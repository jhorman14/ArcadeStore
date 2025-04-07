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
    $juegoSolicitado = Juego::findOrFail($juego_id->id);

    if (!$usuario->juegosComprados()->where('juegos.id', $juegoOfrecidoId)->exists()) {
        return Redirect::back()->with('error', 'El juego ofrecido no pertenece a tu biblioteca.');
    }

    if (!$juegoSolicitado) {
        return Redirect::back()->with('error', 'El juego solicitado no existe.');
    }

    if ($juego_id->id === $juegoOfrecido->id) {
        return Redirect::back()->with('error', 'No puedes intercambiar el mismo juego por sí mismo.');
    }

    // Verificar si ya existe un intercambio pendiente para estos juegos
    $intercambioExistente = Intercambio::where('id_usuario', $usuario->id)
        ->where('id_producto_solicitado', $juego_id->id)
        ->where('id_producto_ofrecido', $juegoOfrecido->id)
        ->whereIn('estado_intercambio', ['Pendiente', 'Pendiente_Pago'])
        ->first();

    if ($intercambioExistente) {
        return Redirect::back()->with('error', 'Ya existe una solicitud de intercambio pendiente para estos juegos.');
    }

    $precioSolicitado = $juego_id->precio;
    $precioOfrecido = $juegoOfrecido->precio;
    $costoAdicional = 0;

    if ($precioSolicitado > $precioOfrecido) {
        $costoAdicional = ($precioSolicitado - $precioOfrecido) * 1.20;
    } elseif ($precioSolicitado == $precioOfrecido) {
        $costoAdicional = $precioSolicitado * 0.20;
    }

    DB::beginTransaction();

    try {
        // Crear el intercambio con estado inicial
        $intercambio = new Intercambio();
        $intercambio->estado_intercambio = $costoAdicional > 0 ? 'Pendiente_Pago' : 'Pendiente';
        $intercambio->fecha_intercambio = now()->toDateString();
        $intercambio->id_usuario = $usuario->id;
        $intercambio->id_producto_solicitado = $juego_id->id;
        $intercambio->id_producto_ofrecido = $juegoOfrecido->id;
        $intercambio->costo_adicional = $costoAdicional;
        $intercambio->save();

        if ($costoAdicional > 0) {
            DB::commit();
            return Redirect::route('intercambio.pendiente-pago', $intercambio)
                ->with('mensaje', 'Por favor, complete el pago adicional para finalizar el intercambio.');
        } else {
            // Procesar intercambio directo sin pago
            $this->completarIntercambio($intercambio);
            DB::commit();
            return Redirect::route('usuario.intercambios')
                ->with('success', 'Intercambio completado exitosamente.');
        }
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error en intercambio: ' . $e->getMessage());
        return Redirect::back()->with('error', 'Hubo un error al procesar el intercambio.');
    }
}


protected function completarIntercambio(Intercambio $intercambio)
{
    $usuario = Auth::user();
    
    DB::beginTransaction();
    try {
        // Actualizar estado
        $intercambio->estado_intercambio = 'Completado';
        $intercambio->save();

        // Verificar si el usuario ya tiene el juego solicitado
        if (!$usuario->juegosComprados()->where('juegos.id', $intercambio->id_producto_solicitado)->exists()) {
            // Realizar el intercambio de juegos
            $usuario->juegosComprados()->detach($intercambio->id_producto_ofrecido);
            $usuario->juegosComprados()->attach($intercambio->id_producto_solicitado, ['created_at' => now(), 'updated_at' => now()]);
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error en completarIntercambio: ' . $e->getMessage());
        throw $e;
    }
}


public function procesarPagoIntercambio(Request $request, Intercambio $intercambio)
{
    Log::info('Iniciando procesarPagoIntercambio para intercambio ID: ' . $intercambio->id);

    // Verificar si el intercambio existe y pertenece al usuario actual
    if (!$intercambio || $intercambio->id_usuario !== Auth::id()) {
        Log::error('Intercambio no encontrado o no pertenece al usuario');
        return redirect()->back()->with('error', 'Intercambio no válido.');
    }

    if ($intercambio->estado_intercambio === 'Completado') {
        Log::info('Intercambio ya completado. Redirigiendo.');
        return redirect()->route('usuario.intercambios')
            ->with('info', 'Este intercambio ya ha sido completado.');
    }

    // Validar el método de pago
    try {
        $request->validate([
            'metodo_de_pago' => 'required|string|in:tarjeta,paypal,transferencia'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Error de validación: ' . json_encode($e->errors()));
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput();
    }

    DB::beginTransaction();
    try {
        $usuario = Auth::user();
        Log::info('Usuario autenticado: ' . $usuario->id);

        // Verificar si ya existe un pedido para este intercambio
        $pedidoExistente = Pedido::where('id_intercambio', $intercambio->id)->first();
        
        if (!$pedidoExistente) {
            // Crear el pedido
            $pedido = new Pedido();
            $pedido->fecha_pedido = now();
            $pedido->estado_pedido = 'Completado';
            $pedido->id_usuario = $usuario->id;
            $pedido->id_juego = $intercambio->id_producto_solicitado;
            $pedido->id_intercambio = $intercambio->id;
            $pedido->save();
            Log::info('Pedido creado con ID: ' . $pedido->id);

            // Crear el pago
            $pago = new Pago();
            $pago->metodo_de_pago = $request->metodo_de_pago;
            $pago->total = $intercambio->costo_adicional;
            $pago->id_pedido = $pedido->id;
            $pago->id_intercambio = $intercambio->id;
            $pago->save();
            Log::info('Pago creado con ID: ' . $pago->id);
        }
        // Realizar el intercambio de juegos
        $usuario->juegosComprados()->detach($intercambio->id_producto_ofrecido);
        // Verificar si el usuario ya tiene el juego solicitado
        if (!$usuario->juegosComprados()->where('juegos.id', $intercambio->id_producto_solicitado)->exists()) {
            $usuario->juegosComprados()->attach($intercambio->id_producto_solicitado, ['created_at' => now(), 'updated_at' => now()]);
            Log::info('Juegos intercambiados correctamente');
        }

        // Actualizar el estado del intercambio
        $intercambio->estado_intercambio = 'Completado';
        $intercambio->save();
        Log::info('Estado del intercambio actualizado a Completado');

        DB::commit();
        Log::info('Transacción completada exitosamente');

        return redirect()->route('usuario.intercambios')
            ->with('success', 'Pago procesado y intercambio completado exitosamente.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al procesar pago: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return redirect()->back()
            ->with('error', 'Error al procesar el pago: ' . $e->getMessage())
            ->withInput();
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

        if ($intercambio->estado_intercambio === 'Completado') {
            return redirect()->route('usuario.intercambios')
                ->with('info', 'Este intercambio ya ha sido completado.');
        }

        if ($intercambio->estado_intercambio !== 'Pendiente_Pago') {
            return redirect()->route('usuario.intercambios')
                ->with('error', 'Este intercambio no está pendiente de pago.');
        }

        return view('pedido.intercambio-pago', [
            'intercambio' => $intercambio,
            'costoAdicional' => $intercambio->costo_adicional
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
