<?php
Class C_mpp extends CI_Controller{
    function __construct(){
				parent::__construct();
				$this->db2 = $this->load->database('db2',True);
        if($this->session->userdata('nrp')==""){
            redirect('login');
		};
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->model('user/m_mpp');
		}
		private $master_mpp = 'master_mpp';

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
	function upload_mpp()
{
	$this->load->view('user/v_upload_mpp');
}
	function import_mpp(){
		$fileName = $this->input->post('file', TRUE);
         
        $config['upload_path'] = './asset/upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') ){

        $this->upload->display_errors();
           $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
             }else {
   $media = $this->upload->data();
   $inputFileName = './asset/upload/'.$media['file_name'];
   
   try {
    $inputFileType = IOFactory::identify($inputFileName);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   }

   $sheet = $objPHPExcel->getSheet(0);
   echo $highestRow = $sheet->getHighestRow();
   echo $highestColumn = $sheet->getHighestColumn();

             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "workcenter"=> $rowData[0][0],
                    "seksi"=> $rowData[0][1],
                    "dept"=> $rowData[0][2],
                   // "tgl_kadaluarsa"=>$dates = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][3])),
                 //"tgl"=>$dates1 = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])),
                   // $dates = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])),
                   // $dates1 = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][5)),
                    "kontrak"=> $rowData[0][5],
                    "gol1"=> $rowData[0][6],
                    "gol2"=> $rowData[0][7],
                    "gol3"=> $rowData[0][8]
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("master_mpp",$data);
                delete_files($media['file_path']);
                     
            }
            if($insert){
  echo $this->session->set_flashdata('msg','success-hapus');  
        redirect('user/c_user/list_mpp');
      }else{
          echo $this->session->set_flashdata('msg','error');  
        redirect('admin/obat/obat');
      }
          
    }
}

	function upload_overtime()
	{
		$this->load->view('user/v_upload_overtime');
	}

	function import_overtime(){
		$fileName = $this->input->post('file', TRUE);
         
        $config['upload_path'] = './asset/upload/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') ){

        $this->upload->display_errors();
           $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
             }else {
   $media = $this->upload->data();
   $inputFileName = './asset/upload/'.$media['file_name'];
   
   try {
    $inputFileType = IOFactory::identify($inputFileName);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   }

   $sheet = $objPHPExcel->getSheet(0);
   echo $highestRow = $sheet->getHighestRow();
   echo $highestColumn = $sheet->getHighestColumn();

             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "id"=> $rowData[0][0],
                    "nama"=> $rowData[0][1],
                    "gol"=> $rowData[0][2],
                    "type"=> $rowData[0][3],
                    "tgl_kadaluarsa"=>$dates = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])),
                 "tgl"=>$dates1 = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][5])),
                   // $dates = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])),
                   // $dates1 = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($rowData[0][5)),
                    "stok"=> $rowData[0][6],
                    "harga_jual"=> $rowData[0][7],
                    "harga_beli"=> $rowData[0][8],
                    "id_supplier"=> $rowData[0][9]
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("obat",$data);
                delete_files($media['file_path']);
                     
            }
            if($insert){
  echo $this->session->set_flashdata('msg','success-hapus');  
        redirect('user/obat/obat');
      }else{
          echo $this->session->set_flashdata('msg','error');  
        redirect('admin/obat/obat');
      }
          
    }
	}

	function master_mpp(){
		$year = date('Y');
		//$x['data'] = $this->m_mpp->viewMasterMpp($year);
		$x['thn'] = $year;
		$this->load->view('user/v_master_mpp',$x);
	}

	function get_mpp1(){
		$year = date('Y');
		$data = $this->m_mpp->viewMasterMpp1($year);
		echo json_encode($data);
	}
	function insert_mpp(){
		$data = array(
			'workcenter'=> $this->input->post('workcenter'),
			'dept'=> $this->input->post('dept'),
			'seksi' => $this->input->post('seksi'),
			'gol1' => $this->inpust->post('gol1'),
			'gol2' => $this->inpust->post('gol2'),
			'gol3' => $this->inpust->post('gol3'),
			'gol4' => $this->inpust->post('gol4'),
			'gol5' => $this->inpust->post('gol5'),
			'gol6' => $this->inpust->post('gol6'),
			'kontrak' => $this->inpust->post('kontrak'),
		);
		$this->m_mpp->inser_mpp($data);
	}
	function edit_mpp(){
		$data = array(

		);
	}
	function hapus_mpp(){
		$this->m_mpp->hapus_mpp($this->input->post('id_master_mpp'));
	}

	function openMpp(){
		$tahun = $this->input->post('tahunpilih');
		$query = $this->db->query("SELECT * FROM costcenter order by costcenter");
		$countcc = $query->num_rows(); 
		$master = $this->db->query("SELECT * FROM master_mpp where tahun = '$tahun' ");
		$countmaster = $master->num_rows();
		if($countmaster>0){
			foreach($master->result() as $z):
			$wct[] = $z->workcenter;
			$sek[] = $z->seksi;
			$depts[] = $z->dept;
			$gol1[] = $z->gol1;
			$gol2[] = $z->gol2;
			$gol3[] = $z->gol3;
			$gol4[] = $z->gol4;
			$gol5[] = $z->gol5;
			$gol6[] = $z->gol6;
			$kontrak[] = $z->kontrak;
			$bulan[] = $z->bulan;
			$thn[] = $z->tahun;
 			endforeach;
			$this->db->query("DELETE FROM MASTER_MPP where tahun = '$tahun' ");
			foreach($query->result() as $i ):
				$costcenter[] = $i->costcenter;
				$seksi[] = $i->lineSeksi;
				$dept[] = $i->dept;
			endforeach;
			
			for ($m=1; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 1, date($tahun)));

				for($k=0; $k<$countcc; $k++){
					$this->db->query("INSERT INTO MASTER_MPP (workcenter,seksi,dept,kontrak,gol1,gol2,gol3,gol4,gol5,gol6
					,bulan,tahun) values('$costcenter[$k]','$seksi[$k]','$dept[$k]','0','0','0','0','0','0','0','$month',$tahun)");
				}

			}
			for($k=0; $k<$countmaster; $k++){
				$this->db->query("UPDATE master_mpp SET gol1 = '$gol1[$k]',gol2='$gol2[$k]',gol3='$gol3[$k]',gol4='$gol4[$k]'
				,gol5='$gol5[$k]',gol6='$gol6[$k]',kontrak='$kontrak[$k]' where workcenter = '$wct[$k]' and bulan = 
				'$bulan[$k]' and tahun = '$thn[$k]'");
			}
			$this->session->set_flashdata('not_empty','Data sudah Digenerate');
			redirect('user/c_mpp/genMPP');
		}else{
			foreach($query->result() as $i ):
				$costcenter[] = $i->costcenter;
				$seksi[] = $i->lineSeksi;
				$dept[] = $i->dept;
			endforeach;
			
			for ($m=1; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 1, date($tahun)));

				for($k=0; $k<$countcc; $k++){
					$this->db->query("INSERT INTO MASTER_MPP (workcenter,seksi,dept,kontrak,gol1,gol2,gol3,gol4,gol5,gol6
					,bulan,tahun) values('$costcenter[$k]','$seksi[$k]','$dept[$k]','0','0','0','0','0','0','0','$month',$tahun)");
				}

			}
			$this->session->set_flashdata('success_data','Data berhasil di Generate'); 
		redirect('user/c_mpp/genMPP');
	}
	}
