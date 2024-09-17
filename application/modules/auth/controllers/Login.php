<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('date.timezone', 'Asia/Jakarta');
        $this->load->model('auth/Auth_model', 'authModel');
        $this->load->library('session');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $user = $this->authModel->getDataUser($email)->row_array();

        if ($this->session->userdata('email')) {
            if ($user['role_id'] == 1) {
                redirect('admin');
            } elseif ($user['role_id'] == 2) {
                redirect('home');
            }
        }
        //Buat rules ketika login
        $this->form_validation->set_rules('email', 'email', 'required|trim', [
            'required' => 'E-mail tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login';

            $this->load->view('templates/templateauth/auth_header', $data);
            $this->load->view('auth/loginpage/view_index');
            $this->load->view('templates/templateauth/auth_footer');
        } else {
            //Ketika validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->authModel->getDataUser($email)->row_array();

        // Jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    // jika data benar
                    $data = [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                        <strong>Password salah!</strong> Silahkan coba lagi.</div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                    <strong>E-mail ini belum di aktivasi!</strong> Silahkan cek email anda untuk mengaktivasi E-mail anda.</div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                <strong>E-mail belum terdaftar!</strong> Silahkan daftarkan E-mail anda.</div>');
            redirect('auth/login');
        }
    }
}
