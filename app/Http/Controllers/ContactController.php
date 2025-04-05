<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeContacto; // Asegúrate de crear este Mailable

class ContactController extends Controller
{
    public function enviarMensaje(Request $request)
    {
        // 1. Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // 2. Enviar el correo electrónico
        $datos = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'asunto' => $request->asunto,
            'mensaje' => $request->mensaje,
        ];

        Mail::to('arcade.store03@gmail.com')->send(new MensajeContacto($datos));

        // 3. (Opcional) Guardar en la base de datos
        // ... (Implementa esto si lo necesitas)

        // 4. Redirigir con mensaje de éxito
        return redirect()->route('inicio')->with('success', 'Tu mensaje ha sido enviado correctamente. ¡Gracias!');
    }
}