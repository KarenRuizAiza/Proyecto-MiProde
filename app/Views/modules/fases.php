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
        <h4><?php echo $faseEditar ? 'Editar fase:' : 'Añadir fase:' ?></h4>
        <form class="form-card" action="<?php echo base_url('agregarModificarFase');?>" method="post" name="agregarModificarFase">
            <input type="hidden" name="id" value="<?php echo $faseEditar ? $faseEditar['id'] : '' ?>">

            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $faseEditar ? $faseEditar['nombre'] : '' ?>">
            <br>

            <div class="form-group">
              <label>Fecha Inicio</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" name="fecha_inicio" class="form-control datetimepicker-input col-sm-4 flex-column d-flex" data-target="#reservationdate" value="<?php echo $faseEditar ? $faseEditar['fecha_inicio'] : '' ?>"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
            </div>

            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <div class="input-group">
              <div for="fecha_fin" class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="text" name="fecha_fin "class="form-control col-sm-4 flex-column d-flex" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo $faseEditar ? $faseEditar['fecha_fin'] : '' ?>">
            </div>
            
            <input type="hidden" name="id_torneo" value="<?php echo $faseEditar ? $faseEditar['id_torneo'] : '' ?>">
            <br>

            <div class="col-sm-8 flex-row d-flex">
                <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                        onclick="return alert('¿Desea guardar la fase con los datos ingresados?')">Guardar</button>
                <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                        onclick="location.href='<?php echo base_url('fases'); ?>'">Cancelar</button>
            </div>

        </form>
      </div>
      <!-- /.form -->

      <div class="card-body table-responsive p-0" style="height: 300px;">
        <h1> <?= $titulo ?> </h1>
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th style="visibility: hidden;">Id</th>
              <th>Nombre</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th style="visibility: hidden;">IdTorneo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fases as $f) : ?>
              <tr>
                <td style="visibility: hidden;"><?= $f['id'] ?></td>
                <td><?= $f['nombre'] ?></td>
                <td><?= $f['fecha_fin'] ?></td>
                <td><?= $f['fecha_fin'] ?></td>
                <td style="visibility: hidden;"><?= $f['id_torneo'] ?></td>
                <td>
                  <a href="<?php echo base_url('delete/'.$f['id']);?>" onclick="return alert('¿Desea eliminar la fase seleccionada?')"><i class="fa-solid fa-trash-can"></i></a>
                  <a href="<?php echo base_url('update/'.$f['id']);?>"><i class="fa-solid fa-pen"></i></a>
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