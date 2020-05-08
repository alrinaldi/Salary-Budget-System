<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('user/c_dashboard');?>">
  <div class="sidebar-brand-icon rotate-n-15">
	<i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">E-BUDGET<sup>2</sup></div>
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
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
	<i class="fas fa-fw fa-cog"></i>
	<span>MPP & Overtime</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
	<div class="bg-white py-2 collapse-inner rounded">
	  <h6 class="collapse-header">List MPP:</h6>
	  <a class="collapse-item" href="<?php echo base_url('dept/c_mpp');?>">Master  MPP</a>
		<a class="collapse-item" href="<?php echo base_url('dept/c_mpp/list_mpp');?>">List MPP</a>
		<a class="collapse-item" href="<?php echo base_url('dept/c_overtime');?>">Master Overtime</a>
		<a class="collapse-item" href="<?php echo base_url('dept/c_overtime/list_overtime');?>">List Overtime</a>
		<a class="collapse-item" href="<?php echo base_url('dept/c_overtime/list_budget_overtime');?>">List Budget Overtime</a>		
		

	</div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->


<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('user/c_dashboard/logout');?>">
	<i class="fas fa-fw fa-chart-area"></i>
	<span>Log Out</span></a>
</li>

<!-- Nav Item - Tables -->


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
