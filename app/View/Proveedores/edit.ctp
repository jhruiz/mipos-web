<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('proveedores/proveedores.js')); ?>
<div class="proveedores form">
<?php echo $this->Form->create('Proveedore'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Editar Proveedor'); ?></b></h2></legend>
		<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '27', 'id' => 'menuvert'))?>
	<?php echo $this->Form->input('id'); ?>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('nit', array('label' => 'Nit', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nit del Proveedor')); ?>                   
                </div>
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('nombre', array('label' => 'Nombre', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre del Proveedor')); ?>                   
                </div>                
		
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('direccion', array('label' => 'Dirección', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Dirección del Proveedor')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('telefono', array('label' => 'Teléfono', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Teléfono del Proveedor')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('ciudade_id', array('label' => 'Ciudad', 'class' => 'form-control')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('paginaweb', array('label' => 'Pagina Web', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Página Web')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('email', array('label' => 'E-Mail', 'type' => 'text',  'class' => 'form-control', 'placeholder' => 'E-Mail Proveedor')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('celular', array('label' => 'Celular', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Celular del Proveedor')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('diascredito', array('label' => 'Días de Crédito', 'class' => 'form-control', 'placeholder' => 'Días de Credito')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <label>Límite de Crédito</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>  
                        <?php echo $this->Form->input('limitecredito', array('label' => '', 'class' => 'form-control numericPrice', 'placeholder' => 'Límite de Crédito')); ?>                                           
                    </div>
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('observaciones', array('label' => 'Observaciones', 'class' => 'form-control', 'placeholder' => 'Observaciones para el proveedor')); ?>                   
                </div>

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('estado_id', array('label' => 'Estado', 'class' => 'form-control')); ?>                   
                    <?php echo $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $usuarioId)); ?>                                       
                </div> 
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>  
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Proveedores'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Ciudad'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
