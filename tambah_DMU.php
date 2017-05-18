<?php include 'layout.php';?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-success">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-cloud"></span> Kelola DMU</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="process/t_DMU.php">
						<fieldset>
							<legend>Masukkan Nilai Variabel</legend>
							<div class="form-group">
						      	<label class="col-md-3 control-label" for="select">Cabang</label>
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
							<?php
								$query = mysqli_query($conn, "SELECT * FROM tb_variabel ORDER BY id_variabel ASC");
								if (mysqli_num_rows($query) > 0) {
									while ($var = mysqli_fetch_assoc($query)) {
										$name = str_replace(' ','_',$var['nama_variabel']);
										$satuan = $var['satuan'];
										echo '
											<div class="form-group">
										      	<label class="col-sm-3 control-label">'.$var["nama_variabel"].'</label>
										      	<div class="col-sm-6">
										        	<input class="form-control" name="'.$name.'" type="number" min="0" placeholder="'.$satuan.'" required>
										      	</div>
										    </div>
										';
									}
								}
							?>
														
						    <br>
							<div class="form-group">
							  	<div class="col-md-4 col-md-offset-3">
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