function genMPP(){
	$this->load->view('user/v_open_mpp');
}

function genOvertime(){
	$this->load->view('user/v_open_overtime');
}

function openOvertime(){
	$tahun = $this->input->post('tahunpilih');
	$query = $this->db->query("SELECT * FROM costcenter order by costcenter");
	$countcc = $query->num_rows(); 
	$master = $this->db->query("SELECT * FROM master_overtime where tahun = '$tahun' ");
	$countmaster = $master->num_rows();
	if($countmaster>0){
		foreach($master->result() as $z):
			$wct[] = $z->workcenter;
			$sek[] = $z->seksi;
			$depts[] = $z->dept;
			$gol1[] = $z->gol1;
			$gol2[] = $z->gol2;
			$gol3[] = $z->gol3;
			$gol4[] = $z->gol4;
			$gol5[] = $z->gol5;
			$gol6[] = $z->gol6;
			$kontrak[] = $z->kontrak;
			$bulan[] = $z->bulan;
			$thn[] = $z->tahun;
 			endforeach;
			$this->db->query("DELETE FROM MASTER_OVERTIME ");
			foreach($query->result() as $i ):
				$costcenter[] = $i->costcenter;
				$seksi[] = $i->lineSeksi;
				$dept[] = $i->dept;
			endforeach;
			
			for ($m=1; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 1, date($tahun)));

				for($k=0; $k<$countcc; $k++){
					$this->db->query("INSERT INTO MASTER_overtime (workcenter,seksi,dept,kontrak,gol1,gol2,gol3,gol4,gol5,gol6
					,bulan,tahun) values('$costcenter[$k]','$seksi[$k]','$dept[$k]','0','0','0','0','0','0','0','$month',$tahun)");
				}

			}
			for($k=0; $k<$countmaster; $k++){
				$this->db->query("UPDATE master_overtime SET gol1 = '$gol1[$k]',gol2='$gol2[$k]',gol3='$gol3[$k]',gol4='$gol4[$k]'
				,gol5='$gol5[$k]',gol6='$gol6[$k]',kontrak='$kontrak[$k]' where workcenter = '$wct[$k]' and tahun = '$thn[$k]' and bulan = '$bulan[$k]' ");
			}
		$this->session->set_flashdata('not_empty','Data sudah Digenerate');
		redirect('user/c_mpp/genOvertime');
	}else{
		foreach($query->result() as $i ):
			$costcenter[] = $i->costcenter;
			$seksi[] = $i->lineSeksi;
			$dept[] = $i->dept;
		endforeach;
		}

		for ($m=1; $m<=12; $m++) {
			$month = date('F', mktime(0,0,0,$m, 1, date($tahun)));

			for($k=0; $k<$countcc; $k++){
				$this->db->query("INSERT INTO MASTER_OVERTIME (workcenter,seksi,dept,kontrak,gol1,gol2,gol3,gol4,gol5,gol6
				,bulan,tahun) values('$costcenter[$k]','$seksi[$k]','$dept[$k]','0','0','0','0','0','0','0','$month',$tahun)");
			}

		}
		$this->session->set_flashdata('success_data','Data berhasil di Generate'); 
	redirect('user/c_mpp/genOvertime');
}

