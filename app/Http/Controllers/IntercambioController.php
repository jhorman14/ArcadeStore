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
    public function solicitarIntercambio(Request $request, Juego $juego_id)
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

        if (!$usuario->juegosComprados()->where('juegos.id', $juegoOfrecidoId)->exists()) {
            return Redirect::back()->with('error', 'El juego ofrecido no pertenece a tu biblioteca.');
        }

        if ($juego_id->id === $juegoOfrecido->id) {
            return Redirect::back()->with('error', 'No puedes intercambiar el mismo juego por sí mismo.');
        }

        $precioSolicitado = $juego_id->precio;
        $precioOfrecido = $juegoOfrecido->precio;
        $costoAdicional = 0;

        DB::beginTransaction();

        try {
            $intercambio = new Intercambio();
            $intercambio->estado_intercambio = 'Pendiente';
            $intercambio->fecha_intercambio = now()->toDateString();
            $intercambio->id_usuario = $usuario->id;
            $intercambio->id_producto_solicitado = $juego_id->id;
            $intercambio->id_producto_ofrecido = $juegoOfrecido->id;

            if ($precioSolicitado > $precioOfrecido) {
                $diferencia = $precioSolicitado - $precioOfrecido;
                $costoAdicional = $diferencia * 1.20;
                $intercambio->costo_adicional = $costoAdicional;
                $intercambio->save();
                DB::commit();
                return Redirect::route('intercambio.pendiente-pago', $intercambio)
                    ->with('costo_adicional', $costoAdicional);
            } elseif ($precioSolicitado < $precioOfrecido) {
                $intercambio->estado_intercambio = 'Aprobado';
                $intercambio->save();
                $usuario->juegosComprados()->detach($juegoOfrecido->id);
                $usuario->juegosComprados()->attach($juego_id->id);
                DB::commit();
                return Redirect::route('pedido.intercambios')
                    ->with('success', 'Intercambio completado exitosamente.');
            } else {
                $costoAdicional = $precioSolicitado * 0.20;
                $intercambio->costo_adicional = $costoAdicional;
                $intercambio->save();
                DB::commit();
                return Redirect::route('intercambio.pendiente-pago', $intercambio)
                    ->with('costo_adicional', $costoAdicional);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en intercambio: ' . $e->getMessage());
            return Redirect::back()->with('error', 'Hubo un error al procesar el intercambio.');
        }
    }

    public function procesarPagoIntercambio(Request $request, Intercambio $intercambio)
    {
        DB::beginTransaction();
        try {
            $usuario = Auth::user();
            
            // Actualizar estado del intercambio
            $intercambio->estado_intercambio = 'Completado';
            $intercambio->save();

            // Realizar el intercambio de juegos
            $usuario->juegosComprados()->detach($intercambio->id_producto_ofrecido);
            $usuario->juegosComprados()->attach($intercambio->id_producto_solicitado);

            // Crear pedido
            $pedido = new Pedido();
            $pedido->id_usuario = $usuario->id;
            $pedido->fecha_pedido = now();
            $pedido->estado_pedido = 'Completado';
            $pedido->id_juego = $intercambio->id_producto_solicitado;
            $pedido->save();

            // Registrar pago
            $pago = new Pago();
            $pago->total = $intercambio->costo_adicional ?? 0;
            $pago->id_pedido = $pedido->id;
            $pago->metodo_de_pago = $request->metodo_de_pago ?? 'Simulado';
            $pago->save();

            // Crear venta
            Venta::createFromPedido($pedido);

            DB::commit();
            return redirect()->route('pedido.intercambios')
                ->with('success', 'Intercambio completado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar pago: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function mostrarFormularioIntercambio(Juego $juego)
    {
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Debes iniciar sesión para solicitar un intercambio.');
        }

        $juegosComprados = Auth::user()->juegosComprados;
        $juegosOfrecidos = $juegosComprados->reject(function ($item) use ($juego) {
            return $item->id === $juego->id;
        });

        return view('tienda.intercambio', compact('juego', 'juegosOfrecidos'));
    }

    public function pendientePago($id)
    {
        $intercambio = Intercambio::findOrFail($id);
        
        // Asegurarse de que el costo adicional esté disponible
        $costoAdicional = $intercambio->costo_adicional ?? session('costo_adicional');

        if (!$costoAdicional) {
            return redirect()->route('usuario.intercambios')
                ->with('error', 'Información de pago adicional no encontrada.');
        }

        return view('pedido.intercambio-pago', [
            'intercambio' => $intercambio,
            'costoAdicional' => $costoAdicional
        ]);
    }

    public function listarIntercambios()
    {
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Debes iniciar sesión para ver tus intercambios.');
        }

        $usuario = Auth::user();
        $intercambios = Intercambio::where('id_usuario', $usuario->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pedido.intercambios', compact('intercambios'));
    }
}
