
<?php  require_once "assets/phpemail/recaptchalib.php"; ?>
<script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>



<?php
// include "core/autoload.php";

// $user_type = UserTypeData::getAll();
// $estado = EstadoData::getAll();

if(Session::getUID()!=""){
	print "<script>window.location='index.php?view=dashboard';</script>";
}
// $rx = UserData::getRepeated("Jarcelo","jarce@gmail.com");
// echo "XXX".$rx;


?>



<?php if(isset($_GET['swal']) && isset($_SESSION["alert"]) && $_GET['swal']!= ""): ?>
	<!-- <!?php Core::toast("warning",$_SESSION["alert"],'true'); ?>
	<!?php Core::toast_down("warning",$_SESSION["alert"],'true'); ?>
	<!?php Core::alert_layout("warning",$_SESSION["alert"],'false'); ?> -->

<?php endif; ?>




<script>





$(document).ready(function() {

// alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
// toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
// toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000); // [message, autohide]
// setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);

// var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

// alertas
<?php if(isset($_GET['swal']) && isset($_SESSION["alert"]) && $_GET['swal']!= ""): ?>
	if (mobile) {
		toastify('<?php echo $_SESSION["alert"]; ?>',true,10000,"warning");
	} else {
		toastify('<?php echo $_SESSION["alert"]; ?>',true,10000,"warning"); // [message, autohide]
	}
<?php endif; ?>

// cambiar el parametro de alert
const url = new URL(window.location);
url.searchParams.set('swal', '');
window.history.pushState({}, '', url);

})





$(function() {

	// elimina los espacios al escribir el usuario
	const username = document.getElementById("username");
	username.addEventListener("keyup",e=>{
		let string = e.target.value;
		e.target.value = string.replace(/ /g,"");
	})

})


	// VALIDAR FORMULARIO
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("signup").addEventListener('submit', validarFormulario); 
	});


	function validarFormulario(evento) {
		evento.preventDefault();

        var formObj = document.getElementById('signup');
		var dni = document.getElementById('user_dni').value;
		var email = document.getElementById('email').value;
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		var passwordrepeat = document.getElementById('passwordrepeat').value;

		// valida usuario
		var user_re = /^\w+$/;
		if(!user_re.test(username.value)) {
			if (mobile) {
				alert("El nombre de usuario debe contener únicamente letras, numeros y guión bajo");
				$("#username").focus();
				$("#username")[0].scrollIntoView();             
			} else {
				// alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000); // [message, autohide]
				toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000,"warning"); // [message, autohide]
				$("#username").focus();
				$("#username")[0].scrollIntoView();
			}
			return false;
		}

		// valida longitud de la contraseña
		if (password.length < 8) {
			if (mobile) {
				alert("La contraseña debe tener mínimo 8 carácteres");
				$("#password").focus();
				$("#password")[0].scrollIntoView();           
			} else {
				toastify("La contraseña debe tener mínimo 8 carácteres",true,10000,"warning"); // [message, autohide]
				$("#password").focus();
				$("#password")[0].scrollIntoView();
			}
			return;
		}

		// valida la contraseña
		var myregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/; 
		if(!myregex.test(password)){
			if (mobile) {
				alert("La contraseña no cumple con todos los parámetros de seguridad");
				$("#password").focus();
				$("#password")[0].scrollIntoView();             
			} else {
				toastify("La contraseña no cumple con todos los parámetros de seguridad",true,10000,"warning"); // [message, autohide]
				$("#password").focus();
				$("#password")[0].scrollIntoView(); 
			}
			return false;        
		}  

		// compara las contraseñas
		if(password != passwordrepeat) {
			if (mobile) {
				alert("Las contraseñas deben ser iguales");              
			} else {
				toastify("Las contraseñas deben ser iguales",true,10000,"warning"); // [message, autohide]
			}
			// document.write("Hola");
			return;
		}

		// valida el recaptcha
		var recaptcha = document.getElementById('g-recaptcha-response').value;
		if (recaptcha) {
			$.ajax({
				type: 'POST',
				url: ("index.php?action=recaptcha"),
				// dataType : 'html',
				async: true,
				data: {
					// captchaResponse: recaptcha
					captchaResponse: grecaptcha.getResponse()
				},
				success: function (data) {
					// recaptcha valido
					if(parseInt(data) == 1){
						// 
					}
					if(parseInt(data) == 0){
						if (mobile) {
							alert("No se pudo validar el recaptcha.\nPor favor intenta nuevamente");              
						} else {
							toastify("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",true,10000,"warning"); // [message, autohide]
						}
						return;
					}
					if(parseInt(data) == 2){
						if (mobile) {
							alert("Debes marcar el captcha");              
						} else {
							toastify("Debes marcar el captcha",true,10000,"warning"); // [message, autohide]
							// toastjs("Debes marcar el captcha",false); // [message, autohide]
						}
						return;
					}
				},

			});

		} else {
			if (mobile) {
				alert("El recaptcha es requerido");              
			} else {
				toastify("El recaptcha es requerido",true,10000,"warning"); // [message, autohide]
			}
			return;
		}



		$('#cover-spin').show(0);

        // buscar repetido
        $.ajax({
            type: "POST",
            url: "index.php?action=finaluser&function=getrepeatedsignup",
            // headers: {
            //     "X-CSRFToken": getCookie("csrftoken")
            // },
            data: {
                username: username,
                user_dni: dni,
                email: email
            }
        })
        .done(function( msg ) {
            console.log(msg);
            var array = JSON.parse(msg);
            if(array['err']=='null'){
                if (mobile) {
                    alert(array['text']);
                } else {
                    toastify(array['text'],true,10000,"error");
                }
                $('#cover-spin').hide(0);

                if(array['param']=='ambos'){
                    $("#user_dni").focus();
                }
                if(array['param']=='email'){
                    $("#user_correo").focus();
                }
                if(array['param']=='dni'){
                    $("#user_dni").focus();
                }
                return;

            }else{
                // formObj = document.getElementById('userdata');
                formObj.submit()
            }
        })
        .fail(function() {
            toastify('No se pudo validar el registro, por favor intenta de nuevo',true,10000,"warning");
            return;
        });




		// this.submit();


	}




