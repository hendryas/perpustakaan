<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PeminjamBuku extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    $this->load->model('admin/admin_model', 'adminModel');
    $this->load->model('manajemenbuku/manajemenbuku_model', 'bukuModel');
    $this->load->model('buku/buku_model', 'bukuModels');
    $this->load->model('peminjambuku/peminjambuku_model', 'peminjambukuModels');
  }

  public function index()
  {
    $data['title'] = 'Peminjam Buku';
    $email = $this->session->userdata('email');
    $data['user'] = $this->adminModel->getDataUser($email)->row_array();
    $id_user = $data['user']['id'];
    $data['data_buku'] = $this->peminjambukuModels->getHistoryPeminjamBuku()->result_array();

    // var_dump($data['data_buku']);
    // die;

    $this->load->view('templates/templateadmin/main_header', $data);
    $this->load->view('templates/loaders/loader');
    $this->load->view('templates/templateadmin/header_menu', $data);
    $this->load->view('templates/templateadmin/navbar_menu', $data);
    $this->load->view('peminjambuku/peminjambuku', $data);
    $this->load->view('templates/templateadmin/main_footer');
  }

  public function selesaipinjam()
  {
    $id_peminjam_buku = $this->input->post('id_peminjam_buku');
    $id_manajemen_buku = $this->input->post('id_manajemen_buku');
    $status_pinjaman = 1;

    $data1 = [
      'status_pengembalian' => $status_pinjaman
    ];

    $this->db->where('id_peminjam_buku', $id_peminjam_buku);
    $this->db->update('peminjam_buku', $data1);

    $data_buku = $this->peminjambukuModels->getDataBukuByID($id_manajemen_buku)->row_array();
    $stok_buku = (int)$data_buku['stok'] + 1;

    $data2 = [
      'stok' => $stok_buku
    ];

    $this->db->where('id_manajemen_buku', $id_manajemen_buku);
    $this->db->update('manajemen_buku', $data2);

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
            <strong>Berhasil merubah status!</strong></div>');
    redirect('peminjambuku');
  }
}
