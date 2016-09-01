<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// DEFINE CONSTANT
define( "SITE_ABRE" , "SPCFL");
define( "SITE_NAME" , "SPC-Faculty Locator");


Route::group(['middleware'=>['guest']], function(){

    Route::resource('index', 'IndexController');
    //simple login
    Route::post('/login', [
        'uses' => '\App\Http\Controllers\Auth\LoginController@authenticate',
    	'as' => 'auth.login'
    ]);

});


Route::get('/logout', [
    'uses' => '\App\Http\Controllers\Auth\LoginController@logout',
    'as' => 'auth.logout'
]);


Route::group(['prefix'=>'/admin/home/{username}', 'as'=>'admin::', 'middleware'=>['auth', 'auth_admin']], function(){

    Route::get('/', 'AdminHomeController@index');
    Route::resource('user', 'AdminHomeController');

});
