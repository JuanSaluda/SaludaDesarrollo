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

  <title>Agendamiento de citas </title>

  <? include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>
<?include_once ("Menu.php")?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
 
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#CrediClinicas" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-file-medical"></i> Campañas de especialistas</a>
  </li>
 
</ul>
<div class="tab-content" id="pills-tabContent">

<div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2E64FE !important;color: white;">
  <i class="fas fa-user-md"></i> Especialidades de medicos express <i class="fas fa-user-md"></i>
  </div>
 
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" class="btn btn-default">
  Agendar nueva cita <i class="fas fa-file-medical"></i>
</button>
</div></div>
<div id="CitasEnLaSucursalExt"></div>

</div>
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?
   include ("Modales/Error.php");
  
   include ("Modales/Exito.php");

   include ("Modales/Precarga.php");
   
   include ("Modales/EstatusAgendaGuardado.php");
  include ("Modales/AgendarCitasDeSucursales.php");
  include ("Modales/AgendarCitasExt.php");
 include ("Modales/AltaEspecialista.php");
  include ("footer.php")?>
  <script src="js/AgendaEnSucursales.js"></script>
<script src="js/CampanasSucursales.js"></script>
<script src="js/CampanasExpress.js"></script>
<script src="js/BuscaDataPacientes.js"></script>
<script src="js/BuscaDataPacientesExt.js"></script>

<script src="js/ObtieneEspecialidadMedicoSucursal.js"></script>
<script src="js/ObtieneMedicoDeSucursal.js"></script>
<script src="js/ObtieneFechas.js"></script>
<script src="js/ObtieneHoras.js"></script>
<script src="js/ObtieneEspecialidadMedicoExt.js"></script>
<script src="js/ObtieneMedicoDeSucursalExt.js"></script>
<script src="js/ObtieneFechasExt.js"></script>
<script src="js/ObtieneHorasExt.js"></script>
<script src="js/AgendaEnSucursalesExt.js"></script>

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