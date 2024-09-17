<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryPinjam extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    $this->load->model('admin/admin_model', 'adminModel');
    $this->load->model('manajemenbuku/manajemenbuku_model', 'bukuModel');
    $this->load->model('buku/buku_model', 'bukuModels');
    $this->load->model('historypinjam/historypinjam_model', 'pinjamModels');
  }

  public function index()
  {
    $data['title'] = 'History Pinjam';
    $email = $this->session->userdata('email');
    $data['user'] = $this->adminModel->getDataUser($email)->row_array();
    $id_user = $data['user']['id'];
    $data['data_buku'] = $this->pinjamModels->getHistoryPinjam($id_user)->result_array();

    $this->load->view('templates/templateadmin/main_header', $data);
    $this->load->view('templates/loaders/loader');
    $this->load->view('templates/templateadmin/header_menu', $data);
    $this->load->view('templates/templateadmin/navbar_menu', $data);
    $this->load->view('historypinjam/historypinjam', $data);
    $this->load->view('templates/templateadmin/main_footer');
  }
}
