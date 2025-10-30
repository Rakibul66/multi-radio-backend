<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMusicRequest extends FormRequest
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
            'title' => 'required|string|max:50|unique:music,title',
            'description' => 'nullable',
            'file' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',            
            'status' => 'required|in:Active,Inactive',
        ];
    }
}
