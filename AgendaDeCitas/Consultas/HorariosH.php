<script type="text/javascript">
$(document).ready( function () {
    $('#Horarios').DataTable({
      "language": {
        "url": "Componentes/Spanish.json"
        }
      } );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Horarios_Citas_especialistas.ID_Horario,Horarios_Citas_especialistas.Horario_Disponibilidad,
Horarios_Citas_especialistas.ID_H_O_D,Horarios_Citas_especialistas.FK_Especialista,Horarios_Citas_especialistas.Estatus_Horario,
Horarios_Citas_especialistas.CodigoColorHo, Especialistas.ID_Especialista,
Especialistas.Nombre_Apellidos FROM Horarios_Citas_especialistas,Especialistas where 
Horarios_Citas_especialistas.FK_Especialista = Especialistas.ID_Especialista
 AND Horarios_Citas_especialistas.ID_H_O_D ='".$row['ID_H_O_D']."'";
 

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Horarios" class="table table-hover">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
	<th>Horario</th>
	<th>Estatus</th>
	<th>Editar</th>
	


</thead>
<?php while ($Horario=$query->fetch_array()):?>
<tr>
	<td><?php echo $Horario["ID_Horario"]; ?></td>
    <td><?php echo $Horario["Nombre_Apellidos"]; ?></td>
    <td><?php echo date('h:i A', strtotime($Horario["Horario_Disponibilidad"])); ?></td>
	
		
	<td><button class="<?php echo $Horario['CodigoColorHo'];?>"><?php echo $Horario["Estatus_Horario"]; ?></button></td>
	

	
	<td>
		<button data-id="<?php echo $Horario["ID_Horario"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludaclinicas.com/Controldecitas/Modales/EditaHorarioH.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Editar Horario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>
		<span id="error_actualiza" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->