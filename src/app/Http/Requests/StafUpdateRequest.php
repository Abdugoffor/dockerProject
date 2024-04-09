<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StafUpdateRequest extends FormRequest
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
            'phone' => 'required',
            'adres' => 'required',
            // 'img' => 'mimes:jpg,png,jpeg',
            // 'file' => 'mimes:pdf,doc,docx',
            'img' => 'mimes:jpg,png,jpeg',
            'file' => 'file|mimes:pdf,doc,docx,jpg,png,jpeg,xlsx',
            // ...
            'img' => 'sometimes|mimes:jpg,png,jpeg',
            'file' => 'sometimes|file|mimes:pdf,doc,docx,jpg,png,jpeg,xlsx',

            'working_time' => 'required',
            'department_id' => 'required',
            'salary__type_id' => 'required',
            'sum' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'phone.required' => 'Введите телефон',
            'adres.required' => 'Введите адрес',
            'img.mimes' => 'Изображение должно быть в формате jpg, png или jpeg.',
            'file.file' => 'Файл должен быть в формате pdf, doc или docx.',
            'working_time.required' => 'Введите рабочее время',
            'department_id.required' => 'Введите отделение',
            'salary__type_id.required' => 'Введите тип зарплаты',
            'sum.required' => 'Введите сумма',
        ];
    }
}
