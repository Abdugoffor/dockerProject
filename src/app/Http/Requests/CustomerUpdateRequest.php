<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone1' => ['required', 'string', 'regex:/^\+998\d{9}$/'],
            'phone2' => ['nullable', 'regex:/^\+998\d{9}$/'],
            // 'balans' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя клиента',
            'phone1.required' => 'Введите телефон 1, (+998 94 105 04 05)',
            'phone2.regex' => 'Введите телефон 2, (+998 94 105 04 05)',
            // 'balans.required' => 'Введите Баланис',
        ];
    }
}
