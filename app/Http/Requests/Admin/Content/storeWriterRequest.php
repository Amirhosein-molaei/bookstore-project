<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class storeWriterRequest extends FormRequest
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
            'name' => 'required|min:2|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'nationality' => 'required|min:2|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'age' => 'required|numeric|digits_between:2,3',
            'description' => 'required|min:5|max:2000',
            'role' => 'in:0,1,2'
        ];
    }
}
