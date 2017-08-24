<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['auth']], function ()
{
	Route::controllers([
		'account'	=>	'AccountController',
		'webshop' 	=>	'WebshopController',
		//'donate'	=>	'DonateController',
		'vote'		=>	'VoteController'
	]);

	Route::group(['middleware' => ['auth.access:'.Settings::access()->dashboard], 'namespace' => 'Admin', 'prefix' => 'admin'], function ()
	{
		Route::resource('news-category', 	'NewsCategoryController', 		['except' 	=> ['show']]);
		Route::resource('news', 			'NewsController',		 		['except' 	=> ['show']]);
		Route::resource('accounts', 		'AccountController', 			['only' 	=> ['index', 'edit', 'update']]);
		Route::resource('webshop-category',	'WebshopCategoryController', 	['except' 	=> ['show']]);
		Route::resource('webshop',			'WebshopController', 			['except' 	=> ['show']]);
		Route::resource('vote',				'VoteController', 				['except' 	=> ['show']]);
		Route::resource('pages',			'PageController',				['except' 	=> ['show']]);

		Route::controllers([
			'ban'			=>	'BanController',
			'tools'			=>	'ToolsController',
			'membership'	=>	'MembershipController',
			'logs'			=> 	'LogController',
			'settings'		=>	'SettingsController',
			'/'				=>	'DashboardController'
		]);
	});
});

Route::controllers([
	'ranking' => 'RankingController'
]);

Route::get('pingback', 			'HomeController@pingback');
Route::get('postback', 			'HomeController@postback');
Route::get('page/{slug}',		'PageController@getPage');
Route::get('news',				'NewsController@getIndex');
Route::get('news/{id}-{slug}',	'NewsController@getNews')->where('id', '[0-9]+');
Route::get('player/{id}', 		'HomeController@player')->where('id', '[0-9]+');
Route::get('legion/{id}', 		'HomeController@legion')->where('id', '[0-9]+');
//Route::get('online-players', 	'HomeController@onlinePlayers');
Route::get('download',			'HomeController@download');
//Route::get('faq',				'HomeController@faq');
//Route::get('info',				'HomeController@info');
// Route::get('guide',				'HomeController@guide');
Route::get('staff',				'HomeController@staff');
Route::get('donate_list',		'DonateListController@index');

Route::get('/', 'HomeController@index');

Route::controllers([
	'/'	=>	'Auth\AuthController'
]);