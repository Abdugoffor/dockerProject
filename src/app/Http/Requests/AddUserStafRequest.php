<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class AddUserStafRequest extends FormRequest
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
            'roles' => 'required|array|exists:roles,name',
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'pas' => 'required|min:3',
        ];
    }


    public function messages(): array
    {
        return [
            'roles.required' => 'Роль пользователя должна быть выбрана',
            'phone.required' => 'Введите номер телефона пользователя +998 94 105 04 05',
            'phone.unique' => 'Есть такой номер телефона',
            'pas.required' => 'Введите пароль длиной не менее 3 символов',
        ];
    }
}
