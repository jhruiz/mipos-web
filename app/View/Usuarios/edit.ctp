<?php $this->layout='inicio'; ?>
<div class="usuarios form">
<?php echo $this->Form->create('Usuario', array('type' => 'file', 'class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Agregar Usuario'); ?></b></h2></legend>
		<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '25', 'id' => 'menuvert'))?>
	<?php echo $this->Form->input('id'); ?> 
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Nombre del Usuario')); ?>
                </div>
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('identificacion', array('label' => 'CC/Nit' ,'class' => 'form-control', 'placeholder' => 'Identificacion del Usuario')); ?>
                </div>                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Login del Usuario')); ?>
                </div>                                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('imagen', array('type' => 'file')); ?>
                    <p class="help-block">Máximo 1MB</p>
                </div>                              
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('perfile_id', array('class' => 'form-control')); ?>
                </div>	 
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('estado_id', array('class' => 'form-control')); ?>
                </div>	   
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('estadologin', array('type' => 'hidden', 'value' => '0')); ?>
                    <?php echo $this->Form->input('intentos', array('type' => 'hidden', 'value' => '0')); ?>
                    <?php if($perfilId == '1'){echo $this->Form->input('empresa_id', array('class' => 'form-control'));}else{echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresas));} ?>                                       
                </div>	                
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>  
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Notas'), array('controller' => 'anotaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Nota'), array('controller' => 'anotaciones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Inventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Inventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Depósitos'), array('controller' => 'depositos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Depósito'), array('controller' => 'depositos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Descargue Inventarios'), array('controller' => 'descargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Descargue Inventario'), array('controller' => 'descargueinventarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Categorías'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
</div>
