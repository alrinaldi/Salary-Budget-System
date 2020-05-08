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

<?php
$tahun = date('Y', strtotime("-1 year"));
$tahunN = date('Y');
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
				
          <h1 class="h3 mb-2 text-gray-800">TAX</h1>
			<p class="mb-4"></p>

			<?php if ($this->session->flashdata('insert_scs')== TRUE):?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
  				<p><?php echo $this->session->flashdata('insert_scs')?></p>
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
  					</button>
			</div>
			<?php endif?>


			<?php if ($this->session->flashdata('update_scs')== TRUE):?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
  				<p><?php echo  $this->session->flashdata('update_scs')?></p>
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
  					</button>
			</div>
			<?php endif?>
			
			<?php if ($this->session->flashdata('set_active')== TRUE):?>
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
  				<p><?php echo  $this->session->flashdata('set_active')?></p>
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
  					</button>
			</div>
			<?php endif?>
			<div class="row">
				<div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Tahun</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_asumsi/percentage_pph21_year'?>" method='post' id="tax">
<?php
$year1=date('Y', strtotime("+1 year"));
$year2=date('Y', strtotime("+2 year"));
$year3=date('Y', strtotime("+3 year"));
$year4=date('Y', strtotime("+4 year"));
$year5=date('Y', strtotime("+5 year"));
$year = date('Y');
?><div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select class="form-control" name="tahunpilih" >
                                        <option value="<?php echo $year; ?>"><?PHP echo $year; ?></option>
                                        <option value="<?php echo $year1; ?>"><?PHP echo $year1; ?></option>
                                        <option value="<?php echo $year2; ?>"><?PHP echo $year2; ?></option>
                                        <option value="<?php echo $year3; ?>"><?PHP echo $year3; ?></option>
                                        <option value="<?php echo $year4; ?>"><?PHP echo $year4; ?></option>
                                        <option value="<?php echo $year5; ?>"><?PHP echo $year5; ?></option>
                                            <option></option>
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
									<h6 class="m-0 font-weight-bold text-primary">Set Active</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_asumsi/tax_active'?>" method='post' >
<?php

?><div class="form-group">
<?php $cek = $this->db->query("SELECT * FROM tax_active ");
foreach($cek->result() as $a):
$tax[] = $a->tax;
$active[]= $a->active;
endforeach;?>	

<label>Pilih Active</label>
                                        <select class="form-control" name="active" required >
																						<option></option>
																						<?php $ceka = $this->db->query("SELECT * FROM tax_active");
																						foreach($ceka->result_array() as $ac){
																							$taxa = $ac['tax'];
																							$act = $ac['active'];
																						?>
																						<option value="<?php echo $taxa;?>"><?php echo $taxa;?></option>
																						<?php } ?>
																				</select>
																				<p class="mt-4"></p>
            <div class="form-check">
							<?php if($active[0]==1){?>
	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked disabled>
							<?php }else{?>
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
							<?php } ?>
  <label class="form-check-label" for="defaultCheck1">
    <?php echo "$tax[0]";?>
  </label>
</div>
<div class="form-check">
							<?php if($active[1]==1){?>
	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked disabled>
							<?php }else{?>
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
							<?php } ?>
  <label class="form-check-label" for="defaultCheck1">
    <?php echo "$tax[1]";?>
  </label>
</div>
</div>

           <button class="btn btn-primary">Submit</button>
           </form>
                </div>
              </div>
			</div>
			
			<div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Import data</h6>
                </div>
                <div class="card-body">
								<a class = "btn btn-primary" href="<?php echo base_url('user/c_download/lakukan_download') ?>">UNDUH Template</a>
								<form action="<?php echo base_url().'user/c_asumsi/upload_tax'?>" method='post' id="uptax" enctype="multipart/form-data">
<?php

