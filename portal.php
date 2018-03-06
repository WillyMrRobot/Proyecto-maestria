<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8" />
    
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Portal Actividades</title>
    <link href="Content/bootstrap_back.min.css" rel="stylesheet">
    <link href="Content/bootstrap-dialog.css" rel="stylesheet">
    <link href="Content/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="Content/datatables.bootstrap.css" rel="stylesheet">
    <link href="Content/datatables.responsive.css" rel="stylesheet">
    <link href="Content/main.min.css" rel="stylesheet">
    <link href="Content/ui.css" rel="stylesheet">
    <link href="Content/proxima-font.css" rel="stylesheet">

</head>
<body class="ui-ly sidebar-mini" ng-app="actividadesApp">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini -->
            <span class="logo-mini"><img style="width: 55px;" src="Content/img/logoColpre.png"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img style="width: 55px;" src="Content/img/logoColpre.png"> <strong></strong></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-brand" style="color:#F8F8F8">Colegio la Presentación Duitama</div><!-- parametrizar -->
            <div class="navbar-custom-menu visible-big">
                <ul class="nav navbar-nav">
                    <li><div id="userName" class="userName" style="color:#F8F8F8"></div></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a href="#" onclick="changepassword(); return false;" id="changePassword"><i class="fa fa-key"></i><span>&nbsp;&nbsp;&nbsp;Cambiar Contraseña</span></a></li> -->
                    <li><a href="#" onclick="Exit(); return false;"><i class="fa fa-sign-out"></i><span>&nbsp;&nbsp;&nbsp;Salir</span></a></li>
                    <li><a href="#">&nbsp;</a></li>
                    
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">Inicio</li>
                <li class="treeview selected">
                    <a href="#inicio">
                        <i class="fa fa-book"></i> <span>Presentación</span>
                    </a>
                </li>
                <li class="header">Actividades</li>
                <li class="treeview selected">
                    <a href="#habilidadesCriticas">
                        <i class="fa fa-bullseye"></i> <span>Habilidades Criticas</span>
                    </a>
                </li>
                     
                    
            </ul>
            <ul class="sidebar-menu invisible-big">
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-user"></i><span id="userName" class="userName" style="color:#F8F8F8"></span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="height:100px !important">
                        <!-- <li class="treeview" style="text-align: center;"><a href="#" onclick="changepassword(); return false;" id="changePassword"><i class="fa fa-key"></i><span>&nbsp;&nbsp;&nbsp;Cambiar Contraseña</span></a></li> -->
                        <li class="treeview" style="text-align: center;"><a href="#" onclick="Exit(); return false;"><i class="fa fa-sign-out"></i><span>&nbsp;&nbsp;&nbsp;Salir</span></a></li>
                    </ul>
                </li>
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <div ng-view></div>
        
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; 2017 <a href="http://www.whitetech.co" target="_blank">WhiteTech.co</a></strong>
    </footer>
</div><!-- ./wrapper -->
<script src="Scripts/modernizr-2.6.2.js" type="text/javascript"></script>
<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="Scripts/bootstrap.min.js" type="text/javascript"></script>
<script src="Scripts/bootstap-dialog.js" type="text/javascript"></script>
<script src="Scripts/jquery.dataTables.js" type="text/javascript"></script>
<script src="Scripts/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="Scripts/datatables.responsive.min.js" type="text/javascript"></script>
<script src="Scripts/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="Scripts/app.min.js" type="text/javascript"></script>

<script src="Scripts/angular/angular.min.js" type="text/javascript"></script>  
<script src="Scripts/angular/angular-route.min.js" type="text/javascript"></script>  
<script src="Scripts/angular/angular-sanitize.min.js" type="text/javascript"></script>  
<script src="Scripts/angular/angular-animate.min.js" type="text/javascript"></script> 
<script src="Scripts/angular/angular-resource.min.js" type="text/javascript"></script>  
<script src="Scripts/angular/underscore.js" type="text/javascript"></script>


<script src="Scripts/app/actividades/app.js" type="text/javascript"></script>
<script src="Scripts/app/common/common.services.js" type="text/javascript"></script>
<script src="Scripts/app/common/utilities.js" type="text/javascript"></script>
<script src="Scripts/app/actividades/services.js" type="text/javascript"></script>
<!--<script src="Scripts/app/actividades/habilidadesController.js" type="text/javascript"></script>-->
<script src="Scripts/app/actividades/blogController.js" type="text/javascript"></script>
<script src="Scripts/app/actividades/inicioController.js" type="text/javascript"></script>
</body>
</html>

