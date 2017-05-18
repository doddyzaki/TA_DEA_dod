<?php include 'layout.php'; ?>
	<!-- div kolom isi -->
	<div class="col-md-6">
		<!-- div panel -->
		<div class="panel panel-success">
			<div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-globe"></span> Kelola Cabang</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="process/t_cabang.php">
						<fieldset>
							<legend>Tambah Cabang</legend>
							<div class="form-group">
						  		<label class="col-md-2 control-label" for="">Nama</label>
						  		<div class="col-md-6">
						    		<input class="form-control" id="" name="cabang_klinik" type="text" placeholder="Cabang Klinik. Misal: Gayamsari">
						  		</div>
							</div>
							<div class="form-group">
						      <label for="textArea" class="col-md-2 control-label">Alamat</label>
						      <div class="col-md-6">
						        <textarea class="form-control" rows="1" name="alamat" id="textArea" placeholder="Alamat"></textarea>
						        <span class="help-block"></span>
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