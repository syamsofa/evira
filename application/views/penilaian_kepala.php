<script>
    var IdPenilai = <?php echo $this->session->userdata('RecId');  ?>
    var TahunPekerjaan = null
    var BulanPekerjaan = null
    var TabelNilai = null
</script>

<style>
    table.dataTable td {
        font-size: 1em;
    }

    table.dataTable th {
        font-size: 1em;
    }

    html {
        font-size: 70%;
    }

    .nilaiPegawai {

        width: 50%;
        text-align: right;
    }
</style>

<section class="content">
    <input type="hidden" class="form-control" id="idPenilai" value="<?php echo $this->session->userdata('RecId');  ?>">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">


            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                    <select onchange="loadTabelPengguna()" id="tahunPekerjaan" required class="custom-select">
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
                    <select onchange="loadTabelPengguna()" id="bulanPekerjaan" required class="custom-select">
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

            <button id="buttonTampilPekerjaan" type="button" class="btn btn-success float-left"> <i class="fa fa-desktop" aria-hidden="true"></i> Tampilkan</button>
            <button id="buttonCetakCkpr" type="button" class="btn btn-success float-right">Cetak CKPR</button>
            <button id="buttonCetakCkpt" type="button" class="btn btn-success float-right">Cetak CKPT</button>

        </div>
        <div class="card-body">
            <div class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelPengguna" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tahun-Bulan</th>
                            <th>Nilai Rerata dari Semua Ka Tim</th>
                            <th>Nilai Kepala/Akhir</th>
                            <th>Nilai Kepala/Akhir</th>

                        </tr>

                    </thead>
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                                <input type="text" class="form-control" required id="volumeRealisasi" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal Penyelesaian/Pengiriman </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control tunggalTanggal" id="tanggalRealisasi" value="" />

                            </div>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save change</button>
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
</script>

<script>
    $(document).ready(function() {
        var TabelPekerjaanSaya = $("#TabelPekerjaanSaya").dataTable({
            "responsive": true,
            destroy: true,

            "lengthChange": false,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        })


    })
</script>
<script>
    function tampilPekerjaanBawahan() {
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
            PenerimaPekerjaanId: $("#penggunaId").val(),
            PenilaiId: $("#idPenilai").val(),
            OpsiTampil: $("#opsiTampil").val(),
            PekerjaanId: $("#idPekerjaan").val()

        }
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/read_pekerjaan_pengguna_by_pengguna_tahun_bulan_by_tim_penilai',
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

                        "" + outputDataBaris.Volume + "",
                        "" + outputDataBaris.VolumeRealisasi + "",
                        "" + outputDataBaris.PersentaseRealisasiVolume + "%",

                        "" + outputDataBaris.TanggalSelesaiFormatted + "",
                        "" + outputDataBaris.KalimatSisaHari + "",
                        "" + outputDataBaris.TanggalRealisasiFormatted + "",
                        "" + outputDataBaris.KalimatSelisihRealisasiDanTarget + "",

                        "Rerata: " + outputDataBaris.PenilaianTim.data.Rerata + "<button onclick=bukaModalLihatPenilaianTim(" + i + ")>Lihat</button><input size='3' class='inputNilai form-control' style='text-align: right;' id='pa_" + i + "' onBlur='ubahPenilaianTimPenilai(outputData," + i + ",\"" + outputDataBaris.PenilaianAtasan + "\",this.value)' max=100  type='number' min='0' value=" + outputDataBaris.Nilai + "> "




                    ]);
                } // End For
                $('.inputNilai').on('input', function() {

                    var value = $(this).val();

                    if ((value !== '') && (value.indexOf('.') === -1)) {

                        $(this).val(Math.max(Math.min(value, 100), -100));
                    }
                });
                $('[data-toggle="tooltipLog"]').tooltip()
                $('[data-toggle="tooltipRealisasi"]').tooltip()

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
    }
</script>
<script>
    $("#buttonTampilPekerjaan").click(function() {
        loadTabelPengguna()
    });
</script>

<script>
    $("#buttonCetakCkpr").click(function() {

        if ($("#bulanPekerjaan").val() == '' || $("#tahunPekerjaan").val() == '' || $("#penggunaId").val() == '')
            alert('Mohon pilih tahun dan bulan dulu')
        else
            window.open('<?php echo base_url(); ?>/servicepekerjaanpengguna/cetak_laporan_ckpr?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&PenerimaPekerjaanId=' + $("#penggunaId").val())

    });
</script>

<script>
    $("#buttonCetakCkpt").click(function() {

        if ($("#bulanPekerjaan").val() == '' || $("#tahunPekerjaan").val() == '' || $("#penggunaId").val() == '')
            alert('Mohon pilih tahun dan bulan dulu')
        else
            window.open('<?php echo base_url(); ?>/servicepekerjaanpengguna/cetak_laporan_ckpt?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&PenerimaPekerjaanId=' + $("#penggunaId").val())

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

    function ubahPenilaianTimPenilai(obj, index, praVal, val) {
        Swal.fire({
            title: 'Yakin memberi nilai sebesar itu?',
            showDenyButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {


                data = {
                    RecId: obj[index].RecId,
                    Nilai: val,
                    PraPenilaianAtasan: praVal,
                    IdPenilai: $("#idPenilai").val()
                }
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/update_penilaian_tim_penilai',
                    dataType: 'json',
                    data: data,
                    success: function(output) {
                        Swal.fire('Nilai tersimpan!', '', 'success')
                        tampilPekerjaanBawahan()

                    },

                    error: function(e) {
                        console.log(e.responseText);

                    }
                });


            } else if (result.isDenied) {
                tampilPekerjaanBawahan()
                // Swal.fire('Tidak ada perubahan nilai', '', 'info')
            }
        })
    }
