<?php $this->layout='inicio'; ?>
<div class="depositosClientes form">
<?php echo $this->Form->create('DepositosCliente'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Agregar Depósito'); ?></b></h2></legend>
                <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '16', 'id' => 'menuvert'))?>
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('deposito_id', array('class' => 'form-control', 'label' => 'Depósito')); ?>
                </div>
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('cliente_id', array('class' => 'form-control')); ?>
                </div>                
                <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresaId)); ?>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>

		<li><?php echo $this->Html->link(__('Lista Depósitos Clientes'), array('action' => 'index')); ?></li>
	</ul>
</div>
