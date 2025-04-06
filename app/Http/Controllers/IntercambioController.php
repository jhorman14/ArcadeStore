<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pedido;
use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Support\Facades\Log;

class IntercambioController extends Controller
{
    public function solicitarIntercambio(Request $request, Juego $juegoSolicitado)
    {
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Debes iniciar sesión para solicitar un intercambio.');
        }

        $request->validate([
            'juego_ofrecido_id' => 'required|exists:juegos,id',
        ]);

        $usuario = Auth::user();
        $juegoOfrecidoId = $request->input('juego_ofrecido_id');
        $juegoOfrecido = Juego::findOrFail($juegoOfrecidoId);

        // Verificar si el usuario tiene el juego que está ofreciendo
        if (!$usuario->juegosComprados()->where('juegos.id', $juegoOfrecidoId)->exists()) {
            return Redirect::back()->with('error', 'El juego ofrecido no pertenece a tu biblioteca.');
        }

        if ($juegoSolicitado->id === $juegoOfrecido->id) {
            return Redirect::back()->with('error', 'No puedes intercambiar el mismo juego por sí mismo.');
        }

        $precioSolicitado = $juegoSolicitado->precio;
        $precioOfrecido = $juegoOfrecido->precio;
        $costoAdicional = 0;

        dd("Precio Solicitado:", $precioSolicitado, "Precio Ofrecido:", $precioOfrecido); // <-- PRIMER dd()

        DB::beginTransaction();

        try {
            $intercambio = new Intercambio();
            $intercambio->estado_intercambio = 'Pendiente';
            $intercambio->fecha_intercambio = now()->toDateString();
            $intercambio->id_usuario = $usuario->id;
            $intercambio->id_producto_solicitado = $juegoSolicitado->id;
            $intercambio->id_producto_ofrecido = $juegoOfrecido->id;

            if ($precioSolicitado > $precioOfrecido) {
                $diferencia = $precioSolicitado - $precioOfrecido;
                $costoAdicional = $diferencia * 1.20;
                $intercambio->costo_adicional = $costoAdicional;
                $intercambio->save();
                DB::commit();
                dd("Redirigiendo a pendiente-pago (precio mayor)", $intercambio->id, $costoAdicional); // <-- SEGUNDO dd()
                return Redirect::route('intercambio.pendiente-pago', $intercambio)
                    ->with('costo_adicional', $costoAdicional);
            } elseif ($precioSolicitado < $precioOfrecido) {
                $intercambio->estado_intercambio = 'Aprobado';
                $intercambio->save();
                $usuario->juegosComprados()->detach($juegoOfrecido->id);
                $usuario->juegosComprados()->attach($juegoSolicitado->id);
                DB::commit();
                dd("Redirigiendo a usuario.intercambios (precio menor)"); // <-- TERCER dd()
                return Redirect::route('usuario.intercambios')
                    ->with('success', 'Intercambio completado exitosamente.');
            } else {
                $costoAdicional = $precioSolicitado * 0.20;
                $intercambio->costo_adicional = $costoAdicional;
                $intercambio->save();
                DB::commit();
                dd("Redirigiendo a pendiente-pago (precio igual)", $intercambio->id, $costoAdicional); // <-- CUARTO dd()
                return Redirect::route('intercambio.pendiente-pago', $intercambio)
                    ->with('costo_adicional', $costoAdicional);
            }

            // ¿Hay alguna otra lógica o Redirect::... aquí abajo?

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en intercambio: ' . $e->getMessage());
            return Redirect::back()->with('error', 'Hubo un error al procesar el intercambio.');
        }
    }

    public function procesarPagoIntercambio(Request $request, Intercambio $intercambio)
    {
        $usuario = Auth::user();

        // Verificar que el intercambio pertenece al usuario
        if ($intercambio->id_usuario !== $usuario->id) {
            return Redirect::route('usuario.intercambios')
                ->with('error', 'No estás autorizado para procesar este intercambio.');
        }

        // Verificar que el intercambio está pendiente y tiene costo adicional
        if ($intercambio->estado_intercambio !== 'Pendiente' || !$intercambio->costo_adicional) {
            return Redirect::back()->with('error', 'Este intercambio no requiere pago adicional.');
        }

        DB::beginTransaction();
        try {
            // Aquí iría la lógica de procesamiento del pago real
            $pagoExitoso = true;

            if ($pagoExitoso) {
                $intercambio->estado_intercambio = 'Completado';
                $intercambio->save();

                // Actualizar la biblioteca del usuario
                $usuario->juegosComprados()->detach($intercambio->id_producto_ofrecido);
                $usuario->juegosComprados()->attach($intercambio->id_producto_solicitado);

                // Crear registro de pedido
                $pedido = Pedido::create([
                    'id_usuario' => $usuario->id,
                    'fecha_pedido' => now(),
                    'estado_pedido' => 'Completado (Intercambio)',
                    'id_juego' => $intercambio->id_producto_solicitado,
                ]);

                // Crear registro de pago
                Pago::create([
                    'total' => $intercambio->costo_adicional,
                    'id_pedido' => $pedido->id,
                    'metodo_de_pago' => 'Intercambio (Pago Adicional)',
                ]);

                Venta::createFromPedido($pedido);

                DB::commit();
                return Redirect::route('usuario.intercambios')
                    ->with('success', 'Intercambio completado exitosamente.');
            }

            DB::rollBack();
            return Redirect::back()->with('error', 'El pago no pudo ser procesado.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en pago de intercambio: ' . $e->getMessage());
            return Redirect::back()->with('error', 'Hubo un error al procesar el pago.');
        }
    }

    public function mostrarFormularioIntercambio(Juego $juego)
    {
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Debes iniciar sesión para solicitar un intercambio.');
        }

        $juegosComprados = Auth::user()->juegosComprados;

        // Excluir el juego que se quiere solicitar del listado de juegos ofrecidos
        $juegosOfrecidos = $juegosComprados->reject(function ($item) use ($juego) {
            return $item->id === $juego->id;
        });

        return view('tienda.intercambio', compact('juego', 'juegosOfrecidos'));
    }

    public function pendientePago($id)
    {
        $intercambio = Intercambio::findOrFail($id);
        $costoAdicional = session('costo_adicional');

        if (!$costoAdicional) {
            // Si no hay costo adicional en la sesión, probablemente hubo un error
            return Redirect::route('usuario.intercambios')->with('error', 'Información de pago adicional no encontrada.');
        }

        return view('tienda.intercambio-pago', compact('intercambio', 'costoAdicional'));
    }


    public function listarIntercambios()
    {
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Debes iniciar sesión para ver tus intercambios.');
        }

        $usuario = Auth::user();
        $intercambios = Intercambio::where(function ($query) use ($usuario) {
            $query->where('id_producto_solicitado', function ($q) use ($usuario) {
                $q->select('id')->from('juegos')->whereIn('id', $usuario->juegosComprados()->pluck('juegos.id'));
            })->orWhere('id_producto_ofrecido', function ($q) use ($usuario) {
                $q->select('id')->from('juegos')->whereIn('id', $usuario->juegosComprados()->pluck('juegos.id'));
            });
        })->latest()->paginate(10);

        return view('usuario.intercambios', compact('intercambios'));
    }
}