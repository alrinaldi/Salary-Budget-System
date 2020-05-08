<?php
Class C_overtime extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==""){
            redirect('login');
        }
        $this->load->model('user/m_overtime');
	}

	private $master_overtime = 'master_overtime';
	
	function viewOvertime(){
		$year = date('Y');
		$x['data1'] = $this->m_overtime->get_asumsi_overtime($year);
		//$x['data'] = $this->m_overtime->get_overtime($year);
		$this->load->view('user/v_overtime',$x);
	}

	function viewOvertimebatch(){
		$year = date('Y');
		$x['data1'] = $this->m_overtime->get_asumsi_overtime($year);
		//$x['data'] = $this->m_overtime->get_overtime($year);
		$this->load->view('user/v_overtime1',$x);
	}
	function listOvertime(){
		$year = date('Y');
		$month = date('F', mktime(0,0,0,1, 1, date('Y')));
		$mnth = 'JANUARY';
		$x['data'] = $this->m_overtime->list_overtime($year,$mnth);
		$x['yearr'] = $year;
		$x['monthh'] = $month;
		$this->load->view('user/v_list_overtime',$x);
	}
	function listFilterOvertime(){
		$year = $this->input->post('year');
		$bulan = $this->input->post('bulan');
		$x['data'] = $this->m_overtime->filter_overtime($year,$bulan);
		$x['yearr'] = $year;
		$x['monthh'] = $bulan;
		$this->load->view('user/v_list_overtime',$x);
	}
	function viewGenerateOvertime(){
		$this->load->view('user/v_generate_overtime');
	}

	function ovtTrans(){
		$this->load->view('user/v_ovt_trans');
	}

	function viewMasterOvertime(){
		$year = date('Y');
		$x['monthh'] = 'JANUARY';
		$x['year']= $year;
		$x['data'] = $this->m_overtime->viewMasterOvertime($year);
		$this->load->view('user/v_listmasterovertime',$x);
	}

	function overtimetrans(){
		$thn = $this->input->post('tahunpilih');
		$ovtm = $this->db->query("SELECT * FROM master_overtime where tahun = '$thn' order by workcenter,bulan");
		$ovtc = $ovtm->num_rows();
		$this->db->query("DELETE FROM OVERTIME where tahun = '$thn'");
		foreach($ovtm->result() as $k):
		$workcenter[] = $k->workcenter;
		$seksi[] = $k->seksi;
		$dept[] = $k->dept;
		$gol1[] = $k->gol1;
		$gol2[] = $k->gol2;
		$gol3[] = $k->gol3;
		$gol4[] = $k->gol4;
		$gol5[] = $k->gol5;
		$gol6[] = $k->gol6;
		$kontrak[] = $k->kontrak;
		$bulan[] = $k->bulan;
		$tahun[] = $k->tahun;
		endforeach;
		if($ovtc>0){

			for($a=0; $a<$ovtc; $a++){
				if($gol1[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','1','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$gol1[$a]','$workcenter[$a]','1','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}
				if($gol2[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','2','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$gol2[$a]','$workcenter[$a]','2','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}
				if($gol3[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','3','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$gol3[$a]','$workcenter[$a]','3','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}
				if($gol4[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','4','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$gol4[$a]','$workcenter[$a]','4','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}
				if($gol5[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','5','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$gol5[$a]','$workcenter[$a]','5','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}if($gol6[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','6','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$gol6[$a]','$workcenter[$a]','6','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}if($kontrak[$a]==0){
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('0','$workcenter[$a]','0','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}else{
					$this->db->query("INSERT INTO OVERTIME (jam,workcenter,gol,bulan,tahun,dept,seksi)
					values('$kontrak[$a]','$workcenter[$a]','0','$bulan[$a]','$tahun[$a]','$dept[$a]','$seksi[$a]')");
				}
			}

		}
		redirect('user/c_overtime/ovtTrans');

	}

	function generateOvertime(){
		$year = date('Y');
		$data1 = $this->m_overtime->get_asumsi_overtime($year);
		$a = 0;
		$j = 0;
		foreach($data1->result_array() as $i){
			$gol[] = $i['gol'];
			$rupiah[] = $i['rupiah'];
		
		}
		$wct = $this->db->query("SELECT * FROM workcenter order by id_workcenter");
	foreach($wct->result_array() as $k){
					$id_workcenter[$a] = $k['id_workcenter'];
					$seksi[$a] = $k['Seksi'];
					$dept[$a] = $k['Dept'];
					$mpp[$j] = $this->db->query("SELECT * FROM master_mpp where workcenter = '$id_workcenter[$a]'");
											foreach($mpp[$j]->result_array() as $z){
													$gol1[$j] = $z['gol1'];
													$gol2[$j] = $z['gol2'];
													$gol3[$j] = $z['gol3'];
													$gol4[$j] = $z['gol4'];
													$gol5[$j] = $z['gol5'];
													$gol6[$j] = $z['gol6'];
													$kontrak[$j] = $z['kontrak'];
												
													if(stripos($id_workcenter[$a], '00') !== FALSE){
															echo $id_workcenter[$a];

															if($gol4[$j]==0){
														
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 4;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
																$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");

															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '4' and monthname(bulan) = 'January' and tahun = '$year' ");

															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($jam * $rupiah[4]) ;
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter' and gol='$golovt'");
															}
														}

													}

													else if($id_workcenter[$a]=='0000'||$id_workcenter[$a]=='0010'||$id_workcenter[$a]=='0020'){

														if($gol5[$j]==0){
													
															$depart = $dept[$a];
															$seksi1 = $seksi[$a];
															$jam = 0;
															$workcenter = $id_workcenter[$a];
															$golovt = 5;
															$bulan = date('Y-01-01'); 
															$tahun = $year; 
															$rp = 0;
															$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");
														$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
														values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
												}
												if($gol6[$j]==0){				
													$depart = $dept[$a];
													$seksi1 = $seksi[$a];
													$jam = 0;
													$workcenter = $id_workcenter[$a];
													$golovt = 6;
													$bulan = date('Y-01-01'); 
													$tahun = $year; 
													$rp = 0;
													$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");
												$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
												values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
										}

													}

												else{
													if($gol1[$j]==0){
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 1;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
																$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");

															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '1' and monthname(bulan) = 'January' and tahun = '$year' ");

															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($jam * $rupiah[1]);
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter' and gol='$golovt'");
															}
														}
													if($gol2[$j]==0){
														
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 2;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
																$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");

															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '2' and monthname(bulan) = 'January' and tahun = '$year' ");

															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($jam * $rupiah[2]);
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter' and gol='$golovt'");
															}
														}

													
													if($gol3[$j]==0){
														
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 3;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
																$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '3' and monthname(bulan) = 'January' and tahun = '$year' ");

															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($jam * $rupiah[3]);
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter' and gol ='$golovt'");
															}
														}

													
														if($gol4[$j]==0){
														
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 4;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
																$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");

															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '4' and monthname(bulan) = 'January' and tahun = '$year' ");

															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($jam * $rupiah[4]) ;
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter' and gol='$golovt'");
															}
														
														}
													if($kontrak[$j]==0){
														
																$depart = $dept[$a];
																$seksi1 = $seksi[$a];
																$jam = 0;
																$workcenter = $id_workcenter[$a];
																$golovt = 0;
																$bulan = date('Y-01-01'); 
																$tahun = $year; 
																$rp = 0;
																$this->db->query("DELETE FROM OVERTIME WHERE gol = '$golovt' and workcenter='$workcenter'");
															$ist = $this->db->query("INSERT INTO overtime (jam,workcenter,gol,bulan,tahun,dept,seksi,budget)
															values('$jam','$workcenter','$golovt','$bulan','$tahun','$depart','$seksi1','$rp')");
														}else{
															$ovt = $this->db->query("SELECT * FROM OVERTIME where workcenter ='$id_workcenter[$a]' and gol = '0' and monthname(bulan) = 'January' and tahun = '$year' ");

															foreach($ovt->result_array() as $m){
																$depart = $m['dept'];
																$seksi1 = $m['seksi'];
																$jam = $m['jam'];
																$workcenter = $m['workcenter'];
																$golovt = $m['gol'];
																$bulan = $m['bulan']; 
																$tahun = $year; 
																$rp = ($m['jam'] * $rupiah[0]) ;
																$this->db->query("Update overtime set budget = $rp where workcenter = '$workcenter' and gol='$golovt' ");
															}
														}

													


													$j++;
											}
										}
										
											$a++;
										}
									
									
	}

	function overtimeBatch(){
		$year=date('Y');
		$x['data1'] = $this->m_overtime->get_asumsi_overtime($year);
		$this->load->view('user/v_overtimebatch',$x);
	}

	function overtimeresult(){
		// $thnp = $this->input->post('year');
		// $cc = $this->db->query("SELECT * FROM COSTCENTER ORDER BY COSTCENTER");
		// $ccc = $cc->num_rows();

		// foreach($cc->result() as $k):
		// 	$costcenter[] = $k->costcenter;
		// endforeach;

		// $aovt = $this->db->query("SELECT * FROM ASUMSI_OVERTIME WHERE tahun = '$thnp' order by gol");
		// $aovtc = $aovt->num_rows();
		// foreach($aovt->result() as $i):
		// 	$gol[] = $i->gol;
		// 	$rupiah[] = $i->rupiah;
		// endforeach;
		
		// $budget[]=0;

		// for ($m=1; $m<=12; $m++) {
		// 	$month = date('F', mktime(0,0,0,$m, 1, date($thnp)));
		// for($n=0; $n<$ccc; $n++){
		// 		$movt[] = $this->db->query("SELECT * FROM OVERTIME where workcenter = '$costcenter[$n]' and bulan = '$month' and tahun = '$thnp' and gol in ('1','2','3','4','Kontrak') order by gol");
		// 		$movtc = $movt->num_rows();
		// 		foreach($movt[]->result() as $b):
		// 			$jam[] = $b->jam;
		// 			$golovt[] = $b->gol;
		// 		endforeach;
		// 		if($movtc[$m]>0){
		// 		for($l=0; $l<5; $l++){
		// 		if($jam[$l]!=0){
		// 			echo $jam[$l];
		// 			 $budget = $jam[$l] * $rupiah[$l];
		// 			echo '</br>';
		// 			$this->db->query("UPDATE OVERTIME SET budget = '$budget[$l]' where workcenter = '$costcenter[$n]' and bulan = '$month' and tahun = '$thnp' and gol = '$golovt[$l]' and jam <> 0");
		// 		}
		// 		}
		// 	}
		// }
		// }
		// $this->session->set_userdata('succes_generate','Data overtime berhasil dihitung');
		//redirect('user/c_overtime/viewGenerateOvertime');


		$thnp  = $this->input->post('year');
		$cc = $this->db->query("SELECT * FROM COSTCENTER ORDER BY COSTCENTER");
		$ccc = $cc->num_rows();
		$aovt = $this->db->query("SELECT * FROM ASUMSI_OVERTIME WHERE tahun = '$thnp' order by gol ");
		foreach($aovt->result_array() as $b):
				$gola[] = $b['gol'];
				$rupiah[]  = $b['rupiah'];
		endforeach;
		$n=0;
		$j=0;
		$v=0;
		for ($m=1; $m<=12; $m++) {
		$month = date('F', mktime(0,0,0,$m, 1, date($thnp)));

			foreach($cc->result_array() as $k):
				$costcenter[$n] = $k['costcenter'];
				$movt[$v] = $this->db->query("SELECT * FROM MASTER_OVERTIME WHERE workcenter = '$costcenter[$n]' and tahun = '$thnp' and bulan = '$month'
				");
				foreach($movt[$v]->result_array() as $q ):
					$wct[$v] = $q['workcenter'];
					$seksi[$v] = $q['seksi'];
					$gol1[$v] = $q['gol1'];
					$gol2[$v] = $q['gol2'];
					$gol3[$v] = $q['gol3'];
					$gol4[$v] = $q['gol4'];
					$gol5[$v] = $q['gol5'];
					$kontrak[$v] = $q['kontrak'];
					if($gol1[$v]!=0){
					//$ovt[$j] = $this->db->query("SELECT * FROM OVERTIME where workcenter = '$wct[$v]' and bulan = '$month' and tahun = '$thnp' and gol = 1");
					$budget = $rupiah[0]*$gol1[$v];
					$this->db->query("UPDATE OVERTIME SET BUDGET = '$budget' where workcenter = '$wct[$v]' and bulan = '$month' and tahun = '$thnp' and gol=1");
					}if($gol2[$v]!=0){
						$budget = $rupiah[1]*$gol2[$v];
						$this->db->query("UPDATE OVERTIME SET BUDGET = '$budget' where workcenter = '$wct[$v]' and bulan = '$month' and tahun = '$thnp' and gol=2");
					}if($gol3[$v]!=0){
						$budget = $rupiah[2]*$gol3[$v];
					$this->db->query("UPDATE OVERTIME SET BUDGET = '$budget' where workcenter = '$wct[$v]' and bulan = '$month' and tahun = '$thnp' and gol=3");
					}if($gol4[$v]!=0){
						$budget = $rupiah[3]*$gol4[$v];
						$this->db->query("UPDATE OVERTIME SET BUDGET = '$budget' where workcenter = '$wct[$v]' and bulan = '$month' and tahun = '$thnp' and gol=4");
					}if($kontrak[$v]!=0){
						$budget = $rupiah[0]*$kontrak[$v];
					$this->db->query("UPDATE OVERTIME SET BUDGET = '$budget' where workcenter = '$wct[$v]' and bulan = '$month' and tahun = '$thnp' and gol='Kontrak'");
					}
					$v++;
				endforeach;
				$n++;
			endforeach;
	
	}
	$this->session->set_flashdata('success_generate','Data Overtime berhasi di Hitung Cek Di Menu " List budget Overtime"');
	redirect('user/c_overtime/viewGenerateOvertime');
	}

    function dataMPP(){
        $x['data'] = $this->m_mpp->getMpp();
        $this->load->view('user/v_mpp',$x);
    }
    function inputMpp(){
        $data= $this->m_mpp->getMppHRC();
        foreach($data->result_array() as $i):
               $nrp = $i['Nrp'];
            $departemen = $i['Departemen'];
           
            $seksi=$i['seksi'];
            $tgl = $i['tglMasuk'];
            $golongan = $i['golongan'];
            $pangkat = $i['pangkat'];
            $costcenter = $i['CostCenter'];
            $statusKaryawan = $i['statusKaryawan'];
           $this->m_mpp->inputMpp($nrp,$costcenter,$departemen,$seksi,$golongan,$pangkat,$statusKaryawan,$tgl);
        endforeach;
	}
	function viewMpp(){
		$year = date('Y');
		$x['data'] = $this->m_mpp->viewMasterMpp($year);
		$this->load->view('user/v_mpp1',$x);
	}
	function viewMppFilter(){
		$year = $this->input->post('filter');
		$month = $this->input->post('bulan');
		$x['data'] = $this->m_mpp->viewMasterMppFilter($month,$year);
		$this->load->view('user/v_mpp1',$x);
	}

	function get_overtime(){

		$year = $this->session->userdata('thnplh1');
		//$depts = $this->session->userdata('dept');
		
		$columns = array(
			'id_master_overtime',
			'workcenter',
			'dept',
			'seksi',
			'kontrak',
			'gol1',
			'gol2',
			'gol3',
			'gol4',
			'gol5',
			'gol6',
			'bulan',
			'tahun'
			
		);

		$indexColumn = 'id_master_overtime';
		$sqlCount = "SELECT count('.$indexColumn.') AS ROW_COUNT FROM master_overtime where tahun = '$year'"  ;
		$totalRecords = $this->db->query($sqlCount)->row()->ROW_COUNT;
		
		
		$limit = '';
		$displayStart = $this->input->get_post('start',true);
		$displayLength = $this->input->get_post('length',true);

		if(isset($displayStart)&& $displayLength !='-1'){
			$limit = "LIMIT " . intval($displayStart) . ", " .
			intval($displayLength);
		}
		$uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);

        $get_param_array = explode('&', $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            $arr[$explode[0]] = $explode[1];
		}
		
		$index_of_columns = strpos($uri_string, 'columns', 1);
        $index_of_start = strpos($uri_string, 'start');
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode('&', $uri_columns);
        $arr_columns = array();
		
		foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
		}
		//sort order
		$order = ' ORDER BY ';
        $orderIndex = $arr['order[0][column]'];
        $orderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $orderIndex . '][orderable]'];
        if ($bSortable_ == 'true') {
            $order .= $columns[$orderIndex] . ($orderDir === 'asc' ? ' asc' : ' desc');
		}
			//filter
			$where = '';
			$searchVal = $arr['search[value]'];
			if (isset($searchVal) && $searchVal != '') {
				$where = "  and (";
				for ($i = 0; $i < count($columns); $i++) {
					$where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($searchVal) . "%' OR ";
				}
				$where = substr_replace($where, "", -3);
				$where .= ')';
			}
		//individual column filtering
        $searchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($columns); $i++) {
            $searchable = $arr['columns[' . $i . '][searchable]'];
            if (isset($searchable) && $searchable == 'true' && $searchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($where == '') {
                    $where = '';
                } else {
                    $where .= ' ';
                }
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
	
			//final records
			$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM  master_overtime  where tahun = "'.$year.'"' . $where  . $order . ' ' .$limit;
			$result = $this->db->query($sql);
			
			//total rows
			$sql = "SELECT FOUND_ROWS() AS length_count";
			$totalFilteredRows = $this->db->query($sql)->row()->length_count;
			
			//display structure
			$echo = $this->input->get_post('draw', true);
			$output = array(
				"draw" => intval($echo),
				"recordsTotal" => $totalRecords,
				"recordsFiltered" => $totalFilteredRows,
				"data" => array()
			);

			foreach ($result->result_array() as $cols) {
				$row = array();
				foreach ($columns as $col) {
					$row[] = $cols[$col];
				}
				array_push($row, '<button class=\'edit\'>Edit</button>&nbsp;&nbsp;');
            $output['data'][] = $row;
			}
			
			return $output;
	}

	function list_master_ovt(){
		if(empty($this->input->post('tahunpilih'))){
			$thnplh['thnplh1'] = date('Y');
			$this->session->set_userdata($thnplh);
		}else{
			$thnplh['thnplh1'] = $this->input->post('tahunpilih');
			$this->session->set_userdata($thnplh);
		}
		$this->load->view('user/v_list_master_ovt',NULL);
	}

	function get_ovt() {
		$master_ovt = $this->get_overtime();
		echo json_encode($master_ovt);
	}

	function delete_ovt($id){
		$sql = 'DELETE FROM ' . $this->master_overtime . ' WHERE id_master_overtime=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	function delete_overtime() {
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;
		
		if($this->delete_ovt($id) === TRUE) {
			return TRUE;
		}
		
		return FALSE;
	}
	function update_overtime() {
		$id = $_POST['id_master_overtime'];
		$workcenter = $_POST['workcenter'];
		$seksi = $_POST['seksi'];
		$dept = $_POST['dept'];
		$kontrak = $_POST['kontrak'];
		$gol1 = $_POST['gol1'];
		$gol2 = $_POST['gol2'];
		$gol3 = $_POST['gol3'];
		$gol4 = $_POST['gol4'];
		$gol5 = $_POST['gol5'];
		$gol6 = $_POST['gol6'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		if($this->m_overtime->update_ovt($id, $workcenter, $seksi, $dept, $kontrak, $gol1, $gol2,$gol3,$gol4,$gol5,$gol6,$bulan,$tahun) === TRUE) {
			return TRUE;
		}
		
		return FALSE;
	}

	
}
