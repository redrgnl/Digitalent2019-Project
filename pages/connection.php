<?php

//format koneksi db digitalent
//$host = "jwpdigitalent.com";
//$username = "u7698500_adybagus";
//$password = "@jwp2019";
//$database = "u7698500_adybagus";

//format koneksi db localhost
$host = "localhost";
$username = "root";
$password = "";
$database = "db_awpcare";

//connect database
$mysqli = mysqli_connect($host, $username, $password, $database);

//kondisi jika error / tidak terkoneksi
if (!$mysqli) {
    die("Connection Failed". mysqli_connect_error());
}

//EOF