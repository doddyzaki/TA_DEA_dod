<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-success">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-globe"></span> Kelola Cabang</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<table class="table table-striped table-hover ">
					  <thead>
					    <tr>
					      <th>No</th>
					      <th>Nama Cabang</th>
					      <th>Alamat</th>
					      <th>Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
							$i=1;
							$query = mysqli_query($conn, "SELECT * FROM tb_klinik");
							if (mysqli_num_rows($query) > 0) {
							    // output data of each row
							    while($cabang = mysqli_fetch_assoc($query)) {
							        echo '
										<tr>
											<td>'.$i.'</td>
											<td>'.$cabang['cabang_klinik'].'</td>
											<td>'.$cabang['alamat'].'</td>
											<td>
												<a href="ubah_cabang.php?id='.$cabang['id_klinik'].'" class="btn btn-info btn-sm">Ubah</a>
												<a href="process/d_cabang.php?id='.$cabang['id_klinik'].'" class="btn btn-danger btn-sm">Hapus</a>
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