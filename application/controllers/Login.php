<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public $pengguna;


	public $satker;
	public $organisasi;
	public $pekerjaan;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_pengguna');
		$this->load->model('model_satker');
		$this->load->model('model_organisasi');
		$this->load->model('model_satuan');
		$this->load->model('model_pekerjaan_bulanan');
	
		$this->pengguna = $this->model_pengguna->read_pengguna();
		$this->satker = $this->model_satker->read_satker();
		$this->organisasi = $this->model_organisasi->read_organisasi();
		$this->satuan = $this->model_satuan->read_satuan();
		$this->pekerjaan = $this->model_pekerjaan_bulanan->read_pekerjaan();
		// Your own constructor code
	}
	public function index()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'index',		
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'pekerjaan' => $this->pekerjaan

		);

		$this->load->view('login', $data);
	}
	
}
