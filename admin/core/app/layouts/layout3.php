<!doctype html>
<html lang="es">
<head>



<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<link rel="icon" type="image/png"  href="uploads/icon.png"/>

<title>InfoApp</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/material-dashboard.css" rel="stylesheet"/>
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="assets/css/views_responsive.css" rel="stylesheet"/>
<link href="assets/css/views_styles.css" rel="stylesheet"/>


<link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

<!-- Theme style -->
<!-- <link rel="stylesheet" href="assets/dist/css/adminlte.min.css"> -->

<!-- SweetAlert2 -->
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css">
<link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.css">

<!-- Toastr -->
<link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

<!-- <link href="assets/css/views_responsive.css" rel="stylesheet"/> -->
<link href="assets/css/views_styles.css" rel="stylesheet"/>

<!-- Ekko Lightbox -->
<link rel="stylesheet" href="assets/plugins/ekko-lightbox/ekko-lightbox.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->
<!-- <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script> -->

  <!-- mobile-detect.min -->
  <script src="assets/js/mobile-detect.min.js"></script>

  
<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>
<?php endif; ?>




  <!-- Bootstrap core CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" /> -->
  <!-- Custom fonts for this template -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" /> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" /> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" /> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" /> -->



  

</head>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/638809c3daff0e1306da5459/1gj5mc9ur';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->






