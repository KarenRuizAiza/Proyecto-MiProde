<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicia sesión en MiProde</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url()?> /plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('/css/miprode/sessions.css')?>">
</head>
<?php
session_start();

// Verificar si hay un mensaje en la sesión
if (isset($_SESSION['alta_exitosa'])) {
    echo "<script>alert('" . $_SESSION['alta_exitosa'] . "');</script>";
    // Después de mostrar el mensaje, borrar el mensaje de la sesión
    unset($_SESSION['alta_exitosa']);
}
?>
<body class="hold-transition sidebar-mini" style="overflow: hidden">
    <section class="session-bg">
        <div class="form-container">

            <h2 class="app-title">MiProde</h2>
            <img src="<?= base_url('/img/bet-logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle">

            <h4 class="mb-3 fw-normal">Inicie sesión en su cuenta</h4>
            <form class="form-card" action="<?php echo base_url('auth');?>" method="post" name="login">
                <div class="form-floating form-input col-12">
                    <input name="nombre" class="form-control" placeholder="Nombre" value="" required>
                </div>
                <br>

                <div class="form-floating form-input col-12">
                    <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" value="" required>
                </div>

                <br>
                <?php if (!empty($error)): ?>
                    <div class="alert-error">
                        <?= esc($error) ?>
                    </div>
                <?php endif; ?>

                <br>

                <div class="col-12 login-button-container">
                    <button type="submit" name="submit" class="form-control login-button">Iniciar sesión</button>

                    <p>¿No sos parte de MiProde? <a href="<?= site_url('register')?>">Sumate creando tu cuenta aquí.</a></p>
                </div>
            </form>
        </div><!-- /.form -->
    </section>
</body>