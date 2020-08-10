<?php echo ($this->Html->script('facturas/facturas.js')); ?>
<?php
    $this->layout='inicio';
?>
<div class="paginainicio index">
    <legend><h2 class="bg-primary"><b><?php echo __('Mi POS'); ?></b></h2></legend>
    <div class="container-fluid">                    
            <?php $contador = 6; $k = 0;?>
            <?php for($i = 0; $i < ceil(count($arrMenusPerfil)/6); $i++){?>
                <div class="row">
                    <?php for($k; $k < $contador; $k++){?>
                        <?php if (isset($arrMenusPerfil[$k])){?>
                            <div class="col-xs-6 col-sm-6 col-md-2">
                                <div class="thumbnail">
                                    <a href="<?php echo $urlPublica . $arrMenusPerfil[$k]['Cloudmenu']['url']; ?>">
                                        <img id="img1" src="<?php echo $urlImagMenu . $arrMenusPerfil[$k]['Cloudmenu']['imagen'];?>" class="img-responsive"  height="100" width="150">
                                    </a>     
                                    <div class="caption">
                                        <a href="<?php echo $urlPublica . $arrMenusPerfil[$k]['Cloudmenu']['url']; ?>">
                                            <strong><?php echo $arrMenusPerfil[$k]['Cloudmenu']['descripcion']?></strong>
                                        </a>           
                                    </div>                
                                </div>                                                                                                                                                                                             
                            </div>
                        <?php } ?>
                    <?php } $contador = $contador + 6;?>
                </div>
            <?php }?>
        <div class="clearfix visible-sm-block"></div>
    </div>
</div>