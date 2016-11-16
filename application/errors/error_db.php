<!DOCTYPE HTML>
<html>
  <head>
    <title>CONSEJO COMUNAL</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/assets/images/inso.png">  
<link href="<?php base_url();?>/assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="<?php base_url();?>/assets/css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-adminRubros">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        </div>
  </div><!-- /.container-->
</nav>

<div class='container content_middle'>

  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Error de comunicacion</h3>
    </div>
    <div class="panel-body">

    	<div class="row">
		  <div class="col-md-12 text-center"><h1> Error de comunicacion</h1></div>
		  <div class="col-md-12  text-center"><h5>Ocurrio un error de comunicacion</h5></div>
		  <div class="col-md-12  text-center"><h4><p>El servidor Web puede estar abajo, demasiado ocupado, 
          o experimentando otros problemas que le impiden responder las solicitudes.
          Intentelo mas tarde.</p></h4></div><?php echo $message; ?>
			<div class="col-md-12  text-center">
<a class="btn btn-default" href="<?php base_url();?>/inicio">Volver</a>


  
			</div>
		</div>
   
    </div>
  </div>

</div> 
</body>
</html>   
