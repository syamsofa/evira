<?php

class Model_opsi_login extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('lib');
        // $this->load->library('lib_security');
        // $this->load->model('role_model');
        // $this->load->model('email_model');
        //call function
        // Your own constructor code
    }
    public function read_opsi_login()
    {
        $query = $this->db->query("select * from opsi_login");
        $data = array();

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
}
