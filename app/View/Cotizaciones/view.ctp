<div class="cotizaciones view">
<h2><?php echo __('Cotizacione'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Empresa'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cotizacione['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $cotizacione['Empresa']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cotizacione['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $cotizacione['Usuario']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cargueinventario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cotizacione['Cargueinventario']['id'], array('controller' => 'cargueinventarios', 'action' => 'view', $cotizacione['Cargueinventario']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['cantidad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valorunitario'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['valorunitario']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valoriva'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['valoriva']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombrecliente'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['nombrecliente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Identificacioncliente'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['identificacioncliente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validezcotizacion'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['validezcotizacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cotizacione['Cotizacione']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cotizacione'), array('action' => 'edit', $cotizacione['Cotizacione']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cotizacione'), array('action' => 'delete', $cotizacione['Cotizacione']['id']), null, __('Are you sure you want to delete # %s?', $cotizacione['Cotizacione']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cotizaciones'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cotizacione'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cargueinventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cargueinventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
