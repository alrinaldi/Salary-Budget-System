<?php
Class M_Overtime Extends CI_Model{

function get_overtime($year,$gol){
    $hsl = $this->db->query("SELECT * FROM overtime WHERE tahun = '$year' and Monthname('bulan') = 'January' and gol='$gol'");
    return $hsl;
}
function ubah_profile(){

}

function viewMasterOvertime($tahun){
	$hsl = $this->db->query("SELECT * FROM master_overtime where bulan = 'JANUARY' and tahun = '$tahun' order by workcenter,bulan ");
	return $hsl;
}



function get_asumsi_overtime($year){
	$hsl = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$year'");
	return $hsl;
}
function get_ausmsi_overtimeold($year){
	$hsl = $this->db->query("SELECT * FROM asumsi_overtune where tahun ='$year'");
	return $hsl;
}
function list_overtime($year,$bulan){
	$hsl =$this->db->query("SELECT workcenter,jam,seksi,dept,budget,gol,bulan,tahun FROM overtime where tahun = '$year' and bulan = '$bulan' and gol in('1','2','3','4','Kontrak') order by workcenter,gol");
	return $hsl;
}
function filter_overtime($year,$bulan){
	$hsl =$this->db->query("SELECT workcenter,jam,seksi,dept,budget,gol,bulan,tahun from
	overtime where bulan = '$bulan' and tahun = '$year'");
	return $hsl;

}
function delete_mpp($id){
	$sql = 'DELETE FROM ' . $this->master_mpp . ' WHERE id_master_mpp=' . $id;
	$this->db->query($sql);
	
	if ($this->db->affected_rows()) {
		return TRUE;
	}
	
	return FALSE;
}

function update_ovt($id_master_overtime, $workcenter, $seksi, $dept, $kontrak, $gol1,$gol2,$gol3,$gol4,$gol5,$gol6,$bulan,$tahun) {
	$data = array(
				'workcenter' => $workcenter,
				'seksi' => $seksi,
				'dept' => $dept,
				'kontrak' => $kontrak,
				'gol1' => $gol1,
				'gol2' => $gol2,
				'gol3' => $gol3,
				'gol4' => $gol4,
				'gol5' => $gol5,
				'gol6' => $gol6,
				'bulan' => $bulan,
				'tahun' => $tahun
			);
	
	$this->db->where('id_master_overtime', $id_master_overtime);
	$this->db->update($this->master_overtime, $data);
	
	if ($this->db->affected_rows()) {
		return TRUE;
	}
	
	return FALSE;
}

}
