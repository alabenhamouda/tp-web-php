<?php

class db
{
    private static $host = "tpwebphp.mysql.database.azure.com";
    private static $dbName = "tpphp";
    private static $username = "tpweb@tpwebphp";
    private static $password = "Samir.sp6";
    private static $db;
    private static $options=[PDO::MYSQL_ATTR_SSL_KEY    => '/ssl/BaltimoreCyberTrustRoot.crt.pem'];
    private static function init()
    {
        try {
            self::$db = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$username,self::$password,self::$options);
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
