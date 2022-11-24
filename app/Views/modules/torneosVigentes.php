<main class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $titulo ?></h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects" id="equipos-list">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Fecha Fin</th>
                        <th scope="col">Fixture Partidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($torneos) : ?>
                        <?php foreach ($torneos as $torneo) : ?>
                            <tr>
                                <td><?php echo $torneo['nombre']; ?></td>
                                <td><?php echo $torneo['descripcion']; ?></td>
                                <td><?php echo $torneo['fecha_inicio']; ?></td>
                                <td><?php echo $torneo['fecha_fin']; ?></td>

                                
                                <td class="project-actions text-right">
                                    <?php $logged = session('logged') ? 1 : 0 ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo base_url('fixture/fasesFull/' . $torneo['id']) ?>">
                                        Ver
                                    </a>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>