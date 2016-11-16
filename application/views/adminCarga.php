<script src="<?php base_url();?>/assets/js/searchItems.js"></script>
<script src="<?php base_url();?>/assets/js/pagerTable.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	function confirmar(){
		if(!confirm("¿Desea adicionar un miembro a la familia de la persona seleccionada?")) return false;
	}
	$(document).ready(function(){ 
		$('[data-toggle="tooltip"]').tooltip();   
		$('#usuarioTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:8});  
	});
 </script>

	<div class='container content_middle'>   
		<div class="panel panel-danger">
		  <div class="panel-heading">
		    <h3 class="panel-title">Censo poblacional</h3>
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

  <?php if(!empty($info)){?>
          <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <?php echo $info; ?>
          </div>
  <?php } ?>
		    </div>
		    <div class="row">
				<div class='col-md-12' >
				<?php $atributos = array('id' => 'formfiltrar', 'autocomplete' => 'off', 'class' => 'form-inline' );
					echo form_open('carga/cargaFilter', $atributos);
				?>
					<div class="form-group">
						<div class="form-group">
			            <?php               
			                  echo form_input(array('name' => 'cedula', 'class' => 'form-control', 'id' => 'cedula', 'size' => '20',  'autocomplete'=>'off',  'placeholder'=>'Indique la Cédula', 'aria-describedby'=>'sizing-addon2')); ?>
			          </div>
					</div>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-seacrh" aria-hidden="true"></span>&nbsp;Buscar</button>
		            <?php echo anchor('carga', 'Limpiar', 'class="btn btn-danger"');?>  
				<?php echo form_close(); ?>
			</div>
		</div>
		</br>

		    <div class = 'col-md-12'>
		    	<div class="panel panel-danger">
		    		<!-- Table -->
<!--   			 <div class="table-responsive">

 -->  			 <div class="table-responsive">

<!-- 				  <table data-height="400" class="table table-striped  table-responsive" >
 -->				  <table data-height="400" class="footable table table-striped table-responsive" >
				  	<thead>
						<tr class="danger">
							<th style="border: hidden" data-hide="expand" class="col-sm-1">Opciones</th>						
							<th style="border: hidden" data-class="expand" class="col-sm-3">Nombres y Apellidos</th>
							<th style="border: hidden" data-hide="phone,tablet" class="col-sm-2">Cédula</th>						
							<th style="border: hidden" data-hide="phone,tablet" class="col-sm-2">Teléfono</th>
							<th style="border: hidden" data-hide="phone,tablet" class="col-sm-2">Otras Opciones</th>

						</tr>	
				    </thead>
			    	<tbody <tbody id="usuarioTable">

			    		<?php 
			    			if(!empty($carga)){
								foreach ($carga as $fila): ?>
									<tr>
										<td style="border: hidden">
											<div class="row">
												<div class="form-group">
													<div class="btn-group" role="group" style="padding-left:10px">
															<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
															echo form_open('carga/actualizaCarga', $atributos);
															echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
															<button data-toggle="tooltip" data-placement="top" title="Editar" type="submit" class="btn  btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>  
															<?php echo form_close(); ?>
													</div>
													<div class="btn-group" role="group" style="padding-left:10px">
															<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
															echo form_open('costanciaResidencia/', $atributos);
															echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
															<button data-toggle="tooltip" data-placement="top" title="Constancia de Residencia" type="submit" class="btn  btn-success btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>  
															<?php echo form_close(); ?>
													</div>
												</div>

											</div>
										</td>
										<td style="border: hidden"><div><?php echo $fila->nombre." ".$fila->apellido; ?></div></td>
										<td style="border: hidden"><div><?php echo $fila->ced; ?></div></td>									
										<td style="border: hidden"><div><?php echo $fila->telef; ?></div></td>									
										<td style="border: hidden">
											<div class="row">
												<div class="form-group">
													
													<div class="btn-group" role="group" style="padding-left:10px">
															<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
															echo form_open('constanciaCompra/', $atributos);
															echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
															<button data-toggle="tooltip" data-placement="top" title="Constancia de Compra" type="submit" class="btn  btn-success btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>  
															<?php echo form_close(); ?>
													</div>
													<div class="btn-group" role="group" style="padding-left:10px">
															<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
															echo form_open('constanciaSolteria/', $atributos);
															echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
															<button data-toggle="tooltip" data-placement="top" title="Soltería" type="submit" class="btn  btn-success btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>  
															<?php echo form_close(); ?>
													</div>
													<div class="btn-group" role="group" style="padding-left:10px">
															<?php $atributos = array('id' => 'editForm', 'class'=>'form-inline', 'autocomplete' => 'off', );
															echo form_open('bajosRecursos/', $atributos);
															echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
															<button data-toggle="tooltip" data-placement="top" title="Bajos Recursos" type="submit" class="btn  btn-success btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>  
															<?php echo form_close(); ?>
													</div>
												</div>
											</div>
										</td>
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