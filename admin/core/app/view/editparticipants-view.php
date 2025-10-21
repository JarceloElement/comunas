<?php
$estado = EstadoData::getAll();
$info = InfoData::getByCode($_GET['code_info']);
$municipio = MunicipioData::getAll();
$part = ParticipantsData::getByIdInner($_GET["id"]);
// $report = ReportActivityData::getById($_GET["id_activity"]);


$con = Database::getCon();
$etnias = $con->query("SELECT * from etnia_type");
$discapacidad = $con->query("SELECT * from disability_type");
$professions = $con->query("SELECT * from professions order by p_name");
$occupations = $con->query("SELECT * from occupations order by p_name");

?>



<script language="javascript">
	$(document).ready(function() {

		if (document.getElementById("user_has_document").value != "Si") {
			document.getElementById("parent_dni_div").style.display = "block";
			document.getElementById("child_number_div").style.display = "block";
			document.getElementById("parent_ref_div").style.display = "block";
			document.getElementById("parent_dni").type = "text";
			document.getElementById("document_id").type = "text";
			document.getElementById("document_id").value = "No cedulado";
			document.getElementById("document_id").required = false;
			document.getElementById("document_id").readOnly = true;
		} else {
			document.getElementById("parent_dni").required = false;
			document.getElementById("child_number").required = false;
			document.getElementById("parent_dni").type = "text";
			document.getElementById("parent_dni").value = "No aplica";
			document.getElementById("parent_ref").value = "No aplica";
		}

		// var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase() ));


		if (document.getElementById("line_action").value == "Comunas en Red Digital") {
			document.getElementById("equipo_sala_comunal_f").style.display = "block";
			document.getElementById("equipo_sala_comunal").required = true;
		} else {
			document.getElementById("equipo_sala_comunal_f").style.display = "none";
			document.getElementById("equipo_sala_comunal").required = false;

		}


	})


	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("validar").addEventListener('submit', validarFormulario);
	});

	function validarFormulario(evento) {
		event.preventDefault();

		var dni = document.getElementById('document_id').value;
		var user_has_document = document.getElementById("user_has_document").value;
		var parent_dni = document.getElementById('parent_dni').value;
		var child_number = document.getElementById('child_number').value;
		var telef = document.getElementById("phone").value;

		// referencia del padre | No cedulados
		if (document.getElementById("user_has_document").value != "Si") {
			var parent_ref = parent_dni + child_number;
			document.getElementById('parent_ref').value = parent_ref;
		} else {
			document.getElementById('parent_ref').value = "No aplica";
		}

		if ((dni.length < 6 || dni.length > 8) && user_has_document == 'Si') {
			alert("El documento de identidad debe tener al menos 6 números");
			$("#document_id").focus();
			// $("#document_id")[0].scrollIntoView();           
			return;
		}

		if (telef.length != "" && telef.length < 12) {
			alert("El número de teléfono no es válido");
			$("#phone").focus();
			return;
		}

		$('#cover-spin').show(0);
		this.submit();

	};
</script>


<div id="cover-spin"></div>

