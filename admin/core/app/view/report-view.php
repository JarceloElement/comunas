<?php
$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();
$location = "index.php?view=report";

$user_code_info = "";
$user_id = "";


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>



<?php
// limitar texto de la tarjeta
function charlimit_title($string, $limit)
{
	$overflow = (strlen($string) > $limit ? true : false);
	return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
}
?>


<!-- MODAL IMAGE POPUP -->
<script language="javascript">
	function del_item(url) {
		Swal.fire({
			title: "\n¿Desea eliminar?",
			text: "¡Esto es irreversible! Eliminará también participantes y productos cargados en ésta actividad",
			// icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "¡Sí, eliminar!",
			cancelButtonText: "Cancelar",
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = url
			}
		});
	};

	function limpiar(id) {
		document.getElementById(id).value = "";
		return false;
	}



	$(document).ready(function() {
		// $('[data-toggle="tooltip"]').tooltip();
		// $('#tooltip').tooltip({
		// 	placement: "top"
		// })



		var Name_OS = "Unknown OS";
		// OS NAME
		if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
		if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
		if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
		if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
		if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
		// console.log(Name_OS);



		// // AVISO
		//if (Name_OS != "Android"){

		//alert('En este momento estamos trabajando en el módulo de reportes.\nPor favor vuelve mas tarde');


		// Swal.fire({
		// // position: 'top-center',
		// icon: 'warning',
		// title: 'En este momento estamos trabajando en el módulo de reportes.\nPor favor vuelve mas tarde',
		// showConfirmButton: true,
		// // timer: 1000
		// })
		//}else{
		//alert('En este momento estamos trabajando en el módulo de reportes.\nPor favor vuelve mas tarde');
		//}




		// mensaje al cambiar el estatus de la actividad
		<?php if (isset($_SESSION['alert']) && $_SESSION['alert'] != "") : ?>
			if (getOS() != "Android") {
				Swal.fire({
					icon: 'success',
					title: '¡Listo!',
					text: '<?php echo $_SESSION['alert']; ?>',
					showConfirmButton: true,
					timer: 50000

				})
			} else {
				alert("<?php echo $_SESSION['alert']; ?>");
			}

			<?php $_SESSION['alert'] = ""; ?>
		<?php endif; ?>





		function sendMessage(event, param, url) {
			event.preventDefault();

			$.ajax({
					type: "POST",
					url: "./?action=ajax",
					// headers: {
					//     "X-CSRFToken": getCookie("csrftoken")
					// },
					data: {
						function: "send_notific",
						message: param,
						url: url,
					}
				})
				.done(function(msg) {
					if (getOS() == "Android") {
						alert("Registro actualizado");
					} else {
						toastify('Registro actualizado', true, 1000, "dashboard");
					}
					// console.log(msg);
					location.reload();

				})
				.fail(function(err) {
					if (getOS() == "Android") {
						alert("Ocurrió un error al guardar, intenta nuevamente");
					} else {
						toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
					}

					$('#cover-spin').hide(0);
				});
			// .always(function() {
			//     toastify('Finished',true,1000,"warning");
			// });
		};



		// <!-- MODAL SWEET ALERT -->
		$(function() {

			<?php if (isset($_GET['swal']) && $_GET['swal'] != "") : ?>
				if (Name_OS != "Android") {
					Swal.fire({
						// position: 'top-center',
						icon: 'success',
						title: '<?php echo $_GET['swal']; ?>',
						<?php if (isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "true") : ?>
							showConfirmButton: true,
						<?php endif; ?>
						<?php if (!isset($_GET['ConfirmButton']) || $_GET['ConfirmButton'] == "false") : ?>
							showConfirmButton: false,
							timer: 1000
						<?php endif; ?>
					})
				} else {

					alert("<?php echo $_GET['swal']; ?>");
				}

				// cambiar el parametro de alert
				const url = new URL(window.location);
				url.searchParams.set('swal', '');
				window.history.pushState({}, '', url);

			<?php endif; ?>


			var data_user_id = "";
			var activity_title = "";
			var code_info = "";
			var responsible_name = "";
			var responsible_type = "";
			var notific_data = "";
			var estado = "";
			var user_username = '<?php echo $_SESSION['user_username']; ?>';

			// al abrir el modal user notific
			$(document).on('click', 'a[type="show_notific"]', function(event) {
				let id = this.id;
				var user_type = <?php echo $_SESSION["user_type"] ?>;
				data_user_id = document.getElementsByClassName("user_id").item(id).id;
				var user_id = <?php echo $_SESSION["user_id"] ?>;
				var data_code = document.getElementsByClassName("data_code").item(id).id;
				var user_code_info = '<?php echo trim(strtoupper($_SESSION["user_code_info"])) ?>';
				var id_activity = document.getElementsByClassName("id_activity").item(id).id;
				notific_data = document.getElementsByClassName("notific_var").item(id).id;
				// console.log(user_id,parseInt(data_user_id));

				document.getElementById("notific_status").value = notific_data;
				document.getElementById("id_notific").value = id_activity;

				if (user_code_info == data_code.toUpperCase() || user_id == parseInt(data_user_id) || user_type >= 5) {
					$("#save_obs").show();
				} else {
					$("#save_obs").hide();
				}

				// // escala el textarea
				// const tx = document.getElementsByTagName("textarea");
				// $("textarea").each(function () {
				//     for (let i = 0; i < tx.length; i++) {
				//         var text = tx[i].value;   
				//         var lines = text.split(/\r|\r\n|\n/);
				//         count = lines.length;
				//         tx[i].rows = count;
				//     }
				// })

			})

			// al abrir el modal rellena los datos del form
			$(document).on('click', 'a[type="update_planning"]', function(event) {
				let id = this.id;
				var data_user_id = document.getElementsByClassName("user_id").item(id).id;
				var id_activity = document.getElementsByClassName("id_activity").item(id).id;
				activity_title = document.getElementsByClassName("activity_title").item(id).id;
				notific_data = document.getElementsByClassName("notific_var").item(id).id;
				var date_pub_end = document.getElementsByClassName("date_pub_end").item(id).id;
				var dimensiones = document.getElementsByClassName("data_dimensiones").item(id).id;
				dimensiones = dimensiones.replace(/%/g, '<font color="black">/</font>');

				code_info = document.getElementsByClassName("data_code").item(id).id;

				responsible_name = document.getElementsByClassName("responsible_name").item(id).id;
				responsible_type = document.getElementsByClassName("responsible_type").item(id).id;
				estado = document.getElementsByClassName("user_state").item(id).id;
				user_username = '<?php echo $_SESSION['user_username']; ?>';
				// console.log(code_info);

				document.getElementById("user_id").value = data_user_id;
				document.getElementById("id_status").value = id_activity;
				document.getElementById("act_title").innerHTML = activity_title;
				document.getElementById("date_pub").value = date_pub_end;
				document.getElementById("act_dimensiones").innerHTML = dimensiones;

				document.getElementById("notific").value = notific_data;

				// console.log(id);


			})



			// enviar cambios por admin
			$('#submit_status').click(function(event) {
				event.preventDefault();
				var data = $("#date_pub").val() + " 00:00:00";
				var today = new Date();
				var dateObject = new Date(Date.parse(data));
				var user_id = $("#user_id").val();
				var id_status = $("#id_status").val();


				notific = document.getElementById("notific").value;
				if (notific_data != notific) {
					document.getElementById("notific").value = notific;
				}

				$('#cover-spin').show(0);

				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						// headers: {
						//     "X-CSRFToken": getCookie("csrftoken")
						// },
						data: {
							function: "update_status",
							id: $("#id_status").val(),
							status_activity: $("#status_activity").val(),
							notific: $("#notific").val(),
							user_id: $("#user_id").val(),
							location: "report",
							code_info: code_info,
							estado: estado,
							activity_title: activity_title,

						}
					})
					.done(function(msg) {
						if (getOS() == "Android") {
							alert("Registro actualizado");
						} else {
							toastify('Registro actualizado', true, 1000, "dashboard");
						}
						// console.log(msg);
						// window.document.location=msg;

						// enviar notificacion con ajax
						if (notific != '' && notific_data != notific) {
							url = "http://infoapp2.infocentro.gob.ve/admin/index.php?view=editplanning&user_id=" + user_id + "&id=" + id_status + "&code_info=" + code_info + "&estado=" + estado + "&participantes=&start_at=&finish_at=&pag=1";
                            message = "🔥 REVISIÓN INFOAPP PARA: <b>" + code_info + "</b>\n\n<b>Región:</b> " + estado + "\n<b>Nombre:</b> " + responsible_name + "\n<b>UID:</b> " + user_id + "\n<b>Rol:</b> " + responsible_type + "\n<b>Revisado por:</b> " + user_username + "\n\n<b>Actividad PLANIFICADA:</b>\n\n -" + activity_title + "\n\n<b>Observación:</b>\n\n" + notific + "\n\nPor favor revisar las observaciones.";
							sendMessage(event, message, url);
						} else {
							location.reload();
						}


						// location.reload();

						// $('#content').reload('#content');
						// $('#update_planning').modal('hide');
						// $('#cover-spin').hide(0);

					})
					.fail(function(err) {
						if (getOS() == "Android") {
							alert("Ocurrió un error al guardar, intenta nuevamente");
						} else {
							toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
						}

						$('#cover-spin').hide(0);
					});
				// .always(function() {
				//     toastify('Finished',true,1000,"warning");
				// });
			});




			// limpiar notific por user
			$('#submit_notific').click(function(event) {
				event.preventDefault();

				$('#cover-spin').show(0);
				document.getElementById("notific_status").value = "";

				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						// headers: {
						//     "X-CSRFToken": getCookie("csrftoken")
						// },
						data: {
							function: "update_notific",
							id: $("#id_notific").val(),
							status_activity: 1,
							notific_status: $("#notific_status").val()
						}
					})
					.done(function(msg) {
						if (getOS() == "Android") {
							alert("Registro actualizado");
						} else {
							toastify('Registro actualizado', true, 1000, "dashboard");
						}
						// window.document.location=msg;
						location.reload();

						// $('#content').reload('#content');
						// $('#update_planning').modal('hide');
						// $('#cover-spin').hide(0);

					})
					.fail(function(err) {
						// console.log(err);
						if (getOS() == "Android") {
							alert("Ocurrió un error al guardar, intenta nuevamente");
						} else {
							toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
						}

						$('#cover-spin').hide(0);
					});
				// .always(function() {
				//     toastify('Finished',true,1000,"warning");
				// });





			});

















		});


	});




	$(function() {

		$(document).on('click', 'button[type="image_edit"]', function(event) {
			let id = this.id;
			let title_v = this.title;

			// $('#image_edit').modal('show');

			$.post("core/app/view/image_edit.php", {
				id: id
			}, function(data) {
				$("#image_edit_body").html(data);
			});

		});



		$(document).on('click', 'button[type="image_viewer_orig"]', function(event) {
			let id = this.id;
			let title_v = this.title;
			// MODAL SWAL
			// var body_html = document.createElement("div");
			// body_html.className = "data-image";
			// body_html.id = "data-image";

			// Swal.fire({
			// 	title: title_v,
			// 	html: body_html,
			// 	width: 800,
			// 	padding: '1em',
			// 	backdrop: `rgba(0,0,123,0.4)`
			// });
			// $('#image_view').modal('show');
			// $('#image_view').modal({ show:true });

			$.post("core/app/view/image_viewer_orig.php", {
				id: id
			}, function(data) {
				$("#modal_image").html(data);
			});

		});

		$(document).on('click', 'button[type="edit_profile"]', function(event) {
			let id = this.id;
			var profile_image = document.getElementsByClassName("profile_image").item(id).id;
			var user_name = document.getElementsByClassName("responsible_name").item(id).id;
			var user_state = document.getElementsByClassName("user_state").item(id).id;
			var responsible_dni = document.getElementsByClassName("responsible_dni").item(id).id;
			var responsible_type = document.getElementsByClassName("responsible_type").item(id).id;

			// console.log(responsible_dni);
			if (responsible_dni == '<?php echo $_SESSION["user_dni"] ?>') {
				location = "./../index.php?view=userform_update";
			} else {
				// toastify(name, true, 2000, "dashboard");
				document.getElementById("imagen_profile").src = profile_image;
				document.getElementById("user_name").innerHTML = user_name;
				document.getElementById("user_type").innerHTML = responsible_type;
				document.getElementById("user_state").innerHTML = " | " + user_state;
				$('#image_profile').modal('show');
			}

		});


		$(document).on('click', 'button[type="image_viewer"]', function(event) {
			let id = this.id;
			// let title_v = this.title;
			var titulo = document.getElementsByClassName("data_titulo").item(id).id;
			var imagen_modal = document.getElementsByClassName("data_imagen_modal").item(id).id;
			var imagen = document.getElementsByClassName("data_imagen").item(id).id;
			var code_info = document.getElementsByClassName("data_code_info").item(id).id;
			var dimensiones = document.getElementsByClassName("data_dimensiones").item(id).id;
			dimensiones = dimensiones.replace(/%/g, '<font color="black">/</font>');

			document.getElementById("title_preview").innerHTML = titulo;
			document.getElementById("imagen_modal").src = imagen;
			document.getElementById("codigo_info").innerHTML = code_info;
			document.getElementById("imag_dimensiones").innerHTML = dimensiones;

		});


		$(document).on('click', 'a[type="link_viewer"]', function(event) {
			let id = this.id;
			let title_v = this.title;



			// METODO 1
			var body_html = document.createElement("div");
			body_html.className = "data-image";
			body_html.id = "data-image";

			Swal.fire({
				title: title_v,
				html: body_html,
				width: 800,
				padding: '1em',
				backdrop: `rgba(0,0,123,0.4)`
			});

			$.post("core/app/view/productslink_viewer.php", {
				id: id
			}, function(data) {
				$("#data-image").html(data);
			});

		});


		$(document).on('click', 'a[type="link_viewer_NO"]', function(event) {
			Swal.fire({
				title: "Producto sin enlaces web",
				// html: body_html,
				width: 800,
				padding: '1em',
				backdrop: `rgba(0,0,123,0.4)`
			});
		});










	});

	function uploadXLSX() {
		$('#cover-spin').show(0);
	}
