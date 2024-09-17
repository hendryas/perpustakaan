<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller {

    public function index()
    {
        // Load the database library
        $this->load->database();

        // Get the data from the database
        $query = $this->db->query("SELECT * FROM kelayakan");
        $data = $query->result_array();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set the worksheet title
        $spreadsheet->getActiveSheet()->setTitle('Data Export');

        // Add the data to the worksheet
        $spreadsheet->getActiveSheet()->fromArray($data, null, 'A1');

        // Create a new Excel object and save the spreadsheet as a file
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_export.xlsx';
        $writer->save($filename);

        // Force the download of the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        readfile($filename);
        unlink($filename);
    }

}