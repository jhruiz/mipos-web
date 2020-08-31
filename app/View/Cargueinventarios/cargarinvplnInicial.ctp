<?php 
    $this->layout='inicio'; 
    echo ($this->Html->script('cargarinventario/cargarinvplano.js'));
?>

<?php echo $this->Form->create('Cargueplano', array('type' => 'file')); ?>
<div class="cargueiplano">
    <legend><h2><?php echo __('Cargue de Inventario Inicial'); ?></h2></legend>
        <div class="col-md-12"> 
            <div class="x_panel">
                <div class="col-md-6">
                    <b>DESCARGAR PLANTILLA</b>
                    <img src="/img/png/excel.png" alt="..." style="width: 80px; height: 80px;" id='plantilla'>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->input('cargarInventario', array('type' => 'file')); ?><br>
                    <?php echo $this->Form->submit('Cargar',array('class'=>'btn btn-primary'));?>                     
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top:10px;">
            <?php if(!empty($mensaje)){?>
            <div class="x_panel">
                <div class="alert alert-info alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong><h2><?php echo base64_decode($mensaje); ?> 
                  <?php if(!empty($errorCsv)){ ?> <button type="button" class="btn btn-warning" onclick="downloadCsvError('<?php echo $errorCsv; ?>')"><i class="fa fa-download"></i> Descargar</button> <?php } ?> </h2></strong> 
                </div>
            </div>
            <?php } ?>            
        </div>
    </div>
</form>
