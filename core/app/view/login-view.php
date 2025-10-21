<?php

if (Session::getUID() != "") {

	$base = new Database();
	$con = $base->connect();


	$user_correo = $_SESSION['user_email'];
	$sql = "SELECT * from final_users where (user_correo = '$user_correo') ";
	$usuario_final = ExecutorPg::get($sql)[0];

	if (count($usuario_final) > 1) {
		$user_email = $usuario_final["user_correo"];
	} else {
		$_SESSION["alert"] = "Registro de perfil";
		print "<script>window.location='index.php?view=userform_new&new=0&swal=1';</script>";
	}

	// Verifica si el usuario final existe y lo envia al dashboard, sino al userform de registro
	if ($user_email != "") {
		print "<script>window.location='index.php?view=dashboard';</script>";
	} else {
		print "<script>window.location='index.php?view=userform';</script>";
	}
}
?>



<script>
	$(document).ready(function() {
		var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
		// document.getElementById('netnone').id = 'net';

		// alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
		// toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
		// toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000); // [message, autohide]
		// setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);





		// AVISO
		//if (mobile != "Android") {
		//	Swal.fire({
//		icon: 'warning',
//		title: '¡Hola!',
//		text: "Queremos informarte que para mejorar el rendimiento de la InfoApp, en este momento se está migrando a un nuevo servidor.\n Una vez se haya completado se les enviará la información de acceso.",
//		showConfirmButton: true,
//		timer: 50000
//	})
		//else {
//	alert('¡Hola ' + 'Queremos informarte que para mejorar el rendimiento de la InfoApp, en este momento se está migrando a un nuevo servidor.\n Una vez se haya completado se les enviará la información de acceso.');
		//






		// alertas
		<?php if (isset($_GET['swal']) && isset($_SESSION["alert"]) && $_GET['swal'] != "") : ?>
			if (mobile) {
				document.getElementById("elementId").style.display = "none"
				toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "warning");
			} else {
				toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "warning"); // [message, autohide]
			}
		<?php endif; ?>

		// cambiar el parametro de alert
		const url = new URL(window.location);
		url.searchParams.set('swal', '');
		window.history.pushState({}, '', url);



		// ajustar titulo flotante del campo cuando no esta vacio
		$('.floating-label .custom-select, .floating-label .form-control').floatinglabel();


	})
</script>



<script>
	// VALIDAR FORMULARIO
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("login").addEventListener('submit', validarFormulario);
	});

	function validarFormulario(evento) {
		evento.preventDefault();

		// valida el recaptcha
		// var recaptcha = document.getElementById('g-recaptcha-response').value;
		// if (recaptcha) {
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: ("index.php?action=recaptcha"),
		// 		// dataType : 'html',
		// 		async: true,
		// 		data: {
		// 			// captchaResponse: recaptcha
		// 			captchaResponse: grecaptcha.getResponse()
		// 		},
		// 		success: function (data) {
		// 			// recaptcha valido
		// 			if(parseInt(data) == 1){
		// 				// 
		// 			}
		// 			if(parseInt(data) == 0){
		// 				if (mobile) {
		// 					alert("No se pudo validar el recaptcha.\nPor favor intenta nuevamente");              
		// 				} else {
		// 					toastify("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",true,10000,"warning"); // [message, autohide]
		// 				}
		// 				return;
		// 			}
		// 			if(parseInt(data) == 2){
		// 				if (mobile) {
		// 					alert("Debes marcar el captcha");              
		// 				} else {
		// 					toastify("Debes marcar el captcha",true,10000,"warning"); // [message, autohide]
		// 					// toastjs("Debes marcar el captcha",false); // [message, autohide]
		// 				}
		// 				return;
		// 			}
		// 		},

		// 	});

		// } else {
		// 	if (mobile) {
		// 		alert("El recaptcha es requerido");              
		// 	} else {
		// 		toastify("El recaptcha es requerido",true,10000,"warning"); // [message, autohide]
		// 	}
		// 	return;
		// }



		this.submit();


	}
