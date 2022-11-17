<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">




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
        <h4><?php echo $partidoEditar ? 'Editar partido' : 'Añadir partido' ?></h4>
        <form class="form-card" action="<?php echo base_url('agregarModificarPartido');?>" method="post" name="agregarModificarPartido"
            <?php if($listado){ echo 'style="visibility:hidden;"'; } else { echo 'style="visibility:visible;"';} ?>>
            <input type="hidden" name="id" value="<?php echo $partidoEditar ? $partidoEditar['id'] : '' ?>">

            <div class="form-group">
                <label>Fecha</label>
                <div class="input-group date" data-target-input="nearest">
                    <input type="text" name="fecha" class="datepicker col-sm-4" class="form-control datetimepicker-input" value="<?php echo $partidoEditar ? $partidoEditar['fecha'] : '' ?>"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Hora</label>
                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                        <input type="time" name="hora" class="form-control datetimepicker-input" data-target="#timepicker"/>
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <br>

            <div class="col-sm-8 flex-row d-flex">
                <button type="submit" name="submit" class="form-control col-sm-2 btn-primary"
                        onclick="return alert('¿Desea guardar el torneo con los datos ingresados?')">Guardar</button>
                <button type="button" name="cancel" class="form-control col-sm-2 ml-2 btn-danger"
                        onclick="location.href='<?php echo base_url('partidos/'.$fase['id']); ?>'">Cancelar</button>
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
              <th>Fecha</th>
              <th>Hora</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($partidos as $p) : ?>
              <tr>
                <td style="visibility: hidden;"><?= $p['id'] ?></td>
                <td><?= $p['fecha'] ?></td>
                <td><?= $p['hora'] ?></td>
                <td>
                  <a href="<?php echo base_url('delete/'.$p['id']);?>" onclick="return alert('¿Desea eliminar el partido seleccionado?')"><i class="fa-solid fa-trash-can"></i></a>
                  <a href="<?php echo base_url('modificar/'.$p['id']);?>"><i class="fa-solid fa-pen"></i></a>
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
        </div>
    </div>
</div>