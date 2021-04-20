<?php

include_once('autoload.php');

class Table
{
    private $name;
    public function __construct($dbName)
    {
        $this->name = $dbName;
    }
    public function findAll()
    {
        return db::fetchAll("SELECT * FROM $this->name");
    }
    public function findById($id)
    {
        return db::fetch("SELECT * FROM $this->name WHERE id = $id");
    }
    public function insert($data)
    {
        $cols = join(", ", array_keys($data));
        $values = array_values($data);
        $paren = array_fill(0, count($values), "?");
        $paren = join(", ", $paren);
        db::exec("INSERT INTO " . $this->name . " (" . $cols . ") VALUES (" . $paren . ");", ...$values);
    }
}
