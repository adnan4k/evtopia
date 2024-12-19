<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // Default rules for thumbnails (You can modify these as per your need)
        $thumbnail = $this->post?->media ? 'nullable' : 'required';

        if ($this->is('api/*')) {
            $thumbnail = 'nullable';
        }

        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'post_category' => 'required|array',
            'post_category.*' => 'exists:post_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:post_tags,id',
            'thumbnail' => "$thumbnail|image",
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => __('The title field is required.'),
            'description.required' => __('The description field is required.'),
            'short_description.required' => __('The short description field is required.'),
            'category.required' => __('The category field is required.'),
            'category.array' => __('The category field must be an array.'),
            'category.*.exists' => __('The selected category is invalid.'),
            'tags.exists' => __('Some of the selected tags are invalid.'),
            'tags.array' => __('The tags field must be an array.'),
            'thumbnail.required' => __('The thumbnail field is required.'),
            'thumbnail.image' => __('The thumbnail must be an image.'),
            'thumbnail.mimes' => __('The thumbnail must be a file of type: png, jpg, jpeg, webp.'),
            'thumbnail.max' => __('The thumbnail may not be greater than 2048 kilobytes.'),
            'is_active.boolean' => __('The is active field must be a boolean value.'),
        ];
    }
}
