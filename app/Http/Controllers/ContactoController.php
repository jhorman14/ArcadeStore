<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviarMensaje(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required',
        ]);

        // Enviar el correo electrónico
        Mail::raw($request->mensaje, function ($message) use ($request) {
            $message->from($request->email, $request->nombre);
            $message->to('info@arcadestore.com');
            $message->subject($request->asunto);
        });

        // Mostrar un mensaje de éxito
        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}