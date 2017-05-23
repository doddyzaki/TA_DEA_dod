<?php 
	
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$nama_var = trim($_POST["nama_variabel"]);
		$satuan = trim($_POST["satuan"]);
		$jenis = trim($_POST["radio_jns"]);
	
	// Mengecek apakah data sudah pernah terdaftar
		$query1 = 'SELECT COUNT(nama_variabel) AS total FROM tb_variabel WHERE LOWER(nama_variabel)=LOWER("'.$nama_var.'")';
		if (mysqli_query($conn, $query1)) {
			$query1 = mysqli_query($conn, $query1);
			$data = mysqli_fetch_assoc($query1);
			// Jika data > 0 artinya sudah terdaftar
			if ($data['total'] > 0) {
		    	header('Location: ../tambah_variabel.php?balasan=1');
			} else { // Jika == 0 artinya belum pernah terdaftar
				
				/* Begining of var-dmu validation */
				// Jika terjadi penambahan var dimana dmu sudah pernah ditambahkan sebelum var baru itu ada
				// Maka dilakukan insert value=0 pada var baru di semua dmu yg sudah ada dengan memastikan detail dmu tidak null
				$query2 = "INSERT INTO tb_variabel (nama_variabel, jenis_variabel, satuan) VALUES ('$nama_var','$jenis','$satuan')";
				if (mysqli_query($conn, $query2)) {
					// Bandingkan jumlah var pd tb variabel dan tb detail dmu
					// Sinkronisasi var pada detail dmu
					// Menghitung jumlah var input dan output pada tb var
					$query3 = mysqli_query($conn, 'SELECT * FROM tb_variabel ORDER BY jenis_variabel ASC, id_variabel ASC');
					$input = 0;
					$output = 0;
					if (mysqli_num_rows($query3) > 0) {
						while($var = mysqli_fetch_assoc($query3)) {
							if ($var['jenis_variabel'] == 'i') {
								$input++;
							} else {
								$output++;
							}
						}
						$total_var = $input + $output;
					}

					// Menghitung jumlah var pd tb detail dmu
					$var_dmu = 0;
					$query4 = mysqli_query($conn, 'SELECT * FROM tb_detail_dmu GROUP BY id_variabel ORDER BY id_variabel ASC');
					if (mysqli_num_rows($query4) > 0) {
						while($var2 = mysqli_fetch_assoc($query4)) {
							$var_dmu++;
						}
					}

					$query5 = mysqli_query($conn, 'SELECT * FROM tb_variabel WHERE nama_variabel="'.$nama_var.'" AND jenis_variabel="'.$jenis.'" AND satuan="'.$satuan.'"');
					if ((mysqli_num_rows($query5) > 0) AND ($total_var != $var_dmu)) {
						$var4 = mysqli_fetch_assoc($query5);
						$id_var_baru = $var4['id_variabel'];
					
						// Menghitung ada tidaknya data pada tb detail dmu
						$query6 = mysqli_query($conn, 'SELECT * FROM `tb_detail_dmu` GROUP BY id_klinik');
						if (mysqli_num_rows($query6) > 0) {
							while($var3 = mysqli_fetch_assoc($query6)) {
								$id_klinik = $var3['id_klinik'];
								// Insert value=0 pada id_var=$id_var_baru dan id_klinik=$id_klinik
								$query7 = "INSERT INTO tb_detail_dmu (id_klinik, id_variabel, nilai_variabel) VALUES ('$id_klinik','$id_var_baru','0')";
								if (mysqli_query($conn, $query7)) {
									header('Location: ../kelola_variabel.php?balasan=1');
								} else {
									header('Location: ../kelola_variabel.php?balasan=2');
								}
							}
						}
					}
					header('Location: ../kelola_variabel.php?balasan=1');
				} else {
					header('Location: ../kelola_variabel.php?balasan=2');
				}
				/* End of var-dmu validation */
			}
		} else {
			header('Location: ../kelola_variabel.php?balasan=2');
		}
	}	
?>