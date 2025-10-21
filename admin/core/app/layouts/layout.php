<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/material/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="uploads/icon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Infoapp</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="assets/plugins/font-awesome-4/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/googleapi/Material-icons.css">

  <!-- CSS Files -->
  <link href="assets/material/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="assets/material/assets/demo/demo.css" rel="stylesheet" />



  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css">
  <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="assets/plugins/ekko-lightbox/ekko-lightbox.css">

  <!-- mobile-detect.min -->
  <script src="assets/js/mobile-detect.min.js"></script>
  <script src="assets/js/jquery.min.js" type="text/javascript"></script>

  <!-- toastify toast-->
  <link href="assets/css/toastify.min.css" rel="stylesheet" />

  <link href="assets/css/views_responsive.css" rel="stylesheet" />
  <!-- MUI -->
  <script src="assets/mui-0.10.3/extra/mui-combined.min.js"></script>
  <!--  -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>





<?php
date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");
$view = $_GET["view"];
?>



<script language="javascript">
  $(document).ready(function() {


    // active menu
    <?php if ($view != "") { ?>

      view = '<?php echo $view; ?>';
      var menu = document.getElementsByClassName(view)[0];
      if (menu != null) {
        if (view == menu.id) {
          document.getElementById(menu.id).classList.add("active");
          // collapse menu
          let collapse = document.getElementById(menu.type);
          if (collapse != null) {
            document.getElementById(menu.type).classList.add("show");
            document.getElementsByClassName(menu.id)[0].classList.add("active");
          }
        }
      }
      // end active menu
    <?php } ?>
    // end active menu


    // inicializa los tooltip
    // $('[data-toggle="tooltip"]').tooltip({
    //   placement: 'top'
    //   // placement: 'bottom'
    // })

    // Swal.fire({
    // 	// position: 'top-center',
    // 	icon: 'warning',
    // 	title: 'En este momento estamos trabajando en el módulo de reportes.\nPor favor vuelve mas tarde',
    // 	showConfirmButton: true,
    // 	// timer: 1000
    // 	})

  });



  $(document).on("click", ".pdf", function() {
    var fileName = $(this).data('id');

    path = "uploads/doc/" + fileName; // To Hide Toolbar
    // path = "uploads/doc/Guia_Infoapp_1.pdf"; // To Hide Toolbar
    var src = $('#myframe').attr('src');;

    $('.modal-body #myframe').attr('src', path); //sets src value in  in modal iframe

  });
</script>


