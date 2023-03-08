<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/ConsultaEstadoConexion.php";
include "Consultas/Mensaje.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AGENDA DE CITAS | <?php echo $row['ID_H_O_D'] ?> </title>

  <!-- Font Awesome Icons -->
  <?php include "Header.php" ?>

</head>
<?php include_once("Menu.php") ?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-user-md"></i> Revaloraciones </a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#CrediClinicas" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-file-medical"></i> Campañas de especialistas</a>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color: #2E64FE !important;color: white;">
        Citas en sucursal del <?php echo FechaCastellano(date('d-m-Y H:i:s'));  ?> al <?php echo FechaCastellano(date('d-m-Y H:i:s', strtotime("+4 day")));  ?>
      </div>

      <div>

      </div>

    </div>



    <div id="CitasDeRevaloracion"></div>
  </div>
  <div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color: #2E64FE !important;color: white;">
        Citas de especialistas del <?php echo FechaCastellano(date('d-m-Y H:i:s'));  ?> al <?php echo FechaCastellano(date('d-m-Y H:i:s', strtotime("+4 day")));  ?>
      </div>
    </div>

    <div>

    </div>
    <div id="CitasEnLaSucursalExt"></div>
  </div>
</div>
</div>








<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<?php include("Modales/Ingreso.php");
include("Modales/Error.php");
include("Modales/Eliminar.php");
include("Modales/NuevoPaciente.php");
include("Modales/EstatusAgendaGuardado.php");
include("Modales/RecordatorioFechas.php");
include("footer.php"); ?>
<!-- ./wrapper -->

<script src="js/Revaloraciones.js"></script>
<script src="js/ControlCampanasDiasExtV2.js"></script>
<script src="js/Logs.js"></script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
</body>

</html>

<?php

function fechaCastellano($fecha)
{
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}
?>
<?php
if ($EstadoIngreso["Estado_Conexion"] == 1) {
} else {

  echo '
 <script>
$(document).ready(function()
{
// id de nuestro modal

$("#Ingreso").modal("show");
});
</script>
 ';
}
?>