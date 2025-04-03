<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'id_juego' => 'required|exists:juegos,id',
            'metodo_de_pago' => 'required|string',
            'total' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'id_juego.required' => 'Por favor, selecciona un juego.',
            'id_juego.exists' => 'El juego seleccionado no existe.',
            'metodo_de_pago.required' => 'Por favor, selecciona un método de pago.',
            'metodo_de_pago.in' => 'El método de pago seleccionado no es válido.',
            'total.required' => 'El total es requerido.',
            'total.numeric' => 'El total debe ser un número.',
            'total.min' => 'El total no puede ser negativo.'
        ];
    }
}
