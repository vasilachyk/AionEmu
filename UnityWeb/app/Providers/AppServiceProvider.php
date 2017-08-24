<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\AuthRepositoryInterface', 'App\Repositories\AuthRepository');

        $this->app->bind('App\Repositories\AccountRepositoryInterface', 'App\Repositories\AccountRepository');

        $this->app->bind('App\Repositories\PlayerRepositoryInterface', 'App\Repositories\PlayerRepository');

        $this->app->bind('App\Repositories\LegionRepositoryInterface', 'App\Repositories\LegionRepository');

        $this->app->bind('App\Repositories\RankingRepositoryInterface', 'App\Repositories\RankingRepository');

        $this->app->bind('App\Repositories\AdminRepositoryInterface', 'App\Repositories\AdminRepository');

        $this->app->bind('App\Repositories\WebshopCategoryRepositoryInterface', 'App\Repositories\WebshopCategoryRepository');

        $this->app->bind('App\Repositories\WebshopRepositoryInterface', 'App\Repositories\WebshopRepository');

        $this->app->bind('App\Repositories\InventoryRepositoryInterface', 'App\Repositories\InventoryRepository');

        $this->app->bind('App\Repositories\MailRepositoryInterface', 'App\Repositories\MailRepository');

        $this->app->bind('App\Repositories\LogRepositoryInterface', 'App\Repositories\LogRepository');

        $this->app->bind('App\Repositories\PaymentRepositoryInterface', 'App\Repositories\PaymentRepository');

        $this->app->bind('App\Repositories\VoteRepositoryInterface', 'App\Repositories\VoteRepository');

        $this->app->bind('App\Repositories\NewsCategoryRepositoryInterface', 'App\Repositories\NewsCategoryRepository');

        $this->app->bind('App\Repositories\NewsRepositoryInterface', 'App\Repositories\NewsRepository');

        $this->app->bind('App\Repositories\PageRepositoryInterface', 'App\Repositories\PageRepository');

        $this->app->bind('App\Repositories\BanRepositoryInterface', 'App\Repositories\BanRepository');

        $this->app->bind('App\Repositories\SettingsRepositoryInterface', 'App\Repositories\SettingsRepository');

        $this->app->bind('App\Repositories\MembershipRepositoryInterface', 'App\Repositories\MembershipRepository');

        $this->app->bind('App\Repositories\ToolsRepositoryInterface', 'App\Repositories\ToolsRepository');

        $this->app->bind('App\Repositories\StatusRepositoryInterface', 'App\Repositories\StatusRepository');

        $this->app->bind('App\Repositories\PaymentRepositoryInterface', 'App\Repositories\PaymentRepository');
    }
}
