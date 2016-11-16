<div class='container content_middle'>

  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title">Datos del Consejo Comunal</h3>
    </div>
    <div class="panel-body">
        <div id="container" name="container" class="vertical-align" style="height: 450px;">      
        <?php $atributos = array('id' => 'createForm',  'class'=>'', 'autocomplete' => 'off', );
         echo form_open('consejoc/create', $atributos); ?>  
         <div class="row">         
            <div class="col-md-3">
                <div class="form-group">
                  <label for="nombre" class="control-label">Nombre</label>
                  <?php echo form_input(array('name' => 'id', 'id' => 'id','maxlength'=>'100', 'value' => $id, 'type'=>'hidden'));                      
                   echo form_input(array('name' => 'nombre', 'class' => 'form-control', 'id' => 'nombre', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'Nombre del Consejo Comunal' ,'value' => $nombre, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>

             <div class="col-md-3">
                <div class="form-group">
                  <label for="rif" class="control-label">R.I.F:</label>
                  <?php echo form_input(array('name' => 'rif','maxlength'=>'255', 'class' => 'form-control', 'id' => 'rif', 'size' => '50',  'autocomplete'=>'off', 'placeholder'=>'RIF del Consejo Comunal' ,'value' => $rif, 'aria-describedby'=>'sizing-addon2')); ?>
                </div>
            </div>
<!--Distribución-->
            <div class="col-md-3">                 
                <div class="form-group">
                <label>Estado</label> 
                    <select class="form-control" id="estado" name="estado" >
                      <option value="default" selected="selected" >SELECCIONE</option>
                      <?php 
                        foreach($estados as $row){ ?>
                        <option value="<?php echo $row->id?>" ><?php echo ucwords(strtolower($row->nombre_estado)); ?></option>
                      <?php  } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Municipio</label> 
                    <select class="form-control" id="municipio" name="municipio" disabled>
                        <option value="default" selected="selected" >SELECCIONE</option>
                    </select>
              </div>
            </div>                            
            
            <div class="col-md-3">
               <div class="form-group">
                <label> Parroquia</label> 
                <select class="form-control m-b" id="parroquia" name="parroquia" disabled>
                        <option value="default" selected="selected" >SELECCIONE</option>
                    </select>
              </div>
            </div>   

            <div class="col-md-3">
              <div class="form-group sector">
                <label>Sector</label> 
                <select class="form-control m-b" id="sector" name="sector" disabled>
                        <option value="default" selected="selected" >SELECCIONE</option>
                </select>
              </div>
            </div>     
          </div>            
<!--Distribución-->

        </div> 
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <?php echo anchor('consejoc', 'Cancelar', 'class="btn btn-danger"');?>  
          </div> 
      </div>  


    <?php echo form_close(); ?>
    </div>
  </div>

<script src="<?php base_url()?>/assets/js/distribucionSelect.js"></script>
<?php if(form_error('sector')){ ?>
    <script type="text/javascript">
    $(".sector").addClass("has-error");
    $(".sector").append( "<p style='color:#C00;' class='help-block'><?php echo form_error('sector'); ?></p>" );
    $(".sector p").slideUp(15000).delay(8000).fadeIn(4000).remove();
    </script>
<?php } ?>
</body>
</html>   
