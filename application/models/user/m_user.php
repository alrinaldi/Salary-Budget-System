<?php
Class M_user Extends CI_Model{
	function add_user($nrp,$nama,$password,$level,$dept){
		$hsl =  $this->db->query("INSERT INTO karyawan (nrp,nama,password,level,dept) values 
		('$nrp','$nama','$password','$level',$dept)");
	return $hsl;
	}
	function edit_user($nrp,$nama,$password,$level,$dept){
		$hsl = $this->db->query("UPDATE karyawan set nrp = '$nrp',nama='$nama',password='$password',level = '$level',dept='$dept'
		where nrp = '$nrp'");
		return $hsl;
	}
	function read_user(){
		$hsl = $this->db->query("SELECT * FROM KARYAWAN");
		return $hsl;
	}
	function delete_user($nrp){
		$hsl = $this->db->query("DELETE FROM KARYAWAN WHERE nrp = '$nrp'");
		return $hsl;
	}
}
