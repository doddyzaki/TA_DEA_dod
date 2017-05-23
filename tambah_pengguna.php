<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Kelola Pengguna</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="process/t_pengguna.php">
						<fieldset>
							<legend>Tambah Pengguna</legend>
							<?php
						    	if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
				  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Cabang</strong> sudah terdaftar. Silahkan gunakan <strong>cabang</strong> lain</div>';
				  			  	}
						    ?>
							<div class="form-group">
						  		<label class="col-md-2 control-label" for="">Nama</label>
						  		<div class="col-md-6">
						    		<input class="form-control" id="" name="nama" type="text" placeholder="Nama">
						  		</div>
							</div>
							<div class="form-group">
							  	<label class="col-md-2 control-label" for="">Username</label>
							  	<div class="col-md-6">
							    	<input class="form-control" id="" name="username" type="text" placeholder="Username">
						  		</div>
							</div>
							<div class="form-group">
							  	<label class="col-md-2 control-label" for="">Password</label>
							  	<div class="col-md-6">
							    	<input class="form-control" id="" name="password" type="password" placeholder="Password">
							  	</div>
							</div>
							<div class="form-group">
						      	<label class="col-md-2 control-label" for="select">Cabang</label>
						      	<div class="col-md-6">
						      		<select class="form-control" name="id_klinik">
						      			<option>-- Pilih Cabang --</option>
							      		<?php
											$query = mysqli_query($conn, "SELECT * FROM tb_klinik");
											if (mysqli_num_rows($query) > 0) {
											    // output data of each row
											    while($cabang = mysqli_fetch_assoc($query)) {
											        echo '
															<option value="'.$cabang['id_klinik'].'">'.$cabang['cabang_klinik'].'</option>
													';
											    }
											}
										?>
							        </select> 
						      	</div>
						    </div>
						    <br>
							<div class="form-group">
							  	<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-danger" type="reset">Cancel</button>
								    <button class="btn btn-success" name="simpan" type="submit">Submit</button>
							  	</div>
							</div>
						</fieldset>
					</form>
			  	</div> <!-- end div panel body -->
		</div> <!-- end div panel -->
	</div> <!-- end div kolom isi -->
<?php include 'footer.php'; ?>