<?php
	include 'process/connect_db.php';
	session_start();
	/* prevent back to login page before logout */
	if (ISSET($_SESSION['level'])){
		header('Location: beranda.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPEK</title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/cssku.css">
    <!-- =======================================================
        Theme Name: Medilab
        Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <!--banner-->
  <section id="banner" class="banner">
    <div class="bg-color">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="assets/img/logo.png" class="img-responsive" style="width: 140px; margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#banner">Home</a></li>
                <li class=""><a href="#service">Sekilas</a></li>
                <li class=""><a href="#login">Login</a></li>
                <li class=""><a href="#kontak">Kontak</a></li>
              </ul>
            </div>
        </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="banner-info">
            <div class="banner-logo text-center">
              <img src="assets/img/logo.png" class="img-responsive">
            </div>
            <div class="banner-text text-center">
              <h1 class="white">Sistem Pengukuran Efisiensi Klinik</h1>
              <!-- <p align="center">Selamat Datang</p> -->
              <br><br><br><br>
              <a href="#login" class="btn btn-appoint"><h4>Login Sistem</h4></a>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
  <!--service-->
  <section id="service" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <h2 class="ser-title">Tentang Sistem</h2>
          <hr class="botm-line">
          <p align="justify"><b> Sistem Pengukuran Efisiensi Klinik </b> merupakan sistem yang dibuat guna membantu Klinik dalam pertimbangan mengambil rekomendasi keputusan terhadap Klinik dalam upaya peningkatan kinerja masing-masing unit usaha dan dapat diharapkan dapat dijadikan sebagai <i> benchmarking </i> dalam meningkatkan mutu dan kualitas unit usaha Klinikita</p>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <div class="icon-info">
              <h4>Laporan Perusahaan</h4>
              <p>Rekap Laporan Klinikita dalam satu tahun yang dijadikan data untuk perhitungan efisiensi</p>
            </div>
          </div>
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <div class="icon-info">
              <h4>Proses dan Analisis</h4>
              <p>Proses menganalisis dan menerjemahkan laporan perusahaan menjadi data untuk perhitungan efisiensi</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <div class="icon-info">
              <h4>Efisiensi</h4>
              <p>Proses Perhitungan efisiensi menggunakan DEA dengan Model CCR <i>Input Oriented</i></p>
            </div>
          </div>
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <div class="icon-info">
              <h4>Rekomendasi Pengambilan Keputusan</h4>
              <p>Hasil perhitungan yang telah dilakukan menghasilkan nilai efisiensi dan rekomendasi yang dapat digunakan untuk mendukung pengambilan keputusan</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ service-->
  <!--cta-->
  
  <!--cta-->
  <!--about-->
  
  <!--/ about-->
  <!--doctor team-->
  <section id="login" class="section-padding">
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">

          <?php 
            if (ISSET($_SESSION['error'])) {
              // Terdapat Error Saat Login
              echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span>  '.$_SESSION['error'].'</div>';
            }
          ?>
            <div class="login-title" align="center">Sistem Pengukuran Efisiensi Klinik</div>
            <div class="account-wall">
                <img class="profile-img" src="assets/img/logo_klinikita.jpg"
                    alt="Logo Klinikita">
                <form class="form-signin" method="post" action="process/login.php">
                  <input type="text" name="username" class="form-control" placeholder="Username" required>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                  <button class="btn btn-lg btn-primary btn-block" name="login" value="login" type="submit">
                    Login
                  </button>
                </form>
                
            </div>
        </div>
    </div>
</div>
  </section>
  <!--/ doctor team-->
  <!--testimonial-->
  
  <!--/ testimonial-->
  <!--cta 2-->
  <section id="cta-2" class="section-padding">
    <div class="container">
      <div class=" row">
        <div class="col-md-2"></div>
              <div class="text-right-md col-md-4 col-sm-4">
                <h2 class="section-title white lg-line">Efisiensi</h2>
              </div>
              <div class="col-md-4 col-sm-5">
                  <p align="justify">
                    "<b>Efisiensi </b> adalah perbandingan yang terbaik antara input (masukan) dan output (keluaran), efisiensi merupakan sesuatu yang kita kerjakan berkaitan dengan menghasilkan hasil yang optimal dengan tidak membuang banyak waktu dalam proses pengerjaannya."
                  </p>
                <p class="text-right text-primary"><i>— H. Emerson</i></p>
              </div>
              <div class="col-md-2"></div>
          </div>
    </div>
  </section>
  <!--cta-->
  <!--contact-->
  <section id="kontak" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title"><i class="fa fa-address-book-o"></i> Kontak Kami</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
            <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>Jl. Timoho Timur IV no. 47<br>
              Semarang</p>
            <div class="space"></div>
            <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>doddyzaki@gmail.com</p>
            <div class="space"></div>
            <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+62 81 80 448 4321</p>
          </div>
        <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
              <h3 class="cnt-ttl">Kritik dan Saran dalam proses pengembangan sangat dibutuhkan</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ contact-->
  <!--footer-->
  <footer id="footer">
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Find Me on</h4>
            </div>
              <ul class="social-icon">
                <li class="bglight-blue"><a href="https://facebook.com/doddyzaki"><i class="fa fa-facebook"></i></a></li>
                <li class="bgred"><a href="https://plus.google.com/+MuhamadDoddyZakiJamil"> <i class="fa fa-google-plus"></i></a></li>
                <li class="bgdark-blue"><a href="https://www.linkedin.com/in/doddyzaki/"> <i class="fa fa-linkedin"></i></a></li>
                <li class="bglight-blue"><a href="https://instagram.com/doddyzaki"> <i class="fa fa-instagram"></i></a></li>
              </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-line">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <a href="index.php"> SPEK </a></br>
                  &copy; Copyright Doddy Zaki. 2017
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    
  </body>
</html>
