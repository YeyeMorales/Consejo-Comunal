<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php base_url();?>/assets/js/searchItems.js"></script>
<script src="<?php base_url();?>/assets/js/pagerTable.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	function confirmar(){
		if(!confirm("¿Está Seguro de Eliminar el Usuario?")) return false;
	}
	$(document).ready(function(){  
		$('[data-toggle="tooltip"]').tooltip(); 
		$('#usuarioTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:8});  
	});
</script>

<script src="<?php base_url();?>/assets/js/footable.js"></script>
<script type="text/javascript">
  $(function() {
    $('table').footable();
  });
</script>

</head>
<body>
	<div class='container content_middle'> 
		<div class="panel panel-danger">
		  <div class="panel-heading">
		    <h2 class="panel-title">Usuarios</h2>
		  </div>
		  <div class="panel-body">
            <div id="container" name="container" class="vertical-align" style="height: 450px;">		  	
		   <div class = "col-md-12">
      <!-- -->

  <?php if(!empty($satisfactorio)){?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php echo $satisfactorio; ?>.
          </div>
  <?php } ?>

    <?php if(!empty($fallo)){?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php echo $fallo; ?>.
          </div>
  <?php } ?>

<!-- -->
		   </div>
		   <div class = "col-md-12">
			<div class="panel panel-danger">
				  	<!-- Table -->
  			 <div class="table-responsive">
				  <table data-height="400" class="footable table table-striped table-responsive" >
				  	<thead>
						<tr>
							<th style="border: hidden" data-hide="expand" style="text-transform: capitalize;"class="col-sm-1">Opciones</th>
							<th style="border: hidden" data-class="expand" class="col-sm-2">Cédula de Identidad</th>
							<th style="border: hidden" data-hide="phone,tablet" style="text-transform: capitalize;"class="col-sm-2">Nombre de Usuario</th>
							<th style="border: hidden" data-hide="phone,tablet" style="text-transform: capitalize;"class="col-sm-2">Correo Electrónico</th>
						</tr>	
				    </thead>
			    	<tbody tbody id="usuarioTable">
			    		<?php 
			    			if(!empty($usuarios)){
								foreach ($usuarios as $fila): ?>
									<tr>
										<td style="border: hidden">
											<div class="row ">
												<div class="form-group">
													<div class="btn-group" role="group" style="padding-left:10px">
														<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
														echo form_open('usuarios/inicioUsuarios', $atributos);
														echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
														<button data-toggle="tooltip" data-placement="top" title="Editar" type="submit" class="btn  btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>  
														<?php echo form_close(); ?>
													</div>
													<div class="btn-group" role="group">
														<?php $atributos = array('id' => 'editForm', 'autocomplete' => 'off', );
														echo form_open('usuarios/delete', $atributos);
														echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
														<button data-toggle="tooltip" data-placement="top" title="Eliminar" type="submit" onClick="if(confirmar() == false) return false" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>  
														<?php echo form_close(); ?>
													</div>
												</div>
											</div>

										</td>
										<td style="border: hidden"><?php echo $fila->cedula; ?></td>
										<td style="border: hidden"><?php echo $fila->nombre_usuario; ?></td>
										<td style="border: hidden"><?php echo $fila->email; ?></td>
									</tr>
								<?php endforeach;
							}

			    		?>
					<tbody>
				  </table>
				</div>

		        <div class="col-md-12 text-center">
			      <ul class="pagination" id="myPager"></ul>
			      </div>
			</div>
		   </div>

		  </div>
		</div> 
	</div> 
	 </body>
</html>	