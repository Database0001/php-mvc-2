<?php

use Modules\Route;

if (Route::$called == 0) {
    $code = 404;
}

if (isset($code)) {
    abort($code);
}
