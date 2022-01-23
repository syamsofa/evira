<?php

class Model_buku_harian extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        // $this->load->library('lib_security');
        // $this->load->model('role_model');
        // $this->load->model('email_model');
        //call function
        // Your own constructor code
    }

    public function create_kegiatan_harian($dataInput)
    {
        $this->db->query("insert into buku_harian
         (Username,Tanggal,Kegiatan) values (?,?,?)
		", array($dataInput['Username'], $dataInput['Tanggal'],$dataInput['Kegiatan']));

        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            return array(
                'sukses' => true,
                'data' => $dataInput
            );
        } else {
            return array(
                'sukses' => false,
                'data' => $dataInput
            );
        }
    }
    public function read_kegiatan_harian($dataInput)
    {
        // print_r($dataInput);
        $query = $this->db->query("select * from buku_harian where Username=?  
		", array($dataInput['Username']));

        $data = array();
        foreach ($query->result_array() as $row) {
            $data = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
}
