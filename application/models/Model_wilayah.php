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
		$query = $this->db->query("select b.nama_kec,c.nama_desa, a.* from sls a
		left join 
		sensus_kec b 
		on a.KdKec=b.kode_kec
		left JOIN
		sensus_desa c 
		on a.KdKec=c.kode_kec and a.KdDesa=c.kode_desa
		where a.KdKec=? and a.KdDesa=?",[$KodeKec,$KodeDesa]);
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
	public function update_data_sls($Id,$Nilai,$Kolom)
	{
		echo $Id.'d ';

		$query = $this->db->query("update sls set ".$Kolom." = ? where Id=?  ",[$Nilai,$Id]);
		// $data = array();


	}
}
