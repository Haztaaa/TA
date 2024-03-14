<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('Form_validation');
		$this->load->library('M_db');
		ceklogin();
		$this->load->model('Kriteria_model', 'mod_kriteria');
		$this->load->model('Alternatif_model', 'mod_alternatif');
	}

	function index()
	{


		$data['data'] = $this->mod_alternatif->get_data()->result();
		$this->template->load('template/backend/dashboard', 'alternatif/alternatif_list', $data);
	}

	function create()
	{



		$krit = $this->db->get('kriteria')->result();
		foreach ($krit as $kr) {
			$this->form_validation->set_rules('kriteria[' . $kr->id_kriteria . ']', 'Nilai Kriteria', 'required');
		}

		$this->form_validation->set_error_delimiters('<small class="text-danger pl-3">', '</small>');
		if ($this->form_validation->run() == FALSE) {
			$d2 = $this->m_db->get_data('alternatif');
			if (!empty($d2)) {
				$listTps = "";
				foreach ($d2 as $r) {
					$listTps .= $r->id_tps . ",";
				}
				$listTps = substr($listTps, 0, -1);

				$sql = "Select * from tps Where id_tps NOT IN ($listTps)";
				$d['tps'] = $this->m_db->get_query_data($sql);
				$d['kriteria'] = $this->mod_kriteria->kriteria_data();

				$this->template->load('template/backend/dashboard', 'alternatif/alternatif_form', $d);
			} else {

				$d['tps'] = $this->db->get('tps')->result();
				$d['kriteria'] = $this->mod_kriteria->kriteria_data();

				$this->template->load('template/backend/dashboard', 'alternatif/alternatif_form', $d);
			}
		} else {
			$id_tps = $this->input->post('id_tps');
			$kriteria = $this->input->post('kriteria');
			$this->mod_alternatif->alternatif_add($id_tps, $kriteria);
		}
	}
	public function ubah($id)
	{


		$ts = $this->db->query("SELECT * FROM alternatif JOIN tps ON tps.id_tps=alternatif.id_tps WHERE alternatif.id_alternatif ='$id'")->row();

		$d['tes'] = $ts;
		// $tess = $this->db->get_where('alternatif_nilai', ['id_alternatif' => $id])->result();
		// var_dump($tess);
		// die;
		$d['alt_nilai'] = $this->db->get_where('alternatif_nilai', ['id_alternatif' => $id])->result();
		$d['kriteria'] = $this->mod_kriteria->kriteria_data();
		$krit = $this->db->get('kriteria')->result();

		$d['idd'] = $id;



		foreach ($krit as $kr) {
			$this->form_validation->set_rules('kriteria[' . $kr->id_kriteria . ']', 'Nilai Kriteria', 'required');
		}

		$this->form_validation->set_error_delimiters('<small class="text-danger pl-3">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('template/backend/dashboard', 'alternatif/alternatif_ubah', $d);
		} else {

			$kriteria = $this->input->post('kriteria');
			$i = 0;

			foreach ($kriteria as $rK => $rV) {
				$i++;
				$tes = $this->input->post('id_alt_nilai' . $i);
				$d2 = array(
					'id_alternatif' => $id,
					'id_kriteria' => $rK,
					'id_subkriteria' => $rV,


				);
				$sql = $this->db->query("SELECT * FROM alternatif_nilai WHERE id_kriteria = '$rK'")->num_rows();
				if ($sql > 0) {
					$this->db->where('id_alternatif_nilai', $tes);
					$this->db->update('alternatif_nilai', $d2);
				} else {
					$this->db->insert('alternatif_nilai', $d2);
				}
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ubah Data Alternatif Berhasil
			</div>');
			redirect(base_url('Alternatif'), 'refresh');
		}
	}

	function hapus()
	{
		$id = $this->input->get('alternatif');
		if ($this->mod_alternatif->alternatif_delete($id) == TRUE) {
			$s = array(
				'id_alternatif' => $id,
			);
			$this->m_db->delete_row('alternatif_nilai', $s);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus Data Alternatif Berhasil
			</div>');
			redirect('alternatif');
		} else {
			redirect('alternatif');
		}
	}
}
