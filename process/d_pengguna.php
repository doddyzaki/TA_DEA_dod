<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$query = 'DELETE FROM tb_pengguna WHERE id_pengguna='.$id.'';
	if (mysqli_query($conn, $query)) {
	    header('Location: ../kelola_pengguna.php?balasan=1');
	} else {
	    header('Location: ../kelola_pengguna.php?balasan=2');
	}
?>