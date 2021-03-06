<?php 
	include 'layout.php'; 
	$id = $_GET['id'];
	$query = mysqli_query($conn, 'SELECT * FROM tb_variabel WHERE id_variabel='.$id.'');
	if (mysqli_num_rows($query) > 0) {
		// output data of each row
		while($variabel = mysqli_fetch_assoc($query)) {
			$namavar_target = $variabel['nama_variabel'];
			$jenisvar_target = $variabel['jenis_variabel'];
			$satuan_target = $variabel['satuan'];
		}
	}
?>
	<!-- div kolom isi -->
	<div class="col-md-9">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Kelola Variabel</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo "process/u_variabel.php?id=".$id.""; ?>">
						<fieldset>
							<legend>Ubah Data Variabel</legend>
							<div class="form-group">
						  		<label class="col-md-2 col-md-offset-2 control-label" for="">Nama Variabel</label>
						  		<div class="col-md-4">
						    		<input class="form-control" id="" name="nama_variabel" type="text" placeholder="Nama Variabel" value="<?php echo $namavar_target; ?>" required>
						  		</div>
							</div>
							<div class="form-group">
						  		<label class="col-md-2 col-md-offset-2 control-label" for="">Satuan</label>
						  		<div class="col-md-4">
						    		<input class="form-control" id="" name="satuan" type="text" placeholder="Satuan dari nilai Variabel. Misal: Orang" value="<?php echo $satuan_target; ?>" required>
						  		</div>
							</div>
							<div class="form-group">
						      	<label class="col-md-2 col-md-offset-2 control-label">Tipe</label>
						      	<div class="col-md-1">
							    <?php 
							      	if ($jenisvar_target == 'Input') {
							      		echo ' <div class="radio">
										          <label>
										            <input name="radiobtn" id="" value="Input" checked type="radio">
										            Input
										          </label>
										        </div>

										        <div class="radio">
										          <label>
										            <input name="radiobtn" id="" value="Output" type="radio">
										            Output
										          </label>
										        </div>
							        	';
							      	} else {
							      		echo '	
							      				<div class="radio">
										          <label>
										            <input name="radiobtn" id="" value="Input" type="radio">
										            Input
										          </label>
										        </div>

							      				<div class="radio">
										          <label>
										            <input name="radiobtn" id="" value="Output" checked type="radio">
										            Output
										          </label>
										        </div>
							        	';
							      	}
							    ?>						        
						      	</div>
						    </div>
						    <br>
							<div class="form-group">
							  	<div class="col-md-4 col-md-offset-4">
								    <button class="btn btn-success" name="simpan" type="submit">Simpan</button>
							  	</div>
							</div>
						</fieldset>
					</form>
			  	</div> <!-- end div panel body -->
		</div> <!-- end div panel -->
	</div> <!-- end div kolom isi -->
<?php include 'closing.php'; ?>