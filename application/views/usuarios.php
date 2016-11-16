    <div class='container content_middle'>

      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Crear Usuarios</h3>
          </div>
          <div class="panel-body">
            <div id="container" name="container" class="vertical-align" style="height: 450px;">
              <?php $atributos = array('id' => 'createForm', 'autocomplete' => 'off', );
                echo form_open('usuarios/create', $atributos); ?> 
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                          <?php echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $id, 'type'=>'hidden'));     
                           echo form_input(array('name' => 'nombre_usuario', 'class' => 'form-control', 'id' => 'nombre_usuario', 'size' => '20','minlength'=>'3', 'maxlength'=>'30',  'autocomplete'=>'off', 'placeholder'=>'Nombre del usuario' ,'value' => $nombre_usuario, 'aria-describedby'=>'sizing-addon2')); ?>     
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cedula" class="control-label">Cédula de Identidad</label>
                      <?php echo form_input(array('name' => 'cedula', 'class' => 'form-control', 'id' => 'cedula','minlength'=>'6', 'maxlength'=>'10', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Cédulad de Identidad' ,'value' => $cedula, 'aria-describedby'=>'sizing-addon2')); ?> 
                    </div>
                  </div> 

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="contrasena" class="control-label">Contraseña</label>
                      <?php echo form_password(array('name' => 'contrasena', 'class' => 'form-control', 'id' => 'contrasena','minlength'=>'6', 'maxlength'=>'30', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'contraseña' ,'value' => $contrasena, 'aria-describedby'=>'sizing-addon2')); ?> 
                    </div>
                  </div> 

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="contrasena_2" class="control-label">Confirmar Contraseña</label>
                      <?php echo form_password(array('name' => 'contrasena_2', 'class' => 'form-control', 'id' => 'contrasena_2','minlength'=>'6', 'maxlength'=>'30', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Confirme su contraseña' ,'value' => $contrasena_2, 'aria-describedby'=>'sizing-addon2')); ?>
                    </div>
                  </div> 

                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="email" class="control-label">Correo Electrónico</label>
                        <?php echo form_input(array('name' => 'email', 'maxlength'=>'100', 'class' => 'form-control', 'id' => 'email', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Correo Electrónico ej xxxxx@xxxx.com' ,'value' => $email, 'aria-describedby'=>'sizing-addon2')); ?>
                      </div>
                  </div> 
                   <div class="col-md-4">
                      <div class="form-group">
                        <label for="email" class="control-label">Confirmar Correo Electrónico</label>
                        <?php echo form_input(array('name' => 'email2', 'maxlength'=>'100', 'class' => 'form-control', 'id' => 'email2', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Correo Electrónico ej xxxxx@xxxx.com' ,'value' => $email, 'aria-describedby'=>'sizing-addon2')); ?>
                      </div>
                  </div> 
                </div> <!-- row -->
            </div>
            <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-danger">Guardar</button>
                        <?php echo anchor('usuarios', 'Cancelar', 'class="btn btn-primary"');?>  
                  </div>   
                <?php echo form_close(); ?>
          </div><!-- panel body -->
      </div>
    </div> <!-- container middle -->
</body>
</html>   
