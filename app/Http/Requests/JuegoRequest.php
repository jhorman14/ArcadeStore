<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JuegoRequest extends FormRequest
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
			'titulo' => 'required|string',
			'precio' => 'required',
			'descripcion' => 'string',
			'requisitos_minimos' => 'string',
			'requisitos_recomendados' => 'string',
			'id_categoria' => 'required',
        ];
    }
}
