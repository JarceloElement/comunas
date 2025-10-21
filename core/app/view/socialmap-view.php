<!-- Archivo CSS para Swiper JS -->
<link rel="stylesheet" type="text/css" href="assets/plugins/swiper/node_modules/swiper/swiper-bundle.css">
<!-- Archivo Javascript para Swiper JS -->
<script type="text/javascript" src="assets/plugins/swiper/node_modules/swiper/swiper-bundle.js"></script>
<script type="text/javascript" src="assets/plugins/swiper/node_modules/swiper/swiper-bundle.esm.js"></script>

<?php


// $estados = EstadoData::getAll();
// $municipio = MunicipioData::getAll();
// $internet_type = InternetTypeData::getAll();
// $operative_info = OperativeInfoData::getAll();
// $status_type = StatusInfocentroData::getAll();


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);




$user_id = "";
$user_email = "";
$cod_info = "";
$id_map = "";


if (isset($_SESSION['user_code_info'])) {

	$user_id = $_SESSION['user_id'];
	$user_type = $_SESSION['user_type'];
	$user_email = $_SESSION['user_email'];
	$cod_info = $_SESSION['user_code_info'];
	$user_cod_gerencia = $_SESSION['user_cod_gerencia'];

	$socialmap = SocialMapData::getByInfo("'" . $_SESSION['user_code_info'] . "'");
	$id_map = $socialmap->id;


	// info con postgres
	$user_code_info = strtoupper($_SESSION['user_code_info']);
	$conn = DatabasePg::connectPg();
	$row_table = $conn->prepare("SELECT * from infocentros where cod = '$user_code_info' ");
	$row_table->execute();
	$info = $row_table->fetchAll(PDO::FETCH_ASSOC);

	if (count($info) > 0) {
		foreach ($info as $name) :
			$municipio = $name["municipio"];
			$direccion = $name["direccion"];
		endforeach;
	}
}
?>



