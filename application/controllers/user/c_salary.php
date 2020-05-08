<?php

Class C_salary extends CI_Controller{
	function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==''){
            redirect('login');
        }
        $this->load->model('user/m_salary');
	}
	
	function generate_salary(){
		$this->load->view('user/v_generate_salary');
	}
	function hitung_salary(){
		$jmt=0;
		$thn = $this->input->post('tahun');
		$yr = $this->input->post('year');
		$this->db->query("DELETE from salary where tahun = '$yr'");
		$wcts = $this->db->query("SELECT * FROM costcenter order by costcenter");
		$wctsc = $wcts->num_rows();
		foreach($wcts->result() as $cc):
			$costcenter[] = $cc->costcenter;
		endforeach;
		$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yr' order by gol,pangkat");
		$casumsigp = $asumsigp->num_rows();
		foreach($asumsigp->result() as $gp):
			$golgp[] = $gp->gol;
			$pangkatgp[] = $gp->pangkat;
			$rupiahgp[] = $gp->rupiah;
		endforeach;
		$asumsiovt = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$yr' order by gol ");
		$casumsiovt = $asumsiovt->num_rows();
		foreach($asumsiovt->result() as $ovt):
			$rupiahvt[] = $ovt->rupiah;
		endforeach;
		$asumsitjh = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yr' order by gol ");
		foreach($asumsitjh->result() as $tjh):
			$golhdr[] = $tjh->gol;
			$rupiahhdr[] = $tjh->rupiah;
		endforeach;
		$asumsitrspt = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$yr'");
		foreach($asumsitrspt->result() as $trspt):
			$goltrspt[]=$trspt->gol;
			$rupiahtrspt[]=$trspt->rupiah;
		endforeach;
		$asumsiobt = $this->db->query("SELECT * FROM asumsi_medical_expense_obat where tahun = '$yr' order by gol");
		foreach($asumsiobt->result() as $obt):
			$golobt[] = $obt->gol;
			$rupiahobt[] = $obt->rupiah;
		endforeach;
		$asumsimeal = $this->db->query("SELECT * FROM meal where tahun = '$yr' ");
		foreach($asumsimeal->result() as $meal):
			$rupiahmeal[] =  $meal->rupiah;
		endforeach;
		$asumsipuasa = $this->db->query("SELECT * FROM meal_puasa where tahun = '$yr' ");
		foreach($asumsipuasa->result() as $ps):
			$rupiahpuasa[] = $ps->rupiah;
		endforeach;
		$asumsibpjs = $this->db->query("SELECT * FROM asumsi_medical_expense_bpjs where tahun = '$yr' order by gol");
		foreach($asumsibpjs->result() as $bpjs):
			$golbpjs[] = $bpjs->gol;
			$rupiahbpjs[] = $bpjs->rupiah;
		endforeach;
		$asumsihspt = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$yr' order by gol");
		foreach($asumsihspt->result() as $hspt):
			$golhspt[] = $hspt->gol;
			$rupiahhspt90[] = $hspt->rp90;
			$rupiahhspt10[] = $hspt->rp10;
			$rupiahhspt100[] = $hspt->rp100;
		endforeach;
		$asumsihs = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$yr' order by gol");
		foreach($asumsihs->result() as $hs):
		$golhs[] = $hs->gol;
		$rupiahhs[] = $hs->rupiah;
		endforeach;
		$asumsidon = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$yr' order by gol ");
		foreach($asumsidon->result() as $don):
			$goldon[] = $don->gol;
			$rupiahdon[] = $don->rupiah;
		endforeach;
		$asumsitlk = $this->db->query("SELECT * FROM asumsi_telekomunikasi where tahun = '$yr' order by gol");
		foreach($asumsitlk->result() as $tlk):
			$goltlk[] = $tlk->gol;
			$rupiahtlk[] = $tlk->rupiah;
		endforeach;
		$asumsifunc = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$yr' order by gol");
		foreach($asumsifunc->result() as $func): 
			$golfunc[] = $func->gol;
			$rupiahfunc[] =$func->rupiah;
		endforeach;
		$asumsithr = $this->db->query("SELECT * FROM asumsi_thr where tahun = '$yr' order by gol ");
		foreach($asumsithr->result() as $thr):
			$golthr[] = $thr->gol;
			$rupiahthr[] = $thr->rupiah;
			endforeach;
		$asumsibon = $this->db->query("SELECT * FROM asumsi_bonus where tahun = '$yr' order by gol");
		foreach($asumsibon->result() as $bon):
			$golbon[] = $bon->gol;
			$rupiahbon[] = $bon->rupiah;
		endforeach;
		$asumsijms = $this->db->query("SELECT * FROM asumsi_manpowerinsurance where tahun = '$yr' order by gol,pangkat");
		foreach($asumsijms->result() as $jms):
			$goljms[] = $jms->gol;
			$rupiahjms[] = $jms->rupiah;
		endforeach;
		$asumsipnsdpa = $this->db->query("SELECT * FROM asumsi_pensiondpa where tahun = '$yr' order by gol,pangkat");
		foreach($asumsipnsdpa->result() as $pnsdpa):
			$golpnsdpa[] = $pnsdpa->gol;
			$rupiahpnsdpa[] = $pnsdpa->rupiah;
		endforeach;
		
		$asumsipnsbpjs = $this->db->query("SELECT * FROM asumsi_pensionbpjs where tahun = '$yr' order by gol,pangkat");
		foreach($asumsipnsbpjs->result() as $pnsbpjs):
			$golpnsbpjs[] = $pnsbpjs->gol;
			$rupiahpnsbpjs[] = $pnsbpjs->rupiah;
		endforeach;

		$asumsihd = $this->db->query("SELECT * FROM asumsi_holiday_allowance where tahun = '$yr' order by gol,pangkat");
		foreach($asumsihd->result() as $hd):
			$golhd[] = $hd->gol;
			$pangkathd[] = $hd->pangkat;
			$rupiahhd[] = $hd->rupiah;
		endforeach;

		$cekactv = $this->db->query("SELECT * FROM tax_active");
		foreach($cekactv->result() as $av):
			$acvc[] = $av->active;
		endforeach;
		
		
		for ($m=1; $m<=12; $m++) {
			 $month = date('F', mktime(0,0,0,$m, 1, date($yr)));
				
				$mppt=$this->db->query("SELECT count(gol) as jmlhmpp,workcenter,dept,seksi,gol,pangkat,statuspernikahan,tglmasuk FROM mpp_trans where 
				  tahun= '$yr' and bulan = '$month' and pangkat <> '-' group by gol,pangkat,workcenter,tglmasuk order by gol,workcenter desc");
				 $mpptc = $mppt->num_rows();
				 if($mpptc>0){
				foreach($mppt->result_array() as $mpt ):
						$wctmpp[$jmt] = $mpt['workcenter'];
					',';
						$seksimpp[$jmt] = $mpt['seksi'];
						',';
						$deptmpp[$jmt] = $mpt['dept'];
						',';
						$golmpp[$jmt] = $mpt['gol'];
					',';
						$tlmsk[$jmt] = $mpt['tglmasuk'];

					$pangkatmpp[$jmt] = $mpt['pangkat'];
					 '</br>';
					$jmlhmpp[$jmt] = $mpt['jmlhmpp'];
						$sp[$jmt] = $mpt['statuspernikahan'];
						if ($golmpp[$jmt] == 1 && $pangkatmpp[$jmt]=='E' ) {
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[1];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[1];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtrspt[0]*22;
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[1];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[1];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[1];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[1];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[1];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[1];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[1];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[1];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[1];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[1];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[1];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[1];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								
							
								if($acvc[1]=='1'){
								$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
								and statuspernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
						}else{
							$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
							and status_pernikahan = '$sp[$jmt]' ");
							$pph21c = $pph21->num_rows();
							if($pph21c==0){
								$pph21bz = 0;
							}else{
							foreach($pph21->result_array() as $p):
								$pph21bz = $p['rupiahbln'];
								$sspph21 = $p['statuspernikahan'];
							endforeach;
						}
						}
						$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[1];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[1];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[1];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								

								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
								$sovtbln[$jmt] = $budgetovt[$jmt];
								$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
								$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
								$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
								$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
								$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
						
						}elseif ($golmpp[$jmt]==1 && $pangkatmpp[$jmt] == 'F'){
							    $salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[2];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[1];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[1];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[2];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[1];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[1];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[1];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[1];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[1];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[1];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[1];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[1];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[2];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[1];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								
							
								if($acvc[1]=='1'){
								$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
								and statuspernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
								}else{
							$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
							and status_pernikahan = '$sp[$jmt]' ");
							$pph21c = $pph21->num_rows();
							if($pph21c==0){
								$pph21bz = 0;
							}else{
							foreach($pph21->result_array() as $p):
								$pph21bz = $p['rupiahbln'];
								$sspph21 = $p['statuspernikahan'];
							endforeach;
						}
						}
							$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[2];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[2];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[2];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
						
							}
						elseif($golmpp[$jmt]==2 && $pangkatmpp[$jmt]=='A'){
							$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[3];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[2];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[2];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[3];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[2];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[2];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[2];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[2];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[2];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[2];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[2];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[2];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[3];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[2];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								
								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' and pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}

								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[3];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[3];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[3];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $rhda[$jmt]+$salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','$rhda[$jmt]','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','$rhda[$jmt]','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','$rhda[$jmt]','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','$rhda[$jmt]','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
										}
									else{

								}	
						
							}elseif($golmpp[$jmt]==2 && $pangkatmpp[$jmt]=='B'){
								
							$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[4];
							$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[2];
							$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
							$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[2];
							$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[4];
							$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[2];
							$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[2];
							$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[2];
							$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[2];
							$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[2];
							$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[2];
							$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[2];
							$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[2];
							$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
							$asumsipuasac = $asumsipuasa->num_rows();
							if($asumsipuasac==0){
								$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
								$sthrbln[$jmt] = 0;
							}else{
								$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
								$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[4];
							}
							if($month=='December'){
								$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[2];
								
							}else{
								$sbonbln[$jmt] = 0;
							}

							if($month=='January'){
								$dt[$jmt]=date('Y-01-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='February'){
								$dt[$jmt]=date('Y-02-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='March'){
								$dt[$jmt]=date('Y-03-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='April'){
								$dt[$jmt]=date('Y-04-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='May'){
								$dt[$jmt]=date('Y-05-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='June'){
								$dt[$jmt]=date('Y-06-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif ($month=='July'){
								$dt[$jmt]=date('Y-07-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='August'){
								$dt[$jmt]=date('Y-08-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif ($month=='September'){
								$dt[$jmt]=date('Y-09-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='October'){
								$dt[$jmt]=date('Y-10-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='November'){
								$dt[$jmt]=date('Y-11-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='December'){
								$dt[$jmt]=date('Y-12-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}else{

							}
							
							if($acvc[1]=='1'){
								$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
								and statuspernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
								}else{
							$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
							and status_pernikahan = '$sp[$jmt]' ");
							$pph21c = $pph21->num_rows();
							if($pph21c==0){
								$pph21bz = 0;
							}else{
							foreach($pph21->result_array() as $p):
								$pph21bz = $p['rupiahbln'];
								$sspph21 = $p['statuspernikahan'];
							endforeach;
						}
						}
							$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
							$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[4];
							$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[4];
							$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[4];
							$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
							
							$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
							and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
							$ovtblnc = $ovtbln->num_rows();
							if($ovtblnc==0){
								$budgetovt[$jmt]=0;
							}else{
							
							foreach($ovtbln->result_array() as $ovtn){
								$budgetovt[$jmt] = $ovtn['budget']; 
							}
						}
						$sovtbln[$jmt] = $budgetovt[$jmt];
						$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
						$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
						$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
						$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
						$tlc[$jmt] = 0;
						if($sp[$jmt]=='S/0'){
							$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
							lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
							housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
							pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
							) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
							'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
							'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
							'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
							}elseif($sp[$jmt]=='M/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
							}elseif($sp[$jmt]=='M/1'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
							}elseif($sp[$jmt]=='M/2'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}else{

							}	
					
							}elseif($golmpp[$jmt]==2 && $pangkatmpp[$jmt]=='C'){
							
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[5];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[2];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[2];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[5];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[2];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[2];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[2];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[2];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[2];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[2];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[2];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[2];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*$rupiahmeal[0];
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[5];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[2];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
							
								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'s");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}

								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[5];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[5];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[5];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
						
							}elseif($golmpp[$jmt]==2 && $pangkatmpp[$jmt]=='D'){
								
							$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[6];
							$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[2];
							$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
							$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[2];
							$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[6];
							$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[2];
							$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[2];
							$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[2];
							$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[2];
							$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[2];
							$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[2];
							$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[2];
							$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[2];
							$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
							$asumsipuasac = $asumsipuasa->num_rows();
							if($asumsipuasac==0){
								$smealbln[$jmt] = $jmlhmpp[$jmt]*$rupiahmeal[0];
								$sthrbln[$jmt] = 0;
							}else{
								$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
								$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[6];
							}
							if($month=='December'){
								$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[2];
								
							}else{
								$sbonbln[$jmt] = 0;
							}

							if($month=='January'){
								$dt[$jmt]=date('Y-01-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='February'){
								$dt[$jmt]=date('Y-02-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='March'){
								$dt[$jmt]=date('Y-03-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='April'){
								$dt[$jmt]=date('Y-04-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='May'){
								$dt[$jmt]=date('Y-05-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='June'){
								$dt[$jmt]=date('Y-06-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif ($month=='July'){
								$dt[$jmt]=date('Y-07-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='August'){
								$dt[$jmt]=date('Y-08-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif ($month=='September'){
								$dt[$jmt]=date('Y-09-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='October'){
								$dt[$jmt]=date('Y-10-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='November'){
								$dt[$jmt]=date('Y-11-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}elseif($month=='December'){
								$dt[$jmt]=date('Y-12-01');
								$dts[$jmt] = strtotime($dt[$jmt]);
								$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
								$months = 0;
								while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
										$months++;
								if($months==60){
									$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
									and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
									foreach($hds->result_array() as $ha):
										$rphda = $ha['rupiah'];
									endforeach;
									$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
								}else{
									$rhda[$jmt]=0;
								}
							}else{

							}
							
							if($acvc[1]=='1'){
								$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
								and statuspernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
								}else{
							$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
							and status_pernikahan = '$sp[$jmt]' ");
							$pph21c = $pph21->num_rows();
							if($pph21c==0){
								$pph21bz = 0;
							}else{
							foreach($pph21->result_array() as $p):
								$pph21bz = $p['rupiahbln'];
								$sspph21 = $p['statuspernikahan'];
							endforeach;
						}
						}
							$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
							$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[6];
							$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[6];
							$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[6];
							$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
							
							$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
							and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
							$ovtblnc = $ovtbln->num_rows();
							if($ovtblnc==0){
								$budgetovt[$jmt]=0;
							}else{
							
							foreach($ovtbln->result_array() as $ovtn){
								$budgetovt[$jmt] = $ovtn['budget']; 
							}
						}
						$sovtbln[$jmt] = $budgetovt[$jmt];
						$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
						$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
						$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
						$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
						$tlc[$jmt] = 0;
						if($sp[$jmt]=='S/0'){
							$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
							lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
							housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
							pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
							) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
							'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
							'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
							'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
							}elseif($sp[$jmt]=='M/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
							}elseif($sp[$jmt]=='M/1'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
							}elseif($sp[$jmt]=='M/2'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

							}	
					
							}elseif($golmpp[$jmt]==2 && $pangkatmpp[$jmt]=='E'){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[7];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[2];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[2];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[7];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[2];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[2];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[2];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[2];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[2];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[2];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[2];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[2];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*$rupiahmeal[0];
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[7];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[2];
									
								}else{
									$sbonbln[$jmt] = 0;
								}

								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '2'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[7];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[7];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[7];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
						
							}
								elseif($golmpp[$jmt]==3 && $pangkatmpp[$jmt]=='A'){			
									$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[8];
									$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[3];
									$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
									$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[3];
									$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[8];
									$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[3];
									$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[3];
									$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[3];
									$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[3];
									$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[3];
									$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[3];
									$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[3];
									$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[3];
									$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
									$asumsipuasac = $asumsipuasa->num_rows();
									if($asumsipuasac==0){
										$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
										$sthrbln[$jmt] = 0;
									}else{
										$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
										$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[8];
									}
									if($month=='December'){
										$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[3];
										
									}else{
										$sbonbln[$jmt] = 0;
									}

									if($month=='January'){
										$dt[$jmt]=date('Y-01-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='February'){
										$dt[$jmt]=date('Y-02-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='March'){
										$dt[$jmt]=date('Y-03-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='April'){
										$dt[$jmt]=date('Y-04-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='May'){
										$dt[$jmt]=date('Y-05-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='June'){
										$dt[$jmt]=date('Y-06-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='July'){
										$dt[$jmt]=date('Y-07-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='August'){
										$dt[$jmt]=date('Y-08-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='September'){
										$dt[$jmt]=date('Y-09-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]' ");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='October'){
										$dt[$jmt]=date('Y-10-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='November'){
										$dt[$jmt]=date('Y-11-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='December'){
										$dt[$jmt]=date('Y-12-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}else{
	
									}
									
									if($acvc[1]=='1'){
										$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
										and statuspernikahan = '$sp[$jmt]' ");
										$pph21c = $pph21->num_rows();
										if($pph21c==0){
											$pph21bz = 0;
										}else{
										foreach($pph21->result_array() as $p):
											$pph21bz = $p['rupiahbln'];
											$sspph21 = $p['statuspernikahan'];
										endforeach;
									}
										}else{
									$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
									and status_pernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
								}
									$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
									$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[8];
									$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[8];
									$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[8];
									$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
									
									$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
									and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
									$ovtblnc = $ovtbln->num_rows();
									if($ovtblnc==0){
										$budgetovt[$jmt]=0;
									}else{
									
									foreach($ovtbln->result_array() as $ovtn){
										$budgetovt[$jmt] = $ovtn['budget']; 
									}
								}
								$sovtbln[$jmt] = $budgetovt[$jmt];
								$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
								$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
								$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
								$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
								$tlc[$jmt] = 0;
								if($sp[$jmt]=='S/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/0'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/1'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/2'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{
	
									}	
							
							}elseif($golmpp[$jmt]==3 && $pangkatmpp[$jmt]=='B'){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[9];
									$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[3];
									$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
									$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[3];
									$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[9];
									$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[3];
									$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[3];
									$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[3];
									$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[3];
									$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[3];
									$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[3];
									$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[3];
									$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[3];
									$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
									$asumsipuasac = $asumsipuasa->num_rows();
									if($asumsipuasac==0){
										$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
										$sthrbln[$jmt] = 0;
									}else{
										$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
										$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[9];
									}
									if($month=='December'){
										$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[3];
										
									}else{
										$sbonbln[$jmt] = 0;
									}

									if($month=='January'){
										$dt[$jmt]=date('Y-01-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='February'){
										$dt[$jmt]=date('Y-02-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='March'){
										$dt[$jmt]=date('Y-03-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='April'){
										$dt[$jmt]=date('Y-04-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='May'){
										$dt[$jmt]=date('Y-05-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='June'){
										$dt[$jmt]=date('Y-06-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='July'){
										$dt[$jmt]=date('Y-07-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='August'){
										$dt[$jmt]=date('Y-08-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='September'){
										$dt[$jmt]=date('Y-09-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='October'){
										$dt[$jmt]=date('Y-10-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='November'){
										$dt[$jmt]=date('Y-11-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='December'){
										$dt[$jmt]=date('Y-12-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}else{
	
									}
									
									if($acvc[1]=='1'){
										$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
										and statuspernikahan = '$sp[$jmt]' ");
										$pph21c = $pph21->num_rows();
										if($pph21c==0){
											$pph21bz = 0;
										}else{
										foreach($pph21->result_array() as $p):
											$pph21bz = $p['rupiahbln'];
											$sspph21 = $p['statuspernikahan'];
										endforeach;
									}
										}else{
									$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
									and status_pernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
								}
									$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
									$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[9];
									$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[9];
									$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[9];
									$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
									
									$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$wctmpp[$jmt]'
									and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
									$ovtblnc = $ovtbln->num_rows();
									if($ovtblnc==0){
										$budgetovt[$jmt]=0;
									}else{
									
									foreach($ovtbln->result_array() as $ovtn){
										$budgetovt[$jmt] = $ovtn['budget']; 
									}
								}
								$sovtbln[$jmt] = $budgetovt[$jmt];
								$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
								$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
								$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
								$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
								$tlc[$jmt] = 0;
								if($sp[$jmt]=='S/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/0'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/1'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/2'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{
	
									}	
							
							}elseif($golmpp[$jmt]==3 && $pangkatmpp[$jmt]=='C'){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[10];
									$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[3];
									$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
									$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[3];
									$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[10];
									$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[3];
									$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[3];
									$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[3];
									$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[3];
									$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[3];
									$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[3];
									$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[3];
									$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[3];
									$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
									$asumsipuasac = $asumsipuasa->num_rows();
									if($asumsipuasac==0){
										$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
										$sthrbln[$jmt] = 0;
									}else{
										$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
										$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[10];
									}
									if($month=='December'){
										$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[3];
										
									}else{
										$sbonbln[$jmt] = 0;
									}

									if($month=='January'){
										$dt[$jmt]=date('Y-01-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='February'){
										$dt[$jmt]=date('Y-02-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='March'){
										$dt[$jmt]=date('Y-03-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='April'){
										$dt[$jmt]=date('Y-04-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='May'){
										$dt[$jmt]=date('Y-05-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='June'){
										$dt[$jmt]=date('Y-06-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='July'){
										$dt[$jmt]=date('Y-07-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='August'){
										$dt[$jmt]=date('Y-08-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='September'){
										$dt[$jmt]=date('Y-09-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='October'){
										$dt[$jmt]=date('Y-10-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='November'){
										$dt[$jmt]=date('Y-11-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='December'){
										$dt[$jmt]=date('Y-12-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}else{
	
									}
									
									if($acvc[1]=='1'){
										$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
										and statuspernikahan = '$sp[$jmt]' ");
										$pph21c = $pph21->num_rows();
										if($pph21c==0){
											$pph21bz = 0;
										}else{
										foreach($pph21->result_array() as $p):
											$pph21bz = $p['rupiahbln'];
											$sspph21 = $p['statuspernikahan'];
										endforeach;
									}
										}else{
									$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
									and status_pernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
								}
									$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
									$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[10];
									$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[10];
									$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[10];
									$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
									
									$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
									and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
									$ovtblnc = $ovtbln->num_rows();
									if($ovtblnc==0){
										$budgetovt[$jmt]=0;
									}else{
									
									foreach($ovtbln->result_array() as $ovtn){
										$budgetovt[$jmt] = $ovtn['budget']; 
									}
								}
								$sovtbln[$jmt] = $budgetovt[$jmt];
								$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
								$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
								$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
								$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
								$tlc[$jmt] = 0;
								if($sp[$jmt]=='S/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/0'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/1'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/2'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{
	
									}	
							
							}elseif($golmpp[$jmt]==3 && $pangkatmpp[$jmt]=='D'){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[11];
									$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[3];
									$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
									$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[3];
									$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[11];
									$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[3];
									$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[3];
									$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[3];
									$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[3];
									$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[3];
									$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[3];
									$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[3];
									$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[3];
									$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
									$asumsipuasac = $asumsipuasa->num_rows();
									if($asumsipuasac==0){
										$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
										$sthrbln[$jmt] = 0;
									}else{
										$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
										$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[11];
									}
									if($month=='December'){
										$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[3];
										
									}else{
										$sbonbln[$jmt] = 0;
									}

									if($month=='January'){
										$dt[$jmt]=date('Y-01-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' ");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='February'){
										$dt[$jmt]=date('Y-02-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='March'){
										$dt[$jmt]=date('Y-03-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='April'){
										$dt[$jmt]=date('Y-04-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='May'){
										$dt[$jmt]=date('Y-05-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='June'){
										$dt[$jmt]=date('Y-06-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='July'){
										$dt[$jmt]=date('Y-07-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='August'){
										$dt[$jmt]=date('Y-08-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif ($month=='September'){
										$dt[$jmt]=date('Y-09-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='October'){
										$dt[$jmt]=date('Y-10-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='November'){
										$dt[$jmt]=date('Y-11-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}elseif($month=='December'){
										$dt[$jmt]=date('Y-12-01');
										$dts[$jmt] = strtotime($dt[$jmt]);
										$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
										$months = 0;
										while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
												$months++;
										if($months==60){
											$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
											and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
											foreach($hds->result_array() as $ha):
												$rphda = $ha['rupiah'];
											endforeach;
											$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
										}else{
											$rhda[$jmt]=0;
										}
									}else{
	
									}
									
									if($acvc[1]=='1'){
										$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
										and statuspernikahan = '$sp[$jmt]' ");
										$pph21c = $pph21->num_rows();
										if($pph21c==0){
											$pph21bz = 0;
										}else{
										foreach($pph21->result_array() as $p):
											$pph21bz = $p['rupiahbln'];
											$sspph21 = $p['statuspernikahan'];
										endforeach;
									}
										}else{
									$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
									and status_pernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
								}
									$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
									$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[11];
									$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[11];
									$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[11];
									$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
									
									$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
									and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
									$ovtblnc = $ovtbln->num_rows();
									if($ovtblnc==0){
										$budgetovt[$jmt]=0;
									}else{
									
									foreach($ovtbln->result_array() as $ovtn){
										$budgetovt[$jmt] = $ovtn['budget']; 
									}
								}
								$sovtbln[$jmt] = $budgetovt[$jmt];
								$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
								$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
								$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
								$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
								$tlc[$jmt] = 0;
								if($sp[$jmt]=='S/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/0'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/1'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
									}elseif($sp[$jmt]=='M/2'){
										$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
										lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
										housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
										pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
										) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
										'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
										'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
										'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{
	
									}	
							
							}elseif($golmpp[$jmt]==3 && $pangkatmpp[$jmt]=='E'){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[12];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[3];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[3];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[12];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[3];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[3];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[3];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[3];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[3];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[3];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[3];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[3];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[12];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[3];
									
								}else{
									$sbonbln[$jmt] = 0;
								}

								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '3'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[12];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[12];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[12];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
						
							}elseif($golmpp[$jmt]=='4' && $pangkatmpp[$jmt]=='A'){
								
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[13];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[4];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[13];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[4];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[4];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[4];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[4];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[4];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[4];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[4];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[13];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[4];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								
								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}

								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[13];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[13];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[13];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
							}elseif($golmpp[$jmt]==4 && $pangkatmpp[$jmt]=='B'){
						
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[14];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[4];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[14];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[4];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[4];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[4];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[4];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[4];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[4];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[4];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[14];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[4];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[14];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[14];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[14];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
							}elseif($golmpp[$jmt]==4 && $pangkatmpp[$jmt]=='C'){
								echo $golmpp[$jmt];
									
						    $salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[15];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[4];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[15];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[4];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[4];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[4];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[4];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[4];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[4];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[4];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[15];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[4];
									
								}else{
									$sbonbln[$jmt] = 0;
								}

								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[15];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[15];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[15];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
							}elseif($golmpp[$jmt]==4 && $pangkatmpp[$jmt]=='D'){
								
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[16];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[4];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[16];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[4];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[4];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[4];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[4];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[4];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[4];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[4];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasa==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[16];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[4];
									
								}else{
									$sbonbln[$jmt] = 0;
								}

								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[16];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[16];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[16];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
							}elseif($golmpp[$jmt]==4 && $pangkatmpp[$jmt]=='E'){
								
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[17];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[4];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[17];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[4];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[4];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[4];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[4];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[4];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[4];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[4];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasa==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[17];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[4];
									
								}else{
									$sbonbln[$jmt] = 0;
								}

								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '4'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[17];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[17];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[17];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[4];
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
							}elseif($golmpp[$jmt]==5 && $pangkatmpp[$jmt]=='A'){
								
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[18];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[5];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[18];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[5];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[5];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[5];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[5];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[5];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[5];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[5];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[5];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasa==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[18];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[5];
									
								}else{
									$sbonbln[$jmt] = 0;
								}

								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '5'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[18];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[18];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[18];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[5];
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	
									}
									else{

								}	
							}elseif($golmpp[$jmt]==6 && $pangkatmpp[$jmt]=='A'){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[19];
								$shadirbln[$jmt] = 0;
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = 0;
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[19];
								$shspt10bln[$jmt] = 0;
								$shspt90bln[$jmt] = 0;
								$shspt100bln[$jmt] =0;
								$srmhbln[$jmt] = 0;
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[6];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[6];
								$stlkmbln[$jmt] = 0;
								$sfuncbln[$jmt] = 0;
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[19];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[6];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								
								if($month=='January'){
									$dt[$jmt]=date('Y-01-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='February'){
									$dt[$jmt]=date('Y-02-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='March'){
									$dt[$jmt]=date('Y-03-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='April'){
									$dt[$jmt]=date('Y-04-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='May'){
									$dt[$jmt]=date('Y-05-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='June'){
									$dt[$jmt]=date('Y-06-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='July'){
									$dt[$jmt]=date('Y-07-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='August'){
									$dt[$jmt]=date('Y-08-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif ($month=='September'){
									$dt[$jmt]=date('Y-09-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='October'){
									$dt[$jmt]=date('Y-10-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='November'){
									$dt[$jmt]=date('Y-11-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}elseif($month=='December'){
									$dt[$jmt]=date('Y-12-01');
									$dts[$jmt] = strtotime($dt[$jmt]);
									$tlsmsks[$jmt]=strtotime($tlmsk[$jmt]);
									$months = 0;
									while (($tlsmsks[$jmt] = strtotime('+1 MONTH', $tlsmsks[$jmt])) <= $dts[$jmt]);
											$months++;
									if($months==60){
										$hds=$this->db->query("SELECT * FROM asumsi_holiday_allowance where gol = '6'
										and tahun ='$yr' pangkat = '$pangkatmpp[$jmt]'");
										foreach($hds->result_array() as $ha):
											$rphda = $ha['rupiah'];
										endforeach;
										$rhda[$jmt] = $rphda*$jmlhmpp[$jmt]; 
									}else{
										$rhda[$jmt]=0;
									}
								}else{

								}

								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[19];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[19];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[19];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
							$sovtbln[$jmt] = $budgetovt[$jmt];
							$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
							$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
							$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
							$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
							$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
							}elseif($golmpp[$jmt]==0 ){
								$salarybln[$jmt] = $jmlhmpp[$jmt] * $rupiahgp[0];
								$shadirbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhdr[0];
								$strsptbln[$jmt] = $jmlhmpp[$jmt] * ($rupiahtrspt[0]*22);
								$sobtbln[$jmt] = $jmlhmpp[$jmt] * $rupiahobt[0];
								$sbpjsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbpjs[0];
								$shspt10bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt10[0];
								$shspt90bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt90[0];
								$shspt100bln[$jmt] = $jmlhmpp[$jmt] * $rupiahhspt100[0];
								$srmhbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhs[0];
								$shdbln[$jmt] = $jmlhmpp[$jmt] * $rupiahhd[0];
								$sdonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahdon[0];
								$stlkmbln[$jmt] = $jmlhmpp[$jmt] * $rupiahtlk[0];
								$sfuncbln[$jmt] = $jmlhmpp[$jmt] * $rupiahfunc[0];
								$asumsipuasa = $this->db->query("SELECT * FROM puasa where tahun ='$yr' and bulan = '$month'");
								$asumsipuasac = $asumsipuasa->num_rows();
								if($asumsipuasac==0){
									$smealbln[$jmt] = $jmlhmpp[$jmt]*($rupiahmeal[0]*22);
									$sthrbln[$jmt] = 0;
								}else{
									$smealbln[$jmt] = $jmlhmpp[$jmt] * $rupiahpuasa[0];
									$sthrbln[$jmt] = $jmlhmpp[$jmt] * $rupiahthr[0];
								}
								if($month=='December'){
									$sbonbln[$jmt] = $jmlhmpp[$jmt] * $rupiahbon[0];
									
								}else{
									$sbonbln[$jmt] = 0;
								}
								
								if($acvc[1]=='1'){
									$pph21 = $this->db->query("SELECT * FROM pph21 where gol='$golmpp[$jmt]' and pangkat ='$pangkatmpp[$jmt]'
									and statuspernikahan = '$sp[$jmt]' ");
									$pph21c = $pph21->num_rows();
									if($pph21c==0){
										$pph21bz = 0;
									}else{
									foreach($pph21->result_array() as $p):
										$pph21bz = $p['rupiahbln'];
										$sspph21 = $p['statuspernikahan'];
									endforeach;
								}
									}else{
								$pph21 = $this->db->query("SELECT * FROM tax_manual where gol='$golmpp[$jmt]' and sub_golongan ='$pangkatmpp[$jmt]'
								and status_pernikahan = '$sp[$jmt]' ");
								$pph21c = $pph21->num_rows();
								if($pph21c==0){
									$pph21bz = 0;
								}else{
								foreach($pph21->result_array() as $p):
									$pph21bz = $p['rupiahbln'];
									$sspph21 = $p['statuspernikahan'];
								endforeach;
							}
							}
								$pph21b[$jmt]= $jmlhmpp[$jmt] * $pph21bz;
								$sjmsbln[$jmt] = $jmlhmpp[$jmt] * $rupiahjms[0];
								$pnsdpaa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsdpa[0];
								$pnsbpjsa[$jmt] = $jmlhmpp[$jmt] * $rupiahpnsbpjs[0];
								$pensiondpabpjs[$jmt] = $pnsdpaa[$jmt] + $pnsbpjsa[$jmt];
								
								$ovtbln = $this->db->query("SELECT * FROM overtime where workcenter = '$costcenter[$jmt]'
								and bulan = '$month' and tahun = '$yr' and gol = '$golmpp[$jmt]' ");
								$ovtblnc = $ovtbln->num_rows();
								if($ovtblnc==0){
									$budgetovt[$jmt]=0;
								}else{
								
								foreach($ovtbln->result_array() as $ovtn){
									$budgetovt[$jmt] = $ovtn['budget']; 
								}
							}
								$sovtbln[$jmt] = $budgetovt[$jmt];
								$tot[$jmt] = $salarybln[$jmt]+$shadirbln[$jmt]+$strsptbln[$jmt]+$sobtbln[$jmt]+$sbpjsbln[$jmt]+
								$shspt90bln[$jmt]+$shspt10bln[$jmt]+$shspt100bln[$jmt]+$srmhbln[$jmt]+$sdonbln[$jmt]+$stlkmbln[$jmt]+
								$sfuncbln[$jmt]+$smealbln[$jmt]+$sthrbln[$jmt]+$sbonbln[$jmt]+$sjmsbln[$jmt]+
								$pensiondpabpjs[$jmt]+$sovtbln[$jmt];
								$tlc[$jmt] = 0;
							if($sp[$jmt]=='S/0'){
								$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
								lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
								housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
								pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
								) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
								'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
								'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
								'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/0'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/1'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");
								}elseif($sp[$jmt]=='M/2'){
									$this->db->query("INSERT INTO salary (workcenter,seksi,dept,gol,gp,incentive,bonus,
									lembur,uang_hadir,transporttasi,meal,holiday_allowance,function_allowance,man_power,
									housing_allowance,income_tax,thr,medical_bpjs,medical_obat,hospitalization,hospitalization2,pension_dpa,
									pension_bpjs,bulan,tahun,donation,mp,pension,pangkat,statuspernikahan,telecomunication
									) values ('$wctmpp[$jmt]','$seksimpp[$jmt]','$deptmpp[$jmt]','$golmpp[$jmt]','$salarybln[$jmt]',
									'0','$sbonbln[$jmt]','$sovtbln[$jmt]','$shadirbln[$jmt]','$strsptbln[$jmt]','$smealbln[$jmt]','0','$sfuncbln[$jmt]','$sjmsbln[$jmt]',
									'$srmhbln[$jmt]','$pph21b[$jmt]','$sthrbln[$jmt]','$sbpjsbln[$jmt]','$sobtbln[$jmt]','$shspt90bln[$jmt]','$shspt10bln[$jmt]','0','0','$month',
									'$yr','$sdonbln[$jmt]','$jmlhmpp[$jmt]','$pensiondpabpjs[$jmt]','$pangkatmpp[$jmt]','$sp[$jmt]',$tlc[$jmt])");	}else{

								}	
										
							}else{

							}
							 $jmt++;
						endforeach;
									}else{

									}
														
				

			
			
		}
		$this->session->set_flashdata('success_gnt','Data berhasil di generate');
redirect('user/c_salary/generate_salary');
	}

function hitung() {
	$jmt=0;
	$thn = $this->input->post('tahun');
	$yr = $this->input->post('year');
	$this->db->query("DELETE from salary where tahun = '$yr'");
	$wcts = $this->db->query("SELECT * FROM costcenter order by costcenter");
	$wctsc = $wcts->num_rows();
	foreach($wcts->result() as $cc):
		$costcenter[] = $cc->costcenter;
	endforeach;
	$asumsigp = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$yr' order by gol,pangkat");
	$casumsigp = $asumsigp->num_rows();
	foreach($asumsigp->result() as $gp):
		$golgp[] = $gp->gol;
		$pangkatgp[] = $gp->pangkat;
		$rupiahgp[] = $gp->rupiah;
	endforeach;
	$asumsiovt = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$yr' order by gol ");
	$casumsiovt = $asumsiovt->num_rows();
	foreach($asumsiovt->result() as $ovt):
		$rupiahvt[] = $ovt->rupiah;
	endforeach;
	$asumsitjh = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$yr' order by gol ");
	foreach($asumsitjh->result() as $tjh):
		$golhdr[] = $tjh->gol;
		$rupiahhdr[] = $tjh->rupiah;
	endforeach;
	$asumsitrspt = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$yr'");
	foreach($asumsitrspt->result() as $trspt):
		$goltrspt[]=$trspt->gol;
		$rupiahtrspt[]=$trspt->rupiah;
	endforeach;
	$asumsiobt = $this->db->query("SELECT * FROM asumsi_medical_expense_obat where tahun = '$yr' order by gol");
	foreach($asumsiobt->result() as $obt):
		$golobt[] = $obt->gol;
		$rupiahobt[] = $obt->rupiah;
	endforeach;
	$asumsimeal = $this->db->query("SELECT * FROM meal where tahun = '$yr' ");
	foreach($asumsimeal->result() as $meal):
		$rupiahmeal[] =  $meal->rupiah;
	endforeach;
	$asumsipuasa = $this->db->query("SELECT * FROM meal_puasa where tahun = '$yr' ");
	foreach($asumsipuasa->result() as $ps):
		$rupiahpuasa[] = $ps->rupiah;
	endforeach;
	$asumsibpjs = $this->db->query("SELECT * FROM asumsi_medical_expense_bpjs where tahun = '$yr' order by gol");
	foreach($asumsibpjs->result() as $bpjs):
		$golbpjs[] = $bpjs->gol;
		$rupiahbpjs[] = $bpjs->rupiah;
	endforeach;
	$asumsihspt = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$yr' order by gol");
	foreach($asumsihspt->result() as $hspt):
		$golhspt[] = $hspt->gol;
		$rupiahhspt90[] = $hspt->rp90;
		$rupiahhspt10[] = $hspt->rp10;
		$rupiahhspt100[] = $hspt->rp100;
	endforeach;
	$asumsihs = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$yr' order by gol");
	foreach($asumsihs->result() as $hs):
	$golhs[] = $hs->gol;
	$rupiahhs[] = $hs->rupiah;
	endforeach;
	$asumsidon = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$yr' order by gol ");
	foreach($asumsidon->result() as $don):
		$goldon[] = $don->gol;
		$rupiahdon[] = $don->rupiah;
	endforeach;
	$asumsitlk = $this->db->query("SELECT * FROM asumsi_telekomunikasi where tahun = '$yr' order by gol");
	foreach($asumsitlk->result() as $tlk):
		$goltlk[] = $tlk->gol;
		$rupiahtlk[] = $tlk->rupiah;
	endforeach;
	$asumsifunc = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$yr' order by gol");
	foreach($asumsifunc->result() as $func): 
		$golfunc[] = $func->gol;
		$rupiahfunc[] =$func->rupiah;
	endforeach;
	$asumsithr = $this->db->query("SELECT * FROM asumsi_thr where tahun = '$yr' order by gol ");
	foreach($asumsithr->result() as $thr):
		$golthr[] = $thr->gol;
		$rupiahthr[] = $thr->rupiah;
		endforeach;
	$asumsibon = $this->db->query("SELECT * FROM asumsi_bonus where tahun = '$yr' order by gol");
	foreach($asumsibon->result() as $bon):
		$golbon[] = $bon->gol;
		$rupiahbon[] = $bon->rupiah;
	endforeach;
	$asumsijms = $this->db->query("SELECT * FROM asumsi_manpowerinsurance where tahun = '$yr' order by gol,pangkat");
	foreach($asumsijms->result() as $jms):
		$goljms[] = $jms->gol;
		$rupiahjms[] = $jms->rupiah;
	endforeach;
	$asumsipnsdpa = $this->db->query("SELECT * FROM asumsi_pensiondpa where tahun = '$yr' order by gol,pangkat");
	foreach($asumsipnsdpa->result() as $pnsdpa):
		$golpnsdpa[] = $pnsdpa->gol;
		$rupiahpnsdpa[] = $pnsdpa->rupiah;
	endforeach;
	
	$asumsipnsbpjs = $this->db->query("SELECT * FROM asumsi_pensionbpjs where tahun = '$yr' order by gol,pangkat");
	foreach($asumsipnsbpjs->result() as $pnsbpjs):
		$golpnsbpjs[] = $pnsbpjs->gol;
		$rupiahpnsbpjs[] = $pnsbpjs->rupiah;
	endforeach;

	$asumsihd = $this->db->query("SELECT * FROM asumsi_holiday_allowance where tahun = '$yr' order by gol,pangkat");
	foreach($asumsihd->result() as $hd):
		$golhd[] = $hd->gol;
		$pangkathd[] = $hd->pangkat;
		$rupiahhd[] = $hd->rupiah;
	endforeach;
	for ($m=1; $m<=12; $m++) {
		$month = date('F', mktime(0,0,0,$m, 1, date($yr)));	

	$mppt=$this->db->query("SELECT count(gol) as jmlhmpp,workcenter,dept,seksi,gol,pangkat,statuspernikahan FROM mpp_trans where 
	 tahun= '$yr' and bulan = '$month' and pangkat <> '-'  group by gol,pangkat,workcenter order by gol,workcenter desc");
	$mpptc = $mppt->num_rows();
	foreach($mppt->result_array() as $mpt):
			$wctmpp[$jmt] = $mpt['workcenter'];
		',';
			$seksimpp[$jmt] = $mpt['seksi'];
			',';
			$deptmpp[$jmt] = $mpt['dept'];
			',';
			$golmpp[$jmt] = $mpt['gol'];
		

		 $pangkatmpp[$jmt] = $mpt['pangkat'];
		echo '</br>';
		$jmlhmpp[$jmt] = $mpt['jmlhmpp'];
if($golmpp[$jmt]==4 && $pangkatmpp[$jmt]=='C'){
	
	echo $golmpp[$jmt];
	 echo $wctmpp[$jmt];
	
}
		$jmt++;
	endforeach;
	
	
	
	}
}

function list_salary_bln(){
	$yr = date('Y');
	$month = 'January';
	$x['bln'] = $month;
	$x['data'] = $this->m_salary->list_salary_bln($yr,$month);
	$this->load->view('user/v_list_salary',$x);
}

function list_filt_salary_bln(){
	$yr = $this->input->post('tahun');
	$bln = $this->input->post('bulan');
	$x['data'] = $this->m_salary->list_salary_bln($yr,$bln);
	$x['bln'] = $bln;
	$this->load->view('user/v_list_salary',$x);
}
function list_salary_thn(){
	$yr = date('Y');
	$x['year'] = $yr;
	$x['data'] = $this->m_salary->list_salary_thn($yr);
	$this->load->view('user/v_list_salary_thn',$x);
}
function list_filt_salary_thn(){
	$yr = $this->input->post('tahun');
	$x['year'] = $yr;
	$x['data'] = $this->m_salary->list_salary_thn($yr);
	$this->load->view('user/v_list_salary_thn',$x);
}
}
