<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Personal_Medico.file_name,Personal_Medico.Fk_Usuario,Personal_Medico.Fk_Sucursal,Personal_Medico.Telefono,
Personal_Medico.ID_H_O_D,Personal_Medico.Estatus,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,Personal_Medico.Biometrico
FROM Personal_Medico,SucursalesCorre,Roles_Puestos where Personal_Medico.Fk_Usuario = Roles_Puestos.ID_rol AND 
Personal_Medico.Fk_Sucursal= SucursalesCorre.ID_SucursalC  AND Personal_Medico.Medico_ID= ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<? if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="ReactivaEmpleados" >
 
    <p>¿Esta seguro que desea reactivar al usuario <br>
    <?php echo $Especialistas->Nombre_Apellidos; ?> ?</p>

    <input type="text"  hidden class="form-control " value="Vigente"  readonly name="VigenciaA" id="vigenciaesta">
    <input type="text"  hidden class="form-control " value="background-color:#FE0000 !important;"  readonly name="ColorVigenciaA" id="colorvigenciaa">
<input type="hidden" name="idbajaa" id="idbajaa" value="<?php echo $Especialistas->Medico_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-primary">Confirmar reactivación <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ReactivaMedicos.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
