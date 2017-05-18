<?php 
	
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$nama_variabel = $_POST["nama_variabel"];
		$satuan = $_POST["satuan"];
		$jenis_variabel = $_POST["radiobtn"];
	}

	$query = "INSERT INTO tb_variabel (nama_variabel,satuan,jenis_variabel) VALUES ('$nama_variabel','$satuan','$jenis_variabel')";
	
	if(mysqli_query($conn,$query)){
		header('Location: ../kelola_variabel.php?balasan=5');
	}else{
		header('Location: ../kelola_variabel.php?balasan=6');
	}
?>