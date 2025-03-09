<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class storeProductRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'type' => 'required|in:0,1',
            'page_count' => 'nullable|numeric|max_digits:4',
            'release_year' => 'required|numeric|digits:4',
            'product_category_id' => 'required|exists:product_categories,id',
            'writer_id' => 'required|exists:writers,id',
            'publisher_id' => 'required|exists:publishers,id',
            'tags' => 'required|array',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discount_expires_at' => 'required_if:discount_percentage,between:0,100|nullable|numeric',
            'marketable' => 'required|in:0,1',
            'description' => 'required|string'
        ];
    }
}