</script>

<!-- div de alerta toastjs -->
<!-- <div id="toastjs"></div> -->


<!-- background -->
<link rel="stylesheet" href="/assets/background_login/style.css">
<div id="net">


	<!-- FORM -->
	<div class="container">
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card p-4" style="background-color: #ffffffc2;">
					<!-- <div class="card p-4 shadow p-3" style="background-color: #ffffffc2;"> -->
					<div class="mui-container-fluid">

						<div class="row justify-content-center">
							<img decoding="async" src="uploads/logo_info.webp" title="LOGO" alt="LOGO" loading="lazy">
						</div>

						<!-- <div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-48 orange600">person_pin</span></div>   -->
						<div class="row justify-content-center">
							<h6 class="title">Ingresar a Infocentrox</h6>
						</div>

						<div class="card-content table-responsive">
							<form id="login" accept-charset="UTF-8" role="form" method="post" action="index.php?view=processlogin">
								<fieldset>

									<div class="form-group floating-label form-ripple-bottom">
										<label for="floating">Usuario o correo</label>
										<input class="form-control" name="email" type="text" required></input>
									</div>

									<div class="form-group floating-label form-ripple-bottom">
										<label for="floating">Contraseña</label>
										<input class="form-control" placeholder="Contraseña" id="password" name="password" type="password" value="" required>
									</div>

									<!-- <div class="col-md-12">
									<div class="form-group row justify-content-center">
										<div id="g-recaptcha" class="g-recaptcha" data-sitekey="6LdYkXwkAAAAACySah1ddWIyPcBa_0L3klLe5GcE"></div>
									</div>
								</div> -->

									<input class="btn btn-primary btn-block" type="submit" value="Iniciar Sesión">
								</fieldset>
							</form>
						</div>
					</div>

					<li class="row justify-content-center">
						<a class="nav-link" href="index.php?view=signup">
							<h6 class="title">Crear una cuenta</h6>
						</a>
					</li>

				</div>
			</div>
		</div>
	</div>













	<style>
		/* Rules for sizing the icon. */
		.material-icons.md-18 {
			font-size: 18px;
		}

		.material-icons.md-24 {
			font-size: 24px;
		}

		.material-icons.md-36 {
			font-size: 36px;
		}

		.material-icons.md-48 {
			font-size: 48px;
		}

		/* Rules for using icons as black on a light background. */
		.material-icons.md-dark {
			color: rgba(0, 0, 0, 0.54);
		}

		.material-icons.md-dark.md-inactive {
			color: rgba(0, 0, 0, 0.26);
		}

		/* Rules for using icons as white on a dark background. */
		.material-icons.md-light {
			color: rgba(255, 255, 255, 1);
		}

		.material-icons.md-light.md-inactive {
			color: rgba(255, 255, 255, 0.3);
		}

		.material-icons.orange600 {
			color: #009dfb;
		}


		/* body, html {
  height: auto;
  background-repeat: no-repeat;
  background: url('assets/css/back.webp') no-repeat center fixed;
  background-size: auto;
}

@media only screen and (max-width: 767px) {
body, html {
  background-image: url('assets/css/back.webp');
}


} */

		/* .g-recaptcha{

} */
	</style>

	<!-- partial -->
	<script src='/assets/background_login/js_r121_three.min.js'></script>
	<script src='/assets/background_login/latest_dist_vanta.net.min.js'></script>
	<script src="/assets/background_login/script.js"></script>


	<script>
		// evento al usuario cerrar el toast
		// $('#layout_alert').on('hidden.bs.toast', function () {
		//   alert("Toast cerrado");
		// })
		// $(document).ready(function(){

		// $('.floating-label .custom-select, .floating-label .form-control').floatinglabel();

		// });
	</script>