<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrixodModelRequest extends FormRequest
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
            // 'shipper' => 'required',
            // 'consignee' => 'required',
            // 'nomer' => 'required',
            // 'date' => 'required',
            // 'sender' => 'required',
            // 'recipient' => 'required',
            'materials *' => 'required|array'
        ];
    }
    public function messages()
    {
        return [
            // 'shipper.required' => 'Введите Грузоотправитель',
            // 'consignee.required' => 'Введите Грузополучатель',
            // 'nomer.required' => 'Введите Основание для отпуска: Договор №',
            // 'date.required' => 'Введите Дата',
            // 'sender.required' => 'Введите Отпустил',
            // 'recipient.required' => 'Введите Получил',
            'materials.required' => 'Введите Материалы',
        ];
    }
}
