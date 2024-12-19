<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrate en MiProde</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url()?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="<?= base_url()?>/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/css/adminlte.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/css/miprode/sessions.css')?>">
</head>
<?php
session_start();

?>
<body class="hold-transition register-page" style="overflow: hidden">
  <section class="session-bg register-out-bg register-container">
      
    <div class="form-container">
        
      <h2 class="app-title">MiProde</h2>
      <img src="<?= base_url('/img/bet-logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle">

      <h4 class="mb-3 fw-normal">Para registrarte completá:</h4>

      <form action="<?php echo base_url('saveUser');?>" method="post" name="agregarModificarUsuario">
        <!-- 
          No andaba porque entraba al update era porque antes la pare de abajo estaba de la siguiente manera:
        
          Es necesario dejar el isset porque se rompe sino...
        
          Mirar chatgtp para ver de como mantentener el valor del formulario (eso que querias hacer)

          Borrar todo el comentario
        -->
        <input type="hidden" name="id" value="<?php echo isset($usuarioEditar) ? $usuarioEditar['id'] : ''; ?>">

        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre de usuario" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Correo electrónico" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="password" class="form-control" name="contraseña" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="password" class="form-control" name="contraseña_repetida" placeholder="Repetir contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="text" class="form-control" name="nombre_completo" placeholder="Nombre Completo" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <span class="fas fa-user-tag"></span>
            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <span class="fas fa-user-tie"></span>
            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <input type="number" class="form-control" name="dni" placeholder="DNI" required>
          <div class="input-group-append">
            <div class="input-group-text form-icon">
              <i class='fa fa-id-badge'></i>

            </div>
          </div>
        </div>
        <div class="form-floating form-input input-group mb-3 col-12">
          <div class="input-group date" id="fechaNacimientoGroupDate" data-target-input="nearest">
            <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de nacimiento" class="form-control datetimepicker-input"/>
            <div class="input-group-append" data-target="#fechaNacimientoGroupDate" data-toggle="datetimepicker">
                <div class="input-group-text form-icon">
                  <i class="fa fa-calendar"></i>
                </div>
            </div>
          </div>
        </div>
      
        <?php if (!empty($error)): ?>
          <div class="alert-error">
              <?= esc($error) ?>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-8">
            <!--<div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
              I agree to the <a href="#">terms</a>
              </label>
            </div>-->
          </div>
          <!-- /.col -->
          <div class="col-12 login-button-container">
            <button type="submit" name="submit" class="form-control login-button">Registrate</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!--<div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>-->


      <div class="col-12 login-button-container text-center mb-3 mt-1">

        <p>¿Ya sos parte del prode? <a href="<?= site_url('/login')?>" class="text-center">Volver al inicio de session</a></p>
      </div>
    </div><!-- /.Containere -->
</section>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?= base_url()?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>/dist/js/adminlte.min.js"></script>

<script src="<?= base_url('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>
<script src="<?= base_url('plugins/moment/moment.min.js')?>"></script>
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>

<script>
  $(function () {
    //Date range picker with time picker
    $('#fechaNacimientoGroupDate')?.datetimepicker({
      format: 'DD/MM/YYYY',
    })
  });
</script>
</body>
</html>