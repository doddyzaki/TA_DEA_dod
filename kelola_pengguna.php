<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Kelola Pengguna</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
			  	<?php
			  		if (ISSET($_GET['balasan'])) {
			  			if ($_GET['balasan']==1) {
			  			  	echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambahkan</div>';
			  			} elseif ($_GET['balasan']==2) {
			  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> Kesalahan telah terjadi</div>';
			  			} elseif ($_GET['balasan']==3) {
			  			  	echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>';
			  			} elseif ($_GET['balasan']==4) {
			  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> Gagal menghapus data cabang klinik</div>';
			  			} elseif ($_GET['balasan']==5) {
			  			  	echo '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>';
			  			} elseif ($_GET['balasan']==6) {
			  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> Gagal mengubah data</div>';
			  			}
			  		}	
		  		?>
					<table class="table table-striped table-hover ">
					  <thead>
					    <tr>
					      <th>No</th>
					      <th>Nama</th>
					      <th>Username</th>
					      <th>Cabang Klinik</th>
					      <th>Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
						    $i=1;
						    $query = mysqli_query($conn,"SELECT * FROM tb_klinik JOIN tb_pengguna ON tb_klinik.id_klinik = tb_pengguna.id_klinik");

							    if(mysqli_num_rows($query)>0){
							    	while ($pengguna = mysqli_fetch_assoc($query)) {
							    		echo '
										    	<tr>
										    		<td>'.$i.'</td>
										    		<td>'.$pengguna['nama'].'</td>
										    		<td>'.$pengguna['username'].'</td>
										    		<td>'.$pengguna['cabang_klinik'].'</td>
										    		<td>
														<a href="ubah_pengguna.php?id='.$pengguna['id_pengguna'].'" class="btn btn-info btn-sm">Ubah</a>
														<a href="process/d_pengguna.php?id='.$pengguna['id_pengguna'].'" class="btn btn-danger btn-sm">Hapus</a>
									        		</td>
										    	</tr>
									    	';
									    $i++;
							    	}
							    }    	
					    ?>
					    
					  </tbody>
					</table> 
			  	</div> <!-- end div panel body -->
		</div> <!-- end div panel -->
	</div> <!-- end div kolom isi -->
<?php include 'footer.php'; ?>