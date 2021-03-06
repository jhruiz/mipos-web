<?php echo ($this->Html->script('bandeja/gestionBandejas'));  ?>
<?php $this->layout='inicio'; ?>
<div class="licenciasEmpresas form">
<?php echo $this->Form->create('LicenciasEmpresa'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Asignar Licencia a Empresa'); ?></b></h2></legend>
                
                <div class="form-group form-inline">
                    <label>Inicio Licencia</label>
                    <input name="data[LicenciasEmpresa][fechainicio]" class="date form-control" placeholder="Fecha Inicio Licencia" type="text" id="fechaInicio">
                </div>

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('licencia_id', array('empty' => 'Seleccione una', 'class' => 'form-control', 'placeholder' => 'Nombre del Producto')); ?>
                </div>
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('fechafin', array('label' => 'Fin de Licencia', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Fecha Fin del Producto', 'readonly' => 'true')); ?>
                </div>
                
                <div class="form-group form-inline">
                    <?php echo $this->Form->input('cantidad', array('label' => 'Cantidad', 'class' => 'form-control', 'placeholder' => 'Cantidad de Licencias')); ?>
                </div>                 

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('empresa_id', array('empty' => 'Seleccione uno', 'class' => 'form-control')); ?>
                </div>

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('estado_id', array('class' => 'form-control')); ?>
                </div>               

                <div class="form-group form-inline">
                    <?php echo $this->Form->input('codigo', array('label' => 'Código de Licencia', 'class' => 'form-control', 'placeholder' => 'Código Licencia', 'readonly' => 'true')); ?>
                </div>                
	</fieldset><br>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Empresas - Licencias'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Licencias'), array('controller' => 'licencias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Licencia'), array('controller' => 'licencias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
	</ul>
</div>
