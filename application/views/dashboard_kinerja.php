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
          <div class="container-fluid">
            <div id="deadline" class="row">

              <div id="ojo" class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

            </div>
          </div>
          <div id="container_laporan_harian" class="card-body box-profile"> </div>
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
    $.ajax({
      type: "POST",
      async: false,
      data: {
        Bulan: $("#bulanPekerjaan").val(),
        Tahun: $("#tahunPekerjaan").val()
      },
      url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/dashboard_deadline',
      dataType: 'json',
      success: function(output) {
        console.log(output)
        $("#deadline").empty()
        output.forEach(dataDeadline => {
          $("#deadline").append("<div class='col-lg-3 col-6'>" +
            "<div class='small-box bg-error'>" +
            " <div class='inner'>" +
            " <h3 class='blink_me'>"+dataDeadline.date_difference+" hari lagi</h3>" +

            " <p>" + dataDeadline.Deskripsi + "</p>" +
            " </div>" +
            " <div class='icon'>" +
            "   <i class='fa-file-audio-o '></i>" +
            " </div>" +
            " <a href='#' class='small-box-footer'> <i class='fas fa-arrow-circle-right'></i></a>" +
            " </div>" +
            " </div>")


        });

      },

      error: function(e) {
        console.log(e.responseText);

      }
    });
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
        jumlahLaporanHarian = [];
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

          let warnaLaporanHarian
          if (row.KinerjaLaporanHarian.jum > 18)
            warnaLaporanHarian = 'green'
          else if (row.KinerjaLaporanHarian.jum > 10)
            warnaLaporanHarian = 'blue'
          else warnaLaporanHarian = 'red'

          jumlahLaporanHarian.push({
            y: parseInt(row.KinerjaLaporanHarian.jum),
            color: warnaLaporanHarian
          })
          nilai.push({
            y: parseInt(row.Ringkasan.rerataPersentaseKinerja),
            color: warna
          })

          nilaiKegiatan.push({
            y: parseInt(row.Ringkasan.jumKegiatan),
            color: 'green'
          })

        });

        Highcharts.chart('container_laporan_harian', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Jumlah Upload Laporan Harian Bulan ' + $("#bulanPekerjaan").val() + ' Tahun ' + $("#tahunPekerjaan").val()
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
              text: 'Jumlah',
              align: 'high'
            },
            labels: {
              overflow: 'justify'
            }
          },
          tooltip: {
            valueSuffix: ' laporan'
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
            name: 'Jumlah Laporan',
            data: jumlahLaporanHarian,
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
    $("#bulanPekerjaan").val(globalBulan + 1)
    $("#tahunPekerjaan").val(globalTahun)

    tampilData()
  }, 1000);
</script>

<script>
  function bukamodalQuote() {
    $('#modalQuote').modal('show');
  }

  let pantun = "<?php echo $this->uri->segment(3); ?>"
  if (pantun == 'pantun')
    // bukamodalQuote()
</script>