<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class storeProductFileRequest extends FormRequest
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
        // dd($this->file('file')->getMimeType());
        return [
            'file' => 'required|file|mimes:pdf,zip,rar,audio/mpeg,mpga,mp3,wav,mp4'
        ];
    }
}
