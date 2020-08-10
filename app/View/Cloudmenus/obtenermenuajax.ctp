<?php echo ($this->Html->script('obtenermenu/obtenermenu.js')); ?>
<?php if (count($menuUsr) > '0'){?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="<?php echo $urlPublica . '/usuarios/paginainicio'?>"><b>HOME</b></a></li>
                <?php foreach ($menuUsr as $menu): ?>
                
                <li id = "menuvert_<?php echo ($menu['Cloudmenu']['id']); ?>" class="menuvert">                    
                    <a href="<?php echo $urlPublica . $menu['Cloudmenu']['url']; ?>">
                        <div class"bg-primary text-white">
                            <b><img id="img1" src="<?php echo $urlImagMenu . $menu['Cloudmenu']['imagen'];?>" class="img-responsive img-circle center-block" width="25" height="25" style="float:left;"> <?php echo  $menu['Cloudmenu']['descripcion']?></b>
                        </div>                        
                    </a> 
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php } else {}?>