<body class="">
  <div class="wrapper ">


    <!-- The Modal -->
    <div class="modal" id="guia_info">
      <div class="modal-dialog" style="max-width: 80% !important;" role="document">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Guía de reportes Infoapp</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <iframe src="" width="100%" height="550px" id="myframe"></iframe>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
      </div>
    </div><!-- Model End   -->



    <?php if (isset($_SESSION["user_id"])) : ?>

      <div class="sidebar" data-color="azure" data-background-color="white" data-image="assets/material/assets/img/sidebar-1.jpg">
        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
      -->

        <div class="logo">
          <a href="./../index.php" class="simple-text"><img src="uploads/logo_info_p.png" style="max-width: 90px; min-height: 10px;" /></a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">


            <li class="nav-item">
              <a class="nav-link" href="./../index.php">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
                  </svg>
                </i>
                <p>Inicio</p>
              </a>
            </li>

            <li class="nav-item">
              <a style="color: #e91e63;" class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_guia">
                <i style="color: #e91e63;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M11.95 18q.525 0 .888-.363t.362-.887t-.362-.888t-.888-.362t-.887.363t-.363.887t.363.888t.887.362m-.9-3.85h1.85q0-.825.188-1.3t1.062-1.3q.65-.65 1.025-1.238T15.55 8.9q0-1.4-1.025-2.15T12.1 6q-1.425 0-2.312.75T8.55 8.55l1.65.65q.125-.45.563-.975T12.1 7.7q.8 0 1.2.438t.4.962q0 .5-.3.938t-.75.812q-1.1.975-1.35 1.475t-.25 1.825M12 22q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                  </svg></i>
                <p>Guías Infoapp</p>
              </a>
            </li>

            <div id="collapse_guia" class="panel-collapse collapse">
              <ul class="nav accordion">

                <li class="nav-item ">
                  <a data-toggle="modal" class="nav-link pdf" data-id="Guia_InfoApp_2.pdf" href="#guia_info">
                    <i>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3 20v-6l8-2l-8-2V4l19 8z" />
                      </svg>
                    </i>
                    <p>Carga de actividades</p>
                  </a>
                </li>

                <li class="nav-item ">
                  <a data-toggle="modal" class="nav-link pdf" data-id="Guia_Infoapp_1.pdf" href="#guia_info">
                    <i>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M2.625 14.025L1 12.85l5-8l3 3.5l4-6.5l3 4.5L19.375 1L21 2.175l-4.95 7.85l-2.975-4.475l-3.8 6.175L6.25 8.2zM14.5 18q1.05 0 1.775-.725T17 15.5t-.725-1.775T14.5 13t-1.775.725T12 15.5t.725 1.775T14.5 18m5.1 4l-2.7-2.7q-.525.35-1.137.525T14.5 20q-1.875 0-3.187-1.312T10 15.5t1.313-3.187T14.5 11t3.188 1.313T19 15.5q0 .65-.175 1.263T18.3 17.9l2.7 2.7z" />
                      </svg>

                    </i>
                    <p>Tipos de reportes</p>
                  </a>
                </li>



              </ul>
            </div class="collapse_report">

            <!-- <li class="nav-item ">
            <a class="nav-link" href="./../index.php?view=indicadores">
              <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 20v-7h4v7zm-6 0V4h4v16zm-6 0V9h4v11z"/></svg></i>
              <p>Indicadores</p>
            </a>
          </li> -->

            <?php if ($_SESSION["user_type"] != 0 && $_SESSION["user_type"] != 1) { ?>

              <!-- accordion mapa-->
              <li class="nav-item ">
                <a class="nav-link nav-primary" data-toggle="collapse" data-parent="#accordion" href="#collapse_map">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M12 22q-2.05 0-3.875-.788t-3.187-2.15t-2.15-3.187T2 12q0-2.075.788-3.887t2.15-3.175t3.187-2.15T12 2q2.075 0 3.888.788t3.174 2.15t2.15 3.175T22 12q0 2.05-.788 3.875t-2.15 3.188t-3.175 2.15T12 22m0-2.05q.65-.9 1.125-1.875T13.9 16h-3.8q.3 1.1.775 2.075T12 19.95m-2.6-.4q-.45-.825-.787-1.713T8.05 16H5.1q.725 1.25 1.813 2.175T9.4 19.55m5.2 0q1.4-.45 2.488-1.375T18.9 16h-2.95q-.225.95-.562 1.838T14.6 19.55M4.25 14h3.4q-.075-.5-.112-.987T7.5 12t.038-1.012T7.65 10h-3.4q-.125.5-.187.988T4 12t.063 1.013t.187.987m5.4 0h4.7q.075-.5.113-.987T14.5 12t-.038-1.012T14.35 10h-4.7q-.075.5-.112.988T9.5 12t.038 1.013t.112.987m6.7 0h3.4q.125-.5.188-.987T20 12t-.062-1.012T19.75 10h-3.4q.075.5.113.988T16.5 12t-.038 1.013t-.112.987m-.4-6h2.95q-.725-1.25-1.812-2.175T14.6 4.45q.45.825.788 1.713T15.95 8M10.1 8h3.8q-.3-1.1-.775-2.075T12 4.05q-.65.9-1.125 1.875T10.1 8m-5 0h2.95q.225-.95.563-1.838T9.4 4.45Q8 4.9 6.912 5.825T5.1 8" />
                    </svg></i>
                  <p>Mapa social</p>
                </a>
              </li>

              <div id="collapse_map" class="panel-collapse collapse">
                <ul class="nav accordion">

                  <li class="nav-item ">
                    <a class="nav-link socialmap" id="socialmap" type="socialmap1" href="./../index.php?view=socialmap">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M8.5 13.5h1.45l3.9-3.925l-1.425-1.425l-3.925 3.9zm6.075-4.65l.7-.7q.125-.125.125-.262t-.125-.263l-.9-.9q-.125-.125-.263-.125t-.262.125l-.7.7zM12 22q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2t5.588 2.225T20 10.2q0 2.5-1.987 5.438T12 22" />
                        </svg></i>
                      <p>Editar mapa</p>
                    </a>
                  </li>

                  <li class="nav-item ">
                    <a class="nav-link reportsocialmap" id="reportsocialmap" type="socialmap1" href="./../index.php?view=reportsocialmap">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M2.625 14.025L1 12.85l5-8l3 3.5l4-6.5l3 4.5L19.375 1L21 2.175l-4.95 7.85l-2.975-4.475l-3.8 6.175L6.25 8.2zM14.5 18q1.05 0 1.775-.725T17 15.5t-.725-1.775T14.5 13t-1.775.725T12 15.5t.725 1.775T14.5 18m5.1 4l-2.7-2.7q-.525.35-1.137.525T14.5 20q-1.875 0-3.187-1.312T10 15.5t1.313-3.187T14.5 11t3.188 1.313T19 15.5q0 .65-.175 1.263T18.3 17.9l2.7 2.7z" />
                        </svg></i>
                      <p>Reportes mapa</p>
                    </a>
                  </li>

                  <li class="nav-item ">
                    <a class="nav-link socialmaporg" id="socialmaporg" type="socialmap1" href="./../index.php?view=socialmaporg">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M17 9h2V7h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zM1 21V11l7-5l7 5v10h-5v-6H6v6zm16 0V10l-7-5.05V3h13v18z" />
                        </svg></i>
                      <p>Organizaciones</p>
                    </a>
                  </li>

                  <li class="nav-item ">
                    <a class="nav-link inst_educativas" id="inst_educativas" type="socialmap1" href="./../index.php?view=inst_educativas">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M17 9h2V7h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zM1 21V11l7-5l7 5v10h-5v-6H6v6zm16 0V10l-7-5.05V3h13v18z" />
                        </svg></i>
                      <p>Inst-educativas</p>
                    </a>
                  </li>

                </ul>
              </div class="collapse_report">
              <!-- fin accordion mapa -->



              <!-- accordion planificacion-->
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_planning">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M3 20v-6l8-2l-8-2V4l14.3 6H17q-2.925 0-4.962 2.063T10 17.05zm14 2q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m1.65-2.65l.7-.7l-1.85-1.85V14h-1v3.2z" />
                    </svg></i>
                  <p>Planificación</p>
                </a>
              </li>

              <div id="collapse_planning" class="collapse">
                <ul class="nav accordion">

                  <li class="nav-item planning" id="planning" type="collapse_planning">
                    <a class="nav-link" href="./?view=planning">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h9v2H5v14h14v-9h2v9q0 .825-.587 1.413T19 21zm3-4v-2h8v2zm0-3v-2h8v2zm0-3V9h8v2zm9-2V7h-2V5h2V3h2v2h2v2h-2v2z" />
                        </svg></i>
                      <p>Planificación</p>
                    </a>
                  </li>

                </ul>
              </div class="collapse_report">
              <!-- fin accordion planificacion -->




              <!-- accordion reportes-->
              <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_report">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M3 20v-6l8-2l-8-2V4l19 8z" />
                    </svg></i>
                  <p>Reportes</p>
                </a>
              </li>

              <div id="collapse_report" class="panel-collapse collapse">
                <ul class="nav accordion">

                  <li class="nav-item report" id="report" type="collapse_report">
                    <a class="nav-link" href="./?view=report">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5h-2v3H7V5H5zm7-14q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5" />
                        </svg></i>
                      <p>Actividades</p>
                    </a>
                  </li>

                  <!-- <li class="nav-item services" id="services" type="collapse_report">
                    <a class="nav-link" href="./index.php?view=services">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M11 21v-2h8v-7.1q0-2.925-2.037-4.962T12 4.9T7.038 6.938T5 11.9V18H4q-.825 0-1.412-.587T2 16v-2q0-.525.263-.987T3 12.275l.075-1.325q.2-1.7.988-3.15t1.975-2.525T8.762 3.6T12 3t3.225.6t2.725 1.663t1.975 2.512t1 3.15l.075 1.3q.475.225.738.675t.262.95v2.3q0 .5-.262.95t-.738.675V19q0 .825-.587 1.413T19 21zm-2-7q-.425 0-.712-.288T8 13t.288-.712T9 12t.713.288T10 13t-.288.713T9 14m6 0q-.425 0-.712-.288T14 13t.288-.712T15 12t.713.288T16 13t-.288.713T15 14m-8.975-1.55Q5.85 9.8 7.625 7.9T12.05 6q2.225 0 3.913 1.412T18 11.026Q15.725 11 13.813 9.8t-2.938-3.25q-.4 2-1.687 3.563T6.025 12.45" />
                        </svg></i>
                      <p>Servicios</p>
                    </a>
                  </li> -->

                  <li class="nav-item participants" id="participants" type="collapse_report">
                    <a class="nav-link" href="./?view=participants">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8" />
                        </svg></i>
                      <p>Participantes</p>
                    </a>
                  </li>

                  <li class="nav-item products" id="products" type="collapse_report">
                    <a class="nav-link" href="./?view=products">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M5 21q-1.275 0-1.812-1.137t.262-2.113L9 11V5H8q-.425 0-.712-.288T7 4t.288-.712T8 3h8q.425 0 .713.288T17 4t-.288.713T16 5h-1v6l5.55 6.75q.8.975.263 2.113T19 21z" />
                        </svg></i>
                      <p>Productos</p>
                    </a>
                  </li>

                  <!-- <li class="nav-item log_deleted" id="log_deleted" type="collapse_report">
                    <a class="nav-link" href="./?view=log_deleted">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M12 21q-3.45 0-6.012-2.287T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.037T19 12t-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924t1.925 2.85T21 12t-.712 3.513t-1.925 2.85t-2.85 1.925T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                        </svg></i>
                      <p>Historial</p>
                    </a>
                  </li> -->

                </ul>
              </div class="collapse_report">
              <!-- fin accordion reportes -->



            <?php } ?>


            <!-- accordion infocentros-->
            <?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>

              <!-- accordion infocentros-->
              <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_info">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M17 9h2V7h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zM1 21V11l7-5l7 5v10h-5v-6H6v6zm16 0V10l-7-5.05V3h13v18z" />
                    </svg></i>
                  <p>Infocentros</p>
                </a>
              </li>

            <?php } ?>

            <div id="collapse_info" class="panel-collapse collapse">
              <ul class="nav accordion">

                <li class="nav-item infocentros" id="infocentros" type="collapse_info">
                  <a class="nav-link" href="./?view=infocentros">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5h-2v3H7V5H5zm7-14q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5" />
                      </svg></i>
                    <p>Datos básicos</p>
                  </a>
                </li>

                <!-- <li class="nav-item inventory" id="inventory" type="collapse_info">
                  <a class="nav-link" href="./?view=inventory">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5h-2v3H7V5H5zm7-14q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5" />
                      </svg></i>
                    <p>Inventario</p>
                  </a>
                </li>

                <li class="nav-item process" id="process" type="collapse_info">
                  <a class="nav-link" href="./?view=process">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5h-2v3H7V5H5zm7-14q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5" />
                      </svg></i>
                    <p>Procesos</p>
                  </a>
                </li> -->

              </ul>
            </div class="collapse_info">
            <!-- fin accordion infocentros -->


            <!-- accordion personal-->
            <!-- <!?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?> -->
            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>

              <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_personal">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M2 20v-2.8q0-.85.425-1.562T3.6 14.55q1.5-.75 3.113-1.15T10 13q.625 0 1.25.088t1.25.212v1.575q-1.125.55-1.812 1.45T10 18.675V20zm10 0v-1.4q0-.6.313-1.112t.887-.738q.9-.375 1.863-.562T17 16t1.938.188t1.862.562q.575.225.888.738T22 18.6V20zm5-5q-1.05 0-1.775-.725T14.5 12.5t.725-1.775T17 10t1.775.725t.725 1.775t-.725 1.775T17 15m-7-3q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
                    </svg></i>
                  <p>Gestión humana</p>
                </a>
              </li>

            <?php } ?>


            <div id="collapse_personal" class="panel-collapse collapse">
              <ul class="nav accordion">

                <?php if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>


                  <li class="nav-item facilitators" id="facilitators" type="collapse_personal">
                    <a class="nav-link" href="./?view=facilitators">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M9.775 12q-.9 0-1.5-.675T7.8 9.75l.325-2.45q.2-1.425 1.3-2.363T12 4t2.575.938t1.3 2.362l.325 2.45q.125.9-.475 1.575t-1.5.675zM4 20v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z" />
                        </svg></i>
                      <p>Facilitadores</p>
                    </a>
                  </li>

                  <li class="nav-item coordinator" id="coordinator" type="collapse_personal">
                    <a class="nav-link" href="./?view=coordinator">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M12 13q-1.65 0-2.825-1.175T8 9V5.5q0-.625.438-1.062T9.5 4q.375 0 .713.175t.537.5q.2-.325.538-.5T12 4t.713.175t.537.5q.2-.325.538-.5T14.5 4q.625 0 1.063.438T16 5.5V9q0 1.65-1.175 2.825T12 13m-8 8v-2.8q0-.85.438-1.562T5.6 15.55q1.55-.775 3.15-1.162T12 14t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 18.2V21z" />
                        </svg></i>
                      <p>Coordinadores</p>
                    </a>
                  </li>

                  <?php if ($_SESSION["user_type"] != 8 && $_SESSION["user_type"] != 3) { ?>
                    <!-- <li class="nav-item gerencias" id="gerencias" type="collapse_personal">
                      <a class="nav-link" href="./?view=gerencias">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
                          </svg></i>
                        <p>Gerencias</p>
                      </a>
                    </li> -->
                  <?php } ?>

                <?php } ?>

                <li class="nav-item final_users" id="final_users" type="collapse_personal">
                  <a class="nav-link" href="./?view=final_users">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8" />
                      </svg></i>
                    <p>Usuarios</p>
                  </a>
                </li>


              </ul>
            </div class="collapse_personal">
            <!-- fin accordion infocentros -->



            <!-- accordion regiones-->
            <?php if ($_SESSION["user_type"] != 10) { ?>
              <?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8) { ?>
                <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_reg">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m15 21l-6-2.1l-4.65 1.8q-.5.2-.925-.112T3 19.75v-14q0-.325.188-.575T3.7 4.8L9 3l6 2.1l4.65-1.8q.5-.2.925.113T21 4.25v14q0 .325-.187.575t-.513.375zm-1-2.45V6.85l-4-1.4v11.7z"/></svg></i>
                <p>Regiones</p>
              </a>
            </li>
              <?php } ?>
            <?php } ?>


            <div id="collapse_reg" class="panel-collapse collapse">
              <ul class="nav accordion">

                <!-- <li class="nav-item estados" id="estados" type="collapse_reg">
                  <a class="nav-link" href="./?view=estados">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m15 21l-6-2.1l-4.65 1.8q-.5.2-.925-.112T3 19.75v-14q0-.325.188-.575T3.7 4.8L9 3l6 2.1l4.65-1.8q.5-.2.925.113T21 4.25v14q0 .325-.187.575t-.513.375zm-1-2.45V6.85l-4-1.4v11.7z" />
                      </svg></i>
                    <p>Estados</p>
                  </a>
                </li>

                <li class="nav-item municipios" id="municipios" type="collapse_reg">
                  <a class="nav-link" href="./?view=municipios">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 12q.825 0 1.413-.587T14 10t-.587-1.412T12 8t-1.412.588T10 10t.588 1.413T12 12m0 10q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2t5.588 2.225T20 10.2q0 2.5-1.987 5.438T12 22" />
                      </svg></i>
                    <p>Municipios</p>
                  </a>
                </li> -->

                <li class="nav-item parroquias" id="parroquias" type="collapse_reg">
                  <a class="nav-link" href="./?view=parroquias">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m16 12l2 2v2h-5v6l-1 1l-1-1v-6H6v-2l2-2V5H7V3h10v2h-1z" />
                      </svg></i>
                    <p>Parroquias</p>
                  </a>
                </li>

                <li class="nav-item ciudades1" id="ciudades1" type="collapse_reg">
                  <a class="nav-link" href="./?view=ciudades">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m16 12l2 2v2h-5v6l-1 1l-1-1v-6H6v-2l2-2V5H7V3h10v2h-1z" />
                      </svg></i>
                    <p>Ciudades</p>
                  </a>
                </li>

              </ul>
            </div class="collapse_reg">
            <!-- fin accordion regiones -->

            <li class="nav-item ">
                <!-- <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_brigadas">
                  <i><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                      width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                    </svg></i>
                  <p>Brigadas</p>
                </a>
              </li> -->

              <div id="collapse_brigadas" class="panel-collapse collapse">
                <ul class="nav accordion">

                  <li class="nav-item brigadas" id="brigadas" type="collapse_brigadas">
                    <a class="nav-link" href="./?view=brigadas">
                      <i><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                      width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                    </svg></i>
                      <p>Brigadas</p>
                    </a>
                  </li>

                  <li class="nav-item brigadistas" id="brigadistas" type="collapse_brigadas">
                    <a class="nav-link" href="./index.php?view=brigadistas">
                      <i><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                      width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                    </svg></i>
                      <p>Brigadistas</p>
                    </a>
                  </li>
                </ul>
              </div class="collapse_brigadistas">



            <!-- accordion datos-->
            <?php if ($_SESSION["user_type"] != 10) { ?>
              <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

                <li class="nav-item ">
                  <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_data">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 20q-.825 0-1.412-.587T3 18V4q0-.825.588-1.412T5 2h14q.825 0 1.413.588T21 4v7.075q-.25-.05-.488-.062T20 11h-6q-.925 0-1.763.263T10.676 12H7v4h1.075q-.05.25-.062.488T8 17q0 .8.2 1.563T8.8 20zm2-10h4V6H7zm7 11q-1.65 0-2.825-1.175T10 17t1.175-2.825T14 13h2v2h-2q-.825 0-1.412.588T12 17t.588 1.413T14 19h2v2zm-1-11h4V6h-4zm1 8v-2h6v2zm4 3v-2h2q.825 0 1.413-.587T22 17t-.587-1.412T20 15h-2v-2h2q1.65 0 2.825 1.163T24 17q0 1.65-1.175 2.825T20 21z" />
                      </svg></i>
                    <p>Datos</p>
                  </a>
                </li>
              <?php } ?>
            <?php } ?>


            <div id="collapse_data" class="panel-collapse collapse">
              <ul class="nav accordion">

                <!-- <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=8&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v5h-2v-1H5v10h7v2zm9 0v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zm6.575-5.6l.925-.975l-.925-.925l-.95.95z" />
                      </svg></i>
                    <p>Fecha de reportes</p>
                  </a>
                </li> -->

                <!-- <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=1&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M6 22L22 5.95V22zm12-2h2v-9.2l-2 2zm-6.95-6.9q-.6 0-1.05-.45t-.45-1.05t.45-1.05t1.05-.45t1.05.45t.45 1.05t-.45 1.05t-1.05.45m-3.2-3.3l-1.3-1.3q.95-.95 2.1-1.4t2.4-.45t2.4.45t2.1 1.4l-1.3 1.3q-.675-.675-1.5-1.012t-1.7-.338t-1.7.338T7.85 9.8M5.3 7.2L4 5.95q1.475-1.475 3.3-2.212T11.05 3t3.775.738T18.15 5.95l-1.3 1.25q-1.2-1.2-2.713-1.775T11.05 4.85t-3.062.575T5.3 7.2" />
                      </svg></i>
                    <p>Tipo de internet</p>
                  </a>
                </li>

                <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=2&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 20q-.825 0-1.412-.587T3 18V4q0-.825.588-1.412T5 2h14q.825 0 1.413.588T21 4v7.075q-.25-.05-.488-.062T20 11h-6q-.925 0-1.763.263T10.676 12H7v4h1.075q-.05.25-.062.488T8 17q0 .8.2 1.563T8.8 20zm2-10h4V6H7zm7 11q-1.65 0-2.825-1.175T10 17t1.175-2.825T14 13h2v2h-2q-.825 0-1.412.588T12 17t.588 1.413T14 19h2v2zm-1-11h4V6h-4zm1 8v-2h6v2zm4 3v-2h2q.825 0 1.413-.587T22 17t-.587-1.412T20 15h-2v-2h2q1.65 0 2.825 1.163T24 17q0 1.65-1.175 2.825T20 21z" />
                      </svg></i>
                    <p>Operatividad</p>
                  </a>
                </li>

                <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=3&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M8 20h8v-3q0-1.65-1.175-2.825T12 13t-2.825 1.175T8 17zm-4 2v-2h2v-3q0-1.525.713-2.863T8.7 12q-1.275-.8-1.987-2.137T6 7V4H4V2h16v2h-2v3q0 1.525-.712 2.863T15.3 12q1.275.8 1.988 2.138T18 17v3h2v2z" />
                      </svg></i>
                    <p>Tipo de estatus</p>
                  </a>
                </li> -->
