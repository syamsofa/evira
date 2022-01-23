<?php

class Model_laporan_harian extends CI_Model
{
    public $uploadDir = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
    }
    public function read_laporan_harian_by_pengguna_tahun_bulan($dataInput)
    {
        $data = $this->fungsi->daftarTanggalByBulanByTahun($dataInput['Tahun'], $dataInput['Bulan']);
        $dataLengkap = [];
        foreach ($data as $dataPerTanggal) {

            $dataPerTanggal['IdPengguna'] = $dataInput['IdPengguna'];
            $dataPerTanggal['Upload'] = $this->read_laporan_harian_per_tanggal_pengguna(["IdPengguna" => $dataInput['IdPengguna'], "Tanggal" => $dataPerTanggal['Tanggal']]);
            $dataLengkap[] = $dataPerTanggal;
        }
        return array(
            'sukses' => true,
            'data' => $dataLengkap
        );
    }
    public function create_laporan_harian($dataInput)
    {
        // print_r($this->cek_laporan_harian($dataInput));
        if ($this->cek_laporan_harian($dataInput) > 0) {
            $this->db->query(
                "update laporan_harian set NamaFile=?,JenisKehadiran=?,Ekstensi=?,Base64=?,CreatedDate=? where Tanggal=? and IdPengguna=? ",
                [$dataInput['NamaFile'], $dataInput['JenisKehadiran'], $dataInput['Ekstensi'], $dataInput['Base64'],$dataInput['CreatedDate'], $dataInput['Tanggal'], $dataInput['Pengguna']['IdPengguna']]
            );
            return array(
                'sukses' => true,
                'pesan' => 'Berhasil Update Laporan'
            );
        } else {

            $this->db->query(
                "insert into laporan_harian (Tanggal,NamaFile,CreatedDate,JenisKehadiran,IdPengguna,CreatedBy,Ekstensi,Base64) values (?,?,?,?,?,?,?,?)  ",
                [
                    $dataInput['Tanggal'], $dataInput['NamaFile'], $dataInput['CreatedDate'], $dataInput['JenisKehadiran'], $dataInput['Pengguna']['IdPengguna'], $dataInput['CreatedBy'], $dataInput['Ekstensi'], $dataInput['Base64']
                ]
            );
            $afftectedRows = $this->db->affected_rows();
            if ($afftectedRows == 1) {
                return array(
                    'sukses' => true,
                    'pesan' => 'Berhasil insert Laporan'
                );
            } else
                return array(
                    'sukses' => false,
                    'pesan' => 'Gagal insert Laporan'
                );
        }
    }
    public function cek_laporan_harian($dataInput)
    {

        return
            $this->db->query(
                "select * from laporan_harian where Tanggal=? and IdPengguna=? ",
                [$dataInput['Tanggal'], $dataInput['Pengguna']['IdPengguna']]
            )->num_rows();
    }
    public function read_laporan_harian_per_tanggal_pengguna($dataInput)
    {

        $dataLap = null;
        $query = $this->db->query(
            "select RecId,CreatedDate,NamaFile,Ekstensi,JenisKehadiran,CONCAT('" . base_url() . "','" . $this->uploadDir . "',NamaFile) as Tautan from laporan_harian where Tanggal=? and IdPengguna=? ",
            [$dataInput['Tanggal'], $dataInput['IdPengguna']]
        );

        if ($query->result_array())
            $dataLap = $query->result_array()[0];


        return ["JumUpload" => $query->num_rows(), "Data" => $dataLap];
    }
    function read_rekap_laporan($dataInput)
    {
        $rangeTanggal = $dataInput['RangeTanggal'];
        $rangeTanggal = str_replace(" ", "", $rangeTanggal);
        $arrTanggal = explode("-", $rangeTanggal);

        $dataInput['TanggalMulai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[0]);
        $dataInput['TanggalSelesai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[1]);

        // print_r($dataInput);

        $arrayPegawai = $this->model_pengguna->read_pengguna()['data'];

        $outputArray = [];
        foreach ($arrayPegawai as $barisPegawai) {

            $begin = new DateTime($this->fungsi->ubahFormatTanggal($arrTanggal[0]));
            $end   = new DateTime($this->fungsi->ubahFormatTanggal($arrTanggal[1]));

            $barisDataLaporan = [];
            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                // echo $i->format("Y-m-d");

                $set = ["Tanggal" => $i->format("Y-m-d"), "Data" => $this->read_laporan_harian_per_tanggal_pengguna(["Tanggal" => $i->format("Y-m-d"), "IdPengguna" => $barisPegawai['RecId']])];
                $barisDataLaporan[] = $set;
            }
            $barisPegawai['DataLaporan'] = $barisDataLaporan;
            $outputArray[] = $barisPegawai;
        }
        return $outputArray;
    }
    function hapushtmllaporanharian($dataInput)
    {

        $fileToDelete = $dataInput["UploadDir"] . $dataInput["NamaFile"];

        if (file_exists($fileToDelete)) {

            if (!unlink($fileToDelete)) {
                return ["sukses" => false, "pesan" => "Tidak berhasil Hapus File"];
            } else {
                $this->db->query(
                    "delete from laporan_harian where NamaFile=? ",
                    [$dataInput["NamaFile"]]
                );
                if ($this->db->affected_rows() > 0)
                    return ["sukses" => true, "pesan" => "Berhasil Hapus File dan Berhasil Mengubah Database"];
                else
                    return ["sukses" => true, "pesan" => "Berhasil Hapus File Tapi Tidak Berhasil Mengubah Database"];
            }
        } else {

            $this->db->query(
                "delete from laporan_harian where NamaFile=? ",
                [$dataInput["NamaFile"]]
            );
            if ($this->db->affected_rows() > 0)
                return ["sukses" => true, "pesan" => "Berhasil Mengubah Database"];
            else
                return ["sukses" => true, "pesan" => "Tidak Berhasil Mengubah Database"];

        }
    }
}
