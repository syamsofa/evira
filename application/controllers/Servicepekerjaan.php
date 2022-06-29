<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicepekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pekerjaan_bulanan');


        // Your own constructor code
    }
    public function read_pekerjaan_by_pengguna()
    {
        $dataInput['RecId'] = $this->input->post('PenggunaId');

        $output = $this->model_pekerjaan_bulanan->read_pekerjaan_by_pengguna($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan_by_pengguna_by_tahun_by_bulan()
    {
        $dataInput['RecId'] = $this->input->post('PenggunaId');
        $dataInput['Tahun'] = $this->input->post('Tahun');
        $dataInput['Bulan'] = $this->input->post('Bulan');

        // print_r($dataInput);

        $output = $this->model_pekerjaan_bulanan->read_pekerjaan_by_pengguna_by_tahun_by_bulan($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan()
    {
        $output = $this->model_pekerjaan_bulanan->read_pekerjaan();

        echo json_encode($output);
    }
    public function read_pekerjaan_by_id()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pekerjaan_bulanan->read_pekerjaan_by_id($dataInput);

        echo json_encode($output);
    }
    public function edit_pekerjaan()
    {
        $dataInput = $this->input->post();

        // print_r($dataInput);
        $output = $this->model_pekerjaan_bulanan->edit_pekerjaan($dataInput);

        echo json_encode($output);
    }
    public function delete_pekerjaan()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pekerjaan_bulanan->delete_pekerjaan($dataInput);

        echo json_encode($output);
    }
    public function duplikasi_pekerjaan()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pekerjaan_bulanan->duplikasi_pekerjaan($dataInput);

        echo json_encode($output);
    }
    public function create_pekerjaan()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pekerjaan_bulanan->create_pekerjaan($dataInput);

        echo json_encode($output);
    }
}
