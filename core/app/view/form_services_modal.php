
<?php

// form_services

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");


$Name_OS = "";
$user_id = $_SESSION['user_id'];
$cod_info = $_SESSION['user_code_info'];


if ($_SESSION['user_code_info'] == "777"){
	$info = InfoData::getByCode("ama000");
	$estado = $info->estado;
	$municipio = $info->municipio;
	$direccion = $info->direccion;
}else {
	$info = InfoData::getByCode($_SESSION['user_code_info']);
	$estado = $info->estado;
	$municipio = $info->municipio;
	$direccion = $info->direccion;
}
?>



<script language="javascript">

    $('#cover-spin').show(0);

    var Name_OS = "Unknown OS";
	// OS NAME
	if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
	if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
	if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
	if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
	if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";

    // navegador web en escritorio
    var sBrowser, sUsrAg = navigator.userAgent;

    if(sUsrAg.indexOf("Chrome") > -1) {
        sBrowser = "Chrome";
    } else if (sUsrAg.indexOf("Safari") > -1) {
        sBrowser = "Safari";
    } else if (sUsrAg.indexOf("Opera") > -1) {
        sBrowser = "Opera";
    } else if (sUsrAg.indexOf("Firefox") > -1) {
        sBrowser = "Firefox";
    } else if (sUsrAg.indexOf("MSIE") > -1) {
        sBrowser = "Internet Explorer";
    }
    // console.log(sBrowser);


    
    if (Name_OS == "Android"){
        get_Name = Name_OS + "|" + sBrowser;
        // get_Name = Name_OS + "|" + md.userAgent() + "|" + md.mobile() + "|" + md.versionStr('Build');
        $("#user_name_os").val(get_Name);
    }else{
        get_Name = Name_OS + "|" + sBrowser;
        $("#user_name_os").val(get_Name);
    }
    // console.log(md.mobile());




// VALIDAR FORMULARIO
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("form").addEventListener('submit', validarFormulario); 
});

function validarFormulario(evento) {
    $('#cover-spin').show(0);

    <?php if( $estado == ""){?>
        alert("No tienes código de infocentro asociado en el usuario.\nPuedes editar tu usuario y colocar tu código de infocentro.");
        event.preventDefault();
        return;
    <?php }?>

	evento.preventDefault();
	var user_id = document.getElementById('user_id').value;
	var document_id = document.getElementById('document_id').value;
	var name = document.getElementById('name').value;
	if(!user_id) {
        alert("No user_id");
		// toastjs("Las contraseñas deben ser iguales",false); // [message, autohide]
		// document.write("Hola");
		return;
	}	
    if(!document_id || !name) {
        // alert("Por favor selecciona un usuario");
		// toastjs("Las contraseñas deben ser iguales",false); // [message, autohide]
		// document.write("Hola");
        document.getElementById('q_participante').focus();
        
		return;
	}
	// var clave = document.getElementById('clave').value;
	// if (clave.length < 6) {
	// 	alert('La clave no es válida');
	// 	return;
	// }
	this.submit();
}






</script>


<!-- <div id="cover-spin"></div> -->



