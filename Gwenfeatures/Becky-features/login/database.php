<?php
$dsn = 'mysql:host=localhost;dbname=php_class';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    // echo "Database connected";
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('database_error.php');
    exit();
}
?>