<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditUserPhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $userId = Auth::user()->id;
        // dd($userId);
        return [
            'phone' => [
                'required', 'regex:/^\+998\d{9}$/',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
            'password' => 'required|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Введите номер телефона пользователя +998 94 000 00 00',
            'phone.regex' => 'Телефон +998 94 000 00 00 нужно ввести таким образом',
            'phone.unique' => 'Есть такой номер телефона',
            'password.required' => 'Введите Пароль мин 3 символ',
            'password.min' => 'Введите Пароль мин 3 символ',
        ];
    }
}
