<div class="cotizaciones form">
<?php echo $this->Form->create('Cotizacione'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cotizacione'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('empresa_id');
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('cargueinventario_id');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('valorunitario');
		echo $this->Form->input('valoriva');
		echo $this->Form->input('nombrecliente');
		echo $this->Form->input('identificacioncliente');
		echo $this->Form->input('validezcotizacion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cotizacione.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cotizacione.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cotizaciones'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cargueinventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cargueinventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
