<?php

class db
{
    private static $db;
    private static function init()
    {
        try {
            require __DIR__ . '/../vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
            $dotenv->load();
            self::$db = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
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
