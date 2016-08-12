<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */


Route::get('/', function() {
    return View::make('login');
});

Route::group(array('prefix' => 'api'), function() {



    Route::post('login', array('uses' => 'Users\UsersController@doLogin'));

    //Route::post('login', array('uses' => 'Users\UsersController@showDocument'));
    
    Route::post('islogin', array('uses' => 'Users\UsersController@isLogged'));

    Route::post('logout', array('uses' => 'Users\UsersController@doLogout'));
});
