<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StorePodcastDetailsRequest extends FormRequest
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
            'file_path' => [
                'required',
                File::types(['mp3', 'wav'])
                    ->min(1024)
                    ->max(12 * 1024),
            ],
            'duration_time' => 'required|numeric',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'release_date' => 'nullable|string',
            'podcast_id' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
