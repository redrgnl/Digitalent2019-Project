<?php

//connection
include '../connection.php';

$today = date("Y-m-d");

//menangkap value post register
$nik = $_POST['regnik'];
$nama = $_POST['regnama'];
$tanggal = $_POST['reglahir'];
$alamat = $_POST['regalamat'];
$provinsi = $_POST['regprovinsi'];
$email = $_POST['regemail'];
$password = $_POST['regpassword'];
$enpassword = md5($password);

//check nik terdaftar atau belum
$checkdata = mysqli_query($mysqli, "SELECT * FROM tbl_anggota WHERE nik = '$nik'");
$checkrows = mysqli_num_rows($sheckdata);

if ($checkrows == 0) {
    //query insert tbl_anggota
    $query = "INSERT INTO tbl_anggota (nik, nama, ttl, alamat, provinsi, email, password, daftar) VALUES ('$nik', '$nama', '$tanggal', '$alamat', '$provinsi', '$email', '$enpassword', '$today')";

    $result = mysqli_query($mysqli, $query);
}

//redirect to form register
header("location: ../../index.html");

//EOF
