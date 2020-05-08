<?php

Class C_excel extends CI_Controller{
	function __construct(){
        parent::__construct();
        if($this->session->userdata('nrp')==''){
            redirect('login');
        }
		$this->load->model('user/m_excel');
		$this->load->model('user/m_mpp');
		$this->load->model('user/m_salary');
	}
	
	function exportmpp(){
		$year = $this->input->post('year');
		$month = $this->input->post('bulan');
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data MPP")
					 ->setSubject("MPP")
					 ->setDescription("Data MPP")
					 ->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT YUTAKA MANUFACTURING INDONESIA "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "MPP"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Project: $year-$month"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Workcenter"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Departemen"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "Seksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "Gol 1"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "Gol 2"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "Gol 3"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "Gol 4"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "Gol 5"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "Gol 6"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "Kontrak"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "Jumlah"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		//$siswa = $this->SiswaModel->view();
		$mpp = $this->db->query("SELECT SUM(gol1+gol2+gol3+gol4+gol5+gol6+kontrak) as jumlah, 
		workcenter,dept,seksi,gol1,gol2,gol3,gol4,gol5,gol6,kontrak FROM master_mpp where tahun = '$year' and bulan = '$month' 
		group by workcenter,bulan,tahun order by workcenter");

		$gt = $this->db->query("SELECT (CASE WHEN TAHUN ='2020' THEN 'GRAND TOTAL' END) as ggrand,SUM(gol1) as ggol1,SUM(gol2) as ggol2,SUM(gol3) as ggol3,SUM(gol4) as ggol4,SUM(gol5) as ggol5,SUM(gol6) as ggol6,SUM(kontrak) as
		gkontrak from master_mpp where tahun = '$year' and bulan = '$month' GROUP BY ggrand");
		foreach($gt->result() as $n):
			$ggrand[] = $n->ggrand;
			$ggol1[] = $n->ggol1;
			$ggol2[] = $n->ggol2;
			$ggol3[] = $n->ggol3;
			$ggol4[] = $n->ggol4;
			$ggol5[] = $n->ggol5;
			$ggol6[] = $n->ggol6;
			$gkontrak[] = $n->gkontrak;
		endforeach;
		$cgt = $gt->num_rows();
		


		$countmpp = $mpp->num_rows();
		$countmpp = $countmpp+10;
		$gcountmpp = $countmpp+1;
		$selisih = $countmpp-2;
		$sg = $gcountmpp-1;

		$grand = $this->db->query("SELECT b.costAllocation,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol1 when b.costAllocation <> 'OPEX' then a.gol1 else 0 end) as totgol1,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol2 when b.costAllocation <> 'OPEX' then a.gol2 else 0 end) as totgol2,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol3 when b.costAllocation <> 'OPEX' then a.gol3 else 0 end) as totgol3,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol4 when b.costAllocation <> 'OPEX' then a.gol4 else 0 end) as totgol4,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol5 when b.costAllocation <> 'OPEX' then a.gol5 else 0 end) as totgol5,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol6 when b.costAllocation <> 'OPEX' then a.gol6 else 0 end) as totgol6,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.kontrak when b.costAllocation <> 'OPEX' then a.kontrak else 0 end) as totkontrak,(CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost
		FROM master_mpp a join costcenter b on a.workcenter = b.costcenter where a.bulan = '$month' and a.tahun = '$year' GROUP BY groupcost");
		foreach($grand->result() as $k):
			$gropcost[]=$k->groupcost;
			$totgol1[]=$k->totgol1;
			$totgol2[]=$k->totgol2;
			$totgol3[]=$k->totgol3;
			$totgol4[]=$k->totgol4;
			$totgol5[]=$k->totgol5;
			$totgol6[]=$k->totgol6;
			$totkontrak[]=$k->totkontrak;
		endforeach;
		$jumlah = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($mpp->result() as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->workcenter);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->dept);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->seksi);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->gol1);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->gol2);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->gol3);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->gol4);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->gol5);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->gol6);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->kontrak);
		  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->jumlah);
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		$lopg = 0;
		for($sg;$sg<$gcountmpp;$sg++){
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$sg, $ggrand[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$sg, $ggol1[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$sg, $ggol2[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$sg, $ggol3[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$sg, $ggol4[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$sg, $ggol5[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$sg, $ggol6[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$sg, $gkontrak[$lopg]);

		$excel->getActiveSheet()->getStyle('C'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$sg)->applyFromArray($style_row);

		$lopg++;
	}

		$lop = 0;
		for($selisih;$selisih<$countmpp;$selisih++){
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$selisih, $gropcost[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$selisih, $totgol1[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$selisih, $totgol2[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$selisih, $totgol3[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$selisih, $totgol4[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$selisih, $totgol5[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$selisih, $totgol6[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$selisih, $totkontrak[$lop]);

		$excel->getActiveSheet()->getStyle('C'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$selisih)->applyFromArray($style_row);

		$lop++;
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Mpp $year-$month");
		$excel->setActiveSheetIndex(0);
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data MPP '.$year.'-'.$month.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }


	  function exportovertime(){
		$year = $this->input->post('year');
		$month = $this->input->post('bulan');
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data Overtime")
					 ->setSubject("Overtime")
					 ->setDescription("Data Overtime")
					 ->setKeywords("Data Overtime");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT YUTAKA MANUFACTURING INDONESIA "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "OVERTIME"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Project: $year"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "JANUARY"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('F5:G5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('F5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('F5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('H5', "FEBRUARY"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('H5:I5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('H5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('H5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('J5', "MARCH"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('J5:K5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('J5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('J5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('L5', "APRIL"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('L5:M5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('L5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('L5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('N5', "MAY"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('N5:O5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('N5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('N5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('P5', "JUNE"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('P5:Q5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('P5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('P5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('P5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('R5', "JULY"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('R5:S5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('R5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('R5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('R5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('T5', "AUGUST"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('T5:U5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('T5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('T5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('T5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('V5', "SEPTEMBER"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('V5:W5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('V5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('V5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('V5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('X5', "OCTOBER"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('X5:Y5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('X5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('X5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('X5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('Z5', "NOVEMBER"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('Z5:AA5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('Z5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('Z5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('Z5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('AB5', "DECEMBER"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('AB5:AC5'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('AB5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('AB5')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('AB5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Workcenter"); // Set kolom A3 dengan tulisan "NO"
		$excel->getActiveSheet()->mergeCells('A5:A6');
		$excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
 // Set Merge Cell pada kolom A1 sampai E1
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Departemen"); // Set kolom B3 dengan tulisan "NIS"
		$excel->getActiveSheet()->mergeCells('B5:B6');
		$excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('B5')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('C5', "Seksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->getActiveSheet()->mergeCells('C5:C6');
		$excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('D5', "Gol "); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->getActiveSheet()->mergeCells('D5:D6');
		$excel->getActiveSheet()->getStyle('D5')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('D5')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('E6', "Price"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('I6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('K6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('L6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('M6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('N6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('O6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('P6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('Q6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('R6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('S6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('T6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('U6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('V6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('W6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('X6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('Y6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('Z6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('AA6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('AB6', "Quantity"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('AC6', "Amount"); // Set kolom E3 dengan tulisan "ALAMAT"

	
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		
		$excel->getActiveSheet()->getStyle('A5:A6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5:B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5:C6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5:D6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('T6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('U6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB6')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC6')->applyFromArray($style_col);






		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		//$siswa = $this->SiswaModel->view();
		$mpp = $this->db->query("SELECT SUM(gol1+gol2+gol3+gol4+gol5+gol6+kontrak) as jumlah, 
		workcenter,dept,seksi,gol1,gol2,gol3,gol4,gol5,gol6,kontrak FROM master_overtime where tahun = '$year' and bulan = '$month' 
		group by workcenter,bulan,tahun order by workcenter");

		$gt = $this->db->query("SELECT (CASE WHEN TAHUN ='2020' THEN 'GRAND TOTAL' END) as ggrand,SUM(gol1) as ggol1,SUM(gol2) as ggol2,SUM(gol3) as ggol3,SUM(gol4) as ggol4,SUM(gol5) as ggol5,SUM(gol6) as ggol6,SUM(kontrak) as
		gkontrak from master_overtime WHERE tahun = '$year' and bulan = '$month' GROUP BY ggrand");
		foreach($gt->result() as $n):
			$ggrand[] = $n->ggrand;
			$ggol1[] = $n->ggol1;
			$ggol2[] = $n->ggol2;
			$ggol3[] = $n->ggol3;
			$ggol4[] = $n->ggol4;
			$ggol5[] = $n->ggol5;
			$ggol6[] = $n->ggol6;
			$gkontrak[] = $n->gkontrak;
		endforeach;
		$cgt = $gt->num_rows();
		
		$countmpp = $mpp->num_rows();
		$countmpp = $countmpp+10;
		$gcountmpp = $countmpp+1;
		$selisih = $countmpp-2;
		$sg = $gcountmpp-1;

		$ovtjan = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		 a.gol in('1','2','3','4','Kontrak') and a.bulan = 'JANUARY' GROUP by a.workcenter,a.gol,a.bulan 
		 ORDER by a.workcenter");
		 $ovtjanc = $ovtjan->num_rows();

		 $ovtfeb = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		 a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		a.gol in('1','2','3','4','Kontrak') and a.bulan = 'FEBRUARY' and c.bulan = 'FEBRUARY' GROUP by a.workcenter,a.gol,a.bulan 
		ORDER by a.workcenter");

		$ovtmar = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
 		from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
 		 a.gol in('1','2','3','4','Kontrak') and a.bulan = 'MARCH' and c.bulan = 'MARCH' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");
		  
		  $ovtapr = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'APRIL' and c.bulan = 'APRIL' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		$ovtmay = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'MAY' and c.bulan = 'MAY' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtjun = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'JUNE' and c.bulan = 'JUNE' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtjul = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'JULY' and c.bulan = 'JULY' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtaug = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'AUGUST' and c.bulan = 'AUGUST' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtsep = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'SEPTEMBER' and c.bulan = 'SEPTEMBER' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtokt = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'OCTOBER' and c.bulan = 'OCTOBER' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtnov = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'NOVEMBER' and c.bulan = 'NOVEMBER' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");

		  $ovtdec = $this->db->query("SELECT (CASE WHEN a.gol = '1' then c.gol1 when a.gol = '2' then c.gol2 when a.gol = '3' then c.gol3 when a.gol = '4' then c.gol4 when a.gol = 'Kontrak' then c.kontrak else 0 end) as quantity,
		a.workcenter as wct,a.dept,a.seksi,b.rupiah as rp,a.gol as gol,(CASE WHEN a.gol = '1' then a.budget WHEN a.gol = '2' THEN a.budget WHEN a.gol = '3' THEN a.budget WHEN a.gol = '4' then a.budget when a.gol = 'Kontrak' then a.budget else 0 end) as budget
		 from overtime a join asumsi_overtime b on a.gol = b.gol join master_overtime c on a.workcenter = c.workcenter where
		  a.gol in('1','2','3','4','Kontrak') and a.bulan = 'DECEMBER' and c.bulan = 'DECEMBER' GROUP by a.workcenter,a.gol,a.bulan 
		  ORDER by a.workcenter");


		foreach($ovtjan->result() as $c):
			$budget[] = $c->budget;
			$qty[] = $c->quantity;
			$wct[] = $c->wct;
			$rp[] = $c->rp;
			$gol[] = $c->gol;
		endforeach;


		$grand = $this->db->query("SELECT b.costAllocation,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol1 when b.costAllocation <> 'OPEX' then a.gol1 else 0 end) as totgol1,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol2 when b.costAllocation <> 'OPEX' then a.gol2 else 0 end) as totgol2,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol3 when b.costAllocation <> 'OPEX' then a.gol3 else 0 end) as totgol3,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol4 when b.costAllocation <> 'OPEX' then a.gol4 else 0 end) as totgol4,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol5 when b.costAllocation <> 'OPEX' then a.gol5 else 0 end) as totgol5,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol6 when b.costAllocation <> 'OPEX' then a.gol6 else 0 end) as totgol6,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.kontrak when b.costAllocation <> 'OPEX' then a.kontrak else 0 end) as totkontrak,(CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost
		FROM master_overtime a join costcenter b on a.workcenter = b.costcenter where a.bulan = '$month' and a.tahun = '$year' GROUP BY groupcost");
		foreach($grand->result() as $k):
			$gropcost[]=$k->groupcost;
			$totgol1[]=$k->totgol1;
			$totgol2[]=$k->totgol2;
			$totgol3[]=$k->totgol3;
			$totgol4[]=$k->totgol4;
			$totgol5[]=$k->totgol5;
			$totgol6[]=$k->totgol6;
			$totkontrak[]=$k->totkontrak;
		endforeach;
		$jumlah = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 7;
		$numrow1 = 7;
		$numrow2 = 7;
		$numrow3 = 7;
		$numrow4 = 7;
		$numrow5 = 7;
		$numrow6 = 7;
		$numrow7 = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
		$numrow8 = 7;
		$numrow9 = 7;
		$numrow10 = 7;
		$numrow11 = 7;
		$numrow12 = 7;
		foreach($ovtjan->result() as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->wct);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->dept);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->seksi);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->gol);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->rp);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->quantity);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->budget);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);

		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
		foreach($ovtfeb->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow1, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow1, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('H'.$numrow1)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow1)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow1++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtmar->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow2, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow2, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('J'.$numrow2)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K'.$numrow2)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow2++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtapr->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow3, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow3, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('L'.$numrow3)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow3)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow3++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtmay->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow4, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow4, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('N'.$numrow4)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('O'.$numrow4)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow4++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtjun->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow5, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow5, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('P'.$numrow5)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow5)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow5++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtjul->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow6, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow6, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('R'.$numrow6)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow6)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow6++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtaug->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow7, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow7, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('T'.$numrow7)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('U'.$numrow7)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow7++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtsep->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow8, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow8, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('V'.$numrow8)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow8)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow8++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtokt->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow9, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow9, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('X'.$numrow9)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow9)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow9++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtnov->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow10, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow10, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('Z'.$numrow10)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow10)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow10++; // Tambah 1 setiap kali looping
		  }

		  foreach($ovtdec->result() as $data){ // Lakukan looping pada variabel siswa

			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow11, $data->quantity);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow11, $data->budget);
  
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('AB'.$numrow11)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow11)->applyFromArray($style_row);
  
			$no++; // Tambah 1 setiap kali looping
			$numrow11++; // Tambah 1 setiap kali looping
		  }




	// 	$lopg = 0;
	// 	for($sg;$sg<$gcountmpp;$sg++){
	// 	$excel->setActiveSheetIndex(0)->setCellValue('C'.$sg, $ggrand[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('D'.$sg, $ggol1[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('E'.$sg, $ggol2[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('F'.$sg, $ggol3[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('G'.$sg, $ggol4[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('H'.$sg, $ggol5[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('I'.$sg, $ggol6[$lopg]);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('J'.$sg, $gkontrak[$lopg]);

	// 	$excel->getActiveSheet()->getStyle('C'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('D'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('E'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('F'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('G'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('H'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('I'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('J'.$sg)->applyFromArray($style_row);
	// 	$excel->getActiveSheet()->getStyle('K'.$sg)->applyFromArray($style_row);

	// 	$lopg++;
	// }

		// $lop = 0;
		// for($selisih;$selisih<$countmpp;$selisih++){
		// $excel->setActiveSheetIndex(0)->setCellValue('C'.$selisih, $gropcost[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('D'.$selisih, $totgol1[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('E'.$selisih, $totgol2[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('F'.$selisih, $totgol3[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('G'.$selisih, $totgol4[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('H'.$selisih, $totgol5[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('I'.$selisih, $totgol6[$lop]);
		// $excel->setActiveSheetIndex(0)->setCellValue('J'.$selisih, $totkontrak[$lop]);

		// $excel->getActiveSheet()->getStyle('C'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('D'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('E'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('F'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('G'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('H'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('I'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('J'.$selisih)->applyFromArray($style_row);
		// $excel->getActiveSheet()->getStyle('K'.$selisih)->applyFromArray($style_row);

		// $lop++;
		// }
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(10);



		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Overtime $year");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Overtime '.$year.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }

	  function exportmpp_y(){
		$year = $this->input->post('year');
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data Overtime")
					 ->setSubject("Overtime (Yearly)")
					 ->setDescription("Data Overtime")
					 ->setKeywords("Data Overtime");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT YUTAKA MANUFACTURING INDONESIA "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "MPP"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Project: $year"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Workcenter"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Departemen"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "Seksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "Gol 1"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "Gol 2"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "Gol 3"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "Gol 4"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "Gol 5"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "Gol 6"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "Kontrak"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "Jumlah"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		//$siswa = $this->SiswaModel->view();
		$mpp = $this->db->query("SELECT SUM(gol1+gol2+gol3+gol4+gol5+gol6+kontrak) as jumlah, 
		workcenter,dept,seksi,gol1,gol2,gol3,gol4,gol5,gol6,kontrak FROM master_mpp where tahun = '$year' 
		group by workcenter,tahun order by workcenter");

		$gt = $this->db->query("SELECT (CASE WHEN TAHUN ='2020' THEN 'GRAND TOTAL' END) as ggrand,SUM(gol1) as ggol1,SUM(gol2) as ggol2,SUM(gol3) as ggol3,SUM(gol4) as ggol4,SUM(gol5) as ggol5,SUM(gol6) as ggol6,SUM(kontrak) as
		gkontrak from master_mpp GROUP BY ggrand");
		foreach($gt->result() as $n):
			$ggrand[] = $n->ggrand;
			$ggol1[] = $n->ggol1;
			$ggol2[] = $n->ggol2;
			$ggol3[] = $n->ggol3;
			$ggol4[] = $n->ggol4;
			$ggol5[] = $n->ggol5;
			$ggol6[] = $n->ggol6;
			$gkontrak[] = $n->gkontrak;
		endforeach;
		$cgt = $gt->num_rows();
		


		$countmpp = $mpp->num_rows();
		$countmpp = $countmpp+10;
		$gcountmpp = $countmpp+1;
		$selisih = $countmpp-2;
		$sg = $gcountmpp-1;

		$grand = $this->db->query("SELECT b.costAllocation,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol1 when b.costAllocation <> 'OPEX' then a.gol1 else 0 end) as totgol1,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol2 when b.costAllocation <> 'OPEX' then a.gol2 else 0 end) as totgol2,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol3 when b.costAllocation <> 'OPEX' then a.gol3 else 0 end) as totgol3,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol4 when b.costAllocation <> 'OPEX' then a.gol4 else 0 end) as totgol4,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol5 when b.costAllocation <> 'OPEX' then a.gol5 else 0 end) as totgol5,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol6 when b.costAllocation <> 'OPEX' then a.gol6 else 0 end) as totgol6,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.kontrak when b.costAllocation <> 'OPEX' then a.kontrak else 0 end) as totkontrak,(CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost
		FROM master_mpp a join costcenter b on a.workcenter = b.costcenter where  a.tahun = '$year' GROUP BY groupcost");
		foreach($grand->result() as $k):
			$gropcost[]=$k->groupcost;
			$totgol1[]=$k->totgol1;
			$totgol2[]=$k->totgol2;
			$totgol3[]=$k->totgol3;
			$totgol4[]=$k->totgol4;
			$totgol5[]=$k->totgol5;
			$totgol6[]=$k->totgol6;
			$totkontrak[]=$k->totkontrak;
		endforeach;
		$jumlah = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($mpp->result() as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->workcenter);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->dept);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->seksi);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->gol1);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->gol2);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->gol3);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->gol4);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->gol5);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->gol6);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->kontrak);
		  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->jumlah);
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		$lopg = 0;
		for($sg;$sg<$gcountmpp;$sg++){
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$sg, $ggrand[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$sg, $ggol1[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$sg, $ggol2[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$sg, $ggol3[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$sg, $ggol4[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$sg, $ggol5[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$sg, $ggol6[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$sg, $gkontrak[$lopg]);

		$excel->getActiveSheet()->getStyle('C'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$sg)->applyFromArray($style_row);

		$lopg++;
	}

		$lop = 0;
		for($selisih;$selisih<$countmpp;$selisih++){
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$selisih, $gropcost[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$selisih, $totgol1[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$selisih, $totgol2[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$selisih, $totgol3[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$selisih, $totgol4[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$selisih, $totgol5[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$selisih, $totgol6[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$selisih, $totkontrak[$lop]);

		$excel->getActiveSheet()->getStyle('C'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$selisih)->applyFromArray($style_row);

		$lop++;
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Mpp $year");
		$excel->setActiveSheetIndex(0);
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data MPP '.$year.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }

	  function exportovertime_y(){
		$year = $this->input->post('year');
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data MPP")
					 ->setSubject("MPP")
					 ->setDescription("Data MPP")
					 ->setKeywords("Data MPP");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT YUTAKA MANUFACTURING INDONESIA "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "MPP"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Project: $year"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Workcenter"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Departemen"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "Seksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "Gol 1"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "Gol 2"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "Gol 3"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "Gol 4"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "Gol 5"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "Gol 6"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "Kontrak"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "Jumlah"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		//$siswa = $this->SiswaModel->view();
		$mpp = $this->db->query("SELECT SUM(gol1+gol2+gol3+gol4+gol5+gol6+kontrak) as jumlah, 
		workcenter,dept,seksi,gol1,gol2,gol3,gol4,gol5,gol6,kontrak FROM master_mpp where tahun = '$year' 
		group by workcenter,tahun order by workcenter");

		$gt = $this->db->query("SELECT (CASE WHEN TAHUN ='2020' THEN 'GRAND TOTAL' END) as ggrand,SUM(gol1) as ggol1,SUM(gol2) as ggol2,SUM(gol3) as ggol3,SUM(gol4) as ggol4,SUM(gol5) as ggol5,SUM(gol6) as ggol6,SUM(kontrak) as
		gkontrak from master_mpp GROUP BY ggrand");
		foreach($gt->result() as $n):
			$ggrand[] = $n->ggrand;
			$ggol1[] = $n->ggol1;
			$ggol2[] = $n->ggol2;
			$ggol3[] = $n->ggol3;
			$ggol4[] = $n->ggol4;
			$ggol5[] = $n->ggol5;
			$ggol6[] = $n->ggol6;
			$gkontrak[] = $n->gkontrak;
		endforeach;
		$cgt = $gt->num_rows();
		


		$countmpp = $mpp->num_rows();
		$countmpp = $countmpp+10;
		$gcountmpp = $countmpp+1;
		$selisih = $countmpp-2;
		$sg = $gcountmpp-1;

		$grand = $this->db->query("SELECT b.costAllocation,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol1 when b.costAllocation <> 'OPEX' then a.gol1 else 0 end) as totgol1,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol2 when b.costAllocation <> 'OPEX' then a.gol2 else 0 end) as totgol2,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol3 when b.costAllocation <> 'OPEX' then a.gol3 else 0 end) as totgol3,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol4 when b.costAllocation <> 'OPEX' then a.gol4 else 0 end) as totgol4,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol5 when b.costAllocation <> 'OPEX' then a.gol5 else 0 end) as totgol5,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.gol6 when b.costAllocation <> 'OPEX' then a.gol6 else 0 end) as totgol6,SUM(CASE WHEN b.costAllocation = 'OPEX' then a.kontrak when b.costAllocation <> 'OPEX' then a.kontrak else 0 end) as totkontrak,(CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost
		FROM master_mpp a join costcenter b on a.workcenter = b.costcenter where  a.tahun = '$year' GROUP BY groupcost");
		foreach($grand->result() as $k):
			$gropcost[]=$k->groupcost;
			$totgol1[]=$k->totgol1;
			$totgol2[]=$k->totgol2;
			$totgol3[]=$k->totgol3;
			$totgol4[]=$k->totgol4;
			$totgol5[]=$k->totgol5;
			$totgol6[]=$k->totgol6;
			$totkontrak[]=$k->totkontrak;
		endforeach;
		$cgrand = $grand->num_rows();
		$jumlah = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($mpp->result() as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->workcenter);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->dept);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->seksi);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->gol1);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->gol2);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->gol3);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->gol4);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->gol5);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->gol6);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->kontrak);
		  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->jumlah);
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		$lopg = 0;
		for($sg;$sg<$gcountmpp;$sg++){
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$sg, $ggrand[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$sg, $ggol1[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$sg, $ggol2[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$sg, $ggol3[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$sg, $ggol4[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$sg, $ggol5[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$sg, $ggol6[$lopg]);
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$sg, $gkontrak[$lopg]);

		$excel->getActiveSheet()->getStyle('C'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$sg)->applyFromArray($style_row);

		$lopg++;
	}

		$lop = 0;
		for($selisih;$selisih<$countmpp;$selisih++){
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$selisih, $gropcost[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$selisih, $totgol1[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$selisih, $totgol2[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$selisih, $totgol3[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('G'.$selisih, $totgol4[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$selisih, $totgol5[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$selisih, $totgol6[$lop]);
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$selisih, $totkontrak[$lop]);

		$excel->getActiveSheet()->getStyle('C'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$selisih)->applyFromArray($style_row);

		$lop++;
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Mpp $year");
		$excel->setActiveSheetIndex(0);
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data MPP '.$year.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }

	  function export_salary_bln(){
		$year = $this->input->post('tahun');
		$month = $this->input->post('bulan');
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data Salary")
					 ->setSubject("Salary")
					 ->setDescription("Data Salary")
					 ->setKeywords("Data Salary");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT YUTAKA MANUFACTURING INDONESIA "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "REKAP SALARY"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Project: $year-$month"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
			  		

		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Workcenter"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Departemen"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "Seksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "Allocation Dept"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "Gol "); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "MP"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "Salary"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "Tunj. Kehadiran"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "Tunj. Lembur"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "Tunj. Makan"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "Tunj. Transport"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('L5', "Tunj. Obat"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('M5', " Tunj. BPJS Sehat"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('N5', "Tunj. Rumah Sakit"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('O5', "Tunj. Rumah Sakit 2 (Excess)"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('P5', "Donation1 "); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('Q5', "Telekomunikasi"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('R5', "Tunj. Function Allow "); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('S5', "THR"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('T5', "BONUS"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('U5', "JAMSOSTEK"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('V5', "DPA  & BPJS PENSIUN"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('W5', " Tunj. Pajak (Reguler)"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('X5', "TOTAL"); // Set kolom C3 dengan tulisan "NAMA"
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('T5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('U5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X5')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		//$siswa = $this->SiswaModel->view();
		$hsl = $this->db->query("SELECT a.workcenter,a.dept,a.seksi,a.gol,b.costAllocation,sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)AS total FROM SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' and a.bulan = '$month' group by a.gol,a.workcenter order by a.workcenter,a.gol asc");
	

	
		$grandcs = $this->db->query("SELECT (CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost,sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)
		AS total FROM 
		SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' and a.bulan = '$month' group by groupcost");
		
		
		$gt = $this->db->query("SELECT sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)
		AS total FROM 
		SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' and a.bulan = '$month'");
		$gtc = $gt->num_rows();
		
		foreach($grandcs->result() as $x){
			$gpca[] = $x->groupcost;
			$mp[] = $x->mp;
			$gpc[] = $x->gp;
			$tnjug[] = $x->uang_hadir;
			$ovtg[] = $x->lembur;
			$mkng[]= $x->meal;
			$tsptg[] = $x->transporttasi;
			$obtg[] = $x->medical_obat;
			$obpjsg[] = $x->medical_bpjs;
			$rs1g[] = $x->hospitalization;
			$rs2g[] = $x->hospitalization2;
			$rmg[] = $x->housing_allowance;
			$ctg[] = $x->holiday_allowance;
			$dtg[] = $x->donation;
			$tlg[] = $x->telecomunication;
			$fcg[] = $x->function_allowance;
			$thrg[] = $x->thr;
			$bong[] = $x->bonus;
			$mpig[] = $x->man_power;
			$psg[] = $x->pension;
			$phg[] = $x->income_tax;
			$totg[] = $x->total;
		}

		foreach($gt->result() as $k){
			$mpt[] = $k->mp;
			$gpct[] = $k->gp;
			$tnjugt[] = $k->uang_hadir;
			$ovtgt[] = $k->lembur;
			$mkngt[]= $k->meal;
			$tsptgt[] = $k->transporttasi;
			$obtgt[] = $k->medical_obat;
			$obpjsgt[] = $k->medical_bpjs;
			$rs1gt[] = $k->hospitalization;
			$rs2gt[] = $k->hospitalization2;
			$rmgt[] = $k->housing_allowance;
			$ctgt[] = $k->holiday_allowance;
			$dtgt[] = $k->donation;
			$tlgt[] = $k->telecomunication;
			$fcgt[] = $k->function_allowance;
			$thrgt[] = $k->thr;
			$bongt[] = $k->bonus;
			$mpigt[] = $k->man_power;
			$psgt[] = $k->pension;
			$phgt[] = $k->income_tax;
			$totgt[] = $k->total;
		}
		$counthsl = $hsl->num_rows();
		$counthsl = $counthsl+10;
	   $gcounthsl = $counthsl+$gtc; 
	    $selisih = $counthsl-2;
	   $sg = $gcounthsl-1;
$lop=0;
$selisih;


		$jumlah = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($hsl->result() as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->workcenter);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->dept);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->seksi);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->costAllocation);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->gol);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->mp);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->gp);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->uang_hadir);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->lembur);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->meal);
		  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->transporttasi);
		  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->medical_obat);
		  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->medical_bpjs);
		  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->hospitalization);
		  $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->hospitalization2);
		  $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data->donation);
		  $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->telecomunication);
		  $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->function_allowance);
		  $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->thr);
		  $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->bonus);
		  $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->man_power);
		  $excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->pension);
		  $excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->income_tax);
		  $excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->total);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);


		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
	
		$tt = 'TOTAL';
		$lopt = 0;
		for($selisih;$selisih<$counthsl;$selisih++){
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$selisih, $gpca[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$selisih, $mp[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$selisih, $gpc[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$selisih, $tnjug[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$selisih, $ovtg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$selisih, $mkng[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$selisih, $tsptg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$selisih, $obtg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$selisih, $obpjsg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$selisih, $rs1g[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$selisih, $rs2g[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$selisih, $rmg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$selisih, $ctg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$selisih, $dtg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$selisih, $tlg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$selisih, $fcg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$selisih, $thrg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$selisih, $bong[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$selisih, $mpig[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$selisih, $psg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$selisih, $phg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$selisih, $totg[$lop]);
 
	  $excel->getActiveSheet()->getStyle('C'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('L'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('M'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('N'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('O'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('P'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('Q'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('S'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('T'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('U'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('V'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('W'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('X'.$selisih)->applyFromArray($style_row);
	 $lop++;
 
		}
		for($sg;$sg<$gcounthsl;$sg++){
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$sg, $tt);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$sg, $mpt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$sg, $gpct[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$sg, $tnjugt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$sg, $ovtgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$sg, $mkngt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$sg, $tsptgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$sg, $obtgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$sg, $obpjsgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$sg, $rs1gt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$sg, $rs2gt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$sg, $rmgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$sg, $ctgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$sg, $dtgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$sg, $tlgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$sg, $fcgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$sg, $thrgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$sg, $bongt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$sg, $mpigt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$sg, $psgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$sg, $phgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$sg, $totgt[$lopt]);
 
	  $excel->getActiveSheet()->getStyle('C'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('L'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('M'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('N'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('O'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('P'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('Q'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('S'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('T'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('U'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('V'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('W'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('X'.$sg)->applyFromArray($style_row);
	 $lop++;
 
		}
		
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(30); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(30);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Salary $year-$month");
		$excel->setActiveSheetIndex(0);
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Salary '.$year.'-'.$month.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }

	  function export_salary_thn(){
		$year = $this->input->post('tahun');
		//$month = $this->input->post('bulan');
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
					 ->setLastModifiedBy('My Notes Code')
					 ->setTitle("Data Salary")
					 ->setSubject("Salary")
					 ->setDescription("Data Salary")
					 ->setKeywords("Data Salary");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "PT YUTAKA MANUFACTURING INDONESIA "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A2', "REKAP SALARY"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Project: $year"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		// Buat header tabel nya pada baris ke 3
			  		

		$excel->setActiveSheetIndex(0)->setCellValue('A5', "Workcenter"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "Departemen"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "Seksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "Allocation Dept"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "Gol "); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "MP"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "Salary"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "Tunj. Kehadiran"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "Tunj. Lembur"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "Tunj. Makan"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "Tunj. Transport"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('L5', "Tunj. Obat"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('M5', " Tunj. BPJS Sehat"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('N5', "Tunj. Rumah Sakit"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('O5', "Tunj. Rumah Sakit 2 (Excess)"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('P5', "Donation1 "); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('Q5', "Telekomunikasi"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('R5', "Tunj. Function Allow "); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('S5', "THR"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('T5', "BONUS"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('U5', "JAMSOSTEK"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('V5', "DPA  & BPJS PENSIUN"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('W5', " Tunj. Pajak (Reguler)"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('X5', "TOTAL"); // Set kolom C3 dengan tulisan "NAMA"
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('T5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('U5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W5')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X5')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		//$siswa = $this->SiswaModel->view();
		$hsl = $this->db->query("SELECT a.workcenter,a.dept,a.seksi,a.gol,b.costAllocation,sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)AS total FROM SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' group by a.gol,a.workcenter order by a.workcenter,a.gol asc");
	

	
		$grandcs = $this->db->query("SELECT (CASE WHEN b.costAllocation <> 'OPEX' then 'COGS' else 'OPEX' end) as groupcost,sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus, sum(a.lembur) as lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus+a.lembur+a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)
		AS total FROM 
		SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' group by groupcost");
		
		
		$gt = $this->db->query("SELECT sum(a.gp) as gp, sum(a.incentive) as incentive, 
		sum(a.bonus) as bonus,lembur, sum(a.uang_hadir) as uang_hadir, sum(a.transporttasi) transporttasi,
		sum(a.meal) as meal, sum(a.holiday_allowance) as holiday_allowance, sum(a.function_allowance) as function_allowance,
		sum(a.man_power) as man_power, sum(a.housing_allowance) as housing_allowance, sum(a.income_tax) as income_tax,sum(a.thr) as thr,sum(a.medical_bpjs) as medical_bpjs, sum(a.medical_obat) as medical_obat, sum(a.hospitalization) as hospitalization,
		sum(a.hospitalization2) as hospitalization2,sum(a.pension_dpa) as pension_dpa,sum(a.pension_bpjs) as pension_bpjs,
		bulan, tahun,sum(a.donation) as donation, sum(a.mp) as mp, sum(a.pension) as pension,
		sum(a.telecomunication) as telecomunication,SUM(a.gp+a.incentive+a.bonus++a.uang_hadir+a.transporttasi+
		a.meal+a.holiday_allowance+a.function_allowance+a.man_power+a.housing_allowance+a.income_tax+a.thr+a.medical_bpjs+
		a.medical_obat+a.hospitalization+a.hospitalization2+a.telecomunication+a.pension_dpa+a.pension_bpjs+a.donation+
		a.pension)
		AS total FROM 
		SALARY a join costcenter b on a.workcenter= b.costcenter WHERE a.tahun ='$year' ");
		$gtc = $gt->num_rows();
		
		foreach($grandcs->result() as $x){
			$gpca[] = $x->groupcost;
			$mp[] = $x->mp;
			$gpc[] = $x->gp;
			$tnjug[] = $x->uang_hadir;
			$ovtg[] = $x->lembur;
			$mkng[]= $x->meal;
			$tsptg[] = $x->transporttasi;
			$obtg[] = $x->medical_obat;
			$obpjsg[] = $x->medical_bpjs;
			$rs1g[] = $x->hospitalization;
			$rs2g[] = $x->hospitalization2;
			$rmg[] = $x->housing_allowance;
			$ctg[] = $x->holiday_allowance;
			$dtg[] = $x->donation;
			$tlg[] = $x->telecomunication;
			$fcg[] = $x->function_allowance;
			$thrg[] = $x->thr;
			$bong[] = $x->bonus;
			$mpig[] = $x->man_power;
			$psg[] = $x->pension;
			$phg[] = $x->income_tax;
			$totg[] = $x->total;
		}

		foreach($gt->result() as $k){
			$mpt[] = $k->mp;
			$gpct[] = $k->gp;
			$tnjugt[] = $k->uang_hadir;
			$ovtgt[] = $k->lembur;
			$mkngt[]= $k->meal;
			$tsptgt[] = $k->transporttasi;
			$obtgt[] = $k->medical_obat;
			$obpjsgt[] = $k->medical_bpjs;
			$rs1gt[] = $k->hospitalization;
			$rs2gt[] = $k->hospitalization2;
			$rmgt[] = $k->housing_allowance;
			$ctgt[] = $k->holiday_allowance;
			$dtgt[] = $k->donation;
			$tlgt[] = $k->telecomunication;
			$fcgt[] = $k->function_allowance;
			$thrgt[] = $k->thr;
			$bongt[] = $k->bonus;
			$mpigt[] = $k->man_power;
			$psgt[] = $k->pension;
			$phgt[] = $k->income_tax;
			$totgts[] = $k->total;
			$totgt[] = $totgts[]+$ovtgt[];
		}
		$counthsl = $hsl->num_rows();
		$counthsl = $counthsl+10;
	   $gcounthsl = $counthsl+$gtc; 
	    $selisih = $counthsl-2;
	   $sg = $gcounthsl-1;
$lop=0;
$selisih;


		$jumlah = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($hsl->result() as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->workcenter);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->dept);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->seksi);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->costAllocation);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->gol);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->mp);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->gp);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->uang_hadir);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->lembur);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->meal);
		  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->transporttasi);
		  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->medical_obat);
		  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->medical_bpjs);
		  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->hospitalization);
		  $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->hospitalization2);
		  $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data->donation);
		  $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->telecomunication);
		  $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->function_allowance);
		  $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->thr);
		  $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->bonus);
		  $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->man_power);
		  $excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->pension);
		  $excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->income_tax);
		  $excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->total);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);


		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
	
		$tt = 'TOTAL';
		$lopt = 0;
		for($selisih;$selisih<$counthsl;$selisih++){
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$selisih, $gpca[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$selisih, $mp[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$selisih, $gpc[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$selisih, $tnjug[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$selisih, $ovtg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$selisih, $mkng[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$selisih, $tsptg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$selisih, $obtg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$selisih, $obpjsg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$selisih, $rs1g[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$selisih, $rs2g[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$selisih, $rmg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$selisih, $ctg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$selisih, $dtg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$selisih, $tlg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$selisih, $fcg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$selisih, $thrg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$selisih, $bong[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$selisih, $mpig[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$selisih, $psg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$selisih, $phg[$lop]);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$selisih, $totg[$lop]);
 
	  $excel->getActiveSheet()->getStyle('C'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('L'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('M'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('N'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('O'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('P'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('Q'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('S'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('T'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('U'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('V'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('W'.$selisih)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('X'.$selisih)->applyFromArray($style_row);
	 $lop++;
 
		}
		for($sg;$sg<$gcounthsl;$sg++){
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$sg, $tt);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$sg, $mpt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$sg, $gpct[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$sg, $tnjugt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$sg, $ovtgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$sg, $mkngt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$sg, $tsptgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$sg, $obtgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$sg, $obpjsgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$sg, $rs1gt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$sg, $rs2gt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$sg, $rmgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$sg, $ctgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$sg, $dtgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$sg, $tlgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$sg, $fcgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$sg, $thrgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$sg, $bongt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$sg, $mpigt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$sg, $psgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$sg, $phgt[$lopt]);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$sg, $totgt[$lopt]);
 
	  $excel->getActiveSheet()->getStyle('C'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('H'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('L'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('M'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('N'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('O'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('P'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('Q'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('R'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('S'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('T'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('U'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('V'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('W'.$sg)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('X'.$sg)->applyFromArray($style_row);
	 $lop++;
 
		}
		
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(30); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(30);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Salary $year");
		$excel->setActiveSheetIndex(0);
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Salary '.$year.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }
	
	
	}
    

