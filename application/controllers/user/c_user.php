<?php
Class C_user Extends CI_Controller {
	function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==''){
            redirect('login');
        }
        $this->load->model('user/m_karyawan');
	}
	
	function index(){
		$x['data'] = $this->m_karyawan->list_user();
		$this->load->view('user/v_adm_user',$x);
	}
	function add_user(){
		$nrp = $this->input->post('nrp');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$dept = $this->input->post('dept');
		$level = $this->input->post('level');
		$this->session->set_flashdata('success_input','User berhasil di tambahkan');
		$this->m_karyawan->simpan_user($nrp,$nama,$password,$level,$dept);
		redirect('user/c_user');
	}
	function edit_user(){
		$nrp = $this->input->post('nrp');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$dept = $this->input->post('dept');
		$level = $this->input->post('leve');
		$this->session->set_flashdata('success_edit','User berhasil di ubah');
		$this->m_karyawan->edit_user($nrp,$nama,$password,$level,$dept);
		redirect('user/c_user');
	}

	function delete_user(){
		$nrp = $this->input->post('nrp');
		$this->session->set_flashdata('success_del','User berhasil di hapus');
		$this->m_karyawan->delete_user($nrp);
		echo $nrp;
		redirect('user/c_user');
	}
}
