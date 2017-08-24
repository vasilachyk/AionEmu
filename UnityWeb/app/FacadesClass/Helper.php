<?php

namespace App\FacadesClass;

use Settings;
use Carbon;

class Helper
{
	public function webshop_discount($itemPrice, $membership, $membershipExpiry)
	{
		if ($membership == 1 && $membershipExpiry > Carbon::now()->toDateString())
		{
			$discountNum = Settings::general()->webshop_discount_premium;
			$discount = ($itemPrice / 100) * $discountNum;
			$newPrice = $itemPrice - $discount;
		}
		elseif ($membership == 2 && $membershipExpiry > Carbon::now()->toDateString())
		{
			$discountNum = Settings::general()->webshop_discount_vip;
			$discount = ($itemPrice / 100) * $discountNum;
			$newPrice = $itemPrice - $discount;
		}
		else
		{
			$discountNum = Settings::general()->webshop_discount_normal;
			$discount = ($itemPrice / 100) * $discountNum;
			$newPrice = $itemPrice - $discount;
		}

		if (empty($discountNum) || $discountNum == 0)
		{
			$disc = 0;
		}
		else
		{
			$disc = $discountNum;
		}

		if (Settings::general()->donate_type == 'CREDITS')
		{
			return $newPrice . ' ' . Settings::general()->credit_name . ' ('.$disc.'% Discount)';
		}
		else
		{
			return $newPrice . ' Toll(s) ('.$disc.'% Discount)';
		}
		
	}
}