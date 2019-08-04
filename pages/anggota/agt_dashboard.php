<?php 

//koneksi db
include '../connection.php';

//memulai session
session_start();

//kondisi status login anggota | hak akses anggota
if ($_SESSION['status'] != "login") {
	header("location: ../../index.html");
} elseif ($_SESSION['login'] != "Anggota") {
	header("location: ../../index.html");
}

//mengambil value dari session
$username = $_SESSION['user'];
$nomorinduk = $_SESSION['nik'];

//query untuk menampilkan biodata berdasarkan nik
$querybio = mysqli_query($mysqli, "SELECT * FROM tbl_anggota WHERE nik = '$nomorinduk'");
while ($biodata = mysqli_fetch_array($querybio)) {
    $nama = $biodata['nama'];
    $lahir = $biodata['ttl'];
    $alamat = $biodata['alamat'];
    $provinsi = $biodata['provinsi'];
    $email = $biodata['email'];
}

//query menampilkan portopolio anggota berdasarkan nik
$queryporto = mysqli_query($mysqli, "SELECT * FROM tbl_portopolio WHERE nik = '$nomorinduk'");
$numporto = mysqli_num_rows($queryporto);

//kondisi melihat portopolio kosong atau tidak
if ($numporto != 0) {
    while ($porto = mysqli_fetch_array($queryporto)) {
        $keahlian = $porto['bidang_keahlian'];
        $pelatihan = $porto['riwayat_pelatihan'];
        $sertifikat = $porto['sertifikat_dimiliki'];
        $project = $porto['riwayat_project'];
    }
} else {
    $keahlian = "- Belum Di Isi -";
    $pelatihan = "- Belum Di Isi -";
    $sertifikat = "- Belum Di Isi -";
    $project = "- Belum Di Isi -";
}

//query melihat jabatan anggota
$queryposisi = mysqli_query($mysqli, "SELECT tbl_posisi.nama_posisi FROM tbl_posisi, tbl_mapping WHERE tbl_mapping.nik = '$nomorinduk' AND tbl_mapping.id_posisi = tbl_posisi.id_posisi");
while ($pos = mysqli_fetch_array($queryposisi)) {
    $posisi = $pos['nama_posisi'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AWDI | Anggota | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>WD</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>WebDev</b>Care</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $username?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $username?>
                  <small>Anggota</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $username?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="agt_dashboard.php"><i class="fa fa-circle-o"></i> Profil</a></li>
            <li><a href="agt_portofolio.php"><i class="fa fa-circle-o"></i> Portofolio</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard Profil Anggota
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary box-solid">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user2-160x160.jpg" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo $username?></h3>
              <p class="text-muted text-center">Software Engineer</p>
            </div>
          </div>
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Biodata</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-key margin-r-5"></i> Jabatan</strong>
              <p class="text-muted"><?php echo $posisi?></p>
              <hr style="margin-bottom: 5px">
              <strong><i class="fa fa-qrcode margin-r-5"></i> No. Identitas</strong>
              <p class="text-muted"><?php echo $nomorinduk?></p>
              <hr style="margin-bottom: 5px">
              <strong><i class="fa fa-calendar margin-r-5"></i> Tanggal Lahir</strong>
              <p class="text-muted"><?php echo $lahir?></p>
              <hr style="margin-bottom: 5px">
              <strong><i class="fa fa-home margin-r-5"></i> Alamat</strong>
              <p class="text-muted"><?php echo $alamat?></p>
              <hr style="margin-bottom: 5px">
              <strong><i class="fa fa-globe margin-r-5"></i> Provinsi</strong>
              <p class="text-muted"><?php echo $provinsi?></p>
              <hr style="margin-bottom: 5px">
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
              <p class="text-muted"><?php echo $email?></p>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6">
              <div class="callout callout-success">
               <h4>Profile | Portopolio Anggota</h4>
               <p>Asosiasi Web Developer Indonesia</p>
              </div>
            </div>
          </div>
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Portofolio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-graduation-cap margin-r-5"></i> Bidang Keahlian</strong>
              <p class="text-muted"><?php echo $keahlian?></p>
              <hr>
              <strong><i class="fa fa-history margin-r-5"></i> Riwayat Pelatihan</strong>
              <p class="text-muted"><?php echo $pelatihan?></p>
              <hr>
              <strong><i class="fa fa-trophy margin-r-5"></i> Sertifikat Yang Dimiliki</strong>
              <p class="text-muted"><?php echo $sertifikat?></p>
              <hr>
              <strong><i class="fa fa-briefcase margin-r-5"></i> Riwayat Project</strong>
              <p class="text-muted"><?php echo $project?></p>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Rebuild By <a href="https://redrgnl.github.io/uncore" target="_blank">Re</a> | Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../../bower_components/raphael/raphael.min.js"></script>
<script src="../../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
