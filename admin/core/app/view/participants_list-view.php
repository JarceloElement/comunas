<!-- <script src="assets/js/jquery-3.1.1.min.js"></script> -->
<script language="javascript">
	var Name_OS = "Unknown OS";


	$('#cover-spin').show(0);



	$(document).ready(function() {


		$('#cover-spin').hide(0);

		// <!-- MODAL SWEET ALERT -->
		$(function() {
			<?php if (isset($_GET['swal']) && $_GET['swal'] != "") : ?>
				if (getOS() != "Android") {
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




		if (document.getElementById("line_action").value == "Comunas en Red Digital") {
			document.getElementById("equipo_sala_comunal_f").style.display = "block";
			document.getElementById("equipo_sala_comunal").required = true;
		} else {
			document.getElementById("equipo_sala_comunal_f").style.display = "none";
			document.getElementById("equipo_sala_comunal").required = false;

		}




	});













	// $fecha_ini = date("d/m/Y", strtotime($res['date_limit_ini']));


	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("validar").addEventListener('submit', validarFormulario);
	});

	function validarFormulario(event) {
		event.preventDefault();

		// Using test we can check if the text match the pattern
		var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
		if (document.validar.email.value.length != 0 && !validEmail.test(document.validar.email.value)) {
			alert('¡El formato del correo no es correcto!\n Debe incluir "@" ');
			return false;
		}


		// valida longitud de la contraseña
		var parent_dni = document.getElementById('parent_dni').value;
		var child_number = document.getElementById('child_number').value;
		var dni = document.getElementById('document_id').value;
		var user_has_document = document.getElementById("user_has_document").value;
		if ((dni.length < 6 || dni.length > 8) && user_has_document == 'Si') {
			if (getOS() == "Android") {
				alert("El documento de identidad debe tener al menos 6 números");
			} else {
				toastify("El documento de identidad debe tener al menos 6 números", true, 10000, "error");
			}
			$("#document_id").focus();
			return;
		}
		// var user_has_document = document.getElementById("user_has_document").value;
		// if ( (parent_dni.length < 6 || parent_dni.length > 8) && user_has_document != 'Si') {
		// 	if (getOS() == "Android"){
		// 		alert("El documento de identidad debe tener al menos 6 números");
		// 	}else {
		// 		toastify("El documento de identidad debe tener al menos 6 números",true,10000,"error");
		// 	}
		// 	$("#parent_dni").focus();
		// 	return;
		// }

		// valida que no sea menor de un año
		var user_f_nacimiento = moment(document.getElementById("user_f_nacimiento").value);
		let fechaActual = moment();
		var diferencia = fechaActual.diff(user_f_nacimiento, 'years');
		console.log(diferencia);
		if (diferencia <= 1) {
			if (getOS() == "Android") {
				alert("El usuario tiene " + diferencia + " años. Por favor verifica que tenga más de un año de edad");
			} else {
				toastify("El usuario tiene " + diferencia + " años. Por favor verifica que tenga más de un año de edad", true, 10000, "error");
			}
			$("#user_f_nacimiento").focus();
			return;
		}


		// valida el telefono
		var valida = /^\d{4}-\d{7}$/;
		var telef_div = document.getElementById("phone");
		var telef = document.getElementById("phone").value;

		if (telef.length > 0) {
			if (telef.match(valida)) {
				telef_div.classList.remove("is-invalid");
				telef_div.className += ' is-valid';
			} else {
				telef_div.classList.remove("is-valid");
				telef_div.className += ' is-invalid';
				$("#phone").focus();
				if (getOS() == "Android") {
					alert("El número de teléfono no es válido");
				} else {
					toastify('El número de teléfono no es válido', true, 10000, "error");
				}
				return;
			}
		}

		// referencia del padre | No cedulados
		if (document.getElementById("child_number").value != "" && document.getElementById('parent_dni').value != "") {
			var parent_ref = parent_dni + child_number;
			document.getElementById('parent_ref').value = parent_ref;
		} else if (document.getElementById("child_number").value == "" && document.getElementById('parent_dni').value == "" && document.getElementById("user_has_document").value == "Si") {
			document.getElementById('parent_ref').value = "No aplica";
			document.getElementById("parent_dni").type = "text";
			document.getElementById('parent_dni').value = "No aplica";
			document.getElementById('child_number').value = null;
		} else if (document.getElementById("child_number").value == "" && document.getElementById('parent_dni').value == "" && document.getElementById("user_has_document").value != "Si") {
			document.getElementById('parent_ref').value = "Falta";
			document.getElementById("parent_dni").type = "text";
			document.getElementById('parent_dni').value = "Falta";
			document.getElementById('child_number').value = null;
		} else if (document.getElementById('parent_dni').value == "" && document.getElementById("user_has_document").value != "Si") {
			document.getElementById('parent_ref').value = "Falta";
			document.getElementById("parent_dni").type = "text";
			document.getElementById('parent_dni').value = "Falta";
			document.getElementById('child_number').value = null;
		}




		$('#cover-spin').show(0);

		$.ajax({
				type: "POST",
				url: "./?action=ajax",
				// headers: {
				//     "X-CSRFToken": getCookie("csrftoken")
				// },
				data: {
					function: "add_participant", // funcion que llama
					is_new: $("#is_new").val(), // si el usuario aun no existe
					id_activity: $("#id_activity").val(), // parametros
					id_final_user: $("#id_final_user").val(),
					activity: $("#activity").val(),
					date_activity: $("#date_activity").val(),
					estate: $("#estate").val(),
					code_info: $("#code_info").val(),
					name: $("#name").val(),
					name_2: $("#name_2").val(),
					lastname: $("#lastname").val(),
					lastname_2: $("#lastname_2").val(),
					user_nationality: $("#user_nationality").val(),
					user_has_document: $("#user_has_document").val(),
					document_id: $("#document_id").val(),
					parent_dni: $("#parent_dni").val(),
					child_number: $("#child_number").val(),
					user_f_nacimiento: $("#user_f_nacimiento").val(),
					gender: $("#gender").val(),
					user_comunity_type: $("#user_comunity_type").val(),
					user_pertenece_organizacion: $("#user_pertenece_organizacion").val(),
					phone: $("#phone").val(),
					email: $("#email").val(),
					etnia: $("#user_etnia").val(),
					line_action: $("#line_action").val(),
					report_type: $("#report_type").val(),
					disability_type: $("#disability_type").val(),
					uid_fac: $("#uid_fac").val(),
					parent_ref: $("#parent_ref").val(),
					user_profesion: $("#user_profesion").val(),
					user_ocupacion: $("#user_ocupacion").val(),
					equipo_sala_comunal: $("#equipo_sala_comunal").val()

				}
			})
			.done(function(msg) {
				console.log(msg);
				$('#cover-spin').hide(0);

				if (getOS() == "Android") {
					alert("Registro guardado");
				} else {
					toastify('Registro guardado', true, 5000, "dashboard");
				}
				// console.log(msg);
				// window.document.location=msg;
				// return;
				location.reload();
				// $('#content').reload('#content');
			})
			.fail(function() {
				if (getOS() == "Android") {
					alert("Hubo un error al guardar, intenta nuevamente");
				} else {
					toastify('Hubo un error al guardar, intenta nuevamente', true, 5000, "warning");
				}
				$('#cover-spin').hide(0);
				return false;
			});
		// .always(function() {
		//     toastify('Finished',true,1000,"warning");
		// });

		// this.submit();

	};
</script>


<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$con = Database::getCon();
$etnias = $con->query("SELECT * from etnia_type");
$discapacidad = $con->query("SELECT * from disability_type");
$professions = $con->query("SELECT * from professions order by p_name");
$occupations = $con->query("SELECT * from occupations order by p_name");




?>

<!-- <div class="panel panel-default"> -->



<div id="cover-spin"></div>




<?php if ($_GET['report_type'] != "Atención al usuario") { ?>

	<div class="card card-nav-tabs text-center">
		<div class="card-header card-header-info">
			Lista de participantes en:
		</div>
		<div class="card-body">
			<h4 class="card-title"><?php echo $_GET["activity"] ?></h4>
		</div>
	</div>
<?php } ?>



<?php if ($_SESSION["user_id"] == $_GET['user_id'] || $_SESSION['user_type'] == 7 || (($_SESSION["user_type"] == 8 || $_SESSION["user_rol"] == 'Políticas públicas') && $_SESSION["user_region"] == $_GET["estate"])) { ?>


	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">

						<div class="card-header card-header-primary">
							<h4 class="title text-left">Nuevo participante</h4>
							<!-- <p class="card-category">Complete your profile</p> -->
						</div>

						<div class="card-body">



							<br><br>

							<form name="validar" id="validar" method="post" role="form">
								<!-- <form class="form-horizontal" role="form" method="post" action="./?action=ajax&function=add_participant"> -->
								<input type="hidden" name="id_activity" id="id_activity" value="<?php echo $_GET['id_activity']; ?>">
								<input type="hidden" name="activity" id="activity" value="<?php echo $_GET['activity']; ?>">
								<input type="hidden" name="date_activity" id="date_activity" value="<?php echo $_GET['date_activity']; ?>">
								<input type="hidden" name="estate" id="estate" value="<?php echo $_GET['estate']; ?>">
								<input type="hidden" name="code_info" id="code_info" value="<?php echo $_GET['code_info']; ?>">
								<input type="hidden" name="line_action" id="line_action" value="<?php echo $_GET['line_action']; ?>">
								<input type="hidden" name="report_type" id="report_type" value="<?php echo $_GET['report_type']; ?>">
								<input type="hidden" name="uid_fac" id="uid_fac" value="<?php echo $_SESSION["user_id"]; ?>">
								<input type="hidden" name="parent_ref" id="parent_ref" value="No aplica">
								<input type="hidden" name="is_new" id="is_new" value="">
								<input type="hidden" name="id_final_user" id="id_final_user" value="0">

								<div class="form-row">
									<label><i class="fa fa-search"></i> Buscar por DNI, código, nombre o correo</label>
									<div class="col-md-12 mui-textfield mui-textfield--float-label">
										<div class="input-group">
											<input type="text" class="form-control" name="buscar_participante" id="q_participante" value="" placeholder="Buscar">
											<span class="input-group-btn">
												<button type="button" onclick="codigoAJAX()" class="btn btn-fab btn-round btn-primary">
													<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
															<path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
														</svg></i>
												</button>
											</span>
										</div>
										<br>
									</div>

									<div class="col-md-4 mui-select">
										<select name="user_nationality" id="user_nationality" required>
											<option value="<?php echo "V"; ?>"><?php echo "V"; ?></option>
											<option value="<?php echo "E"; ?>"><?php echo "E"; ?></option>
										</select>
										<label><i class="fa fa-user"></i> Nacionalidad</label>
									</div>

									<div class="col-md-4 mui-select">
										<select name="user_has_document" id="user_has_document" required>
											<option value="">-Elige-</option>
											<option value="<?php echo "Si"; ?>">Si</option>
											<option value="<?php echo "No/Sin partida de nacimiento"; ?>">No/Sin partida de nacimiento</option>
											<option value="<?php echo "No/Menor de edad"; ?>">No/Menor de edad</option>
											<option value="<?php echo "No/Problemas en documentos"; ?>">No/Problemas en documentos</option>
											<option value="<?php echo "No/Pueblo originario"; ?>">No/Pueblo originario</option>
										</select>
										<label><i class="fa fa-user"></i> ¿Está cedulado?</label>
									</div>

									<div class="col-md-4 mui-textfield mui-textfield--float-label" id="document_id_l">
										<input type="number" name="document_id" id="document_id" required minlength="6" maxlength="8" placeholder="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
										<label><i class="fa fa-user"></i> Número DNI</label>
									</div>

									<!-- datos del padre para no cedulados -->
									<div class="col-md-6" id="parent_dni_div" style="display:none">
										<div class="form-group">
											<label for="parent_dni" class=" control-label" style="color:green;"> DNI del representante (Solo no cedulados)</label>
											<input type="number" class="form-control" name="parent_dni" id="parent_dni" minlength="6" maxlength="8" value="" placeholder="C.I del padre o madre" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
										</div>
									</div>

									<div class="col-md-6" id="child_number_div" style="display:none">
										<div class="form-group">
											<label for="child_number" class=" control-label" style="color:green;"> ¿Que posición de hijo tiene? (Ejemplo: el 1, 2, 3)</label>
											<input type="number" class="form-control" name="child_number" id="child_number" minlength="6" maxlength="8" value="1" placeholder="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = 0;if (document.getElementById('parent_dni').value==''){alert('Por favor asigna primero el DNI del representante');document.getElementById('child_number').value='';document.getElementById('parent_dni').focus();};">
										</div>
									</div>

									<!-- <div class="col-md-4" id="parent_ref_div" style="display:none">
									<div class="form-group">
										<label for="parent_ref" class=" control-label" style="color:red;"> DNI Referencia (Para no cedulados)</label>
										<input type="text" class="form-control" name="parent_ref" id="parent_ref" readonly placeholder="DNI madre + posición del hijo" minlength="6" maxlength="8" value="<?php echo $part->parent_ref; ?>" >
									</div>
								</div> -->




									<div class="col-md-6 mui-textfield mui-textfield--float-label" id="name_l">
										<input type="text" name="name" id="name" required placeholder="">
										<label><i class="fa fa-user"></i> Primer nombre</label>
									</div>

									<div class="col-md-6 mui-textfield mui-textfield--float-label" id="name_2_l">
										<input type="text" name="name_2" id="name_2" placeholder="">
										<label><i class="fa fa-user"></i> Segundo nombre</label>
									</div>

									<div class="col-md-6 mui-textfield mui-textfield--float-label" id="lastname_l">
										<input type="text" name="lastname" id="lastname" required placeholder="">
										<label><i class="fa fa-user"></i> Primer apellido</label>
									</div>

									<div class="col-md-6 mui-textfield mui-textfield--float-label" id="lastname_2_l">
										<input type="text" name="lastname_2" id="lastname_2" placeholder="">
										<label><i class="fa fa-user"></i> Segundo apellido</label>
									</div>

									<div class="col-md-6 mui-textfield mui-textfield--float-label-true">
										<input type="date" name="user_f_nacimiento" id="user_f_nacimiento" required placeholder="" min="1928-01-01" max="2021-12-31">
										<label><i class="fa fa-user"></i> Fecha de nacimiento*</label>
									</div>

									<div class="col-md-6 mui-textfield mui-textfield--float-label" id="phone_l">
										<input type="tel" name="phone" id="phone" placeholder="" maxlength="12" list="list_code">
										<label><i class="fa fa-user"></i> Teléfono</label>
									</div>

									<div class="col-md-6 mui-textfield mui-textfield--float-label" id="email_l">
										<input type="email" name="email" id="email" placeholder="">
										<label><i class="fa fa-user"></i> Correo</label>
									</div>


									<div class="col-md-6 mui-select">
										<select name="user_genero" id="gender" required>
											<option value="">-GÉNERO-</option>
											<option value="<?php echo "Hombre"; ?>"><?php echo "Hombre"; ?></option>
											<option value="<?php echo "Mujer"; ?>"><?php echo "Mujer"; ?></option>
										</select>
										<label><i class="fa fa-user"></i> Género*</label>
									</div>

									<div class="col-md-6 mui-select">
										<select name="user_comunity_type" id="user_comunity_type" required>
											<option value=""><?php echo "-SELECCIONE-" ?></option>
											<option value="<?php echo "No aplica" ?>"> <?php echo "No aplica" ?></option>
											<option value="<?php echo "Indígena" ?>"> <?php echo "Indígena" ?></option>
											<option value="<?php echo "Campesina" ?>"> <?php echo "Campesina" ?></option>
											<option value="<?php echo "Afrodescendiente" ?>"> <?php echo "Afrodescendiente" ?></option>
											<option value="<?php echo "Privado de Libertad" ?>"> <?php echo "Privado de Libertad" ?></option>
										</select>
										<label><i class="fa fa-user"></i> Comunidad a la que pertenece*</label>
									</div>

									<div class="col-md-6 mui-select">
										<select name="user_pertenece_organizacion" id="user_pertenece_organizacion" required>
											<option value=""><?php echo "-SELECCIONE-" ?></option>
											<option value="<?php echo "No aplica" ?>"><?php echo "No aplica" ?></option>
											<option value="<?php echo "Consejo Comunal" ?>"><?php echo "Consejo Comunal" ?></option>
											<option value="<?php echo "Comuna" ?>"><?php echo "Comuna" ?></option>
											<option value="<?php echo "UBCH" ?>"><?php echo "UBCH" ?></option>
											<option value="<?php echo "Clap" ?>"><?php echo "Clap" ?></option>
											<option value="<?php echo "Comité" ?>"><?php echo "Comité" ?></option>
											<option value="<?php echo "Movimiento" ?>"><?php echo "Movimiento" ?></option>
											<option value="<?php echo "Colectivo" ?>"><?php echo "Colectivo" ?></option>
										</select>
										<label><i class="fa fa-user"></i> Pertenece a Organización social*</label>
									</div>


									<div class="col-md-6 mui-select">
										<select name="user_etnia" id="user_etnia" required>
											<option value="">-ETNIA-</option>
											<?php foreach ($etnias as $name) : ?>
												<option value="<?php echo $name["name"]; ?>"> <?php echo $name["name"]; ?></option>
											<?php endforeach; ?>
										</select>
										<label><i class="fa fa-user"></i> Pueblo indígena*</label>
									</div>

									<div class="col-md-6 mui-select">
										<select name="disability_type" id="disability_type" required>
											<option value="">-DISCAPACIDAD-</option>
											<?php foreach ($discapacidad as $name) : ?>
												<option value="<?php echo $name["disability"]; ?>"> <?php echo $name["disability"]; ?></option>
											<?php endforeach; ?>
										</select>
										<label><i class="fa fa-user"></i> Discapacidad*</label>
									</div>


									<div class="col-md-6 mui-select">
										<select name="user_profesion" class="form-control" id="user_profesion" required>
											<option value="">-SELECCIONE-</option>
											<option value="Otra">Otra</option>
											<option value="Estudiante">Estudiante</option>
											<option value="Trabajo del hogar">Trabajo del hogar</option>
											<?php foreach ($professions as $name) : ?>
												<option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
											<?php endforeach; ?>
										</select>
										<label><i class="fa fa-user"></i> Profesión*</label>
									</div>

									<div class="col-md-6 mui-select">
										<select name="user_ocupacion" class="form-control" id="user_ocupacion" required>
											<option value="">-SELECCIONE-</option>
											<option value="Otra">Otra</option>
											<option value="Estudiante">Estudiante</option>
											<option value="Trabajo del hogar">Trabajo del hogar</option>
											<?php foreach ($occupations as $name) : ?>
												<option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
											<?php endforeach; ?>
										</select>
										<label><i class="fa fa-user"></i> Ocupación*</label>
									</div>



									<div class="col-md-12 mui-select" id="equipo_sala_comunal_f" style="display:none">
										<select name="equipo_sala_comunal" id="equipo_sala_comunal">
											<option value=""><?php echo "-SELECCIONE-" ?></option>
											<option value="<?php echo "Responsable de la Sala de Autogobierno" ?>"><?php echo "Responsable de la Sala de Autogobierno" ?></option>
											<option value="<?php echo "Secretario" ?>"><?php echo "Secretario" ?></option>
											<option value="<?php echo "Sistematizadores" ?>"><?php echo "Sistematizadores" ?></option>
											<option value="<?php echo "Misioneros de las Grandes Misiones de Nueva Generación" ?>"><?php echo "Misioneros de las Grandes Misiones de Nueva Generación" ?></option>
											<option value="<?php echo "Voceros del Gabinete Popular Comunal: Economía Productiva" ?>"><?php echo "Voceros del Gabinete Popular Comunal: Economía Productiva" ?></option>
											<option value="<?php echo "Voceros del Gabinete Popular Comunal: Ciudades Humanas y Servicios" ?>"><?php echo "Voceros del Gabinete Popular Comunal: Ciudades Humanas y Servicios" ?></option>
											<option value="<?php echo "Voceros del Gabinete Popular Comunal: Seguridad y Paz" ?>"><?php echo "Voceros del Gabinete Popular Comunal: Seguridad y Paz" ?></option>
											<option value="<?php echo "Voceros del Gabinete Popular Comunal: Suprema Felicidad Social" ?>"><?php echo "Voceros del Gabinete Popular Comunal: Suprema Felicidad Social" ?></option>
											<option value="<?php echo "Voceros del Gabinete Popular Comunal: Organización y Planificación Popular" ?>"><?php echo "Voceros del Gabinete Popular Comunal: Organización y Planificación Popular" ?></option>
											<option value="<?php echo "Voceros del Gabinete Popular Comunal: Ecosocialismo, Ciencia y Tecnología" ?>"><?php echo "Voceros del Gabinete Popular Comunal: Ecosocialismo, Ciencia y Tecnología" ?></option>
										</select>
										<label><i class="fa fa-user"></i> Equipo coordinador de la Sala Comunal del Sistema de Gobierno Popular*</label>
									</div>



									<div class="col-md-6">
										<div class="form-group">
											<button type="submit" name="" class="btn btn-primary btn-block">Agregar</button>
										</div>
									</div>
								</div>

							</form>

							<datalist id="list_code">
								<option value="0412">
								<option value="0414">
								<option value="0416">
								<option value="0424">
								<option value="0426">
							</datalist>


						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


<?php } ?>









<?php

$CantidadMostrar = 30;
$url_pag_atras = "";
$url_pag_adelante = "";

// Validado  la variable GET
$pag = isset($_GET['pag']) ? $_GET['pag'] : '';
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];




