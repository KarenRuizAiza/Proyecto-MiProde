<?php
/**
 * View: Home Module
 * Description: Main landing page for MiProde, redesigned with teal theme.
 */
?>
<link rel="stylesheet" href="<?= base_url('/css/home.css')?>">

<div class="home-container">
    <!-- Hero Section with Teal Gradient -->
    <div class="hero-section">
        <div class="container">
            <?php if(session()->rol == 'Administrador'): ?>
                <h1 class="hero-title">Bienvenido Administrador</h1>
                <p class="hero-subtitle">Gestión del Sistema MiProde.</p>
            <?php else: ?>
                <h1 class="hero-title">BIENVENIDO A MIPRODE</h1>
                <p class="hero-subtitle">Realiza tus predicciones y compite con tus amigos.</p>
                <?php if(!session()->has('usuarioId')): ?>
                    <a href="<?= site_url('/register') ?>" class="btn btn-hero">REGÍSTRATE</a>
                <?php else: ?>
                    <a href="<?= site_url('/torneos') ?>" class="btn btn-hero">VER TORNEOS</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if(session()->rol == 'Administrador'): ?>
    <div class="container pb-5 mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row text-center">
                    
                    <!-- User Management Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card admin-card h-100">
                            <i class="fas fa-user-cog fa-3x mb-3 text-teal"></i>
                            <h4 class="card-title">Gestión de Usuarios</h4>
                            <p class="card-text text-muted mb-4">Administra los usuarios registrados en el sistema.</p>
                            <div class="mt-auto px-3 mb-4">
                                <a href="<?= site_url('/usuarios') ?>" class="btn btn-teal btn-block">Ver Usuarios</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tournament Management Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card admin-card h-100">
                            <i class="fas fa-trophy fa-3x mb-3 text-teal"></i>
                            <h4 class="card-title">Gestión de Torneos</h4>
                            <p class="card-text text-muted mb-4">Crea, modifica y organiza los torneos y sus fases.</p>
                            <div class="mt-auto px-3 mb-4">
                                <a href="<?= site_url('/torneos') ?>" class="btn btn-teal btn-block">Ver Torneos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Team Management Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card admin-card h-100">
                            <i class="fas fa-shield-alt fa-3x mb-3 text-teal"></i>
                            <h4 class="card-title">Gestión de Equipos</h4>
                            <p class="card-text text-muted mb-4">Administra el listado de equipos participantes.</p>
                            <div class="mt-auto px-3 mb-4">
                                <a href="<?= site_url('/equipos/') ?>" class="btn btn-teal btn-block">Ver Equipos</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session()->rol != 'Administrador'): ?>
    <div class="container pb-5">
        <div class="row justify-content-center">
            
            <!-- Cards Section -->
            <div class="col-lg-10">
                <div class="row">
                    
                    <!-- Challenges Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card challenge-card text-center h-100">
                            <i class="fas fa-users fa-3x mb-3"></i>
                            <h4 class="card-title">¡Crea tu Desafío!</h4>
                            <p class="card-text text-muted px-3">Invita a tus amigos, crea grupos privados y compite por el mejor ranking.</p>
                            
                            <div class="mt-auto mb-4 px-3">
                                <?php if(session()->has('usuarioId')): ?>
                                    <a href="<?= site_url('/desafios') ?>" class="btn btn-teal btn-lg btn-block">Crear Desafío</a>
                                <?php else: ?>
                                    <a href="<?= site_url('/login') ?>" class="btn btn-teal btn-lg btn-block">Iniciar Sesión para Empezar</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Tournaments Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card tournament-list h-100">
                            <div class="tournament-header">
                                <i class="fas fa-star mr-2"></i> Torneos Populares
                            </div>
                            <div class="card-body p-0">
                                <?php if(!empty($torneos)): ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach($torneos as $torneo): ?>
                                            <a href="<?= site_url('/torneos') ?>" class="tournament-item list-group-item list-group-item-action border-0">
                                                <i class="fas fa-trophy mr-3 text-warning"></i>
                                                <span><?= esc($torneo['nombre']) ?></span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="p-4 text-center text-muted">
                                        No hay torneos activos disponibles.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php endif; ?>
</div>
