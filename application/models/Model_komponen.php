<?php

class Model_komponen extends CI_Model
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
	public function read_komponen()
	{
		$query = $this->db->query("select * from komponen");
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
    public function read_komponen_by_ro($KodeRo)
	{
		$query = $this->db->query("select * from komponen where KodeRo=?",[$KodeRo]);
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
