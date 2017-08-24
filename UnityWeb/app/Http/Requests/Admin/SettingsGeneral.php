<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SettingsGeneral extends Request
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
            'server_name'               =>  ['required'],
            'pass_reset_expire'         =>  ['required', 'numeric'],
            'rates_exp'                 =>  ['required', 'numeric'],
            'rates_kinah'               =>  ['required', 'numeric'],
            'rates_drop'                =>  ['required', 'numeric'],
            'rates_quest'               =>  ['required', 'numeric'],
            'port_game'                 =>  ['required', 'numeric'],
            'port_login'                =>  ['required', 'numeric'],
            'port_timeout'              =>  ['required', 'numeric'],
            'webshop_discount_normal'   =>  ['required', 'numeric'],
            'webshop_discount_premium'  =>  ['required', 'numeric'],
            'webshop_discount_vip'      =>  ['required', 'numeric'],
            'news_count'                =>  ['required', 'numeric'],
            'rank_player'               =>  ['required', 'numeric', 'min:10'],
            'rank_abyss'                =>  ['required', 'numeric', 'min:10'],
            'rank_exp'                  =>  ['required', 'numeric', 'min:10'],
            'rank_legions'              =>  ['required', 'numeric', 'min:10'],
            'rank_gp'                   =>  ['required', 'numeric', 'min:10'],
            'rank_kinah'                =>  ['required', 'numeric', 'min:10'],
            'rank_ap'                   =>  ['required', 'numeric', 'min:10'],
            'donate_type'               =>  ['required', 'in:CREDITS,TOLL'],
            'vote_type'                 =>  ['required', 'in:CREDITS,TOLL'],
            'vote_ip_blocking'          =>  ['required', 'numeric', 'in:0,1'],
            'unlock_unstuck'            =>  ['required', 'numeric'],
            'allow_banned_ip'           =>  ['required', 'numeric', 'in:0,1'],
        ];
    }
}
