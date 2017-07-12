<?php
	include 'connect_db.php';
	$id = $_GET['id'];
	$query1 = 'DELETE FROM tb_variabel WHERE id_variabel='.$id.'';
	if (mysqli_query($conn, $query1)) {
		$query2 = 'DELETE FROM tb_detail_dmu WHERE id_variabel='.$id.'';
		if (mysqli_query($conn, $query2)) {
			$query3 = 'DELETE FROM tb_perhitungan_efisiensi WHERE id_variabel='.$id.'';
			if (mysqli_query($conn, $query3)){
			header('Location: ../kelola_variabel.php?balasan=3');
			} else {
				header('Location: ../kelola_variabel.php?balasan=4');
			} 
		}else{
	    	header('Location: ../kelola_variabel.php?balasan=4');
	    }
	}else {
    	header('Location: ../kelola_variabel.php?balasan=4');
	}
?>