</script>


<script>
    $(function() {
        $('.tunggalTanggal').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
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

        console.log(data)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/update_volume_realisasi_volume_by_id',
            dataType: 'json',
            data: data,
            success: function(output) {
                Swal.fire('Saved!', '', 'success')
                tampilPekerjaanBawahan()
                $("#modalRealisasi").modal('hide')

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
    function bukaModalRealisasi(Obj, i) {
        $("#recIdPekerjaanPenggunaRealisasi").val(Obj[i].RecId)

        $("#deskripsiRealisasi").val(Obj[i].Deskripsi)
        $("#volumeTarget").val(Obj[i].Volume)
        $("#volumePraRealisasi").val(Obj[i].VolumeRealisasi)
        $('#modalRealisasi').modal('show');
        console.log(Obj)

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
    $(document).ready(function() {
        $('.select2').select2()

    });
</script>

<script>
    function bukaModalLihatPenilaianTim(index) {
        $('#modalLihatPenilaianTim').modal('show');
        console.log(outputData[index].PenilaianTim.data)

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
    $("#opsiTampil").change(function() {
        if (this.value == 'darisaya')
            $("#idPekerjaan").prop("disabled", false);

        else
            $("#idPekerjaan").prop("disabled", true);

    })
</script>
<script>
    function tampilPekerjaanPenilai() {

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_pengguna_by_tahun_by_bulan',
            dataType: 'json',
            data: {
                PenggunaId: $("#idPenilai").val(),
                Tahun: $("#tahunPekerjaan").val(),
                Bulan: $("#bulanPekerjaan").val()


            },
            success: function(output) {

                $("#idPekerjaan").empty()
                $("#idPekerjaan").append("<option value=''>Semua Pekerjaan</option>")

                output.data.forEach(element => {
                    // console.log(element)

                    $("#idPekerjaan").append("<option value=" + element.RecId + ">" + element.Deskripsi + "</option>")
                });

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
    }
</script>
<script>
    function cek(element) {
        let nilaiMasukan = parseInt(element.value)
        const rangeNilai = [97, 98, 99]
        if (!rangeNilai.includes(nilaiMasukan)) {
            Alert979899()
            element.value = ''
            $(element).css("background-color", "red");
        } else {

            if (element.value == 99)
                $(element).css("background-color", "#96FF33");
            if (element.value == 98)
                $(element).css("background-color", "#F6FF33");
            if (element.value == 97)
                $(element).css("background-color", "#FFDD33");

        }

        simpanNilai(element)

    }
</script>

<script>
    function simpanNilai(element) {
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepenilaian/simpan_nilai',
            dataType: 'json',
            data: {
                BulanPekerjaan: BulanPekerjaan,
                TahunPekerjaan: TahunPekerjaan,
                IdPenilai: IdPenilai,
                IdDinilai: $(element).attr("IdDinilai"),
                Kolom: $(element).attr("Kolom"),
                Nilai: element.value

            },
            success: function(output) {
                console.log(output)
            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

    }
</script>
<script>
    function loadTabelPengguna() {

        TahunPekerjaan = $("#tahunPekerjaan").val()
        BulanPekerjaan = $("#bulanPekerjaan").val()
        IdPenilai = <?php echo $this->session->userdata('RecId');  ?>

        // console.log(tahunPekerjaan, bulanPekerjaan)
        var TabelPengguna = $("#TabelPengguna").dataTable({
            fixedHeader: {
                header: true,
                footer: true
            },
            "bPaginate": false,
            "responsive": true,
            destroy: true,
            "lengthChange": false,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        })

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepengguna/read_penilaian_kepala',
            dataType: 'json',
            data: {
                BulanPekerjaan: BulanPekerjaan,
                TahunPekerjaan: TahunPekerjaan

            },
            success: function(output) {
                TabelPengguna.fnClearTable();

                outputData = output.data

                TabelNilai=outputData
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    if (outputDataBaris.Bulan != '' && outputDataBaris.Tahun != '') {
                        // let rerata=(parseInt(outputDataBaris.NilaiDariKetuaTim.BebanKerja)+parseInt(outputDataBaris.Nilai.TanggungJawab)+parseInt(outputDataBaris.Nilai.Disiplin)+parseInt(outputDataBaris.Nilai.Profesionalitas)+parseInt(outputDataBaris.Nilai.KualitasKerja))/5
                        TabelPengguna.fnAddData([
                            "" + outputDataBaris.Nama + "",
                            "" + outputDataBaris.Tahun + "-" + outputDataBaris.Bulan,
                            "" + outputDataBaris.NilaiDariKetuaTim.rerata + " <button onclick=''>Lihat Penilaian Semua Ketua Tim</button>",
                            "<input kolom='KualitasKerja'  IdDinilai='" + outputDataBaris.RecId + "' value='' class='nilaiPegawai'  onblur='cek(this)'>",
                            ""

                        ]);
                    }
                } // End For

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

        // new $.fn.dataTable.FixedHeader(TabelPengguna);

    }
</script>
<script>
    // loadTabelPengguna()
</script>
<script>
    $(".nilaiPegawai")
</script>

<script>
    function Alert979899() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Hanya boleh memasukkan 97,98,99'
        })
    }
</script>