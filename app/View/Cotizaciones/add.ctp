<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('cotizacion/cotizacion.js')); ?>
<div class="cotizaciones form">
<?php echo $this->Form->create('Cotizacione'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Realizar Cotización'); ?></b></h2></legend>
	    <div class="container"> 
	            <div class="panel panel-default">
	                <div class="panel-body"> 	    	    
			<table border="0">
			    <tr>
			        <td width="35%" align="left">
			          <img src="<?php echo $urlImg . $arrEmpresa['Empresa']['id'] . '/' . $arrEmpresa['Empresa']['imagen'];?>" class="img-responsive img-thumbnail center-block" width="135" height="135" >
			        </td>
			    	<td width="30%"  align="left">
		                    <h3><dt><?php echo h($arrEmpresa['Empresa']['nombre']);?></dt></h3>
		                    <dt><?php echo h("Nit: " . $arrEmpresa['Empresa']['nit']);?></dt>
		                    <dt><?php echo h("Dirección: " . $arrEmpresa['Empresa']['direccion']);?></dt>
		                    <dt><?php echo h("Teléfono: " . $arrEmpresa['Empresa']['telefono1'] . " - " . $arrEmpresa['Empresa']['telefono2']);?></dt> 
		                    <dt><?php echo h("Correo Electrónico: " . $arrEmpresa['Empresa']['email']);?></dt>
			    	<td>
			    	<td width="35%" align="left">
	                            <dt><?php echo h("Vendedor: " . $infoVendedor['Usuario']['nombre']);?></dt>
	                            <dt><?php echo h("Nit/C.C: " . $infoVendedor['Usuario']['identificacion']);?></dt>
	                            <dt><?php echo h("Fecha Cotización: " . $fechaActual);?></dt>
	                            <dt><?php echo h("Fecha Vencimiento Cotización: " . $fechaVenceCot);?></dt>		    	
			    	</td>	        
			    </tr>
			</table>
		    </div>
	    </div>	    

            <div class="panel panel-default">
                <div class="panel-body"> 	
	                <div class="container-fluid">
	                    <div class="row">
			        <div class="col-md-6">
			            <div class="form-group">
			                <label>Nombre Cliente</label><br>
			                <?php echo $this->Form->input('nomcliente', array('label' => false, 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Nombre del Cliente')); ?>			                
			            </div>
		                </div>
			        <div class="col-md-6">
			            <div class="form-group">
			                <label>Identificación Cliente</label><br>
			                <?php echo $this->Form->input('idcliente', array('label' => false, 'class' => 'form-control registrado', 'autocomplete' => 'off', 'placeholder' => 'Identificación Cliente')); ?>			                
			            </div>
		                </div>
		                
	                    </div>
	                </div>	
		</div>
            </div>
            
            <div class="panel panel-default">
            	<div class="panel-body">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="form-group ">  
	                            <label>Producto</label><br>                                
	                                <?php echo $this->Form->input('producto', array('label' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Selección de Producto', 'onkeyup' => 'fnObtenerDatosProducto(event);')); ?>
	                                <div id="datosProducto" style="position:absolute; z-index:1;"></div>                                
	                        </div>  
	                    </div>
	                </div>
	            </div>  
	        </div>
            </div>          

	<?php
		echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $arrEmpresa['Empresa']['id']));
		echo $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $infoVendedor['Usuario']['id'])); 
		echo $this->Form->input('fechaActual', array('type' => 'hidden', 'value' => $fechaActual)); 
		echo $this->Form->input('fechaVencCot', array('type' => 'hidden', 'value' => $fechaVenceCot)); 						               			
	?>
	
            <div class="panel panel-default">
            	<div class="panel-body">	
	            <div class="table-responsive">
	                <div class="container-fluid">        
	                    <table  id="productosCotizacion" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-condensed">
	                        <tr>
                                        <th style="width: 20%;"><?php echo ('Nombre'); ?></th>
                                        <th style="width: 20%;"><?php echo ('Código'); ?></th>
                                        <th style="width: 10%;"><?php echo ('Cantidad'); ?></th>
                                        <th style="width: 20%;"><?php echo ('Valor Unitario'); ?></th>
                                        <th style="width: 20%;"><?php echo ('Valor Total'); ?></th>                                       
                                        <th style="width: 10%;">&nbsp;</th>
	                        </tr>                        
	                    </table>
	                    <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
	                        <tr>
                                        <th style="width: 70%;"; align="center"><?php echo ('SUBTOTAL'); ?></th>
                                        <th style="width: 20%;"><?php echo $this->Form->input('subtotal', array('label' => false, 'class' => 'form-control numericPrice', 'disabled' => 'true')); ?></th>                                       
                                        <th style="width: 10%;">&nbsp;</th>
	                        </tr>                        
	                    </table>	
	                    <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
	                        <tr>
                                        <th style="width: 70%;"><?php echo ('IMPUESTOS'); ?></th>
                                        <th style="width: 20%;"><?php echo $this->Form->input('impuestos', array('label' => false, 'class' => 'form-control numericPrice', 'disabled' => 'true')); ?></th>                                       
                                        <th style="width: 10%;">&nbsp;</th>
	                        </tr>                        
	                    </table>
	                    <table  id="productosCotizacion" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
	                        <tr>
                                        <th style="width: 70%;"; align="center"><?php echo ('VALOR TOTAL'); ?></th>
                                        <th style="width: 20%;"><?php echo $this->Form->input('total', array('label' => false, 'class' => 'form-control numericPrice', 'disabled' => 'true')); ?></th>                                       
                                        <th style="width: 10%;">&nbsp;</th>
	                        </tr>                        
	                    </table>	                    	                                        	                    
	                </div>
	            </div> 
                </div>
            </div>	


	</fieldset>
	<div class="container">
	        <div class="btn-group">                    
	           <?php //<button id="butImprimirFact" class="btn btn-primary hidden-print" onclick="imprimirFactura();">Imprimir Cotización</button> ?>
	        </div>
        </div>
</div>
<div id="datosProducto"></div>
<div id="div_producto"></div>
