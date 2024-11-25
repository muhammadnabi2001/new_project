<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopshiriqUpdateRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'ijrochi' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx,xls,xlsx|max:2048',
            'muddat' => 'required|date',
            'regions' => 'required|array',
            'regions.*' => 'exists:regions,id',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Categorya tanlanmagan',
            'ijrochi.required' => 'Ijrochi maydonini to\'ldiring',
            'title.required' => 'title maydonini to\'diring',
            'description.required' => 'descrtiption maydonini to\'ldiring',
            'muddat.required' => 'muddat tanlanmagan',
            'regions.required' => 'Hudud tanlangmagan',
        ];
    }
}
