<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyProfile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    $this->load->model('admin/admin_model', 'adminModel');
  }

  public function index()
  {
    $data['title'] = 'Buku';
    $email = $this->session->userdata('email');
    $data['user'] = $this->adminModel->getDataUser($email)->row_array();

    // var_dump($data['data_buku']);
    // die;
    $this->load->view('templates/templateadmin/main_header', $data);
    $this->load->view('templates/loaders/loader');
    $this->load->view('templates/templateadmin/header_menu', $data);
    $this->load->view('templates/templateadmin/navbar_menu', $data);
    $this->load->view('myprofile/myprofile', $data);
    $this->load->view('templates/templateadmin/main_footer');
  }
}
