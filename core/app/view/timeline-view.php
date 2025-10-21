<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ 
    $sql = "SELECT * from reports WHERE is_active=1 and status_activity=0 order by date_pub asc LIMIT 50";
    $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0";
} else if ($_SESSION["user_type"] == 8){ 
    $sql = "SELECT * from reports WHERE is_active=1 and status_activity=0 and estate='".$user_region."' order by date_pub asc LIMIT 10";
    $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0 and estate='".$user_region."' ";
}else {
    $sql = "SELECT * from reports WHERE is_active=1 and status_activity=0 and user_id='".$user_id."' order by date_pub asc LIMIT 10";
    $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0 and user_id='".$user_id."' ";
}


$users = ReportActivityData::getBySQL($sql);




$Saludo = "";
if (isset($_SESSION["user_genero"]) && $_SESSION["user_genero"] == "Mujer"){
  $Saludo = "Bienvenida de vuelta ".$_SESSION["user_nombres"];
}else {
  $Saludo = "Bienvenido de vuelta ".$_SESSION["user_nombres"];
}
?>




<script>

$(document).ready(function() {

  toastify('<?php echo $Saludo; ?>',true,10000,"dashboard");



// alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide,time,style]
// toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
// toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000); // [message, autohide,time,style]
// setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);


// alertas
<?php if(isset($_GET['swal']) && isset($_SESSION["alert"]) && $_GET['swal']!= ""): ?>
	if (mobile) {
		toastify('<?php echo $_SESSION["alert"]; ?>',true,10000,"dashboard");
	} else {
		toastify('<?php echo $_SESSION["alert"]; ?>',true,10000,"dashboard"); // [message, autohide,time,style]
	}
<?php endif; ?>

// cambiar el parametro de alert
const url = new URL(window.location);
url.searchParams.set('swal', '');
window.history.pushState({}, '', url);

})


</script>






