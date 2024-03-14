<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subkriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kriteria_model', 'km');
        $this->load->model('Subkriteria_model');
        $this->load->model('Nilai_model', 'nm');
        $this->load->library('Form_validation');
        ceklogin();
        $this->load->library('m_db');
    }

    public function index()
    {
        $id_kriteria =  $this->uri->segment(3);
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'subkriteria/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'subkriteria/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'subkriteria/index.html';
            $config['first_url'] = base_url() . 'subkriteria/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Subkriteria_model->total_rows($q);
        $subkriteria = $this->Subkriteria_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'record' => $this->db->get_where('subkriteria', ['id_kriteria' => $id_kriteria])->result(),
            'subkriteria_data' => $subkriteria,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_list', $data);
    }



    public function parameter($id_kriteria)
    {




        $data = array(
            'record' => $this->db->get_where('subkriteria', ['id_kriteria' => $id_kriteria])->result(),
        );
        $data['kriteriaa'] = $id_kriteria ? "?kriteria=" . $id_kriteria : "";
        $data['kriteria'] = $id_kriteria;
        $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_paramater', $data);
    }


    public function tambah()
    {


        $ref = $this->input->get('kriteria');

        $tes = $this->uri->segment(3);
        $data['cek'] = $this->db->query("SELECT nilai FROM subkriteria WHERE id_kriteria ='$tes'")->result();

        $data['kriteria'] = $this->uri->segment(3);
        $this->form_validation->set_rules('ket', 'Keterangan', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">', '</small>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_tambah', $data);
        } else {



            $ref = $this->input->post('id_kriteria');


            $link = $ref ? "?kriteria=" . $ref : "";
            $id_kriteria = $this->input->post('id_kriteria');
            $id_nilai = $this->input->post('nilai');
            $ket = $this->input->post('ket');

            $data = [
                'id_kriteria' => $id_kriteria,
                'nilai' => $id_nilai,
                'nama' => $ket,
            ];

            $this->db->insert('subkriteria', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Data Berhasil Berhasil
			</div>');
            redirect(base_url() . "subkriteria/parameter/" . $ref);
            // }
        }
    }



    public function ubah($id, $idd)
    {
        $data['sub'] = $this->db->get_where('subkriteria', ['id_subkriteria' => $id])->row();
        $data['kriteria'] = $this->input->get('kriteria');
        $data['id'] = $id;
        $data['idd'] = $idd;

        $this->form_validation->set_rules('ket', 'Keterangan', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">', '</small>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template/backend/dashboard', 'subkriteria/subkriteria_ubah', $data);
        } else {

            $data = [
                'nama' => $this->input->post('ket'),
                'nilai' => $this->input->post('nilai'),
            ];
            $this->db->where('id_subkriteria', $id);
            $this->db->update('subkriteria', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ubah Data Berhasil
			</div>');
            redirect(base_url('subkriteria/parameter/' . $idd));
        }
    }



    public function delete($id, $idd)
    {
        $row = $this->Subkriteria_model->get_by_id($id);

        if ($row) {
            $this->Subkriteria_model->delete($id);
            $this->session->set_flashdata('message', '<text class="alert alert-success pl-2">Hapus Data Berhasil </text>');
            redirect(site_url('subkriteria/parameter/' . $idd));
        } else {
            $this->session->set_flashdata('message', '<text class="alert alert-success pl-2">Hapus Data Berhasil </text>');
            redirect(site_url('subkriteria/parameter/' . $idd));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_subkriteria', 'nama subkriteria', 'trim|required');
        $this->form_validation->set_rules('id_kriteria', 'id kriteria', 'trim|required');
        $this->form_validation->set_rules('tipe', 'tipe', 'trim|required');
        $this->form_validation->set_rules('nilai_minimum', 'nilai minimum', 'trim|required|numeric');
        $this->form_validation->set_rules('nilai_maksimum', 'nilai maksimum', 'trim|required|numeric');
        $this->form_validation->set_rules('op_min', 'op min', 'trim|required');
        $this->form_validation->set_rules('op_max', 'op max', 'trim|required');
        $this->form_validation->set_rules('id_nilai', 'id nilai', 'trim|required');

        $this->form_validation->set_rules('id_subkriteria', 'id_subkriteria', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Subkriteria.php */
/* Location: ./application/controllers/Subkriteria.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-29 15:35:40 */
/* http://harviacode.com */