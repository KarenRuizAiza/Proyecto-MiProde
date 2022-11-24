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
                        <div class="card-header">
                            <div class="card-tools" style="width: 100%;">
                                <h4><?php echo $faseEditar  ? 'Editar fase' : $titulo ?></h4>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body" style="margin-top: 3em;">
                            <!-- /form -->
                            <div class="form-container">
                                <form class="form-card" action="<?php echo base_url('agregarModificarFase');?>" method="post" name="agregarModificarFase" id="formFase"
                                    <?php if($listado){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';} ?>>
                                    <?= csrf_field() ?>

                                    <input type="hidden" name="id" value="<?php echo $faseEditar ? $faseEditar['id'] : '' ?>">

                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input name="nombre" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $faseEditar ? $faseEditar['nombre'] : '' ?>">
                                    <br>

                                    <div class="form-group">
                                        <label>Fecha de inicio</label>
                                        <div class="input-group date" id="reservationdateStart" data-target-input="nearest">
                                            <input type="text" name="fecha_inicio" class="form-control datetimepicker-input col-sm-3" value="<?php echo $faseEditar ? $faseEditar['fecha_inicio'] : '' ?>"/>
                                            <div class="input-group-append" data-target="#reservationdateStart" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Fecha de fin</label>
                                        <div class="input-group date" id="reservationdateEnd" data-target-input="nearest">
                                            <input type="text" name="fecha_fin" class="form-control datetimepicker-input col-sm-3" value="<?php echo $faseEditar ? $faseEditar['fecha_fin'] : '' ?>"/>
                                            <div class="input-group-append" data-target="#reservationdateEnd" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_torneo" value="<?php echo $torneo["id"] ?>">
                                    <div class="col-sm-8 flex-row d-flex">
                                        <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                                                onclick="return alert('¿Desea guardar la fase con los datos ingresados?')">Guardar</button>
                                        <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                                                onclick="location.href='<?php echo base_url('fases/torneo='.$torneo['id']); ?>'">Cancelar</button>
                                    </div>
                                </form>
                            </div><!-- /.form -->
                            <div class="table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Partidos</th>
                                        <th <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
                                            <td <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>
                                                <a href="<?php echo base_url('eliminar/fase='.$f['id']);?>" onclick="return alert('¿Desea eliminar la fase seleccionada?')"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="<?php echo base_url('modificar/fase='.$f['id']).'/torneo='.($torneo['id']);?>"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </section>