function gntMpp(){
	$yr = $this->input->post('tahunpilih');
	$mmpp = $this->db->query("SELECT * FROM MASTER_MPP WHERE TAHUN = '$yr' order by workcenter");
	$ctmpp = $mmpp->num_rows();
	foreach($mmpp->result as $i):
		$workcenter[] = $i->workcenter;
		$seksi[] = $i->seksi;
		$dept[] = $i->dept;
		$gol1[] = $i->gol1;
		$gol2[] = $i->gol2;
		$gol3[] = $i->gol3;
		$gol4[] = $i->gol4;
		$gol5[] = $i->gol5;
		$gol6[] = $i->gol6;
		$kontrak[] = $i->kontrak;
	endforeach;

for($x=0; $x<$ctmpp; $x++){
$workcenter[$x];
if($gol1!=0){

}elseif($gol2!=0){

}elseif($gol3!=0){

}elseif($gol4!=0){

}elseif($gol5!=0){

}elseif($gol6!=0){

}else{

}


}

	}

	function trans_mpp(){
		$this->load->view('user/v_mpp_trans');
	}

	function generate_master_mpp(){
		$thn = $this->input->post('tahunpilih');
		$this->db->query("DELETE FROM mpp_trans where tahun = '$thn'");
		$overtime_trans = $this->db->query("SELECT * FROM master_mpp where tahun = '$thn' order by workcenter,bulan");
		ECHO $count_tr = $overtime_trans->num_rows();
		foreach($overtime_trans->result() as $i):
				$workcenter[] = $i->workcenter;
				$seksi[] = $i->seksi;
				$dept[] = $i->dept;
				$gol1[]= $i->gol1;
				$gol2[] = $i->gol2;
				$gol3[] = $i->gol3;
				$gol4[] = $i->gol4;
				$gol5[] = $i->gol5;
				$gol6[] = $i->gol6;
				$kontrak[] = $i->kontrak;
				$bulan[] = $i->bulan;
				$tahun[] = $i->tahun;
		endforeach;

		for($x=0; $x<$count_tr; $x++){
	
				if($gol1[$x]==0){
					//$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
					//('$workcenter[$x]','$seksi[$x]','$dept[$x]','1','-','S/0','$bulan[$x]','$tahun[$x]')");
				}else{
					$slcgol1 = $this->db2->query("SELECT * FROM Karyawan where costcenter = '$workcenter[$x]' and
					(statuskaryawan = 'TETAP' or statuskaryawan = 'MANAGEMENT TRAINEE' or statuskaryawan = 'KONTRAK1' or statuskaryawan = 'KONTRAK2' )
					and golongan = '1'");
					$count_slc1 = $slcgol1->num_rows();
					foreach($slcgol1->result() as $k):
						$golongan1[] = $k->Golongan;
						$pangkat1[] = $k->Pangkat;
						$sp1[] = $k->StatusPernikahan;
						$tlm1[] = $k->TglMasuk;					
						endforeach;
					for($z=0; $z<$count_slc1; $z++){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,tglmasuk,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan1[$z]','$pangkat1[$z]','$sp1[$z]','$tlm1[$z]','$bulan[$x]','$tahun[$x]') ");
					}
					if($gol1[$x]!=$count_slc1){
						$ul1 = abs($gol1[$x]-$count_slc1);
						for($q=0; $q<$ul1; $q++){
						$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
						('$workcenter[$x]','$seksi[$x]','$dept[$x]','1','E','S/0','$bulan[$x]','$tahun[$x]') ");
						}	
				}
				}

				if($gol2[$x]==0){
				//	$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,bulan,tahun) values 
				//	('$workcenter[$x]','$seksi[$x]','$dept[$x]','2','-','$bulan[$x]','$tahun[$x]')");
				}else{
					$slcgol2 = $this->db2->query("SELECT * FROM Karyawan where costcenter = '$workcenter[$x]' and
					(statuskaryawan = 'TETAP' or statuskaryawan = 'MANAGEMENT TRAINEE' or statuskaryawan = 'KONTRAK1' or statuskaryawan = 'KONTRAK2') 
					AND golongan = '2'");
					$count_slc2 = $slcgol2->num_rows();
					foreach($slcgol2->result() as $i):
						$golongan2[] = $i->Golongan;
						$pangkat2[] = $i->Pangkat;
						$sp2[] = $i->StatusPernikahan;
						$tlm2[] = $i->TglMasuk;
					endforeach;
					for($z=0; $z<$count_slc2; $z++){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,tglmasuk,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan2[$z]','$pangkat2[$z]','$sp2[$z]','$tlm2[$z]','$bulan[$x]','$tahun[$x]') ");
					}
					if($gol2[$x]!=$count_slc2){
						$ul2 = abs($gol2[$x]-$count_slc2);
						for($q=0; $q<$ul2; $q++){
						$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
						('$workcenter[$x]','$seksi[$x]','$dept[$x]','2','A','S/0','$bulan[$x]','$tahun[$x]') ");
						}	
				}
				}

				if($gol3[$x]==0){
				//$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,bulan,tahun) values 
				//('$workcenter[$x]','$seksi[$x]','$dept[$x]','3','-','$bulan[$x]','$tahun[$x]')");
				}else{
					$slcgol3 = $this->db2->query("SELECT * FROM Karyawan where costcenter = '$workcenter[$x]' and
					(statuskaryawan = 'TETAP' or statuskaryawan = 'MANAGEMENT TRAINEE' or statuskaryawan = 'KONTRAK1' or statuskaryawan = 'KONTRAK2' )
					AND golongan = '3' ");
					$count_slc3 = $slcgol3->num_rows();
					foreach($slcgol3->result() as $i):
						$golongan3[] = $i->Golongan;
						$pangkat[] = $i->Pangkat;
						$sp3[] = $i->StatusPernikahan;
						$tlm3[] =$i->TglMasuk;
					endforeach;
					for($z=0; $z<$count_slc3; $z++){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,tglmasuk,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan3[$z]','$pangkat[$z]','$sp3[$z]','$tlm3[$z]','$bulan[$x]','$tahun[$x]') ");
					}
					if($gol3[$x]!=$count_slc3){
						$ul3 = abs($gol3[$x]-$count_slc3);
						for($q=0; $q<$ul3; $q++){
						$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
						('$workcenter[$x]','$seksi[$x]','$dept[$x]','3','A','S/0','$bulan[$x]','$tahun[$x]') ");
						}	
				}
				}

				if($gol4[$x]==0){
				//	$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,bulan,tahun) values 
				//	('$workcenter[$x]','$seksi[$x]','$dept[$x]','4','-','$bulan[$x]','$tahun[$x]')");
				}else{
					$slcgol4 = $this->db2->query("SELECT * FROM Karyawan where costcenter = '$workcenter[$x]' and
					(statuskaryawan = 'TETAP' or statuskaryawan = 'MANAGEMENT TRAINEE' or statuskaryawan = 'KONTRAK1' or statuskaryawan = 'KONTRAK2' )
					AND golongan = '4' ");
					echo $count_slc4 = $slcgol4->num_rows();
					foreach($slcgol4->result() as $i):
						$golongan4[] = $i->Golongan;
						$pangkat4[] = $i->Pangkat;
						$sp4[] = $i->StatusPernikahan;
						$tlm4[] = $i->TglMasuk;
					endforeach;
					for($z=0; $z<$count_slc4; $z++){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,tglmasuk,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan4[$z]','$pangkat4[$z]','$sp4[$z]','$tlm4[$z]','$bulan[$x]','$tahun[$x]') ");
					}
					if($gol4[$x]!=$count_slc4){
						$ul4 = abs($gol4[$x]-$count_slc4);
						for($q=0; $q<$ul4; $q++){
						$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
						('$workcenter[$x]','$seksi[$x]','$dept[$x]','4','A','S/0','$bulan[$x]','$tahun[$x]') ");
						}	
				}
				}

				if($gol5[$x]==0){
				//	$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,bulan,tahun) values 
				//	('$workcenter[$x]','$seksi[$x]','$dept[$x]','5','-','$bulan[$x]','$tahun[$x]')");
				}else{
					$slcgol5 = $this->db2->query("SELECT * FROM Karyawan where costcenter = '$workcenter[$x]' and
					(statuskaryawan = 'TETAP' or statuskaryawan = 'MANAGEMENT TRAINEE' or statuskaryawan = 'KONTRAK1' or statuskaryawan = 'KONTRAK2' )
					AND golongan = '5' ");
					$count_slc5 = $slcgol5->num_rows();
					foreach($slcgol5->result() as $i):
						$golongan5[] = $i->Golongan;
						$pangkat5[] = $i->Pangkat;
						$sp5[] = $i->Statuspernikahan;
						$tlm5[] = $i->TglMasuk;
					endforeach;
					for($z=0; $z<$count_slc5; $z++){
						if($sp5[$z]!=null){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,tglmasuk,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan5[$z]','$pangkat5[$z]','$sp5[$z]','$tlm5[$z]','$bulan[$x]','$tahun[$x]') ");
						}else{
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan5[$z]','$pangkat5[$z]','M/2','$bulan[$x]','$tahun[$x]') ");
							
						}	
				}
					if($gol5[$x]!=$count_slc5){
						$ul5 = abs($gol5[$x]-$count_slc5);
						for($q=0; $q<$ul5; $q++){
						$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
						('$workcenter[$x]','$seksi[$x]','$dept[$x]','5','A','S/0','$bulan[$x]','$tahun[$x]') ");
						}	
				}
				}

				if($gol6[$x]==0){
				//	$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,bulan,tahun) values 
				//	('$workcenter[$x]','$seksi[$x]','$dept[$x]','6','-','$bulan[$x]','$tahun[$x]')");
				}else{
					$slcgol6 = $this->db2->query("SELECT * FROM Karyawan where costcenter = '$workcenter[$x]' and
					(statuskaryawan = 'TETAP' or statuskaryawan = 'MANAGEMENT TRAINEE' or statuskaryawan = 'KONTRAK1' or statuskaryawan = 'KONTRAK2' )
					AND golongan = '6' ");
					$count_slc6 = $slcgol6->num_rows();
					foreach($slcgol6->result() as $i):
						$golongan6[] = $i->Golongan;
						$pangkat6[] = $i->Pangkat;
						$sp6[] = $i->StatusPernikahan;
						$tlm6[] = $i->TglMasuk;
					endforeach;
					for($z=0; $z<$count_slc6; $z++){
						if($sp6[$z]==null){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,tglmasuk,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan6[$z]','A','M/2','$bulan[$x]','$tlm6[$z]','$tahun[$x]') ");
						}	else{
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','$golongan6[$z]','A','$sp6[$z]','$bulan[$x]','$tahun[$x]') ");
							
						}
				}
					if($gol6[$x]!=$count_slc6){
						$ul6 = abs($gol6[$x]-$count_slc6);
						for($q=0; $q<$ul6; $q++){
						$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
						('$workcenter[$x]','$seksi[$x]','$dept[$x]','6','A','M/2','$bulan[$x]','$tahun[$x]') ");
						}	
				}
				}

				if($kontrak[$x]==0){
					//$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,bulan,tahun) values 
					//('$workcenter[$x]','$seksi[$x]','$dept[$x]','Kontrak','-','$bulan[$x]','$tahun[$x]')");
				}else{
				$count_slc0 = $kontrak[$x];
					for($z=0; $z<$count_slc0; $z++){
							$this->db->query("INSERT INTO MPP_TRANS (workcenter,seksi,dept,gol,pangkat,statuspernikahan,bulan,tahun) values 
							('$workcenter[$x]','$seksi[$x]','$dept[$x]','0','','S/0','$bulan[$x]','$tahun[$x]') ");
					}
				}

				
			
		}

redirect('user/c_mpp/trans_mpp');
		}	

		function list_master_mpp(){
			$this->load->view('user/v_list_master_mpp',null);
		}

		function get_mmpp(){
			$year = date('Y');
			$columns = array(
				'id_master_mpp',
				'workcenter',
				'seksi',
				'dept',
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
	
			$indexColumn = 'id_master_mpp';
			$sqlCount = 'SELECT count('.$indexColumn.') AS ROW_COUNT FROM ' . $this->master_mpp . ' where tahun = "'.$year.'" '  ;
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
				$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM ' . $this->master_mpp . ' where  tahun = "'.$year.'"'  . $where  . $order . ' ' .$limit;
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
					array_push($row, '<button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id='. $cols[$indexColumn] .'>Delete</button>');
							$output['data'][] = $row;
				}
				
				return $output;
		}
		
		function get_mpp() {
			$master_mpp = $this->get_mmpp();
			echo json_encode($master_mpp);
		}
		
		function delete_mpp() {
			$id = isset($_POST['id']) ? $_POST['id'] : NULL;
			
			if($this->m_mpp->delete_mpp($id) === TRUE) {
				return TRUE;
			}
			
			return FALSE;
		}
		
		function update_mpp() {
			$id = $_POST['id_master_mpp'];
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
			if($this->m_mpp->update_mpp($id, $workcenter, $seksi, $dept, $kontrak, $gol1, $gol2,$gol3,$gol4,$gol5,$gol6,$bulan,$tahun) === TRUE) {
				return TRUE;
			}
			
			return FALSE;
		}
		

	
		function list_mpp(){
			$depts = $this->session->userdata('dept');
			$tahun = date('Y');
	
			$x['data'] = $this->m_mpp->list_mpp($depts,$tahun);
			$this->load->view('dept/v_list_mpp',$x);
	
		}

		function viewmppmaster(){
				$year = date('Y');
				$x['monthh'] = 'January';
				$x['data'] = $this->m_mpp->viewMasterMpp1($year);
				$x['year'] = $year;
			$this->load->view('user/v_listmastermpp_bln',$x);
		}


	}

