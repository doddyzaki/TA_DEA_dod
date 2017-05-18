<?php include 'layout.php'; ?>
			<div class="col-md-9">
				<div class="panel panel-success">
				  <div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Hasil Perhitungan Efisiensi</h3>
				  </div>
				  <div class="panel-body">
					<table class="table table-striped table-hover table-bordered">
					  <thead>
					    <tr>
					      <th>No</th>
					      <th>DMU</th>
					      <th>Nilai Efisiensi</th>
					      <th>Rekomendasi</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <td>1</td>
					      <td>Setiabudi</td>
					      <td>0.6</td>
					      <td><ul><b>Belum Optimal</b>
					      	<li>Dokter awal 4 orang ,direkomendasikan menjadi 6 orang</li>
							<li>Perawat awal 7 orang ,direkomendasikan menjadi 7 orang</li>
							<li>Staff Non-Medis awal 2 orang ,direkomendasikan menjadi 0 orang</li>
							<li>Pasien awal 719 orang ,direkomendasikan menjadi 456 orang</li> 
							<li>Laba awal 51 juta ,direkomendasikan menjadi 55 juta</li>
							<li>Gaji awal 17 juta ,direkomendasikan menjadi 17 juta</li>
							</ul>
					      </td>
					    </tr>
					    <tr>
					      <td>2</td>
					      <td>Kalipancur</td>
					      <td>1</td>
					      <td><b>Sudah Optimal</b></td>
					    </tr>
					    <tr>
					      <td>3</td>
					      <td>Kedungmundu</td>
					      <td>1</td>
					      <td><b>Sudah Optimal</b></td>
					    </tr>
					  </tbody>
					</table> 
				  </div>
				</div>
			</div>

<?php include 'footer.php'; ?>