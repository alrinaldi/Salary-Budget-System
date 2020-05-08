<?php
Class M_workcenter extends CI_Model{
	
	function add_wct($costcenter,$seksi,$div,$costAllocation,$dept){
		$hsl = $this->db->query("INSERT INTO costcenter (costcenter,lineseksi,divisi,costAllocation,dept)
		values('$costcenter','$seksi','$div','$costAllocation','$dept')");
		return $hsl;
	}

	function edit_wct($cc,$ls,$div,$ca,$dept){
		$hsl = $this->db->query("UPDATE costcenter set costcenter = '$cc',lineseksi='$ls',divisi='$div',costAllocation
		='$ca',dept = '$dept' ");
		return $hsl;
	}

	function list_wct(){
		$hsl = $this->db->query("SELECT * FROM costcenter order by costcenter");
		return $hsl;
	}

	function del_wct($cc){
		$hsl = $this->db->query("DELETE FROM costcenter where costcenter = '$cc'");
		return $hsl;

	}


}
