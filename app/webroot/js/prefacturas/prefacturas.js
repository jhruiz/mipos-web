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
        },
        close: function( event, ui){
        },
        title: 'Seleccion de Producto'    
};

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
var dialogDialogSeleccionProducto;

function validarExisteCliente(){
    var cliente = $('#FacturaIdcliente').val();
    if(typeof(cliente) != 'undefined' && cliente != ""){
        $('#PrefacturaProducto').prop('disabled', false);
        $('#PrefacturaDatoscliente').val($('#PrefacturaNombrecliente').val());
        $('#PrefacturaNitcliente').val($('#PrefacturaNitcccliente').val());     //no me muestra el dato                                      
        $('#PrefacturaTelefonocliente').val($('#PrefacturaTelcliente').val());
        $('#PrefacturaDircliente').val($('#PrefacturaDireccliente').val());
        $('#PrefacturaDiascredcliente').val($('#PrefacturaDiascliente').val());
        $('#PrefacturaLimitecredcliente').val($('#PrefacturaLimitecliente').val());
    }else{
        $('#PrefacturaProducto').prop('disabled', true);
    }
}

function actualizarNitCliente(){
    var clienteId = $('#FacturaIdcliente').val();
    if(typeof(clienteId) != "undefined" && clienteId != ""){
        $.ajax({
                url: $('#url-proyecto').val() + 'clientes/ajaxActualizarNitCliente',
                data: {clienteId: clienteId, nit: $('#PrefacturaNitcliente').val()},
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
                data: {clienteId: clienteId, telefono: $('#PrefacturaTelefonocliente').val()},
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
                data: {clienteId: clienteId, direccion: $('#PrefacturaDircliente').val()},
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
                data: {clienteId: clienteId, diascredito: $('#PrefacturaDiascredcliente').val()},
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
                data: {clienteId: clienteId, limitecredito: $('#PrefacturaLimitecredcliente').val()},
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

function validarProductosPrefacturados(){
    var prefacId = $('#prefacturadoId').val();
    $.ajax({
        url: $('#url-proyecto').val() + 'prefacturasdetalles/obtenerPrefacturasDetalles',
        data: {prefacId: prefacId},
        type: "POST",
        success: function(data) {    
            var respuesta = JSON.parse(data);
            if(respuesta.resp){
                $.each(respuesta.detFact, function(idx, obj) {
                    var costoTotal = Number(obj['Prefacturasdetalle']['cantidad']) * Number(obj['Prefacturasdetalle']['costoventa']);
                    $('#productosPrefacturas').append('<tr id="tr_' + obj['Prefacturasdetalle']['id'] + '">' + 
                    '<td>' + obj['Cargueinventario']['descprod'] + '</td>' + 
                    '<td>' + obj['Cargueinventario']['codprod'] + '</td>' + 
                    '<td><input type="text" name="cant_' + obj['Prefacturasdetalle']['id'] + '" class="form-control" id="cant_' + obj['Prefacturasdetalle']['id'] + '" value="' + obj['Prefacturasdetalle']['cantidad'] + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                    '<td><input type="text" name="precio_' + obj['Prefacturasdetalle']['id'] + '" class="form-control" id="precio_' + obj['Prefacturasdetalle']['id'] + '" value="' + obj['Prefacturasdetalle']['costoventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                    '<td><input type="text" name="total_' + obj['Prefacturasdetalle']['id'] + '" class="form-control ttales" id="total_' + obj['Prefacturasdetalle']['id'] + '" value="' + costoTotal + '" readonly>&nbsp;</td>' +
                    '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + obj['Prefacturasdetalle']['id'] + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                });
                
            }
        }
    });      
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

function totalCrediContado(){
    var ttales = 0;
    $(".ttales").each(function() {
        ttales = Number(ttales) + Number($(this).val());
    });

    return ttales;
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

function fnObtenerDatosProducto(e){
    var usuarioId = $('#usuarioId').val();
    var clienteId = $('#FacturaIdcliente').val();
    
    
    var key = (document.all) ? e.keyCode : e.which;
    if(key == 13){       
        if(typeof(clienteId) != "undefined" && clienteId != ""){
            $.ajax({
               url: $('#url-proyecto').val() + 'prefacturas/addProductoBarCode',
               data: {usuarioId: usuarioId, descProducto: $('#PrefacturaProducto').val(), clienteId: clienteId},
               type: "POST",
               success: function(data) {
                    var prefactura = JSON.parse(data);
                    if(prefactura.valido){
                        $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                                '<td>' + prefactura.producto['0']['Producto']['descripcion'] + '</td>' + 
                                '<td>' + prefactura.producto['0']['Producto']['codigo'] + '</td>' + 
                                '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="1" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                                '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                                '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" readonly>&nbsp;</td>' +
                                '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                        $('#PrefacturaProducto').val("");
                        $('#datosProducto').hide();
                    }else{                        
                        $('#PrefacturaProducto').val("");
                        $('#datosProducto').hide();                    
                        bootbox.alert(prefactura.mensaje);
                    }                    
               }
           });                
        }else{
            bootbox.alert('Debe seleccionar un cliente.');
            $('#FacturaProducto').val("");                
        }
    }else if($('#PrefacturaProducto').val().length <= '0'){
        $('#datosProducto').hide();        
    }else{    
        if(typeof(clienteId) != "undefined" && clienteId != ""){
                $.ajax({
                url: $('#url-proyecto').val() + 'cargueinventarios/ajaxProductosVenta',
                data: {usuarioId: usuarioId, descProducto: $('#PrefacturaProducto').val()},
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
            $('#PrefacturaProducto').val("");
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
                $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + $('#nombreProducto').val() + '</td>' + 
                        '<td>' + $('#codigoProducto').val() + '</td>' + 
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="' + cantidadventa + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + precioventa + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + totalVenta + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                $('#PrefacturaProducto').val("");
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

function facturarProductos(){
    if(typeof($('.ttales').val()) == 'undefined'){
        bootbox.alert('Debe seleccionar al menos un producto.');
        
    }else{
        var tipoPago = $('#PrefacturaTipopago').val();
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

function submitForm(){
    var formData = new FormData($('#PrefacturaViewForm')[0]);    
    
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

var fnObtenerDatosCliente = function(){
    
    $('.nuevo').val("");
    $('.rapida').val("");

    var empresaId = $('#empresaId').val();
    $.ajax({
            url: $('#url-proyecto').val() + 'clientes/ajaxObtenerClientes',
            data: {datosCliente: $('#PrefacturaDatoscliente').val(), empresaId: empresaId},
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

function seleccionarCliente(datos){
    var clienteId = datos.name;

    $.ajax({
            url: $('#url-proyecto').val() + 'clientes/ajaxObtenerInfoCliente',
            data: {clienteId: clienteId},
            type: "POST",
            success: function(data) {               
                var cliente = JSON.parse(data);
                $('#PrefacturaDatoscliente').val(cliente.resp.Cliente.nombre);
                $('#PrefacturaNitcliente').val(cliente.resp.Cliente.nit);
                $('#PrefacturaTelefonocliente').val(cliente.resp.Cliente.telefono);
                $('#PrefacturaDircliente').val(cliente.resp.Cliente.direccion);
                $('#PrefacturaDiascredcliente').val(cliente.resp.Cliente.diascredito);
                $('#PrefacturaLimitecredcliente').val(cliente.resp.Cliente.limitecredito);
                $('#FacturaIdcliente').val(cliente.resp.Cliente.id);
                $('#datosCliente').hide();    
                $('#PrefacturaProducto').prop('disabled', false);
            }
        });    

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

function fnObtenerDatosProductoUsuarioNuevo(e){
    var usuarioId = $('#usuarioId').val();
    var prefacturaId = $('#prefacturadoId').val();
    var mensaje = "";
    
    var mensaje = "";
    var key = (document.all) ? e.keyCode : e.which;
    if(key == 13){      
        mensaje = validarDatosUsuarioNuevo();
        if(mensaje == ""){
            $.ajax({
               url: $('#url-proyecto').val() + 'prefacturas/addProductoClienteNuevoBarCode',
               data: {usuarioId: usuarioId, descProducto: $('#PrefacturaProductousuarionuevo').val(), prefacturaId: prefacturaId},
               type: "POST",
               success: function(data) {
                    var prefactura = JSON.parse(data);
                    if(prefactura.valido){
                        $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + prefactura.producto['0']['Producto']['descripcion'] + '</td>' + 
                        '<td>' + prefactura.producto['0']['Producto']['codigo'] + '</td>' +                                
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="1" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');                                                
                        $('#PrefacturaProductousuarionuevo').val("");                              
                        $('#datosProductoclientenuevo').hide(); 
                   }else{
                        $('#PrefacturaProductousuarionuevo').val("");                              
                        $('#datosProductoclientenuevo').hide();     
                        $('#PrefacturaProductoventarapida').val("");   
                        bootbox.alert(prefactura.mensaje);                        
                    }
               }
           });                
        }else{
            bootbox.alert(mensaje);
            $('#FacturaProducto').val("");                
        }
    }else{        
        mensaje = validarDatosUsuarioNuevo();
        if(mensaje != ""){
            bootbox.alert(mensaje);
            $('#PrefacturaProductousuarionuevo').val("");
        }else{        
                $.ajax({
                url: $('#url-proyecto').val() + 'cargueinventarios/ajaxProductosVenta',
                data: {usuarioId: usuarioId, descProducto: $('#PrefacturaProductousuarionuevo').val()},
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
    var nombre = $('#PrefacturaNuevonombre').val();
    var nit = $('#PrefacturaNuevonit').val();
    var direccion = $('#PrefacturaNuevodireccion').val();
    var diascredito = $('#PrefacturaNuevodiscredito').val();
    var limitecredito = $('#PrefacturaNuevolimitecredito').val();

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
               data: {usuarioId: usuarioId, descProducto: $('#PrefacturaProductoventarapida').val(), prefacturaId: null},
               type: "POST",
               success: function(data) {
                    var prefactura = JSON.parse(data);
                    if(prefactura.valido){
                        $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + prefactura.producto['0']['Producto']['descripcion'] + '</td>' + 
                        '<td>' + prefactura.producto['0']['Producto']['codigo'] + '</td>' +                                
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="1" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + prefactura.producto['0']['Cargueinventario']['precioventa'] + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');                                                
                        $('#PrefacturaProductoventarapida').val("");
                        $('#datosProductoventarapida').hide();                         
                   }else{
                        $('#PrefacturaProductousuarionuevo').val("");
                        $('#PrefacturaProductoventarapida').val("");
                        $('#datosProductoventarapida').hide(); 
                        bootbox.alert(prefactura.mensaje);                        
                    }
               }
           });                
        }else{
            bootbox.alert(mensaje);
            $('#FacturaProducto').val("");                
        }
    }else{     
        mensaje = validarDatosVentaRapida();
        if(mensaje != ""){
            bootbox.alert(mensaje);
            $('#PrefacturaProductoventarapida').val("");
        }else{        
                $.ajax({
                url: $('#url-proyecto').val() + 'cargueinventarios/ajaxProductosVenta',
                data: {usuarioId: usuarioId, descProducto: $('#PrefacturaProductoventarapida').val()},
                type: "POST",
                success: function(data) {
                    var producto = JSON.parse(data);
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
    var nombre = $('#PrefacturaRapidanombre').val();
    var nit = $('#PrefacturaRapidanit').val();

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
        $('#url-proyecto').val() + "cargueinventarios/seleccionproductoordencompra",
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

function agregarProductoOrdenCompra(){
    var cargueinventarioId = $('#cargueinventarioId').val();
    var cantidadventa = $('#cantidadventa').val();
    var precioventa = $('#precioventa').val();
    var prefacturaId = $('#prefacturadoId').val();
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
                $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + $('#nombreProducto').val() + '</td>' + 
                        '<td>' + $('#codigoProducto').val() + '</td>' + 
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="' + cantidadventa + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + precioventa + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + totalVenta + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                $('#PrefacturaProductousuarionuevo').val("");
                $('#PrefacturaProductoventarapida').val("");
                $('#prefacturadoId').val(prefactura.prefact);
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


function agregarProductoFacturaClienteNuevo(){
    var cargueinventarioId = $('#cargueinventarioId').val();
    var cantidadventa = $('#cantidadventa').val();
    var precioventa = $('#precioventa').val();
    var prefacturaId = $('#prefacturadoId').val();
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
                $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + $('#nombreProducto').val() + '</td>' + 
                        '<td>' + $('#codigoProducto').val() + '</td>' + 
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="' + cantidadventa + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + precioventa + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + totalVenta + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                $('#FacturaProductousuarionuevo').val("");
                $('#FacturaProductoventarapida').val("");
                $('#prefacturadoId').val(prefactura.prefact);
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

function agregarProductoFacturaClienteNuevo(){
    
    var cargueinventarioId = $('#cargueinventarioId').val();
    var cantidadventa = $('#cantidadventa').val();
    var precioventa = $('#precioventa').val();
    var prefacturaId = $('#prefacturadoId').val();
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
                $('#productosPrefacturas').append('<tr id="tr_' + prefactura.resp + '">' + 
                        '<td>' + $('#nombreProducto').val() + '</td>' + 
                        '<td>' + $('#codigoProducto').val() + '</td>' + 
                        '<td><input type="text" name="cant_' + prefactura.resp + '" class="form-control" id="cant_' + prefactura.resp + '" value="' + cantidadventa + '" onblur="actualizarCantidadPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="precio_' + prefactura.resp + '" class="form-control" id="precio_' + prefactura.resp + '" value="' + precioventa + '" onblur="actualizarPrecioPrefact(this);">&nbsp;</td>' +
                        '<td><input type="text" name="total_' + prefactura.resp + '" class="form-control ttales" id="total_' + prefactura.resp + '" value="' + totalVenta + '" readonly>&nbsp;</td>' +
                        '<td><input type="button" class="btn btn-primary" value="Eliminar" id="' + prefactura.resp + '"onclick="eliminarProductoPrefactura(this)"></td></tr>');
                $('#PrefacturaProductousuarionuevo').val("");
                $('#PrefacturaProductoventarapida').val("");
                $('#prefacturadoId').val(prefactura.prefact);
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

function activarFiltroProductoClienteNuevo(){
    var cliente = $('#PrefacturaNuevonombre').val();
    var nit = $('#PrefacturaNuevonit').val();
    var dir = $('#PrefacturaNuevodireccion').val();
    var diasCred = $('#PrefacturaNuevodiscredito').val();
    var limCred = $('#PrefacturaNuevolimitecredito').val();
    
    if(cliente.length == '0' || nit.length == '0' || dir.length == '0' || diasCred.length == '0' || limCred.length == '0'){
        $('#PrefacturaProductousuarionuevo').prop('disabled', true);
    }else{
        $('#PrefacturaProductousuarionuevo').prop('disabled', false);
    }
}

function activarFiltroProductoVentaRapida(){
    var nombre = $('#PrefacturaRapidanombre').val();
    var nit = $('#PrefacturaRapidanit').val();
    if(nombre.length == '0' || nit.length == '0'){
        $('#PrefacturaProductoventarapida').prop('disabled', true);
    }else{
        $('#PrefacturaProductoventarapida').prop('disabled', false);
    }    
}


$( function() {
    validarExisteCliente();
    validarProductosPrefacturados();      
    $('#PrefacturaDatoscliente').keyup(fnObtenerDatosCliente);   
    $('#PrefacturaProductousuarionuevo').prop('disabled', true); //keyup(fnObtenerDatosProductoUsuarioNuevo);
    $('#PrefacturaProductoventarapida').prop('disabled', true); //keyup(fnObtenerDatosProductoVentaRapida);    
});


