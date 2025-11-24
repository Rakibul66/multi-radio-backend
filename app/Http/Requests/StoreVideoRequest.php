<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'video_url' => 'required|url',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'is_top' => 'required|in:Yes,No',
            'status' => 'required|in:Active,Inactive',
        ];
    }
}
