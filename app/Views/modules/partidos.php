
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h2> <?= $fase['nombre'] ?></h2>
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
                                <form class="form-card form-partido align-items-center" onsubmit="return validarFormulario()" action="<?php echo base_url('agregarModificarPartido');?>" method="post" name="agregarModificarPartido"
                                    <?php if($listado){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';} ?>>
                                    <input type="hidden" name="id" value="<?php echo $partidoEditar ? $partidoEditar['id'] : '' ?>">
                                    <input type="hidden" name="id_fase" value="<?php echo $fase['id'] ?>">

                                    <div class="form-group ">
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

                                    <div class="form-group col-sm-2 align-items-center">
                                        <label>Equipo local</label>
                                        <select id="local" name="local" class="form-control select2">
                                            <option value="<?=null?>">Seleccionar...</option>
                                            <?php foreach ($equipos as $e) : ?>
                                                <option <?= $partidoEditar ? ($partidoEditar['id_equipo_local'] === $e['id'] ? 'selected="selected"': '') : '' ?>" value="<?= $e['id'] ?>"><?= $e['nombre'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>

                                    <div class="form-group col-sm-2 align-items-center">
                                        <label>Equipo visitante</label>
                                        <select id="visitante" name="visitante" class="form-control select2">
                                            <option value="<?=null?>">Seleccionar...</option>
                                            <?php foreach ($equipos as $e) : ?>
                                                <option <?= $partidoEditar ? ($partidoEditar['id_equipo_visitante'] === $e['id'] ? 'selected="selected"' : '') : '' ?>" value="<?= $e['id'] ?>"><?= $e['nombre'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <span id="error-equipos" hidden="true">Debe seleccionar equipos diferentes.</span>

                                    <div class="form-buttons-partido col-sm-2 flex-row d-flex">
                                        <button type="submit" name="submit" class="form-control btn-primary"
                                                onclick="return confirm('¿Desea guardar el partido con los datos ingresados?')">Guardar</button>
                                        <button type="button" name="cancel" class="form-control ml-2 btn-danger"
                                                onclick="location.href='<?php echo base_url('partidos/fase='.$fase['id']); ?>'">Cancelar</button>
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
                                        <?php
                                        if(isset($p['local_prediccion']) && $p['local_prediccion'] && $p['local'] && $p['visitante']) { ?>
                                            <div class="team-container" <?php if(session()->rol == 'Administrador'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>
                                                <div class="team">
                                                    <img src="<?= base_url()?>/img/teams/<?=$p['local']?>.svg">
                                                    <span><?=$p['local']?></span>
                                                </div>
                                                <div class="team">
                                                    <img src="<?= base_url()?>/img/teams/<?=$p['visitante']?>.svg">
                                                    <span><?=$p['visitante']?></span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        <div class="team-container ml-5">
                                            <div class="team">
                                                <?php
                                                if(isset($p['local_prediccion']) && $p['local_prediccion']){ ?>
                                                    <img src="<?= base_url()?>/img/teams/<?=$p['local_prediccion']?>.svg">
                                                    <span><?=$p['local_prediccion']?></span>
                                                <?php 
                                                } else if(isset($p['local']) && $p['local']) { ?>
                                                    <img src="<?= base_url()?>/img/teams/<?=$p['local']?>.svg">
                                                    <span><?=$p['local']?></span>
                                                <?php
                                                } else { ?>
                                                    <img src="<?= base_url()?>/img/teams/<?='Unknown_flag'?>.svg">
                                                    <span class='undefined-team'>Sin definir</span>
                                                <?php } 
                                                ?>
                                            </div>
                                            <div class="team">
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
                                                    <img src="<?= base_url()?>/img/teams/<?='Unknown_flag'?>.svg">
                                                    <span class='undefined-team'>Sin definir</span>
                                                <?php } 
                                                ?>
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
                                        <?php 
                                            if (session()->rol == 'Administrador') {
                                                

                                                $currentDateTime = new DateTime();
                                                $fecha_inicio = $p['fecha'];                                               
                                                $hora_inicio = $p['hora'];                                               
                                                $inicioDateTime = new DateTime($fecha_inicio .''. $hora_inicio);
                                                $inicioDateTime->add(new DateInterval('P10D'));

                                                if ($inicioDateTime > $currentDateTime) { ?>
                                                    <div class="actions d-flex justify-content-between">
                                                        <a href="<?php echo base_url('eliminar/partido='.$p['id']);?>" onclick="return confirm('¿Desea eliminar el partido seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                                                        <a href="<?php echo base_url('modificar/partido='.$p['id'].'/fase='.array_values($partidos)[0]['id_fase']);?>"><i class="fa-solid fa-pen"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="actions d-flex justify-content-between">
                                                        <a href='' class="disabled-item"><i class="fa-solid fa-trash-can"></i></a>
                                                        <a href='' class="disabled-item"><i class="fa-solid fa-pen"></i></a>
                                                    </div>
                                                <?php }

                                            }
                                        ?>

                                        <span class="d-flex ml-3">
                                            <strong>Resultado: </strong> <?= $p['resultado'] ? $p['resultado'] : 'Sin resultado' ?>
                                        </span>

                                        <?php
                                        if (session()->rol == 'Participante') { ?>
                                            <span class="d-flex ml-5">
                                                <?php
                                                
                                                $currentDateTime = new DateTime();
                                                $fecha_inicio = $p['inicio_fase'];                                               
                                                $inicioFase = new DateTime($fecha_inicio);

                                                if ($p['resultado_prediccion'] && $inicioFase > $currentDateTime) { ?>
                                                    <a href="<?php echo base_url('eliminarPrediccion/prediccion='.$p['id_prediccion']);?>" title="Eliminar predicción" onclick="return confirm('¿Desea eliminar la predicción seleccionada?')"
                                                     class="mr-1" style="margin-top: .15rem">
                                                        <i class="fa fa-times-circle" style="color: #ff0060"></i></a>
                                                <?php } ?>
                                                <strong>Predicción:</strong> <?= $p['resultado_prediccion'] ? $p['resultado_prediccion'] : 'Sin predicción' ?>
                                            </span>
                                            <?php 
                                                $currentDateTime = new DateTime();
                                                $fecha_inicio = $p['inicio_fase'];                                               
                                                $inicioFase = new DateTime($fecha_inicio);

                                                if (!$p['resultado'] && $inicioFase > $currentDateTime) { ?>
                                                    <span onclick="location.href='<?php echo base_url('cargarPrediccion/partido='.$p['id'].'/fase='.array_values($partidos)[0]['id_fase']);?>'">
                                                        <?= $p['resultado_prediccion'] ? 'Editar predicción' : 'Cargar predicción' ?> <span class="detail-arrow">&#10095;</span>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="disabled-item">
                                                        <?= $p['resultado_prediccion'] ? 'Editar predicción' : 'Cargar predicción' ?> <span class="detail-arrow disabled-item">&#10095;</span>
                                                    </span>
                                                <?php } 
                                            ?>


                                        <?php } else if(session()->rol == 'Administrador') {
                                            
                                                $currentDateTime = new DateTime();
                                                $fecha_inicio = $p['fecha'];                                               
                                                $hora_inicio = $p['hora'];                                               
                                                $inicioDateTime = new DateTime($fecha_inicio .''. $hora_inicio);
                                                $inicioDateTime->add(new DateInterval('P10D'));

                                                if ($inicioDateTime > $currentDateTime) { ?>
                                                    
                                                    <span onclick="location.href='<?php echo base_url('cargarResultado/partido='.$p['id'].'/fase='.array_values($partidos)[0]['id_fase']);?>'">
                                                    Cargar resultado <span class="detail-arrow">&#10095;</span></span>
                                                <?php } else { ?>
                                                    <span class="disabled-item">
                                                        Cargar resultado <span class="detail-arrow disabled-item">&#10095;</span>
                                                    </span>
                                                <?php } 
                                            ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- /.listado de partidos -->
                        </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>

                <!--Popup apuesta-->
                <?php if(isset($partidoPrediccion)) { ?>
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
                                    <h5 class="mb-4">Apuesta creada el <?= $apuesta ? array_values($apuesta)[0]['fecha_creacion'] : ''; ?>.</h5s>
                                    <div class="form-group flex-column mt-3" style="align-items: flex-start">
                                        <form action="<?php echo base_url('agregarPrediccion');?>" method="post" class="m-0">
                                            <div class="team mb-3">
                                                <!-- <img src="base_url()?>/img/teams/=$partidoPrediccion ? array_values($partidoPrediccion)[0]['local'] : ''; ?>.svg">-->
                                                
                                                <?php if ($partidoPrediccion && array_values($partidoPrediccion)[0]['local']  && array_values($partidoPrediccion)[0]['visitante']) { ?>
                                                    <img src="<?= base_url()?>/img/teams/<?=$partidoPrediccion ? array_values($partidoPrediccion)[0]['local'] : ''; ?>.svg">
                                                    <span><?= $partidoPrediccion ? array_values($partidoPrediccion)[0]['local'] : '';?>  - </span>
                                                    <img src="<?= base_url()?>/img/teams/<?=$partidoPrediccion ? array_values($partidoPrediccion)[0]['visitante'] : '';?>.svg">
                                                    <span><?= $partidoPrediccion ? array_values($partidoPrediccion)[0]['visitante'] : '';?></span>
                                                <?php } else {?>

                                                    <div>
                                                        <label>Equipo Local</label>
                                                        <select required class="custom-select" id="equipo_local_prediccion" name="equipo_local_prediccion">
                                                            <option value="<?=null?>">Seleccionar...</option>
                                                            <?php foreach ($equipos as $e) : ?>
                                                            <option <?= isset($prediccion) && $prediccion ? ($prediccion[0]['id_equipo_local'] === $e['id'] ? 'selected="selected"' : '') : '' ?>" value="<?= $e['id'] ?>"><?= $e['nombre'] ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    

                                                    <div>
                                                        <label>Equipo Visitante</label>
                                                        <select required class="custom-select" id="equipo_visitante_prediccion" name="equipo_visitante_prediccion">
                                                            <option value="<?=null?>">Seleccionar...</option>
                                                            <?php foreach ($equipos as $e) : ?>
                                                            <option <?= isset($prediccion) && $prediccion ? ($prediccion[0]['id_equipo_visitante'] === $e['id'] ? 'selected="selected"' : '') : '' ?>" value="<?= $e['id'] ?>"><?= $e['nombre'] ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <input type="hidden" name="id_partido" value="<?php echo $partidoPrediccion ? array_values($partidoPrediccion)[0]['id'] : ''; ?>">
                                            <input type="hidden" name="id_fase" value="<?php echo $partidoPrediccion ? array_values($partidoPrediccion)[0]['id_fase'] : ''; ?>">
                                            <input type="hidden" name="id_apuesta" value="<?php echo $apuesta ? array_values($apuesta)[0]['id'] : ''; ?>">

                                            <div>
                                                <label>Resultado</label>
                                                <select required class="custom-select" id="resultado_prediccion" name="resultado_prediccion">
                                                    <option>Local</option>
                                                    <option>Empate</option>
                                                    <option>Visitante</option>
                                                </select>
                                            </div>

                                            <div class="modal-footer" style="align-self: center">
                                                <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($partidoResultado)) { ?>
                    <div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cargar Resultado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2><?= $partidoResultado ? array_values($partidoResultado)[0]['nombre_fase'] : ''; ?></h2>
                                    
                                    <div class="team">
                                        <img src="<?= base_url()?>/img/teams/<?=$partidoResultado ? array_values($partidoResultado)[0]['local'] : ''; ?>.svg">
                                        <span><?= $partidoResultado ? array_values($partidoResultado)[0]['local'] : '';?>  - </span>
                                        <img src="<?= base_url()?>/img/teams/<?=$partidoResultado ? array_values($partidoResultado)[0]['visitante'] : '';?>.svg">
                                        <span><?= $partidoResultado ? array_values($partidoResultado)[0]['visitante'] : '';?></span>
                                    </div>

                                    <div class="form-group">
                                        <form action="<?php echo base_url('agregarResultado');?>" method="post">
                                            <input type="hidden" name="id_partido" value="<?php echo $partidoResultado ? array_values($partidoResultado)[0]['id'] : ''; ?>">
                                            <input type="hidden" name="id_fase" value="<?php echo $partidoResultado ? array_values($partidoResultado)[0]['id_fase'] : ''; ?>">

                                            <label>Resultado</label>
                                            <select class="custom-select" id="resultado_partido" name="resultado_partido">
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
                <?php } ?>

            </section>

            <script>

                $(window).on('load', function() {
                    if (<?=(isset($partidoPrediccion) && $partidoPrediccion != false && $equiposDefinidos) ? 1 : 0?>) {
                        $('#prediccionModal').modal('show');
                    } else if(<?=(isset($equiposDefinidos) && !$equiposDefinidos) ? 1 : 0?>) {
                        alert('Los equipos no están definidos.')
                    }

                    $("#prediccionModal").on("hidden.bs.modal", function () {
                    window.location.replace('<?= base_url('partidos/fase='.$fase['id']);?>');
                    });

                    if (<?=(isset($partidoResultado) && $equiposDefinidos) ? 1 : 0?>) {
                        $('#resultadoModal').modal('show');
                    } else if(<?=(isset($equiposDefinidos) && !$equiposDefinidos) ? 1 : 0?>) {
                        alert('Los equipos no están definidos.')
                    }

                    $("#resultadoModal").on("hidden.bs.modal", function () {
                    window.location.replace('<?= base_url('partidos/fase='.$fase['id']);?>');
                    });
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
                    if (local && visitante && local == visitante) {
                        document.getElementById('error-equipos').hidden = false;
                        return false;
                    } else return true;
                }
            </script>
