<?php $this->layout='inicio'; ?>
<?php echo ($this->Html->script('facturas/gestionfacturas.js'));?>
<div class="facturas view">
    <legend><h2 class="bg-primary"><b><?php echo __('FACTURA DE VENTA No. ' . $consecutivoFact) ?></b></h2></legend>
    <?php echo $this->Form->input('menuvert', array('type' => 'hidden', 'value' => '33', 'id' => 'menuvert'))?>
    <div class="container">      
        <input type="hidden" id="facturaId" value="<?php echo $infoFact['Factura']['id'];?>">
        <div class="btn-group">                    
            <button id="butImprimirFact" class="btn btn-primary hidden-print" onclick="imprimirFactura();">Imprimir Factura</button>
            <button id="butImprimirTicket" class="btn btn-primary hidden-print" onclick="imprimirTicket()">Imprimir Ticket</button>
            <!--<button id="butDescargarFact" class="btn btn-primary hidden-print" onclick="">Descargar Factura</button>-->
        </div>
    </div><br><br> 

    <div class="container">            
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">                                
                    <div class="col-md-4">
                        <?php if(isset($infoEmpresaRel)){?>
                            <dl>
                                <h3><dt><?php echo h($infoEmpresaRel['Relacionempresa']['nombre']);?></dt></h3>
                                <dt><?php echo h("Nit: " . $infoEmpresaRel['Relacionempresa']['nit']);?></dt>
                                <dt><?php echo h("Dirección: " . $infoEmpresaRel['Relacionempresa']['direccion']);?></dt>
                                <dt><?php echo h("Teléfono: " . $infoEmpresaRel['Relacionempresa']['telefono1']);?></dt> 
                                <dt><?php echo h("Correo Electrónico: " . $infoEmpresaRel['Relacionempresa']['email']);?></dt>
                            </dl>                        
                        <?php }else{?>
                            <dl>
                                <h3><dt><?php echo h($infoEmpresa['Empresa']['nombre']);?></dt></h3>
                                <dt><?php echo h("Nit: " . $infoEmpresa['Empresa']['nit']);?></dt>
                                <dt><?php echo h("Dirección: " . $infoEmpresa['Empresa']['direccion']);?></dt>
                                <dt><?php echo h("Teléfono: " . $infoEmpresa['Empresa']['telefono1'] . " - " . $infoEmpresa['Empresa']['telefono2']);?></dt> 
                                <dt><?php echo h("Correo Electrónico: " . $infoEmpresa['Empresa']['email']);?></dt>
                            </dl>                        
                        <?php }?>
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4" id="divImg">
                        <?php if(isset($infoEmpresaRel)){?>
                            <img src="<?php echo $urlImg . $infoEmpresaRel['Relacionempresa']['empresa_id'] . '/' . $infoEmpresaRel['Relacionempresa']['imagen'];?>" class="img-responsive img-thumbnail center-block" width="135" height="135" >
                        <?php }else{?>
                            <img src="<?php echo $urlImg . $infoEmpresa['Empresa']['id'] . '/' . $infoEmpresa['Empresa']['imagen'];?>" class="img-responsive img-thumbnail center-block" width="135" height="135" >
                        <?php } ?>                        
                    </div>                   
                </div>
            </div>                                                                           
        </div>  
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-4">
                        <dl>
                            <dt><?php if(isset($infoFact['Factura'])){echo h("Fecha Factura: " . $infoFact['Factura']['created']);}?></dt>
                            <dt><?php if(isset($consecutivoFact)){echo h("Factura No.: " . $consecutivoFact);}?></dt>
                            <dt><?php if(isset($infoTipoPago['Tipopago'])){echo h("Tipo de Pago.: " . $infoTipoPago['Tipopago']['descripcion']);}?></dt>
                            <dt><?php if(isset($infoDetFact['0'])){echo h("Almacen: " . $infoDetFact['0']['Deposito']['descripcion']);}?></dt> 
                            <dt><?php if(isset($infoDetFact['0'])){echo h("Teléfono Almacen: " . $infoDetFact['0']['Deposito']['telefono']);}?></dt>
                            <dt><?php if(isset($infoDetFact['0'])){echo h("Dirección Almacen: " . $infoDetFact['0']['Deposito']['direccion']);}?></dt>                                
                        </dl>
                    </div>
                    <div class="col-md-4">
                        <?php if(!isset($infoFact['Cliente']['id'])){?>
                            <dl>
                                <dt><?php echo h("Nombre Cliente: " . $infoVentaRapida['Ventarapida']['cliente']);?></dt>
                                <dt><?php echo h("Nit/C.C: " . $infoVentaRapida['Ventarapida']['identificacion']);?></dt>
                                <dt><?php echo h("Teléfono: " . $infoVentaRapida['Ventarapida']['telefono']);?></dt>
                                <dt><?php echo h("Dirección: " . $infoVentaRapida['Ventarapida']['direccion']);?></dt>
                                
                            </dl>                                                
                        <?php }else{?>
                            <dl>
                                <dt><?php echo h("Nombre Cliente: " . $infoFact['Cliente']['nombre']);?></dt>
                                <dt><?php echo h("Nit/C.C: " . $infoFact['Cliente']['nit']);?></dt>
                                <dt><?php echo h("Teléfono: " . $infoFact['Cliente']['telefono'] . ' - ' . $infoFact['Cliente']['celular']);?></dt>
                                <dt><?php echo h("Dirección: " . $infoFact['Cliente']['direccion']);?></dt>
                                <dt><?php echo h("Total Cartera: $" . number_format($totalCartera,2));?></dt>
                            </dl>                           
                        <?php }?>
                    </div>
                    <div class="col-md-4">
                        <dl>
                            <dt><?php echo h("Vendedor: " . $infoVendedor['Usuario']['nombre']);?></dt>
                            <dt><?php echo h("Nit/C.C: " . $infoVendedor['Usuario']['identificacion']);?></dt><br>
                            <dt><?php //echo h("Pago de Contado: $ " . number_format($infoFact['Factura']['pagocontado'],2));?></dt>
                            <dt><?php //echo h("Pago a Crédito: $ " . number_format($infoFact['Factura']['pagocredito'],2));?></dt><br>
                            <?php if (isset($infoFact['Factura']['fechavence']) && $infoFact['Factura']['fechavence'] != ""){?>
                            <dt><?php echo h("Vencimiento Factura: " . $infoFact['Factura']['fechavence']);?></dt>
                            <?php }?>                            
                        </dl>                          
                    </div>                                    
                </div>            
            </div>
        </div>
    </div>
    
    <div class="container" id="divTableTicket" style="display: none">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                                        
                        <?php if(isset($regimen['Regimene']) && $regimen['Regimene']['id'] == '2'){?>
		                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
		                    <tr class="info">
		                                    <th><?php echo ('DESCRIPCION (CANTIDAD)'); ?></th>
		                                    <th><?php echo ('VALOR TOTAL'); ?></th>
		                    </tr>
		                    <?php foreach ($infoDetFact as $DetFact): ?>
		                    <tr>
		                        <td><?php echo h($DetFact['Producto']['descripcion'] . "(" . $DetFact['Facturasdetalle']['cantidad'] . ")"); ?>&nbsp;</td>
		                        <td><?php echo h(number_format($DetFact['Facturasdetalle']['costototal'],0)); ?>&nbsp;</td>
		                    </tr>
		                    <?php endforeach; ?>                  
		                    <tr>
		                        <td><b>Subtotal</b></td>
		                        <td><?php echo (number_format($subTtalVent,0)); ?></td>                                                
		                    </tr>
		                    <tr>                        
		                        <td><b>IVA</b></td>
		                        <td><b><?php echo (number_format($iva,0));?></b></td>
		                    </tr>                    
		                    <tr>
		                        <td><b>TOTAL</b></td>
		                        <td><b><?php echo (number_format($tatalVentaIva,0));?></b></td>
		                    </tr>
		                </table> 
	                <?php }else{ ?>
		                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
		                    <tr class="info">
		                    		    <th><?php echo ('COD.'); ?></th>
		                                    <th><?php echo ('DESC (CANT)'); ?></th>
		                                    <th><?php echo ('TOTAL'); ?></th>
		                    </tr>
		                    <?php foreach ($infoDetFact as $DetFact): ?>
		                    <tr>
		                        <td><?php echo h($DetFact['Producto']['codigo']); ?>&nbsp;</td>
		                        <td><?php echo h($DetFact['Producto']['descripcion'] . "(" . $DetFact['Facturasdetalle']['cantidad'] . ")"); ?>&nbsp;</td>
		                        <td><?php echo h(number_format($DetFact['Facturasdetalle']['valorconiva'],0)); ?>&nbsp;</td>
		                    </tr>
		                    <?php endforeach; ?>                                     
		                    <tr>
		                        <td>&nbsp;</td>
		                        <td><b>TOTAL</b></td>
		                        <td><b><?php echo (number_format($tatalVentaIva,0));?></b></td>
		                    </tr>
		                </table>
		                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
		                    <tr>
		                        <td>Tipo</td>
		                        <td>B.I</td>
		                        <td>IVA</td>		                        
		                    </tr>
		                    <tr>
		                        <td><?php echo $infoDetFact['0']['Facturasdetalle']['baseiva'] . " = " . $infoDetFact['0']['Facturasdetalle']['iva']; ?></td>
		                        <td><?php echo number_format($subTtalVent,0); ?></td>
		                        <td><?php echo (number_format($iva,0));?></td>                                               
		                    </tr>		                
		                </table>	                 
	                <?php } ?>
	                
	                                              
                    </div>
                </div>
            </div>
        </div>
    </div>

    <legend>&nbsp;</legend>
