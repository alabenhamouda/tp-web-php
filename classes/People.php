<?php
include_once('autoload.php');

class People extends Table
{
    public function __construct()
    {
        parent::__construct("people");
    }
    public function findByUserId($id)
    {
        return db::fetchAll("SELECT * FROM people WHERE user_id = ?;", $id);
    }
    public function deleteById($id) {
       db::fetchd("DELETE FROM people WHERE id=?",$id);
    }
    public function findPeoplebyCin($cin)
    {
        return db::fetch("SELECT * FROM people WHERE cin = ?",$cin);
    }
    public function findPeoplebyCin2($cin,$id)
    {
        return db::fetch("SELECT * FROM people WHERE cin = ? AND id !=?",$cin,$id);
    }

    public function update($data)
    {
        db::exec("UPDATE people SET name=?, photo=?, cin=? where id=?",...array_values($data));
    }
}