<body>
<?php if(isset($_SESSION["user_id"])):?>

  <div class="wrapper">

    <div class="sidebar" data-color="blue">
      <div class="logo">
        <a href="./" class="simple-text"><img src="uploads/infocentro_400px.png" style="max-width: 90px; min-height: 10px;"/></a>
      </div>

      <div class="sidebar-wrapper">
        <ul class="nav">

          <li>
            <a href="./">
              <i class="fa fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>

          <li>
            <a href="./?view=indicadores">
              <i class="fa fa-area-chart"></i>
              <p>Indicadores</p>
            </a>
          </li>

          <!-- accordion reportes-->
          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_report">
            <!-- <a href="./?view=infocentros"> -->
		          <!-- <p> <i class='fa fa-map' ></i> <b> Regiones </b> </p> -->
              <i class="fa fa-paper-plane"></i>
              <p>Reportes</p>
            </a>
          </li>

          <div id="collapse_report" class="panel-collapse collapse">
            <ul class="nav accordion" >

            <li>
              <a href="./?view=report">
                <i class="fa fa-user-check"></i>
                <p>Actividades</p>
              </a>
            </li>

            <li>
              <a href="./?view=services">
                <i class="fa fa-plus-circle"></i>
                <p>Servicios</p>
              </a>
            </li> 

            <li>
              <a href="./?view=participants">
                <i class="fa fa-users"></i>
                <p>Participantes</p>
              </a>
            </li> 

            <li>
              <a href="./?view=products">
                <i class="fa fa-flask"></i>
                <p>Productos</p>
              </a>
            </li> 

            


            </ul>
          </div class="collapse_info">
          <!-- fin accordion reportes -->


          <!-- accordion infocentros-->
          <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>

          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_info">
            <!-- <a href="./?view=infocentros"> -->
		          <!-- <p> <i class='fa fa-map' ></i> <b> Regiones </b> </p> -->
              <i class="fa fa-building"></i>
              <p>Infocentros</p>
            </a>
          </li>
          <?php } ?>

          <div id="collapse_info" class="panel-collapse collapse">
            <ul class="nav accordion" >

              <li>
                <a href="./?view=infocentros">
                  <i class="fa fa-home"></i>
                  <p class="accordion_text"> Datos básico</p>
                </a>
              </li>

              <li>
                <a href="">
                    <i class="fa fa-users"></i>
                    <p>inter-institucional</p>
                </a>
              </li>

              <li>
                <a href="">
                    <i class="fa fa-building"></i>
                    <p>Infraestructura</p>
                </a>
              </li>

              <li>
                <a href="">
                    <i class="fa fa-wifi"></i>
                    <p>Tecnología</p>
                </a>
              </li>
              <li>
                <a href="">
                    <i class="fa fa-plug"></i>
                    <p>Comunicación</p>
                </a>
              </li>

            </ul>
          </div class="collapse_info">
          <!-- fin accordion infocentros -->






          <!-- accordion personal-->
          <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>
          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_personal">
            <!-- <a href="./?view=infocentros"> -->
		          <!-- <p> <i class='fa fa-map' ></i> <b> Regiones </b> </p> -->
              <i class="fa fa-users"></i>
              <p>Gestión humana</p>
            </a>
          </li>
          <?php } ?>

          <div id="collapse_personal" class="panel-collapse collapse">
            <ul class="nav accordion" >

              <li>
                <a href="./?view=facilitators">
                    <i class="fa fa-users"></i>
                    <p>Facilitadores</p>
                </a>
              </li>

              <li>
                <a href="./?view=coordinator">
                    <i class="fa fa-users"></i>
                    <p>Coordinadores</p>
                </a>
              </li>

               

            <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>

              <li>
                <a href="./?view=gerencias">
                    <i class="fa fa-user-tie"></i>
                    <p>Gerencias</p>
                </a>
              </li>
            <?php } ?>

            <li>
              <a href="./?view=final_users">
                <i class="fa fa-user-tag"></i>
                <p>Usuarios</p>
              </a>
            </li>


            </ul>
          </div class="collapse_info">
          <!-- fin accordion personal -->






          <!-- accordion regiones-->
          <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>
          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_reg">
            <!-- <a href="./?view=infocentros"> -->
		          <!-- <p> <i class='fa fa-map' ></i> <b> Regiones </b> </p> -->
              <i class="fa fa-map"></i>
              <p>Regiones</p>
            </a>
          </li>
          <?php } ?>

          <div id="collapse_reg" class="panel-collapse collapse">
            <ul class="nav accordion" >

              <li>
                <a href="./?view=estados">
                  <i class="fa fa-map"></i>
                  <p class="accordion_text"> Estados</p>
                </a>
              </li>


              <li>
                <a href="./?view=municipios">
                  <i class="fa fa-map-marker "></i>
                  <p class="accordion_text">Municipios</p>
                </a>
              </li>


              <li>
                <a href="./?view=parroquias">
                  <i class="fa fa-map-pin "></i>
                  <p class="accordion_text">Parroquias</p>
                </a>
              </li>

            </ul>
          </div class="collapse_reg">
          <!-- fin accordion regiones -->






          <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ ?>
          <!-- accordion datos-->
          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_data">
            <!-- <a href="./?view=infocentros"> -->
		          <!-- <p> <i class='fa fa-map' ></i> <b> Regiones </b> </p> -->
              <i class="fa fa-database"></i>
              <p>Datos</p>
            </a>
          </li>
          <?php } ?>

          <div id="collapse_data" class="panel-collapse collapse">
            <ul class="nav accordion" >

              <li>
                <a href="./?view=data&type=8&swal=">
                  <i class="fa fa-calendar"></i>
                  <p>Fecha de reportes</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=1&swal=">
                  <i class="fa fa-signal"></i>
                  <p>Tipo de internet</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=2&swal=">
                  <i class="fa fa-unlink"></i>
                  <p>Operatividad</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=3&swal=">
                  <i class="fa fa-hourglass-2"></i>
                  <p>Tipo de estatus</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=9&swal=">
                  <i class="fa fa-flask"></i>
                  <p>Tipo de productos</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=4&swal=">
                  <i class="fa fa-cogs"></i>
                  <p>Línea de acción</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=5&swal=">
                  <i class="fa fa-sliders"></i>
                  <p>Coordinaciones</p>
                </a>
              </li>

              <li>
                <a href="./?view=data&type=6&swal=">
                  <i class="fa fa-user-tag"></i>
                  <p>Tipo responsable</p>
                </a>
              </li>

            <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ ?>

              <li class="nav-item">
                <a href="./?view=data&type=7&swal=" class="nav-link">
                  <i class="fas fa-user-cog"></i>
                  <p>Tipo de usuario</p>
                </a>
              </li>
            <?php } ?>


            </ul>
          </div class="collapse_data">
          <!-- fin accordion datos -->




          <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9){ ?>
          <!-- accordion datos-->
          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_data_root">
            <!-- <a href="./?view=infocentros"> -->
		          <!-- <p> <i class='fa fa-map' ></i> <b> Regiones </b> </p> -->
              <i class="fa fa-cog"></i>
              <p>SOLO-ROOT</p>
            </a>
          </li>
          <?php } ?>

          <div id="collapse_data_root" class="panel-collapse collapse">
            <ul class="nav accordion" >

            <li>
              <a href="./?view=report_admin">
                <i class="fa fa-user-check"></i>
                <p>Actividades</p>
              </a>
            </li> 

            <li>
              <a href="./?view=participants_admin">
                <i class="fa fa-users"></i>
                <p>Participantes</p>
              </a>
            </li> 

            <li>
              <a href="./?view=products_admin">
                <i class="fa fa-flask"></i>
                <p>Productos</p>
              </a>
            </li> 

            <li>
              <a href="./?view=database">
              <!-- <a href="./?action=database"> -->
                <i class="fa fa-database"></i>
                <p>Database</p>
              </a>
            </li> 
                   
            </ul>
          </div class="collapse_data_root">
          <!-- fin accordion datos -->





          <!-- <li>
            <a href="./?view=documentacion">
              <i class="fa fa-help"></i>
              <p>Documentación</p>
            </a>
          </li> -->



          <!-- ADMIN -->
          <!?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ ?>

          <?php
          $_location = "./?view=users";
          // if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8){
          //   $_location = "./?view=users&q=".$_SESSION['user_region'];
          // }
          ?>

          <!-- accordion configuracion-->
          <li>
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_conf">
              <i class="fa fa-cog"></i>
              <p>Configuración</p>
            </a>
          </li>
          

          <div id="collapse_conf" class="panel-collapse collapse">
            <ul class="nav accordion" >

              <li>
                <a href="<?php echo $_location ?>">
                    <i class="fa fa-users"></i>
                    <p>Usuarios sistema</p>
                </a>
              </li>


            </ul>
          </div class="collapse_conf">
          <!-- fin accordion configuracion -->

          <!?php } ?>



          <li>
            <a href="logout.php">
              <i class="fa fa-times"></i>
              <p>Salir</p>
            </a>
          </li>



        </ul>
      </div>

      
    </div>













    <div class="main-panel">
      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">

          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><b>Sistema de Gestión</b></a>

           
          </div>

          
          <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-ellipsis-v"></i>
                  <!-- <p>Config</p> -->
                </a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php">Salir</a></li>
                  
                   <!-- USUARIO Y PERMISOS -->
            <?php echo $_SESSION["user_type"]?>
            <?php echo $_SESSION["user_name"]?>
            <?php echo $_SESSION["user_region"]?>
                  <!-- <li><a href="logout.php">Salir</a></li>
                  <li><a href="logout.php">Salir</a></li> -->
                </ul>
              </li>
            </ul>



          
            <!--
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group  is-empty">
                <input type="text" class="form-control" placeholder="Search">
                <span class="material-input"></span>
              </div>
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="fa fa-search"></i><div class="ripple-container"></div>
              </button>
            </form>
            -->
          </div>



        </div>
      </nav>


      <div class="content">
        <div class="container-fluid">
          <?php 
            // puedo cargar otras funciones iniciales
            // dentro de la funcion donde cargo la vista actual
            // como por ejemplo cargar el corte actual
            View::load("login");

          ?>
        </div>
      </div>



      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-center">
            <ul>
              <!-- <li>
                <a href="./?view=home" >
                  Inicio
                </a>

              </li>
              <li>
                <a href="http://evilnapsis.com/" target="_blank">
                  Evilnapsis
                </a>
              </li>
        
              <li>
                <a href="#">
                  Company
                </a>
              </li>

              <li>
                <a href="#">
                  Portfolio
                </a>
              </li> -->

              <li>
                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Fundación Infocentro | con <i class="fa fa-heart" aria-hidden="true"></i> y Software Libre
              </li>


         
            </ul>
          </nav>
          <!-- <p class="copyright pull-right">
            <a href="http://evilnapsis.com" target="_blank">Evilnapsis</a> &copy; 2016 
          </p> -->
        </div>
      </footer>

      
    </div>

  </div>







  <?php else:?>
    <?php 
    View::load("login");
    if(isset($_GET["view"]) && $_GET["view"]!="index"){
      print "<script>window.location='logout.php';</script>";
    }
  ?>

  <?php endif;?>
