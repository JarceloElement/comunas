<!DOCTYPE html>
<html lang="es">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Infocentro en un clic | Promoviendo la inclusión digital">
  <meta name="author" content="infocentro.gob.ve">
  <meta name="keyword" content="Infocentro, Amazonas, Venezuela">
  <title>InfoApp</title>
  <link rel="icon" type="image/png" href="uploads/icon_info.png" />

  <!-- Main styles for this application-->
  <link href="assets/node_modules/pace-progress/css/pace.min.css" rel="stylesheet">
  <link href="assets/css/views_styles.css" rel="stylesheet" />
  <link href="assets/timeline/timeline.css" rel="stylesheet" />

  <!-- Material CSS -->
  <link href="assets/css/googleapi/material.min.css" rel="stylesheet" crossorigin>
  <!-- <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material.min.css" rel="stylesheet" crossorigin> -->

  <!-- Icon material -->
  <link href="assets/googleapi/Material-icons.css" rel="stylesheet" crossorigin>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/node_modules/sweetalert2/sweetalert2.css">

  <script src="assets/css/googleapi/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>

  <link href="assets/css/select2.min.css" rel="stylesheet">



  <!-- navbar Material Design -->
  <link href="assets/css/googleapi/material-components-web.min.css" rel="stylesheet">

  <!-- toastify toast-->
  <link href="assets/css/toastify.min.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css" />

  <link rel="stylesheet" type="text/css" href="assets/plugins/intl-tel-input-master/intlTelInput.min.css" />



  <!-- tadatable -->
  <link href="assets/datatables/js/css/datatables.css" rel="stylesheet" crossorigin>
  <link href="assets/datatables/js/css/material-plugins.min.css" rel="stylesheet" crossorigin>

  <script src="assets/datatables/js/pdfmake.min.js" integrity="sha256-Xf58sgO5ClVXPyDzPH+NtjN52HMC0YXBJ3rp8sWnyUk="
    crossorigin></script>
  <script src="assets/datatables/js/vfs_fonts.js" integrity="sha256-vEmrkqA2KrdjNo0/IWMNelI6jHuWAOkIJxGf88r4iic="
    crossorigin></script>
  <script src="assets/datatables/js/datatables.min.js" crossorigin></script>

  <?php
  date_default_timezone_set('UTC');
  date_default_timezone_set("America/La_Paz");
  $view = $_GET["view"];




  ?>

</head>


<?php
$session_id = isset($_SESSION['session_id']) ? $_SESSION['session_id'] : "";
$user_username = isset($_SESSION['user_username']) ? $_SESSION['user_username'] : "";

?>




<script language="javascript">
  $(document).ready(function () {

    // inicializa los tooltip
    $('[data-toggle="tooltip"]').tooltip({
      placement: 'top'
      // placement: 'bottom'
    })

    <?php if ($session_id != "") { ?>
      // actualiza las sessiones activas en BD al caducar la session
      let identificadorIntervaloDeTiempo;
      repetirCadaSegundo();
    <?php } ?>

    function repetirCadaSegundo() {
      // 600.000 10 minutos
      identificadorIntervaloDeTiempo = setInterval(mandarMensaje, 50000);
    }

    function mandarMensaje() {
      $.post("core/app/view/GetActiveSession.php", {
        user_id: localStorage.getItem('usersession'),
        user_username: '<?php echo $user_username; ?>',
        session_id: '<?php echo $session_id; ?>'

      }, function (data) {
        var array = JSON.parse(data);
        console.log("Sesiones activas:", array["total"]);
        console.log("SesionID:", '<?php echo $_SESSION['session_id']; ?>');
        if (array["active_session"] == "Session_cerrada") {
          console.log(array["active_session"]);
        }
      });
    }


  })
</script>



