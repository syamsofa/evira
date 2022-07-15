<?php

class Model_penilaian_tim extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('lib');
		// $this->load->library('lib_security');
		// $this->load->model('role_model');
		// $this->load->model('email_model');
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
}
