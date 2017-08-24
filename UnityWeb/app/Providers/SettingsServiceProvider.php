<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Settings', 'App\FacadesClass\SiteSettings');

        $this->app->bind('Helper',  'App\FacadesClass\Helper');

        $this->app->bind('Status',  'App\FacadesClass\Status');
    }
}
