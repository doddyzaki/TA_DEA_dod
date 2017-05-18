<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-success">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Kelola Variabel</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
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