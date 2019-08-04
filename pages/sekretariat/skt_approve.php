<?php

//koneksi db
include '../connection.php';

//get nik from link
$nik = $_GET['nik'];

//query untuk approve anggota yang mendaftar
$queryapprove = mysqli_query($mysqli, "INSERT INTO tbl_mapping VALUES ('$nik', '4')");

//redirect ke dashboard sekretariat
header("location: skt_dashboard.php");

//EOF