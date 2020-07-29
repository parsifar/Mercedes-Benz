<?php

$server = 'localhost';
$username = 'ninja';
$password = 'pa1xpro';
$database = 'mercedes';

$conn = new mysqli($server, $username, $password, $database);
if($conn -> connect_error){
    die('Error connectiont to db '. $conn -> connect_error);
}
?>