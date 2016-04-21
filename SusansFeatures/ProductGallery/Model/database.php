<?php
Class DB_connection
{

private static $dsn = "mysql:host=woad.arvixe.com;dbname=Team_Polar_Bear";
private static $user = "PolarBear";
private static $pass = "Nithya123";
private static $db;

function __construct(){}

public static function getDB(){
if (!isset(self::$db)) {
try {
self::$db = new PDO(self::$dsn, self::$user, self::$pass);
} catch (PDOException $e) {
return $e->getMessage();
exit();
}
}
return self::$db;
}
}
?>