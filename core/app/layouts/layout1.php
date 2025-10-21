<!DOCTYPE html>
<html lang="es">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Infocentro en un clic | Promoviendo la inclusión digital">
    <meta name="author" content="Lanubeplus.com">
    <meta name="keyword" content="Infocentro, Amazonas, Venezuela">
    <title>InfoApp</title>
    <link rel="icon" type="image/png"  href="uploads/icon_info.png"/>

    <!-- Main styles for this application-->
    <!-- <link href="user/assets/usertheme/css/style.css" rel="stylesheet"> -->
    <link href="assets/node_modules/pace-progress/css/pace.min.css" rel="stylesheet">
    <link href="assets/css/views_styles.css" rel="stylesheet"/>


    <!-- Add Material font (Roboto) and Material icon as needed -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin> -->
    <!-- <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin> -->

    <link href="assets/css/googleapi/Roboto.css" rel="stylesheet" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&family=Roboto+Slab:wght@300;400;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet" crossorigin> -->
    
    <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet" crossorigin> -->

    <!-- Material CSS -->
    <link href="assets/css/googleapi/material.min.css" rel="stylesheet" crossorigin>
    <!-- <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material.min.css" rel="stylesheet" crossorigin> -->
    
    <!-- Icon material -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons&family=Material+Icons+Outlined" rel="stylesheet" crossorigin>
    <!-- <link href="assets/css/googleapi/Material-icons.css" rel="stylesheet" crossorigin> -->

    <!-- Optional Material CSS for Plugins
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" crossorigin>
    -->

    <!-- SweetAlert2 -->
    <!-- <link rel="stylesheet" href="node_modules/sweetalert2-theme-bootstrap-4/bootstrap-4.css"> -->
    <link rel="stylesheet" href="assets/node_modules/sweetalert2/sweetalert2.css">
    
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>




    <!-- navbar Material Design -->
    <link href="assets/css/googleapi/material-components-web.min.css" rel="stylesheet">
    <!-- <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet"> -->
    <!-- <script src="assets/css/googleapi/material-components-web.min.js"></script> -->
    <!-- <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script> -->

    <!-- toastify toast-->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> -->
    <link href="assets/css/toastify.min.css" rel="stylesheet"/>

    

<?php
// session_start();

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");





// if (isset($_COOKIE['user_id'])){
// 	$_SESSION['user_id'] = $_COOKIE['user_id'];
// }
// if (isset($_COOKIE['user_type'])){
// 	$_SESSION['user_type'] = $_COOKIE['user_type'];
// }
// if (isset($_COOKIE['user_email'])){
// 	$_SESSION['user_email'] = $_COOKIE['user_email'];
// }
// if (isset($_COOKIE['alert'])){
// 	$_SESSION['alert'] = $_COOKIE['alert'];
// }

// session_regenerate_id(true); 
// $_SESSION['start'] = time();

// if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > (60 * 1))) {
//     session_unset(); 
//     session_destroy(); 
//     echo "session destroyed"; 
// }



?>

</head>


<!-- ALERT TOAST -->
<!-- <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="height: 50px;">
  <div id="layout_alert" class="toast hide " role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <div class="toast-body" id="toast-body">
    </div>
  </div>
</div> -->

<!-- <script>alert('<!?php echo Session::getUID().$_SESSION['user_email'];?>');</script> -->

<!?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""):?>
<?php if(Session::getUID()!=""):?>
  

  <body class="app_user" >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">



      <header class="mdc-top-app-bar mdc-top-app-bar--short">
        <div class="mdc-top-app-bar__row">
          <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <!-- <button onclick=sidemenu(); class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded">menu</button> -->
            <button data-target="#navdrawerDefault" data-toggle="navdrawer" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded">menu</button>
            <!-- <span class="mdc-top-app-bar__title" href="./index.php">InfoApp</span> -->
            <a class="mdc-top-app-bar__title" href="./index.php">InfoApp</a>
          </section>
          
          <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
            <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>
              <a class="navbar-brand" href="./admin/index.php" role="button"><span class="mdc-icon-button material-icons">admin_panel_settings</span></a>
            <a class="navbar-brand mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" href="./index.php?view=services">support_agent</a>
            <?php } ?>
            <!-- Dark mode -->
            <button onclick=darkSwitch(); class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded">brightness_4</button>
            <a class="navbar-brand mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" href="logout.php">logout</a>
          
          </section>

        </div>
      </header>

    </nav>


<!-- div de alerta toastjs -->
<div id="toastjs"></div>












