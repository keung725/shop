<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Authentication Routes...
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');

    // Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');


    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    Route::get('logout', 'Auth\AuthController@logout');




    Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:siteowner|admin']), function () {
        Route::get('/', function()
        {
            return view('admin.index');
        });
        Route::get('roles', 'RolesController@index');
        Route::get('roles/create', 'RolesController@create');
        Route::post('roles/create', 'RolesController@store');
        Route::get('roles/{id?}/edit', 'RolesController@edit');
        Route::post('roles/{id?}/edit','RolesController@update');
        Route::get('users', 'UsersController@index');
        Route::get('users/{id?}/edit', 'UsersController@edit');
        Route::post('users/{id?}/edit','UsersController@update');
        Route::get('homebanner', 'HomeBannerController@listView');
        Route::get('homebanner/recover', 'HomeBannerController@recoverView');
        Route::get('homebanner/create', 'HomeBannerController@create');
        Route::post('homebanner/store', 'HomeBannerController@store');

    });

    Route::group(array( 'middleware' => ['role:siteowner|admin']), function () {
        Route::get('api/homebanners', 'Admin\HomeBannerController@index');
        Route::put('api/homebanner/{id?}', 'Admin\HomeBannerController@update');
        Route::get('api/homebanners/recovers', 'Admin\HomeBannerController@recoverIndex');
        Route::put('api/homebanner/recover/{id?}', 'Admin\HomeBannerController@recoverUpdate');

    });
});
