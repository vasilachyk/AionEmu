<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composers([
            'App\Http\ViewComposers\WebshopCategoryComposer'    =>  ['includes.crumbs-webshop', 'admin.webshop.create', 'admin.webshop.edit'],
            'App\Http\ViewComposers\LogCountComposer'           =>  ['includes.crumbs-logs'],
            'App\Http\ViewComposers\NewsCategoryComposer'       =>  ['admin.news.create', 'admin.news.edit'],
            'App\Http\ViewComposers\NewsComposer'               =>  ['pages.main.index'],
            'App\Http\ViewComposers\PageComposer'               =>  ['navigation.main'],
            'App\Http\ViewComposers\AdminMembershipComposer'    =>  ['admin.includes.memberships']
        ]);
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}