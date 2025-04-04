<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Juego; // Asegúrate de importar el modelo Juego
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
    Log::info('Datos del formulario completo recibidos: ' . json_encode($request->all()));

    $pagoExitoso = true;

    if ($pagoExitoso) {
        DB::beginTransaction();
        try {
            $juego = Juego::findOrFail($request->id_juego);
            $totalPedido = $juego->precio;

            $pedidoData = [
                'id_usuario' => auth()->id(),
                'fecha_pedido' => now(),
                'estado_pedido' => 'Completado',
                'id_juego' => $request->id_juego,
            ];
            
            $pedido = Pedido::create($pedidoData);

            $pagoData = [
                'total' => $totalPedido,
                'id_pedido' => $pedido->id,
                'metodo_de_pago' => $request->metodo_de_pago,
            ];
            
            $pago = Pago::create($pagoData);

            DB::commit();
            $inventarioController = app(InventarioController::class);
            $inventarioController->reducirStock($request);
            
            return redirect()->route('pedido.gracias', $pedido)
                           ->with('success', 'Pedido creado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear pedido y pago: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->withInput()->withErrors(['error' => 'Hubo un error al crear el pedido: ' . $e->getMessage()]);
        }
    }
    
    return back()->withInput()->withErrors(['error' => 'El pago simulado no fue exitoso.']);
}


    /**
     * Show the thank you page after a successful order.
     */
    public function gracias(Pedido $pedido)
    {
        return view('pedido.gracias', compact('pedido'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = auth()->user()->pedidos()->paginate(10);
        $juegosComprados = auth()->user()->juegosComprados; // Obtener los juegos comprados por el usuario a través de la tabla pedidos
        return view('pedido.index', compact('pedidos', 'juegosComprados'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $pago = Pago::where('id_pedido', $pedido->id)->first(); // Obtener el pago asociado
        return view('pedido.show', compact('pedido', 'pago'));
    }

    public function __construct()
{
    $this->middleware('auth');
}

    // Puedes agregar otros métodos como edit, update, destroy si los necesitas para la gestión de pedidos
}
