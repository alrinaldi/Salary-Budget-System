<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

	<title>Salary Budget System</title>

<!-- Custom fonts for this template-->
<link rel="shortcut icon" href="<?php echo base_url().'asset/img/bgts.png'?>" >

  <link href="<?php echo base_url('asset/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('asset/css/sb-admin-2.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('asset/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">

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
					<h2 style="color:mediumblue">YUTAKA MANUFACTURING INDONESIA</h2>


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
				
          <h1 class="h3 mb-2 text-gray-800">List Overtime </h1>
			<p class="mb-4"></p>
			<div class="row">
				<div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_overtime/listFilterOvertime'?>" method='post'>
<?php
$year1=date('Y', strtotime("+1 year"));
$year2=date('Y', strtotime("+2 year"));
$year3=date('Y', strtotime("+3 year"));
$year4=date('Y', strtotime("+4 year"));
$year5=date('Y', strtotime("+5 year"));
$year = date('Y');

?><div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select class="form-control" name="year" >
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
                  <h6 class="m-0 font-weight-bold text-primary">Export DATA</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_excel/exportmpp'?>" method='post'>
<?php
$year1=date('Y', strtotime("+1 year"));
$year2=date('Y', strtotime("+2 year"));
$year3=date('Y', strtotime("+3 year"));
$year4=date('Y', strtotime("+4 year"));
$year5=date('Y', strtotime("+5 year"));
$year = date('Y');

?><div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select class="form-control" name="year" >
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
                  <h6 class="m-0 font-weight-bold text-primary">Export DATA (Yearly)</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_excel/exportmpp_y'?>" method='post'>
<?php
$year1=date('Y', strtotime("+1 year"));
$year2=date('Y', strtotime("+2 year"));
$year3=date('Y', strtotime("+3 year"));
$year4=date('Y', strtotime("+4 year"));
$year5=date('Y', strtotime("+5 year"));
$year = date('Y');

?><div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select class="form-control" name="year" >
																				<?php $yl = $this->db->query("SELECT DISTINCT(tahun) as tahun from master_mpp");
																				foreach($yl->result_array() as $m):
																					$tahun = $m['tahun'];
																				?>
                                        <option value="<?php echo $tahun; ?>"><?PHP echo $tahun; ?></option>
																				<?php endforeach;?>
																						
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
              <h4 class="m-0 font-weight-bold text-primary">MPP <?php echo $monthh; ?>-<?php echo $year; ?></h4>
            </div>
            <div class="card-body">		
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
											
					<th>CostCenter</th>
                      <th>Departemen</th>
                      <th >Seksi</th>
                      <th>Gol 1</th>
                      <th>Gol 2</th>
                      <th>Gol 3</th>
                      <th>Gol 4</th>
                      <th>Gol 5</th>
					  <th>Gol 6</th>
						<th>Kontrak</th>
						
                    </tr>
                  </thead>
                  <tfoot>

                    <tr>
												
					<th>CostCenter</th>
                      <th>Departemen</th>
                      <th >Seksi</th>
                      <th>Gol 1</th>
                      <th>Gol 2</th>
                      <th>Gol 3</th>
                      <th>Gol 4</th>
                      <th>Gol 5</th>
					  <th>Gol 6</th>
						<th>Kontrak</th>
				
                    </tr>
                  </tfoot>
                  <tbody>
										<?php
										foreach($data->result_array() as $i):
										$departemen = $i['dept'];
										$workcenter = $i['workcenter'];
										$seksi = $i['seksi'];
										$gol1 = $i['gol1'];
										$gol2 = $i['gol2'];
										$gol3 = $i['gol3'];
										$gol4 = $i['gol4'];
										$gol5 = $i['gol5'];
										$gol6 = $i['gol6'];
										$kontrak = $i['kontrak'];
										?>
										<tr>
											<?php
											
											?>

											<td><?php echo$workcenter;?></td>
											<td><?php echo$departemen;?></td>
											<td><?php echo$seksi;?></td>
											<td><?php echo$gol1;?></td>
											<td><?php echo$gol2;?></td>
											<td><?php echo$gol3;?></td>
											<td><?php echo$gol4;?></td>
											<td><?php echo$gol5;?></td>
											<td><?php echo$gol6;?></td>
											<td><?php echo$kontrak;?></td>
											

										</tr>
										<?php endforeach ?>
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
