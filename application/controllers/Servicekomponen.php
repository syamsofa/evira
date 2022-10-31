<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicekomponen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_komponen');

        // Your own constructor code
    }
    public function read_komponen_by_ro()
    {
        $KodeRo = $this->input->post('KodeRo');
        $output = $this->model_komponen->read_komponen_by_ro($KodeRo);

        echo json_encode($output);
    }
}
