<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$query = 'DELETE FROM tb_detail_dmu WHERE id_klinik='.$id.'';
	if (mysqli_query($conn, $query)) {
	    header('Location: ../kelola_dmu.php?balasan=3');
	} else {
	    header('Location: ../kelola_dmu.php?balasan=4');
	}
?>