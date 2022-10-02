<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicepenilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_penilaian_tim');

        // Your own constructor code
    }
    public function simpan_nilai()
    {
        // print_r($this->input->post());
        $output = $this->model_penilaian_tim->simpan_nilai($this->input->post());

        echo json_encode($output);
    }
}
