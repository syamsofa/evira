<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gredirect extends CI_Controller
{

    public $opsiLogin = 2;
    public function index()
    {
        $this->load->model('model_pengguna');
        $this->load->model('model_role');
        include APPPATH . 'third_party/glogin/config.php';
        if (isset($_GET["code"])) {
            //It will Attempt to exchange a code for an valid authentication token.
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
            if (!isset($token['error'])) {
                //Set the access token used for requests
                $google_client->setAccessToken($token['access_token']);

                //Store "access_token" value in $_SESSION variable for future use.
                $_SESSION['access_token'] = $token['access_token'];

                //Create Object of Google Service OAuth 2 class
                $google_service = new Google_Service_Oauth2($google_client);

                //Get user profile data from google
                $dataFromGoogle = $google_service->userinfo->get();

                // echo json_encode($dataFromGoogle);

                $data = array(
                    "OpsiLoginId" => $this->opsiLogin, //google
                    "Email" => $dataFromGoogle['email'],
                    "Nama" => $dataFromGoogle['name'],
                    "UrlPicture" => $dataFromGoogle['picture']

                );


                $output = $this->model_pengguna->cek_pengguna($data);
                

                if ($output['sukses'] == true) {
                    $output = $output['data'];

                    $dataUrlPicture = array(
                        "RecId" => $output['RecId'],
                        "UrlPicture" => $dataFromGoogle['picture']
                    );

                    //cek user
                    $this->model_pengguna->edit_url_picture($dataUrlPicture);
                    $this->session->set_userdata($output);
                    $this->session->set_userdata('RoleIdAktif',2);
                    $this->session->set_userdata('RoleAktif','Pengguna Biasa');

                    // print_r($dataUrlPicture);
                    // print_r($output['data']);
                    // echo json_encode($this->session->userdata);
                    //  print_r($this->session->userdata('Nama'));
                    redirect('site/dashboard');
                } else {

                    $output = $this->model_pengguna->create_pengguna($data);
                    $dataUrlPicture = array(
                        "RecId" => $output['data'][0]['RecId'],
                        "UrlPIcture" => $dataFromGoogle['picture']
                    );
                    $this->model_pengguna->edit_url_picture($dataUrlPicture);
                    $this->session->set_userdata($output['data']);
                    $this->session->set_userdata('RoleIdAktif',2);
                    $this->session->set_userdata('RoleAktif','Pengguna Biasa');
                    redirect('site/dashboard');
                }
            }
        }
    }
}
