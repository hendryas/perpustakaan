<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenBuku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //jika tidak ada session,lempar ke auth
        // is_logged_in();
        $this->load->model('manajemenbuku_model', 'bukuModel');
        $this->load->model('master/Menu_model', 'Menu_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Buku';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->getDataUser($email)->row_array();

        $data['data_buku'] = $this->bukuModel->getDataBuku()->result_array();

        $this->load->view('templates/templateadmin/main_header', $data);
        $this->load->view('templates/loaders/loader');
        $this->load->view('templates/templateadmin/header_menu', $data);
        $this->load->view('templates/templateadmin/navbar_menu', $data);
        $this->load->view('manajemenbuku/manajemenbuku');
        $this->load->view('templates/templateadmin/main_footer');
    }

    public function add()
    {
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        $penerbit = $this->input->post('penerbit');
        $tahun_terbit = $this->input->post('tahun_terbit');
        $jumlah_kopi = $this->input->post('jumlah_kopi');
        $stok = $this->input->post('stok');
        $date_created = date('Y-m-d H:i:s');
        $timestamp = strtotime($date_created);
        $image = $_FILES['image']['name'];

        $dname = explode(".", $_FILES['image']['name']);
        $ext = end($dname);
        $new_image = $_FILES['image']['name'] = strtolower('buku' . '_' . $timestamp  . '.' . $ext);

        $data = [
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'jumlah_kopi' => $jumlah_kopi,
            'stok' => $stok,
            'image' => $new_image
        ];

        if ($image) {
            $file_name1 = 'buku' . '_' . $timestamp;
            $config1['upload_path']          = './assets/images/buku/';
            $config1['allowed_types']        = 'jpg|png|jpeg';
            $config1['max_size']             = 3023;
            $config1['remove_space']         = TRUE;
            $config1['file_name']            = $file_name1;

            $this->load->library('upload', $config1);

            if ($this->upload->do_upload('image')) {
                $this->upload->data();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('manajemenbuku');
            }
        }

        $this->bukuModel->insertData($data);

        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->getDataUser($email)->row_array();
        $id_user = $data['user']['id'];

        $qry_manajemen_buku = $this->bukuModel->getManajemenBukuDesc()->row_array();
        $id_manajemen_buku = $qry_manajemen_buku['id_manajemen_buku'];

        $status_notif = '0';
        $id_manajemen_buku = $id_manajemen_buku;
        $id_user = $id_user;
        $pesan = "Berhasil menambahkan data buku!";

        $this->db->insert('notifikasi_admin', [
            'id_manajemen_buku' => $id_manajemen_buku,
            'id_user' => $id_user,
            'pesan' => $pesan,
            'status_notif' => $status_notif
        ]);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        <strong>Data baru telah ditambahkan!</strong></div>');
        redirect('manajemenbuku');
    }

    public function edit()
    {
        $id_manajemen_buku = $this->input->post('id_manajemen_buku');
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        $penerbit = $this->input->post('penerbit');
        $tahun_terbit = $this->input->post('tahun_terbit');
        $stok = $this->input->post('stok');
        $jumlah_kopi = $this->input->post('jumlah_kopi');
        $image = $_FILES['image']['name'];
        $date_created = date('Y-m-d H:i:s');
        $timestamp = strtotime($date_created);

        if ($image == NULL) {
            $buku = $this->db->get_where('manajemen_buku', ['id_manajemen_buku' => $id_manajemen_buku])->row_array();
            $new_image = $buku['image'];

            $data = [
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'jumlah_kopi' => $jumlah_kopi,
                'stok' => $stok
            ];

            $this->db->where('id_manajemen_buku', $id_manajemen_buku);
            $this->db->update('manajemen_buku', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Buku berhasil di rubah!</strong></div>');
            redirect('manajemenbuku');
        } else {
            $dname = explode(".", $_FILES['image']['name']);
            $ext = end($dname);
            $new_image = $_FILES['image']['name'] = strtolower('buku' . '_' . $timestamp  . '.' . $ext);

            if ($image) {
                $file_name1 = 'buku' . '_' . $timestamp;
                $config1['upload_path']          = './assets/images/buku/';
                // $config1['allowed_types']        = 'doc|docx|pdf';
                $config1['allowed_types']        = 'jpg|png|jpeg';
                $config1['max_size']             = 3023;
                $config1['remove_space']         = TRUE;
                $config1['file_name']            = $file_name1;

                $this->load->library('upload', $config1);

                if ($this->upload->do_upload('image')) {
                    $this->upload->data();
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('manajemenbuku');
                }
            }

            $data = [
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'jumlah_kopi' => $jumlah_kopi,
                'stok' => $stok,
                'image' => $new_image
            ];

            $this->db->where('id_manajemen_buku', $id_manajemen_buku);
            $this->db->update('manajemen_buku', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Buku berhasil di rubah!</strong></div>');
            redirect('manajemenbuku');
        }

        // $this->bukuModel->editData($id_manajemen_buku, $data);

        // $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        // <strong>Berhasil edit data!</strong></div>');
        // redirect('manajemenbuku');
    }

    public function delete($id)
    {
        $id = decrypt_url($id);
        $this->bukuModel->deleteData($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        <strong>Data berhasil dihapus!</strong></div>');
        redirect('manajemenbuku');
    }
}