</script>

<div id="cover-spin"></div>




<style>
	.avatar {
		vertical-align: middle;
		width: 60px;
		height: 60px;
		border-radius: 50%;
		border: 3px solid #fff;
		object-fit: cover;
	}

	.form-group input[type=file] {
		opacity: 0;
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 100;
	}

	.iti {
		position: relative;
		display: block;
	}
</style>




<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<center>
		<div class="row">
			<div class="col-md-12">


				<!-- ACTUALIZAR REGISTROS POR LOTES -->
				<!-- <div class="col-md-4">
					<form action="index.php?view=import_xlsx_reports" method="POST" enctype="multipart/form-data" />
					<span class="btn btn-raised btn-round btn-default btn-file">
						<span class="fileinput-new"></span>
						<span class="fileinput-exists"></span>
						<input type="file" name="info_process" id="file-input" class="file-input__input" accept=".xlsx" />
					</span>
					<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-info btn-block"><i class="far fa-file"></i> Subir Archivo XLSX</button>

					</form>
				</div> -->

			</div>
		</div>
	</center>


<?php } ?>




<!-- Modal -->
<div class="modal" id="update_planning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<h4 class="title_preview">Cambiar estatus de actividad:</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="col-lg-12">
				<div class="form-group">
					<label for="status_activity" style="text-align:center;color:#c50082;" class=" control-label" id="act_title"> Título</label>
				</div>
			</div>

			<div class="col-lg-12">
				<h6 class="title_preview" style="text-align:center;">Dimensiones</h6>
				<div class="form-group">
					<label for="dimensiones" style="text-align:center;color:#9c9c9c;" class=" control-label" id="act_dimensiones"> Dimensiones</label>
				</div>
			</div>

			<div class="modal-body fullscreen" id="modal-body">

				<!-- FORM -->
				<form name="form" id="form" accept-charset="UTF-8" class="form-horizontal">
					<input type="hidden" id="user_id" value="">
					<input type="hidden" id="id_status" value="">
					<input type="hidden" id="date_pub" value="">

					<fieldset>

						<!-- estatus -->
						<div class="col-lg-12">
							<div class="form-group">
								<label for="status_activity" class=" control-label"><i class="fa fa-clock-o"></i> Estatus</label>
								<select name="status_activity" class="form-control" id="status_activity">
									<option value="1"> Ejecutada </option>
									<option value="0"> Planificada </option>
									<!-- <option value="2"> No ejecutada </option> -->
								</select>
							</div>
						</div>

						<br>


						<!-- contenido desarrollado -->
						<div class="col-md-12">
							<div style="display: none" class="form-group" id="contenido">
								<label for="contenido_des" class=" control-label"><i class="fa fa-flask"></i> Contenido desarrollado</label>
								<br>
								<textarea rows="4" class="form-control" name="contenido_des" placeholder="Descripción" id="contenido_des" required></textarea>
							</div>
						</div>


						<!-- modalida formacion -->
						<div class="col-lg-12">
							<div style="display: none" class="form-group" id="modalidad">
								<label for="modalidad_formacion" class=" control-label"><i class="fa fa-users"></i> Modalidad formación</label>
								<select name="modalidad_formacion" class="form-control" id="modalidad_formacion" required>
									<option value="" id="option_modality"></option>
									<option value="Presencial"> Presencial </option>
									<option value="Distancia"> Distancia </option>
									<option value="Ambas"> Ambas </option>
								</select>
							</div>
						</div>


						<!-- duracion act -->
						<div class="col-md-12">
							<div style="display: none" class="form-group" id="div_duracion_dias">
								<label for="duracion_dias" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración días</label>
								<input type="number" class="form-control" value="" name="duracion_dias" placeholder="Días" id="duracion_dias">
								<p class="help-block" style="color:gray;">Días impartiendo formación</p>
							</div>
						</div>
						<div class="col-md-12">
							<div style="display: none" class="form-group" id="div_duracion_horas">
								<label for="duracion_horas" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración horas</label>
								<input type="number" class="form-control" value="" name="duracion_horas" placeholder="Horas" id="duracion_horas">
								<p class="help-block" style="color:gray;">Horas académicas certificadas</p>
							</div>
						</div>


						<?php if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) : ?>

							<!-- notificaciones -->
							<div class="col-md-12">
								<div class="form-group">
									<label for="notific" class=" control-label"><i class="fa fa-warning"></i> Observaciones al usuario</label>
									<br>
									<textarea style="background: #ecffb1;" rows="4" class="form-control" name="notific" placeholder="Descripción" id="notific"></textarea>
								</div>
							</div>
						<?php else : ?>
							<textarea style="display:none;" rows="4" class="form-control" name="notific" placeholder="Descripción" id="notific"></textarea>
						<?php endif ?>


						<div class="col-md-12">
							<div class="form-group">
								<button id="submit_status" class="btn btn-primary btn-block"> Actualizar actividad</button>
							</div>
						</div>



					</fieldset>
				</form name="form">

			</div>

			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div> -->
		</div>
	</div>
