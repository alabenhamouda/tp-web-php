<?php

class db
{
    private static $db;
    private static $options = [PDO::MYSQL_ATTR_SSL_KEY    => '/ssl/BaltimoreCyberTrustRoot.crt.pem'];
    private static $host;
    private static $name;
    private static $username;
    private static $password;
    private static function init()
    {
        try {
            if(file_exists(".env")){
                require __DIR__ . '/../vendor/autoload.php';
                $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
                $dotenv->load();
                self::$host = $_ENV['DB_HOST'];
                self::$name = $_ENV['DB_NAME'];
                self::$username = $_ENV['DB_USERNAME'];
                self::$password = $_ENV['DB_PASSWORD'];
            } else {
                self::$host = getenv('DB_HOST');
                self::$name = getenv('DB_NAME');
                self::$username = getenv('DB_USERNAME');
                self::$password = getenv('DB_PASSWORD');
            }
            self::$db = new PDO("mysql:host=" . self::$host .
                ";dbname=" . self::$name, self::$username,
                self::$password, self::$options);
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
    public static function fetchd($request, ...$params)
    {
        self::exec($request, ...$params);
        
    }
    public static function lastInsertId()
    {
        return self::fetch("SELECT LAST_INSERT_ID();");
    }
}
