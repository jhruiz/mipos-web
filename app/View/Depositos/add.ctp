<?php echo ($this->Html->script('bandeja/gestionBandejas'));  ?>
<?php $this->layout='inicio'; ?>
<div class="depositos form">
<?php echo $this->Form->create('Deposito'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Agregar Depósito'); ?></b></h2></legend>
                <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '15', 'id' => 'menuvert'))?>
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('descripcion', array('label' => 'Nombre', 'class' => 'form-control', 'placeholder' => 'Nombre del Depósito')); ?>
                </div>                
                
                <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('ciudade_id', array('class' => 'form-control')); ?>
                </div>      
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('estado_id', array('class' => 'form-control')); ?>
                </div>  
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('telefono', array('label' => 'Teléfono', 'class' => 'form-control', 'placeholder' => 'Teléfono del Depósito')); ?>
                </div>                 
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('direccion', array('label' => 'Dirección', 'class' => 'form-control', 'placeholder' => 'Dirección del Depósito')); ?>
                </div>  

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('usuario_id', array('label' => 'Encargado', 'class' => 'form-control')); ?>
                </div>    
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('nombredocumentoventa', array('label' => 'Dcto. Venta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre Documento')); ?>
                </div>     
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('resolucionfacturacion', array('label' => 'Resolución Fact.', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Resolución Factura')); ?>
                </div> 
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('tipodeposito_id', array('label' => 'Tipo Depósito', 'class' => 'form-control')); ?>
                </div>  
                
                <div class="form-group form-inline">     
                    <label>Fecha de Resolución</label>
                    <input name="data[Deposito][fecharesolucion]" class="date form-control" placeholder="Fecha de Resolución" type="text" id="cumpleanios">
                </div>     
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('resolucioninicia', array('label' => 'Inicio Resolución', 'class' => 'form-control', 'placeholder' => 'Número Inicial de Resolución')); ?>
                </div>
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('resolucionfin', array('label' => 'Fin Resolución', 'class' => 'form-control', 'placeholder' => 'Número Final de Resolución')); ?>
                </div>                

                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('prefijo', array('class' => 'form-control', 'placeholder' => 'Prefijo del Depósito')); ?>
                </div>      
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('regimene_id', array('label' => 'Régimen', 'class' => 'form-control')); ?>
                </div>     
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('nota', array('class' => 'form-control', 'placeholder' => 'Agregar nota para el depósito')); ?>
                </div>                
	</fieldset><br>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>

		<li><?php echo $this->Html->link(__('Lista Depósitos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Ciudad'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Tipo Depósitos'), array('controller' => 'tipodepositos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipo Depósito'), array('controller' => 'tipodepositos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Régimen'), array('controller' => 'regimenes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Régimen'), array('controller' => 'regimenes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Cargue Inventarios'), array('controller' => 'cargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cargue Inventario'), array('controller' => 'cargueinventarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Descargue Inventarios'), array('controller' => 'descargueinventarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Descargue Inventario'), array('controller' => 'descargueinventarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
