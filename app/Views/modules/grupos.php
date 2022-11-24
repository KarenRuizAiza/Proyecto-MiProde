<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- /form -->
      <div class="form-container">
        <h4><?php echo $grupoEditar ? 'Editar grupo:' : 'Añadir grupo:' ?></h4>
        <form class="form-card" action="<?php echo base_url('agregarModificarGrupo');?>" method="post" name="agregarModificarGrupo">
            <input type="hidden" name="id" value="<?php echo $grupoEditar ? $grupoEditar['id'] : '' ?>">

            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $grupoEditar ? $grupoEditar['nombre'] : '' ?>">
            <br>
            
            <div class="col-sm-8 flex-row d-flex">
                <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                        onclick="return alert('¿Desea guardar el grupo con los datos ingresados?')">Guardar</button>
                <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                        onclick="location.href='<?php echo base_url('grupos'); ?>'">Cancelar</button>
            </div>

        </form>
      </div>
      <!-- /.form -->

      <div class="card-body table-responsive p-0" style="height: 300px;">
        <h1> <?= $titulo ?> </h1>
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Equipos</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($grupos as $g) : ?>
              <tr>
                <td><?= $g['nombre'] ?></td>
                <td>
                  <a href="<?php echo base_url('equipos/'.$g['id']);?>"> <i class="fa-solid fa-table-list"></i> Ver </a>
                  <a href="<?php echo base_url('agregarEquipo/'.$g['id']); ?>"><i class="fa-solid fa-plus"></i> Agregar  </a>
                </td>
                <td>
                  <a href="<?php echo base_url('deleteGrupo/'.$g['id']);?>" onclick="return alert('¿Desea eliminar el grupo seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                  <a href="<?php echo base_url('updateGrupo/'.$g['id']);?>"><i class="fa-solid fa-pen"></i></a>
                  
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>