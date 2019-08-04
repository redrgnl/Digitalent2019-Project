<?php

include '../connection.php';

$nik = $_GET['nik'];
$akses = $_POST['inpakses'];

$queryakses = mysqli_query($mysqli, "UPDATE tbl_mapping SET id_posisi = '$akses' WHERE nik = '$nik'");

header("location: adm_detail.php?nik=$nik");

//EOF