<!-- side menu -->
<div aria-hidden="true" class="navdrawer" id="navdrawerDefault" tabindex="-1">
  <div class="navdrawer-content">
    <div class="navdrawer-header">
      <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <span class="mdc-top-app-bar__title">Menú</span>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <!-- <button onclick=sidemenu(); class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded">close</button> -->
          <button data-target="#navdrawerDefault" data-toggle="navdrawer" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded">close</button>
        </section>
      </div>
    </div>
    
    <!-- <li>
            <a href="./?view=indicadores">
              <i class="fa fa-area-chart"></i>
              <p>Indicadores</p>
            </a>
          </li> -->


    <div class="accordion" id="accordion1">

      <!-- collapse1 -->
      <!-- toggle co JS -->
      <!-- <ul class="navdrawer-nav">
        <li class="nav-item"><a id="reportes" class="nav-link inactive" data-toggle="collapse"><i class="material-icons mr-3">article</i>Reportes</a></li>
      </ul> -->

      <div class="nav-link">
        <a class="btn btn-link" href="./index.php" role="button"><i class="material-icons mr-3">dashboard</i>Inicio</a>
      </div>

      <!-- panel admin -->
      <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>
      <div class="nav-link">
        <a class="btn btn-link" href="./admin/index.php" role="button"><i class="material-icons mr-3">admin_panel_settings</i>Panel admin</a>
      </div>
      <?php } ?>

      <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>

      <div class="nav-link">
        <a class="btn btn-link" href="./admin/index.php?view=indicadores" role="button"><i class="material-icons mr-3">bar_chart</i>Indicadores</a>
      </div>


      <div class="nav-link nav-item " id="Reportes">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">
        <i class="material-icons mr-3">article</i>Reportes</button>
      </div>

      <div id="collapse1" class="collapse hide" data-parent="#accordion1">
        <ul class="navdrawer-nav">
          <li class="nav-item"><a class="nav-link" href="./admin/index.php?view=report"><i class="material-icons mr-3">assignment_add</i> Actividades</a></li>
          <li class="nav-item"><a class="nav-link" href="./index.php?view=services"><i class="material-icons mr-3">support_agent</i> Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="./admin/index.php?view=participants"><i class="material-icons mr-3">group</i> Participantes</a></li>
          <li class="nav-item"><a class="nav-link" href="./admin/index.php?view=products"><i class="material-icons mr-3">send_time_extension</i> Productos</a></li>
        </ul>
      </div>
      <!-- end collapse1 -->

      <!-- collapse2 -->

      <div class="nav-link nav-item inactive" id="heading2">
        <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">
        <i class="material-icons mr-3">camera_outdoor</i>Infocentros</button>
      </div>

      <div id="collapse2" class="collapse hide" data-parent="#accordion1">
        <ul class="navdrawer-nav">
          <li class="nav-item"><a class="nav-link" href="./admin/index.php?view=infocentros"><i class="material-icons mr-3">home</i> Datos básicos</a></li>
        </ul>
      </div>
      <!-- end collapse2 -->
      <?php } ?>

      


      <!-- collapse3 -->
      <!-- <div class="nav-link nav-item inactive" id="heading3">
        <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">
        <i class="material-icons mr-3">alarm_on</i>Gestión de usuarios</button>
      </div>

      <div id="collapse3" class="collapse hide" data-parent="#accordion1">
        <ul class="navdrawer-nav">
          <li class="nav-item"><a class="nav-link" href="#"><i class="material-icons mr-3">link</i> Link with icon</a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="material-icons mr-3">alarm_on</i> with icon</a></li>
        </ul>
      </div> -->
      <!-- end collapse3 -->
      
    </div>
      <!-- end accordion -->



    <div class="navdrawer-divider"></div>
      <p class="navdrawer-subheader">Configuración</p>

      <ul class="navdrawer-nav">
      <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8){ ?>
        <li class="nav-item"><a class="nav-link" href="./admin/index.php?view=users"><i class="material-icons mr-3">manage_accounts</i>Configuración</a></li>
      <?php }else {?>
        
        <li class="nav-item"><a class="nav-link" href="#"><i class="material-icons mr-3">manage_accounts</i>Configuración</a></li>

        <?php } ?>

        <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="material-icons mr-3">alarm_on</i>Planificación</a></li> -->
        <!-- <li class="nav-item"><a class="nav-link disabled" href="#"><i class="material-icons mr-3">alarm_off</i> Disabled with icon</a></li> -->
      </ul>

      <!-- <nav class="navdrawer-nav">
          <li class="list-group-item d-flex justify-content-between align-items-center"><i class="material-icons mr-3">alarm_on</i>Reportes del mes<span class="badge badge-primary badge-pill">14</span></li>
      </nav> -->

    <div class="navdrawer-divider"></div>

  </div>
  <!-- navdrawer-content -->

