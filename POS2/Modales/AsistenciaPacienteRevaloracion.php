<?php 
include "../Consultas/db_connection.php";
include "../Consultas/Sesion.php";
include "../Consultas/Consultas.php";
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
$user_id=null;
$sql1= "SELECT Agenda_revaloraciones.Id_genda,Agenda_revaloraciones.Nombres_Apellidos,Agenda_revaloraciones.Telefono,Agenda_revaloraciones.Fk_sucursal,
Agenda_revaloraciones.Medico,Agenda_revaloraciones.Fecha,Agenda_revaloraciones.Turno,Agenda_revaloraciones.Motivo_Consulta,Agenda_revaloraciones.Agrego,Agenda_revaloraciones.AgregadoEl, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Agenda_revaloraciones, SucursalesCorre WHERE SucursalesCorre.ID_SucursalC = Agenda_revaloraciones.Fk_sucursal AND Agenda_revaloraciones.Id_genda = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialidades = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialidades=$r;
  break;
}

  }
?>

<? if($Especialidades!=null):?>

  <form action="javascript:void(0)" method="post" id="AsistenciaDelPaciente" >

  <div class="form-group">
  <label for="exampleFormControlInput1">Paciente</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Nombres_Apellidos; ?>" aria-describedby="basic-addon1">
      </div>
  
  </div>
  <div class="form-group">
  <label for="exampleFormControlInput1">¿Asistió?</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
  <select aria-label="Default select example" class="form-control" name="Asistio" id="Asistio">
  <option selected>Elija una opción</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>
  
  </div></div></div>
  
  
  <input type="hidden" name="ID_CitaActualizada" id="IDCitaActualizada" value="<?php echo $Especialidades->Id_genda; ?>">
  <input type="hidden" name="ActualizadoPor" id="actualizadopor" value="<?php echo $row['Nombre_Apellidos']?>">
  <button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Confirmar <i class="fas fa-user-check"></i></button>
</form>

<script src="js/ConfirmaSiNoPacienteRevaloracion.js"></script>
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>