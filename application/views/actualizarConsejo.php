<?php 
  if(!empty($consejo)){
    foreach ($consejo as $fila):
      $id = $fila->id;
      $rif = $fila ->rif;
      $nombre = $fila->nombre;
      $n_sector = $fila->n_sector;
    endforeach;
  }else{
    $id = "";
    $rif = $fila ->cedula;
    $nombre= "";
    $n_sector = "";
  }
?>

    <div class='container content_middle'>

      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Actualizar datos del Consejo Comunal</h3>
          </div>
          <div class="panel-body">
           <div id="container" name="container" class="vertical-align" style="height: 450px;">      
              <?php
                if(form_error('nombre')){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <?php echo form_error('nombre'); ?>.
                  </div>
              <?php } ?>           
              <?php
                if(form_error('rif')){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo form_error('rif'); ?>.
                  </div>
              <?php } ?>

              <?php
                if(form_error('n_sector')){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo form_error('n_sector'); ?>.
                  </div>
              <?php } ?>
              
            <?php $atributos = array('id' => 'createForm', 'autocomplete' => 'off', );
              echo form_open('consejoc/update', $atributos); ?> 
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="nombre" class="control-label">Nombre del Consejo Comunal</label>
                        <?php echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $id, 'type'=>'hidden'));     
                         echo form_input(array('name' => 'nombre', 'class' => 'form-control', 'id' => 'nombre', 'size' => '20', 'maxlength'=>'30',  'autocomplete'=>'off', 'placeholder'=>'Nombre del Consejo Comunal' ,'value' => $nombre, 'aria-describedby'=>'sizing-addon2')); ?>     
                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cedula" class="control-label">R.I.F</label>
                    <?php echo form_input(array('name' => 'rif', 'class' => 'form-control', 'id' => 'rif','minlength'=>'6', 'maxlength'=>'30', 'size' => '20',  'autocomplete'=>'off', 'placeholder'=>'R.I.F' ,'value' => $rif, 'aria-describedby'=>'sizing-addon2')); ?> 
                  </div>
                </div> 

<!--Distribución-->
            <div class="col-md-4">                 
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
            <div class="col-md-4">
              <div class="form-group">
                <label>Municipio</label> 
                    <select class="form-control" id="municipio" name="municipio" disabled>
                        <option value="default" selected="selected" >SELECCIONE</option>
                    </select>
              </div>
            </div>                            
            
            <div class="col-md-4">
               <div class="form-group">
                <label> Parroquia</label> 
                <select class="form-control m-b" id="parroquia" name="parroquia" disabled>
                        <option value="default" selected="selected" >SELECCIONE</option>
                    </select>
              </div>
            </div>   

            <div class="col-md-4">
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
                      <button type="submit" class="btn btn-danger">Guardar</button>
                      <?php echo anchor('usuarios', 'Cancelar', 'class="btn btn-primary"');?>  
                </div>   

              </div> <!-- row -->
              <?php echo form_close(); ?>
          </div><!-- panel body -->
    </div> <!-- container middle -->
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
