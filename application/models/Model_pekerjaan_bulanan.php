<?php

class Model_pekerjaan_bulanan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        // $this->load->library('lib');
        // $this->load->library('lib_security');
        $this->load->model('model_pekerjaan_bulanan_pengguna');
        // $this->load->model('email_model');
        //call function
        // Your own constructor code
    }
    public function read_pekerjaan()
    {
        $query = $this->db->query("select a.*,b.Satuan ,c.Nama,d.Status
        from pekerjaan_bulanan a left join satuan b on a.SatuanId=b.RecId
        left join pengguna c on c.RecId=a.CreatedBy
        left join status_penugasan d on d.RecId=a.StatusPenugasanId
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
    public function read_pekerjaan_by_pengguna($inputData)
    {
        $query = $this->db->query("select a.*,b.Satuan ,c.Nama,d.Status
        from pekerjaan_bulanan a left join satuan b on a.SatuanId=b.RecId
        left join pengguna c on c.RecId=a.CreatedBy
        left join status_penugasan d on d.RecId=a.StatusPenugasanId
        where a.CreatedBy=?
		", array($inputData['RecId']));
        $data = array();

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }

    public function read_pekerjaan_by_pengguna_by_tahun_by_bulan($inputData)
    {
        $query = $this->db->query("select a.*,b.Satuan ,c.Nama,d.Status
        from pekerjaan_bulanan a left join satuan b on a.SatuanId=b.RecId
        left join pengguna c on c.RecId=a.CreatedBy
        left join status_penugasan d on d.RecId=a.StatusPenugasanId
        where a.CreatedBy=? and (
                  
                
                (MONTH(a.TanggalMulai)=? and YEAR(a.TanggalMulai)=?)
                
                or 
                
                (MONTH(a.TanggalSelesai)=? and YEAR(a.TanggalSelesai)=?));		", array($inputData['RecId'],  $inputData['Bulan'], $inputData['Tahun'], $inputData['Bulan'], $inputData['Tahun']));
        $data = array();

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }

    public function read_pekerjaan_by_id($dataInput)
    {
        $query = $this->db->query("select a.*,b.Satuan ,c.Nama as NamaPembuat,d.Status
        from pekerjaan_bulanan a left join satuan b on a.SatuanId=b.RecId
        left join pengguna c on c.RecId=a.CreatedBy
        left join status_penugasan d on d.RecId=a.StatusPenugasanId
        where a.RecId=?
		", array($dataInput['RecId']));
        $data = array();

        foreach ($query->result_array() as $row) {
            $tanggalMulaiFormatted = $this->fungsi->ubahFormatTanggal2($row['TanggalMulai']);
            $tanggalSelesaiFormatted = $this->fungsi->ubahFormatTanggal2($row['TanggalSelesai']);
            $row['RangeTanggal'] = $tanggalMulaiFormatted . ' - ' . $tanggalSelesaiFormatted;
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
    public function create_pekerjaan($dataInput)
    {
        date_default_timezone_set('Asia/Jakarta');

        $rangeTanggal = $dataInput['RangeTanggal'];
        $rangeTanggal = str_replace(" ", "", $rangeTanggal);
        $arrTanggal = explode("-", $rangeTanggal);

        $dataInput['TanggalMulai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[0]);
        $dataInput['TanggalSelesai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[1]);

        $dataToSave = array(
            $dataInput['Deskripsi'],
            $dataInput['Volume'],
            $dataInput['SatuanId'],
            date("Y-m-d G:i:s"),
            date("Y-m-d G:i:s"),
            $this->session->userdata('RecId'),
            $dataInput['TanggalMulai'],
            $dataInput['TanggalSelesai']

        );
        $query1 = $this->db->query(
            "insert into pekerjaan_bulanan (Deskripsi,Volume,SatuanId,CreatedDate,ModifiedDate,CreatedBy,TanggalMulai,TanggalSelesai) values (?,?,?,?,?,?,?,?)  ",
            $dataToSave
        );
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            return array(
                'sukses' => true,
                'data' => $dataToSave,
                'insertId' => $this->db->insert_id(),
                'tanggalMulai' => $dataInput['TanggalMulai'],
                'tanggalSelesai' => $dataInput['TanggalSelesai']
            );
        } else
            return array(
                'sukses' => false,
                'data' => $dataToSave
            );
    }
    public function edit_pekerjaan($dataInput)
    {
        date_default_timezone_set('Asia/Jakarta');

        $rangeTanggal = $dataInput['RangeTanggal'];
        $rangeTanggal = str_replace(" ", "", $rangeTanggal);
        $arrTanggal = explode("-", $rangeTanggal);

        $dataInput['TanggalMulai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[0]);
        $dataInput['TanggalSelesai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[1]);

        $dataToSave = array(
            $dataInput['Deskripsi'],
            $dataInput['Volume'],
            $dataInput['SatuanId'],
            date("Y-m-d G:i:s"),
            $this->session->userdata('RecId'),
            $dataInput['TanggalMulai'],
            $dataInput['TanggalSelesai'],
            $dataInput['RecId'],



        );
        $query1 = $this->db->query(
            "update pekerjaan_bulanan set Deskripsi=?,Volume=?,SatuanId=?,ModifiedDate=?,ModifiedBy=?,TanggalMulai=?,TanggalSelesai=? where RecId=? ",
            $dataToSave
        );
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {

            $this->model_pekerjaan_bulanan_pengguna->ubah_tanggal_pekerjaan_pengguna_by_id($dataInput);
            return array(
                'sukses' => true,
                'data' => $dataToSave
            );
        } else
            return array(
                'sukses' => false,
                'data' => $dataToSave
            );
    }
    public function delete_pekerjaan($dataInput)
    {
        $this->db->query(
            "delete from pekerjaan_bulanan_pengguna where PekerjaanId=? ",
            [$dataInput['RecId']]
        );
        $this->db->query(
            "delete from pekerjaan_bulanan where RecId=? ",
            [$dataInput['RecId']]
        );
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            return array(
                'sukses' => true
            );
        } else
            return array(
                'sukses' => false
            );
    }
    public function duplikasi_pekerjaan($dataInput)
    {
        $outputDuplikasiMaster = $this->create_pekerjaan($dataInput);
        $IdPekerjaanBulananOutput = $outputDuplikasiMaster['insertId'];
        $TanggalMulai = $outputDuplikasiMaster['tanggalMulai'];
        $TanggalSelesai = $outputDuplikasiMaster['tanggalSelesai'];

        if ($dataInput['IsPenugasan'] == 1)
            return $this->model_pekerjaan_bulanan_pengguna->duplikasi_pekerjaan_pengguna([
                "IdPekerjaanBulananToDuplikat" => $dataInput['RecId'],
                "IdPekerjaanBulananOutput" => $IdPekerjaanBulananOutput,
                "TanggalMulai" => $TanggalMulai,
                "TanggalSelesai" => $TanggalSelesai
            ]);
        else
            return [
                'sukses' => true,
                'jumlahBarisTerduplikasi' => 0
                // 'data' => $dataInput
            ];
    }
}
