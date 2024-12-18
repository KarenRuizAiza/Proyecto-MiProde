<?php $selectedValue = "";?>

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
                    <div class="card-header" style="padding: 2em 0; background-color: aliceblue;">
                        <div class="card-tools" style="width: 100%;">
                            <div class="input-group input-group-sm">
                                <!-- /form -->
                                <div class="form-container w-100">
                                    <form class="form-card form-partido justify-content-start" action="<?php echo base_url('agregarModificarUsuario');?>" method="post" name="seleccionTorneo">

                                        <div class="flex-column d-flex col-sm-8">
                                            <label>Torneo</label>
                                            <select id="torneo" name="torneo" class="form-control select2" >
                                                <option value="<?=null?>">Seleccionar...</option>
                                                <?php foreach ($torneos as $t) : ?>
                                                    <option <?= $torneo_seleccionado ? ($torneo_seleccionado === $t['id'] ? 'selected="selected"': '') : '' ?>" value="<?= $t['id'] ?>"><?= $t['nombre'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <button type="button" name="buscar" title="Buscar" class="form-control col-sm-1 ml-1 btn-info align-self-end"
                                                onclick="buscarParticipantes()">
                                            <i class='fas fa-search-dollar'></i>
                                        </button>
                                    </form>
                                </div><!-- /.form -->
                            </div>
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body" style="margin-top: 3em;">
                        <div class="table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Torneo</th>
                                    <th>Puntaje</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if ($participantes) {
                                    foreach ($participantes as $p) : ?>
                                        <tr>
                                            <td><?= $p['nombre_usuario'] ?></td>
                                            <td style="white-space: break-spaces;text-align: justify;"><?= $p['nombre_torneo'] ?></td>
                                            <td style="white-space: break-spaces;text-align: justify;"><?= $p['puntaje'] ?></td>
                                        </tr>
                                    <?php endforeach;
                                    
                                } else { ?>
                                    <tr style="text-align: center;">
                                        <td colspan="3"> <?= $torneo_seleccionado != 'null' ? 'El torneo seleccionado no tiene ninguna apuesta realizada' : 'No ha seleccionado ningún torneo' ?></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>


        <script>
            function buscarParticipantes() {
                // Obtener el valor seleccionado del select
                var opcionSeleccionada = document.getElementById('torneo').value;

                // Redirigir a la URL con el valor seleccionado en el query string
                if (!opcionSeleccionada)
                    window.location.href = '<?php echo base_url('/participantes/torneo'); ?>';

                else
                    window.location.href = '<?php echo base_url('/participantes/torneo='); ?>' + opcionSeleccionada;
            }
        </script>