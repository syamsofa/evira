<?php

use phpDocumentor\Reflection\DocBlock\Tags\Throws;

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    public function okokok()
    {

        $templateLaporan = "aset/template_laporan/laporan_ckpt.xlsx";


        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);

        $array_sheet = $spreadsheet->getSheetNames();
        ##  DISPLAY ALL SHEETS
        echo "<pre>\n";
        print_r($array_sheet);
        echo "</pre>\n";

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];

        $jumBaris = 0;
        $jumKolom = 0;
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];

            $kolomIter = 0;
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
                $kolomIter++;
                if ($jumKolom <= $kolomIter) $jumKolom = $kolomIter;
            }
            $rows[] = $cells;
            $jumBaris++;
        }

        print_r([$jumBaris,$jumKolom]);

        // echo "<table>";
        foreach ($rows as $isi) {
            echo "AD<br>";
        }
        // echo "</table>";
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
            } elseif ($this->fungsi->isFileAllowed($_FILES['file']['type'])) {
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
