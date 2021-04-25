<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'worker_id'         => 'required',
            'skill_id'          => 'required',
            'job_description'   => 'required',
            'transaction_long'  => 'numeric|required',
            'transaction_lat'   => 'numeric|required',
            'total_cost'        => 'numeric|required',
        ];
    }
}
