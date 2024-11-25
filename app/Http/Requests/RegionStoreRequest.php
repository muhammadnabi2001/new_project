<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionStoreRequest extends FormRequest
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
            'user_id'=>'required',
            'name'=>'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'user_id.required'=>'User id topilmadi',
            'name.required'=>'Name maydoni bo\'sh qolgan'
        ];
    }
}
