<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url()?> /plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('/css/miprode/login.css')?>">
</head>
<body class="hold-transition sidebar-mini" style="overflow: hidden">
    <section class="login-bg">
        <div class="form-container">
            <img src="<?= base_url('/img/bet-logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle">

            <h4 class="mb-3 fw-normal">Inicie sesión en su cuenta</h4>
            <form class="form-card" action="<?php echo base_url('auth');?>" method="post" name="login">
                <div class="form-floating form-input col-12">
                    <input name="nombre" class="form-control" placeholder="Nombre" value="">
                </div>
                <br>

                <div class="form-floating form-input col-12">
                    <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" value="">
                </div>
                <br>

                <div class="col-12">
                    <button type="submit" name="submit" class="form-control login-button">Iniciar sesión</button>
                </div>
            </form>
        </div><!-- /.form -->
    </section>
</body>