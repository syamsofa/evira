<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{
	public $pengguna;
	public $tahun;
	public $bulan;
	public $roleByPengguna;
	public $satker;
	public $organisasi;
	public $pekerjaan;
	public $pekerjaanByPengguna;

	public function __construct()
	{

		parent::__construct();
		$this->load->model('model_pengguna');
		$this->load->model('model_opsi_login');
		$this->load->model('model_satker');
		$this->load->model('model_organisasi');
		$this->load->model('model_satuan');
		$this->load->model('model_pekerjaan_bulanan');
		$this->load->model('model_tahun');

		$this->load->model('model_bulan');
		$this->load->library('fungsi');

		$this->detailPengguna = $this->model_pengguna->read_pengguna_by_id($data = $this->session->userdata());
		$this->roleByPengguna = $this->model_pengguna->read_role_by_pengguna($data = $this->session->userdata());
		$this->pengguna = $this->model_pengguna->read_pengguna();
		$this->satker = $this->model_satker->read_satker();
		$this->organisasi = $this->model_organisasi->read_organisasi();
		$this->opsiLogin = $this->model_opsi_login->read_opsi_login();
		$this->satuan = $this->model_satuan->read_satuan();
		$this->pekerjaan = $this->model_pekerjaan_bulanan->read_pekerjaan();
		$this->pekerjaanByPengguna = $this->model_pekerjaan_bulanan->read_pekerjaan_by_pengguna($this->session->userdata());
		$this->tahun = $this->model_tahun->read_tahun();
		$this->bulan = $this->model_bulan->read_bulan();
		// Your own constructor code
	}
	public function index()
	{
		redirect('/site/dashboard');
	}
	public function dashboard()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Selamat Datang',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,



		);
		$this->load->view('site', $data);
	}
	public function dashboard_kinerja()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Dashboard Kinerja',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,



		);
		$this->load->view('site', $data);
	}

	public function profil()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Profil',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna

		);
		$this->load->view('site', $data);
		// echo json_encode($data);
	}
	public function pengguna()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Pengguna',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'opsiLogin' => $this->opsiLogin

		);
		$this->load->view('site', $data);
	}
	public function pegawai_bawahan()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Penilaian Bawahan',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'opsiLogin' => $this->opsiLogin,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,


		);
		$this->load->view('site', $data);
	}
	public function pekerjaan_bulanan()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Master Pekerjaan',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'pekerjaan' => $this->pekerjaan,
			'pekerjaanByPengguna' => $this->pekerjaanByPengguna


		);
		$this->load->view('site', $data);
	}
	public function laporan_harian()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Laporan Harian Saya',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,

		);
		$this->load->view('site', $data);
		// echo json_encode($data);
	}
	public function rekap_laporan_harian()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Rekap Laporan Pegawai',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,

		);
		$this->load->view('site', $data);
		// echo json_encode($data);
	}
	public function tes()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Pekerjaan',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'pekerjaan' => $this->pekerjaan



		);
		$this->load->view('site', $data);
		// print_r($this->pekerjaanByPengguna);
	}
	public function pekerjaan_saya()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Pekerjaan Yang Ditugaskan Ke Saya',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'pekerjaan' => $this->pekerjaan,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,
			'pekerjaanByPengguna' => $this->pekerjaanByPengguna

		);
		$this->load->view('site', $data);
	}
	public function satuan()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Daftar Satuan',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'pekerjaan' => $this->pekerjaan,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,
			'pekerjaanByPengguna' => $this->pekerjaanByPengguna

		);
		$this->load->view('site', $data);
	}

	public function logout()
	{
		$array_items = array('Nama', 'Email', 'UrlPicture');
		$this->session->unset_userdata($array_items);
		include APPPATH . 'third_party/glogin/config.php';

		if ($this->session->userdata('OpsiLoginId') == 2)
			$google_client->revokeToken();
		else if ($this->session->userdata('OpsiLoginId') == 1) {

			redirect($this->session->userdata('UrlLogout'));
		}

		session_destroy();
		redirect('site/index');
	}
}
