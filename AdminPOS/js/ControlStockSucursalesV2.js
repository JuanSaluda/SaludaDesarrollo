function StockPorSucursales() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/StockSucursalesV2.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();