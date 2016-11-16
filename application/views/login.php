<?php include 'header.php';?>

<?php $frm = array (
    'id' => 'frmContacto'
);
$frm_enviar = array (
    'name' => 'submit',
    'id' => 'frSubmit',
    'value' => 'Enviar',
    'class' => 'submit'
);?>


<body  oncontextmenu='return false'>
<!--- start-header-->
<div class="container">

  <!--start-header-->

        <div class="col-md-4 col-sm-8 col-xs-6">
          <div class="row">
            <div class="panel panel-danger">
              <div class="panel-heading">Ingresar</div>
              <div class="panel-body">
                          <!-- inicio donde va las cajas de login -->          
                <div class="col-md-10">
                        <?php
                            if($this->session->flashdata('usuario_incorrecto')){?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <?php echo $this->session->flashdata('usuario_incorrecto'); ?>
                          </div>
                            <?php } ?>
                          
                        <?php 
                          $atributos = array('id' => 'loginForm', 'autocomplete' => 'off');
                          echo form_open('inicio', $atributos); 
                        ?> 

                      <span class="error-block"></span> 
                      <div class="form-group">  
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                          
                          <?php echo form_input(array('name' => 'usuario', 'class' => 'form-control', 'id' => 'usuario', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Usuario')); ?>
                                    
                        </div>
                      </div>
                      <span class="help-block"></span>
                      <div class="form-group">          
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                          <?php echo form_password(array('name' => 'contrasena', 'class' => 'form-control','id' => 'contrasena','size' => '20','placeholder'=>'Contraseña', 'autocomplete'=>'off')); ?>
                        </div>
                      </div>

                     
                   <span class="help-block"></span> 
                    <div>
                       <button class="btn btn-lg btn-danger btn-block" type="submit">Iniciar Sesión</button>
                    </div>
                    <span class="help-block"></span> 
                    <?php echo form_close(); ?> 
                  <!-- fin donde va las cajas de login -->          
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

<!-- Scripts-->
<script src="<?php base_url();?>/assets/js/jquery/jquery-1.11.2.min.js"></script>
<script src="<?php base_url();?>/assets/js/jquery/jquery-validate.js"></script>
<script src="<?php base_url();?>/assets/js/toastr.js"></script>
<script src="<?php base_url();?>/assets/js/bootstrap/bootstrap.min.js"></script>

<script src="<?php base_url();?>/assets/js/validatorLogin.js"></script>
<script type="application/x-javascript"> 
  {
  if(history.forward(1))
  location.replace(history.forward(1))
  }
  $(document).ready(function(){  
    $('[data-toggle="tooltip"]').tooltip() 
  });
      </script>
</body>
</html>
