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
          <div id="container" class="card-body box-profile">

          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row"></div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>


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

        });
      


        Highcharts.chart('container', {
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
              rotation: -90,
              color: '#FFFAFF',
              align: 'right',
              format: '{point.y:.1f}', // one decimal
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