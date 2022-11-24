<main class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $titulo ?></h3>
        </div>
        <?php if (!empty($partidos)) { ?>
            <div class="card-body p-0">
                <div class="card text-center">
                    <div class="card-header">
                        <h3><?= $partidos[0]['torneo'] ?></h3>
                    </div>
                    <div class="card-body text-left">
                        <?php $cant_partidos = count($partidos); ?>
                        <?php $i = 0; ?>
                        <?php while ($i < $cant_partidos) { ?>
                            <?php $instancia = $partidos[$i]['id_instancia']; ?>

                            <div class="fases box my-4">
                                <h4><?= ucfirst($partidos[$i]['instancia']) ?></h4>

                                <ul class="<?= $partidos[$i]['id_instancia'] == '1' ? 'list-group list-group-flush text-center' : 'list-group list-group-flush' ?>">
                                    <?php while ($i < $cant_partidos and $instancia == $partidos[$i]['id_instancia']) { ?>
                                        <?php if ($partidos[$i]['id_instancia'] == '1' ) { ?>
                                            <?php $grupo =  $partidos[$i]['id_grupo']; ?>
                                            <h5>Grupo <?= $partidos[$i]['grupo'] ?></h5>
                                            <?php while ($i < $cant_partidos and $grupo == $partidos[$i]['id_grupo']) { ?>

                                                <div class="timeline-item justify-content-center">
                                                    <span class="time"><i class="fas fa-clock"></i><?= $partidos[$i]['hora'] ?></span>
                                                    <span class="time"><i class="fas fa-solid fa-calendar"></i><?= $partidos[$i]['fecha'] ?></span>

                                                    <div class="timeline-body">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="col"><img src="<?= base_url('/images/banderas/' . $partidos[$i]['l_flag']) ?>" class="brand-image" style="height: 33px ; width: 33px;"></th>
                                                                    <th scope="col" class="font-eq"><?= $partidos[$i]['local'] ?></th>
                                                                    <th scope=" col"><?= $partidos[$i]['goles'] == '' ? 'VS' : $partidos[$i]['goles'] ?></th>
                                                                    <th scope="col" class="font-eq"><?= $partidos[$i]['visitante'] ?></th>
                                                                    <th scope="col">
                                                                        <img src="<?= base_url('/images/banderas/' . $partidos[$i]['v_flag']) ?>" class="brand-image" style="height: 33px ; width: 33px;">
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            <?php $i++;
                                            } ?>
                                        <?php } else { ?>
                                            <div class="timeline-item justify-content-center">
                                                <span class="time"><i class="fas fa-clock"></i><?= $partidos[$i]['hora'] ?></span>
                                                <span class="time"><i class="fas fa-solid fa-calendar"></i><?= $partidos[$i]['fecha'] ?></span>

                                                <div class="timeline-body">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="col"><img src="<?= base_url('/images/banderas/' . $partidos[$i]['l_flag']) ?>" class="brand-image" style="height: 33px ; width: 33px;"></th>
                                                                <th scope="col" class="font-eq"><?= $partidos[$i]['local'] ?></th>
                                                                <th scope=" col"><?= $partidos[$i]['goles'] == '' ? 'VS' : $partidos[$i]['goles'] ?></th>
                                                                <th scope="col" class="font-eq"><?= $partidos[$i]['visitante'] ?></th>
                                                                <th scope="col">
                                                                    <img src="<?= base_url('/images/banderas/' . $partidos[$i]['v_flag']) ?>" class="brand-image" style="height: 33px ; width: 33px;">
                                                                </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php $i++;
                                        } ?>
                                    <?php
                                    } ?>
                                </ul>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>