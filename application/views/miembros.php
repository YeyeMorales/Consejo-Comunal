    <div class='container content_middle'>

      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Crear Miembros del Consejo Comunal</h3>
          </div>
          <div class="panel-body">
            <div id="container" name="container" class="vertical-align" style="height: 450px;">
              <?php $atributos = array('id' => 'createForm', 'autocomplete' => 'off', );
                echo form_open('miembros/create', $atributos); ?> 
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                          <?php echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $id, 'type'=>'hidden'));     
                           echo form_input(array('name' => 'nombre', 'class' => 'form-control', 'id' => 'nombre', 'size' => '20','minlength'=>'3', 'maxlength'=>'30',  'autocomplete'=>'off', 'placeholder'=>'Nombre del Miembro' ,'value' => $nombre, 'aria-describedby'=>'sizing-addon2')); ?>     
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="apellido" class="control-label">Apellido</label>
                      <?php echo form_input(array('name' => 'apellido', 'class' => 'form-control', 'id' => 'apellido','minlength'=>'6', 'maxlength'=>'10', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Apellido del Miembro' ,'value' => $apellido, 'aria-describedby'=>'sizing-addon2')); ?> 
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
                      <label for="telefono" class="control-label">Teléfono</label>
                      <?php echo form_input(array('name' => 'telefono', 'class' => 'form-control', 'id' => 'telefono','minlength'=>'6', 'maxlength'=>'30', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Teléfono Personal' ,'value' => $telefono, 'aria-describedby'=>'sizing-addon2')); ?> 
                    </div>
                  </div> 

                  <div class="col-md-4">  
                  <div class="form-group">
                    <label for="Grupo" class="control-label">Comisión</label>
                    <select class="form-control" id="comisionid" name="comisionid" >
                      <option value="default" selected="selected" >Seleccione tipo</option>
                      <?php 
                        foreach($comision as $row){ ?>
                        <option value="<?= $row->id?>" ><?= $row->nombre_comision ?></option>
                      <?php  } ?>
                    </select>
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
