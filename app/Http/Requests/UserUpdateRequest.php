<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'role' => 'nullable|string|max:255', 
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ism maydoni to\'ldirilishi shart.',
            'email.required' => 'Email maydoni to\'ldirilishi shart.',
            'email.unique' => 'Bu email allaqachon mavjud.',
            'role.string' => 'Rol faqat matnli bo\'lishi kerak.',
        ];
    }
}
