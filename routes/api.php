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
    Route::get('comments', 'CommentController@index');
    Route::get('comments/{comment}', 'CommentController@show');
    Route::post('comments', 'CommentController@store');
    Route::put('comments/{comment}', 'CommentController@update');
    Route::patch('comments/{comment}', 'CommentController@update');
    Route::delete('comments/{comment}', 'CommentController@destroy');
});
