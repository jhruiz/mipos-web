<?php $this->layout = 'inicio'; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#UsuarioUsername").focus();
    });
</script>
    
<div class="container">
    <br>
    <div class="row">       
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('Usuario',array('class' => 'form-horizontal', 'controller' => 'usuarios','action'=>'login')); ?>
        <div class="col-md-6">
            <div class="panel panel-primary">
            
                <div class="panel-heading">
                    <h3><?php echo __('Por favor ingrese su nombre de usuario y contraseña'); ?></h3>
                </div>     
                <div class="panel-body">
                    <div class="form-group">   
                        <?php echo $this->Form->input('username',array('label' => 'Usuario', 'class' => "form-control", 'placeholder' => 'Usuario'));?>
                    </div>


                    <div class="form-group"> 
                        <?php echo $this->Form->input('password',array('label' => 'Contraseña: ', 'class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Password'));?>
                    </div>

                    <div class="form-group">            
                            <?php echo $this->Form->input('isLogin',array('id' => 'isLogin',  'type' => 'hidden','value' => true));?>
                    </div>

                    <div class="form-group">
                        <div class="col-md-1">
                        <?php echo $this->Form->submit('Ingresar',array('class'=>'btn btn-primary'));?>   
                        </div>
                    </div>                
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
