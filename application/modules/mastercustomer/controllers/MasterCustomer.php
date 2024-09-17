<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterCustomer extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    $this->load->model('mastercustomer/mastercustomer_model', 'customerModel');
    $this->load->model('auth/auth_model', 'authModel');
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    $data['title'] = 'Data Customer';
    $email = $this->session->userdata('email');
    $data['user'] = $this->authModel->getDataUser($email)->row_array();
    $data['data_customer'] = $this->customerModel->getDataCustomer()->result_array();

    $this->load->view('templates/templatecustomer/main_header', $data);
    $this->load->view('templates/loaders/loader');
    $this->load->view('templates/templatecustomer/header_menu', $data);
    $this->load->view('templates/templatecustomer/navbar_menu', $data);
    $this->load->view('mastercustomer/mastercustomer', $data);
    $this->load->view('templates/templatecustomer/main_footer');
  }
}
