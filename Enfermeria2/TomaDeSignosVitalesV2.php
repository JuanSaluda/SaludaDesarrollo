<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Cita en sucursal <?php echo $row['Nombre_Sucursal'] ?></title>

  <?php include "Header.php" ?>
</head>
<?php include_once("Menu.php") ?>
<div class="card text-center">
  <div class="card-header" style="background-color: #33b5e5 !important;color: white;">
    Cita en sucursal <?php echo $row['Nombre_Sucursal'] ?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>
  </div>
  <div>
    <a type="button" class="btn btn-success" href="AltaPacientes">
      Alta de paciente <i class="fas fa-plus-square"></i>
    </a>
  </div>

</div>








</div>
</div>
</div>




<!-- Main Footer -->
<?php
include("Modales/AltaCitaSucursal.php");
include("Modales/Exito.php");
include("Modales/Confirmacion.php");
include("Modales/Precarga.php");
include("footer.php"); ?>
<!-- ./wrapper -->



<script src="js/GuardaCita.js"></script>
<script src="js/Capturadata.js"></script>
<script src="js/CalculaIMC.js"></script>

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