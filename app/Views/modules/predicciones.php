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
                                            <label>Participante</label>
                                            <select id="participante" name="prticipante" class="form-control select2" >
                                                <option value="<?=null?>">Seleccionar...</option>
                                                <?php foreach ($participantes as $p) : ?>
                                                    <option <?= $participante_seleccionado ? ($participante_seleccionado === $p['id'] ? 'selected="selected"': '') : '' ?>" 
                                                            value="<?= $p['id'] ?>"><?= $p['nombre'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <button type="button" name="buscar" title="Buscar" class="form-control col-sm-1 ml-1 btn-info align-self-end"
                                                onclick="buscarPredicciones()">
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
                                    <th>Torneo</th>
                                    <th>Fase</th>
                                    <th>Equipo Local</th>
                                    <th>Equipo Visitante</th>
                                    <th>Predicción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if ($predicciones) {
                                    foreach ($predicciones as $p) : ?>
                                        <tr>
                                            <td style="white-space: break-spaces;text-align: justify;"><?= $p['nombre_torneo'] ?></td>
                                            <td><?= $p['nombre_fase'] ?></td>
                                            <td><?= $p['equipo_local_prediccion'] ?></td>
                                            <td><?= $p['equipo_visitante_prediccion'] ?></td>
                                            <td><?= $p['resultado'] ?></td>
                                        </tr>
                                    <?php endforeach;
                                    
                                } else { ?>
                                    <tr style="text-align: center;">
                                        <td colspan="5"> <?= $participante_seleccionado != 'null' ? 'El participante seleccionado no ha realizado ninguna predicción' : 'No ha seleccionado ningún participante' ?></td>
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
            function buscarPredicciones() {
                // Obtener el valor seleccionado del select
                var opcionSeleccionada = document.getElementById('participante').value;

                // Redirigir a la URL con el valor seleccionado en el query string
                if (!opcionSeleccionada)
                    window.location.href = '<?php echo base_url('/predicciones/participante'); ?>';

                else
                    window.location.href = '<?php echo base_url('/predicciones/participante='); ?>' + opcionSeleccionada;
            }
        </script>