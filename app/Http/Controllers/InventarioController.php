<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventarioController extends Controller
{
    public function reducirStock(Request $request)
    {
        Log::info('Iniciando reducción de stock para juego_id: ' . $request->juego_id);
        
        DB::beginTransaction();
        try {
            // Buscamos el inventario usando id_juego en lugar de juego_id
            $inventario = Inventario::where('id_juego', $request->juego_id)->first();
            
            if (!$inventario) {
                Log::error('Inventario no encontrado para juego_id: ' . $request->juego_id);
                DB::rollBack();
                return response()->json(['error' => 'Inventario no encontrado.'], 404);
            }

            if ($inventario->stock <= 0) {
                Log::warning('Stock insuficiente para juego_id: ' . $request->juego_id);
                DB::rollBack();
                return response()->json(['error' => 'No hay suficiente stock disponible.'], 400);
            }

            $inventario->stock -= 1;
            $inventario->save();
            
            DB::commit();
            Log::info('Stock reducido exitosamente. Nuevo stock: ' . $inventario->stock);
            
            return response()->json([
                'success' => true, 
                'message' => 'Stock reducido exitosamente.',
                'nuevo_stock' => $inventario->stock
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al reducir stock: ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'error' => 'Ocurrió un error al reducir el stock.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
