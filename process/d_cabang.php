<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$query = 'DELETE FROM tb_klinik WHERE id_klinik='.$id.'';
	if (mysqli_query($conn, $query)) {
	    header('Location: ../kelola_cabang.php?');
	} else {
	    header('Location: ../kelola_cabang.php?');
	}
?>