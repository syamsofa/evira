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
                                        <th>Nom Batch</th>
                                        <th>Kode SLS</th>
                                        <th>Nama SLS</th>
                                        <th>Hasil Verifikasi Keluarga</th>
                                        <th>Dok XK</th>
                                        <th>Operator Entri</th>
                                        <th>Tanggal Penyerahan ke Operator Entri</th>
                                        <th>Tanggal Penerimaan kembali dari Operator Entri</th>
                                        <th>Validator</th>
                                        <th>Tanggal Penyerahan ke Operator Validasi</th>
                                        <th>Tanggal Penerimaan Kembali dari Operator Validasi</th>

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
                        "" + outputDataBaris.NomorBatch + "",
                        "" + outputDataBaris.KdSls + "",
                        "" + outputDataBaris.NmSls + "",
                        "" + outputDataBaris.HasilVerifikasi + "",
                        "" + outputDataBaris.Xk + "",
                        " <input targetkolom='Operator' onchange='UpdateData(this)' targetid=" + outputDataBaris.Id + " value='" + outputDataBaris.Operator + "' class='Operator'>",
                        "<input targetkolom='TanggalEntri' onchange='UpdateData(this)' targetid=" + outputDataBaris.Id + " class='tunggalTanggal' value='" + outputDataBaris.TanggalEntri + "' type='text'>",
                        "<input targetkolom='TanggalKembali' onchange='UpdateData(this)' targetid=" + outputDataBaris.Id + " class='tunggalTanggal' value='" + outputDataBaris.TanggalKembali + "' type='text'>",
                        " <input targetkolom='Validator' onchange='UpdateData(this)' targetid=" + outputDataBaris.Id + " value='" + outputDataBaris.Validator + "' class='Operator'>",
                        " <input targetkolom='TanggalValidasi' onchange='UpdateData(this)' targetid=" + outputDataBaris.Id + " value='" + outputDataBaris.TanggalValidasi + "' class='tunggalTanggal'>",
                        " <input targetkolom='TanggalValidasiKembali' onchange='UpdateData(this)' targetid=" + outputDataBaris.Id + " value='" + outputDataBaris.TanggalValidasiKembali + "' class='tunggalTanggal'>",

                    ]);
                } // End For

                $('[data-toggle="tooltipView"]').tooltip()
                $('[data-toggle="tooltipHapus"]').tooltip()

                $('#loaderGif').hide();

                $(".select2").select2()

                var DaftarSupervisor = [
                    'Adi Muntiardiyanto Umar',
                    'Agus Susanto',
                    'Amir Murtono',
                    'Didik Permono',
                    'Dinata Hindra Setiawan S.AP',
                    'Drs. Sumitro',
                    'Ekha Jaya Prianjani S.M.',
                    'Erlinda S.ST, M.Ec.Dev',
                    'Faisal Luthfi Arief SST',
                    'Henri Wagiyanto S.Pt., M.Ec.Dev, M.A.',
                    'Herhardana S.Si.',
                    'Imam Mustofa S.Si.',
                    'Khaerul Anwar SST',
                    'Kristiyanti',
                    'M. Dwi Priyanto S.E.',
                    'Miyan Andi Irawan SST, M.S.E.',
                    'Mochtar Rahmadi',
                    'Moh. Asrori S.Si.',
                    'Mohamad Achiruzaman S.ST, M.T',
                    'Muhamad Bukhori S.E.',
                    'Muncar Cahyono SST',
                    'Murni SE',
                    'Mustaqhwiroh S.Stat.',
                    'Nanda Ilyas Syukur SST',
                    'Nia Aprillyana, S.ST, M.Si.',
                    'Raudlatul Jannah, SST',
                    'Respati Adi Wicaksono S.Si.',
                    'Roni Rijanto',
                    'Senthir Bawono S.E.',
                    'Slamet Purwoko',
                    'Sophan Hidayatna',
                    'Sri Rejeki SST, M.M.',
                    'Sukaryo A.Md.',
                    'Wahyu Sri Lestari SST, M.Stat',
                    'Winarso SST',
                    'Zakaria'
                ];
                $(".Supervisor").autocomplete({
                    source: DaftarSupervisor
                });

                var DaftarOperator = [
                    'Abdul Kamid',
                    'Afnizar zulfiani C',
                    'Alfian Nur Rohmad',
                    'Alvin Brilianjaya',
                    'Andre Praditya Rosadi',
                    'Andriawan Imam Santoso',
                    'Biruwati Pratika S.',
                    'Christina Ardyastuti',
                    'Dimas Bagus Setiawan',
                    'Dita Yuliana Sari',
                    'Dwi Sulistyowati',
                    'DYAN WAHYUDI RIA SAPUTRA',
                    'Eka Laila Dindayani',
                    'Eko Bagus Wibowo',
                    'Pulung',
                    'Fahrudin',
                    'Farensha Aleyda Zahra',
                    'Fitri Irawati',
                    'Gita Suci Amaryl',
                    'Imam Qusthalaani',
                    'Islah Rakhadinda Akbar',
                    'Kanti Triyani',
                    'Khoirun Nisa',
                    'Lailatul Khoiriyah',
                    'Latifatul Azizah',
                    'Lilik Tri Wahyuni',
                    'MARDHA ATTHAARIQ ISYRAQI',
                    'Mohammad Aris Bahagiawan',
                    'Pracilia Ayu Yulia Savega',
                    'Pratiwi Setyoningrum',
                    'Rachmad Fajar Riandi',
                    'Rian',
                    'Ahmad Mijazi',
                    'Alfian Roy Brucelee',
                    'Aliyatus Zulfa',
                    'Anang Erdyanto',
                    'Any Endah Kuncahyani',
                    'Awalin Nabila Wardatul Purwanto',
                    'Dimas Poetra Dewa',
                    'EKANANDA PUJI INDAH LESTARI',
                    'Ikwana Yusro',
                    'Imroatun Azizah',
                    'Intan Purnama Sari',
                    'Istiawan',
                    'Jayanto',
                    'M. Fajar Zahrul Fadli',
                    'Marlina Yunita M',
                    'Mubtadiul Khoeroh ',
                    'Muhammad Fasikh',
                    'Muhhamad Yusuf Syarifuddin',
                    'Mustaqiim Bariklana',
                    'NUR LELY SOFIA',
                    'Putri Diyana Tush Sholihah',
                    'Rizkyana Nur Safitri',
                    'Salsabila asmasika',
                    'Serri Diyah Kusumawiduri',
                    'Silvi',
                    'SISKA DIANA LOMBAN',
                    'Siti Durrotul Manihah',
                    'Slamet Tri Wibowo',
                    'Tutwuri Handayani Oktavia',
                    'Vikky Andian',
                    'Yudika',
                    'Ahmad Dhiyaus Syahidin',
                    'Ajeng Setyorini',
                    'Andre Haryanto',
                    'Anisa Septianingrum',
                    'Artilerianna Putri Sari Damayanti Suseno',
                    'Dewi Maisaroh',
                    'FATIHUL ILHAM MAULIDA',
                    'Helvin Leo Atmaja',
                    'Hidayatun Nikmah',
                    'Juminem',
                    'Khoirus',
                    'Lukman Nur Hakim',
                    'Mizan Asrori',
                    'MUH CHOLID RIDWAN ARSADAL AKMA',
                    'Muhammad Ibnu Pamungkas',
                    'Nila Rifda Wachidatun Nabilah',
                    'Nailul Ianah',
                    'Nurul Khotimah',
                    'Oktaviani Tiara Murti',
                    'Pasya Eka Aprilia',
                    'Putri Januar Puspa Adi Pradana',
                    'Faham',
                    'Septika Ayu Desintawati',
                    'Setiyowati Ryski Anggraeni',
                    'Siti Nur Karimah',
                    'Sri Utami',
                    'Ubaid',
                    'Wilda Maesarotus Septina',
                    'Ika Winda Febrianti',
                    'MUHAMMAD KHOIRUL ANAM',
                    'Tegar',
                    'Dewi Gesang',
                    'MUHAMMAD NAUFAL ARIQ',
                    'YOSSI ANANTA',

                ];
                $(".Operator").autocomplete({
                    source: DaftarOperator
                });
                // $('.tunggalTanggal').daterangepicker({
                //     singleDatePicker: true,
                //     showDropdowns: true,
                //     minYear: 2021,
                //     autoclose: true,
                //     maxYear: parseInt(moment().format('YYYY'), 10)
                // }, function(start, end, label) {
                //     var years = moment().diff(start, 'years');

                // });

                $(".tunggalTanggal").datepicker();

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
        var DaftarSupervisor = [
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
        $("#Supervisor").autocomplete({
            source: DaftarSupervisor
        });
    });
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
    function UpdateData(tes) {

        console.log(tes.value)
        console.log(tes.getAttribute('targetid'))

        $.ajax({
            type: "POST",
            async: false,
            data: {
                Nilai: tes.value,
                Id: tes.getAttribute('targetid'),
                Kolom: tes.getAttribute('targetkolom')
            },
            url: '<?php echo base_url(); ?>/servicewilayah/update_data_sls',
            dataType: 'json',
            success: function(output) {





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