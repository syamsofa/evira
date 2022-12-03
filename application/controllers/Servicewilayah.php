<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicewilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_wilayah');

        // Your own constructor code
    }
    public function read_desa_by_kec()
    {
        $KodeKec = $this->input->post('KodeKec');
        $output = $this->model_wilayah->read_desa_by_kec($KodeKec);

        echo json_encode($output);
    }
    public function update_data_sls()
    {
        print_r($this->input->post());

        $Id=$this->input->post('Id');
        // $parts = explode('-', $this->input->post('Nilai'));
        // print_r($parts);

        $Nilai=$this->input->post('Nilai');
        $Kolom=$this->input->post('Kolom');
        
        $output = $this->model_wilayah->update_data_sls($Id,$Nilai,$Kolom);

        echo json_encode($output);
    }
    
    public function read_sls_by_kec_desa()
    {

        // print_r($this->input->post());
        $KodeKec = $this->input->post('KodeKec');
        $KodeDesa = $this->input->post('KodeDesa');
        $output = $this->model_wilayah->read_sls_by_kec_desa($KodeKec,$KodeDesa);

        echo json_encode($output);
    }
    public function edit_rb()
    {

        print_r($this->input->post());
        // $KodeKec = $this->input->post('KodeKec');
        // $KodeDesa = $this->input->post('KodeDesa');
        // $output = $this->model_wilayah->read_sls_by_kec_desa($KodeKec,$KodeDesa);

        // echo json_encode($output);
    }
}
