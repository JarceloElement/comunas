<!doctype html>
<html lang="en">
<head>



<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<link rel="icon" type="image/png"  href="images/icon.png"/>

<title>InfoApp</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" /> -->
<!-- <link href="assets/css/material-dashboard.css" rel="stylesheet"/> -->

<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
<link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- Toastr -->
<link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

<!-- <link href="assets/css/views_responsive.css" rel="stylesheet"/> -->
<link href="assets/css/views_styles.css" rel="stylesheet"/>

<!-- Ekko Lightbox -->
<link rel="stylesheet" href="assets/plugins/ekko-lightbox/ekko-lightbox.css">

<script src="assets/js/jquery.min.js" type="text/javascript"></script>




<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>
<?php endif; ?>



</head>
<?php if(isset($_SESSION["user_id"])){?>



<!-- <body> -->
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    
      



      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <!-- <i class="far fa-bell"></i> -->
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Acceso</span>
          <div class="dropdown-divider"></div>
          

          <a href="?view=users" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Usuarios
          </a>
          <a href="logout.php" class="dropdown-item">
            <i class="fas fa-arrow-right mr-2"></i> Salir
          </a>
          


          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
          
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->










<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Info App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->









      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <!-- <li class="nav-item has-treeview menu-open"> -->
          <!-- <li class="nav-item has-treeview menu">

            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index2.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>

            </ul>

          </li> -->




          <li class="nav-item">
            <a href="./" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
                <p>
                  Inicio
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
          </li>


          <li class="nav-item">
            <a href="./?view=indicadores" class="nav-link active">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Indicadores
                </p>
              </a>
          </li>

          <!-- accordion reportes-->
          <!-- <li class="nav-item has-treeview menu-open"> -->
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./?view=report" class="nav-link ">
                  <i class="nav-icon fas fa-circle"></i>
                    <p>
                    Actividades
                    </p>
                  </a>
              </li>


              <li class="nav-item">
                <a href="./?view=participants" class="nav-link active">
                  <i class="nav-icon fas fa-users"></i>
                    <p>
                    Participantes
                    </p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="./?view=products" class="nav-link">
                  <i class="nav-icon fas fa-flask"></i>
                    <p>
                    Productos
                    </p>
                  </a>
              </li>

            </ul>
          </li>
          <!-- fin accordion reportes -->


          
  


          <!-- accordion infocentros-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
              Infocentros
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="./?view=infocentros" class="nav-link">
                  <i class="fas fa-edit"></i>
                  <p>Datos básico</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>Inter-institucional</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-building"></i>
                  <p>Infraestructura</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-wifi"></i>
                  <p>Tecnología</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-plug"></i>
                  <p>Comunicación</p>
                </a>
              </li>
              

            </ul>
          </li>
          <!-- fin accordion infocentros -->





          <!-- accordion infocentros-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Gestión humana
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="./?view=facilitators" class="nav-link">
                  <i class="fas fa-male"></i>
                  <p>Facilitadores</p>
                </a>
              </li>

            <li class="nav-item">
              <a href="./?view=coordinator" class="nav-link">
                <i class="fas fa-male"></i>
                <p>Coordinadores</p>
              </a>
            </li>

            </ul>
          </li>
          <!-- fin accordion infocentros -->





          <!-- accordion regiones-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-map"></i>
              <p>
                Regiones
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./?view=estados" class="nav-link">
                  <i class="fas fa-map"></i>
                  <p>Estados</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=municipios" class="nav-link">
                  <i class="fas fa-map-marker"></i>
                  <p>Municipios</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=parroquias" class="nav-link">
                  <i class="fas fa-map-pin"></i>
                  <p>Parroquias</p>
                </a>
              </li>

            </ul>
          </li>
          <!-- fin accordion regiones -->


          <!-- accordion datos-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Datos
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./?view=data&type=1" class="nav-link">
                  <i class="fas fa-map"></i>
                  <p>Tipo de internet</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=data&type=2" class="nav-link">
                  <i class="fas fa-unlink"></i>
                  <p>Operatividad</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=data&type=3" class="nav-link">
                  <i class="fas fa-hourglass"></i>
                  <p>Tipo de estatus</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=data&type=4" class="nav-link">
                  <i class="fas fa-cogs"></i>
                  <p>Línea de acción</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=data&type=5" class="nav-link">
                  <i class="far fa-thumbs-up"></i>
                  <p>Coordinaciones</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=data&type=6" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>Tipo responsable</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./?view=data&type=7" class="nav-link">
                  <i class="fas fa-cog"></i>
                  <p>Tipo de usuarios</p>
                </a>
              </li>

            </ul>
          </li>
          <!-- fin accordion datos -->


          


          <li class="nav-header">ADMINISTRACIÓN</li>
            <!-- <li class="nav-item">
              <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Calendar
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li> -->
         

            <!-- configuracion-->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Configuración
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./?view=users" class="nav-link">
                    <i class="fas fa-users"></i>
                    <p>Usuarios del sistema</p>
                  </a>
                </li>

          

              </ul>
            



            </li>
            <!-- fin accordion configuracion -->
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>















  <?php if(isset($_SESSION["user_id"])){?>


    <div class="main-panel">

      <div class="content">
        <div class="container-fluid">
          <?php 
            // puedo cargar otras funciones iniciales
            // dentro de la funcion donde cargo la vista actual
            // como por ejemplo cargar el corte actual
            View::load("login");

  }?>
        </div>
      </div>





        <!-- Main Footer -->
      <!-- <footer class="main-footer">
        <strong>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Fundación Infocentro | con <i class="fa fa-heart" aria-hidden="true"></i> y Software Libre</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.0.0-rc.1
        </div>
      </footer> -->
  
      
    </div>

  </div>

<?php }else{?>
    <?php 
    View::load("login");
    if(isset($_GET["view"]) && $_GET["view"]!="index"){
      print "<script>window.location='logout.php';</script>";
    }
  }
  ?>

