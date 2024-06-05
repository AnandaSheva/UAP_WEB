<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "go_groceries";
    $mysqli = mysqli_connect($host, $user, $pass, $db);

    if(mysqli_connect_errno()) {
        echo "Gagal Menghubungkan ke Database : " . $mysqli->connect_error;
        exit();
    }