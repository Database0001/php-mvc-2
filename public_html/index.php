<?php
set_time_limit(0);

define('START', microtime(true));

$dirs = [
    '../modules/*.php'
];

foreach ($dirs as $dir) {
    $files = glob($dir);
    foreach ($files as $file) {
        include($file);
    }
}

include(base_path('/route.php'));
include(base_path('/control-modules/error_handling.php'));

define('FINISH', microtime(true));

// echo "<br><br>Bitiş süresi: " . (FINISH - START);
