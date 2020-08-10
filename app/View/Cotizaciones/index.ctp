<div class="cotizaciones index">
	<h2><?php echo __('Cotizaciones'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('empresa_id'); ?></th>
			<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cargueinventario_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('valorunitario'); ?></th>
			<th><?php echo $this->Paginator->sort('valoriva'); ?></th>
			<th><?php echo $this->Paginator->sort('nombrecliente'); ?></th>
			<th><?php echo $this->Paginator->sort('identificacioncliente'); ?></th>
			<th><?php echo $this->Paginator->sort('validezcotizacion'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cotizaciones as $cotizacione): ?>
	<tr>
		<td><?php echo h($cotizacione['Cotizacione']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cotizacione['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $cotizacione['Empresa']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cotizacione['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $cotizacione['Usuario']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cotizacione['Cargueinventario']['id'], array('controller' => 'cargueinventarios', 'action' => 'view', $cotizacione['Cargueinventario']['id'])); ?>
		</td>
		<td><?php echo h($cotizacione['Cotizacione']['cantidad']); ?>&nbsp;</td>
		<td><?php echo h($cotizacione['Cotizacione']['valorunitario']); ?>&nbsp;</td>
		<td><?php echo h($cotizacione['Cotizacione']['valoriva']); ?>&nbsp;</td>
		<td><?php echo h($cotizacione['Cotizacione']['nombrecliente']); ?>&nbsp;</td>
		<td><?php echo h($cotizacione['Cotizacione']['identificacioncliente']); ?>&nbsp;</td>
		<td><?php echo h($cotizacione['Cotizacione']['validezcotizacion']); ?>&nbsp;</td>
		<td><?php echo h($cotizacione['Cotizacione']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $cotizacione['Cotizacione']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cotizacione['Cotizacione']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cotizacione['Cotizacione']['id']), null, __('Are you sure you want to delete # %s?', $cotizacione['Cotizacione']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Cotizacione'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cargueinventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cargueinventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
