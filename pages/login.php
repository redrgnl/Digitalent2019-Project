<?php

//mengaktifkan session
session_start();

//connection
include 'connection.php';

//menangkap value input login
$nik = $_POST['lognama'];
$pass = $_POST['logpassword'];
$enpass = md5($pass);

//query untuk login
$query = mysqli_query($mysqli, "SELECT tbl_posisi.nama_posisi, tbl_anggota.nama, tbl_anggota.nik FROM tbl_anggota, tbl_mapping, tbl_posisi WHERE tbl_anggota.nik = '$nik' AND tbl_anggota.password = '$enpass' AND tbl_mapping.nik = tbl_anggota.nik AND tbl_mapping.id_posisi = tbl_posisi.id_posisi");

//mengambil data berdasarkan username
while ($privilege = mysqli_fetch_array($query)) {
    $access = $privilege['nama_posisi'];
    $username = $privilege['nama'];
    $nomor = $privilege['nik'];
}

//cek data yang dimasukkan / login sesuai atau tidak
$check = mysqli_num_rows($query);
if ($check > 0) {
    if ($access == "Admin") {
        $_SESSION['user'] = $username;
        $_SESSION['nik'] = $nomor;
        $_SESSION['status'] = "login";
        $_SESSION['login'] = "Admin";
        header("location: admin/adm_dashboard.php");
    } elseif ($access == "Ketua") {
        $_SESSION['user'] = $username;
        $_SESSION['nik'] = $nomor;
        $_SESSION['status'] = "login";
        $_SESSION['login'] = "Ketua";
        header("location: ketua/kta_dashboard.php");
    } elseif ($access == "Sekretariat") {
        $_SESSION['user'] = $username;
        $_SESSION['nik'] = $nomor;
        $_SESSION['status'] = "login";
        $_SESSION['login'] = "Sekretariat";
        header("location: sekretariat/skt_dashboard.php");
    } else {
        $_SESSION['user'] = $username;
        $_SESSION['nik'] = $nomor;
        $_SESSION['status'] = "login";
        $_SESSION['login'] = "Anggota";
        header("location: anggota/agt_dashboard.php");
    }
} else {
    header("location: ../index.html");
}

//EOF