<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('productos/productos.js')); ?>
    <div class="productos form">

    <?php echo $this->Form->create('Producto', array('type' => 'file', 'class' => 'form-horizontal')); ?>
        <fieldset>
            <legend><h2 class="bg-primary"><b><?php echo __('Agregar Producto'); ?></b></h2></legend>
                <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '4', 'id' => 'menuvert'))?>            
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('descripcion', array('label' => 'Nombre', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre del Producto')); ?>
                </div>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('imagen', array('type' => 'file')); ?>
                    <p class="help-block">Máximo 1MB</p>
                </div>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('categoria_id', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('marca', array('class' => 'form-control', 'placeholder' => 'Marca del Producto')); ?>
                </div>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('existenciaminima', array('label' => 'Existencia Mínima', 'class' => 'form-control', 'placeholder' => 'Cantidad Mínima Permitida')); ?>
                </div>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('existenciamaxima', array('label' =>  'Existencia Máxima', 'class' => 'form-control', 'placeholder' => 'Cantidad Máxima Permitida')); ?>
                </div>
                <div class="form-group form-inline"> 
                    <label>Costo Promedio</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>                    
                        <?php echo $this->Form->input('costopromedio', array('label' => '', 'class' => 'form-control number', 'placeholder' => 'Costo de Producto')); ?>
                    </div>
                </div>
                <div class="form-group form-inline"> 
                    <label>Mostrar en Catálogo</label>
                    <?php echo $this->Form->input('mostrarencatalogo', array('label' => '', 'type' => 'checkbox', 'class' => 'form-control')); ?>
                    <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId))?>
                </div>
                <div class="form-group form-inline"> 
                    <label>Código</label>
                    <?php echo $this->Form->input('codigo', array('label' => '', 'class' => 'form-control', 'placeholder' => 'Código del Producto')); ?>                   
                </div>
	</fieldset>
        <br>
        <?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>        
    </div><br>
<div class="actions">
    <legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
        <ul>

		<li><?php echo $this->Html->link(__('Lista Productos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Inventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cargue de Inventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Descargue de Inventarios'), array('controller' => 'descargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Descargue de Inventario'), array('controller' => 'descargueinventarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
