<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Juego;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PedidoRequest;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ Importar DomPDF

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($juego_id = null)
    {
        $juegos = Juego::all();
        return view('pedido.create', compact('juegos', 'juego_id'));
    }

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

                Venta::createFromPedido($pedido);

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

    public function gracias(Pedido $pedido)
    {
        return view('pedido.gracias', compact('pedido'));
    }

    public function index()
    {
        $pedidos = auth()->user()->pedidos()->paginate(10);
        $juegosComprados = auth()->user()->juegosComprados;
        return view('pedido.index', compact('pedidos', 'juegosComprados'));
    }

    public function show(Pedido $pedido)
    {
        $pago = Pago::where('id_pedido', $pedido->id)->first();

        // ✅ Generar PDF si se solicita con ?pdf=1
        if (request()->has('pdf')) {
            $pdf = Pdf::loadView('pedido.show', compact('pedido', 'pago'));
            return $pdf->download('comprobante-pedido-' . $pedido->id . '.pdf');
        }

        return view('pedido.show', compact('pedido', 'pago'));
    }
}
