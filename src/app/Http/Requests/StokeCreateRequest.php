<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StokeCreateRequest extends FormRequest
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
            'name' => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Введите название склада.',
            'user_id.exists' => 'Выбранный пользователь не существует.',
        ];
    }
}
