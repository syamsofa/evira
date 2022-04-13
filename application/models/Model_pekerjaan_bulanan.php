<?php

class Model_pekerjaan_bulanan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        // $this->load->library('lib');
        // $this->load->library('lib_security');
        // $this->load->model('role_model');
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
        where a.CreatedBy=?
                and MONTH(a.CreatedDate)=?
                and YEAR(a.CreatedDate)=?		", array($inputData['RecId'], $inputData['Bulan'], $inputData['Tahun']));
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
            $this->session->userdata('RecId'),
            $dataInput['TanggalMulai'],
            $dataInput['TanggalSelesai']

        );
        $query1 = $this->db->query(
            "insert into pekerjaan_bulanan (Deskripsi,Volume,SatuanId,CreatedDate,CreatedBy,TanggalMulai,TanggalSelesai) values (?,?,?,?,?,?,?)  ",
            $dataToSave
        );
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
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
}
