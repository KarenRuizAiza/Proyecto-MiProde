<link rel="stylesheet" href="<?= base_url('/css/home.css')?>">

<div class="home-container">
    <div class="container">
        <!-- Hero Section -->
        <div class="row">
            <div class="col-12">
                <div class="hero-section">
                    <h1 class="hero-title">Bienvenido a MiProde</h1>
                    <p class="hero-subtitle">Demuestra tus conocimientos deportivos y gana.</p>
                    <?php if(!session()->has('id')): ?>
                        <a href="<?= site_url('/register') ?>" class="btn btn-primary btn-lg">Regístrate para Jugar</a>
                    <?php else: ?>
                        <a href="<?= site_url('/torneos') ?>" class="btn btn-primary btn-lg">Ver Torneos</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Main Content: Matches Fixture -->
            <div class="col-lg-8">
                <h3 class="section-title">Próximos Partidos</h3>
                
                <?php if(!empty($partidos)): ?>
                    <?php 
                        // Group matches by Phase and then by Group
                        $groupedMatches = [];
                        foreach($partidos as $partido) {
                            $phase = $partido['nombre_fase'];
                            $group = $partido['grupo'];
                            $groupedMatches[$phase][$group][] = $partido;
                        }
                    ?>

                    <?php foreach($groupedMatches as $phaseName => $groups): ?>
                        <div class="phase-section mb-4">
                            <div class="phase-header">
                                <h4><?= esc($phaseName) ?></h4>
                            </div>
                            
                            <div class="row">
                                <?php foreach($groups as $groupName => $matches): ?>
                                    <div class="col-md-6 col-xl-4 mb-3"> <!-- 3 columns on XL, 2 on MD -->
                                        <div class="group-card">
                                            <div class="group-header">
                                                <h5><?= esc($groupName) ?></h5>
                                            </div>
                                            <div class="group-content">
                                                <?php foreach($matches as $match): ?>
                                                    <div class="match-item-compact">
                                                        <div class="match-date-compact">
                                                            <?= date('d/m H:i', strtotime($match['fecha'] . ' ' . $match['hora'])) ?>
                                                        </div>
                                                        <div class="match-teams-compact">
                                                            <div class="team-name-compact"><?= esc($match['local']) ?></div>
                                                            <div class="vs-divider">vs</div>
                                                            <div class="team-name-compact"><?= esc($match['visitante']) ?></div>
                                                        </div>
                                                        <div class="match-actions-compact">
                                                            <button class="btn-compact btn-l" title="Gana Local">L</button>
                                                            <button class="btn-compact btn-e" title="Empate">E</button>
                                                            <button class="btn-compact btn-v" title="Gana Visitante">V</button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <?= $pager->links() ?>
                    </div>

                <?php else: ?>
                    <div class="alert alert-info">No hay partidos próximos disponibles.</div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Challenges & Promo -->
            <div class="col-lg-4">
                <!-- Challenges Card -->
                <div class="card challenge-card mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title text-white">¡Crea tu Desafío!</h5>
                        <p class="card-text text-muted">Invita a tus amigos, crea grupos privados y compite por el mejor ranking.</p>
                        <?php if(session()->has('id')): ?>
                            <a href="<?= site_url('/desafios') ?>" class="btn btn-outline-primary btn-block">Crear Desafío</a>
                        <?php else: ?>
                            <a href="<?= site_url('/login') ?>" class="btn btn-outline-primary btn-block">Iniciar Sesión para Crear</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tournaments List -->
                <div class="tournament-list mb-4">
                    <h5 class="text-white mb-3 pl-2">Torneos Populares</h5>
                    <?php if(!empty($torneos)): ?>
                        <?php foreach($torneos as $torneo): ?>
                            <a href="<?= site_url('/torneos') ?>" class="tournament-item">
                                <i class="fas fa-trophy mr-2"></i> <?= esc($torneo['nombre']) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted pl-2">No hay torneos activos.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('home-page');
        var wrapper = document.querySelector('.content-wrapper');
        if(wrapper) {
            wrapper.style.backgroundColor = '#0f1923';
            wrapper.style.marginLeft = '0'; // Remove sidebar margin
        }
        
        // Hide sidebar if it exists in DOM
        var sidebar = document.querySelector('.main-sidebar');
        if(sidebar) {
            sidebar.style.display = 'none';
        }
    });
</script>