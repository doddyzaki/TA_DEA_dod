<?php 
	
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$nama = trim($_POST["nama"]);
		$username = str_replace(" ","",$_POST["username"]);
		$password = md5($_POST["password"]);
		$id_klinik = $_POST["id_klinik"];
		
		// Mengecek apakah data sudah pernah terdaftar
		$query1 = 'SELECT COUNT(username) AS total FROM tb_pengguna WHERE LOWER(username)=LOWER("'.$username.'")';
		if (mysqli_query($conn, $query1)) {
			$query = mysqli_query($conn, $query1);
			$data = mysqli_fetch_assoc($query1);
			// Jika username > 0 artinya sudah terdaftar
			if ($data['total'] > 0) {
		    	header('Location: ../tambah_pengguna.php?balasan=1');
			} elseif ($data['total'] == 0) { // Jika == 0 artinya belum pernah terdaftar
				$query2 = "INSERT INTO tb_pengguna (nama, username, password, id_klinik, level) VALUES ('$nama','$username','$password','$id_klinik','p')";
				if (mysqli_query($conn, $query2)) {
				    header('Location: ../kelola_pengguna.php?balasan=1');
				} else {
				    header('Location: ../kelola_pengguna.php?balasan=2');
				}
			}
		} else {
			header('Location: ../kelola_pengguna.php?balasan=2');
		}	
	}
?>