<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'number_id' => 'required|unique:users,number_id,' . auth()->user()->id ,
            'telephone' => 'required',
            'birthplace' => 'required',
            'date_of_birth' => 'required',
            'city' => 'required',
            'province' => 'required',
            'class_major' => 'required',
            'class_year' => 'required',
            'institution' => 'required',
            'instagram_username' => 'required',
        ];
    }
}
