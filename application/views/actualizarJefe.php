<?php if(!empty($jefe_familia)){
  foreach ($jefe_familia as $fila):
    $id = $fila->id;
    $nombres = $fila->nombres;
    $apellidos = $fila->apellidos;
    $fecha_nac = $fila->fecha_nac;
    $cedula = $fila->cedula;
    $telefono = $fila->telefono;
    $profesion = $fila->profesion;
    $oficio = $fila->oficio;
   
  endforeach;
}else{
  $id = "";
  $nombres = "";
  $apellidos = "";
  $fecha_nac = "";
  $cedula = "";
  $telefono = "";
  $profesion = "";
  $oficio = "";
 
}
?>


    <div class='container content_middle'>

      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Actualizar Datos del Jefe de Familia</h3>
          </div>
          <div class="panel-body">
            <div id="container" name="container" class="vertical-align" style="height: 450px;">
             <?php $atributos = array('id' => 'createForm',  'class'=>'', 'autocomplete' => 'off', );
           echo form_open('jefe/update', $atributos); ?>  
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                    <label for="nombres" class="control-label">Nombres</label>
                    <?php echo form_input(array('name' => 'id', 'id' => 'id','maxlength'=>'100', 'value' => $id, 'type'=>'hidden'));                      
                     echo form_input(array('name' => 'nombres', 'class' => 'form-control', 'id' => 'nombres', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Nombres' ,'value' => $nombres, 'aria-describedby'=>'sizing-addon2')); ?>
                  </div>
              </div>

            <div class="col-md-3">
                <div class="form-group">
                  <label for="apellidos" class="control-label">Apellidos</label>
                  <?php echo form_input(array('name' => 'apellidos', 'class' => 'form-control', 'id' => 'apellidos', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Apellidos' ,'value' => $apellidos, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="fecha_nac" class="control-label">Fecha de Nacimiento</label>
                    <div class='input-group'>
                    <?php echo form_input(array('name' => 'fecha_nac', 'class' => 'form-control datepicker', 'id' => 'fecha_nac', 'size' => '20', 'autocomplete'=>'off', 'placeholder'=>'Fecha de Nacimiento', 'value' => $fecha_nac, 'aria-describedby'=>'sizing-addon2')); ?>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>                
                </div>
            </div>
                       
            <div class="col-md-3">
                <div class="form-group">
                  <label for="cedula" class="control-label">Cédula de Identidad</label>
                  <?php echo form_input(array('name' => 'cedula','maxlength'=>'255', 'class' => 'form-control', 'id' => 'cedula', 'size' => '50',  'autocomplete'=>'off', 'placeholder'=>'Cédula de Identidad' ,'value' => $cedula, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="telefono" class="control-label">Télefono Principal</label>
                  <?php echo form_input(array('name' => 'telefono','maxlength'=>'255', 'class' => 'form-control', 'id' => 'telefono', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Teléfono personal' ,'value' => $telefono, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="profesion" class="control-label">Profesión</label>
                  <?php echo form_input(array('name' => 'profesion','maxlength'=>'255', 'class' => 'form-control', 'id' => 'profesion', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Profesion' ,'value' => $profesion, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>   
           <div class="col-md-3">
                <div class="form-group">
                  <label for="oficio" class="control-label">Ocupación</label>
                  <?php echo form_input(array('name' => 'oficio','maxlength'=>'255', 'class' => 'form-control', 'id' => 'oficio', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Ocupación' ,'value' => $oficio, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>
            <div class="col-md-3">  
            <div class="form-group">
              <label for="Grupo" class="control-label">¿Pertenece a alguna Comisión del Consejo Comunal?: </label>
            </div>
          </div> 
           <div class="col-md-3">  
            <div class="form-group">
                <select class="form-control" id="comisionid" name="comisionid" >
                    <option value="default" selected="selected" >Seleccione</option>
                      <?php 
                        foreach($comision as $row){ ?>
                    <option value="<?= $row->idcomision?>" ><?= $row->nombre_comision ?></option>
                      <?php  } ?>
                </select>
            </div>
          </div>     
    </div>
  </div>
   <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <?php echo anchor('jefe', 'Cancelar', 'class="btn btn-danger"');?>  
          </div> 
    <?php echo form_close(); ?>
</div>
</div>
<script>
(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
  });
  $('.spinner .btn:last-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
  });
})(jQuery);
  $('.datepicker').datepicker({
      language: "es",
      autoclose: true,
      format: 'yyyy-mm-dd',
      clearBtn: true
    });
</script>
</body>
</html>   