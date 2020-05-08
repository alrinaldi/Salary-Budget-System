<?php
Class M_login extends CI_Model{

    public function cek_user($data) {
        $query = $this->db->get_where('karyawan', $data);
        return $query;
}
}