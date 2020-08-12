<?php

if (isset($_COOKIE['username'])){
    //to delete the cookie set an expiry time in the past
    setcookie('username','notimportant' , time()-100000);
    header('Location: index.php');
}