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
				
          <h1 class="h3 mb-2 text-gray-800">List User </h1>
			<p class="mb-4"></p>
			<?php if ($this->session->flashdata('success_input')== TRUE):?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
  									<p><?php echo $this->session->flashdata('success_input')?></p>
  										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
  										</button>
									</div>
								<?php endif?>
								<?php if ($this->session->flashdata('success_edit')== TRUE):?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
  									<p><?php echo $this->session->flashdata('success_edit')?></p>
  										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
  										</button>
									</div>
								<?php endif?>
								<?php if ($this->session->flashdata('succes_del')== TRUE):?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
  									<p><?php echo $this->session->flashdata('success_del')?></p>
  										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    										<span aria-hidden="true">&times;</span>
  										</button>
									</div>
								<?php endif?>

		  <div class="row">
			  <div class="col-md-12">
			  <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
			<div class="box">
            <div class="box-header">
              <a class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add Workcenter</a>
			</div>
			<br>		
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
											
					<th>Costcenter</th>
					<th>DIV</th>
                      <th>DEPT</th>
                        <th>Seksi</th>
                      <th>Cost Allocation</th>
                      <th>Pilihan</th>
                    </tr>
                  </thead>
                  <tfoot>

                    <tr>	
					<th>Costcenter</th>
					<th>DIV</th>
                      <th>DEPT</th>
                      <th>Seksi</th>
					  <th>Cost Allocation</th>
					  <th>Pilihan</th>                      
                    </tr>
                  </tfoot>
                  <tbody>
										<?php
										foreach($data->result_array() as $i):
										$costcenter = $i['costcenter'];
										$div = $i['divisi'];
										$dept = $i['dept'];
										$seksi = $i['lineSeksi'];
										$ca = $i['costAllocation'];

										?>
										<tr>
											<?php
											
											?>

											<td><?php echo$costcenter;?></td>
											<td><?php echo$div;?></td>
											<td><?php echo$dept;?></td>
											<td><?php echo$seksi;?></td>
											<td><?php echo$ca;?></td>
											<td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $costcenter;?>"><span class="fa fa-edit"></span></a>
                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $costcenter;?>"><span class="fa fa-trash"></span></a>
                  								</td>
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



    <!--Modal Add Pengguna-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Workcenter</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url('user/c_workcenter/add_wct')?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Workcenter</label>
                                <div class="col-sm-7">
                                  <input type="text" name="wct" class="form-control"  placeholder="workcenter" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Divisi</label>
                                <div class="col-sm-7">
								<select class="form-control" name="div" required>
										<?php $div = $this->db->query("SELECT DISTINCT(divisi) as divisi FROM  costcenter");
										foreach ($div->result_array() as $i):
										$divisi = $i['divisi'];
										?>											
									<option value="<?php echo $divisi; ?>"><?php echo $divisi?></option>
									<?php endforeach;?>	
								</select>	                               
								 </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Dept</label>
                                <div class="col-sm-7">
								<select class="form-control" name="dept" required>
									<?php $dept = $this->db->query("SELECT DISTINCT(dept)  as dept FROM costcenter");
									foreach ($dept->result_array() as $i):
										$departement = $i['dept'];
										?>											
									<option value="<?php echo $departement; ?>"><?php echo $departement?></option>
									<?php endforeach;?>	
							</select>	                
			                </div>
                            </div>
                      
                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Seksi</label>
                                <div class="col-sm-7">
								<input type="text" name="seksi" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="workcenter" required onkeypress='return harusHuruf(event)'>
								</div>
							</div>
							
                               <div class="form-group">
                                        <label class="col-sm-4 control-label">Cost Allocation</label>
                                        <div class="col-sm-7">
										<input type="text" name="ca" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Cost Allocation" required>
                                    </div>
                                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                    </form>
                    </div>
                    </div>
                    </div>

					<?php
										foreach($data->result_array() as $i):
											$costcenter = $i['costcenter'];
										$div = $i['divisi'];
										$dept = $i['dept'];
										$seksi = $i['lineSeksi'];
										$ca = $i['costAllocation'];

		
	?>
<!--Modal Edit Pengguna-->
<div class="modal fade" id="ModalEdit<?php echo $costcenter;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
				<h4 class="modal-title" id="myModalLabel">Edit User</h4>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('user/c_workcenter/edit_wct')?>" method="post" enctype="multipart/form-data">
			<div class="modal-body">
						
						<div class="form-group">
						<label for="inputUserName" class="col-sm-4 control-label">Costcenter</label>
						<div class="col-sm-7">
						  <input type="text" name="cc" class="form-control"  placeholder="Costcenter" value = "<?php echo $costcenter?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="inputUserName" class="col-sm-4 control-label">Divisi</label>
						<div class="col-sm-7">
						  <input type="text" name="div" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="divisi" value = "<?php echo $div?>"  required>
						</div>
					</div>

					<div class="form-group">
						<label for="inputUserName" class="col-sm-4 control-label">Dept</label>
						<div class="col-sm-7">
						  <input type="text" name="dept" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Departemen" value = "<?php echo $dept?>"  required>
						</div>
					</div>
				  
					<div class="form-group">
						<label for="inputUserName" class="col-sm-4 control-label">Seksi</label>
						<div class="col-sm-7">
						<input type="text" name="seksi" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Departemen" value = "<?php echo $seksi?>"  required>
					</div>
					</div>
					  <div class="form-group">
								<label class="col-sm-4 control-label">Cost Allocation</label>
								<div class="col-sm-7">
								<input type="text" name="ca" class="form-control" onkeyup="this.value = this.value.toUpperCase()" placeholder="Cost Allocation" value = "<?php echo $ca?>"  required>

							</div>
							</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach;?>


<?php
										foreach($data->result_array() as $i):
											$costcenter = $i['costcenter'];
										$div = $i['divisi'];
										$dept = $i['dept'];
										$seksi = $i['lineSeksi'];
										$ca = $i['costAllocation'];
			?>
   <div class="modal fade" id="ModalHapus<?php echo $costcenter;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
				<h4 class="modal-title" id="myModalLabel">Hapus Akun</h4>
			</div>
			<form class="form-horizontal" action="<?php echo base_url('user/c_workcenter/delete_wct');?>" method="post" enctype="multipart/form-data">
			<div class="modal-body">       
					<input type="hidden" name="costcenter" value="<?php echo $costcenter;?>"/> 
					<p>Apakah Anda yakin mau menghapus Costcenter <b><?php echo $costcenter;?></b> ?</p>
					   
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach;?>


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
<script>
	function harusHuruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
}
</script>
</body>

</html>
