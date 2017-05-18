<?php
	include 'process/connect_db.php';
	session_start();
	/* prevent back to login page before logout */
	if (ISSET($_SESSION['level'])){
		header('Location: beranda.php');
	}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SPEK</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="assets/css/cssku.css">
</head>

<body>
  
<div class="container">
  <div class="info">
    <strong>Sistem Pengukuran Efisiensi Klinikita</strong>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="assets/img/logo_klinikita.jpg"/></div>
  <form class="login-form" method="post" action="process/login.php">
    <input type="text" name="username" placeholder="username" required />
    <input type="password" name="password" placeholder="password" required/>
    <button name="login" value="login">Login</button>
    <p class="message">Not registered? <a href="#">Create an account</a></p>
  </form>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

</body>
</html>
