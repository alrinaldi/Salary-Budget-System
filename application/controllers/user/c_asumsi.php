<?php
Class C_asumsi extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==''){
            redirect('login');
        }
		$this->load->model('user/m_asumsi');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

    }
    
    function index(){
        $x['data'] = $this->m_asumsi->get_asumsi();
        $this->load->view('user/v_asumsi',$x);
    }

    function percentage(){
        
        $this->load->view('user/v_asumsi_percentage');
	}
	function bonus(){
		$year = date('Y', strtotime("-1 year"));
		$year1 = date('Y');
		$x['yearC'] = $year;
		$x['yearN'] = $year1;
		$x['data'] = $this->m_asumsi->bonus_gp($year);
		$x['data1'] = $this->m_asumsi->bonus_gpN($year1);
		$this->load->view('user/v_bonus_asumsi',$x);
	}
	function percentage_bonus_year(){
	$yearN = $this->input->post('tahunpilih');
	$yearC = $yearN - 1;
		$x['yearN'] = $yearN;
		$x['yearC'] = $yearC;
		$x['data'] = $this->m_asumsi->bonus_gp($yearC);
		$x['data1'] = $this->m_asumsi->bonus_gpN($yearN);
		$this->load->view('user/v_bonus_asumsi',$x);
	}

	function percentage_gp_year(){
	$yearN = $this->input->post('tahunpilih');
	$yearC = $yearN - 1;
	$x['yearN'] = $yearN;
	$x['yearC'] = $yearC;
	$x['data'] = $this->m_asumsi->asumsi_gp($yearC);
	$x['data1'] = $this->m_asumsi->asumsi_gpN($yearN);
	$this->load->view('user/v_asumsi_gp_batch',$x);

	}

	function calculatebonus(){
		$crupiah[]=0;
	$yearC = $this->input->post('yearC');	
	$yearN = $this->input->post('yearN');
	$gol0 = $this->input->post('gol0');
	$gol1 = $this->input->post('gol1');
	$gol2 = $this->input->post('gol2');
	$gol3 = $this->input->post('gol3');
	$gol4 = $this->input->post('gol4');
	$asumsigp = $this->db->query("SELECT * FROM asumsi_gp_avg where tahun = '$yearN' ");
	$asumsicount = $asumsigp->num_rows();
	if($asumsicount > 0){
		if($asumsigp->num_rows()>0){
			foreach ($asumsigp -> result() as $data ) {
				$rupiah[] = $data->rupiah;
				# code...
			}
			$crupiah[0] = $rupiah[0]*$gol0;
			$crupiah[1] = $rupiah[1]*$gol1;
			$crupiah[2] = $rupiah[2]*$gol2;
			$crupiah[3] = $rupiah[3]*$gol3;
			$crupiah[4] = $rupiah[4]*$gol4;

			$asumsin = $this->db->query("SELECT * FROM asumsi_bonus where tahun = '$yearN'");
			$asumsincount = $asumsin->num_rows();
			$no=0;
			if($asumsincount>0){
				for($m=0; $m<$asumsincount; $m++){
					$this->db->query(" update asumsi_bonus set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
					$no++;
				}
				}else{
					for($k=0; $k<5; $k++){
						$this->db->query("INSERT INTO asumsi_bonus (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");

					}
				}
			}
				$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
				redirect('user/c_asumsi/bonus');
	}
	else
	{
					$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
				redirect('user/c_asumsi/bonus');	
	}	
	}

	function insert_bns(){
		$yr = $this->input->post('thn');
					$kontrak = $this->input->post('kontrak');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
					$gol5 = $this->input->post('gol5');
					$gol6 = $this->input->post('gol6');
			
					$cek_asumsi = $this->db->query("SELECT * FROM asumsi_bonus where tahun = '$yr' order by gol");
					foreach($cek_asumsi->result() as $f):
						$gol[] = $f->gol;
						$rupiah[] = $f->rupiah;  
					endforeach;
					$cek_asumsic = $cek_asumsi->num_rows();
					if($cek_asumsic > 0){
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$gol1' where tahun = '$yr' and gol = 1");
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$gol2' where tahun = '$yr' and gol = 2");
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$gol3' where tahun = '$yr' and gol = 3");
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$gol4' where tahun = '$yr' and gol = 4");
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$gol5' where tahun = '$yr' and gol = 5");
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$gol6' where tahun = '$yr' and gol = 6");
							$this->db->query("UPDATE asumsi_bonus set rupiah = '$kontrak' where tahun = '$yr' and gol = 0");

							
							$this->session->set_flashdata('success_update','Data Bonus berhasil diubah');
							redirect('user/c_asumsi/Bonus');
					}else{
						$this->db->query("INSERT INTO asumsi_bonus (gol,tahun,rupiah) values ('0','$yr','$kontrak'),('1','$yr','$gol1'),
						('2','$yr','$gol2'),('3','$yr','$gol3'),('4','$yr','$gol4'),('5','$yr','$gol5'),('6','$yr','$gol6')");
						$this->session->set_flashdata('success_insert','Data Bonus berhasil disimpan');
						redirect('user/c_asumsi/Bonus');
					}
	}
	
	function gpPercentage(){
		$year = date('Y', strtotime("-1 year"));
		$year1 = date('Y');
		$x['yearC'] = $year;
		$x['yearN'] = $year1;
		$x['data'] = $this->m_asumsi->asumsi_gp($year);
		$x['data1'] = $this->m_asumsi->asumsi_gpN($year1);
		$this->load->view('user/v_asumsi_gp_batch',$x);
	}
	function calculategp(){
	$crupiah[]=0;
	$yearC = $this->input->post('yearC');	
	$yearN = $this->input->post('yearN');
	$gol0 = $this->input->post('gol0');
	$gol1 = $this->input->post('gol1');
	$gol2 = $this->input->post('gol2');
	$gol3 = $this->input->post('gol3');
	$gol4 = $this->input->post('gol4');
	$asumsigp = $this->db->query("SELECT * FROM asumsi_gp_avg where tahun = '$yearC' ");
	$asumsicount = $asumsigp->num_rows();
	if($asumsicount > 0){
		if($asumsigp->num_rows()>0){
			foreach ($asumsigp -> result() as $data ) {
				$rupiah[] = $data->rupiah;
				# code...
			}
			$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
			$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
			$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
			$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
			$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);

			$asumsin = $this->db->query("SELECT * FROM asumsi_gp_avg where tahun = '$yearN'");
			$asumsincount = $asumsin->num_rows();
			$no=0;
			if($asumsincount>0){
				for($m=0; $m<$asumsincount; $m++){
					$this->db->query(" update asumsi_gp_avg set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
					$no++;
				}
				}else{
					for($k=0; $k<5; $k++){
						$this->db->query("INSERT INTO asumsi_gp_avg (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");

					}
				}
			}
			$this->session->set_flashdata('succes_gp','Data Gaji Pokok berhasi di simpan');
			redirect('user/c_asumsi/gpPercentage');

	}else
	{
		$this->session->set_flashdata('error_gp','Data Gaji Pokok tidak berhasi di simpan');
	redirect('user/c_asumsi/gpPercentage');	
	}	
	}

	function lembur(){
		$year = date('Y', strtotime("-1 year"));
		$year1 = date('Y');
		$x['yearC'] = $year;
		$x['yearN'] = $year1;
		$x['data'] = $this->m_asumsi->lembur_gp($year);
		$x['data1'] = $this->m_asumsi->lembur_gpN($year1);
		$this->load->view('user/v_asumsi_lembur',$x);
	}
	function percentage_lembur_year(){
		$yearN = $this->input->post('tahunpilih');
		$yearC = $yearN - 1;
		$x['yearN'] = $yearN;
		$x['yearC'] = $yearC;
		$x['data'] = $this->m_asumsi->lembur_gp($yearC);
		$x['data1'] = $this->m_asumsi->lembur_gpN($yearN);
		$this->load->view('user/v_asumsi_lembur',$x);
	
		}
	
		
		function calculatelembur(){
			$crupiah[]=0;
			$yearC = $this->input->post('yearC');	
			$yearN = $this->input->post('yearN');
			$gol0 = $this->input->post('gol0');
			$gol1 = $this->input->post('gol1');
			$gol2 = $this->input->post('gol2');
			$gol3 = $this->input->post('gol3');
			$gol4 = $this->input->post('gol4');
			$asumsigp = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$yearC' ");
			$asumsicount = $asumsigp->num_rows();
			if($asumsicount > 0){
				if($asumsigp->num_rows()>0){
					foreach ($asumsigp -> result() as $data ) {
						$rupiah[] = $data->rupiah;
						# code...
					}
					$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
					$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
					$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
					$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
					$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
		
					$asumsin = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$yearN'");
					$asumsincount = $asumsin->num_rows();
					$no=0;
					if($asumsincount>0){
						for($m=0; $m<$asumsincount; $m++){
							$this->db->query(" update asumsi_overtime set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
							$no++;
						}
						}else{
							for($k=0; $k<5; $k++){
								$this->db->query("INSERT INTO asumsi_overtime (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
		
							}
						}
					}
					$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
					redirect('user/c_asumsi/lembur');
				}
				else
				{
				$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
				redirect('user/c_asumsi/lembur');	
				}
			}

			function insert_ovt(){
				$yr = $this->input->post('thn');
					$kontrak = $this->input->post('kontrak');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
		
			
					$cek_asumsi = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$yr' order by gol");
					foreach($cek_asumsi->result() as $f):
						$gol[] = $f->gol;
						$rupiah[] = $f->rupiah;  
					endforeach;
					$cek_asumsic = $cek_asumsi->num_rows();
					if($cek_asumsic > 0){
							$this->db->query("UPDATE asumsi_overtime set rupiah = '$gol1' where tahun = '$yr' and gol = 1");
							$this->db->query("UPDATE asumsi_overtime set rupiah = '$gol2' where tahun = '$yr' and gol = 2");
							$this->db->query("UPDATE asumsi_overtime set rupiah = '$gol3' where tahun = '$yr' and gol = 3");
							$this->db->query("UPDATE asumsi_overtime set rupiah = '$gol4' where tahun = '$yr' and gol = 4");
							$this->db->query("UPDATE asumsi_overtime set rupiah = '$kontrak' where tahun = '$yr' and gol = 0");

							
							$this->session->set_flashdata('success_update','Data Overtime berhasil diubah');
							redirect('user/c_asumsi/lembur');
					}else{
						$this->db->query("INSERT INTO asumsi_overtime (gol,tahun,rupiah) values ('0','$yr','$kontrak'),('1','$yr','$gol1'),
						('2','$yr','$gol2'),('3','$yr','$gol3'),('4','$yr','$gol4')");
						$this->session->set_flashdata('success_insert','Data Overtime berhasil disimpan');
						redirect('user/c_asumsi/lembur');
					}
			}

			function donation(){
				$year = date('Y', strtotime("-1 year"));
				$year1 = date('Y');
				$x['yearC'] = $year;
				$x['yearN'] = $year1;
				$x['data'] = $this->m_asumsi->donation_gp($year);
				$x['data1'] = $this->m_asumsi->donation_gpN($year1);
				$this->load->view('user/v_asumsi_donation',$x);
			}
			function percentage_donation_year(){
				$yearN = $this->input->post('tahunpilih');
				$yearC = $yearN - 1;
				$x['yearN'] = $yearN;
				$x['yearC'] = $yearC;
				$x['data'] = $this->m_asumsi->donation_gp($yearC);
				$x['data1'] = $this->m_asumsi->donation_gpN($yearN);
				$this->load->view('user/v_asumsi_donation',$x);
			
				}
			
				
				function calculatedonation(){
					$crupiah[]=0;
					$yearC = $this->input->post('yearC');	
					$yearN = $this->input->post('yearN');
					$gol0 = $this->input->post('gol0');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
					$asumsigp = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$yearC' ");
					$asumsicount = $asumsigp->num_rows();
					if($asumsicount > 0){
						if($asumsigp->num_rows()>0){
							foreach ($asumsigp -> result() as $data ) {
								$rupiah[] = $data->rupiah;
								# code...
							}
							$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
							$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
							$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
							$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
							$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
				
							$asumsin = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$yearN'");
							$asumsincount = $asumsin->num_rows();
							$no=0;
							if($asumsincount>0){
								for($m=0; $m<$asumsincount; $m++){
									$this->db->query(" update asumsi_donation set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
									$no++;
								}
								}else{
									for($k=0; $k<5; $k++){
										$this->db->query("INSERT INTO asumsi_donation (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
				
									}
								}
							}
				
					}else
					{
					$this->session->set_flashdata('error_result','Data tidak dapat di hitung');
					redirect('user/c_asumsi/donation');	
					}	
					$this->session->set_flashdata('success_result','Data Berhasil di Hitung');
					redirect('user/c_asumsi/donation');
					}
		
	function insert_don(){
		$yr = $this->input->post('thn');
					$kontrak = $this->input->post('kontrak');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
					$gol5 = $this->input->post('gol5');
					$gol6 = $this->input->post('gol6');
			
					$cek_asumsi = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$yr' order by gol");
					foreach($cek_asumsi->result() as $f):
						$gol[] = $f->gol;
						$rupiah[] = $f->rupiah;  
					endforeach;
					$cek_asumsic = $cek_asumsi->num_rows();
					if($cek_asumsic > 0){
							$this->db->query("UPDATE asumsi_donation set rupiah = '$gol1' where tahun = '$yr' and gol = 1");
							$this->db->query("UPDATE asumsi_donation set rupiah = '$gol2' where tahun = '$yr' and gol = 2");
							$this->db->query("UPDATE asumsi_donation set rupiah = '$gol3' where tahun = '$yr' and gol = 3");
							$this->db->query("UPDATE asumsi_donation set rupiah = '$gol4' where tahun = '$yr' and gol = 4");
							$this->db->query("UPDATE asumsi_donation set rupiah = '$gol5' where tahun = '$yr' and gol = 5");
							$this->db->query("UPDATE asumsi_donation set rupiah = '$gol6' where tahun = '$yr' and gol = 6");
							$this->db->query("UPDATE asumsi_donation set rupiah = '$kontrak' where tahun = '$yr' and gol = 0");

							
							$this->session->set_flashdata('success_update','Data asumsi_donation berhasil diubah');
							redirect('user/c_asumsi/incentive');
					}else{
						$this->db->query("INSERT INTO asumsi_donation (gol,tahun,rupiah) values ('0','$yr','$kontrak'),('1','$yr','$gol1'),
						('2','$yr','$gol2'),('3','$yr','$gol3'),('4','$yr','$gol4'),('5','$yr','$gol5'),('6','$yr','$gol6')");
						$this->session->set_flashdata('success_insert','Data Incentive berhasil disimpan');
						redirect('user/c_asumsi/incentive');
					}
	}
		
		
	function medicalObat(){
		$year = date('Y', strtotime("-1 year"));
		$year1 = date('Y');
		$x['yearC'] = $year;
		$x['yearN'] = $year1;
		$x['data'] = $this->m_asumsi->medicalObat_gp($year);
		$x['data1'] = $this->m_asumsi->medicalObat_gpN($year1);
		$this->load->view('user/v_medical_obat',$x);
	}
	function percentage_medicalObat_year(){
		$yearN = $this->input->post('tahunpilih');
		$yearC = $yearN - 1;
		$x['yearN'] = $yearN;
		$x['yearC'] = $yearC;
		$x['data'] = $this->m_asumsi->medicalObat_gp($yearC);
		$x['data1'] = $this->m_asumsi->medicalObat_gpN($yearN);
		$this->load->view('user/v_medical_obat',$x);
	
		}

		function calculatemedicalObat(){
			$crupiah[]=0;
			$yearC = $this->input->post('yearC');	
			$yearN = $this->input->post('yearN');
			$gol0 = $this->input->post('gol0');
			$gol1 = $this->input->post('gol1');
			$gol2 = $this->input->post('gol2');
			$gol3 = $this->input->post('gol3');
			$gol4 = $this->input->post('gol4');
			$asumsigp = $this->db->query("SELECT * FROM asumsi_medical_expense_obat where tahun = '$yearC' ");
			$asumsicount = $asumsigp->num_rows();
			if($asumsicount > 0){
				if($asumsigp->num_rows()>0){
					foreach ($asumsigp -> result() as $data ) {
						$rupiah[] = $data->rupiah;
						# code...
					}
					$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
					$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
					$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
					$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
					$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
		
					$asumsin = $this->db->query("SELECT * FROM asumsi_medical_expense_obat where tahun = '$yearN'");
					$asumsincount = $asumsin->num_rows();
					$no=0;
					if($asumsincount>0){
						for($m=0; $m<$asumsincount; $m++){
							$this->db->query(" update asumsi_medical_expense_obat set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
							$no++;
						}
						}else{
							for($k=0; $k<5; $k++){
								$this->db->query("INSERT INTO asumsi_medical_expense_obat (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
		
							}
						}
					}
		
			}else
			{
			echo "kosong";	
			}	
			}

			function medicalBpjs(){
				$year = date('Y', strtotime("-1 year"));
				$year1 = date('Y');
				$x['yearC'] = $year;
				$x['yearN'] = $year1;
				$x['data'] = $this->m_asumsi->medicalBpjs_gp($year);
				$x['data1'] = $this->m_asumsi->medicalBpjs_gpN($year1);
				$this->load->view('user/v_asumsi_medical_bpjs',$x);
			}
			function percentage_medicalBpjs_year(){
				$yearN = $this->input->post('tahunpilih');
				$yearC = $yearN - 1;
				$x['yearN'] = $yearN;
				$x['yearC'] = $yearC;
				$x['data'] = $this->m_asumsi->medicalBpjs_gp($yearC);
				$x['data1'] = $this->m_asumsi->medicalBpjs_gpN($yearN);
				$this->load->view('user/v_asumsi_medical_bpjs',$x);
			
				}
		
				function calculatemedicalBpjs(){
					$crupiah[]=0;
					$yearC = $this->input->post('yearC');	
					$yearN = $this->input->post('yearN');
					$gol0 = $this->input->post('gol0');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
					$gol5 = $this->input->post('gol5');
					$gol6 = $this->input->post('gol6');
					$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' order by gol,pangkat ");
					$asumsicount = $asumsigp->num_rows();
					if($asumsicount > 0){
						if($asumsigp->num_rows()>0){
							foreach ($asumsigp -> result() as $data ) {
								$rupiah[] = $data->rupiah;
								$golp[] = $data->gol;
								$pangkatp[]=$data->pangkat;
								# code...
							}
					$crupiah[0] = $rupiah[0]*($gol0/100);
					$crupiah[1] = $rupiah[1]*($gol1/100);
					$crupiah[2] = $rupiah[2]*($gol1/100);
					$crupiah[3] = $rupiah[3]*($gol2/100);
					$crupiah[4] = $rupiah[4]*($gol2/100);
					$crupiah[5] = $rupiah[5]*($gol2/100);
					$crupiah[6] = $rupiah[6]*($gol2/100);
					$crupiah[7] = $rupiah[7]*($gol2/100);
					$crupiah[8] = $rupiah[8]*($gol3/100);
					$crupiah[9] = $rupiah[9]*($gol3/100);
					$crupiah[10] = $rupiah[10]*($gol3/100);
					$crupiah[11] = $rupiah[11]*($gol3/100);
					$crupiah[12] = $rupiah[12]*($gol3/100);
					$crupiah[13] = $rupiah[13]*($gol4/100);
					$crupiah[14] = $rupiah[14]*($gol4/100);
					$crupiah[15] = $rupiah[15]*($gol4/100);
					$crupiah[16] = $rupiah[16]*($gol4/100);
					$crupiah[17] = $rupiah[17]*($gol4/100);
					$crupiah[18] = $rupiah[18]*($gol5/100);
					$crupiah[19] = $rupiah[19]*($gol6/100);
				
							$asumsin = $this->db->query("SELECT * FROM asumsi_medical_expense_bpjs where tahun = '$yearN' order by gol,pangkat");
							$asumsincount = $asumsin->num_rows();
							$no=0;
							if($asumsincount>0){
								for($m=0; $m<$asumsincount; $m++){
									$this->db->query(" update asumsi_medical_expense_bpjs set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$golp[$m]'
									and pangkat = '$pangkatp[$m]' ");
									$no++;
								}
								}else{
									for($k=0; $k<20; $k++){
										$this->db->query("INSERT INTO asumsi_medical_expense_bpjs (gol,pangkat,tahun,rupiah) values('$golp[$k]','$pangkatp[$k]','$yearN','$crupiah[$k]') ");
				
									}
								}
							}
							$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
							redirect('user/c_asumsi/medicalBpjs');
						}
						else
						{
						$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
						redirect('user/c_asumsi/medicalBpjs');	
						}	
					}


					function thr(){
						$year = date('Y', strtotime("-1 year"));
						$year1 = date('Y');
						$x['yearC'] = $year;
						$x['yearN'] = $year1;
						$x['data'] = $this->m_asumsi->thr_gp($year);
						$x['data1'] = $this->m_asumsi->thr_gpN($year1);
						$this->load->view('user/v_asumsi_thr',$x);
					}
					function percentage_thr_year(){
						$yearN = $this->input->post('tahunpilih');
						$yearC = $yearN - 1;
						$x['yearN'] = $yearN;
						$x['yearC'] = $yearC;
						$x['data'] = $this->m_asumsi->thr_gp($yearC);
						$x['data1'] = $this->m_asumsi->thr_gpN($yearN);
						$this->load->view('user/v_asumsi_thr',$x);
					
						}
						function calculateThr(){
							$crupiah[]=0;
						$yearC = $this->input->post('yearC');	
						$yearN = $this->input->post('yearN');
						$gol0 = $this->input->post('gol0');
						$gol1 = $this->input->post('gol1');
						$gol2 = $this->input->post('gol2');
						$gol3 = $this->input->post('gol3');
						$gol4 = $this->input->post('gol4');
						$gol5 = $this->input->post('gol5');
						$gol6 = $this->input->post('gol6');

						$asumsitspt = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$yearN' order by gol");
						foreach($asumsitspt->result() as $t):
						$rpt[] = $t->rupiah;
						endforeach;
						$asumsihdr = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yearN' order by gol");
						foreach($asumsihdr->result() as $h):
							$rph[] = $h->rupiah;
						endforeach;
						$asumsimeal = $this->db->query("SELECT * FROM meal_puasa where tahun = '$yearN'");
						foreach($asumsimeal->result() as $p):
						$meal_p[] = $p->rupiah;
						endforeach;
						$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' ");
					
						$asumsicount = $asumsigp->num_rows();
						if($asumsicount > 0){
							if($asumsigp->num_rows()>0){
								foreach ($asumsigp -> result() as $data ) {
									$rupiah[] = $data->rupiah;
									$pangkatn[] = $data->pangkat;
									$goln[] = $data->gol;
									# code...
								}
								$crupiah[0] = $rupiah[0]*1;
								$crupiah[1] = $rupiah[1]*1+(($rpt[1]+$meal_p[0])*22)+$rph[1];
								$crupiah[2] = $rupiah[2]*1+(($rpt[1]+$meal_p[0])*22)+$rph[1];
								$crupiah[3] = $rupiah[3]*1+(($rpt[2]+$meal_p[0])*22)+$rph[2];
								$crupiah[4] = $rupiah[4]*1+(($rpt[2]+$meal_p[0])*22)+$rph[2];
								$crupiah[5] = $rupiah[5]*1+(($rpt[2]+$meal_p[0])*22)+$rph[2];
								$crupiah[6] = $rupiah[6]*1+(($rpt[2]+$meal_p[0])*22)+$rph[2];
								$crupiah[7] = $rupiah[7]*1+(($rpt[2]+$meal_p[0])*22)+$rph[2];	
								$crupiah[8] = $rupiah[8]*1+(($rpt[3]+$meal_p[0])*22)+$rph[3];
								$crupiah[9] = $rupiah[9]*1+(($rpt[3]+$meal_p[0])*22)+$rph[3];
								$crupiah[10] = $rupiah[10]*1+(($rpt[3]+$meal_p[0])*22)+$rph[3];
								$crupiah[11] = $rupiah[11]*1+(($rpt[3]+$meal_p[0])*22)+$rph[3];
								$crupiah[12] = $rupiah[12]*1+(($rpt[3]+$meal_p[0])*22)+$rph[3];
								$crupiah[13] = $rupiah[13]*1+(($rpt[4]+$meal_p[0])*22);
								$crupiah[14] = $rupiah[14]*1+(($rpt[4]+$meal_p[0])*22);
								$crupiah[15] = $rupiah[15]*1+(($rpt[4]+$meal_p[0])*22);
								$crupiah[16] = $rupiah[16]*1+(($rpt[4]+$meal_p[0])*22);
								$crupiah[17] = $rupiah[17]*1+(($rpt[4]+$meal_p[0])*22);
								$crupiah[18] = $rupiah[18]*1+(($rpt[5]+$meal_p[0])*22);
								$crupiah[19] = $rupiah[19]*1+(($rpt[6]+$meal_p[0])*22);

								$asumsin = $this->db->query("SELECT * FROM asumsi_thr where tahun = '$yearN' order by gol,pangkat");
								$asumsincount = $asumsin->num_rows();
								$no=0;
								if($asumsincount>0){
									for($m=0; $m<$asumsincount; $m++){
										$this->db->query(" update asumsi_thr set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$goln[$m]'
										and pangkat = '$pangkatn[$m]' ");
										$no++;
									}
									}else{
										for($k=0; $k<20; $k++){
											$this->db->query("INSERT INTO asumsi_thr (gol,pangkat,tahun,rupiah) values('$goln[$k]','$pangkatn[$k]','$yearN','$crupiah[$k]') ");
					
										}
									}
								}
								$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
										redirect('user/c_asumsi/thr');
							}
							else
							{
											$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
										redirect('user/c_asumsi/thr');	
							}	
						}
						function hadir(){
							$year = date('Y', strtotime("-1 year"));
							$year1 = date('Y');
							$x['yearC'] = $year;
							$x['yearN'] = $year1;
							$x['data'] = $this->m_asumsi->hadir_gp($year);
							$x['data1'] = $this->m_asumsi->hadir_gpN($year1);
							$this->load->view('user/v_asumsi_hadir',$x);
						}
						function percentage_hadir_year(){
							$yearN = $this->input->post('tahunpilih');
							$yearC = $yearN - 1;
							$x['yearN'] = $yearN;
							$x['yearC'] = $yearC;
							$x['data'] = $this->m_asumsi->hadir_gp($yearC);
							$x['data1'] = $this->m_asumsi->hadir_gpN($yearN);
							$this->load->view('user/v_asumsi_hadir',$x);
						
							}
					
							function calculatehadir(){
								$crupiah[]=0;
								$yearC = $this->input->post('yearC');	
								$yearN = $this->input->post('yearN');
								$gol0 = $this->input->post('gol0');
								$gol1 = $this->input->post('gol1');
								$gol2 = $this->input->post('gol2');
								$gol3 = $this->input->post('gol3');
								$gol4 = $this->input->post('gol4');
								$asumsigp = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yearC' ");
								$asumsicount = $asumsigp->num_rows();
								if($asumsicount > 0){
									if($asumsigp->num_rows()>0){
										foreach ($asumsigp -> result() as $data ) {
											$rupiah[] = $data->rupiah;
											# code...
										}
										$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
										$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
										$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
										$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
										$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
							
										$asumsin = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yearN'");
										$asumsincount = $asumsin->num_rows();
										$no=0;
										if($asumsincount>0){
											for($m=0; $m<$asumsincount; $m++){
												$this->db->query(" update asumsi_tnj_hadir set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
												$no++;
											}
											}else{
												for($k=0; $k<5; $k++){
													$this->db->query("INSERT INTO asumsi_tnj_hadir (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
							
												}
											}
										}
										$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
										redirect('user/c_asumsi/hadir');
							}
							else
							{
											$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
										redirect('user/c_asumsi/hadir');	
							}	
								}
								function insert_hdr(){
									$yr = $this->input->post('thn');
									$kontrak = $this->input->post('kontrak');
									$gol1 = $this->input->post('gol1');
									$gol2 = $this->input->post('gol2');
									$gol3 = $this->input->post('gol3');
									$gol4 = $this->input->post('gol4');
						
							
									$cek_asumsi = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yr' order by gol");
									foreach($cek_asumsi->result() as $f):
										$gol[] = $f->gol;
										$rupiah[] = $f->rupiah;  
									endforeach;
									$cek_asumsic = $cek_asumsi->num_rows();
									if($cek_asumsic > 0){
											$this->db->query("UPDATE asumsi_tnj_hadir set rupiah = '$gol1' where tahun = '$yr' and gol = 1");
											$this->db->query("UPDATE asumsi_tnj_hadir set rupiah = '$gol2' where tahun = '$yr' and gol = 2");
											$this->db->query("UPDATE asumsi_tnj_hadir set rupiah = '$gol3' where tahun = '$yr' and gol = 3");
											$this->db->query("UPDATE asumsi_tnj_hadir set rupiah = '$gol4' where tahun = '$yr' and gol = 4");
											$this->db->query("UPDATE asumsi_tnj_hadir set rupiah = '$kontrak' where tahun = '$yr' and gol = 0");
				
											
											$this->session->set_flashdata('success_update','Data Tunj Hadir berhasil diubah');
											redirect('user/c_asumsi/hadir');
									}else{
										$this->db->query("INSERT INTO asumsi_tnj_hadir (gol,tahun,rupiah) values ('0','$yr','$kontrak'),('1','$yr','$gol1'),
										('2','$yr','$gol2'),('3','$yr','$gol3'),('4','$yr','$gol4')");
										$this->session->set_flashdata('success_insert','Data Tunj Hadir berhasil disimpan');
										redirect('user/c_asumsi/hadir');
									}
								}
		
								function holiday_allowance(){
									$year = date('Y', strtotime("-1 year"));
									$year1 = date('Y');
									$x['yearC'] = $year;
									$x['yearN'] = $year1;
									$x['data'] = $this->m_asumsi->holiday_gp($year);
									$x['data1'] = $this->m_asumsi->holiday_gpN($year1);
									$this->load->view('user/v_asumsi_holiday_allowance',$x);
								}
								function percentage_holiday_year(){
									$yearN = $this->input->post('tahunpilih');
									$yearC = $yearN - 1;
									$x['yearN'] = $yearN;
									$x['yearC'] = $yearC;
									$x['data'] = $this->m_asumsi->holiday_gp($yearC);
									$x['data1'] = $this->m_asumsi->holiday_gpN($yearN);
									$this->load->view('user/v_asumsi_holiday_allowance',$x);
									}
							
									function calculateholiday(){
										$crupiah[]=0;
										$yearC = $this->input->post('yearC');	
										$yearN = $this->input->post('tahunpilih');
										$gol0 = $this->input->post('gol0');
										$gol1 = $this->input->post('gol1');
										$gol2 = $this->input->post('gol2');
										$gol3 = $this->input->post('gol3');
										$gol4 = $this->input->post('gol4');
										$asumsigpk = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' order by gol,pangkat");
										$asumsihdr = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yearN' order by gol");
									
										$asumsimeal = $this->db->query("SELECT * FROM meal where tahun = '$yearN'");
										$asumsitspt = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$yearN'");
										 $asumsihdrc = $asumsihdr->num_rows();
										$asumsigpkc = $asumsigpk->num_rows();
										$asumsimealc = $asumsimeal->num_rows();
										$asumsitsptc = $asumsitspt->num_rows();
										foreach($asumsihdr->result() as $v):
											$golhdr[]=$v->gol;
											$rphdr[] = $v->rupiah;  
										endforeach;
										foreach($asumsimeal->result() as $l):
											$rpmeal[] = $l->rupiah;
										endforeach;
										foreach($asumsitspt->result() as $t):
										$rptspt[]=$t->rupiah;
										endforeach;
										$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' ");
										$asumsicount = $asumsigp->num_rows();
										if($asumsicount > 0 && $asumsihdrc > 0 && $asumsimealc > 0 && $asumsitsptc > 0){
											$asumsihdy = $this->db->query("SELECT * FROM asumsi_holiday_allowance where tahun = '$yearN'");
											$asumsihdyc = $asumsihdy->num_rows();
											if($asumsihdyc == 0){	
											$j=0;
											$tot[]=0;
												foreach($asumsigpk->result_array() as $gpk):
												 $gol[$j] = $gpk['gol'];
												 $pangkat[$j] = $gpk['pangkat'];
												 $rupiah[$j] = $gpk['rupiah'];	
												

												if($gol[$j]==1 && $pangkat[$j]=='e'){
												 $gol[$j];
												$tot[$j]= ($rupiah[$j]+$rphdr[0])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");
												}elseif($gol[$j]==2 && $pangkat[$j]=='a'){
													$tot[$j]= ($rupiah[$j]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");
												}elseif($gol[$j]==2 && $pangkat[$j]=='b'){
													
													$tot[$j]= ($rupiah[$j]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==2 && $pangkat[$j]=='c'){
														
													$tot[$j]= ($rupiah[$j]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==2 && $pangkat[$j]=='d'){
													
													$tot[$j]= ($rupiah[$j]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==2 && $pangkat[$j]=='e'){
													
													$tot[$j]= ($rupiah[$j]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==3 && $pangkat[$j]=='a'){
													
													$tot[$j]= ($rupiah[$j]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==3 && $pangkat[$j]=='b'){
													$tot[$j]= ($rupiah[$j]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==3 && $pangkat[$j]=='c'){
													$tot[$j]= ($rupiah[$j]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==3 && $pangkat[$j]=='d'){
													$tot[$j]= ($rupiah[$j]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==3 && $pangkat[$j]=='e'){
													$tot[$j]= ($rupiah[$j]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==4 && $pangkat[$j]=='a'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==4 && $pangkat[$j]=='b'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==4 && $pangkat[$j]=='c'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");
															
												}elseif($gol[$j]==4 && $pangkat[$j]=='d'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==4 && $pangkat[$j]=='e'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==5 && $pangkat[$j]=='a'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==5 && $pangkat[$j]=='b'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==5 && $pangkat[$j]=='c'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==5 && $pangkat[$j]=='d'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==5 && $pangkat[$j]=='e'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==6 && $pangkat[$j]=='a'){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}elseif($gol[$j]==0 ){
													$tot[$j]= ($rupiah[$j]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("INSERT INTO asumsi_holiday_allowance (gol,pangkat,rupiah,tahun)
													values ('$gol[$j]','$pangkat[$j]','$tot[$j]','$yearN')");

												}else{

												}
												$j++;
												endforeach;
											
												
												$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
											redirect('user/c_asumsi/holiday_allowance');
											}else{
												$tot[]=0;
												$d=0;
												foreach($asumsigpk->result() as $dc){
												$gol[] = $dc->gol;
													$pangkat[] = $dc->pangkat;
													$rupiah[] = $dc->rupiah;
												}
												for($d=0;$d<$asumsigpkc;$d++){
												if($gol[$d]==0 ){
												echo $tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]'");
													echo "</br>";
												}	
												if($gol[$d]==1 && $pangkat[$d]=='e'){
												echo $tot[$d]= ($rupiah[$d]+$rphdr[0])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");
												}elseif($gol[$d]==2 && $pangkat[$d]=='a'){
													$tot[$d]= ($rupiah[$d]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==2 && $pangkat[$d]=='b'){
													
													$tot[$d]= ($rupiah[$d]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==2 && $pangkat[$d]=='c'){
														
													$tot[$d]= ($rupiah[$d]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==2 && $pangkat[$d]=='d'){
													
													$tot[$d]= ($rupiah[$d]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==2 && $pangkat[$d]=='e'){
													
													$tot[$d]= ($rupiah[$d]+$rphdr[1])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==3 && $pangkat[$d]=='a'){
													
													$tot[$d]= ($rupiah[$d]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==3 && $pangkat[$d]=='b'){
													$tot[$d]= ($rupiah[$d]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==3 && $pangkat[$d]=='c'){
													$tot[$d]= ($rupiah[$d]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==3 && $pangkat[$d]=='d'){
													$tot[$d]= ($rupiah[$d]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==3 && $pangkat[$d]=='e'){
													$tot[$d]= ($rupiah[$d]+$rphdr[2])+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==4 && $pangkat[$d]=='a'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==4 && $pangkat[$d]=='b'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==4 && $pangkat[$d]=='c'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");
		
												}elseif($gol[$d]==4 && $pangkat[$d]=='d'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==4 && $pangkat[$d]=='e'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==5 && $pangkat[$d]=='a'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==5 && $pangkat[$d]=='b'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==5 && $pangkat[$d]=='c'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==5 && $pangkat[$d]=='d'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==5 && $pangkat[$d]=='e'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}elseif($gol[$d]==6 && $pangkat[$d]=='a'){
													$tot[$d]= ($rupiah[$d]+0)+(22*($rpmeal[0]+$rptspt[0]));
													$this->db->query("UPDATE asumsi_holiday_allowance set rupiah = '$tot[$d]' where tahun = '$yearN' and gol = '$gol[$d]' and pangkat = '$pangkat[$d]'");

												}
											}
											
												
												$this->session->set_flashdata('update_scs','Data berhasil diperbaharui');
												//redirect('user/c_asumsi/holiday_allowance');
											}
											}
									else
									{
													$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui, cek kembali data asumsi 
													(gaji pokok,transport,meal,tunjangan uang hadir');
												redirect('user/c_asumsi/holiday_allowance');	
									}
										}
										function incentive(){
											$year = date('Y', strtotime("-1 year"));
											$year1 = date('Y');
											$x['yearC'] = $year;
											$x['yearN'] = $year1;
											$x['data'] = $this->m_asumsi->incentive_gp($year);
											$x['data1'] = $this->m_asumsi->incentive_gpN($year1);
											$this->load->view('user/v_asumsi_incentive',$x);
										}
										function percentage_incentive_year(){
											$yearN = $this->input->post('tahunpilih');
											$yearC = $yearN - 1;
											$x['yearN'] = $yearN;
											$x['yearC'] = $yearC;
											$x['data'] = $this->m_asumsi->incentive_gp($yearC);
											$x['data1'] = $this->m_asumsi->incentive_gpN($yearN);
											$this->load->view('user/v_asumsi_incentive',$x);
										
											}
									
											function calculateincentive(){
												$crupiah[]=0;
												$yearC = $this->input->post('yearC');	
												$yearN = $this->input->post('yearN');
												$gol0 = $this->input->post('gol0');
												$gol1 = $this->input->post('gol1');
												$gol2 = $this->input->post('gol2');
												$gol3 = $this->input->post('gol3');
												$gol4 = $this->input->post('gol4');
												$asumsigp = $this->db->query("SELECT * FROM asumsi_incentive where tahun = '$yearC' ");
												$asumsicount = $asumsigp->num_rows();
												if($asumsicount > 0){
													if($asumsigp->num_rows()>0){
														foreach ($asumsigp -> result() as $data ) {
															$rupiah[] = $data->rupiah;
															# code...
														}
														$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
														$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
														$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
														$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
														$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
											
														$asumsin = $this->db->query("SELECT * FROM asumsi_incentive where tahun = '$yearN'");
														$asumsincount = $asumsin->num_rows();
														$no=0;
														if($asumsincount>0){
															for($m=0; $m<$asumsincount; $m++){
																$this->db->query(" update asumsi_incentive set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
																$no++;
															}
															}else{
																for($k=0; $k<5; $k++){
																	$this->db->query("INSERT INTO asumsi_incentive (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
											
																}
															}
														}
														$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
														redirect('user/c_asumsi/incentive');
											}
											else
											{
															$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
														redirect('user/c_asumsi/incentive');	
											}
												}

												function insert_inc(){
					$yr = $this->input->post('thn');
					$kontrak = $this->input->post('kontrak');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
					$gol5 = $this->input->post('gol5');
					$gol6 = $this->input->post('gol6');
			
					$cek_asumsi = $this->db->query("SELECT * FROM asumsi_incentive where tahun = '$yr' order by gol");
					foreach($cek_asumsi->result() as $f):
						$gol[] = $f->gol;
						$rupiah[] = $f->rupiah;  
					endforeach;
					$cek_asumsic = $cek_asumsi->num_rows();
					if($cek_asumsic > 0){
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$gol1' where tahun = '$yr' and gol = 1");
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$gol2' where tahun = '$yr' and gol = 2");
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$gol3' where tahun = '$yr' and gol = 3");
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$gol4' where tahun = '$yr' and gol = 4");
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$gol5' where tahun = '$yr' and gol = 5");
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$gol6' where tahun = '$yr' and gol = 6");
							$this->db->query("UPDATE asumsi_incentive set rupiah = '$kontrak' where tahun = '$yr' and gol = 0");

							
							$this->session->set_flashdata('success_update','Data Incentive berhasil diubah');
							redirect('user/c_asumsi/incentive');
					}else{
						$this->db->query("INSERT INTO asumsi_incentive (gol,tahun,rupiah) values ('0','$yr','$kontrak'),('1','$yr','$gol1'),
						('2','$yr','$gol2'),('3','$yr','$gol3'),('4','$yr','$gol4'),('5','$yr','$gol5'),('6','$yr','$gol6')");
						$this->session->set_flashdata('success_insert','Data Incentive berhasil disimpan');
						redirect('user/c_asumsi/incentive');
					}
				}
												
													function manPowerInsurance(){
													$year = date('Y', strtotime("-1 year"));
													$year1 = date('Y');
													$x['yearC'] = $year;
													$x['yearN'] = $year1;
													$x['data'] = $this->m_asumsi->manpowerinsurance_gp($year);
													$x['data1'] = $this->m_asumsi->manpowerinsurance_gpN($year1);
													$this->load->view('user/v_asumsi_manpower_insurance',$x);
												}
												function percentage_manpower_year(){
													$yearN = $this->input->post('tahunpilih');
													$yearC = $yearN - 1;
													$x['yearN'] = $yearN;
													$x['yearC'] = $yearC;
													$x['data'] = $this->m_asumsi->manpowerinsurance_gp($yearC);
													$x['data1'] = $this->m_asumsi->manpowerinsurance_gpN($yearN);
													$this->load->view('user/v_asumsi_manpower_insurance',$x);
												
													}
											
													function calculatemanpowerInsurance(){
														$crupiah[]=0;
														$yearC = $this->input->post('yearC');	
														$yearN = $this->input->post('yearN');
														$gol0 = $this->input->post('gol0');
														$gol1 = $this->input->post('gol1');
														$gol2 = $this->input->post('gol2');
														$gol3 = $this->input->post('gol3');
														$gol4 = $this->input->post('gol4');
														$gol5 = $this->input->post('gol5');
														$gol6 = $this->input->post('gol6');
														
														$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' ORDER BY GOL,PANGKAT ");
														$asumsicount = $asumsigp->num_rows();
														if($asumsicount > 0){
															if($asumsigp->num_rows()>0){
																foreach ($asumsigp -> result() as $data ) {
																	$rupiah[] = $data->rupiah;
																	$pangkatp[] = $data->pangkat;
																	$golp[] = $data->gol; 
																	# code...
																}
																$crupiah[0] = $rupiah[0]*($gol0/100);
																$crupiah[1] = $rupiah[1]*($gol1/100);
																$crupiah[2] = $rupiah[2]*($gol1/100);
																$crupiah[3] = $rupiah[3]*($gol2/100);
																$crupiah[4] = $rupiah[4]*($gol2/100);
																$crupiah[5] = $rupiah[5]*($gol2/100);
																$crupiah[6] = $rupiah[6]*($gol2/100);
																$crupiah[7] = $rupiah[7]*($gol2/100);
																$crupiah[8] = $rupiah[8]*($gol3/100);
																$crupiah[9] = $rupiah[9]*($gol3/100);
																$crupiah[10] = $rupiah[10]*($gol3/100);
																$crupiah[11] = $rupiah[11]*($gol3/100);
																$crupiah[12] = $rupiah[12]*($gol3/100);
																$crupiah[13] = $rupiah[13]*($gol4/100);
																$crupiah[14] = $rupiah[14]*($gol4/100);
																$crupiah[15] = $rupiah[15]*($gol4/100);
																$crupiah[16] = $rupiah[16]*($gol4/100);
																$crupiah[17] = $rupiah[17]*($gol4/100);
																$crupiah[18] = $rupiah[18]*($gol5/100);
																$crupiah[19] = $rupiah[19]*($gol6/100);
																$asumsin = $this->db->query("SELECT * FROM asumsi_manpowerinsurance where tahun = '$yearN' order by gol,pangkat");
																$asumsincount = $asumsin->num_rows();
																$no=0;
																if($asumsincount>0){
																	for($m=0; $m<$asumsincount; $m++){
																		$this->db->query(" update asumsi_manpowerinsurance set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$golp[$m]'
																		and pangkat = '$pangkatp[$m]' ");
																		$no++;
																	}
																	}else{
																		for($k=0; $k<20; $k++){
																			$this->db->query("INSERT INTO asumsi_manpowerinsurance (gol,pangkat,tahun,rupiah) values('$golp[$k]','$pangkatp[$k]','$yearN','$crupiah[$k]') ");
													
																		}
																	}
																}
																$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
																redirect('user/c_asumsi/manPowerInsurance');
															}
															else
															{
															$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
															redirect('user/c_asumsi/manPowerInsurance');	
															}
														}
			function pensionDPA(){
			$year = date('Y', strtotime("-1 year"));
			$year1 = date('Y');
			$x['yearC'] = $year;
			$x['yearN'] = $year1;
			$x['data'] = $this->m_asumsi->pensionDPA_gp($year);
			$x['data1'] = $this->m_asumsi->pensionDPA_gpN($year1);
			$this->load->view('user/v_asumsi_pensionDPA',$x);
			}
			function percentage_pensionDPA_year(){
			$yearN = $this->input->post('tahunpilih');
			$yearC = $yearN - 1;
			$x['yearN'] = $yearN;
			$x['yearC'] = $yearC;
			$x['data'] = $this->m_asumsi->pensionDPA_gp($yearC);
			$x['data1'] = $this->m_asumsi->pensionDPA_gpN($yearN);
			$this->load->view('user/v_asumsi_pensionDPA',$x);
			}
													
			function calculatepensionDPA(){
			$crupiah[]=0;
			$yearC = $this->input->post('yearC');	
			$yearN = $this->input->post('yearN');
			$gol0 = $this->input->post('gol0');
			$gol1 = $this->input->post('gol1');
			$gol2 = $this->input->post('gol2');
			$gol3 = $this->input->post('gol3');
			$gol4 = $this->input->post('gol4');
			$gol5 = $this->input->post('gol5');
			$gol6 = $this->input->post('gol6');
			$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' ORDER BY GOL,PANGKAT ");
			$asumsicount = $asumsigp->num_rows();
			if($asumsicount > 0){
			if($asumsigp->num_rows()>0){
			foreach ($asumsigp -> result() as $data ) {
			$rupiah[] = $data->rupiah;
			$golp[] = $data->gol;
			$pangkatp[] = $data->pangkat;
			# code...
			}
					$crupiah[0] = $rupiah[0]*($gol0/100);
					$crupiah[1] = $rupiah[1]*($gol1/100);
					$crupiah[2] = $rupiah[2]*($gol1/100);
					$crupiah[3] = $rupiah[3]*($gol2/100);
					$crupiah[4] = $rupiah[4]*($gol2/100);
					$crupiah[5] = $rupiah[5]*($gol2/100);
					$crupiah[6] = $rupiah[6]*($gol2/100);
					$crupiah[7] = $rupiah[7]*($gol2/100);
					$crupiah[8] = $rupiah[8]*($gol3/100);
					$crupiah[9] = $rupiah[9]*($gol3/100);
					$crupiah[10] = $rupiah[10]*($gol3/100);
					$crupiah[11] = $rupiah[11]*($gol3/100);
					$crupiah[12] = $rupiah[12]*($gol3/100);
					$crupiah[13] = $rupiah[13]*($gol4/100);
					$crupiah[14] = $rupiah[14]*($gol4/100);
					$crupiah[15] = $rupiah[15]*($gol4/100);
					$crupiah[16] = $rupiah[16]*($gol4/100);
					$crupiah[17] = $rupiah[17]*($gol4/100);
					$crupiah[18] = $rupiah[18]*($gol5/100);
					$crupiah[19] = $rupiah[19]*($gol6/100);
			
			$asumsin = $this->db->query("SELECT * FROM asumsi_pensionDPA where tahun = '$yearN' order by gol,pangkat");
			$asumsincount = $asumsin->num_rows();
			$no=0;
			if($asumsincount>0){
			for($m=0; $m<$asumsincount; $m++){
			$this->db->query(" update asumsi_pensionDPA set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$golp[$m]'
			and pangkat = '$pangkatp[$m]' ");
			$no++;
			}
			}else{
			for($k=0; $k<20; $k++){
			$this->db->query("INSERT INTO asumsi_pensionDPA (gol,pangkat,tahun,rupiah) values('$golp[$k]','$pangkatp[$k]','$yearN','$crupiah[$k]') ");
			}
				}
					}
					$this->session->set_flashdata('succes_pensionDPA','Data Pensiun berhasi tersimpan');
					redirect('user/c_asumsi/pensionDPA');
				}else
			{
				$this->session->set_flashdata('failed_pensionDPA','Data Pension tahun'  + $yearN+ 'tidak tersimpan');
			redirect('user/c_asumsi/pensionDPA');
			}	
				}

				function pensionBPJS(){
					$year = date('Y', strtotime("-1 year"));
					$year1 = date('Y');
					$x['yearC'] = $year;
					$x['yearN'] = $year1;
					$x['data'] = $this->m_asumsi->pensionBPJS_gp($year);
					$x['data1'] = $this->m_asumsi->pensionBPJS_gpN($year1);
					$this->load->view('user/v_asumsi_pensionbpjs',$x);
					}
					function percentage_pensionBPJS_year(){
					$yearN = $this->input->post('tahunpilih');
					$yearC = $yearN - 1;
					$x['yearN'] = $yearN;
					$x['yearC'] = $yearC;
					$x['data'] = $this->m_asumsi->pensionBPJS_gp($yearC);
					$x['data1'] = $this->m_asumsi->pensionBPJS_gpN($yearN);
					$this->load->view('user/v_asumsi_pensionbpjs',$x);
					}
															
					function calculatepensionBPJS(){
					$crupiah[]=0;
					$yearC = $this->input->post('yearC');	
					$yearN = $this->input->post('yearN');
					$gol0 = $this->input->post('gol0');
					$gol1 = $this->input->post('gol1');
					$gol2 = $this->input->post('gol2');
					$gol3 = $this->input->post('gol3');
					$gol4 = $this->input->post('gol4');
					$gol5 = $this->input->post('gol5');
					$gol6 = $this->input->post('gol6');
					$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' ORDER BY GOL,PANGKAT ");
					$asumsicount = $asumsigp->num_rows();
					if($asumsicount > 0){
					if($asumsigp->num_rows()>0){
					foreach ($asumsigp -> result() as $data ) {
					$rupiah[] = $data->rupiah;
					$pangkatp[] = $data->pangkat;
					$golp[] = $data->gol;
					# code...
					}
					$crupiah[0] = $rupiah[0]*($gol0/100);
					$crupiah[1] = $rupiah[1]*($gol1/100);
					$crupiah[2] = $rupiah[2]*($gol1/100);
					$crupiah[3] = $rupiah[3]*($gol2/100);
					$crupiah[4] = $rupiah[4]*($gol2/100);
					$crupiah[5] = $rupiah[5]*($gol2/100);
					$crupiah[6] = $rupiah[6]*($gol2/100);
					$crupiah[7] = $rupiah[7]*($gol2/100);
					$crupiah[8] = $rupiah[8]*($gol3/100);
					$crupiah[9] = $rupiah[9]*($gol3/100);
					$crupiah[10] = $rupiah[10]*($gol3/100);
					$crupiah[11] = $rupiah[11]*($gol3/100);
					$crupiah[12] = $rupiah[12]*($gol3/100);
					$crupiah[13] = $rupiah[13]*($gol4/100);
					$crupiah[14] = $rupiah[14]*($gol4/100);
					$crupiah[15] = $rupiah[15]*($gol4/100);
					$crupiah[16] = $rupiah[16]*($gol4/100);
					$crupiah[17] = $rupiah[17]*($gol4/100);
					$crupiah[18] = $rupiah[18]*($gol5/100);
					$crupiah[19] = $rupiah[19]*($gol6/100);
					
					$asumsin = $this->db->query("SELECT * FROM asumsi_pensionBPJS where tahun = '$yearN'");
					$asumsincount = $asumsin->num_rows();
					$no=0;
					if($asumsincount>0){
					for($m=0; $m<$asumsincount; $m++){
					$this->db->query(" update asumsi_pensionBPJS set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$golp[$m]'
					and = '$pangkatp[$m]' ");
					$no++;
					}
					}else{
					for($k=0; $k<20; $k++){
					$this->db->query("INSERT INTO asumsi_pensionBPJS (gol,pangkat,tahun,rupiah) values('$golp[$k]','$pangkatp[$k]','$yearN','$crupiah[$k]') ");
					}
						}
							}
							$this->session->set_flashdata('succes_pensionDPA','Data Pensiun berhasi tersimpan');
							redirect('user/c_asumsi/pensionBPJS');
						}else
					{
						$this->session->set_flashdata('failed_pensionDPA','Data Pension tahun'  + $yearN+ 'tidak tersimpan');
					redirect('user/c_asumsi/pensionBPJS');
					}	
						}
		

				function gajiPokokPercentage(){
					$year = date('Y', strtotime("-1 year"));
					$year1 = date('Y');
					$x['yearC'] = $year;
					$x['yearN'] = $year1;
					$x['data'] = $this->m_asumsi->asumsi_gaji($year);
					$x['data1'] = $this->m_asumsi->asumsi_gajiN($year1);
					$this->load->view('user/v_asumsi_gaji_pokok',$x);
				}
				function percentage_gajip_year(){
					$yearN = $this->input->post('tahunpilih');
					$yearC = $yearN - 1;
					$x['yearN'] = $yearN;
					$x['yearC'] = $yearC;
					$x['data'] = $this->m_asumsi->asumsi_gaji($yearC);
					$x['data1'] = $this->m_asumsi->asumsi_gajiN($yearN);
					$this->load->view('user/v_asumsi_gaji_pokok',$x);
				}
				function calculateGajiPokok(){
				$crupiah[]=0;
				$z=0;
				$yearC = $this->input->post('yearC');	
				$yearN = $this->input->post('yearN');
				$gol0 = $this->input->post('gol0');
				$gol1 = $this->input->post('gol1');
				$gol2 = $this->input->post('gol2');
				$gol3 = $this->input->post('gol3');
				$gol4 = $this->input->post('gol4');
				$gol5 = $this->input->post('gol5');
				$gol6 = $this->input->post('gol6');
				$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearC' order by gol,pangkat ");
				$asumsicount = $asumsigp->num_rows();
				if($asumsicount > 0){
					if($asumsigp->num_rows()>0){
						foreach ($asumsigp -> result() as $data ) {
							$rupiah[] = $data->rupiah;
							$gol[] = $data->gol;
							$pangkat[] = $data->pangkat;
							# code...
							if($gol[$z]=='0'){
								$crupiah[$z] = $rupiah[$z]+(($gol0/100)*$rupiah[$z]);
							}elseif($gol[$z]=='1'){
								$crupiah[$z] = $rupiah[$z]+(($gol1/100)*$rupiah[$z]);								
							}elseif($gol[$z]=='2'){
								$crupiah[$z] = $rupiah[$z]+(($gol2/100)*$rupiah[$z]);																
							}elseif($gol[$z]=='3'){
								$crupiah[$z] = $rupiah[$z]+(($gol3/100)*$rupiah[$z]);								
							}elseif($gol[$z]=='4'){
								$crupiah[$z] = $rupiah[$z]+(($gol4/100)*$rupiah[$z]);								
							}elseif($gol[$z]=='5'){
								$crupiah[$z] = $rupiah[$z]+(($gol5/100)*$rupiah[$z]);								
							}elseif($gol[$z]=='6'){
								$crupiah[$z] = $rupiah[$z]+(($gol6/100)*$rupiah[$z]);
							}
							$z++;
						}
						$asumsin = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yearN' order by gol,pangkat");
						$asumsincount = $asumsin->num_rows();
						$no=0;
						if($asumsincount>0){
							for($m=0; $m<$asumsincount; $m++){
								$this->db->query(" update asumsi_gaji_pokok set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$gol[$no]' and pangkat = '$pangkat[$no]' ");
								$no++;
							}
							}else{
								for($k=0; $k<19; $k++){
									$this->db->query("INSERT INTO asumsi_gaji_pokok (gol,tahun,rupiah,pangkat) values('$gol[$k]','$yearN','$crupiah[$k]','$pangkat[$k]') ");
			
								}
							}
						}
			
						$this->session->set_flashdata('succes_gp_p','Data Gaji Pokok berhasi di simpan');
						redirect('user/c_asumsi/gajiPokokPercentage');
				}else
				{
					$this->session->set_flashdata('error_gp_p','Data Gaji Pokok tidak berhasi di simpan');
					redirect('user/c_asumsi/gajiPokokPercentage');
						}	
				}

				function insert_gp(){
					$yr = $this->input->post('thn');
					$gol0 = $this->input->post('kontrak');
					$gol1e = $this->input->post('gol1e');
					$gol1f = $this->input->post('gol1f');
					$gol2a = $this->input->post('gol2a');
					$gol2b = $this->input->post('gol2b');
					$gol2c = $this->input->post('gol2c');
					$gol2d = $this->input->post('gol2d');
					$gol2e = $this->input->post('gol2e');
					$gol3a = $this->input->post('gol3a');
					$gol3b = $this->input->post('gol3b');
					$gol3c = $this->input->post('gol3c');
					$gol3d = $this->input->post('gol3d');
					$gol3e = $this->input->post('gol3e');
					$gol4a = $this->input->post('gol4a');
					$gol4b = $this->input->post('gol4b');
					$gol4c = $this->input->post('gol4c');
					$gol4d = $this->input->post('gol4d');
					$gol4e = $this->input->post('gol4e');
					$gol5a = $this->input->post('gol5a');
					$gol6a = $this->input->post('gol6a');

					$cek_asumsi = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yr' order by gol,pangkat");
					foreach($cek_asumsi->result() as $f):
						$gol[] = $f->gol;
						$rupiah[] = $f->rupiah;  
					endforeach;
					$cek_asumsic = $cek_asumsi->num_rows();
					if($cek_asumsic > 0){
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol1e' where tahun = '$yr' and gol = 1 and pangkat = e");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol1f' where tahun = '$yr' and gol = 1 and pangkat = f");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol2a' where tahun = '$yr' and gol = 2 and pangkat = a");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol2b' where tahun = '$yr' and gol = 2 and pangkat = b");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol2c' where tahun = '$yr' and gol = 2 and pangkat = c");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol2d' where tahun = '$yr' and gol = 2 and pangkat = d");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol2e' where tahun = '$yr' and gol = 2 and pangkat = e");
							
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol3a' where tahun = '$yr' and gol = 3 and pangkat = a");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol3b' where tahun = '$yr' and gol = 3 and pangkat = b");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol3c' where tahun = '$yr' and gol = 3 and pangkat = c");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol3d' where tahun = '$yr' and gol = 3 and pangkat = d");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol3e' where tahun = '$yr' and gol = 3 and pangkat = e");
							
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol4a' where tahun = '$yr' and gol = 4 and pangkat = a");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol4b' where tahun = '$yr' and gol = 4 and pangkat = b");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol4c' where tahun = '$yr' and gol = 4 and pangkat = c");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol4d' where tahun = '$yr' and gol = 4 and pangkat = d");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol4e' where tahun = '$yr' and gol = 4 and pangkat = e");
		
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol5a' where tahun = '$yr' and gol = 5 and pangkat = a");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol6a' where tahun = '$yr' and gol = 6 and pangkat = a");
							$this->db->query("UPDATE asumsi_gaji_pokok set rupiah = '$gol0' where tahun = '$yr' and gol = 0");
							$this->session->set_flashdata('success_update','Data Gaji Pokok berhasil diubah');
							redirect('user/c_asumsi/gajiPokokPercentage');
					}else{
						$this->db->query("INSERT INTO asumsi_gaji_pokok (gol,pangkat,tahun,rupiah) values ('0','','$yr','$gol0'),('1','e','$yr','$gol1e'),
						('1','f','$yr','$gol1f'),('2','a','$yr','$gol2a'),('2','b','$yr','$gol2b'),('2','c','$yr','$gol2c'),('2','d','$yr','$gol2d'),('2','e','$yr','$gol2e'),
						('3','a','$yr','$gol3a'),('3','b','$yr','$gol3b'),('3','c','$yr','$gol3c'),('3','d','$yr','$gol3d'),('3','e','$yr','$gol3e'),
						('4','a','$yr','$gol4a'),('4','b','$yr','$gol4b'),('4','c','$yr','$gol4c'),('4','d','$yr','$gol4d'),('4','e','$yr','$gol4e'),
						('5','a','$yr','$gol5a'),('6','a','$yr','$gol6a')");
						$this->session->set_flashdata('success_insert','Data Gaji Pokok berhasil disimpan');
						redirect('user/c_asumsi/gajiPokokPercentage');
					}
				}
					function percentage_gaji_pokok_year(){
					$yearN = $this->input->post('tahunpilih');
					$yearC = $yearN - 1;
					$x['yearN'] = $yearN;
					$x['yearC'] = $yearC;
					$x['data'] = $this->m_asumsi->asumsi_gaji($yearC);
					$x['data1'] = $this->m_asumsi->asumsi_gajiN($yearN);
					$this->load->view('user/v_asumsi_gaji_pokok',$x);
				
					}

					function meal(){
						$year = date('Y', strtotime("-1 year"));
						$year1 = date('Y');
						$x['yearC'] = $year;
						$x['yearN'] = $year1;
						$x['data'] = $this->m_asumsi->meal_gp($year);
						$x['data1'] = $this->m_asumsi->meal_gpN($year1);
						$puasa1 =  $this->m_asumsi->puasa($year1);
						$countP = $puasa1->num_rows();
						if($countP>0){
						foreach($puasa1->result_array() as $u){
								$tahunP = $u['tahun'];
								$bulanP  = $u['bulan'];
						}
						//$x['data2'] = $this->m_asumsi->mealp_gp($tahunP,$bulanP);
					}else{
						$tahunP = "tahun Belum Di set";
						$bulanP = "Bulan belum di set";
					}
						//echo $tahunP
						//$ps['data4'] = $this->m_asumsi->puasa($year);
						$x['tahunP'] = $tahunP;
						$x['bulanP'] = $bulanP;
						$x['data2'] = $this->m_asumsi->mealp_gp($tahunP);
						$this->load->view('user/v_asumsi_meal',$x);
						}
						function percentage_meal_year(){
						$yearN = $this->input->post('tahunpilih');
						$yearC = $yearN - 1;
						$x['yearN'] = $yearN;
						$x['yearC'] = $yearC;
						$x['data'] = $this->m_asumsi->meal_gp($yearC);
						$x['data1'] = $this->m_asumsi->meal_gpN($yearN);
						
						$puasa1 =  $this->m_asumsi->puasa($yearN);
						$countP = $puasa1->num_rows();
						if($countP>0){
						foreach($puasa1->result_array() as $u){
								$tahunP = $u['tahun'];
								$bulanP  = $u['bulan'];
						}
					}else{
						$tahunP = "tahun Belum Di set";
						$bulanP = "Bulan belum di set";
					}
					$x['tahunP'] = $tahunP;
						$x['bulanP'] = $bulanP;
					$x['data2'] = $this->m_asumsi->mealp_gp($tahunP);
						$this->load->view('user/v_asumsi_meal',$x);
						}
																
						function calculatemeal(){
						$crupiah[]=0;
						
						$yearN = $this->input->post('thn');
						$meal = $this->input->post('meal');
						$asumsimeal = $this->db->query("SELECT * FROM MEAL WHERE tahun = '$yearN'");
						$asumsimealc = $asumsimeal->num_rows();
						if($asumsimealc>0){
							$this->db->query("UPDATE meal set rupiah = '$meal'");
							$this->session->set_flashdat('update_scs','Data berhasil diperbaharui');
						}else{
							$this->db->query("INSERT INTO meal (rupiah,tahun) values ('$meal','$yearN')");
							$this->session->set_flashdata('inser_scs','Data berhasil ditambahkan ');
							redirect('user/c_asumsi/meal');
						}
						}
							function calculatemealpuasa(){
								$crupiah[]=0;
								$yearN = $this->input->post('thn');
								$meal = $this->input->post('mealp');
								$bulanN = $this->input->post('bulanP');
								$asumsimeal = $this->db->query("SELECT * FROM MEAL_PUASA WHERE tahun = '$yearN'");
								$asumsimealc = $asumsimeal->num_rows();
								if($asumsimealc>0){
									$this->db->query("UPDATE meal_puasa set rupiah = '$meal' where tahun = '$yearN' and bulan = '$bulanN'");
									$this->session->set_flashdata('update_scs','Data Makan Puasa berhasil diperbaharui');
									redirect('user/c_asumsi/meal');

								}else{
									$this->db->query("INSERT INTO meal_puasa (rupiah,tahun,bulan) values ('$meal','$yearN','$bulanN')");
									$this->session->set_flashdata('insert_scs','Data Makan Puasa berhasil ditambahkan ');
									redirect('user/c_asumsi/meal');
								}
									}

					function setpuasa(){
						$tahun = $this->input->post('tahunpuasa');
						$bulan = $this->input->post('bulanpuasa');
						$cek = $this->db->query("SELECT * FROM PUASA WHERE tahun = '$tahun'");
						$cekdata = $cek->num_rows();
						if($cekdata<0){
							$this->db->query("INSERT INTO PUASA (tahun,bulan) values ('$tahun','$bulan') ");
							$this->session->set_flashdata('succes_puasa','Bulan Puasa berhasi di setting');
							redirect('user/c_asumsi/meal');
						}else{
							$this->session->set_flashdata('update_puasa','Bulan Puasa berhasi di Update');
							$this->db->query("UPDATE puasa set tahun = '$tahun',bulan = '$bulan' where tahun = '$tahun'");
							redirect('user/c_asumsi/meal');
						}
					}


					function housing(){
						$year = date('Y', strtotime("-1 year"));
						$year1 = date('Y');
						$x['yearC'] = $year;
						$x['yearN'] = $year1;
						$x['data'] = $this->m_asumsi->housing_gp($year);
						$x['data1'] = $this->m_asumsi->housing_gpN($year1);
						$this->load->view('user/v_asumsi_housing_allowance',$x);
						}
						function percentage_housing_year(){
						$yearN = $this->input->post('tahunpilih');
						$yearC = $yearN - 1;
						$x['yearN'] = $yearN;
						$x['yearC'] = $yearC;
						$x['data'] = $this->m_asumsi->housing_gp($yearC);
						$x['data1'] = $this->m_asumsi->housing_gpN($yearN);
						$this->load->view('user/v_asumsi_housing_allowance',$x);
						}
																
						
						function calculatehousing(){
							$crupiah[]=0;
							$yearC = $this->input->post('yearC');	
							$yearN = $this->input->post('yearN');
							$gol0 = $this->input->post('gol0');
							$gol1 = $this->input->post('gol1');
							$gol2 = $this->input->post('gol2');
							$gol3 = $this->input->post('gol3');
							$gol4 = $this->input->post('gol4');
							$gol5 = $this->input->post('gol5');
							$gol6 = $this->input->post('gol6');

							$asumsigp = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$yearC' ");
							$asumsicount = $asumsigp->num_rows();
							if($asumsicount > 0){
								if($asumsigp->num_rows()>0){
									foreach ($asumsigp -> result() as $data ) {
										$rupiah[] = $data->rupiah;
										# code...
									}
									$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
									$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
									$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
									$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
									$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
									$crupiah[5] = $rupiah[5]+(($gol5/100)*$rupiah[5]);
									$crupiah[6] = $rupiah[6]+(($gol5/100)*$rupiah[6]);
						
									$asumsin = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$yearN'");
									$asumsincount = $asumsin->num_rows();
									$no=0;
									if($asumsincount>0){
										for($m=0; $m<$asumsincount; $m++){
											$this->db->query(" update asumsi_housing_allowance set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
											$no++;
										}
										}else{
											for($k=0; $k<7; $k++){
												$this->db->query("INSERT INTO asumsi_housing_allowance (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
						
											}
										}
									}
									$this->session->set_flashdata('success_calculate','Data berhasil dihitung');
									redirect('user/c_asumsi/housing');
							}else
							{
								$this->session->set_flashdata('error_calculate','Data tidak berhasil dihitung');
							redirect('user/c_asumsi/housing');
							}	
							}
							function insert_hos(){
								$yr = $this->input->post('thn');
								$kontrak = $this->input->post('kontrak');
								$gol1 = $this->input->post('gol1');
								$gol2 = $this->input->post('gol2');
								$gol3 = $this->input->post('gol3');
								$gol4 = $this->input->post('gol4');
								$gol5 = $this->input->post('gol5');
								$gol6 = $this->input->post('gol6');
						
								$cek_asumsi = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$yr' order by gol");
								foreach($cek_asumsi->result() as $f):
									$gol[] = $f->gol;
									$rupiah[] = $f->rupiah;  
								endforeach;
								$cek_asumsic = $cek_asumsi->num_rows();
								if($cek_asumsic > 0){
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$gol1' where tahun = '$yr' and gol = 1");
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$gol2' where tahun = '$yr' and gol = 2");
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$gol3' where tahun = '$yr' and gol = 3");
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$gol4' where tahun = '$yr' and gol = 4");
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$gol5' where tahun = '$yr' and gol = 5");
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$gol6' where tahun = '$yr' and gol = 6");
										$this->db->query("UPDATE asumsi_housing_allowance set rupiah = '$kontrak' where tahun = '$yr' and gol = 0");
			
										
										$this->session->set_flashdata('success_update','Data asumsi_housing_allowance berhasil diubah');
										redirect('user/c_asumsi/incentive');
								}else{
									$this->db->query("INSERT INTO asumsi_housing_allowance (gol,tahun,rupiah) values ('0','$yr','$kontrak'),('1','$yr','$gol1'),
									('2','$yr','$gol2'),('3','$yr','$gol3'),('4','$yr','$gol4'),('5','$yr','$gol5'),('6','$yr','$gol6')");
									$this->session->set_flashdata('success_insert','Data asumsi_housing_allowance berhasil disimpan');
									redirect('user/c_asumsi/incentive');
								}
							}

							function transportasi(){
								$year = date('Y', strtotime("-1 year"));
								$year1 = date('Y');
								$x['yearC'] = $year;
								$x['yearN'] = $year1;
								$x['data'] = $this->m_asumsi->trans_gp($year);
								$x['data1'] = $this->m_asumsi->trans_gpN($year1);
								$this->load->view('user/v_asumsi_transportasi',$x);
								}
								function percentage_transportasi_year(){
								$yearN = $this->input->post('tahunpilih');
								$yearC = $yearN - 1;
								$x['yearN'] = $yearN;
								$x['yearC'] = $yearC;
								$x['data'] = $this->m_asumsi->trans_gp($yearC);
								$x['data1'] = $this->m_asumsi->trans_gpN($yearN);
								$this->load->view('user/v_asumsi_transportasi',$x);
								}
																		
								
								function calculatetransportasi(){
									$crupiah[]=0;
									$yearN = $this->input->post('tahun');
									$rp = $this->input->post('rupiah');
									$gol4 = $this->input->post('gol4');
									$gol5 = $this->input->post('gol5');
									$gol6 = $this->input->post('gol6');
									$kpsm = $this->input->post('kpsm');
									$asumsits = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$yearN' ");
									$asumsitsc = $asumsits->num_rows();
									if($asumsitsc>0){
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$rp' where gol = 0");
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$rp', kpsm = '$kpsm' where gol = 1");
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$rp', kpsm = '$kpsm' where gol = 2");
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$rp', kpsm = '$kpsm' where gol = 3");
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$gol4' where gol = 4");
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$gol5' where gol = 5");
										$this->db->query("UPDATE asumsi_transportasi set rupiah = '$gol6' where gol = 6");
										$this->session->set_flashdata('update_scs','Data berhasil diperbaharui');
										redirect('user/c_asumsi/transportasi');
									}else{
										$this->db->query("INSERT INTO asumsi_transportasi (gol,rupiah,kpsm,tahun) values ('0','$rp','0','$yearN')
										,('4','$gol4','0','$yearN'),('5','$gol5','0','$yearN'),('6','$gol6','0','$yearN'),('1','$rp','$kpsm','$yearN'),
										('2','$rp','$kpsm','$yearN'),('3','$rp','$kpsm','$yearN')");
										$this->session->set_flashdata('insert_scs','Data berhasil ditambahkan');
										redirect('user/c_asumsi/transportasi');
									}
									}

									function function_a(){
										$year = date('Y', strtotime("-1 year"));
										$year1 = date('Y');
										$x['yearC'] = $year;
										$x['yearN'] = $year1;
										$x['data'] = $this->m_asumsi->function_gp($year);
										$x['data1'] = $this->m_asumsi->function_gpN($year1);
										$this->load->view('user/v_asumsi_function',$x);
									}
									function percentage_function_year(){
										$yearN = $this->input->post('tahunpilih');
										$yearC = $yearN - 1;
										$x['yearN'] = $yearN;
										$x['yearC'] = $yearC;
										$x['data'] = $this->m_asumsi->function_gp($yearC);
										$x['data1'] = $this->m_asumsi->function_gpN($yearN);
										$this->load->view('user/v_asumsi_function',$x);
									
										}
							function  calculatefunction(){
							$crupiah[]=0;
							$yearC = $this->input->post('yearC');	
							$yearN = $this->input->post('yearN');
							$gol0 = $this->input->post('gol0');
							$gol1 = $this->input->post('gol1');
							$gol2 = $this->input->post('gol2');
							$gol3 = $this->input->post('gol3');
							$gol4 = $this->input->post('gol4');
							$gol5 = $this->input->post('gol5');
							$asumsigp = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$yearC' ");
							$asumsicount = $asumsigp->num_rows();
							if($asumsicount > 0){
								if($asumsigp->num_rows()>0){
									foreach ($asumsigp -> result() as $data ) {
										$rupiah[] = $data->rupiah;
										# code...
									}
									$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
									$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
									$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
									$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
									$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
									$crupiah[5] = $rupiah[5]+(($gol5/100)*$rupiah[5]);

									$asumsin = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$yearN'");
									$asumsincount = $asumsin->num_rows();
									$no=0;
									if($asumsincount>0){
										for($m=0; $m<$asumsincount; $m++){
											$this->db->query(" update asumsi_function_allowance set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
											$no++;
										}
										}else{
											for($k=0; $k<6; $k++){
												$this->db->query("INSERT INTO asumsi_function_allowance (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
						
											}
										}
									}
									$this->session->set_flashdata('success_calculate','Data berhasil dihitung');
									redirect('user/c_asumsi/function');
							}else
							{
								$this->session->set_flashdata('error_calculate','Data tidak berhasil dihitung');
							redirect('user/c_asumsi/function');
							}	
							}	
							
						function insert_function(){
							$thn = $this->input->post('thn');
							$gol0 = $this->input->post('gol0');
							$gol1 = $this->input->post('gol1');
							$gol2 = $this->input->post('gol2');
							$gol3 = $this->input->post('gol3');
							$gol4 = $this->input->post('gol4');
							$gol5 = $this->input->post('gol5');
							$kontrak = $this->input->post('kontrak');

							$cek = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$thn'");
							echo $cekc = $cek->num_rows();
							if($cekc == 0){
								$this->db->query("INSERT INTO asumsi_function_allowance (gol,rupiah,tahun) values
								('0','$gol0','$thn'),('1','$gol1','$thn'),('2','$gol2','$thn'),('3','$gol3','$thn'),
								('4','$gol4','$thn'),('5','$gol5','$thn')");
							
							$this->session->set_flashdata('insert_scs','Data berhasil ditambahkan');
							redirect('user/c_asumsi/function');

							}else{
							$this->db->query("UPDATE asumsi_function_allowance set rupiah = '$gol1' where tahun = '$thn' and gol = 1 ");
							$this->db->query("UPDATE asumsi_function_allowance set rupiah = '$gol2' where tahun = '$thn' and gol = 2 ");
							$this->db->query("UPDATE asumsi_function_allowance set rupiah = '$gol3' where tahun = '$thn' and gol = 3 ");
							$this->db->query("UPDATE asumsi_function_allowance set rupiah = '$gol4' where tahun = '$thn' and gol = 4 ");
							$this->db->query("UPDATE asumsi_function_allowance set rupiah = '$gol5' where tahun = '$thn' and gol = 5 ");
							$this->db->query("UPDATE asumsi_function_allowance set rupiah = '$kontrak' where tahun = '$thn' and gol = 0 ");
								$this->session->set_flashdata('update_scs','Data berhasil diperbaharui');
								redirect('user/c_asumsi/function');
							}

						}

										function hospitalization(){
										$year = date('Y', strtotime("-1 year"));
										$year1 = date('Y');
										$x['yearC'] = $year;
										$x['yearN'] = $year1;
										$x['data'] = $this->m_asumsi->hospitalization_gp($year);
										$x['data1'] = $this->m_asumsi->hospitalization_gpN($year1);
										$this->load->view('user/v_asumsi_hospitalization',$x);
									}
									function percentage_hospitalization_year(){
										$yearN = $this->input->post('tahunpilih');
										$yearC = $yearN - 1;
										$x['yearN'] = $yearN;
										$x['yearC'] = $yearC;
										$x['data'] = $this->m_asumsi->hospitalization_gp($yearC);
										$x['data1'] = $this->m_asumsi->hospitalization_gpN($yearN);
										$this->load->view('user/v_asumsi_hospitalization',$x);
									
										}
							function  calculatehospitalization(){
							$crupiah[]=0;
							$crupiah10[]=0;
							$yearC = $this->input->post('yearC');			
							$yearN = $this->input->post('yearN');
							$gol0 = $this->input->post('gol0');
							$gol1 = $this->input->post('gol1');
							$gol2 = $this->input->post('gol2');
							$gol3 = $this->input->post('gol3');
							$gol4 = $this->input->post('gol4');
							$gol5 = $this->input->post('gol5');
							$asumsigp = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$yearC' ");
							$asumsicount = $asumsigp->num_rows();
							if($asumsicount > 0){
								if($asumsigp->num_rows()>0){
									foreach ($asumsigp -> result() as $data ) {
										$rupiah[] = $data->rp100;
										# code...
									}
									$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
									$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
									$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
									$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
									$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
									$crupiah[5] = $rupiah[5]+(($gol5/100)*$rupiah[5]);

									$crupiah10[0] = $crupiah[0]*((10/100));
									$crupiah10[1] = $crupiah[1]*((10/100));
									$crupiah10[2] = $crupiah[2]*((10/100));
									$crupiah10[3] = $crupiah[3]*((10/100));
									$crupiah10[4] = $crupiah[4]*((10/100));
									$crupiah10[5] = $crupiah[5]*((10/100));

									$crupiah90[0] = $crupiah[0]*((90/100));
									$crupiah90[1] = $crupiah[1]*((90/100));
									$crupiah90[2] = $crupiah[2]*((90/100));
									$crupiah90[3] = $crupiah[3]*((90/100));
									$crupiah90[4] = $crupiah[4]*((90/100));
									$crupiah90[5] = $crupiah[5]*((90/100));


									$asumsin = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$yearN'");
									$asumsincount = $asumsin->num_rows();
									$no=0;
									if($asumsincount>0){
										for($m=0; $m<$asumsincount; $m++){
											$this->db->query(" update asumsi_hospitalization set rp100 = '$crupiah[$no]',rp90='$crupiah90',rp10='$crupiah10' where tahun ='$yearN' and gol = '$no' ");
											$no++;
										}
										}else{
											for($k=0; $k<6; $k++){
												$this->db->query("INSERT INTO asumsi_hospitalization (gol,tahun,rp100,rp90,rp10) values('$k','$yearN','$crupiah[$k]','$crupiah90[$k]','$crupiah10[$k]') ");
						
											}
										}
									}
									$this->session->set_flashdata('success_calculate','Data berhasil dihitung');
									redirect('user/c_asumsi/hospitalization');
							}else
							{
								$this->session->set_flashdata('error_calculate','Data tidak berhasil dihitung');
							redirect('user/c_asumsi/hospitalization');
							}	
							}	
							
						function insert_hospitalization(){
							$thn = $this->input->post('thn');
							$gol0 = $this->input->post('gol0');
							$gol1 = $this->input->post('gol1');
							$gol2 = $this->input->post('gol2');
							$gol3 = $this->input->post('gol3');
							$gol4 = $this->input->post('gol4');
							$gol5 = $this->input->post('gol5');
							$kontrak = $this->input->post('kontrak');

							//$g0rp10 = $gol0*(10/100);
							$g1rp10 = $gol1*(10/100);
							$g2rp10 = $gol2*(10/100);
							$g3rp10 = $gol3*(10/100);
							$g4rp10 = $gol4*(10/100);
							$g5rp10 = $gol5*(10/100);
							$g0rp10 = $kontrak*(10/100);

							
							//$g0rp90 = $gol0*(90/100);
							$g1rp90 = $gol1*(90/100);
							$g2rp90 = $gol2*(90/100);
							$g3rp90 = $gol3*(90/100);
							$g4rp90 = $gol4*(90/100);
							$g5rp90 = $gol5*(90/100);
							$g0rp90 = $kontrak*(90/100);

							$cek = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$thn'");
							echo $cekc = $cek->num_rows();
							if($cekc == 0){
								$this->db->query("INSERT INTO asumsi_hospitalization (gol,rp100,rp90,rp10,tahun) values
								('0','$kontrak','$g0rp90','$g0rp10','$thn'),('1','$gol1','$g1rp90','$g1rp10','$thn'),
								('2','$gol2','$g2rp90','$g2rp10','$thn'),('3','$gol3','$g3rp90','$g3rp10','$thn'),
								('4','$gol4','$g4rp90','$g4rp10','$thn'),('5','$gol5','$g5rp90','$g5rp10','$thn')");
							
							$this->session->set_flashdata('insert_scs','Data berhasil ditambahkan');
							redirect('user/c_asumsi/hospitalization');

							}else{
							$this->db->query("UPDATE asumsi_hospitalization set rp100 = '$gol1',rp90='$g1rp90',rp10='$g1rp10' where tahun = '$thn' and gol = 1 ");
							$this->db->query("UPDATE asumsi_hospitalization set rp100 = '$gol2',rp90='$g2rp90',rp10='$g2rp10' where tahun = '$thn' and gol = 2 ");
							$this->db->query("UPDATE asumsi_hospitalization set rp100 = '$gol3',rp90='$g3rp90',rp10='$g3rp10' where tahun = '$thn' and gol = 3 ");
							$this->db->query("UPDATE asumsi_hospitalization set rp100 = '$gol4',rp90='$g4rp90',rp10='$g4rp10' where tahun = '$thn' and gol = 4 ");
							$this->db->query("UPDATE asumsi_hospitalization set rp100 = '$gol5',rp90='$g5rp90',rp10='$g5rp10' where tahun = '$thn' and gol = 5 ");
							$this->db->query("UPDATE asumsi_hospitalization set rp100 = '$kontrak',rp90='$g0rp90',rp10='$g0rp10' where tahun = '$thn' and gol = '0' ");
								$this->session->set_flashdata('update_scs','Data berhasil diperbaharui');
								redirect('user/c_asumsi/hospitalization');
							}

						}

						function telecomunication(){
							$year = date('Y', strtotime("-1 year"));
							$year1 = date('Y');
							$x['yearC'] = $year;
							$x['yearN'] = $year1;
							$x['data'] = $this->m_asumsi->telekomunikasi_gp($year);
							$x['data1'] = $this->m_asumsi->telekomunikasi_gpN($year1);
							$this->load->view('user/v_asumsi_telekomunikasi',$x);
						}
						function percentage_telekomunikasi_year(){
							$yearN = $this->input->post('tahunpilih');
							$yearC = $yearN - 1;
							$x['yearN'] = $yearN;
							$x['yearC'] = $yearC;
							$x['data'] = $this->m_asumsi->telekomunikasi_gp($yearC);
							$x['data1'] = $this->m_asumsi->telekomunikasi_gpN($yearN);
							$this->load->view('user/v_asumsi_telekomunikasi',$x);
						
							}
					
							function calculatetelekomunikasi(){
								$crupiah[]=0;
								$yearC = $this->input->post('yearC');	
								$yearN = $this->input->post('yearN');
								$gol0 = $this->input->post('gol0');
								$gol1 = $this->input->post('gol1');
								$gol2 = $this->input->post('gol2');
								$gol3 = $this->input->post('gol3');
								$gol4 = $this->input->post('gol4');
								$gol5 = $this->input->post('gol5');
								$asumsigp = $this->db->query("SELECT * FROM asumsi_telekomunikasi where tahun = '$yearC' ");
								$asumsicount = $asumsigp->num_rows();
								if($asumsicount > 0){
									if($asumsigp->num_rows()>0){
										foreach ($asumsigp -> result() as $data ) {
											$rupiah[] = $data->rupiah;
											# code...
										}
										$crupiah[0] = $rupiah[0]+(($gol0/100)*$rupiah[0]);
										$crupiah[1] = $rupiah[1]+(($gol1/100)*$rupiah[1]);
										$crupiah[2] = $rupiah[2]+(($gol2/100)*$rupiah[2]);
										$crupiah[3] = $rupiah[3]+(($gol3/100)*$rupiah[3]);
										$crupiah[4] = $rupiah[4]+(($gol4/100)*$rupiah[4]);
							
										$asumsin = $this->db->query("SELECT * FROM asumsi_telekomunikasi where tahun = '$yearN'");
										$asumsincount = $asumsin->num_rows();
										$no=0;
										if($asumsincount>0){
											for($m=0; $m<$asumsincount; $m++){
												$this->db->query(" update asumsi_telekomunikasi set rupiah = '$crupiah[$no]' where tahun ='$yearN' and gol = '$no' ");
												$no++;
											}
											}else{
												for($k=0; $k<6; $k++){
													$this->db->query("INSERT INTO asumsi_telekomunikasi (gol,tahun,rupiah) values('$k','$yearN','$crupiah[$k]') ");
							
												}
											}
										}
										$this->session->set_flashdata('insert_scs','Data berhasil di tambahkan / di perbaharui');
										redirect('user/c_asumsi/hadir');
							}
							else
							{
											$this->session->set_flashdata('insert_error','Data tidak berhasil di tambahkan / di perbaharui');
										redirect('user/c_asumsi/hadir');	
							}
							
				
	
								}

								function vpph21(){
									$year = date('Y', strtotime("-1 year"));
									$year1 = date('Y');
									$x['yearC'] = $year;
									$x['yearN'] = $year1;
									$x['data'] = $this->m_asumsi->pph21_gp($year);
									$x['datat'] = $this->m_asumsi->tax_gp($year1);
									$x['data1'] = $this->m_asumsi->pph21_gpN($year1);
									$datan = $this->db->query("SELECT * FROM pph21 where tahun = '$year1' ORDER BY gol");
									$x['datac'] = $datan->num_rows();	
									$this->load->view('user/v_asumsi_tax',$x);
								}
								function percentage_vpph21_year(){
									$yearN = $this->input->post('tahunpilih');
									$yearC = $yearN - 1;
									$x['yearN'] = $yearN;
									$x['yearC'] = $yearC;
									$x['data'] = $this->m_asumsi->pph21_gp($yearC);
									$x['data1'] = $this->m_asumsi->pph21_gpN($yearN);
									$this->load->view('user/v_asumsi_tax',$x);
								
									}	

						
	function pph21(){
		$j=0;
		$ss0[]=0;
		$sm0[]=0;
		$sm1[]=0;
		$sm2[]=0;
		$sm3[]=0;
		$s0=54000000;
		$m0=58500000;
		$m1=63000000;
		$m2=67500000;
		$m3=72000000;
		$tnj = 1500000;
		$totgp[] = 0;
		$tot[]=0;
		$totbruto[]=0;
		$bjbt[]=0;
		$bjbt12[]=0;
		$iur[]=0;
		$iur12[]=0;
		$pngl[]=0;
		$netto[]=0;
		$totpph[]=0;
		$totpph12[]=0;
		$thn = $this->input->post('tahun');
		$this->db->query("DELETE from PPH21 WHERE tahun = '$thn'");
		$gp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$thn' order by gol,pangkat");
		$gpc = $gp->num_rows();
		$asumsipph21 = $this->db->query("SELECT * FROM pph21 where tahun = '$thn'");
		$asumsipph21c = $asumsipph21->num_rows();

		if($gpc<0){
			$this->session->set_flashdata('error_gnt','Data tidak berhasil dihitung cek Asumsi Gaji Pokok');
			redirect('user/c_asumsi/pajak');
		}else{
			if($asumsipph21c==0){
				foreach($gp->result_array() as $i):
					$golgp[$j] = $i['gol'];
					$pangkatgp[$j] = $i['pangkat'];
					$rupiahgp[$j] = $i['rupiah'];

					if($golgp[$j]==0){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				

					}elseif($golgp[$j]==1 && $pangkatgp[$j]=='e'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				
					}elseif($golgp[$j]==2 && $pangkatgp[$j]=='b'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==2 && $pangkatgp[$j]=='c'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==2 && $pangkatgp[$j]=='d'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==3 && $pangkatgp[$j]=='a'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==3 && $pangkatgp[$j]=='d'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
				
					}elseif($golgp[$j]==3 && $pangkatgp[$j]=='e'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
				
					}elseif($golgp[$j]==4 && $pangkatgp[$j]=='a'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
				
					}elseif($golgp[$j]==4 && $pangkatgp[$j]=='b'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
				
					}elseif($golgp[$j]==4 && $pangkatgp[$j]=='c'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==4 && $pangkatgp[$j]=='d'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==4 && $pangkatgp[$j]=='e'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
				
					}elseif($golgp[$j]==5 && $pangkatgp[$j]=='a'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
					}elseif($golgp[$j]==6 && $pangkatgp[$j]=='a'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				
					}elseif($golgp[$j]==3 && $pangkatgp[$j]=='b'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				
					}elseif($golgp[$j]==3 && $pangkatgp[$j]=='c'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				
					}elseif($golgp[$j]==1 && $pangkatgp[$j]=='f'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				
					}elseif($golgp[$j]==2 && $pangkatgp[$j]=='a'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];

						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($ss0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($ss0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($ss0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($ss0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'S/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm0[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm0[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm0[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm0[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/0','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm1[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
	
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm1[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm1[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm1[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/1','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm2[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm2[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm2[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm2[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/2','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								$totpph1[$j]=50000000*(5/100);
								$totpph[$j]=(($sm3[$j]-50000000)*(15/100))+$totpph1[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								$totpph13[$j]=50000000*(5/100);
								$totpph23[$j]=250000000*(15/100);
								$totpph[$j]=(($sm3[$j]-300000000)*(25/100))+$totpph13[$j]+$totpph23[$j];
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}elseif($sm3[$j]>500000000){
								$totpph13[$j]=5000000*(5/100);
								$totpph23[$j]=200000000*(15/100);
								$totpph33[$j]=250000000*(25/100);
								$totpph[$j]=(($sm3[$j]-500000000)*(30/100))+($totpph13[$j]+$totpph23[$j]+$totpph33[$j]);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("INSERT INTO pph21 (gol,pangkat,rupiah,rupiahbln,statuspernikahan,iuran,
								iuran12,jbtn,jbtn12,tahun) values ('$golgp[$j]','$pangkatgp[$j]','$totpph[$j]','$totpph12[$j]',
								'M/3','$iur[$j]','$iur12[$j]','$bjbt[$j]','$bjbt12[$j]',$thn)");
							}else{
	
							}
						}
						
				
					}
					
					else{

					}
					$j++;
				endforeach;
				$this->session->set_flashdata('insert_scs','Data PPH21 berhasil di tambahkan');
	redirect('user/c_asumsi/vpph21');	
			}
		else{
			foreach($gp->result_array() as $m):
				$golgp[$j] = $m['gol'];
				$pangkatgp[$j] = $m['pangkat'];
				$rupiahgp[$j] = $m['rupiah'];

				if($golgp[$j]==0){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
					if($ss0[$j]<=50000000){
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0'");
					}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph[$j]=$ss0[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0'");
					}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph[$j]=$ss0[$j]*(15/100);
						$totpph[$j]=$ss0[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0'");
					}elseif($ss0[$j]>500000000){
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph[$j]=$ss0[$j]*(15/100);
						$totpph[$j]=$ss0[$j]*(25/100);
						$totpph[$j]=$ss0[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0'");
					}else{

					}
				}
				if($netto[$j]>=$m0){
					if($sm0[$j]<=50000000){
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0'");
					}elseif($sm0[$j]<=250000000 && $sm0[$j] >= 50000000){
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph[$j]=$sm0[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0'");
					}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph[$j]=$sm0[$j]*(15/100);
						$totpph[$j]=$sm0[$j]*(25/100);	
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0'");
					}elseif($sm0[$j]>500000000){
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph[$j]=$sm0[$j]*(15/100);
						$totpph[$j]=$sm0[$j]*(25/100);
						$totpph[$j]=$sm0[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0'");
					}else{

					}
				}
				if($netto[$j]>=$m1){
					if($sm1[$j]<=50000000){
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1'");
						 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
						$totpph[$j]=$sm1[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1'");
					}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph[$j]=$sm1[$j]*(15/100);
						$totpph[$j]=$sm1[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1'");
					}elseif($sm1[$j]>500000000){
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph[$j]=$sm1[$j]*(15/100);
						$totpph[$j]=$sm1[$j]*(25/100);
						$totpph[$j]=$sm1[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1'");
					}else{

					}
				}
				if($netto[$j]>=$m2){
					if($sm2[$j]<=50000000){
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2'");
					}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph[$j]=$sm2[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2'");
					}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph[$j]=$sm2[$j]*(15/100);
						$totpph[$j]=$sm2[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2'");
					}elseif($sm2[$j]>500000000){
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph[$j]=$sm2[$j]*(15/100);
						$totpph[$j]=$sm2[$j]*(25/100);
						$totpph[$j]=$sm2[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2'");
					}else{

					}
				}
				if($netto[$j]>=$m3){
					if($sm3[$j]<=50000000){
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3'");
					}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph[$j]=$sm3[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3'");
					}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph[$j]=$sm3[$j]*(15/100);
						$totpph[$j]=$sm3[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3'");
					}elseif($sm3[$j]>500000000){
							$totpph[$j]=$sm3[$j]*(5/100);
						$totpph[$j]=$sm3[$j]*(15/100);
						$totpph[$j]=$sm3[$j]*(25/100);
						$totpph[$j]=$sm3[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3'");
					}else{

					}
				}
					
				}elseif($golgp[$j]==1 && $pangkatgp[$j]=='e'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
					if($ss0[$j]<=50000000){
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
					}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
						
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph[$j]=$ss0[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
					}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
						
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph[$j]=$ss0[$j]*(15/100);
						$totpph[$j]=$ss0[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
					}elseif($ss0[$j]>500000000){
						
						$totpph[$j]=$ss0[$j]*(5/100);
						$totpph[$j]=$ss0[$j]*(15/100);
						$totpph[$j]=$ss0[$j]*(25/100);
						$totpph[$j]=$ss0[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
					}else{

					}
				}
				if($netto[$j]>=$m0){
					if($sm0[$j]<=50000000){
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
					}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
						
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph[$j]=$sm0[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
					}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
						
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph[$j]=$sm0[$j]*(15/100);
						$totpph[$j]=$sm0[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
					}elseif($sm0[$j]>500000000){
						
						$totpph[$j]=$sm0[$j]*(5/100);
						$totpph[$j]=$sm0[$j]*(15/100);
						$totpph[$j]=$sm0[$j]*(25/100);
						$totpph[$j]=$sm0[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
					}else{

					}
				}
				if($netto[$j]>=$m1){
					if($sm1[$j]<=50000000){
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
						 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
							 
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph[$j]=$sm1[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
					}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
						
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph[$j]=$sm1[$j]*(15/100);
						$totpph[$j]=$sm1[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
					}elseif($sm1[$j]>500000000){
						
						$totpph[$j]=$sm1[$j]*(5/100);
						$totpph[$j]=$sm1[$j]*(15/100);
						$totpph[$j]=$sm1[$j]*(25/100);
						$totpph[$j]=$sm1[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
					}else{

					}
				}
				if($netto[$j]>=$m2){
					if($sm2[$j]<=50000000){
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
					}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
						
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph[$j]=$sm2[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
					}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
						
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph[$j]=$sm2[$j]*(15/100);
						$totpph[$j]=$sm1[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
					}elseif($sm2[$j]>500000000){
						
						$totpph[$j]=$sm2[$j]*(5/100);
						$totpph[$j]=$sm2[$j]*(15/100);
						$totpph[$j]=$sm2[$j]*(25/100);
						$totpph[$j]=$sm2[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
					}else{

					}
				}
				if($netto[$j]>=$m3){
					if($sm3[$j]<=50000000){
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
					}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
						
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph[$j]=$sm3[$j]*(15/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
					}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
						
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph[$j]=$sm3[$j]*(15/100);
						$totpph[$j]=$sm3[$j]*(25/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
					}elseif($sm3[$j]>500000000){
						
						$totpph[$j]=$sm3[$j]*(5/100);
						$totpph[$j]=$sm3[$j]*(15/100);
						$totpph[$j]=$sm3[$j]*(25/100);
						$totpph[$j]=$sm3[$j]*(30/100);
						$totpph12[$j]=$totpph[$j]/12;
						$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
						 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
						 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
					}else{

					}
				}
			
				}elseif($golgp[$j]==2 && $pangkatgp[$j]=='a'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				}elseif($golgp[$j]==2 && $pangkatgp[$j]=='b'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				}elseif($golgp[$j]==2 && $pangkatgp[$j]=='c'){
				
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				
					}elseif($golgp[$j]==1 && $pangkatgp[$j]=='e'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];
	
						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph[$j]=$ss0[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph[$j]=$ss0[$j]*(15/100);
								$totpph[$j]=$ss0[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($ss0[$j]>500000000){
								
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph[$j]=$ss0[$j]*(15/100);
								$totpph[$j]=$ss0[$j]*(25/100);
								$totpph[$j]=$ss0[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
								
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph[$j]=$sm0[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph[$j]=$sm0[$j]*(15/100);
								$totpph[$j]=$sm0[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($sm0[$j]>500000000){
								
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph[$j]=$sm0[$j]*(15/100);
								$totpph[$j]=$sm0[$j]*(25/100);
								$totpph[$j]=$sm0[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
								 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
									 
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph[$j]=$sm1[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
								
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph[$j]=$sm1[$j]*(15/100);
								$totpph[$j]=$sm1[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
							}elseif($sm1[$j]>500000000){
								
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph[$j]=$sm1[$j]*(15/100);
								$totpph[$j]=$sm1[$j]*(25/100);
								$totpph[$j]=$sm1[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph[$j]=$sm2[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph[$j]=$sm2[$j]*(15/100);
								$totpph[$j]=$sm1[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}elseif($sm2[$j]>500000000){
								
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph[$j]=$sm2[$j]*(15/100);
								$totpph[$j]=$sm2[$j]*(25/100);
								$totpph[$j]=$sm2[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph[$j]=$sm3[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph[$j]=$sm3[$j]*(15/100);
								$totpph[$j]=$sm3[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
							}elseif($sm3[$j]>500000000){
								
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph[$j]=$sm3[$j]*(15/100);
								$totpph[$j]=$sm3[$j]*(25/100);
								$totpph[$j]=$sm3[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
							}else{
		
							}
						}
					
				
				}elseif($golgp[$j]==2 && $pangkatgp[$j]=='d'){
				
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				
						
					}elseif($golgp[$j]==1 && $pangkatgp[$j]=='e'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];
	
						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
							if($ss0[$j]<=50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
							}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
								
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph[$j]=$ss0[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
								
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph[$j]=$ss0[$j]*(15/100);
								$totpph[$j]=$ss0[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($ss0[$j]>500000000){
								
								$totpph[$j]=$ss0[$j]*(5/100);
								$totpph[$j]=$ss0[$j]*(15/100);
								$totpph[$j]=$ss0[$j]*(25/100);
								$totpph[$j]=$ss0[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m0){
							if($sm0[$j]<=50000000){
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
								
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph[$j]=$sm0[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
								
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph[$j]=$sm0[$j]*(15/100);
								$totpph[$j]=$sm0[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}elseif($sm0[$j]>500000000){
								
								$totpph[$j]=$sm0[$j]*(5/100);
								$totpph[$j]=$sm0[$j]*(15/100);
								$totpph[$j]=$sm0[$j]*(25/100);
								$totpph[$j]=$sm0[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m1){
							if($sm1[$j]<=50000000){
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
								 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
									 
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph[$j]=$sm1[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
							}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
								
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph[$j]=$sm1[$j]*(15/100);
								$totpph[$j]=$sm1[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
							}elseif($sm1[$j]>500000000){
								
								$totpph[$j]=$sm1[$j]*(5/100);
								$totpph[$j]=$sm1[$j]*(15/100);
								$totpph[$j]=$sm1[$j]*(25/100);
								$totpph[$j]=$sm1[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m2){
							if($sm2[$j]<=50000000){
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
								
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph[$j]=$sm2[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
								
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph[$j]=$sm2[$j]*(15/100);
								$totpph[$j]=$sm1[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}elseif($sm2[$j]>500000000){
								
								$totpph[$j]=$sm2[$j]*(5/100);
								$totpph[$j]=$sm2[$j]*(15/100);
								$totpph[$j]=$sm2[$j]*(25/100);
								$totpph[$j]=$sm2[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
							}else{
		
							}
						}
						if($netto[$j]>=$m3){
							if($sm3[$j]<=50000000){
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
							}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
								
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph[$j]=$sm3[$j]*(15/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
							}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
								
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph[$j]=$sm3[$j]*(15/100);
								$totpph[$j]=$sm3[$j]*(25/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
							}elseif($sm3[$j]>500000000){
								
								$totpph[$j]=$sm3[$j]*(5/100);
								$totpph[$j]=$sm3[$j]*(15/100);
								$totpph[$j]=$sm3[$j]*(25/100);
								$totpph[$j]=$sm3[$j]*(30/100);
								$totpph12[$j]=$totpph[$j]/12;
								$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
								 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
								 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
							}else{
		
							}
						}
					
				
				}elseif($golgp[$j]==2 && $pangkatgp[$j]=='e'){
				
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				
					}elseif($golgp[$j]==2 && $pangkatgp[$j]=='e'){
						$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
						$bjbt[$j] = $totbruto[$j]*(5/100);
						$iur[$j]=$totbruto[$j]*(5/100);
						if($bjbt[$j]>=6000000){
							$bjbt[$j]=6000000;
							$bjbt12[$j]=$bjbt[$j]/12;
						}else{
							$bjbt12[$j]=$bjbt[$j]/12;
						}
						if($iur[$j]>=2400000){
							$iur[$j]=2400000;
							$iur12[$j]=$iur[$j]/12;
						}else{
							$iur12[$j]=$iur[$j]/12;
						}
						$pngl[$j]=$bjbt[$j]+$iur[$j];
						$netto[$j]= $totbruto[$j]-$pngl[$j];
	
						$ss0[$j] = $netto[$j]-$s0;
						$sm0[$j] = $netto[$j]-$m0;
						$sm1[$j] = $netto[$j]-$m1;
						$sm2[$j] = $netto[$j]-$m2;
						$sm3[$j] = $netto[$j]-$m3;
						if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $ss0[$j] >= 50000000){
								 
								$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				
				}elseif($golgp[$j]==3 && $pangkatgp[$j]=='a'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0'");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0'");
						}elseif($ss0[$j]>500000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0'");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0'");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0'");
						}elseif($sm0[$j]<=500000000 && $ss0[$j]>=250000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);	
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0'");
						}elseif($sm0[$j]>500000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0'");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1'");
							 }elseif($sm1[$j]<=250000000 && $ss0[$j] >= 50000000){
								$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1'");
						}elseif($sm1[$j]<=500000000 && $ss0[$j]>=250000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1'");
						}elseif($sm1[$j]>500000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1'");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2'");
						}elseif($sm2[$j]<=250000000 && $ss0[$j] >= 50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2'");
						}elseif($sm2[$j]<=500000000 && $ss0[$j]>=250000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2'");
						}elseif($sm2[$j]>500000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2'");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3'");
						}elseif($sm3[$j]<=250000000 && $ss0[$j] >= 50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3'");
						}elseif($sm3[$j]<=500000000 && $ss0[$j]>=250000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3'");
						}elseif($sm3[$j]>500000000){
								$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3'");
						}else{
	
						}
					}
						
					
						
					
				}elseif($golgp[$j]==4 && $pangkatgp[$j]=='a'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
				
						
					
						
					
					
				
						
				
					
			
				}elseif($golgp[$j]==4 && $pangkatgp[$j]=='b'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}	
				}elseif($golgp[$j]==4 && $pangkatgp[$j]=='c'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}		
			
				}elseif($golgp[$j]==4 && $pangkatgp[$j]=='d'){
					$totbruto[$j] = ($rupiahgp[$j]*12)+($tnj*12)+$rupiahgp[$j];
					$bjbt[$j] = $totbruto[$j]*(5/100);
					$iur[$j]=$totbruto[$j]*(5/100);
					if($bjbt[$j]>=6000000){
						$bjbt[$j]=6000000;
						$bjbt12[$j]=$bjbt[$j]/12;
					}else{
						$bjbt12[$j]=$bjbt[$j]/12;
					}
					if($iur[$j]>=2400000){
						$iur[$j]=2400000;
						$iur12[$j]=$iur[$j]/12;
					}else{
						$iur12[$j]=$iur[$j]/12;
					}
					$pngl[$j]=$bjbt[$j]+$iur[$j];
					$netto[$j]= $totbruto[$j]-$pngl[$j];

					$ss0[$j] = $netto[$j]-$s0;
					$sm0[$j] = $netto[$j]-$m0;
					$sm1[$j] = $netto[$j]-$m1;
					$sm2[$j] = $netto[$j]-$m2;
					$sm3[$j] = $netto[$j]-$m3;
					if($netto[$j]>=$s0){
						if($ss0[$j]<=50000000){
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]'");
						}elseif($ss0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]<=500000000 && $ss0[$j]>=250000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($ss0[$j]>500000000){
							
							$totpph[$j]=$ss0[$j]*(5/100);
							$totpph[$j]=$ss0[$j]*(15/100);
							$totpph[$j]=$ss0[$j]*(25/100);
							$totpph[$j]=$ss0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'S/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m0){
						if($sm0[$j]<=50000000){
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=250000000 && $ss0[$j] >= 50000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]<=500000000 && $sm0[$j]>=250000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}elseif($sm0[$j]>500000000){
							
							$totpph[$j]=$sm0[$j]*(5/100);
							$totpph[$j]=$sm0[$j]*(15/100);
							$totpph[$j]=$sm0[$j]*(25/100);
							$totpph[$j]=$sm0[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/0' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m1){
						if($sm1[$j]<=50000000){
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND pangkat='$pangkatgp[$j]' ");
							 }elseif($sm1[$j]<=250000000 && $sm1[$j] >= 50000000){
								 
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]<=500000000 && $sm1[$j]>=250000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}elseif($sm1[$j]>500000000){
							
							$totpph[$j]=$sm1[$j]*(5/100);
							$totpph[$j]=$sm1[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph[$j]=$sm1[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/1' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m2){
						if($sm2[$j]<=50000000){
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=250000000 && $sm2[$j] >= 50000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]<=500000000 && $sm2[$j]>=250000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm1[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}elseif($sm2[$j]>500000000){
							
							$totpph[$j]=$sm2[$j]*(5/100);
							$totpph[$j]=$sm2[$j]*(15/100);
							$totpph[$j]=$sm2[$j]*(25/100);
							$totpph[$j]=$sm2[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/2' AND '$pangkatgp[$j]' ");
						}else{
	
						}
					}
					if($netto[$j]>=$m3){
						if($sm3[$j]<=50000000){
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=250000000 && $sm3[$j] >= 50000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]<=500000000 && $sm3[$j]>=250000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND '$pangkatgp[$j]' ");
						}elseif($sm3[$j]>500000000){
							
							$totpph[$j]=$sm3[$j]*(5/100);
							$totpph[$j]=$sm3[$j]*(15/100);
							$totpph[$j]=$sm3[$j]*(25/100);
							$totpph[$j]=$sm3[$j]*(30/100);
							$totpph12[$j]=$totpph[$j]/12;
							$this->db->query("UPDATE pph21 set rupiah = '$totpph[$j]',rupiahbln = '$totpph12[$j]',iuran='$iur[$j]',
							 iuran12 = '$iur12[$j]',jbtn='$bjbt[$j]',jbtn12='$bjbt12[$j]' where tahun = '$thn' and gol='$golgp[$j]'
							 and statuspernikahan = 'M/3' AND pangkat='$pangkatgp[$j]' ");
						}else{
	
						}
					}			
			
				}
				$j++;
			endforeach;
			$this->session->set_flashdata('update_scs','Data PPH21 berhasil diperbaharui');
			redirect('user/c_asumsi/vpph21');
		}
	}
	}

	function tax_active(){
		$act = $this->input->post('active');
		if($act=='pph21'){
			$this->db->query("UPDATE tax_active set active = 1 where tax = '$act'");
			$this->db->query("UPDATE tax_active set active = 0 where tax = 'manual'");
		}else{
			$this->db->query("UPDATE tax_active set active = 1 where tax = '$act'");
			$this->db->query("UPDATE tax_active set active = 0 where tax = 'pph21'");
		}
		$this->session->set_flashdata('set_active','Data tax active berhasil diubah');
		redirect('user/c_asumsi/vpph21');
	}
	function upload_tax(){
		$th = $this->input->post('tahun');
		$this->db->query("DELETE tax_manual where tahun = '$th'");
		$fileName = $this->input->post('file', TRUE);

		$config['upload_path'] = './assets/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		$config['max_size'] = 10000;
	  
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 
		
		if (!$this->upload->do_upload('file')) {
		 $error = array('error' => $this->upload->display_errors());
		 $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
		 redirect('Welcome'); 
		} else {
		 $media = $this->upload->data();
		 $inputFileName = 'assets/'.$media['file_name'];
		 
		 try {
		  $inputFileType = IOFactory::identify($inputFileName);
		  $objReader = IOFactory::createReader($inputFileType);
		  $objPHPExcel = $objReader->load($inputFileName);
		 } catch(Exception $e) {
		  die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		 }
	  
		 $sheet = $objPHPExcel->getSheet(0);
		 $highestRow = $sheet->getHighestRow();
		 $highestColumn = $sheet->getHighestColumn();
	  
		 for ($row = 2; $row <= $highestRow; $row++){  
		   $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
			 NULL,
			 TRUE,
			 FALSE);
		   $data = array(
		   "gol"=> $rowData[0][0],
		   "sub_golongan"=> $rowData[0][1],
		   "status_pernikahan"=> $rowData[0][2],
		   "rupiah"=> $rowData[0][3],
		   "tahun"=> $rowData[0][4]
		  );

	
		  $this->db->insert("tax_manual",$data);
		 } 
		 $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
		 redirect('user/c_asumsi/vpph21');
		}  
	   } 
}