</div>
<!-- end side menu -->









<!-- <button data-target="#navdrawerDefault" data-toggle="navdrawer" type="button">Launch navigation drawer</button> -->



    <div class="content">
      <div class="container-fluid">
        <?php 
        // llama login si existe ID de usuario activo lo redirecciona al dashboard
          View::load("login");
        ?>
      </div>
    </div>

    <!-- <!?php 
      echo $_COOKIE['user_id']; 
      echo "<br />\n"; 
      echo 'session_id(): ' . session_id(); 
      echo "<br />\n"; 
      echo 'session_name(): ' . session_name(); 
      echo "<br />\n"; 
      print_r(session_get_cookie_params()); 
    ?> -->


  </body>








    <footer class="footer">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <ul>
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> Fundación Infocentro | con <span class="material-icons">favorite</span> y Software Libre
            </ul>
        </div>
      </div>
    </footer>


    

    
    <?php else:?>
      <br><br><br>
      
    <?php 
    if(isset($_GET["logintype"]) && $_GET["logintype"]=="signup"){
      View::load("signup");
 
    // registered viene de adduser-action | nuevo usuario creado
    }elseif (isset($_GET["logintype"]) && $_GET["logintype"]=="registered") {
      View::load("login");

    }elseif (!isset($_GET["logintype"])) {
      View::load("login");
    }

    if(isset($_GET["view"]) && $_GET["view"]!="index" && $_GET["view"]!="signup" && $_GET["view"]!="processlogin" && $_GET["view"]!="adduser"){
      print "<script>window.location='logout.php';</script>";
      // echo "XXXX: ".Session::getUID();
    }

    // echo "On layout";

    ?>


    <?php endif; ?>

    <!-- jQuery, Bootstrap Bundle (includes Popper) and Material -->
    <script src="assets/css/googleapi/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
  
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin></script> -->
    <script src="assets/css/googleapi/bootstrap.bundle.min.js" integrity="sha256-GRJrh0oydT1CwS36bBeJK/2TggpaUQC6GzTaTQdZm0k=" crossorigin></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha256-GRJrh0oydT1CwS36bBeJK/2TggpaUQC6GzTaTQdZm0k=" crossorigin></script> -->
    <script src="assets/css/googleapi/material.min.js" crossorigin></script>
    <!-- <script src="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/js/material.min.js" crossorigin></script> -->
    


    <!-- CoreUI and necessary plugins-->
    <!-- <script src="node_modules/jquery/dist/jquery.min.js"></script> -->

    <!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->

    <!-- <script src="core/app/usertheme/node_modules/popper.js/dist/umd/popper.min.js"></script> -->
    <!-- <script src="core/app/usertheme/node_modules/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script src="assets/node_modules/pace-progress/pace.min.js"></script>
    <!-- <script src="core/app/usertheme/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script> -->
    <!-- <script src="core/app/usertheme/node_modules/@coreui/coreui/dist/js/coreui.min.js"></script> -->


    <!-- Plugins and scripts required by this view-->
    <!-- <script src="core/app/usertheme/node_modules/chart.js/dist/Chart.min.js"></script> -->
    <!-- <script src="core/app/usertheme/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script> -->
    <!-- SweetAlert2 -->
    <script src="assets/node_modules/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/toast.js"></script>
    <script src="assets/css/googleapi/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script> -->


    <!-- toastify toast-->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> -->
    <script src="assets/js/toastify-js.js"></script>

    <!-- aqui se encuentra la func toastjs -->
    <script src="assets/js/demo.js"></script>








</html>


<script>
var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

function sidemenu(){
  $('#navdrawerDefault').navdrawer('toggle')
}



// document.getElementById("reportes").onclick = function() {
//   $('#collapse1').collapse('toggle');
//   $(this).toggleClass('active');
//   // $( this ).switchClass( "active", "inactive");

// }

// $('#collapse1').on('shown.bs.collapse', function () {
//   alert("colapse");
// })





// intervalo repetitivo
// setInterval(function(){
//   <!?php if(Session::getUID()!=""){ ?>
//     window.location='logout.php';
//     // alert("GGG");
//   <!?php } ?>
// }, 50000);


function darkSwitch(){
  const Tag = document.documentElement;
  if (Tag.dataset.theme == "dark"){
    Tag.dataset.theme = 'light';
    sessionStorage.setItem("darkSwitch", "light");
  }else{
    Tag.dataset.theme = 'dark';
    sessionStorage.setItem("darkSwitch", "dark");

  }

}






// carga el color del tema
document.documentElement.dataset.theme = sessionStorage.getItem("darkSwitch");
</script>



<style>

</style>