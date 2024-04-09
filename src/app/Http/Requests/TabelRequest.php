<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TabelRequest extends FormRequest
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
            'tabels' => 'required|array',
            'how_many' => 'required',
            'stavka' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            // 'tabels.array' => 'sa',
            'tabels.required' => 'Выберите даты',
            'how_many.required' => 'Введите количество отработанных часов',
            'stavka.required' => 'Введите Ставка',
        ];
    }
}
