<?php
if ($this->session->userdata('Email'))
    redirect('site/dashboard');

?>




<?php


include APPPATH . 'third_party/glogin/config.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Add font awesome icons to buttons (note that the fa-spin class rotates the icon) -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evaluasi BPS Kabupaten Rembang | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/AdminLTE-master/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body class="hold-transition login-page">

    <div class="login-box align-items-center">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <i class="fa fa-desktop fa-2x" aria-hidden="true"></i> <a href="<?php echo base_url(); ?>" class="h1"><b>Evaluasi</b> <br>BPS Rembang</a>
            </div>
            <div class="card-body">

                <form id="formLogin">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username Community">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password Community">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">


                            <button id="buttonSubmit" type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>

                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a hidden href="<?php echo $google_client->createAuthUrl(); ?>" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <script src="<?php echo base_url(); ?>/AdminLTE-master/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/AdminLTE-master/dist/js/adminlte.min.js"></script>
</body>

</html>

<script>
    var cm = $('.CodeMirror')[0].CodeMirror;

    //Hide
    $(cm.getWrapperElement()).hide();
</script>



<script>
    $("#formLogin").submit(function(event) {
        $("#buttonSubmit").html(" <i class='fa fa-refresh fa-spin'></i> Proses ");

        $.ajax({
            type: "POST",
            cache: false,
            url: '<?php echo base_url(); ?>/servicepengguna/login_jatengklik',
            dataType: 'json',
            data: {
                username: $("#username").val(),
                password: $("#password").val()
            },
            success: function(output) {
                // $("#buttonSubmit").html(" Login ");

                console.log(output)
                if (output.sukses == true)
                    location.reload();
                else if (output.sukses == false)
                    $("#buttonSubmit").html(" Login ");



            }

        })

        event.preventDefault()




    });
</script>