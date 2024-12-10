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
                        <div class="card-header" style="padding: 2em 0;">
                            <div class="card-tools" style="width: 100%;">
                                <div class="form-grid-container input-group input-group-sm">
                                    <!-- /form -->
                                    <div class="form-container">
                                        <form class="form-group form-card" action="<?php echo base_url('agregarModificarUsuario');?>" method="post" name="agregarModificarUsuario"
                                        <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>
                                            <input type="hidden" name="id" value="<?php echo $usuarioEditar ? $usuarioEditar['id'] : '' ?>">

                                            <div class="flex-column d-flex col-sm-4">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input required name="nombre" class="form-control" placeholder="Nombre de usuario" value="<?php echo $usuarioEditar ? $usuarioEditar['nombre'] : '' ?>">
                                            </div>

                                            <div class="flex-column d-flex col-sm-6">
                                                <label for="email" class="form-label">Correo electrónico</label>
                                                <input required type="email" name="email" class="form-control" placeholder="ejemplo@email.com" value="<?php echo $usuarioEditar ? $usuarioEditar['email'] : '' ?>">
                                            </div>

                                            <div class="flex-column d-flex col-sm-3">
                                                <label for="rol" class="form-label">Rol</label>
                                                <select required name="rol" class="form-control select2">
                                                    <option value="">Seleccionar...</option>
                                                    <?php foreach ($roles as $rol) : ?>
                                                        <option <?= $usuarioEditar ? ($usuarioEditar['rol'] === $rol ? 'selected="selected"' : '') : '' ?>" value="<?= $rol ?>"><?= $rol ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-8 flex-row d-flex">
                                                <button type="submit" name="submit" title="Guardar" class="form-control col-sm-2 btn-primary"
                                                        onclick="return confirm('¿Desea guardar el usuario con los datos ingresados?')">
                                                    <i class='<?= $usuarioEditar ? 'fas fa-user-check' : 'fa fa-user-plus' ?>'></i>
                                                </button>
                                                <button type="button" name="cancel" title="Deshacer" class="form-control col-sm-2 ml-2 btn-danger"
                                                        onclick="location.href='<?php echo base_url('usuarios'); ?>'">
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
                                        <th>Correo electrónico</th>
                                        <th <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>Rol</th>
                                        <th <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($usuarios as $u) : ?>
                                        <tr>
                                            <td><?= $u['nombre'] ?></td>
                                            <td style="white-space: break-spaces;text-align: justify;"><?= $u['email'] ?></td>
                                            <td style="white-space: break-spaces;text-align: justify;"><?= $u['rol'] ?></td>
                                            <td <?php if(session()->rol == 'Participante'){ echo 'style="display:none;visibility:hidden;"'; } else { echo 'style="visibility:visible;"';}?>>
                                                <a href="<?php echo base_url('deleteUsuario/'.$u['id']);?>" title="Eliminar" onclick="return confirm('¿Desea eliminar el usuario seleccionado?')"><i class="fa fa-user-times"></i></a>
                                                <a href="<?php echo base_url('restablecerContraseña/'.$u['id']);?>" title="Restablecer contraseña" onclick="return confirm('¿Desea restablecer la contraseña del usuario seleccionado? Se le asignará una por defecto.')"><i class="fas fa-user-lock"></i></a>
                                                <a href="<?php echo base_url('updateUsuario/'.$u['id']);?>" title="Modificar"><i class="fa-solid fa-user-pen"></i></a>
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
