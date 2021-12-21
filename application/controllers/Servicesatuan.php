<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicesatuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_satuan');

        // Your own constructor code
    }
    public function read_satuan()
    {
        $output = $this->model_satuan->read_satuan();

        echo json_encode($output);
    }

}
