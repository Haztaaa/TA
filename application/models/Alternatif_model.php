<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Alternatif_model extends CI_Model
{

	private $tb_alternatif = 'alternatif';
	function __construct()
	{
		$this->load->library('M_db');
	}


	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('alternatif');
		$this->db->join('tps', 'tps.id_tps = alternatif.id_tps');

		return $this->db->get();
	}
	function alternatif_add($id_tps, $kriteriaData = array(), $sub = array())
	{
		if ($this->m_db->is_bof('tps') == FALSE) {
			if (!empty($kriteriaData)) {
				$d = array(
					'id_tps' => $id_tps,
				);
				if ($this->m_db->add_row('alternatif', $d) == TRUE) {
					$alternatifID = $this->m_db->last_insert_id();
					foreach ($kriteriaData as $rK => $rV) {
						$d2 = array(
							'id_alternatif' => $alternatifID,
							'id_kriteria' => $rK,
							'id_subkriteria' => $rV,
						);
						$this->m_db->add_row('alternatif_nilai', $d2);
					}
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Data Alternatif Berhasil
			</div>');
					redirect('Alternatif', 'refresh');
				} else {
					//echo "GAGAL TAMBAH PESERTA";
					return false;
				}
			} else {
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}
		} else {
			//echo "SISWA TIDAK ADA";
			return false;
		}
	}
	function alternatif_ubah($id_tps, $kriteriaData = array(), $where)
	{
		if ($this->m_db->is_bof('tps') == FALSE) {
			if (!empty($kriteriaData)) {
				$d = array(
					'id_tps' => $id_tps,
				);
				if ($this->m_db->edit_row('alternatif', $d, $where) == TRUE) {
					$alternatifID = $where;
					foreach ($kriteriaData as $rK => $rV) {

						$d2 = array(
							'id_alternatif' => $alternatifID,
							'id_kriteria' => $rK,
							'id_subkriteria' => $rV,
						);
						$this->m_db->add_row('alternatif_nilai', $d2);
					}
					redirect(base_url('Alternatif'), 'refresh');
				} else {
					//echo "GAGAL TAMBAH PESERTA";
					return false;
				}
			} else {
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}
		} else {
			//echo "SISWA TIDAK ADA";
			return false;
		}
	}

	function alternatif_delete($id_alternatif)
	{
		$s = array(
			'id_alternatif' => $id_alternatif,
		);
		if ($this->m_db->delete_row($this->tb_alternatif, $s) == TRUE) {
			return true;
		} else {
			return false;
		}
	}
}
