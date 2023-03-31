<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
// include "Consultas/AnalisisIndex.php";
$IdBusqueda=($_POST['Sucursal']);
$fecha1=($_POST['Fecha1']);
$fecha2=($_POST['Fecha2']);
$nombresucursalelegida=($_POST['nombresucursal']);
$sql1="SELECT Ventas_POS.Cod_Barra,Ventas_POS.Nombre_Prod,Ventas_POS.Fk_sucursal,Ventas_POS.Fecha_venta,Sum(Ventas_POS.Cantidad_Venta) AS 
Expr1,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Stock_POS.Cod_Barra,Stock_POS.Fk_sucursal,Stock_POS.Existencias_R FROM 
Ventas_POS,SucursalesCorre,Stock_POS WHERE Ventas_POS.Fecha_venta BETWEEN '$fecha1' AND '$fecha2' AND Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC 
AND Ventas_POS.Fk_sucursal='$IdBusqueda' AND Stock_POS.Fk_sucursal='$IdBusqueda' AND Ventas_POS.Cod_Barra = Stock_POS.Cod_Barra GROUP BY Ventas_POS.Cod_Barra"
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Filtro de pedidos de la sucursal  <?php echo $nombresucursalelegida?> </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?php include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Datos de venta de la sucursal  <?php echo $nombresucursalelegida?> del <?php echo fechaCastellano($fecha1)?> al <?php echo fechaCastellano($fecha2)?>
  </div>
  <div >
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#FiltroEspecifico" class="btn btn-default">
  Realizar busqueda por fechas <i class="fas fa-search"></i>
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroEspecificoPorCod" class="btn btn-default">
  Realizar busqueda por Codigo <i class="fas fa-capsules"></i>
</button>
</div>
 
</div>
    
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#StockSucursalesDistribucion').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50, 150, 200, -1], [10,50, 150, 200, "Todos"]],   
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
         //para usar los botones   
         responsive: "true",
          dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
                title: 'registro de ventas del <?php echo $fecha1?> al <?php echo $fecha2?> de la sucursal <?php echo $nombresucursalelegida?>',
				className: 'btn btn-success'
			},
			
		
        ],
       
   
	   
        	        
    });     
});
   
	 
</script>
<?php 
;


$user_id=null;

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <form action="javascript:void(0)" method="post" id="ActualizaConcidentes">
        
  <div class="text-center">
  
	<div class="table-responsive">
	<table  id="StockSucursalesDistribucion" class="table table-hover">
<thead>
<th>Cod</th>
<th>Producto</th>
    <th>Sucursal</th>
    <th>Fecha</th>
    <th>Cantidad</th>
    <th>Stock en existencia</th>

	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
<td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td><?php echo fechaCastellano($Usuarios["Fecha_venta"]); ?></td>
    <td><?php echo $Usuarios["Expr1"]; ?></td>
    <td><?php echo $Usuarios["Existencias_R"]; ?></td>
		
</tr>
<?php endwhile;?>
</form>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No se encontraron coincidencias</p>
<?php endif;?>
</div>
</div>
</div>
</div>







     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
 
  include ("Modales/BuscaPorFechaVentas.php");
  include ("Modales/BuscaPorFechaVentasProductos.php");
  include ("footer.php")?>

<!-- ./wrapper -->




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