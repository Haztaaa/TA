<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Perbandingan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->library('M_db');
		$this->load->model('Kriteria_model', 'mod_kriteria');
		$this->load->model('Proses_model', 'mod_pro');
		ceklogin();
	}

	function banding()
	{
		$this->template->load('template/backend/dashboard', 'perbandingan/perbandingan_list');
	}

	function gethtml()
	{
		$output = array();
		$dKriteria = $this->mod_kriteria->kriteria_data();
		foreach ($dKriteria as $rK) {
			$output[$rK->id_kriteria] = $rK->nama_kriteria;
		}
		$d['id'] = $this->db->get('kriteria')->result_array();
		$d['arr'] = $output;
		// $this->template->load('template/backend/dashboard', 'perbandingan/matriks/matrikutama', $d);
		$this->load->view('perbandingan/matriks/matrikutama', $d);
	}





	function updateutama()
	{
		$error = FALSE;
		$msg = "";
		$s = array(
			'id_kriteria_nilai !=' => ''
		);
		$this->m_db->delete_row('kriteria_nilai', $s);

		$cr = $this->input->post('crvalue');
		if ($cr > 0.1) {
			$msg = "Gagal diupdate karena nilai CR Lebih dari 0.1";
			$error = TRUE;
		} else {
			foreach ($_POST as $k => $v) {
				if ($k != "crvalue") {
					foreach ($v as $x => $x2) {
						$d = array(
							'kriteria_id_dari' => $k,
							'kriteria_id_tujuan' => $x,
							'nilai' => $x2,
						);

						$this->m_db->add_row('kriteria_nilai', $d);
					}
				}
			}
			$msg = "Berhasil update nilai kriteria";
			$error = FALSE;
		}


		if ($error == FALSE) {
			echo json_encode(array('status' => 'ok', 'msg' => $msg));
		} else {
			echo json_encode(array('status' => 'no', 'msg' => $msg));
		}
	}
	function hasil()
	{
		$data['kriteria_data'] = $this->db->get('kriteria')->result();

		//$data['alternatif'] = $this->db->get('tps')->result();
		$this->template->load('template/backend/dashboard', 'perbandingan/prosesview', $data);
	}




	function simpanbobot()
	{
		$row = $this->db->get('kriteria')->num_rows();

		$cr = $this->input->post('crvalue');

		if ($cr > 0.1) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Menyiman bobot karena CR lebih dari 0.1
			</div>');
		} else {

			for ($i = 1; $i <= $row; $i++) {

				$tes = $this->input->post('id' . $i);


				$array[$i] = [
					'bobot'			=> $this->input->post('jumlahprio' . $i)
				];
				var_dump($array[$i]);
				die;

				$this->db->where('id_kriteria', $tes);
				$this->db->update('kriteria', $array[$i]);
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Simpan Bobot Berhasil
			</div>');
		}

		redirect('perbandingan/banding');
	}
}
