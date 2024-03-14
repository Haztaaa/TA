<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		if ($this->session->userdata('jabatan') == 'pengguna') {
			redirect('pengguna/dashboardp');
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
		$this->template->load('template/backend/dashboard', 'backend/dashboard', $data);
	}
	public function manajemen()
	{
		$data['users'] = $this->db->get('user')->result();
		$this->template->load('template/backend/dashboard', 'backend/user', $data);
	}
	public function aktif()
	{
		$id = $this->input->post('id');

		$data = [
			'status' =>  $this->input->post('status'),
		];

		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ubah Status Pengguna Menjadi Aktif Berhasil
		</div>');
		redirect('admin/dashboard/manajemen');
	}
	public function tidakaktif()
	{
		$id = $this->input->post('id');

		$data = [
			'status' => $this->input->post('status'),
		];

		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ubah Status Pengguna Menjadi Tidak Aktif Berhasil 
		</div>');
		redirect('admin/dashboard/manajemen');
	}
	public function tambah_pengguna()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->template->load('template/backend/dashboard', 'backend/user_tambah');
		} else {
			$data = [
				'nama' => $this->input->post('nama_lengkap', TRUE),
				'username' => $this->input->post('nama_pengguna', TRUE),
				'password' => $this->input->post('kata_sandi', TRUE),
				'status' => '0',
				'jabatan' => 'pengguna',
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<text class="alert alert-success"> Tambah Data Pengguna Berhasil</text>');
			redirect(site_url('admin/dashboard/manajemen'));
		}
	}
	public function ubah_pengguna($id)
	{
		$data['users'] = $this->db->get_where('user', ['id_user' => $id])->row();
		$data['id'] = $id;
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->template->load('template/backend/dashboard', 'backend/user_ubah', $data);
		} else {
			$data = [
				'nama' => $this->input->post('nama_lengkap', TRUE),
				'username' => $this->input->post('nama_pengguna', TRUE),
				'password' => $this->input->post('kata_sandi', TRUE),

			];
			$this->db->where('id_user', $id);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', '<text class="alert alert-success"> Ubah Data Pengguna Berhasil</text>');
			redirect(site_url('admin/dashboard/manajemen'));
		}
	}
	public function hapus_pengguna($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('user');
		$this->session->set_flashdata('message', '<text class="alert alert-success"> Hapus Data Pengguna Berhasil</text>');
		redirect(site_url('admin/dashboard/manajemen'));
	}
	public function _rules()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');

		$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim|required');
		$this->form_validation->set_rules('kata_sandi', 'Kata Sandi', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
