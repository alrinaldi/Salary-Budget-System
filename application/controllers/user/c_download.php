<?php
Class C_download extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download')); 
		}

		public function lakukan_download(){ 
			force_download('dw/pph21 manual.xlsx',NULL);
			} 
}
