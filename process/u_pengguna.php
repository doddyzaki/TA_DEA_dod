<?php
	include 'connect_db.php';
	if ((ISSET($_GET['id'])) AND ($_POST['nama_pengguna'])) {
		$id = $_GET['id'];
		$lvl = $_GET['lvl'];
		$type = $_GET['type'];
		$nama = trim($_POST['nama_pengguna']);
		$password = md5(trim($_POST['password']));
		if ($lvl == 's') {
			$id_klinik = 0;
		} else {
			$id_klinik = $_POST['cabang_klinik'];
		}

	// Mengecek apakah data sudah pernah terdaftar
		$query = 'SELECT COUNT(username) AS total FROM tb_pengguna WHERE LOWER(username)=LOWER("'.$username.'")';
		if (mysqli_query($conn, $query)) {
			$query = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($query);
			// Jika > 0 artinya sudah terdaftar
			if ($data['total'] > 0) {
				// Ditemukan bahwa data telah terdaftar
				// Tapi dalam kondisi khusus jika batal ubah (data belum disentuh) tapi tetap klik simpan
				$query = 'SELECT COUNT(*) AS total FROM tb_pengguna WHERE LOWER(username)=LOWER("'.$username.'") AND id_pengguna="'.$id.'"';
				$query = mysqli_query($conn, $query);
				$d = mysqli_fetch_assoc($query);
				if ($d['total'] > 0) {
					// Mengecek jika username tidak berubah, tp atribut lain berubah
					$query = 'SELECT COUNT(*) AS total FROM tb_pengguna WHERE LOWER(username)=LOWER("'.$username.'") AND id_pengguna="'.$id.'" AND password="'.$password.'" AND id_klinik="'.$id_klinik.'"';
					$query = mysqli_query($conn, $query);
					$data = mysqli_fetch_assoc($query);
					if ($data['total'] == 0) {
						$query = 'UPDATE tb_pengguna SET nama="'.$nama.'", password="'.$password.'" WHERE id_pengguna="'.$id.'"';
						if (mysqli_query($conn, $query)) {
							if ($type == 'profile') {
								header('Location: ../beranda.php?balasan=1');
							} elseif ($type == 'ubah') {
								header('Location: ../kelola_pengguna.php?balasan=5');
							}
						} else {
							if ($type == 'profile') {
								header('Location: ../ubah_pengguna.php?balasan=2');
							} elseif ($type == 'ubah') {
						    	header('Location: ../kelola_pengguna.php?balasan=6');
						    }
						}
					} else {
						// Maka tidak ada notifikasi karna data tidak berubah sama sekali
						if ($type == 'profile') {
							header('Location: ../beranda.php');
						} elseif ($type == 'ubah') {
							header('Location: ../kelola_pengguna.php');
						}
					}
				} else {
					// Jika pengguna a diubah menjadi pengguna b, sedangkan pengguna b sudah terdaftar
					if ($type == 'profile') {
						header('Location: ../ubah_pengguna.php?type=profile&id='.$id.'&lvl='.$lvl.'&balasan=1');
					} elseif ($type == 'ubah') {
						header('Location: ../ubah_pengguna.php?id='.$id.'&balasan=1&type='.$type.'');
					}
				}
			} elseif ($data['total'] == 0) { // Jika == 0 artinya belum pernah terdaftar
				$query = 'UPDATE tb_pengguna SET nama="'.$nama.'", password="'.$password.'" WHERE id_pengguna="'.$id.'"';
				if (mysqli_query($conn, $query)) {
				    if ($type == 'profile') {
						header('Location: ../beranda.php?balasan=1');
					} elseif ($type == 'ubah') {
						header('Location: ../kelola_pengguna.php?balasan=5');
					}
				} else {
				    if ($type == 'profile') {
						header('Location: ../ubah_pengguna.php?balasan=2');
					} elseif ($type == 'ubah') {
						header('Location: ../kelola_pengguna.php?balasan=6');
					}
				}
			}
		} else {
			if ($type == 'profile') {
				header('Location: ../ubah_pengguna.php?balasan=2');
			} elseif ($type == 'ubah') {
				header('Location: ../kelola_pengguna.php?balasan=6');
			}
		}
	}
?>