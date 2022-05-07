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
	}
	public function read_nilai_by_id_pekerjaan_pengguna()
	{
		$query = $this->db->query("select * from penilaian_tim  where IdPekerjaanPengguna=?",array(1593));
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}

}
