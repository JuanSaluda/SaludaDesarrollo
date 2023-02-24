<script>

tabla = $('#Traspasos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/CEDISMOVIL/Consultas/ArrrayTraspasosPartner.php",
 "aoColumns": [
       { mData: 'IDTraspasoGenerado' },
       { mData: 'Cod_Barra' },
       { mData: 'NumOrden' },
       { mData: 'Nombre_Prod' },
       { mData: 'ProveedorTraspaso' },
       { mData: 'Fk_sucursal' },
       { mData: 'Destino' },
       { mData: 'Cantidad' },
      { mData: 'FechaEntrega' },
        {mData: "Estatus",
       "searchable": true,
        "orderable":true,
        "render": function (data, type, row) {
            if ( row.Estatus="Generado") {

            return '<button class="btn btn-default btn-sm" style="background-color:#2b73bb !important">Generado</button>';
        }
        else if ( row.Estatus="Cancelado") {
return '<button class="btn btn-default btn-sm" style="background-color:#ff1800!important">Cancelado</button>'
        }
            else {
 
    return '<button class="btn btn-default btn-sm" style="background-color:#2bbb1d!important">Entregado</button>';
 
}
        }
 
    },

    { mData: 'Traspasocorrecto' },
    //    { mData: 'Traspasoincorrecto' },
       
       
       
      ],
     
    
      "lengthMenu": [[20,50,150,250,500, -1], [20,50,150,250,500, "Todos"]],  
  
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
          
       
       
   
	   
        	        
    });     

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="Traspasos" class="table table-hover">
<thead>

<th>ID</th>
<th>Codigo de barras</th>
<th># de orden </th>
<th>Nombre</th>
<th>Tipo Traspaso</th>
<th>Origen</th>
<th>Destino</th>
<th>Cantidad</th>

<th>Fecha estimada de entrega</th>
<th>Estatus</th>
<th>Aceptar Traspaso</th>
<!-- <th>Marcar observacion</th> -->
</thead>

</div>
</div>


<!-- <script>
  $(".btn-edit").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Asignacion de productos en otras sucursales");
       
        $("#DiProductosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-success");
    });
    $('#editModalProductosG').modal('show'); 
});
$(".btn-VerDistribucion").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DistribucionesProductos.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Distribucion de productos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});
$(".btn-editProd").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/EditaProductosStockGeneral.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Editar datos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});
$(".btn-History").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialProductos.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Actualizaciones y movimientos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});


$(".btn-Delete").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DeleteProductos.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Eliminar producto");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiProductosG").addClass("modal-dialog modal-sm modal-notify modal-danger");
    });
    $('#editModalProductosG').modal('show');
});


</script>


  <div class="modal fade" id="editModalProductosG" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiProductosG"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloProductosG"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editProductosG"></div>
        
        </div>

      </div>
    </div>
  </div> -->
