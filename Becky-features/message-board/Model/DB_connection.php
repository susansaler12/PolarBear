<?php


class Dbclass{


    private static $dsn = 'mysql:host=woad.arvixe.com;dbname=Team_Polar_Bear';
    private static $username = 'PolarBear';
    private static $password = 'Nithya123';
    private static $db;

    private function __construct() {

    }

    public static function getDB(){

        try {
            if(!isset(self::$db)){
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        }

        return self::$db;
    }
}
