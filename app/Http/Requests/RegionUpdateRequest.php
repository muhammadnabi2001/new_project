<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionUpdateRequest extends FormRequest
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
            'user_id'=>'required|exists:users,id',
            'name'=>'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'user_id.required'=>'user maydoni bo\'sh qolgan',
            'name.required'=>'name maydonino to\'ldiring'
        ];
    }
}
