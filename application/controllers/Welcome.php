<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Welcome extends CI_Controller {

	public function index()
	{
		// Load the database and spreadsheet libraries
		$this->load->database();
		$this->load->library('spreadsheet');
	
		// Get the data from the database
		$data = $this->db->get('kelayakan')->result_array();
	
		// Create a new Spreadsheet object
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
	
		// Set the worksheet title
		$spreadsheet->getActiveSheet()->setTitle('Data Export');
	
		// Add the data to the worksheet
		$spreadsheet->getActiveSheet()->fromArray($data, null, 'A1');
	
		// Create a new Excel object and save the spreadsheet as a file
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$filename = 'data_export.xlsx';
		$writer->save($filename);
	
		// Force the download of the file
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		readfile($filename);
		unlink($filename);
	}
	

}