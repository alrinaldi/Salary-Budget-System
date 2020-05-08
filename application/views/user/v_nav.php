<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('user/c_dashboard');?>">
  <div class="sidebar-brand-icon rotate-n-15">
	<i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">SALARY BUDGET SYSTEM</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo base_url('user/c_dashboard');?>">
	<i class="fas fa-fw fa-tachometer-alt"></i>
	<span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Fitur
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
	<i class="fas fa-fw fa-cog"></i>
	<span>MPP & OVERTIME</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
	<div class="bg-white py-2 collapse-inner rounded">
	  <h6 class="collapse-header">List MPP dan Overtime:</h6>
	  <a class="collapse-item" href="<?php echo base_url('user/c_mpp/viewmppmaster');?>">List MPP</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_overtime/viewMasterOvertime');?>">List Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_mpp/upload_mpp');?>">Upload MPP</a>
	  <a class="collapse-item" href="cards.html">Upload Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_mpp/list_master_mpp');?>">Master MPP</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_overtime/list_master_ovt');?>">Master Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_mpp/genMPP')?>">Open MPP</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_mpp/genOvertime')?>">Open Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_mpp/trans_mpp')?>">MPP Trans</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_overtime/ovtTrans')?>">Overtime Trans</a>
	</div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
	<i class="fas fa-fw fa-wrench"></i>
	<span>Asumsi</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
	<div class="bg-white py-2 collapse-inner rounded">
	  <h6 class="collapse-header">Asumsi:</h6>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi');?>">Asumsi GP</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/gpPercentage');?>">Gaji Pokok Rata-Rata</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/gajiPokokPercentage');?>">Gaji Pokok</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/incentive');?>">Incentive</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/bonus');?>">Bonus</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/lembur');?>">Lembur</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/hadir');?>">Uang Hadir</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/transportasi')?>">Transportasi</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/meal')?>">Meal</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/holiday_allowance');?>">Holiday Allowance</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/function_a')?>">Function Allowance</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/manPowerInsurance')?>">Man Power Insurance</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/donation')?>">Donation to Employee</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/housing')?>">Housing Allowance</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/vpph21')?>">Income TAX Allowance</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/thr');?>">THR</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/medicalBpjs');?>">Medicxal Expense (BPJS)</a>
				  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/medicalObat');?>">Medical Expense (Obat)</a>
				  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/hospitalization')?>">Hospitalization</a>
				  <a class="collapse-item" href="<?PHP echo base_url('user/c_asumsi/pensionDPA');?>">Pension Allowance(DPA)</a>
				  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/pensionBPJS')?>">Pension Allowance (BPJS)</a>
				  <a class="collapse-item" href="<?php echo base_url('user/c_asumsi/telecomunication')?>">Telekomunikasi</a>

	</div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
  <i class="fas fa-stopwatch"></i>
  	<span> Generate Overtime</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
	<div class="bg-white py-2 collapse-inner rounded">
	<a class="collapse-item" href="<?php echo base_url('user/c_overtime/viewGenerateOvertime');?>">Generate Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_overtime/viewOvertime');?>">Master Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_overtime/listOvertime');?>">List Overtime</a>

	</div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages">
  <i class="fas fa-dollar-sign"></i>
  	<span>Salary</span>
  </a>
  <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
	<div class="bg-white py-2 collapse-inner rounded">
	<a class="collapse-item" href="<?php echo base_url('user/c_salary/generate_salary');?>">Generate Salary</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_salary/list_salary_thn');?>">List Salary (Tahun)</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_salary/list_salary_bln');?>">List Salary (Bulan)</a>
	</div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages12" aria-expanded="true" aria-controls="collapsePages">
  <i class="fas fa-dollar-sign"></i>
  	<span>Revisi</span>
  </a>
  <div id="collapsePages12" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
	<div class="bg-white py-2 collapse-inner rounded">
	<a class="collapse-item" href="<?php echo base_url('user/c_revisi/list_revisi_ovt');?>">Revisi Overtime</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_salary/list_salary_thn');?>">List Salary (Tahun)</a>
	  <a class="collapse-item" href="<?php echo base_url('user/c_salary/list_salary_bln');?>">List Salary (Bulan)</a>
	</div>
  </div>
</li>

<!-- Nav Item - Charts -->

<!-- Nav Item - Tables -->


<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('user/c_user');?>">
  <i class="fas fa-user-edit"></i>
  	<span>User</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('user/c_workcenter');?>">
  <i class="fas fa-industry"></i>
  	<span>Workcenter</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('user/c_dashboard/logout');?>"onclick="return confirm('Yakin akan keluar dari sistem?')">
  <i class="fas fa-sign-out-alt"></i>
  	<span>Log Out</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
