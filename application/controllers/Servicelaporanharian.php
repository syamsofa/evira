<?php

use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


defined('BASEPATH') or exit('No direct script access allowed');


class Servicelaporanharian extends CI_Controller
{

    public $upload_dir = 'uploads/';
    public $now;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_laporan_harian');
        $this->load->model('model_pengguna');
        $this->load->library('fungsi');
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date("Y-m-d G:i:s");
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

        print_r([$jumBaris, $jumKolom]);

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
            } elseif ($this->fungsi->isFileDiizinkan($_FILES['file']['type'])) {
                $dataPenggunaRinci = $this->model_pengguna->read_pengguna_by_id(["RecId" => $input['IdPengguna']])['data'];
                $namaFileToUpload = $input['TanggalPekerjaan'] . "_" . $dataPenggunaRinci['NipLama'] . "_" . $dataPenggunaRinci['Nama'] . " (" . $input['JenisKehadiran'] . ")." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                date_default_timezone_set('Asia/Jakarta');

                $dataInput = [
                    "Tanggal" => $input['TanggalPekerjaan'],
                    "NamaFile" => $namaFileToUpload,
                    "CreatedDate" => $this->now,
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
        } else {
            $dataPenggunaRinci = $this->model_pengguna->read_pengguna_by_id(["RecId" => $input['IdPengguna']])['data'];

            $dataInput = [
                "Tanggal" => $input['TanggalPekerjaan'],
                "NamaFile" => '-',
                "CreatedDate" => $this->now,
                "JenisKehadiran" => $input['JenisKehadiran'],
                "Pengguna" => [
                    "IdPengguna" => $input['IdPengguna'],
                    "NipLama" => $dataPenggunaRinci['NipLama'],
                    "Nama" => $dataPenggunaRinci['Nama']
                ],
                "CreatedBy" => $this->session->userdata('RecId'),
                "Ekstensi" => '-',
                // "Base64" => base64_encode(file_get_contents($_FILES['file']['tmp_name']))
                "Base64" => ''

            ];
            // print_r($dataInput);
            $output = $this->model_laporan_harian->create_laporan_harian($dataInput);
            $outputRespon = $output;
        }
        // print_r($dataInput);
        echo json_encode($outputRespon);
    }
    public function hapushtmllaporanharian()
    {
        // $NamaFile=;
        $dataInput = ["UploadDir" => $this->upload_dir, "NamaFile" => $this->input->post('NamaFile')];



        $output = $this->model_laporan_harian->hapushtmllaporanharian($dataInput);

        echo json_encode($output);
    }
    public function viewhtmllaporanharian()
    {
        $NamaFile = $this->input->post('NamaFile');
        $templateLaporan = "uploads/" . $NamaFile;
        // .$NamaFile;


        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);

        $array_sheet = $spreadsheet->getSheetNames();
        ##  DISPLAY ALL SHEETS

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
            if ($jumBaris >= 100)
                break;
        }


        // echo "<table>";

        // echo "</table>";

        // echo "<table>";
        // foreach ($worksheet->getRowIterator() as $row) {

        //     $cellIterator = $row->getCellIterator();
        //     $cellIterator->setIterateOnlyExistingCells(false);

        //     echo "<tr>";
        //     foreach ($cellIterator as $cell) {
        //         echo "<td>" . $cell->getValue() . "</td>";
        //     }
        //     echo "</tr>";
        //     # code...
        // }
        // echo "<table>";

        $output = [
            "JumBaris" => $jumBaris,
            "JumKolom" => $jumKolom,
            "Data" => $rows
        ];

        echo json_encode($output);
    }
    public function eksporlaporansatubulan()
    {

        $Tahun = $this->input->get('Tahun');
        $Bulan = $this->input->get('Bulan');
        $IdPengguna = $this->input->get('IdPengguna');

        $DataPengguna = $this->model_pengguna->read_pengguna_by_id(["RecId" => $IdPengguna]);

        // echo json_encode($DataPengguna);
        $outputs = $this->model_laporan_harian->read_laporan_harian_by_pengguna_tahun_bulan(["Tahun" => $Tahun, "Bulan" => $Bulan, "IdPengguna" => $IdPengguna]);
        // echo json_encode($outputs['data']);

        $listData = [];
        foreach ($outputs['data'] as $outputD) {
            if ($outputD['Upload']['JumUpload'] == 1)
                $listData[] = [
                    "NamaFile" => $outputD['Upload']['Data']['NamaFile'],
                    "TanggalLaporan" => $outputD['Tanggal'],
                    "JenisKehadiran" => $outputD['Upload']['Data']['JenisKehadiran']
                ];
        }

        // echo json_encode($listData);

        $toDisplay = [];

        foreach ($listData as $list) {
            $NamaFile = $list['NamaFile'];
            $file = "uploads/" . $NamaFile;

            if (file_exists($file)) {
                $spreadsheet = new Spreadsheet();

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);


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
                    if ($jumBaris >= 100)
                        break;
                }

                $flagMulai = 0;
                $flagSelesai = 0;

                foreach ($rows as $row_) {
                    if ($flagMulai == 1 and $flagSelesai == 0) {

                        if (is_numeric($row_[0]) == false) break;

                        $toDisplay[] = [$row_[0], $row_[1], $row_[2], $row_[3], $row_[4], $row_[5], $row_[6], $list['TanggalLaporan'], $list['JenisKehadiran']];
                    }
                    if ($row_[0] == '[1]')
                        $flagMulai = 1;
                }
                // break;
            }
        }
        // echo (json_encode($toDisplay));

        $templateLaporan = "aset/template_matriks/template.xlsx";


        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('C2', $Tahun);
        $sheet->setCellValue('C3', $this->fungsi->bulanByNo($Bulan));
        $sheet->setCellValue('C4', $DataPengguna['data']['NipLama'].' - '.$DataPengguna['data']['NipBaru']);
        $sheet->setCellValue('C5', $DataPengguna['data']['Nama']);
        
// $DataPengguna

        $initialBaris = 8;
        $inisialNomor = 1;
        foreach ($toDisplay as $toWrite) {
            $sheet->setCellValue('B' . $initialBaris, $inisialNomor);
            $sheet->setCellValue('C' . $initialBaris, $toWrite[1]);
            $sheet->setCellValue('D' . $initialBaris, $toWrite[2]);
            $sheet->setCellValue('E' . $initialBaris, $toWrite[3]);
            $sheet->setCellValue('F' . $initialBaris, $toWrite[4]);
            $sheet->setCellValue('G' . $initialBaris, $toWrite[5]);
            $sheet->setCellValue('H' . $initialBaris, $toWrite[6]);
            $sheet->setCellValue('I' . $initialBaris, $toWrite[7]);
            // $sheet->setCellValue('I'.$initialBaris, $toWrite[7]);
            $sheet->setCellValue('J' . $initialBaris, $toWrite[8]);

            $initialBaris++;
            $inisialNomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('Rekap_Data_Kegiatan_Tahun_'.$Tahun.'_Bulan_'.$Bulan.'_NIP_'.$DataPengguna['data']['NipBaru'].'_'.$DataPengguna['data']['Nama'].'.xlsx') . '"');
        $writer->save('php://output');
    }
}