<!-- FORM -->
<form name="form" id="form" accept-charset="UTF-8" class="form-horizontal" method="post" action="index.php?action=services_users&function=add&pag=" role="form">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
    <input type="hidden" name="user_info_cod" id="user_info_cod" value="<?php echo $cod_info;?>">
    <input type="hidden" name="user_nombres" id="user_nombres" value="">
    <input type="hidden" name="user_apellidos" id="user_apellidos" value="">
    <input type="hidden" name="user_dni" id="user_dni" value="">
    <input type="hidden" name="user_correo" id="user_correo" value="">
    <input type="hidden" name="user_telefono" id="user_telefono" value="">
    <input type="hidden" name="user_genero" id="user_genero" value="">
    <input type="hidden" name="user_f_nacimiento" id="user_f_nacimiento" value="">
    <input type="hidden" name="user_edad" id="user_edad" value="">
    <input type="hidden" name="user_nivel_academ" id="user_nivel_academ" value="">
    <input type="hidden" name="user_profesion" id="user_profesion" value="">
    <input type="hidden" name="user_empleado" id="user_empleado" value="">
    <input type="hidden" name="user_institucion" id="user_institucion" value="">
    <input type="hidden" name="user_estado" id="user_estado" value="<?php echo $estado?>">
    <input type="hidden" name="user_municipio" id="user_municipio" value="<?php echo $municipio?>">
    <input type="hidden" name="user_direccion" id="user_direccion" value="<?php echo $direccion?>">
    <input type="hidden" name="user_tipo_servicio" id="user_tipo_servicio" value="">
    <input type="hidden" name="user_name_os" id="user_name_os" value="">

    <fieldset>


    <div class="col-md-12">
        <div class="form-group floating-label form-ripple-bottom">
        <label for="floating">Buscar usuario por DNI, nombre o correo</label>
        <input type="text" name="buscar_participante" id="q_participante" value="" class="form-control" placeholder="DNI, nombre o correo">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
        <div class="form-row">
            <div class="col">
                <input type="text" name="name" id="name" required class="form-control" placeholder="Nombre y apellido" disabled>
            </div>
            <div class="col">
                <input type="text" name="document_id" id="document_id" required class="form-control" placeholder="Documento ID" disabled>
            </div>
        </div>
        </div>
    </div>



    <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">Fecha del servicio</label>
        <!-- <input type="password" name="passwordrepeat" class="form-control" id="passwordrepeat" placeholder="Contrase&ntilde;a" required> -->
        <input type="text" name="user_fecha_servicio" required class="form-control" id="user_fecha_servicio" value="<?php echo date("Y/m/d",time());?>" placeholder="" onclick="ocultarError();" onfocus="(this.type='date')" >
    </div>
    </div>



    <div class="col-md-12">
        <div class="form-group">
            <!-- <label for="user_tipo_servicio" class="control-label">Servicio prestado*</label> -->
            <select name="tipo_servicio" class="form-control" id="tipo_servicio" required>
                <option value=""> --Servicio prestado-- </option>
                <option value="Investigación"> Investigación </option>
                <option value="Uso de redes sociales"> Uso de redes sociales </option>
                <option value="Banca en línea"> Banca en línea </option>
                <option value="Comercio en línea"> Comercio en línea </option>
                <option value="Sistema Patria"> Sistema Patria </option>
                <option value="Gobierno en línea"> Gobierno en línea </option>
                <option value="Noticias"> Noticias </option>
                <option value="Entretenimiento"> Entretenimiento </option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"> Registrar servicio</button>
        </div>
    </div>



    </fieldset>
</form name="form">

<!-- <li class="row justify-content-center"> <a class="nav-link" href="index.php?view=login"><h6 class="title">Iniciar sesión</h6></a></li> -->











<script language="javascript">
document.addEventListener("DOMContentLoaded", function() {

// CARGA DATOS DEL RESPONSABLE CON AJAX Y RETARDO AL ESCRIBIR
    var controladorTiempo = "";

    // retardo entre caracteres
    $(function(){

        $("#q_participante").on("keyup", function() {
            clearTimeout(controladorTiempo);
            controladorTiempo = setTimeout(codigoAJAX, 800);
        });
    });

					
    function codigoAJAX() {
        que = document.getElementById("q_participante").value;
        // alert(que);
        $.post("core/app/view/getFinalUser-view.php", { search: que }, function(data){
            var array = JSON.parse(data);
            // alert(array["email"]);
            $("#name").val(array["user_nombres"]+" "+array["user_apellidos"]); // preview
            $("#document_id").val(array["user_dni"]); // preview
            $("#user_nombres").val(array["user_nombres"]);
            $("#user_apellidos").val(array["user_apellidos"]);
            $("#user_dni").val(array["user_dni"]);
            $("#user_correo").val(array["user_correo"]);
            $("#user_telefono").val(array["user_telefono"]);
            $("#user_genero").val(array["user_genero"]);
            $("#user_f_nacimiento").val(array["user_f_nacimiento"]);
            $("#user_edad").val(array["user_edad"]);
            $("#user_nivel_academ").val(array["user_nivel_academ"]);
            $("#user_profesion").val(array["user_profesion"]);
            $("#user_empleado").val(array["user_empleado"]);
            $("#user_institucion").val(array["user_institucion"]);
            // $("#user_estado").val(array["user_estado"]);
            // $("#user_municipio").val(array["user_municipio"]);
            // $("#user_direccion").val(array["user_direccion"]);
            // $("#parroquias").val(array["parroquia"]);
            
        }); 
    }
    // =======================


    $(function(){
        $("#tipo_servicio").change(function () {
            value = $(this).val();
            $("#user_tipo_servicio").val(value);
            // alert(value);
                     
        });








    });
});





</script>

