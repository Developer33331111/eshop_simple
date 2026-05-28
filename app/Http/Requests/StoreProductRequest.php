<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
            'code' => ['nullable', 'string'],
            'seo_url' => ['nullable', 'string'],
            'description' => ['nullable', 'text'],
            'parameters' => ['nullable', 'array'],
            'parameters.*.name' => ['required_with:parameters', 'string', 'max:100'],
            'parameters.*.value' => ['required_with:parameters', 'string', 'max:100'],
        ];
    }
}
