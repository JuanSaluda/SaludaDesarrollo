


<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Traspasos_generados.ID_Traspaso_Generado,Traspasos_generados.Folio_Prod_Stock,Traspasos_generados.TraspasoRecibidoPor,	Traspasos_generados.TraspasoGeneradoPor,Traspasos_generados.Num_Orden,
Traspasos_generados.Num_Factura,Traspasos_generados.TotaldePiezas,
Traspasos_generados.Cod_Barra, Traspasos_generados.Nombre_Prod,Traspasos_generados.Fk_sucursal,Traspasos_generados.Fk_Sucursal_Destino, Traspasos_generados.Proveedor1,	Traspasos_generados.Proveedor2,
Traspasos_generados.Precio_Venta,Traspasos_generados.Precio_Compra, Traspasos_generados.Total_traspaso,Traspasos_generados.TotalVenta,Traspasos_generados.Existencias_R,Traspasos_generados.ProveedorFijo,
 Traspasos_generados.Cantidad_Enviada,Traspasos_generados.Existencias_D_envio,Traspasos_generados.FechaEntrega,Traspasos_generados.Estatus,Traspasos_generados.ID_H_O_D,
 SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Traspasos_generados,SucursalesCorre WHERE Traspasos_generados.Fk_sucursal = SucursalesCorre.ID_SucursalC AND 
 MONTH(Traspasos_generados.FechaEntrega) = MONTH(CURDATE())"; 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["IDTraspasoGenerado"] = $fila["ID_Traspaso_Generado"];
    $data[$c]["NumberOrden"] = $fila["Num_Orden"];
    $data[$c]["NumberFactura"] = $fila["Num_Factura"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
  
   
    
    $data[$c]["ProveedorFijo"] = $fila["ProveedorFijo"];
    $data[$c]["Fk_sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Destino"] = $fila["Fk_Sucursal_Destino"];
    $data[$c]["Cantidad"] = $fila["Cantidad_Enviada"];
    $data[$c]["PrecioCompra"] = $fila["Precio_Venta"];
    $data[$c]["PrecioVenta"] = $fila["Precio_Compra"];
    $data[$c]["Total_traspaso"] = $fila["Total_traspaso"];
    $data[$c]["TotalVenta"] = $fila["TotalVenta"];
    $data[$c]["TotaldePiezas"] = $fila["TotaldePiezas"];
    $data[$c]["FechaEntrega"] = fechaCastellano($fila["FechaEntrega"]);
    $data[$c]["Estatus"] =$fila["Estatus"];
    $data[$c]["Envio"] =$fila["TraspasoGeneradoPor"];
    $data[$c]["Recibio"] =$fila["TraspasoRecibidoPor"];

    $data[$c]["Acciones"] = ["<button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-th-list fa-1x'></i></button><div class='dropdown-menu'><a href=https://controlfarmacia.com/CEDIS/CancelaTraspaso?idProd=".base64_encode($fila["ID_Prod_POS"])." class='btn-edit  dropdown-item' >Cancelar Traspaso <i class='fas fa-ban'></i></a><a href=https://controlfarmacia.com/AdminPOS/DistribucionSucursales?Disid=".base64_encode($fila["ID_Prod_POS"])." class='btn-VerDistribucion  dropdown-item' >Consultar distribución <i class='fas fa-table'></i> </a><a href=https://controlfarmacia.com/AdminPOS/EdicionDatosProducto?editprod=".base64_encode($fila["ID_Prod_POS"])." class='btn-editProd dropdown-item' >Editar datos <i class='fas fa-pencil-alt'></i></a><a href=https://controlfarmacia.com/AdminPOS/HistorialProducto?idProd=".base64_encode($fila["ID_Prod_POS"])." class='btn-History dropdown-item' >Ver movimientos <i class='fas fa-history'></i></a><a href=https://controlfarmacia.com/AdminPOS/EliminarProductoGeneral?idProd=".base64_encode($fila["ID_Prod_POS"])." class='btn-Delete dropdown-item' >Eliminar Producto <i class='fas fa-minus-circle'></i></a></div> "];
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>




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