</div>


<!-- Modal notific-->
<div class="modal" id="show_notific" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<h4 class="title_preview">Observaciones técnicas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>



			<div class="modal-body fullscreen" id="modal-body">

				<!-- FORM -->
				<form name="form" id="form" accept-charset="UTF-8" class="form-horizontal">
					<input type="hidden" id="id_notific" value="">

					<fieldset>

						<!-- notificaciones -->
						<div class="col-md-12">
							<div class="form-group" id="contenido">
								<label for="notific_status" class=" control-label">
									<i>
										<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
											<path fill="currentColor" d="M13 14h-2V9h2m0 9h-2v-2h2M1 21h22L12 2z" />
										</svg>
									</i> Observaciones al usuario</label>
								<br>
								<textarea rows="10" class="form-control" name="notific_status" placeholder="..." id="notific_status"></textarea>
							</div>
						</div>

						<div class="col-md-12" id="save_obs">
							<div class="form-group">
								<button id="submit_notific" class="btn btn-primary btn-block"> Marcar como listo</button>
							</div>
						</div>



					</fieldset>
				</form name="form">

			</div>

			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div> -->
		</div>
	</div>
</div>





<!-- MODAL IMAGE PREVIEW -->

<!-- Modal -->
<div class="modal" id="image_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="title_preview" id="codigo_info">codigo_info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="col-lg-12">
				<h6 class="title_preview" style="text-align:center;">Dimensiones</h6>
				<div class="form-group">
					<label for="dimensiones" style="text-align:center; font-size:12px; color:#9c9c9c;" class=" control-label" id="imag_dimensiones"> Dimensiones text</label>
				</div>
			</div>

			<div class="modal-body fullscreen" id="modal-body">
				<img src='' id='imagen_modal' style="margin:1px auto; display:block; width: 100%; height:auto;" alt="Imagen" />
				<br>
				<div class="mui--text-center">
					<h5 class="title_preview" id="title_preview">Descripción</h5>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>





<!-- Modal profile -->
<div class="modal" id="image_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h5 class="title_preview" id="codigo_info">codigo_info</h5> -->
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="col-lg-12">
				<div class="mui--text-center">
					<label style="text-align:center; font-size:16px; color:#c50082;margin-top:10px;margin-bottom:0px" class=" control-label" id="user_name"> user_name</label>
				</div>
				<div class="mui--text-center">
					<label style="text-align:center; font-size:14px; color:#992fcd;" class=" control-label" id="user_type"> user_type</label>
					<label style="text-align:center; font-size:14px; color:#992fcd;" class=" control-label" id="user_state"> user_state</label>
				</div>
			</div>

			<div class="modal-body fullscreen" id="modal-body">
				<img src='' id='imagen_profile' style="margin:1px auto; display:block; width: 100%; height:auto;" alt="Imagen" />
				<!-- <br>
				<div class="mui--text-center">
					<h5 class="title_preview" id="title_preview">Descripción</h5>
				</div> -->
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>





<!-- modal images -->
<div class="modal fade " id="image_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<!-- <div class="modal fade" id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body" id="modal_image">

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
	</div>
</div>
<!-- fin modal images -->





<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar reportes</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="report">

								<div class="row">

									<div class="col">
										<div class="form-group col-mg-4">
											<div class="mui-textfield mui-textfield--float-label">

												<input type="text" id="q" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																								echo $_GET["q"];
																							} ?>" />
												<label><i class="fa fa-search"></i> Palabra clave</label>
												<!-- <div class="input-group">
													<input type="text" Class="form-control" id="q" name="q" value="<!?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>"/>
													<button onclick="return limpiar('q');" class="btn btn-success"><span class="fa fa-eye-slash icon"></span></button>
												</div> -->

											</div>
										</div>
									</div>
									<div class="col">
										<div class="form-group col-mg-4">
											<div class="mui-textfield mui-textfield--float-label">
												<input type="text" name="info_id" value="<?php if (isset($_GET["info_id"]) && $_GET["info_id"] != "") {
																								echo $_GET["info_id"];
																							} ?>">
												<label><i class="fa fa-search"></i> Código info</label>
											</div>
										</div>
									</div>

									<div class="col">
										<div class="form-group col-mg-4">
											<div class="mui-textfield mui-textfield--float-label">
												<input type="text" name="uid" value="<?php if (isset($_GET["uid"]) && $_GET["uid"] != "") {
																							echo $_GET["uid"];
																						} ?>">
												<label><i class="fa fa-search"></i> UID</label>
											</div>
										</div>
									</div>



									<div class="col">
										<div class="form-group col-mg-4">
											<div class="mui-textfield mui-textfield--float-label">
												<input type="text" name="id_act" value="<?php if (isset($_GET["id_act"]) && $_GET["id_act"] != "") {
																							echo $_GET["id_act"];
																						} ?>">
												<label><i class="fa fa-search"></i> ID-Actividad</label>
											</div>
										</div>
									</div>


								</div>

								<div class="row">

									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
											<select name="estado" class="form-control">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p) : ?>
													<option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<span class="input-group-addon"><i class="fa fa-cogs"></i> Linea de acción</span>
											<select name="linea_accion" class="form-control" id="linea_accion">
												<option value="">-- LINEA DE ACCIÓN --</option>
												<?php foreach ($action_line as $p) : ?>
													<option value="<?php echo $p->line_name; ?>"> <?php echo $p->line_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<!-- <div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-users"></i> Participantes</span>
											<select name="participantes" class="form-control">
												<option value="">PARTICIPANTES</option>
												<option value="1"><!?php echo "Con participantes" ?></option>
												<option value="0"><!?php echo "Sin participantes" ?></option>
											</select>
										</div>
									</div> -->

								</div>



								<div class="form-group ">
									<div class="row">

										<div class="col">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="material-icons">date_range</i> </span> Desde
											</div>
											<input type="date" name="start_at" value="<?php if (isset($_GET["start_at"]) && $_GET["start_at"] != "") {
																							echo $_GET["start_at"];
																						} ?>" class="form-control">
										</div>


										<div class="col">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="material-icons">date_range</i> </span> Hasta
											</div>
											<input type="date" name="finish_at" value="<?php if (isset($_GET["finish_at"]) && $_GET["finish_at"] != "") {
																							echo $_GET["finish_at"];
																						} ?>" class="form-control">
										</div>

									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary float-right">Buscar</button>
								</div>

							</form>



						</div>
					</div>


				</div>
			</div>
		</div>

	</div>
</div>












<?php
$participants_q = isset($_GET["participantes"]) ? $_GET["participantes"] : "";
$start_at_q = isset($_GET["start_at"]) ? $_GET["start_at"] : "";
$finish_at_q = isset($_GET["finish_at"]) ? $_GET["finish_at"] : "";
$linea_accion_q = isset($_GET["linea_accion"]) ? $_GET["linea_accion"] : "";
$q = isset($_GET["q"]) ? $_GET["q"] : "";
$uid_q = isset($_GET["uid"]) ? $_GET["uid"] : "";
$estado_q = isset($_GET["estado"]) ? $_GET["estado"] : "";
$pag = isset($_GET["pag"]) ? $_GET["pag"] : "";
$code_info = isset($_GET["info_id"]) ? $_GET["info_id"] : "";
$id_act = isset($_GET["id_act"]) ? $_GET["id_act"] : "";
$info_id = "";
$TotalReg = 0;

if ($code_info != "") {
	$code_info = trim(strtoupper($code_info));
	$conn = DatabasePg::connectPg();
	$row = $conn->prepare("SELECT * FROM infocentros WHERE upper(cod)='$code_info'");
	$row->execute();
	$data = $row->fetchAll(PDO::FETCH_ASSOC)[0];
	$info_id = isset($data["id"]) ? $data["id"] : "0";
}



$CantidadMostrar = 50;
$url_pag_atras = "";
$url_pag_adelante = "";
$TotalRegistro = 0;

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag']) || $_GET['pag'] == "") ? 1 : $_GET['pag'];

$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

$date_ini = date_create($start_at_q);
$date_end = date_create($finish_at_q);
$start_at = $date_ini->format('Y-m-d');
$finish_at = $date_end->format('Y-m-d');

// echo "dmy".date("d-m-Y", strtotime("10/07/2023"))->format('d-m-Y');
// echo "ymd".date("Y-m-d", strtotime("2023/07/10"))->format('Y-m-d');

// $sql = "SELECT * FROM reports WHERE";

$sql_dw = "SELECT ";
$fields = "
reports.id, 
reports.is_active, 
reports.status_activity, 
reports.user_id, 
reports.code_info, 
reports.line_action, 
reports.report_type, 
reports.person_fe, 
reports.person_ma, 
reports.specific_action, 
reports.training_type, 
reports.tipo_taller, 
reports.training_level, 
reports.activity_title, 
reports.responsible_name, 
reports.responsible_phone, 
reports.responsible_type, 
reports.responsible_dni, 
reports.responsible_email, 
reports.personal_type, 
reports.training_modality, 
reports.date_ini, 
reports.date_pub, 
reports.duration_days, 
reports.duration_hour, 
reports.developed_content, 
reports.organized_by_info, 
reports.institutions, 
reports.address, 
reports.estate, 
reports.city, 
reports.municipality, 
reports.parish, 
infocentros.tipo_zona, 
infocentros.espacio_inst, 
reports.observations, 
reports.notific, 
reports.name_os, 
reports.image, 
reports.total_products, 
reports.institucion_formacion, 
reports.isnt_type, 
reports.circuito_comunal, 
reports.profile_image, 
reports.datetime";
$sql = "SELECT " . $fields;
$sql .= " from reports 
LEFT JOIN infocentros ON reports.code_info = infocentros.cod 
where";

