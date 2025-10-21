<?php
// session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

// if (ini_get('date.timezone')) {
//   echo 'date.timezone: ' . ini_get('date.timezone');
// }
// 

$user_region = isset($_SESSION["user_region"]) ? $_SESSION['user_region'] : "";
$user_id = $_SESSION['user_id'];

if (isset($_SESSION["user_type"]) && ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7)) {
  $sql = "SELECT * from reports WHERE is_active='1' and status_activity='0' order by date_pub asc LIMIT 50";
} else if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == 8) {
  $sql = "SELECT * from reports WHERE is_active='1' and status_activity='0' and estate='" . $user_region . "' order by date_pub asc LIMIT 50";
} else {
  $sql = "SELECT * from reports WHERE is_active='1' and status_activity='0' and user_id='" . $user_id . "' order by date_pub asc LIMIT 50";
}


// $users = ReportActivityData::getBySQL($sql);


// $sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
$conn = DatabasePg::connectPg();
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$users = $data;

// $sql = "SELECT * FROM reports WHERE relname = 'reports'";
// $data = ExecutorPg::get($sql);


$Saludo = "";
if (isset($_SESSION["user_genero"]) && $_SESSION["user_genero"] == "Mujer") {
  $Saludo = "Bienvenida de vuelta " . $_SESSION["user_nombres"];
} else {
  $Saludo = "Bienvenido de vuelta " . $_SESSION["user_nombres"];
}




?>


<script>
  $(document).ready(function() {

    var Name_OS = "Unknown OS";
    // OS NAME
    if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
    if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
    if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
    if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
    if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";



    // AVISO
    // if (Name_OS != "Android") {
    //   Swal.fire({
    //     icon: 'warning',
    //     title: '¡Hola ' + '<"?php echo $_SESSION["user_nombres"]; ?>' + '!',
    //     text: "Queremos informarte que para mejorar el rendimiento de la InfoApp, hicimos un respaldo de los datos.\n Es posible que en algunos módulos solo encuentres información de tu región nada más.\n Si necesitas algunos datos extras no dudes en consultar con Políticas públicas.",
    //     showConfirmButton: true,
    //     timer: 50000
    //   })
    // } else {
    //   alert('¡Hola ' + '<"?php echo $_SESSION["user_nombres"]; ?>' + '!' + '\nQueremos informarte que para mejorar el rendimiento de la InfoApp, hicimos un respaldo de los datos.\n Es poosible que en algunos módulos solo encuentres información de tu región nada más.\n Si necesitas algunos datos extras no dudes en consultar con Políticas públicas.');
    // }

    // AVISO
    // if (Name_OS != "Android") {
    //   Swal.fire({
    //     icon: 'warning',
    //     title: '¡Hola ' + '<!?php echo $_SESSION["user_nombres"]; ?>',
    //     text: "Ya está habilitado el módulo de servicios al usuario en: Reportes/Servicios",
    //     showConfirmButton: true,
    //     timer: 50000
    //   })
    // } else {
    //   alert('¡Hola ' + '<!?php echo $_SESSION["user_nombres"]; ?>' + '!' + '\nYa está habilitado el módulo de servicios al usuario en: Reportes/Servicios');
    // }




    // alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide,time,style]
    // toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
    // toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000); // [message, autohide,time,style]
    // setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);


    // alertas
    <?php if ($_SESSION["alert"] != "") : ?>
      if (mobile) {
        toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "dashboard");
      } else {
        toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "dashboard"); // [message, autohide,time,style]
      }
    <?php endif; ?>

    // cambiar el parametro de alert
    // const url = new URL(window.location);
    // url.searchParams.set('swal', '');
    // window.history.pushState({}, '', url);

    <?php echo $_SESSION["alert"] = ""; ?>


    // AVISO
    // toastify('AVISO: Hemos aumentado la memoria para cargar imágenes que pesen más de 2 megas.', true, 20000, "warning");
    toastify('<?php echo $Saludo; ?>', true, 20000, "dashboard");



  })
</script>


