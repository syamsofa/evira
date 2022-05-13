<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    var outputData = null;
</script>
<div id="loaderGif">
    <img src="../aset/image/loader.gif">
</div>
<script>
    $('#loaderGif').hide();
</script>
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">


            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                    <select id="tahunPekerjaan" required class="custom-select">
                        <option value=''>--PILIH--</option>
                        <?php
                        foreach ($tahun['data'] as $rows) {

                        ?>

                            <option value='<?php echo $rows['Tahun']; ?>'><?php echo $rows['Tahun']; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-10">
                    <select id="bulanPekerjaan" required class="custom-select">
                        <option value=''>--PILIH--</option>
                        <?php
                        foreach ($bulan['data'] as $rows) {

                        ?>

                            <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Bulan']; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Pegawai</label>
                <div class="col-sm-10">
                    <select id="idPengguna" required class="select2 custom-select">
                        <option value=''>--PILIH--</option>
                    </select>
                </div>
            </div>
            <button id="buttonTampilPekerjaan" type="button" class="btn btn-success float-left">Tampilkan / Refresh</button>
            <button id="" onclick="unduhRekapLaporan()" type="button" class="btn btn-warning float-right"><i class="fa fa-download" aria-hidden="true"></i> Unduh Data dari Laporan Harian</button>
            <button id="buttonCetakCkpr" type="button" class="btn btn-success float-right">Cetak CKPR</button>
            <button id="buttonCetakCkpt" type="button" class="btn btn-success float-right">Cetak CKPT</button>
        </div>
        <div class="card-body">
            <div class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelPekerjaanSaya" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Pemberi Tugas</th>
                            <th>Satuan</th>
                            <th>Target</th>
                            <th>Realisasi</th>
                            <th>Persentase</th>
                            <th>Batas Waktu</th>
                            <th>Tanggal Penyelesaian/Penyerahan</th>
                            <th>Kepatuhan</th>
                            <th>Penilaian Atasan</th>
                            <th>Aksi</th>


                        </tr>

                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody></tbody>
                </table>

            </div>

        </div>
        <!-- /.card-body -->
    </div>

</section>

<div class="modal fade" id="modalTambahPenugasanPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penugasan Untuk Saya</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="formTambahPenugasanPekerjaan" class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="recId" placeholder="Email">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Volume</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="volumePenugasan" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Untuk Siapa?</label>
                            <div class="col-sm-10">
                                <select id="penerimaPekerjaanId" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <?php
                                    foreach ($pengguna['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Nama']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Pekerjaan?</label>
                            <div class="col-sm-10">

                                <select id="pekerjaanId" onchange="fungsiGetRangeTanggal(this.value)" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <?php
                                    foreach ($pekerjaanByPengguna['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Deskripsi']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Range Tanggal </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rangeTanggal" id="rangeTanggalPenugasan" value="" />

                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <div class="table-responsive card-body p-0" style="display: block;">
                    <table id="TabelPekerjaan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>CreatedBy</th>
                                <th>CreatedDate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalLogPekerjaanBulananPengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log Perubahan Realisasi Volume Pekerjaan</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="card-body p-0" style="display: block;">
                    <strong><i class="fas fa-book mr-1"></i> Deskripsi Pekerjaan</strong>

                    <p id="deskripsiDetail" class="text-muted">
                        TESTES
                    </p>

                    <hr>

                    <strong><i class="fas fa-book mr-1"></i> Volume Awal </strong>

                    <p id="volumeDetail" class="text-muted">
                        TESTES
                    </p>

                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Pemberi Pekerjaan</strong>
                    <p id="namaPemberiPekerjaanDetail" class="text-muted">
                        TESTES
                    </p>
                    <hr>
                    <div class="table-responsive card-body p-0" style="display: block;">

                        <table id="TabelLogPekerjaanBulananPengguna" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Merealisasikan</th>
                                    <th>Realisasi Volume Menjadi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRealisasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realisasikan Volume</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form id="formRealisasi" class="form-horizontal">

                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="recIdPekerjaanPenggunaRealisasi" placeholder="Email">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled id="deskripsiRealisasi" placeholder="Deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Target Volume</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled id="volumeTarget" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Realisasi Volume Sebelumnya</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" disabled id="volumePraRealisasi" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Realisasi Volume</label>
                            <div class="col-sm-10">
                                <input type="text" autocomplete="off" class="form-control" required id="volumeRealisasi" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal Penyelesaian/Pengiriman </label>
                            <div class="col-sm-10">
                                <input type="text" autocomplete="off" class="form-control tunggalTanggal" id="tanggalRealisasi" value="" />

                            </div>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLihatPenilaianTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-text" aria-hidden="true"></i> Lihat Nilai</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="table-responsive card-body p-0" style="display: block;">
                    <table id="TabelPenilaianTim" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Penilai</th>
                                <th>Nilai Yang Diberikan</th>


                            </tr>

                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody></tbody>
                    </table>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<script>
    var penggunaId = '<?php echo $this->session->userdata('RecId') ?>'

    setTimeout(() => {
        console.log(penggunaId)
    }, 1200);
</script>

<script>
    $(document).ready(function() {
        var TabelPekerjaanSaya = $("#TabelPekerjaanSaya").dataTable({
            columns: [{

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                }

            ],
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        })


    })
</script>
<script>
    function tampilPekerjaan() {
        $('#loaderGif').show();
        $('title').text('Pekerjaan_' + $("#tahunPekerjaan").val() + '_bulan_' + $("#bulanPekerjaan").val())
        var TabelPekerjaanSaya = $("#TabelPekerjaanSaya").dataTable({
            columns: [{

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                },
                {

                    className: "text-center"
                }

            ],
            "responsive": true,
            destroy: true,

            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })
        data = {
            Tahun: $("#tahunPekerjaan").val(),
            Bulan: $("#bulanPekerjaan").val(),
            PenerimaPekerjaanId: $("#idPengguna").val()
        }
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/read_pekerjaan_pengguna_by_pengguna_tahun_bulan',
            dataType: 'json',
            data: data,
            success: function(output) {
                console.log(output)
                TabelPekerjaanSaya.fnClearTable();
                outputData = output.data.detail
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]


                    j = i + 1

                    TabelPekerjaanSaya.fnAddData([
                        "" + outputDataBaris.Deskripsi + "",
                        "" + outputDataBaris.NamaPemberiPekerjaan + "",
                        "" + outputDataBaris.Satuan + "",

                        "" + outputDataBaris.Volume + "",
                        "" + outputDataBaris.VolumeRealisasi + "",
                        "" + outputDataBaris.PersentaseRealisasiVolume + "%",

                        "" + outputDataBaris.TanggalSelesaiFormatted + "",
                        // "" + outputDataBaris.KalimatSisaHari + "",
                        "" + outputDataBaris.TanggalRealisasiFormatted + "",
                        "" + outputDataBaris.KalimatSelisihRealisasiDanTarget + "",
                        "" + outputDataBaris.PenilaianTim.data.Rerata + " <button onclick=bukaModalLihatPenilaianTim(" + i + ")>Lihat</button>",


                        "" +
                        ""



                    ]);
                } // End For
                $('#loaderGif').hide();
            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
    }
</script>
<script>
    $("#buttonTampilPekerjaan").click(function() {
        tampilPekerjaan()
    });
</script>

<script>
    $("#buttonCetakCkpr").click(function() {

        if ($("#bulanPekerjaan").val() == '' || $("#tahunPekerjaan").val() == '')
            alert('Mohon pilih tahun dan bulan dulu')
        else
            window.open('<?php echo base_url(); ?>/servicepekerjaanpengguna/cetak_laporan_ckpr?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&PenerimaPekerjaanId=' + $("#idPengguna").val(), )

    });
</script>
<script>
    $("#buttonCetakCkpt").click(function() {
        if ($("#bulanPekerjaan").val() == '' || $("#tahunPekerjaan").val() == '')
            alert('Mohon pilih tahun dan bulan dulu')
        else
            window.open('<?php echo base_url(); ?>/servicepekerjaanpengguna/cetak_laporan_ckpt?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&PenerimaPekerjaanId=' + $("#idPengguna").val(), )

    });
</script>

<script>
    function bukaModalTambahPekerjaanPengguna(RecId) {
        $('#modalTambahPenugasanPekerjaan').modal('show');
    }
</script>


<script type="text/javascript">
    function ubahVolumeRealisasi(obj, index, praVal, val) {
        Swal.fire({
            title: 'Yakin ubah realisasi volume?',
            showDenyButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {


                console.log(obj[index].RecId, index, val)

                data = {
                    RecId: obj[index].RecId,
                    VolumeRealisasi: val,
                    VolumePraRealisasi: praVal

                }
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/update_volume_realisasi_volume_by_id',
                    dataType: 'json',
                    data: data,
                    success: function(output) {
                        Swal.fire('Saved!', '', 'success')


                    },

                    error: function(e) {
                        console.log(e.responseText);
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });


            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    function ubahPenilaianAtasan(obj, index, praVal, val) {
        Swal.fire({
            title: 'Yakin memberi nilai sebesar itu?',
            showDenyButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {


                console.log(obj[index].RecId, index, val)

                data = {
                    RecId: obj[index].RecId,
                    PenilaianAtasan: val,
                    PraPenilaianAtasan: praVal

                }
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/update_penilaian_atasan_by_id',
                    dataType: 'json',
                    data: data,
                    success: function(output) {
                        Swal.fire('Saved!', '', 'success')


                    },

                    error: function(e) {
                        console.log(e.responseText);
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });


            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }
</script>


<script>
    $(function() {
        $('.rangeTanggal').daterangepicker({
            opens: 'left',
            dateFormat: 'YYYY-MM-DD'

        }, function(start, end, label) {
            var tanggalMulai = start.format('YYYY-MM-DD')
            var tanggalSelesai = end.format('YYYY-MM-DD')

            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script>
    $("#formTambahPenugasanPekerjaan").submit(function(e) {
        let PekerjaanId = $('#pekerjaanId').val()
        let PenerimaPekerjaanId = $('#penerimaPekerjaanId').val()
        let Volume = $('#volumePenugasan').val()
        let RangeTanggal = $('#rangeTanggalPenugasan').val()

        $.ajax({


            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/create_pekerjaan_pengguna',
            dataType: 'json',
            data: {
                //     $dataInput['PenerimaPekerjaanId'],
                // $dataInput['PekerjaanId'],
                // $dataInput['Volume'],
                PenerimaPekerjaanId: PenerimaPekerjaanId,
                PekerjaanId: PekerjaanId,
                Volume: Volume,
                RangeTanggal: RangeTanggal
            },
            success: function(output) {
                console.log(output)


            }
        })
        e.preventDefault()

        return false;


    });
</script>


<script>
    function fungsiGetRangeTanggal(RecId) {
        $.ajax({


            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_id',
            dataType: 'json',
            data: {
                //     $dataInput['PenerimaPekerjaanId'],
                // $dataInput['PekerjaanId'],
                // $dataInput['Volume'],

                RecId: RecId
            },
            success: function(output) {
                console.log(output)
                $("#rangeTanggalPenugasan").val(output.data[0]['RangeTanggal'])

            }
        })
    }
</script>

<script>
    function bukaModalLogPekerjaanPengguna(RecId) {
        $('#modalLogPekerjaanBulananPengguna').modal('show');

        var TabelLogPekerjaanBulananPengguna = $("#TabelLogPekerjaanBulananPengguna").dataTable({
            "responsive": true,
            destroy: true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/read_pekerjaan_bulanan_pengguna_by_id',
            data: {
                RecId: RecId
            },
            dataType: 'json',
            success: function(output) {

                data = output['data'];
                $("#deskripsiDetail").html(data['Deskripsi'])
                $("#namaPemberiPekerjaanDetail").html(data['NamaPemberiPekerjaan'])
                $("#volumeDetail").html(data['Volume'])


            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicelogpekerjaanbulananpengguna/read_log_pekerjaan_bulanan_pengguna_by_id_pekerjaan_bulanan_pengguna',
            data: {
                PekerjaanBulananPenggunaId: RecId
            },
            dataType: 'json',
            success: function(output) {

                console.log(output);
                TabelLogPekerjaanBulananPengguna.fnClearTable();
                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]


                    j = i + 1

                    TabelLogPekerjaanBulananPengguna.fnAddData([
                        "" + outputDataBaris.CreatedDate + "",
                        " Realisasi Volume Diubah dari " + outputDataBaris.VolumePraRealisasi + " MenJadi " + outputDataBaris.VolumeRealisasi + ""


                    ]);
                } // End For


            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

    }
</script>

<script>
    function bukaModalRealisasi(Obj, i) {
        $("#recIdPekerjaanPenggunaRealisasi").val(Obj[i].RecId)

        console.log()
        $("#deskripsiRealisasi").val(Obj[i].Deskripsi)
        $("#volumeTarget").val(Obj[i].Volume)
        $("#volumePraRealisasi").val(Obj[i].VolumeRealisasi)
        $('#modalRealisasi').modal('show');
        console.log(Obj)

    }
</script>


<script>
    $(function() {
        $('.tunggalTanggal').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            autoclose: true,
            maxYear: parseInt(moment().format('YYYY'), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');

        });
    });
</script>


<script>
    $("#formRealisasi").submit(function(e) {

        data = {
            RecId: $("#recIdPekerjaanPenggunaRealisasi").val(),
            VolumePraRealisasi: $("#volumePraRealisasi").val(),
            VolumeRealisasi: $("#volumeRealisasi").val(),
            VolumeTarget: $("#volumeTarget").val(),
            TanggalRealisasi: $("#tanggalRealisasi").val()

        }

        // console.log(data)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/update_volume_realisasi_volume_by_id',
            dataType: 'json',
            data: data,
            success: function(output) {
                Swal.fire('Saved!', '', 'success')
                tampilPekerjaan()
                $("#modalRealisasi").modal('hide')
                $("#formRealisasi")[0].reset()

            },

            error: function(e) {
                console.log(e.responseText);
                Swal.fire('Changes are not saved', '', 'info')
            }
        });
        e.preventDefault()

        return false;


    });
</script>

<script>
    $(function() {
        $("#modalRealisasi").draggable();
    });
</script>

<script>
    $.ajax({
        type: "POST",
        async: false,
        url: '<?php echo base_url(); ?>/servicepengguna/read_pengguna',
        dataType: 'json',

        success: function(output) {
            console.log(output.data)

            output.data.forEach(element => {
                $('#idPengguna').append("<option value='" + element.RecId + "'>" + element.Nama + "</option>")

            });

        },

        error: function(e) {
            console.log(e.responseText);

        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2()

    });
</script>

<script>
    function bukaModalLihatPenilaianTim(index) {
        console.log(outputData[index].PenilaianTim.data)
        $('#modalLihatPenilaianTim').modal('show');

        var TabelPenilaianTim = $("#TabelPenilaianTim").dataTable({
            columns: [{

                    className: "text-center"
                },
                {

                    className: "text-center"
                }
            ],
            "paging": false,
            "responsive": true,
            destroy: true,

            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })

        TabelPenilaianTim.fnClearTable();
        let outputDataNilaiPerKegiatan = outputData[index].PenilaianTim.data.Detail;
        for (var i = 0; i < outputDataNilaiPerKegiatan.length; i++) {


            j = i + 1
            outputDataBaris = outputDataNilaiPerKegiatan[i]
            TabelPenilaianTim.fnAddData([
                "" + outputDataBaris.Penilai.data.Nama + "",
                "" + outputDataBaris.Nilai + ""

            ]);
        } // End For

        $('#TabelPenilaianTim_info').text('Nilai Rata-rata = ' + outputData[index].PenilaianTim.data.Rerata)
    }
</script>

<script>
    $("#buttonCetakCkpr").click(function() {

        if ($("#bulanPekerjaan").val() == '' || $("#tahunPekerjaan").val() == '')
            alert('Mohon pilih tahun dan bulan dulu')
        else
            window.open('<?php echo base_url(); ?>/servicepekerjaanpengguna/cetak_laporan_ckpr?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&PenerimaPekerjaanId=' + penggunaId, )

    });
</script>
<script>
    $("#buttonCetakCkpt").click(function() {
        if ($("#bulanPekerjaan").val() == '' || $("#tahunPekerjaan").val() == '')
            alert('Mohon pilih tahun dan bulan dulu')
        else
            window.open('<?php echo base_url(); ?>/servicepekerjaanpengguna/cetak_laporan_ckpt?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&PenerimaPekerjaanId=' + penggunaId, )

    });
</script>

<script>
    function unduhRekapLaporan() {
        window.location.href = '<?php echo base_url(); ?>/servicelaporanharian/eksporlaporansatubulan?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&IdPengguna=' + $("#idPengguna").val()

    }
</script>