<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();

// echo strtoupper("ama05");


// $usersx = ParticipantsData::getAll();

// foreach($usersx as $user){

// // sacamos la fecha de inicio
// $date_pub_end = explode("/",$user->date_activity);
// $end = $date_pub_end[1] != "" ? $date_pub_end[1] : $date_pub_end[0];

// $date_ini_x = date_create($date_pub_end[0]);
// $date_end_x = date_create($end);
// $start_at_x = $date_ini_x->format('d-m-Y');
// $finish_at_x = $date_end_x->format('d-m-Y');

// $new_date = $start_at_x."/".$finish_at_x;
// echo $new_date;
// $db = Database::getCon();
// $statement_1 = $db->query("UPDATE participants_list SET date_activity = '".$new_date."' where id='".$user->id."' ");

// }

?>


<script src="assets/js/jquery.min.js" type="text/javascript"></script>




<!-- MODAL IMAGE POPUP -->
<script>
	$('#cover-spin').show(0);

	$(document).ready(function() {
		$('#cover-spin').hide(0);
	});


	function add_viewer(comp) {
		let id = comp.id;

		$.post("core/app/view/image_viewer.php", {
			id: id
		}, function(data) {
			$("#modal-body").html(data);
			$('#myModal').modal('show');

			//   alert("-"+id+"-");
			//   console.log(id);

		});
	}







	$(function() {
		if ('<?php echo $_GET['swal']; ?>' != "") {
			Swal.fire({
				icon: 'success',
				title: '<?php echo $_GET['swal']; ?>',
				showConfirmButton: false,
				timer: 1500
			})
		};

		// cambiar el parametro de alert
		const url = new URL(window.location);
		url.searchParams.set('swal', '');
		window.history.pushState({}, '', url);


		$(document).on('click', 'button[type="image_viewer"]', function(event) {
			let id = this.id;
			// $(window).scrollTop(0);
			window.scrollTo({
				top: 100,
				left: 100,
				behavior: 'smooth'
			});
			// document.location.href = "#top";

			$.post("core/app/view/image_viewer.php", {
				id: id
			}, function(data) {
				$("#modal-body").html(data);
				$('#myModal').modal('show');
				$('.modal,.notice').fadeIn(200, function() {});

				// $(window).scrollTop(0);
				// window.scrollTo({ top: 0, behavior: 'smooth' });

				//   alert("-"+id+"-");
				//   console.log(id);
				// console.log("Se presionó el Boton con Id :"+ id)

			});


		});
	});



	(function smoothscroll() {
		var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
		if (currentScroll > 0) {
			window.requestAnimationFrame(smoothscroll);
			window.scrollTo(0, currentScroll - (currentScroll / 5));
		}
	})();














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
				<!-- <li class="nav-item">

					<form action="index.php?view=import_xlsx_participants" method="POST" enctype="multipart/form-data" />
					<span class="btn btn-raised btn-round btn-default btn-file">
						<span class="fileinput-new"></span>
						<span class="fileinput-exists"></span>
						<input type="file" name="info_process" id="file-input" class="file-input__input" accept=".xlsx" />
						<input type="hidden" name="os" id="os" value="" />
					</span>
					<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-info"><i class="far fa-file"></i> Subir Archivo XLSX</button>
					</form>

				</li> -->

			</div>
		</div>
	</center>


<?php } ?>






<!-- <input type="button" value="Abrir modal" name="registrar" id="image_viewer" class="registrar" tabindex="8" /> -->

<!-- MODAL IMAGE POPUP -->
<div class="modal fullscreen-modal fade" id="myModal" role="dialog">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="modal-body" id="modal-body">

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>

</div>




