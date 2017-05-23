<?php 
	session_start();
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$cabang = trim($_POST["cabang_klinik"]);
		$alamat = trim($_POST["alamat"]);
	
		$query1 = 'SELECT COUNT(cabang_klinik) AS total_cabang FROM tb_klinik WHERE LOWER(cabang_klinik)=LOWER("'.$cabang.'")';

		if (mysqli_query($conn,$query1)) {
			$query1 = mysqli_query($conn,$query1);
			$data = mysqli_fetch_assoc($query1);
			//total>0 cabang telah terdaftar
			if ($data['total_cabang']>0) {
				header('Location: ../tambah_cabang.php?balasan=1');
			}elseif ($data['total']== 0) {
				//data cabang belum pernah terdaftar
				$query2 = "INSERT INTO tb_klinik (cabang_klinik,alamat) VALUES ('$cabang','$alamat')";
				if(mysqli_query($conn,$query2)){
					header('Location: ../kelola_cabang.php?balasan=1');
				}else{
					header('Location: ../kelola_cabang.php?balasan=2');
				}
			}
		} else {
			header('Location: ../kelola_cabang.php?balasan=2');
		}
	}
?>