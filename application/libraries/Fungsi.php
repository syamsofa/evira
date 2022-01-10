<?php

class Fungsi
{
    function isFileExcel($ekstensi)
    {
        $ekstensiIzin = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
        // in_array()
        return in_array($ekstensi, $ekstensiIzin);
    }
    function isFileAllowed($ekstensi)
    {
        $ekstensiIzin = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.oasis.opendocument.spreadsheet"];
        // in_array()
        return in_array($ekstensi, $ekstensiIzin);
    }

    function ubahFormatTanggal($tanggal)
    {
        $arrTanggal = explode("/", $tanggal);
        return $arrTanggal[2] . '-' . $arrTanggal[0] . '-' . $arrTanggal[1];
    }

    function ubahFormatTanggal2($tanggal)
    {
        $arrTanggal = explode("-", $tanggal);
        return $arrTanggal[1] . '/' . $arrTanggal[2] . '/' . $arrTanggal[0];
    }

    function bulanByNo($no)
    {
        $arr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $arr[$no - 1];
    }

    function daftarTanggalByBulanByTahun($tahun, $bulan)
    {
        $list = array();
        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $bulan, $d, $tahun);
            if (date('m', $time) == $bulan)
                $list[] = ["Tanggal" => date('Y-m-d', $time)];
        }
        return $list;
    }
}
