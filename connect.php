<?php
//connection for every page a query is needed
    $host = "localhost";
    $user = "asm122";
    $password = "3942566";
    $dbname = "daa82";
    $connect = mysqli_connect($host, $user, $password, $dbname);
    if(mysqli_connect_errno()) {
        die("Database connection failed: ".mysqli_connect_error() . " (" . mysqli_connect_errno(). ")");
    }
?>