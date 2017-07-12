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
                          <legend>Perhitungan Efisiensi</legend>
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
									//Assign a query
									$query = mysqli_query($conn,"SELECT e.*, d.cabang_klinik FROM tb_perhitungan_efisiensi e, tb_klinik d WHERE d.id_klinik = e.id_klinik ORDER BY d.id_klinik ASC");
									$i = 1;
									while($z = mysqli_fetch_array($query)){
										if($z['nilai_efisiensi'] == 1){
											$y = '<b>Sudah Efisien</b>';
										}else{
											$y = '<b>Belum Efisien </b>'.','.'   '. $z['rekomendasi'];
										}
										echo '<tr>';
										echo '<td>'.$i.'</td>';
										echo '<td>'.$z['cabang_klinik'].'</td>';
										echo '<td>'.$z['nilai_efisiensi'].'</td>';
										echo '<td>'.$y.'</td>';
										echo '</tr>';
										$i++;
									}
										echo '<br />';
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

<?php include 'closing.php'; ?>