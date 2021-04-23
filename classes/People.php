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
}
