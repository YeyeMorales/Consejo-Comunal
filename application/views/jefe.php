<script src="<?php base_url();?>/assets/js/validate.js"></script>

<div class='container content_middle'>
  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title">Datos del Jefe de Familia</h3>
    </div>
    <div class="panel-body">
     <div id="container" name="container" class="vertical-align" style="height: 450px;">
      <?php $atributos = array('id' => 'jefeFamilia', 'autocomplete' => 'off', 'novalidate');
        echo form_open('/jefe/create', $atributos); ?> 
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <?php 
                  echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $id, 'type'=>'hidden'));              
                  echo form_input(array('name' => 'nombres', 'class' => 'form-control', 'id' => 'nombres', 'size' => '50', 'autocomplete'=>'off', 'placeholder'=>'Nombres', 'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <?php               
                  echo form_input(array('name' => 'apellidos', 'class' => 'form-control', 'id' => 'apellidos', 'size' => '50',  'autocomplete'=>'off',  'placeholder'=>'Apellidos', 'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
        <div class="col-md-4" >
          <div class="form-group">
            <div class='input-group'>
              <?php echo form_input(array('name' => 'fecha_nac', 'class' => 'form-control datepicker', 'id' => 'fecha_nac', 'size' => '20', 'autocomplete'=>'off', 'placeholder'=>'Fecha de nacimiento', 'aria-describedby'=>'sizing-addon2')); ?>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group">
            <?php echo form_input(array('name' => 'cedula', 'class' => 'form-control', 'id' => 'cedula',  'placeholder'=>'Cédula de Identidad' , 'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
          <div class="col-md-4">
          <div class="form-group">
            <?php echo form_input(array('name' => 'telefono', 'class' => 'form-control', 'id' => 'telefono', 'placeholder'=>'Teléfono Personal' , 'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <?php echo form_input(array('name' => 'profesion', 'class' => 'form-control', 'id' => 'profesion', 'placeholder'=>'Profesión' , 'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
          <div class="col-md-4">
          <div class="form-group">
            <?php echo form_input(array('name' => 'oficio', 'class' => 'form-control', 'id' => 'oficio',  'placeholder'=>'Oficio', 'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
          <div class="col-md-4">  
            <div class="form-group">
              <label for="Grupo" class="control-label">¿Pertenece a alguna Comisión del Consejo Comunal?: </label>
            </div>
          </div> 
           <div class="col-md-4">  
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
      </div><!-- row -->
      <div class="col-md-12 text-right">
          <?= form_submit('','Guardar','class="btn btn-primary"')?>          
          <?php echo anchor('jefe', 'Cancelar', 'class="btn btn-danger"');?> 
        </div>
      <?php echo form_close(); ?>
    </div><!-- panel body -->
  </div>  

</div> <!-- container middle -->
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
