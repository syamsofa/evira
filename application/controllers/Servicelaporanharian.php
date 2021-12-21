<?php

use phpDocumentor\Reflection\DocBlock\Tags\Throws;

defined('BASEPATH') or exit('No direct script access allowed');

class Servicelaporanharian extends CI_Controller
{
    public $upload_dir = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_laporan_harian');
        $this->load->model('model_pengguna');
        $this->load->library('fungsi');


        // Your own constructor code
    }
    public function read_laporan_harian_by_pengguna_tahun_bulan()
    {
        $dataInput = $this->input->post();

        $output = $this->model_laporan_harian->read_laporan_harian_by_pengguna_tahun_bulan($dataInput);

        echo json_encode($output);
    }
    public function read_rekap_laporan()
    {
        $dataInput = $this->input->post();

        $output = $this->model_laporan_harian->read_rekap_laporan($dataInput);

        echo json_encode($output);
    }
    public function create_laporan_harian()
    {
        $outputRespon = [];
        $input = $this->input->post();
        if ($_FILES) {
            if ($_FILES['file']['size'] > 1000000) {
                $outputRespon = ["sukses" => false, "pesan" => "File tidak boleh lebih dari 1MB"];
            } elseif ($this->fungsi->isFileExcel($_FILES['file']['type'])) {
                $dataPenggunaRinci = $this->model_pengguna->read_pengguna_by_id(["RecId" => $input['IdPengguna']])['data'];
                $namaFileToUpload = $input['TanggalPekerjaan'] . "_" . $dataPenggunaRinci['NipLama'] . "_" . $dataPenggunaRinci['Nama'] . " (" . $input['JenisKehadiran'] . ")." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $dataInput = [
                    "Tanggal" => $input['TanggalPekerjaan'],
                    "NamaFile" => $namaFileToUpload,
                    "CreatedDate" => date("Y-m-d h:i:sa"),
                    "JenisKehadiran" => $input['JenisKehadiran'],
                    "Pengguna" => [
                        "IdPengguna" => $input['IdPengguna'],
                        "NipLama" => $dataPenggunaRinci['NipLama'],
                        "Nama" => $dataPenggunaRinci['Nama']
                    ],
                    "CreatedBy" => $this->session->userdata('RecId'),
                    "Ekstensi" => $_FILES['file']['type'],
                    // "Base64" => base64_encode(file_get_contents($_FILES['file']['tmp_name']))
                    "Base64" => ''

                ];
                // print_r($dataInput);
                $output = $this->model_laporan_harian->create_laporan_harian($dataInput);
                $outputRespon = $output;
                if ($output['sukses'] == true) {
                    move_uploaded_file($_FILES['file']['tmp_name'], $this->upload_dir . $namaFileToUpload);
                    $outputRespon = $output;
                } else
                    $outputRespon = ["sukses" => false, "pesan" => "Tidak berhasil simpan/upload laporan"];
            } else
                $outputRespon = ["sukses" => false, "pesan" => "Ekstensi tidak diizinkan. Harus Xls/Xlsx"];
        }

        // print_r($outputRespon);
        echo json_encode($outputRespon);
    }
}
