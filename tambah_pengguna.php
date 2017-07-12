<?php 
include 'layout.php';
$id= $_SESSION["id"];
$level= $_SESSION["level"];
?>
	<!-- div kolom isi -->
	<div class="col-md-9">
		<!-- div panel -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php
				if ($level=="s") {
					$lvl="Admin Cabang";
				}else{
					$lvl="Manajer Cabang";
				}
				echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Kelola '.$lvl.'</h3>
			</div> <!-- end div panel heading -->
			  	<div class="panel-body">
					<form class="form-horizontal" method="post" action="process/t_pengguna.php">
						<fieldset>
							<legend>Tambah '.$lvl.'</legend>';
							
						    	if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
				  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>Cabang</strong> sudah terdaftar. Silahkan gunakan <strong>cabang</strong> lain</div>';
				  			  	}
						    ?>
							<div class="form-group">
						  		<label class="col-md-2 col-md-offset-2 control-label" for="">Nama</label>
						  		<div class="col-md-4">
						    		<input class="form-control" id="" name="nama_pengguna" type="text" placeholder="Nama maksimal 30 karakter" maxlength="30" required>
						  		</div>
							</div>
							<div class="form-group">
							  	<label class="col-md-2 col-md-offset-2 control-label" for="">Username</label>
							  	<div class="col-md-4">
							    	<input class="form-control" id="" name="username" placeholder="Panjang username 5-20 karakter" type="text" minlength="5" maxlength="20" required>
						  		</div>
							</div>
							<div class="form-group">
							  	<label class="col-md-2 col-md-offset-2 control-label" for="">Password</label>
							  	<div class="col-md-4">
							    	<input class="form-control" id="" placeholder="Panjang password 5-15 karakter" type="password" minlength="5" maxlength="15" required>
							  	</div>
							</div>
							<div class="form-group">
						      	<label class="col-md-2 col-md-offset-2 control-label" for="select">Cabang</label>
						      	<div class="col-md-4">

						      		<?php
							      		if ($level=="s") {
							      			echo '
							      			<select class="form-control" name="id_klinik" required>
							      			<option>-- Pilih Cabang --</option>';
							      			$query1 = mysqli_query($conn, "SELECT * FROM tb_klinik");
							      			if (mysqli_num_rows($query1) > 0) {
											    // output data of each row
											    while($cabang = mysqli_fetch_assoc($query1)) {
											        echo '<option value="'.$cabang['id_klinik'].'"">'.$cabang['cabang_klinik'].'</option>
													';
											    }
											}
											echo '</select>';
							      		}elseif($level=="a"){
							      			$query2 = mysqli_query($conn, 'SELECT * FROM tb_pengguna JOIN tb_klinik ON tb_pengguna.id_klinik = tb_klinik.id_klinik WHERE id_pengguna='.$id.'');
											if (mysqli_num_rows($query2) > 0) {
												// output data of each row
												while($pengguna = mysqli_fetch_assoc($query2)) {
													$nama = $pengguna['nama'];
													$username = $pengguna['username'];
													$id_klinik = $pengguna['id_klinik'];
													$cabang_klinik = $pengguna['cabang_klinik'];
												}
											}

								      		echo '
							      			<select class="form-control" name="id_klinik" required>';
							      			$query3 = mysqli_query($conn, "SELECT * FROM tb_klinik");
							      			if (mysqli_num_rows($query3) > 0) {
											    // output data of each row
											    while($cabang = mysqli_fetch_assoc($query3)) {
											    	$id_cabang = $cabang['id_klinik'];
											    	if ($id_klinik == $id_cabang) { // Jika sesuai id yang sedang diubah
													    		echo '<option value="'.$cabang['id_klinik'].'" selected>'.$cabang['cabang_klinik'].'</option>';
													    	}
											        /*echo '<option value="'.$cabang['id_klinik'].'"">'.$cabang['cabang_klinik'].'</option>*/
													
											    }
											}
											echo '</select>';
							      		}
						      		?>
						      		
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