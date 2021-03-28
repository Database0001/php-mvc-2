<?php

namespace Modules;

class DB
{
    public $db;

    public $table;
    public $sql;

    public $data;

    public $params;

    public function __construct($db)
    {
        $this->db = $db;
        $this->ezPDO = new ezPDO($db);
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function where($where)
    {
        foreach ($where as $key => $val) {
            $this->data['where'][] = $val[0] . " " . $val[1] . " :" . $val[0];
            $this->params[":" . $val[0]] = $val[2];
        }

        return $this;
    }

    public function build()
    {

        foreach ($this->data ?? [] as $key => $val) {
            if ($key == "where") {
                $val = "WHERE " . implode(' AND ', $val);
            }
            $this->sql .= " " . $val;
        }

        return $this->sql;
    }

    public function limit($limit = 10, $stop = null)
    {
        @$this->data['limit'] .= "LIMIT $limit" . ($stop ? ",$stop" : null);
        return $this;
    }

    public function get($fields = "*")
    {
        $this->sql = "SELECT $fields FROM $this->table $this->sql";

        return $this->ezPDO->read($this->build(), $this->params);
    }
}
