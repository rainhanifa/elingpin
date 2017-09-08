<?php
    $dbHost = "localhost"; 
    $dbUser = "root";
    $dbPass = "";
    $dbName = "dbelprowin";
    $conn   = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if(mysqli_connect_errno()){
        die ("Koneksi gagal : ". mysqli_connect_errno());
        echo "gagal";
    } else {
        echo "berhasil";
    }
?>