<?php 

//koneksi db
include '../connection.php';

//memulai session
session_start();

//get current year
$month = date("Y");

//kondisi untuk cek status login | cek hak akses
if ($_SESSION['status'] != "login") {
	header("location: ../../index.html");
} elseif ($_SESSION['login'] != "Admin") {
	header("location: ../../index.html");
}

//mengambil value session
$username = $_SESSION['user'];
$nomorinduk = $_SESSION['nik'];

//query cek hak akses anggota
$querynums = mysqli_query($mysqli, "SELECT * FROM tbl_mapping");
$anggotanums = mysqli_num_rows($querynums);

//query pengelompokan anggota orderby provinsi
$grpprovinsi = mysqli_query($mysqli, "SELECT COUNT(tbl_anggota.nik) as jumlah, tbl_anggota.provinsi FROM tbl_anggota, tbl_mapping WHERE tbl_anggota.nik = tbl_mapping.nik GROUP BY provinsi");

//jumlah anggota perbulan bedasarkan tahun ini
$statistikbulanan = mysqli_query($mysqli, "SELECT COUNT(tbl_anggota.nik) as jmlagt, MONTH(tbl_anggota.daftar) as blnagt FROM tbl_anggota, tbl_mapping WHERE YEAR(tbl_anggota.daftar) = '$month' AND tbl_anggota.nik = tbl_mapping.nik GROUP BY MONTH(daftar)");

//query untuk melihat data anggota terdaftar
$queryanggota = mysqli_query($mysqli, "SELECT tbl_anggota.nik, tbl_anggota.nama, tbl_anggota.ttl, tbl_anggota.alamat, tbl_anggota.provinsi, tbl_anggota.email FROM tbl_anggota, tbl_mapping WHERE tbl_anggota.nik = tbl_mapping.nik");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AWDI | Admin | Dashboard</title>
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
  <!-- Chartjs -->
  <link rel="stylesheet" href="../../bower_components/chart.js/Chart.js">
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
                  <small>Admin</small>
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
      <!-- /.search form -->
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
            <li class="active"><a href="adm_dashboard.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <li><a href="adm_pendaftar.php"><i class="fa fa-circle-o"></i> Pendaftar</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
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
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 style="margin-left: 15px"><?php echo $anggotanums?> <i class="fa fa-user" style="font-size: 30px"></i></h3>

              <p>Jumlah Total Anggota</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="callout callout-info">
            <h4>Daftar Anggota</h4>
            <p>Asosiasi Web Developer Indonesia</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4>Jumlah Anggota Per Bulan | Tahun <?php echo $month?></h4>
        </div>
      </div>
      <div class="row">
        <?php while ($stat = mysqli_fetch_array($statistikbulanan)) { ?>
        <?php $bulan = $stat['blnagt']; 
            if ($bulan == 1) { $dafbulan = "Januari"; } elseif ($bulan == 2) { $dafbulan = "Februari"; } elseif ($bulan == 3) { 
                $dafbulan = "Maret"; } elseif ($bulan == 4) { $dafbulan = "April"; } elseif ($bulan == 5) { $dafbulan = "Mei";
            } elseif ($bulan == 6) { $dafbulan = "Juni"; } elseif ($bulan == 7) { $dafbulan = "Juli"; } elseif ($bulan == 8) {
                $dafbulan = "Agustus"; } elseif ($bulan == 9) { $dafbulan = "September"; } elseif ($bulan == 10) { $dafbulan = "Oktober";
            } elseif ($bulan == 11) { $dafbulan = "November"; } elseif ($bulan == 12) { $dafbulan = "Desember"; }
          ?>
        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><?php echo $dafbulan?></span>
              <span class="info-box-number"><?php echo $stat['jmlagt']?> Anggota</span>
            </div>
          </div>
        </div>
        <?php } ?>  
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4>Daftar Anggota | Jumlah Anggota Per Provinsi</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#daftar" data-toggle="tab">Anggota</a></li>
              <li><a href="#provinsi" data-toggle="tab">Provinsi</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="daftar">
                <div class="box box-solid box-primary">
                  <div class="box-body">
                    <table class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>NIK</th>  
                          <th>Nama</th>  
                          <th>Lahir</th>  
                          <th>Alamat</th>  
                          <th>Provinsi</th>  
                          <th>Email</th>  
                          <th>Detail</th>  
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = mysqli_fetch_array($queryanggota)) { ?>
                        <tr>
                          <td><?php echo $row['nik']?></td>
                          <td><?php echo $row['nama']?></td>
                          <td><?php echo $row['ttl']?></td>
                          <td><?php echo $row['alamat']?></td>
                          <td><?php echo $row['provinsi']?></td>
                          <td><?php echo $row['email']?></td>
                          <td><a href="adm_detail.php?nik=<?php echo $row['nik']?>" class="btn btn-primary"><i class="fa fa-search"></i></a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="provinsi">
                <div class="box box-solid box-primary">
                  <div class="box-body">
                    <table class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Provinsi</th>  
                          <th>Jumlah Anggota</th>  
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($prov = mysqli_fetch_array($grpprovinsi)) { ?>
                        <tr>
                          <td><?php echo $prov['provinsi']?></td>
                          <td><?php echo $prov['jumlah']?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Rebuild By <a href="https://redrgnl.github.io/uncore" target="_blank">Re</a> | Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a></strong> All rights
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
