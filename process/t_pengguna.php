<?php 
	session_start();
	$level = $_SESSION['level'];
	if ($level == 's') {
		# Login sebagai Superadmin
		$lvl = 'a';
	} else {
		# Login sebagai Admin Cabang
		$lvl = 'm';
	}
	include 'connect_db.php';
	// Memastikan Data Terkirim Melalui Form
	if (ISSET($_POST["nama_pengguna"])) {
		$nama = trim($_POST["nama_pengguna"]);
		$username = str_replace(" ","",$_POST["username"]);
		$password = md5(trim($_POST["password"]));
		$cabang = $_POST["id_klinik"];
		// Mengecek apakah data sudah pernah terdaftar
		$query1 = 'SELECT COUNT(username) AS total FROM tb_pengguna WHERE LOWER(username)=LOWER("'.$username.'")';
		if (mysqli_query($conn, $query1)) {
			$query1 = mysqli_query($conn, $query1);
			$data = mysqli_fetch_assoc($query1);
			// Jika username > 0 artinya sudah terdaftar
			if ($data['total'] > 0) {
		    	header('Location: ../tambah_pengguna.php?balasan=1');
			} elseif ($data['total'] == 0) { // Jika == 0 artinya belum pernah terdaftar
				$query2 = "INSERT INTO tb_pengguna (nama, username, password, id_klinik, level) VALUES ('$nama','$username','$password','$cabang','$lvl')";
				if (mysqli_query($conn, $query2)) {
				    header('Location: ../kelola_pengguna.php?balasan=1&id="'.$cabang.'"');
				} else {
				    header('Location: ../kelola_pengguna.php?balasan=2');
				}
			}
		} else {
			header('Location: ../kelola_pengguna.php?balasan=2');
		}	
	}
?>