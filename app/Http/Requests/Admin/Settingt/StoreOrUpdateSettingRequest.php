<?php

namespace App\Http\Requests\Admin\Settingt;

use App\Models\Setting\Setting;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateSettingRequest extends FormRequest
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
        $setting=Setting::first();
        if($setting){
            return [
                'title' => 'max:120|min:2|regex:/^[ا-ی0-9\-۰-۹ء-ي.,a-zA-Z0-9 ]+$/u',
                'description' => 'max:500|min:2|regex:/^[ا-ی0-9\-۰-۹ء-ي.,a-zA-Z0-9 ]+$/u',
                'keywords' => 'max:250|min:2|regex:/^[ا-ی0-9\-۰-۹ء-ي.,a-zA-Z0-9 ]+$/u',
                'logo' => 'image|mimes:png,jpg,jpeg,gif',
                'icon' => 'image|mimes:png,jpg,jpeg,gif',
            ];

        }
        else{
            return [
                'title' => 'required|max:120|min:2|regex:/^[ا-ی0-9\-۰-۹ء-ي.,a-zA-Z0-9 ]+$/u',
                'description' => 'required|max:500|min:2|regex:/^[ا-ی0-9\-۰-۹ء-ي.,a-zA-Z0-9 ]+$/u',
                'keywords' => 'required|max:250|min:2|regex:/^[ا-ی0-9\-۰-۹ء-ي.,a-zA-Z0-9 ]+$/u',
                'logo' => 'required|image|mimes:png,jpg,jpeg,gif',
                'icon' => 'required|image|mimes:png,jpg,jpeg,gif',
            ];

        }
     
    }
}
