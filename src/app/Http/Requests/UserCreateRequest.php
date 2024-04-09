<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
            'roles' => 'required|array',
            // 'roles.*' => 'required|string|max:255|in_table_column:roles,name',
            'permissions' => 'required|array',
            // 'permissions.*' => 'required|string|max:255|in_table_column:permissions,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя пользователя',
            'phone.required' => 'Введите номер телефона пользователя',
            'phone.unique' => 'Есть такой номер телефона',
            'password.required' => 'Введите пароль длиной не менее 8 символов',
            'password.min' => 'Пароль должен содержать как минимум 8 символов',
            'c_password.required' => 'Введите пароль длиной не менее 8 символов',
            'c_password.same' => 'Ошибка подтверждения пароля',
            'roles.required' => 'Роль пользователя должна быть выбрана',
            'permissions.required' => 'Разрешения должны быть выбраны',
        ];
    }
}
