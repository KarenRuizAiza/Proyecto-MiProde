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

      <div class="card-header"  style="padding: 2em 0; background-color: aliceblue">
        <h4 class="form-titulo"><?php echo $equipoEditar ? 'Editar equipo' : 'Añadir equipo' ?></h4>

          <div class="card-tools" style="width: 100%;">
              <div class="input-group input-group-sm">

                <div class="form-container w-100">
                  <form class="form-group form-card" style="place-items: center;" action="<?php echo base_url('agregarModificar');?>" method="post" name="agregarModificarEquipo" id="form-equipo">
                      
                      <input type="hidden" name="id" value="<?php echo $equipoEditar ? $equipoEditar['id'] : '' ?>">

                      <div class="form-group align-items-center" style="width: 30rem">
                        <label for="nombre" class="form-label">Nombre</labe>
                        <input name="nombre" class="form-control" value="<?php echo $equipoEditar ? $equipoEditar['nombre'] : '' ?>">
                      </div>


                      <div class="input-group  align-items-center">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" accept=".png, .svg, .jpg" id="imagen" onchange="updateFileName()">
                          <label class="custom-file-label" for="imagen" aria-describedby="imagenAddon">Selecciona una imagen...</label>
                        </div>
                      </div>

                      <div class="flex-row d-flex col-sm-4" style="gap: 1rem">
                          <button type="submit" name="submit" class="form-control btn-primary"
                                  onclick="return confirm('¿Desea guardar el equipo con los datos ingresados?')">Guardar</button>
                          <button type="button" name="cancel" class="form-control ml-2 btn-danger"
                                  onclick="location.href='<?php echo base_url('grupos'); ?>'">Cancelar</button>
                      </div>

                  </form>
                </div>
              </div>
          </div>
      </div><!-- /.card-header -->

        
        <!-- /form -->
        <div class="card-body" >

          <div class="table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($equipos as $e) : ?>
                  <tr>
                   <td><?= $e['nombre'] ?></td>
                    <td>
                      <a href="<?php echo base_url('delete/'.$e['id']);?>" onclick="return alert('¿Desea eliminar el equipo seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                      <a href="<?php echo base_url('update/'.$e['id']);?>"><i class="fa-solid fa-pen"></i></a>
                    </td>
                 </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        
        </div><!-- /.card-body -->
     
    </div> <!-- /.card -->
  </div>
</section> 

<script>
  function updateFileName() {
    const input = document.getElementById('imagen');
    const label = input.nextElementSibling; // El label correspondiente al input
    const fileName = input.files[0] ? input.files[0].name : 'Selecciona una imagen...'; // Si hay un archivo, toma su nombre
    label.textContent = fileName; // Actualiza el texto del label
  }
</script>

