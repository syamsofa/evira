<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
                <div class="card-header">
                    <div class="table-responsive card-body p-0" style="display: block;">
            <table id="TabelSatuan" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Satuan</th>

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
        function loadTabelSatuan() {
            var TabelSatuan = $("#TabelSatuan").dataTable({
                "responsive": true,
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
                url: '<?php echo base_url(); ?>/servicesatuan/read_satuan',
                dataType: 'json',
                success: function(output) {
                    TabelSatuan.fnClearTable();

                    outputData = output.data
                    for (var i = 0; i < outputData.length; i++) {

                        outputDataBaris = outputData[i]
                        j = i + 1

                        TabelSatuan.fnAddData([
                            "" + outputDataBaris.Satuan + ""
                      
                        ]);
                    } // End For

                },

                error: function(e) {
                    console.log(e.responseText);

                }
            });
        }

        loadTabelSatuan()

        $("#formUbahPengguna").submit(function(e) {
            $.ajax({
                type: "POST",
                async: false,
                url: '<?php echo base_url(); ?>/servicepengguna/update_pengguna_by_id',
                dataType: 'json',
                data: {
                    RecId: $('#recIdEdit').val(),
                    Nama: $('#namaEdit').val(),
                    Nip: $('#nipEdit').val(),
                    SatkerId: $('#satkerIdEdit').val(),
                    OrganisasiId: $('#organisasiIdEdit').val(),
                    OpsiLoginId: $('#opsiLoginIdEdit').val()
                },
                success: function(output) {
                    console.log(output)
                    loadTabelSatuan()
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
    });
</script>
<script>
    function bukaFormEditPengguna(RecId) {
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicepengguna/read_pengguna_by_id',
            dataType: 'json',
            data: {
                RecId: RecId
            },
            success: function(output) {
                console.log(output)
                var output = output.data
                
                // console.log(output.Email)
                $("#nipEdit").val(output.Nip)
                $("#namaEdit").val(output.Nama)
                $("#emailEdit").val(output.Email)
                $("#recIdEdit").val(output.RecId)
                $("#satkerIdEdit").val(output.SatkerId)
                $("#organisasiIdEdit").val(output.OrganisasiId)
                $("#opsiLoginIdEdit").val(output.OpsiLoginId)

                


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
                        "<button type='button' onclick='bukaFormEditPengguna(RecId=" + outputDataBaris.RecId + ")' class='btn btn-primary'>Edit"
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <input type="hidden" class="form-control" id="recIdEdit" placeholder="">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="emailEdit" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nipEdit" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="namaEdit" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Opsi Login</label>
                            <div class="col-sm-10">
                                <select id="opsiLoginIdEdit" class="custom-select">
                                    <option value=''>--Pilih Opsi--</option>

                                    <?php
                                    foreach ($opsiLogin['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['OpsiLogin']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Satker</label>
                            <div class="col-sm-10">
                                <select id="satkerIdEdit" class="custom-select">
                                    <option value=''>--Pilih Opsi--</option>

                                    <?php
                                    foreach ($satker['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Nama']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Organisasi</label>
                            <div class="col-sm-10">
                                <select id="organisasiIdEdit" class="custom-select">
                                    <option value=''>--Pilih Opsi--</option>

                                    <?php
                                    foreach ($organisasi['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Nama']; ?></option>

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
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTambahRolePengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <input type="hidden" class="form-control" id="recId" placeholder="Email">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                                                <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nipEdit" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="nama" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Satker</label>
                            <div class="col-sm-10">
                                <select id="satkerId" class="custom-select">
                                    <?php
                                    foreach ($satker['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Nama']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Organisasi</label>
                            <div class="col-sm-10">
                                <select id="organisasiId" class="custom-select">
                                    <?php
                                    foreach ($organisasi['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Nama']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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