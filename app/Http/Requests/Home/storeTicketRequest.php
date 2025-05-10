<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class storeTicketRequest extends FormRequest
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
            'subject' => 'required|string|min:3|max:100',
            'body' => 'required|string|max:4000',
            'category_id' => 'required|exists:ticket_categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif'
        ];
    }
}
