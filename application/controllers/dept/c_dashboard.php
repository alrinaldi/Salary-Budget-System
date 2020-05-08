<?php
class C_dashboard extends CI_Controller{
  function __construct(){
    parent::__construct();
    //validasi jika user belum login
		if ($this->session->userdata('nrp')=="") {
			redirect('login');
        }
  }
 
  function index(){
    $this->load->view('dept/v_dashboard');
  }

  
  public function logout() {
		$this->session->unset_userdata('nrp');
     $this->session->unset_userdata('level');
    $this->session->unset_userdata('nama');
		session_destroy();
		redirect('login');
	}
}
