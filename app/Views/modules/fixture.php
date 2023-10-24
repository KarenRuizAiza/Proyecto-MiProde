<main class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $titulo ?></h3>
        </div>
        <?php if (!empty($partidos)) { ?>
            <div class="card-body p-0">
                <div class="card text-center">
                    <div class="card-header">
<!--                        <h3>--><?//= $partidos[0]['nombre_torneo'] ?><!--</h3>-->
                    </div>
                    <div class="card-body text-left">
                        <?php $cant_partidos = count($partidos); ?>
                        <?php $i = 0; ?>
                        <?php foreach ($partidos as $p) : ?>
                            <div class="match-card">
                                <!--<span class="match-card-tittle">Khallifa International Stadium, Municipio de Rayan</span>-->
                                <span <?php if($p['grupo']){ echo 'style="visibility:visible;"'; } else { echo 'style="visibility:hidden;"';} ?>>
                                            Grupo <?= $p['grupo'] ? $p['grupo'] : '' ?>
                                    </span>
                                <div class="match-info">
                                    <div class="team-container">
                                        <div class="team">
                                            <img src="<?= base_url()?>/img/teams/<?=$p['local']?>.svg">
                                            <span><?= $p['local'] ?></span>
                                        </div>
                                        <div class="team">
                                            <img src="<?= base_url()?>/img/teams/<?=$p['visitante']?>.svg">
                                            <span><?= $p['visitante'] ?></span>
                                        </div>
                                    </div>

                                    <div class="time-container">
                                        <div class="time">
                                            <span><?= DateTime::createFromFormat('Y-m-d', $p['fecha'])->format('d M Y') ?></span>
                                        </div>
                                        <div class="time">
                                            <span><?= date("H:i", strtotime($p['hora'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
