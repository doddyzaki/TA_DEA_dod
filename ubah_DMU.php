<?php 
	include 'layout.php'; 
	$id = $_GET['id'];
?>
				<div class="col-sm-9">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><span class="glyphicon glyphicon-cloud"></span> Mengelola DMU</h3>
						</div>
						<div class="panel-body">			
							<form class="form-horizontal" method="post" action="<?php echo "process/u_dmu.php?id=".$id.""; ?>">
								<fieldset>
								    <legend>Ubah DMU</legend>
								    <div class="form-group">
								      	<label class="col-sm-4 control-label">Nama</label>
								      	<div class="col-sm-6">
								        	<select name="id_klinik" class="form-control" required disabled>
								        		<option value=""> -- Pilih Cabang -- </option>
								        		<?php
								        			$query = mysqli_query($conn, "SELECT k.cabang_klinik, d.id_klinik FROM tb_klinik AS k, tb_detail_dmu AS d WHERE k.id_klinik=d.id_klinik GROUP BY id_klinik");
								        			if (mysqli_num_rows($query) > 0) {
													    // output data of each row
													    while($cabang = mysqli_fetch_assoc($query)) {
													    	$id_cabang = $cabang['id_klinik'];
													    	if ($id == $id_cabang) { // Jika sesuai id yang sedang diubah
													    		echo '<option value="'.$id_cabang.'" selected>'.$cabang["cabang_klinik"].'</option>';
													    	} else { // Jika bukan id yang sedang diubah
													    		echo '<option value="'.$id_cabang.'">'.$cabang["cabang_klinik"].'</option>';
													    	}
													    }
													}
								        		?>
								        	</select>
								      	</div>
								    </div>
								    <?php
								    	$input = 0;
								    	$output = 0;
										$query = mysqli_query($conn, 'SELECT * FROM tb_variabel v, tb_detail_dmu d WHERE v.id_variabel=d.id_variabel AND d.id_klinik='.$id.' ORDER BY v.jenis_variabel ASC, v.id_variabel ASC');
										while($var = mysqli_fetch_assoc($query)){
											$name =	 str_replace(' ','_',$var['nama_variabel']);
											$satuan = $var['satuan'];
											$value = $var["nilai_variabel"];
											if (($var['jenis_variabel'] == 'i') AND ($input == 0)) {
												echo '<div class="form-group"><legend class="col-sm-8 col-sm-offset-2">Variabel Input</legend></div>';
													$input = 1;
											} elseif (($var['jenis_variabel'] == 'o') AND ($output == 0)) {
												echo '<div class="form-group"><legend class="col-sm-8 col-sm-offset-2">Variabel Output</legend></div>';
													$output = 1;
											}
											echo '
												<div class="form-group">
												    <label class="col-sm-4 control-label">'.$var["nama_variabel"].'</label>
												    <div class="col-sm-6">
												        <input class="form-control" name="'.$name.'" type="number" min="0" placeholder="'.$satuan.'" value="'.$value.'" required>
												    </div>
												</div>
											';
										}
									?>
								    <div class="form-group">
								      	<div class="col-sm-6 col-sm-offset-4">
								        	<button type="submit" class="btn btn-default">Simpan</button>
								        	<button type="reset" class="btn btn-primary">Kosongkan</button>
								      	</div>
								    </div>
								</fieldset>
							</form>
						</div>
					</div>
				</div> <!-- End of Main Content (Second col-sm-9) -->
<?php include 'footer.php' ?>