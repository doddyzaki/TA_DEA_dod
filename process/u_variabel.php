<?php 
	include "connect_db.php";

	if(ISSET($_POST["simpan"])){
		$id = $_GET['id'];
		$nama_variabel = $_POST["nama_variabel"];
		$satuan = $_POST["satuan"];
		$jenis_variabel = $_POST["radiobtn"];
	}

	$query = 'UPDATE tb_variabel SET nama_variabel="'.$nama_variabel.'", jenis_variabel="'.$jenis_variabel.'", satuan="'.$satuan.'"  WHERE id_variabel="'.$id.'" ';
	
	if(mysqli_query($conn,$query)){
		header('Location: ../kelola_variabel.php?balasan=5&out="'.$id.'"');
	}else{
		header('Location: ../kelola_variabel.php?balasan=6&out="'.$jenis_variabel.'"');
	}
?>