<?php 
  if(!empty($usuarios)){
    foreach ($usuarios as $fila):
      $id = $fila->id;
      $cedula = $fila ->cedula;
      $nombre_usuario = $fila->nombre_usuario;
      $email = $fila->email;
    endforeach;
  }else{
    $id = "";
    $cedula = $fila ->cedula;
    $nombre_usuario = "";
    $email = "";
  }
?>

    <div class='container content_middle'>

      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Actualizar Usuarios</h3>
          </div>
          <div class="panel-body">
            <div id="container" name="container" class="vertical-align" style="height: 450px;">       
          
              <?php
                if(form_error('nombre_usuario')){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <?php echo form_error('nombre_usuario'); ?>.
                  </div>
              <?php } ?>
              

              <?php
                if(form_error('cedula')){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo form_error('cedula'); ?>.
                  </div>
              <?php } ?>

              <?php
                if(form_error('email')){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo form_error('email'); ?>.
                  </div>
              <?php } ?>


            <?php $atributos = array('id' => 'createForm', 'autocomplete' => 'off', );
              echo form_open('usuarios/update', $atributos); ?> 
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="nombre" class="control-label">Nombre</label>
                        <?php echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $id, 'type'=>'hidden'));     
                         echo form_input(array('name' => 'nombre_usuario', 'class' => 'form-control', 'id' => 'nombre_usuario', 'size' => '20', 'maxlength'=>'30',  'autocomplete'=>'off', 'placeholder'=>'Nombre del usuario' ,'value' => $nombre_usuario, 'aria-describedby'=>'sizing-addon2')); ?>     
                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cedula" class="control-label">Cédula de Identidad</label>
                    <?php echo form_input(array('name' => 'cedula', 'class' => 'form-control', 'id' => 'cedula','minlength'=>'6', 'maxlength'=>'30', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Cédulad de Identidad' ,'value' => $cedula, 'aria-describedby'=>'sizing-addon2')); ?> 
                  </div>
                </div> 

                <div class="col-md-4">
                    <div class="form-group">
                      <label for="email" class="control-label">Correo Electrónico</label>
                      <?php echo form_input(array('name' => 'email', 'maxlength'=>'100', 'class' => 'form-control', 'id' => 'email', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Correo Electrónico ej xxxxx@xxxx.com' ,'value' => $email, 'aria-describedby'=>'sizing-addon2')); ?>
                    </div>
                </div> 
              </div> <!-- row -->
          </div><!-- panel body -->
          <div class="col-md-12 text-right">
               <button type="submit" class="btn btn-danger">Guardar</button>
                <?php echo anchor('usuarios', 'Cancelar', 'class="btn btn-primary"');?>  
            </div>  
        <?php echo form_close(); ?>
      </div>
            
    </div> <!-- container middle -->
  </div>
</body>
</html>   
