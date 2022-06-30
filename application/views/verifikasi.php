
<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>SPK. Pemilihan Paket Internet Metode SAW</title>
  <!-- Favicon -->
  <link rel="icon" href="<?=base_url()?>assets/argon/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/argon/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>assets/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/argon/css/argon.css?v=1.1.0" type="text/css">
</head>

<body class="bg-default">
 
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h3 class="text-white">Sistem Pendukung Keputusan</h3>
              <p class="text-lead text-white">Pemilihan Paket Internet Menggunakan Metode SAW</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4"> 

                <?= $this->session->flashdata('msg') ?>
              </div>
               center>
       <b>
      <p>Verifikasi Kode</p>
    </b>
     </center>
                <?php echo form_open('lupapassword/proses') ?> 
                <input type="hidden" name="email" value="<?=$email?>">
            <div class="row">
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="first" type="text" name="k1" class="form-control" style="text-align: center;">
              </div>
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="second" type="text" name="k2" class="form-control" style="text-align: center;">
              </div>
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="third" type="text" name="k3" class="form-control" style="text-align: center;">
              </div>
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="fourth" type="text" name="k4" class="form-control" style="text-align: center;">
              </div> 
            </div>
            <br>
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <center>  <input type="submit" class="btn btn-block bg-blue waves-effect" value="Verifikasi" name="proses"> </center>
          </div>
          <!-- /.col -->
                        <br>
                        <br>
                        <center>kirim ulang kode verifikasi anda ?  <span style="color : red" id="bataswaktu"></span><span style="color : blue" id="kirimulang"></span></center> 
        </div>
      </form>
            </div>

          </div> 
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
 
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?=base_url()?>assets/argon/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/argon/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?=base_url()?>assets/argon/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?=base_url()?>assets/argon/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="<?=base_url()?>assets/argon/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="<?=base_url()?>assets/argon/js/demo.min.js"></script>
</body>

</html>