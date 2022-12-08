<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serviceregsosek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_wilayah');

        // Your own constructor code
    }
    public function fromrbtoevira()
    {

        print_r($this->input->post());

        // echo json_encode([1,2]);

    }
}
