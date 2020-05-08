<?php
Class C_profile extends CI_Controller{
    function __construct(){
        parent::__construct();

        //validasi jika user belum login
        if ($this->session->userdata('nrp')=="") {
                redirect('login');
      }
      $this->load->model('user/m_karyawan');
    }
    function profile(){
        $nrp = $this->session->userdata('nrp');
            $x['data'] = $this->m_karyawan->get_profile($nrp);
        $this->load->view('user/v_profilkaryawan',$x);
    }
    
}