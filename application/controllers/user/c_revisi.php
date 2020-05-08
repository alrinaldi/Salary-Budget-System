<?php
Class C_revisi extends CI_Controller{
	function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==''){
            redirect('login');
        }
        $this->load->model('user/m_overtime');
	}
	
	function list_revisi_ovt(){
		$year = date('Y');
		$month = date('F', mktime(0,0,0,1, 1, date('Y')));
		$mnth = 'JANUARY';
		$x['data'] = $this->m_overtime->list_overtime($year,$mnth);
		$x['yearr'] = $year;
		$x['monthh'] = $month;
		$this->load->view('user/v_revisi_ovt',$x);
	}
	function filter_rev_ovt(){
		$year = $this->input->post('tahun');
		$month = $this->input->post('bulan');
		$x['data'] = $this->m_overtime->list_overtime($year,$month);
		$x['yearr'] = $year;
		$x['monthh'] = $month;
		$this->load->view('user/v_revisi_ovt',$x);
	}

	function rev_dept(){
		$dept = $this->input->post('dept');
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$rev = $this->input->post('rev');
		$bd[]= 0;
		$bt[]=0;
		$cekovt = $this->db->query("SELECT * FROM overtime where dept = '$dept' and tahun = '$tahun' order by workcenter");
		$cekovtc = $cekovt->num_rows();
		foreach($cekovt->result() as $o):
			$workcenter[] = $o->workcenter;
			$jam[] = $o->jam;
			$gol[] = $o->gol;
			$budget[] = $o->budget;
		endforeach;
		$asumsiovt = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$tahun'");
		$casumsiovt = $asumsiovt->num_rows();
		foreach($asumsiovt->result() as $z):
			$gola[] = $z->gol;
			$rpa[] = $z->rupiah;
		endforeach;
		if($casumsiovt>0){
		for($x=0;$x<$cekovtc;$x++){
			if($gol[$x]==1){
			$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
			$bt[$x] = $bd[$x]*$rpa[1];
			$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
			and tahun ='$tahun'");
			}elseif($gol[$x]==2){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[2];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==3){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[3];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==4){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[4];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==0){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[0];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}
		}
		
		$this->session->set_flashdata('success_dept','Data berhasil direvisi berdasarkan Departement yang dipilih');
		redirect('user/c_revisi/list_revisi_ovt');
	}else{

		$this->session->set_flashdata('error_wct','Data gagal direvisi berdasarkan workcenter yang dipilih');
		redirect('user/c_revisi/list_revisi_ovt');
	}
	}
	function rev_wct(){
		$wct = $this->input->post('wct');
		$tahun = $this->input->post('tahun');
		$buln = $this->input->post('bulan');
		$rev = $this->input->post('rev');

		$bd[]= 0;
		$bt[]=0;
		$cekovt = $this->db->query("SELECT * FROM overtime where workcenter = '$wct' and tahun = '$tahun' order by workcenter");
		$cekovtc = $cekovt->num_rows();
		foreach($cekovt->result() as $o):
			$workcenter[] = $o->workcenter;
			$jam[] = $o->jam;
			$gol[] = $o->gol;
			$budget[] = $o->budget;
		endforeach;
		$asumsiovt = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$tahun'");
		$casumsiovt = $asumsiovt->num_rows();
		foreach($asumsiovt->result() as $z):
			$gola[] = $z->gol;
			$rpa[] = $z->rupiah;
		endforeach;
		if($casumsiovt>0){
		for($x=0;$x<$cekovtc;$x++){
			if($gol[$x]==1){
			$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
			$bt[$x] = $bd[$x]*$rpa[1];
			$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
			and tahun ='$tahun'");
			}elseif($gol[$x]==2){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[2];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==3){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[3];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==4){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[4];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==0){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[0];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}
		}
		$this->session->set_flashdata('success_wct','Data berhasil direvisi berdasarkan workcenter yang dipilih');
		redirect('user/c_revisi/list_revisi_ovt');
	}else{

		$this->session->set_flashdata('error_wct','Data gagal direvisi berdasarkan workcenter yang dipilih');
		redirect('user/c_revisi/list_revisi_ovt');
	}
	}
	function rev_all(){
		
		$tahun = $this->input->post('tahun');
		$buln = $this->input->post('bulan');
		$rev = $this->input->post('rev');

		$bd[]= 0;
		$bt[]=0;

		$cekovt = $this->db->query("SELECT * FROM overtime where tahun = '$tahun' order by workcenter");
		$cekovtc = $cekovt->num_rows();
		if($cekovtc>0){
		foreach($cekovt->result() as $o):
			$workcenter[] = $o->workcenter;
			$jam[] = $o->jam;
			$gol[] = $o->gol;
			$budget[] = $o->budget;
		endforeach;
		$asumsiovt = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$tahun'");
		$casumsiovt = $asumsiovt->num_rows();
		foreach($asumsiovt->result() as $z):
			$gola[] = $z->gol;
			$rpa[] = $z->rupiah;
		endforeach;
		for($x=0;$x<$cekovtc;$x++){
			if($gol[$x]==1){
			$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
			$bt[$x] = $bd[$x]*$rpa[1];
			$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
			and tahun ='$tahun'");
			}elseif($gol[$x]==2){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[2];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==3){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[3];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==4){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[4];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}elseif($gol[$x]==0){
				$bd[$x] = $jam[$x]*($rev/100)+$jam[$x];
				$bt[$x] = $bd[$x]*$rpa[0];
				$this->db->query("UPDATE overtime set budget = '$bt[$x]' where workcenter = '$workcenter[$x]' and gol = '$gol[$x]'
				and tahun ='$tahun'");
				
			}
		}
		$this->session->set_flashdata('all_success','Data overtime berhasil direvisi berdasarkan seluruh workcenter');
		redirect('user/c_revisi/list_revisi_ovt');
	}
	else{
		$this->session->set_flashdata('all_error','Data overtime gagal direvisi');
		redirect('user/c_revisi/list_revisi_ovt');
	}

	}
}