<!-- columna izquierda fija | en row-cols-N° se puede cambiar el número de columnas que se quiere -->
<!-- <div class="container">
  <div class="row row-cols-2">

    <div class="col-8">
      <div class="card p-4">
        <div class="mui-container-fluid">
          <div class="row justify-content-center container">
            <img class="img3" src="assets/infoapp_portada.webp">
          </div>
        </div>
      </div>
      <br>
    </div>

    <div class="col-4">
      <div class="card p-4">
        <div class="mui-container-fluid">
          <div class="row justify-content-center container">
            <img class="img3" src="assets/infoapp_portada.webp">
          </div>
        </div>
      </div>
      <br>
    </div>

  </div>
</div> -->



<!-- columna a la izquierda responsive -->
<!-- <div class="container">

  <div class="row">

    <div class="col-md-8">
      <div class="card p-4">
        <div class="mui-container-fluid">
          <div class="row justify-content-center container">
            <img class="img3" src="assets/infoapp_portada.webp">
          </div>
        </div>
      </div>
      <br>
    </div>

    <div class="col-md-4">
      <div class="card p-4">
        <div class="mui-container-fluid">
          <div class="row justify-content-center container">
            <img class="img3" src="assets/infoapp_portada.webp">
          </div>
        </div>
      </div>
      <br>
    </div>

  </div>
</div> -->






