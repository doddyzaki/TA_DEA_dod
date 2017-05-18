<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$cabang = $_POST['cabang_klinik'];
	$alamat = $_POST['alamat'];

	$query = 'UPDATE tb_klinik SET cabang_klinik="'.$cabang.'", alamat="'.$alamat.'" WHERE id_klinik="'.$id.'"';
	if (mysqli_query($conn, $query)) {
	    header('Location: ../kelola_cabang.php?balasan=5');
	} else {
	    header('Location: ../kelola_cabang.php?balasan=6');
	}
?>