<?php
	require_once 'connect_db.php';
	session_start();
	if (ISSET($_POST['login'])) {
		// Login Berhasil
		$username = test_input($_POST['username']);
		$password = md5($_POST['password']);
		$query = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE username='".$username."' AND password='".$password."'");
		if(mysqli_num_rows($query) > 0){
			// Username dan Password Benar
			while($data = mysqli_fetch_assoc($query)){
				$level = $data['level'];
				$id = $data['id_pengguna'];
				$id_klinik = $data['id_klinik'];
				$nama = $data['nama'];
			}
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['id'] = $id;
			$_SESSION['level'] = $level;
			$_SESSION['id_klinik'] = $id_klinik;
			$_SESSION['nama'] = $nama;
			// Klasifikasi Level Pengguna
			if($level=='s'){ 
				// Admin
				$_SESSION['user'] = "Superadmin";
				header("location: ../beranda.php");
			}elseif ($level=='a'){ 
				// Admin Cabang
				$_SESSION['user'] = "Admin Cabang";
				header("location: ../beranda.php");
			} elseif ($level=='m') {
				// Manajer Cabang
				$_SESSION['user'] = "Manajer Cabang";
				header("location: ../beranda.php");
			} else {
				// Manajer Pusat
				$_SESSION['user'] = "Manajer Pusat";
				header("location: ../beranda.php");
			}
		} else {
			// Username dan atau Password Salah
			$_SESSION['error'] = "<b>Username</b> atau <b>Password</b> salah";
			header("location: ../index.php#login");
		}
	} else {
		// Login Gagal
		$_SESSION['error'] = 'Login Gagal';
		header("location: ../index.php#login");
	}
	
	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}
?>