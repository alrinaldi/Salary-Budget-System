<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('asset/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('asset/css/sb-admin-2.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('asset/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
<?php
?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
	 <?php
	 $this->load->view('user/v_nav');
	 ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
          

        

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

					<!-- Page Heading -->
				
          <h1 class="h3 mb-2 text-gray-800">MPP</h1>
			<p class="mb-4"></p>
			<div class="row">
				<div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tahun</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_mpp/viewMppFilter'?>" method='post'>
<?php
$year1=date('Y', strtotime("+1 year"));
$year2=date('Y', strtotime("+2 year"));
$year3=date('Y', strtotime("+3 year"));
$year4=date('Y', strtotime("+4 year"));
$year5=date('Y', strtotime("+5 year"));
$year = date('Y');

?><div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select class="form-control" name="filter" >
                                        <option value="<?php echo $year; ?>"><?PHP echo $year; ?></option>
                                        <option value="<?php echo $year1; ?>"><?PHP echo $year1; ?></option>
                                        <option value="<?php echo $year2; ?>"><?PHP echo $year2; ?></option>
                                        <option value="<?php echo $year3; ?>"><?PHP echo $year3; ?></option>
                                        <option value="<?php echo $year4; ?>"><?PHP echo $year4; ?></option>
                                        <option value="<?php echo $year5; ?>"><?PHP echo $year5; ?></option>
                                            <option></option>
																				</select>
																				<label>Pilih Bulan</label>
                                        <select class="form-control" name="bulan" >
											<?php
											
											for ($m=1; $m<=12; $m++) {
												$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
												echo $month. '<br>';
											?>
                                        <option value="<?php echo $month; ?>"><?PHP echo $month; ?></option>
											<?php 
										}
										?>
                                        </select>
																		</div>
																		

           <button class="btn btn-primary">Submit</button>
           </form>
                </div>
              </div>
	  </div>
	  
	  <div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Bulan</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'admin/penjualan/penjualan_filter'?>" method='post'>
<?php
$month1=date('m', strtotime("+1 month"));
$month2=date('m', strtotime("+2 month"));
$month3=date('m', strtotime("+3 month"));
$month4=date('m', strtotime("+4 month"));
$month5=date('m', strtotime("+5 year"));
$month = date('m');

//for ($m=1; $m<=12; $m++) {
//	$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
//	echo $month. '<br>';
//	}

?><div class="form-group">
                                        <label>Pilih Bulan</label>
                                        <select class="form-control" name="filter" >
											<?php
											
											for ($m=1; $m<=12; $m++) {
												$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
												echo $month. '<br>';
											?>
                                        <option value="<?php echo $month; ?>"><?PHP echo $month; ?></option>
											<?php 
										}
										?>
                                        </select>
                                    </div>

           <button class="btn btn-primary">Submit</button>
           </form>
                </div>
              </div>
      </div>
      </div>
		
		  <div class="row">
			  <div class="col-md-12">
			  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">MPP</h6>
            </div>
            <div class="card-body">		
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
											
                      <th>CostCenter</th>
                      <th>Departemen</th>
					  <th>Seksi</th>
					  <th>Jam</th>

                      <th>Golongan 1</th>
                    </tr>
                  </thead>
                  <tfoot>

                    <tr>
										
                      <th>CostCenter</th>
                      <th>Departemen</th>
                      <th>Seksi</th>
                      <th>Golongan 1</th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
										<?php
										for ($m=1; $m<=12; $m++) {
											$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
											//echo $month. '<br>';
										}
									$year = date('Y');
									$e = 0;
									$a = 0;
									$j = 0;
									$x = 0;
									foreach($data1->result_array() as $i){
										$gol[] = $i['gol'];
										$rupiah[] = $i['rupiah'];
									
									}
										$wct = $this->db->query("SELECT * FROM workcenter order by id_workcenter");
										foreach($wct->result_array() as $k){
											$id_workcenter[$a] = $k['id_workcenter'];
											$seksi[$a] = $k['Seksi'];
											$dept[$a] = $k['Dept'];
											$mpp[$j] = $this->db->query("SELECT * FROM master_mpp where workcenter = '$id_workcenter[$a]'");
											foreach($mpp[$j]->result_array() as $z){
													$gol1[$j] = $z['gol1'];
													$gol2[$j] = $z['gol2'];
													$gol3[$j] = $z['gol3'];
													$gol4[$j] = $z['gol4'];
													$gol5[$j] = $z['gol5'];
													$gol6[$j] = $z['gol6'];
													$kontrak[$j] = $z['kontrak'];
												
													if($gol1[$j]==0){
														$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '1' and monthname(bulan) = 'January' and tahun = '$year' ");
														$covt = $ovt->num_rows();
														if($covt == 0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 1;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($m['jam'] * $rupiah[1]) * $gol1[$j];
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter'");
															}
														}

													}
													if($gol2[$j]==0){
														$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '2' and monthname(bulan) = 'January' and tahun = '$year' ");
														$covt = $ovt->num_rows();
														if($covt == 0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 2;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($m['jam'] * $rupiah[2]) * $gol2[$j];
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter'");
															}
														}

													}
													if($gol3[$j]!=''){
														$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '3' and monthname(bulan) = 'January' and tahun = '$year' ");
														$covt = $ovt->num_rows();
														if($covt == 0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 3;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($m['jam'] * $rupiah[3]) * $gol3[$j];
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter'");
															}
														}

													}
														if($gol4[$j]!=''){
														$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '4' and monthname(bulan) = 'January' and tahun = '$year' ");
														$covt = $ovt->num_rows();
														if($covt == 0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 4;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																echo $rp = ($jam * $rupiah[4]) * $gol4[$j];
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter'");
															}
														}

													}
													if($gol5[$j]!=''){
														$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '5' and monthname(bulan) = 'January' and tahun = '$year' ");
														$covt = $ovt->num_rows();
														if($covt == 0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 5;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($m['jam'] * $rupiah[5]) * $gol5[$j];
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter'");
															}
														}

													}
													if($kontrak[$j]!=''){
														$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = 'KONTRAK' and monthname(bulan) = 'January' and tahun = '$year' ");
														$covt = $ovt->num_rows();
														if($covt == 0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 'KONTRAK';
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($m['jam'] * $rupiah[0]) * $kontrak[$j];
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter'");
															}
														}

													}


													$j++;
											}
										
											$a++;
										}
									
									?>
										<tr>
										
										</tr>
									
                  </tbody>
                </table>
              </div>
            </div>
          </div>
			  </div>
		  </div>

          <!-- DataTales Example -->
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy;  Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('user/c_dashboard/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('asset/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('asset/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('asset/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('asset/js/sb-admin-2.min.js');?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('asset/vendor/chart.js/Chart.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('asset/js/demo/chart-area-demo.js');?>"></script>
  <script src="<?php echo base_url('asset/js/demo/chart-pie-demo.js');?>"></script>

  <script src="<?php echo base_url('asset/vendor/datatables/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('asset/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('asset/js/demo/datatables-demo.js');?>"></script>

</body>

</html>
