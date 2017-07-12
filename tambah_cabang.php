<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-9">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-globe"></span> Kelola Cabang</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="process/t_cabang.php">
						<fieldset>
							<legend>Tambah Cabang</legend>
							<?php
						    	if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
				  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Cabang</strong> sudah terdaftar. Silahkan gunakan <strong>cabang</strong> lain</div>';
				  			  	}
						    ?>

							<div class="form-group">
						  		<label class="col-md-2 col-md-offset-2 control-label" for="">Nama Cabang</label>
						  		<div class="col-md-4">
						    		<input class="form-control" id="" name="cabang_klinik" type="text" placeholder="Panjang maksimal 30 karakter." maxlength="30" required>
						  		</div>
							</div>
							<div class="form-group">
						      <label for="textArea" class="col-md-2 col-md-offset-2 control-label">Alamat</label>
						      <div class="col-md-4">
						        <textarea class="form-control" rows="1" name="alamat" id="textArea" placeholder="Alamat" required></textarea>
						        <span class="help-block"></span>
						      </div>
						    </div>
							<div class="form-group">
							  	<div class="col-md-4 col-md-offset-4">
								    <button class="btn btn-success" name="simpan" type="submit">Submit</button>
							  	</div>
							</div>
						</fieldset>
					</form>
			  	</div> <!-- end div panel body -->
		</div> <!-- end div panel -->
	</div> <!-- end div kolom isi -->
<?php include 'closing.php'; ?>