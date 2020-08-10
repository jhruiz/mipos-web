<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('bandeja/gestionBandejas.js'));?>
<div class="index">
    
    <?php echo $this->Form->create('Facturas',array('action'=>'buscarcierre','method'=>'post'));?>
    <legend><h2 class="bg-primary"><b><?php echo __('Buscar Fecha de Cierre'); ?></b></h2></legend> 
    <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '32', 'id' => 'menuvert'))?>     
    <div class="row">
        <div class="col-md-3">
            <div class="form-group ">  
                <label>Fecha</label><br>                          
                <input name="data[Cierrediario][Fecha]" id="CierrediarioFecha" class="date form-control" placeholder="Fecha de Cierre" type="text">
            </div>             
        </div>       
        <div class="col-md-9">
            &nbsp;
        </div>                      
    </div><br>              
    <?php echo $this->Form->submit('Buscar',array('class'=>'btn btn-primary'));?>
    </form><br><br>    
    
    
	<legend><h2 class="bg-primary"><b><?php echo __('Detalle Cierre Diario: ' . $fechaCierre); ?></b></h2></legend>        
        <div class="table-responsive">
            <div class="container">        
                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                <tr>
                                <th><?php echo ('Consecutivo Factura'); ?></th>
                                <th><?php echo ('Cliente'); ?></th>
                                <th><?php echo ('Vendedor'); ?></th>
                                <th class="text-right"><?php echo ('Pago Contado'); ?></th>
                                <th class="text-right"><?php echo ('Pago Crédito'); ?></th>
                </tr>
                <?php foreach ($detFacts as $dFact): ?>
                <tr>
                    <?php if ($dFact['Factura']['consecutivodian'] == ""){?>
                    <td><?php echo h($dFact['Factura']['codigo']); ?>&nbsp;</td>
                    <?php }else{?>
                    <td><?php echo h($dFact['Factura']['consecutivodian']); ?>&nbsp;</td>
                    <?php }?>
                    <?php if($dFact['Factura']['cliente_id'] == ""){?>
                    <td><?php echo h($dFact['Factura']['nombrecliente']); ?>&nbsp;</td>
                    <?php }else{?>
                    <td><?php echo h($dFact['Cliente']['nombre'] . " - " . $dFact['Cliente']['nit']); ?>&nbsp;</td>
                    <?php } ?>                        
                    <td><?php echo h($dFact['Usuario']['nombre'] . " - " . $dFact['Usuario']['identificacion']); ?>&nbsp;</td>
                    <td align="right"><?php echo h('$' . number_format($dFact['Factura']['pagocontado'],2)); ?>&nbsp;</td>
                    <td align="right"><?php echo h('$' . number_format($dFact['Factura']['pagocredito'],2)); ?>&nbsp;</td>
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
                            <dt class="text-left text-success"><?php echo h("Venta Total: ");?></dt>
                            <dt class="text-left text-success"><?php echo h("Venta de Contado: ");?></dt>
                            <dt class="text-left text-success"><?php echo h("Venta a Crédito: ");?></dt>
                        </dl>
                    </div>         
                    <div class="col-md-2">                
                        <dl>
                            <dt class="text-right text-success"><?php echo h("$" . number_format(($totalContado + $totalCredito),2))?></dt>
                            <dt class="text-right text-success"><?php echo h("$" . number_format($totalContado,2))?></dt>
                            <dt class="text-right text-success"><?php echo h("$" . number_format($totalCredito,2))?></dt>
                        </dl>
                    </div>                     
                </div>
            </div>
        </div>
</div>