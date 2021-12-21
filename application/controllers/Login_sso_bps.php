<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_sso_bps extends CI_Controller
{
    public $opsiLogin = 1;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pengguna');
    }

    public function index()
    {


        require 'vendor/autoload.php';

        $provider = new JKD\SSO\Client\Provider\Keycloak(


            [
                'authServerUrl'         => 'https://sso.bps.go.id',
                'realm'                 => 'pegawai-bps',
                'clientId'              => '03340-aduan-k4k',
                'clientSecret'          => '1fb2fbdb-153f-4ad1-a6f0-4f194fb150c1',
                'redirectUri'           => base_url() . '/login_sso_bps'
            ]
        );

        if (!isset($_GET['code'])) {

            // Untuk mendapatkan authorization code
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: ' . $authUrl);
            exit;

            // Mengecek state yang disimpan saat ini untuk memitigasi serangan CSRF
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {

            try {
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
            } catch (Exception $e) {
                exit('Gagal mendapatkan akses token : ' . $e->getMessage());
            }

            // Opsional: Setelah mendapatkan token, anda dapat melihat data profil pengguna
            try {

                $user = $provider->getResourceOwner($token);
                
                // echo "Nama : ".$user->getName();
                // echo "E-Mail : ". $user->getEmail();
                // echo "Username : ". $user->getUsername();
                // echo "NIP : ". $user->getNip();
                // echo "NIP Baru : ". $user->getNipBaru();
                // echo "Kode Organisasi : ". $user->getKodeOrganisasi();
                // echo "Kode Provinsi : ". $user->getKodeProvinsi();
                // echo "Kode Kabupaten : ". $user->getKodeKabupaten();
                // echo "Alamat Kantor : ". $user->getAlamatKantor();
                // echo "Provinsi : ". $user->getProvinsi();
                // echo "Kabupaten : ". $user->getKabupaten();
                // echo "Golongan : ". $user->getGolongan();
                // echo "Jabatan : ". $user->getJabatan();
                // echo "Eselon : ". $user->getEselon();

                $data = array(
                    "OpsiLoginId" => $this->opsiLogin, //google
                    "Email" => $user->getEmail(),
                    "Nama" => $user->getName(),
                    "UrlPicture" => ''

                );


                $output = $this->model_pengguna->cek_pengguna($data);
                if ($output['sukses'] == true) {
                    $output = $output['data'][0];
                    $output['UrlLogout']=$provider->getLogoutUrl();
                
                    $dataUrlPicture = array(
                        "RecId" => $output['RecId'],
                        "UrlPicture" => $user->getUrlFoto()
                    );
                    $this->model_pengguna->edit_url_picture($dataUrlPicture);
                    $this->session->set_userdata($output);

                    // print_r($dataUrlPicture);
                    // echo json_encode($output);
                    // echo json_encode($this->session->userdata);
                    //  print_r($this->session->userdata('Nama'));
                    redirect('site/dashboard');
                } else {

                    $output = $this->model_pengguna->create_pengguna($data);
                    $dataUrlPicture = array(
                        "RecId" => $output['data'][0]['RecId'],
                        "UrlPicture" => $user->getUrlFoto()
                    );
                    $this->model_pengguna->edit_url_picture($dataUrlPicture);
                    $output['data']['UrlLogout']=$provider->getLogoutUrl();
                
                    $this->session->set_userdata($output['data']);
                    redirect('site/dashboard');
                }
            } catch (Exception $e) {
                exit('Gagal Mendapatkan Data Pengguna: ' . $e->getMessage());
            }
        }
    }
}
