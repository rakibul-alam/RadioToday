<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePodcastRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'released' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'podcast_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'name_bn' => 'nullable|string',
            'published_date' => 'required|string',
            'tag' => 'nullable|string',
        ];
    }
}
