<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ToolsSendRequest extends Request
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
            'player'        =>  ['required'],
            'item_id'       =>  ['required', 'numeric'],
            'quantity'      =>  ['required', 'numeric'],
            'enchant'       =>  ['required', 'numeric'],
            'temperance'    =>  ['required', 'numeric'],
            'amplify'       =>  ['required', 'numeric', 'between:0,20'],
            'stackable'     =>  ['required', 'numeric', 'in:0,1']
        ];
    }
}
