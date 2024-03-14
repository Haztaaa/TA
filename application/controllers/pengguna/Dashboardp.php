<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboardp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        if ($this->session->userdata('jabatan') == 'admin') {
            redirect('admin/dashboard');
        }
        ceklogin();
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        $this->load->model('Kriteria_model', 'km');
        $this->load->model('Sekolah_model', 'sm');
    }

    public function index()
    {

        $data['jumlah_users'] = $this->db->get('user')->num_rows();
        $data['jumlah_tps'] = $this->db->get('tps')->num_rows();
        $data['jumlah_kriteria'] = $this->km->jumlah()->result();
        $this->template->load('template/backend/dashboard', 'backend/dashboardp', $data);
    }
}
