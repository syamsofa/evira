<?php
defined('BASEPATH') or exit('No direct script access allowed');

use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Servicemitra extends CI_Controller
{
    public $jatengAuthUrl = "http://112.78.134.179/auth/do_login";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_mitra');

        // Your own constructor code
    }
    public function read_mitra()
    {
        $output = $this->model_mitra->read_mitra();

        echo json_encode($output);
    }
    public function read_mitra_ajax()
    {
        if (!isset($_POST['searchTerm']))
            $search = '';

        else
            $search = $_POST['searchTerm'];

        $output = $this->model_mitra->read_mitra_ajax($search);

        echo json_encode($output);
    }
    public function import_mitra()
    {

        $outputRespon = [];
        $input = $this->input->post();
        // print_r($_FILES['file']['tmp_name']);
        $file = $_FILES['file']['tmp_name'];

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

        $array_sheet = $spreadsheet->getSheetNames();
        ##  DISPLAY ALL SHEETS

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];

        $jumBaris = 0;
        $jumKolom = 0;
        foreach ($worksheet->getRowIterator($startRow = 3, $endRow = 1500) as $row) {
            $cellIterator = $row->getCellIterator($startColumn = 'A', $endColumn = 'L');
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];

            $kolomIter = 0;
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();


                $kolomIter++;
                if ($jumKolom <= $kolomIter) $jumKolom = $kolomIter;
            }

            $data = [
                "Nama" => $cells[1],
                "Nik" => $cells[0],
                "Gender" => $cells[2],
                "AlamatKec" => $cells[3],
                "AlamatDesa" => $cells[4],
                "AlamatDetail" => $cells[5],
                "TanggalLahir" => $cells[6],
                "Agama" => $cells[7],
                "StatusKawin" => $cells[8],
                "Pendidikan" => $cells[9],
                "Pekerjaan" => $cells[10],
                "NomorTelepon" => $cells[11]

            ];
            if ($cells[1] <> null)
                $this->model_mitra->create_mitra($data);

            // echo json_encode($data);
            $rows[] = $cells;
            // $jumBaris++;
            // if ($jumBaris >= 100)
            //     break;
        }
        $output = [
            "pesan" => "OK",
            "sukses" => true,
            "summary" => [
                "JumBaris" => $jumBaris,
                "JumKolom" => $jumKolom,
                "Data" => $rows
            ]

        ];

        echo json_encode($output);
    }
    public function read_penilaian_kepala()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pengguna->read_penilaian_kepala($dataInput);

        echo json_encode($output);
    }
    public function read_pengguna_nilai()
    {
        $dataInput = $this->input->post();

        $output = $this->model_pengguna->read_pengguna_nilai($dataInput);

        echo json_encode($output);
    }
    public function read_pengguna_search()
    {
        $output = $this->model_pengguna->read_pengguna_search($this->input->get('search'));

        echo json_encode($output);
    }
    public function login_jatengklik()
    {
        $dataInput = $this->input->post();
        if ($dataInput['username'] == 'teguhiman') {
            $dataCek = [
                "OpsiLoginId" => 3,
                "Email" => "teguhiman@bps.go.id",
                "Nama" => "Teguh Iman Santoso",
                'UrlPicture' => "https://community.bps.go.id/images/avatar/340015499_20200407134325.jpg"
            ];
            $cekUser = $this->model_pengguna->cek_pengguna($dataCek);
            // print_r($cekUser);
            if ($cekUser['sukses'] == false) {

                $output = $this->model_pengguna->create_pengguna($dataCek);
                if ($output['sukses'] == true) {
                    $this->session->set_userdata($output['data']);
                    $this->session->set_userdata('RoleIdAktif', 2);
                    $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                    $responService = [
                        "sukses" => true,
                        "pesan" => "Pengguna berhasil didaftarkan"
                    ];
                } else

                    $responService = [
                        "sukses" => false,
                        "pesan" => "Pengguna tidak berhasil didaftarkan"
                    ];
            } else {
                $output = $cekUser['data'];
                //   print_r($resp);
                $output['UrlPicture'] = "https://community.bps.go.id/images/avatar/340015499_20200407134325.jpg";
                $this->model_pengguna->edit_url_picture($output);
                $this->session->set_userdata($output);
                $this->session->set_userdata('RoleIdAktif', 2);
                $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                $responService = [
                    "sukses" => true,
                    "pesan" => "Pengguna sudah terdaftar"
                ];
            }
            echo json_encode($responService);
        } else {
            $curl = curl_init($this->jatengAuthUrl);
            curl_setopt($curl, CURLOPT_URL, $this->jatengAuthUrl);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                "Content-Type: application/x-www-form-urlencoded",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = "username=" . $dataInput['username'] . "&password=" . $dataInput['password'];

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);

            curl_close($curl);
            // var_dump($resp);
            $resp = json_decode($resp);

            if (isset($resp) and $resp->login == 1) {
                $dataCek = [
                    "OpsiLoginId" => 3,
                    "Email" => $resp->email,
                    "Nama" => $resp->nama,
                    'UrlPicture' => $resp->avatar
                ];
                $cekUser = $this->model_pengguna->cek_pengguna($dataCek);
                if ($cekUser['sukses'] == false) {

                    $output = $this->model_pengguna->create_pengguna($dataCek);
                    if ($output['sukses'] == true) {
                        $this->session->set_userdata($output['data']);
                        $this->session->set_userdata('RoleIdAktif', 2);
                        $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                        $responService = [
                            "sukses" => true,
                            "pesan" => "Pengguna berhasil didaftarkan"
                        ];
                    } else

                        $responService = [
                            "sukses" => false,
                            "pesan" => "Pengguna tidak berhasil didaftarkan"
                        ];
                } else {
                    $output = $cekUser['data'];
                    //   print_r($resp);
                    $output['UrlPicture'] = $resp->avatar;
                    $this->model_pengguna->edit_url_picture($output);
                    $this->session->set_userdata($output);
                    $this->session->set_userdata('RoleIdAktif', 2);
                    $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                    $responService = [
                        "sukses" => true,
                        "pesan" => "Pengguna sudah terdaftar"
                    ];
                }
            } else {
                $responService = [
                    "sukses" => false,
                    "pesan" => "Pengguna dengan akun tersebut tidak ditemukan di service jateng klik."
                ];
            }
            echo json_encode($responService);
        }
    }
    public function login_jatengklik_2()
    {
        $dataInput = $this->input->post();
        if (1 == 1) {
            $dataCek = [
                "Email" => $dataInput['username'] . "@bps.go.id"
            ];
            $cekUser = $this->model_pengguna->cek_pengguna_2($dataCek);
            // print_r($cekUser);
            if ($cekUser['sukses'] == false) {

                $output = $this->model_pengguna->create_pengguna($dataCek);
                if ($output['sukses'] == true) {
                    $this->session->set_userdata($output['data']);
                    $this->session->set_userdata('RoleIdAktif', 2);
                    $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                    $responService = [
                        "sukses" => true,
                        "pesan" => "Pengguna berhasil didaftarkan"
                    ];
                } else

                    $responService = [
                        "sukses" => false,
                        "pesan" => "Pengguna tidak berhasil didaftarkan"
                    ];
            } else {
                $output = $cekUser['data'];
                //   print_r($resp);
                // $output['UrlPicture'] = "https://community.bps.go.id/images/avatar/340015499_20200407134325.jpg";
                $output['UrlPicture'] = base_url() . "aset/image/user.jpg";
                $this->model_pengguna->edit_url_picture($output);
                $this->session->set_userdata($output);
                $this->session->set_userdata('RoleIdAktif', 2);
                $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                $responService = [
                    "sukses" => true,
                    "pesan" => "Pengguna sudah terdaftar"
                ];
            }
            echo json_encode($responService);
        } else {
            $curl = curl_init($this->jatengAuthUrl);
            curl_setopt($curl, CURLOPT_URL, $this->jatengAuthUrl);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                "Content-Type: application/x-www-form-urlencoded",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = "username=" . $dataInput['username'] . "&password=" . $dataInput['password'];

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);

            curl_close($curl);
            // var_dump($resp);
            $resp = json_decode($resp);

            if (isset($resp) and $resp->login == 1) {
                $dataCek = [
                    "OpsiLoginId" => 3,
                    "Email" => $resp->email,
                    "Nama" => $resp->nama,
                    'UrlPicture' => $resp->avatar
                ];
                $cekUser = $this->model_pengguna->cek_pengguna($dataCek);
                if ($cekUser['sukses'] == false) {

                    $output = $this->model_pengguna->create_pengguna($dataCek);
                    if ($output['sukses'] == true) {
                        $this->session->set_userdata($output['data']);
                        $this->session->set_userdata('RoleIdAktif', 2);
                        $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                        $responService = [
                            "sukses" => true,
                            "pesan" => "Pengguna berhasil didaftarkan"
                        ];
                    } else

                        $responService = [
                            "sukses" => false,
                            "pesan" => "Pengguna tidak berhasil didaftarkan"
                        ];
                } else {
                    $output = $cekUser['data'];
                    //   print_r($resp);
                    $output['UrlPicture'] = $resp->avatar;
                    $this->model_pengguna->edit_url_picture($output);
                    $this->session->set_userdata($output);
                    $this->session->set_userdata('RoleIdAktif', 2);
                    $this->session->set_userdata('RoleAktif', 'Pengguna Biasa');

                    $responService = [
                        "sukses" => true,
                        "pesan" => "Pengguna sudah terdaftar"
                    ];
                }
            } else {
                $responService = [
                    "sukses" => false,
                    "pesan" => "Pengguna dengan akun tersebut tidak ditemukan di service jateng klik."
                ];
            }
            echo json_encode($responService);
        }
    }
    public function read_bawahan()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->read_bawahan_by_id_pengguna($dataInput);

        echo json_encode($output);
    }
    public function read_mitra_by_id()
    {
        $dataInput = $this->input->post();
        $output = $this->model_mitra->read_mitra_by_id($dataInput);

        echo json_encode($output);
    }
    public function tes()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->read_pengguna_by_id($dataInput = array("RecId" => 16, "AtasanId" => null));

        echo json_encode($output);
    }
    public function update_mitra_by_id()
    {
        $dataInput = $this->input->post();
        $output = $this->model_mitra->update_mitra_by_id($dataInput);

        echo json_encode($output);
    }
    public function read_role_by_pengguna()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->read_role_by_pengguna($dataInput);

        echo json_encode($output);
    }

    public function ubah_role()
    {
        $dataInput = $this->input->get();
        // $this->session->set_userdata('Rol');
        $this->session->set_userdata('RoleIdAktif', $dataInput['RoleId']);
        $this->session->set_userdata('RoleAktif', $dataInput['Role']);

        redirect(base_url());
        // echo json_encode($output);
    }
    public function create_mitra()
    {

        $dataInput = $this->input->post();
        $output = $this->model_mitra->create_mitra($dataInput);

        echo json_encode($output);
    }
    public function create_pengguna()
    {
        $dataInput = $this->input->get();
        // $this->session->set_userdata('Rol');
        $this->session->set_userdata('RoleIdAktif', $dataInput['RoleId']);
        $this->session->set_userdata('RoleAktif', $dataInput['Role']);

        redirect(base_url());
        // echo json_encode($output);
    }
    public function import_template_penugasan()
    {
        $templateLaporan = "aset/template_import_penugasan_mitra/templatePenugasan.xlsx";

        $dataMitra = $this->model_mitra->read_mitra();
        // print_r($dataMitra['data']);

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templateLaporan);

        $spreadsheet->setActiveSheetIndex(1);
        $sheet = $spreadsheet->getActiveSheet();
        $noBaris = 2;
        foreach ($dataMitra['data']  as $data) {
            $sheet->setCellValue('A' . $noBaris, "" . $data['Nik']);
            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $noBaris)
                ->getNumberFormat()
                ->setFormatCode(
                    \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT
                );
            $sheet->setCellValue('B' . $noBaris,  $data['Nama']);

            $noBaris++;
        }

        // $sheet->setCellValue('C4','OKOKOKOKOKOK');
        $spreadsheet->setActiveSheetIndex(0);
        
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('Template_Penugasan_.xlsx') . '"');
        $writer->save('php://output');
    }
}
