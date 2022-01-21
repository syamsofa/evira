<?php

class Model_log_realisasi extends CI_Model
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
    public function create_log_realisasi($dataInput)
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $dataToSave = array(
            $dataInput['Peer'],
            $this->session->userdata('RecId'),
            $dataInput['PekerjaanId'],
            $dataInput['Volume'],
            date("Y-m-d G:i:s"),
            $this->session->userdata('RecId'),
            $dataInput['TanggalMulai'],
            $dataInput['TanggalSelesai']
        );

        $this->db->query(
            "insert into log_realisasi (PekerjaanPenggunaId,VolumeTarget,VolumeRealisasi,CreatedBy,TanggalPenyelesaian) values (?,?,?,?,?)  ",
            $dataToSave
        );
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            return array(
                'sukses' => true,
                'data' => $dataInput
            );
        } else
            return array(
                'sukses' => false,
                'data' => $dataInput
            );
    }
}
