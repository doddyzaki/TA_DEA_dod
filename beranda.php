<?php include 'layout.php'; ?>

<div class="col-md-9">
	<?php
		if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
		  	echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Profil</strong> berhasil diubah</div>';
		}
	?>
	<div class="panel panel-primary">
	<div class="panel-heading">
    	<h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Dashboard</h3>
  	</div>
	  	<div class="panel-body">
		  	<?php 
				if ($level == 's') {
					echo '	<div align="center">
								<h1><strong>SISTEM PENGUKURAN EFISIENSI KLINIKITA</strong></h1>
							</div><hr />';
					echo '
							<br>
							<h4>Sistem Pengukuran Efisiensi Klinik merupakan sebuah sistem yang berfungsi untuk menghitung efisiensi kinerja masing-masing cabang klinik. <em>Output</em> dari sistem ini berupa nilai efisiensi serta rekomendasi untuk dapat meningkatkan efisiensi cabang yang dinilai belum efisien. Cabang klinik yang dinilai sudah efisien akan dijadikan sebagai <em>benchmarking</em> bagi cabang klinik lain yang belum efisien melalui rekomendasi yang dihasilkan. Sistem ini dibuat guna membantu manajer dalam mengambil keputusan sebagai upaya dalam meningkatkan mutu dan kualitas pelayanan Klinikita Semarang.
							</h4>
							<br>
					';
				} else {
					echo '	<div align="center">
								<h1><strong>HASIL PENGUKURAN EFISIENSI DAN REKOMENDASI KLINIKITA</strong></h1>
							</div>';
				}
			?>
			
			<?php
				if ($level == 'p') {
					//Mendapatkan jumlah DMU
					$ef = $cab = $id_klin = array();
					$query = mysqli_query($conn,"SELECT e.nilai_efisiensi,k.id_klinik, k.cabang_klinik FROM tb_perhitungan_efisiensi AS e, tb_klinik AS k WHERE e.id_klinik=k.id_klinik GROUP BY e.id_klinik");
					$n_dmu = mysqli_num_rows($query);

					if ($n_dmu > 0) {
						$i=0;
						while ($z = mysqli_fetch_assoc($query)) {
							$ef[$i] = $z['nilai_efisiensi'];
							$cab[$i] = $z['cabang_klinik'];
							$id_klin[$i] = $z['id_klinik'];
							$i++;
						}//end while
						
						//looping utama
						for ($j=0; $j < $n_dmu ; $j++) { 
						$efisiensi=round($ef[$j],4);
						
						echo '
						<div class="panel-body">
							<div class="row">
							  	<div class="col-md-3">
							    	<legend>'.$cab[$j].'</legend>
							  	</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-default">
								  <div class="panel-heading" align="center"><h4> Nilai Efisiensi </h4></div>
								  <div class="panel-body" align="center">
								    <h2> '.$efisiensi.' </h2>
								  </div>
								</div>
							</div>
							
						';
					
						echo '
							<div class="col-md-9">
							  	<table class="table table-striped table-hover">
							  		<thead>
							  			<tr>
							  				<th>No</th>
							  				<th>Variabel</th>
							  				<th>Nilai Lama</th>
							  				<th></th>
							  				<th>Rekomendasi</th>
							  				<th>Satuan</th>
							  			</tr>
							  		</thead>
							  		<tbody>';
										$q_tb = mysqli_query($conn, 'SELECT e.id_klinik, e.nilai_awal, e.rekomendasi, v.nama_variabel, v.satuan FROM tb_perhitungan_efisiensi AS e, tb_variabel AS v WHERE e.id_variabel=v.id_variabel AND id_klinik="'.$id_klin[$j].'" ORDER BY e.id_klinik, v.id_variabel');
										$k=0; $i=0;
										$nm_var = $ni_lama = $reko = $satuan = array();
										if (mysqli_num_rows($q_tb)>0) {
											while ($y = mysqli_fetch_assoc($q_tb)) {
												$nm_var[$k] = $y['nama_variabel'];
												$ni_lama[$k] = $y['nilai_awal'];
												$reko[$k] = $y['rekomendasi'];
												$satuan[$k] = $y['satuan'];
												$i=$k+1;

												echo '<tr>
											  			<td>'.$i.'</td>
											  			<td>'.$nm_var[$k].'</td>
											  			<td>'.$ni_lama[$k].'</td>
											  			<td><span class="glyphicon glyphicon-chevron-right"></span></td>
											  			<td>'.$reko[$k].'</td>
											  			<td>'.$satuan[$k].'</td>
								  					</tr>';
											$k++;
											}
										}
								  		echo '
								  	</tbody>
								</table>
							</div>
						</div>
						';
						} //akhir perulangan utama
					} else {
						echo '
							<br>
					  		<div class="col-sm-12">
					  			<div class="alert alert-dismissible alert-warning">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<Strong>Belum Dilakukan Perhitungan Efisiensi</strong>. Silahkan Menghubungi Admin Cabang.
								</div>
							</div>
						';
					}/// end if jumlah dmu != 0
				} elseif (($level == 'a') OR ($level == 'm')) { // selain manajer pusat 
					echo '<div class="row">';
					
					//Mendapatkan jumlah DMU
					$query = mysqli_query($conn,'SELECT e.nilai_efisiensi,k.id_klinik, k.cabang_klinik FROM tb_perhitungan_efisiensi AS e, tb_klinik AS k WHERE e.id_klinik=k.id_klinik AND e.id_klinik="'.$id_cabang.'" GROUP BY e.id_klinik');
					$n_dmu = mysqli_num_rows($query);

					if ($n_dmu > 0) {
						$i=0;
						while ($z = mysqli_fetch_assoc($query)) {
							$ef[$i] = $z['nilai_efisiensi'];
							$cab[$i] = $z['cabang_klinik'];
							$id_cabang[$i] = $z['id_klinik'];
							$i++;
						}//end while
						
						//looping utama
						for ($j=0; $j < $n_dmu ; $j++) { 
						$efisiensi=round($ef[$j],4);
						
						echo '
						<div class="panel-body">
							<div class="row">
							  	<div class="col-md-3">
							    	<legend>'.$cab[$j].'</legend>
							  	</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-default">
								  <div class="panel-heading" align="center"><h4> Nilai Efisiensi </h4></div>
								  <div class="panel-body" align="center">
								    <h2> '.$efisiensi.' </h2>
								  </div>
								</div>
							</div>
							
						';
					
						echo '
							<div class="col-md-9">
							  	<table class="table table-striped table-hover">
							  		<thead>
							  			<tr>
							  				<th>No</th>
							  				<th>Variabel</th>
							  				<th>Nilai Lama</th>
							  				<th></th>
							  				<th>Rekomendasi</th>
							  				<th>Satuan</th>
							  			</tr>
							  		</thead>
							  		<tbody>';
										$q_tb = mysqli_query($conn, 'SELECT e.id_klinik, e.nilai_awal, e.rekomendasi, v.nama_variabel, v.satuan FROM tb_perhitungan_efisiensi AS e, tb_variabel AS v WHERE e.id_variabel=v.id_variabel AND id_klinik="'.$id_cabang[$j].'" ORDER BY e.id_klinik, v.id_variabel');
										$k=0; $i=0;
										$nm_var = $ni_lama = $reko = $satuan = array();
										if (mysqli_num_rows($q_tb)>0) {
											while ($y = mysqli_fetch_assoc($q_tb)) {
												$nm_var[$k] = $y['nama_variabel'];
												$ni_lama[$k] = $y['nilai_awal'];
												$reko[$k] = $y['rekomendasi'];
												$satuan[$k] = $y['satuan'];
												$i=$k+1;

												echo '<tr>
											  			<td>'.$i.'</td>
											  			<td>'.$nm_var[$k].'</td>
											  			<td>'.$ni_lama[$k].'</td>
											  			<td><span class="glyphicon glyphicon-chevron-right"></span></td>
											  			<td>'.$reko[$k].'</td>
											  			<td>'.$satuan[$k].'</td>
								  					</tr>';
											$k++;
											}
										}
								  		echo '
								  	</tbody>
								</table>
							</div>
						</div>
						';
						} //akhir perulangan utama
					} else {
						echo '
							<br>
					  		<div class="col-sm-12">
					  			<div class="alert alert-dismissible alert-warning">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<Strong>Belum Dilakukan Perhitungan Efisiensi</strong>. Silakan Menghubungi Admin Cabang!
								</div>
							</div>
						';
					}/// end if jumlah dmu lebih dari 0
				} //end else dari level pengguna 
			?>
		</div> <!-- div panel body -->
	</div> <!-- div panel main -->
</div> <!-- div kolom layout -->

<?php include 'closing.php'; ?>