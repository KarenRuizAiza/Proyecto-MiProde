            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h2><?= $titulo ?></h2>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-tools" style="width: 100%;">
                                <div class="input-group input-group-sm">
                                    <h4><?php if(session()->rol == 'Administrador'){ echo $torneoEditar ? 'Editar torneo' : 'Agregar torneo';} ?></h4>
<!--                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">-->
<!--                                    <div class="input-group-append">-->
<!--                                        <button type="submit" class="btn btn-default">-->
<!--                                            <i class="fas fa-search"></i>-->
<!--                                        </button>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body" style="margin-top: 3em;">
                            <!-- /form -->
                            <div class="form-container">
                                <form class="form-card" action="<?php echo base_url('agregarModificarTorneo');?>" method="post" name="agregarModificarTorneo"
                                <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>
                                    <input type="hidden" name="id" value="<?php echo $torneoEditar ? $torneoEditar['id'] : '' ?>">

                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input name="nombre" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $torneoEditar ? $torneoEditar['nombre'] : '' ?>">
                                    <br>

                                    <label for="descripcion" class="form-label">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $torneoEditar ? $torneoEditar['descripcion'] : '' ?>">
                                    <br>

                                    <div class="form-group">
                                        <label>Fecha de inicio</label>
                                        <div class="input-group date" id="reservationdateStart" data-target-input="nearest">
                                            <input type="text" name="fecha_inicio" class="form-control datetimepicker-input" value="<?php echo $torneoEditar ? $torneoEditar['fecha_inicio'] : '' ?>"/>
                                            <div class="input-group-append" data-target="#reservationdateStart" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Fecha de fin</label>
                                        <div class="input-group date" id="reservationdateEnd" data-target-input="nearest">
                                            <input type="text" name="fecha_fin" class="form-control datetimepicker-input" value="<?php echo $torneoEditar ? $torneoEditar['fecha_fin'] : '' ?>"/>
                                            <div class="input-group-append" data-target="#reservationdateEnd" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-8 flex-row d-flex">
                                        <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                                                onclick="return alert('¿Desea guardar el torneo con los datos ingresados?')">Guardar</button>
                                        <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                                                onclick="location.href='<?php echo base_url('torneos'); ?>'">Cancelar</button>
                                    </div>
                                </form>
                            </div><!-- /.form -->

                            <div class="table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Fases</th>
                                        <th <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($torneos as $t) : ?>
                                        <tr>
                                            <td><?= $t['nombre'] ?></td>
                                            <td style="white-space: break-spaces;text-align: justify;"><?= $t['descripcion'] ?></td>
                                            <td><?= DateTime::createFromFormat('Y-m-d', $t['fecha_inicio'])->format('d/m/Y') ?></td>
                                            <td><?= DateTime::createFromFormat('Y-m-d', $t['fecha_fin'])->format('d/m/Y') ?></td>
                                            <td>
                                                <a href="<?php echo base_url('fases/torneo='.$t['id']);?>"> <i class="fa-solid fa-table-list"></i> Ver </a>
                                                <a href="<?php echo base_url('agregarFase/torneo='.$t['id']); ?>"
                                                    <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>
                                                    <i class="fa-solid fa-plus"></i> Agregar
                                                </a>
                                            </td>
                                            <td <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="display:inherit;visibility:visible;"';}?>>
                                                <a href="<?php echo base_url('deleteTorneo/'.$t['id']);?>" onclick="return alert('¿Desea eliminar el torneo seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="<?php echo base_url('updateTorneo/'.$t['id']);?>"><i class="fa-solid fa-pen"></i></a>

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
