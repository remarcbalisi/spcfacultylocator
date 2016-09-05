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

    Route::get('/', 'IndexController@index');
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
    Route::get('user/faculty/create', 'AdminHomeController@create_faculty')->name('faculty.create');
    Route::post('user/faculty/store', 'AdminHomeController@store_faculty')->name('faculty.store');
    Route::get('user/faculty/edit/{id}', 'AdminHomeController@edit_faculty')->name('faculty.edit');
    Route::put('user/faculty/update/{id}', 'AdminHomeController@update_faculty')->name('faculty.update');
    Route::get('requests/pending', 'AdminHomeController@show_all_pending_request')->name('pending_requests.show');
    Route::post('requests/pending/store/{id}', 'AdminHomeController@accept_or_delete_request')->name('pending_requests.store');
    Route::resource('user', 'AdminHomeController', [
        'names' => [
            'create' => 'user.create',
            'store' => 'user.store',
            'destroy' => 'user.destroy',
            'edit' => 'user.edit',
            'update' => 'user.update'
        ],
    ]);

});
