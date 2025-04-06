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

        $juegoOfrecidoId = $request->input('juego_ofrecido_id');
        $juegoOfrecido = Juego::findOrFail($juegoOfrecidoId);
        $usuario = Auth::user();

        if (!$usuario->juegosComprados->contains($juegoOfrecido)) {
            return Redirect::back()->with('error', 'El juego ofrecido no pertenece a tu biblioteca.');
        }

        if ($juegoSolicitado->id === $juegoOfrecido->id) {
            return Redirect::back()->with('error', 'No puedes intercambiar el mismo juego por sí mismo.');
        }

        $precioSolicitado = $juegoSolicitado->precio;
        $precioOfrecido = $juegoOfrecido->precio;
        $costoAdicional = 0;

        DB::beginTransaction();

        try {
            $intercambio = new Intercambio();
            $intercambio->estado_intercambio = 'Pendiente';
            $intercambio->fecha_intercambio = now()->toDateString();
            $intercambio->id_producto_solicitado = $juegoSolicitado->id;
            $intercambio->id_producto_ofrecido = $juegoOfrecido->id;
            $intercambio->save();

            if ($precioSolicitado > $precioOfrecido) {
                $diferencia = $precioSolicitado - $precioOfrecido;
                $costoAdicional = $diferencia * 1.20;
                DB::commit();
                return Redirect::route('intercambio.pendiente-pago', $intercambio)->with('costo_adicional', $costoAdicional);
            } elseif ($precioSolicitado < $precioOfrecido) {
                $intercambio->estado_intercambio = 'Aprobado';
                $intercambio->save();
                $usuario->juegosComprados()->detach($juegoOfrecido->id);
                $usuario->juegosComprados()->attach($juegoSolicitado->id);
                DB::commit();
                return Redirect::route('usuario.intercambios')->with('success', 'Intercambio solicitado y aprobado.');
            } else {
                $costoAdicional = $precioSolicitado * 0.20;
                DB::commit();
                return Redirect::route('intercambio.pendiente-pago', $intercambio)->with('costo_adicional', $costoAdicional);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', 'Hubo un error al solicitar el intercambio: ' . $e->getMessage());
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

    public function pendientePago(\App\Models\Intercambio $intercambio)
    {
        $costoAdicional = session('costo_adicional');

        if (!$costoAdicional) {
            return Redirect::route('usuario.intercambios')->with('error', 'Información de pago adicional no encontrada.');
        }

        return view('tienda.intercambio-pago', compact('intercambio', 'costoAdicional'));
    }

    public function procesarPagoIntercambio(Request $request, \App\Models\Intercambio $intercambio)
    {
        if ($intercambio->id_producto_ofrecido !== auth()->user()->juegosComprados()->pluck('juegos.id')->first()) {
            return Redirect::route('usuario.intercambios')->with('error', 'No estás autorizado para procesar el pago de este intercambio.');
        }

        $costoAdicional = session('costo_adicional');
        $montoPagado = $request->input('monto');

        if (!$costoAdicional || $montoPagado != $costoAdicional) {
            return Redirect::back()->with('error', 'El monto pagado no coincide con el costo adicional.');
        }

        DB::beginTransaction();
        try {
            $pagoExitoso = true;

            if ($pagoExitoso) {
                $intercambio->estado_intercambio = 'Completado';
                $intercambio->save();

                $usuario = auth()->user();
                $juegoSolicitado = $intercambio->productoSolicitado;
                $juegoOfrecido = $intercambio->productoOfrecido;

                $usuario->juegosComprados()->detach($juegoOfrecido->id);
                $usuario->juegosComprados()->attach($juegoSolicitado->id);

                $pedidoData = [
                    'id_usuario' => $usuario->id,
                    'fecha_pedido' => now(),
                    'estado_pedido' => 'Completado (Intercambio)',
                    'id_juego' => $juegoSolicitado->id,
                ];
                $pedido = Pedido::create($pedidoData);

                $pagoData = [
                    'total' => $costoAdicional,
                    'id_pedido' => $pedido->id,
                    'metodo_de_pago' => 'Intercambio (Pago Adicional)',
                ];
                Pago::create($pagoData);

                Venta::createFromPedido($pedido);

                DB::commit();

                session()->forget('costo_adicional');

                return Redirect::route('usuario.intercambios')->with('success', 'Pago adicional procesado. Intercambio completado.');
            } else {
                DB::rollBack();
                return Redirect::back()->with('error', 'El pago simulado falló.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar el pago del intercambio: ' . $e->getMessage());
            return Redirect::back()->with('error', 'Hubo un error al procesar el pago del intercambio.');
        }
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