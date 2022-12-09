<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{
	public $pengguna;
	public $tahun;
	public $bulan;
	public $roleByPengguna;
	public $satker;
	public $seksi;
	public $ro;
	public $komponen;
	public $organisasi;
	public $pekerjaan;
	public $pekerjaanByPengguna;
	public $kecamatan;
	public $batch;

	public function __construct()
	{

		parent::__construct();
		$this->load->model('model_pengguna');
		$this->load->model('model_opsi_login');
		$this->load->model('model_satker');
		$this->load->model('model_organisasi');
		$this->load->model('model_satuan');
		$this->load->model('model_ro');
		$this->load->model('model_komponen');
		$this->load->model('model_pekerjaan_bulanan');
		$this->load->model('model_tahun');
		$this->load->model('model_wilayah');

		$this->load->model('model_bulan');
		$this->load->library('fungsi');

		$this->kecamatan=$this->model_wilayah->read_kecamatan();
		$this->batch=$this->model_wilayah->read_batch();
		$this->detailPengguna = $this->model_pengguna->read_pengguna_by_id($data = $this->session->userdata());
		$this->roleByPengguna = $this->model_pengguna->read_role_by_pengguna($data = $this->session->userdata());
		$this->pengguna = $this->model_pengguna->read_pengguna();
		$this->satker = $this->model_satker->read_satker();
		$this->organisasi = $this->model_organisasi->read_organisasi();
		$this->opsiLogin = $this->model_opsi_login->read_opsi_login();
		$this->satuan = $this->model_satuan->read_satuan();
		$this->ro = $this->model_ro->read_ro();
		$this->seksi = $this->model_ro->read_seksi();
		$this->komponen = $this->model_komponen->read_komponen();
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
			'judul' => 'Dashboard Kinerja dan Kegiatan',
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

	public function regsosek_rb()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Entri Receiving Batching',
			'kecamatan' => $this->kecamatan,
			
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
	public function regsosek_supervisor_wil()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Entri Supervisor',
			'kecamatan' => $this->kecamatan,
			
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
	public function regsosek_supervisor_batch()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Entri Supervisor By Batch',
			'kecamatan' => $this->kecamatan,
			'batch' => $this->batch,
			
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
	public function penilaian_dari_saya()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Penilaian Pegawai',
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
		// echo json_encode($data);
	}
	public function penilaian_bulanan()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Penilaian Pegawai',
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
		// echo json_encode($data);
	}
	public function penilaian_kepala()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Penilaian Kepala',
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
		// echo json_encode($data);
	}
	public function monitoring_kegiatan()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Monitoring Kegiatan',
			'role_by_pengguna' => $this->roleByPengguna,
			'detailPengguna' => $this->detailPengguna,
			'satker' => $this->satker,
			'organisasi' => $this->organisasi,
			'satuan' => $this->satuan,
			'seksi' => $this->seksi,
			'pengguna' => $this->pengguna,
			'opsiLogin' => $this->opsiLogin,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan,


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
			'ro' => $this->ro,
			'komponen' => $this->komponen,
			'satuan' => $this->satuan,
			'pengguna' => $this->pengguna,
			'pekerjaan' => $this->pekerjaan,
			'pekerjaanByPengguna' => $this->pekerjaanByPengguna,
			'tahun' => $this->tahun,
			'bulan' => $this->bulan



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
	public function upload_realisasi()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Realisasi Per Output',
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
	public function pekerjaan_semua()
	{
		$data = array(
			'menu' => $this->uri->segment(2),
			'judul' => 'Pekerjaan Semua Pegawai',
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
		
		if ($this->session->userdata('OpsiLoginId') == 1) {

			redirect($this->session->userdata('UrlLogout'));
		}

		session_destroy();
		redirect('site/index');
	}
}
