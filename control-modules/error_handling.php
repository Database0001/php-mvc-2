<?php

use Modules\Route;

if (Route::$called == 0) {
    abort(404);
}
