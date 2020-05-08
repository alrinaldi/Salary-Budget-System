<?PHP
Class M_mpp extends CI_Model{
	private $master_mpp = 'master_mpp';
	
	function get_mpp(){
		$columns = array(
			'id_master_mpp',
			'workcenter',
			'seksi',
			'dept',
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

		$indexColumn = 'id_master_mpp';
		$sqlCount = 'SELECT count('.$indexColumn.') AS ROW_COUNT FROM ' . $this->master_mpp . ' where dept = "HRD" '  ;
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
			$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM ' . $this->master_mpp . ' where dept = "HRD"'  . $where  . $order . ' ' .$limit;
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
				array_push($row, '<button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id='. $cols[$indexColumn] .'>Delete</button>');
            $output['data'][] = $row;
			}
			
			return $output;
	}

	function delete_mpp($id){
		$sql = 'DELETE FROM ' . $this->master_mpp . ' WHERE id_master_mpp=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	function update_mpp($id_master_mpp, $workcenter, $seksi, $dept, $kontrak, $gol1,$gol2,$gol3,$gol4,$gol5,$gol6,$bulan,$tahun) {
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
		
		$this->db->where('id_master_mpp', $id_master_mpp);
		$this->db->update($this->master_mpp, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	function add_mpp($workcenter, $seksi, $dept, $kontrak, $gol1,$gol2,$gol3,$gol4,$gol5,$gol6,$bulan,$tahun) {
		$data = array(
					'workcenter' => $workcenter,
					'seksi' => $seksi,
					'dept' => $dept,
					'$kontrak' => $kontrak,
					'gol1' => $gol1,
					'gol2' => $gol2,
					'gol3' => $gol3,
					'gol4' => $gol4,
					'gol5' => $gol5,
					'gol6' => $gol6,
					'bulan' => $bulan,
					'tahun' => $tahun
				);		
		$this->db->insert($this->master_mpp, $data);
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}



	function list_mpp($depts,$tahun){
		$hsl = $this->db->query("SELECT * FROM MASTER_MPP  WHERE dept = '$depts' and tahun = '$tahun' ");
		return $hsl;
	}
	function list_mpp_filt(){

	}

}