<!-- 
                <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=9&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-1.275 0-1.812-1.137t.262-2.113L9 11V5H8q-.425 0-.712-.288T7 4t.288-.712T8 3h8q.425 0 .713.288T17 4t-.288.713T16 5h-1v6l5.55 6.75q.8.975.263 2.113T19 21z" />
                      </svg></i>
                    <p>Categoría de productos</p>
                  </a>
                </li> -->

                <!-- <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=11&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-1.275 0-1.812-1.137t.262-2.113L9 11V5H8q-.425 0-.712-.288T7 4t.288-.712T8 3h8q.425 0 .713.288T17 4t-.288.713T16 5h-1v6l5.55 6.75q.8.975.263 2.113T19 21z" />
                      </svg></i>
                    <p>Tipo de productos</p>
                  </a>
                </li> -->

                <!-- <li class="nav-item social_medias" id="social_medias" type="collapse_data">
                  <a class="nav-link" href="./?view=social_medias&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Redes sociales</p>
                  </a>
                </li> -->

                <li class="nav-item action_line" id="action_line" type="collapse_data">
                  <a class="nav-link" href="./?view=action_line&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Línea de acción</p>
                  </a>
                </li>

                <li class="nav-item strategic_action" id="strategic_action" type="collapse_data">
                  <a class="nav-link" href="./?view=strategic_action&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Acciones estratégicas</p>
                  </a>
                </li>

                <li class="nav-item specific_action" id="specific_action" type="collapse_data">
                  <a class="nav-link" href="./?view=specific_action&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Acciones específicas</p>
                  </a>
                </li>

                <li class="nav-item training_type" id="training_type" type="collapse_data">
                  <a class="nav-link" href="./?view=training_type&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Categoría formación</p>
                  </a>
                </li>

                <li class="nav-item tipo_taller_view" id="tipo_taller_view" type="collapse_data">
                  <a class="nav-link" href="./?view=tipo_taller_view&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Tipo talleres</p>
                  </a>
                </li>

                <!-- <li class="nav-item level_training" id="level_training" type="collapse_data">
                  <a class="nav-link" href="./?view=level_training&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                      </svg></i>
                    <p>Nivel de formaciones</p>
                  </a>
                </li> -->

                <!-- <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=5&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15 21v-3h-4V8H9v3H2V3h7v3h6V3h7v8h-7V8h-2v8h2v-3h7v8z" />
                      </svg></i>
                    <p>Coordinaciones</p>
                  </a>
                </li>

                <li class="nav-item data" id="data" type="collapse_data">
                  <a class="nav-link" href="./?view=data&type=6&swal=">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19.95 15.95L18.4 14.4q1.1-1.025 1.725-2.425T20.75 9t-.625-2.95t-1.725-2.4l1.55-1.6q1.4 1.325 2.225 3.125T23 9t-.825 3.825t-2.225 3.125m-3.2-3.2l-1.6-1.6q.45-.425.725-.962T16.15 9t-.275-1.187t-.725-.963l1.6-1.6q.8.725 1.25 1.688T18.45 9T18 11.063t-1.25 1.687M9 13q-1.65 0-2.825-1.175T5 9t1.175-2.825T9 5t2.825 1.175T13 9t-1.175 2.825T9 13m-8 8v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T9 14t3.525.45t2.875 1.1q.75.375 1.175 1.1T17 18.2V21z" />
                      </svg></i>
                    <p>Tipo responsable</p>
                  </a>
                </li> -->

                <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

                  <!-- <li class="nav-item data" id="data" type="collapse_data">
                    <a class="nav-link" href="./?view=data&type=7&swal=">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
                        </svg></i>
                      <p>Tipo de usuario</p>
                    </a>
                  </li>

                  <li class="nav-item services_type" id="services_type" type="collapse_data">
                    <a class="nav-link" href="./?view=services_type&swal=">
                      <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
                        </svg></i>
                      <p>Tipo de servicios</p>
                    </a>
                  </li> -->
                <?php } ?>

              </ul>
            </div class="collapse_data">
            <!-- fin accordion datos -->


            <!-- accordion datos ROOT -->
            <?php if ($_SESSION["user_type"] == 7) { ?>
              <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#collapse_data_root">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M1 21L12 2l11 19zm11-3q.425 0 .713-.288T13 17t-.288-.712T12 16t-.712.288T11 17t.288.713T12 18m-1-3h2v-5h-2z" />
                    </svg></i>
                  <p>SOLO-ROOT</p>
                </a>
              </li>
            <?php } ?>

            <div id="collapse_data_root" class="panel-collapse collapse">
              <ul class="nav accordion">

                <li class="nav-item database" id="database" type="collapse_data_root">
                  <a class="nav-link" href="./?view=database">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11.025 21.95q-3.85-.375-6.425-3.225T2.025 12T4.6 5.275t6.425-3.225v3q-2.6.35-4.3 2.325T5.025 12t1.7 4.625t4.3 2.325zm2 0v-3q2.35-.3 3.975-1.95t1.975-4h3q-.35 3.575-2.863 6.088t-6.087 2.862M18.975 11Q18.625 8.65 17 7t-3.975-1.95v-3q3.575.35 6.088 2.863T21.975 11z" />
                      </svg></i>
                    <p>Database</p>
                  </a>
                </li>

                <li class="nav-item databasePg" id="databasePg" type="collapse_data_root">
                  <a class="nav-link" href="./?view=databasePg">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11.025 21.95q-3.85-.375-6.425-3.225T2.025 12T4.6 5.275t6.425-3.225v3q-2.6.35-4.3 2.325T5.025 12t1.7 4.625t4.3 2.325zm2 0v-3q2.35-.3 3.975-1.95t1.975-4h3q-.35 3.575-2.863 6.088t-6.087 2.862M18.975 11Q18.625 8.65 17 7t-3.975-1.95v-3q3.575.35 6.088 2.863T21.975 11z" />
                      </svg></i>
                    <p>DatabasePg</p>
                  </a>
                </li>

              </ul>
            </div class="collapse_data_root">
            <!-- fin accordion datos ROOT-->

            <?php if ($_SESSION["user_type"] != 0 && $_SESSION["user_type"] != 1 && $_SESSION["user_type"] != 2 && $_SESSION["user_type"] != 10) { ?>
              <!-- <li class="nav-item ">
                <a class="nav-link" href="./../backup/Reportes/">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M11 20H6.5q-2.275 0-3.887-1.575T1 14.575q0-1.95 1.175-3.475T5.25 9.15q.625-2.3 2.5-3.725T12 4q2.925 0 4.963 2.038T19 11q1.725.2 2.863 1.488T23 15.5q0 1.875-1.312 3.188T18.5 20H13v-7.15l1.6 1.55L16 13l-4-4l-4 4l1.4 1.4l1.6-1.55z" />
                    </svg></i>
                  <p>Respaldos</p>
                </a>
              </li> -->
            <?php } ?>


            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" data-parent="#accordion" href="#manage_accounts">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
                  </svg></i>
                <p>Configuración</p>
              </a>
            </li>
            <div id="manage_accounts" class="panel-collapse collapse">
              <ul class="nav accordion">

                <li class="nav-item users" id="users" type="manage_accounts">
                  <a class="nav-link" href="./?view=users">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9 14.25q-.525 0-.888-.363T7.75 13t.363-.888T9 11.75t.888.363t.362.887t-.363.888T9 14.25m6 0q-.525 0-.888-.363T13.75 13t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362M12 20q3.35 0 5.675-2.325T20 12q0-.6-.075-1.162T19.65 9.75q-.525.125-1.05.188T17.5 10q-2.275 0-4.3-.975T9.75 6.3q-.8 1.95-2.287 3.388T4 11.85V12q0 3.35 2.325 5.675T12 20m0 2q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                      </svg></i>
                    <p>Usuario</p>
                  </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="./../index.php?view=userform_update">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 22q-.825 0-1.412-.587T2 20V9q0-.825.588-1.412T4 7h5V4q0-.825.588-1.412T11 2h2q.825 0 1.413.588T15 4v3h5q.825 0 1.413.588T22 9v11q0 .825-.587 1.413T20 22zm2-4h6v-.45q0-.425-.238-.788T11.1 16.2q-.5-.225-1.012-.337T9 15.75t-1.088.113T6.9 16.2q-.425.2-.663.563T6 17.55zm8-1.5h4V15h-4zM9 15q.625 0 1.063-.437T10.5 13.5t-.437-1.062T9 12t-1.062.438T7.5 13.5t.438 1.063T9 15m5-1.5h4V12h-4zM11 9h2V4h-2z" />
                      </svg></i>
                    <p>Perfil</p>
                  </a>
                </li>

              </ul>
            </div class="manage_accounts">

            




            <li class="nav-item ">
              <a class="nav-link" href="./../index.php?view=doc">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m-2.9-2.55l1.2-2.75q-1.05-.375-1.812-1.162T7.3 13.7l-2.75 1.15q.575 1.6 1.775 2.8t2.775 1.8M7.3 10.3q.425-1.05 1.188-1.837T10.3 7.3L9.15 4.55q-1.6.6-2.8 1.8t-1.8 2.8zM12 15q1.25 0 2.125-.875T15 12t-.875-2.125T12 9t-2.125.875T9 12t.875 2.125T12 15m2.9 4.45q1.575-.6 2.763-1.787T19.45 14.9l-2.75-1.2q-.375 1.05-1.15 1.813t-1.8 1.187zm1.8-9.2l2.75-1.15q-.6-1.575-1.787-2.762T14.9 4.55l-1.15 2.8q1.025.375 1.775 1.138T16.7 10.25" />
                  </svg></i>
                <p>Documentación</p>
              </a>
            </li>

            <li class="nav-item ">
              <a class="nav-link" href="./../logout.php">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                  </svg></i>
                <p>Salir</p>
              </a>
            </li>



          </ul>
        </div>
      </div>



      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="javascript:;"><?php echo $_SESSION["user_region"] ?> | <?php echo $_SESSION["user_username"] ?> | UID: <?php echo $_SESSION["user_id"] ?></a>
            </div>


            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end">
              <ul class="navbar-nav">


                <li class="nav-item dropdown">
                  <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z" />
                      </svg></i>
                    <p class="d-lg-none d-md-block">
                      Sesión
                    </p>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                    <p class="dropdown-item"><i class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z" />
                        </svg></i> User ID: <?php echo $_SESSION["user_id"] ?></p>
                    <p class="dropdown-item"><i class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M3 11V3h8v8zm2-2h4V5H5zM3 21v-8h8v8zm2-2h4v-4H5zm8-8V3h8v8zm2-2h4V5h-4zm4 12v-2h2v2zm-6-6v-2h2v2zm2 2v-2h2v2zm-2 2v-2h2v2zm2 2v-2h2v2zm2-2v-2h2v2zm0-4v-2h2v2zm2 2v-2h2v2z" />
                        </svg></i> Code info: <?php echo $_SESSION["user_code_info"] ?></p>
                    <p class="dropdown-item"><i class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M12 22q-3.475-.875-5.738-3.988T4 11.1V5l8-3l8 3v6.1q0 3.8-2.262 6.913T12 22m0-2.1q2.425-.75 4.05-2.963T17.95 12H12V4.125l-6 2.25v5.175q0 .175.05.45H12z" />
                        </svg></i> Permisos: <?php echo $_SESSION["user_type"] ?></p>
                    <p class="dropdown-item"><i class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M4 22q-.825 0-1.412-.587T2 20V9q0-.825.588-1.412T4 7h5V4q0-.825.588-1.412T11 2h2q.825 0 1.413.588T15 4v3h5q.825 0 1.413.588T22 9v11q0 .825-.587 1.413T20 22zm2-4h6v-.45q0-.425-.238-.788T11.1 16.2q-.5-.225-1.012-.337T9 15.75t-1.088.113T6.9 16.2q-.425.2-.663.563T6 17.55zm8-1.5h4V15h-4zM9 15q.625 0 1.063-.437T10.5 13.5t-.437-1.062T9 12t-1.062.438T7.5 13.5t.438 1.063T9 15m5-1.5h4V12h-4zM11 9h2V4h-2z" />
                        </svg> </i> Rol: <?php echo $_SESSION["user_rol"] ?></p>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./../logout.php"><i class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                        </svg></i> Salir</a>
                  </div>
                </li>
              </ul>

            </div>

          </div>
        </nav>
        <!-- End Navbar -->


        <div class="content">
          <?php
          View::load("home");
          ?>

        </div>


        <footer class="footer">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <ul>
                Copyright &copy;<script>
                  document.write(new Date().getFullYear());
                </script> | Fundación Infocentro
              </ul>
            </div>
            <div class="row justify-content-center">
              <ul>
                Con <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m12 21l-1.45-1.3q-2.525-2.275-4.175-3.925T3.75 12.812T2.388 10.4T2 8.15Q2 5.8 3.575 4.225T7.5 2.65q1.3 0 2.475.55T12 4.75q.85-1 2.025-1.55t2.475-.55q2.35 0 3.925 1.575T22 8.15q0 1.15-.387 2.25t-1.363 2.412t-2.625 2.963T13.45 19.7z" />
                  </svg></span> y Software Libre
              </ul>
            </div>
          </div>
        </footer>

      </div>
  </div>
