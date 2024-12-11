<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => 'nullable|numeric|min:0.01|max:999999.99',

            //uz validation
            'translations.uz.name' => 'nullable|sometimes|string|min:3',
            'translations.uz.description' => 'nullable|sometimes|string|max:225',

            //en validation
            'translation.en.name' => 'nullable|sometimes|string|min:3',
            'translations.en.description' => 'nullable|sometimes|string|max:225',

            //ru validation
            'translation.ru.name' => 'nullable|sometimes|string|min:3',
            'translations.ru.description' => 'nullable|sometimes|string|max:225',
        ];
    }
}
