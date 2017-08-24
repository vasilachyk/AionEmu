<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Postback extends Request
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
            'id'        =>  ['required', 'numeric'],
            'uid'       =>  ['required', 'numeric'],
            'oid'       =>  ['required', 'numeric'],
            'new'       =>  ['required', 'numeric'],
            'total'     =>  ['required', 'numeric'],
            'sig'       =>  ['required']
        ];
    }
}
