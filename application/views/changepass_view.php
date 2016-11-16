<div class='container content_middle'>
  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title">Cambiar Contraseña</h3>
    </div>
    <div class="panel-body">
      <?php $atributos = array('id' => 'formpw', 'autocomplete' => 'off');
        echo form_open('/usuarios/changepass', $atributos); ?>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="antipw" class="control-label">Contraseña actual</label>
            <?php echo form_password(array('name' => 'antipw', 
                              'class' => 'form-control', 
                              'id' => 'antipw',
                              'placeholder'=>'Contraseña actual' ,
                              'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
      </div>      
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="pwnew1" class="control-label">Nueva Contraseña</label>
            <?php echo form_password(array('name' => 'pwnew1', 
                              'class' => 'form-control', 
                              'id' => 'pwnew1',
                              'placeholder'=>'Nueva contraseña' ,
                              'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
      </div>      
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="pwnew2" class="control-label">Confirmar Contraseña</label>
            <?php echo form_password(array('name' => 'pwnew2', 
                              'class' => 'form-control', 
                              'id' => 'pwnew2', 
                              'placeholder'=>'Repita su nueva contraseña' ,
                              'aria-describedby'=>'sizing-addon2')); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <?php echo form_submit('','Cambiar','class="btn btn-primary"')?>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div><!-- panel body -->
  </div>
</div> <!-- container middle -->
<?php include 'footer.php';?>
</body>
<?php 
  if(!empty($pwsuccess)){
    echo "<script type='text/javascript'> 
      $(document).ready(function() {
        toastr.success('$pwsuccess', 'Cambio Realizado');
      });
    </script>";
    }elseif (!empty($pwerror)) {
      echo"<script type='text/javascript'>
        $(document).ready(function() {
          toastr.error('$pwerror', 'Error');
        });
      </script>";
    } 

  if (form_error('antipw')) { 
    $data = form_error('antipw');
    echo" <script type='text/javascript'> 
            $(document).ready(function() {
              event.preventDefault();
              $('#antipw').closest('.form-group').addClass('has-error');
              toastr.error('$data', 'Error');
            });
          </script>";
  } 
  
  if (form_error('pwnew1')) {
    $data = form_error('pwnew1');
    echo"<script type='text/javascript'>
          $(document).ready(function() {
            event.preventDefault();
            $('#pwnew1').closest('.form-group').addClass('has-error');
            toastr.error('$data', 'Error');
          });
        </script>";
  }

  if (form_error('pwnew2')) {
    $data = form_error('pwnew2');
    echo"<script type='text/javascript'>
          $(document).ready(function() {
            event.preventDefault();
            $('#pwnew2').closest('.form-group').addClass('has-error');
            toastr.error('$data', 'Error');
          });
        </script>";
  } 
  ?>
</html>