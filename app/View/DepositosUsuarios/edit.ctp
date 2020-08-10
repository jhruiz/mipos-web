<?php $this->layout='inicio'; ?>
<div class="depositosUsuarios form">
<?php echo $this->Form->create('DepositosUsuario'); ?>
	<fieldset>
		<legend><h2 class="bg-primary"><b><?php echo __('Editar Usuario - Depósito'); ?></b></h2></legend>
		<?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '17', 'id' => 'menuvert'))?>
                <?php echo $this->Form->input('id'); ?>
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('usuario_id', array('class' => 'form-control')); ?>
                </div>
                
                <div class="form-group form-inline"> 
                    <?php echo $this->Form->input('deposito_id', array('label' => 'Depósito','class' => 'form-control')); ?>
                </div>                
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Lists Usuarios - Depositos'), array('action' => 'index')); ?></li>
	</ul>
</div>
