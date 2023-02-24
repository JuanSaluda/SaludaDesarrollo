<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SERVICIOS ESPECIALIZADOS |<?echo $row['ID_Sucursal']?> </title>

  <!-- Font Awesome Icons -->
 
  <?include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<!-- <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">¡ATENCIÓN! </h4>
  <p>El espacio en el disco del servidor está llegando al límite, se recomienda contactar a soporte para realizar tareas de mantenimiento.</p>

</div> -->
<div class="card text-center">
  <div class="card-header" style="background-color:#0195AF !important;color: white;">
  Ultrasonidos pendientes de entrega al  <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div >
  
</div>

</div>
  <!-- Content Wrapper. Contains page content -->
  

  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="TablaResultadosUltrasonidos"></div>


</div>
</div>
</div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <?include "footer.php" ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="js/ControlUltras.js"></script>
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
<?

function fechaCastellano ($fecha) {
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
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>