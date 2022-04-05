<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="card">

                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button onclick="bukaModalTambahPekerjaan('aa')" type="button" class="btn btn-primary btn-block"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah</button>
                                </li>

                            </ul>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
                            <div class="col-sm-10">
                                <select id="tahunPekerjaan" onchange="loadTabelPekerjaan()" required class="custom-select">
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
                            <label for="" class="col-sm-2 col-form-label">Bulan Pembuatan</label>
                            <div class="col-sm-10">
                                <select onchange="loadTabelPekerjaan()" id="bulanPekerjaan" required class="custom-select">
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

                        <div class="table-responsive card-body p-0" style="display: block;">
                            <table id="TabelPekerjaan" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Deskripsi</th>
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
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penugasan Pekerjaan</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pekerjaan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Deskripsi Pekerjaan</strong>

                        <p id="namaPekerjaanDetail" class="text-muted">
                            TESTES
                        </p>

                        <hr>

                        <strong><i class="fas fa-book mr-1"></i> Volume dan Satuan</strong>

                        <p id="satuanPekerjaanDetail" class="text-muted">
                            TESTES
                        </p>

                        <hr>
                        <p class="text-muted">
                            <button onclick="bukaModalTambahPenugasanPekerjaan()" type="button" class="btn btn-primary btn-sm"><i class="fa fa-address-card" aria-hidden="true"></i> Tambah Penugasan</button>

                        </p>

                        <hr>
                        <div class="table-responsive card-body p-0" style="display: block;">

                            <table id="TabelPenugasanPekerjaan" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Penerima Pekerjaan</th>
                                        <th>Tanggal Penerimaan Tugas</th>
                                        <th>Durasi Pekerjaan</th>
                                        <th>Volume</th>
                                        <th></th>
                                    </tr>
                                </thead>
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
<div class="modal fade" id="modalTambahPenugasanPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penugasan Pekerjaan</h5>

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
                                <select id="penerimaPekerjaanId" required class="select3 custom-select">
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
                                <select id="pekerjaanId" required class="custom-select">
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
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
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
    function loadTabelPenugasanPekerjaan(RecId) {

        var TabelPenugasanPekerjaan = $("#TabelPenugasanPekerjaan").dataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
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
                }

            ],
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
            url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/read_pekerjaan_pengguna_by_pekerjaan',
            dataType: 'json',
            data: {
                RecId: RecId

            },
            success: function(output) {
                console.log(output)
                TabelPenugasanPekerjaan.fnClearTable();

                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    TabelPenugasanPekerjaan.fnAddData([
                        "" + outputDataBaris.NamaPenerimaPekerjaan + "",
                        "" + outputDataBaris.CreatedDate + "",
                        "" + outputDataBaris.TanggalMulaiFormatted + " s/d " + outputDataBaris.TanggalSelesaiFormatted,

                        "<input onchange='ubahVolumePenugasan(this.value," + outputDataBaris.RecId + "," + outputDataBaris.PekerjaanId + ")' style='text-align:right;' value='" + outputDataBaris.Volume + "'>",
                        "<button onclick='hapusPenugasan(" + outputDataBaris.RecId + "," + RecId + ")' class='btn btn-danger'>Hapus</button>"
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
    function bukaModalPenugasanPekerjaan(RecId) {

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
                $("#namaPekerjaanDetail").html(data['Deskripsi'])
                $("#satuanPekerjaanDetail").html(data['Volume'] + ' ' + data['Satuan'])
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
    function loadTabelPekerjaan() {
        var TabelPekerjaan = $("#TabelPekerjaan").dataTable({
            destroy: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepekerjaan/read_pekerjaan_by_pengguna_by_tahun_by_bulan',
            dataType: 'json',
            data: {
                PenggunaId: <?php echo $this->session->userdata('RecId'); ?>,
                Tahun: $("#tahunPekerjaan").val(),
                Bulan: $("#bulanPekerjaan").val()

            },
            success: function(output) {
                TabelPekerjaan.fnClearTable();

                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    TabelPekerjaan.fnAddData([
                        "" + outputDataBaris.Deskripsi + "",
                        "" + outputDataBaris.Volume + "",
                        "" + outputDataBaris.Satuan + "",
                        "" + outputDataBaris.Nama + "",
                        "" + outputDataBaris.CreatedDate + "",
                        "<button type='button' onclick='bukaModalEditPekerjaan(RecId=" + outputDataBaris.RecId + ")' class='btn btn-primary fa fa-pencil-square-o'>" +
                        "<button type='button' onclick='bukaModalPenugasanPekerjaan(RecId=" + outputDataBaris.RecId + ")' class='btn btn-primary fa fa-tasks'>"
                    ]);
                } // End For

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
    }
    $(document).ready(function() {








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
                    if(output.sukses==true)
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