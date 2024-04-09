<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinesStoreRequest extends FormRequest
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
            'staf_id' => 'required',
            'date' => 'required',
            'summa' => 'required',
            'comment' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'staf_id.required' => 'Выберите сотрудника',
            'date.required' => 'Введите дату',
            'summa.required' => 'Введите сумму',
            'comment.required' => 'Оставить комментарий',
        ];
    }
}
