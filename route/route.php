<?php

use Src\Controllers\TestController;
use Modules\Route;
use Src\Controllers\AuthController;
use Src\Controllers\ResourceController;
use Src\Middleware\guest;

// "/" url everytime must set endest. 

middleware(guest::class, function () {
    Route::get('/auth/signin', function () {
        return view("pages.auth.signin");
    });

    Route::post('/auth/signin', [AuthController::class, 'signin']);
});

Route::resource('/resource', ResourceController::class);

Route::get('/', function () {
    echo "Welcome";
});
