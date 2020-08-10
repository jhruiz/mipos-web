<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('bandeja/gestionBandejas'));  ?>
<div class="facturas index">
    
            <?php echo $this->Form->create('Facturas',array('action'=>'search','method'=>'post'));?>
            <legend><h2 class="bg-primary"><b><?php echo __('Buscar Facturas'); ?></b></h2></legend>      
            <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '33', 'id' => 'menuvert'))?>
            <div class="row">                     
                
                <div class="col-md-2">
                    <div class="form-group ">  
                        <label>Código</label><br>                          
                        <input name="codigo" id="codigo" class="form-control" placeholder="Código de la Factura" type="text">
                    </div>             
                </div>    
                
                <div class="col-md-2">
                    <div class="form-group ">  
                        <label>Consecutivo</label><br>                          
                        <input name="consecutivo" id="consecutivo" class="form-control" placeholder="Consecutivo DIAN" type="text">
                    </div>             
                </div>                  
                
                <div class="col-md-2">
                    <div class="form-group ">  
                        <label>Vendedor</label><br>                          
                        <?php echo $this->Form->input('vendedor', array('label' => '', 'name' => 'vendedor', 'empty' => 'Seleccione uno', 'type' => 'select', 'options' => $usuario, 'class' => 'form-control'));?>
                    </div>             
                </div>
                
                <div class="col-md-2">
                    <div class="form-group ">  
                        <label>Fecha</label><br>                          
                        <input name="fechafactura" id="fechafactura" class="date form-control" placeholder="Fecha de Expedición" type="text">
                    </div>             
                </div>                

                <div class="col-md-2">
                    <div class="form-group ">  
                        <label>Vencimiento</label><br>                          
                        <input name="fechavence" id="fechavence" class="date form-control" placeholder="Fecha de Vencimiento" type="text">
                    </div>             
                </div>  
                
                <div class="col-md-2">
                    <div class="form-group ">  
                        <label>Pago</label><br>                          
                        <?php echo $this->Form->input('tipopago', array('label' => '', 'name' => 'tipopago', 'empty' => 'Seleccione uno', 'type' => 'select', 'options' => $tipoPago, 'class' => 'form-control'));?>
                    </div>             
                </div>                                          
        </div>        
        <div class="row">
            
            <div class="col-md-3">
                <div class="form-group ">  
                <?php echo $this->Form->submit('Buscar',array('class'=>'btn btn-primary'));?>                
                </div>             
            </div>
            <div class="col-md-9">
                &nbsp;
            </div>
        </div>            

        </form><br><br> 
        
        
	<legend><h2 class="bg-primary"><b><?php echo __('Facturas'); ?></b></h2></legend>
        <div class="table-responsive">
            <div class="container">
            <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                <tr>
                    <th><?php echo $this->Paginator->sort('codigo'); ?></th>
                    <th><?php echo $this->Paginator->sort('consecutivodian', 'Consecutivo'); ?></th>
                    <th><?php echo $this->Paginator->sort('cliente_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('usuario_id', 'Vendedor'); ?></th>
                    <th><?php echo $this->Paginator->sort('created', 'Fecha Factura'); ?></th>
                    <th><?php echo $this->Paginator->sort('fechavence', 'Fecha Vencimiento'); ?></th>
                    <th><?php echo $this->Paginator->sort('tipopago_id', 'Tipo de Pago'); ?></th>
                    <th class="actions"><?php echo __('Acciones'); ?></th>
                </tr>
                <?php foreach ($facturas as $factura): ?>
                <tr>                    
                        <td><?php echo h($factura['Factura']['codigo']); ?>&nbsp;</td>
                        <td><?php echo h($factura['Factura']['consecutivodian']); ?>&nbsp;</td>
                        <td><?php echo h($factura['Cliente']['nombre']); ?>&nbsp;</td>
                        <td><?php echo h($factura['Usuario']['nombre']); ?>&nbsp;</td>
                        <td><?php echo h($factura['Factura']['created']); ?>&nbsp;</td>
                        <td><?php echo h($factura['Factura']['fechavence']); ?>&nbsp;</td>
                        <td><?php echo h($factura['Tipopago']['descripcion']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->image('png/list-10.png', array('title' => 'Ver Factura', 'alt' => __('Brownies'), 'width' => '20px', 'url' => array('action' => 'view', $factura['Factura']['id']))); ?>
                            <?php
                            echo $this->Form->postLink(                        
                              $this->Html->image('png/list-2.png', array('title' => 'Cancelar Factura', 'alt' => __('Brownies'), 'width' => '20px')), //imagen
                              array('action' => 'delete', $factura['Factura']['id']), //url
                              array('escape' => false), //el escape
                              __('Está seguro que desea cancelar la factura?') //la confirmacion
                            ); 
                            ?> 
                        </td>
                </tr>
    <?php endforeach; ?>
            </table>
            </div>
        </div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registro de {:count} en total, iniciando en registro {:start}, finalizando en {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled')); ?>
	<?php echo $this->Paginator->numbers(array('separator' => ' || ')); ?>
	<?php echo $this->Paginator->next(__(' Siguiente') . ' >', array(), null, array('class' => 'next disabled')); ?>
	</div>
</div><br><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h3></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Facturar'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
