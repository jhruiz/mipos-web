var opcDialogSeleccionProducto = {
        autoOpen: false,
        modal: true,
        width: 750,
        height: 680,
        position: [400, 50],
        show: {
            duration: 400    
        },
        hide: function () {
//            alert($(this).dialog());
//            $(this).dialog('destroy').remove();
        },
        close: function( event, ui){
//            $(this).dialog('destroy').remove();            
        },
        title: 'Seleccion de Producto'    
};

var dialogDialogSeleccionProducto;

var opcCrediContado = {
        autoOpen: false,
        modal: true,
        width: 500,
        height: 450,
        position: [400, 50],
        show: {
            duration: 400    
        },
        hide: function () {
//            alert($(this).dialog());
//            $(this).dialog('destroy').remove();
        },
        close: function( event, ui){
//            $(this).dialog('destroy').remove();            
        },
        title: 'Pago Credi - Contado'    
};

var dialogCrediContado;

var fnObtenerDatosCliente = function(){
    
    activarFiltroProducto();
    $('.nuevo').val("");
    $('.rapida').val("");
    
    var empresaId = $('#empresaId').val();
    $.ajax({
            url: $('#url-proyecto').val() + 'clientes/ajaxObtenerClientes',
            data: {datosCliente: $('#FacturaDatoscliente').val(), empresaId: empresaId},
            type: "POST",
            success: function(data) {
                
                var cliente = JSON.parse(data);
                var uls = "";
                for(var i = 0; i < cliente.resp.length; i++){
                    uls += "<a href='#' class='list-group-item list-group-item-info' name='" + cliente.resp[i].Cliente.id + "' onClick ='seleccionarCliente(this)'>" + cliente.resp[i].Cliente.nombre + " - " + cliente.resp[i].Cliente.nit + "</a>";
                }
                $('#datosCliente').show();
                $('#datosCliente').html(uls);
            }
        });    
};

function activarFiltroProducto(){
    var cliente = $('#FacturaDatoscliente').val();
    if(cliente.length <= '0'){
        $('#FacturaProducto').prop('disabled', true);
    }else{
        $('#FacturaProducto').prop('disabled', false);
    }
}

function activarFiltroProductoClienteNuevo(){
    var cliente = $('#FacturaNuevonombre').val();
    var nit = $('#FacturaNuevonit').val();
    var dir = $('#FacturaNuevodireccion').val();
    var diasCred = $('#FacturaNuevodiscredito').val();
    var limCred = $('#FacturaNuevolimitecredito').val();
    
    if(cliente.length == '0' || nit.length == '0' || dir.length == '0' || diasCred.length == '0' || limCred.length == '0'){
        $('#FacturaProductousuarionuevo').prop('disabled', true);
    }else{
        $('#FacturaProductousuarionuevo').prop('disabled', false);
    }
}

function activarFiltroProductoVentaRapida(){
    var nombre = $('#FacturaRapidanombre').val();
    var nit = $('#FacturaRapidanit').val();
    
    if(nombre.length == '0' || nit.length == '0'){
        $('#FacturaProductoventarapida').prop('disabled', true);
    }else{
        $('#FacturaProductoventarapida').prop('disabled', false);
    }    
}

function seleccionarCliente(datos){
    var clienteId = datos.name;

    $.ajax({
            url: $('#url-proyecto').val() + 'clientes/ajaxObtenerInfoCliente',
            data: {clienteId: clienteId},
            type: "POST",
            success: function(data) {               
                var cliente = JSON.parse(data);
                $('#FacturaDatoscliente').val(cliente.resp.Cliente.nombre);
                $('#FacturaNitcliente').val(cliente.resp.Cliente.nit);
                $('#FacturaTelefonocliente').val(cliente.resp.Cliente.telefono);
                $('#FacturaDircliente').val(cliente.resp.Cliente.direccion);
                $('#FacturaDiascredcliente').val(cliente.resp.Cliente.diascredito);
                $('#FacturaLimitecredcliente').val(cliente.resp.Cliente.limitecredito);
                $('#FacturaIdcliente').val(cliente.resp.Cliente.id);
                $('#datosCliente').hide();
                activarFiltroProducto();
            }
        });    

}

