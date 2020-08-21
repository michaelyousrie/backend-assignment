<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/users', 'Api\UsersController@index');
    Route::get('/users/{user}', 'Api\UsersController@view');
});