<?php if (Session::getUID() != ""): ?>


  <body class="app_user">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">



      <header class="mdc-top-app-bar mdc-top-app-bar--short">
        <div class="mdc-top-app-bar__row">
          <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button data-target="#navdrawerDefault" data-toggle="navdrawer"
              class="mdc-icon-button d-inline-flex mdc-top-app-bar__action-item--unbounded"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3 18v-2h18v2zm0-5v-2h18v2zm0-5V6h18v2z" />
              </svg></button>
          </section>

          <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
            <?php
            // usuarios activos
            echo $active_session = isset($_SESSION['active_session']) ? $_SESSION['active_session'] : "";
            ?>
            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8) { ?>
              <a class="navbar-brand mdc-icon-button d-inline-flex mdc-top-app-bar__action-item--unbounded" href="#"><svg
                  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M11 21v-2h8v-7.1q0-2.925-2.037-4.962T12 4.9T7.038 6.938T5 11.9V18H4q-.825 0-1.412-.587T2 16v-2q0-.525.263-.987T3 12.275l.075-1.325q.2-1.7.988-3.15t1.975-2.525T8.762 3.6T12 3t3.225.6t2.725 1.663t1.975 2.512t1 3.15l.075 1.3q.475.225.738.675t.262.95v2.3q0 .5-.262.95t-.738.675V19q0 .825-.587 1.413T19 21zm-2-7q-.425 0-.712-.288T8 13t.288-.712T9 12t.713.288T10 13t-.288.713T9 14m6 0q-.425 0-.712-.288T14 13t.288-.712T15 12t.713.288T16 13t-.288.713T15 14m-8.975-1.55Q5.85 9.8 7.625 7.9T12.05 6q2.225 0 3.913 1.412T18 11.026Q15.725 11 13.813 9.8t-2.938-3.25q-.4 2-1.687 3.563T6.025 12.45" />
                </svg></a>
              <a class="navbar-brand mdc-icon-button d-inline-flex mdc-top-app-bar__action-item--unbounded"
                href="./index.php?view=doc"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m-2.9-2.55l1.2-2.75q-1.05-.375-1.812-1.162T7.3 13.7l-2.75 1.15q.575 1.6 1.775 2.8t2.775 1.8M7.3 10.3q.425-1.05 1.188-1.837T10.3 7.3L9.15 4.55q-1.6.6-2.8 1.8t-1.8 2.8zM12 15q1.25 0 2.125-.875T15 12t-.875-2.125T12 9t-2.125.875T9 12t.875 2.125T12 15m2.9 4.45q1.575-.6 2.763-1.787T19.45 14.9l-2.75-1.2q-.375 1.05-1.15 1.813t-1.8 1.187zm1.8-9.2l2.75-1.15q-.6-1.575-1.787-2.762T14.9 4.55l-1.15 2.8q1.025.375 1.775 1.138T16.7 10.25" />
                </svg></a>
            <?php } ?>
            <a class="navbar-brand mdc-icon-button d-inline-flex mdc-top-app-bar__action-item--unbounded"
              href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
              </svg></a>
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
              <span class="mdc-top-app-bar__title"> </span>
            </section>

            <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
              <div class="logo">
                <a href="./../index.php" class="simple-text"><img src="uploads/logo_info_p.webp"
                    style="max-width: 90px; min-height: 10px;" /></a>
              </div>
            </section>

            <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
              <button data-target="#navdrawerDefault" data-toggle="navdrawer"
                class="mdc-icon-button mdc-top-app-bar__action-item--unbounded"><svg xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="m8.382 17.025l-1.407-1.4L10.593 12L6.975 8.4L8.382 7L12 10.615L15.593 7L17 8.4L13.382 12L17 15.625l-1.407 1.4L12 13.41z" />
                </svg></button>
            </section>

          </div>
        </div>



        <div class="accordion" id="accordion1">

          <nav class="navdrawer-nav">
            <a class="nav-link nav-primary dashboard" id="dashboard" href="./index.php" role="button"><svg class="mr-3"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
              </svg>Inicio
            </a>

            <!-- panel admin -->
            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
              <a class="nav-link nav-primary report" id="report" style="color: #089617;"
                href="./admin/index.php?view=report" role="button"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M17 22q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m-5 0q-3.475-.875-5.738-3.988T4 11.1V5l8-3l8 3v5.675q-.65-.325-1.463-.5T17 10q-2.9 0-4.95 2.05T10 17q0 1.55.588 2.8t1.487 2.175q-.025 0-.037.013T12 22m5-5q.625 0 1.063-.437T18.5 15.5t-.437-1.062T17 14t-1.062.438T15.5 15.5t.438 1.063T17 17m0 3q.775 0 1.425-.363t1.05-.962q-.55-.325-1.175-.5T17 18t-1.3.175t-1.175.5q.4.6 1.05.963T17 20" />
                </svg>Panel admin
              </a>
              <!-- panel admin -->

            <?php } ?>


            <!-- collapse2 mapa social-->
            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>

              <a class="nav-link nav-primary services" id="services" type="button" data-toggle="collapse"
                data-target="#socialmap1" aria-expanded="true" aria-controls="collapseOne">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m-1-2.05V18q-.825 0-1.412-.587T9 16v-1l-4.8-4.8q-.075.45-.137.9T4 12q0 3.025 1.988 5.3T11 19.95m6.9-2.55q.5-.55.9-1.187t.662-1.325t.4-1.413T20 12q0-2.45-1.363-4.475T15 4.6V5q0 .825-.587 1.413T13 7h-2v2q0 .425-.288.713T10 10H8v2h6q.425 0 .713.288T15 13v3h1q.65 0 1.175.388T17.9 17.4" />
                </svg>Mapa social
              </a>

              <div id="socialmap1" class="collapse visible" data-parent="#accordion1">
                <ul class="navdrawer-nav">
                  <li class="nav-item">
                    <a class="nav-link socialmap" id="socialmap" type="socialmap1" href="./index.php?view=socialmap"><svg
                        class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M8.5 13.5h1.45l3.9-3.925l-1.425-1.425l-3.925 3.9zm6.075-4.65l.7-.7q.125-.125.125-.262t-.125-.263l-.9-.9q-.125-.125-.263-.125t-.262.125l-.7.7zM12 22q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2t5.588 2.225T20 10.2q0 2.5-1.987 5.438T12 22" />
                      </svg> Editar mapa
                    </a>
                    <!-- indicadores del mapa -->
                    <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
                      <a class="nav-link reportsocialmap" id="reportsocialmap" type="socialmap1"
                        href="./index.php?view=reportsocialmap"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                          width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2.625 14.025L1 12.85l5-8l3 3.5l4-6.5l3 4.5L19.375 1L21 2.175l-4.95 7.85l-2.975-4.475l-3.8 6.175L6.25 8.2zM14.5 18q1.05 0 1.775-.725T17 15.5t-.725-1.775T14.5 13t-1.775.725T12 15.5t.725 1.775T14.5 18m5.1 4l-2.7-2.7q-.525.35-1.137.525T14.5 20q-1.875 0-3.187-1.312T10 15.5t1.313-3.187T14.5 11t3.188 1.313T19 15.5q0 .65-.175 1.263T18.3 17.9l2.7 2.7z" />
                        </svg> Reportes mapa</a>
                      <a class="nav-link socialmaporg" id="socialmaporg" type="socialmap1"
                        href="./index.php?view=socialmaporg"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M17 9h2V7h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zM1 21V11l7-5l7 5v10h-5v-6H6v6zm16 0V10l-7-5.05V3h13v18z" />
                        </svg> Organizaciones
                      </a>
                      <a class="nav-link inst_educativas" id="inst_educativas" type="socialmap1"
                        href="./index.php?view=inst_educativas"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M17 9h2V7h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zM1 21V11l7-5l7 5v10h-5v-6H6v6zm16 0V10l-7-5.05V3h13v18z" />
                        </svg> Inst-Educativas
                      </a>
                    <?php } ?>
                  </li>
                  <!-- end indicadores del mapa -->
                </ul>
              </div>
            <?php } ?>
            <!-- end collapse2 -->




            <!-- collapse encuesta tecnologica-->
            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>

              <a class="nav-link nav-primary" type="button" data-toggle="collapse" data-target="#encuesta"
                aria-expanded="true" aria-controls="collapseOne">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M6 20q-.825 0-1.412-.587T4 18t.588-1.412T6 16t1.413.588T8 18t-.587 1.413T6 20m0-6q-.825 0-1.412-.587T4 12t.588-1.412T6 10t1.413.588T8 12t-.587 1.413T6 14m0-6q-.825 0-1.412-.587T4 6t.588-1.412T6 4t1.413.588T8 6t-.587 1.413T6 8m6 0q-.825 0-1.412-.587T10 6t.588-1.412T12 4t1.413.588T14 6t-.587 1.413T12 8m6 0q-.825 0-1.412-.587T16 6t.588-1.412T18 4t1.413.588T20 6t-.587 1.413T18 8m-6 6q-.825 0-1.412-.587T10 12t.588-1.412T12 10t1.413.588T14 12t-.587 1.413T12 14m1 6v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zm6.575-5.6l.925-.975l-.925-.925l-.95.95z" />
                </svg>Encuestas
              </a>

              <div id="encuesta" class="collapse visible" data-parent="#accordion1">
                <ul class="navdrawer-nav">
                  <!-- encuesta-1 -->
                  <a class="nav-link nav-item form_technological_capabilities" id="form_technological_capabilities"
                    type="encuesta" href="./index.php?view=edit_form_technological_capabilities"><svg class="mr-3"
                      xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M6 20q-.825 0-1.412-.587T4 18t.588-1.412T6 16t1.413.588T8 18t-.587 1.413T6 20m0-6q-.825 0-1.412-.587T4 12t.588-1.412T6 10t1.413.588T8 12t-.587 1.413T6 14m0-6q-.825 0-1.412-.587T4 6t.588-1.412T6 4t1.413.588T8 6t-.587 1.413T6 8m6 0q-.825 0-1.412-.587T10 6t.588-1.412T12 4t1.413.588T14 6t-.587 1.413T12 8m6 0q-.825 0-1.412-.587T16 6t.588-1.412T18 4t1.413.588T20 6t-.587 1.413T18 8m-6 6q-.825 0-1.412-.587T10 12t.588-1.412T12 10t1.413.588T14 12t-.587 1.413T12 14m1 6v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.5 5.5zm6.575-5.6l.925-.975l-.925-.925l-.95.95z" />
                    </svg> Encuestas
                  </a>

                  <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
                    <a class="nav-link nav-item report_capabilities_tech" id="report_capabilities_tech" type="encuesta"
                      href="./index.php?view=report_capabilities_tech"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M2.625 14.025L1 12.85l5-8l3 3.5l4-6.5l3 4.5L19.375 1L21 2.175l-4.95 7.85l-2.975-4.475l-3.8 6.175L6.25 8.2zM14.5 18q1.05 0 1.775-.725T17 15.5t-.725-1.775T14.5 13t-1.775.725T12 15.5t.725 1.775T14.5 18m5.1 4l-2.7-2.7q-.525.35-1.137.525T14.5 20q-1.875 0-3.187-1.312T10 15.5t1.313-3.187T14.5 11t3.188 1.313T19 15.5q0 .65-.175 1.263T18.3 17.9l2.7 2.7z" />
                      </svg> Reportes encuesta
                    </a>
                  <?php } ?>

                  <!-- end encuesta-1 -->
                </ul>
              </div>
            <?php } ?>
            <!-- end collapse -->


            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>

              <!-- collapse planning -->
              <a class="nav-link nav-primary" type="button" data-toggle="collapse" data-target="#collapse_planning"
                aria-expanded="true" aria-controls="collapseOne">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M3 20v-6l8-2l-8-2V4l14.3 6H17q-2.925 0-4.962 2.063T10 17.05zm14 2q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m1.65-2.65l.7-.7l-1.85-1.85V14h-1v3.2z" />
                </svg>Planificación
              </a>

              <div id="collapse_planning" class="collapse visible" data-parent="#accordion1">
                <ul class="navdrawer-nav">
                  <a class="nav-link planning" id="planning" type="collapse_planning"
                    href="./admin/index.php?view=planning"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                      height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h9v2H5v14h14v-9h2v9q0 .825-.587 1.413T19 21zm3-4v-2h8v2zm0-3v-2h8v2zm0-3V9h8v2zm9-2V7h-2V5h2V3h2v2h2v2h-2v2z" />
                    </svg> Planificación
                  </a>
                </ul>
              </div>
              <!-- end collapse planning -->

              <!-- collapse1 -->
              <a class="nav-link nav-primary" type="button" data-toggle="collapse" data-target="#reports"
                aria-expanded="true" aria-controls="collapseOne">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm2-4h7v-2H7zm0-4h10v-2H7zm0-4h10V7H7z" />
                </svg>Reportes
              </a>

              <div id="reports" class="collapse visible" data-parent="#accordion1">

                <a class="nav-link report" id="report" type="reports" href="./admin/index.php?view=report"><svg class="mr-3"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M12 4.25q.325 0 .538-.213t.212-.537t-.213-.537T12 2.75t-.537.213t-.213.537t.213.538t.537.212M18 23q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23m-.5-2h1v-2.5H21v-1h-2.5V15h-1v2.5H15v1h2.5zM7 9h10V7H7zm4.675 12H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.2q.325-.9 1.088-1.45T12 1t1.713.55T14.8 3H19q.825 0 1.413.588T21 5v6.7q-.725-.35-1.463-.525T18 11q-.275 0-.513.012t-.487.063V11H7v2h6.125q-.45.425-.812.925T11.675 15H7v2h4.075q-.05.25-.062.488T11 18q0 .825.15 1.538T11.675 21" />
                  </svg>Actividades
                </a>
                <a class="nav-link services" id="services" type="reports" href="./admin/index.php?view=services"><svg
                    class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M11 21v-2h8v-7.1q0-2.925-2.037-4.962T12 4.9T7.038 6.938T5 11.9V18H4q-.825 0-1.412-.587T2 16v-2q0-.525.263-.987T3 12.275l.075-1.325q.2-1.7.988-3.15t1.975-2.525T8.762 3.6T12 3t3.225.6t2.725 1.663t1.975 2.512t1 3.15l.075 1.3q.475.225.738.675t.262.95v2.3q0 .5-.262.95t-.738.675V19q0 .825-.587 1.413T19 21zm-2-7q-.425 0-.712-.288T8 13t.288-.712T9 12t.713.288T10 13t-.288.713T9 14m6 0q-.425 0-.712-.288T14 13t.288-.712T15 12t.713.288T16 13t-.288.713T15 14m-8.975-1.55Q5.85 9.8 7.625 7.9T12.05 6q2.225 0 3.913 1.412T18 11.026Q15.725 11 13.813 9.8t-2.938-3.25q-.4 2-1.687 3.563T6.025 12.45" />
                  </svg> Servicios
                </a>
                <a class="nav-link participants" id="participants" type="reports"
                  href="./admin/index.php?view=participants"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8" />
                  </svg> Participantes
                </a>
                <a class="nav-link products" id="products" type="reports" href="./admin/index.php?view=products"><svg
                    class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M13 22v-4l4-1l-4-1v-4l10 5zm-8-1q-.825 0-1.412-.587T3 19v-3.8q1.2 0 2.1-.762T6 12.5t-.9-1.937T3 9.8V6q0-.825.588-1.412T5 4h4q0-1.05.725-1.775T11.5 1.5t1.775.725T14 4h4q.825 0 1.413.588T20 6v7.25l-9-4.5v9.3q-1 .2-1.6.938T8.8 21z" />
                  </svg> Productos
                </a>
              </div>
              <!-- end collapse1 -->
            <?php } ?>

            <?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>
              <!-- collapse2 -->
              <a class="nav-link nav-primary" type="button" data-toggle="collapse" data-target="#infocentros"
                aria-expanded="true" aria-controls="collapseOne">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M4 21V9l8-6l8 6v2h-7q-.825 0-1.412.588T11 13v4q0 .825.588 1.413T13 19h7v2zm9-3q-.425 0-.712-.288T12 17v-4q0-.425.288-.712T13 12h4q.425 0 .713.288T18 13v1l2-1.05v4.1L18 16v1q0 .425-.288.713T17 18z" />
                </svg>Infocentros
              </a>

              <div id="infocentros" class="collapse visible" data-parent="#accordion1">
                <ul class="navdrawer-nav">
                  <a class="nav-link infocentros" id="infocentros" type="infocentros"
                    href="./admin/index.php?view=infocentros"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                      width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
                    </svg> Datos básicos
                  </a>
                </ul>

                <ul class="navdrawer-nav">
                  <a class="nav-link inventory" id="inventory" type="inventory" href="./admin/index.php?view=inventory"><svg
                      class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
                    </svg> Inventario
                  </a>
                </ul>

                <ul class="navdrawer-nav">
                  <a class="nav-link process" id="process" type="process" href="./admin/index.php?view=process"><svg
                      class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
                    </svg> Procesos
                  </a>
                </ul>

              </div>


              <!-- end collapse2 -->
            <?php } ?>

            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 7) { ?>
              <!-- collapse2 -->
              <a class="nav-link nav-primary" type="button" data-toggle="collapse" data-target="#brigadas"
                aria-expanded="true" aria-controls="collapseOne">
                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                </svg>Brigadas
              </a>

              <div id="brigadas" class="collapse visible" data-parent="#accordion1">
                <ul class="navdrawer-nav">
                  <a class="nav-link brigadas" id="brigadas" type="brigadas" href="./admin/index.php?view=brigadas"><svg
                      class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                    </svg>Brigadas
                  </a>
                </ul>

                <ul class="navdrawer-nav">
                  <a class="nav-link inventory" id="inventory" type="inventory"
                    href="./admin/index.php?view=brigadistas"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg"
                      width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M0 18v-1.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0v-1.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V18zm13.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                    </svg>Brigadistas
                  </a>
                </ul>
              </div>
              <!-- end collapse2 -->
            <?php } ?>
          </nav>

        </div>
        <!-- end accordion -->



        <div class="navdrawer-divider"></div>


        <ul class="navdrawer-nav">
          <?php if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
            <!-- collapse -->
            <div class="nav-link nav-primary" data-toggle="collapse" data-target="#config" aria-expanded="true"
              aria-controls="collapseOne"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
              </svg>Configuración</div>

            <div id="config" class="collapse visible" data-parent="#accordion1">
              <ul class="navdrawer-nav">
                <a class="nav-link users" id="users" type="config" href="./admin/index.php?view=users"><svg class="mr-3"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M9 14.25q-.525 0-.888-.363T7.75 13t.363-.888T9 11.75t.888.363t.362.887t-.363.888T9 14.25m6 0q-.525 0-.888-.363T13.75 13t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362M12 20q3.35 0 5.675-2.325T20 12q0-.6-.075-1.162T19.65 9.75q-.525.125-1.05.188T17.5 10q-2.275 0-4.3-.975T9.75 6.3q-.8 1.95-2.287 3.388T4 11.85V12q0 3.35 2.325 5.675T12 20m0 2q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                  </svg>Usuario</a>

                <a class="nav-link userform_update" id="userform_update" type="config"
                  href="index.php?view=userform_update"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M4 22q-.825 0-1.412-.587T2 20V9q0-.825.588-1.412T4 7h5V4q0-.825.588-1.412T11 2h2q.825 0 1.413.588T15 4v3h5q.825 0 1.413.588T22 9v11q0 .825-.587 1.413T20 22zm2-4h6v-.45q0-.425-.238-.788T11.1 16.2q-.5-.225-1.012-.337T9 15.75t-1.088.113T6.9 16.2q-.425.2-.663.563T6 17.55zm8-1.5h4V15h-4zM9 15q.625 0 1.063-.437T10.5 13.5t-.437-1.062T9 12t-1.062.438T7.5 13.5t.438 1.063T9 15m5-1.5h4V12h-4zM11 9h2V4h-2z" />
                  </svg>Perfil</a>
              </ul>
            </div>
            <!-- end collapse -->
            <a class="nav-link doc" id="doc" href="./index.php?view=doc"><svg class="mr-3"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m-2.9-2.55l1.2-2.75q-1.05-.375-1.812-1.162T7.3 13.7l-2.75 1.15q.575 1.6 1.775 2.8t2.775 1.8M7.3 10.3q.425-1.05 1.188-1.837T10.3 7.3L9.15 4.55q-1.6.6-2.8 1.8t-1.8 2.8zM12 15q1.25 0 2.125-.875T15 12t-.875-2.125T12 9t-2.125.875T9 12t.875 2.125T12 15m2.9 4.45q1.575-.6 2.763-1.787T19.45 14.9l-2.75-1.2q-.375 1.05-1.15 1.813t-1.8 1.187zm1.8-9.2l2.75-1.15q-.6-1.575-1.787-2.762T14.9 4.55l-1.15 2.8q1.025.375 1.775 1.138T16.7 10.25" />
              </svg>Documentación
            </a>


          <?php } else { ?>

            <!-- collapse -->
            <div class="nav-link" data-toggle="collapse" data-target="#config" aria-expanded="true"
              aria-controls="collapseOne"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12" />
              </svg>Configuración
            </div>

            <div id="config" class="collapse visible" data-parent="#accordion1">
              <ul class="navdrawer-nav">
                <a class="nav-link users" id="users" type="config" href="./admin/index.php?view=users"><svg class="mr-3"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M9 14.25q-.525 0-.888-.363T7.75 13t.363-.888T9 11.75t.888.363t.362.887t-.363.888T9 14.25m6 0q-.525 0-.888-.363T13.75 13t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362M12 20q3.35 0 5.675-2.325T20 12q0-.6-.075-1.162T19.65 9.75q-.525.125-1.05.188T17.5 10q-2.275 0-4.3-.975T9.75 6.3q-.8 1.95-2.287 3.388T4 11.85V12q0 3.35 2.325 5.675T12 20m0 2q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                  </svg>Usuario</a>

                <a class="nav-link userform_update" id="userform_update" type="config"
                  href="index.php?view=userform_update"><svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M4 22q-.825 0-1.412-.587T2 20V9q0-.825.588-1.412T4 7h5V4q0-.825.588-1.412T11 2h2q.825 0 1.413.588T15 4v3h5q.825 0 1.413.588T22 9v11q0 .825-.587 1.413T20 22zm2-4h6v-.45q0-.425-.238-.788T11.1 16.2q-.5-.225-1.012-.337T9 15.75t-1.088.113T6.9 16.2q-.425.2-.663.563T6 17.55zm8-1.5h4V15h-4zM9 15q.625 0 1.063-.437T10.5 13.5t-.437-1.062T9 12t-1.062.438T7.5 13.5t.438 1.063T9 15m5-1.5h4V12h-4zM11 9h2V4h-2z" />
                  </svg>Perfil</a>
              </ul>
            </div>
            <!-- end collapse -->

          <?php } ?>

        </ul>


        <div class="navdrawer-divider"></div>

      </div>
      <!-- navdrawer-content -->

    </div>
    <!-- end side menu -->

    <?php
    // llama login si existe ID de usuario activo lo redirecciona al dashboard
    View::load("login");
    ?>
  </body>








  <footer class="footer">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <ul>
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script> | Fundación Infocentro
        </ul>
      </div>
      <div class="row justify-content-center">
        <ul>
          Con <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="m12 21l-1.45-1.3q-2.525-2.275-4.175-3.925T3.75 12.812T2.388 10.4T2 8.15Q2 5.8 3.575 4.225T7.5 2.65q1.3 0 2.475.55T12 4.75q.85-1 2.025-1.55t2.475-.55q2.35 0 3.925 1.575T22 8.15q0 1.15-.387 2.25t-1.363 2.412t-2.625 2.963T13.45 19.7z" />
          </svg> y Software Libre
        </ul>
      </div>
    </div>
  </footer>





