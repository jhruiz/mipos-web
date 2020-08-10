<?php $this->layout='inicio'; ?>
<div class="tipodepositos form">
<?php echo $this->Form->create('Tipodeposito'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Editar Tipo de Depósito'); ?></b></h2></legend>
		<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '8', 'id' => 'menuvert'))?> 
	<?php echo $this->Form->input('id'); ?>
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('descripcion', array('label' => 'Nombre', 'class' => 'form-control', 'placeholder' => 'Nombre del Tipo de Depósito')); ?>
                </div>
	<?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
	</fieldset><br>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>

		<li><?php echo $this->Html->link(__('Lista Tipo de Depósitos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Depósitos'), array('controller' => 'depositos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Depósito'), array('controller' => 'depositos', 'action' => 'add')); ?> </li>
	</ul>
</div>
