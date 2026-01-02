<?php
// ini_set('memory_limit', '512M');

$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();
$location = "index.php?view=report";




// echo strtoupper("ama05");
// GIT

// $users = ReportActivityData::getAll();
// $users = ReportActivityData::getById(33836);
// $data = "";
// $count = 0;

// foreach($users as $user){
// 	// sacamos la fecha de inicio
// 	$date_pub_end = explode("/",$user->date_pub);

// 	$date_ini_x = date_create($date_pub_end[0]);
// 	$date_end_x = date_create($date_pub_end[1]);
// 	$start_at_x = $date_ini_x->format('d-m-Y');
// 	$finish_at_x = $date_end_x->format('d-m-Y');

// 	$new_date = $start_at_x."/".$finish_at_x;
// 	// echo $new_date;
// 	// $db = Database::getCon();
// 	// $statement_1 = $db->query("UPDATE reports SET date_pub = '".$new_date."' where id='".$user->id."' ");

// 	$count++;
// 	$data = $new_date;
// }
// echo "C-".$count;
// echo "A-".$data;

$user_code_info = "";
$user_id = "";

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
			title: "¿Desea eliminar?",
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
		$('#tooltip2').tooltip({
			placement: "top"
		})



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









		// <!-- MODAL SWEET ALERT -->
		$(function() {



			// al abrir el modal user notific
			$(document).on('click', 'a[type="show_notific"]', function(event) {
				let id = this.id;
				var user_type = <?php echo $_SESSION["user_type"] ?>;
				var data_user_id = document.getElementsByClassName("user_id").item(id).id;
				var user_id = <?php echo $_SESSION["user_id"] ?>;
				var data_code = document.getElementsByClassName("data_code").item(id).id;
				var user_code_info = '<?php echo trim(strtoupper($_SESSION["user_code_info"])) ?>';
				var id_activity = document.getElementsByClassName("id_activity").item(id).id;
				var notific = document.getElementsByClassName("notific_var").item(id).id;
				// console.log(user_id,parseInt(data_user_id));

				document.getElementById("notific_status").value = notific;
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
				var id_activity = document.getElementsByClassName("id_activity").item(id).id;
				var activity_title = document.getElementsByClassName("activity_title").item(id).id;
				var notific = document.getElementsByClassName("notific_var").item(id).id;
				var date_pub_end = document.getElementsByClassName("date_pub_end").item(id).id;
				var dimensiones = document.getElementsByClassName("data_dimensiones").item(id).id;
				dimensiones = dimensiones.replace(/%/g, '<font color="black">/</font>');

				// console.log(dimensiones);

				document.getElementById("id_status").value = id_activity;
				document.getElementById("act_title").innerHTML = activity_title;
				document.getElementById("date_pub").value = date_pub_end;
				document.getElementById("act_dimensiones").innerHTML = dimensiones;
				document.getElementById("notific").value = notific;

				// console.log(id);


			})



			// enviar cambios por admin
			$('#submit_status').click(function(event) {
				event.preventDefault();
				var data = $("#date_pub").val() + " 00:00:00";
				var today = new Date();
				var dateObject = new Date(Date.parse(data));

				$('#cover-spin').show(0);

				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						// headers: {
						//     "X-CSRFToken": getCookie("csrftoken")
						// },
						data: {
							function: "update_planning",
							id: $("#id_status").val(),
							status_activity: $("#status_activity").val(),
							notific: $("#notific").val()
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





<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<center>
		<div class="row">
			<div class="col-md-12">


				<!-- ACTUALIZAR REGISTROS POR LOTES -->
				<div class="col-md-4">
					<!-- <form action="core/app/view/recibe_excel.php" method="POST" enctype="multipart/form-data"/> -->
					<form action="index.php?view=import_xlsx_reports" method="POST" enctype="multipart/form-data" />
					<span class="btn btn-raised btn-round btn-default btn-file">
						<span class="fileinput-new"></span>
						<span class="fileinput-exists"></span>
						<input type="file" name="info_process" id="file-input" class="file-input__input" accept=".xlsx" />
					</span>
					<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-info btn-block"><i class="far fa-file"></i> Subir Archivo XLSX</button>

					</form>
				</div>

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
								<label for="notific_status" class=" control-label"><i class="fa fa-warning"></i> Observaciones al usuario</label>
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
$info_id = "";
$TotalReg = 0;

if ($code_info != "") {
	$base = new Database();
	$db = $base->connectPDO();

	$query = $db->query("SELECT id from infocentros where cod='$code_info'");
	$res = $query->fetchAll();
	foreach ($res as $row) {
		$info_id = isset($row["id"]) ? $row["id"] : "0";
	}
}



$CantidadMostrar = 10;
$url_pag_atras = "";
$url_pag_adelante = "";
$TotalRegistro = 0;

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

$date_ini = date_create($start_at_q);
$date_end = date_create($finish_at_q);
$start_at = $date_ini->format('d-m-Y');
$finish_at = $date_end->format('d-m-Y');

// echo "dmy".date("d-m-Y", strtotime("10/07/2023"))->format('d-m-Y');
// echo "ymd".date("Y-m-d", strtotime("2023/07/10"))->format('Y-m-d');

$sql = "SELECT * FROM reports WHERE";

$sql_dw = "SELECT reports.id, 
reports.is_active, 
reports.status_activity, 
reports.user_id, 
reports.code_info, 
reports.line_action, 
reports.report_type, 
reports.specific_action, 
reports.training_type, 
reports.training_level, 
reports.activity_title, 
SUM(participants_list.gender = 'Mujer') AS T_mujeres, 
SUM(participants_list.gender = 'Hombre') AS T_hombres, 
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
infocentros.tipo_zona, 
infocentros.espacio_inst as tipo_espacio, 
reports.observations, 
reports.notific, 
reports.name_os, 
reports.image, 
reports.datetime 
from reports 
INNER JOIN participants_list ON participants_list.id_activity = reports.id 
LEFT JOIN infocentros ON reports.code_info = infocentros.cod 
where";


$users = array();
if ((isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"])) &&  ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $_GET["info_id"] != "")) {

	// $sql = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1 AND"; 

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

	if ($info_id != "") {
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
		}
		if ($_GET["linea_accion"] == "Comunidades de aprendizaje") {
			$sql .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}
		if ($_GET["linea_accion"] == "Medios digitales") {
			$sql .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}
		if ($_GET["linea_accion"] == "Acceso abierto") {
			$sql .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
			$sql_dw .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}

		// $sql .= " reports.line_action='".$_GET["linea_accion"]."'";
		// $sql_dw .= " reports.line_action='".$_GET["linea_accion"]."'";
	}


	// solo admin visualiza la data nacional
	if ($_GET["estado"] != "" && ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6)) {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.estate='" . $_GET["estado"] . "'";
		$sql_dw .= " reports.estate='" . $_GET["estado"] . "'";

	} else if ($_GET["estado"] != "" && ($_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 6)) {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
		$sql_dw .= " reports.estate='" . $_SESSION["user_region"] . "'";
		
	} else if ($_GET["estado"] == "" && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
		if ($_GET["q"] != "" or $_GET["uid"] != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
		$sql_dw .= " reports.estate='" . $_SESSION["user_region"] . "'";
	}


	// if($_GET["start_at"]!="" and $_GET["finish_at"]!=""){
	//     if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
	//         $sql .= " and ";
	//     }
	//     $sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%Y-%m-%d' )>=STR_TO_DATE('".$start_at."', '%Y-%m-%d')"." and STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%Y-%m-%d' )<=STR_TO_DATE('".$finish_at."', '%Y-%m-%d')"." ) ";
	// }

	// if($_GET["start_at"]!="" and $_GET["finish_at"]==""){
	//     if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
	//         $sql .= ' and ';
	//     }
	//     $sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%d-%m-%y' )>= STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." ) ";
	// }


	// 
	if ($_GET["start_at"] != "" and $_GET["finish_at"] != "") {

		if (($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) || $_GET["q"] != "" || $_GET["estado"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $info_id != "") {
			$sql .= " and ";
			$sql_dw .= " and ";
		}
		$sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )>=STR_TO_DATE('" . $start_at . "', '%d-%m-%Y')" . " and STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )<=STR_TO_DATE('" . $finish_at . "', '%d-%m-%Y')" . " ) ";
		$sql_dw .= " ( STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )>=STR_TO_DATE('" . $start_at . "', '%d-%m-%Y')" . " and STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )<=STR_TO_DATE('" . $finish_at . "', '%d-%m-%Y')" . " ) ";
		// $sql .= " ( datetime>=STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." and datetime<=STR_TO_DATE('".$finish_at."', '%d-%m-%Y')"." ) ";
		// $sql .= " ( DATE_FORMAT(datetime, '%d-%m-%Y')>=STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." and DATE_FORMAT(datetime, '%d-%m-%Y')<=STR_TO_DATE('".$finish_at."', '%d-%m-%Y')"." ) ";
	}

	if ($_GET["start_at"] != "" && $_GET["finish_at"] == "") {

		if (($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) || ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $info_id != "")) {
			$sql .= ' and ';
			$sql_dw .= ' and ';
		}
		$sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )>= STR_TO_DATE('" . $start_at . "', '%d-%m-%Y')" . " ) ";
		$sql_dw .= " ( STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )>= STR_TO_DATE('" . $start_at . "', '%d-%m-%Y')" . " ) ";
		// $sql .= " ( datetime>= STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." ) ";
	}


	// echo $sql;


	// if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ 
	//     $sql = $sql;
	// } else if ($_SESSION["user_type"] == 8){ 
	//     $sql.="and estate='".$user_region."' ";
	// }else {
	//     $sql.="and user_id='".$user_id."' ";
	// }



	// Busca el total de registros segun parametros de consulta
	$sql .= " AND reports.is_active=1 AND reports.status_activity=1 and reports.estate!=''";
	$sql_dw .= " AND reports.is_active=1 AND reports.status_activity=1 GROUP BY reports.datetime order by reports.datetime desc";
	// echo $sql;


	// echo `<script> console.log(`.$sql_dw.`); </script>`;
	// echo $sql_dw;
	// echo $sql;

	$total = ReportActivityData::getBySQL($sql);
	$TotalReg = count($total);

	$users = ReportActivityData::getBySQL($sql . " order by datetime desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar);
	
	// Asigna url de paginacion
	$url_pag = "<a href=\"?view=report&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";
	$url_edit = "linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q;
	$_SESSION["location"] = "view=report&" . $url_edit;


	$param_csv = $sql_dw;
	$param_xlsx = $sql_dw;
	$param_sql = "true";

	// SELECT id, reports.is_active, reports.status_activity, reports.user_id, reports.code_info, reports.date_pub, reports.line_action, reports.report_type, reports.activity_title, reports.responsible_name, reports.responsible_phone, reports.responsible_type, reports.responsible_dni, reports.responsible_email, reports.personal_type, reports.training_modality, reports.duration_days, reports.duration_hour, developed_content, (SELECT COUNT(*) FROM participants_list WHERE participants_list.gender = 'Mujer') T_mujeres, (SELECT COUNT(*) FROM participants_list WHERE participants_list.gender = 'Hombre') T_hombres, reports.organized_by_info, reports.institutions, reports.address, reports.estate, reports.city, reports.municipality, reports.parish, reports.observations, reports.notific, reports.name_os, reports.image, reports.datetime from reports INNER JOIN participants_list on participants_list.id_activity = reports.id where AND reports.is_active=1 AND reports.status_activity=1 order by reports.datetime desc


	// SELECT reports.id, reports.is_active, reports.status_activity, reports.user_id, reports.code_info, reports.date_pub, reports.line_action, reports.report_type, reports.activity_title, reports.responsible_name, reports.responsible_phone, reports.responsible_type, reports.responsible_dni, reports.responsible_email, reports.personal_type, reports.training_modality, reports.duration_days, reports.duration_hour, reports.developed_content, (SELECT COUNT(*) FROM participants_list WHERE participants_list.gender = 'Mujer') T_mujeres, (SELECT COUNT(*) FROM participants_list WHERE participants_list.gender = 'Hombre') T_hombres, reports.organized_by_info, reports.institutions, reports.address, reports.estate, reports.city, reports.municipality, reports.parish, reports.observations, reports.notific, reports.name_os, reports.image, reports.datetime from reports INNER JOIN participants_list on participants_list.id_activity = reports.id whereSELECT * FROM reports WHERE reports.estate='Amazonas' AND is_active=1 AND status_activity=1 order by reports.datetime desc


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


	if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {

		$sql = "SELECT * FROM reports WHERE";
		$sql_dw = "SELECT reports.id, 
		reports.is_active, 
		reports.status_activity, 
		reports.user_id, 
		reports.code_info, 
		reports.line_action, 
		reports.report_type, 
		reports.activity_title, 
		SUM(participants_list.gender = 'Mujer') AS T_mujeres, 
		SUM(participants_list.gender = 'Hombre') AS T_hombres, 
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
		reports.datetime 
		from reports 
		INNER JOIN participants_list ON participants_list.id_activity = reports.id 
		where";
	} else {

		$sql = "SELECT * FROM reports WHERE reports.estate='" . $_SESSION["user_region"] . "' and ";
		$sql_dw = "SELECT reports.id, 
		reports.is_active, 
		reports.status_activity, 
		reports.user_id, 
		reports.code_info, 
		reports.line_action, 
		reports.report_type, 
		reports.activity_title, 
		SUM(participants_list.gender = 'Mujer') AS T_mujeres, 
		SUM(participants_list.gender = 'Hombre') AS T_hombres, 
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
		reports.datetime 
		from reports 
		INNER JOIN participants_list ON participants_list.id_activity = reports.id 
		where reports.estate='" . $_SESSION["user_region"] . "' and ";
	}
	// solo admin visualiza la data nacional



	$sql .= " is_active=1 AND status_activity=1 and estate!='' and (STR_TO_DATE(SUBSTRING_INDEX(date_pub,'/',1),'%d-%m-%Y')>=STR_TO_DATE('01-01-2024 00:00 00', '%d-%m-%Y'))";
	$sql_dw .= " reports.is_active=1 AND reports.status_activity=1 and reports.estate!='' and (STR_TO_DATE(SUBSTRING_INDEX(reports.date_pub,'/',1),'%d-%m-%Y')>=STR_TO_DATE('01-02-2024 00:00 00', '%d-%m-%Y')) GROUP BY reports.datetime order by reports.datetime desc";


	// total para paginacionSELECT * FROM reports WHERE reports.estate='Amazonas' AND reports.is_active=1 AND reports.status_activity=1 and reports.estate!='' order by datetime desc LIMIT 0 , 10
	if (($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
		$total = ReportActivityData::getBySQL($sql);
		$TotalReg = count($total);
	}

	if (($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7)) {
		$consult = $sql . " order by datetime desc LIMIT " . (($compag - 1) * 0) . " , " . 1000;
		$total = ReportActivityData::getBySQL($consult);
		$TotalReg = count($total);
	}


	$consult = $sql . " order by datetime desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
	$users = ReportActivityData::getBySQL($consult);
	//echo $consult;





	$url_pag = "<a href=\"?view=report&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";


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
		<!-- <a href="./index.php?view=newactivity" class="btn btn-primary"><i class="fa fa-paper-plane" ></i> Agregar reporte</a> -->
		<a href="./index.php?view=services" class="btn btn-info"><i class="material-icons">support_agent</i> Registrar servicio</a>

		<a target="_blank" href="./pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
		<a target="_blank" class="btn btn-success" href="../../../core/app/view/exportxlsx.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<a href="./pdf/jspdf2.php?param_pdf=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> PDF</a>

		<!-- <a href="./pdf/jspdf.php" name="Descargar" class=" btn btn-default "><i class="fa fa-file-pdf-o"></i> </a> -->
		<!-- <button onclick="generate()">Generate pdf</button> -->
		<!-- <a href="./index.php?view=services" class="btn btn-primary btn-round"><i class="material-icons">add</i></a> -->

		<!-- <div class="form-group text_label">
		<!?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
	</div> -->


		<?php if (($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) && (!isset($_GET["q"]) && !isset($_GET["estado"]) && !isset($_GET["start_at"]) && !isset($_GET["finish_at"]) && !isset($_GET["uid"]) && !isset($_GET["linea_accion"]) && !isset($_GET["info_id"]))) { ?>
			<?php if ($TotalReg > 0) { ?>
				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Se han cargado los últimos mil registros del año en curso</b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
				</div>
			<?php } ?>

		<?php } else if (($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) && (isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"])) &&  ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $_GET["info_id"] != "")) { ?>
			<?php if ($TotalReg > 0) { ?>
				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
				</div>
			<?php } ?>

		<?php } else if (($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) && (isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"])) &&  ($_GET["q"] == "" || $_GET["estado"] == "" || $_GET["start_at"] == "" || $_GET["finish_at"] == "" || $_GET["uid"] == "" || $_GET["linea_accion"] == "" || $_GET["info_id"] == "")) { ?>
			<?php if ($TotalReg > 0) { ?>
				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Se han cargado los últimos mil registros del año en curso</b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
				</div>
			<?php } ?>

		<?php } else if ((!isset($_GET["q"]) && !isset($_GET["estado"]) && !isset($_GET["start_at"]) && !isset($_GET["finish_at"]) && !isset($_GET["uid"]) && !isset($_GET["linea_accion"]) && !isset($_GET["info_id"]))) { ?>
			<?php if ($TotalReg > 0) { ?>
				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros en el año en curso </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
				</div>
			<?php } ?>

		<?php } else if ((isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"])) &&  ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["uid"] != "" || $_GET["linea_accion"] != "" || $_GET["info_id"] != "")) { ?>
			<?php if ($TotalReg > 0) { ?>
				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros en total</b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
				</div>
			<?php } ?>

		<?php } else if ((isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"])) &&  ($_GET["q"] == "" || $_GET["estado"] == "" || $_GET["start_at"] == "" || $_GET["finish_at"] == "" || $_GET["uid"] == "" || $_GET["linea_accion"] == "" || $_GET["info_id"] == "")) { ?>
			<?php if ($TotalReg > 0) { ?>
				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros en el año en curso </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
				</div>
			<?php } ?>
		<?php } ?>

	</div>










	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">


					<?php if ($_SESSION["user_type"] == 7) { ?>

						<!-- EDICION POR LOTES -->
						<form class="form-horizontal" role="form" method="post" action="./?action=ajax&function=active_report" enctype="multipart/form-data">
							<input type="hidden" name="data_id" id="data_id" value="">
							<input type="hidden" name="pagination" id="pagination" value="<?php echo $location ?>">

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

						</form>
						<!-- END EDICION POR LOTES -->


						<br>
					<?php } ?>

					<!-- <div class="card-body">
						<h6 class="card-category text-danger text-center">
							<i class="material-icons">support_agent</i> ¡Toda actividad sin participante será eliminada en un plazo de tiempo!
						</h6>
						<h6 class="card-category text-info text-center">
							AVISO: A partir del 1 de agosto no se crearan los reportes de actividades desde este módulo de Reportes, la nueva forma será primero planificar la actividad en la sección de planificación y se cambia el estatus a ejecutada, luego se cargan participantes, productos e imágenes.
						</h6>
					</div> -->

					<!-- <p class='alert alert-warning' style='padding:10px 10px;'>¡Toda actividad sin participante será eliminada en un plazo de tiempo! </p> -->





					<!-- <table class="table"> -->
					<table class="table table-hover">


						<!-- INONOS -->
						<thead>
							<th class="text_label " style="width: 100px;"> <i class="fa fa-image icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-calendar icon_table"></i></th>
							<!-- <th class="text_label " > <i class="fa fa-calendar icon_table" ></i></th> -->
							<th class="text_label "> <i class="fa fa-home icon_table"></i></th>
							<!-- <th class="text_label " > <i class="fa fa-map icon_table" ></i></th> -->
							<th class="text_label" style="width: 400px;"> <i class="fa fa-cogs icon_table"></i></th>
							<th class="text_label" style="width: 150px;"> <i class="fa fa-newspaper-o icon_table"></i></th>
							<!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-user icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-phone icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-male icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-female icon_table" ></i></th> -->
							<th class="text_label "> <i class="fa fa-user-plus icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-flask icon_table"></i></th>
							<!-- <th class="text_label " > <i class="fa fa-image icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-file icon_table" ></i></th> -->
							<th class="text_label "> <i class="fa fa-image icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
						</thead>


						<!-- TITULOS -->
						<thead>
							<th> Fecha Ejec</th>
							<th> Publicado</th>
							<!-- <th> Fecha de actividad</th> -->
							<th> Infocentro</th>
							<!-- <th> Estado</th> -->
							<th> Línea de acción</th>
							<!-- <th> Tipo de reporte</th> -->
							<th> Título de la actividad</th>
							<!-- <th> Responsable</th> -->
							<!-- <th> Teléfono</th> -->
							<!-- <th> Partic. Hombres</th> -->
							<!-- <th> Partic. Mujeres</th> -->
							<th> Agregar Part</th>
							<th> Agregar Prod</th>
							<!-- <th> Imágenes</th> -->
							<!-- <th> Archivo</th> -->
							<th>Imág</th>
							<th>Acciones</th>
						</thead>


						<?php
						$total_fem = 0;
						$total_mas = 0;
						$ID = 0;

						$imagen_p = "";
						$titulo_p = "";
						$code_info_p = "";

						foreach ($users as $user) {
							// $pacient  = $user->getPacient();
							// $medic = $user->getMedic();



						?>
							<tr>
								<td>
									<!-- CARGA LAS IMAGENES -->
									<?php $img = explode(", ", $user->image)[0];
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
									if ($img != "Sin registro fotográfico") {
										$img = $img;
									}
									if ($img == "Sin registro fotográfico") {
										$img = "default.jpg";
									}

									if ($img == "") {
										$img = "default.jpg";
									}


									// $imagen_p = "uploads/images/reports/".$img;
									$imagen_p = $img;
									$titulo_p = $user->activity_title;
									$code_info_p = $user->code_info . " | " . $user->line_action;

									$planning_line_action  = $user->line_action;
									$type = ($user->report_type != '') ? $user->report_type : '<font color="red">SELECCIONE</font>';
									$specific = ($user->specific_action != '') ? $user->specific_action : '<font color="red">SELECCIONE</font>';
									$training = ($user->training_type != '') ? $user->training_type : '<font color="red">-</font>';
									$data_activity = $planning_line_action . " % " . $type . " % " . $specific . " % " . $training;

									// sacamos la fecha de inicio
									$date_pub_end = explode("/", $user->date_pub);
									if (count($date_pub_end) > 1) {
										$date_pub = $date_pub_end[0];
									} else {
										$date_pub = $user->date_pub;
									}



									?>


									<!-- <!?php echo explode(", ",$user->image)[0];?> -->
									<div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
										<button type="image_viewer" id="<?php echo $ID; ?>" class="btn_preview" data-toggle="modal" data-target="#image_preview">
											<img src="uploads/images/reports/<?php echo $img; ?>" style="min-width: 80px; min-height: 50px;" class="img-fluid mb-2" alt="Imagen" />
										</button>
									</div>
									<div class="mui--text-center">
										<?php echo date("d/m/Y", strtotime($date_pub)); ?>
									</div>
								</td>







								<td><?php echo date("d/m/Y H:i:s", strtotime($user->datetime));
									echo " desde " . $user->name_os;
									echo " Por: UID " . $user->user_id; ?></td>
								<!-- <td><!?php echo date("d/m/Y", strtotime($date_pub)); ?></td> -->
								<td><?php echo $user->code_info . " | " . $user->responsible_name; ?></td>
								<!-- <td><!?php echo $user->estate; ?></td> -->



								<?php if ($user->line_action == "Infocentro adentro" || $user->line_action == "Comunidades de participación digital" || $user->line_action == "Participación digital") {
									echo '<td class="priority_5" style="color:#f75e05;">'; ?>
								<?php } else if ($user->line_action == "Formación a la medida" || $user->line_action == "Comunidades de aprendizaje") {
									echo '<td class="priority_5" style="color:#f72acb;">'; ?>
								<?php } else if ($user->line_action == "Tejiendo redes" || $user->line_action == "Medios digitales") {
									echo '<td class="priority_5" style="color:#005af5;">'; ?>
								<?php } else if ($user->line_action == "Unidades socio-productivas" || $user->line_action == "Acceso abierto") {
									echo '<td class="priority_5" style="color:#02782f;">'; ?>
								<?php } else if ($user->line_action == "Sistematización de Experiencias") {
									echo '<td class="priority_5" style="color:#bf0442;">'; ?>
								<?php } else {
									echo '<td class="priority_5">';
								} ?>
								<?php echo $planning_line_action . " | " . $specific . " | " . $training; ?>

								</td>

								<!-- <td><!?php echo $user->line_action." |\n ".$user->report_type; ?></td> -->

								<td><?php echo charlimit_title($user->activity_title, 60); ?></td>
								<!-- <td><!?php echo ucfirst(mb_strtolower($user->activity_title,"UTF-8")); ?></td> -->
								<!-- <td><!?php echo $user->responsible_name; ?></td> -->
								<!-- <td><!?php echo $user->responsible_phone; ?></td> -->
								<!-- <td><!?php echo $user->person_ma; ?></td> -->
								<!-- <td><!?php echo $user->person_fe; ?></td> -->

								<?php
								// total de participantes
								if ($user->report_type == "Atención al usuario" && $user->user_id != "") {
									$mujer = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=" . $user->user_id . " AND user_genero='Mujer' AND DATE(user_fecha_servicio)=" . "'" . date("Y/m/d", strtotime($user->date_pub)) . "'");
									$hombre = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=" . $user->user_id . " AND user_genero='Hombre' AND DATE(user_fecha_servicio)=" . "'" . date("Y/m/d", strtotime($user->date_pub)) . "'");
									$Total_mujeres = count($mujer);
									$Total_hombres = count($hombre);

									$total_part = $Total_mujeres + $Total_hombres;

									// actualizo los participantes si la cantidad es diferente
									if ($user->person_fe != $Total_mujeres) {
										$sql = "UPDATE reports SET person_fe=\"$Total_mujeres\" WHERE id=\"$user->id\" ";
										Executor::doit($sql);
									}
									if ($user->person_ma != $Total_hombres) {
										$sql = "UPDATE reports SET person_ma=\"$Total_hombres\" WHERE id=\"$user->id\" ";
										Executor::doit($sql);
									}
								} else {
									$total_part = count(ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=$user->id ")[0]);
								}
								$total_prod = ProductsData::getBySQL("SELECT * from products_list where id_activity=$user->id ");
								// echo count($total_part);
								//echo $user->id;



								// ENLACE DE LOS PRODUCTOS
								$product = [];
								foreach ($total_prod as $p) :
									// $link = $p;
									// $link = explode(", ",$p->web_link);
									if (strlen($p->web_link) > 0) {
										$product[$p->web_link] = $p->web_link;
									}
								endforeach;

								$prod_link = sizeof($product);


								?>



								<?php if ($total_part > 0) { ?>
									<td><a href="index.php?view=participants_list&user_id=<?php echo $user->user_id; ?>&line_action=<?php echo $user->line_action; ?>&report_type=<?php echo $user->report_type; ?>&code_info=<?php echo $user->code_info; ?>&estate=<?php echo $user->estate; ?>&id_activity=<?php echo $user->id; ?>&date_activity=<?php echo $user->date_pub; ?>&activity=<?php echo $user->activity_title; ?>" class="btn btn-info btn-sm <?php if ($user->user_id != $_SESSION["user_id"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8 && ($_SESSION["user_rol"] == 'Políticas públicas' && $user->estate != $_SESSION["user_region"]))) {
																																																																																																																	echo 'disabled';
																																																																																																																} ?>"> <?php echo $total_part ?></a></td>
								<?php } ?>

								<?php if ($total_part == 0) { ?>
									<td><a href="index.php?view=participants_list&user_id=<?php echo $user->user_id; ?>&line_action=<?php echo $user->line_action; ?>&report_type=<?php echo $user->report_type; ?>&code_info=<?php echo $user->code_info; ?>&estate=<?php echo $user->estate; ?>&id_activity=<?php echo $user->id; ?>&date_activity=<?php echo $user->date_pub; ?>&activity=<?php echo $user->activity_title; ?>" class="btn btn-danger btn-sm <?php if ($user->user_id != $_SESSION["user_id"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8 && ($_SESSION["user_rol"] == 'Políticas públicas' && $user->estate != $_SESSION["user_region"]))) {
																																																																																																																	echo 'disabled';
																																																																																																																} ?>"> <?php echo $total_part ?></a></td>
								<?php } ?>


								<?php if (count($total_prod) > 0) { ?>
									<td>
										<a href="index.php?view=products_list&user_id=<?php echo $user->user_id; ?>&code_info=<?php echo $user->code_info; ?>&estate=<?php echo $user->estate; ?>&id_activity=<?php echo $user->id; ?>&date_activity=<?php echo $user->date_pub; ?>&activity_title=<?php echo $user->activity_title; ?>" class="btn btn-info btn-sm <?php if ($user->user_id != $_SESSION["user_id"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8 && ($_SESSION["user_rol"] == 'Políticas públicas' && $user->estate != $_SESSION["user_region"]))) {
																																																																																										echo 'disabled';
																																																																																									} ?>"> <?php echo count($total_prod) ?></a>

										<?php if ($prod_link > 0) { ?>
											<a type="link_viewer" id="<?php echo $user->id; ?>" class=" btn btn-info btn-sm"><i class="fa fa-globe"></i> </a>
										<?php } else { ?>
											<a type="link_viewer_NO" id="<?php echo $user->id; ?>" class=" btn btn-warning btn-sm"><i class="fa fa-globe"></i> </a>
										<?php } ?>

									</td>
								<?php } ?>

								<?php if (count($total_prod) == 0) { ?>
									<td><a href="index.php?view=products_list&user_id=<?php echo $user->user_id; ?>&code_info=<?php echo $user->code_info; ?>&estate=<?php echo $user->estate; ?>&id_activity=<?php echo $user->id; ?>&date_activity=<?php echo $user->date_pub; ?>&activity_title=<?php echo $user->activity_title; ?>" class="btn btn-danger btn-sm <?php if ($user->user_id != $_SESSION["user_id"] && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8 && ($_SESSION["user_rol"] == 'Políticas públicas' && $user->estate != $_SESSION["user_region"]))) {
																																																																																											echo 'disabled';
																																																																																										} ?>"> <?php echo count($total_prod) ?></a></td>
								<?php } ?>




								<!-- <td><button type="image_viewer" id="<!?php echo $user->id; ?>" class="btn btn-success btn-xs">Ver</td> -->
								<!-- <!?php if ($user->file != ""){ ?>
							<td><a href="uploads/files/<!?php echo $user->file;?>" class="btn btn-default btn-xs">Des</a></td>
							<!?php } ?>
							<!?php if ($user->file == ""){ ?>
							<td><a href="#" class="btn btn-default btn-xs">Des</a></td>
							<!?php } ?> -->


								<td><a href="index.php?view=image_edit&id=<?php echo $user->id; ?>&code_info=<?php echo $user->code_info; ?>&user_id=<?php echo $user->user_id; ?>&estate=<?php echo $user->estate; ?>&title=<?php echo $user->activity_title; ?>" class="btn btn-default btn-sm"><i class="material-icons">image</i></a></td>

								<td>

									<?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
										<div class="btn-group btn-group-xs">
											<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id; ?>&id=<?php echo $user->id; ?>&code_info=<?php echo $user->code_info; ?>&estado=<?php echo $user->estate; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																													echo $_GET["participantes"];
																																																												} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																	echo $_GET["start_at"];
																																																																} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																					echo $_GET["finish_at"];
																																																																				} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																								echo $_GET["pag"];
																																																																							} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
											<?php $URL = "index.php?action=delplanning&id=" . $user->id . "&estado=" . $user->estate . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
											<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>
										</div>
										<div class="btn-group btn-group-xs">
											<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
											<?php if ($user->notific != "") { ?>
												<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
											<?php } ?>
										</div>

										<!-- edita el monitor estadal -->
										<?php } else if ($_SESSION['user_rol'] == "Políticas públicas") {
										if ($_SESSION["user_type"] == 3 && strtoupper($_SESSION["user_region"]) == strtoupper($user->estate)) { ?>
											<div class="btn-group btn-group-xs">
												<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id; ?>&id=<?php echo $user->id; ?>&code_info=<?php echo $user->code_info; ?>&estado=<?php echo $user->estate; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																														echo $_GET["participantes"];
																																																													} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																		echo $_GET["start_at"];
																																																																	} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																						echo $_GET["finish_at"];
																																																																					} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																									echo $_GET["pag"];
																																																																								} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
												<?php $URL = "index.php?action=delplanning&id=" . $user->id . "&estado=" . $user->estate . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
												<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>

											</div>
											<div class="btn-group btn-group-xs">
												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<?php if ($user->notific != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											</div>

											<!-- ver las notificaciones de terceros -->
										<?php } else if ($_SESSION["user_type"] == 3 && strtoupper($_SESSION["user_region"]) != strtoupper($user->estate)) { ?>
											<div class="btn-group btn-group-xs">
												<?php if ($user->notific != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											</div>
										<?php } ?>


										<?php } else {
										if ($_SESSION["user_type"] == 8) {
										?>
											<?php if (strtoupper($_SESSION["user_region"]) == strtoupper($user->estate)) { ?>

												<div class="btn-group btn-group-xs">
													<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id; ?>&id=<?php echo $user->id; ?>&code_info=<?php echo $user->code_info; ?>&estado=<?php echo $user->estate; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																															echo $_GET["participantes"];
																																																														} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																			echo $_GET["start_at"];
																																																																		} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																							echo $_GET["finish_at"];
																																																																						} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																										echo $_GET["pag"];
																																																																									} ?>" type="button" rel="tooltip2" data-placement="top" title="Editar" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
													<?php $URL = "index.php?action=delplanning&id=" . $user->id . "&estado=" . $user->estate . "&participantes=" . $participants_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag; ?>
													<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>

												</div>
												<div class="btn-group btn-group-xs">
													<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
													<?php if ($user->notific != "") { ?>
														<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
													<?php } ?>
												</div>

												<!-- ver las notificaciones de terceros -->
											<?php } else if (strtoupper($_SESSION["user_region"]) != strtoupper($user->estate)) { ?>
												<div class="btn-group btn-group-xs">
													<?php if ($user->notific != "") { ?>
														<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
													<?php } ?>
												</div>
											<?php } ?>

											<!-- <!?php }else if ( trim(strtoupper($_SESSION["user_code_info"])) == trim(strtoupper($user->code_info) ))  { ?> -->
										<?php } else if ($_SESSION["user_id"] == $user->user_id) { ?>
											<?php if (strtoupper($_SESSION["user_region"]) == strtoupper($user->estate)) { ?>

												<a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i class="material-icons">update</i></a>
												<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id; ?>&id=<?php echo $user->id; ?>&code_info=<?php echo $user->code_info; ?>&estado=<?php echo $user->estate; ?>&participantes=<?php if (isset($_GET["participantes"])) {
																																																														echo $_GET["participantes"];
																																																													} ?>&start_at=<?php if (isset($_GET["start_at"])) {
																																																																		echo $_GET["start_at"];
																																																																	} ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
																																																																						echo $_GET["finish_at"];
																																																																					} ?>&pag=<?php if (isset($_GET["pag"])) {
																																																																									echo $_GET["pag"];
																																																																								} ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
												<?php if ($user->notific != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>

												<!-- ver las notificaciones de terceros -->
											<?php } else if (strtoupper($_SESSION["user_region"]) != strtoupper($user->estate)) { ?>
												<?php if ($user->notific != "") { ?>
													<a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i class="material-icons">notifications</i></a>
												<?php } ?>
											<?php } ?>

										<?php } ?>

									<?php } ?>



								</td>


								<!-- <td><button type="image_viewer_orig" id="<"?php echo $user->id; ?>" class="btn btn-success btn-xs">Imágenes</td> -->
								<!-- activa el modal y llama la func JS | el scroll vuelve a donde estaba -->
								<!-- <td><button type="image_viewer_orig" id="<!?php echo $user->id; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#image_view">Imágenes</button> -->
								<!-- <button type="image_edit" id="<!?php echo $user->id; ?>" class="btn btn-success btn-xs" data-toggle="modal" data-target="#image_view">Editar</button><td> -->
								<!-- <a href="index.php?view=image_edit&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> -->


								<!-- <td style="width:180px;">
							<a href="index.php?view=editinfocentro&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
							<a href="index.php?action=delinfocentro&id=<!?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
							</td> -->

							</tr>


							<!-- data preview -->
							<p class="data" id="get_data">
								<!-- <p class="data_imagen" id="https://infoapp.lanubeplus.com/uploads/images/reports/<!?php echo $imagen_p;?>"></p> -->
							<p class="data_imagen_modal" id='uploads/images/reports/<?php echo $img; ?>'></p>
							<p class="data_imagen" id="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . '/admin/uploads/images/reports/'; ?><?php echo $imagen_p; ?>"></p>
							<p class="data_titulo" id='<?php echo $titulo_p; ?>'></p>
							<p class="data_code_info" id="<?php echo $code_info_p; ?>"></p>
							<p class="data_code" id="<?php echo $user->code_info; ?>"></p>
							<p class="data_dimensiones" id='<?php echo $data_activity; ?>'></p>
							<p class="id_activity" id='<?php echo $user->id; ?>'></p>
							<p class="notific_var" id='<?php echo $user->notific; ?>'></p>
							<p class="user_id" id='<?php echo $user->user_id; ?>'></p>
							<p class="date_pub_end" id='<?php echo date("Y-m-d", strtotime($date_pub_end[0])); ?>'></p>
							<p class="activity_title" id='<?php echo $user->activity_title; ?>'></p>
							<p class="products" id='<?php echo $product; ?>'></p>
							</p>

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
		<!-- <!?php if ($_GET["estado"] == "" && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) { ?> -->

		<center>

			<?php

			/*Sector de Paginacion */

			//Operacion matematica para boton siguiente y atras 
			$IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
			$DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);

			echo $url_pag . $DecrementNum . "\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-left\"></i> </a>";

			//Se resta y suma con el numero de pag actual con el cantidad de 
			//numeros  a mostrar
			$Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
			$Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);

			//Se valida
			$Desde = ($Desde < 1) ? 1 : $Desde;
			$Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
			//Se muestra los numeros de paginas
			for ($i = $Desde; $i <= $Hasta; $i++) {
				//Se valida la paginacion total
				//de registros
				if ($i <= $TotalRegistro) {
					//Validamos la pag activo
					if ($i == $compag) {
						echo $url_pag . $i . "\" class=\"btn btn-primary btn-sm\"active\">" . $i . "  </a>";
					} else {
						echo $url_pag . $i . "\" class=\"btn btn-info btn-sm\">" . $i . "  </a>";
					}
				}
			}

			// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";
			echo $url_pag . $IncrimentNum . "\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


			?>

		</center>

		<!-- <!?php } ?> -->
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
	</style>