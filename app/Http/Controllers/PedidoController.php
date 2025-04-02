<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Pago;
use App\Models\Juego; // Asegúrate de importar el modelo Juego
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PedidoRequest;

class PedidoController extends Controller
{
    public function create($juego_id = null)
    {
        $juegos = Juego::all();
        return view('pedido.create', compact('juegos', 'juego_id'));
    }
    /**
     * Store a newly created resource in storage (simulando pago exitoso y creando pedido).
     */
    public function store(PedidoRequest $request)
{
    // Simulación de pago exitoso
    $pagoExitoso = true;

    if ($pagoExitoso) {
        DB::beginTransaction();
        try {
            $pago = Pago::create([
                'total' => $request->total, // Obtén el total del request
                'id_pedido' => null,
                'metodo_de_pago' => $request->metodo_de_pago,
            ]);

            $pedido = Pedido::create([
                'id_usuario' => auth()->id(),
                'fechapedido' => now(),
                'estadopedido' => 'Pendiente',
                'Id_juego' => $request->id_juego,
                'total' => $request->total, // Guarda también el total en la tabla de pedidos (opcional pero útil)
            ]);

            $pago->update(['id_pedido' => $pedido->id_pedido]);

            DB::commit();

            return redirect()->route('pedidos.show', $pedido->id_pedido)->with('success', 'Pedido creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear pedido y pago (simulado): ' . $e->getMessage());
            return back()->withErrors(['error' => 'Hubo un error al crear el pedido.']);
        }
    } else {
        return back()->withErrors(['error' => 'El pago simulado no fue exitoso.']);
    }
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = auth()->user()->pedidos()->paginate(10);
        return view('pedido.index', compact('pedidos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return view('pedido.show', compact('pedido'));
    }

    // Puedes agregar otros métodos como edit, update, destroy si los necesitas para la gestión de pedidos
}