 <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2" style="margin-left: 4.5rem !important;">
                        <h2> <?= $titulo ?> </h2>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header" style="padding: 2em 0; background-color: aliceblue;">
                            <h4 class="form-titulo"><?php echo isset($desafioEditar)  ? 'Editar desafio' : 'Agregar Desafio' ?></h4>
                            <div class="card-tools" style="width: 100%;">
                                <div class="input-group input-group-sm">
                                    <!-- /form -->
                                    <div class="form-container">
                                        <form class="form-group form-card" style="place-items: center;" action="<?php echo base_url('agregarModificarDesafio');?>" method="post" name="agregarModificarDesafio" id="formFase">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?php echo isset($desafioEditar) ? $desafioEditar['id'] : '' ?>">

                                            <div class="flex-column d-flex col-sm-5">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input name="nombre" class="form-control" value="<?php echo isset($desafioEditar) ? $desafioEditar['nombre'] : '' ?>">
                                            </div>

                                            <div class="flex-column d-flex col-sm-3">
                                                <label>Fecha</label>
                                                <div class="input-group date" id="reservationdateStart" data-target-input="nearest">
                                                    <input type="text" name="fecha" class="form-control datetimepicker-input" value="<?php echo isset($desafioEditar) ? $desafioEditar['fecha_inicio'] : '' ?>"/>
                                                    <div class="input-group-append" data-target="#reservationdateStart" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Hora</label>
                                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                        <input type="text" id="hora" readonly="readonly" name="hora" class="form-control datetimepicker-input col-sm-10" data-target="#timepicker" value="<?= isset($desafioEditar) ? $desafioEditar['hora'] : '' ?>"/>
                                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <span id="fecha-hora-requeridos" hidden="true">Los campos fecha y hora son obligatorios.</span>


                                            <input type="hidden" name="id_torneo" value="1">
                                            <div class="flex-row d-flex col-sm-3" style="gap: 1rem; margin-top: 1.8rem">
                                                <button type="submit" name="submit" class="form-control btn-primary"
                                                        onclick="return alert('¿Desea guardar el desafio los datos ingresados?')">
                                                    <i class='<?= isset($desafioEditar) ? 'fa fa-check' : 'fa fa-plus' ?>'></i>
                                                </button>
                                                <button type="button" name="cancel" class="form-control btn-danger"
                                                        onclick="location.href='<?php echo base_url('desafios'); ?>'">
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
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php foreach ($desafios as $d) : ?> 
                                    <tr>
                                        <td><?= $d['nombre'] ?></td>
                                        <td><?= DateTime::createFromFormat('Y-m-d', $d['fecha'])->format('d/m/Y') ?></td>
                                        <td><?= DateTime::createFromFormat('H:i', $d['hora'])->format('H:i') ?></td>
                                        <td >
                                            <a href="<?php echo base_url('delete/desafio='.$d['id']);?>" title="Eliminar" onclick="return confirm('¿Desea eliminar el desafio seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                                            <a href="<?php echo base_url('update/desafio='.$d['id']);?>." title="Modificar"><i class="fa-solid fa-pen"></i></a>
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
        