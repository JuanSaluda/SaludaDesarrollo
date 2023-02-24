<script type="text/javascript">
$(document).ready( function () {
    $('#CitasExteriores').DataTable({
      "order": [[ 0, "desc" ]],
     
      "info": false,
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
    
		
	  } 
	  
	  );
} );
</script>
<?php
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
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Agenda_revaloraciones.Id_genda,Agenda_revaloraciones.Nombres_Apellidos,Agenda_revaloraciones.Telefono,Agenda_revaloraciones.Fk_sucursal,
Agenda_revaloraciones.Medico,Agenda_revaloraciones.Fecha,Agenda_revaloraciones.Asistio,Agenda_revaloraciones.Turno,Agenda_revaloraciones.Motivo_Consulta,Agenda_revaloraciones.Agrego,Agenda_revaloraciones.AgregadoEl, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Agenda_revaloraciones, SucursalesCorre WHERE SucursalesCorre.ID_SucursalC = Agenda_revaloraciones.Fk_sucursal 
AND Agenda_revaloraciones.Fk_Sucursal='".$row['Fk_Sucursal']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CitasExteriores" class="table table-hover">
<thead>
<th>Folio</th>
<th>Paciente</th>
<th>Telefono</th>
<th>Fecha </th>
<th>Sucursal</th>
<th>Medico</th>
<th>Turno</th>
<th>Motivo_Consulta</th>
<th>¿El paciente asistio?</th>
<th>Contacto por whatsaap</th>
<th>Acciones</th>



</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

    <td> <?php echo $Usuarios["Id_genda"]; ?></td>
    <td> <?php echo $Usuarios["Nombres_Apellidos"]; ?></td>
    <td> <?php echo $Usuarios["Telefono"]; ?></td>
    <td> <?php echo fechaCastellano($Usuarios["Fecha"]); ?> </td>
    <td> <?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["Medico"]; ?></td>
    <td> <?php echo $Usuarios["Turno"]; ?></td>
    <td> <?php echo $Usuarios["Motivo_Consulta"]; ?></td>
    <td> <?php echo $Usuarios["Asistio"]; ?></td>
    <td> <a class="btn btn-success"  href="https://api.whatsapp.com/send?phone=+52<?php echo $Usuarios["Telefono"]; ?>&text=¡Hola <?php echo $Usuarios["Nombres_Apellidos"]; ?> ! Te contactamos de *Saluda Centro Médico Familiar <?php echo $Usuarios["Nombre_Sucursal"]; ?>* para recordatorio de su cita médica con el doctor(a) <?php echo $Usuarios["Medico"]; ?> agendada para el día *<?php echo fechaCastellano($Usuarios["Fecha"]); ?>* en el turno *<?php echo $Usuarios["Turno"]; ?>*   Agradecemos su pronta confirmación.😃" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a></td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">

  
  <!-- <a data-id="<?php echo $Usuarios["Id_genda"];?>" class="btn-Cancela dropdown-item" >Cancelar <i class="fas fa-ban"></i></a> -->
  <a data-id="<?php echo $Usuarios["Id_genda"];?>" class="btn-Asiste dropdown-item" >¿el paciente asistio? <i class="far fa-calendar-check"></i></a>
 
</div>
<!-- Basic dropdown -->
	 </td>
   
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Por el momento no hay citas</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	
    

    $(".btn-Cancela").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/CancelaCitaRev.php","id="+id,function(data){
              $("#form-editExt").html(data);
              $("#TituloExt").html("Cancelación");
              $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#DiExt").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModalExt').modal('show');
    });


    $(".btn-Asiste").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/AsistenciaPacienteRevaloracion.php","id="+id,function(data){
              $("#form-editExt").html(data);
              $("#TituloExt").html("¿El paciente asistió?");
              $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#DiExt").addClass("modal-dialog modal-sm modal-notify modal-success");
  		});
  		$('#editModalExt').modal('show');
    });
    
  </script>
  <div class="modal fade" id="editModalExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalExtLabel" aria-hidden="true">
  <div id="DiExt"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloExt"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editExt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->