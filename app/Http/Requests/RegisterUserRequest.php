<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'      => 'required|unique:users,username',
            'password'      => 'required',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'address'       => 'required',
            'current_lat'   => 'numeric|required',
            'current_long'  => 'numeric|required',
            'mobile_number' => 'numeric|regex:/(09)[0-9]{9}/',
            'email_address' => 'email|unique:users,email_address',
        ];
    }
}
