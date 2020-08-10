<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('bandeja/gestionBandejas.js'));  ?>
<?php echo ($this->Html->script('prefacturas/prefacturas.js')); ?>

<?php echo $this->Form->create('Prefactura'); ?>

<fieldset>
<legend><h2 class="bg-primary"><b><?php echo __('Orden de Compra'); ?></b></h2></legend>
<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '30', 'id' => 'menuvert'))?>
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#registrado" aria-controls="registrado" data-toggle="tab" role="tab">Cliente Registrado</a></li>
                    <li role="presentation"><a href="#nuevo" aria-controls="nuevo" data-toggle="tab" role="tab">Cliente Nuevo</a></li>
                    <li role="presentation"><a href="#ventarapida" aria-controls="ventarapida" data-toggle="tab" role="tab">Venta Rápida</a></li>                        
                </ul>
            </div>
            
            <div class="tab-content">
                <!--Inicia el div para facturar productos a los usuarios registrados en la aplicacion-->
                <div role="tabpanel" class="tab-pane active" id="registrado">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if(isset($prefactura['Cliente']['id']) && $prefactura['Cliente']['id'] != ""){?>
                                    <?php echo $this->Form->input('idcliente', array('type' => 'hidden', 'name' => 'data[Factura][idcliente]', 'id' => 'FacturaIdcliente', 'value' => $prefactura['Cliente']['id']));?>
                                    <?php echo $this->Form->input('nombrecliente', array('type' => 'hidden', 'value' => $prefactura['Cliente']['nombre']));?>
                                    <?php echo $this->Form->input('direccliente', array('type' => 'hidden', 'value' => $prefactura['Cliente']['direccion']));?>
                                    <?php echo $this->Form->input('nitcccliente', array('type' => 'hidden', 'value' => $prefactura['Cliente']['nit']));?>
                                    <?php echo $this->Form->input('diascliente', array('type' => 'hidden', 'value' => $prefactura['Cliente']['diascredito']));?>
                                    <?php echo $this->Form->input('telcliente', array('type' => 'hidden', 'value' => $prefactura['Cliente']['telefono']));?>
                                    <?php echo $this->Form->input('limitecliente', array('type' => 'hidden', 'value' => $prefactura['Cliente']['limitecredito']));?>
                                
                                <?php }else{?>
                                <?php echo $this->Form->input('idcliente', array('type' => 'hidden', 'name' => 'data[Factura][idcliente]', 'id' => 'FacturaIdcliente'));?>
                                <?php }?>
                                <?php echo $this->Form->input('empresa', array('type' => 'hidden', 'name' => 'data[Factura][empresa]', 'value' => $empresaId, 'id' => 'empresaId'));?>                                
                                <?php echo $this->Form->input('usuario', array('type' => 'hidden', 'name' => 'data[Factura][usuario]', 'value' => $usuarioId, 'id' => 'usuarioId'));?>
                                <?php echo $this->Form->input('pagocredito', array('type' => 'hidden', 'name' => 'data[Factura][pagocredito]', 'value' => '0', 'id' => 'pagocredito'));?>
                                <?php echo $this->Form->input('pagocontado', array('type' => 'hidden', 'name' => 'data[Factura][pagocontado]', 'value' => '0', 'id' => 'pagocontado'));?>
                                <?php echo $this->Form->input('prefacturado', array('type' => 'hidden', 'name' => 'data[Factura][prefacturado]', 'value' => $prefactura['Prefactura']['id'], 'id' => 'prefacturadoId'));?>

                                <div class="form-group ">  
                                    <label>Cliente</label><br>                                
                                        <?php echo $this->Form->input('datoscliente', array('label' => false, 'name' => 'data[Factura][datoscliente]', 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Cliente')); ?>
                                        <div id="datosCliente" style="position: absolute;"></div>                                
                                </div>

                                <div class="form-group">
                                    <label>Nit</label><br>
                                    <?php echo $this->Form->input('nitcliente', array('label' => false, 'name' => 'data[Factura][nitcliente]', 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Nit', 'onblur' => 'actualizarNitCliente();')); ?>
                                </div>

                                <div class="form-group">
                                    <label>Teléfono</label><br>
                                    <?php echo $this->Form->input('telefonocliente', array('label' => false, 'name' => 'data[Factura][telefonocliente]', 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Teléfono', 'onblur' => 'actualizarTelefonoCliente();')); ?>
                                </div>                           
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dirección</label><br>
                                    <?php echo $this->Form->input('dircliente', array('label' => false, 'name' => 'data[Factura][dircliente]', 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Dirección', 'onblur' => 'actualizarDireccionCliente();')); ?>
                                </div>

                                <div class="form-group">
                                    <label>Días</label><br>
                                    <?php echo $this->Form->input('diascredcliente', array('label' => false, 'name' => 'data[Factura][diascredcliente]', 'class' => 'form-control registrado', 'name' => 'data[Factura][diascredcliente]', 'autocomplete' => 'off', 'placeholder' => 'Días Límite Crédito', 'onblur' => 'actualizarDiasLimite();')); ?>
                                </div>

                                <div class="form-group">
                                    <label>Límite</label><br>
                                    <?php echo $this->Form->input('limitecredcliente', array('label' => false, 'name' => 'data[Factura][limitecredcliente]', 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Límite de Crédito', 'onblur' => 'actualizarCreditoLimite();')); ?>
                                </div>                             
                            </div>
                        </div>
                    </div>
                    <legend>&nbsp;</legend>  
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">  
                                    <label>Producto</label><br>                                
                                        <?php echo $this->Form->input('producto', array('label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Selección de Producto', 'onkeyup' => 'fnObtenerDatosProducto(event);')); ?>
                                        <div id="datosProducto" style="position: absolute;"></div>                                
                                </div>  
                            </div>
                        </div>
                    </div>                    
                </div>
                <!--Finaliza el div para facturar productos a los usuarios registrados en la aplicacion-->                

                <!--Inicia el div para facturar productos a los usuarios que se van a registrar como nuevos en la aplicacion-->
                <div role="tabpanel" class="tab-pane" id="nuevo"><br>
                    <div class="container-fluid">                       
                        <div class="row">
                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Nombre *</label><br>                                
                                        <?php echo $this->Form->input('nuevonombre', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevonombre]', 'autocomplete' => 'off', 'placeholder' => 'Nombre del Cliente Nuevo', 'onblur' => 'limpirarFormularios()')); ?>
                                </div>              
                            </div>

                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Nit/C.C *</label><br>                                
                                        <?php echo $this->Form->input('nuevonit', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevonit]', 'autocomplete' => 'off', 'placeholder' => 'Nit/C.C del Cliente Nuevo', 'onblur' => 'activarFiltroProductoClienteNuevo();')); ?>
                                </div>              
                            </div>

                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Dirección *</label><br>                                
                                        <?php echo $this->Form->input('nuevodireccion', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevodireccion]', 'autocomplete' => 'off', 'placeholder' => 'Dirección Cliente Nuevo', 'onblur' => 'activarFiltroProductoClienteNuevo();')); ?>
                                </div>              
                            </div>                        
                        </div>

                        <div class="row">
                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Teléfono</label><br>                                
                                        <?php echo $this->Form->input('nuevotelefono', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevotelefono]', 'autocomplete' => 'off', 'placeholder' => 'Teléfono Cliente Nuevo')); ?>     
                                </div>              
                            </div>

                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Celular</label><br>                                
                                        <?php echo $this->Form->input('nuevocelular', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevocelular]', 'autocomplete' => 'off', 'placeholder' => 'Celular Cliente Nuevo')); ?>                               
                                </div>              
                            </div>

                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Email</label><br>                                
                                        <?php echo $this->Form->input('nuevoemail', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevoemail]', 'autocomplete' => 'off', 'placeholder' => 'Email Cliente Nuevo')); ?>                              
                                </div>              
                            </div>                        
                        </div> 

                        <div class="row">
                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Página Web</label><br>                                
                                        <?php echo $this->Form->input('nuevopaginaweb', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevopaginaweb]',  'autocomplete' => 'off', 'placeholder' => 'Página Web Cliente Nuevo')); ?>                                                                  
                                </div>              
                            </div>

                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Días de Crédito *</label><br>                                
                                        <?php echo $this->Form->input('nuevodiscredito', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevodiascredito]',  'autocomplete' => 'off', 'placeholder' => 'Días de Crédito', 'onblur' => 'activarFiltroProductoClienteNuevo();')); ?> 
                                </div>              
                            </div>

                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Límite de Crédito *</label><br>                                
                                        <?php echo $this->Form->input('nuevolimitecredito', array('label' => false, 'class' => 'form-control nuevo', 'name' => 'data[Nuevo][nuevolimitecredito]',  'autocomplete' => 'off', 'placeholder' => 'Límite de Crédito', 'onblur' => 'activarFiltroProductoClienteNuevo();')); ?>
                                </div>              
                            </div>                        
                        </div>    

                        <div class="row">
                            <div class="col-md-4">                    
                                <div class="form-group ">  
                                    <label>Cumpleaños</label><br>
                                    <input name="data[Nuevo][nuevocumpleanios]" id="nuevocumpleanios" class="date form-control nuevo" placeholder="Cumpleaños del Cliente" autocomplete="off" type="text">
                                </div>              
                            </div>                                              
                        </div>                      
                    </div>
                    
                    <legend>&nbsp;</legend>  
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">  
                                    <label>Producto</label><br>                                
                                        <?php echo $this->Form->input('productousuarionuevo', array('label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Selección de Producto', 'onkeyup' => 'fnObtenerDatosProductoUsuarioNuevo(event);')); ?>
                                        <div id="datosProductoclientenuevo" style="position: absolute;"></div>                                
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <!--Finaliza el div para facturar productos a los usuarios que se van a registrar como nuevos en la aplicacion-->
                
                <!--Inicia el div para facturar productos a los usuarios de venta rapida, es decir, no se guardan en la aplicacion-->
                <div role="tabpanel" class="tab-pane" id="ventarapida">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">                    
                                <div class="form-group ">  
                                    <label>Nombre *</label><br>                                
                                        <?php echo $this->Form->input('rapidanombre', array('label' => false, 'class' => 'form-control rapida', 'name' => 'data[Rapida][rapidanombre]', 'autocomplete' => 'off', 'placeholder' => 'Nombre del Cliente', 'onblur' => 'limpirarFormulariosRegistrados()')); ?>                                                                  
                                </div>              
                            </div> 
                            <div class="col-md-6">                    
                                <div class="form-group ">  
                                    <label>Nit/C.C *</label><br>                                
                                        <?php echo $this->Form->input('rapidanit', array('label' => false, 'class' => 'form-control rapida', 'name' => 'data[Rapida][rapidanit]', 'autocomplete' => 'off', 'placeholder' => 'Nit/C.C del Cliente', 'onblur' => 'activarFiltroProductoVentaRapida();')); ?>
                                </div>              
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">                    
                                <div class="form-group ">  
                                    <label>Teléfono</label><br>                                
                                        <?php echo $this->Form->input('rapidatelefono', array('label' => false, 'class' => 'form-control rapida', 'name' => 'data[Rapida][rapidatelefono]', 'autocomplete' => 'off', 'placeholder' => 'Teléfono del Cliente')); ?>                                                                  
                                </div>              
                            </div> 
                            <div class="col-md-6">                    
                                <div class="form-group ">  
                                    <label>Dirección</label><br>                                
                                        <?php echo $this->Form->input('rapidadireccion', array('label' => false, 'class' => 'form-control rapida', 'name' => 'data[Rapida][rapidadireccion]', 'autocomplete' => 'off', 'placeholder' => 'Dirección del Cliente')); ?>                                                                  
                                </div>              
                            </div>                            
                        </div>
                        
                    </div>
                    
                    
                    <legend>&nbsp;</legend>  
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">  
                                    <label>Producto</label><br>                                
                                        <?php echo $this->Form->input('productoventarapida', array('label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Selección de Producto', 'onkeyup' => 'fnObtenerDatosProductoVentaRapida(event);')); ?>
                                        <div id="datosProductoventarapida" style="position: absolute;"></div>                                
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <!--Finaliza el div para facturar productos a los usuarios de venta rapida, es decir, no se guardan en la aplicacion-->
                
            </div>
            <!--Finaliza el div de los tabs para gestion de usuarios-->
            
                    <legend>&nbsp;</legend>                  
                    <div class="table-responsive">
                        <div class="container-fluid">        
                            <table  id="productosPrefacturas" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-condensed">
                                <tr>
                                                <th><?php echo ('Nombre'); ?></th>
                                                <th><?php echo ('Código'); ?></th>
                                                <th><?php echo ('Cantidad'); ?></th>
                                                <th><?php echo ('Valor Unitario'); ?></th>
                                                <th><?php echo ('Valor Total'); ?></th>                                       
                                                <th>&nbsp;</th>
                                </tr>                        
                            </table>
                        </div>
                    </div> 
                    <legend>&nbsp;</legend>            
            
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo $this->Form->input('tipopago', array('label' => 'Tipo Pago', 'type' => 'select', 'options' => $tipoPago, 'class' => 'form-control', 'name' => 'data[Factura][tipopago]', 'default' => '2'));?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $this->Form->input('notafactura', array('label' => 'Nota', 'empty' => 'Seleccione Una', 'type' => 'select', 'options' => $notaFactura, 'class' => 'form-control', 'name' => 'data[Factura][notafactura]'));?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $this->Form->input('vendedor', array('label' => 'Vendedor', 'type' => 'select', 'options' => $vendedor, 'class' => 'form-control', 'default' => $usuarioId, 'name' => 'data[Factura][vendedor]'));?>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <?php echo $this->Form->input('empresaRelacionada', array('label' => '', 'name' => 'data[Factura][empresaRelacionada]', 'class' => 'form-control'));?>
                        </div>
                    </div>             
                    </form>
        </fieldset>
        <div class="container-fluid">
            <button id="btn_facturar" class="btn btn-primary center-block" onclick="facturarProductos();">Facturar</button>
        </div>  
       
<div id="div_producto"></div>
<div id="div_facturar"></div>

