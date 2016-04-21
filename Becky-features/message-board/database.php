<?php
$dsn = 'mysql:host=woad.arvixe.com;dbname=Team_Polar_Bear';
$username = 'PolarBear';
$password = 'Nithya123';

try {
    $db = new PDO($dsn, $username, $password);
    // echo "Database connected";
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('database_error.php');
    exit();
}
?>