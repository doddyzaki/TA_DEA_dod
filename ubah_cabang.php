<?php 
	include 'layout.php'; 
	$id = $_GET['id'];
	$query = mysqli_query($conn, 'SELECT * FROM tb_klinik WHERE id_klinik='.$id.'');
	if (mysqli_num_rows($query) > 0) {
		// output data of each row
		while($cabang = mysqli_fetch_assoc($query)) {
			$cabang_target = $cabang['cabang_klinik'];
			$alamat_target = $cabang['alamat'];
		}
	}
?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-success">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-globe"></span> Kelola Cabang</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo "process/u_cabang.php?id=".$id.""; ?>">
						<fieldset>
							<legend>Tambah Cabang</legend>
							<div class="form-group">
						  		<label class="col-md-2 control-label" for="">Nama</label>
						  		<div class="col-md-6">
						    		<input class="form-control" id="" name="cabang_klinik" type="text" placeholder="Cabang Klinik. Misal: Gayamsari" value="<?php echo $cabang_target; ?>">
						  		</div>
							</div>
							<div class="form-group">
						  		<label class="col-md-2 control-label" for="">Alamat</label>
						  		<div class="col-md-6">
						    		<input class="form-control" id="" name="alamat" type="text" placeholder="Alamat" value="<?php echo $alamat_target; ?>">
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