</body>



<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- <script src="assets/plugins/jquery/jquery.min.js"></script> -->
<!-- <script src="assets/js/jquery-3.1.1.min.js"></script> -->
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- InputMask -->
<script src="assets/plugins/inputmask/jquery.inputmask.bundle.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="assets/dist/js/demo.js"></script> -->

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<!-- <script src="assets/dist/js/pages/dashboard2.js"></script> -->


<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Ekko Lightbox -->
<script src="assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->

<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>





  <!--   Core JS Files   -->
  <!-- <script src="assets/js/bootstrap.min.js" type="text/javascript"></script> -->
  <!-- <script src="assets/js/material.min.js" type="text/javascript"></script> -->

  <!--  Charts Plugin -->
  <!-- <script src="assets/js/chartist.min.js"></script> -->

  <!--  Notifications Plugin    -->
  <!-- <script src="assets/js/bootstrap-notify.js"></script> -->

  <!--  Google Maps Plugin    -->
  <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

  <!-- Material Dashboard javascript methods -->
  <!-- <script src="assets/js/material-dashboard.js"></script> -->

  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="assets/js/demo.js"></script> -->

  <!-- <script type="text/javascript">
      $(document).ready(function(){

      // Javascript method's body can be found in assets/js/demos.js
          demo.initDashboardPageCharts();

      });
  </script> -->

</html>


<!-- <style>
@media only screen and (min-width: 768px){

  .accordion{
  font-size: 24px;
  color: #d30c5f;
  background:#ffffff;
  }

  .accordion_text{
  color: #131313;
  }

}

@media only screen and (max-width: 767px){

  .accordion{
  font-size: 24px;
  color: #2d2d2d;
  margin-right: 10px;
  background:#5a5a5a;
  }

  .accordion_text{
  color: #ffffff;
  }

  .sidebar .nav i {
    color: #ffffff;
  }

}


.modal-backdrop {
    position: relative;

}







.fullscreen-modal .modal-dialog {
  margin: 0;
  margin-top: 10%;
  margin-right: auto;
  margin-left: auto;
  width: 100%;

}
@media (min-width: 768px) {
  .fullscreen-modal .modal-dialog {
	width: 750px;
	
  }
}
@media (min-width: 992px) {
  .fullscreen-modal .modal-dialog {
	width: 800px;
	
  }
}
@media (min-width: 1200px) {
  .fullscreen-modal .modal-dialog {
	 width: 800px;
	 
  }
}





</style> -->