<?php else: ?>

  <?php
  if (isset($_GET["logintype"]) && $_GET["logintype"] == "signup") {
    View::load("signup");

    // registered viene de adduser-action | nuevo usuario creado
  } elseif (isset($_GET["logintype"]) && $_GET["logintype"] == "sabana") {
    View::load("login2");
  } elseif (!isset($_GET["logintype"])) {
    View::load("login");
  }

  if (isset($_GET["view"]) && $_GET["view"] != "index" && $_GET["view"] != "signup" && $_GET["view"] != "processlogin" && $_GET["view"] != "adduser" && $_GET["view"] != "sabana") {
    print "<script>window.location='logout.php';</script>";
  }


  ?>


<?php endif; ?>

<script src="assets/css/googleapi/bootstrap.bundle.min.js"
  integrity="sha256-GRJrh0oydT1CwS36bBeJK/2TggpaUQC6GzTaTQdZm0k=" crossorigin></script>
<script src="assets/css/googleapi/material.min.js" crossorigin></script>


<script src="assets/node_modules/pace-progress/pace.min.js"></script>
<script src="assets/node_modules/sweetalert2/sweetalert2.all.min.js"></script>
<script src="assets/js/toast.js"></script>
<!-- toastify toast-->
<script src="assets/js/toastify-js.js"></script>
<script src="assets/js/demo.js"></script>
<script src="assets/js/js_select2.min.js"></script>
<script src="assets/js/axios.min.js"></script>

