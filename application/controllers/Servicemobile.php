<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicemobile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_buku_harian');

        // Your own constructor code
    }

    public function create_kegiatan_harian()
    {
        $dataInput = $this->input->post();

        $output = $this->model_buku_harian->create_kegiatan_harian($dataInput);

        echo json_encode($output);
    }
    
    public function read_kegiatan_harian()
    {
        $dataInput = $this->input->post();

        $output = $this->model_buku_harian->read_kegiatan_harian($dataInput);

        echo json_encode($output);
    }
    
}
