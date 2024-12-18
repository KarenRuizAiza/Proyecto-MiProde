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
                        <div class="card-header" style="padding: 2em 0; background-color: aliceblue; <?php if(session()->rol == 'Participante'){ echo 'display:none;visibility:hidden'; } else { echo 'visibility:visible';}?>">
                            <h4 class="form-titulo"><?php echo $torneoEditar ? 'Editar torneo' : 'Agregar torneo'; ?></h4>    
                            <div class="card-tools" style="width: 100%;">
                                <div class="input-group input-group-sm">
                                    <!-- /form -->
                                    <div class="form-container">
                                        <form class="form-group form-card" style="place-items: center;" action="<?php echo base_url('agregarModificarTorneo');?>" method="post" name="agregarModificarTorneo"
                                        <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>
                                            <input type="hidden" name="id" value="<?php echo $torneoEditar ? $torneoEditar['id'] : '' ?>">

                                            <div class="flex-column d-flex col-sm-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input name="nombre" class="form-control" value="<?php echo $torneoEditar ? $torneoEditar['nombre'] : '' ?>">
                                            </div>
                                            
                                            <div class="flex-column d-flex col-sm-4" style="margin-top: 1.5em;">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea type="text" name="descripcion" class="form-control">
                                                    <?php echo $torneoEditar ? $torneoEditar['descripcion'] : '' ?>
                                                </textarea>
                                            </div>

                                            <div class="flex-column d-flex col-sm-2">
                                                <label>Fecha de inicio</label>
                                                <div class="input-group date" id="reservationdateStart" data-target-input="nearest">
                                                    <input type="text" name="fecha_inicio" class="form-control datetimepicker-input" 
                                                            value="<?php echo $torneoEditar ? DateTime::createFromFormat('Y-m-d', $torneoEditar['fecha_inicio'])->format('d/m/Y') : '' ?>"/>
                                                    <div class="input-group-append" data-target="#reservationdateStart" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex-column d-flex col-sm-2">
                                                <label>Fecha de fin</label>
                                                <div class="input-group date" id="reservationdateEnd" data-target-input="nearest">
                                                    <input type="text" name="fecha_fin" class="form-control datetimepicker-input" 
                                                    value="<?php echo $torneoEditar ? DateTime::createFromFormat('Y-m-d', $torneoEditar['fecha_fin'])->format('d/m/Y') : '' ?>"/>
                                                    <div class="input-group-append" data-target="#reservationdateEnd" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex-row d-flex col-sm-2" style="gap: 1rem; margin-top: 1.8rem">
                                                <button type="submit" name="submit" title="Guardar" class="form-control btn-primary"
                                                        onclick="return confirm('¿Desea guardar el torneo con los datos ingresados?')">
                                                    <i class='<?= $torneoEditar ? 'fa fa-check' : 'fa fa-plus' ?>'></i>
                                                </button>
                                                <button type="button" name="cancel" title="Deshacer" class="form-control btn-danger"
                                                        onclick="location.href='<?php echo base_url('torneos'); ?>'">
                                                    <i class='fas fa-undo'></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div><!-- /.form -->
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
                            <div class="table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Fases</th>
                                        <th <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>Acciones</th>
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
                                            <td <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>
                                                <a href="<?php echo base_url('deleteTorneo/'.$t['id']);?>" title="Eliminar" onclick="return confirm('¿Desea eliminar el torneo seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="<?php echo base_url('updateTorneo/'.$t['id']);?>" title="Modificar"><i class="fa-solid fa-pen"></i></a>
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
