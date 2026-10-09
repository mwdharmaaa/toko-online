<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'author_name' => ['nullable', 'string', 'max:100'],
            'reading_time_minutes' => ['nullable', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'cover_image_url' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}
