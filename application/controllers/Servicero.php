<?php
defined('BASEPATH') or exit('No direct script access allowed');

use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Servicero extends CI_Controller
{
    public $upload_dir = 'uploads/';
    public $now;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_ro');
        $this->load->library('fungsi');
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date("Y-m-d G:i:s");

        // Your own constructor code
    }
    public function read_ro_by_seksi()
    {
        $Seksi = $this->input->post('Seksi');
        $output = $this->model_ro->read_ro_by_seksi($Seksi);

        echo json_encode($output);
    }
    public function read_ro_by_kode()
    {
        $KodeRo = $this->input->post('KodeRo');
        $output = $this->model_ro->read_ro_by_kode($KodeRo);

        echo json_encode($output);
    }
    public function read_ro()
    {
        // $Seksi = $this->input->post('Seksi');
        $output = $this->model_ro->read_ro();

        echo json_encode($output);
    }
    public function insert_laporan_ro()
    {

        $outputRespon = [];
        $input = $this->input->post();
        if ($_FILES) {
            if ($_FILES['file']['size'] > 10000000) {
                $outputRespon = ["sukses" => false, "pesan" => "File tidak boleh lebih dari 1MB"];
            } elseif ($this->fungsi->isFileDiizinkan($_FILES['file']['type'])) {
                $namaFileToUpload =  "File_realisasi_." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                date_default_timezone_set('Asia/Jakarta');

                // print_r($dataInput);
                if (move_uploaded_file($_FILES['file']['tmp_name'], $this->upload_dir . $namaFileToUpload)) {
                    $file = $this->upload_dir  . $namaFileToUpload;

                    if (file_exists($file)) {
                        $spreadsheet = new Spreadsheet();

                        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);


                        $worksheet = $spreadsheet->getActiveSheet();
                        $rows = $worksheet->toArray();

                        $nomorBaris = 0;
                        $baris = [];
                        $outputs = [];
                        foreach ($rows as $key => $value) {

                            if ($nomorBaris > 8)
                                // print_r($value);

                                $baris[] = $value;
                            foreach ($value as $iter => $column_value) {
                                //$column_value the value of row
                            };
                            if (strlen($value[1]) == 7) {
                                $KodeKegiatan = substr($value[1], 3, 4);
                                // print_r($value);
                            }
                            if (strlen($value[2]) == 7) {
                                // $KodeRo = $value[2];
                                // print_r($value);
                                $output = ["KodeRo" => $KodeKegiatan . "." . $value[2], "PaguRevisi" => str_replace(",", "", $value[9]), "Realisasi" => str_replace(",", "", $value[15])];
                                $outputs[] = $output;
                                $this->model_ro->update_realisasi_ro($output);

                                // $value;
                            }

                            $nomorBaris++;
                        }; // break;
                    }
                }
            }
        }
        echo json_encode($outputs);
    }
}
