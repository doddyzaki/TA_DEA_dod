<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-9">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Kelola Variabel</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="process/t_variabel.php">
						<fieldset>
							<legend>Tambah Variabel</legend>
							<?php
						    	if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
				  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Cabang</strong> sudah terdaftar. Silahkan gunakan <strong>cabang</strong> lain</div>';
				  			  	}
						    ?>
							<div class="form-group">
						  		<label class="col-md-2 col-md-offset-2 control-label" for="">Nama Variabel</label>
						  		<div class="col-md-4">
						    		<input class="form-control" id="" name="nama_variabel" type="text" placeholder="Maksimal 20 Karakter." maxlength="20" required>
						  		</div>
							</div>
							<div class="form-group">
						  		<label class="col-md-2 col-md-offset-2 control-label" for="">Satuan</label>
						  		<div class="col-md-4">
						    		<input class="form-control" id="" name="satuan" type="text" placeholder="Satuan dari nilai Variabel. Misal: Orang" maxlength="20" required>
						  		</div>
							</div>
							<div class="form-group">
						      <label class="col-md-2 col-md-offset-2 control-label">Tipe</label>
						      <div class="col-md-2">
						        <div class="radio">
						          <label class="col-md-2 ">
						            <input name="radio_jns" id="" value="Input" checked="" type="radio">
						            Input
						          </label>
						        </div>
						        <div class="radio">
						          <label class="col-md-2">
						            <input name="radio_jns" id="" value="Output" type="radio">
						            Output
						          </label>
						        </div>
						      </div>
						    </div>
						    <br>
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