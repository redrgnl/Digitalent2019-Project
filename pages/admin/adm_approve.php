<?php

//koneksi database
include '../connection.php';

//get value from link
$nik = $_GET['nik'];

//query menambah posisi anggota baru menjadi anggota (approved)
$queryapprove = mysqli_query($mysqli, "INSERT INTO tbl_mapping VALUES ('$nik', '4')");

//redirect dashboard admin
header("location: adm_dashboard.php");

//EOF