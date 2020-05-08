<?php
Class M_salary extends CI_Model{
	
	function list_salary_bln($year,$bln){
		$hsl = $this->db->query("SELECT *,total1+lembur as total from (SELECT workcenter, seksi, dept, gol, sum(gp) as gp,
		 sum(incentive) as incentive, sum(bonus) as bonus, lembur, sum(uang_hadir) as uang_hadir, 
		 sum(transporttasi) transporttasi, sum(meal) as meal, sum(holiday_allowance) as holiday_allowance, 
		 sum(function_allowance) as function_allowance, sum(man_power) as man_power, sum(housing_allowance) as 
		 housing_allowance, sum(income_tax) as income_tax,sum(thr) as thr ,sum(medical_bpjs) as medical_bpjs, 
		 sum(medical_obat) as medical_obat, sum(hospitalization) as hospitalization, sum(hospitalization2) as 
		 hospitalization2,sum(pension_dpa) as pension_dpa,sum(pension_bpjs) as pension_bpjs, bulan, tahun,
		 sum(donation) as donation, sum(mp) as mp, sum(pension) as pension, pangkat, statuspernikahan, 
		 sum(telecomunication) as telecomunication,SUM(gp+incentive+bonus+uang_hadir+transporttasi+meal+
		 holiday_allowance+function_allowance+man_power+housing_allowance+income_tax+thr+medical_bpjs+medical_obat
		 +hospitalization+ hospitalization2+telecomunication+pension_dpa+pension_bpjs+donation+pension)
		  AS total1 FROM SALARY WHERE tahun ='$year' and bulan = '$bln' group by workcenter,gol order by
		   workcenter,gol) totalb where tahun ='$year' and bulan ='$bln' GROUP by gol,workcenter order by 
		   workcenter,gol");
		return $hsl;
	}
	function list_salary_thn($year){
			$hsl = $this->db->query("SELECT workcenter, seksi, dept, gol, sum(gp) as gp, sum(incentive) as incentive, 
			sum(bonus) as bonus, sum(lembur) as lembur, sum(uang_hadir) as uang_hadir, sum(transporttasi) transporttasi,
			sum(meal) as meal, sum(holiday_allowance) as holiday_allowance, sum(function_allowance) as function_allowance,
			sum(man_power) as man_power, sum(housing_allowance) as housing_allowance, sum(income_tax) as income_tax,sum(thr) as thr
			,sum(medical_bpjs) as medical_bpjs, sum(medical_obat) as medical_obat, sum(hospitalization) as hospitalization,
			sum(hospitalization2) as hospitalization2,sum(pension_dpa) as pension_dpa,sum(pension_bpjs) as pension_bpjs,
			bulan, tahun,sum(donation) as donation, sum(mp) as mp, sum(pension) as pension, pangkat, statuspernikahan,
			sum(telecomunication) as telecomunication,SUM(gp+incentive+bonus+uang_hadir+transporttasi+meal+holiday_allowance+function_allowance+man_power+housing_allowance+income_tax+thr+medical_bpjs+medical_obat+hospitalization+ hospitalization2+telecomunication+pension_dpa+pension_bpjs+donation+pension)
			AS total FROM 
			SALARY WHERE tahun ='$year' group by gol,workcenter order by workcenter,gol asc");
			return $hsl;
		
	}

	function read_salary($year,$bln){
		$hsl = $this->db->query("SELECT workcenter, seksi, dept, gol, sum(gp) as gp, sum(incentive) as incentive, 
		sum(bonus) as bonus, sum(lembur) as lembur, sum(uang_hadir) as uang_hadir, sum(transporttasi) transporttasi,
		sum(meal) as meal, sum(holiday_allowance) as holiday_allowance, sum(function_allowance) as function_allowance,
		sum(man_power) as man_power, sum(housing_allowance) as housing_allowance, sum(income_tax) as income_tax,sum(thr) as thr
		,sum(medical_bpjs) as medical_bpjs, sum(medical_obat) as medical_obat, sum(hospitalization) as hospitalization,
		sum(hospitalization2) as hospitalization2,sum(pension_dpa) as pension_dpa,sum(pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(donation) as donation, sum(mp) as mp, sum(pension) as pension, pangkat, statuspernikahan FROM 
		SALARY WHERE tahun ='$year' and bulan = '$bln' group by gol,workcenter order by gol,workcenter");

	}
	function grouptotal($year,$month){
		$hsl = $this->db->query("SELECT (CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost,sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension, pangkat, statuspernikahan,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)
		AS total FROM 
		SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' and a.bulan = '$month' group by groupcost");
	return $hsl;
	}

	function salary_excel_bln($year,$month){
		$hsl = $this->db->query("SELECT a.workcenter,a.dept,a.seksi,a.gol,sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension, pangkat, statuspernikahan,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)
		AS total FROM 
		SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' and a.bulan = '$month' group by a.gol,a.workcenter order by a.gol,a.workcenter");
	return $hsl;
	}
}