</body>

  <!--   Core JS Files   -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/material.min.js" type="text/javascript"></script>

  <!--  Charts Plugin -->
  <!-- <script src="assets/js/chartist.min.js"></script> -->

  <!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

  <!-- Material Dashboard javascript methods -->
  <script src="assets/js/material-dashboard.js"></script>



  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="assets/js/demo.js"></script> -->


<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="assets/dist/js/adminlte.min.js"></script> -->
<!-- InputMask -->
<script src="assets/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<!-- ChartJS -->
<!-- <script src="assets/plugins/chart.js/Chart.min.js"></script> -->
<script src="assets/plugins/chart.js/3/chart.min.js"></script>
<script src="assets/plugins/chart.js/chartjs-plugin-datalabels.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js" integrity="sha512-Tfw6etYMUhL4RTki37niav99C6OHwMDB2iBT5S5piyHO+ltK2YX8Hjy9TXxhE1Gm/TmAV0uaykSpnHKFIAif/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->



<!-- Ekko Lightbox -->
<script src="assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->

<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>



  <!-- Bootstrap core JavaScript -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->

  <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->

  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>










<!-- MUI -->
<script src="assets/mui-0.10.3/extra/mui-combined.min.js"></script>

  <!-- <script type="text/javascript">
      $(document).ready(function(){

      // Javascript method's body can be found in assets/js/demos.js
          demo.initDashboardPageCharts();

      });
  </script> -->

</html>


<style>
  
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





</style>


<script>

// // AVISO
  // Swal.fire({
  // // position: 'top-center',
  // icon: 'warning',
  // title: 'En este momento nos encontramos modificando la InfoApp.\n Por favor espera a que terminemos para que puedas usar esta sección.\n Terminamos en 30 minutos',
  // showConfirmButton: true,
  // // timer: 1000
  // })





//   const Toast = Swal.mixin({
//   toast: true,
//   position: 'top-end',
//   showConfirmButton: false,
//   timer: 6000,
//   timerProgressBar: true,
//   didOpen: (toast) => {
//     toast.addEventListener('mouseenter', Swal.stopTimer)
//     toast.addEventListener('mouseleave', Swal.resumeTimer)
//   }
// })

// Toast.fire({
//   icon: 'success',
//   title: 'Se reiniciaron los reportes a partir del 1ro de septiembre'
// })


</script>
