<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicelogpekerjaanbulananpengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_log_pekerjaan_pengguna');

        // Your own constructor code
    }

    public function read_log_pekerjaan_bulanan_pengguna_by_id_pekerjaan_bulanan_pengguna()
    {
        $dataInput = $this->input->post();

        $output = $this->model_log_pekerjaan_pengguna->read_log_pekerjaan_bulanan_pengguna_by_id_pekerjaan_bulanan_pengguna($dataInput);

        echo json_encode($output);
    }
    public function read_log_pekerjaan_bulanan_pengguna_by_id()
    {
        $dataInput = $this->input->post();

        $output = $this->model_log_pekerjaan_pengguna->read_log_pekerjaan_bulanan_pengguna_by_id($dataInput);

        echo json_encode($output);
    }
}
