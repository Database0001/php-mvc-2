<?php

use Src\Controllers\TestController;
use Modules\Route;
// "/" url everytime must set endest. 

Route::get('/test', [TestController::class, 'index']);

Route::get('/', function () {
    echo "Welcome";
});
