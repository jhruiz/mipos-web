<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('gastos/gastos')); ?>
<?php echo ($this->Html->script('bandeja/gestionBandejas'));  ?>
<div class="gastos form">
<?php echo $this->Form->create('Gasto'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Agregar Gasto'); ?></b></h2></legend>
                <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '40', 'id' => 'menuvert'))?>
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('descripcion', array('class' => 'form-control', 'placeholder' => 'Descripción del gasto')); ?>
                </div> 

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('usuario_id', array('class' => 'form-control', 'empty' => 'Seleccione Uno')); ?>
                </div> 

                <div class="form-group form-inline">
                    <label>Fecha Gasto</label>
                    <input name="data[Gasto][fechagasto]" class="date form-control" placeholder="Fecha del Gasto" type="text" id="fechagasto">                    
                </div> 

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('valor', array( 'type' => 'text', 'class' => 'form-control numberPrice', 'placeholder' => 'Monto del gasto', 'onblur' => 'restaurarCuenta();')); ?>
                </div> 

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('cuenta_id', array('class' => 'form-control', 'empty' => 'Seleccione Una', 'onchange' => 'validarEstadoCuenta();')); ?>
                </div> 
                <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?> 
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Gastos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
