            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2" style="margin-left: 4.5rem !important;">
                        <h2><?= $titulo ?></h2>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <table class="table table-striped table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Torneo</th>
                                        <th scope="col">Fecha Inicio</th>
                                        <th scope="col">Fecha Fin</th>
                                        <th scope="col">Fixture</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($torneos) : ?>
                                        <?php foreach ($torneos as $torneo) : ?>
                                            <tr>
                                                <td><?php echo $torneo['nombre']; ?></td>
                                                <td><?= DateTime::createFromFormat('Y-m-d', $torneo['fecha_inicio'])->format('d/m/Y') ?></td>
                                                <td><?= DateTime::createFromFormat('Y-m-d', $torneo['fecha_inicio'])->format('d/m/Y') ?></td>

                                                
                                                <td class="project-actions">
                                                    <?php $logged = session('logged') ? 1 : 0 ?>
                                                    <a href="<?php echo base_url('fixture/' . $torneo['id']) ?>" title="Ver">
                                                        <i class='fa fa-eye'></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>