<?php echo ($this->Html->script('bandeja/gestionBandejas'));  ?>
<?php $this->layout='inicio'; ?>
<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Editar Cliente'); ?></b></h2></legend>
		<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '14', 'id' => 'menuvert'))?>
    <section class="main row">
        <div class="col-md-4"> 
            <?php echo $this->Form->input('id'); ?>
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('nit', array('label' => 'Nit', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nit del Cliente')); ?>                   
            </div>     
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('telefono', array('label' => 'Teléfono', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Teléfono del Cliente')); ?>                   
            </div> 
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('email', array('label' => 'E-mail', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'E-mail del Cliente')); ?>                   
            </div>  
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('limitecredito', array('label' => 'Límite de Crédito', 'class' => 'form-control', 'placeholder' => 'Límite de Crédito Sugerido')); ?>                   
            </div>  
            <div class="form-group form-inline"> 
                <label>Observaciones</label><br>
                <?php echo $this->Form->input('observaciones', array('label' => '', 'class' => 'form-control', 'placeholder' => 'Observaciones sobre el Cliente')); ?>                   
            </div>            
        </div>
        <div class="col-md-4">
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('nombre', array('label' => 'Nombre', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre del Cliente')); ?>                   
            </div>    
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('ciudade_id', array('label' => 'Ciudad', 'class' => 'form-control')); ?>                   
            </div>  
            <div class="form-group form-inline">
                <?php echo $this->Form->input('celular', array('label' => 'Celular', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Celular del Cliente')); ?>                   
            </div>   
            <div class="form-group form-inline">     
                <label>Cumpleaños</label>
                <input name="data[Cliente][cumpleanios]" class="date form-control" placeholder="Cumpleaños Cliente" type="text" id="cumpleanios">
            </div>              
        </div>
        <div class="col-md-4">   
            <div class="form-group form-inline">
                <?php echo $this->Form->input('direccion', array('label' => 'Dirección', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Dirección del Cliente')); ?>                   
            </div> 
            <div class="form-group form-inline">
                <?php echo $this->Form->input('paginaweb', array('label' => 'Página Web', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Página Web del Cliente')); ?>                   
            </div>    
            <div class="form-group form-inline">
                <?php echo $this->Form->input('diascredito', array('label' => 'Días de Crédito', 'class' => 'form-control', 'placeholder' => 'Días de Crédito Sugeridos')); ?>                   
            </div> 
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('deposito_id', array('label' => 'Depósito', 'class' => 'form-control', 'placeholder' => 'Nit del Cliente')); ?>                   
            </div>                                         
        </div>
            <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
            <?php echo $this->Form->input('usuario_id', array('type' => 'hidden', 'value' => $usuarioId)); ?>
            <?php echo $this->Form->input('estado_id', array('type' => 'hidden', 'value' => '1')); ?>           
    </section>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Clientes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Depósitos'), array('controller' => 'depositos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Depósito'), array('controller' => 'depositos', 'action' => 'add')); ?> </li>
	</ul>
</div>
