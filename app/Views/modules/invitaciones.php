<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5>Mis Invitaciones a Desafíos</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($desafios as $desafio): ?>
                        <tr>
                            <td><?= $invitacion_participante['mensaje'] ?></td>
                            <td><?= $desafio['id_torneo'] ?></td>
                            <td><?= $desafio['fecha'] ?></td>
                            <td><?= $desafio['hora'] ?></td>
                            <td><?= $desafio['id_partido'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>