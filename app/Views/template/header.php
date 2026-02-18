<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qatar 2022</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url()?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?= base_url()?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- MiProde Styles -->
    <link rel="stylesheet" href="<?= base_url('/css/miprode/partido.css')?>">
    <link rel="stylesheet" href="<?= base_url('/css/miprode/formularios.css')?>">
    <link rel="stylesheet" href="<?= base_url('/css/miprode/fixture.css')?>">
</head>
<body class="hold-transition sidebar-mini" style="overflow: hidden">

    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">

      <?php if (session()->getFlashdata('success')): ?>
          <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')): ?>
          <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        </div>
      <?php endif; ?>

    </div>

    <?= view('components/loader') ?>
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="/" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <!--<li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Equipos</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= site_url('/torneos')?>" class="nav-link">Torneos</a>
          </li>-->
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <?php if(!session()->has('usuarioId')): ?>
            <li class="nav-item">
              <a href="<?= site_url('/login') ?>" class="btn btn-outline-primary mr-2">Iniciar Sesión</a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('/register') ?>" class="btn btn-primary">Registrarse</a>
            </li>
          <?php else: ?>
            <li class="nav-item d-flex align-items-center">
              <span class="mr-3 text-muted">Hola, <?= esc(session()->usuario) ?></span>
              <form action="<?= site_url('logout') ?>" method="post" class="m-0">
                <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar Sesión</button>
              </form>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
      <!-- /.navbar -->
