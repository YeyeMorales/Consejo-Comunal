<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php base_url();?>/assets/js/searchItems.js"></script>
<script src="<?php base_url();?>/assets/js/pagerTable.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	function confirmar(){
		if(!confirm("¿Desea eliminar el Consejo Comunal seleccionado? \nRecuerde que solo podrá eliminarla si no tiene registros asociados")) return false;
	}
	$(document).ready(function(){ 
		$('[data-toggle="tooltip"]').tooltip();   
		$('#usuarioTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:8});  
	});
 </script>

	<div class='container content_middle'>   
  	  <div class="panel panel-danger">
		  <div class="panel-heading">
		    <h3 class="panel-title">Datos del Consejo Comunal</h3>
		  </div>
		  <div class="panel-body">
		  	 <div id="container" name="container" class="vertical-align" style="height: 450px;">
		    <div class = 'col-md-12'>
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
   <?php if(!empty($warning)){?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
            <?php echo $warning; ?>
          </div>
  <?php } ?>
		    </div>
		    <div class = 'col-md-12'>
		    	<div class="panel panel-danger">
 			 		<div class="table-responsive">

					<table data-height="350" class="footable table table-striped table-responsive" >
					  	<thead >
							<tr class="danger">
								<th style="border: hidden" data-hide="expand" class="col-sm-1">Opciones</th>						
								<th style="border: hidden" data-hide="expand" class="col-sm-1">Nombre</th>
								<th style="border: hidden" data-hide="phone,tablet" class="col-sm-1">R.I.F</th>
								<th style="border: hidden" data-hide="phone,tablet" class="col-sm-1">Sector</th>
	 
							</tr>	
					    </thead>
			    	<tbody tbody id="usuarioTable">

			    		<?php 
			    			if(!empty($consejo)){
								foreach ($consejo as $fila): ?>
									<tr>
										<td style="border: hidden">
											<div class="row">
												<div class="form-group">
													<div class="btn-group" role="group" style="padding-left:10px">
															<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
															echo form_open('consejoc/actualizaConsejo', $atributos);
															echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
															<button data-toggle="tooltip" data-placement="top" title="Editar" type="submit" class="btn  btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>  
															<?php echo form_close(); ?>
													</div>
													<div class="btn-group" role="group">
														<?php $atributos = array('id' => 'deletForm', 'autocomplete' => 'off', );
														echo form_open('consejoc/delete', $atributos);
														echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
														<button data-toggle="tooltip" data-placement="top" title="Eliminar" type="submit" onClick="if(confirmar() == false) return false" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>  
														<?php echo form_close(); ?>
													</div>
												</div>
											</div>
										</td>
										<td style="border: hidden"><div><?php echo $fila->nombre; ?></div></td>
										<td style="border: hidden"><div><?php echo $fila->rif; ?></div></td>
										<td style="border: hidden"><div><?php echo $fila->nombre_sector; ?></div></td>										
									</tr>
								<?php endforeach;
							}

			    		?>
					<tbody>
				  </table>
				</div>
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