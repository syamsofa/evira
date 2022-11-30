<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
    var globalTahun = new Date().getFullYear()
    var globalBulan = (new Date().getMonth())
</script>
<style>
    .blink_me {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

<?php
?>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card  card-primary card-outline">
                    <div class=" card-body box-profile">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <select id="kecamatan" onchange="getDesaByKec(this.value)" required class=" select2 custom-select">
                                    <option value=''>--PILIH--</option>
                                    <?php
                                    foreach ($kecamatan['data'] as $rows) {

                                    ?>

                                        <option value='<?php echo $rows['kode_kec']; ?>'><?php echo $rows['kode_kec'] . " " . $rows['nama_kec']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Desa</label>
                            <div class="col-sm-10">
                                <select onchange="tampilData()" id="desa" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                </select>
                            </div>
                        </div>
                        <button onclick="tampilData()" type="button" class="btn btn-success float-left">Tampilkan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive card-body p-0" style="display: block;">
                            <table id="TabelRealisasi" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode SLS</th>
                                        <th>Nama SLS</th>
                                        <th>Yang Menyerahkan</th>
                                        <th>VK1</th>
                                        <th>VK2</th>
                                        <th>K</th>
                                        <th>XK</th>
                                        <th>PSLS</th>
                                        <th>Peta WS</th>
                                        <th>BANR</th>
                                        <th>Hasil Verifikasi</th>
                                        <th>--</th>

                                    </tr>

                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody></tbody>
                            </table>

                        </div>

                    </div>

                    <div class="d-none">
                        <div class="col-sm-4">
                            <div class="position-relative text-center">
                                <img height="300dp" src="https://community.bps.go.id/images/avatar/340053328_20190724105413.jpg" alt="Photo 1" class="img-circle elevation-2">
                                <div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-success text-xl">
                                        #1
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="position-relative">
                                <img src="../../dist/img/photo2.png" alt="Photo 2" class="img-fluid">
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class="ribbon bg-success text-xl">
                                        #2
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="position-relative" style="min-height: 180px;">
                                <img src="../../dist/img/photo3.jpg" alt="Photo 3" class="img-fluid">
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class="ribbon bg-success text-xl">
                                        #3
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="container_laporan_harian" class="card-body box-profile"> </div>

                </div>

            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row"></div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
</section>
<div class="modal fade" id="modalQuote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">QUOTE</h1>



            </div>
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://www.posbagus.com/wp-content/uploads/2019/03/000147-03_kata-kata-semangat-kerja_tombol-tunda_800x450_cc0-min.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.posbagus.com/wp-content/uploads/2019/03/000147-03_kata-kata-semangat-kerja_tombol-tunda_800x450_cc0-min.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.posbagus.com/wp-content/uploads/2019/03/000147-03_kata-kata-semangat-kerja_tombol-tunda_800x450_cc0-min.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function tampilData() {

        var TabelRealisasi = $("#TabelRealisasi").dataTable({
            columns: [{

                    className: "text-center"
                }, {

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
                },
                {

                    className: "text-right"
                },
                {

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
                },
                {

                    className: "text-right"
                },
                {

                    className: "text-right"
                }
            ],
            paging: false,
            searching: true,
            "responsive": true,
            destroy: true,
            "lengthChange": false,
            "autoWidth": false
        })

        $.ajax({
            type: "POST",
            async: false,
            data: {
                KodeKec: $("#kecamatan").val(),
                KodeDesa: $("#desa").val()
            },
            url: '<?php echo base_url(); ?>/servicewilayah/read_sls_by_kec_desa',
            dataType: 'json',
            success: function(output) {

                // console.log()
                console.log(output);
                TabelRealisasi.fnClearTable();
                outputData = output.data
                // console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]


                    j = i + 1

                    TabelRealisasi.fnAddData([
                        "" + outputDataBaris.KdSls + "",
                        "" + outputDataBaris.NmSls + "",
                        " <input class='tags'>",
                        "  <input maxlength=1 size=1 value='" + outputDataBaris.Vk1 + "' type='text'>",
                        "<input maxlength=1 size=1 value='" + outputDataBaris.Vk2 + "' type='text'>",
                        "<input maxlength=4 size=4 value='" + outputDataBaris.K + "' type='text'>",
                        "<input maxlength=4 size=4 value='" + outputDataBaris.Xk + "' type='text'>",
                        "<input maxlength=4 size=4 value='" + outputDataBaris.Psls + "' type='text'>",
                        "<input maxlength=4 size=4 value='" + outputDataBaris.PetaWs + "' type='text'>",
                        "<input maxlength=4 size=4 value='" + outputDataBaris.Banr + "' type='text'>",
                        "<input maxlength=4 size=4 value='" + outputDataBaris.HasilVerifikasi + "' type='text'>",
                        "<button>Edit</button>"


                    ]);
                } // End For

                $('[data-toggle="tooltipView"]').tooltip()
                $('[data-toggle="tooltipHapus"]').tooltip()

                $('#loaderGif').hide();

                $(".select2").select2()

                var availableTags = [
                    "Nanda Ilyas",
                    "AppleScript",
                    "Asp",
                    "BASIC",
                    "C",
                    "C++",
                    "Clojure",
                    "COBOL",
                    "ColdFusion",
                    "Erlang",
                    "Fortran",
                    "Groovy",
                    "Haskell",
                    "Java",
                    "JavaScript",
                    "Lisp",
                    "Perl",
                    "PHP",
                    "Python",
                    "Ruby",
                    "Scala",
                    "Scheme"
                ];
                $(".tags").autocomplete({
                    source: availableTags
                });
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
    function getDesaByKec(KodeKec) {
        $.ajax({
            type: "POST",
            async: false,
            data: {
                KodeKec: KodeKec

            },
            url: '<?php echo base_url(); ?>/servicewilayah/read_desa_by_kec',
            dataType: 'json',
            success: function(output) {
                console.log(output)
                $("#desa").empty()
                $("#desa").append("<option value=''>-- PILIH --</option>")
                output.data.forEach(data => {
                    $("#desa").append("<option value='" + data.kode_desa + "'>" + data.kode_desa + " " + data.nama_desa + "</option>")


                });

            },

            error: function(e) {
                console.log(e.responseText);

            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            // dropdownParent: $("#modalTambahPekerjaan")
        })

    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $("#tags").autocomplete({
            source: availableTags
        });
    });
</script>