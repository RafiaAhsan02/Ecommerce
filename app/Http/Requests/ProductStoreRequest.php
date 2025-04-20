<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:products,slug,except,id',
            'short_description' => 'required|string',
            'description' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'price' => 'required|decimal:0,2',
            'discount' => 'nullable|numeric',
            'quantity' => 'required',
            'images.*' => 'required|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }
}