function actualizarNitCliente(){
    var clienteId = $('#FacturaIdcliente').val();
    if(typeof(clienteId) != "undefined" && clienteId != ""){
        $.ajax({
                url: $('#url-proyecto').val() + 'clientes/ajaxActualizarNitCliente',
                data: {clienteId: clienteId, nit: $('#FacturaNitcliente').val()},
                type: "POST",
                success: function(data) {               
                    var respuesta = JSON.parse(data);
                    bootbox.alert(respuesta.resp);
                }
            });        
    }else{
        bootbox.alert('Debe seleccionar un cliente.');
    }
}

function actualizarTelefonoCliente(){
    var clienteId = $('#FacturaIdcliente').val();
    if(typeof(clienteId) != "undefined" && clienteId != ""){
        $.ajax({
                url: $('#url-proyecto').val() + 'clientes/ajaxActualizarTelCliente',
                data: {clienteId: clienteId, telefono: $('#FacturaTelefonocliente').val()},
                type: "POST",
                success: function(data) {               
                    var respuesta = JSON.parse(data);
                    bootbox.alert(respuesta.resp);
                }
            });        
    }else{
        bootbox.alert('Debe seleccionar un cliente.');
    }    
}

function actualizarDireccionCliente(){
    var clienteId = $('#FacturaIdcliente').val();
    if(typeof(clienteId) != "undefined" && clienteId != ""){
        $.ajax({
                url: $('#url-proyecto').val() + 'clientes/ajaxActualizarDirCliente',
                data: {clienteId: clienteId, direccion: $('#FacturaDircliente').val()},
                type: "POST",
                success: function(data) {               
                    var respuesta = JSON.parse(data);
                    bootbox.alert(respuesta.resp);
                }
            });        
    }else{
        bootbox.alert('Debe seleccionar un cliente.');
    }    
}

function actualizarDiasLimite(){
    var clienteId = $('#FacturaIdcliente').val();
    if(typeof(clienteId) != "undefined" && clienteId != ""){
        $.ajax({
                url: $('#url-proyecto').val() + 'clientes/ajaxActualizarDiasCliente',
                data: {clienteId: clienteId, diascredito: $('#FacturaDiascredcliente').val()},
                type: "POST",
                success: function(data) {               
                    var respuesta = JSON.parse(data);
                    bootbox.alert(respuesta.resp);
                }
            });        
    }else{
        bootbox.alert('Debe seleccionar un cliente.');
    }    
}

function actualizarCreditoLimite(){
    var clienteId = $('#FacturaIdcliente').val();
    if(typeof(clienteId) != "undefined" && clienteId != ""){
        $.ajax({
                url: $('#url-proyecto').val() + 'clientes/ajaxActualizarCredCliente',
                data: {clienteId: clienteId, limitecredito: $('#FacturaLimitecredcliente').val()},
                type: "POST",
                success: function(data) {               
                    var respuesta = JSON.parse(data);
                    bootbox.alert(respuesta.resp);
                }
            });        
    }else{
        bootbox.alert('Debe seleccionar un cliente.');
    }    
}

