<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchKassaRequest extends FormRequest
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
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ];
    }

    public function messages(): array
    {
        return [
            'start.required' => 'Введите От дата',
            'end.required' => 'Введите До дата',
            'end.after_or_equal' => 'Неверный диапазон дат',
        ];
    }
}
