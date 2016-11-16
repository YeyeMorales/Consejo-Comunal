<meta name="viewport" content="width=device-width, initial-scale=1">
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">
          <h1>
              Permisos de Eventos
          </h1>
        </section>

        <!-- Main content -->
	<div class='container content_middle'>   
  	  <div class="panel panel-info">
		  <div class="panel-body">
		  	 <div id="container" name="container" class="vertical-align" style="height: 400px;">
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

		    <div class="row">
				<div class='col-md-12' >
				<?php $atributos = array('id' => 'formfiltrar', 'autocomplete' => 'off', 'class' => 'form-inline' );
					echo form_open('atletas/filterAtleta', $atributos);
				?>
					<div class="form-group">
						<div class="form-group">
			            <?php               
			                  echo form_input(array('name' => 'cedula', 'class' => 'form-control', 'id' => 'cedula', 'size' => '20',  'autocomplete'=>'off',  'placeholder'=>'Indique la Cédula', 'aria-describedby'=>'sizing-addon2')); ?>
			          </div>
					</div>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-seacrh" aria-hidden="true"></span>&nbsp;Buscar</button>
		            <?php echo anchor('atletas/buscarAtleta', 'Limpiar', 'class="btn btn-danger"');?>  
				<?php echo form_close(); ?>
			</div>
		</div></br>
		    <div class = 'col-md-12'>
		    	<div class="panel panel-info">
 			 		<div class="table-responsive">

					<table data-height="350" class="footable table table-striped table-responsive" >
					  	<thead >
							<tr class="info">
								<th style="border: hidden" data-hide="expand" class="col-sm-2">Nombres y Apellidos</th>
								<th style="border: hidden" data-hide="expand" class="col-sm-2">Cédula</th>
								<th style="border: hidden" data-hide="expand" class="col-sm-2"><center>Opciones</center></th>
							</tr>	
					    </thead>
			    	<tbody tbody id="usuarioTable">

			    		<?php 
			    			if(!empty($atletas)){
								foreach ($atletas as $fila): ?>
									<tr>
										<td style="border: hidden"><div><?php echo $fila->nombres." ".$fila->apellidos; ?></div></td>
										<td style="border: hidden"><div><?php echo $fila->cedula; ?></div></td>
										<td style="border: hidden">
											<div class="row">
												<div class="form-group">
												<center>
													<div class="btn-group" role="group">
														<?php $atributos = array('id' => 'deletForm', 'autocomplete' => 'off', );
														echo form_open('permiso/', $atributos);
														echo form_input(array('name' => 'id', 'id' => 'id', 'value' => $fila->id, 'type'=>'hidden')); ?> 
														<button data-toggle="tooltip" data-placement="top" title="Generar Permiso" type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>  
														<?php echo form_close(); ?>
													</div>
												</center>
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
</section>
</div>
</div>