</body>

</html>


<?php else : ?>
  <?php
      if (!isset($_SESSION['user_id'])) {
        print "<script>window.location='./../index.php';</script>";
      }

      echo "else admin";
  ?>

<?php endif; ?>



<!--   Core JS Files   -->
<script src="assets/material/assets/js/core/popper.min.js"></script>
<script src="assets/material/assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/material/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="assets/material/assets/js/plugins/moment.min.js"></script>
<!-- Plugin for Sweet Alert -->
<script src="assets/material/assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="assets/material/assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/material/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!-- Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/material/assets/js/plugins/bootstrap-selectpicker.js"></script>
<!-- Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="assets/material/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>









<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/material/assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/material/assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="assets/material/assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="assets/material/assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/material/assets/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> -->
<script src="assets/js/ajax-core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/material/assets/js/plugins/arrive.min.js"></script>
<!-- Chartist JS -->
<script src="assets/material/assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/material/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/material/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>

<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- InputMask -->
<script src="assets/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/3/chart.min.js"></script>
<script src="assets/plugins/chart.js/chartjs-plugin-datalabels.min.js"></script>


<!-- Ekko Lightbox -->
<script src="assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->

<!-- SweetAlert2 -->
<script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>



<!-- toastify toast-->
<script src="assets/js/toastify-js.js"></script>

<!-- aqui se encuentra la func toastjs -->
<script src="assets/js/demo.js"></script>

<script src="assets/googleapi/material.min.js" crossorigin></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src='assets/fullcalendar/dist/index.global.js'></script>

<script>
  $(document).ready(function() {
    $().ready(function() {
      $sidebar = $('.sidebar');

      $sidebar_img_container = $sidebar.find('.sidebar-background');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

      if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
        if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
          $('.fixed-plugin .dropdown').addClass('open');
        }

      }











    });
  });
</script>

<style>
  @media only screen and (min-width: 768px) {

    .accordion {
      font-size: 24px;
      color: #d30c5f;
      background: #e3e3e3;
    }

    .accordion_text {
      color: #131313;
    }

  }

  @media only screen and (max-width: 767px) {

    .accordion {
      font-size: 24px;
      color: #2d2d2d;
      margin-right: 10px;
      background: #E1E1E1FF;
    }

    .accordion_text {
      color: #ffffff;
    }

    .sidebar .nav i {
      color: #848484FF;
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
