<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class ProtsentRequest extends FormRequest
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
            'protsent' => 'nullable|string',
        ];
    }

    public function validate(array $data)
    {
        $validatedData = Validator::make($data, [
            'protsent' => 'nullable|string',
        ])->validate();

        if (isset($validatedData['protsent'])) {
            // Agar 'protsent' kiritilgan bo'lsa
            $protsent = $validatedData['protsent'];

            // Son va floatga o'tkazib ko'rish
            if (!is_numeric($protsent)) {
                throw new \Exception('Invalid value for "protsent". Must be a number.');
            }

            // Qiymatni floatga aylantirish
            $protsent = floatval($protsent);

            // Sonning butun son yoki floatga o'tgani tekshiriladi
            if (!is_int($protsent) && !is_float($protsent)) {
                throw new \Exception('Invalid value for "protsent". Must be an integer or float.');
            }

            $validatedData['protsent'] = $protsent;
        }

        return $validatedData;
    }
}
