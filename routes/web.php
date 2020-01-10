<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route('home'));
    }
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'TicketController@index')->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@edit')->name('profile.edit');
        Route::put('/', 'ProfileController@update')->name('profile.update');
        Route::get('/password', 'ProfileController@password')->name('profile.password');
    });

    Route::group(['prefix' => 'ticket'], function () {
        Route::post('/create', 'TicketController@store')->name('tickets.store');
        Route::get('/create', 'TicketController@create')->name('tickets.create');
        Route::get('/show/{id}', 'TicketController@show')->name('tickets.show');
        Route::get('/close/{id}', 'TicketController@close')->name('tickets.close');
    });

    Route::post('comment', 'CommentController@postComment')->name('comment.post');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::get('/user/{id}/tickets', 'TicketController@index')->name('user.tickets.show');

    Route::get('/login/{user}', 'AdminController@loginAs')->name('user.login');
});

