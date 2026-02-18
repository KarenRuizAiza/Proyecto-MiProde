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
                            <th>Desafio</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($invitaciones)): ?>
                            <?php foreach ($invitaciones as $invitacion): ?>
                                <tr>
                                    <td><?php echo $invitacion['desafio']; ?></td>
                                    <td><?php echo $invitacion['mensaje']; ?></td>
                                    <td><?= DateTime::createFromFormat('Y-m-d', $invitacion['fecha'])->format('d/m/Y') ?></td>
                                    <td><?php echo $invitacion['estado']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('/aceptarInvitacion/'.$invitacion['id']);?>" 
                                            title="Aceptar"
                                            onclick="return confirm('¿Desea aceptar la invitacion?')">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        <a href="<?php echo base_url('/rechazarInvitacion/'.$invitacion['id']);?>" 
                                            title="Rechazar"
                                            onclick="return confirm('¿Desea rechazar la invitacion?')">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No tienes invitaciones disponibles.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>