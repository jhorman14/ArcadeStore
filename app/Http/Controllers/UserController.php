<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario autenticado es el mismo que se está viendo
        if ($user->id != $id) {
            // Puedes redirigir o mostrar un error si no coincide
            return redirect()->route('home')->with('error', 'No tienes permiso para ver este perfil.');
        }

        // Lógica para mostrar el perfil del usuario
        return view('user.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario autenticado es el mismo que se está editando
        if ($user->id != $id) {
            // Puedes redirigir o mostrar un error si no coincide
            return redirect()->route('home')->with('error', 'No tienes permiso para editar este perfil.');
        }

        // Lógica para mostrar el formulario de edición del perfil
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario autenticado es el mismo que se está actualizando
        if ($user->id != $id) {
            // Puedes redirigir o mostrar un error si no coincide
            return redirect()->route('home')->with('error', 'No tienes permiso para editar este perfil.');
        }

        $request->validate([
            // Define tus reglas de validación para la actualización del perfil aquí
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['required', 'string', 'max:20'],
            'nick' => ['required', 'string', 'max:20'],
        ]);

        $user->update( $request->all());

        return redirect()->route('profile.show', $user->id)->with('success', 'Perfil actualizado exitosamente.');
    }

    public function deactivateAccount(Request $request)
    {
        $user = Auth::user();

        $user->update(['is_active' => false]);

        Auth::logout();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada.');
    }
}