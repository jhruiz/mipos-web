<?php $this->layout='inicio'; ?>
<div class="ciudades index">
    
            <?php echo $this->Form->create('Ciudades',array('action'=>'search','method'=>'post'));?>
            <legend><h2 class="bg-primary"><b><?php echo __('Buscar Ciudades'); ?></b></h2></legend>      
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group ">  
                        <label>Nombre</label><br>                          
                        <input name="nombre" id="nombre" class="form-control" placeholder="Nombre de la Ciudad" type="text">
                    </div>             
                </div>                      
                
                <div class="col-md-3">
                    <div class="form-group ">  
                        <label>País</label><br>                          
                        <?php echo $this->Form->input('pais', array('label' => '', 'name' => 'pais', 'empty' => 'Seleccione uno', 'type' => 'select', 'options' => $paises, 'class' => 'form-control'));?>
                    </div>             
                </div>
                          
        </div>        
        <div class="row">
            <div class="col-md-3">
                <div class="form-group ">  
                <?php echo $this->Form->submit('Buscar',array('class'=>'btn btn-primary'));?>                
                </div>             
            </div>
            <div class="col-md-9">
                &nbsp;
            </div>
        </div>            

        </form><br><br>              
        
        
	<legend><h2 class="bg-primary"><b><?php echo __('Ciudades'); ?></b></h2></legend>
        <div class="table-responsive">
            <div class="container">        
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-condensed">
                    <tr>
                                    <th><?php echo $this->Paginator->sort('descripcion', 'Nombre'); ?></th>
                                    <th><?php echo $this->Paginator->sort('paise_id', 'País'); ?></th>
                                    <th class="actions"><?php echo __('Acciones'); ?></th>
                    </tr>
                    <?php foreach ($ciudades as $ciudade): ?>
                    <tr>
                            <td><?php echo h($ciudade['Ciudade']['descripcion']); ?>&nbsp;</td>
                            <td>
                                    <?php echo $this->Html->link($ciudade['Paise']['descripcion'], array('controller' => 'paises', 'action' => 'view', $ciudade['Paise']['id'])); ?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->image('png/list-10.png', array('title' => 'Ver Ciudad', 'alt' => __('Brownies'), 'width' => '20px', 'url' => array('action' => 'view', $ciudade['Ciudade']['id']))); ?>
                                <?php echo $this->Html->image('png/list-12.png', array('title' => 'Editar Ciudad', 'alt' => __('Brownies'), 'width' => '20px', 'url' => array('action' => 'edit', $ciudade['Ciudade']['id']))); ?>                   
                                <?php
                                echo $this->Form->postLink(                        
                                  $this->Html->image('png/list-2.png', array('title' => 'Eliminar Ciudad', 'alt' => __('Brownies'), 'width' => '20px')), //imagen
                                  array('action' => 'delete', $ciudade['Ciudade']['id']), //url
                                  array('escape' => false), //el escape
                                  __('Está seguro que desea eliminar la ciudad %s?', $ciudade['Ciudade']['descripcion']) //la confirmacion
                                ); 
                                ?>                                   
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registro de {:count} en total, iniciando en registro {:start}, finalizando en {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('Anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' || '));
		echo $this->Paginator->next(__(' Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h3></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva Ciudad'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista Paises'), array('controller' => 'paises', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Pais'), array('controller' => 'paises', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de Depósitos'), array('controller' => 'depositos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Depósito'), array('controller' => 'depositos', 'action' => 'add')); ?> </li>
	</ul>
</div>
