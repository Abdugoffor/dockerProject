<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductProductionRequest extends FormRequest
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
            'model_product_id' => 'required',
            'product_stok_id' => 'required|exists:product_stoks,id',
            'equipment1' => 'required|numeric',
            'user1' => 'required|exists:users,id',
            // 'users.*' => 'exists:users,id',
            'count' => 'required|numeric',
            'lose' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'model_product_id.required' => 'Выберите Модель продукта',
            'equipment1.required' => 'Выберите склад',
            'user1.required' => 'Введите пользователи',
            'count.required' => 'Count должен быть числом',
            'lose.required' => 'Введите % потерь',
        ];
    }
}
