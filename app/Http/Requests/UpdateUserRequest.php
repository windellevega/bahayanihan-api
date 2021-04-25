<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'password'      => 'required',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'address'       => 'required',
            'current_lat'   => 'numeric|required',
            'current_long'  => 'numeric|required',
            'is_worker'     => 'required|boolean',
            'mobile_number' => 'numeric|regex:/(09)[0-9]{9}/',
        ];
    }
}