<div class="row justify-content-center">
  <div class="container">




    <?php if (count($users) > 0) { ?>


      <h4 class="p-title" style="color:#ff0e6e;">Actividades pendientes</h4>
      <div class="row justify-content-center">
        <span class="p-titlex">Próximas 50 actividades</span>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="main-timeline7">


            <?php
            setlocale(LC_TIME, "");
            setlocale(LC_TIME, "es_ES.UTF-8");

            foreach ($users as $user) {
              // sacamos la fecha de inicio
              $date_pub_end = explode("/", $user["date_pub"]);
              if (count($date_pub_end) > 1) {
                $date_pub = date("d/m/Y", strtotime($date_pub_end[0]));
                $date_pub = str_replace("/", "-", $date_pub);
                $newDate = date("d-m-Y", strtotime($date_pub));
                $date_pub = strftime("%a %d de %b", strtotime($newDate));
              } else {
                $date_pub = date("d/m/Y", strtotime($user["date_pub"]));
                $date_pub = str_replace("/", "-", $date_pub);
                $newDate = date("d-m-Y", strtotime($date_pub));
                $date_pub = strftime("%a %d de %b", strtotime($newDate));
              }

            ?>

              <?php if ($user["line_action"] == "Infocentro adentro" || $user["line_action"] == "Participación digital") { ?>

                <div class="timeline line_1">
                  <div class="timeline-icon line_1-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 30">
                        <path fill="currentColor" d="M15.5 1h-8A2.5 2.5 0 0 0 5 3.5v17A2.5 2.5 0 0 0 7.5 23h8a2.5 2.5 0 0 0 2.5-2.5v-17A2.5 2.5 0 0 0 15.5 1m-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5s-.67 1.5-1.5 1.5m4.5-4H7V4h9z" />
                      </svg></i></div>
                  <span class="year year-line_1"><?php echo $user["code_info"] . " | " . $date_pub; ?></span>
                  <div class="timeline-content">
                    <h5 class="title title-line_1"><?php echo $user["line_action"]; ?></h5>
                    <p class="description">
                      <?php echo $user["activity_title"]; ?>
                    </p>
                  </div>
                </div>

              <?php } else if ($user["line_action"] == "Formación a la medida" || $user["line_action"] == "Comunidades de aprendizaje") { ?>

                <div class="timeline line_2">
                  <div class="timeline-icon line_2-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 30">
                        <path fill="currentColor" d="M10.514 6.49a4.5 4.5 0 0 1 2.973 0l7.6 2.66c.803.282.803 1.418 0 1.7l-7.6 2.66a4.5 4.5 0 0 1-2.973 0l-5.509-1.93a1.24 1.24 0 0 0-.436.597a1 1 0 0 1 .013 1.635l.004.018l.875 3.939a.6.6 0 0 1-.585.73H3.125a.6.6 0 0 1-.586-.73l.875-3.94l.005-.017a1 1 0 0 1 .132-1.707a2.35 2.35 0 0 1 .413-.889l-1.05-.367c-.804-.282-.804-1.418 0-1.7z" />
                        <path fill="currentColor" d="m6.393 12.83l-.332 2.654c-.057.452.127.92.52 1.196c1.157.815 3.043 1.82 5.42 1.82a9 9 0 0 0 5.473-1.834c.365-.28.522-.727.47-1.152l-.336-2.685l-4.121 1.442a4.5 4.5 0 0 1-2.973 0z" />
                      </svg></i></div>
                  <span class="year year-line_2"><?php echo $user["code_info"] . " | " . $date_pub; ?></span>
                  <div class="timeline-content">
                    <h5 class="title title-line_2"><?php echo $user["line_action"]; ?></h5>
                    <p class="description">
                      <?php echo $user["activity_title"]; ?>
                    </p>
                  </div>
                </div>



              <?php } else if ($user["line_action"] == "Tejiendo redes" || $user["line_action"] == "Medios digitales") { ?>

                <div class="timeline line_3">
                  <div class="timeline-icon line_3-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 25">
                        <path fill="currentColor" d="M13 11V4c0-.55-.45-1-1-1h-1.67L9 1H5L3.67 3H2c-.55 0-1 .45-1 1v7c0 .55.45 1 1 1h10c.55 0 1-.45 1-1M7 4.5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5M14 6h5v10.5a2.5 2.5 0 0 1-5 0a2.5 2.5 0 0 1 3-2.45V9h-3zm-4 8.05V13h2v3.5a2.5 2.5 0 0 1-5 0a2.5 2.5 0 0 1 3-2.45" />
                      </svg></i></div>
                  <span class="year year-line_3"><?php echo $user["code_info"] . " | " . $date_pub; ?></span>
                  <div class="timeline-content">
                    <h5 class="title title-line_3"><?php echo $user["line_action"]; ?></h5>
                    <p class="description">
                      <?php echo $user["activity_title"]; ?>
                    </p>
                  </div>
                </div>


              <?php } else if ($user["line_action"] == "Unidades socio-productivas" || $user["line_action"] == "Acceso abierto") { ?>

                <div class="timeline line_4">
                  <div class="timeline-icon line_4-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 20">
                        <path fill="currentColor" d="M12 7V5l-1.2-.4c-.1-.3-.2-.7-.4-1l.6-1.2l-1.5-1.3l-1.1.5c-.3-.2-.6-.3-1-.4L7 0H5l-.4 1.2c-.3.1-.7.2-1 .4l-1.1-.5l-1.4 1.4l.6 1.2c-.2.3-.3.6-.4 1L0 5v2l1.2.4c.1.3.2.7.4 1l-.5 1.1l1.4 1.4l1.2-.6c.3.2.6.3 1 .4L5 12h2l.4-1.2c.3-.1.7-.2 1-.4l1.2.6L11 9.6l-.6-1.2c.2-.3.3-.6.4-1zM3 6c0-1.7 1.3-3 3-3s3 1.3 3 3s-1.3 3-3 3s-3-1.3-3-3" />
                        <path fill="currentColor" d="M7.5 6a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 7.5 6M16 3V2h-.6c0-.2-.1-.4-.2-.5l.4-.4l-.7-.7l-.4.4c-.2-.1-.3-.2-.5-.2V0h-1v.6c-.2 0-.4.1-.5.2l-.4-.4l-.7.7l.4.4c-.1.2-.2.3-.2.5H11v1h.6c0 .2.1.4.2.5l-.4.4l.7.7l.4-.4c.2.1.3.2.5.2V5h1v-.6c.2 0 .4-.1.5-.2l.4.4l.7-.7l-.4-.4c.1-.2.2-.3.2-.5zm-2.5.5c-.6 0-1-.4-1-1s.4-1 1-1s1 .4 1 1s-.4 1-1 1m1.9 8.3c-.1-.3-.2-.6-.4-.9l.3-.6l-.7-.7l-.5.4c-.3-.2-.6-.3-.9-.4L13 9h-1l-.2.6c-.3.1-.6.2-.9.4l-.6-.3l-.7.7l.3.6c-.2.3-.3.6-.4.9L9 12v1l.6.2c.1.3.2.6.4.9l-.3.6l.7.7l.6-.3c.3.2.6.3.9.4l.1.5h1l.2-.6c.3-.1.6-.2.9-.4l.6.3l.7-.7l-.4-.5c.2-.3.3-.6.4-.9l.6-.2v-1zM12.5 14c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5s1.5.7 1.5 1.5s-.7 1.5-1.5 1.5" />
                      </svg></i></div>
                  <span class="year year-line_4"><?php echo $user["code_info"] . " | " . $date_pub; ?></span>
                  <div class="timeline-content">
                    <h5 class="title title-line_4"><?php echo $user["line_action"]; ?></h5>
                    <p class="description">
                      <?php echo $user["activity_title"]; ?>
                    </p>
                  </div>
                </div>


              <?php } else if ($user["line_action"] == "Sistematización de Experiencias") { ?>

                <div class="timeline line_5">
                  <div class="timeline-icon line_5-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 56 60">
                        <path fill="currentColor" d="M26.336 2.88v17.203c0 3 1.406 4.43 4.406 4.43h16.969v21.281c0 4.875-2.414 7.336-7.266 7.336h-24.89c-4.828 0-7.266-2.437-7.266-7.336V10.239c0-4.875 2.438-7.359 7.266-7.359zm-8.21 30.055h-1.563c-.863 0-1.563.7-1.563 1.563v10.94C15 46.3 15.7 47 16.563 47h1.563c.863 0 1.562-.7 1.562-1.563v-10.94c0-.862-.7-1.562-1.562-1.562m7.032-4.688h-1.563c-.863 0-1.562.7-1.562 1.562v15.628c0 .863.7 1.563 1.562 1.563h1.563c.863 0 1.563-.7 1.563-1.563V29.81c0-.863-.7-1.562-1.563-1.562m7.033 9.376h-1.563c-.863 0-1.563.7-1.563 1.563v6.251c0 .863.7 1.563 1.563 1.563h1.563c.863 0 1.562-.7 1.562-1.563v-6.25c0-.864-.7-1.564-1.562-1.564M29.523 3.138c.985.164 1.97.844 3.047 1.969l12.938 13.148c1.101 1.148 1.781 2.086 1.945 3.047h-16.64c-.844 0-1.29-.422-1.29-1.266Z" />
                      </svg></i></div>
                  <span class="year year-line_5"><?php echo $user["code_info"] . " | " . $date_pub; ?></span>
                  <div class="timeline-content">
                    <h5 class="title title-line_5"><?php echo $user["line_action"]; ?></h5>
                    <p class="description">
                      <?php echo $user["activity_title"]; ?>
                    </p>
                  </div>
                </div>

              <?php } ?>

            <?php } ?>

          </div>
        </div>
      </div>




    <?php } else { ?>

      <div class="row">
        <div class="col-md-12">
          <div class="main-timeline7">

            <div class="row justify-content-center"><span class="material-icons">&#xE87C;</span></div>
            <div class="row justify-content-center">Este es tu escritorio</div>
            <br>

            <div class="card p-4">
              <div class="mui-container-fluid">
                <div class="row justify-content-center container">
                  <img class="img3" src="assets/infoapp_portada.webp">
                </div>
              </div>
            </div>
            <br>

          </div>
        </div>
      </div>

    <?php } ?>





  </div>
