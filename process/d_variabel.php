<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$query = 'DELETE FROM tb_variabel WHERE id_variabel='.$id.'';
	if (mysqli_query($conn, $query)) {
	    header('Location: ../kelola_variabel.php?balasan=1');
	} else {
	    header('Location: ../kelola_variabel.php?balasan=2');
	}
?>