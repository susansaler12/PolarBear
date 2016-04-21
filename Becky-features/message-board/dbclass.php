<?php

//when want to use class, this is how to call it
Dbclass::getDB();


class DBConn
{

    private $dsn = 'mysql:host=localhost;dbname=php_class';
    private $username = 'root';
    private $password = '';

    public function getConnection(){
        $db = new PDO($this-> dsn, $this-> username, $this-> password);
        return $db;
    }

}

$mydb = new DBConn();
$dbc = $mydb->getConnection();

$mydb2 = new DBConn();


class Dbclass{
    
    
    private static $dsn = 'mysql:host=localhost;dbname=php_class';
    private static $username = 'root';
    private static $password = '';
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
