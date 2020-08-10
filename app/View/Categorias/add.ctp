<?php $this->layout='inicio'; ?>
<div class="categorias form">
<?php echo $this->Form->create('Categoria'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Agregar Categoría'); ?></b></h2></legend>
                <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '12', 'id' => 'menuvert'))?> 
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('descripcion', array('label' => 'Nombre', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre de la Categoría')); ?>
                </div>                
                <?php echo $this->Form->input('usuario_id', array('type' => 'hidden', 'label' => 'Usuario', 'value' => $usuarioId)); ?>
                <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'label' => 'Usuario', 'value' => $empresaId)); ?>
                
                <div class="form-group form-inline"> 
                    <label>Mostrar en Catálogo</label>
                    <?php echo $this->Form->input('mostrarencatalogo', array('label' => '', 'type' => 'checkbox', 'class' => 'form-control')); ?>
                </div>                
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
    <legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>

		<li><?php echo $this->Html->link(__('Lista Categorías'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Producto'), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>
