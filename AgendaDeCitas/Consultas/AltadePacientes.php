<script type="text/javascript">
  $(document).ready(function() {
    $('#PacientesData').DataTable({
        "order": [
          [0, "desc"]
        ],
        "lengthMenu": [
          [15, 30, 100 - 1],
          [15, 30, 100]
        ],
        "language": {
          "url": "Componentes/Spanish.json"
        }

      }

    );
  });
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id = null;
$sql1 = "SELECT COUNT(*) as TotalPACIENTES ,Ingreso,Sistema,Ingresadoen,FK_ID_H_O_D FROM 
Data_Pacientes WHERE FK_ID_H_O_D ='" . $row['ID_H_O_D'] . "' AND DATE(Ingresadoen) = DATE_FORMAT(CURDATE(),'%Y-%m-%d')
AND Sistema='Enfermer&iacute;a' GROUP by Ingreso,Sistema";
$query = $conn->query($sql1);
?>

<?php if ($query->num_rows > 0) : ?>
  <div class="table-responsive">
    <table id="PacientesData" class="table ">
      <thead>

        <th>Enfermero registrado </th>
        <th>Total de pacientes registrados </th>
        <th>Fecha </th>
        <th>Hora de registro </th>


      </thead>
      <?php while ($DataPacientes = $query->fetch_array()) : ?>
        <tr>
          <td><?php echo $DataPacientes["Ingreso"]; ?></td>
          <td><?php echo $DataPacientes["TotalPACIENTES"]; ?></td>
          <td><?php echo fechaCastellano($DataPacientes["Ingresadoen"]); ?></td>
          <td><?php echo date("g:i a", strtotime($DataPacientes["Ingresadoen"])); ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
<?php else : ?>
  <p class="alert alert-warning">Aún no hay pacientes registrados</p>
<?php endif; ?>
<!-- Modal -->
<script>
  $(".btn-edit").click(function() {
    id = $(this).data("id");
    $.post("https://saludaclinicas.com/Enfermeria2/Modales/SignosVitalesAlta.php", "id=" + id, function(data) {
      $("#form-edit").html(data);
    });
    $('#editModal').modal('show');
  });
</script>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead">Captura de signos vitales de paciente</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="alert alert-info alert-styled-left text-blue-800 content-group">
        <span class="text-semibold">Estimado usuario, </span>
        Por favor verifica los datos del paciente antes de realizar el rellenado de información.
        <button type="button" class="close" data-dismiss="alert">×</button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div id="form-edit"></div>

        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

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