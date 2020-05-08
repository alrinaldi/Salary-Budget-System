<?php 

Class M_mpp extends CI_Model{
    public $db2;
    function __construct(){
        parent::__construct();
        $this->db2 = $this->load->database('db2',True);
    }

    function getMpp(){
        $hsl = $this->db2->query("select count(nrp) as mpp,CostCenter,seksi,Departemen,golongan from karyawan where 
        StatusKaryawan in('KONTRAK1','KONTRAK2','TETAP','MANAGEMENT TRAINEE')group by CostCenter,Golongan,Departemen,
         seksi ORDER BY CostCenter,Golongan");
        
         return $hsl;
    }

    function getMppHRC(){
        $hsl = $this->db2->query("select Nrp,CostCenter,seksi,Departemen,golongan,pangkat,statusKaryawan,tglMasuk from karyawan where 
        StatusKaryawan in('KONTRAK1','KONTRAK2','TETAP','MANAGEMENT TRAINEE')");
        
         return $hsl;
    }


    function inputMpp($nrp,$costcenter,$departemen,$seksi,$golongan,$pangkat,$statusKaryawan,$tglmsk)
    {
        $hsl = $this->db->query("insert into mpp_karyawan (nrp,costcenter,departemen,seksi,golongan,pangkat,statusKaryawan,tglMsk)
        values ('$nrp','$costcenter','$departemen','$seksi','$golongan','$pangkat','$statusKaryawan','$tglmsk')");
		}
	function viewMasterMpp($year){
		$hsl = $this->db->query("SELECT * FROM master_mpp where monthname(bulan) = 'January' AND tahun = '$year'");
		return $hsl;
	}

	function viewMasterMpp1($year){
		$hsl = $this->db->query("SELECT * FROM master_mpp where bulan = 'January' AND tahun = '$year'");
		return $hsl;
	}
	function viewMasterMppFilter($month,$year){
		$hsl = $this->db->query("SELECT * FROM MASTER_MPP WHERE BULAN = '$month' and tahun = '$year'");
		return $hsl;
	}

	function updateMpp($nrp,$costcenter,$departemen,$seksi,$golongan,$pangkat,$statusKaryawan,$tglmsk){
		$hsl = $this->db->query("UPDATE mpp_karyawan set nrp = '$nrp', costcenter = '$costcenter',departemen = '$departemen',
		seksi = '$seksi',golongan = '$golongan',pangkat='$pangkat',statusKaryawan = '$statusKaryawan',tglmsk = '$tglmsk'");
		return $hsl;
	}

	function insertMPP($data){
		$this->db->insert('master_mpp',$data);
	}
	function editMPP($data,$id){
		$this->db->where('id_master_mpp',$id);
		$this->db->update('master_mpp',$data);
	}
	function hapusMPP($data,$id){
		$this->db->where('id_master_mpp',$id);
		$this->db->update('master_mpp',$data);
	}

	

}
