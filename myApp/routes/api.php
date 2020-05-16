<?php

use Illuminate\Http\Request;

Route::post('login', 'APIController@login');
Route::post('register', 'APIController@register');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'APIController@logout');

    Route::get('Transactions', 'TransactionsController@index');
    Route::get('Transactions/{id}', 'TransactionsController@show');
    Route::post('Transactions', 'TransactionsController@store');
    Route::put('Transactions/{id}', 'TransactionsController@update');
    Route::delete('Transactions/{id}', 'TransactionsController@destroy');
});