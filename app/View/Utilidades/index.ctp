<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('bandeja/gestionBandejas.js'));?>
<div class="utilidades index">
    <?php echo $this->Form->create('Utilidades',array('action'=>'search','method'=>'post'));?>
    <legend><h2 class="bg-primary"><b><?php echo __('Buscar Fecha de Utilidad por Ventas'); ?></b></h2></legend>  
    <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '34', 'id' => 'menuvert'))?>    
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">  
                <label>Fecha Inicial</label><br>                          
                <input name="data[Utilidade][fechaInicio]" id="fechaInicio" class="date form-control" placeholder="Fecha Inicio" type="text">                             
            </div>             
        </div>       
        <div class="col-md-3">
            <div class="form-group">
                <label>Fecha Final</label><br>                          
                <input name="data[Utilidade][fechaFin]" id="fechaFin" class="date form-control" placeholder="Fecha Fin" type="text">               
            </div>        
        </div>
        <div class="col-md-6">
            &nbsp;
        </div>                      
    </div><br>              
    <?php echo $this->Form->submit('Buscar',array('class'=>'btn btn-primary'));?>
    </form><br><br>  
    
	<legend><h2 class="bg-primary"><b><?php echo __('Utilidades por Ventas. ' . $fechaInicio . ' - ' . $fechaFin); ?></b></h2></legend>
        <div class="table-responsive">
            <div class="container">                
                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                <tr>
                    <th><?php echo h('Producto'); ?></th>
                    <th><?php echo h('cantidad'); ?></th>
                    <th><?php echo h('Precio de Venta'); ?></th>                    
                    <th><?php echo h('Utilidad Bruta'); ?></th>
                    <th><?php echo h('Utilidad Porcentual'); ?></th>
                    <th><?php echo h('Fecha'); ?></th>
                </tr>
                <?php foreach ($utilidades as $utilidade): ?>
                <tr>
                    <td><?php echo h($utilidade['Cargueinventario']['nombreProducto']); ?>&nbsp;</td>
                    <td><?php echo h($utilidade['Utilidade']['cantidad']); ?>&nbsp;</td>
                    <td><?php echo h("$" . number_format($utilidade['Utilidade']['precioventa'],2)); ?>&nbsp;</td>                    
                    <td><?php echo h("$" . number_format($utilidade['Utilidade']['utilidadbruta'],2)); ?>&nbsp;</td>
                    <td><?php echo h($utilidade['Utilidade']['utilidadporcentual']); ?>&nbsp;</td>
                    <td><?php echo h($utilidade['Utilidade']['created']); ?>&nbsp;</td>
                </tr>
                <?php endforeach; ?>
                </table>
                <legend>&nbsp;</legend>
                <div class="row">
                    <div class="col-md-8">
                        &nbsp;
                    </div>              
                    <div class="col-md-2">
                        <dl>                    
                            <dt class="text-left text-success"><?php echo h("Total Ventas: ");?></dt>
                            <dt class="text-left text-success"><?php echo h("Total Utilidad: ");?></dt>
                        </dl>
                    </div>         
                    <div class="col-md-2">                
                        <dl>
                            <dt class="text-right text-success"><?php echo h("$" . number_format(($totalVenta),2))?></dt>
                            <dt class="text-right text-success"><?php echo h("$" . number_format($utilidadBruta,2))?></dt>
                        </dl>
                    </div>                     
                </div>
                
            </div>
        </div>
</div>
