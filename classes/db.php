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
            self::$db = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$username, getenv("password"));
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            // echo "<pre>" . print_r($e, true) . "</pre>";
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getDB()
    {
        if (!self::$db)
            self::init();
        return self::$db;
    }

    public static function exec($request, ...$params)
    {
        if (!self::$db)
            self::init();
        $response = self::$db->prepare($request);
        $response->execute($params);
        return $response;
    }
    public static function fetchAll($request, ...$params)
    {
        $response = self::exec($request, ...$params);
        return $response->fetchAll(PDO::FETCH_OBJ);
    }
    public static function fetch($request, ...$params)
    {
        $response = self::exec($request, ...$params);
        return $response->fetch(PDO::FETCH_OBJ);
    }
}
