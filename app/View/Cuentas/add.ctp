<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('obtenermenu/obtenermenu.js')); ?>
<div class="cuentas form">
<?php echo $this->Form->create('Cuenta'); ?>
	<fieldset>
            <legend><h2 class="bg-primary"><b><?php echo __('Agregar Cliente'); ?></b></h2></legend>
            <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '39', 'id' => 'menuvert'))?>
            <section class="main row">        
                <div class="col-md-4">
                    <div class="form-group form-inline"> 
                        <?php echo $this->Form->input('descripcion', array('label' => 'Nombre Cuenta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre de la Cuenta')); ?>                   
                    </div>             
                    <div class="form-group form-inline"> 
                        <?php echo $this->Form->input('numerocuenta', array('label' => 'Número Cuenta', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Número de la Cuenta')); ?>                   
                    </div>             
                    <div class="form-group form-inline"> 
                        <?php echo $this->Form->input('saldo', array('label' => 'Saldo', 'type' => 'text', 'class' => 'form-control numericPrice', 'placeholder' => 'Saldo de la Cuenta')); ?>                   
                    </div>                         
                    <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
                </div>
            </section>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lista Cuentas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Gastos'), array('controller' => 'gastos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Gasto'), array('controller' => 'gastos', 'action' => 'add')); ?> </li>
	</ul>
</div>