<div class="col-md-8">
	<span class='text_label'> <i class='fa fa-edit icon_label'></i> <b> Editar participante: <?php echo $part["name"] . " | Vinculado al usuario final con el código Nº: " . $part["id_user_final"]; ?></b> </span>
	<div class="card">

		<!-- <div class="col-md-6">
			<div class="form-group">
				<h4 for="name" class="control-label"><i class='fa fa-edit icon_label' ></i> <b><?php echo $part["id"]; ?></b> ID del participante</h4>
			</div>
		</div> -->

		<br><br>

		<div class="form-group">

			<div class="card-body">

				<form id="validar" class="form-horizontal" method="post" action="index.php?view=updateparticipants&pag=<?php echo $_GET["pag"]; ?>" role="form">
					<br>
					<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
					<input type="hidden" name="parent_ref" id="parent_ref" value="<?php echo $part["parent_ref"]; ?>">
					<input type="hidden" name="date_activity" id="date_activity" value="<?php echo $part["date_activity"]; ?>">
					<input type="hidden" name="id_user_final" id="id_user_final" value="<?php echo $part["id_user_final"]; ?>">
					<input type="hidden" name="id_activity" id="id_activity" value="<?php echo $part["id_activity"]; ?>">
					<input type="hidden" name="line_action" id="line_action" value="<?php echo $_GET['line_action']; ?>">



					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="name" class="control-label is-required"><i class="fa fa-user"></i> Primer nombre</label>
								<input type="text" name="name" id="name" required value="<?php echo $part["name"]; ?>" class="form-control" placeholder="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="name_2" class="control-label"><i class="fa fa-user"></i> Segundo nombre</label>
								<input type="text" name="name_2" id="name_2" value="<?php echo $part["name_2"]; ?>" class="form-control" placeholder="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname" class="control-label is-required"><i class="fa fa-user"></i> Primer apellido</label>
								<input type="text" name="lastname" id="lastname" required value="<?php echo $part["lastname"]; ?>" class="form-control" placeholder="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname_2" class="control-label"><i class="fa fa-user"></i> Segundo apellido</label>
								<input type="text" name="lastname_2" id="lastname_2" value="<?php echo $part["lastname_2"]; ?>" class="form-control" placeholder="">
							</div>
						</div>


						<div class="col-md-6">
							<label for="user_nationality" class="control-label is-required"><i class="fa fa-flag"></i> Nacionalidad</label>
							<select name="user_nationality" class="form-control" id="user_nationality" required>
								<option name="gender" id="user_nationality" required value="<?php echo $part["user_nationality"]; ?>"> <?php echo $part["user_nationality"]; ?></option>
								<option value="<?php echo "V"; ?>"><?php echo "V"; ?></option>
								<option value="<?php echo "E"; ?>"><?php echo "E"; ?></option>
							</select>
						</div>

						<div class="col-md-6">
							<label for="user_has_document" class="control-label is-required"><i class="fa fa-user-circle"></i> ¿Está cedulado?</label>
							<select name="user_has_document" id="user_has_document" class="form-control" required>
								<option value="<?php echo $part["user_has_document"]; ?>"><?php echo $part["user_has_document"]; ?></option>
								<option value="<?php echo "Si"; ?>">Si</option>
								<option value="<?php echo "No/Sin partida de nacimiento"; ?>">No/Sin partida de nacimiento</option>
								<option value="<?php echo "No/Menor de edad"; ?>">No/Menor de edad</option>
								<option value="<?php echo "No/Problemas en documentos"; ?>">No/Problemas en documentos</option>
								<option value="<?php echo "No/Pueblo originario"; ?>">No/Pueblo originario</option>
							</select>
						</div>

						<br>

						<div class="col-md-6">
							<div class="form-group">
								<label for="document_id" class="control-label is-required"><i class="fa fa-address-card"></i> Documento ID</label>
								<input type="number" name="document_id" id="document_id" required value="<?php echo $part["document_id"]; ?>" class="form-control" placeholder="" minlength="6" maxlength="8" placeholder="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 1) this.value = '',alert('El DNI no es válido');">
							</div>
						</div>

						<br>

						<!-- datos del padre para no cedulados -->
						<div class="col-md-6" id="parent_dni_div" style="display:none">
							<div class="form-group">
								<label for="parent_dni" class=" control-label" style="color:green;"><i class="fa fa-address-card"></i> DNI del representante (Solo no cedulados)</label>
								<input type="number" class="form-control" name="parent_dni" id="parent_dni" minlength="6" maxlength="8" value="<?php echo $part["parent_dni"]; ?>" placeholder="C.I del padre o madre" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 1) this.value = '',alert('El DNI no es válido');">
							</div>
						</div>

						<div class="col-md-6" id="child_number_div" style="display:none">
							<div class="form-group">
								<label for="child_number" class=" control-label" style="color:green;"><i class="fa fa-user-plus"></i> ¿Que posición de hijo tiene? (Ejemplo: el 1, 2, 3)</label>
								<input type="number" class="form-control" name="child_number" id="child_number" minlength="6" maxlength="8" value="<?php echo $part["child_number"]; ?>" placeholder="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = 0;">
							</div>
						</div>

						<div class="col-md-6" id="parent_ref_div" style="display:none">
							<div class="form-group">
								<label for="parent_ref" class=" control-label" style="color:green;"><i class="fa fa-address-book"></i> DNI Referencia (Para no cedulados)</label>
								<input type="text" class="form-control" name="parent_ref" id="parent_ref" readonly placeholder="DNI madre + posición del hijo" minlength="6" maxlength="8" value="<?php echo $part["parent_ref"]; ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="age" class="control-label is-required"><i class="fa fa-calendar"></i> Fecha de nacimiento</label>
								<input type="date" name="user_f_nacimiento" id="user_f_nacimiento" required value="<?php echo $part["user_f_nacimiento"]; ?>" class="form-control" placeholder="">
							</div>
						</div>



						<div class="col-md-6">
							<div class="form-group">
								<label for="email" class="control-label"><i class="fa fa-envelope"></i> Correo</label>
								<input type="email" name="email" id="email" value="<?php echo $part["email"]; ?>" class="form-control" placeholder="">
							</div>
						</div>

						<div class="col-md-6">
							<label for="gender" class="control-label is-required"><i class="fa fa-users"></i> Género</label>
							<select name="gender" class="form-control" id="gender" required>
								<option name="gender" id="gender" required value="<?php echo $part["gender"]; ?>"> <?php echo $part["gender"]; ?></option>
								<option value="Hombre"> Hombre </option>
								<option value="Mujer"> Mujer </option>
							</select>
						</div>

						<div class="col-md-6">
							<label class="is-required"><i class="fa fa-user"></i> Comunidad a la que pertenece</label>
							<select name="user_comunity_type" id="user_comunity_type" class="form-control" required>
								<option name="gender" id="gender" required value="<?php echo $part["user_comunity_type"]; ?>"> <?php echo $part["user_comunity_type"]; ?></option>
								<option value="<?php echo "Indígena" ?>"> <?php echo "Indígena" ?></option>
								<option value="<?php echo "Campesina" ?>"> <?php echo "Campesina" ?></option>
								<option value="<?php echo "Afrodescendiente" ?>"> <?php echo "Afrodescendiente" ?></option>
								<option value="<?php echo "Privado de Libertad" ?>"> <?php echo "Privado de Libertad" ?></option>
								<option value="<?php echo "No aplica" ?>"> <?php echo "No aplica" ?></option>
							</select>
						</div>

						<div class="col-md-6">
							<label class="is-required"><i class="fa fa-user"></i> Pertenece a Organización social</label>
							<select name="user_pertenece_organizacion" id="user_pertenece_organizacion" class="form-control" required>
								<option name="gender" id="gender" required value="<?php echo $part["user_pertenece_organizacion"]; ?>"> <?php echo $part["user_pertenece_organizacion"]; ?></option>
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
						</div>

						<br>

						<div class="col-md-6">
							<div class="form-group">
								<label for="phone" class="control-label"><i class="fa fa-phone"></i> Teléfono</label>
								<input type="tel" name="phone" id="phone" minlength="12" maxlength="12" value="<?php echo $part["phone"]; ?>" class="form-control" placeholder="">
							</div>
						</div>

						<div class="col-md-6">
							<label class="is-required"><i class="fa fa-user"></i> Pueblo indígena</label>
							<select name="user_etnia" id="user_etnia" class="form-control" required>
								<option value="<?php echo $part["etnia"]; ?>"><?php echo $part["etnia"]; ?></option>
								<?php foreach ($etnias as $name) : ?>
									<option value="<?php echo $name["name"]; ?>"> <?php echo $name["name"]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="col-md-6">
							<label for="disability_type" class="is-required"><i class="fa fa-wheelchair"></i> Discapacidad</label>
							<select name="disability_type" id="disability_type" class="form-control" required>
								<option value="<?php echo $part["disability_type"]; ?>"><?php echo $part["disability_type"]; ?></option>
								<?php foreach ($discapacidad as $name) : ?>
									<option value="<?php echo $name["disability"]; ?>"> <?php echo $name["disability"]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>


						<div class="col-md-6" id="profesion">
							<label for="user_profesion" class="control-label"><i class="fa fa-mortar-board"></i> Profesión</label>
							<select name="user_profesion" class="form-control" id="user_profesion">
								<option value="<?php echo $part["user_profesion"]; ?>"><?php echo $part["user_profesion"]; ?></option>
								<option value="Otra">Otra</option>
								<option value="Estudiante">Estudiante</option>
								<option value="Trabajo del hogar">Trabajo del hogar</option>
								<?php foreach ($professions as $name) : ?>
									<option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="col-md-6" id="ocupacion">
							<label for="user_ocupacion" class="control-label"><i class="fa fa-user"></i> Ocupación</label>
							<select name="user_ocupacion" class="form-control" id="user_ocupacion">
								<option value="<?php echo $part["user_ocupacion"]; ?>"><?php echo $part["user_ocupacion"]; ?></option>
								<option value="Otra">Otra</option>
								<option value="Estudiante">Estudiante</option>
								<option value="Trabajo del hogar">Trabajo del hogar</option>
								<?php foreach ($occupations as $name) : ?>
									<option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="user_estado" class="control-label"><i class="fa fa-map"></i> Estado</label>
								<select name="user_estado" class="form-control" id="user_estado">
									<option value="<?php echo $part["user_estado"]; ?>"><?php echo $part["user_estado"]; ?></option>
									<?php foreach ($estado as $p) : ?>
										<option value="<?php echo $p->estado; ?>"> <?php echo $p->estado; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-md-12 mui-select" id="equipo_sala_comunal_f" style="display:none">
							<select name="equipo_sala_comunal" id="equipo_sala_comunal">
								<option value="<?php echo $part["equipo_sala_comunal"]; ?>"><?php echo $part["equipo_sala_comunal"]; ?></option>
								<option value="<?php echo "Responsable de la Sala de Autogobierno" ?>"><?php echo "Responsable de la Sala de Autogobierno" ?></option>
								<option value="<?php echo "Secretario" ?>"><?php echo "Secretario" ?></option>
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
								<button type="submit" class="btn btn-primary btn-block">Guardar</button>
							</div>
						</div>

					</div>
				</form>
			</div>
		</div>


	</div>
