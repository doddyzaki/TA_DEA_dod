<?php 
	session_start();
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$cabang = $_POST["cabang_klinik"];
		$alamat = $_POST["alamat"];
	}

	$query = "INSERT INTO tb_klinik (cabang_klinik,alamat) VALUES ('$cabang','$alamat')";
	
	if(mysqli_query($conn,$query)){
		header('Location: ../kelola_cabang.php');
	}else{
		header('Location: ../kelola_cabang.php');
	}
?>