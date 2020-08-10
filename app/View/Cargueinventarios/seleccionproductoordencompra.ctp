<?php $this->layout=false;?>
<legend><center><h4><?php echo __('Información del Producto'); ?></h4></center></legend><br><br>           
<section class="main row">
    <div class="col-md-6">                
        <div class="thumbnail">
            <?php if($arrProducto['Producto']['imagen'] == ""){ ?>
                <?php echo $this->Html->image('png/image-4.png', array('alt' => 'CakePHP', 'style' => 'max-width: 250px; max-height: 250px;')); ?>  
            <?php }else{?>
            <img src="<?php echo $urlImgProducto . $arrProducto['Producto']['empresa_id'] . "/" . $arrProducto['Producto']['imagen'];?>" class="img-responsive img-rounded center-block" style="max-width: 250px; max-height: 250px;" />
            <?php }?>     
        <div class="caption">
            <legend><h4><b><?php echo $arrProducto['Producto']['descripcion'] . " - " . $arrProducto['Producto']['codigo']; ?></b></h4></legend>
            Existencia Actual: <?php echo $arrProducto['Cargueinventario']['existenciaactual']; ?> <br>
            Precio de Venta: $ <?php echo $arrProducto['Cargueinventario']['precioventa']; ?> <br>
            Precio Máximo: $ <?php echo $arrProducto['Cargueinventario']['preciomaximo']; ?> <br>
            Precio Mínimo: $ <?php echo $arrProducto['Cargueinventario']['preciominimo']; ?>            
        </div>                
        </div>
    </div>

    <div class="col-md-6">           
        <input type="hidden" id="precioVenta" value="<?php echo $arrProducto['Cargueinventario']['precioventa'];?>">
        <input type="hidden" id="precioMinimo" value="<?php echo $arrProducto['Cargueinventario']['preciominimo'];?>">
        <input type="hidden" id="cantidadProducto" value="<?php echo $arrProducto['Cargueinventario']['existenciaactual'];?>">
        <input type="hidden" id="cargueinventarioId" value="<?php echo $arrProducto['Cargueinventario']['id'];?>">  
        <input type="hidden" id="nombreProducto" value="<?php echo $arrProducto['Producto']['descripcion'];?>">
        <input type="hidden" id="codigoProducto" value="<?php echo $arrProducto['Producto']['codigo'];?>">
        
        <div class="form-group form-inline"> 
            <label>Cantidad</label><br>
            <div class="input-group">
                <span class="input-group-addon">#</span>                    
                <?php echo $this->Form->input('cantidadventa', array('label' => '', 'class' => 'form-control', 'placeholder' => 'Cantidad', 'value' => '1', 'onblur' => 'validarCantidadStock();')); ?>
            </div>
        </div>   
        <div class="form-group form-inline"> 
            <label>Precio de Venta</label><br>
            <div class="input-group">
                <span class="input-group-addon">$</span>                    
                <?php echo $this->Form->input('precioventa', array('label' => '', 'class' => 'form-control', 'placeholder' => 'Precio de Venta', 'value' => $arrProducto['Cargueinventario']['precioventa'], 'onblur' => 'validarPrecioMinimo();')); ?>
            </div>
        </div> 
        <legend>&nbsp;</legend>
        <b>Impuestos</b><br>
        <?php foreach ($arrImpuestos as $imp):?>
        <?php echo $imp['Impuesto']['descripcion'] . " : " . $imp['Impuesto']['valor'] . '%';?><br>
        <?php endforeach;?>
    </div>
</section>    
<div class="container-fluid">
    <button  id="btn_guardarEst" class="btn btn-primary center-block" onclick="agregarProductoOrdenCompra()">Agregar</button>
</div>

