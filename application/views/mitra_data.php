<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">



            <button id="" onclick="bukaModalTambahExcel()" type="button" class="btn btn-success float-right">Import Using Excel</button>

            <button disabled id="" onclick="bukaModalTambahPengguna()" type="button" class="btn btn-success float-right">Tambah</button>

        </div>

        <div class="card-header">
            <div class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelMitra" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Mitra</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>

        <!-- /.card-body -->
    </div>

</section>

<script>
    $(function() {

    });
</script>

<script>
    $(document).ready(function() {
        function loadTabelMitra() {
            var TabelMitra = $("#TabelMitra").dataTable({
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
                url: '<?php echo base_url(); ?>/servicemitra/read_mitra',
                dataType: 'json',
                success: function(output) {
                    TabelMitra.fnClearTable();

                    outputData = output.data
                    for (var i = 0; i < outputData.length; i++) {

                        outputDataBaris = outputData[i]
                        j = i + 1

                        TabelMitra.fnAddData([
                            "" + outputDataBaris.Nama + "",
                            "" + outputDataBaris.Nik + "",
                            "" + outputDataBaris.DeskripsiJenisKelamin + "",
                            "" + outputDataBaris.TanggalLahirIndonesia + "",
                            "<button type='button' onclick='bukaFormEditPengguna(Id=" + outputDataBaris.RecId + ")' class='btn btn-primary'>Edit"

                        ]);
                    } // End For

                },

                error: function(e) {
                    console.log(e.responseText);

                }
            });
        }

        loadTabelMitra()

        $("#formUbahPengguna").submit(function(e) {
            $.ajax({
                type: "POST",
                async: false,
                url: '<?php echo base_url(); ?>/servicemitra/update_mitra_by_id',
                dataType: 'json',
                data: {
                    Id: $('#idEdit').val(),
                    Nama: $('#namaEdit').val(),
                    Nik: $('#nikEdit').val(),
                    Gender: $('#genderEdit').val()
                },
                success: function(output) {
                    console.log(output)
                    loadTabelMitra()
                    // $("modalE")
                    $('#modalUbahPengguna').modal('hide');
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

        $("#formTambahPengguna").submit(function(e) {
            $.ajax({
                type: "POST",
                async: false,
                url: '<?php echo base_url(); ?>/servicemitra/create_mitra',
                dataType: 'json',
                data: {
                    Nama: $('#nama').val(),
                    Nik: $('#nik').val(),
                    Gender: $('#gender').val()

                },
                success: function(output) {
                    console.log(output)
                    loadTabelMitra()
                    // $("modalE")
                    $('#modalTambahPengguna').modal('hide');
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
    });
</script>
<script>
    function bukaFormEditPengguna(Id) {

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicemitra/read_mitra_by_id',
            dataType: 'json',
            data: {
                Id: Id
            },
            success: function(output) {
                console.log(output)
                var output = output.data

                // console.log(output.Email)
                $("#namaEdit").val(output.Nama)
                $("#idEdit").val(output.Id)
                $("#nikEdit").val(output.Nik)
                $("#genderEdit").val(output.Gender)
                $("#tanggalLahirEdit").val(output.TanggalLahir)
                $("#alamatDetailEdit").val(output.AlamatDetail)
            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
        $('#modalUbahPengguna').modal('show');
    }
</script>

<script>
    function bukaFormRolePengguna(RecId) {
        var TabelRolePengguna = $("#TabelRolePengguna").dataTable({
            "paging": false,
            "searching": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepengguna/read_role_by_pengguna',
            dataType: 'json',
            data: {
                RecId: RecId
            },
            success: function(output) {
                TabelRolePengguna.fnClearTable();

                outputData = output.data
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]
                    j = i + 1

                    TabelRolePengguna.fnAddData([

                        "" + outputDataBaris.Role + "",
                        "<button type='button' onclick='bukaFormEditPengguna(Id=" + outputDataBaris.Id + ")' class='btn btn-primary'>Edit"
                    ]);
                } // End For

            },


            error: function(e) {
                console.log(e.responseText);

            }
        });
        $('#modalRolePengguna').modal('show');
    }
</script>
<div class="modal fade" id="modalUbahPengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formUbahPengguna" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idEdit" placeholder="">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="namaEdit" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="nikEdit" placeholder="NIK">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select id="genderEdit" class="custom-select">
                                    <option value=''>--Pilih Opsi--</option>
                                    <option value='1'>Laki-laki</option>
                                    <option value='2'>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="tanggalLahirEdit" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat Detail</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="alamatDetailEdit" placeholder="">
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
<div class="modal fade" id="modalTambahPengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formTambahPengguna" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input autocomplete="off" type="text" class="form-control" id="nama" placeholder="NAME">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="nik" placeholder="NIK">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select id="gender" class="custom-select">
                                    <option value=''>--Pilih Opsi--</option>
                                    <option value='1'>Laki laki</option>
                                    <option value='2'>Perempuan</option>


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
<div class="modal fade" id="modalTambahExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-text" aria-hidden="true"></i> Tambah Mitra Pakai Excel</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="formTambahMitra" enctype="multipart/form-data" class="form-horizontal">


                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="idPengguna" value="<?php echo $this->session->userdata('RecId');  ?>">

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Template</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <a href="<?php echo base_url();  ?>aset/template_import_mitra/templateMitra.xlsx"> Template</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input onchange="getKeteranganFile()" required type="file" class="custom-file-input" id="fileLaporan">
                                        <label id="keteranganUpload" class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="buttonSubmit" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalRolePengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Role Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table id="TabelRolePengguna" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Role</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="bukaModalTambahRole()" class="btn btn-primary">Add</button>
            </div>

        </div>
    </div>
</div>

<script>
    function bukaModalTambahRole() {
        $('#modalTambahRolePengguna').modal('show');
    }
</script>

<script>
    function bukaModalTambahPengguna() {
        $('#modalTambahPengguna').modal('show');
    }
</script>


<script>
    function bukaModalTambahExcel() {
        $('#modalTambahExcel').modal('show');
    }
</script>

<script>
    function getKeteranganFile(varr) {
        const fileupload = $('#fileLaporan').prop('files')[0];

        console.log(fileupload)
        $("#keteranganUpload").html(fileupload.name + ', ' + fileupload.size + ' bytes' + ', ' + fileupload.type)
    }
</script>

<script>
    $("#formTambahMitra").submit(function(event) {


        $("#buttonSubmit").html(" <i class='fa fa-refresh fa-spin'></i> Sedang Proses Upload ");

        const fileupload = $('#fileLaporan').prop('files')[0];
        console.log(fileupload)
        var form_data = new FormData();
        form_data.append('file', fileupload);

        // console.log(form_data)



        $.ajax({


            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: '<?php echo base_url(); ?>/servicemitra/import_mitra',
            dataType: 'json',
            data: form_data,
            success: function(output) {
                console.log(output)
                if (output.sukses == true) {
                    Swal.fire(output.pesan, '', 'success')
                    $('#formTambahMitra')[0].reset();
                    $('#modalTambahExcel').modal('hide');
                    $("#keteranganUpload").html('')
                    loadTabelMitra()
                } else
                    Swal.fire(output.pesan, '', 'error')
                $("#buttonSubmit").html(" <i class='fa fa-paper-plane' aria-hidden='true'></i> Submit ");

            }

        })

        event.preventDefault()




    });
</script>