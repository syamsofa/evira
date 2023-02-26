<?php

class Model_mitra extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('lib');
        // $this->load->library('lib_security');
        $this->load->model('model_role');
        $this->load->model('model_penilaian_tim');
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
    public function cek_pengguna_2($data)
    {
        $query = $this->db->query("select * from pengguna where Email=?  ", array($data['Email']));
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
    public function create_mitra($data)
    {
        $this->db->query("insert into  mitra (Nama, Nik,Gender) values (?,?,?)  ", array($data['Nama'], $data['Nik'], $data['Gender']));
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            // $this->db->query("insert into role_pengguna (RoleId, PenggunaId) values (?,?)  ", array(2, $this->db->insert_id()));
            $data['RecId'] = $this->db->insert_id();

            // $data['dataRolePengguna'] = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $data['RecId']));

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
    public function read_mitra_ajax($search)
    {
        $query = $this->db->query("select * from mitra where Nama like '%".$search."%'", array());
        $data = array();

        foreach ($query->result_array() as $row) {
            $data[] = ["id"=>$row['Id'], "text"=>$row['Nama']];
            // $data[] = $row;
        }

        return $data;
        
    }
    public function read_mitra()
    {
        $query = $this->db->query("select * from mitra", array());
        $data = array();

        foreach ($query->result_array() as $row) {
            // $data[] = ["id"=>$row['Id'], "text"=>$row['Nama']];
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
        
    }

    public function read_penilaian_kepala($dataInput)
    {

        $tahun = $dataInput['TahunPekerjaan'];
        $bulan = $dataInput['BulanPekerjaan'];


        $query = $this->db->query("select a.* from pengguna a where a.Email<>'teguhiman@bps.go.id' order by a.Nama;", array());
        $data = array();

        foreach ($query->result_array() as $row) {

            $dataMasukan = [
                "Tahun" => $tahun,
                "Bulan" => $bulan,
                "IdDinilai" => $row['RecId']
            ];
            $row['Tahun'] = $tahun;
            $row['Bulan'] = $bulan;
            $row['NilaiDariKetuaTim'] = $this->model_penilaian_tim->read_nilai_by_id_dinilai_tahun_bulan($dataMasukan);
            $row['NilaiDariKepala'] = $this->model_penilaian_tim->read_nilai_dari_kepala($dataMasukan);

            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
    public function read_pengguna_nilai($dataInput)
    {

        $tahun = $dataInput['TahunPekerjaan'];
        $bulan = $dataInput['BulanPekerjaan'];
        $idPenilai = $dataInput['IdPenilai'];


        $query = $this->db->query("select a.* from pengguna a where a.Email<>'teguhiman@bps.go.id' order by a.Nama;", array());
        $data = array();

        foreach ($query->result_array() as $row) {

            $dataMasukan = [
                "Tahun" => $tahun,
                "Bulan" => $bulan,
                "IdDinilai" => $row['RecId'],
                "IdPenilai" => $idPenilai
            ];
            $row['Tahun'] = $tahun;
            $row['Bulan'] = $bulan;
            $row['Nilai'] = $this->model_penilaian_tim->read_nilai_by_id_dinilai_id_penilai_tahun_bulan($dataMasukan);

            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
    public function update_mitra_by_id($dataInput)
    {
        // print_r($dataInput);
        $query = $this->db->query("update mitra set Nama=?,Nik=?,Gender=? where Id=?
		", array($dataInput['Nama'], $dataInput['Nik'], $dataInput['Gender'], $dataInput['Id']));
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
    public function read_mitra_by_id($dataInput)
    {
        $query = $this->db->query("select * from mitra where Id=?
		", array($dataInput['Id']));


        $dataOutput = array();

        foreach ($query->result_array() as $row) {

            // $row['DataAtasan'] = $this->read_atasan_by_id_pengguna($row);
            // $row['DataBawahan'] = $this->read_bawahan_by_id_pengguna($dataInput);
            // $row['DataRole'] = $this->model_role->read_role_pengguna_by_id_pengguna(array("PenggunaId" => $dataInput['RecId']));
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
