function CargaCitasEnSucursal(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
