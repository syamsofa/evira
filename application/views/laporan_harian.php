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


            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                    <select id="tahunPekerjaan" onchange="tampilDaftarLaporanPerBulanTahun($('#bulanPekerjaan').val(),this.value, globalIdPengguna)" required class="custom-select">
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
                    <select onchange="tampilDaftarLaporanPerBulanTahun(this.value,$('#tahunPekerjaan').val(), globalIdPengguna)" id="bulanPekerjaan" required class="custom-select">
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
            <button id="" onclick="bukaModalTambahLaporanHarian()" type="button" class="btn btn-success float-right"><i class="fa fa-plus-square" aria-hidden="true"></i> Upload Laporan Harian</button>

        </div>
        <div class="card-body">
            <div class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelLaporanHarianSaya" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>File</th>
                            <th>Lihat</th>

                            <th>Tipe WFO/WFH/Cuti</th>
                            <th>Waktu Upload</th>
                            <th></th>

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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-file-text" aria-hidden="true"></i> Tambah Laporan Harian</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="formTambahLaporanHarian" enctype="multipart/form-data" class="form-horizontal">


                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="idPengguna" value="<?php echo $this->session->userdata('RecId');  ?>">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Jenis (WFO/WFH/Cuti)</label>
                            <div class="col-sm-10">
                                <select required id="jenisKehadiran" onchange="setAtribut(this.value)" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <option value='wfh'>WFH</option>
                                    <option value='wfo'>WFO</option>
                                    <option value='cuti'>CUTI</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tanggal </label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control tanggal" autocomplete="off" id="tanggalPekerjaan" value="" />

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
    var penggunaId = '<?php echo $this->session->userdata('RecId') ?>'
</script>
<script>
    function tampilDaftarLaporanPerBulanTahun(bulan, tahun, idPengguna) {
        console.log(bulan, tahun, idPengguna)
        var TabelLaporanHarianSaya = $("#TabelLaporanHarianSaya").dataTable({
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
            url: '<?php echo base_url(); ?>/servicelaporanharian/read_laporan_harian_by_pengguna_tahun_bulan',
            dataType: 'json',
            data: {
                Tahun: tahun,
                Bulan: bulan,
                IdPengguna: idPengguna
                // PenerimaPekerjaanId: penggunaId
            },
            success: function(output) {
                console.log(output);
                TabelLaporanHarianSaya.fnClearTable();
                outputData = output.data
                // console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]


                    j = i + 1

                    TabelLaporanHarianSaya.fnAddData([
                        "" + outputDataBaris.Tanggal + "",
                        () => {
                            if (outputDataBaris.Upload.JumUpload > 0) {

                                if (outputDataBaris.Upload.Data.JenisKehadiran == 'cuti')
                                    return "CUTI"
                                else

                                    return "<a href='" + outputDataBaris.Upload.Data.Tautan + "'><i class='fa fa-file-text' aria-hidden='true'></i> Tersedia</a>"
                            } else
                                return '-'
                            // 
                        },
                        () => {
                            if (outputDataBaris.Upload.JumUpload > 0) {
                                if (outputDataBaris.Upload.Data.JenisKehadiran == 'cuti')
                                    return "CUTI"
                                else

                                    return "<button class='btn-success' data-toggle='tooltipView' data-placement='top' title='Lihat Laporan Secara Live' onclick='bukaModalViewLaporanHarian(\"" + outputDataBaris.Upload.Data.NamaFile + "\")' ><i class='fa fa-eye' aria-hidden='true'></i> </button>"
                            } else
                                return '-'
                            // 
                        },
                        () => {
                            if (outputDataBaris.Upload.JumUpload > 0) {

                                return outputDataBaris.Upload.Data.JenisKehadiran
                            } else
                                return '-'
                            // 
                        },
                        () => {
                            if (outputDataBaris.Upload.JumUpload > 0) {
                                if (outputDataBaris.Upload.Data.JenisKehadiran == 'cuti')
                                    return "CUTI"
                                else

                                    return outputDataBaris.Upload.Data.CreatedDate
                            } else
                                return '-'
                            // 
                        },
                        () => {
                            if (outputDataBaris.Upload.JumUpload > 0) {
                                if (outputDataBaris.Upload.Data.JenisKehadiran == 'cuti')
                                    return "CUTI"
                                else

                                    return "<button class='btn-danger' data-toggle='tooltipHapus' data-placement='top' title='Hapus Laporan' onclick='hapusLaporanHarian(\"" + outputDataBaris.Upload.Data.NamaFile + "\")' ><i class='fa fa-trash' aria-hidden='true'></i> </button>"
                            } else
                                return '-'
                            // 
                        },

                        // "" + outputDataBaris.CreatedDate + "",
                        // " Realisasi Volume Diubah dari " + outputDataBaris.VolumePraRealisasi + " MenJadi " + outputDataBaris.VolumeRealisasi + ""


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
    $("#buttonTampilLaporanHarian").click(function() {
        $('#loaderGif').show();
        tampilDaftarLaporanPerBulanTahun($("#bulanPekerjaan").val(), $("#tahunPekerjaan").val(), globalIdPengguna)
    });
</script>

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
    function hapusLaporanHarian(NamaFile) {
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicelaporanharian/hapushtmllaporanharian',
            dataType: 'json',
            data: {
                NamaFile: NamaFile
            },
            success: function(output) {
                console.log(output.Data);
                tampilDaftarLaporanPerBulanTahun($("#bulanPekerjaan").val(), $("#tahunPekerjaan").val(), globalIdPengguna)

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


<input type="text" class="form-control">
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
    $("#formTambahLaporanHarian").submit(function(event) {
        $("#buttonSubmit").html(" <i class='fa fa-refresh fa-spin'></i> Sedang Proses Upload ");

        const fileupload = $('#fileLaporan').prop('files')[0];
        console.log(fileupload)
        var form_data = new FormData();
        form_data.append('file', fileupload);
        form_data.append('TanggalPekerjaan', $("#tanggalPekerjaan").val());
        form_data.append('IdPengguna', $("#idPengguna").val());
        form_data.append('JenisKehadiran', $("#jenisKehadiran").val());
        // console.log(form_data)



        $.ajax({


            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: '<?php echo base_url(); ?>/servicelaporanharian/create_laporan_harian',
            dataType: 'json',
            data: form_data,
            success: function(output) {
                if (output.sukses == true) {
                    Swal.fire(output.pesan, '', 'success')
                    $('#formTambahLaporanHarian')[0].reset();
                    $('#modalTambahLaporanHarian').modal('hide');
                    tampilDaftarLaporanPerBulanTahun($("#bulanPekerjaan").val(), $("#tahunPekerjaan").val(), $("#idPengguna").val())
                    $("#keteranganUpload").html('')
                } else
                    Swal.fire(output.pesan, '', 'error')
                $("#buttonSubmit").html(" <i class='fa fa-paper-plane' aria-hidden='true'></i> Submit ");

            }

        })

        event.preventDefault()




    });
</script>



<script>
    $("#tahunPekerjaan").val(globalTahun)
    $("#bulanPekerjaan").val(globalBulan)
    setTimeout(() => {
        tampilDaftarLaporanPerBulanTahun(globalBulan, globalTahun, globalIdPengguna)
    }, 1000);
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
    function setAtribut(jenis)
    {
        // alert(jenis)
        if(jenis=='cuti')
        {
            // $( "#tanggalPekerjaan" ).prop( "disabled", true );
            $( "#fileLaporan" ).prop( "disabled", true );
            

        }
        else
        {
            $( "#fileLaporan" ).prop( "disabled", false);
            
        }

    }
</script>