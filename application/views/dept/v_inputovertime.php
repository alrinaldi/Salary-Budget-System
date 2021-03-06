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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('asset/css/sb-admin-2.css');?>" rel="stylesheet">
	<link href = 'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css' rel = "stylesheet" >
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
	 <?php
	 $this->load->view('dept/v_nav');
	 
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
          <h1 class="h3 mb-2 text-gray-800">MPP PLANING</h1>
		  <p class="mb-4"></p>
		  
		  <div class="row">
			<div class="col-xs-6 col-md-4">
				<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tahun</h6>
                </div>
                <div class="card-body">
				<form action="<?php echo base_url().'user/c_asumsi/percentage_pensionDPA_year'?>" method='post'>
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
			</div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">MPP <?php echo $thn; ?></h3>
			</div>
			
				

            <div class="card-body">
			<button class='btn btn-primary' id = "addRow" width="30%" > Tambah Data </button>
			<br>
			<br>
			<button class='btn btn-primary' id = "removeRow" width="30%"> Hapus Data </button>
			<br>	
			
              <div class="table-responsive">
                <table class="display" id="dataTable" width="100%" >
                  <thead>
                    <tr>
                    
                      <th>CostCenter</th>
                      <th>Departemen</th>
                      <th width="100%">Seksi</th>
                      <th>Gol 1</th>
                      <th>Gol 2</th>
                      <th>Gol 3</th>
                      <th>Gol 4</th>
                      <th>Gol 5</th>
					  <th>Gol 6</th>
					  <th>Kontrak</th>
					  <th>Pilih</th>
                    </tr>
                  </thead>
                  <tfoot>

                    <tr>
              
                    <th>CostCenter</th>
                      <th>Departemen</th>
                      <th width="100%">Seksi</th>
                      <th>Gol 1</th>
                      <th>Gol 2</th>
                      <th>Gol 3</th>
                      <th>Gol 4</th>
                      <th>Gol 5</th>
					  <th>Gol 6</th>
					  <th>Kontrak</th>
					  <th>Pilih</th>
                    </tr>
                  </tfoot>
                  <tbody>
				 
					
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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



  <script>
	  $(document).ready(function(){
			function get_mpp(){
				$.ajax({
					url:"<?php echo base_url()?>user/c_mpp/get_mpp",
					dataType : "JSON",
					success:function(data){
						var html = '<tr>';
		html += '<td id="workcenter" contenteditable   placeholder="Enter Workcenter"></td>';
        html += '<td id="dept" contenteditable  placeholder="Enter Dept"></td>';
		html += '<td id="seksi" contenteditable ></td>';
		html += '<td id="gol1" contenteditable "></td>';
		html += '<td id="gol2" contenteditable ></td>';
		html += '<td id="gol3" contenteditable ></td>';
		html += '<td id="gol4" contenteditable ></td>';
		html += '<td id="gol5" contenteditable ></td>';
		html += '<td id="gol6" contenteditable ></td>';
		html += '<td id="kontrak" contenteditable ></td>';
        html += '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button></td></tr>';

						for(var i=0; i < data.length; i++){
		html += '<tr>';
          html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="workcenter" contenteditable>'+data[i].workcenter+'</td>';
          html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="dept" contenteditable>'+data[i].dept+'</td>';
		  html += '<td width = "40%" class="table_data" data-row_id="'+data[i].id+'" data-column_name="seksi" contenteditable>'+data[i].seksi+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="gol1" contenteditable>'+data[i].gol1+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="gol2" contenteditable>'+data[i].gol2+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="gol3" contenteditable>'+data[i].gol3+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="gol4" contenteditable>'+data[i].gol4+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="gol5" contenteditable>'+data[i].gol5+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="gol6" contenteditable>'+data[i].gol6+'</td>';
		  html += '<td class="table_data" data-row_id="'+data[i].id+'" data-column_name="kontrak" contenteditable>'+data[i].kontrak+'</td>';
          html += '<td><button type="button" name="delete_btn" id="'+data[i].id+'" class="btn btn-xs btn-danger btn_delete"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
						}
						$('tbody').html(html);
	}
				});
			}
			get_mpp();
	$(document).on('click', '#btn_add', function(){
    var workcenter = $('#workcenter').text();
    var dept = $('#dept').text();
	var seksi = $('#seksi').text();
	var gol1 = $('#gol1').text();
	var gol2 = $('#gol2').text();
	var gol3 = $('#gol3').text();
	var gol4 = $('#gol4').text();
	var gol5 = $('#gol5').text();
	var gol6 = $('#gol6').text();
	var kontrak = $('#kontrak').text();

    if(workcenter == '')
    {
      alert('Enter Workcenter');
      return false;
    }
    if(dept == '')
    {
      alert('Enter Department');
      return false;
	}
	if(seksi == '')
    {
      alert('Enter Section');
      return false;
	}
	if(gol1 == '')
    {
      alert('Enter Gol 1');
      return false;
	}
	if(gol2 == '')
    {
      alert('Enter Gol 2');
      return false;
	}
	if(gol3 == '')
    {
      alert('Enter Gol 3');
      return false;
	}
	if(gol4 == '')
    {
      alert('Enter Gol 4');
      return false;
	}
	if(gol5 == '')
    {
      alert('Enter Gol 5');
      return false;
	}
	if(gol6 == '')
    {
      alert('Enter Gol 6');
      return false;
	}
	if(kontrak == '')
    {
      alert('Enter Kontrak');
      return false;
	}

	$.ajax({
      url:"<?php echo base_url(); ?>user/c_mpp/insert_mpp",
      method:"POST",
      data:{workcenter:workcenter, dept:dept, seksi:seksi,gol1:gol1,gol2:gol2,gol3:gol3,gol4:gol4,gol5:gol5,gol6:gol6,kontrak:kontrak},
      success:function(data){
        get_mpp();
      }
    })
  });

  $(document).on('blur', '.table_data', function(){
    var id = $(this).data('row_id');
    var table_column = $(this).data('column_name');
    var value = $(this).text();
    $.ajax({
      url:"<?php echo base_url(); ?>user/c_mpp/edit_mpp",
      method:"POST",
      data:{id:id, table_column:table_column, value:value},
      success:function(data)
      {
        get_mpp();
      }
    })
  });

  $(document).on('click', '.btn_delete', function(){
    var id = $(this).attr('id');
    if(confirm("Apa anda yakin menghapus data ini?"))
    {
      $.ajax({
        url:"<?php echo base_url(); ?>user/c_mpp/hapus_mpp",
        method:"POST",
        data:{id:id},
        success:function(data){
          get_mpp();
        }
      })
    }
  });
	  });
  </script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#dataTable').DataTable();
	});
</script>

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