<!-- FORM -->
<div class="container">
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      
    <!-- boton con tooltips | js abajo -->
    <!-- <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button> -->


    <!-- spinner de cargando -->
    <!-- <div class="d-flex justify-content-center">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
    </div> -->

      <!-- <div class="row justify-content-center"><span class="material-icons">&#xE87C;</span></div>     -->
      <!-- <div class="row justify-content-center">Este es tu escritorio, pronto verás aquí la información de todos los servicios prestados</div>    
      <br> -->
      

                <!-- <div class="row justify-content-center responsive">
                                <img decoding="async" src="assets/portada_info.webp" title="LOGO" alt="LOGO" loading="lazy">
                            </div> -->


                <!-- <div class="row justify-content-center container">
                    <img class="img3" src="assets/infoapp_portada.webp">
                </div> -->

            <div class="container">
                <h4 style="color:#ff0e6e;">Actividades pendientes</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-timeline7">
                    
                        <?php if(count($users)>0){ ?>

                            <?php
                            foreach($users as $user){

                                // sacamos la fecha de inicio
                                $date_pub_end = explode("/",$user->date_pub);
                                if (count($date_pub_end) > 1) {
                                    $date_pub = date("d/m/Y", strtotime($date_pub_end[0]));
                                    setlocale(LC_TIME, "es_ES.UTF-8");
                                    $date_pub = str_replace("/", "-", $date_pub); 
                                    $newDate = date("d-m-Y", strtotime($date_pub)); 
                                    $date_pub = strftime("%a %d de %b", strtotime($newDate));

                                }else {
                                    $date_pub = date("d/m/Y", strtotime($user->date_pub));
                                    setlocale(LC_TIME, "es_ES.UTF-8");
                                    $date_pub = str_replace("/", "-", $date_pub); 
                                    $newDate = date("d-m-Y", strtotime($date_pub)); 
                                    $date_pub = strftime("%a %d de %b", strtotime($newDate));
                                }

                                ?>

                                <?php if ($user->line_action == "Infocentro adentro"){?>

                                    <div class="timeline line_1">
                                        <div class="timeline-icon line_1-icon"><i class="fa fa-desktop"></i></div>
                                        <span class="year year-line_1"><?php echo $date_pub;?></span>
                                        <div class="timeline-content">
                                            <h5 class="title title-line_1"><?php echo $user->line_action; ?></h5>
                                            <p class="description">
                                            <?php echo $user->activity_title;?>
                                            </p>
                                        </div>
                                    </div>

                                <?php } else if ($user->line_action == "Formación a la medida"){?>

                                    <div class="timeline line_2">
                                        <div class="timeline-icon line_2-icon"><i class="fa fa-graduation-cap"></i></div>
                                        <span class="year year-line_2"><?php echo $date_pub;?></span>
                                        <div class="timeline-content">
                                            <h5 class="title title-line_2"><?php echo $user->line_action; ?></h5>
                                            <p class="description">
                                            <?php echo $user->activity_title;?>
                                            </p>
                                        </div>
                                    </div>


                                <?php } else if ($user->line_action == "Tejiendo redes"){?>

                                    <div class="timeline line_3">
                                        <div class="timeline-icon line_3-icon"><i class="fa fa-mobile"></i></div>
                                        <span class="year year-line_3"><?php echo $date_pub;?></span>
                                        <div class="timeline-content">
                                            <h5 class="title title-line_3"><?php echo $user->line_action; ?></h5>
                                            <p class="description">
                                            <?php echo $user->activity_title;?>
                                            </p>
                                        </div>
                                    </div>


                                <?php } else if ($user->line_action == "Unidades socio-productivas"){?>

                                    <div class="timeline line_4">
                                        <div class="timeline-icon line_4-icon"><i class="fa fa-cogs"></i></div>
                                        <span class="year year-line_4"><?php echo $date_pub;?></span>
                                        <div class="timeline-content">
                                            <h5 class="title title-line_4"><?php echo $user->line_action;?></h5>
                                            <p class="description">
                                            <?php echo $user->activity_title;?>
                                            </p>
                                        </div>
                                    </div>


                                <?php } else if ($user->line_action == "Sistematización de Experiencias"){?>

                                    <div class="timeline line_5">
                                        <div class="timeline-icon line_5-icon"><i class="fa fa-pie-chart"></i></div>
                                        <span class="year year-line_5"><?php echo $date_pub;?></span>
                                        <div class="timeline-content">
                                            <h5 class="title title-line_5"><?php echo $user->line_action; ?></h5>
                                            <p class="description">
                                                <?php echo $user->activity_title;?>
                                            </p>
                                        </div>
                                    </div>

                                <?php } ?>

                            <?php } ?>

                        <?php } ?>
                        
                        </div>
                    </div>
                </div>
            </div>

          <br>


    </div>
  </div>

  

</div>

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


<br><br>
    

    

<script language="javascript">
$(document).ready(function(){
  $("#estados").change(function () {

    $('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
    $('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');
    
    $("#estados option:selected").each(function () {
      id_estado = $(this).val();
    
    // alert(id_estado);
    // alert($("#municipios").val());
      
      $.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
      $("#municipios_1").html(data);
      });  

      $.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
      $("#ciudades").html(data);
      });          
    });
  })
});


$(document).ready(function(){
  $("#municipios_1").change(function () {
    $("#municipios_1 option:selected").each(function () {
      id_municipio = $(this).val();
    // alert(id_municipio);
      
      $.post("core/app/view/getParroquia.php", { id_municipio: id_municipio }, function(data){
        $("#parroquias").html(data);
      });            
    });
  })
});



$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// alert(localStorage.getItem("Nombre"));

// localStorage.removeItem("Nombre");

// localStorage.setItem("Nombre", "Ana");
// alert(localStorage.getItem("Nombre"));

// sessionStorage.setItem("Nombre", <!?php echo time(); ?>);
// alert(sessionStorage.getItem("Nombre"));

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