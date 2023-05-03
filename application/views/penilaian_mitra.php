<script>
    var IdPenilai = <?php echo $this->session->userdata('RecId');  ?>
    var IdPekerjaan = null
    var TahunPekerjaan = null
    var BulanPekerjaan = null
</script>
<script>
    var templateOptionPenilaian = "<input type='radio' id='oksigensi' name='fav_language' value='100'>" +
        "<label for='html'>Di Atas Ekspektasi</label><br>" +
        "<input type='radio' id='oksigensi' name='fav_language' value='99'>" +
        "<label for='css'>Sesuai Ekspektasi</label><br>" +
        "<input type='radio' id='oksigensi' name='fav_language' value='98'>" +
        "<label for='javascript'>Di Bawah Ekspektasi</label><br>" +
        "<input type='radio' id='oksigensi' name='fav_language' value='0'>" +
        "<label for='javascript'>Tidak Relevan</label>"
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
                <label for="" class="col-sm-2 col-form-label">Seksi/Fungsi</label>
                <div class="col-sm-10">
                    <select onchange="getRo(this.value)" id="seksi" required class="custom-select">
                        <option value=''>--PILIH--</option>
                        <?php
                        foreach ($seksi['data'] as $rows) {

                        ?>

                            <option value='<?php echo $rows['Seksi']; ?>'><?php echo $rows['Seksi']; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Output</label>
                <div class="col-sm-10">
                    <select id="kodeRo" onchange="getPekerjaan()" required class="custom-select">
                        <option value=''>--PILIH--</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <select id="pekerjaanId" onchange="setPekerjaanId(this.value)" required class="custom-select">
                        <option value=''>--PILIH--</option>
                    </select>
                </div>
            </div>
            <button id="buttonTampilPekerjaan" type="button" class="btn btn-success float-left"> <i class="fa fa-desktop" aria-hidden="true"></i> REFRESH DATA</button>
            
        </div>
        <div class="card-body">
            <div class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelPengguna" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2">Nama Mitra</th>
                            <th colspan="5">Unsur Penilaian</th>

                        </tr>
                        <tr>
                            <th>Ketepatan Waktu</th>
                            <th>Ketelitian</th>
                            <th>Kualitas Hasil</th>
                            <th>Kerjasama </th>
                            <th>Loyalitas</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>

        </div>
        <!-- /.card-body -->
    </div>

</section>


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
        const rangeNilai = [0, 98, 99, 100]
        if (!rangeNilai.includes(nilaiMasukan)) {
            Alert979899()
            element.value = ''
            $(element).css("background-color", "red");
        } else {

            if (element.value == 100)
                $(element).css("background-color", "#96FF33");
            if (element.value == 99)
                $(element).css("background-color", "#F6FF33");
            if (element.value == 98)
                $(element).css("background-color", "#FFDD33");

        }

        simpanNilai(element)

    }
</script>

