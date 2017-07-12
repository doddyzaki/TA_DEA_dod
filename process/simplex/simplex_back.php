<?php 
	session_start();
	include "../connect_db.php";
	
	//ambil id klinik
	$index_dmu = 0;
	$q = mysqli_query($conn, 'SELECT id_klinik FROM tb_detail_dmu GROUP BY id_klinik');
	if(mysqli_num_rows($q)>0){
		while ($data = mysqli_fetch_assoc($q)) {
			$id_dmu_klinik[$index_dmu]=$data['id_klinik'];
			$index_dmu++;
		}
	}
	$index_dmu = 0;
	$index_dmu_ccr = 1;
	$n_dmu = count($id_dmu_klinik);

	//jumlah variabel input
	$n_var_input = 0;
	$q=mysqli_query($conn, 'SELECT COUNT(*) AS total FROM tb_variabel WHERE jenis_variabel="Input"');
	$d=mysqli_fetch_array($q);
	$n_var_input=$d['total'];

	//jumlah variabel output
	$n_var_output = 0;
	$q=mysqli_query($conn, 'SELECT COUNT(*) AS total FROM tb_variabel WHERE jenis_variabel="Output"');
	$d=mysqli_fetch_array($q);
	$n_var_output=$d['total'];

	echo "var input:<br>";
	echo $n_var_input.'<br>';
	echo "var output:<br>";
	echo $n_var_output.'<br>';

	/**Pembentukan Persamaan CCR Model DEA**/
	
	//Looping Utama Perhitungan DMU ke-N
	for ($y=0; $y < $n_dmu; $y++) { 
		$q1=mysqli_query($conn, 'SELECT d.id_variabel FROM tb_detail_dmu AS d, tb_variabel AS v WHERE d.id_variabel=v.id_variabel GROUP BY d.id_variabel ORDER BY v.jenis_variabel, v.id_variabel ASC');
	
		if (mysqli_num_rows($q1)>0) {
			$i=0; $k=0;
			$j=1; $l=1;
			$n_var = 1;
			$dummy_z=array();
			while ($d1=mysqli_fetch_assoc($q1)) {
				$id_var=$d1['id_variabel'];
				if ($n_var <= $n_var_input) {
					// Fungsi Z (var input)
					$q2=mysqli_query($conn, 'SELECT d.nilai_variabel FROM tb_detail_dmu AS d, tb_variabel AS v WHERE d.id_variabel=v.id_variabel AND d.id_variabel="'.$id_var.'" AND v.jenis_variabel="Input"');
					if (mysqli_num_rows($q2) > 0) {
						while ($d2=mysqli_fetch_assoc($q2)) {
							if ($j > $n_dmu) {
								$i++;
								$j=1;
							}
							$dummy_z[$i]['x'.$j]=$d2['nilai_variabel'];
							$j++;
						}
					}
				} else {
					// Fungsi Kendala (var output)
					$q3=mysqli_query($conn, 'SELECT d.nilai_variabel FROM tb_detail_dmu AS d, tb_variabel AS v WHERE d.id_variabel=v.id_variabel AND d.id_variabel="'.$id_var.'" AND v.jenis_variabel="Output"');
					if (mysqli_num_rows($q3) > 0) {
						while ($d3=mysqli_fetch_assoc($q3)) {
							if ($l > $n_dmu) {
								$k++;
								$l=1;
							}
							$fungsi_kendala[$k]['x'.$l]=$d3['nilai_variabel'];
							$l++;
						}
					}
				}
				$n_var++;
			}
		}

		// Menambahkan var -Z di dalam Fungsi Z sesuai DMU ke-n			
		for ($m=0; $m < $n_var_input; $m++) { 
			$dummy_z[$m]['z'] = -$dummy_z[$m]['x'.$index_dmu_ccr];
			$dummy_z[$m]['notasi'] = '=';
			$dummy_z[$m]['ruas_kanan'] = 0;
		}

		// Menambahkan notasi dan ruas kanan pada fungsi kendala
		for ($o=0; $o < $n_var_output; $o++) { 
			$fungsi_kendala[$o]['notasi'] = '>=';
			$fungsi_kendala[$o]['ruas_kanan'] = $fungsi_kendala[$o]['x'.$index_dmu_ccr];
		}

		//$index_dmu++;
		echo '<br>DMU ke: '.$it=$y+1;
		echo "<br>dummy z:<br>";
		print_r($dummy_z[0]);
		echo "<br>";
		print_r($dummy_z[1]);
		echo "<br>";
		print_r($dummy_z[2]);
		echo "<br>";
		print_r($dummy_z[3]);
		echo "<br>";
		print_r($dummy_z[4]);

		echo "<br><br>kendala:<br>";
		print_r($fungsi_kendala[0]);
		echo "<br>";
		print_r($fungsi_kendala[1]);
		echo "<br>";
		/* Akhir pembentukan persamaan CCR Model */
		
		$tabel_ccr = tabel_dual_simplex($dummy_z, $fungsi_kendala, $n_var_input, $n_dmu);
		echo '<br><b>Hasil Penjumlahan Z: </b><br>';
		print_r($tabel_ccr[0]); echo "<br><br>";
		echo '<b>Fungsi Kendala:</b><br>';
		print_r($tabel_ccr[1][0]); echo '<br>';
		print_r($tabel_ccr[1][1]); echo '<br>';
		$dual_simplex = dual_simplex($tabel_ccr, $n_dmu);

		echo '<b>Pivot Baris CCR</b><br>'; print_r($dual_simplex[0]); echo '<br><br>';
		echo '<b>Index Pivot Baris CCR</b><br>'; print_r($dual_simplex[1]); echo '<br><br>';
		echo '<b>Pivot Kolom CCR</b><br>'; print_r($dual_simplex[2]); echo '<br><br>';
		echo '<b>Index Pivot Kolom CCR</b><br>'; print_r($dual_simplex[3]); echo '<br><br>';
		echo '<b>Fungsi Kendala Baru</b><br>'; print_r($dual_simplex[4]); echo '<br><br>';
		echo '<b>Fungsi Z Baru</b><br>'; print_r($dual_simplex[5]); echo '<br><br>';
		echo '<b>Iterasi CCR</b><br>'; print_r($dual_simplex[6]); echo '<br><br>';
		echo '-------------------------------------------------------------------<br>';
		
		$index_dmu_ccr++;
		$index_dmu;	
	}

	//Fungsi Pembentukan Tabel Dual Simplex
	function tabel_dual_simplex($dummy_z, $fungsi_kendala, $n_var_input, $n_dmu){
		/*menjumlahkan fungsi Z*/
		$f_ccr_z = array();
		for ($i=1; $i <= $n_dmu; $i++) { 
			$f_ccr_z[0]['x'.$i] = 0;
		}
		$f_ccr_z[0]['z'] = 0;
		$f_ccr_z[0]['notasi'] = $dummy_z[0]['notasi'];
		$f_ccr_z[0]['ruas_kanan'] = $dummy_z[0]['ruas_kanan'];
		for ($i=0; $i < $n_var_input; $i++) { 
			$f_ccr_z[0]['z'] += $dummy_z[$i]['z'];
			for ($j=1; $j <= $n_dmu; $j++) { 
				$f_ccr_z[0]['x'.$j] += $dummy_z[$i]['x'.$j];
			}
		}

		//Membagi Koefisien Fungsi Z dengan koefisien var Z
		//Sekaligus Mengalikan Fungsi Z dengan -1
		for ($i=0; $i < $n_var_input; $i++) { 
			for ($j=1; $j <= $n_dmu; $j++) { 
				$f_ccr_z[0]['x'.$j] = -1 * ($f_ccr_z[0]['x'.$j] / abs($f_ccr_z[0]['z']));
			}
			$f_ccr_z[0]['z'] = $f_ccr_z[0]['z'] / abs($f_ccr_z[0]['z']);
		}

		//Pindah ruas Z
		//Menambahkan var slack pada fungsi z
		$f_ccr_z[0]['ruas_kanan'] = 0;
		$f_ccr_z[0]['b'] = 'z';
		unset($f_ccr_z[0]['z']);
		$n_kendala_ccr =  count($fungsi_kendala);
		for ($i=1; $i <= $n_kendala_ccr; $i++) { 
			$f_ccr_z[0]['s'.$i] = 0;
		}

		//Mengubah Notasi Fungsi Kendala dari >= menjadi <= dengan mengalikan -1
		//Menambah Var Slack
		for ($i=0; $i < $n_kendala_ccr; $i++) { 
			for ($j=1; $j <= $n_dmu; $j++) { 
				$fungsi_kendala[$i]['x'.$j] *= -1;
			}
			$fungsi_kendala[$i]['notasi'] = '=';
			for ($k=1; $k <= $n_kendala_ccr; $k++) { 
				if (($i+1) == $k) {
					$fungsi_kendala[$i]['s'.$k] = 1;
					$fungsi_kendala[$i]['b'] = 's'.$k;
				} else {
					$fungsi_kendala[$i]['s'.$k] = 0;
				}
			}
			$fungsi_kendala[$i]['ruas_kanan'] = -$fungsi_kendala[$i]['ruas_kanan'];
		}

		$tabel_dual_simplex = array($f_ccr_z, $fungsi_kendala);
		return $tabel_dual_simplex;
	}

	function dual_simplex($tabel_ccr, $n_dmu){
		$f_ccr_z = $tabel_ccr[0];
		$n_kendala_ccr = count($tabel_ccr[1]);
		$fungsi_kendala = array();
		for ($i=0; $i < $n_kendala_ccr ; $i++) { 
			$fungsi_kendala[$i] = $tabel_ccr[1][$i];
		}

		//Mengecek Kondisi Terminasi
		//Ketika semua kolom ruas kanan >= 0 (positif)
		$min = 100; //inisialisasi agar solusi pivot baris dianggap paling kecil
		for ($i=0; $i < $n_kendala_ccr ; $i++) { 
			if($min > $fungsi_kendala[$i]['ruas_kanan']){
				$min = $fungsi_kendala[$i]['ruas_kanan'];
			}
		}
		if ($min > $f_ccr_z[0]['ruas_kanan']) {
			$min = $f_ccr_z[0]['ruas_kanan'];
		}
		if ($min >= 0) {
			$terminasi_ccr = 0;
		} else {
			$terminasi_ccr = 1;
		}

		$iter = 0;
		//Perulangan Utama Dual Simplex
		while ($terminasi_ccr !== 0) {
		$iter++;
		//Perhitungan Iterasi
			//Mencari Pivot Baris
			$pivot_baris_ccr = 100;
			for ($i=0; $i < $n_kendala_ccr; $i++) { 
				if ($fungsi_kendala[$i]['ruas_kanan'] <= $pivot_baris_ccr) {
					$pivot_baris_ccr = $fungsi_kendala[$i]['ruas_kanan'];
					$index_pivot_baris_ccr = $i;
				}
			}
			//Mencari Pivot Kolom
			$pivot_kolom_ccr = 100;
			$rasio_ccr = 0;
			$index_pivot_kolom_ccr = '';
				//Non Basis Variabel
				for ($j=1; $j <= $n_dmu ; $j++) { 
					if ($fungsi_kendala[$index_pivot_baris_ccr]['x'.$j] != 0) {
						$rasio_ccr = $f_ccr_z[0]['x'.$j] / $fungsi_kendala[$index_pivot_baris_ccr]['x'.$j];
						if (($rasio_ccr < $pivot_kolom_ccr) AND ($rasio_ccr > 0)) {
							$pivot_kolom_ccr = $rasio_ccr;
							$index_pivot_kolom_ccr = 'x'.$j;
						}
					}
				}

				//Basis Variabel
				for ($k=1; $k <= $n_kendala_ccr; $k++) { 
					if ($fungsi_kendala[$index_pivot_baris_ccr]['s'.$k] != 0) {
						$rasio_ccr = $f_ccr_z[0]['s'.$k] / $fungsi_kendala[$index_pivot_baris_ccr]['s'.$k];
						if (($rasio_ccr < $pivot_kolom_ccr) AND ($rasio_ccr > 0)) {
							$pivot_kolom_ccr = $rasio_ccr;
							$index_pivot_kolom_ccr = 's'.$k;
						}
					}
				}

			//Menghitung Baris Baru
				//Baris yang berperan sebagai Pivot Baris
				for ($i=1; $i <= $n_dmu ; $i++) { 
					$f_ccr_kendala[$index_pivot_baris_ccr]['x'.$i] = $fungsi_kendala[$index_pivot_baris_ccr]['x'.$i] / $fungsi_kendala[$index_pivot_baris_ccr][$index_pivot_kolom_ccr];
				}
				for ($j=1; $j <= $n_kendala_ccr ; $j++) { 
					$f_ccr_kendala[$index_pivot_baris_ccr]['s'.$j] = $fungsi_kendala[$index_pivot_baris_ccr]['s'.$j] / $fungsi_kendala[$index_pivot_baris_ccr][$index_pivot_kolom_ccr];
				}
				$f_ccr_kendala[$index_pivot_baris_ccr]['ruas_kanan'] = $fungsi_kendala[$index_pivot_baris_ccr]['ruas_kanan'] / $fungsi_kendala[$index_pivot_baris_ccr][$index_pivot_kolom_ccr];
				$f_ccr_kendala[$index_pivot_baris_ccr]['b'] = $index_pivot_kolom_ccr;

				//Selain Pivot Baris
				if (!ISSET($f_ccr_z_baru)) {
					$f_ccr_z_baru = array();
				}
				for ($i=0; $i < $n_kendala_ccr; $i++) { 
					for ($j=1; $j <= $n_dmu ; $j++) { 
						if ($i !== $index_pivot_baris_ccr) {
							$f_ccr_kendala[$i]['x'.$j] = $fungsi_kendala[$i]['x'.$j] + (-$fungsi_kendala[$i][$index_pivot_kolom_ccr] * $f_ccr_kendala[$index_pivot_baris_ccr]['x'.$j]);

						}
						$f_ccr_z_baru[0]['x'.$j] = $f_ccr_z[0]['x'.$j] + (-$f_ccr_z[0][$index_pivot_kolom_ccr] * $f_ccr_kendala[$index_pivot_baris_ccr]['x'.$j]);
					}
					for ($k=1; $k <= $n_kendala_ccr ; $k++) { 
						if($i !== $index_pivot_baris_ccr) {
							$f_ccr_kendala[$i]['s'.$k] = $fungsi_kendala[$i]['s'.$k] + (-$fungsi_kendala[$i][$index_pivot_kolom_ccr] * $f_ccr_kendala[$index_pivot_baris_ccr]['s'.$k]);
						}
					}
					if ($i !== $index_pivot_baris_ccr) {
						$f_ccr_kendala[$i]['ruas_kanan'] = $fungsi_kendala[$i]['ruas_kanan'] + (-$fungsi_kendala[$i][$index_pivot_kolom_ccr] * $f_ccr_kendala[$index_pivot_baris_ccr]['ruas_kanan']);
						$f_ccr_kendala[$i]['b'] = $fungsi_kendala[$i]['b'];
					}
					$f_ccr_z_baru[0]['ruas_kanan'] = $f_ccr_z[0]['ruas_kanan'] + (-$f_ccr_z[0][$index_pivot_kolom_ccr] * $f_ccr_kendala[$index_pivot_baris_ccr]['ruas_kanan']);
				}
				for ($j=1; $j <= $n_kendala_ccr; $j++) { 
					$f_ccr_z_baru[0]['s'.$j] = $f_ccr_z[0]['s'.$j] + (-$f_ccr_z[0][$index_pivot_kolom_ccr] * $f_ccr_kendala[$index_pivot_baris_ccr]['s'.$j]);
				}

			$hasil = array($pivot_baris_ccr, $index_pivot_baris_ccr, $pivot_kolom_ccr, $index_pivot_kolom_ccr, $f_ccr_kendala, $f_ccr_z_baru, $iter);
			$fungsi_kendala = $f_ccr_kendala;
			unset($f_ccr_kendala);
			$f_ccr_z = $f_ccr_z_baru;
			unset($f_ccr_z_baru);

			//Mengecek Kondisi Terminasi
			//Ketika Semua Kolom Ruas Kanan >= 0 (Positif)
			$min = 100;
			for ($i=0; $i < $n_kendala_ccr; $i++) { 
				if ($min > $fungsi_kendala[$i]['ruas_kanan']) {
					$min = $fungsi_kendala[$i]['ruas_kanan'];
				}
			}
			if ($min > $f_ccr_z[0]['ruas_kanan']) {
				$min =  $f_ccr_z[0]['ruas_kanan'];
			}
			if ($min >= 0) {
				$terminasi_ccr = 0; //True
			} else {
				$terminasi_ccr = 1; //False
			}
			/*return $hasil;*/
		} /*Akhir Perulangan*/
		return $hasil;
	}
?>