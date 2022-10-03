<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Servicepekerjaanpengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pekerjaan_bulanan_pengguna');

        // Your own constructor code
    }

    public function read_pekerjaan_bulanan_pengguna_by_id()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_bulanan_pengguna_by_id($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan_pengguna_by_pengguna()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan_pengguna_by_pekerjaan()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pekerjaan($dataInput);

        echo json_encode($output);
    }

    public function ubah_volume_pekerjaan_pengguna_by_id()
    {
        $dataInput = $this->input->post();

        // print_r($dataInput);
        $output = $this->model_pekerjaan_bulanan_pengguna->ubah_volume_pekerjaan_pengguna_by_id($dataInput);

        echo json_encode($output);
    }
    public function ubah_volume_realisasi_pekerjaan_pengguna_by_id()
    {
        $dataInput = $this->input->post();

        // print_r($dataInput);
        $output = $this->model_pekerjaan_bulanan_pengguna->ubah_volume_realisasi_pekerjaan_pengguna_by_id($dataInput);

        echo json_encode($output);
    }
    public function delete_pekerjaan_pengguna_by_id()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->delete_pekerjaan_pengguna_by_id($dataInput);

        echo json_encode($output);
    }

    public function create_pekerjaan_pengguna()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->create_pekerjaan_pengguna($dataInput);

        echo json_encode($output);
    }
    public function duplikasi_pekerjaan_pengguna()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->duplikasi_pekerjaan_pengguna($dataInput);

        echo json_encode($output);
    }

    public function read_pekerjaan_pengguna_by_pengguna_tahun_bulan()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna_tahun_bulan($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan_pengguna_by_id_kegiatan()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_id_kegiatan($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan_pengguna_by_pengguna_tahun_bulan_2()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna_tahun_bulan_2($dataInput);

        echo json_encode($output);
    }
    public function read_pekerjaan_pengguna_by_pengguna_tahun_bulan_by_tim_penilai()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna_tahun_bulan_by_tim_penilai($dataInput);

        echo json_encode($output);
    }
    public function update_volume_realisasi_volume_by_id()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->update_volume_realisasi_volume_by_id($dataInput);

        echo json_encode($output);
    }

    public function update_penilaian_atasan_by_id()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->update_penilaian_atasan_by_id($dataInput);

        echo json_encode($output);
    }
    public function update_penilaian_tim_penilai()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pekerjaan_bulanan_pengguna->update_penilaian_tim_penilai($dataInput);

        echo json_encode($output);
    }

    public function testes()
    {
        // $templateLaporan = "./../../uploads/2021-11-01__Nia Aprillyana, S.ST, M.Si. (wfh).xlsx";
        $templateLaporan = 'uploads/2022-01-06_340053328_Mohamad Achiruzaman S.ST, M.T (wfh).xlsx';

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);
        $sheet = $spreadsheet->getActiveSheet();

        echo "<table>";
        foreach ($sheet->getRowIterator() as $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            echo "<tr>";
            foreach ($cellIterator as $cell) {
                echo "<td>" . $cell->getValue() . "</td>";
            }
            echo "</tr>";
            # code...
        }
        echo "<table>";
    }
    public function cetak_laporan_ckpr()
    {
        $dataInput = $this->input->get();
        $dataInput['RecId'] = $dataInput['PenerimaPekerjaanId'];

        $templateLaporan = "aset/template_laporan/laporan_ckpr.xlsx";


        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);

        $sheet = $spreadsheet->getActiveSheet();

        $namaBulanLaporan = $this->fungsi->bulanByNo($dataInput['Bulan']);
        $namaBulanPenilaian = $this->fungsi->bulanByNo($dataInput['Bulan'] + 1);

        $outputIdentitasPengguna = $this->model_pengguna->read_pengguna_by_id($dataInput);
        $sheet->setCellValue('B2', "REALISASI KINERJA PEGAWAI TAHUN " . $dataInput['Tahun']);
        $sheet->setCellValue('C4', $outputIdentitasPengguna['data']['NamaSatker']);
        $sheet->setCellValue('C5', $outputIdentitasPengguna['data']['Nama']);
        $sheet->setCellValue('C6', $outputIdentitasPengguna['data']['Jabatan']);
        $sheet->setCellValue('C7', $namaBulanLaporan . ' Tahun ' . $dataInput['Tahun']);
        $sheet->setCellValue('C20', $outputIdentitasPengguna['data']['Jabatan']);
        $sheet->setCellValue('I20', $outputIdentitasPengguna['data']['DataAtasan']['data']['Jabatan']);
        $sheet->setCellValue('C23', $outputIdentitasPengguna['data']['Nama']);
        $sheet->setCellValue('I23', $outputIdentitasPengguna['data']['DataAtasan']['data']['Nama']);
        $sheet->setCellValue('C24', 'NIP. ' . $outputIdentitasPengguna['data']['NipBaru']);
        $sheet->setCellValue('I24', 'NIP. ' . $outputIdentitasPengguna['data']['DataAtasan']['data']['NipBaru']);
        $sheet->setCellValue('C17', "2 " . $namaBulanPenilaian . " " . $dataInput['Tahun']);

        $sheet->getStyle("C20:I23")->getFont()->setItalic(false)->setUnderline(false);

        $startBarisPekerjaanPengguna = 12;

        $outputPekerjaanPengguna = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna_tahun_bulan($dataInput);
        $outputPekerjaanPengguna = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna_tahun_bulan_2($dataInput);

        // $sheet->setCellValue('G14', $outputPekerjaanPengguna['data']['ringkasan']['rerataPersentaseRealisasiVolume']);
        // $sheet->setCellValue('H14', $outputPekerjaanPengguna['data']['ringkasan']['rerataPersentasePenilaianAtasan']);

        foreach ($outputPekerjaanPengguna['data']['detail'] as $rowPekerjaanPengguna) {
            $sheet->insertNewRowBefore($startBarisPekerjaanPengguna);
        }

        $indeks = 0;
        // $coPenilaianTim=0;
        // $sumPenilaianTim = 0;

        $rerataKuantitas=0;
        $rerataKualitas=0;
        foreach ($outputPekerjaanPengguna['data']['detail'] as $rowPekerjaanPengguna) {
            $no = $indeks + 1;

            $sheet->setCellValue('A' . $startBarisPekerjaanPengguna, $no);
            $sheet->setCellValue('B' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['Deskripsi']);
            $spreadsheet->getActiveSheet()->mergeCells("B" . $startBarisPekerjaanPengguna . ":C" . $startBarisPekerjaanPengguna);

            $sheet->getStyle("B" . $startBarisPekerjaanPengguna)->getAlignment()->setHorizontal('left');

            $sheet->setCellValue('D' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['Satuan']);
            $sheet->setCellValue('E' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['Volume']);
            $sheet->setCellValue('F' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['VolumeRealisasi']);
            $sheet->setCellValue('G' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['PersentaseRealisasiVolume']);
            $sheet->setCellValue('H' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['PenilaianKepala']['nilai']);
            $sheet->getStyle("B:K")->getFont()->setItalic(false);

            $penilaianDariKepala=$rowPekerjaanPengguna['PenilaianKepala']['nilai'];
            // $sumPenilaianTim = $sumPenilaianTim + $rowPekerjaanPengguna['PenilaianTim']['data']['Rerata'];

            $startBarisPekerjaanPengguna++;
            $indeks++;
        }
        $startBarisPekerjaanPengguna=$startBarisPekerjaanPengguna+2;
        // $rerataPenilaianTim = $sumPenilaianTim / ($indeks + 1);
        $sheet->setCellValue('G' . $startBarisPekerjaanPengguna, $outputPekerjaanPengguna['data']['ringkasan']['rerataPersentaseRealisasiVolume']);
        $sheet->setCellValue('H' . $startBarisPekerjaanPengguna, $penilaianDariKepala);
    
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('Laporan_CKPR_Tahun_' . $dataInput['Tahun'] . '_Bulan_' . $dataInput['Bulan'] . '_NIP_' . $outputIdentitasPengguna['data']['NipBaru'] . '_' . $outputIdentitasPengguna['data']['Nama'] . '.xlsx') . '"');
        $writer->save('php://output');
        // echo json_encode($output);
    }
    public function cetak_laporan_ckpt()
    {
        $dataInput = $this->input->get();
        $dataInput['RecId'] = $dataInput['PenerimaPekerjaanId'];

        $templateLaporan = "aset/template_laporan/laporan_ckpt.xlsx";


        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);

        $sheet = $spreadsheet->getActiveSheet();

        $namaBulanLaporan = $this->fungsi->bulanByNo($dataInput['Bulan']);
        $namaBulanPenilaian = $this->fungsi->bulanByNo($dataInput['Bulan'] + 1);

        $outputIdentitasPengguna = $this->model_pengguna->read_pengguna_by_id($dataInput);
        $sheet->setCellValue('B2', "TARGET KINERJA PEGAWAI TAHUN " . $dataInput['Tahun']);
        $sheet->setCellValue('C4', $outputIdentitasPengguna['data']['NamaSatker']);
        $sheet->setCellValue('C5', $outputIdentitasPengguna['data']['Nama']);
        $sheet->setCellValue('C6', $outputIdentitasPengguna['data']['Jabatan']);
        $sheet->setCellValue('C7', $namaBulanLaporan . ' Tahun ' . $dataInput['Tahun']);
        $sheet->setCellValue('C18', $outputIdentitasPengguna['data']['Jabatan']);
        $sheet->setCellValue('C21', $outputIdentitasPengguna['data']['Nama']);
        $sheet->setCellValue('C22', 'NIP. ' . $outputIdentitasPengguna['data']['NipBaru']);
        $sheet->setCellValue('C15', "1 " . $namaBulanLaporan . " " . $dataInput['Tahun']);

        $sheet->getStyle("C20:I23")->getFont()->setItalic(false)->setUnderline(false);

        $startBarisPekerjaanPengguna = 12;

        $outputPekerjaanPengguna = $this->model_pekerjaan_bulanan_pengguna->read_pekerjaan_pengguna_by_pengguna_tahun_bulan($dataInput);

        // return array(
        //     'sukses' => true,
        //     'data' => array(
        //         "detail" => $dataPerBaris,
        //         "ringkasan" => array(
        //             "rerataPersentaseRealisasiVolume" => $rerataPersentaseRealisasiVolume,
        //             "rerataPersentasePenilaianAtasan" => $rerataPersentasePenilaianAtasan
        //         )
        // $outputPekerjaanPengguna

        foreach ($outputPekerjaanPengguna['data']['detail'] as $rowPekerjaanPengguna) {
            $sheet->insertNewRowBefore($startBarisPekerjaanPengguna);
        }

        $no = 1;
        foreach ($outputPekerjaanPengguna['data']['detail'] as $rowPekerjaanPengguna) {
            $sheet->setCellValue('A' . $startBarisPekerjaanPengguna, $no);
            $sheet->setCellValue('B' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['Deskripsi']);
            $spreadsheet->getActiveSheet()->mergeCells("B" . $startBarisPekerjaanPengguna . ":C" . $startBarisPekerjaanPengguna);

            $sheet->getStyle("B" . $startBarisPekerjaanPengguna)->getAlignment()->setHorizontal('left');

            $sheet->setCellValue('D' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['Satuan']);
            $sheet->setCellValue('E' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['Volume']);
            $sheet->setCellValue('H' . $startBarisPekerjaanPengguna, $rowPekerjaanPengguna['TanggalSelesaiFormatted']);
            $sheet->getStyle("B:K")->getFont()->setItalic(false);

            $startBarisPekerjaanPengguna++;
            $no++;
        }


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('Laporan_CKPT_Tahun_' . $dataInput['Tahun'] . '_Bulan_' . $dataInput['Bulan'] . '_NIP_' . $outputIdentitasPengguna['data']['NipBaru'] . '_' . $outputIdentitasPengguna['data']['Nama'] . '.xlsx') . '"');
        $writer->save('php://output');
        // echo json_encode($output);
    }
    public function dashboard_deadline()
    {

        echo json_encode($this->model_pekerjaan_bulanan_pengguna->dashboard_deadline($this->input->post()));
    }
    public function dashboard_kinerja()
    {

        echo json_encode($this->model_pekerjaan_bulanan_pengguna->dashboard_kinerja($this->input->post()));
    }
}