<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="title text-left">Participantes de actividades</h4>
						<!-- <p class="card-category">Complete your profile</p> -->


						<!-- <div class="row-md-4">
							<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-info btn-block"><i class="far fa-file"></i> Subir Archivo XLSX</button>
						</div> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="participants">

								<div class="form-group">
									<div class="row">

										<div class="col-md-4">
											<div class="col-md-12 mui-textfield mui-textfield--float-label">
												<input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																						echo $_GET["q"];
																					} ?>">
												<label><i class="fa fa-search"></i> Palabra clave</label>
											</div>
										</div>

										<div class="col-md-4">
											<div class="col-md-12 mui-textfield mui-textfield--float-label">
												<input type="text" name="code_info" value="<?php if (isset($_GET["code_info"]) && $_GET["code_info"] != "") {
																								echo $_GET["code_info"];
																							} ?>">
												<label><i class="fa fa-search"></i> Código info</label>
											</div>
										</div>

										<div class="col-md-4">
											<div class="col-md-12 mui-textfield mui-textfield--float-label">
												<input type="text" name="user_id" value="<?php if (isset($_GET["user_id"]) && $_GET["user_id"] != "") {
																								echo $_GET["user_id"];
																							} ?>">
												<label><i class="fa fa-search"></i> UID</label>
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


									</div>





									<div class="form-group ">
										<div class="form-group">
											<label>Filtrar por la fecha de la actividad</label>
										</div>
										<div class="row">

											<div class="col">
												<div class="input-group-prepend">
													<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																<path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
															</svg></i> </span> Desde
												</div>
												<input type="date" name="start_at" value="<?php if (isset($_GET["start_at"]) && $_GET["start_at"] != "") {
																								echo $_GET["start_at"];
																							} ?>" class="form-control">
											</div>


											<div class="col">
												<div class="input-group-prepend">
													<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																<path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
															</svg></i> </span> Hasta
												</div>
												<input type="date" name="finish_at" value="<?php if (isset($_GET["finish_at"]) && $_GET["finish_at"] != "") {
																								echo $_GET["finish_at"];
																							} ?>" class="form-control">
											</div>

										</div>
									</div>


									<div class="form-group ">
										<div class="form-group">
											<label>Filtrar por la fecha de carga del participante</label>
										</div>
										<div class="row">

											<div class="col">
												<div class="input-group-prepend">
													<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																<path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
															</svg></i> </span> Desde
												</div>
												<input type="datetime-local" name="start_at_1" value="<?php if (isset($_GET["start_at_1"]) && $_GET["start_at_1"] != "") {
																											echo $_GET["start_at_1"];
																										} ?>" class="form-control">
											</div>


											<div class="col">
												<div class="input-group-prepend">
													<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																<path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
															</svg></i> </span> Hasta
												</div>
												<input type="datetime-local" name="finish_at_1" value="<?php if (isset($_GET["finish_at_1"]) && $_GET["finish_at_1"] != "") {
																											echo $_GET["finish_at_1"];
																										} ?>" class="form-control">
											</div>

										</div>
									</div>


									<div class="form-group">
										<div class="row">

											<div class="col-md-6">
												<div class="form-group col-mg-3">
													<div class="col-md-12 mui-textfield mui-textfield--float-label">
														<input type="text" name="min_age" value="<?php if (isset($_GET["min_age"]) && $_GET["min_age"] != "") {
																										echo $_GET["min_age"];
																									} ?>">
														<label><i class="fa fa-search"></i> Edad mínima</label>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group col-mg-3">
													<div class="col-md-12 mui-textfield mui-textfield--float-label">
														<input type="text" name="max_age" value="<?php if (isset($_GET["max_age"]) && $_GET["max_age"] != "") {
																										echo $_GET["max_age"];
																									} ?>">
														<label><i class="fa fa-search"></i> Edad máxima</label>
													</div>
												</div>
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

