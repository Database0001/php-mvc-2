<?php

use Src\Controllers\TestController;
use Modules\Route;
use Src\Controllers\AuthController;
use Src\Controllers\ResourceController;

// "/" url everytime must set endest. 


Route::get('/auth/signin', function () {
    return view("pages.auth.signin");
});

Route::post('/auth/signin', [AuthController::class, 'signin']);


Route::resource('/resource', ResourceController::class);

Route::get('/', function () {
    echo "Welcome";
});
