    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="<?= base_url('/img/bet-logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">MiProde</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= base_url('/img/user-default-1.png') ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo session()->usuario ?></a>
                    <form action="<?php echo base_url('logout');?>" method="post" name="logout">
                        <button class="btn" type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cerrar sesión">
                            <i class="fa-solid fa-right-from-bracket" style="color: white"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="../gallery.html" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Gallery
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="fixture/verTorneos" class="nav-link">
                            <i class="nav-icon fa-solid fa-table"></i>
                            <p>
                                Fixture
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="fixture/verTorneos" class="nav-link">
                            <i class="nav-icon fa-solid fa-circle-dollar-to-slot"></i>
                            <p>
                                Apuesta
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content">