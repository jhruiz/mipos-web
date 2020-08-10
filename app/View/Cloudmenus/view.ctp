<?php $this->layout='inicio'; ?>
<div class="cloudmenus view">
<legend><h2 class="bg-primary"><b><?php echo __('Menú'); ?></b></h2></legend>
<section class="main row">
    <div class="col-md-4"> 
        <?php if($cloudmenu['Cloudmenu']['imagen'] == ""){ ?>
            <?php echo $this->Html->image('png/image-4.png', array('alt' => 'CakePHP', 'width' => '400', 'height' => '500')); ?>  
        <?php }else{?>
            <img src="<?php echo $urlImagen . $cloudmenu['Cloudmenu']['imagen'];?>" class="img-responsive img-thumbnail">
        <?php }?>                        
    </div>  
    <div class="col-md-4">
	<dl>
		<dt class="text-info"><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($cloudmenu['Cloudmenu']['descripcion']); ?>
			&nbsp;
		</dd><br>
		<dt class="text-info"><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($cloudmenu['Cloudmenu']['url']); ?>
			&nbsp;
                </dd><br>
		<dt class="text-info"><?php echo __('Orden'); ?></dt>
		<dd>
			<?php echo h($cloudmenu['Cloudmenu']['orden']); ?>
			&nbsp;
		</dd><br>
	</dl>
    </div>
</section>
</div><br>
<div class="actions">
	<legend><h2 class="bg-primary"><b><?php echo __('Acciones'); ?></b></h3></legend>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Menú'), array('action' => 'edit', $cloudmenu['Cloudmenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Lista de Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Perfiles'), array('controller' => 'perfiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Perfil'), array('controller' => 'perfiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
