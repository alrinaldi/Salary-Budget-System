<?php

class C_overtime extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('dept/m_overtime');
	}
	
	private $master_overtime = 'master_overtime';
	function index() {
		$this->load->view('dept/v_master_ovt', NULL);
	}
	
	function get_overtime(){
		$depts = $this->session->userdata('dept');
		$year  = date('Y');
		$columns = array(
			'id_master_overtime',
			'workcenter',
			'dept',
			'seksi',
			'kontrak',
			'gol1',
			'gol2',
			'gol3',
			'gol4',
			'gol5',
			'gol6',
			'bulan',
			'tahun'
			
		);

		$indexColumn = 'id_master_overtime';
		$sqlCount = "SELECT count('.$indexColumn.') AS ROW_COUNT FROM master_overtime where dept = '$depts' and tahun = '$year'"  ;
		$totalRecords = $this->db->query($sqlCount)->row()->ROW_COUNT;
		
		
		$limit = '';
		$displayStart = $this->input->get_post('start',true);
		$displayLength = $this->input->get_post('length',true);

		if(isset($displayStart)&& $displayLength !='-1'){
			$limit = "LIMIT " . intval($displayStart) . ", " .
			intval($displayLength);
		}
		$uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);

        $get_param_array = explode('&', $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            $arr[$explode[0]] = $explode[1];
		}
		
		$index_of_columns = strpos($uri_string, 'columns', 1);
        $index_of_start = strpos($uri_string, 'start');
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode('&', $uri_columns);
        $arr_columns = array();
		
		foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
		}
		//sort order
		$order = ' ORDER BY ';
        $orderIndex = $arr['order[0][column]'];
        $orderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $orderIndex . '][orderable]'];
        if ($bSortable_ == 'true') {
            $order .= $columns[$orderIndex] . ($orderDir === 'asc' ? ' asc' : ' desc');
		}
			//filter
			$where = '';
			$searchVal = $arr['search[value]'];
			if (isset($searchVal) && $searchVal != '') {
				$where = "  and (";
				for ($i = 0; $i < count($columns); $i++) {
					$where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($searchVal) . "%' OR ";
				}
				$where = substr_replace($where, "", -3);
				$where .= ')';
			}
		//individual column filtering
        $searchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($columns); $i++) {
            $searchable = $arr['columns[' . $i . '][searchable]'];
            if (isset($searchable) && $searchable == 'true' && $searchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($where == '') {
                    $where = '';
                } else {
                    $where .= ' ';
                }
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
	
			//final records
			$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM  master_overtime  where dept = "'.$depts.'"  and tahun = "'.$year.'"' . $where  . $order . ' ' .$limit;
			$result = $this->db->query($sql);
			
			//total rows
			$sql = "SELECT FOUND_ROWS() AS length_count";
			$totalFilteredRows = $this->db->query($sql)->row()->length_count;
			
			//display structure
			$echo = $this->input->get_post('draw', true);
			$output = array(
				"draw" => intval($echo),
				"recordsTotal" => $totalRecords,
				"recordsFiltered" => $totalFilteredRows,
				"data" => array()
			);

			foreach ($result->result_array() as $cols) {
				$row = array();
				foreach ($columns as $col) {
					$row[] = $cols[$col];
				}
				array_push($row, '<button class=\'edit\'>Edit</button>&nbsp;&nbsp;');
            $output['data'][] = $row;
			}
			
			return $output;
	}


	
	function get_ovt() {
		$master_ovt = $this->get_overtime();
		echo json_encode($master_ovt);
	}

	function delete_ovt($id){
		$sql = 'DELETE FROM ' . $this->master_overtime . ' WHERE id_master_overtime=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	function delete_overtime() {
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;
		
		if($this->delete_ovt($id) === TRUE) {
			return TRUE;
		}
		
		return FALSE;
	}


	function update_overtime() {
		$id = $_POST['id_master_overtime'];
		$workcenter = $_POST['workcenter'];
		$seksi = $_POST['seksi'];
		$dept = $_POST['dept'];
		$kontrak = $_POST['kontrak'];
		$gol1 = $_POST['gol1'];
		$gol2 = $_POST['gol2'];
		$gol3 = $_POST['gol3'];
		$gol4 = $_POST['gol4'];
		$gol5 = $_POST['gol5'];
		$gol6 = $_POST['gol6'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];

		if($bulan == 'January'){
			for ($m=1; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
			$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6', bulan = '$month' where bulan = '$month' and tahun ='$tahun' and workcenter = '$workcenter'");
			}
		}elseif($bulan == 'February'){
			for ($m=2; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 2, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan=='March'){
			for ($m=3; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 3, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan =='April'){
			for ($m=4; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 4, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'May'){
			for ($m=5; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 5, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'June'){
			for ($m=6; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 6, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}	
		}elseif ($bulan == 'July'){
			for ($m=7; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 7, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'August'){
			for ($m=8; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 8, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'September'){
			for ($m=9; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 9, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'October'){
			for ($m=10; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 10, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'November'){
			for ($m=11; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 11, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}elseif ($bulan == 'December'){
			for ($m=12; $m<=12; $m++) {
				$month = date('F', mktime(0,0,0,$m, 12, date('Y')));
				$this->db->query("UPDATE master_overtime set workcenter = '$workcenter',seksi='$seksi',dept='$dept',kontrak='$kontrak',
			gol1='$gol1',gol2='$gol2',gol3='$gol3',gol4='$gol4',gol5='$gol5',gol6='$gol6' where bulan = '$month' and tahun ='$tahun'and workcenter = '$workcenter'");
			}
		}

		//if($this->m_overtime->update_ovt($id, $workcenter, $seksi, $dept, $kontrak, $gol1, $gol2,$gol3,$gol4,$gol5,$gol6,$bulan,$tahun) === TRUE) {
		//	return TRUE;
		//}
		
		//return FALSE;
	}
	
	function list_overtime(){
		$depts = $this->session->userdata('dept');
		
		if(!empty($this->input->post('tahunpilih'))){
			$tahun = $this->input->post('tahunpilih');
		}else{
			$tahun = date('Y');
		}
		$x['thn1'] = $tahun;
		$x['data'] = $this->m_overtime->list_overtime($depts,$tahun);
		$this->load->view('dept/v_list_overtime',$x);
	}

	function list_budget_overtime(){
		$yr = date('Y');
		$month = 'January';
		$dept = $this->session->userdata('dept');
		$x['bln'] = $month;
		$x['data']= $this->m_overtime->budget_lembur($yr,$month,$dept);
		$this->load->view('dept/v_list_budget_lembur',$x);
	}

	function set_ovt(){
		$tahun = $this->input->post('thn');
		$bulan = $this->input->post('bln');
		$jam = $this->input->post('jam');
		$wcts = $this->input->post('wcts');
		$gol = $this->input->post('gol');

		if($gol=='gol1'){
			$this->db->query("UPDATE master_overtime set gol1 = '$jam' where workcenter = '$wcts' and bulan = '$bulan' and
			tahun = '$tahun'");
		}elseif($gol=='gol2'){
			$this->db->query("UPDATE master_overtime set gol2 = '$jam' where workcenter = '$wcts' and bulan = '$bulan' and
			tahun = '$tahun'");
		}elseif($gol=='gol3'){
			$this->db->query("UPDATE master_overtime set gol3 = '$jam' where workcenter = '$wcts' and bulan = '$bulan' and
			tahun = '$tahun'");
		}elseif($gol=='gol4'){
			$this->db->query("UPDATE master_overtime set gol4 = '$jam' where workcenter = '$wcts' and bulan = '$bulan' and
			tahun = '$tahun'");
		}else{
		
		}	
		redirect('dept/c_mpp');
	}

}