<!-- Chartist JS -->
<script src="assets/material/assets/js/plugins/chartist.min.js"></script>

<!-- ChartJS -->
<script src="assets/plugins/chart.js/3/chart.min.js"></script>
<script src="assets/plugins/chart.js/chartjs-plugin-datalabels.min.js"></script>

<script type="text/javascript" src="assets/js/moment.min.js"></script>
<script type="text/javascript" src="assets/js/daterangepicker.min.js"></script>

<script src="assets/material/assets/js/plugins/fullcalendar.min.js"></script>
<script type='text/javascript' src='assets/fullcalendar/js/locale/es.js'></script>

<script type='text/javascript' src='assets/plugins/intl-tel-input-master/intlTelInputWithUtils.min.js'></script>

</html>


<script>
  var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

  function sidemenu() {
    $('#navdrawerDefault').navdrawer('toggle')
  }

  function darkSwitch() {
    const Tag = document.documentElement;
    if (Tag.dataset.theme == "dark") {
      Tag.dataset.theme = 'light';
      sessionStorage.setItem("darkSwitch", "light");
    } else {
      Tag.dataset.theme = 'dark';
      sessionStorage.setItem("darkSwitch", "dark");

    }

  }




  // inicializa los tooltip
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip()

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
          }
        }
      }
      // end active menu
    <?php } ?>

  });
</script>

<style>
  .navdrawer-header {
    background-color: #fff;
    border-bottom: 0px solid rgba(0, 0, 0, .12);
  }


  .navdrawer-nav .nav-link {
    color: #666;
  }

  .navdrawer-nav .nav-primary {
    color: #fd0476;
  }

  .navdrawer-nav .nav-primary:hover {
    color: #fd0476;
  }

  .navdrawer-nav .nav-item {
    color: #666;
  }

  .navdrawer-nav .nav-link.active,
  .navdrawer-nav .nav-link:active {
    background-color: rgb(8, 116, 211);
    color: #f3f5f7;
  }
</style>