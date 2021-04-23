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
        db::fetchAll("SELECT * FROM people WHERE user_id = ?", $id);
    }
}
