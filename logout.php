<?php
session_start();
if (isset($_SESSION['username'])){
    session_unset();  //clears the content of the session file
    header('Location: index.php');
}else{
    header('Location: index.php');
}