$total = ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=" . $_GET['id_activity'] . " order by id asc ");
$TotalReg = $total[1];

$param_csv = "SELECT * from participants_list where id_activity=" . $_GET['id_activity'] . " order by id desc ";
$sql = "SELECT * from participants_list where id_activity=" . $_GET['id_activity'] . " order by id desc";
$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
$param = ParticipantsData::getBySQL($sql);

$url_pag = "<a href=\"?view=participants_list&user_id=" . $_GET["user_id"] . "&report_type=" . $_GET["report_type"] . "&code_info=" . $_GET["code_info"] . "&estate=" . $_GET["estate"] . "&id_activity=" . $_GET["id_activity"] . "&date_activity=" . $_GET["date_activity"] . "&activity=" . $_GET["activity"] . "&pag=";
$url_location = "?view=participants_list&user_id=" . $_GET["user_id"] . "&line_action=" . $_GET["line_action"] . "&report_type=" . $_GET["report_type"] . "&code_info=" . $_GET["code_info"] . "&estate=" . $_GET["estate"] . "&id_activity=" . $_GET["id_activity"] . "&date_activity=" . $_GET["date_activity"] . "&activity=" . $_GET["activity"];
$_SESSION["location"] = $url_location;


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
$param_sql = "true";
$DB_name = "participants_list";



