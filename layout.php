<?php 
  session_start();
  if ((!ISSET($_SESSION['username'])) AND (!ISSET($_SESSION['password']))) {
    // Mencegah direct access melalui url
    header('Location: index.php');
  } else {
    // Berhasil Login
    include "process/connect_db.php";
    $id= $_SESSION["id"];
    $level= $_SESSION["level"];
    $id_cabang= $_SESSION['id_klinik'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Program DEA</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/cssku.css">
  </head>
  
  <body>

    <div class="container-fluid">
      <div class="row">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- navbar header -->
            <div class="navbar-header">
              <!-- navbar toogle strips -->
              <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <a class="navbar-brand" href="beranda.php">Sistem Pengukuran Efisiensi Klinik</a>
            </div>
            <!-- contents inside navbar toogle -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <!--menu dropdown navbar -->
              <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['user']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="ubah_pengguna.php?type=profile&id=<?php echo $id; ?>&lvl=<?php echo $level; ?>"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
                          <li class="nav-divider"></li>
                          <li><a href="process/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </li>
                  </ul> <!-- end menu dropdown navbar -->
            </div> <!-- end contents inside navbar toogle -->
          </div> <!-- end second container fluid -->
        </nav> <!-- end navbar -->
      </div> <!-- end row -->

      <!-- div row -->
      <div class="row">
        <!-- col sidebar -->
        <div class="col-md-3">
          <div class="panel panel-default" style="top: 0;">
            <div class="panel-body">
            <a href="beranda.php"><img src="assets/img/logo_klinikita.jpg" class="img img-responsive" width="280px" id="gb1"></a>
            <br>
              <p align="center">Selamat Datang <b> <?php echo $_SESSION['nama']; ?></b></p>
              <!-- list side bar -->
              <ul class="nav nav-pills nav-stacked" id="stacked-menu">
                <li class="nav-divider"></li>
                <!-- <li><a href="beranda.php"><span class="glyphicon glyphicon-home"></span> Beranda </a></li> -->
                <?php 
                if ($level=="s") {
                  $lvl="Admin Cabang";
                echo '
                      <li>
                        <a data-toggle="collapse" data-parent="#stacked-menu" href="#p2"><span class="glyphicon glyphicon-globe"></span> Kelola Cabang <span class="caret"></span></a>
                        <ul class="nav nav-pills nav-stacked collapse" id="p2">
                          <li><a href="tambah_cabang.php">Tambah Cabang</a></li>
                          <li><a href="kelola_cabang.php">Daftar Cabang</a></li>
                        </ul>
                      </li>
                      <li>
                        <a data-toggle="collapse" data-parent="#stacked-menu" href="#p1"><span class="glyphicon glyphicon-user"></span> Kelola '.$lvl.' <span class="caret"></span></a>
                        <ul class="nav nav-pills nav-stacked collapse" id="p1">
                          <li><a href="tambah_pengguna.php">Tambah Pengguna</a></li>
                          <li><a href="kelola_pengguna.php">Daftar Pengguna</a></li>
                        </ul>
                      </li>
                      <li>
                        <a data-toggle="collapse" data-parent="#stacked-menu" href="#p3"><span class="glyphicon glyphicon-file"></span> Kelola Variabel <span class="caret"></span></a>
                        <ul class="nav nav-pills nav-stacked collapse" id="p3">
                          <li><a href="tambah_variabel.php">Tambah Variabel</a></li>
                          <li><a href="kelola_variabel.php">Daftar Variabel</a></li>
                        </ul>
                      </li>
                ';
                }elseif ($level=="a"){
                  $lvl="Manajer Cabang";
                    echo '
                      <li>
                        <a data-toggle="collapse" data-parent="#stacked-menu" href="#p1"><span class="glyphicon glyphicon-user"></span> Kelola '.$lvl.' <span class="caret"></span></a>
                        <ul class="nav nav-pills nav-stacked collapse" id="p1">
                          <li><a href="tambah_pengguna.php">Tambah Pengguna</a></li>
                          <li><a href="kelola_pengguna.php?id='.$id.'">Daftar Pengguna</a></li>
                        </ul>
                      </li>
                      
                      <li>
                      <a data-toggle="collapse" data-parent="#stacked-menu" href="#p4"><span class="glyphicon glyphicon-cloud"></span> Kelola Data DMU <span class="caret"></span></a>
                      <ul class="nav nav-pills nav-stacked collapse" id="p4">
                        <li><a href="tambah_DMU.php">Tambah Data DMU</a></li>
                        <li><a href="kelola_DMU.php">Daftar Data DMU</a></li>
                      </ul>
                      </li>
                ';
                }
                ?>
              </ul> <!-- end list sidebar -->
            </div>
          </div>
        </div> <!-- end col sidebar -->