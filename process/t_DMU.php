<?php 
	session_start();
	include 'connect_db.php';
	// Memastikan Data Terkirim Melalui Form
	if (ISSET($_POST["simpan"])) {
		$id_klinik = $_POST["id_klinik"];
		// Memastikan cabang klinik yang dipilih belum terdaftar
		$query = mysqli_query($conn, 'SELECT * FROM tb_detail_dmu WHERE id_klinik='.$id_klinik.'');
		if (mysqli_num_rows($query) > 0) {
			// Ditemukan cabang klinik yang dipilih telah terdaftar
			header('Location: ../tambah_DMU.php?balasan=1&out="'.$variabel.'"');
		} else {
			$query1 = mysqli_query($conn, "SELECT * FROM tb_variabel");
			if (mysqli_num_rows($query1) > 0) {
				while ($var = mysqli_fetch_assoc($query1)) {
					$name = str_replace(' ','_',$var['nama_variabel']);
					$variabel = $_POST[$name];
					// Translate nama var -> id var
					$query2 = mysqli_query($conn, "SELECT * FROM tb_variabel WHERE nama_variabel='".$var['nama_variabel']."'");
					if (mysqli_num_rows($query2) > 0) {
						while ($idvar = mysqli_fetch_assoc($query2)) {
							$id_variabel = $idvar['id_variabel'];
						}
					} else {
						header('Location: ../kelola_DMU.php?balasan=2');
					}
					// Insert ke tb_detail_dmu
					$query3 = mysqli_query($conn, "INSERT INTO tb_detail_dmu (id_klinik, id_variabel, nilai_variabel) VALUES ('$id_klinik','$id_variabel','$variabel')");
				}
			} else {
				header('Location: ../kelola_DMU.php?balasan=2');
			}
			header('Location: ../kelola_DMU.php?balasan=1&out= "'.$variabel.'"');
		}
	} else {
		header('Location: ../kelola_DMU.php?balasan=2');
	}
?>