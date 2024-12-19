            </div>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022-2024 <a href="http://localhost/miprode/public/">MiProde</a>.</strong> Todos los derechos reservados.
        </footer>
      </div>
      <!-- ./wrapper -->

      <!-- REQUIRED SCRIPTS -->

      <!-- jQuery -->

      <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
      <!-- Bootstrap 4 -->
      <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
      <!-- AdminLTE App -->
      <script src="<?= base_url('js/adminlte.min.js') ?>"></script>
      <!-- Bootstrap4 Duallistbox -->
      <script src="<?= base_url('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>
      <script src="<?= base_url('plugins/moment/moment.min.js')?>"></script>
      <script src="<?= base_url('plugins/daterangepicker/daterangepicker.js')?>"></script>
      <script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>

      <script>
        $(function ()
{
            //Date range picker with time picker
            $('#reservationdate')?.datetimepicker({
                format: 'DD/MM/YYYY',
            })

            $('#reservationdateStart').datetimepicker({
                format: 'DD/MM/YYYY',
            })
            $('#reservationdateEnd').datetimepicker({
                format: 'DD/MM/YYYY',
            })
            //Timepicker
            $('#timepicker')?.datetimepicker({
                format : 'HH:mm'
            });
        });
      </script>
  </body>
</html>
