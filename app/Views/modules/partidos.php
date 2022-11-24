
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h2> <?= array_values($partidos)[0]['nombre_fase'] ?></h2>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-tools" style="width: 100%;">
                                <div class="input-group input-group-sm">
                                    <h4 style="width: 80%;"><?php echo $partidoEditar  ? 'Editar partido' : $titulo ?></h4>
<!--                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">-->
<!--                                    <div class="input-group-append">-->
<!--                                        <button type="submit" class="btn btn-default">-->
<!--                                            <i class="fas fa-search"></i>-->
<!--                                        </button>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body body-partidos">
                            <!-- /form -->
                            <div class="form-container" <?php if($listado){ echo 'style="display:none;"'; } else { echo 'style="display:flex;"';} ?>>
                                <form class="form-card form-partido" onsubmit="return validarFormulario()" action="<?php echo base_url('agregarModificarPartido');?>" method="post" name="agregarModificarPartido"
                                    <?php if($listado){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';} ?>>
                                    <input type="hidden" name="id" value="<?php echo $partidoEditar ? $partidoEditar['id'] : '' ?>">
                                    <input type="hidden" name="id_fase" value="<?php echo array_values($partidos)[0]['id_fase'] ?>">

                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" id="fecha" name="fecha" class="form-control datetimepicker-input col-sm-10" value="<?= $partidoEditar ? $partidoEditar['fecha'] : '' ?>"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Hora</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" id="hora" readonly="readonly" name="hora" class="form-control datetimepicker-input col-sm-10" data-target="#timepicker" value="<?= $partidoEditar ? $partidoEditar['hora'] : '' ?>"/>
                                                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <span id="fecha-hora-requeridos" hidden="true">Los campos fecha y hora son obligatorios.</span>

                                    <div class="form-group col-sm-2">
                                        <label>Equipo local</label>
                                        <select id="local" name="local" class="form-control select2">
                                            <option>Seleccionar...</option>
                                            <?php foreach ($equipos as $e) : ?>
                                                <option <?= $partidoEditar ? ($partidoEditar['id_equipo_local'] === $e['id'] ? 'selected="selected"': '') : '' ?>" value="<?= $e['id'] ?>"><?= $e['nombre'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label>Equipo visitante</label>
                                        <select id="visitante" name="visitante" class="form-control select2">
                                            <option>Seleccionar...</option>
                                            <?php foreach ($equipos as $e) : ?>
                                                <option <?= $partidoEditar ? ($partidoEditar['id_equipo_visitante'] === $e['id'] ? 'selected="selected"' : '') : '' ?>" value="<?= $e['id'] ?>"><?= $e['nombre'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <span id="error-equipos" hidden="true">Debe seleccionar equipos diferentes.</span>

                                    <div class="form-buttons-partido col-sm-2 flex-row d-flex">
                                        <button type="submit" name="submit" class="form-control btn-primary"
                                                onclick="return alert('¿Desea guardar el partido con los datos ingresados?')">Guardar</button>
                                        <button type="button" name="cancel" class="form-control ml-2 btn-danger"
                                                onclick="location.href='<?php echo base_url('partidos/fase='.array_values($partidos)[0]['id_fase']); ?>'">Cancelar</button>
                                    </div>

                                </form>
                            </div>
                            <!-- /.form -->

                            <!-- Listado de partidos -->
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

                                    <div class="match-detail">
                                        <div class="actions">
                                            <a href="<?php echo base_url('eliminar/partido='.$p['id']);?>" onclick="return alert('¿Desea eliminar el partido seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                                            <a href="<?php echo base_url('modificar/partido='.$p['id'].'/fase='.array_values($partidos)[0]['id_fase']);?>"><i class="fa-solid fa-pen"></i></a>
                                        </div>

                                        <span><strong>Predicción:</strong> <?= $p['resultado_prediccion'] ? $p['resultado_prediccion'] : 'No hay predicción' ?></span>

                                        <span onclick="location.href='<?php echo base_url('cargarPrediccion/partido='.$p['id'].'/fase='.array_values($partidos)[0]['id_fase']);?>'">
                                            Cargar predicción <span class="detail-arrow">&#10095;</span>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- /.listado de partidos -->
                        </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>

                <!--Popup apuesta-->
                <div class="modal fade" id="prediccionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cargar Predicción</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h2><?= $partidoPrediccion ? array_values($partidoPrediccion)[0]['nombre_fase'] : ''; ?></h2>
                                <h4>Apuesta creada el <?= $apuesta ? array_values($apuesta)[0]['fecha_creacion'] : ''; ?>.</h4>
                                <div class="team">
                                    <img src="<?= base_url()?>/img/teams/<?=$partidoPrediccion ? array_values($partidoPrediccion)[0]['local'] : ''; ?>.svg">
                                    <span><?= $partidoPrediccion ? array_values($partidoPrediccion)[0]['local'] : '';?>  - </span>
                                    <img src="<?= base_url()?>/img/teams/<?=$partidoPrediccion ? array_values($partidoPrediccion)[0]['visitante'] : '';?>.svg">
                                    <span><?= $partidoPrediccion ? array_values($partidoPrediccion)[0]['visitante'] : '';?></span>
                                </div>

                                <div class="form-group">
                                    <form action="<?php echo base_url('agregarPrediccion');?>" method="post">
                                        <input type="hidden" name="id_partido" value="<?php echo $partidoPrediccion ? array_values($partidoPrediccion)[0]['id'] : ''; ?>">
                                        <input type="hidden" name="id_fase" value="<?php echo $partidoPrediccion ? array_values($partidoPrediccion)[0]['id_fase'] : ''; ?>">
                                        <input type="hidden" name="id_apuesta" value="<?php echo $apuesta ? array_values($apuesta)[0]['id'] : ''; ?>">

                                        <label>Resultado</label>
                                        <select class="custom-select" id="resultado_prediccion" name="resultado_prediccion">
                                            <option>Local</option>
                                            <option>Empate</option>
                                            <option>Visitante</option>
                                        </select>

                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>

            </section>

            <script>

                $(window).on('load', function() {
                    if (<?=$partidoPrediccion != false?>)
                        $('#prediccionModal').modal('show');
                });

                function validarFormulario() {
                    let fecha = document.getElementById('fecha').value;
                    let hora = document.getElementById('hora').value;
                    let local = document.getElementById('local').value;
                    let visitante = document.getElementById('visitante').value;

                    if (!fecha || !hora) {
                        document.getElementById('fecha-hora-requeridos').hidden = false;
                        return false;
                    } else {
                        document.getElementById('fecha-hora-requeridos').hidden = true;
                    }
                    if (local == visitante) {
                        document.getElementById('error-equipos').hidden = false;
                        return false;
                    } else return true;
                }
            </script>
