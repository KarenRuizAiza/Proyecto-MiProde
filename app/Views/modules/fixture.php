
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h2> <?= $titulo?> </h2>
                    </div>
                </div>

                <h4>Apuesta con <?=$cantidada_aciertos?> aciertos</h4>
            </section>
            <section class="content" style="max-height: 44rem; overflow: auto;">
                <div class="justify-content-center container-fluid fixture-body">

                    <?php foreach ($fixture as $fase => $partidos) : ?>
                        <div class="fase-container">
                            <h5><?= $fase ?></h5>

                            <!-- Listado de partidos -->
                            <?php foreach ($partidos as $p) : ?>
                                <div class="d-flex flex-column mb-2" style="width: 25rem;">
                                    <div class="d-flex">
                                        <div class="fixture-time-container">
                                            <span>
                                                <?= DateTime::createFromFormat('Y-m-d', $p['fecha'])->format('d M Y') ?>
                                                <span><?= date("H:i", strtotime($p['hora'])) ?>
                                            </span>
                                        </div>

                                        <span class="resultado-fixture d-flex ml-3">
                                            <strong>Predicción: </strong> <?= $p['resultado_prediccion'] ? $p['resultado_prediccion'] : 'Sin predicción' ?>
                                        </span>
                                        <?php if ($p['resultado']) { ?>
                                            <button type="button" class="resultado-popover btn btn-outline-info" data-toggle="popover" data-trigger="focus" title="Resultado del Partido"
                                                data-content="
                                                <span class='info-partido d-flex'>
                                                   <strong>Ganador:</strong> <span><?=$p['resultado'] ? $p['resultado'] : 'Sin resultado'?></span>
                                                </span>
                                                <div class='resultado-team-container'>
                                                    <div class='fixture-team' style='justify-content: right;'>
                                                        <span><?=$p['local']?></span>
                                                        <img src='<?= base_url()?>/img/teams/<?=$p['local']?>.svg' alt='Equipo Local'>
                                                    </div>
                                                    <span class='vs'>VS</span>
                                                    <div class='fixture-team'>
                                                        <img src='<?= base_url()?>/img/teams/<?=$p['visitante']?>.svg' alt='Equipo Visitante'>
                                                        <span><?=$p['visitante']?></span>
                                                    </div>
                                                </div>">
                                                <i class='fa fa-eye'></i> Resultado
                                            </button>
                                        <?php } else { ?>
                                            <button type="button" class="resultado-popover btn btn-outline-info disabled-item" disabled title="Resultado del Partido">
                                                <i class='fa fa-eye'></i> Resultado
                                            </button>
                                        <?php } ?>
                                        
                                    </div>
                                    
                                    <?php 
                                    if($p['id_prediccion'] == null || $p['resultado'] == null) { ?>
                                        <div class="fixture-team-container">
                                    <?php } else if($p['acerto_prediccion']) {?>
                                        <div class="fixture-team-container acierta"> 
                                    <?php } else { ?>
                                        <div class="fixture-team-container no-acierta">
                                    <?php }
                                    ?>

                                        <div class="fixture-team" style="justify-content: right;">
                                            <?php
                                            if(isset($p['local_prediccion']) && $p['local_prediccion']){ ?>
                                                <span><?=$p['local_prediccion']?></span>
                                                <img src="<?= base_url()?>/img/teams/<?=$p['local_prediccion']?>.svg">
                                            <?php 
                                            } else if(isset($p['local']) && $p['local']) { ?>
                                                <span><?=$p['local']?></span>
                                                <img src="<?= base_url()?>/img/teams/<?=$p['local']?>.svg">
                                            <?php
                                            } else { ?>
                                          <div>
                                                    <span class='fixture-undefined-team'>Sin definir</span>
                                                    <img src="<?= base_url()?>/img/teams/<?='Unknown_flag'?>.svg">
                                                </div>
                                            <?php } 
                                            ?>
                                        </div>
                                        <span class="vs">VS</span>
                                        <div class="fixture-team">
                                        <?php
                                            if(isset($p['visitante_prediccion']) && $p['visitante_prediccion']){ ?>
                                                <img src="<?= base_url()?>/img/teams/<?=$p['visitante_prediccion']?>.svg">
                                                <span><?=$p['visitante_prediccion']?></span>
                                            <?php 
                                            } else if(isset($p['visitante']) && $p['visitante']) { ?>
                                                <img src="<?= base_url()?>/img/teams/<?=$p['visitante']?>.svg">
                                                <span><?=$p['visitante']?></span>
                                            <?php
                                            } else { ?>
                                                <div>
                                                    <img src="<?= base_url()?>/img/teams/<?='Unknown_flag'?>.svg">
                                                    <span class='fixture-undefined-team'>Sin definir</span>
                                                </div>
                                            <?php } 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            
                            <?php endforeach; ?>
                            <!-- /.listado de partidos -->
                        </div>
                    <?php endforeach; ?>
                </div><!-- /.fixture-body -->
            </section>

            
            <script>
                // Inicializamos los popovers cuando el documento esté listo
                $(document).ready(function() {
                    // Inicializar popover
                    $('[data-toggle="popover"]').popover({
                        html: true  // Esto permite que se interprete HTML dentro del popover
                    });

                    $('.popover-dismiss').popover({
                        trigger: 'focus'
                    });
                });
            </script>