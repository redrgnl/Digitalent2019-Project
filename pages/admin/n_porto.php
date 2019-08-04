<?php

//koneksi db
include '../connection.php';

//memulai session
session_start();

//get nik from link
$nomorinduk = $_GET['nik'];

//mengambil data dari post form input portopolio
$keahlian = $_POST['inpkeahlian'];
$pelatihan = $_POST['inppelatihan'];
$sertifikat = $_POST['inpsertifikat'];
$project = $_POST['inpproject'];

//query untuk melihat keberadaan portopolio
$checkporto = mysqli_query($mysqli, "SELECT * FROM tbl_portopolio WHERE nik = '$nomorinduk'");
$numporto = mysqli_num_rows($checkporto);

//kondisi portopolio kosong atau tidak
if ($numporto == 0) {
    $insert = mysqli_query($mysqli, "INSERT INTO tbl_portopolio VALUES ('$nomorinduk', '$keahlian', '$pelatihan', '$sertifikat', '$project')");
    header ("location: adm_detail.php?nik=$nomorinduk");
} else {
    $update = mysqli_query($mysqli, "UPDATE tbl_portopolio SET bidang_keahlian = '$keahlian', riwayat_pelatihan = '$pelatihan', sertifikat_dimiliki = '$sertifikat', riwayat_project = '$project' WHERE nik = '$nomorinduk'");
    header ("location: adm_detail.php?nik=$nomorinduk");
}

//EOF