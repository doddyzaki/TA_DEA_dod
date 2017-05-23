<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Kelola Variabel</h3>
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
			  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> Gagal menghapus data Variabel</div>';
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
					      <th>Nama Variabel</th>
					      <th>Satuan</th>
					      <th>Tipe</th>
					      <th>Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					    	$i=1;
					    	$query= mysqli_query($conn,"SELECT * FROM tb_variabel ORDER BY id_variabel ASC");
					    	if(mysqli_num_rows($query)>0){
					    		while ($variabel = mysqli_fetch_assoc($query)) {
					    			echo '<tr>
					    					<td>'.$i.'</td>
					    					<td>'.$variabel['nama_variabel'].'</td>
					    					<td>'.$variabel['satuan'].'</td>
					    					<td>'.$variabel['jenis_variabel'].'</td>
					    					<td>
												<a href="ubah_variabel.php?id='.$variabel['id_variabel'].'" class="btn btn-info btn-sm">Ubah</a>
												<a href="process/d_variabel.php?id='.$variabel['id_variabel'].'" class="btn btn-danger btn-sm">Hapus</a>
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