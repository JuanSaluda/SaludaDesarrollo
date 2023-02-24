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
 
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="Componentes/fontsgoogle.css" rel="stylesheet">

  <link rel="stylesheet" href="Componentes/bootstrap.min.css">
  

<!-- JS, Popper.js, and jQuery -->
<script src="Componentes/jquery-3.5.1.slim.min.js"></script>
<script src="Componentes/popper.min.js"></script>
<script src="Componentes/bootstrap.min.js"></script>

<!-- JS, Popper.js, and jQuery -->

<script src="Componentes/jquery-3.5.0.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="Componentes/datatables.min.css"/>
<script type="text/javascript" src="Componentes/datatables.min.js"></script>
<script src="Componentes/sweetalert2@9.js"></script>
<script src="Componentes/b5ed0deb1b.js"></script>
</head>
<?include_once ("Menu.php")?>
<!-- <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">¡ATENCIÓN! </h4>
  <p>El espacio en el disco del servidor está llegando al límite, se recomienda contactar a soporte para realizar tareas de mantenimiento.</p>

</div> -->
<div class="card text-center">
  <div class="card-header" style="background-color:#0195AF !important;color: white;">
  <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Desplegar ayuda <i class="far fa-comment-alt"></i></button>
  </div>
  <div class="collapse" id="collapseExample">
  <div class="card-body">
  <div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Descarga pdf</th>
      <th scope="col">Descarga pdf movil</th>
      <th scope="col">Abrir whatsapp</th>
      <th scope="col">Editar informacion</th>
    </tr>
      <td><button class="btn btn-warning"><span class="far fa-file-pdf"></span></button></td>
      <td>  <button class="btn btn-secondary"><span class="far fa-file-pdf"></span></button></td>
      <td>  <button class="btn btn-success"><span class="fab fa-whatsapp"></span></button></td>
     <td>  <button class="btn btn-info"><i class="far fa-edit"></i></button></td>
    </tr>
  </thead>
  <tbody>
</table>
  </div>
  </div>
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
