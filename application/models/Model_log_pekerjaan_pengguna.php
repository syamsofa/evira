<?php

class Model_log_pekerjaan_pengguna extends CI_Model
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

    public function create_log_pekerjaan_bulanan_pengguna($dataInput)
    {
        $this->db->query("insert into log_pekerjaan_bulanan_pengguna (PekerjaanPenggunaId,VolumePraRealisasi,VolumeRealisasi,CreatedBy) values (?,?,?,?)
		", array($dataInput['RecId'], $dataInput['VolumePraRealisasi'], $dataInput['VolumeRealisasi'], $this->session->userdata('RecId')));
        // print_r($dataInput);

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
    public function read_log_pekerjaan_bulanan_pengguna_by_id_pekerjaan_bulanan_pengguna($dataInput)
    {
        $query = $this->db->query("select * from log_pekerjaan_bulanan_pengguna where PekerjaanPenggunaId=?  
		", array($dataInput['PekerjaanBulananPenggunaId']));

        $data = array();
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
    public function read_log_pekerjaan_bulanan_pengguna_by_id($dataInput)
    {
        print_r($dataInput);
        $query = $this->db->query("select * from log_pekerjaan_bulanan_pengguna where RecId=?  
		", array($dataInput['RecId']));

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
