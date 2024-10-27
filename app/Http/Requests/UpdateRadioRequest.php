<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRadioRequest extends FormRequest
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
            'radio_name' => 'required|string|max:50|unique:radios,radio_name,' . $this->radio->id, 

            'radio_url' => 'required|url|unique:radios,radio_url,' . $this->radio->id,

            'category_id' => 'required|integer',
            'country_id' => 'required|integer',
            'status' => 'required|in:Active,Inactive',
        ];
    }
}
