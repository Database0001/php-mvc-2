<?php

use Modules\ezPDO;

$db = [];

$db[] = ezPDO::connect('test-mvc');