?>
<p class="mt-4"></p>
<div class="form-group">
           <label for="inputUserName" class="col-sm-4 control-label">Pilih Tahun Data</label>
                                <div class="col-sm-12">
									<select name="thn" id="" class="form-control">
									<?php
									//$yr = date('Y',strtotime("-5 year"));
									$yr1 = strtotime('2016-01-01');
									$k = 20;
									for($n=0;$n<$k;$n++){
									$yr = date('Y',strtotime("+ $n year",$yr1));
									?>
									<option value="<?php echo $yr?>"><?php echo $yr?></option>
									<?php } ?>
									</select>
								</div>
								<p class="mt-4"></p>
   <input type="file" name="file"/>
                                    </div>

           <button class="btn btn-primary">Submit</button>
           </form>
                </div>
              </div>
			</div>
 
      </div>
			
		  <div class="row">
			  <div class="col-md-8">
			  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List PPH21 </h6>
            </div>
            <div class="card-body">		
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Golongan</th>
					  <th>Pangkat</th>
					  <th>Status Pernikahan</th>
					  <th>Iuran (thn)</th>
					  <th>Iuran (bln)</th>
					  <th>Jabatan (thn)</th>
					  <th>Jabatan (bln)</th>
					  <th>Pph21 (bln)</th>
					  <th>Pph21 (thn)</th>
					  
                    </tr>
                  </thead>
                  <tfoot>

                    <tr>
					<th>Golongan</th>
					  <th>Pangkat</th>
					  <th>Status Pernikahan</th>
					  <th>Iuran (bln)</th>
					  <th>Iuran (thn)</th>
					  <th>Jabatan (bln)</th>
					  <th>Jabatan (thn)</th>
					  <th>Pph21 (bln)</th>
					  <th>Pph21 (thn)</th>
					  </tr>
					
                  </tfoot>
                  <tbody>
					<?php $no=0;
					$x = 0;
					$a = 0;
					$z = 0;
					if($data != null){
					 foreach($data as $i):
						$gol[] = $i->gol;
						$tahunA[] = $i->tahun;
						$rupiah[] = $i->rupiah;
						$rupiahbln[] = $i->rupiahbln;
						$pangkat[] =$i->pangkat;
						$statusp[] = $i->statupernikahan;
						$iuranthn[] =$i->iuran;
						$iuranbln[] = $i->iuran12;
						$jbtnthn[] = $i->jbtn;
						$jbtnbln[] = $i->jbtn12;

					 endforeach;
					} else{
						for($z=0;$z<19;$z++){
							
						$rupiah[$z] = 0;
						$rupiahbln[$z] = 0;
						$pangkat[$z] =0;
						$statusp[$z] = 0;
						$iuranthn[$z] =0;
						$iuranbln[$z] = 0;
						$jbtnthn[$z] = 0;
						$jbtnbln[$z] = 0;
						}

					 }
					?>
					<?php
					//$count1 = $data1->numw_rows();
					if($data1!=null){

						foreach($data1 as $m):
							$goln[] = $m->gol;
							$tahunAn[] = $m->tahun;
							$rupiahn[] = $m->rupiah;
							$rupiahblnn[] = $m->rupiahbln;
							$pangkatn[] =$m->pangkat;
							$statuspn[] = $m->statuspernikahan;
							$iuranthnn[] =$m->iuran;
							$iuranblnn[] = $m->iuran12;
							$jbtnthnn[] = $m->jbtn;
							$jbtnblnn[] = $m->jbtn12;
							endforeach;
						}else{
							$datac = 5;
							for($k=0;$k<19;$k++){
							$goln[$k]= '-';	
							$rupiahn[$k] = 0;
							$rupiahblnn[$k] = 0;
							$pangkatn[$k] ='-';
							$statuspn[$k] = '-';
							$iuranthnn[$k] =0;
							$iuranblnn[$k] = 0;
							$jbtnthnn[$k] = 0;
							$jbtnblnn[$k] = 0;
							}
						}


					  ?>
					  <?php
						for($x=0; $x<$datac; $x++){
						?>
                    <tr>
					  <td>Gol <?php echo $goln[$x];?></td>
					  <td><?php echo $pangkatn[$x];?></td>
					  <td><?php echo $statuspn[$x];?></td>
					  <td><?php echo  number_format($iuranblnn[$x])."<br>";?></td>
					  <td><?php echo  number_format($iuranthnn[$x])."<br>";?></td>
					  <td><?php echo  number_format($jbtnblnn[$x])."<br>";?></td>
					  <td><?php echo  number_format($jbtnthnn[$x])."<br>";?></td>
						<td><?php echo number_format($rupiahblnn[$x])."<br>"; ?></td>
						  <td><?php echo number_format($rupiahn[$x])."<br>"; ?></td>
						  

					  <?php } ?>
					</tr>
					
					

                  </tbody>
                </table>
              </div>
            </div>
          </div>
			  </div>
			  <div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Generate PPH21 (auto)</h6>
                </div>
                <div class="card-body">
								<form action="<?php echo base_url().'user/c_asumsi/pph21'?>" method='post' id="myForm">
								<img src="<?php echo base_url('asset/img/redirecting.gif');?>" alt="" style="display:none; height:auto; width:auto;" id="imgLoader">

<?php
$year1=date('Y', strtotime("+1 year"));
$year2=date('Y', strtotime("+2 year"));
$year3=date('Y', strtotime("+3 year"));
$year4=date('Y', strtotime("+4 year"));
$year5=date('Y', strtotime("+5 year"));
$year = date('Y');
?><div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select class="form-control" name="tahun" >
											<option></option>
											<?php
											$tm = strtotime('2016-01-01');
											for($n=0;$n<20;$n++){
												$time= date('Y',strtotime("+$n year",$tm));
											?>
											<option value="<?php echo $time?>"><?php echo $time?></option>
											<?php
											
											}?>
                                        </select>
                                    </div>

           <button class="btn btn-primary">Submit</button>
           </form>
                </div>
              </div>
			</div>
			
 
			</div>
			<div class="row">
			<div class="col-md-8">
			  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tax Manual</h6>
            </div>
            <div class="card-body">		
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Golongan</th>
					  <th>Sub Golongan</th>
					  <th>Status Pernikahan</th>
					  <th>Rupiah (bln)</th>
				
					  
                    </tr>
                  </thead>
                  <tfoot>

                    <tr>
					<th>Golongan</th>
					  <th>Sub Golongan</th>
					  <th>Status Pernikahan</th>
					  <th>Rupiah (bln)</th>
			
					  </tr>
					
                  </tfoot>
                  <tbody>
					<?php $no=0;
				


					  ?>
					  <?php
						foreach($datat->result_array() as $t){
						?>
                    <tr>
					  <td>Gol <?php echo $t['gol'];?></td>
					  <td><?php echo $t['sub_golongan'];?></td>
					  <td><?php echo $t['status_pernikahan'];?></td>
					  <td><?php echo  number_format($t['rupiah'])."<br>";?></td>
				
						  

					  <?php } ?>
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
  <script type="text/javascript">
$(document).ready(function(){
    $('#myForm').submit(function() {
     $('#imgLoader').show(); 
      return true;
    });
});
  </script>
  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('asset/js/demo/chart-area-demo.js');?>"></script>
  <script src="<?php echo base_url('asset/js/demo/chart-pie-demo.js');?>"></script>

  <script src="<?php echo base_url('asset/vendor/datatables/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('asset/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('asset/js/demo/datatables-demo.js');?>"></script>

</body>

</html>
