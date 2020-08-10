<?php $this->layout='inicio'; ?>
<div class="prefacturas index">
	<legend><h2 class="bg-primary"><b><?php echo __('Orden de Pedido'); ?></b></h2></legend>
	<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '30', 'id' => 'menuvert'))?>
        <div class="table-responsive">
            <div class="container">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-condensed">
                <tr>
                                <th><?php echo $this->Paginator->sort('cliente_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('created', 'Fecha'); ?></th>
                                <th class="actions"><?php echo __('Acciones'); ?></th>
                </tr>
                <?php foreach ($prefacturas as $prefactura): ?>
                <tr>
                        <td><?php echo h($prefactura['Cliente']['nombre']); ?>&nbsp;</td>
                        <td><?php echo h($prefactura['Prefactura']['created']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->image('png/list-10.png', array('title' => 'Ver Orden de Compra', 'alt' => __('Brownies'), 'width' => '20px', 'url' => array('action' => 'view', $prefactura['Prefactura']['id']))); ?>
                            <?php
                            echo $this->Form->postLink(                        
                              $this->Html->image('png/list-2.png', array('title' => 'Eliminar Orden de Compra', 'alt' => __('Brownies'), 'width' => '20px')), //imagen
                              array('action' => 'delete', $prefactura['Prefactura']['id']), //url
                              array('escape' => false), //el escape
                              __('Está seguro que desea eliminar la orden de Compra?') //la confirmacion
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
</div>