</script>


<div id="cover-spin"></div>


<!-- div de alerta toastjs -->
<!-- <div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div id="toastjs"></div>
		</div>
	</div>
</div> -->




<!-- FORM -->
<div class="container">
	<br>
	<br>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-7">

			<?php if(isset($_COOKIE['password_updated'])):?>
				<div class="alert alert-success">
					<p><i class='glyphicon glyphicon-off'></i> Se ha cambiado la contraseña exitosamente !!</p>
					<p>Pruebe iniciar sesion con su nueva contraseña.</p>
				</div>
			<?php setcookie("password_updated","",time()-18600);
				endif; ?>

			<div class="card p-4" style="background-color: #ffffffc2;">
				<div class="mui-container-fluid">
					
					<!-- <div class="row justify-content-center"><span class="material-icons md-48 orange600">&#xe7fe;</span></div>     -->
					<!-- <div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-48 orange600">person_add</span></div>   -->
					<div class="row justify-content-center">
						<img decoding="async" src="uploads/logo_info.webp" title="LOGO" alt="LOGO" loading="lazy">
					</div>
					<!-- <div class="row justify-content-center"><h4 class="title">Fundación Infocentro</h4></div>     -->
					<div class="row justify-content-center"><h6 class="title">Crear una cuenta</h6></div>    
					
					<form id="signup" accept-charset="UTF-8" class="form-horizontal" method="post" action="index.php?action=adduser" role="form">
					
						<fieldset>

						<!-- <div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><i class="fa fa-user"></i> Nombre</label>
								<input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
							</div>
						</div> -->

						<div class="col-md-12">
							<div class="form-group floating-label form-ripple-bottom">
							<label for="floating">Nombre</label>
							<input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group floating-label form-ripple-bottom">
							<label for="floating">Apellido</label>
							<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Apellido">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group floating-label form-ripple-bottom">
							<label for="floating">Documento de identidad</label>
							<input type="number" name="user_dni" class="form-control" id="user_dni" minlength="7" maxlength="8" placeholder="2012345" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group floating-label form-ripple-bottom">
							<label for="floating">Nombre de usuario*</label>
							<input type="text" name="username" class="form-control" id="username" placeholder="Usuario" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group floating-label form-ripple-bottom">
							<label for="floating">Correo electrónico*</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="Correo" required>
							</div>
						</div>

						<div class="form-group col-md-12">
							<label for="gender">Género</label>
							<select name="gender" id="gender" class="form-control" required>
								<option value="">-SELECCIONE-</option>
								<option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
							</select>
						</div>

						<div class="col-md-12">
							<div class="form-group floating-label">
								<label for="password"> <i class="fa fa-lock"></i> Crea una contrase&ntilde;a para tu cuenta*</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Contrase&ntilde;a" required>
								<small id="passwordHelpBlock" class="form-text text-muted">Debe tener mímino 8 caracteres, mayúsculas, minúsculas, y números.</small>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group floating-label form-ripple-bottom">
							<label class="control-label"><i class="fa fa-lock"></i> Repite la contrase&ntilde;a*</label>
							<input type="password" name="passwordrepeat" class="form-control" id="passwordrepeat" placeholder="Contrase&ntilde;a" required>
							</div>
						</div>

						

						<div class="col-md-12">
							<div class="form-check" id="is_organization">
								<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" class="custom-control-input" name="is_organization" value="Programación" id="checkbox_organization" value="0">
									<label class="custom-control-label" for="checkbox_organization">Pertenece a una organización comunitaria</label>
								</div>
							</div>
						</div>

			

						<div class="col-md-12" id="organization_name" style="display: none;">
							<div class="form-group floating-label form-ripple-bottom">
							<label for="floating">Nombre de la organización</label>
							<!-- <input type="text" name="username" class="form-control" id="username" placeholder="Usuario" required> -->
							<input type="text" name="organization_name" class="form-control" id="organization" value="" placeholder="">
							</div>
						</div>
	
						<div class="col-md-12">
							<div class="form-group row justify-content-center">
								<div id="g-recaptcha" class="g-recaptcha" data-sitekey="6Ley_7EnAAAAAKrjkKYZ4L4-uuXC_nA9B_tOA88C"></div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"> Crear cuenta</button>
							</div>
						</div>


						</fieldset>
					</form>

					<li class="row justify-content-center"> <a class="nav-link" href="index.php"><h6 class="title">Iniciar sesión</h6></a></li>


				</div>

			</div>
		</div>
	</div>
