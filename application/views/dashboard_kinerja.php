<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
  var globalTahun = new Date().getFullYear()
  var globalBulan = new Date().getMonth()
</script>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
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
                <select onchange="tampilData()" id="bulanPekerjaan" required class="custom-select">
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
            <button onclick="tampilData()" type="button" class="btn btn-success float-left">Tampilkan</button>
          </div>
          <div id="container_persentase" class="card-body box-profile">

          </div>
          <div id="container_kegiatan" class="card-body box-profile">

          </div>

        </div>

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row"></div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<div class="modal fade" id="modalPenugasanPekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">QUOTE</h1>



      </div>
      <div class="modal-body">
        <blockquote class="blockquote text-left">
          <p class="mb-0">
          <h1>
            <p><i>Gelar Kloso DiLenggui Wong Papat. Ojo Roso Roso, Ayo Semangat.</i></p>
          </h1>.</p>
          <footer class="blockquote-footer">Mas <cite title="Source Title">Bro</cite></footer>
        </blockquote>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  function tampilData() {
    $.ajax({
      type: "POST",
      async: false,
      data: {
        Bulan: $("#bulanPekerjaan").val(),
        Tahun: $("#tahunPekerjaan").val()
      },
      url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/dashboard_kinerja',
      dataType: 'json',
      success: function(output) {
        console.log(output)
        categories = [];
        nilai = [];
        nilaiKegiatan = [];
        warna = [];
        output.forEach(row => {
          categories.push(row.Nama)

          let warna
          if (row.Ringkasan.rerataPersentaseKinerja > 95)
            warna = 'green'
          else if (row.Ringkasan.rerataPersentaseKinerja > 65)
            warna = 'blue'
          else warna = 'red'

          nilai.push({
            y: parseInt(row.Ringkasan.rerataPersentaseKinerja),
            color: warna
          })

          nilaiKegiatan.push({
            y: parseInt(row.Ringkasan.jumKegiatan),
            color: 'green'
          })

        });



        Highcharts.chart('container_persentase', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Kinerja Bulan ' + $("#bulanPekerjaan").val() + ' Tahun ' + $("#tahunPekerjaan").val()
          },
          xAxis: {
            categories: categories,
            title: {
              text: null
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Persentase',
              align: 'high'
            },
            labels: {
              overflow: 'justify'
            }
          },
          tooltip: {
            valueSuffix: ' persen'
          },
          plotOptions: {
            bar: {
              dataLabels: {
                enabled: true
              }
            }
          },
          // colors: warna,
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Persentase Kinerja',
            data: nilai,
            dataLabels: {
              enabled: true,

              rotation: 0,
              color: '#FFFAFF',
              align: 'right',
              format: '{point.y:.0f}', // one decimal
              y: 10, // 10 pixels down from the top
              style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif'
              }

            }

          }]
        });

        Highcharts.chart('container_kegiatan', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Jumlah Kegiatan di Bulan ' + $("#bulanPekerjaan").val() + ' Tahun ' + $("#tahunPekerjaan").val()
          },
          xAxis: {
            categories: categories,
            title: {
              text: null
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Jumlah Kegiatan',
              align: 'high'
            },
            labels: {
              overflow: 'justify'
            }
          },
          tooltip: {
            valueSuffix: ' '
          },
          plotOptions: {
            bar: {
              dataLabels: {
                enabled: true
              }
            }
          },
          // colors: warna,
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Jumlah Kegiatan',
            data: nilaiKegiatan,
            dataLabels: {
              enabled: true,
              inside: true,

              rotation: 0,
              color: '#FFFAFF',
              align: 'right',
              format: '{point.y:.0f}', // zero decimal
              y: 10, // 10 pixels down from the top
              style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif'
              }

            }

          }]
        });

      },

      error: function(e) {
        console.log(e.responseText);

      }
    });



  }
</script>

<script>
  setTimeout(() => {
    $("#bulanPekerjaan").val(globalBulan)
    $("#tahunPekerjaan").val(globalTahun)

    tampilData()
  }, 1000);
</script>

<script>
  function bukaModalPenugasanPekerjaan() {



    $('#modalPenugasanPekerjaan').modal('show');





  }
  bukaModalPenugasanPekerjaan()
</script>