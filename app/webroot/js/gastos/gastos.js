function validarEstadoCuenta(){
    var montoGasto = $('#GastoValor').val();
    if(montoGasto == "" || typeof(montoGasto) == "undefined"){
        bootbox.alert('Debe ingresar un monto para el gasto');
        $('#GastoCuentaId').val("");
    }else{
        var cuentaId = $('#GastoCuentaId').val();
        $.ajax({
            url: $('#url-proyecto').val() + 'cuentas/ajaxvalidarmontocuenta',
            data: {montoGasto: montoGasto, cuentaId: cuentaId},
            type: "POST",
            success: function(data) {    
                var respuesta = JSON.parse(data);
                if(!respuesta.resp){
                    bootbox.alert('No hay suficiente saldo en la cuenta para descontar el gasto.');
                    $('#GastoCuentaId').val("");
                }
            }
        }); 
    }
}

function restaurarCuenta(){    
    $('#GastoCuentaId').val("");
}

$( function() {
    $('.numberPrice').number(true);
});

