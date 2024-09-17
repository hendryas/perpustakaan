<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
    $data['title'] = 'Home';
    $email = $this->session->userdata('email');
    $data['user'] = $this->adminModel->getDataUser($email)->row_array();
    $id_user = $data['user']['id'];
    $data['jumlah_peminjam'] = $this->db->get_where('peminjam_buku', ['id_user' => $id_user])->result();


    $this->load->view('templates/templateadmin/main_header', $data);
    $this->load->view('templates/loaders/loader');
    $this->load->view('templates/templateadmin/header_menu', $data);
    $this->load->view('templates/templateadmin/navbar_menu', $data);
    $this->load->view('home/home', $data);
    $this->load->view('templates/templateadmin/main_footer');
  }
}
