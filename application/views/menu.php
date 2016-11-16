<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consejo Comunal</title>
    <!-- Bootstrap Core CSS -->
    <link rel="icon" type="image/png" href="/assets/images/ico.png">        
    <link href="<?php base_url();?>/assets/css/bootstrap.css" rel='stylesheet' type='text/css'>
    <link href="<?php base_url();?>/assets/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
    <link href="<?php base_url();?>/assets/css/bootstrap-datepicker.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="<?php base_url();?>/assets/css/shop-item.css" rel='stylesheet' type='text/css'>
    <link href="<?php base_url();?>/assets/css/toastr.css" rel='stylesheet' type='text/css'/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php base_url();?>/assets/js/jquery/jquery-1.11.2.min.js"></script>    
    <script src="<?php base_url();?>/assets/js/toastr.js"></script>
    <script src="<?php base_url();?>/assets/js/bootstrap/bootstrap.js"></script>
    <script src="<?php base_url();?>/assets/js/bootstrap-datepicker.js"></script>

            <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
            <script>
                $(document).ready(function() {
                  toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    "positionClass": "toast-top-right",
                    timeOut: 4000
                  };
                });   
            </script>
            <!--webfont-->
            <!--prueba -->
        <script>
            (function($){
              $(document).ready(function(){
                $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
                  event.preventDefault(); 
                  event.stopPropagation(); 
                  $(this).parent().siblings().removeClass('open');
                  $(this).parent().toggleClass('open');
                });
              });
            })(jQuery);
        </script>
            <!--fin prueba -->
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="prueba">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php base_url();?>/index">Inicio</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="prueba">
                <ul class="nav navbar-nav">
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                         <span class="glyphicon glyphicon-wrench" aria-hidden="true">  Configuración</span> <span class="caret"></span>
                            <ul class="dropdown-menu" role="menu">
                             <li class="dropdown">
                              <ul class="dropdown-menu" role="menu">
                               <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                                        
                                </li>          
                              </ul>
                            </li>
                            <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consejo Comunal</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php base_url();?>/consejoc/inicio"><span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Adicionar</a></li>
                                        <li><a href="<?php base_url();?>/consejoc"><span class="glyphicon glyphicon-search" aria-hidden="true"> </span> Ver</a></li>
                                    </ul>
                            </li>    
                            <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php base_url();?>/usuarios/create"><span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Adicionar</a></li>
                                        <li><a href="<?php base_url();?>/usuarios/"><span class="glyphicon glyphicon-search" aria-hidden="true"> </span> Ver</a></li>
                                    </ul>
                            </li> 
                            <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Respaldo</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php base_url();?>/backup/exportar_sql"><span class="glyphicon glyphicon-download" aria-hidden="true"> </span> Respaldar Datos</a></li>
                                    </ul>
                            </li>                                                               
                        </ul>
                        </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                         <span class="glyphicon glyphicon--book" aria-hidden="true"> Censo</span> <span class="caret"></span>
                            <ul class="dropdown-menu" role="menu">
                             <li class="dropdown">
                              <ul class="dropdown-menu" role="menu">
                               <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                                        
                                </li>          
                              </ul>
                            </li>
                            <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jefe de Familia</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php base_url();?>/jefe/inicio"><span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Adicionar</a></li>
                                        <li><a href="<?php base_url();?>/jefe"><span class="glyphicon glyphicon-search" aria-hidden="true"> </span> Ver</a></li>
                                    </ul>
                            </li>                                                                                  
                              <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Población</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php base_url();?>/carga"><span class="glyphicon glyphicon-search" aria-hidden="true"> </span> Ver</a></li>
                                    </ul>
                            </li> 
                        </ul>
                        </li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                         <span class="glyphicon glyphicon-list-alt" aria-hidden="true">  Constancias Genéricas</span> <span class="caret"></span>
                            <ul class="dropdown-menu" role="menu">
                             <li class="dropdown">
                              <ul class="dropdown-menu" role="menu">
                               <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                                        
                                </li>          
                              </ul>
                            </li>
                            <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Imprimir</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="aval/"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> </span> Carta Aval Vivienda Principal</a></li>
                                        <li><a href="madreSoltera/"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> </span> Constancia de Madre Soltera</a></li>
                                        <li><a href="cartaAval/"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> </span> Carta Aval de Obra</a></li>
                                    </ul>
                            </li>                                                              
                        </ul>
                        </li>
                   </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                            <?php echo $this->session->userdata('nombre_usuario')?><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php base_url();?>/usuarios/changepass"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Cambiar Contraseña</a></li>
                                <li><a href="<?php base_url();?>/inicio/cerrar_sesion"><span class="glyphicon glyphicon-off" aria-hidden="true"> </span> Cerrar Sesión</a></li>
                            </ul>
                    </li>
                </ul>
                </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

