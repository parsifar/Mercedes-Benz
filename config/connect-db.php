<?php

// include dotenv to hide sensitive data from users
require_once('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv -> load();

$server = $_ENV['DB_SERVER_NAME'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

$conn = new mysqli($server, $username, $password, $database);
if($conn -> connect_error){
    die('Error connectiont to db '. $conn -> connect_error);
}
?>