// CORREGIR FECHAS DE LA ACTIVIDAD DESIGUALES EN EL REG DEL PARTICIPANTE
// $corregir = ParticipantsData::getBySQL($param_csv);
// foreach($corregir[0] as $data){
// 	if ($data->date_activity == "" || $data->date_activity != $_GET['date_activity']){
// 		$user = ParticipantsData::getById($data->id)[0];
// 		$user->date_activity = $_GET['date_activity'];
// 		$user->update();
// 	}
// }

?>



<div class="col-md-12">
	<div class="card">
		<div class="card-content table-responsive">
			<div class="card-body">

				<?php if (count($param[0]) > 0) { ?>
					<!-- si hay usuarios -->


					<div class="form-group text_label">
						<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
					</div>

					<a href="./pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
					<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>

					<br><br>

					<table class="table table-bordered table-hover">
						<thead>
							<th>N°</th>
							<th>UID_Fac</th>
							<th>ID_user</th>
							<th>Estado</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>C.I</th>
							<th>Ref. Padres</th>
							<th>Edad</th>
							<th>Género</th>
							<th>Teléfono</th>
							<th>Acciones</th>
						</thead>

						<?php
						$var_count = 0;
						foreach ($param[0] as $types) {
							$var_count += 1;
						?>
							<tr>
								<td><?php echo $var_count; ?></td>
								<!-- <td><!?php echo $_GET['estate']; ?></td> -->
								<td><?php echo $types["uid_fac"]; ?></td>
								<td><?php echo $types["id_user_final"]; ?></td>
								<td><?php echo $types["estate"]; ?></td>
								<td><?php echo $types["name"]; ?></td>
								<td><?php echo $types["lastname"]; ?></td>
								<td><?php echo $types["document_id"]; ?></td>
								<td><?php echo $types["parent_ref"]; ?></td>
								<td><?php echo $types["age"]; ?></td>
								<td><?php echo $types["gender"]; ?></td>
								<td><?php echo $types["phone"]; ?></td>


								<td style="width:180px;">

									<?php if ($_SESSION["user_id"] == $_GET['user_id']) { ?>
										<a href='index.php?view=editparticipants&id=<?php echo $types["id"]; ?>&code_info=<?php echo $_GET['code_info']; ?>&estate=<?php echo $_GET['estate']; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&activity=<?php echo $_GET["activity"]; ?>&gender=<?php echo $types["gender"]; ?>&line_action=<?php echo $_GET["line_action"]; ?>&report_type=<?php echo $_GET["report_type"]; ?>&pag=<?php echo $pag; ?>' class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
													<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
												</svg></i></a>
										<a href='./?action=ajax&function=del_participant&code_info=<?php echo $_GET['code_info']; ?>&estate=<?php echo $_GET['estate']; ?>&id=<?php echo $types["id"]; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&activity=<?php echo $_GET["activity"]; ?>&gender=<?php echo $types["gender"]; ?>&line_action=<?php echo $_GET["line_action"]; ?>&report_type=<?php echo $_GET["report_type"]; ?>&user_id=<?php echo $_GET["user_id"]; ?>' class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
													<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
												</svg></i></a>

									<?php } elseif ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9 || (($_SESSION["user_type"] == 8 || $_SESSION["user_rol"] == 'Políticas públicas') && $_SESSION["user_region"] == $_GET["estate"])) { ?>

										<a href='index.php?view=editparticipants&id=<?php echo $types["id"]; ?>&code_info=<?php echo $_GET['code_info']; ?>&estate=<?php echo $_GET['estate']; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&activity=<?php echo $_GET["activity"]; ?>&gender=<?php echo $types["gender"]; ?>&line_action=<?php echo $_GET["line_action"]; ?>&report_type=<?php echo $_GET["report_type"]; ?>&pag=<?php echo $pag; ?>' class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
													<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
												</svg></i></a>
										<a href='./?action=ajax&function=del_participant&code_info=<?php echo $_GET['code_info']; ?>&estate=<?php echo $_GET['estate']; ?>&id=<?php echo $types["id"]; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&activity=<?php echo $_GET["activity"]; ?>&gender=<?php echo $types["gender"]; ?>&line_action=<?php echo $_GET["line_action"]; ?>&report_type=<?php echo $_GET["report_type"]; ?>&user_id=<?php echo $_GET["user_id"]; ?>' class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
													<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
												</svg></i></a>

									<?php } ?>

								</td>
							</tr>
						<?php
						}
						?>


					</table>


				<?php
				} else {
					echo "<p class='alert alert-danger'>No hay registros</p>";
				}
				?>
			</div>
		</div class="card-content table-responsive">
	</div>
