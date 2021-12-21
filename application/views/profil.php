<script>
  var penggunaId = <?php echo $this->session->userdata('RecId');  ?>
</script>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="<?php echo $this->session->userdata('UrlPicture'); ?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $this->session->userdata('Nama'); ?></h3>

            <p class="text-muted text-center"><?php echo $this->session->userdata('Email'); ?></p>


          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tentang Saya</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Satuan Kerja</strong>

            <p class="text-muted">
              <?php echo $detailPengguna['data']['NamaSatker']; ?>
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Unit Kerja</strong>

            <p class="text-muted"> <?php echo $detailPengguna['data']['NamaOrganisasi']; ?>
            </p>

            <hr>



           

            <strong><i class="far fa-file-alt mr-1"></i> Opsi Login</strong>

            <p class="text-muted"> <?php echo $detailPengguna['data']['OpsiLogin']; ?>
            </p>
            <hr>
            <strong><i class="far fa-file-alt mr-1"></i> Role Aktif</strong>

            <p class="text-muted"> <?php echo $this->session->userdata('RoleAktif'); ?>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link  active" href="#settings" data-toggle="tab">Settings</a></li>
              <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <!-- /.tab-pane -->

              <div class="active  tab-pane" id="settings">
                <form id="formUbahPengguna" class="form-horizontal">


                  <input type="hidden" class="form-control" id="recIdEdit" placeholder="">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="emailEdit" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NIP Lama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nipEdit" placeholder="NIP Lama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NIP Baru</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nipBaruEdit" placeholder="NIP Baru">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" required id="namaEdit" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" required id="jabatanEdit" placeholder="Jabatan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Atasan</label>
                    <div class="col-sm-10">
                      <select id="atasanIdEdit" class="custom-select">
                        <option value=''>--Pilih Opsi--</option>

                        <?php
                        foreach ($pengguna['data'] as $rows) {

                        ?>

                          <option value='<?php echo $rows['RecId']; ?>'><?php echo $rows['Nama']; ?></option>

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
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>


<script>
  function tampilProfilPengguna(RecId) {
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

        $("#recIdEdit").val(RecId)

        $("#nipBaruEdit").val(output.NipBaru)
        $("#nipEdit").val(output.NipLama)
        $("#namaEdit").val(output.Nama)
        $("#jabatanEdit").val(output.Jabatan)
        $("#atasanIdEdit").val(output.AtasanId)
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
  $("#formUbahPengguna").submit(function(e) {
    $.ajax({
      type: "POST",
      async: false,
      url: '<?php echo base_url(); ?>/servicepengguna/update_pengguna_by_id',
      dataType: 'json',
      data: {
        RecId: $('#recIdEdit').val(),
        Nama: $('#namaEdit').val(),
        Jabatan: $('#jabatanEdit').val(),
        NipLama: $('#nipEdit').val(),
        NipBaru: $('#nipBaruEdit').val(),
        AtasanId: $('#atasanIdEdit').val(),
        SatkerId: $('#satkerIdEdit').val(),
        OrganisasiId: $('#organisasiIdEdit').val(),
        OpsiLoginId: $('#opsiLoginIdEdit').val()
      },
      success: function(output) {
        console.log(output)
        // $("modalE")
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
  tampilProfilPengguna(penggunaId)
</script>