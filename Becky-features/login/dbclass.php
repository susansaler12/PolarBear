<?php

//when want to use class, this is how to call it
//Dbclass::getDB();


class Dbclass{

    private static $dsn = "mysql:host=woad.arvixe.com;dbname=Team_Polar_Bear";
    private static $user = "PolarBear";
    private static $pass = "Nithya123";
    private static $db;

    function __construct(){}

    public static function getDB(){
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$user, self::$pass);
                // echo "Database connected";
            } catch (PDOException $e) {
                return $e->getMessage();
                include('database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
