<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMT | Login</title>
  <link rel="icon" href="<?= base_url(); ?>assets/dist/img/logo_psd.png" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" onload="getcookiedata()">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>PMT</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign In</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
          <div class="col-md-12">
            <?php echo validation_errors(
              '<div class="alert alert-danger alert-dismissable">',
              ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'
            ); ?>
          </div>
        </div>
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?= $this->session->unset_userdata('success') ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
          <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?= $this->session->unset_userdata('error') ?>
        <?php endif; ?>
        <form action="<?php echo base_url(); ?>Login" method="post">
          <div class="input-group mb-3">
            <input class="form-control" name="user_account" placeholder="User Account" id="employee_account">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" id="password" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" onclick="setcookie()">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
</body>

</html>

<script type="text/javascript">
  function setcookie() {
    var u = document.getElementById('employee_account').value;
    var p = document.getElementById('password').value;
    const d = new Date();
    d.setTime(d.getTime() + (9 * 60 * 60 * 1000));
    let expires = d.toUTCString();
    document.cookie = "myemployeeaccount=" + u + "; expires=" + expires + "; path=http://localhost/pmt/login";
    document.cookie = "mypassword=" + p + ";  expires=" + expires + " path=http://localhost/pmt/login";
    // console.log(expireTime);
  }

  function getcookiedata() {
    console.log(document.cookie);
    var employeeaccount = getCookie('myemployeeaccount');
    var password = getCookie('mypassword');

    document.getElementById('employee_account').value = employeeaccount;
    document.getElementById('password').value = password;
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
</script>