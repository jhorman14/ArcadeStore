<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = Auth::user();
        if ($user->id != $id) {
            return redirect()->route('inicio')->with('error', 'No tienes permiso para ver este perfil.');
        }
        return view('profile.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = Auth::user();
        if ($user->id != $id) {
            return redirect()->route('inicio')->with('error', 'No tienes permiso para editar este perfil.');
        }
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if ($user->id != $id) {
            return redirect()->route('inicio')->with('error', 'No tienes permiso para editar este perfil.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['required', 'string', 'max:20'],
            'nick' => ['required', 'string', 'max:20'],
        ]);

        $user->update($request->all());
        return redirect()->route('profile.show', $user->id)->with('success', 'Perfil actualizado exitosamente.');
    }

    public function deactivateAccount(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                Log::error('Intento de desactivación de cuenta sin usuario autenticado');
                return redirect()->route('inicio')->with('error', 'Usuario no encontrado.');
            }

            // Guardar el ID del usuario antes de desactivar
            $userId = $user->id;

            // Actualizar el estado de la cuenta
            $user->is_active = false;
            $user->save();

            // Log para debugging
            Log::info('Cuenta desactivada para el usuario: ' . $userId);

            // Cerrar la sesión
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('inicio')->with('success', 'Tu cuenta ha sido eliminada exitosamente.');
            
        } catch (\Exception $e) {
            Log::error('Error al desactivar cuenta: ' . $e->getMessage());
            return redirect()->route('inicio')->with('error', 'Ocurrió un error al eliminar la cuenta.');
        }
    }
}
