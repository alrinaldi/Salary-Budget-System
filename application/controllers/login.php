<?php
Class Login extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('m_login');
    }
    
    function index(){
        $this->load->view('v_login');
    }

    public function cek_login(){
		$data = array('nrp' => $this->input->post('nrp', TRUE),
					'password' => $this->input->post('password', TRUE)
			);
		//$this->load->model('m_login'); // load model_user
		$hasil = $this->m_login->cek_user($data);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Loggin';
				$sess_data['nama'] = $sess->nama;
				$sess_data['nrp'] = $sess->nrp;
				$sess_data['level'] = $sess->level;
				$sess_data['dept'] = $sess->dept;
				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('level')=='1') {
				$this->session->set_flashdata('succes_login','Anda berhasil login');
				redirect('dept/c_dashboard');
			}
			elseif ($this->session->userdata('level')=='2') {
				$this->session->set_flashdata('succes_login','Anda berhasil login');
				redirect('user/c_dashboard');
			}		
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
    }
    

}
