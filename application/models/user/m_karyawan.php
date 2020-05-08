<?php
Class M_Karyawan Extends CI_Model{

function get_profile($nrp){
    $hsl = $this->db->query("SELECT * FROM KARYAWAN WHERE NRP = '$nrp'");
    return $hsl;
}
function ubah_profile(){

}
function list_user(){
	$hsl = $this->db->query("SELECT * FROM karyawan ");
	return $hsl;
}
function simpan_user($nrp,$nama,$password,$level,$dept){
	$hsl = $this->db->query("INSERT INTO karyawan (nrp,nama,password,level,dept) values ('$nrp','$nama','$password','$level','$dept')");
	return $hsl;
}
function edit_user($nrp,$nama,$password,$level,$dept){
	$hsl = $this->db->query("UPDATE karyawan set nrp = '$nrp',nama = '$nama', password='$password',level = '$level',dept= '$dept' where nrp = '$nrp'");
	return $hsl;
}
function delete_user($nrp){
	$hsl  = $this->db->query("DELETE FROM KARYAWAN WHERE nrp = '$nrp'");
	return $hsl;
}

}
