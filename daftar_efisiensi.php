<?php include 'layout.php'; ?>
			<div class="col-md-9">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-tasks"></span> Hasil Perhitungan Efisiensi</h3>
				  </div>
				  <div class="panel-body">
					<!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Perhitungan Efisiensi
                          </header>
                          <div class="panel-body">
                              <div class="table-responsive">
								<table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>DMU</th>
                                            <th>Nilai Efisiensi</th>
											<th>Rekomendasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									include 'connect_db.php';
									
									//Assign a query
									$query = "SELECT e.*, d.nama_dmu FROM tb_perhitungan_efisiensi e, tb_klinik d WHERE d.id_klinik = e.id_dmu ORDER BY d.id_dmu ASC";
									$i = 1;
									$result = $db->query($query);
									while($row = $result->fetch_object()){
										if($row->nilai_efisiensi >= 0.95){
											$a = '<b>Sudah Efisien</b>';
										}else{
											$a = '<b>Belum Efisien</b>'.','.'  '.$row->rekomendasi;
										}
										echo '<tr>';
										echo '<td>'.$i.'</td>';
										echo '<td>'.$row->nama_dmu.'</td>';
										echo '<td>'.$row->nilai_efisiensi.'</td>';
										echo '<td>'.$a.'</td>';
										echo '</tr>';
										$i++;
									}
										echo '</table>';
										echo '<br />';
										$result->free();
									?>
									</tbody>
								</table>
							  </div>
							  <!-- /.table-responsive -->
						  </div>	  
              <!-- page end-->
          </section>
      </section>
  </section>
  <!-- container section end -->

    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery validate js -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- custom form validation script for this page-->
    <script src="js/form-validation-script.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
	<script src="asset/datatables/jquery.dataTables.min.js"></script>
	<script src="asset/datatables/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="asset/datatables/dataTables.bootstrap.css">
	<script type="text/javascript">
		  $(function () {
			$("#example1").DataTable();
		  });
		  </script>
				  </div>
				</div>
			</div>

<?php include 'footer.php'; ?>