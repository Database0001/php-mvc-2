<?php

use Modules\ezPDO;

$db = [];
try {
    $db[] = ezPDO::connect('test-mvc');
} catch (Exception $e) {
    abort(500, ['message' => "Veritabanı bağlantısı başarısız."]);
}
