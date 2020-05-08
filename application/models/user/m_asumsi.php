<?php
Class M_asumsi extends CI_Model{

    function get_asumsi(){
        $hsl = $this->db->query("SELECT z.id_asumsi,a.e as gol1e,b.a as gol2a,b.b as gol2b,b.c as gol2c,b.d as gol2d
        ,b.e as gol2e,b.e as gol2f,c.a as gol3a,c.b as gol3b,c.c as gol3c,c.d as gol3d,c.e as gol3e,d.a as gol4a
        ,d.b as gol4b,d.c as gol4c,d.d as gol4d,d.e as gol4e from asumsi_gp z join asumsi_gol1 a on z.id_asumsi_gol1
        = a.id_asumsi_gol1 join asumsi_gol2 b on z.id_asumsi_gol2 = b.id_asumsi_gol2 join asumsi_gol3 c on z.id_asumsi_gol3 =
        c.id_asumsi_gol3 join asumsi_gol4 d on z.id_asumsi_gol4 = d.id_asumsi_gol4  where z.id_asumsi = (select max(id_asumsi) from asumsi_gp) ");
        return $hsl;
	}
	
	function asumsi_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_gp_avg where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function asumsi_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_gp_avg where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function asumsi_gaji($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$year' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function asumsi_gajiN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_gaji_pokok where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function bonus_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_bonus where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function bonus_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_bonus where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	
	function lembur_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function lembur_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_overtime where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function medicalObat_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_medical_expense_obat where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function medicalObat_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_medical_expense_obat where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function medicalBpjs_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_medical_expense_bpjs where tahun = '$year' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function medicalBpjs_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_medical_expense_bpjs where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	function thr_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_thr where tahun = '$year' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function thr_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_thr where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	function hadir_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function hadir_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_tnj_hadir where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function incentive_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_incentive where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function incentive_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_incentive where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	function holiday_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_holiday_allowance where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function holiday_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_holiday_allowance where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function manpowerinsurance_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_manpowerinsurance where tahun = '$year' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function manpowerinsurance_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_manpowerinsurance where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	function pensionDPA_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_pensiondpa where tahun = '$year' order by gol,pangakt");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function pensionDPA_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_pensiondpa where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	function pensionBPJS_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_pensionbpjs where tahun = '$year' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function pensionBPJS_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_pensionbpjs where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function donation_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function donation_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_donation where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function add_donation($gol,$rupiah,$tahun){
		$hsl = $this->db->query("INSERT INTO donation (gol,rupiah,tahun) values
		('$gol','$rupiah','$tahun')");
		return $hsl;
	}


	function meal_gp($year){
		$hsl = $this->db->query("SELECT * FROM meal where tahun = '$year' ");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function meal_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM meal where tahun = '$year1' ");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	
	function mealp_gp($year){
		$hsl = $this->db->query("SELECT * FROM meal_puasa where tahun = '$year' ");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function mealp_gpN($year1,$bulan1){
		$hsl = $this->db->query("SELECT * FROM meal_puasa where tahun = '$year1' and  bulan = '$bulan1' ");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}
	function puasa($year){
		$hsl = $this->db->query("SELECT * FROM PUASA where tahun =  '$year' " );
		return $hsl;
	}

	function housing_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$year'  order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function housing_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_housing_allowance where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function trans_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$year'  order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function trans_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_transportasi where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function function_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function function_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_function_allowance where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function insert_function($gol,$thn,$rupiah){
		$hsl = $this->db->query("INSERT INTO asumsi_function_allowance (gol,tahun,rupiah) values
		('$gol','$thn','$rupiah')");
		return $hsl;
	}

	function hospitalization_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function hospitalization_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_hospitalization where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	
	function telekomunikasi_gp($year){
		$hsl = $this->db->query("SELECT * FROM asumsi_telekomunikasi where tahun = '$year' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function telekomunikasi_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM asumsi_telekomunikasi where tahun = '$year1' order by gol");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	
	}

	
	function pph21_gp($year){
		$hsl = $this->db->query("SELECT * FROM pph21 where tahun = '$year' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	}

	function pph21_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM pph21 where tahun = '$year1' order by gol,pangkat");
		if($hsl->num_rows()>0){
			foreach ($hsl -> result() as $data ) {
				$hasil[] = $data;
				# code...
			}
			return $hasil;
		}
	
	}

	function tax_gp($year){
		$hsl = $this->db->query("SELECT * FROM tax_manual where tahun = '$year' order by gol,sub_golongan");
	
			return $hsl;
		}
	

	function tax_gpN($year1){
		$hsl = $this->db->query("SELECT * FROM tax_manual where tahun = '$year1' order by gol,pangkat");
	
			return $hsl;
	
	}
}