</div>

<br>
<br>






<!-- // Comprueba si es un DNI correcto (entre 5 y 8 letras seguidas de la letra que corresponda).

// Acepta NIEs (Extranjeros con X, Y o Z al principio)
function validateDNI(dni) {
    var numero, let, letra;
    var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;

    dni = dni.toUpperCase();

    if(expresion_regular_dni.test(dni) === true){
        numero = dni.substr(0,dni.length-1);
        numero = numero.replace('X', 0);
        numero = numero.replace('Y', 1);
        numero = numero.replace('Z', 2);
        let = dni.substr(dni.length-1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero+1);
        if (letra != let) {
            //alert('Dni erroneo, la letra del NIF no se corresponde');
            return false;
        }else{
            //alert('Dni correcto');
            return true;
        }
    }else{
        //alert('Dni erroneo, formato no válido');
        return false;
    }
} -->






<script language="javascript">
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })

  // alert(localStorage.getItem("Nombre"));

  // localStorage.removeItem("Nombre");

  // localStorage.setItem("Nombre", "Ana");
  // alert(localStorage.getItem("Nombre"));

  // sessionStorage.setItem("Nombre", <!?php echo time(); ?>);
  // alert(sessionStorage.getItem("Nombre"));

  // console.log(localStorage.getItem("usersession"));
</script>


<style>
  .container {
    padding: 20px;
  }

  .img2 {
    width: 100%;
  }

  .img3 {
    max-width: 80%;
    height: auto;
  }
</style>