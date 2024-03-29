<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once 'back/config/parametros.php'; ?>
<html>
    <head>
        <title id="titulo"><?php print 'Leader IT - '.NOMBRE_EMPRESA ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="css/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Estilos propios -->
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="animate fadeIn nav-md"> <!-- class="nav-mf" -->

        <div class="container body"> <!-- body -->
            <div id="main_container" class="main_container">
                <!-- Sidebar Menu -->

                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a onclick="cargar_formulario('frm/dashboard')" class="site_title centrado" style="cursor:pointer;">
                                <img id="principal_ico" src="img/logo_barra.png" alt="">
                                <!--<i class="fa fa-desktop"> </i>--> 
                                <span><?php print NOMBRE_EMPRESA ?></span>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <!--<div class="centrado">
                            <span id="empresa_call">Empresa call</span>
                        </div>-->
                        <!-- menu profile quick info -->
                        <div class="centrado">
                            <div class="profile clearfix">
                                <div class="profile_info">
                                    <h2 id="nombre_usuario">user-name</h2>
                                </div>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Ventas</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Definiciones <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a onclick="cargar_formulario('frm/clientes')">Clientes</a></li>
                                            <li><a onclick="cargar_formulario('frm/productos')">Productos</a></li>
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-pencil-square-o"></i> Movimientos <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a onclick="cargar_formulario('frm/pedidos')">Facturacion</a></li>
                                            <li><a onclick="cargar_formulario('frm/consulta')">Consulta de Stock</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="glyphicon glyphicon-list-alt"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a onclick="cargar_formulario('frm/reporte_pedidos_emitidos')">Detalle de Ventas</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /Sidebar Menu -->

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>


                            <ul id="mini-menu" class="nav navbar-nav navbar-right">


                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <label id="usuario"></label>
                                        <span class="fa fa-ellipsis-v"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a id="log_out"><i class="fa fa-sign-out pull-right"></i>Salir</a></li>
                                    </ul>
                                </li>
                                <!--<li class="">
                                    <a data-toggle="modal" data-target="#modalInformes" class="user-profile dropdown-toggle" aria-expanded="false">
                                        <label> INFORMES </label> <span class="glyphicon glyphicon-list-alt"></span>
                                    </a>
                                </li>-->
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- /top navigation -->

                <!-- CONTENIDO -->

                <div class="right_col" role="main" ><!-- contenedor_main -->
                    





                    <div class="row tile_count">
                        <div id="formulario">

                        </div>
                        <div id="buscado">

                        </div>
                    </div>
                </div>


                <!-- FIN CONTENIDO -->
            </div>
        </div>







        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="vendors/Flot/jquery.flot.js"></script>
        <script src="vendors/Flot/jquery.flot.pie.js"></script>
        <script src="vendors/Flot/jquery.flot.time.js"></script>
        <script src="vendors/Flot/jquery.flot.stack.js"></script>
        <script src="vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="vendors/moment/moment.js"></script>
        <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="js/custom.js" type="text/javascript"></script>
        <!-- Funciones Esteban-->
        <script src="js/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="js/jwt-decode.min.js" type="text/javascript"></script>
        <script src="js/funciones.js" type="text/javascript"></script>
        <script src="js/principal.js" type="text/javascript"></script>
        <script src="js/jquery.priceformat.min.js" type="text/javascript"></script>


    </body>
</html>
