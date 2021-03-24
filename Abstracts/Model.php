<?php

namespace Abstracts;

use Modules\DB;

class Model extends DB
{
    public function __construct()
    {
        global $db;
        parent::__construct($db[$this->db ?? 0]);
        parent::table($this->table);
    }
}