</div>

<br><br>





<script>
// alerta al salir del campo de passwordrepeat si no son iguales
$(function(){
	$("#passwordrepeat").change(function () {
		passwordrepeat = $(this).val();
        password = document.getElementById("password").value;
        if (passwordrepeat != password){
			// alert("las contraseñas no son iguales");
		// const bs5Utils = new Bs5Utils();
		// bs5Utils.Snack.show('warning', 'Las contraseñas no son iguales', 0, false);

		}
	});
});


// resalta el campo mientras se confirma el password
var controladorTiempo = "";
$(function(){
	$("#username").focus();
	
	$("#is_organization").change(function () {
      data = $(this).val();
      var checkbox = $("#checkbox_organization").is(":checked");

      var $organization_name = $('#organization_name');
      if (checkbox == true){
        $($organization_name).show();
        $("#organization").focus();
      }else{
        $($organization_name).hide();
        $("#organization").val("");
      }

    });

	$("#passwordrepeat").on("keyup", function() {
		passwordrepeat = $(this).val();
        password = document.getElementById("password").value;
		clearTimeout(controladorTiempo);
        if (passwordrepeat != password){
			// retardo entre caracteres
			controladorTiempo = setTimeout(comparepass(' is-invalid'), 800);
		}else{
			document.getElementById("passwordrepeat").classList.remove("is-invalid");
			controladorTiempo = setTimeout(comparepass(' is-valid'), 800);
		}
	});

	$("#password").on("keyup", function() {
		passwordrepeat = $(this).val();
        password = document.getElementById("passwordrepeat").value;
		clearTimeout(controladorTiempo);
        if (passwordrepeat != password){
			// retardo entre caracteres
			controladorTiempo = setTimeout(comparepass(' is-invalid'), 800);
		}else{
			document.getElementById("passwordrepeat").classList.remove("is-invalid");
			controladorTiempo = setTimeout(comparepass(' is-valid'), 800);
		}
	});





});

function comparepass(setclass) {
	// const bs5Utils = new Bs5Utils();
	// bs5Utils.Snack.show('warning', setclass, 0, false);
	var element = document.getElementById("passwordrepeat");
    element.className += setclass;
}

</script>













<style>
	/* Rules for sizing the icon. */
.material-icons.md-18 { font-size: 18px; }
.material-icons.md-24 { font-size: 24px; }
.material-icons.md-36 { font-size: 36px; }
.material-icons.md-48 { font-size: 48px; }

/* Rules for using icons as black on a light background. */
.material-icons.md-dark { color: rgba(0, 0, 0, 0.54); }
.material-icons.md-dark.md-inactive { color: rgba(0, 0, 0, 0.26); }

/* Rules for using icons as white on a dark background. */
.material-icons.md-light { color: rgba(255, 255, 255, 1); }
.material-icons.md-light.md-inactive { color: rgba(255, 255, 255, 0.3); }

.material-icons.orange600 { color: #009dfb; }
</style>
