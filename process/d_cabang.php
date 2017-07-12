<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$query1 = 'DELETE FROM tb_klinik WHERE id_klinik='.$id.'';
	if (mysqli_query($conn, $query1)) {
		$query2 = 'DELETE FROM tb_detail_dmu WHERE id_klinik='.$id.'';	
		if (mysqli_query($conn, $query2)) {
			$query3 = 'DELETE FROM tb_pengguna WHERE id_klinik='.$id.'';
			if (mysqli_query($conn, $query3)) {
				$query4 = 'DELETE FROM tb_perhitungan_efisiensi WHERE id_klinik='.$id.'';
				if (mysqli_query($conn, $query4)) {
					header('Location: ../kelola_cabang.php?balasan=3');
				}else{
				header('Location: ../kelola_cabang.php?balasan=4');
				}
			}else {
				header('Location: ../kelola_cabang.php?balasan=4');
			}
		}else{
			header('Location: ../kelola_cabang.php?balasan=4');
		}
	}else{
		header('Location: ../kelola_cabang.php?balasan=4');
	}
?>