</div>

<?php include "core/app/layouts/pagination.php"; ?>















<script language="javascript">
	$('#cover-spin').show(0);


	// CARGA DATOS DEL RESPONSABLE CON AJAX Y RETARDO AL ESCRIBIR
	var controladorTiempo = "";

	// retardo entre caracteres
	$(function() {

		// $("#q_participante").on("keyup", function() {
		// 	clearTimeout(controladorTiempo);
		// 	controladorTiempo = setTimeout(codigoAJAX, 800);
		// });

		$("#user_f_nacimiento").on("keyup", function() {
			clearTimeout(controladorTiempo);
			controladorTiempo = setTimeout(codigoAJAX, 2500);
		});



	});

	function codigoAJAX() {
		$('#cover-spin').show(0);

		que = document.getElementById("q_participante").value;
		user_nombres = document.getElementById("name").value;
		user_nombre_2 = document.getElementById("name_2").value;
		user_apellidos = document.getElementById("lastname").value;
		user_has_document = document.getElementById("user_has_document").value;
		user_f_nacimiento = document.getElementById("user_f_nacimiento").value;


		// alert(que);
		$.post("core/app/view/getParticipant-view.php", {
			search: que,
			user_nombres: user_nombres,
			user_nombre_2: user_nombre_2,
			user_apellidos: user_apellidos,
			user_has_document: user_has_document,
			user_f_nacimiento: user_f_nacimiento

		}, function(data) {
			$('#cover-spin').hide(0);

			// console.log(data);
			var array = JSON.parse(data);
			// console.log("-" + array["user_etnia"] + "-");
			// console.log(que);

			if (array["error"] == "false") {
				document.getElementById("is_new").value = "false";

				$("#document_id_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				$("#parent_ref").val(array["parent_ref"]);
				$("#parent_ref_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				$("#name").val(array["name"]);
				$("#name_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				$("#name_2").val(array["name_2"]);
				$("#name_2_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');

				$("#parent_dni").val(array["parent_dni"]);
				$("#parent_dni_div").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');

				$("#child_number").val(array["child_number"]);
				$("#child_number_div").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');

				$("#lastname").val(array["lastname"]);
				$("#lastname_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				$("#lastname_2").val(array["lastname_2"]);
				$("#lastname_2_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');

				$("#user_f_nacimiento").val(array["user_f_nacimiento"]);
				$("#age").val(array["age"]);
				$("#gender").val(array["gender"]);
				$("#user_comunity_type").val(array["user_comunity_type"]);
				$("#user_pertenece_organizacion").val(array["user_pertenece_organizacion"]);
				$("#phone").val(array["phone"]);
				$("#phone_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				$("#email").val(array["email"]);
				$("#email_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				$("#user_nationality").val(array["user_nationality"]);
				$("#user_has_document").val(array["user_has_document"]);
				$("#user_etnia").val(array["user_etnia"]);
				$("#disability_type").val(array["disability_type"]);
				$("#id_final_user").val(array["id_final_user"]);
				$("#user_profesion").val(array["user_profesion"]);
				$("#user_ocupacion").val(array["user_ocupacion"]);
				$("#equipo_sala_comunal").val(array["user_equipo_sala_comunal"]);


				if (getOS() == "Android") {
					alert(array["param"]);
				} else {
					toastify(array["param"], true, 20000, "warning");
				}


				var cedulado = array["user_has_document"];
				if (cedulado != 'Si') {
					document.getElementById("document_id").type = "text";
					$("#document_id").val(array["document_id"]);
					document.getElementById("document_id").setAttribute('maxlength', 11);
					document.getElementById("document_id").value = "No cedulado";
					document.getElementById("document_id").readOnly = true;
					document.getElementById("document_id").classList.remove("is-invalid");
					$("#document_id_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');

					document.getElementById("parent_dni_div").style.display = "block";
					// document.getElementById("parent_ref_div").style.display="block";
					document.getElementById("child_number_div").style.display = "block";
					document.getElementById("parent_dni").type = "number";
					// document.getElementById("parent_dni").required = true;
					// document.getElementById("child_number").required = true;

					// document.getElementById("email").required = true;
					compareDni(' is-valid');
					// if (mobile) {
					//     alert('¡AVISO! si el usuario no está cedulado requiere de un correo electrónico para ser registrado');
					// } else {
					//     toastify('¡AVISO! si el usuario no está cedulado requiere de un correo electrónico para ser registrado',true,10000,"warning");
					// }
				} else {
					document.getElementById("document_id").type = "number";
					$("#document_id").val(array["document_id"]);
					document.getElementById("document_id").setAttribute('maxlength', 8);
					document.getElementById("document_id").readOnly = false;
					document.getElementById("document_id").classList.remove("is-valid");

					document.getElementById("parent_dni_div").style.display = "none";
					document.getElementById("child_number_div").style.display = "none";
					// document.getElementById("parent_ref_div").style.display="none";
					document.getElementById("parent_dni").required = false;
					document.getElementById("child_number").required = false;
					document.getElementById("child_number").value = "";
					document.getElementById("parent_dni").type = "text";
					document.getElementById("parent_dni").value = "No aplica";
					document.getElementById("parent_ref").value = "No aplica";
					document.getElementById("child_number").value = "";

					// document.getElementById("email").required = false;
					compareDni(' is-invalid');
				}


			} else {
				document.getElementById("q_participante").value = "";
				document.getElementById("id_final_user").value = "0";
				document.getElementById("is_new").value = "true";
				if (getOS() == "Android") {
					alert(array["param"]);
				} else {
					toastify(array["param"], true, 15000, "error");
				}

			}



		});
	}
	// =======================


	$(document).ready(function() {
		var dni = document.getElementById("document_id").value;
		var controladorTiempo = "";

		// verificar si es cedulado
		$("#user_has_document").change(function() {
			var cedulado = $(this).val();
			if (cedulado != 'Si') {
				document.getElementById("document_id").type = "text";
				document.getElementById("document_id").setAttribute('maxlength', 11);
				document.getElementById("document_id").value = "No cedulado";
				document.getElementById("document_id").readOnly = true;
				document.getElementById("document_id").classList.remove("is-invalid");
				$("#document_id_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');

				document.getElementById("parent_dni_div").style.display = "block";
				// document.getElementById("parent_ref_div").style.display="block";
				document.getElementById("child_number_div").style.display = "block";
				document.getElementById("child_number").value = "";
				document.getElementById("parent_dni").type = "number";
				document.getElementById("parent_ref").value = "No aplica";
				// document.getElementById("parent_dni").required = true;
				// document.getElementById("child_number").required = true;

				// document.getElementById("email").required = true;
				compareDni(' is-valid');
				if (getOS() == "Android") {
					alert('¡AVISO! si el campo (DNI del representante) está vacío, el sistema le asignará un código de referencia para usar como su DNI la próxima vez');
				} else {
					toastify('¡AVISO! si el campo (DNI del representante) está vacío, el sistema le asignará un código de referencia para usar como su DNI la próxima vez', true, 30000, "warning");
				}
			} else {
				document.getElementById("document_id").type = "number";
				document.getElementById("document_id").setAttribute('maxlength', 8);
				document.getElementById("document_id").value = dni;
				document.getElementById("document_id").readOnly = false;
				document.getElementById("document_id").classList.remove("is-valid");

				document.getElementById("parent_dni_div").style.display = "none";
				document.getElementById("child_number_div").style.display = "none";
				// document.getElementById("parent_ref_div").style.display="none";
				document.getElementById("parent_dni").required = false;
				document.getElementById("child_number").required = false;
				document.getElementById("child_number").value = "";
				document.getElementById("parent_dni").type = "text";
				document.getElementById("parent_dni").value = "No aplica";
				document.getElementById("parent_ref").value = "No aplica";
				document.getElementById("child_number").value = "";

				// document.getElementById("email").required = false;
				compareDni(' is-invalid');
			}
		})



		$("#document_id").on("keyup", function() {
			user_dni = $(this).val();
			var user_has_document = document.getElementById("user_has_document").value;
			clearTimeout(controladorTiempo);

			if (user_has_document == 'Si') {
				if (user_dni == 0) {
					toastify('El número de documento no es válido, debe ser mayor a cero', true, 8000, "error");
					document.getElementById("document_id").value = "";
				}
				if (user_dni.length < 6 || user_dni.length > 8) {
					// retardo entre caracteres
					controladorTiempo = setTimeout(compareDni(' is-invalid'), 800);
				} else {
					document.getElementById("document_id").classList.remove("is-invalid");
					controladorTiempo = setTimeout(compareDni(' is-valid'), 800);
				}
			}
		});


		// validar telefono
		var numbers = /^[0-9_-]+$/;
		var valida = /^\d{4}-\d{7}$/;
		$("#phone").on("keyup", function() {
			var tel = $(this).val();
			var element = document.getElementById("phone");

			if (tel.length > 0) {
				if (tel.match(valida)) {
					element.classList.remove("is-invalid");
					element.className += ' is-valid';
				} else {
					element.classList.remove("is-valid");
					element.className += ' is-invalid';
				}

				// solo numeros y guiones
				if (tel.match(numbers)) {
					// 
				} else {
					alert("¡En el campo teléfono solo se aceptan números!");
					document.getElementById("phone").focus();
					document.getElementById("phone").value = tel.substring(0, tel.length - 1);
				}
				// colocar y quitar guion
				if (tel.length > 4 && !tel.includes("-")) {
					document.getElementById("phone").value = tel.slice(0, 4) + "-" + (tel).slice(4);
				} else if (tel.length == 5) {
					document.getElementById("phone").value = tel.replace("-", "");
				}

				// if (tel.length == 11) {
				//     controladorTiempo = setTimeout(validaTele, 200);
				// }
			} else {
				document.getElementById("phone").value = ""
				element.classList.remove("is-invalid");
				element.className += ' is-valid';
			}


		});






	})




	function compareDni(setclass) {
		var element = document.getElementById("document_id");
		element.className += setclass;
	}


	function validaTele() {
		var tel = document.getElementById("phone").value;
		if (tel.length == 4) {
			document.getElementById("phone").value = tel + '-';
		}
	}
</script>