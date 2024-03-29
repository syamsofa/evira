<script>
    var globalVolumeTotal = 0;
    var globalVolumeTotalDinamis = 0;
</script>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="card">

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tahun Kegiatan</label>
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
                            <label for="" class="col-sm-2 col-form-label">Bulan Kegiatan</label>
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
                            <label for="" class="col-sm-2 col-form-label">RO/Output</label>
                            <div class="col-sm-10">
                                <select id="kodeRo" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                </select>
                            </div>
                        </div>
                        <button id="buttonTampilPekerjaan" type="button" class="btn btn-success float-left" onclick="loadTabelPekerjaan()">Tampilkan / Refresh</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive card-body p-0" style="display: block;">
                            <table id="TabelRealisasiOutput" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Output</th>
                                        <th>Pagu Revisi</th>
                                        <th>Realisasi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                        <div class="table-responsive card-body p-0" style="display: block;">
                            <table id="TabelPekerjaan" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <th>Volume Satuan</th>
                                        <th>Batas Pekerjaan</th>
                                        <th>Dibuat oleh</th>
                                        <th>Lihat Detail</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalEditPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEditPekerjaan" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <input type="hidden" class="form-control" id="recIdEdit" placeholder="Email">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="deskripsiEdit" placeholder="Deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Volume</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="volumeEdit" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rangeTanggal" id="rangeTanggalEdit" value="" />

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select id="satuanIdEdit" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <?php
                                    foreach ($satuan['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Satuan']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
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
<div class="modal fade" id="modalDuplikasiPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formDuplikasiPekerjaan" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Duplikasi Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Silahkan lakukan penyesuaian/modifikasi untuk hasil data duplikasinya
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="recIdDup" placeholder="Email">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="deskripsiDup" placeholder="Deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Volume</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="volumeDup" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rangeTanggal" id="rangeTanggalDup" value="" />

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select id="satuanIdDup" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <?php
                                    foreach ($satuan['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Satuan']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Apakah Penugasannya Juga Diduplikasi?</label>
                            <div class="col-sm-10">
                                <select id="isPenugasanDup" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <option value='1'>Iya</option>
                                    <option value='0'>Tidak</option>

                                </select>
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
<div class="modal fade" id="modalTambahPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formTambahPekerjaan" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="deskripsi" placeholder="Deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Volume</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="volume" placeholder="Volume">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rangeTanggal" id="rangeTanggal" value="" />

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select id="satuanId" required class="select2 custom-select">
                                    <option value=''>--PILIH--</option>
                                    <?php
                                    foreach ($satuan['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Satuan']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPenugasanPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 id="namaPekerjaanDetail" class="card-title">Detail Pekerjaan</h3>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <strong><i class="fas fa-book mr-1"></i> Volume dan Satuan</strong>

                        <p id="satuanPekerjaanDetail" class="text-muted">
                            TESTES
                        </p>

                        <div class="table-responsive card-body p-0" style="display: block;">

                            <table id="TabelPekerjaanSaya" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <th>Nama Penerima Tugas</th>
                                        <th>Satuan</th>
                                        <th>Target</th>
                                        <th>Realisasi</th>
                                        <th>Batas Waktu</th>
                                        <th>Tanggal Penyelesaian/Penyerahan</th>
                                        <th>Kepatuhan</th>
                                        <th>Kuantitas (%)</th>
                                        <th>Kualitas (%)</th>
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


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function loadSelectPekerjaan() {
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_pengguna',
            dataType: 'json',
            data: {
                PenggunaId: <?php echo $this->session->userdata('RecId'); ?>

            },
            success: function(output) {

                console.log(output);
                $("#pekerjaanId").empty()
                $('#pekerjaanId').append(`<option value="">
                                       --Pilih--
                                  </option>`);

                output.data.forEach(element => {
                    console.log(element)
                    $('#pekerjaanId').append(`<option value="${element.RecId}">
                                       ${element.Deskripsi}
                                  </option>`);
                });

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

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
    function loadTabelPenugasanPekerjaan(RecId) {

        var TabelPekerjaanSaya = $("#TabelPekerjaanSaya").dataTable({
            columns: [{

                    className: "text-center"
                },
                {

                    className: "text-center"
                }, {

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
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/read_pekerjaan_pengguna_by_id_kegiatan',
            dataType: 'json',
            data: {
                RecId: RecId,
                Tahun: $("#tahunPekerjaan").val(),
                Bulan: $("#bulanPekerjaan").val()


            },
            success: function(output) {

                TabelPekerjaanSaya.fnClearTable();
                outputData = output.data.detail
                for (var i = 0; i < outputData.length; i++) {

                    console.log("GEGEGEG")

                    console.log(outputData[i])
                    console.log("GEGEGEG")
                    outputDataBaris = outputData[i]


                    j = i + 1

                    TabelPekerjaanSaya.fnAddData([
                        "" + outputDataBaris.Deskripsi + "",
                        "" + outputDataBaris.NamaPenerimaPekerjaan + "",
                        "" + outputDataBaris.Satuan + "",
                        "" + outputDataBaris.Volume + "",


                        "" + outputDataBaris.VolumeRealisasi + "",

                        "" + outputDataBaris.TanggalSelesaiFormatted + "",
                        // "" + outputDataBaris.KalimatSisaHari + "",
                        "" + outputDataBaris.TanggalRealisasiFormatted + "",
                        "" + outputDataBaris.KalimatSelisihRealisasiDanTarget + "",
                        // "" + outputDataBaris.PenilaianTim.data.Rerata + " <button onclick=bukaModalLihatPenilaianTim(" + i + ")>Lihat</button>",
                        "" + outputDataBaris.PersentaseRealisasiVolume + " ",
                        " ",

                        "<button type='button' onclick='bukaModalRealisasi(outputData," + i + ")' class='btn btn-primary  btn-sm'>Realisasi </button>"



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
    function ubahVolumePenugasan(value, baris, pekerjaanId) {
        // console.log(value, baris)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/Servicepekerjaanpengguna/ubah_volume_pekerjaan_pengguna_by_id',
            data: {
                Volume: value,
                RecId: baris
            },
            dataType: 'json',
            success: function(output) {
                loadTabelPenugasanPekerjaan(pekerjaanId)



            },

            error: function(e) {
                console.log(e.responseText);

            }
        });



    }
</script>
<script>
    function ubahVolumeRealisasi(value, baris, pekerjaanId) {
        // console.log(value, baris)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/Servicepekerjaanpengguna/ubah_volume_realisasi_pekerjaan_pengguna_by_id',
            data: {
                Volume: value,
                RecId: baris
            },
            dataType: 'json',
            success: function(output) {
                loadTabelPenugasanPekerjaan(pekerjaanId)



            },

            error: function(e) {
                console.log(e.responseText);

            }
        });



    }
</script>

<script>
    function bukaModalPenugasanPekerjaan(RecId, VolumeTotal) {

        globalVolumeTotal = VolumeTotal;

        $('#modalPenugasanPekerjaan').modal('show');
        loadTabelPenugasanPekerjaan(RecId)


        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_id',
            data: {
                RecId: RecId
            },
            dataType: 'json',
            success: function(output) {

                console.log(output);
                data = output.data[0]
                $("#namaPekerjaanDetail").html("Detail Pekerjaan : " + data['Deskripsi'])
                $("#satuanPekerjaanDetail").html(data['Volume'] + ' ' + data['Satuan'])

                globalVolumeTotal = data['Volume']
                $("#pekerjaanId").val(data['RecId'])
                $("#rangeTanggalPenugasan").val(data['RangeTanggal'])


            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

    }

    function bukaModalEditPenugasanPekerjaan(RecId) {

        $('#modalEditPenugasan').modal('show');

    }
</script>
<script>
    function bukaModalEditPekerjaan(RecId) {
        $('#modalEditPekerjaan').modal('show');

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_id',
            data: {
                RecId: RecId
            },
            dataType: 'json',
            success: function(output) {

                data = output.data[0]
                console.log(data);

                $("#recIdEdit").val(data.RecId)
                $("#satuanIdEdit").val(data.SatuanId)
                $("#deskripsiEdit").val(data.Deskripsi)
                $("#volumeEdit").val(data.Volume)
                $("#rangeTanggalEdit").val(data.RangeTanggal)

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
        // loadTabelPenugasanPekerjaan(RecId)

    }
</script>
<script>
    function bukaModalDuplikasiPekerjaan(RecId) {
        $('#modalDuplikasiPekerjaan').modal('show');

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_id',
            data: {
                RecId: RecId
            },
            dataType: 'json',
            success: function(output) {

                data = output.data[0]
                console.log(data);

                $("#recIdDup").val(data.RecId)
                $("#satuanIdDup").val(data.SatuanId)
                $("#deskripsiDup").val(data.Deskripsi)
                $("#volumeDup").val(data.Volume)
                $("#rangeTanggalDup").val(data.RangeTanggal)

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
        // loadTabelPenugasanPekerjaan(RecId)

    }
</script>
<script>
    function loadTabelPekerjaan() {
        var TabelPekerjaan = $("#TabelPekerjaan").dataTable({
            destroy: true,
            "lengthChange": true,
            "bPaginate": true,
            fixedHeader: {
                header: true,
                footer: true
            },
            columns: [{

                    className: "text-left"
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



            // dom: 'Bfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ]
        });
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_tahun_by_bulan_by_ro',
            dataType: 'json',
            data: {
                PenggunaId: <?php echo $this->session->userdata('RecId'); ?>,
                Tahun: $("#tahunPekerjaan").val(),
                Bulan: $("#bulanPekerjaan").val(),
                KodeRo: $("#kodeRo").val()


            },
            success: function(output) {
                TabelPekerjaan.fnClearTable();

                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    TabelPekerjaan.fnAddData([
                        "" + outputDataBaris.Deskripsi + "",
                        "" + outputDataBaris.Volume +
                        " " + outputDataBaris.Satuan + "",
                        " " + outputDataBaris.TanggalSelesaiFormatted + "",
                        "" + outputDataBaris.Nama + "",
                        "<button title='Detail' type='button' onclick='bukaModalPenugasanPekerjaan(RecId=" + outputDataBaris.RecId + ",VolumeTotal=" + outputDataBaris.Volume + ")' class='btn btn-primary fa fa-tasks'>"

                    ]);
                } // End For

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

        var TabelRealisasiOutput = $("#TabelRealisasiOutput").dataTable({
            destroy: true,
            "lengthChange": true,
            "bPaginate": true,
            fixedHeader: {
                header: true,
                footer: true
            },
            columns: [{

                    className: "text-left"
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

        });
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicero/read_ro_by_kode',
            dataType: 'json',
            data: {
                KodeRo: $("#kodeRo").val()
            },
            success: function(output) {
                TabelRealisasiOutput.fnClearTable();

                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    TabelRealisasiOutput.fnAddData([
                        "" + outputDataBaris.Kode + "",
                        "" + outputDataBaris.Ro + "",
                        " " + outputDataBaris.PaguRevisiFormatted + "",
                        " " + outputDataBaris.RealisasiFormatted + ""

                    ]);
                } // End For

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });

    }
    $(document).ready(function() {




        $("#formDuplikasiPekerjaan").submit(function(e) {

            console.log('proses')
            $.ajax({
                type: "POST",
                async: false,
                url: '<?php echo base_url(); ?>/servicepekerjaan/duplikasi_pekerjaan',
                dataType: 'json',
                data: {
                    Deskripsi: $('#deskripsiDup').val(),
                    SatuanId: $('#satuanIdDup').val(),
                    Volume: $('#volumeDup').val(),
                    RangeTanggal: $('#rangeTanggalDup').val(),
                    RecId: $('#recIdDup').val(),
                    IsPenugasan: $('#isPenugasanDup').val()

                    // TanggalMulai:tanggalMulai,
                    // TanggalSelesai:tanggalSelesai
                },
                success: function(output) {
                    console.log(output)
                    loadTabelPekerjaan()
                    if (output.sukses == true) {
                        formDuplikasiPekerjaan.reset()
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Master pekerjaan berhasil dibuat, Data penugasan yang Terduplikasi sebanyak ' + output.jumlahBarisTerduplikasi,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#modalDuplikasiPekerjaan').modal('hide');


                    } else
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Gagal lakukan duplikasi',
                            showConfirmButton: false,
                            timer: 1500
                        })


                }
            })
            e.preventDefault()

            return false;


        });




        $("#formTambahPekerjaan").submit(function(e) {
            $.ajax({
                type: "POST",
                async: false,
                url: '<?php echo base_url(); ?>/servicepekerjaan/create_pekerjaan',
                dataType: 'json',
                data: {
                    Deskripsi: $('#deskripsi').val(),
                    SatuanId: $('#satuanId').val(),
                    Volume: $('#volume').val(),
                    RangeTanggal: $('#rangeTanggal').val()

                },
                success: function(output) {
                    console.log(output)
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data tersimpan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modalTambahPekerjaan").modal("hide")
                    loadTabelPekerjaan()
                    formTambahPekerjaan.reset()
                    $('#satuanId').val(null).trigger('change');

                    loadSelectPekerjaan()
                }
            })
            e.preventDefault()

            return false;


        });
        $("#formEditPekerjaan").submit(function(e) {
            $.ajax({
                type: "POST",
                async: false,
                url: '<?php echo base_url(); ?>/servicepekerjaan/edit_pekerjaan',
                dataType: 'json',
                data: {
                    Deskripsi: $('#deskripsiEdit').val(),
                    SatuanId: $('#satuanIdEdit').val(),
                    Volume: $('#volumeEdit').val(),
                    RangeTanggal: $('#rangeTanggalEdit').val(),
                    RecId: $('#recIdEdit').val()
                    // TanggalMulai:tanggalMulai,
                    // TanggalSelesai:tanggalSelesai
                },
                success: function(output) {
                    console.log(output)
                    loadTabelPekerjaan()
                    formEditPekerjaan.reset()
                    $("#modalEditPekerjaan").modal('hide')
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data tersimpan',
                        showConfirmButton: false,
                        timer: 1500
                    })



                }
            })
            e.preventDefault()

            return false;


        });
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
                    PenerimaPekerjaanId: PenerimaPekerjaanId,
                    PekerjaanId: PekerjaanId,
                    Volume: Volume,
                    RangeTanggal: RangeTanggal
                },
                success: function(output) {
                    console.log(output)
                    loadTabelPenugasanPekerjaan(PekerjaanId)
                    if (output.sukses == true)
                        Swal.fire('Berhasil tambah penugasan', '', 'success')
                    else
                        Swal.fire('Gagal tambah penugasan', '', 'error')

                    // $("#modalTambahPenugasanPekerjaan").modal('hide')

                    // $('#penerimaPekerjaanId').val(null).trigger('change');

                }
            })
            e.preventDefault()

            return false;


        });
        loadTabelPekerjaan()
    })
</script>

<script>
    function bukaModalTambahPekerjaan(RecId) {

        $('#modalTambahPekerjaan').modal('show');
    }
</script>

<script>
    function bukaModalTambahPenugasanPekerjaan() {
        $('#modalTambahPenugasanPekerjaan').modal('show');
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
    function hapusPenugasan(RecId, PekerjaanId) {

        Swal.fire({
            title: 'Anda yakin menghapusnya?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya. Hapus',
            denyButtonText: `Tidak`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '<?php echo base_url(); ?>/Servicepekerjaanpengguna/delete_pekerjaan_pengguna_by_id',
                    dataType: 'json',
                    data: {
                        RecId: RecId

                    },
                    success: function(output) {

                        console.log(output);
                        loadTabelPenugasanPekerjaan(PekerjaanId)


                    },

                    error: function(e) {
                        console.log(e.responseText);

                    }
                });
                Swal.fire('Terhapus', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Tidak jadi dihapus', '', 'info')
            }
        })
    }
</script>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $("#modalTambahPekerjaan")
        })

    });
    $(document).ready(function() {
        $('.select3').select2({
            dropdownParent: $("#modalTambahPenugasanPekerjaan")
        })

    });
</script>

<script>
    function bukaDialogHapusPekerjaan(RecId) {
        Swal.fire({
            title: 'Anda yakin menghapus semua pekerjaan dan sekaligus penugasannya? Data yang dihapus tidak bisa direstore',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                // Swal.fire('Saved!', '', 'success')
                $.ajax({
                    type: "POST",
                    async: false,
                    url: '<?php echo base_url(); ?>/servicepekerjaan/delete_pekerjaan',
                    dataType: 'json',
                    data: {
                        RecId: RecId
                    },
                    success: function(output) {
                        console.log(output)
                        loadTabelPekerjaan()

                    }
                })

            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }
</script>