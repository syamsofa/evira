<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
                <select id="bulanPekerjaan" required class="custom-select">
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
            <button onclick="tampilData()" type="button" class="btn btn-warning float-left">Tampilkan</button>
          </div>
        </div>
      </div>
    </div>
    
     <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
               <div id="container form-group row" class="row">
   </div>
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
      url: '<?php echo base_url(); ?>/servicepekerjaanpengguna/tess',
      dataType: 'json',
      success: function(output) {
        console.log(output)
        categories = [];
        nilai = [];
        output.forEach(row => {
          categories.push(row.Nama)
          nilai.push(parseInt(row.Ringkasan.rerataPersentasePenilaianAtasan))

        });
        console.log(nilai)

       
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
            data: nilai
          }]
        });

      },

      error: function(e) {
        console.log(e.responseText);

      }
    });



  }
</script>