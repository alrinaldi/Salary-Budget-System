<?php

Class C_workcenter extends CI_Controller{
	function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==''){
            redirect('login');
        }
        $this->load->model('user/m_workcenter');
}

function index(){
$x['data']=$this->m_workcenter->list_wct();
$this->load->view('user/v_workcenter',$x);	
}
function add_wct(){
$wct = $this->input->post('wct');
$div = $this->input->post('div');
$dept = $this->input->post('dept');
$seksi = $this->input->post('seksi');
$ca = $this->input->post('ca');

$this->m_workcenter->add_wct($wct,$seksi,$div,$ca,$dept);
$this->session->set_flashdata('success_input','Data Workcenter baru berhasil di tambahkan');
redirect('user/c_workcenter');
}

function edit_wct(){
$wct = $this->input->post('cc');
$div = $this->input->post('div');
$dept = $this->input->post('dept');
$seksi = $this->input->post('seksi');
$ca = $this->input->post('ca');
$this->m_workcenter->edit_wct($wct,$seksi,$div,$ca,$dept);
$this->session->set_flashdata('success_edit','Data Workcenter berhasil di ubah');
redirect('user/c_workcenter');
}

function del_wct(){
$wct = $this->input->post('costcenter');
$this->m_workcenter->del_wct($wct);
$this->session->set_flashdata('success_del','Data Workcenter berhasil di hapus');
redirect('user/c_workcenter');
}
}
