<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntercambioRequest extends FormRequest
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
			'estado_intercambio' => 'required|string',
			'fecha_intercambio' => 'required',
			'id_producto_solicitado' => 'required',
			'id_producto_ofrecido' => 'required',
        ];
    }
}
