<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price' => 'required|numeric|min:0.01|max:999999.99',

            //uz validation
            'translations.uz.name' => 'required|sometimes|string|min:3',
            'translations.uz.description' => 'required|sometimes|string|max:225',

            //en validation
            'translation.en.name' => 'required|sometimes|string|min:3',
            'translations.en.description' => 'required|sometimes|string|max:225',
            
            //ru validation
            'translation.ru.name' => 'required|sometimes|string|min:3',
            'translations.ru.description' => 'required|sometimes|string|max:225',

        ];
    }
}
