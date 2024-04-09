<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RashodStoreRequest extends FormRequest
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
        $rules = [
            'rashod_type' => 'required',
            'type_sum' => 'required',
            'sum' => 'required|numeric|gt:0',
        ];

        if ($this->input('type_sum') == 4) {
            $rules['kurs'] = 'required|numeric|gt:0'; // Checking positive number using `gt` rule
        }

        if ($this->input('rashod_type') == 1) {
            $rules['application_id'] = 'required';
        } else {
            $rules['application_id'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'rashod_type.required' => 'Выбор типа',
            'type_sum.required' => 'Введите типа сумму',
            'sum.required' => 'Введите сумму обязательно',
            'sum.numeric' => 'Введите сумму в число',
            'kurs.required' => 'Введите курс доллара',
            'kurs.numeric' => 'Введите курс доллара в число',
            'kurs.gt' => 'Введите курс доллара в число',
            'application_id.required' => 'Введите Заявки',
        ];
    }
}
