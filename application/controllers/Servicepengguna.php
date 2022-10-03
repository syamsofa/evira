<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicepengguna extends CI_Controller
{
    public $jatengAuthUrl = "http://112.78.134.179/auth/do_login";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pengguna');

        // Your own constructor code
    }
    public function read_pengguna()
    {
        $output = $this->model_pengguna->read_pengguna();

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
    public function read_bawahan()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->read_bawahan_by_id_pengguna($dataInput);

        echo json_encode($output);
    }
    public function read_pengguna_by_id()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->read_pengguna_by_id($dataInput);

        echo json_encode($output);
    }
    public function tes()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->read_pengguna_by_id($dataInput = array("RecId" => 16, "AtasanId" => null));

        echo json_encode($output);
    }
    public function update_pengguna_by_id()
    {
        $dataInput = $this->input->post();
        $output = $this->model_pengguna->update_pengguna_by_id($dataInput);

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
    public function create_pengguna_baru()
    {

        $dataInput = $this->input->post();
        $output = $this->model_pengguna->create_pengguna($dataInput);

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
