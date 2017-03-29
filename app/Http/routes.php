<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});
Route::group([
    'middleware' => 'Cors'
        ], function() {

    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'auth.checkrole:admin'
            ], function() {
        Route::resource('categories', 'CategoriesController');
        Route::resource('products', 'ProductsController');
        Route::resource('users', 'UsersController');
        Route::resource('clients', 'ClientsController');
        Route::resource('orders', 'OrdersController');
        Route::resource('cupoms', 'CupomsController');
    });
    Route::group([
        'prefix' => 'custumer',
        'middleware' => 'auth.checkrole:client'
            ], function() {
        Route::resource('order', 'CheckoutsController', ['except' => 'edit', 'update', 'destroy']);
    });
    Route::post('oauth/access_token', function() {
        
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function() {
        Route::get('authenticated ', 'Auth\Authenticated@userAuthenticated');
        Route::group([
            'prefix' => 'client',
            'middleware' => 'oauth.checkrole:client',
            'as' => 'client.'
                ], function() {

            Route::resource('orders', 'Api\Client\ClientCheckoutController', ['except' => ['create', 'edit', 'update', 'destroy']]);
        });

        Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman', 'as' => 'deliveryman.'], function() {
            Route::resource('orders', 'Api\Deliveryman\DeiverymanCheckoutController', ['except' => ['store', 'create', 'edit', 'update', 'destroy']]);
            Route::patch('order/{id}/update-status', ['uses' => 'Api\Deliveryman\DeiverymanCheckoutController@updateStatus', 'as' => 'order.update_status']);
        });
        
        Route::get('user', "Api\HomeController@index");
    });
});