<?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
	<?php Core::toast("warning", $_SESSION["alert"], 'false'); ?>
	<!?php Core::toast_down("warning",$_GET['swal'],'true'); ?>
		<!?php Core::alert_layout("warning",$_SESSION["alert"],'false'); ?>

		<?php endif; ?>



		<script language="javascript">
			$(document).ready(function() {

				var Name_OS = "Unknown OS";
				// OS NAME
				if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
				if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
				if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
				if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
				if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
				// console.log(Name_OS);
				// navegador web en escritorio
				var sBrowser, sUsrAg = navigator.userAgent;

				if (sUsrAg.indexOf("Chrome") > -1) {
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


				if (Name_OS == "Android") {
					get_Name = Name_OS + "|" + sBrowser;
					get_Name = get_Name === "" ? "N/D" : get_Name;
					// get_Name = Name_OS + "|" + md.userAgent() + "|" + md.mobile() + "|" + md.versionStr('Build');
					$("#user_name_os").val(get_Name);
				} else {
					get_Name = Name_OS + "|" + sBrowser;
					get_Name = get_Name === "" ? "N/D" : get_Name;
					$("#user_name_os").val(get_Name);
				}

				// // // AVISO
				// if (Name_OS != "Android"){
				// 	Swal.fire({
				// 	// position: 'top-center',
				// 	icon: 'warning',
				// 	title: 'Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.\n',
				// 	showConfirmButton: true,
				// 	// timer: 1000
				// 	})
				// }else{
				// 	alert('Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.');
				// }















				// VALIDAR FORMULARIO
				document.addEventListener("DOMContentLoaded", function() {
					document.getElementById("set_map").addEventListener('submit', set_map);
				});

				function set_map(evento) {

					evento.preventDefault();

					user_id = document.getElementById("user_id").value;
					user_type = document.getElementById("user_type").value;
					code_info = document.getElementById("code_info").value;
					user_email = document.getElementById("user_email").value;

					if (user_id === "") {
						alert("Falta el user_id, intenta iniciar sesión nuevamente.");
						return;
					};
					if (user_type === "") {
						alert("Falta el user_type, intenta iniciar sesión nuevamente.");
						return;
					};
					if (code_info === "") {
						alert("Falta el code_info, intenta iniciar sesión nuevamente.");
						return;
					};
					if (user_email === "") {
						alert("Falta el user_email, intenta iniciar sesión nuevamente.");
						return;
					};

					document.getElementById("submit_map").disabled = true;
					this.submit();
					// document.form.submit();

				}







			});
		</script>








		<!-- documentacion mapa -->
		<br>
		<br>

		<div class="row justify-content-center">
			<div class="col-md-5">
				<!-- Swiper -->
				<div class="swiper">
					<div class="swiper-wrapper">

						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/portada.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/1.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/2.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/3.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/4.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/5.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/6.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/7.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/8.jpg">
							</div>
						</div>
						<div class="swiper-slide">
							<div class="swiper-zoom-container">
								<img src="uploads/images/socialmap/9.jpg">
							</div>
						</div>

					</div>
					<!-- Add Pagination -->
					<div class="swiper-pagination swiper-pagination-white"></div>
					<!-- Add Navigation -->
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			</div>
			<!-- <!?php echo "UD:".$_SESSION["user_demo"]; ?> -->
			<!-- <!?php echo "CG:".$user_cod_gerencia; ?> -->
		</div>









		<!-- Usuario con codigo info | no ha creado el mapa -->
		<?php if (($id_map == "" && $cod_info != "" && ($user_cod_gerencia != 1 || $user_cod_gerencia != -1) ) || ($id_map == "" && ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 9))) { ?>

			<br>
			<div class="row justify-content-center">
				<div class="col-md-5">
					<!-- <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#nuevoservicio">Crear mapa social</button> -->
					<!-- <button class="btn btn-flat-warning btn-block" type="button">Crear Mapa Social</button> -->
					<!-- <button class="btn btn-warning btn-shaped btn-block" type="button">Crear Mapa Social</button> -->
					<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>
					<!-- <button class="btn btn-outline-primary btn-shaped btn-block" type="button"><i class="material-icons btn-icon-prepend" aria-hidden="true">add</i>Crear Mapa Social</button> -->

				</div>
			</div>


			<!-- FORM -->
			<form name="form" id="set_map" accept-charset="UTF-8" class="form-horizontal" method="post" action="index.php?action=socialmap&function=add&pag=" role="form">
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>">
				<input type="hidden" name="code_info" id="code_info" value="<?php echo $cod_info; ?>">
				<input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
				<input type="hidden" name="user_name_os" id="user_name_os" value="">

				<fieldset>

					<div class="row justify-content-center">
						<div class="col-md-5">
							<div class="form-group">
								<!-- <button type="submit" class="btn btn-primary btn-block"> Crear Mapa Social </button> -->
								<button class="btn btn-outline-primary btn-shaped btn-block" type="submit" id="submit_map"><i class="material-icons btn-icon-prepend" aria-hidden="true">add</i>Crear Mapa Social</button>
							</div>
						</div>
					</div>

				</fieldset>
			</form name="form">

		<?php } ?>





		<?php if ($cod_info == "") { ?>

			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="container">
						<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>
						<div class="row justify-content-center">
							<h6 class="title">Debes tener un código de Infocentro vinculado a tu usuario para cargar el mapa social, puedes editar tu usuario y agregar el código del Infocentro</h6>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>

		<?php if ($cod_info != "" && $user_cod_gerencia == -1 && $_SESSION["user_type"] != 2) { ?>

			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="container">
						<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>
						<div class="row justify-content-center">
							<h6 class="title">No existe ningún infocentro registrado con tu código info: <?php echo $cod_info; ?>. Por favor verifica que tu infocentro esté registrado en el sistema.</h6>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>

		<?php if ($cod_info != "" && $_SESSION["user_type"] != 2) { ?>

			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="container">
						<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>
						<div class="row justify-content-center">
							<h6 class="title">Solo los facilitadores pueden generar el mapa social ya que el mismo se vincula con el código del infocentro</h6>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>

		<?php if ($cod_info != "" && $user_cod_gerencia == 1 && $_SESSION["user_type"] == 2) { ?>

			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="container">
						<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>
						<div class="row justify-content-center">
							<h6 class="title">Actualmente tienes rol de facilitador(a) pero tu código de infocentro aparece marcado como "Código de gerencia", esta configuración no es correcta, por favor solicita a tu soporte para solucionarlo ya que un facilitador(a) no puede tener código de gerencia.</h6>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>


		<br>
		<br>





		<?php if ($id_map != "") { ?>

			<br>
			<?php include "core/app/view/form_socialmap_modal.php"; ?>
		<?php } ?>





		<!-- Initialize Swiper -->
		<script type="text/javascript">
			function delete_socialmap(e) {
				field_id = e.id;

				$.post("index.php?action=socialmapstudents&function=delete", {
					id: field_id
				}, function(response, status, data, result) {
					if (status == 'success') {
						e.parentNode.remove();
						toastify('Eliminado', true, 1000, "dashboard");

					}
				});

				// alert(field_id);
			}
















			var swiper = new Swiper('.swiper', {
				zoom: true,
				slidesPerView: 1,
				spaceBetween: 30,

				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				//   autoplay: {
				//     delay: 2500,
				//     disableOnInteraction: false,
				//   },
				keyboard: {
					enabled: true,
				},
				loop: true,

			});
		</script>





		<!-- Demo styles -->
		<style>
			html,
			body {
				position: relative;
				height: 100%;
			}

			/* body {
      background: #000;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: rgb(218, 218, 218);
      margin: 0;
      padding: 0;
    } */

			.swiper {
				width: 100%;
				height: 100%;

				background: #000;
				font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
				font-size: 14px;
				color: rgb(218, 218, 218);
				margin: 0;
				padding: 0;
			}

			.swiper-slide {
				overflow: hidden;
			}
		</style>