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
                <label for="" class="col-sm-3 col-form-label">Tanggal Laporan </label>
                <div class="col-sm-9">
                    <input autocomplete="off" type="text" class="form-control rangeTanggal" id="rangeTanggal" value="" />

                </div>
            </div>

            <button id="buttonTampilRekap" onclick="tampilRekapLaporan()" type="button" class="btn btn-success float-right"><i class="fa fa-filter" aria-hidden="true"></i> Tampilkan Rekap</button>
            <ibutton type="button" onclick="printDiv('TabelRekapLaporan')" type="button" class="btn btn-danger float-left" value="Cetak Rekap" /><i class="fa fa-file-text" aria-hidden="true"></i> Cetak Rekap</button>
        </div>
        <div class="card-body">
            <div id="divTabel" class="table-responsive card-body p-0" style="display: block;">
                <table id="TabelRekapLaporan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>

                        </tr>

                    </thead>
                    <tbody></tbody>
                </table>

            </div>

        </div>
        <!-- /.card-body -->
    </div>

</section>

<div class="modal fade" id="modalTambahLaporanHarian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Jenis (WFO/WFH)</label>
                            <div class="col-sm-10">
                                <select required id="jenisKehadiran" required class="custom-select">
                                    <option value=''>--PILIH--</option>
                                    <option value='wfh'>WFH</option>
                                    <option value='wfo'>WFO</option>

                                </select>
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
    function tampilRekapLaporan() {
        $("#buttonTampilRekap").html(" <i class='fa fa-refresh fa-spin'></i> Sedang Proses Ambil Data ");

        $('#TabelRekapLaporan tbody').empty();
        $('#TabelRekapLaporan thead').empty();
        const myArray = $("#rangeTanggal").val().split("-");
        var start = new Date(myArray[0]);
        var end = new Date(myArray[1]);


        var loop = new Date(start);

        var loopToPegawai = []
        var toHeadTabel = '<tr><td>Nama </td>'

        while (loop <= end) {
            console.log(loop.toLocaleDateString('en-CA'));
            // console.log(formatDate(loop));
            toHeadTabel = toHeadTabel + '<td>' + loop.toLocaleDateString('en-CA') + '</td>';
            // $('#TabelRekapLaporan thead tr').append('<td>' + loop.toLocaleDateString('en-CA') + '</td>');
            loopToPegawai.push(loop.toLocaleDateString('en-CA'))
            var newDate = loop.setDate(loop.getDate() + 1);
            loop = new Date(newDate);
        }
        toHeadTabel = toHeadTabel + '</tr>'
        $('#TabelRekapLaporan thead').append(toHeadTabel);

        console.log(loopToPegawai)

        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/servicelaporanharian/read_rekap_laporan',
            dataType: 'json',
            data: {
                RangeTanggal: $("#rangeTanggal").val()
            },
            success: function(output) {
                console.log(output);
                // console.log(outputData);
                for (var i = 0; i < output.length; i++) {
                    var toWrite = '<tr><td>' + output[i].Nama + '</td>';


                    output[i].DataLaporan.forEach(element => {

                        if (element.Data.JumUpload == 1)
                            var kett = 'V'
                        else
                            var kett = '-'
                        toWrite = toWrite + '<td>' + kett + '</td>';
                        // $('#TabelRekapLaporan tbody tr').append('<td>' + output[i].Nama + '</td>');

                    });
                    toWrite = toWrite + '</tr>'
                    $('#TabelRekapLaporan tbody').append(toWrite);
                } // End For

                setTimeout(() => {
                    $("#TabelRekapLaporan").dataTable({
                        paging: false,
                        dom: 'Bfrtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ]
                    })
                    $("#buttonTampilRekap").html(" <i class='fa fa-filter' aria-hidden='true'></i> Tampilkan Laporan ");

                }, 2000);

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
        tampilRekapLaporan($("#bulanPekerjaan").val(), $("#tahunPekerjaan").val(), globalIdPengguna)
    });
</script>

<script>
    function bukaModalTambahLaporanHarian(RecId) {
        $('#modalTambahLaporanHarian').modal('show');
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
                    tampilRekapLaporan($("#bulanPekerjaan").val(), $("#tahunPekerjaan").val(), $("#idPengguna").val())
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
    setTimeout(() => {
        tampilRekapLaporan()
    }, 1000);
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
    function printDiv(divName) {
        var divContents = document.getElementById("divTabel").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write('<body > <h1>Div contents are <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
        // w.close();
    }
</script>