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

                                            <div class="flex-column d-flex col-sm-8">
                                                <label for="nombre" class="form-label">Nombre del desafio</label>
                                                <input name="nombre" class="form-control" value="<?php echo isset($desafioEditar) ? $desafioEditar['nombre'] : '' ?>">
                                            </div>

                                            <input type="hidden" name="id_torneo" value="<?php echo isset($torneo) ? $torneo["id"] : ''?>">
                                            

                                            <div class="flex-column d-flex col-sm-8">
                                                <label>Torneo</label>
                                                <select id="torneo" name="torneo" class="form-control select2" >
                                                    <option value="<?=null?>">Seleccionar...</option>
                                                    <?php foreach ($torneos as $t) : ?>
                                                        <option <?= isset($desafioEditar) ? ($desafioEditar['id_torneo'] === $t['id'] ? 'selected="selected"': '') : '' ?>" value="<?= $t['id'] ?>"><?= $t['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <span id="fecha-hora-requeridos" hidden="true">Los campos fecha y hora son obligatorios.</span>


                                            <input type="hidden" name="id_partido" value="<?php echo isset($partido) ? $partido["id"] : ''?>">
                                            
                                            <div class="flex-row d-flex col-sm-6" style="gap: 1rem; margin-top: 1.8rem">
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
                            <div class="table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Torneo</th>
                                        <!--<th>Fecha</th>-->
                                        <!--<th>Hora</th>-->
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php if ($desafios) {
                                            foreach ($desafios as $d) : ?> 
                                            <tr>
                                                    <td><?= $d['nombre'] ?></td>
                                                    <td><?= $d['torneo_nombre'] ?></td>
                                                
                                                    <td><?= $d['id_creador'] == $participante ? 'Dueño' : 'Invitado' ?></td>
                
                                                    <td >
                                                        <?php if ($d['id_creador'] == $participante): ?>
                                                            <a href="<?php echo base_url('/deleteDesafio/'.$d['id']);?>" 
                                                            title="Eliminar"
                                                            onclick="return confirm('¿Desea eliminar el desafio seleccionado?')">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('/updateDesafio/'.$d['id']);?>" 
                                                            title="Modificar">
                                                                <i class="fa-solid fa-pen"></i>
                                                            </a>
                                                            <a href="#"
                                                            class="enviarInvitacionBoton" 
                                                            data-id="<?= $d['id']; ?>"
                                                            title="Enviar invitacion">
                                                                <i class="fa-solid fa-envelope"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo base_url('/desafio/ranking/desafio='.$d['id']);?>"
                                                        title="Ranking">
                                                                <i class="fa-solid fa-ranking-star"></i>
                                                            </a>
                                                    </td>
                                            </tr>
                                            <?php endforeach; 
                                        } else { ?>
                                            <tr style="text-align: center;">
                                                <td colspan="6">
                                                    Actualmente no es parte de ningún desafio
                                                </td>
                                            </tr>
                                        <?php }?>
                            
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->

                    <div class="modal fade" id="enviarInvitacionMondal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <form  action="<?php echo base_url('/enviarinvitacion/');?>" id="formInvitacion" method="post">

                                    <?= csrf_field() ?>

                                    <input type="hidden" name="idDesafio" id="idDesafio">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Enviar Invitaciones</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="flex-column d-flex">
                                            <label for="nombre" class="form-label">Mensaje (opcional)</labe>
                                            <textarea name="mensaje"
                                                    id="mensaje"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Escriba un mensaje para la invitación..."></textarea>
                                        </div>

                                        
                                        <div class="flex-column d-flex">
                                            <label>Emails</label>
                                            <input type="text" 
                                                    id="emailsInput"
                                                    class="form-control"
                                                    placeholder="Escriba email y presione Enter">

                                            <!-- hidden field that will store all emails -->
                                            <input type="hidden" name="emails" id="emailsHidden">

                                            <div id="emailChips" class="mt-2" style="display: flex; gap: 8px"></div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button id="guardarInvitaciones" type="submit" class="btn btn-primary" disabled>
                                            Guardar
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section> 

            <script>
                let emails = [];

                $('.enviarInvitacionBoton').on('click', function() {

                    var id = $(this).data('id');

                    $('#idDesafio').val(id);

                    $('#enviarInvitacionMondal').modal('show');
                });

                $('#emailsInput').keypress(function(e){

                    if(e.which == 13){ // Enter
                        e.preventDefault();

                        let email = $(this).val().trim();

                        if (email && validateEmail(email)) {
                            addChip(email);

                            $('#emailsHidden').val(emails.join(','));

                            $(this).val('');
                        }
                    }
                });

                                
                function addChip(email) {

                    if (emails.includes(email)) return; // prevent duplicates

                    emails.push(email);

                    const chip = document.createElement('span');
                    chip.className = 'badge bg-primary me-2 mb-2';
                    chip.innerHTML = `
                        ${email}
                        <span style="cursor:pointer; margin-left:8px;" onclick="removeChip('${email}', this)">
                            &times;
                        </span>
                    `;

                    $('#emailChips').append(chip);

                    updateGuardarButton();
                }

                function updateGuardarButton() {
                    if (emails.length > 0) {
                        $('#guardarInvitaciones').prop('disabled', false);
                    } else {
                        $('#guardarInvitaciones').prop('disabled', true);
                    }
                }

                function removeChip(email, element) {
                    emails = emails.filter(e => e !== email);
                    element.parentElement.remove();

                    
                    updateGuardarButton();
                }

                function validateEmail(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                }
            </script>
        