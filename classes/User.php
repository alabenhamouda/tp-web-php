<?php
include_once('autoload.php');

class user extends Table
{
    public function __construct()
    {
        parent::__construct("users");
    }
    public function findByEmail($email)
    {
        return db::fetch("SELECT * FROM users WHERE email = ?", $email);
    }
}
