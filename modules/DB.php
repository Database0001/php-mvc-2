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
            $this->data['where'][] = $val[0] . " " . $val[1] . " :where_" . $val[0];
            $this->params["where_" . $val[0]] = $val[2];
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

    public function create($data = [])
    {
        $this->sql = "INSERT INTO $this->table(" . implode(", ", array_keys($data)) . ") VALUES(:" . implode(", :", array_keys($data)) . ")";
        $ex = $this->ezPDO->exec($this->sql, $data);

        if ($ex)
            return $this->ezPDO->read("SELECT * FROM $this->table WHERE id = :id", ["id" => $this->ezPDO->lastID()]);


        return false;
    }

    public function update($data = [])
    {

        $update_sql = "";

        foreach ($data as $key => $val) {
            $update_sql .= "$key = :$key, ";
        }

        $update_sql = rtrim($update_sql, ', ');

        $where_ = $this->build();

        $data = array_merge($this->params, $data);

        $sql = "UPDATE $this->table SET $update_sql" . $where_;

        $ex = $this->ezPDO->exec($sql, $data);

        if ($ex)
            return $this->ezPDO->read("SELECT * FROM $this->table " . $where_, $this->params);

        return false;
    }

    public function get($fields = "*")
    {
        $this->sql = "SELECT $fields FROM $this->table $this->sql";
        return $this->ezPDO->read($this->build(), $this->params);
    }
}
