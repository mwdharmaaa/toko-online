<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_name' => ['required', 'string', 'max:150'],
            'store_tagline' => ['nullable', 'string', 'max:255'],
            'welcome_title' => ['required', 'string', 'max:255'],
            'welcome_subtitle' => ['nullable', 'string', 'max:1000'],
            'whatsapp_number' => ['required', 'string', 'max:30'],
            'whatsapp_message_template' => ['required', 'string'],
            'store_address' => ['nullable', 'string', 'max:255'],
            'store_email' => ['nullable', 'email', 'max:150'],
            'instagram_handle' => ['nullable', 'string', 'max:100'],
        ];
    }
}
