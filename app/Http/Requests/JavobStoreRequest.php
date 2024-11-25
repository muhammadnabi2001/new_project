<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JavobStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'file' => 'nullable|file',
            'status' => 'required|string',
            'region_id' => 'required|exists:regions,id',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'title maydoni to\'sh qolgan',
            'status.required' => 'status maydoni bo\'sh qolgan',
            'region_id.required' => 'region tanlanmagan',
        ];
    }
}
