<div id="loaderGif">
    <img src="../aset/image/loader.gif">
</div>
<script>
    var globalTahun = new Date().getFullYear()
    var globalBulan = new Date().getMonth()
    var globalIdPengguna = <?php echo $this->session->userdata('RecId'); ?>

    // var globalBulan=
</script>
<script>
    $('#loaderGif').hide();
</script>
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">


            <button id="" onclick="bukaModalTambahLaporanHarian()" type="button" class="btn btn-success float-right"><i class="fa fa-plus-square" aria-hidden="true"></i> Upload Realisasi</button>

        </div>
        <div class="card-body">
            <div class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelRealisasi" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>RO/Output</th>
                            <th>Pagu Revisi</th>
                            <th>Realisasi</th>

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

<div class="modal fade" id="modalTambahLaporanHarian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-text" aria-hidden="true"></i> Upload Realisasi</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="formUploadRealisasi" enctype="multipart/form-data" class="form-horizontal">


                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="idPengguna" value="<?php echo $this->session->userdata('RecId');  ?>">
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
<div class="modal fade" id="modalViewLaporanHarian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <script>
                $("#sss").attr("src", "http://localhost/evira/servicepekerjaanpengguna/testes")
            </script>

            <div class="modal-body">

                <div id="htmllaporanharian"></div>
            </div>
            <div class="modal-footer">

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


<script>
    function bukaModalTambahLaporanHarian(RecId) {
        $('#modalTambahLaporanHarian').modal('show');
    }
</script>
<script>
    function bukaModalViewLaporanHarian(NamaFile) {
        console.log(NamaFile)
        $('#modalViewLaporanHarian').modal('show');
        let DataLaporan, JumBaris, JumKolom
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicelaporanharian/viewhtmllaporanharian',
            dataType: 'json',
            data: {
                NamaFile: NamaFile
            },
            success: function(output) {
                console.log(output.Data);
                DataLaporan = output.Data
                JumBaris = output.JumBaris
                JumKolom = output.JumKolom

            },

            error: function(e) {
                console.log(e.responseText);
                setTimeout(() => {
                    $('#loaderGif').hide();
                }, 2000);

            }
        });
        var t = $("#htmllaporanharian");
        t.empty()
        // Example
        t.xtab("init", {
            mainlabel: "DataExcel",
            split: true,
            rows: JumBaris,
            cols: JumKolom,
            rowlabels: true,
            collabels: true,
            // widths: [75, 50, 100, 200],
            values: DataLaporan,
            change: function(r, c, val, ref) {
                console.log("CHANGE [" + r + ", " + c + "] = \"" + ref + "\": " + val);
            },
            focus: function(r, c, val, ref) {
                console.log("FOCUS [" + r + ", " + c + "] = \"" + ref + "\": " + val);
            }
        });

    }
</script>
<script>
    $(function() {
        $('.tanggal').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
<script>
    function getKeteranganFile(varr) {
        const fileupload = $('#fileLaporan').prop('files')[0];

        console.log(fileupload)
        $("#keteranganUpload").html(fileupload.name + ', ' + fileupload.size + ' bytes' + ', ' + fileupload.type)
    }
</script>
<script>
    $("#formUploadRealisasi").submit(function(event) {
        $("#buttonSubmit").html(" <i class='fa fa-refresh fa-spin'></i> Sedang Proses Upload ");

        const fileupload = $('#fileLaporan').prop('files')[0];
        console.log(fileupload)
        var form_data = new FormData();
        form_data.append('file', fileupload);
        // form_data.append('TanggalPekerjaan', $("#tanggalPekerjaan").val());
        // form_data.append('IdPengguna', $("#idPengguna").val());
        // form_data.append('JenisKehadiran', $("#jenisKehadiran").val());
        // console.log(form_data)



        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: '<?php echo base_url(); ?>/servicero/insert_laporan_ro',
            dataType: 'json',
            data: form_data,
            success: function(output) {
                console.log(output)
                tampilRealisasi()
                $('#formUploadRealisasi')[0].reset();
                $('#modalTambahLaporanHarian').modal('hide');
                $("#buttonSubmit").html(" <i class='fa fa-paper-plane' aria-hidden='true'></i> Submit ");

            }

        })

        event.preventDefault()




    });
</script>




<style type="text/css" media="screen">
    html,
    body {
        background-color: white;
        color: black;
        font-family: Arial, Verdana, Helvetica;
    }

    p,
    a,
    ul,
    li,
    td,
    th {
        font-size: 12pt;
    }

    h1 {
        font-size: 16pt;
    }

    h2 {
        font-size: 14pt;
    }

    button {
        margin: 5px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {



    });
</script>

<script>
    function setAtribut(jenis) {
        // alert(jenis)
        if (jenis == 'cuti' || jenis == 'dl') {
            // $( "#tanggalPekerjaan" ).prop( "disabled", true );
            $("#fileLaporan").prop("disabled", true);


        } else {
            $("#fileLaporan").prop("disabled", false);

        }

    }
</script>
<script>
    function unduhRekapLaporan() {
        window.location.href = '<?php echo base_url(); ?>/servicelaporanharian/eksporlaporansatubulan?Tahun=' + $("#tahunPekerjaan").val() + '&Bulan=' + $("#bulanPekerjaan").val() + '&IdPengguna=' + $("#idPengguna").val()

    }
</script>

<script type="text/javascript">
    $(function() {
        $('.select2').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: 'masukkan nama propinsi',
            ajax: {
                dataType: 'json',
                url: '<?php echo base_url(); ?>/servicepengguna/read_pengguna_search',
                delay: 800,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                },
            }
        }).on('select2:select', function(evt) {
            console.log(evt.params.data.id);
            var data = $(".select2 option:selected").text();
            // alert("Data yang dipilih adalah " + data);
        });
    });
</script>

<script>
    function tampilRealisasi() {
        var TabelRealisasi = $("#TabelRealisasi").dataTable({
            columns: [{

                    className: "text-center"
                },
                {

                    className: "text-left"
                },
                {

                    className: "text-right"
                },
                {

                    className: "text-right"
                }
            ],
            paging: false,
            searching: false,
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
            url: '<?php echo base_url(); ?>/servicero/read_ro',
            dataType: 'json',
            success: function(output) {
                console.log(output);
                TabelRealisasi.fnClearTable();
                outputData = output.data
                // console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]


                    j = i + 1

                    TabelRealisasi.fnAddData([
                        "" + outputDataBaris.Kode + "",
                        "" + outputDataBaris.Ro + "",
                        "" + outputDataBaris.PaguRevisiFormatted + "",
                        "" + outputDataBaris.RealisasiFormatted + ""


                    ]);
                } // End For

                $('[data-toggle="tooltipView"]').tooltip()
                $('[data-toggle="tooltipHapus"]').tooltip()

                $('#loaderGif').hide();
            },

            error: function(e) {
                console.log(e.responseText);
                setTimeout(() => {
                    $('#loaderGif').hide();
                }, 2000);

            }
        });
    }
</script>
<script>
    setTimeout(() => {
        tampilRealisasi()
    }, 1000);
</script>