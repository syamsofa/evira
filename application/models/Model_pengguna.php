<?php

class Model_pengguna extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('lib');
		// $this->load->library('lib_security');
		$this->load->model('model_role');
		// $this->load->model('email_model');
		//call function
		// Your own constructor code
	}


	public function cek_pengguna($data)
	{
		$query = $this->db->query("select * from pengguna where OpsiLoginId=? and Email=?  ", array($data['OpsiLoginId'], $data['Email']));
		if ($query->num_rows() > 0) {

			$dataPengguna = $query->result_array()[0];
			$dataRolePengguna = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $dataPengguna['RecId']));
			$dataPengguna['RolePengguna'] = $dataRolePengguna;
			return array(
				'sukses' => true,
				'data' => $dataPengguna
			);
		} else
			return array(
				'sukses' => false,
				'data' => null

			);
	}
	public function edit_url_picture($dataInput)
	{
		$this->db->query("update pengguna set UrlPicture=? where RecId=? ", array($dataInput['UrlPicture'], $dataInput['RecId']));

		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows == 1) {
			return array(
				'sukses' => true,
				'data' => $dataInput
			);
		} else
			return array(
				'sukses' => false,
				'data' => $dataInput
			);
	}
	public function create_pengguna($data)
	{
		$this->db->query("insert into  pengguna (OpsiLoginId, Email,Nama,UrlPicture) values (?,?,?,?)  ", array($data['OpsiLoginId'], $data['Email'], $data['Nama'], $data['UrlPicture']));
		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows == 1) {
			$this->db->query("insert into role_pengguna (RoleId, PenggunaId) values (?,?)  ", array(2, $this->db->insert_id()));
			$data['RecId'] = $this->db->insert_id();

			$data['dataRolePengguna'] = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $data['RecId']));

			return array(
				'sukses' => true,
				'data' => $data
			);
		} else
			return array(
				'sukses' => false,
				'data' => $data
			);
	}
	public function read_pengguna_search($search)
	{
		$query = $this->db->query("select * from pengguna where Nama like '%" . $search . "%'");
		$list = [];
		$key = 0;
		foreach ($query->result_array() as $row) {
			$list[$key]['id'] = $row['RecId'];
			$list[$key]['text'] = $row['Nama'];
			$key++;
		}

		return $list;
	}
	public function read_pengguna()
	{
		$query = $this->db->query("select a.*,b.OpsiLogin,c.Nama as NamaSatker,d.Nama as NamaOrganisasi 
		from pengguna a left join opsi_login b on a.OpsiLoginId=b.RecId
		left join satker c on c.RecId=a.SatkerId
		left join organisasi d on d.RecId=a.OrganisasiId
		order by a.Nama
		;
		", array());
		$data = array();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $data
		);
	}
	public function update_pengguna_by_id($dataInput)
	{
		// print_r($dataInput);
		$query = $this->db->query("update pengguna set Nama=?,Jabatan=?,SatkerId=?,OrganisasiId=?,NipLama=?,NipBaru=?,AtasanId=? 
		where RecId=?
		", array($dataInput['Nama'], $dataInput['Jabatan'], $dataInput['SatkerId'], $dataInput['OrganisasiId'], $dataInput['NipLama'], $dataInput['NipBaru'], $dataInput['AtasanId'], $dataInput['RecId']));
		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows == 1) {

			return array(
				'sukses' => true,
				'data' => $dataInput
			);
		} else
			return array(
				'sukses' => false,
				'data' => $dataInput
			);
	}
	public function read_pengguna_by_id($dataInput)
	{
		$query = $this->db->query("select a.*,b.OpsiLogin,c.Nama as NamaSatker,d.Nama as NamaOrganisasi 
		from pengguna a left join opsi_login b on a.OpsiLoginId=b.RecId
		left join satker c on c.RecId=a.SatkerId
		left join organisasi d on d.RecId=a.OrganisasiId
		where a.RecId=?
		", array($dataInput['RecId']));


		$dataOutput = array();

		foreach ($query->result_array() as $row) {

			$row['DataAtasan'] = $this->read_atasan_by_id_pengguna($row);
			$row['DataBawahan'] = $this->read_bawahan_by_id_pengguna($dataInput);
			$row['DataRole'] = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $dataInput['RecId']));
			$dataOutput = $row;
		}

		return array(
			'sukses' => true,
			'data' => $dataOutput
		);
	}
	public function read_bawahan_by_id_pengguna($dataInput)
	{
		$query = $this->db->query("select a.*,b.OpsiLogin,c.Nama as NamaSatker,d.Nama as NamaOrganisasi 
		from pengguna a left join opsi_login b on a.OpsiLoginId=b.RecId
		left join satker c on c.RecId=a.SatkerId
		left join organisasi d on d.RecId=a.OrganisasiId
		where a.AtasanId=?
		", array($dataInput['RecId']));


		$dataOutput = array();

		foreach ($query->result_array() as $row) {

			// $row['DataAtasan']=$this->read_pengguna_by_id($row['AtasanId']);
			$dataOutput[] = $row;
		}

		return array(
			'sukses' => true,
			'data' => $dataOutput
		);
	}

	public function read_atasan_by_id_pengguna($dataInput)
	{
		$RecId = $dataInput['AtasanId'];
		$query = $this->db->query("select a.*,b.OpsiLogin,c.Nama as NamaSatker,d.Nama as NamaOrganisasi 
		from pengguna a left join opsi_login b on a.OpsiLoginId=b.RecId
		left join satker c on c.RecId=a.SatkerId
		left join organisasi d on d.RecId=a.OrganisasiId
		where a.RecId=?
		", array($RecId));


		$dataOutput = array();

		foreach ($query->result_array() as $row) {

			// $row['DataAtasan']=$this->read_pengguna_by_id($row['AtasanId']);
			$dataOutput = $row;
		}

		return array(
			'sukses' => true,
			'data' => $dataOutput
		);
	}

	public function read_role_by_pengguna($dataInput)
	{
		$query = $this->db->query("select a.*,b.Role from role_pengguna a 
		inner join role b 
		on a.RoleId=b.RecId
		
		where a.PenggunaId=?;
		", array($dataInput['RecId']));
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
