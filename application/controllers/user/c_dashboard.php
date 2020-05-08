<?php
class C_dashboard extends CI_Controller{
  function __construct(){
    parent::__construct();
    //validasi jika user belum login
    if ($this->session->userdata('nrp')=="") {
			redirect('login');
	};
	{
		$this->load->model('user/m_chart');
	}
}
 
  function index(){
		$year = date('Y');
		$x['mp'] = $this->m_chart->chartmp($year);
    $this->load->view('user/v_dashboard',$x);
  }
  
  public function logout() {
		$this->session->unset_userdata('nrp');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('nama');
		    session_destroy();
		    redirect('login');
	}
}
