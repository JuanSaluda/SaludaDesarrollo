<?php

include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Personal | <? echo $row['ID_H_O_D'] ?> </title>

  <?php include "Header.php" ?>
  <style>
    .error {
      color: red;
      margin-left: 5px;

    }
  </style>
</head>
<?php include_once("Menu.php") ?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Personal Vigente</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bajas</a>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color:#2b73bb !important;color: white;">
        Personal de intendecia vigentes al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>
      </div>

      <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaEmpleado" class="btn btn-default">
          Añadir nuevo empleado <i class="fas fa-user-plus"></i>
        </button>
      </div>
    </div>






    <div id="tablaEmpleados"></div>


  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color:#2b73bb !important;color: white;">
        Bajas de intendencia al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>
      </div>

      <div>

      </div>
    </div>






    <div id="tablaEmpleadosBajas"></div>


  </div>

</div>
</div>
</div>



<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- Main Footer -->
<?php

include("Modales/AltaEmpleadosLimpieza.php");
include("Modales/Vacios.php");
include("Modales/Error.php");
include("Modales/Exito.php");
include("Modales/ExitoActualiza.php");
include("footer.php") ?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ControlEmpleadosLimpieza.js"></script>
<script src="js/ControlEmpleadosLimpiezaBajas.js"></script>
<script src="js/AltaEmpleadosLimpieza.js"></script>



<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->

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