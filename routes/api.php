<?php

Route::middleware('api')->group(function () {
    Route::delete('logs', function () {
        exec(': > ../storage/logs/laravel.log');
    });

    Route::get('logs', function () {
        try {
            $res = file_get_contents('../storage/logs/laravel.log');
        } catch (\Exception $e) {
            $res = null;
        }
        return $res;
    });

    Route::get('routes', function () {
        exec('cd ..; php artisan route:list', $res);
        return implode(PHP_EOL, $res);
    });

    // Edit the botttom from here!
    Route::get('comments', 'CommentController@index');
});
