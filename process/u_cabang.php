<?php
	include 'connect_db.php';
	if((ISSET($_GET['id'])) AND (ISSET($_POST['simpan']))){
		$id = $_GET['id'];
		$cabang = trim($_POST['cabang_klinik']);
		$alamat = trim($_POST['alamat']);

		$query1 = 'SELECT COUNT(*) AS total FROM tb_klinik WHERE LOWER(cabang_klinik) = LOWER("'.$cabang.'") AND id_klinik="'.$id.'"';
		if (mysqli_query($conn, $query1)) {
			$query1 = mysqli_query($conn,$query1);
			$data = mysqli_fetch_assoc($query1);
		
			if($data['total']>0){
				// Ditemukan bahwa data telah terdaftar
				// Tapi dalam kondisi khusus jika batal ubah (data belum disentuh) tapi tetap klik simpan
				$query2 = 'SELECT COUNT(*) AS total2 FROM tb_klinik WHERE LOWER(cabang_klinik)=LOWER("'.$cabang.'") AND id_klinik="'.$id.'"';
				$query = mysqli_query($conn, $query2);
				$data = mysqli_fetch_assoc($query2);

				if ($data['total2'] > 0) {
					// Maka tidak ada notifikasi karna data tidak berubah sama sekali
					header('Location: ../kelola_cabang.php');
				} else { //end if 4
					// Jika cabang a diubah menjadi cabang b, sedangkan cabang b sudah terdaftar
					header('Location: ../ubah_cabang.php?id='.$id.'&balasan=1');
				}
			} elseif ($data['total2'] == 0) { // Jika == 0 artinya belum pernah terdaftar //end if 3
					$query3 = 'UPDATE tb_klinik SET cabang_klinik="'.$cabang.'", alamat="'.$alamat.'" WHERE id_klinik="'.$id.'"';
					if (mysqli_query($conn, $query3)) {
						    header('Location: ../kelola_cabang.php?balasan=5');
						} else {
						    header('Location: ../kelola_cabang.php?balasan=6');
						}
				} //end elseif
		} else { //end if 2
			header('Location: ../kelola_cabang.php?balasan=6');
		}
	} //end if 1
?>