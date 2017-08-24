<?php

namespace App\FacadesClass;

use App\Repositories\SettingsRepositoryInterface;

class SiteSettings
{
	protected $settings;

	public function __construct(SettingsRepositoryInterface $settings)
	{
		$this->settings = $settings;
	}

	public function general()
	{
		return $this->settings->getGeneral();
	}

	public function payment()
	{
		return $this->settings->getPayment();
	}

	public function access()
	{
		return $this->settings->getRoutesAccess();
	}
}