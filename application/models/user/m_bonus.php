<?php
Class M_Bonus Extends CI_Model{

function get_bonus($year){
    $hsl = $this->db->query("SELECT * FROM bonus WHERE tahun = '$year'");
    return $hsl;
}
function ubah_profile(){

}

}
