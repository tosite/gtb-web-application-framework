<?php

Route::middleware('api')->group(function () {
    Route::delete('logs', function () {
        exec(': > ../storage/logs/laravel.log');
    });

    Route::get('logs', function () {
        $logPath = '../storage/logs/laravel.log';
        return (file_exists($logPath)) ? file_get_contents($logPath) : null;
    });

    Route::get('routes', function () {
        exec('cd ..; php artisan route:list', $res);
        return implode(PHP_EOL, $res);
    });

    // Edit the botttom from here!
    Route::resource('comments', 'CommentController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
});
