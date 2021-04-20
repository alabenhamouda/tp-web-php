<?php

class db
{
    private static $host = "localhost";
    private static $dbName = "tpPhp";
    private static $username = "alabh";
    private static $db;
    private static function init()
    {
        try {
            self::$db = new PDO("mysql:host=${self::$host};dbname=${self::$dbName}", self::$username, getenv("password"));
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public static function getDB()
    {
        if (!self::$db)
            self::init();
        return self::$db;
    }
}
