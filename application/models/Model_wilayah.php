<?php

class Model_wilayah extends CI_Model
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
	public function read_kecamatan()
	{
		$query = $this->db->query("select * from sensus_kec ");
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
    public function read_desa_by_kec($KodeKec)
	{
		$query = $this->db->query("select * from sensus_desa where kode_kec=? ",[$KodeKec]);
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
    public function read_sls_by_kec_desa($KodeKec,$KodeDesa)
	{
		$query = $this->db->query("select * from sls where KdKec=? and KdDesa=? ",[$KodeKec,$KodeDesa]);
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
