<?php $this->layout='inicio'; ?>
<div class="relacionempresas form">
<?php echo $this->Form->create('Relacionempresa', array('type' => 'file', 'class' => 'form-horizontal')); ?>
	<fieldset>
            <legend><h2 class="bg-primary"><b><?php echo __('Relacionar Empresa'); ?></b></h2></legend>
            <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '37', 'id' => 'menuvert'))?>
            <?php echo $this->Form->input('empresa_id', array('type' => 'hidden', 'value' => $empresas)); ?>
            <div class="form-group form-inline">
                <?php echo $this->Form->input('nombre', array( 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nombre Empresa')); ?>
            </div> 
            
            <div class="form-group form-inline">
                <?php echo $this->Form->input('nit', array('class' => 'form-control', 'placeholder' => 'Nit Empresa')); ?>
            </div>             

            <div class="form-group form-inline">
                <?php echo $this->Form->input('direccion', array('label' => 'Dirección','class' => 'form-control', 'placeholder' => 'Dirección Empresa')); ?>
            </div>                         
            
            <div class="form-group form-inline">
                <?php echo $this->Form->input('telefono1', array('label' => 'Teléfono','class' => 'form-control', 'placeholder' => 'Teléfono Empresa')); ?>
            </div>                              
            
            <div class="form-group form-inline">
                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'E-mail Empresa')); ?>
            </div>                        
            
            <div class="form-group form-inline">
                <?php echo $this->Form->input('representantelegal', array('label' => 'Representante', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Representante Empresa')); ?>
            </div>      
            
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('codigo', array('class' => 'form-control', 'placeholder' => 'Código de la Empresa')); ?>
            </div>                
            
            <div class="form-group form-inline"> 
                <?php echo $this->Form->input('imagen', array('type' => 'file')); ?>
                <p class="help-block">Máximo 1MB</p>
            </div>              
	
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary'));?>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h2></legend>
        <ul>
		<li><?php echo $this->Html->link(__('Lista Empresas Relacionadas'), array('action' => 'index')); ?></li>
	</ul>
</div>
