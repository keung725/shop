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

    Route::get('/', 'PageController@home');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::get('password/email', 'Auth\PasswordController@showLinkRequestForm');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    Route::get('logout', 'Auth\AuthController@logout');



    Route::post('register', 'UsersController@register');
    Route::post('login', 'UsersController@login');
    Route::get('profile', 'UsersController@profile');
    Route::post('profile', 'UsersController@postProfile');

    Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
    Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');




    Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:siteowner|admin']), function () {
        Route::get('/', function()
        {
            return view('admin.index');
        });
        Route::get('roles', 'RolesController@index');
        Route::get('roles/create', 'RolesController@create');
        Route::post('roles/store', 'RolesController@store');
        Route::get('roles/{id?}', 'RolesController@edit');
        Route::post('roles/{id?}','RolesController@update');

        Route::get('users', 'UsersController@index');
        Route::get('users/{id?}', 'UsersController@edit');
        Route::post('users/{id?}','UsersController@update');

        Route::get('homebanners', 'HomeBannerController@index');
        Route::get('homebanners/available', 'HomeBannerController@availableIndex');
        Route::get('homebanners/recover', 'HomeBannerController@recoverView');
        Route::get('homebanners/recovers', 'HomeBannerController@recoverIndex');
        Route::get('homebanners/create', 'HomeBannerController@create');
        Route::post('homebanners/store', 'HomeBannerController@store');
        Route::get('homebanners/{id?}', 'HomeBannerController@edit');
        Route::post('homebanners/{id?}', 'HomeBannerController@update');

        Route::get('category', 'CategoryController@index');
        Route::get('category/available', 'CategoryController@availableIndex');
        Route::get('category/recover', 'CategoryController@recoverView');
        Route::get('category/recovers', 'CategoryController@recoverIndex');
        Route::get('category/create', 'CategoryController@create');
        Route::post('category/store', 'CategoryController@store');
        Route::get('category/{id?}', 'CategoryController@edit');
        Route::post('category/{id?}', 'CategoryController@update');

        Route::get('brands', 'BrandController@index');
        Route::get('brands/available', 'BrandController@availableIndex');
        Route::get('brands/recover', 'BrandController@recoverView');
        Route::get('brands/recovers', 'BrandController@recoverIndex');
        Route::get('brands/create', 'BrandController@create');
        Route::post('brands/store', 'BrandController@store');
        Route::get('brands/{id?}', 'BrandController@edit');
        Route::post('brands/{id?}', 'BrandController@update');

    });

});
