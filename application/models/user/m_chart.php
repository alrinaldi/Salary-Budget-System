<?php
Class M_chart extends CI_Model{
	
function chartmp($year){
	$hsl = $this->db->query("SELECT SUM(gol1+gol2+gol3+gol4+gol5+gol6+kontrak) as jumlah, 
	dept FROM master_mpp where tahun = '$year' 
	group by dept,tahun order by workcenter");
	if($hsl->num_rows()>0){
		foreach ($hsl -> result() as $data ) {
			$hasil[] = $data;
			# code...
		}
		return $hasil;
	}
}
}
