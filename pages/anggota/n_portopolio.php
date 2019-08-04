<?php

//koneksi db
include '../connection.php';

//memulai session
session_start();

//mengambil nik dari session
$nomorinduk = $_SESSION['nik'];

//menerima data dari post form portopolio
$keahlian = $_POST['inpkeahlian'];
$pelatihan = $_POST['inppelatihan'];
$sertifikat = $_POST['inpsertifikat'];
$project = $_POST['inpproject'];

//query untuk cek ada atau tidaknya portopolio anggota
$checkporto = mysqli_query($mysqli, "SELECT * FROM tbl_portopolio WHERE nik = '$nomorinduk'");
$numporto = mysqli_num_rows($checkporto);

//kondisi ada tidaknya portopolio
if ($numporto == 0) {
    $insert = mysqli_query($mysqli, "INSERT INTO tbl_portopolio VALUES ('$nomorinduk', '$keahlian', '$pelatihan', '$sertifikat', '$project')");
    header ("location: agt_dashboard.php");
} else {
    $update = mysqli_query($mysqli, "UPDATE tbl_portopolio SET bidang_keahlian = '$keahlian', riwayat_pelatihan = '$pelatihan', sertifikat_dimiliki = '$sertifikat', riwayat_project = '$project' WHERE nik = '$nomorinduk'");
    header ("location: agt_dashboard.php");
}

//EOF