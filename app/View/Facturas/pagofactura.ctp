<?php 
$this->layout=false;
echo ($this->Html->script('seleccionproductoventa/seleccionproductoventa.js'));
?>
<legend><center><h4><?php echo __('Pago Credi-Contado'); ?></h4></center></legend>
    <div class="row" id="credicontado"> 
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8">                                
                <?php echo $this->Form->input('totalventa', array('id' => 'totalVenta', 'value' => $totalFacturar, 'readonly' => 'readonly', 'class' => 'form-control numericPrice'))?><br>                             
                <?php echo $this->Form->input('contado', array('id' => 'pagoContado', 'value' => '', 'class' => 'form-control numericPrice', 'onblur' => 'calcularPagoContado()'))?><br>
                <?php echo $this->Form->input('credito', array('label' => 'Crédito', 'id' => 'pagoCredito', 'value' => '', 'class' => 'form-control numericPrice', 'onblur' => 'calcularPagoCredito()'))?>
        </div>
        <div class="col-md-2">&nbsp;</div>
    </div><br><br>
    <button id="btn_facturar" class="btn btn-primary center-block" onclick="validarCrediContado();">Facturar</button>