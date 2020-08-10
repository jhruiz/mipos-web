<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>        
        <title>MiPOS</title>        
        <?php
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0',  'http-equiv' => "X-UA-Compatible"));
        echo $this->Html->meta('icon');
        
        echo $this->Html->css(array('./StyleLayout', 'StyleTable'));
        echo $this->Html->css('bootstrap.min.css', array('rel' => 'stylesheet', 'media' => 'all'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->script('jquery-1.10.2');
        echo $this->Html->script('bootstrap.min');        
//        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('jquery-ui/js/jquery-ui-1.10.3.custom.min');
        echo $this->Html->script('bootbox.min.js');
        echo $this->Html->css('jquery-ui-css/redmond/jquery-ui.css');
        /** Adicionamos la librería para el menu * */
        echo $this->Html->css('menu');
        echo $this->Html->script('menu');

        /*         * * Adicionamos librería para menu vertical * */
        echo $this->Html->script('menu_vert/jquery.easing.1.3');
        echo $this->Html->script('menu_vert/script_menu_vert');
        echo $this->Html->css('style_menu_vert');

        /*         * * Adicionamos funciones para mostrar modal ** */
        echo $this->Html->script('modalCargar');

        /*         * * Adicionamos funciones utiles para html** */
        echo $this->Html->script('jquery_number/jquery.number');
        echo $this->Html->script('utilsjs/utilsElementosHTML');
        echo $this->Html->script('layout/inicio');
        ?>     
        

        <style type="text/css">
            
            
            
body{ 
    background: transparent url("http://mipos.com.co/img/bg1.jpg") no-repeat top center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover; }  
            
            
            div.container-fluid {
                margin: 20px 10px 10px 10px;
            }

            label {
                float: left;
                width: 75px;
                display: block;
                clear: left;
                text-align: left;
                cursor: hand;
            }

            .buttonC { /* clase general */
              border: 1px solid #dedede;
              border-radius: 3px;
              color: #555;
              display: inline-block;
              font: bold 12px/12px HelveticaNeue, Arial;
              padding: 8px 19px;
              text-decoration: none;
            }

            .buttonC.white{
              background: #f5f5f5;
              border-color: #dedede #d8d8d8 #d3d3d3;
              box-shadow: 0 1px 1px #eaeaea, inset 0 1px 0 #fbfbfb;
              color: #555;
              text-shadow: 0 1px 0 #fff;
              background: -moz-linear-gradient(top,  #f9f9f9, #f0f0f0);
              background: -webkit-linear-gradient(top,  #f9f9f9, #f0f0f0);
              background: o-linear-gradient(top,  #f9f9f9, #f0f0f0);
              background: ms-linear-gradient(top,  #f9f9f9, #f0f0f0);
              background: linear-gradient(top,  #f9f9f9, #f0f0f0);
              filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#f0f0f0');
            }           
            
body{margin-top:20px;}
.fa-fw {width: 2em;}                    

        </style>

    </head>
    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 hidden-print">
                        <?php if($logged_in):?>
                        <?php $urlImagen = "http://mipos.com.co/imagenesCloud/imgUsuario/";?>
                            <?php if($current_user['imagen'] == ""){?>
                                <?php echo $this->Html->image('png/user-6.png', array('alt' => 'CakePHP', 'width' => '135', 'height' => '130', 'class' => 'img-responsive img-circle center-block')); ?>  
                            <?php }else{?>
                                <img style="float:left" src="<?php echo $urlImagen . $current_user['id'] . '/' . $current_user['imagen'];?>" class="img-responsive img-circle center-block" width="60" height="60" >
                            <?php }?>
                        <?php endif;?>
                        <?php // echo $this->Html->image('cloud.jpg', array('alt' => 'CakePHP', 'width' => '200px', 'class' => 'img-responsive')); ?>                        
                    </div>
                    
                    <div class="col-xs-4 col-sm-4 col-md-8 hidden-print">
                    	<?php if ($logged_in): ?>
                    		<?php echo $this->Html->image('MiPOS.png', array('alt' => 'CakePHP', 'width' => '135', 'height' => '130', 'style' => 'float:left', 'class' => 'img-responsive center-block'))?>
                    	<?php endif; ?>
                    </div>                    
                    
                    <div class="col-xs-4 col-sm-4 col-md-1 hidden-print">                        
                        <?php if ($logged_in): ?>                        
                        <input type="hidden" id="user-id" value="<?php echo $current_user['id'] ?>" />
                        <input type="hidden" id="tipoperfiluser_id" value="<?php echo $current_user['Perfile']['descripcion'] ?>" />  
                        <input type="hidden" id="perfiluser_id" value="<?php echo $current_user['Perfile']['id'] ?>" />  
                        <?php endif; ?>                        
                    </div>
                    <?php if ($logged_in): ?>
                    <div class="col-md-1 hidden-print">
                        <?php echo $this->Html->link("Salir", array('controller' => 'usuarios','action'=> 'logout'), array( 'class' => 'button btn btn-danger', 'style' => 'color:white;'))?> 
                    </div>
                    <?php endif; ?>  
                </div>
            </div>
        </header>
        <div class="container-fluid">
            <section class="main row">
                <div class="hidden-xs col-sm-4 col-md-3 hidden-print"> 
                    
                    <?php       	
                    if($logged_in){                    
                    ?>
                        <div id='menuUsr'>
                        </div>

                    <?php
                    }
                    ?>                     
                </div> 
                
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <?php if ($flash = $this->Session->flash()) { ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php echo $flash ?></strong>
                        </div>
                    <?php } ?>

                    <?php echo $this->fetch('content'); ?>                 
                </div>
                <div class="clearfix visible-sm-block"></div>
            </section>
        </div>
        <footer class="hidden-print">
            <hr class="lineas">
            <div class="container-fluid">                
                <script type="text/javascript">
                    function startTime() {
                        today = new Date();
                        h = today.getHours();
                        m = today.getMinutes();
                        s = today.getSeconds();
                        m = checkTime(m);
                        s = checkTime(s);
                        document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s;
                        t = setTimeout('startTime()', 500);
                    }
                    function checkTime(i)
                    {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }
                    window.onload = function() {
                        startTime();
                    }
                </script>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-9">
                            <?php echo $this->Html->image('footcloud.png', array('alt' => 'CakePHP', 'width' => '80px')); ?>                           
                    </div>
                    <div class="text-primary col-xs-12 col-sm-4 col-md-3"> 
                        <div id="reloj" style="font-size:20px;"></div>
                        <script type="text/javascript">
                            var date = new Date();
                            var d = date.getDate();
                            var day = (d < 10) ? '0' + d : d;
                            var m = date.getMonth() + 1;
                            var month = (m < 10) ? '0' + m : m;
                            var yy = date.getYear();
                            var year = (yy < 1000) ? yy + 1900 : yy;
                            document.write(day + "/" + month + "/" + year);
                        </script>                    
                    </div>                      
                </div>                
            </div>            
        </footer>
        <input class="hidden-print" type="hidden" id="url-proyecto" value="<?php echo $this->Html->url('/', true) ?>" />
        <div class="hidden-print" id="copyright" style="display: none;" >Copyright &copy; 2013 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>
    </body>
</html>
