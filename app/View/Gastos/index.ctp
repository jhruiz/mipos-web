<?php $this->layout='inicio'; ?>
<div class="gastos index">
	<legend><h2 class="bg-primary"><b><?php echo __('Gastos'); ?></b></h2></legend>
	<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '40', 'id' => 'menuvert'))?>
        <div class="table-responsive">
            <div class="container">        
                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                <tr>
                                <th><?php echo $this->Paginator->sort('descripcion'); ?></th>
                                <th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('fechagasto', 'Fecha del Gasto'); ?></th>
                                <th><?php echo $this->Paginator->sort('created', 'Fecha del Registro'); ?></th>
                                <th><?php echo $this->Paginator->sort('valor'); ?></th>
                                <th><?php echo $this->Paginator->sort('cuenta_id'); ?></th>
                                <th class="actions"><?php echo __('Acciones'); ?></th>
                </tr>
                <?php foreach ($gastos as $gasto): ?>
                <tr>
                        <td><?php echo h($gasto['Gasto']['descripcion']); ?>&nbsp;</td>
                        <td>
                                <?php echo $this->Html->link($gasto['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $gasto['Usuario']['id'])); ?>
                        </td>
                        <td><?php echo h($gasto['Gasto']['fechagasto']); ?>&nbsp;</td>
                        <td><?php echo h($gasto['Gasto']['created']); ?>&nbsp;</td>
                        <td><?php echo h("$" . number_format($gasto['Gasto']['valor'],2)); ?>&nbsp;</td>
                        <td><?php echo h($gasto['Cuenta']['descripcion']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->image('png/list-10.png', array('title' => 'Ver Gasto', 'alt' => __('Brownies'), 'width' => '20px', 'url' => array('action' => 'view', $gasto['Gasto']['id']))); ?>
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
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h3></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Gasto'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
