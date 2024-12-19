            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h2> <?= $torneo["nombre"] ?></h2>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header" style="padding: 2em 0; background-color: aliceblue; <?php if(session()->rol == 'Participante'){ echo 'display:none;visibility:hidden'; } else { echo 'visibility:visible';}?>">
                            <h4 class="form-titulo"><?php echo $faseEditar  ? 'Editar fase' : $titulo ?></h4>
                            <div class="card-tools" style="width: 100%;">
                                <div class="input-group input-group-sm">
                                    <!-- /form -->
                                    <div class="form-container">
                                        <form class="form-group form-card" style="place-items: center;" action="<?php echo base_url('agregarModificarFase');?>" method="post" name="agregarModificarFase" id="formFase">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?php echo $faseEditar ? $faseEditar['id'] : '' ?>">

                                            <div class="flex-column d-flex col-sm-5">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input name="nombre" class="form-control" value="<?php echo $faseEditar ? $faseEditar['nombre'] : '' ?>">
                                            </div>

                                            <div class="flex-column d-flex col-sm-3">
                                                <label>Fecha de inicio</label>
                                                <div class="input-group date" id="reservationdateStart" data-target-input="nearest">
                                                    <input type="text" name="fecha_inicio" class="form-control datetimepicker-input" value="<?php echo $faseEditar ? $faseEditar['fecha_inicio'] : '' ?>"/>
                                                    <div class="input-group-append" data-target="#reservationdateStart" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex-column d-flex col-sm-3">
                                                <label>Fecha de fin</label>
                                                <div class="input-group date" id="reservationdateEnd" data-target-input="nearest">
                                                    <input type="text" name="fecha_fin" class="form-control datetimepicker-input" value="<?php echo $faseEditar ? $faseEditar['fecha_fin'] : '' ?>"/>
                                                    <div class="input-group-append" data-target="#reservationdateEnd" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="id_torneo" value="<?php echo $torneo["id"] ?>">
                                            <div class="flex-row d-flex col-sm-3" style="gap: 1rem; margin-top: 1.8rem">
                                                <button type="submit" name="submit" class="form-control btn-primary"
                                                        onclick="return alert('¿Desea guardar la fase con los datos ingresados?')">
                                                    <i class='<?= $faseEditar ? 'fa fa-check' : 'fa fa-plus' ?>'></i>
                                                </button>
                                                <button type="button" name="cancel" class="form-control btn-danger"
                                                        onclick="location.href='<?php echo base_url('fases/torneo='.$torneo['id']); ?>'">
                                                    <i class='fas fa-undo'></i>
                                                </button>
                                            </div>
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
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Partidos</th>
                                        <th <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!$fases) { ?> 
                                        <tr style="text-align: center;">
                                            <td colspan="5">El torneo no tiene ninguna fase cargada</td>
                                        </tr>
                                    <?php } else { ?> 
                                        <?php foreach ($fases as $f) : ?>
                                        <tr>
                                            <td><?= $f['nombre'] ?></td>
                                            <td><?= DateTime::createFromFormat('Y-m-d', $f['fecha_inicio'])->format('d/m/Y') ?></td>
                                            <td><?= DateTime::createFromFormat('Y-m-d', $f['fecha_fin'])->format('d/m/Y') ?></td>
                                            <td>
                                                <a href="<?php echo base_url('partidos/fase='.$f['id']);?>"> <i class="fa-solid fa-table-list"></i> Ver </a>
                                                <a href="<?php echo base_url('agregarPartido/fase='.$f['id']); ?>"
                                                    <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>
                                                    <i class="fa-solid fa-plus"></i> Agregar
                                                </a>
                                            </td>
                                            <td <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>
                                                <a href="<?php echo base_url('eliminar/fase='.$f['id']);?>" title="Eliminar" onclick="return confirm('¿Desea eliminar la fase seleccionada?')"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="<?php echo base_url('modificar/fase='.$f['id']).'/torneo='.($torneo['id']);?>" title="Modificar"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </section>
