<?php

class Model_ro extends CI_Model
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
	public function read_ro_by_kode($Seksi)
	{
		$query = $this->db->query("select * from ro where Kode=?", [$Seksi]);
		$data = array();

		foreach ($query->result_array() as $row) {
			$row['PaguRevisiFormatted'] = number_format($row['PaguRevisi'], 0, ",", ".");
			$row['RealisasiFormatted'] = number_format($row['Realisasi'], 0, ",", ".");
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}

	public function read_ro()
	{
		$query = $this->db->query("select * from ro");
		$data = array();

		foreach ($query->result_array() as $row) {

			$row['PaguRevisiFormatted'] = number_format($row['PaguRevisi'], 0, ",", ".");
			$row['RealisasiFormatted'] = number_format($row['Realisasi'], 0, ",", ".");
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
	public function update_realisasi_ro($input)
	{
		$query = $this->db->query("update ro set PaguRevisi=?, Realisasi=? where Kode=?", [$input['PaguRevisi'], $input['Realisasi'], $input['KodeRo']]);
	}
	public function read_ro_by_seksi($Seksi)
	{
		$query = $this->db->query("select * from ro where Seksi=?", [$Seksi]);
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
	public function read_seksi()
	{
		$query = $this->db->query("SELECT DISTINCT(Seksi) FROM ro;");
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
