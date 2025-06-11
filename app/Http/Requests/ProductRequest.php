<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "title" => ["required", "string", "max:255"],
            "price" => ["required", "numeric", "min:0", "max:9999999.99"],
            "brand" => ["required", "string", "max:255"],
            "delivery" => ["required", "date_format:Y-m-d"],
            "category" => ["required", "string", "max:255"],
            "warranty" => ["required", "string", "max:255"],
            "material" => ["required","string","max:255"],
            "power_supply" => ["required", "string", "max:255"],
            "product_image" => ["nullable", "image", "mimes:jpg,jpeg,png,webp"]
        ];
    }
}