function fnObtenerDatosProducto(e){  
    var usuarioId = $('#usuarioId').val();
    var clienteId = $('#FacturaIdcliente').val();
    var key = (document.all) ? e.keyCode : e.which;
    if(key == 13){        
        if(typeof(clienteId) != "undefined" && clienteId != ""){
            $.ajax({
               url: $('#url-proyecto').val() + 'prefacturas/addProductoBarCode',
               data: {usuarioId: usuarioId, descProducto: $('#FacturaProducto').val(), clienteId: clienteId},
               type: "POST",
               success: function(data) {
                    var prefactura = JSON.parse(data);
                    if(prefactura.valido){
                        $('#productosFacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                                '<td>' + prefactura.producto['0']['Producto']['descripcion'] + '</td>' + 
                                '<td>' + prefactura.producto['0']['Producto']['codigo'] + '</td>' + 
                                '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="1" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                                '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control numericPrice" id="precio_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                                '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales numericPrice" id="total_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" readonly>&nbsp;</td>' +
                                '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                        $('#FacturaProducto').val("");
                        $('#datosProducto').hide();
                        $('.numericPrice').number(true);
                    }else{                        
                        $('#FacturaProducto').val("");
                        $('#datosProducto').hide();                        
                        bootbox.alert(prefactura.mensaje);
                    }                    
               }
           });                
        }else{
            bootbox.alert('Debe seleccionar un cliente.');
            $('#FacturaProducto').val("");                
        }
    }else if($('#FacturaProducto').val().length <= '0'){
        $('#datosProducto').hide();        
    }else{
        if(typeof(clienteId) != "undefined" && clienteId != ""){  
            $.ajax({
                url: $('#url-proyecto').val() + 'cargueinventarios/ajaxProductosVenta',
                data: {usuarioId: usuarioId, descProducto: $('#FacturaProducto').val()},
                type: "POST",
                success: function(data) {
                    var producto = JSON.parse(data);
                    
                    var uls = "";
                    for(var i = 0; i < producto.resp.length; i++){
                        uls += "<a href='#' class='list-group-item list-group-item-info' name='" + producto.resp[i].Producto.id + "' onClick ='seleccionarProducto(this)'>" + producto.resp[i].Producto.descripcion + " - " + producto.resp[i].Producto.codigo + "</a>";
                    }
                    $('#datosProducto').show();
                    $('#datosProducto').html(uls);
                }
            }); 
        }else{
            bootbox.alert('Debe seleccionar un cliente.');
            $('#FacturaProducto').val("");                
        }      
    }         
}


function seleccionarProducto(dato){
    var productoId = dato.name;  
    
    
    $("#div_producto").load(
            $('#url-proyecto').val() + "cargueinventarios/seleccionproductoventa",
            {
                productoId: productoId
            },
            function(){                                                            
                dialogDialogSeleccionProducto=$("#div_producto").dialog(opcDialogSeleccionProducto);
                dialogDialogSeleccionProducto.dialog('open');
                $('#datosProducto').hide();
            }
        );     
}

function validarCantidadStock(){   
    var cantidadActual = $('#cantidadProducto').val();
    var cantidadVenta = $('#cantidadventa').val();
    if(Number(cantidadVenta) > Number(cantidadActual)){
        $('#cantidadventa').val("");
        bootbox.alert('Ha excedido la cantidad actual del Stock');        
    }
}

function validarPrecioMinimo(){
    var precioventa = $('#precioventa').val();
    var precioMinimo = $('#precioMinimo').val();
    
    if(Number(precioventa) < Number(precioMinimo)){
        $('#precioventa').val($('#precioVenta').val());
        bootbox.alert('El precio de venta no puede ser menor al mínimo establecido.');
    }
}

function agregarProductoFactura(){
    var usuarioId = $('#usuarioId').val();
    var clienteId = $('#FacturaIdcliente').val();
    var cargueinventarioId = $('#cargueinventarioId').val();
    var cantidadventa = $('#cantidadventa').val();
    var precioventa = $('#precioventa').val();
    var totalVenta = (Number(cantidadventa) * Number(precioventa));
    var mensaje = "";    
    
    mensaje = validarDatosFactura(cantidadventa,precioventa);
    if(mensaje == ""){
        $.ajax({
        url: $('#url-proyecto').val() + 'prefacturas/add',
        data: {usuarioId: usuarioId, clienteId: clienteId, cargueinventarioId: cargueinventarioId, cantidadventa: cantidadventa, precioventa: precioventa},
        type: "POST",
        success: function(data) {
            var prefactura = JSON.parse(data);
            if(prefactura.resp != '0' && prefactura.resp != ""){
                $('#productosFacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + $('#nombreProducto').val() + '</td>' + 
                        '<td>' + $('#codigoProducto').val() + '</td>' + 
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="' + cantidadventa + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control numericPrice" id="precio_' + prefactura.resp + '" value="' + precioventa + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales numericPrice" id="total_' + prefactura.resp + '" value="' + totalVenta + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                $('#FacturaProducto').val("");
                $('.numericPrice').number(true);
                dialogDialogSeleccionProducto.dialog('close');
            }else{
                bootbox.alert('No se pudo agregar el producto a la factura de venta. Por favor, inténtelo de nuevo.');
            }
        }
        });         
    }else{
        bootbox.alert(mensaje);
    }
}

function validarDatosFactura(cantidadventa,precioventa){
    var mensaje = "";
    if(typeof(cantidadventa) == 'undefined' || cantidadventa == ""){
        mensaje = "- Debe ingresar una cantidad de productos.<br>";
    }
    
    if(typeof(precioventa) == 'undefined' || precioventa == ""){
        mensaje += "- Debe ingresar un precio de venta para el producto.";
    }
    
    return mensaje;
}


/*funciones de la tabla prefactura*/
function actualizarCantidadPrefact(dato){  
    var arrName = dato.name.split('_');
    var cantidad = $('#' + dato.name).val();
    if(typeof(cantidad) == "undefined" || cantidad == ""){
        bootbox.alert('- Debe ingresar una cantidad de productos.');
    }else{
        $.ajax({
            url: $('#url-proyecto').val() + 'prefacturasdetalles/actalizarcantidad',
            data: {cantidad: cantidad, id: arrName['1']},
            type: "POST",
            success: function(data) { 
                var respuesta = JSON.parse(data);
                if(respuesta.resp){
                    var total = Number(cantidad) * Number($('#precio_' + arrName['1']).val());
                    $('#total_' + arrName['1']).val(total);
                    totalCrediContado();
                }else{
                    bootbox.alert('Ha excedido la cantidad actual del Stock. ' + respuesta.cantStock); 
                    $('#' + dato.name).val(respuesta.cantidad);
                }
            }            
        });         
    }
}

function actualizarPrecioPrefact(dato){
    var arrName = dato.name.split('_');
    var precioventa = $('#' + dato.name).val();    
    if(typeof(precioventa) == 'undefined' || precioventa == ""){
        bootbox.alert('- Debe ingresar el precio de venta del producto.');
    }else{
        $.ajax({
            url: $('#url-proyecto').val() + 'prefacturasdetalles/actualizarcostoventa',
            data: {precioventa: precioventa, id: arrName['1']},
            type: "POST",
            success: function(data) { 
                var respuesta = JSON.parse(data);
                if(respuesta.resp){
                    var total = Number(precioventa) * Number($('#cant_' + arrName['1']).val());
                    $('#total_' + arrName['1']).val(total);
                    totalCrediContado();
                }else{
                    $('#' + dato.name).val(respuesta.precioventa);
                    bootbox.alert('El precio de venta no puede ser menor al mínimo establecido.');
                }
            }
        });        
    }
}

function eliminarProductoPrefactura(dato){
        $.ajax({
            url: $('#url-proyecto').val() + 'prefacturasdetalles/delete',
            data: {detalleId: dato.id},
            type: "POST",
            success: function(data) { 
                var respuesta = JSON.parse(data);
                if(respuesta.resp){
                    $('#tr_' + dato.id).remove();
                    totalCrediContado();
                }else{
                    bootbox.alert('No se pudo eliminar el producto. Por favor, inténtelo de nuevo.');
                }
            }
        });         
}

function facturarProductos(){
    if(typeof($('.ttales').val()) == 'undefined'){
        bootbox.alert('Debe seleccionar al menos un producto.');
        
    }else{
        var tipoPago = $('#FacturaTipopago').val();
        //funcion detallar el pago entre credito y contado
        if(tipoPago == '5'){
            var valorCompra = totalCrediContado();
            $("#div_facturar").load(
                $('#url-proyecto').val() + "facturas/pagofactura",
                {valorCompra: valorCompra},
                function(){                                                            
                    dialogCrediContado=$("#div_facturar").dialog(opcCrediContado);
                    dialogCrediContado.dialog('open');
                }
            );        
        }else if(tipoPago == '4'){
            var credito = totalCrediContado();
            $('#pagocredito').val(credito);
            $('#pagocontado').val('0');
            submitForm();
        }else if(tipoPago == '2'){
            var contado = totalCrediContado();
            $('#pagocontado').val(contado);
            $('#pagocredito').val('0');
            submitForm();
        }        
    }
        
}

function totalCrediContado(){
    var ttales = 0;
    $(".ttales").each(function() {
        ttales = Number(ttales) + Number($(this).val());
    });

    return ttales;
}

function calcularPagoContado(){
    var contado = $('#pagoContado').val();    
    var totalFacturar = $('#totalVenta').val();
    
    if(Number(contado) > Number(totalFacturar)){
        bootbox.alert('El valor que se paga de contado no puede ser mayor al valor total de la factura.');
    }else{
        var result = Number(totalFacturar) - Number(contado);
        $('#pagoCredito').val(result);
        
        $('#pagocredito').val(result);        
        $('#pagocontado').val(contado);        
    }        
}

function calcularPagoCredito(){    
    var credito = $('#pagoCredito').val();
    var totalFacturar = $('#totalVenta').val();
    
    if(Number(credito) > Number(totalFacturar)){
        bootbox.alert('El valor que se paga a crédito no puede ser mayor al valor total de la factura.');
    }else{
        var result = Number(totalFacturar) - Number(credito);
        $('#pagoContado').val(result);  
        $('#pagocredito').val(credito);        
        $('#pagocontado').val(result);          
    }
}

function validarCrediContado(){

    var mensaje = "";
    mensaje = validarDatosContadoCredito();
    
    if(mensaje != ""){
        bootbox.alert(mensaje);
    }else{
        submitForm();
    }
}

function validarDatosContadoCredito(){
    var credito = $('#pagocredito').val();        
    var contado = $('#pagocontado').val(); 
    var mensaje = "";
    if(credito == "" || credito == "0"){
        mensaje = '- Debe ingresar el valor a pagar a crédito. <br>';
    }    
    
    if(contado == "" || contado == "0"){
        mensaje += '- Debe ingresar el valor a pagar de contado.';
    }
    return mensaje;
}


function submitForm(){

    var formData = new FormData($('#FacturaAddForm')[0]);    
    
    $.ajax({
        url: $('#url-proyecto').val() + 'facturas/facturarProductos',
        type: 'POST',        
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            var respuesta = JSON.parse(data);
            window.location.href = $('#url-proyecto').val() + 'facturas/view/' + respuesta.resp;
        }
    });    
}

function fnObtenerDatosProductoUsuarioNuevo(e){
    var usuarioId = $('#usuarioId').val();
    var prefacturaId = $('#prefacturaId').val();    
    
    var mensaje = "";
    var key = (document.all) ? e.keyCode : e.which;
    if(key == 13){      
        mensaje = validarDatosUsuarioNuevo();
        if(mensaje == ""){
            $.ajax({
               url: $('#url-proyecto').val() + 'prefacturas/addProductoClienteNuevoBarCode',
               data: {usuarioId: usuarioId, descProducto: $('#FacturaProductousuarionuevo').val(), prefacturaId: prefacturaId},
               type: "POST",
               success: function(data) {
                    var prefactura = JSON.parse(data);
                    if(prefactura.valido){
                        $('#productosFacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + prefactura.producto['0']['Producto']['descripcion'] + '</td>' + 
                        '<td>' + prefactura.producto['0']['Producto']['codigo'] + '</td>' +                                
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="1" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control numericPrice" id="precio_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales numericPrice" id="total_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');                                                
                        $('#FacturaProductousuarionuevo').val("");
                        $('#datosProductoclientenuevo').hide(); 
                        $('#prefacturaId').val(prefactura.prefact); 
                        $('.numericPrice').number(true);
                   }else{
                        $('#FacturaProductousuarionuevo').val("");
                        $('#FacturaProductoventarapida').val("");                                            
                        bootbox.alert(prefactura.mensaje);                        
                    }
               }
           });                
        }else{
            bootbox.alert(mensaje);
            $('#FacturaProducto').val("");                
        }
    }else if($('#FacturaProductousuarionuevo').val().length <= '0'){
        $('#datosProductoclientenuevo').hide();         
    }else{   
        mensaje = validarDatosUsuarioNuevo();
        if(mensaje != ""){
            bootbox.alert(mensaje);
            $('#FacturaProductousuarionuevo').val("");
        }else{        
                $.ajax({
                url: $('#url-proyecto').val() + 'cargueinventarios/ajaxProductosVenta',
                data: {usuarioId: usuarioId, descProducto: $('#FacturaProductousuarionuevo').val()},
                type: "POST",
                success: function(data) {
                    var producto = JSON.parse(data);
                    var uls = "";
                    for(var i = 0; i < producto.resp.length; i++){
                        uls += "<a href='#' class='list-group-item list-group-item-info' name='" + producto.resp[i].Producto.id + "' onClick ='seleccionarProductoClienteNuevo(this)'>" + producto.resp[i].Producto.descripcion + " - " + producto.resp[i].Producto.codigo + "</a>";
                    }
                    $('#datosProductoclientenuevo').show();
                    $('#datosProductoclientenuevo').html(uls);
                }
            });         
        }
    }
}

function validarDatosUsuarioNuevo(){
    var mensaje = "";
    /*se obtienen los campos del formulario del cliente*/
    var nombre = $('#FacturaNuevonombre').val();
    var nit = $('#FacturaNuevonit').val();
    var direccion = $('#FacturaNuevodireccion').val();
    var diascredito = $('#FacturaNuevodiscredito').val();
    var limitecredito = $('#FacturaNuevolimitecredito').val();

    if(typeof(nombre) == "undefined" || nombre == ''){
        mensaje += "- Debe ingresar el nombre del cliente.<br>";
    }
    
    if(typeof(nit) == "undefined" || nit == ''){
        mensaje += "- Debe ingresar el Nit/C.C del cliente.<br>";
    }
    
    if(typeof(direccion) == "undefined" || direccion == ''){
        mensaje += "- Debe ingresar la dirección del cliente.<br>";
    }
    
    if(typeof(diascredito) == "undefined" || diascredito == ''){
        mensaje += "- Debe ingresar los días de crédito para el cliente.<br>";
    }
    
    if(typeof(limitecredito) == "undefined" || limitecredito == ''){
        mensaje += "- Debe ingresar el límite de crédito para el cliente.<br>";
    }
    
    return mensaje;
}

function fnObtenerDatosProductoVentaRapida(e){ 
    var usuarioId = $('#usuarioId').val();       
    var mensaje = "";

    var key = (document.all) ? e.keyCode : e.which;
    if(key == 13){      
        mensaje = validarDatosVentaRapida();
        if(mensaje == ""){
            $.ajax({
               url: $('#url-proyecto').val() + 'prefacturas/addProductoClienteNuevoBarCode',
               data: {usuarioId: usuarioId, descProducto: $('#FacturaProductoventarapida').val(), prefacturaId: null},
               type: "POST",
               success: function(data) {
                    var prefactura = JSON.parse(data);
                    if(prefactura.valido){
                        $('#productosFacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + prefactura.producto['0']['Producto']['descripcion'] + '</td>' + 
                        '<td>' + prefactura.producto['0']['Producto']['codigo'] + '</td>' +                                
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="1" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control numericPrice" id="precio_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales numericPrice" id="total_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');                                                
                        $('#FacturaProductoventarapida').val("");
                        $('#datosProductoventarapida').hide(); 
                        $('#prefacturaId').val(prefactura.prefact); 
                        $('.numericPrice').number(true);
                   }else{
                        $('#FacturaProductousuarionuevo').val("");
                        $('#FacturaProductoventarapida').val("");
                        $('#datosProductoventarapida').hide(); 
                        bootbox.alert(prefactura.mensaje);                        
                    }
               }
           });                
        }else{
            bootbox.alert(mensaje);
            $('#FacturaProducto').val("");                
        }
    }else if($('#FacturaProductoventarapida').val().length <= '0'){
        $('#datosProductoventarapida').hide();        
    }else{ 
        mensaje = validarDatosVentaRapida();
        if(mensaje != ""){
            bootbox.alert(mensaje);
            $('#FacturaProductoventarapida').val("");
        }else{        
                $.ajax({
                url: $('#url-proyecto').val() + 'cargueinventarios/ajaxProductosVenta',
                data: {usuarioId: usuarioId, descProducto: $('#FacturaProductoventarapida').val()},
                type: "POST",
                success: function(data) {
                    var producto = JSON.parse(data);
                    console.log(producto);
                    var uls = "";
                    for(var i = 0; i < producto.resp.length; i++){
                        uls += "<a href='#' class='list-group-item list-group-item-info' name='" + producto.resp[i].Producto.id + "' onClick ='seleccionarProductoVentaRapida(this)'>" + producto.resp[i].Producto.descripcion + " - " + producto.resp[i].Producto.codigo + "</a>";
                    }
                    $('#datosProductoventarapida').show();
                    $('#datosProductoventarapida').html(uls);
                }
            });         
        }                
    }    
}

function validarDatosVentaRapida(){
    var mensaje = "";
    /*se obtienen los campos del formulario del cliente*/
    var nombre = $('#FacturaRapidanombre').val();
    var nit = $('#FacturaRapidanit').val();

    if(typeof(nombre) == "undefined" || nombre == ''){
        mensaje += "- Debe ingresar el nombre del cliente.<br>";
    }    
    
    if(typeof(nit) == "undefined" || nit == ''){
        mensaje += "- Debe ingresar el Nit/C.C del cliente.<br>";
    }        
    
    return mensaje;
}

function seleccionarProductoClienteNuevo(dato){
    var productoId = dato.name;  
    
    $("#div_producto").load(
        $('#url-proyecto').val() + "cargueinventarios/seleccionproductoventaclientenuevo",
        {
            productoId: productoId
        },
        function(){                                                            
            dialogDialogSeleccionProducto=$("#div_producto").dialog(opcDialogSeleccionProducto);
            dialogDialogSeleccionProducto.dialog('open');
            $('#datosProductoclientenuevo').hide();
        }
    );     
}


function agregarProductoFacturaClienteNuevo(){
    var cargueinventarioId = $('#cargueinventarioId').val();
    var cantidadventa = $('#cantidadventa').val();
    var precioventa = $('#precioventa').val();
    var prefacturaId = $('#prefacturaId').val();
    var usuarioId = $('#usuarioId').val();
    var totalVenta = (Number(cantidadventa) * Number(precioventa));
    var mensaje = "";    

    mensaje = validarDatosFactura(cantidadventa,precioventa);

    if(mensaje == ""){
        $.ajax({
        url: $('#url-proyecto').val() + 'facturas/facturacionclientenuevo',
        data: {prefacturaId: prefacturaId, cargueinventarioId: cargueinventarioId, cantidadventa: cantidadventa, precioventa: precioventa, usuarioId:usuarioId},
        type: "POST",
        success: function(data) {
            var prefactura = JSON.parse(data);
            if(prefactura.resp != '0' && prefactura.resp != ""){
                $('#productosFacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + $('#nombreProducto').val() + '</td>' + 
                        '<td>' + $('#codigoProducto').val() + '</td>' + 
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="' + cantidadventa + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control numericPrice" id="precio_' + prefactura.resp + '" value="' + precioventa + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales numericPrice" id="total_' + prefactura.resp + '" value="' + totalVenta + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                $('#FacturaProductousuarionuevo').val("");
                $('#FacturaProductoventarapida').val("");
                $('#prefacturaId').val(prefactura.prefact);
                $('.numericPrice').number(true);
                dialogDialogSeleccionProducto.dialog('close');
            }else{
                bootbox.alert('No se pudo agregar el producto a la factura de venta. Por favor, inténtelo de nuevo.');
            }
        }
        });         
    }else{
        bootbox.alert(mensaje);
    }
}

function limpirarFormularios(){
    activarFiltroProductoClienteNuevo();
    $('.registrado').val("");
    $('.rapida').val("");
    
}

function limpirarFormulariosRegistrados(){
    activarFiltroProductoVentaRapida();
    $('.registrado').val("");
    $('.nuevo').val("");   
}

function seleccionarProductoVentaRapida(dato){
    var productoId = dato.name;  
    
    $("#div_producto").load(
        $('#url-proyecto').val() + "cargueinventarios/seleccionproductoventaclientenuevo",
        {
            productoId: productoId
        },
        function(){                                                            
            dialogDialogSeleccionProducto=$("#div_producto").dialog(opcDialogSeleccionProducto);
            dialogDialogSeleccionProducto.dialog('open');
            $('#datosProductoventarapida').hide();
        }
    );    
}

$( function() {
    $('#FacturaDatoscliente').keyup(fnObtenerDatosCliente);    
    $('#FacturaProducto').prop('disabled', true);
    $('#FacturaProductousuarionuevo').prop('disabled', true);
    //$('#FacturaProductoventarapida').prop('disabled', true);
    $('#FacturaLimitecredcliente').number(true);
    $('#FacturaNuevolimitecredito').number(true);
    $('.numberPrice').number(true);
});