$sql_dw .= $fields;
$sql_dw .= " from reports 
INNER JOIN participants_list ON participants_list.id_activity = reports.id 
LEFT JOIN infocentros ON reports.code_info = infocentros.cod 
where";


$users = array();
if ((isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"]) || isset($_GET["id_act"])) &&  ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $_GET["info_id"] != "" || $_GET["id_act"] != "")) {


	if ($_GET["q"] != "") {
		$sql .= " (reports.report_type like '$_GET[q]%' or reports.activity_title like '%$_GET[q]%' or reports.line_action like '$_GET[q]%' or reports.estate like '$_GET[q]%' or reports.code_info='$_GET[q]' or reports.responsible_dni='$_GET[q]') ";
		$sql_dw .= " (reports.report_type like '$_GET[q]%' or reports.activity_title like '%$_GET[q]%' or reports.line_action like '$_GET[q]%' or reports.estate like '$_GET[q]%' or reports.code_info='$_GET[q]' or reports.responsible_dni='$_GET[q]') ";
	}

	if ($_GET["uid"] != "") {
		if ($_GET["q"] != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.user_id='" . $_GET["uid"] . "'";
		$sql_dw .= " reports.user_id='" . $_GET["uid"] . "'";
	}

	if ($code_info != "") {
		if ($_GET["q"] != "" || $_GET["uid"] != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.info_id='" . $info_id . "'";
		$sql_dw .= " reports.info_id='" . $info_id . "'";
	}

	if ($linea_accion_q != "") {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $info_id != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}

		if ($_GET["linea_accion"] == "Participación digital" || $_GET["linea_accion"] == "Comunidades de participación digital") {
			$sql .= " (reports.line_action='Medios digitales' or reports.line_action='Participación digital' or reports.line_action='Tejiendo redes' or reports.line_action='Infocentro adentro' or reports.line_action='Sistematización de Experiencias' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Medios digitales' or reports.line_action='Participación digital' or reports.line_action='Tejiendo redes' or reports.line_action='Infocentro adentro' or reports.line_action='Sistematización de Experiencias' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else if ($_GET["linea_accion"] == "Comunidades de aprendizaje") {
			$sql .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else if ($_GET["linea_accion"] == "Medios digitales") {
			$sql .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else if ($_GET["linea_accion"] == "Acceso abierto") {
			$sql .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else {
			$sql .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}
	}


	// solo admin visualiza la data nacional
	if ($_GET["estado"] != "" && ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7)) {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $code_info != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.estate='" . $_GET["estado"] . "'";
		$sql_dw .= " reports.estate='" . $_GET["estado"] . "'";
	} else if ($_SESSION["user_rol"] == 'Analista') {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $code_info != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.user_id='" . $_SESSION["user_id"] . "'";
		$sql_dw .= " reports.user_id='" . $_SESSION["user_id"] . "'";
	} else if ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $code_info != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
		$sql_dw .= " reports.estate='" . $_SESSION["user_region"] . "'";
	}





	if ($_GET["id_act"] != "") {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $code_info != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.id='" . $_GET["id_act"] . "'";
		$sql_dw .= " reports.id='" . $_GET["id_act"] . "'";
	}


	if ($_GET["start_at"] != "" and $_GET["finish_at"] != "") {

		if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $code_info != "" || $_GET["id_act"] != "") {
			$sql .= " and ";
			$sql_dw .= " and ";
		}
		// $sql .= " date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')";
		$sql .= " reports.date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
		$sql_dw .= " reports.date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
	}

	if ($_GET["start_at"] != "" && $_GET["finish_at"] == "") {

		if (($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $code_info != "" || $_GET["id_act"] != "")) {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.date_ini >= '" . $start_at . "'";
		$sql_dw .= " reports.date_ini >= '" . $start_at . "'";
	}


	// echo $sql;
	// echo $sql_dw;


	$conn = DatabasePg::connectPg();

	$sql .= " AND";
	$sql .= " reports.is_active='1' AND reports.status_activity='1' AND reports.estate!=''";
	$sql .= " AND reports.date_ini between '2024-01-01' and '2025-12-31'";
	$sql .= " group by " . $fields;
	$sql .= " order by reports.date_ini desc";
	$sql_dw .= " AND reports.is_active='1' AND reports.status_activity='1' AND reports.estate!='' AND reports.date_ini between '2024-01-01' and '2025-12-31' group by " . $fields . " order by reports.date_ini desc";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$TotalReg = $stmt->rowCount();

	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);


	// Busca el total de registros segun parametros de consulta
	// $sql .= " AND reports.is_active=1 AND reports.status_activity=1 and reports.estate!=''";
	// $sql_dw .= " AND reports.is_active=1 AND reports.status_activity=1 GROUP BY reports.datetime order by reports.datetime desc";
	// echo $sql_dw;


	// $stmt = $conn->prepare("SELECT * from reports WHERE (date_ini between '2024-05-01' and '2024-05-30') LIMIT 10");
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$users = $data;
	// print_r($data);


	// $users = ReportActivityData::getBySQL($sql . " order by datetime desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar);

	// Asigna url de paginacion
	$url_pag = "<a href=\"?view=report&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&id_act=" . $id_act . "&pag=";
	$url_edit = "linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&id_act=" . $id_act . "&pag=" . $compag;
	$_SESSION["location"] = "view=report&" . $url_edit;


	$param_csv = $sql_dw;
	$param_xlsx = $sql_dw;
	$param_sql = "true";
} else {
	// $users = InfoData::getAll();

	// $total = ReportActivityData::getAll();
	// if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ 
	// 	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1"; 
	// } else if ($_SESSION["user_type"] == 8){ 
	// 	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1 and estate='".$user_region."'"; 
	// }else {
	// 	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1 and user_id='".$user_id."' "; 
	// }+


	if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {

		$sql = "SELECT * FROM reports";
		$sql_dw = "SELECT reports.id, 
		reports.is_active, 
		reports.status_activity, 
		reports.user_id, 
		reports.code_info, 
		reports.line_action, 
		reports.report_type, 
		reports.person_fe, 
		reports.person_ma, 
		reports.specific_action, 
		reports.training_type, 
		reports.tipo_taller, 
		reports.training_level, 
		reports.activity_title, 
		reports.responsible_name, 
		reports.responsible_phone, 
		reports.responsible_type, 
		reports.responsible_dni, 
		reports.responsible_email, 
		reports.personal_type, 
		reports.training_modality, 
		reports.date_pub, 
		reports.date_ini, 
		reports.duration_days, 
		reports.duration_hour, 
		reports.developed_content, 
		reports.organized_by_info, 
		reports.institutions, 
		reports.address, 
		reports.estate, 
		reports.city, 
		reports.municipality, 
		reports.parish, 
		reports.observations, 
		reports.notific, 
		reports.name_os, 
		reports.image, 
		reports.total_products, 
		reports.institucion_formacion, 
		reports.isnt_type, 
		reports.circuito_comunal, 
		reports.datetime 
		from reports";
		$sql .= " WHERE";
		$sql .= " reports.is_active='1' AND reports.status_activity='1' AND reports.estate!=''";
		$sql .= " AND reports.date_ini between '2024-06-01' and '2025-12-31'";
		$sql .= " order by reports.datetime desc";
		$sql_dw .= " WHERE reports.is_active='1' AND reports.status_activity='1' AND reports.estate!='' AND reports.date_ini between '2024-06-01' and '2025-12-31' order by reports.datetime desc";
	} elseif ($_SESSION["user_rol"] == 'Analista') {
		$sql = "SELECT * FROM reports";
		$sql_dw = "SELECT reports.id, 
		reports.is_active, 
		reports.status_activity, 
		reports.user_id, 
		reports.code_info, 
		reports.line_action, 
		reports.report_type, 
		reports.tipo_taller, 
		reports.activity_title, 
		reports.responsible_name, 
		reports.responsible_phone, 
		reports.responsible_type, 
		reports.responsible_dni, 
		reports.responsible_email, 
		reports.personal_type, 
		reports.training_modality, 
		reports.date_pub, 
		reports.duration_days, 
		reports.duration_hour, 
		reports.developed_content, 
		reports.organized_by_info, 
		reports.institutions, 
		reports.address, 
		reports.estate, 
		reports.city, 
		reports.municipality, 
		reports.parish, 
		reports.observations, 
		reports.notific, 
		reports.name_os, 
		reports.image, 
		reports.total_products,
		reports.institucion_formacion, 
		reports.isnt_type, 
		reports.circuito_comunal,  
		reports.datetime 
		from reports";
		$sql .= " WHERE";
		$sql .= " reports.user_id='" . $_SESSION["user_id"] . "' AND reports.is_active='1' AND reports.status_activity='1' AND reports.estate!=''";
		$sql .= " AND reports.date_ini between '2024-06-01' and '2025-12-31'";
		$sql .= " order by reports.datetime desc";
		$sql_dw .= " WHERE reports.user_id='" . $_SESSION["user_id"] . "' AND reports.is_active='1' AND reports.status_activity='1' AND reports.estate!='' AND reports.date_ini between '2024-06-01' and '2025-12-31' order by reports.datetime desc";
	} elseif ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8) {

		$sql = "SELECT * FROM reports";
		$sql_dw = "SELECT reports.id, 
		reports.is_active, 
		reports.status_activity, 
		reports.user_id, 
		reports.code_info, 
		reports.line_action, 
		reports.report_type, 
		reports.tipo_taller, 
		reports.activity_title, 
		reports.responsible_name, 
		reports.responsible_phone, 
		reports.responsible_type, 
		reports.responsible_dni, 
		reports.responsible_email, 
		reports.personal_type, 
		reports.training_modality, 
		reports.date_pub, 
		reports.duration_days, 
		reports.duration_hour, 
		reports.developed_content, 
		reports.organized_by_info, 
		reports.institutions, 
		reports.address, 
		reports.estate, 
		reports.city, 
		reports.municipality, 
		reports.parish, 
		reports.observations, 
		reports.notific, 
		reports.name_os, 
		reports.image, 
		reports.total_products, 
		reports.institucion_formacion, 
		reports.isnt_type, 
		reports.circuito_comunal, 
		reports.datetime 
		from reports";
		$sql .= " WHERE";
		$sql .= " reports.is_active='1' AND reports.status_activity='1' AND reports.estate!=''";
		$sql .= " AND reports.date_ini between '2024-06-01' and '2025-12-31'";
		$sql .= " order by reports.datetime desc";
		$sql_dw .= " WHERE reports.estate='" . $_SESSION["user_region"] . "' AND reports.is_active='1' AND reports.status_activity='1' AND reports.estate!='' AND reports.date_ini between '2024-06-01' and '2025-12-31' order by reports.datetime desc";
	} else {
		$sql = "SELECT * FROM reports";
		$sql_dw = "SELECT reports.id, 
		reports.is_active, 
		reports.status_activity, 
		reports.user_id, 
		reports.code_info, 
		reports.line_action, 
		reports.report_type, 
		reports.tipo_taller, 
		reports.activity_title, 
		reports.responsible_name, 
		reports.responsible_phone, 
		reports.responsible_type, 
		reports.responsible_dni, 
		reports.responsible_email, 
		reports.personal_type, 
		reports.training_modality, 
		reports.date_pub, 
		reports.duration_days, 
		reports.duration_hour, 
		reports.developed_content, 
		reports.organized_by_info, 
		reports.institutions, 
		reports.address, 
		reports.estate, 
		reports.city, 
		reports.municipality, 
		reports.parish, 
		reports.observations, 
		reports.notific, 
		reports.name_os, 
		reports.image, 
		reports.total_products, 
		reports.institucion_formacion, 
		reports.isnt_type, 
		reports.circuito_comunal, 
		reports.datetime 
		from reports";
		$sql .= " WHERE";
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "' AND reports.is_active='1' AND reports.status_activity='1' AND reports.estate!=''";
		$sql .= " AND reports.date_ini between '2024-06-01' and '2025-12-31'";
		$sql .= " order by reports.datetime desc";
		$sql_dw .= " WHERE reports.estate='" . $_SESSION["user_region"] . "' AND reports.is_active='1' AND reports.status_activity='1' AND reports.estate!='' AND reports.date_ini between '2024-06-01' and '2025-12-31' order by reports.datetime desc";
	}

	// solo admin visualiza la data nacional



	// echo $sql;

	$base = new DatabasePg();
	$conn = $base->connectPg();


	// if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {
	// total aproximado con pg_class all
	$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'reports'");
	$row_table->execute();
	$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
	$TotalReg = $total_data[0]["reltuples"];
	// $TotalReg = 1000;
	// } else {
	// 	// por regiones
	// 	$total = ReportActivityData::getBySQL($sql);
	// 	$TotalReg = $total[1];
	// }

	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$users = $data;
	// print_r($data);


	$url_pag = "<a href=\"?view=report&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&id_act=" . $id_act . "&pag=";
	$url_edit = "linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&id_act=" . $id_act . "&pag=" . $compag;
	$_SESSION["location"] = "view=report&" . $url_edit;

	$param_csv = $sql_dw;
	$param_xlsx = $sql_dw;
	$param_sql = "true";
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
if ($TotalReg > 0) {
	$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
}
$DB_name = "reports";
// echo $param_csv;

?>




<?php if (count($users) > 0) { ?>
	<!-- si hay usuarios -->

	<div class="col-md-12">
		<a href="./index.php?view=newplanning" class="btn btn-primary"><i class="material-icons">update</i> Programar actividad</a>
		<a target="_blank" href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
		<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<!-- <a href="./pdf/jspdf2.php?param_pdf=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> PDF</a> -->
		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>
	</div>


	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">


					<?php if ($_SESSION["user_type"] == 7) { ?>

						<!-- EDICION POR LOTES -->
						<!-- <form class="form-horizontal" role="form" method="post" action="./?action=ajax&function=active_report" enctype="multipart/form-data">
							<input type="hidden" name="data_id" id="data_id" value="">
							<input type="hidden" name="pagination" id="pagination" value="<!?php echo $location ?>">

							<div class="row">

								<div class="col-lg-4">
									<div class="form-group">
										<span class="input-group-addon"><i class="fa fa-cog"></i> Avisos de actividades sin participantes</span>
										<select name="participantes" class="form-control" required>
											<option value="">-OPCIONES-</option>
											<option value="0"><?php echo "Enviar notificación al usuario" ?></option>
											<option value="1"><?php echo "Notificar al usuario y enviarlas a planificadas" ?></option>
											<option value="2"><?php echo "Ocultar actividades sin participantes" ?></option>
											<option value="3"><?php echo "Visualizar actividades sin participantes" ?></option>
											<option value="4"><?php echo "Limpiar todas las notificaciones" ?></option>
										</select>
									</div>
								</div>

								<div class="col-lg-3">
									<button class="btn btn-warning btn-block"><i class="far fa-save"></i> Modificar todo</button>
								</div>

							</div>

						</form> -->
						<!-- END EDICION POR LOTES -->


					<?php } ?>

					<!-- AVISOS -->
					<!-- <div class="card-body">
						<h6 class="card-category text-danger text-center">
							<i class="material-icons">support_agent</i> ¡Toda actividad sin participante será eliminada en un plazo de tiempo!
						</h6>
						<h6 class="card-category text-info text-center">
							AVISO: A partir del 1 de agosto no se crearan los reportes de actividades desde este módulo de Reportes, la nueva forma será primero planificar la actividad en la sección de planificación y se cambia el estatus a ejecutada, luego se cargan participantes, productos e imágenes.
						</h6>
					</div> -->
					<!-- <p class='alert alert-warning' style='padding:10px 10px;'>¡Toda actividad sin participante será eliminada en un plazo de tiempo! </p> -->


					<table class="table table-hover">

						<!-- INONOS -->
						<thead>
							<th class="text_label text-center" style="width: 100px;"> <i class="fa fa-image icon_table"></i></th>
							<th class="text_label text-center"> <i class="fa fa-calendar icon_table"></i></th>
							<th class="text_label text-center"> <i class="fa fa-home icon_table"></i></th>
							<th class="text_label text-center" style="width: 400px;"> <i class="fa fa-cogs icon_table"></i></th>
							<th class="text_label text-center" style="width: 150px;"> <i class="fa fa-newspaper-o icon_table"></i></th>
							<th class="text_label text-center"> <i class="fa fa-user-plus icon_table"></i></th>
							<th class="text_label text-center"> <i class="fa fa-flask icon_table"></i></th>
							<th class="text_label text-center"> <i class="fa fa-image icon_table"></i></th>
							<th class="text_label text-center"> <i class="fa fa-cog icon_table"></i></th>
						</thead>



						<!-- TITULOS -->
						<thead>
							<th class="text-center"> <label> Fecha Ejec </label></th>
							<th class="text-center priority_5x"> <label> Publicado </label></th>
							<th class="text-center"> <label>Infocentro</label></th>
							<th class="text-center priority_5x"> <label>Línea de acción</label></th>
							<th class="text-center"> <label>Título</label></th>
							<th class="text-center"> <label>Participantes</label></th>
							<th class="text-center"> <label>Productos</label></th>
							<th class="text-center"><label>Imág</label></th>
							<th class="text-center"><label>Acciones</label></th>
						</thead>


						<?php
						$total_fem = 0;
						$total_mas = 0;
						$ID = 0;

						$imagen_p = "";
						$titulo_p = "";
						$code_info_p = "";

						foreach ($users as $user) {
						?>
							<tr>
								<td>
									<!-- CARGA LAS IMAGENES -->
									<?php
									$img = explode(", ", $user["image"])[0];
									$img = str_replace("origin", "preview", $img);
									if (!file_exists("uploads/images/reports/" . $img)) {
										$img = str_replace("jpg", "webp", $img);
										$img = str_replace("jpeg", "webp", $img);
										$img = str_replace("JPG", "webp", $img);
										$img = str_replace("JPEG", "webp", $img);
										if (!file_exists("uploads/images/reports/" . $img)) {
											// se coloca la original
											$img = str_replace("preview", "origin", $img);
											$img = str_replace("webp", "jpg", $img);
										}
									} else {
										// echo "------------ La imagen no es .webp -------------------";
									}
									?>

									<?php
									if ($img != "Sin registro fotográfico" && $img != "") {
										$img = $img;
									}
									if ($img == "Sin registro fotográfico") {
										$img = "default.jpg";
									}
									if ($img != "" && !file_exists("uploads/images/reports/" . $img)) {
										$img = "default.jpg";
									}

									if ($img == "") {
										$img = "default.jpg";
									}


									// imagen de perfil
									if (!file_exists("./../uploads/profile/" . $user["profile_image"]) || $user["profile_image"] == "") {
										$profile_image = "./../uploads/profile/profile.png";
									} else {
										$profile_image = "./../uploads/profile/" . $user["profile_image"];
									}


									$imagen_p = $img;
									$titulo_p = $user["activity_title"];
									$code_info_p = $user["code_info"] . " | " . $user["line_action"];

									$planning_line_action  = $user["line_action"];
									$type = ($user["report_type"] != '') ? $user["report_type"] : '<font color="red">SELECCIONE</font>';
									$specific = ($user["specific_action"] != '') ? $user["specific_action"] : '<font color="red">SELECCIONE</font>';
									$training = ($user["training_type"] != '') ? $user["training_type"] : '<font color="red">Tipo de curso</font>';
									$taller = ($user["tipo_taller"] != '') ? $user["tipo_taller"] : '<font color="red">Tipo de taller</font>';

									if ($user["specific_action"] == "Formación en habilidades digitales") {
										$data_activity = $planning_line_action . " % " . $type . " % " . $specific . " % " . $training . " % " . $taller;
									} else {
										$data_activity = $planning_line_action . " % " . $type . " % " . $specific;
									}
									// sacamos la fecha de inicio
									// $date_pub_end = explode("/", $user["date_pub"]);
									// if (count($date_pub_end) > 1) {
									// 	$date_pub = $date_pub_end[0];
									// } else {
									// 	$date_pub = $user["date_pub"];
									// }
									$date_pub = $user["date_ini"];

									?>

									<div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
										<button type="image_viewer" id="<?php echo $ID; ?>" class="btn_preview" data-toggle="modal" data-target="#image_preview">
											<img src="uploads/images/reports/<?php echo $img; ?>" style="min-width: 80px; min-height: 50px;" class="img-fluid mb-2" alt="Imagen" />
										</button>
									</div>
									<div class="mui--text-center">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 -10 512 512">
											<rect width="448" height="512" fill="none" />
											<path fill="#969696" d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24v40H64C28.7 64 0 92.7 0 128v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64h-40V24c0-13.3-10.7-24-24-24s-24 10.7-24 24v40H152zM48 192h352v256c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16z" />
										</svg>
										<span style="margin-top:-3px;font-size:12px;"><?php echo date("d/m/Y", strtotime($date_pub)); ?></span>

									</div>
								</td>


								<td>
									<div class="row" style="flex-wrap: inherit;">

										<ul class="list-group">
											<li class="list-group-item d-flex" style="padding: 1px;">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 600 512">
													<rect width="448" height="512" fill="none" />
													<path fill="#969696" d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24v40H64C28.7 64 0 92.7 0 128v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64h-40V24c0-13.3-10.7-24-24-24s-24 10.7-24 24v40H152zM48 192h352v256c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16z" />
												</svg>
												<span style="margin-top:-3px;font-size:12px;"><?php echo date("d/m/Y H:i:s", strtotime($user["datetime"])); ?></span>
											</li>

											<li class="list-group-item d-flex" style="padding: 1px;">
												<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 4 30 24">
													<rect width="24" height="24" fill="none" />
													<g fill="none">
														<path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
														<path fill="#969696" d="M17 4a2 2 0 0 1 1.995 1.85L19 6v2h1a2 2 0 0 1 1.995 1.85L22 10v9a2 2 0 0 1-1.85 1.995L20 21h-4a2 2 0 0 1-1.647-.866L14.268 20H4a2 2 0 0 1-1.995-1.85L2 18V6a2 2 0 0 1 1.85-1.995L4 4zm3 6h-4v9h4zm-3-4H4v12h10v-8a2 2 0 0 1 2-2h1z" />
													</g>
												</svg>
												<label class="button" style="font-size:12px;"><?php echo $user["name_os"]; ?></label>
											</li>

										</ul>

									</div>


								</td>

								<!-- <td><!?php echo date("d/m/Y", strtotime($date_pub)); ?></td> -->
								<td>

									<!-- profile -->
									<div class="container">
										<div class="row" style="flex-wrap: inherit;">
											<div class="col-sm" style="max-width:100px;">

												<button type="edit_profile" class="btn_preview" id="<?php echo $ID; ?>" title="<?php echo $user["responsible_name"]; ?>" data-toggle="tooltip">
													<img src="<?php echo $profile_image; ?>" class="avatar"></img>
												</button>
												<span style="color:#c50082;font-size:11px;"><?php echo "UID: " . $user["user_id"]; ?></span>
											</div>

											<ul class="list-group">
												<label style="font-size:11px;"><?php echo $user["responsible_name"]; ?></label>
												<span style="margin-top:-10px;font-size:11px;"><?php echo $user["code_info"]; ?></span>
											</ul>

										</div>
										<ul class="list-group">
											<span style="margin-top:-10px;color:darkorchid;font-size:11px;"><?php echo $user["responsible_type"]; ?></span>
										</ul>

									</div>





								</td>
								<!-- <td><!?php echo $user["estate"]; ?></td> -->

								<?php $line_a = ""; ?>
								<?php if ($user["line_action"] == "Infocentro adentro" || $user["line_action"] == "Comunidades de participación digital" || $user["line_action"] == "Participación digital") {
									echo '<td class="priority_5x" style="color:#f75e05;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16"><rect width="16" height="16" fill="none"/><path fill="#f75e05" d="M5.5 3.5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0m1 3.5A1.5 1.5 0 0 0 5 8.5V11a3 3 0 1 0 6 0V8.5A1.5 1.5 0 0 0 9.5 7zm-2.444.97A2.5 2.5 0 0 0 4 8.5V11a4 4 0 0 0 1.213 2.87l-.1.028a3 3 0 0 1-3.673-2.121l-.389-1.45A1.5 1.5 0 0 1 2.112 8.49zm6.73 5.9A4 4 0 0 0 12 11V8.5q-.001-.274-.056-.53l1.943.52a1.5 1.5 0 0 1 1.061 1.838l-.388 1.449a3 3 0 0 1-3.773 2.093M1 5a2 2 0 1 1 4 0a2 2 0 0 1-4 0m10 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0"/></svg> ' . '<label style="font-size:11px;color:#f75e05;">' . charlimit_title($specific, 140) . '</label>';
									echo $line_a;
								?>

								<?php } else if ($user["line_action"] == "Formación a la medida" || $user["line_action"] == "Comunidades de aprendizaje") {
									echo '<td class="priority_5x" style="color:#f72acb;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 2304 1536"><rect width="2304" height="1536" fill="none"/><path fill="#f72acb" d="m1774 708l18 316q4 69-82 128t-235 93.5t-323 34.5t-323-34.5t-235-93.5t-82-128l18-316l574 181q22 7 48 7t48-7zm530-324q0 23-22 31L1162 767q-4 1-10 1t-10-1L490 561q-43 34-71 111.5T385 851q63 36 63 109q0 69-58 107l58 433q2 14-8 25q-9 11-24 11H224q-15 0-24-11q-10-11-8-25l58-433q-58-38-58-107q0-73 65-111q11-207 98-330L22 415q-22-8-22-31t22-31L1142 1q4-1 10-1t10 1l1120 352q22 8 22 31"/></svg> ';

									if ($user["specific_action"] == "Formación en habilidades digitales") {
										echo  $line_a . '<label style="font-size:11px;color:#f72acb;">' . ' ' . $specific . ' ' . $training . '<br>' . ' <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 14 14"><rect width="14" height="14" fill="none"/><path fill="#f72acb" fill-rule="evenodd" d="M12.402 8.976H7.259a2.278 2.278 0 0 0-.193-4.547h-1.68A3.095 3.095 0 0 0 4.609 0h7.793a1.35 1.35 0 0 1 1.348 1.35v6.279c0 .744-.604 1.348-1.348 1.348ZM2.898 4.431a1.848 1.848 0 1 0 0-3.695a1.848 1.848 0 0 0 0 3.695m5.195 2.276c0-.568-.46-1.028-1.027-1.028H2.899a2.65 2.65 0 0 0-2.65 2.65v1.205c0 .532.432.963.964.963h.172l.282 2.61A1 1 0 0 0 2.66 14h.502a1 1 0 0 0 .99-.862l.753-5.404h2.16c.567 0 1.027-.46 1.027-1.027Z" clip-rule="evenodd"/></svg> ' . $taller . '</label>';
									} else {
										echo $line_a . '<label style="font-size:11px;color:#f72acb;">' . ' ' . $specific . '</label>';
									}

								?>
								<?php } else if ($user["line_action"] == "Tejiendo redes" || $user["line_action"] == "Medios digitales") {
									echo '<td class="priority_5x" style="color:#005af5;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><rect width="16" height="16" fill="none"/><path fill="#005af5" d="M5.5 3.5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0m1 3.5A1.5 1.5 0 0 0 5 8.5V11a3 3 0 1 0 6 0V8.5A1.5 1.5 0 0 0 9.5 7zm-2.444.97A2.5 2.5 0 0 0 4 8.5V11a4 4 0 0 0 1.213 2.87l-.1.028a3 3 0 0 1-3.673-2.121l-.389-1.45A1.5 1.5 0 0 1 2.112 8.49zm6.73 5.9A4 4 0 0 0 12 11V8.5q-.001-.274-.056-.53l1.943.52a1.5 1.5 0 0 1 1.061 1.838l-.388 1.449a3 3 0 0 1-3.773 2.093M1 5a2 2 0 1 1 4 0a2 2 0 0 1-4 0m10 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0"/></svg> ' . '<label style="font-size:11px;color:#005af5;">' . $specific . '</label>';
									echo $line_a;
								?>
								<?php } else if ($user["line_action"] == "Unidades socio-productivas" || $user["line_action"] == "Acceso abierto") {
									echo '<td class="priority_5x" style="color:#02782f;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="none" stroke="#02782f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 9l5 5v7H8v-4m0 4H3v-7l5-5m1 1V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v17h-8m0-14v.01M17 7v.01M17 11v.01M17 15v.01"/></svg> ' . '<label style="font-size:11px;color:#02782f;">' . $specific . '</label>';
									echo $line_a;
								?>
								<?php } else if ($user["line_action"] == "Sistematización de Experiencias") {
									echo '<td class="priority_5x" style="color:#bf0442;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><rect width="16" height="16" fill="none"/><path fill="#bf0442" d="M5.5 3.5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0m1 3.5A1.5 1.5 0 0 0 5 8.5V11a3 3 0 1 0 6 0V8.5A1.5 1.5 0 0 0 9.5 7zm-2.444.97A2.5 2.5 0 0 0 4 8.5V11a4 4 0 0 0 1.213 2.87l-.1.028a3 3 0 0 1-3.673-2.121l-.389-1.45A1.5 1.5 0 0 1 2.112 8.49zm6.73 5.9A4 4 0 0 0 12 11V8.5q-.001-.274-.056-.53l1.943.52a1.5 1.5 0 0 1 1.061 1.838l-.388 1.449a3 3 0 0 1-3.773 2.093M1 5a2 2 0 1 1 4 0a2 2 0 0 1-4 0m10 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0"/></svg> ' . '<label style="font-size:11px;color:#bf0442;">' . $specific . '</label>';
									echo $line_a;
								?>
								<?php } else if ($user["line_action"] == "Comunas en Red Digital") {
									echo '<td class="priority_5x" style="color:#866849FF;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16"><rect width="16" height="16" fill="none"/><path fill="#866849FF" d="M5.5 3.5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0m1 3.5A1.5 1.5 0 0 0 5 8.5V11a3 3 0 1 0 6 0V8.5A1.5 1.5 0 0 0 9.5 7zm-2.444.97A2.5 2.5 0 0 0 4 8.5V11a4 4 0 0 0 1.213 2.87l-.1.028a3 3 0 0 1-3.673-2.121l-.389-1.45A1.5 1.5 0 0 1 2.112 8.49zm6.73 5.9A4 4 0 0 0 12 11V8.5q-.001-.274-.056-.53l1.943.52a1.5 1.5 0 0 1 1.061 1.838l-.388 1.449a3 3 0 0 1-3.773 2.093M1 5a2 2 0 1 1 4 0a2 2 0 0 1-4 0m10 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0"/></svg> ' . '<label style="font-size:11px;color:#866849FF;">' . charlimit_title($user["line_action"], 100) . '</label>';
									echo  $line_a . '<label style="font-size:11px;color:#866849FF;">' . ' ' . $training . '<br>' . ' <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 14 14"><rect width="14" height="14" fill="none"/><path fill="#866849FF" fill-rule="evenodd" d="M12.402 8.976H7.259a2.278 2.278 0 0 0-.193-4.547h-1.68A3.095 3.095 0 0 0 4.609 0h7.793a1.35 1.35 0 0 1 1.348 1.35v6.279c0 .744-.604 1.348-1.348 1.348ZM2.898 4.431a1.848 1.848 0 1 0 0-3.695a1.848 1.848 0 0 0 0 3.695m5.195 2.276c0-.568-.46-1.028-1.027-1.028H2.899a2.65 2.65 0 0 0-2.65 2.65v1.205c0 .532.432.963.964.963h.172l.282 2.61A1 1 0 0 0 2.66 14h.502a1 1 0 0 0 .99-.862l.753-5.404h2.16c.567 0 1.027-.46 1.027-1.027Z" clip-rule="evenodd"/></svg> ' . $taller . '</label>';
								?>
								<?php } else {
									echo '<td class="priority_5x" style="color:#646B74FF;">';
									$line_a = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><rect width="16" height="16" fill="none"/><path fill="#969696" d="M5.5 3.5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0m1 3.5A1.5 1.5 0 0 0 5 8.5V11a3 3 0 1 0 6 0V8.5A1.5 1.5 0 0 0 9.5 7zm-2.444.97A2.5 2.5 0 0 0 4 8.5V11a4 4 0 0 0 1.213 2.87l-.1.028a3 3 0 0 1-3.673-2.121l-.389-1.45A1.5 1.5 0 0 1 2.112 8.49zm6.73 5.9A4 4 0 0 0 12 11V8.5q-.001-.274-.056-.53l1.943.52a1.5 1.5 0 0 1 1.061 1.838l-.388 1.449a3 3 0 0 1-3.773 2.093M1 5a2 2 0 1 1 4 0a2 2 0 0 1-4 0m10 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0"/></svg> ' . '<label style="font-size:11px;color:#969696;">' . charlimit_title($specific, 140) . '</label>';
									echo $line_a;
								} ?>

								</td>


								<td><label style="font-size:12px;"><?php echo charlimit_title($user["activity_title"], 60); ?></label></td>


								<?php
								// total de participantes
								$total_part = (int)$user["person_fe"] + (int)$user["person_ma"];

								?>


								<!-- participantes -->
								<?php if ($total_part > 0) { ?>
									<td>
										<a href='index.php?view=participants_list&user_id=<?php echo $user["user_id"]; ?>&line_action=<?php echo $user["line_action"]; ?>&report_type=<?php echo $user["report_type"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estate=<?php echo $user["estate"]; ?>&id_activity=<?php echo $user["id"]; ?>&date_activity=<?php echo $user["date_pub"]; ?>&activity=<?php echo $user["activity_title"]; ?>' class="btn btn-info btn-sm 
											<?php
											if ($user["user_id"] != $_SESSION["user_id"] && $user["estate"] != $_SESSION["user_region"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8)) {
												echo 'disabled';
											} else if (($_SESSION["user_rol"] == 'Políticas públicas' && $user["estate"] == $_SESSION["user_region"])) {
												echo '';
											}
											?>"> <?php echo $total_part ?>
										</a>
									</td>
								<?php } ?>

								<?php if ($total_part == 0) { ?>
									<td>
										<a href='index.php?view=participants_list&user_id=<?php echo $user["user_id"]; ?>&line_action=<?php echo $user["line_action"]; ?>&report_type=<?php echo $user["report_type"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estate=<?php echo $user["estate"]; ?>&id_activity=<?php echo $user["id"]; ?>&date_activity=<?php echo $user["date_pub"]; ?>&activity=<?php echo $user["activity_title"]; ?>' class="btn btn-danger btn-sm 
											<?php
											if ($user["user_id"] != $_SESSION["user_id"] && $user["estate"] != $_SESSION["user_region"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8)) {
												echo 'disabled';
											} else if (($_SESSION["user_rol"] == 'Políticas públicas' && $user["estate"] == $_SESSION["user_region"])) {
												echo '';
											}
											?>"> <?php echo $total_part ?>
										</a>
									</td>
								<?php } ?>

								<!-- productos -->
								<?php if ($user["total_products"] > 0) {

								?>
									<td><a href='index.php?view=products_list&user_id=<?php echo $user["user_id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estate=<?php echo $user["estate"]; ?>&id_activity=<?php echo $user["id"]; ?>&date_activity=<?php echo $user["date_pub"]; ?>&activity_title=<?php echo $user["activity_title"]; ?>' class="btn btn-info btn-sm 
									<?php
									if ($user["user_id"] != $_SESSION["user_id"] && $user["estate"] != $_SESSION["user_region"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8)) {
										echo 'disabled';
									} else if (($_SESSION["user_rol"] == 'Políticas públicas' && $user["estate"] == $_SESSION["user_region"])) {
										echo '';
									}
									?>"> <?php echo $user["total_products"] ?></a></td>
								<?php } ?>

								<?php if ($user["total_products"] <= 0) { ?>
									<td><a href='index.php?view=products_list&user_id=<?php echo $user["user_id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estate=<?php echo $user["estate"]; ?>&id_activity=<?php echo $user["id"]; ?>&date_activity=<?php echo $user["date_pub"]; ?>&activity_title=<?php echo $user["activity_title"]; ?>' class="btn btn-danger btn-sm 
									<?php
									if ($user["user_id"] != $_SESSION["user_id"] && $user["estate"] != $_SESSION["user_region"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8)) {
										echo 'disabled';
									} else if (($_SESSION["user_rol"] == 'Políticas públicas' && $user["estate"] == $_SESSION["user_region"])) {
										echo '';
									}
									?>"> <?php echo $user["total_products"] ?></a></td>
								<?php } ?>

								<!-- imagenes -->
								<td><a href='index.php?view=image_edit&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&user_id=<?php echo $user["user_id"]; ?>&estate=<?php echo $user["estate"]; ?>&title=<?php echo $user["activity_title"]; ?>' class="btn btn-default btn-sm"><i class="material-icons">image</i></a></td>

								<td>


									<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
										<div class="btn-group btn-group-xs">

											<?php if (($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5) && $_SESSION["user_id"] == $user["user_id"]) { ?>

												<a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																								echo $_GET["participantes"];
																																																																							} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																												echo $_GET["start_at"];
																																																																											} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																echo $_GET["finish_at"];
																																																																															} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																			echo $_GET["pag"];
																																																																																		} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
												<?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
												<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>
											<?php } else if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

												<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																									echo $_GET["participantes"];
																																																																								} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																													echo $_GET["start_at"];
																																																																												} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																	echo $_GET["finish_at"];
																																																																																} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																				echo $_GET["pag"];
																																																																																			} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
												<?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
												<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>
											<?php } ?>

										</div>
										<div class="btn-group btn-group-xs">
											<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
											<?php if ($user["notific"] != "") { ?>
												<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
											<?php } ?>
										</div>

										<!-- edita el monitor estadal -->
										<?php } else if ($_SESSION['user_rol'] == "Políticas públicas") {
										if ($_SESSION["user_type"] == 3 && strtoupper($_SESSION["user_region"]) == strtoupper($user["estate"])) { ?>
											<div class="btn-group btn-group-xs">
												<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																									echo $_GET["participantes"];
																																																																								} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																													echo $_GET["start_at"];
																																																																												} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																	echo $_GET["finish_at"];
																																																																																} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																				echo $_GET["pag"];
																																																																																			} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
												<?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
												<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>

											</div>
											<div class="btn-group btn-group-xs">
												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											</div>

											<!-- ver las notificaciones de terceros -->
										<?php } else if ($_SESSION["user_type"] == 3 && strtoupper($_SESSION["user_region"]) != strtoupper($user["estate"])) { ?>
											<div class="btn-group btn-group-xs">
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											</div>
										<?php } ?>


										<?php } else {
										if ($_SESSION["user_type"] == 8) {
										?>
											<?php if (strtoupper($_SESSION["user_region"]) == strtoupper($user["estate"])) { ?>

												<div class="btn-group btn-group-xs">
													<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																										echo $_GET["participantes"];
																																																																									} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																														echo $_GET["start_at"];
																																																																													} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																		echo $_GET["finish_at"];
																																																																																	} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																					echo $_GET["pag"];
																																																																																				} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
													<?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
													<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>

												</div>
												<div class="btn-group btn-group-xs">
													<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
													<?php if ($user["notific"] != "") { ?>
														<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
													<?php } ?>
												</div>

												<!-- ver las notificaciones de terceros -->
											<?php } else if (strtoupper($_SESSION["user_region"]) != strtoupper($user["estate"])) { ?>
												<div class="btn-group btn-group-xs">
													<?php if ($user["notific"] != "") { ?>
														<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
													<?php } ?>
												</div>
											<?php } ?>

											<!-- <!?php }else if ( trim(strtoupper($_SESSION["user_code_info"])) == trim(strtoupper($user->code_info) ))  { ?> -->
										<?php } else if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3) { ?>
											<?php if ($_SESSION["user_rol"] != 'Analista' && $_SESSION["user_id"] == $user["user_id"] && (strtoupper($_SESSION["user_region"]) == strtoupper($user["estate"]))) { ?>

												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																									echo $_GET["participantes"];
																																																																								} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																													echo $_GET["start_at"];
																																																																												} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																	echo $_GET["finish_at"];
																																																																																} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																				echo $_GET["pag"];
																																																																																			} ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>

												<!-- ver las notificaciones de terceros -->
											<?php } else if ($_SESSION["user_rol"] != 'Analista' && (strtoupper($_SESSION["user_region"]) != strtoupper($user["estate"]))) { ?>
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											<?php } ?>


											<!-- analista -->
											<?php if ($_SESSION["user_rol"] == 'Analista') { ?>

												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																									echo $_GET["participantes"];
																																																																								} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																													echo $_GET["start_at"];
																																																																												} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																	echo $_GET["finish_at"];
																																																																																} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																				echo $_GET["pag"];
																																																																																			} ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>

												<!-- ver las notificaciones de terceros -->
												<?php if (strtoupper($_SESSION["user_region"]) != strtoupper($user["estate"])) { ?>
													<?php if ($user["notific"] != "") { ?>
														<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
													<?php } ?>
												<?php } ?>
											<?php } ?>


										<?php } else if ($_SESSION["user_id"] == $user["user_id"]) {
										?>
											<?php if ($_SESSION["user_rol"] != 'Analista' && (strtoupper($_SESSION["user_region"]) == strtoupper($user["estate"]))) { ?>

												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																									echo $_GET["participantes"];
																																																																								} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																													echo $_GET["start_at"];
																																																																												} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																	echo $_GET["finish_at"];
																																																																																} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																				echo $_GET["pag"];
																																																																																			} ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>

												<!-- ver las notificaciones de terceros -->
											<?php } else if ($_SESSION["user_rol"] != 'Analista' && (strtoupper($_SESSION["user_region"]) != strtoupper($user["estate"]))) { ?>
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											<?php } ?>


											<!-- analista -->
											<?php if ($_SESSION["user_rol"] == 'Analista') { ?>

												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<!-- <a href="index.php?view=editactivity&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&id_act=<?php echo $id_act; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																																									echo $_GET["participantes"];
																																																																								} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																													echo $_GET["start_at"];
																																																																												} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																																	echo $_GET["finish_at"];
																																																																																} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																																				echo $_GET["pag"];
																																																																																			} ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a> -->
												<?php if ($user["notific"] != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>

												<!-- ver las notificaciones de terceros -->
												<?php if (strtoupper($_SESSION["user_region"]) != strtoupper($user["estate"])) { ?>
													<?php if ($user["notific"] != "") { ?>
														<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
													<?php } ?>
												<?php } ?>
											<?php } ?>


										<?php } ?>

									<?php } ?>



								</td>


							</tr>


							<!-- data preview -->
							<p class="profile_image" id='<?php echo $profile_image; ?>'></p>
							<p class="data_imagen_modal" id='uploads/images/reports/<?php echo $img; ?>'></p>
							<p class="data_imagen" id="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/admin/uploads/images/reports/'; ?><?php echo $imagen_p; ?>"></p>
							<p class="data_titulo" id='<?php echo $titulo_p; ?>'></p>
							<p class="data_code_info" id="<?php echo $code_info_p; ?>"></p>
							<p class="data_code" id="<?php echo $user["code_info"]; ?>"></p>
							<p class="data_dimensiones" id='<?php echo $data_activity; ?>'></p>
							<p class="id_activity" id='<?php echo $user["id"]; ?>'></p>
							<p class="notific_var" id='<?php echo $user["notific"]; ?>'></p>
							<p class="responsible_name" id='<?php echo $user["responsible_name"]; ?>'></p>
							<p class="user_id" id='<?php echo $user["user_id"]; ?>'></p>
							<p class="user_state" id='<?php echo $user["estate"]; ?>'></p>
							<p class="responsible_dni" id='<?php echo $user["responsible_dni"]; ?>'></p>
							<p class="responsible_type" id='<?php echo $user["responsible_type"]; ?>'></p>
							<p class="date_pub_end" id='<?php echo date("Y-m-d", strtotime($date_pub_end[0])); ?>'></p>
							<p class="activity_title" id='<?php echo $user["activity_title"]; ?>'></p>
							<p class="products" id='<?php echo $product; ?>'></p>

						<?php
							$ID += 1;
						}
						?>


					</table>


				<?php
			} else {
				echo "<p class='alert alert-danger'>No hay reportes</p>";
			}
				?>


				</div class="card-content table-responsive">



			</div>
		</div>
	</div>



	<?php if (count($users) > 0) { ?>
		<!-- Botones de paginacion -->
		<?php include "core/app/layouts/pagination.php"; ?>
	<?php } ?>








	<style>
		.title {
			margin-top: 0;
			margin-bottom: 5px;
			margin-left: 10px;
			margin-right: -20px;
		}

		/* .card {
	font-size: 14px;
	margin: 15px 0;
}

h5, .h5 {
    font-size: 1.0em;
    line-height: 1.0em;
    margin-bottom: 15px;
} */

		.icon_table {
			font-size: 24px;
			color: #585858;
			margin-right: 10px;
		}

		.btn_preview {
			color: #FFFFFF;
			background: #ffffff00;
			box-shadow: none;
			padding: 0px 0px;
			margin: 0px 0px;
			border: none;
			opacity: 1;
			cursor: pointer;
		}





		.fullscreen-swal {
			z-index: 9999 !important;
			width: 100vw !important;
			height: 90vh !important;
		}

		@media screen and (max-width: 1600px) and (min-width: 1400px) {

			.priority_6 {
				display: none;
			}
		}

		@media screen and (max-width: 1225px) and (min-width: 1045px) {
			.priority_5 {
				display: none;
			}

			.priority_6 {
				display: none;
			}
		}

		@media screen and (max-width: 1045px) and (min-width: 835px) {
			.priority_5 {
				display: none;
			}

			.priority_6 {
				display: none;
			}
		}

		@media screen and (max-width: 835px) and (min-width: 300px) {
			.priority_6 {
				display: none;
			}

			.priority_5 {
				display: none;
			}

			.priority_4 {
				display: none;
			}


		}

		@media screen and (max-width: 300px) {
			.priority_6 {
				display: none;
			}

			.priority_5 {
				display: none;
			}

			.priority_4 {
				display: none;
			}

			.priority_3 {
				display: none;
			}

			.priority_2 {
				display: none;
			}

		}
	</style>