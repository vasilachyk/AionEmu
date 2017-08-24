<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class RoutesAccess extends Request
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
            'dashboard'             =>  ['required', 'numeric', 'between:1,10'],
            'news'                  =>  ['required', 'numeric', 'between:1,10'],
            'news_category'         =>  ['required', 'numeric', 'between:1,10'],
            'accounts'              =>  ['required', 'numeric', 'between:1,10'],
            'webshop_category'      =>  ['required', 'numeric', 'between:1,10'],
            'webshop'               =>  ['required', 'numeric', 'between:1,10'],
            'vote'                  =>  ['required', 'numeric', 'between:1,10'],
            'pages'                 =>  ['required', 'numeric', 'between:1,10'],
            'ban'                   =>  ['required', 'numeric', 'between:1,10'],
            'tools'                 =>  ['required', 'numeric', 'between:1,10'],
            'membership'            =>  ['required', 'numeric', 'between:1,10'],
            'logs'                  =>  ['required', 'numeric', 'between:1,10'],
            'settings'              =>  ['required', 'numeric', 'between:1,10']
        ];
    }
}
