<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    $this->load->model('admin/admin_model', 'adminModel');
    $this->load->model('manajemenbuku/manajemenbuku_model', 'bukuModel');
    $this->load->model('buku/buku_model', 'bukuModels');
  }

  public function index()
  {
    $data['title'] = 'Buku';
    $email = $this->session->userdata('email');
    $data['user'] = $this->adminModel->getDataUser($email)->row_array();
    $data['data_buku'] = $this->bukuModel->getDataBuku()->result_array();

    // var_dump($data['data_buku']);
    // die;
    $this->load->view('templates/templateadmin/main_header', $data);
    $this->load->view('templates/loaders/loader');
    $this->load->view('templates/templateadmin/header_menu', $data);
    $this->load->view('templates/templateadmin/navbar_menu', $data);
    $this->load->view('buku/buku', $data);
    $this->load->view('templates/templateadmin/main_footer');
  }

  public function pinjambuku()
  {
    $id_user = $this->input->post('id_user');
    $id_manajemen_buku = $this->input->post('id_manajemen_buku');
    $tanggal_pinjam = $this->input->post('tanggal_pinjam');
    $tanggal_kembali = $this->input->post('tanggal_kembali');
    $judul_buku = $this->input->post('judul_buku');

    $dataBuku = $this->bukuModels->getDataBukuID($id_manajemen_buku)->row_array();
    $stok_buku = (int)$dataBuku['stok'] - 1;

    $data1 = [
      'stok' => $stok_buku
    ];

    if ($stok_buku != 0) {
      $data = [
        'id_user' => $id_user,
        'id_manajemen_buku' => $id_manajemen_buku,
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_pengembalian' => $tanggal_kembali
      ];

      $status_notif = '0';
      $id_manajemen_buku = $id_manajemen_buku;
      $id_user = $id_user;
      $pesan = "Berhasil meminjam buku $judul_buku";

      $this->db->insert('notifikasi_user', [
        'id_manajemen_buku' => $id_manajemen_buku,
        'id_user' => $id_user,
        'pesan' => $pesan,
        'status_notif' => $status_notif
      ]);

      $status_notif = '0';
      $id_manajemen_buku = $id_manajemen_buku;
      $id_user = $id_user;
      $pesan = "Berhasil meminjam buku $judul_buku pada tanggal $tanggal_kembali";

      $this->db->insert('notifikasi_admin', [
        'id_manajemen_buku' => $id_manajemen_buku,
        'id_user' => $id_user,
        'pesan' => $pesan,
        'status_notif' => $status_notif
      ]);

      $this->bukuModels->insertData($data);

      $this->db->where('id_manajemen_buku', $id_manajemen_buku);
      $this->db->update('manajemen_buku', $data1);

      $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
      <strong>Berhasil meminjam buku!</strong></div>');
      redirect('buku');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
      <strong>Stok Habis!</strong></div>');
      redirect('buku');
    }
  }
}