</div>




<script language="javascript">
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
				document.getElementById("parent_dni_div").style.display = "block";
				document.getElementById("parent_ref_div").style.display = "block";
				document.getElementById("child_number_div").style.display = "block";
				document.getElementById("parent_dni").type = "number";
				// document.getElementById("parent_dni").required = true;
				// document.getElementById("child_number").required = true;
				// $("#document_id_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
				// document.getElementById("email").required = true;
				compareDni(' is-valid');
				if (getOS() == "Android") {
					alert('¡AVISO! si el campo (DNI del representante) está vacío, el sistema asignará un código');
				} else {
					toastify('¡AVISO! si el campo (DNI del representante) está vacío, el sistema asignará un código', true, 20000, "warning");
				}
			} else {
				document.getElementById("document_id").type = "number";
				document.getElementById("document_id").setAttribute('maxlength', 8);
				document.getElementById("document_id").value = dni;
				document.getElementById("document_id").readOnly = false;
				document.getElementById("document_id").classList.remove("is-valid");
				document.getElementById("parent_dni_div").style.display = "none";
				document.getElementById("child_number_div").style.display = "none";
				document.getElementById("parent_ref_div").style.display = "none";
				document.getElementById("parent_dni").required = false;
				document.getElementById("child_number").required = false;
				document.getElementById("parent_dni").type = "text";
				document.getElementById("parent_dni").value = "No aplica";
				document.getElementById("parent_ref").value = "No aplica";
				document.getElementById("child_number").value = "";
				// document.getElementById("email").required = false;
				// compareDni(' is-invalid');
			}
		})



		$("#document_id").on("keyup", function() {
			user_dni = $(this).val();
			var user_has_document = document.getElementById("user_has_document").value;
			clearTimeout(controladorTiempo);

			if (user_has_document == 'Si') {
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



<style>
	.is-required:after {
		content: '*';
		margin-left: 3px;
		color: red;
		font-weight: bold;
	}
</style>