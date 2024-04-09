<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourierCreateRequest extends FormRequest
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
            'staf_id' => 'required|exists:stafs,id',
            'phone' => ['required', 'regex:/^\+998\d{9}$/'],
            'car_number' => ['required', 'regex:/^\d{2}[A-Z]\d{3}[A-Z]{2}$/'],
            'telegram_id' => 'required|numeric|digits:9',
        ];
    }

    public function messages(): array
    {
        return [
            'staf_id.required' => 'Выберите сотрудника',
            'phone.required' => 'Введите телефон',
            'phone.regex' => 'Номер телефона должен +998 00 000 00 00',
            'car_number.required' => 'Введите номер машины',
            'car_number.regex' => 'Номер машины должен быть 60A111AA',
            'telegram_id.required' => 'Введите телеграмма_id',
            'telegram_id.numeric' => 'Телеграмма_id должен быть числовым',
            'telegram_id.digits' => 'Телеграма id 9 - число',
        ];
    }
}
