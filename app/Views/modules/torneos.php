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
        <h4><?php echo $torneoEditar ? 'Editar torneo:' : 'Añadir torneo:' ?></h4>
        <form class="form-card" action="<?php echo base_url('agregarModificarTorneo');?>" method="post" name="agregarModificarTorneo">
            <input type="hidden" name="id" value="<?php echo $torneoEditar ? $torneoEditar['id'] : '' ?>">

            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $torneoEditar ? $torneoEditar['nombre'] : '' ?>">
            <br>

            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" name="descripcion" class="form-control col-sm-4 flex-column d-flex" value="<?php echo $torneoEditar ? $torneoEditar['descripcion'] : '' ?>">
            <br>

            <div class="form-group">
              <label>Fecha Inicio</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text" name="fecha_inicio" class="form-control datetimepicker-input col-sm-4 flex-column d-flex" data-target="#reservationdate" value="<?php echo $torneoEditar ? $torneoEditar['fecha_inicio'] : '' ?>"/>
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
              <input type="text" name="fecha_fin "class="form-control col-sm-4 flex-column d-flex" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo $torneoEditar ? $torneoEditar['fecha_fin'] : '' ?>">
            </div>
            <br>

            <div class="col-sm-8 flex-row d-flex">
                <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                        onclick="return alert('¿Desea guardar el torneo con los datos ingresados?')">Guardar</button>
                <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                        onclick="location.href='<?php echo base_url('torneos'); ?>'">Cancelar</button>
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
              <th>Descripcion</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($torneos as $t) : ?>
              <tr>
                <td style="visibility: hidden;"><?= $t['id'] ?></td>
                <td><?= $t['nombre'] ?></td>
                <td><?= $t['descripcion'] ?></td>
                <td><?= $t['fecha_fin'] ?></td>
                <td><?= $t['fecha_fin'] ?></td>
                <td>
                  <a href="<?php echo base_url('delete/'.$t['id']);?>" onclick="return alert('¿Desea eliminar el torneo seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                  <a href="<?php echo base_url('update/'.$t['id']);?>"><i class="fa-solid fa-pen"></i></a>
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