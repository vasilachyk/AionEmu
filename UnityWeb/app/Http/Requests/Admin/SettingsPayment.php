<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SettingsPayment extends Request
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
            'paypal_status'             =>  ['numeric', 'in:0,1'],
            'paypal_test_mode'          =>  ['numeric', 'in:0,1'],
            'paypal_api_username'       =>  [],
            'paypal_api_password'       =>  [],
            'paypal_api_signature'      =>  [],
            'paypal_donate_points'      =>  ['required', 'numeric'],
            'paypal_donate_toll'        =>  ['required', 'numeric'],
            'donate_rates'              =>  ['required', 'numeric'],
            'paymentwall_status'        =>  ['numeric', 'in:0,1'],
            'paymentwall_public_key'    =>  [],
            'paymentwall_private_key'   =>  [],
            'super_rewards_status'      =>  ['numeric', 'in:0,1'],
            'super_rewards_public_key'  =>  [],
            'super_rewards_private_key' =>  [],
        ];
    }
}
