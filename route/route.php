<?php

use Modules\Auth;
use Src\Controllers\TestController;
use Modules\Route;
use Src\Controllers\AuthController;
use Src\Controllers\ResourceController;
use Src\Middleware\auth as MiddlewareAuth;
use Src\Middleware\guest;

// "/" url everytime must set endest. 

middleware(guest::class, function () {

    Route::get('/auth/signin', function () {
        return view("pages.auth.signin");
    });

    Route::post('/auth/signin', [AuthController::class, 'signin']);

    Route::get('/auth/signup', function () {
        return view("pages.auth.signup");
    });

    Route::post('/auth/signup', [AuthController::class, 'signup']);
});

middleware(MiddlewareAuth::class, function () {
    Route::get('/auth/logout', function () {
        Auth::logout();
        redirect(host('/'));
    });
});

Route::resource('/resource', ResourceController::class);

Route::get('/', function () {

    $username = @Auth::user()['username'];

    echo "Welcome " . (($username ? $username . " <a href='/auth/logout'>Logout</a>" : null) ?? "Guest") . ".";
});
