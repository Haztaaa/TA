<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        $this->form_validation->set_rules('username', 'Nama Pengguna', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {


            $this->load->view('login/masuk');
        } else {
            $this->login();
        }
    }
    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');


        $user = $this->db->query("SELECT * FROM user WHERE username ='$username' and status = '0'")->row_array();

        if ($user) {

            if ($password == $user['password']) {
                $data = [

                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'jabatan' => $user['jabatan']
                ];
                $this->session->set_userdata($data);
                if ($user['jabatan'] == "admin") {
                    $this->session->set_flashdata('message', '<text class="alert alert-success"> Berhasil Masuk Ke Dalam Aplikasi</text>');
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<text class="alert alert-success"> Berhasil Masuk Ke Dalam Aplikasi</text>');
                    redirect('pengguna/Dashboardp');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Atau Username Salah!
            </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Atau Username Salah!
            </div>');
            redirect('login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Keluar Aplikasi
            </div>');
        redirect('login');
    }
}
