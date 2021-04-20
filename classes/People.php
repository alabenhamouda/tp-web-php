<?php
include_once('autoload.php');

class People extends Table
{
    public function __construct()
    {
        parent::__construct("people");
    }
}