<div class="container-fluid">
        <div class="table-responsive" id="divTable">
            <div class="container">
            <?php if(isset($regimen['Regimene']) && $regimen['Regimene']['id'] == '2'){?>
                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                    <tr class="info">
                                    <th><?php echo ('REFERENCIA'); ?></th>
                                    <th><?php echo ('DESCRIPCION'); ?></th>
                                    <th><?php echo ('CANTIDAD'); ?></th>
                                    <th><?php echo ('VALOR UNITARIO'); ?></th>
                                    <th><?php echo ('VALOR TOTAL'); ?></th>
                    </tr>
                    <?php foreach ($infoDetFact as $DetFact): ?>
                    <tr>
                        <td><?php echo h($DetFact['Producto']['codigo']); ?>&nbsp;</td>
                        <td><?php echo h($DetFact['Producto']['descripcion']); ?>&nbsp;</td>
                        <td><?php echo h($DetFact['Facturasdetalle']['cantidad']); ?>&nbsp;</td>
                        <td><?php echo h("$ " . number_format($DetFact['Facturasdetalle']['costoventa'],2)); ?>&nbsp;</td>
                        <td><?php echo h("$ " . number_format($DetFact['Facturasdetalle']['costototal'],2)); ?>&nbsp;</td>
                    </tr>
                    <?php endforeach; ?>                  
                    <tr>
                        <td>&nbsp;</td>
                        <td><b>Total Unidades</b></td>
                        <td><?php echo $ttalUnid; ?></td>
                        <td><b>Subtotal</b></td>
                        <td><?php echo "$ " . number_format($subTtalVent,2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td><b>IVA</b></td>
                        <td><b><?php echo ("$ ". number_format($iva,2));?></b></td>
                    </tr>                    
                    <tr>
                        <td colspan="3"></td>
                        <td><b>TOTAL</b></td>
                        <td><b><?php echo ("$ ". number_format($tatalVentaIva,2));?></b></td>
                    </tr>
                </table>
                <?php } else { ?> 
                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                    <tr class="info">
                                    <th><?php echo ('CÓDIGO'); ?></th>
                                    <th><?php echo ('DESCRIPCION'); ?></th>
                                    <th><?php echo ('CANTIDAD'); ?></th>
                                    <th><?php echo ('VALOR TOTAL'); ?></th>
                    </tr>
                    <?php foreach ($infoDetFact as $DetFact): ?>
                    <tr>
                        <td><?php echo h($DetFact['Producto']['codigo']); ?>&nbsp;</td>
                        <td><?php echo h($DetFact['Producto']['descripcion']); ?>&nbsp;</td>
                        <td><?php echo h($DetFact['Facturasdetalle']['cantidad']); ?>&nbsp;</td>
                        <td><?php echo h("$ " . number_format($DetFact['Facturasdetalle']['valorconiva'],2)); ?>&nbsp;</td>
                    </tr>
                    <?php endforeach; ?>                                    
                    <tr>
                        <td colspan="2"></td>
                        <td><b>TOTAL</b></td>
                        <td><b><?php echo ("$ ". number_format($tatalVentaIva,2));?></b></td>
                    </tr>                    
                </table> 
                <table cellpadding="0" cellspacing="0" class="table table-striped table-hover table-condensed">
                    <tr>
                        <td><b>TIPO</b></td>
                        <td>BASE IMPOSITIVA</td>
                        <td>IMP</td>
                    </tr>
                    <tr>
                        <td><?php echo $infoDetFact['0']['Facturasdetalle']['baseiva'] . " = " . $infoDetFact['0']['Facturasdetalle']['iva']; ?></td>
                        <td><?php echo "$ " . number_format($subTtalVent,2); ?></td>
                        <td><?php echo ("$ ". number_format($iva,2));?></td>
                    </tr>                                      
                </table>               
                <?php } ?>                               
            </div>
        </div>
</div>
    <?php if(count($notaFactura) > '0'){?>        
        <legend>&nbsp;</legend>
        <dl>
            <dt><?php echo __('Notas'); ?></dt>
                <?php foreach ($notaFactura as $nF): ?>
                <dd>
                    <?php echo h($nF['FacturasNotafactura']['created'] . " " . $nF['Usuario']['nombre'] . ".  " . $nF['Notafactura']['descripcion']); ?>
                    &nbsp;
                </dd>
                <?php endforeach;?>
        </dl>
    <?php }?>
    
    <legend>&nbsp;</legend>    
    <?php if(isset($infoEmpresaRel)){?>
        Código de la Factura No. <?php echo $infoFact['Factura']['codigo'];?>
    <?php }else if(isset($regimen['Regimene']) && $regimen['Regimene']['id'] == '1'){?>
        Resolución <?php echo ($DetFact['Deposito']['resolucionfacturacion'])?>. Fecha de Resolución <?php echo ($DetFact['Deposito']['fecharesolucion'])?>.
        Numeración habilitada del <?php echo ($DetFact['Deposito']['resolucioninicia']);?> al <?php echo ($DetFact['Deposito']['resolucionfin']);?>. Regimen <?php echo ($regimen['Regimene']['descripcion']);?>. <?php echo ($DetFact['Deposito']['nota']);?>. 
    <?php }else{ ?>
        Código de la Factura No. <?php echo $infoFact['Factura']['codigo'];?>
    <?php }?>
</div>