$CantidadMostrar = 30;
$url_pag_atras = "";
$url_pag_adelante = "";
$TotalRegistro = 0;
$TotalReg = 0;

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
$pag = isset($_GET['pag']) ? $_GET['pag'] : "";
$q = isset($_GET['q']) ? $_GET['q'] : "";
$code_info_q = isset($_GET['code_info']) ? $_GET['code_info'] : "";
$linea_accion_q = isset($_GET['linea_accion']) ? $_GET['linea_accion'] : "";
$start_at_q = isset($_GET['start_at']) ? $_GET['start_at'] : "";
$finish_at_q = isset($_GET['finish_at']) ? $_GET['finish_at'] : "";
$start_at_1_q = isset($_GET['start_at']) ? $_GET['start_at_1'] : "";
$finish_at_1_q = isset($_GET['finish_at']) ? $_GET['finish_at_1'] : "";

$estado_q = isset($_GET['estado']) ? $_GET['estado'] : "";
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";
$min_age = isset($_GET['min_age']) ? $_GET['min_age'] : "";
$max_age = isset($_GET['max_age']) ? $_GET['max_age'] : "";

$info_id = "";
$start_at = "";
$finish_at = "";

if ($code_info_q != "") {
	$code_info_q = trim(strtoupper($code_info_q));
	$conn = DatabasePg::connectPg();
	$row = $conn->prepare("SELECT * FROM infocentros WHERE cod='$code_info_q'");
	$row->execute();
	$data = $row->fetchAll(PDO::FETCH_ASSOC)[0];
	$info_id = isset($data["id"]) ? $data["id"] : "0";
}


$date_ini = date_create(isset($_GET["start_at"]) ? $_GET["start_at"] : "0000-00-00");
$start_at = $date_ini->format('Y-m-d');

$date_end = date_create(isset($_GET["finish_at"]) ? $_GET["finish_at"] : "0000-00-00");
$finish_at = $date_end->format('Y-m-d');


$date_ini_1 = date_create(isset($_GET["start_at_1"]) ? $_GET["start_at_1"] : "0000-00-00 00:00:00");
$date_end_1 = date_create(isset($_GET["finish_at_1"]) ? $_GET["finish_at_1"] : "0000-00-00 00:00:00");
$start_at_1 = $date_ini_1->format('Y-m-d H:i:s');
$finish_at_1 = $date_end_1->format('Y-m-d H:i:s');


$user_region = $_SESSION["user_region"];
$user_code_info = $_SESSION['user_code_info'];
$users = array();


