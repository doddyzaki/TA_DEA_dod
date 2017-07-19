<?php 
	include 'layout.php';
	if (ISSET($_GET['id'])) {
		$id = $_GET['id'];
	}
	if (ISSET($_GET['type'])) {
	 	$type = $_GET['type'];
	} 
	if (ISSET($_GET['lvl'])) {
		$lvl = $_GET['lvl'];
		if (($lvl == 's') OR ($lvl == 'p')) { # Jika ingin mengubah profil
			$query = mysqli_query($conn, 'SELECT * FROM tb_pengguna WHERE id_pengguna="'.$id.'"');
			if (mysqli_num_rows($query) > 0) {
				while ($data = mysqli_fetch_assoc($query)) {
					$nama = $data['nama'];
					$username = $data['username'];
				}
			}
		} else {
			$query = mysqli_query($conn, 'SELECT * FROM tb_pengguna AS p, tb_klinik AS k WHERE p.id_klinik = k.id_klinik AND p.id_pengguna="'.$id.'"');
			if (mysqli_num_rows($query) > 0) {
				$pengguna = mysqli_fetch_assoc($query);
				$nama = $pengguna['nama'];
				$username = $pengguna['username'];
				$id_klinik = $pengguna['id_klinik'];
				$cabang_klinik = $pengguna['cabang_klinik'];
				$lvl = $pengguna['level'];
			}
		}
	} else { # Jika yang login Superadmin -> mengelola Admin Cabang atau Admin Cabang -> mengelola Manajer Cabang
		$query = mysqli_query($conn, 'SELECT * FROM tb_pengguna AS p, tb_klinik AS k WHERE p.id_klinik = k.id_klinik AND p.id_pengguna="'.$id.'"');
		if (mysqli_num_rows($query) > 0) {
			$pengguna = mysqli_fetch_assoc($query);
			$nama = $pengguna['nama'];
			$username = $pengguna['username'];
			$id_klinik = $pengguna['id_klinik'];
			$cabang_klinik = $pengguna['cabang_klinik'];
			$lvl = $pengguna['level'];
		}
	}
?>
				<div class="col-sm-9">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<?php
						  		if ($level == 's') {
							  		# Superadmin
							  		$user = 'Admin Cabang';
							  		$profil = 'Superadmin';
							  		if ($type == 'profile') {
							  			echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Mengelola Profil Superadmin</h3>';
							  		} else {
							  			echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Mengelola Admin Cabang</h3>';
							  		}
							  	} elseif ($level == 'a') {
							  		# Admin Cabang
							  		$user = 'Manajer Cabang';
							  		$profil = 'Admin Cabang';
							  		if ($type == 'profile') {
							  			echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Mengelola Profil Admin Cabang</h3>';
							  		} else {
							  			echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Mengelola Manajer Cabang</h3>';
							  		}
							  	} elseif ($level == 'p') {
							  		# Manajer Pusat
							  		$profil = 'Manajer Pusat';
							  		echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Mengelola Profil Manajer Pusat</h3>';
							  	} else {
							  		# Manajer Cabang
							  		$profil = 'Manajer Cabang';
							  		echo '<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Mengelola Profil Manajer Cabang</h3>';
							  	}
					  		?>
						</div>
						<div class="panel-body">			
							<form class="form-horizontal" method="post" action="<?php echo "process/u_pengguna.php?type=".$type."&id=".$id."&lvl=".$lvl.""; ?>">
								<fieldset>
								<?php
									if ($type == 'profile') {
										echo '<legend>Profil '.$profil.'</legend>';
									} else {
										echo '<legend>Ubah '.$user.'</legend>';
									}
								?>
								    <?php
								    	if (ISSET($_GET['balasan']) AND ($_GET['balasan']==1)) {
						  			  	echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-remove"></span> <strong>Username</strong> sudah terdaftar. Silahkan gunakan <strong>username</strong> lain</div>';
						  			  	} elseif (ISSET($_GET['balasan']) AND ($_GET['balasan']==2)) {
						  			  		echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span> Gagal mengubah data</div>';
						  			  }
								    ?>
								    <div class="form-group">
								      	<label class="col-sm-2 col-md-offset-2 control-label">Nama</label>
								      	<div class="col-sm-4">
								        	<input class="form-control" name="nama_pengguna" placeholder="Panjang maksimal 50 karakter" type="text" maxlength="50" value="<?php echo $nama; ?>" required>
								      	</div>
								    </div>
								    <div class="form-group">
								      	<label class="col-sm-2 col-md-offset-2 control-label">Username</label>
								      	<div class="col-sm-4">
								        	<input class="form-control" name="username" placeholder="Panjang username 5-20 karakter" type="text" minlength="5" maxlength="20" value="<?php echo $username; ?>" disabled required>
								      	</div>
								    </div>
								    <div class="form-group">
								      	<label class="col-sm-2 col-md-offset-2 control-label">Password</label>
								      	<div class="col-sm-4">
								        	<input class="form-control" name="password" placeholder="Panjang password 5-12 karakter" type="password" minlength="5" maxlength="12" required>
								      	</div>
								    </div>
								    <div class="form-group">
								      	<label class="col-sm-2 col-md-offset-2 control-label">Cabang</label>
								      	<div class="col-sm-4">
								        	<select name="cabang_klinik" class="form-control" <?php if ($lvl == 's') {echo 'disabled';} ?> disabled required>
								        		<option value=""> -- Pilih Cabang -- </option>
								        		<?php
								        			$query = mysqli_query($conn, "SELECT * FROM tb_klinik");
								        			if (mysqli_num_rows($query) > 0) {
													    // output data of each row
													    while($cabang = mysqli_fetch_assoc($query)) {
													    	$id_cabang = $cabang['id_klinik'];
													    	if ($id_klinik == $id_cabang) { // Jika sesuai id yang sedang diubah
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
								    <div class="form-group">
								      	<div class="col-sm-4 col-sm-offset-4">
								        	<button type="submit" class="btn btn-success">Simpan</button>
								      	</div>
								    </div>
								</fieldset>
							</form>
						</div>
					</div>
				</div> <!-- End of Main Content (Second col-sm-9) -->
<?php include 'closing.php' ?>