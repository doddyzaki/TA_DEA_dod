<?php 
	
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$nama = $_POST["nama"];
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$id_klinik = $_POST["id_klinik"];
	}

	$query = "INSERT INTO tb_pengguna (nama,username,password,id_klinik,level) VALUES ('$nama','$username','$password','$id_klinik','p')";
	
	if(mysqli_query($conn,$query)){
		header('Location: ../kelola_pengguna.php?balasan=5');
	}else{
		header('Location: ../kelola_pengguna.php?balasan=6');
	}
?>