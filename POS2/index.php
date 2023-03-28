
<?php
# Iniciando la variable de control que permitirá mostrar o no el modal
$exibirModal = false;
# Verificando si existe o no la cookie
if(!isset($_COOKIE["IngresoVentas"]))
{
 
  $expirar = 43200; //muestra cada 12 horas
  //$expirar = 86400;  // muestra cada 24 horas
  setcookie('IngresoVentas', 'SI', (time() + $expirar)); // mostrará cada 12 horas.
  # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
  $exibirModal = true;
}
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/NotificacionesApp.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";
include "Consultas/ConsultaFondoCaja.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>PUNTO DE VENTA | <?php echo $row["Nombre_Sucursal"]; ?></title>

  <?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                
                <h3>Caja</h3>
              </div>
              <div class="icon">
              <i class="fas fa-cash-register"></i>
              </div>
              <a data-id="<?php echo $ValorFondoCaja["ID_Fon_Caja"];?>" class="btn-edit small-box-footer">Administrar caja <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">

                <h3>Traspasos</h3>
              </div>
              <div class="icon">
              <i class="fas fa-box-open"></i>
              </div>
              <a data-toggle="modal" data-target="#ConsultaTraspasos" class="small-box-footer">Ver traspasos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                

                <h3>Productos</h3>
              </div>
              <div class="icon">
              <i class="fas fa-search"></i>
              </div>
              <a data-toggle="modal" data-target="#ConsultaProductos" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                

                <h3>Incidencias</h3>
              </div>
              <div class="icon">
              <i class="fas fa-bullhorn"></i>
              </div>
              <a data-toggle="modal" data-target="#ReporteRapidoModal" class="small-box-footer">Reportar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div> </div>
       
     


        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
 
  <li class="nav-item">
    <a class="nav-link active " id="pills-home-tab" data-toggle="pill" href="#CrediClinicas" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-file-medical"></i> Campañas de especialistas</a>
  </li>
 
</ul>
<div class="tab-content" id="pills-tabContent">

<div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Citas de especialistas del <?php echo FechaCastellano(date('d-m-Y H:i:s'));  ?>  al <?php echo FechaCastellano(date('d-m-Y H:i:s', strtotime("+4 day")));  ?> 
  </div>
  </div>
 
  <div >
  
</div>
<div id="CitasEnLaSucursalExt"></div>

</div>


<div aria-live="polite" aria-atomic="true" style="position:inherit;">
  <!-- Position it -->
  <div style="position: absolute; top: 0; right: 0;">
  <?php if($query->num_rows>0):?>
    <?php while ($Usuarios=$query->fetch_array()):?>
    <!-- Then put toasts within -->
    <div class="toast" id="toastt" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
      <img src="https://controlconsulta.com/Perfiles/Doctor_Consulta.png" style="width: 8%;" class="rounded mr-2" alt="...">
        <strong class="mr-auto"><?echo $Usuarios['Tipo_Notificacion']?></strong><small class="text-mute"><?echo date('h:i A', strtotime(($Usuarios['Registrado'])))?></small> <br>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        <div class="text-center">
      <?echo $Usuarios['Encabezado']?> <?echo $Usuarios['Mensaje_Notificacion']?>
      <form enctype="multipart/form-data" id="ActualizaNotificaciones">
        <input hidden type="text" name="idactualizable"value="<?echo $Usuarios['ID_Notificacion']?>">
        <input hidden type="text" name="nuevoestado"value="0">
      <button type="submit"  onclick="chale()" id="EnviarDatos" value="Guardar" class="btn btn-success btn-sm">Marcar como leído <i class="fa-solid fa-check"></i></button>
      
    
      </div></form></div></div> 
    <?php endwhile;?>

</div>
</div>
<?php else:?>
	
<?php endif;?>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
       
  <!-- Main Footer -->
  
    

<script>

$(document).ready(function(){
    $(".toast").toast({autohide:false});
    // $('.toast').toast({ delay: 9000 });
    $(".toast").toast("show");
  });

  function chale(){
    $(".toast").toast("hide");
  }
</script>
</div></div>
  <?php include ("Modales/Ingreso.php");
      include ("Modales/ModalConsultaProductos.php");
      include ("Modales/ModalTraspasos.php");
      include ("Modales/Error.php");
      include ("Modales/ReporteRapido.php");
  
   include ("Modales/Exito.php");
  include ("footer.php");
 ?>
<!-- ./wrapper -->
<script src="js/ControlCampanasDiasSucursalesV2.js"></script>
<script src="js/ControlCampanasDiasExtV2.js"></script>
<script src="js/GuardaReporteRapidoIndex.js"></script>
<script src="js/Logs.js"></script>
<script src="js/Cambianotificacion.js"></script>
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
<?php if($exibirModal === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
<script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#Ingreso").modal("show");
});
</script>
<?php endif; ?> 

<script>
  	
    $(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludaclinicas.com/POS2/Modales/AbreCajaIndex.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Apertura de caja");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#AltaFondo').modal('show');
    });


    window.addEventListener("online",function(){alert("Todo ok");},false); 
window.addEventListener("offline",function(){$("#Sinwifi").modal("show");},false);
  </script>
  <div class="modal fade" id="AltaFondo" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
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