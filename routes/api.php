<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    Route::delete('logs', function () {
        exec(': > ../storage/logs/laravel.log');
    });
    Route::get('logs', function () {
        return file_get_contents('../storage/logs/laravel.log');
    });

    Route::get('comments', 'CommentController@index');
});