if ((isset($_GET["q"]) || isset($_GET["start_at_1"]) || isset($_GET["finish_at_1"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["estado"]) || isset($_GET["user_id"]) || isset($_GET["linea_accion"]) || isset($_GET["code_info"]) || isset($_GET["max_age"]) || isset($_GET["min_age"])) && ($_GET["q"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["start_at_1"] != "" || $_GET["finish_at_1"] != "" || $_GET["code_info"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "" || $_GET["max_age"] != "" || $_GET["min_age"] != "")) {

	$sql = "SELECT 
	participants_list.id, 
	reports.user_id, 
	reports.date_ini, 
	participants_list.uid_fac, 
	participants_list.id_activity, 
	reports.line_action, 
	reports.report_type, 
	reports.specific_action, 
	reports.training_type, 
	reports.tipo_taller, 
	reports.training_level, 
	reports.training_modality, 
	participants_list.report_type, 
	reports.activity_title as name_activity, 
	reports.date_pub as date_activity, 
	participants_list.estate, 
	participants_list.info_id, 
	participants_list.code_info, 
	participants_list.name, 
	participants_list.name_2, 
	participants_list.lastname, 
	participants_list.lastname_2, 
	participants_list.user_nationality, 
	participants_list.user_has_document, 
	participants_list.document_id, 
	participants_list.parent_ref, 
	participants_list.user_f_nacimiento,
	participants_list.age, 
	participants_list.gender, 
	participants_list.phone, 
	participants_list.email, 
	participants_list.etnia, 
	participants_list.disability_type, 
	final_users.user_nivel_academ, 
	final_users.user_profesion, 
	final_users.user_ocupacion, 
	final_users.user_empleado, 
	final_users.user_institucion, 
	participants_list.date_reg, 
	participants_list.equipo_sala_comunal, 
	reports.id as idact 
	from participants_list 
	INNER JOIN reports on (participants_list.id_activity)::int = (reports.id)::int 
	LEFT JOIN final_users on (participants_list.id_user_final)::int = (final_users.id)::int 
	where";

	if ($q != "") {
		$sql .= " (reports.line_action='$_GET[q]' or participants_list.parent_ref='$_GET[q]' or participants_list.estate='$_GET[q]' or participants_list.name like '%$_GET[q]%' or participants_list.document_id='$_GET[q]' or participants_list.gender='$_GET[q]' or participants_list.name_activity like '%$_GET[q]%') ";
	}


	if ($user_id != "") {
		if ($q != "") {
			$sql .= " and ";
		}
		$sql .= " reports.user_id = '" . $user_id . "' ";
	}


	if ($info_id != "") {
		if ($q != "" || $user_id != "") {
			$sql .= ' and ';
		}
		$sql .= " participants_list.info_id='" . $info_id . "'";
	}



	if ($_GET["linea_accion"] != "") {
		if ($q != "" or $_GET["code_info"] != "" or $user_id != "") {
			$sql .= ' and ';
		}

		if ($_GET["linea_accion"] == "Comunidades de participación digital") {
			$sql .= " (reports.line_action='Medios digitales' or reports.line_action='Infocentro adentro' or reports.line_action='Participación digital' or reports.line_action='Sistematización de Experiencias' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}
		else if ($_GET["linea_accion"] == "Comunidades de aprendizaje") {
			$sql .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}
		else if ($_GET["linea_accion"] == "Medios digitales") {
			$sql .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}
		else if ($_GET["linea_accion"] == "Acceso abierto") {
			$sql .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
		}else{
			$sql .= " (reports.line_action='" . $_GET["linea_accion"] . "')";
		}
	}



	// solo admin visualiza la data nacional
	if ($_GET["estado"] != "" && ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6)) {
		if ($_GET["q"] != "" or $user_id != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
		}
		$sql .= " reports.estate='" . $_GET["estado"] . "'";
	} else if ($_GET["estado"] != "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 6)) {
		if ($_GET["q"] != "" or $user_id != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
	} else if ($_GET["estado"] == "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
		if ($_GET["q"] != "" or $user_id != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
	}


	// print_r($sql);


	if ($start_at_q != "" and $finish_at_q != "") {
		if ($q != "" || $_GET["code_info"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "") {
			$sql .= " and ";
		}
		// $sql .= " to_date(left(participants_list.date_activity,10), 'DD-MM-YYYY') BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
		$sql .= " (reports.date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "')";
	}

	if ($start_at_q != "" and $finish_at_q == "") {
		if ($q != "" || $_GET["code_info"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "") {
			$sql .= ' and ';
		}
		// $sql .= " to_date(left(participants_list.date_activity,10), 'DD-MM-YYYY')>=to_date('" . $start_at . "','DD-MM-YYYY')";
		$sql .= " reports.date_ini >= '" . $start_at . "'";
	}

	// filtro por fecha de carga de los participantes
	if ($start_at_1_q != "" and $finish_at_1_q != "") {
		if ($q != "" || $linea_accion_q != "" || $estado_q != "" || $user_id != "" || $info_id != "" || $start_at_q != "" || $finish_at_q != "") {
			$sql .= ' and ';
		}
		$sql .= " ( participants_list.date_reg BETWEEN '" . $start_at_1 . "' and '" . $finish_at_1 . "' ) ";
	}

	if ($start_at_1_q != "" and $finish_at_1_q == "") {
		if ($q != "" || $linea_accion_q != "" || $estado_q != "" || $user_id != "" || $info_id != "" || $start_at_q != "" || $finish_at_q != "") {
			$sql .= ' and ';
		}
		$sql .= " (participants_list.date_reg >='" . $start_at_1 . "')";
	}

	if ($min_age != "") {
		if ($q != "" || $linea_accion_q != "" || $estado_q != "" || $user_id != "" || $info_id != "" || $start_at_q != "" || $finish_at_q != "" || $start_at_1_q != "" || $start_at_1_q != "") {
			$sql .= ' and ';
		}
		$sql .= " (participants_list.age)::int>=" . $min_age;
	}

	if ($max_age != "") {
		if ($q != "" || $linea_accion_q != "" || $estado_q != "" || $user_id != "" || $info_id != "" || $start_at_q != "" || $finish_at_q != "" || $start_at_1_q != "" || $start_at_1_q != "" || $min_age != "") {
			$sql .= ' and ';
		}
		$sql .= " (participants_list.age)::int<=" . $max_age;
	}


	// echo $sql;
	// return;

	// Busca el total de registros segun parametros de consulta
	$total = ParticipantsData::getBySQL($sql . " order by reports.date_ini desc");



	$TotalReg = $total[1];

	$sql .= " order by reports.date_ini desc";
	$param_csv = $sql;
	$param_xlsx = $sql;

	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = ParticipantsData::getBySQL($sql);


	// Asigna url de paginacion
	// $url_pag = "<a href=\"?view=participants&q=".$_GET["q"]."&start_at=&finish_at=&pag=";
	$url_pag = "<a href=\"?view=participants&q=" . $q . "&code_info=" . $code_info_q . "&user_id=" . $user_id . "&estado=" . $estado_q . "&linea_accion=" . $linea_accion_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&start_at_1=" . $start_at_1_q . "&finish_at_1=" . $finish_at_1_q . "&pag=";
	$param_sql = "true";
} else {

	if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
		$total_sql = "SELECT 
		participants_list.id, 
		participants_list.id_user_final, 
		participants_list.uid_fac, 
		participants_list.id_activity, 
		participants_list.line_action, 
		participants_list.report_type, 
		participants_list.name_activity, 
		participants_list.date_activity, 
		participants_list.estate, 
		participants_list.code_info, 
		participants_list.name, 
		participants_list.name_2, 
		participants_list.lastname, 
		participants_list.lastname_2, 
		participants_list.user_nationality, 
		participants_list.user_has_document, 
		participants_list.document_id, 
		participants_list.parent_ref, 
		participants_list.user_f_nacimiento, 
		participants_list.age, 
		participants_list.gender, 
		participants_list.phone, 
		participants_list.email, 
		participants_list.etnia, 
		participants_list.disability_type,
		final_users.user_nivel_academ, 
		final_users.user_profesion, 
		final_users.user_ocupacion, 
		final_users.user_empleado, 
		final_users.user_institucion,
		participants_list.date_reg, 
		reports.id as idact, 
		reports.specific_action, 
		reports.training_type, 
		reports.tipo_taller, 
		reports.training_level, 
		reports.training_modality 
		from participants_list 
		INNER JOIN reports on participants_list.id_activity = reports.id 
		LEFT JOIN final_users on (participants_list.id_user_final)::int  = final_users.id 
		where (split_part(participants_list.date_activity, '/',1)>='01-01-2023') 
		order by participants_list.date_reg desc";
	} else {
		$total_sql = "SELECT 
		participants_list.id, 
		participants_list.id_user_final, 
		participants_list.uid_fac, 
		participants_list.id_activity, 
		participants_list.line_action, 
		participants_list.report_type, 
		participants_list.name_activity, 
		participants_list.date_activity, 
		participants_list.estate, 
		participants_list.code_info, 
		participants_list.name, 
		participants_list.name_2, 
		participants_list.lastname, 
		participants_list.lastname_2, 
		participants_list.user_nationality, 
		participants_list.user_has_document, 
		participants_list.document_id, 
		participants_list.parent_ref, 
		participants_list.user_f_nacimiento, 
		participants_list.age, 
		participants_list.gender, 
		participants_list.phone, 
		participants_list.email, 
		participants_list.etnia, 
		participants_list.disability_type,
		final_users.user_nivel_academ, 
		final_users.user_profesion, 
		final_users.user_ocupacion, 
		final_users.user_empleado, 
		final_users.user_institucion, 
		participants_list.date_reg, 
		reports.id as idact,
		reports.specific_action, 
		reports.training_type, 
		reports.tipo_taller, 
		reports.training_level, 
		reports.training_modality
		from participants_list 
		INNER JOIN reports on participants_list.id_activity = reports.id 
		LEFT JOIN final_users on (participants_list.id_user_final)::int  = final_users.id 
		where reports.estate='" . $_SESSION["user_region"] . "' and (split_part(participants_list.date_activity, '/',1)>='01-01-2023') 
		order by participants_list.date_reg desc";
	}


	$total_sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	// echo $total_sql;
	$users = ParticipantsData::getBySQL($total_sql);
	$TotalReg = $users[1];


	if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {

		// total aproximado con pg_class
		$base = new DatabasePg();
		$conn = $base->connectPg();
		$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'participants_list'");
		$row_table->execute();
		$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $total_data[0]["reltuples"];
		// $TotalReg = 1000;
	}



	$url_pag = "<a href=\"?view=participants&q=" . $q . "&code_info=" . $code_info_q . "&user_id=" . $user_id . "&estado=" . $estado_q . "&linea_accion=" . $linea_accion_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&start_at_1=" . $start_at_1_q . "&finish_at_1=" . $finish_at_1_q . "&pag=";

	$param_csv = $total_sql;
	$param_xlsx = $total_sql;
	$param_sql = "true";
}

//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
// $TotalRegistro  =ceil(1000/$CantidadMostrar);
if ($TotalReg > 0) {
	$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
} else {
	$TotalRegistro  = 0;
}
// echo $sql;
// echo $param_csv;
$DB_name = "participants_list";


?>




<?php if (count($users[0]) > 0) { ?>
	<!-- si hay usuarios -->
	<div class="col-md-12">

		<?php if ($TotalReg > 0) { ?>
			<div class="form-group text_label">
				<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros</b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
			</div>
		<?php } ?>


		<a target="_blank" href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
		<!-- <a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a> -->
		<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<!-- <a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_3.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a> -->
		<!-- <a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_4.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a> -->
		<!-- <a target="_blank" href="./pdf/jspdf_part.php?param_pdf=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> </a> -->
		<!-- <a href="./pdf/jspdf.php" name="Descargar" class=" btn btn-default "><i class="fa fa-file-pdf-o"></i> </a> -->

	</div>




	<div class="col-md-12">
		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">
					<table class="table table-bordered table-hover">
						<!-- INONOS -->
						<thead>
							<th class="text_label "> <i class="fa fa-check icon_table"></i></th>
							<!-- <th class="text_label " > <i class="fa fa-gear icon_table" ></i></th> -->
							<th class="text_label "> <i class="fa fa-user icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-calendar-check-o icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-calendar-check-o icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-map-marker icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-building icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-list icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-user icon_table"></i></th>
							<!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-user icon_table" ></i></th> -->
							<th class="text_label "> <i class="fa fa-list-alt icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-list-alt icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-calendar icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-male icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-phone icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
						</thead>

						<!-- TITULOS -->
						<thead>
							<th> ID-Act</th>
							<!-- <th> UID_Act</th> -->
							<th> UID_Fac</th>
							<th> Fecha act.</th>
							<th> Fecha carga</th>
							<th> Estado</th>
							<th> Código-Info</th>
							<th> Línea de A.</th>
							<th> Actividad</th>
							<th> Participante</th>
							<th> Documento ID</th>
							<th> Código ref.</th>
							<th> Edad</th>
							<th> Género</th>
							<th> Teléfono</th>
							<th> Acciones</th>
						</thead>

						<?php


						$total_fem = 0;
						$total_mas = 0;
						$var_count = 0;

						foreach ($users[0] as $user) {
							// sacamos la fecha de inicio
							$date_pub_end = explode("/", $user["date_activity"]);
							if (count($date_pub_end) > 1) {
								$date_activity = $date_pub_end[0];
							} else {
								$date_activity = $user["date_activity"];
							}

							$var_count += 1;
						?>
							<tr>
								<!-- <td><!?php echo $var_count; ?></td> -->
								<td><?php echo $user["idact"]; ?></td>
								<!-- <td><!?php echo $user["user_id"]; ?></td> -->
								<td><?php echo $user["uid_fac"]; ?></td>
								<td><?php echo date("d/M/Y", strtotime($date_activity)); ?></td>
								<td><?php echo date("d/M/Y h:i", strtotime($user["date_reg"])); ?></td>

								<td><?php echo $user["estate"]; ?></td>
								<td><?php echo $user["code_info"]; ?></td>
								<td><?php echo $user["training_type"]; ?></td>
								<td><?php echo $user["name_activity"]; ?></td>

								<td><?php echo $user["name"] . " " . $user["lastname"]; ?></td>
								<td><?php echo $user["document_id"]; ?></td>
								<td><?php echo $user["parent_ref"]; ?></td>
								<td><?php echo $user["age"]; ?></td>
								<td><?php echo $user["gender"]; ?></td>
								<td><?php echo $user["phone"]; ?></td>


								<td style="width:80px;">

									<?php $url_edit = "q=" . $q . "&code_info=" . $code_info_q . "&user_id=" . $user_id . "&estado=" . $estado_q . "&linea_accion=" . $linea_accion_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&start_at_1=" . $start_at_1_q . "&finish_at_1=" . $finish_at_1_q; ?>
									<?php $_SESSION["section"] = "participants"; ?>
									<?php $_SESSION["location"] = "?view=participants&" . $url_edit; ?>

									<?php if ($_SESSION["user_type"] != 10) { ?>
										<?php if ($_SESSION["user_id"] == $user["uid_fac"]) { ?>
											<a href="index.php?view=editparticipants&id=<?php echo $user["id"]; ?>&id_activity=<?php echo $user["id_activity"]; ?>&code_info=<?php echo $user["code_info"]; ?>&pag=<?php echo $pag; ?>" class="btn btn-warning btn-sm">Editar</a>
										<?php } elseif ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
											<a href="index.php?view=editparticipants&id=<?php echo $user["id"]; ?>&id_activity=<?php echo $user["id_activity"]; ?>&code_info=<?php echo $user["code_info"]; ?>&pag=<?php echo $pag; ?>" class="btn btn-warning btn-sm">Editar</a>
										<?php } ?>
									<?php } ?>
								</td>

							</tr>

						<?php } ?>

					</table>


				<?php
			} else {
				echo "<p class='alert alert-danger'>No hay participantes</p>";
			}
				?>

				</div>
			</div class="card-content table-responsive">
		</div>
	</div>
	<!-- fin tabla con lista de registros -->

	<?php if (count($users[0]) > 0) { ?>

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

			echo $url_pag . $IncrimentNum . "\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


			?>

		</center>


	<?php } ?>







	<style>
		.title {
			margin-top: 0;
			margin-bottom: 5px;
			margin-left: 10px;
			margin-right: -20px;
		}

		.card {
			font-size: 14px;
			margin: 15px 0;
		}

		h5,
		.h5 {
			font-size: 1.0em;
			line-height: 1.0em;
			margin-bottom: 15px;
		}

		.icon_table {
			font-size: 24px;
			color: #585858;
			margin-right: 10px;

		}







		.table>thead>tr>th {
			border-bottom-width: 1px;
			font-size: 0.8em;
			font-weight: 400;
			/* width: 50%; */

		}



		.table>thead>tr>th,
		.table>tbody>tr>th,
		.table>tfoot>tr>th,
		.table>thead>tr>td,
		.table>tbody>tr>td,
		.table>tfoot>tr>td {
			padding: 5px 5px;
			vertical-align: middle;
		}
	</style>