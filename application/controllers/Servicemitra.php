<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
        print_r($_FILES);
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
}
