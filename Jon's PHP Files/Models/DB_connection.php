<?php

Class DB_connection
{

    private static $dsn = "mysql:host=localhost;dbname=PolarBear";
    private static $user = "JBoss";
    private static $db;

    function __construct(){}

    public static function getDB(){
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                    self::$user);
            } catch (PDOException $e) {
                return $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }
}

