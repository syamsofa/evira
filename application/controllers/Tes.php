<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pengguna');
        $this->load->model('model_satker');
        $this->load->model('model_organisasi');
        $this->load->model('model_satuan');
        $this->load->model('model_pekerjaan_bulanan');

        $this->pengguna = $this->model_pengguna->read_pengguna();
        $this->satker = $this->model_satker->read_satker();
        $this->organisasi = $this->model_organisasi->read_organisasi();
        $this->satuan = $this->model_satuan->read_satuan();
        $this->pekerjaan = $this->model_pekerjaan_bulanan->read_pekerjaan();
        // Your own constructor code
    }
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        echo  date("Y-m-d G:i:s");
    }
    public function jebret()
    {
        $query = $this->db->query("select * from pekerjaan_bulanan_pengguna ");

        foreach ($query->result_array() as $dat) {
            // print_r($dat);
            $jum = $this->db->query("select * from penilaian_tim where IdPekerjaanPengguna=? ", [$dat['RecId']])->num_rows();
            if ($jum == 0)
                $this->db->query(
                    "insert into penilaian_tim (IdPenilai,IdPekerjaanPengguna,Nilai) values (?,?,?)  ",
                    [$dat['PemberiPekerjaanId'], $dat['RecId'], 100]
                );
        }
    }
    public function jebretlagi()
    {
        $query = $this->db->query("select a.* from pekerjaan_bulanan_pengguna a
        left join pekerjaan_bulanan b on b.RecId=a.PekerjaanId
        
        where month(b.TanggalMulai)='7' and year(b.TanggalMulai)='2022'; ");

        foreach ($query->result_array() as $dat) {
            // print_r($dat);
            $jum = $this->db->query("select * from penilaian_tim where IdPekerjaanPengguna=? ", [$dat['RecId']])->num_rows();
            if ($jum == 0)
                $this->db->query(
                    "insert into penilaian_tim (IdPenilai,IdPekerjaanPengguna,Nilai) values (?,?,?)  ",
                    [$dat['PemberiPekerjaanId'], $dat['RecId'], 100]
                );
        }
    }
    public function jebretlagi2()
    {
        $query = $this->db->query("select a.* from pekerjaan_bulanan_pengguna a
        left join pekerjaan_bulanan b on b.RecId=a.PekerjaanId
        
        where month(b.TanggalMulai)='7' and year(b.TanggalMulai)='2022'; ");

        foreach ($query->result_array() as $dat) {
            print_r($dat);
            $this->db->query(
                "update penilaian_tim  set Nilai=100 where IdPekerjaanPengguna=? ",
                [$dat['RecId']]
            );
        }
    }
}
