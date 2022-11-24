<section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                      <h2> <?= $nombre_grupo ?></h2>
                    </div>
                </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div> <!-- /.card-header -->
    
        
        <!-- /form -->
        <div class="card-body" >
          <div class="form-container">
            <h4><?php echo $equipoEditar ? 'Editar equipo' : 'Añadir equipo' ?></h4>
            <form class="form-card" action="<?php echo base_url('agregarModificar');?>" method="post" name="agregarModificarEquipo">
              <input type="hidden" name="id" value="<?php echo $equipoEditar ? $equipoEditar['id'] : '' ?>">

              <label for="nombre" class="form-label">Nombre</label>
              <input name="nombre" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $equipoEditar ? $equipoEditar['nombre'] : '' ?>">
              <br>

              <input type="hidden" name="id_grupo" value="<?php echo $id_grupo ?>">
              
              <div class="col-sm-8 flex-row d-flex">
                <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                        onclick="return alert('¿Desea guardar el equipo con los datos ingresados?')">Guardar</button>
                <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                        onclick="location.href='<?php echo base_url('equipos'); ?>'">Cancelar</button>
              </div>

            </form><!-- /.form -->
          </div>

          <div class="table-responsive p-0" style="height: 300px;">
            <h1> <?= $titulo ?> </h1>
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

