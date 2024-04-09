<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
        $userId = $this->route('role')->id;
        return [
            'name' => ['required', Rule::unique('roles', 'id')->ignore($userId)],
            'permissions' => 'required|array|exists:permissions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя ролей',
            'name.unique' => 'Есть такая роль',
            'permissions.required' => 'Введите разрешения',
            'permissions.exists' => 'Выберите разрешения',
        ];
    }
}
