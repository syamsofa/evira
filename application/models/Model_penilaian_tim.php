<?php

use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;

class Model_penilaian_tim extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('lib');
		// $this->load->library('lib_security');
		// $this->load->model('role_model');
		// $this->load->model('model_pengguna');
		//call function
		// Your own constructor code

		$this->load->model('model_pengguna');
	}
	public function read_nilai_by_id_pekerjaan_pengguna($IdPekerjaanPengguna)
	{
		$query = $this->db->query("select * from penilaian_tim  where IdPekerjaanPengguna=?", array($IdPekerjaanPengguna));
		$data = array();

		$jumlah = 0;
		$count = 0;
		foreach ($query->result_array() as $row) {


			$row['Penilai'] = $this->model_pengguna->read_pengguna_by_id(["RecId" => $row['IdPenilai']]);
			$data[] = $row;
			$jumlah = $jumlah + $row['Nilai'];
			$count++;
		}
		// $rerata = if($count==0:;
		if ($count == 0 ? $rerata = 0 : $rerata = $jumlah / $count);


		return array(
			'sukses' => true,
			'data' => ["Rerata" => number_format($rerata, 2), "Detail" => $data]
		);
	}

	public function read_nilai_by_id_dinilai_tahun_bulan($dataMasukan)
	{

		$query = $this->db->query("select a.PenggunaId,a.RoleId,b.Nama from role_pengguna a left join pengguna b on a.PenggunaId=b.RecId where a.RoleId=3");

		$array = [];
		if ($query->num_rows() > 0) {

			$JumNilaiKeseluruhan = 0;
			$JumBaris = 0;
			foreach ($query->result_array() as $row) {

				$dataMasukan["IdPenilai"] = $row['PenggunaId'];
				$row['Nilai'] = $this->read_nilai_by_id_dinilai_id_penilai_tahun_bulan($dataMasukan);
				$JumBaris++;
				$JumNilaiKeseluruhan = $JumNilaiKeseluruhan + $row['Nilai']['NilaiKeseluruhan'];

				$array[] = $row;
			}

			$Rerata = $JumNilaiKeseluruhan / $JumBaris;
			return array(
				'sukses' => true,
				'data' => $array,
				'rerata' => number_format($Rerata,2)
			);
		} else
			return array(
				'sukses' => false,
				'data' => null

			);
	}
	public function read_nilai_by_id_dinilai_id_penilai_tahun_bulan($dataMasukan)
	{
		// print_r($dataMasukan);
		$dataNilai = $this->db->query("select * from penilaian_kinerja where IdDinilai=? and IdPenilai=? and Tahun=? and Bulan=?", array($dataMasukan['IdDinilai'], $dataMasukan['IdPenilai'], $dataMasukan['Tahun'], $dataMasukan['Bulan']))->result_array();


		if (empty($dataNilai[0]))
			$kkkk = 1;
		// $dataNilai = $dataNilai[0];

		else
			$dataNilai = $dataNilai[0];

		$BebanKerja = (empty($dataNilai['BebanKerja'])) ?  0 : $dataNilai['BebanKerja'];
		$TanggungJawab = (empty($dataNilai['TanggungJawab'])) ?  0 : $dataNilai['TanggungJawab'];
		$Disiplin = (empty($dataNilai['Disiplin'])) ?   0 : $dataNilai['Disiplin'];
		$Profesionalitas = (empty($dataNilai['Profesionalitas'])) ?   0 : $dataNilai['Profesionalitas'];
		$KualitasKerja = (empty($dataNilai['KualitasKerja'])) ?   0 : $dataNilai['KualitasKerja'];
		$NilaiKeseluruhan = ($BebanKerja + $TanggungJawab + $Disiplin + $Profesionalitas + $KualitasKerja) / 5;

		return array(
			'BebanKerja' => $BebanKerja,
			'TanggungJawab' => $TanggungJawab,
			'Disiplin' => $Disiplin,
			'Profesionalitas' => $Profesionalitas,
			'KualitasKerja' => $KualitasKerja,
			'NilaiKeseluruhan' => $NilaiKeseluruhan
		);
	}
	public function simpan_nilai($dataMasukan)
	{
		print_r($dataMasukan);

		$IdDinilai = $dataMasukan['IdDinilai'];
		$IdPenilai = $dataMasukan['IdPenilai'];
		$Kolom = $dataMasukan['Kolom'];
		$Nilai = $dataMasukan['Nilai'];
		$Tahun = $dataMasukan['TahunPekerjaan'];
		$Bulan = $dataMasukan['BulanPekerjaan'];

		$cek = $this->db->query("select * from penilaian_kinerja where IdDinilai=? and IdPenilai=? and Tahun=? and Bulan=?", array($IdDinilai, $IdPenilai, $Tahun, $Bulan));
		if ($cek->num_rows() > 0) {

			$this->db->query("update penilaian_kinerja set " . $Kolom . "=? where IdDinilai=? and IdPenilai=? and Tahun=? and Bulan=?", [$Nilai, $IdDinilai, $IdPenilai, $Tahun, $Bulan]);
		} else
			$this->db->query("insert into penilaian_kinerja (IdDinilai,IdPenilai,Tahun,Bulan," . $Kolom . ") values (?,?,?,?,?) ", [$IdDinilai, $IdPenilai, $Tahun, $Bulan, $Nilai]);

		// return array(
		// 	'BebanKerja' => (empty($dataNilai['BebanKerja'])) ?  0 : $dataNilai['BebanKerja'],
		// 	'TanggungJawab' => (empty($dataNilai['TanggungJawab'])) ?  0 : $dataNilai['TanggungJawab'],
		// 	'Disiplin' => (empty($dataNilai['Disiplin'])) ?   0 : $dataNilai['Disiplin'],
		// 	'Profesionalitas' => (empty($dataNilai['Profesionalitas'])) ?   0 : $dataNilai['Profesionalitas'],
		// 	'KualitasKerja' => (empty($dataNilai['KualitasKerja'])) ?   0 : $dataNilai['KualitasKerja']
		// );
	}
}
