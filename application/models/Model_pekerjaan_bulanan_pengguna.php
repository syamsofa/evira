<?php

class Model_pekerjaan_bulanan_pengguna extends CI_Model
{
    public const kalimatBelumAdaPenyerahan = 'Belum Ada Penyerahan/Penyelesaian';
    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        // $this->load->library('lib_security');
        $this->load->model('model_log_pekerjaan_pengguna');
        $this->load->model('model_pengguna');
        $this->load->model('model_penilaian_tim');
        // $this->load->model('email_model');
        //call function
        // Your own constructor code
    }
    public function read_pekerjaan_pengguna_by_pekerjaan($dataInput)
    {
        $query = $this->db->query("select a.*,CONVERT(a.TanggalMulai, DATE) as TanggalMulaiFormatted,CONVERT(a.TanggalSelesai, DATE) as TanggalSelesaiFormatted, b.Nama as NamaPenerimaPekerjaan  from pekerjaan_bulanan_pengguna a
        left join pengguna b on b.RecId=a.PenerimaPekerjaanId
         where a.PekerjaanId=?
		", array($dataInput['RecId']));
        $data = array();

        $jumlahVolume = 0;
        foreach ($query->result_array() as $row) {
            $row['PemberiTugas'] = $this->model_pengguna->read_pengguna_by_id(array("RecId" => $row['PemberiPekerjaanId']));
            $data[] = $row;
            $jumlahVolume = $jumlahVolume + $row['Volume'];
        }

        return array(
            'sukses' => true,
            'data' => $data,
            'agregat' => ["JumlahVolume" => $jumlahVolume]
        );
    }
    public function read_pekerjaan_pengguna_by_pengguna($dataInput)
    {
        $query = $this->db->query("select a.*,b.Nama as NamaPenerimaPekerjaan,c.Nama as NamaPemberiPekerjaan  ,
        DATE(a.TanggalMulai) as TanggalMulai,DATE(a.TanggalSelesai) as TanggalSelesai,
        d.Deskripsi
         from pekerjaan_bulanan_pengguna a
        left join pengguna b on b.RecId=a.PenerimaPekerjaanId
        left join pengguna c on c.RecId=a.PemberiPekerjaanId
        left join pekerjaan_bulan d on d.RecId=a.PekerjaanId        
         where a.PenerimaPekerjaanId=?
		", array($dataInput['PenerimaPekerjaanId']));
        $data = array();

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }
    public function read_pekerjaan_bulanan_pengguna_by_id($dataInput)
    {
        $query = $this->db->query("select a.*,b.Nama as NamaPenerimaPekerjaan,c.Nama as NamaPemberiPekerjaan  ,
        DATE(a.TanggalMulai) as TanggalMulai,DATE(a.TanggalSelesai) as TanggalSelesai,
        d.Deskripsi
         from pekerjaan_bulanan_pengguna a
        left join pengguna b on b.RecId=a.PenerimaPekerjaanId
        left join pengguna c on c.RecId=a.PemberiPekerjaanId
        left join pekerjaan_bulanan d on d.RecId=a.PekerjaanId        
         where a.RecId=?
		", array($dataInput['RecId']));
        $data = array();

        foreach ($query->result_array() as $row) {
            $data = $row;
        }

        return array(
            'sukses' => true,
            'data' => $data
        );
    }

    public function update_penilaian_tim_penilai($dataInput)
    {
        // print_r($dataInput);
        // print_r($dataInput);
        $this->db->query("update penilaian_tim set Nilai=?  where IdPenilai=? and IdPekerjaanPengguna=?
		", array($dataInput['Nilai'], $dataInput['IdPenilai'], $dataInput['RecId']));


        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            // $this->model_log_pekerjaan_pengguna->create_log_pekerjaan_bulanan_pengguna($dataInput);
            return array(
                'sukses' => true,
                'data' => $dataInput
            );
        } else {

            $this->db->query("insert into penilaian_tim (Nilai,IdPenilai,IdPekerjaanPengguna) values (?,?,?)
            ", array($dataInput['Nilai'], $dataInput['IdPenilai'], $dataInput['RecId']));


            return array(
                'sukses' => false,
                'data' => $dataInput
            );
        }
    }
    public function update_penilaian_atasan_by_id($dataInput)
    {
        // print_r($dataInput);
        // print_r($dataInput);
        $this->db->query("update pekerjaan_bulanan_pengguna set PenilaianAtasan=? where RecId=?
		", array($dataInput['PenilaianAtasan'], $dataInput['RecId']));


        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            // $this->model_log_pekerjaan_pengguna->create_log_pekerjaan_bulanan_pengguna($dataInput);
            return array(
                'sukses' => true,
                'data' => $dataInput
            );
        } else {
            return array(
                'sukses' => false,
                'data' => $dataInput
            );
        }
    }
    public function update_volume_realisasi_volume_by_id($dataInput)
    {


        $this->db->query("update pekerjaan_bulanan_pengguna set VolumeRealisasi=?, TanggalRealisasi=?,ModifiedDate=?,ModifiedBy=? where RecId=?
		", array($dataInput['VolumeRealisasi'], $this->fungsi->ubahFormatTanggal($dataInput['TanggalRealisasi']), "2022-01-12 09:43:43", $this->session->userdata('RecId'), $dataInput['RecId']));

        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            $this->model_log_pekerjaan_pengguna->create_log_pekerjaan_bulanan_pengguna($dataInput);
            return array(
                'sukses' => true,
                'data' => $dataInput
            );
        } else {
            return array(
                'sukses' => false,
                'data' => $dataInput
            );
        }
    }


    public function read_pekerjaan_pengguna_by_pengguna_tahun_bulan_by_tim_penilai($dataInput)
    {

        return   $this->read_pekerjaan_pengguna_by_pengguna_tahun_bulan($dataInput);
    }
    public function read_pekerjaan_pengguna_by_pengguna_tahun_bulan($dataInput)
    {

        $query_tambahan = "";
        $kolom_tambahan = "";
        if (isset($dataInput['PenilaiId'])) {
            $query_tambahan = "left join penilaian_tim f on f.IdPekerjaanPengguna=a.RecId
            and f.IdPenilai=" . $dataInput['PenilaiId'];
            $kolom_tambahan = ", f.Nilai";
        }
        $query = $this->db->query("select a.*,b.Nama as NamaPenerimaPekerjaan,c.Nama as NamaPemberiPekerjaan,
        DATE(a.TanggalMulai) as TanggalMulai,DATE(a.TanggalSelesai) as TanggalSelesai,
        d.Deskripsi,e.Satuan $kolom_tambahan
         from pekerjaan_bulanan_pengguna a
        left join pengguna b on b.RecId=a.PenerimaPekerjaanId
        left join pengguna c on c.RecId=a.PemberiPekerjaanId
        left join pekerjaan_bulanan d on d.RecId=a.PekerjaanId     
        left join satuan e on d.SatuanId=e.RecId   
        
        $query_tambahan
         where a.PenerimaPekerjaanId=?
         and 
(         MONTH(a.TanggalMulai)=?
         or
         MONTH(a.TanggalSelesai)=?
       )
       and YEAR(a.TanggalSelesai)=?;
		", array($dataInput['PenerimaPekerjaanId'], $dataInput['Bulan'], $dataInput['Bulan'], $dataInput['Tahun']));
        $dataPerBaris = array();

        $jumKegiatan = 0;
        $jumPersentaseKetepatanWaktu = 0;

        $jumPersentaseRealisasiVolume = 0;
        $jumPersentasePenilaianAtasan = 0;
        $urut = 0;

        // print_r($query->result_array());

        foreach ($query->result_array() as $row) {

            $row['PenilaianTim'] = $this->model_penilaian_tim->read_nilai_by_id_pekerjaan_pengguna($row['RecId']);;
            $row['SelisihHari'] = (new DateTime($row['TanggalSelesai']))->diff(new DateTime($row['TanggalMulai']))->days + 1;

            $row['SisaHari'] = (new DateTime(date("Y-m-d")))->diff(new DateTime($row['TanggalSelesai']))->format("%r%a");
            if ($row['SisaHari'] < 0)
                $row['KalimatSisaHari'] =  " sudah lewat " . abs($row['SisaHari']) . " hari";

            else
                $row['KalimatSisaHari'] = abs($row['SisaHari']) . " hari lagi";



            if ($row['TanggalRealisasi'] == '0000-00-00 00:00:00' or $row['TanggalRealisasi'] == null) {
                $row['SelisihRealisasiDanTarget'] = 0;
                $row['KalimatSelisihRealisasiDanTarget'] = $this::kalimatBelumAdaPenyerahan;
            } else {
                $row['SelisihRealisasiDanTarget'] = (new DateTime($row['TanggalRealisasi']))->diff(new DateTime($row['TanggalSelesai']))->format("%r%a");

                if ($row['SelisihRealisasiDanTarget'] < 0)
                    $row['KalimatSelisihRealisasiDanTarget'] = "Terlambat " . abs($row['SelisihRealisasiDanTarget']) . " hari";
                else if ($row['SelisihRealisasiDanTarget'] > 0)

                    $row['KalimatSelisihRealisasiDanTarget'] = abs($row['SelisihRealisasiDanTarget']) . " hari lebih cepat";
                else
                    $row['KalimatSelisihRealisasiDanTarget'] = " Tepat waktu";
            }

            if ($row['TanggalRealisasi'] == '0000-00-00 00:00:00' or $row['TanggalRealisasi'] == null)
                $row['TanggalRealisasiFormatted'] = $this::kalimatBelumAdaPenyerahan;
            else
                $row['TanggalRealisasiFormatted'] = date('d F Y', strtotime($row['TanggalRealisasi']));

            $row['TanggalSelesaiFormatted'] = date('d F Y', strtotime($row['TanggalSelesai']));
            $row['PersentaseRealisasiVolume'] = number_format(100 * $row['VolumeRealisasi'] / $row['Volume'], 2);
            // $row['PersentaseKetepatanWaktu'] = $row['SelisihRealisasiDanTarget'];
            // ,
            $urut++;
            $jumKegiatan = $jumKegiatan + 1;
            $jumPersentaseRealisasiVolume = $jumPersentaseRealisasiVolume + $row['PersentaseRealisasiVolume'];
            $jumPersentasePenilaianAtasan = $jumPersentasePenilaianAtasan + $row['PenilaianAtasan'];
            $jumPersentaseKetepatanWaktu = $jumPersentaseKetepatanWaktu + $row['SelisihRealisasiDanTarget'];
            if ($row['PenilaianAtasan'] == 0)
                $row['PenilaianAtasan'] = 'Belum dinilai';


            $dataPerBaris[] = $row;
        }
        if ($urut == 0) {
            $rerataPersentaseRealisasiVolume = 0;
            $rerataPersentasePenilaianAtasan = 0;
            $rerataPersentaseKetepatanWaktu = 0;
        } else {
            $rerataPersentaseRealisasiVolume = number_format($jumPersentaseRealisasiVolume / $urut, 2, ".", "");
            $rerataPersentasePenilaianAtasan = number_format($jumPersentasePenilaianAtasan / $urut, 2, ".", "");
            $rerataPersentaseKetepatanWaktu = number_format($jumPersentaseKetepatanWaktu / $urut, 2, ".", "");
        }

        return array(
            'sukses' => true,
            'data' => array(
                "detail" => $dataPerBaris,
                "ringkasan" => array(
                    "rerataPersentaseRealisasiVolume" => $rerataPersentaseRealisasiVolume,
                    "rerataPersentasePenilaianAtasan" => $rerataPersentasePenilaianAtasan,
                    "rerataPersentaseKetepatanWaktu" => $rerataPersentaseKetepatanWaktu,
                    "rerataPersentaseKinerja" => $rerataPersentaseKetepatanWaktu + $rerataPersentaseRealisasiVolume,
                    "jumKegiatan" => $jumKegiatan
                )
            )
        );
    }
    public function dashboard_kinerja($dataInput)
    {
        $array = [];
        foreach ($this->model_pengguna->read_pengguna()['data'] as $row) {
            $row['Ringkasan'] = $this->read_pekerjaan_pengguna_by_pengguna_tahun_bulan(array("PenerimaPekerjaanId" => $row['RecId'], "Tahun" => $dataInput['Tahun'], "Bulan" => $dataInput['Bulan']))['data']['ringkasan'];

            $array[] = $row;
        }
        return $array;
    }
    public function cek_duplikat_pekerjaan_bulanan_pengguna($dataInput)
    {
        $array = array(
            "PekerjaanId" => $dataInput['PekerjaanId'],
            "PenerimaPekerjaanId" => $dataInput['PenerimaPekerjaanId']
        );
        $query = $this->db->query(
            "select RecId from pekerjaan_bulanan_pengguna where PekerjaanId=? and PenerimaPekerjaanId=?",
            $array

        );


        return array(
            'sukses' => true,
            'data' => ['JumlahRecord' => $query->num_rows()]
        );
    }
    public function create_pekerjaan_pengguna($dataInput)
    {
        date_default_timezone_set('Asia/Jakarta');

        $rangeTanggal = $dataInput['RangeTanggal'];
        $rangeTanggal = str_replace(" ", "", $rangeTanggal);
        $arrTanggal = explode("-", $rangeTanggal);

        $dataInput['TanggalMulai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[0]);
        $dataInput['TanggalSelesai'] = $this->fungsi->ubahFormatTanggal($arrTanggal[1]);
        $dataToSave = array(
            $dataInput['PenerimaPekerjaanId'],
            $this->session->userdata('RecId'),
            $dataInput['PekerjaanId'],
            $dataInput['Volume'],
            date("Y-m-d G:i:s"),
            $this->session->userdata('RecId'),
            $dataInput['TanggalMulai'],
            $dataInput['TanggalSelesai']
        );

        // $cekDuplikat = $this->cek_duplikat_pekerjaan_bulanan_pengguna($dataInput);
        // $cekDuplikat=0;
        // if ($cekDuplikat['data']['JumlahRecord'] == 0) {
        $this->db->query(
            "insert into pekerjaan_bulanan_pengguna (PenerimaPekerjaanId,PemberiPekerjaanId,PekerjaanId,Volume,CreatedDate,CreatedBy,TanggalMulai,TanggalSelesai) values (?,?,?,?,?,?,?,?)  ",
            $dataToSave
        );
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
        // } else
        //     return array(
        //         'sukses' => false,
        //         'data' => ["Pesan" => "Terjadi Duplikat Data. Tidak Tersimpan"]
        //     );
    }

    public function create_pekerjaan_pengguna_2($dataInput)
    {
        date_default_timezone_set('Asia/Jakarta');

        $dataInput['TanggalMulai'] = $dataInput['TanggalMulai'];
        $dataInput['TanggalSelesai'] = $dataInput['TanggalSelesai'];
        $dataToSave = array(
            $dataInput['PenerimaPekerjaanId'],
            $this->session->userdata('RecId'),
            $dataInput['IdPekerjaanBulananOutput'],
            $dataInput['Volume'],
            date("Y-m-d G:i:s"),
            $this->session->userdata('RecId'),
            $dataInput['TanggalMulai'],
            $dataInput['TanggalSelesai']
        );

        // $cekDuplikat = $this->cek_duplikat_pekerjaan_bulanan_pengguna($dataInput);
        // $cekDuplikat=0;
        // if ($cekDuplikat['data']['JumlahRecord'] == 0) {
        $this->db->query(
            "insert into pekerjaan_bulanan_pengguna (PenerimaPekerjaanId,PemberiPekerjaanId,PekerjaanId,Volume,CreatedDate,CreatedBy,TanggalMulai,TanggalSelesai) values (?,?,?,?,?,?,?,?)  ",
            $dataToSave
        );
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows == 1) {
            return array(
                'sukses' => true
                // 'data' => $dataInput
            );
        } else
            return array(
                'sukses' => false
                // 'data' => $dataInput
            );
        // } else
        //     return array(
        //         'sukses' => false,
        //         'data' => ["Pesan" => "Terjadi Duplikat Data. Tidak Tersimpan"]
        //     );
    }

    public function ubah_volume_pekerjaan_pengguna_by_id($dataInput)
    {
        // print_r($dataInput);
        $this->db->query("update pekerjaan_bulanan_pengguna 
     set Volume=?    where RecId=?
		", array($dataInput['Volume'], $dataInput['RecId']));
    }
    public function delete_pekerjaan_pengguna_by_id($dataInput)
    {
        $this->db->query("delete from pekerjaan_bulanan_pengguna 
         where RecId=?
		", array($dataInput['RecId']));
    }


    public function duplikasi_pekerjaan_pengguna($dataInput)
    {
        $IdPekerjaanBulananOutput = $dataInput['IdPekerjaanBulananOutput'];

        $query = $this->db->query("select * from pekerjaan_bulanan_pengguna where PekerjaanId=?
		", array($dataInput['IdPekerjaanBulananToDuplikat']));

        $jumlahBarisTerduplikat = 0;
        foreach ($query->result_array() as $row) {
            $dataInput = $row;
            $dataInput['IdPekerjaanBulananOutput'] = $IdPekerjaanBulananOutput;


            if ($this->create_pekerjaan_pengguna_2($dataInput)['sukses'] == true)
                $jumlahBarisTerduplikat = $jumlahBarisTerduplikat + 1;
        }


        return [
            'sukses' => true,
            'jumlahBarisTerduplikasi' => $jumlahBarisTerduplikat
            // 'data' => $dataInput
        ];


        // $this->db->query("delete from pekerjaan_bulanan_pengguna 
        //  where RecId=?
        // ", array($dataInput['RecId']));
    }
}
