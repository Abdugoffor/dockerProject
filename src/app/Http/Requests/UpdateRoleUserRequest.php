<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $userId = $this->route('staf')->user->user->id;
        // dd($userId);
        return [
            'name' => 'required',
            'roles' => 'required|array|exists:roles,name',
            'phone' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'roles.required' => 'Роль пользователя должна быть выбрана',
            'phone.required' => 'Введите номер телефона пользователя +998 94 105 04 05',
            'phone.unique' => 'Есть такой номер телефона',
        ];
    }
}
