<?php
class Notifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('date.timezone', 'Asia/Jakarta');
        $this->load->model('Notifikasi_model');
    }
    public function index()
    {
        $data['title'] = 'Notifikasi';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['notifikasi_admin'] = $this->Notifikasi_model->getnotifikasi_admin()->result_array();
        $data['notifikasi_user'] = $this->Notifikasi_model->getnotifikasi_user()->result_array();
        $data['role'] = $this->db->get_where('user', [
            'role_id' => $this->session->userdata('role_id'),
            'id' => $this->session->userdata('id')
        ])->row_array();

        // $this->load->view('templates/main_header', $data);
        $this->load->view('templates/templateadmin/main_header', $data);
        $this->load->view('templates/loaders/loader');
        $this->load->view('templates/templateadmin/header_menu', $data);
        $this->load->view('templates/templateadmin/navbar_menu', $data);
        if ($data['role']['role_id'] == 1) {
            $this->load->view('notifikasi/view_index_admin', $data);
        } elseif ($data['role']['role_id'] == 2) {
            $this->load->view('notifikasi/view_index_user', $data);
        }
        // $this->load->view('templates/main_footer');
        $this->load->view('templates/templateadmin/main_footer');
    }
    public function user_notifi()
    {
        $data['role'] = $this->db->get_where('user', [
            'role_id' => $this->session->userdata('role_id'),
            'id' => $this->session->userdata('id')
        ])->row_array();

        if ($data['role']['role_id'] == 1) {

            $v = $this->input->post('view');

            echo  $op = $this->Notifikasi_model->fetch_data_admin($v);

            return $op;
        } elseif ($data['role']['role_id'] == 2) {

            $v = $this->input->post('view');

            echo  $op = $this->Notifikasi_model->fetch_data_user($v);

            return $op;
        }
    }
}
