<?php $this->layout='inicio'; ?>
<div class="tipopagos form">
<?php echo $this->Form->create('Tipopago'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Agregar Tipo de Pago'); ?></b></h2></legend>
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('descripcion', array('label' => 'Nombre', 'class' => 'form-control', 'placeholder' => 'Nombre del Tipo de Pago')); ?>
                </div>
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('contabilizar', array('type' => 'checkbox', 'class' => 'form-control')); ?>
                </div>
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('estado_id', array('class' => 'form-control')); ?>
                </div>
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
                </div>                
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Tipo de Pagos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Cargue Inventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cargue Inventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Descargue Inventarios'), array('controller' => 'descargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Descargue Inventario'), array('controller' => 'descargueinventarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
