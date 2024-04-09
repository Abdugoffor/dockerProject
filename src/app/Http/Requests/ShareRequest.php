<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShareRequest extends FormRequest
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
            'material_stok_value' => 'required|numeric',
            'quantity' => 'required',
            'to_id' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'material_stok_value.required' => 'Выберите склад материалов',
            'quantity.required' => 'Введите номер',
            'to_id.required' => 'Выберите, куда отправить',
        ];
    }
}
