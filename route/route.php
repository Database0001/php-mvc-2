<?php

use Src\Controllers\TestController;
use Modules\Route;
use Src\Controllers\ResourceController;

// "/" url everytime must set endest. 

Route::get('/test', [TestController::class, 'index']);

Route::resource('/resource', ResourceController::class);

Route::get('/', function () {
    echo "Welcome";
});