<script>
    function simpanNilai(element) {
        console.log($(element).attr("IdDinilai"), $(element).attr("Kolom"), element.value)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepenilaian/simpan_nilai_mitra',
            dataType: 'json',
            data: {
                IdPekerjaan: IdPekerjaan,
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
            url: '<?php echo base_url(); ?>/servicepengguna/read_pengguna_mitra_nilai',
            dataType: 'json',
            data: {
                IdPekerjaan: IdPekerjaan,
                IdPenilai: ''

            },
            success: function(output) {
                TabelPengguna.fnClearTable();

                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    if (outputDataBaris.Bulan != '' && outputDataBaris.Tahun != '') {
                        let rerata = (parseInt(outputDataBaris.Nilai.BebanKerja) + parseInt(outputDataBaris.Nilai.TanggungJawab) + parseInt(outputDataBaris.Nilai.Disiplin) + parseInt(outputDataBaris.Nilai.Profesionalitas) + parseInt(outputDataBaris.Nilai.KualitasKerja)) / 5
                        TabelPengguna.fnAddData([
                            "" + outputDataBaris.Nama + "",

                            "<select kolom='KetepatanWaktu' IdDinilai='" + outputDataBaris.IdDinilai + "'  onblur='cek(this)'><option>--Pilih--</option><option value=100>Di Atas Ekspektasi</option><option value=99>Sesuai Ekspektasi</option><option value=98>Di Bawah Ekspektasi</option><option value=0>Tidak Relevan</option></select>",

                            "<select kolom='Ketelitian' IdDinilai='" + outputDataBaris.IdDinilai + "'  onblur='cek(this)'><option>--Pilih--</option><option value=100>Di Atas Ekspektasi</option><option value=99>Sesuai Ekspektasi</option><option value=98>Di Bawah Ekspektasi</option><option value=0>Tidak Relevan</option></select>",

                            "<select kolom='KualitasHasil' IdDinilai='" + outputDataBaris.IdDinilai + "'  onblur='cek(this)'><option>--Pilih--</option><option value=100>Di Atas Ekspektasi</option><option value=99>Sesuai Ekspektasi</option><option value=98>Di Bawah Ekspektasi</option><option value=0>Tidak Relevan</option></select>",

                            "<select kolom='Kerjasama' IdDinilai='" + outputDataBaris.IdDinilai + "'  onblur='cek(this)'><option>--Pilih--</option><option value=100>Di Atas Ekspektasi</option><option value=99>Sesuai Ekspektasi</option><option value=98>Di Bawah Ekspektasi</option><option value=0>Tidak Relevan</option></select>",


                            "<select kolom='Loyalitas' IdDinilai='" + outputDataBaris.IdDinilai + "'  onblur='cek(this)'><option>--Pilih--</option><option value=100>Di Atas Ekspektasi</option><option value=99>Sesuai Ekspektasi</option><option value=98>Di Bawah Ekspektasi</option><option value=0>Tidak Relevan</option></select>",



                        ]);

                        $("select[kolom='KetepatanWaktu'][IdDinilai=" + outputDataBaris.IdDinilai + "]").val(outputDataBaris.Nilai.KetepatanWaktu)
                        $("select[kolom='Ketelitian'][IdDinilai=" + outputDataBaris.IdDinilai + "]").val(outputDataBaris.Nilai.Ketelitian)
                        $("select[kolom='KualitasHasil'][IdDinilai=" + outputDataBaris.IdDinilai + "]").val(outputDataBaris.Nilai.KualitasHasil)
                        $("select[kolom='Kerjasama'][IdDinilai=" + outputDataBaris.IdDinilai + "]").val(outputDataBaris.Nilai.Kerjasama)
                        $("select[kolom='Loyalitas'][IdDinilai=" + outputDataBaris.IdDinilai + "]").val(outputDataBaris.Nilai.Loyalitas)
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
            title: 'Hanya boleh memasukkan 0,98,99,100'
        })
    }
</script>

<script>
    function getRo(val) {
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicero/read_ro_by_seksi',
            dataType: 'json',
            data: {
                Seksi: val

            },
            success: function(output) {

                console.log(output);
                $("#kodeRo").empty()
                $("#kodeRo").append("<option>--Pilih Output--</option>")
                output.data.forEach(element => {
                    $("#kodeRo").append("<option value=" + element.Kode + ">" + element.Kode + " " + element.Ro + "</option>")

                });

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

    }
</script>
<script>
    function getPekerjaan(val) {
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_tahun_by_bulan_by_ro',
            dataType: 'json',
            data: {
                Tahun: $("#tahunPekerjaan").val(),
                Bulan: $("#bulanPekerjaan").val(),
                KodeRo: $("#kodeRo").val()


            },
            success: function(output) {

                console.log(output);
                $("#pekerjaanId").empty()
                $("#pekerjaanId").append("<option>--Pilih Output--</option>")
                output.data.forEach(element => {
                    $("#pekerjaanId").append("<option value=" + element.RecId + ">" + element.RecId + " " + element.Deskripsi + "</option>")

                });

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

    }
</script>
<script>
    function setPekerjaanId(val) {
        IdPekerjaan = val
    }
</script>