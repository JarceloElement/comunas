<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();

$location = "index.php?view=infocentros";
if (isset($_GET['pag'])) {
	$pagination = $_GET["pag"];
} else {
	$pagination = "";
}

?>

<script type="text/javascript">
	// MODAL IMAGE POPUP
	function del_item(url) {
		Swal.fire({
			title: "\n¿Desea eliminar?",
			text: "¡Esto es irreversible! Podría afectar todos los datos que contengan éste código",
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


	$(function() {

		// anima la notificacion
		$(function() {
			<?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
				Swal.fire({
					// position: 'top-center',
					icon: 'success',
					title: '<?php echo $_GET['swal']; ?>',
					showConfirmButton: true,
					timer: 10500
				})
			<?php endif; ?>

		});

		// cambiar el parametro de alert
		const url = new URL(window.location);
		url.searchParams.set('swal', '');
		window.history.pushState({}, '', url);
		// fin - anima la notificacion




		$(document).on('click', 'button[type="obser_viewer"]', function(event) {
			$("#modal-header").html(this.value);
			$("#modal-body").html(this.id);
			$('#modal-secondary').modal('show');

			// Swal.fire({
			// 	title: this.id,
			// 	text: this.value,
			// 	width: 600,
			// 	// padding: '3em',
			// 	backdrop: `rgba(0,0,123,0.4)`,
			// })

		});


	});

	function uploadXLSX() {
		$('#cover-spin').show(0);
	}
</script>


<div id="cover-spin"></div>



<!-- VER OBSERVACIONES -->
<div class="modal fade" id="modal-secondary">
	<div class="modal-dialog">
		<!-- <div class="modal-content bg-primary"> -->
		<div class="modal-content">
			<div class="modal-header" id="modal-header">
				<h4 class="modal-title">Secondary Modal</h4>
			</div>
			<div class="modal-body" id="modal-body">
				<!-- One fine body -->
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx" method="POST" enctype="multipart/form-data" />
						<span class="btn btn-raised btn-round btn-default btn-file">
							<span class="fileinput-new">Select</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".xlsx" />
						</span>

						<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-default btn-block">
							Subir Archivo
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16">
								<path fill="currentColor" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252q.284.091.665.091q.507 0 .858-.158q.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.188-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15q-.336.149-.527.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326a.5.5 0 0 1-.085.29a.56.56 0 0 1-.255.193q-.168.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.249-.115a.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036z" />
							</svg>
						</button>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>

<?php } ?>



<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar infocentros</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">


							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="infocentros">


								<div class="form-group col-mg-4">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
														<path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
													</svg></i></span>
										</div>
										<label class="bmd-label-floating floating_icon">Palabra clave</label>
										<input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																				echo $_GET["q"];
																			} ?>" class="form-control">
									</div>
								</div>

								<div class="row">

									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
											<select name="estado" class="form-control" id="estados">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p): ?>
													<option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>



									<div class="col-lg-4">
										<div class="form-group">
											<span class="input-group-addon"><i class="fa fa-unlink"></i></span>
											<select name="operatividad" class="form-control">
												<option value="">OPERATIVIDAD</option>
												<?php foreach ($operative_info as $p): ?>
													<option value="<?php echo $p->operative_type; ?>"><?php echo $p->operative_type ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<span class="input-group-addon"><i class="fa fa-signal"></i></span>
											<select name="internet" class="form-control">
												<option value="">INTERNET</option>
												<?php foreach ($internet_type as $p): ?>
													<option value="<?php echo $p->type; ?>"><?php echo $p->type ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<span class="input-group-addon"><i class="fa fa-hourglass-2"></i></span>
											<select name="estatus" class="form-control">
												<option value="">ESTATUS</option>
												<?php foreach ($status_type as $p): ?>
													<option value="<?php echo $p->status; ?>"><?php echo $p->status ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>


									<div class="col-lg-4">
										<div class="form-group">
											<span class="input-group-addon"><i class="fa fa-cog"></i> Tipo de código (Gerencia)</span>
											<select name="cod_gerencia" class="form-control">
												<option value="">-SELECCIONE-</option>
												<option value="1">SI</option>
												<option value="0">NO</option>
											</select>
										</div>
									</div>



									<div class="col-lg-4">
										<div class="form-group">
											<button class="btn btn-primary btn-block">Buscar</button>
										</div>
									</div>

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

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
$q_info = isset($_GET['q']) ? trim(strtoupper($_GET['q'])) : "";
$users = array();
if ((isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["operatividad"]) || isset($_GET["internet"]) || isset($_GET["estatus"]) || isset($_GET["cod_gerencia"])) && ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "" || $_GET["internet"] != "" || $_GET["estatus"] != "" || $_GET["cod_gerencia"] != "")) {


	$sql = "SELECT * from infocentros where ";

	if ($_GET["q"] != "") {
		$sql .= " (nombre like '%$_GET[q]%' or estado like '%$_GET[q]%' or cod like '%$q_info%') ";
	}

	// filtra por regiones
	if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {


		if ($_SESSION["user_region"] == "Bolívar") {
			if ($_GET["q"] != "") {
				$sql .= " and ";
			}
			if ($_GET["estado"] == "") {
				$sql .= "(estado ='" . $_SESSION['user_region'] . "' or estado ='Guayana Esequiba') and";
			} else {
				$sql .= "(estado ='" . $_SESSION['user_region'] . "' or estado ='Guayana Esequiba')";
			}
		} else {
			if ($_GET["q"] != "") {
				$sql .= " and ";
			}
			if ($_GET["estado"] == "") {
				$sql .= "estado ='" . $_SESSION['user_region'] . "' and";
			} else {
				$sql .= "estado ='" . $_SESSION['user_region'] . "'";
			}
		}
	} else {
		if ($_GET["estado"] != "") {
			if ($_GET["q"] != "") {
				$sql .= " and ";
			}
			$sql .= " estado ='" . $_GET["estado"] . "'";
		}
	}

	if ($_GET["operatividad"] != "") {
		if ($_GET["q"] != "" || $_GET["estado"] != "") {
			$sql .= " and ";
		}

		$sql .= " estatus_op ='" . $_GET["operatividad"] . "'";
	}


	if ($_GET["internet"] != "") {
		if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "") {
			$sql .= " and ";
		}
		$sql .= " tecno_internet = '" . $_GET["internet"] . "'";
	}

	if ($_GET["estatus"] != "") {
		if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "" || $_GET["internet"] != "") {
			$sql .= " and ";
		}

		$sql .= " estatus ='" . $_GET["estatus"] . "'";
	}

	if ($_GET["cod_gerencia"] != "") {
		if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "" || $_GET["internet"] != "" || $_GET["estatus"] != "") {
			$sql .= " and ";
		}

		if ($_GET["cod_gerencia"] == "1") {
			$sql .= " cod_gerencia ='" . $_GET["cod_gerencia"] . "' ";
		}
		if ($_GET["cod_gerencia"] == "0") {
			$sql .= " (cod_gerencia ='" . $_GET["cod_gerencia"] . "' or cod_gerencia ='') ";
		}
	}


	if ($_GET["cod_gerencia"] == "1") {

		$sql_dw = "SELECT 
		i.cod,
		i.estado,
		i.nombre,
		i.municipio,
		i.direccion,
		i.perso_contacto,
		i.telef_contacto,
		i.f_instalacion,
		i.observacion,
		i.cod_gerencia,
		f.info_cod as faci_info_cod,
		f.name as faci_name,
		f.lastname as faci_lastname,
		f.document_number as faci_dni,
		f.phone_number as faci_phone,
		f.email as faci_email,
		f.gender as faci_gender,
		f.birthdate as faci_birthdate,
		f.date_admission as faci_date_admission,
		f.observations as faci_observations,
		u.username as user_username,
		u.id as UID,
		u.name as user_name,
		u.lastname as user_lastname,
		u.user_dni,
		u.email as user_email,
		u.gender as user_gender,
		u.rol as user_rol,
		u.user_type,
		u.is_active 
		from infocentros i 
		left join facilitators f on i.cod = f.info_cod 
		left join user u on i.cod = u.code_info 
		where";

		if ($_GET["q"] != "") {
			$sql_dw .= " (nombre like '%$_GET[q]%' or estado like '%$_GET[q]%' or cod like '%$_GET[q]%') ";
		}


		if ($_GET["estado"] != "") {
			if ($_GET["q"] != "") {
				$sql_dw .= " and ";
			}
			$sql_dw .= " i.estado ='" . $_GET["estado"] . "'";
		}

		if ($_GET["operatividad"] != "") {
			if ($_GET["q"] != "" || $_GET["estado"] != "") {
				$sql_dw .= " and ";
			}

			$sql_dw .= " i.estatus_op ='" . $_GET["operatividad"] . "'";
		}



		if ($_GET["internet"] != "") {
			if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "") {
				$sql_dw .= " and ";
			}

			$sql_dw .= " i.tecno_internet = '" . $_GET["internet"] . "'";
		}



		if ($_GET["estatus"] != "") {
			if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "" || $_GET["internet"] != "") {
				$sql_dw .= " and ";
			}

			$sql_dw .= " i.estatus ='" . $_GET["estatus"] . "'";
		}

		if ($_GET["cod_gerencia"] != "") {
			if ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["operatividad"] != "" || $_GET["internet"] != "" || $_GET["estatus"] != "") {
				$sql_dw .= " and ";
			}

			if ($_GET["cod_gerencia"] == "1") {
				$sql_dw .= " i.cod_gerencia ='" . $_GET["cod_gerencia"] . "' ";
			}
			if ($_GET["cod_gerencia"] == "0") {
				$sql_dw .= " (i.cod_gerencia ='" . $_GET["cod_gerencia"] . "' or cod_gerencia ='') ";
			}
		}

		$sql_download = $sql_dw . ' GROUP BY i.cod order by i.estado asc';
	}

	$param_csv = $sql;
	$param_sql = "true";
	// echo $param_csv ;

	$conn = DatabasePg::connectPg();
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$TotalReg = $stmt->rowCount();


	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$users = $data;

	// Asigna url de paginacion
	$url_pag = "<a href=\"?view=infocentros&q=" . $_GET["q"] . "&estado=" . $_GET["estado"] . "&operatividad=" . $_GET["operatividad"] . "&internet=" . $_GET["internet"] . "&estatus=" . $_GET["estatus"] . "&cod_gerencia=" . $_GET["cod_gerencia"] . "&pag=";
	$_SESSION["location"] = "q=" . $_GET["q"] . "&estado=" . $_GET["estado"] . "&operatividad=" . $_GET["operatividad"] . "&internet=" . $_GET["internet"] . "&estatus=" . $_GET["estatus"] . "&cod_gerencia=" . $_GET["cod_gerencia"] . "&pag=" . $compag;
} else {
	// $users = InfoData::getAll();
	$region = $_SESSION['user_region'];
	if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {
		if ($_SESSION["user_region"] == "Bolívar") {
			$sql = "SELECT * from infocentros WHERE (estado='$region' or estado ='Guayana Esequiba') order by cod asc ";
		} else {
			$sql = "SELECT * from infocentros WHERE estado='$region' order by cod asc ";
		}
	} else {
		$sql = "SELECT * from infocentros WHERE (cod_gerencia = '' or cod_gerencia = '0') order by cod asc ";
	}

	$param_csv = $sql;
	$param_sql = "true";

	$conn = DatabasePg::connectPg();
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$TotalReg = $stmt->rowCount();

	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);

	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$users = $data;

	$url_pag = "<a href=\"?view=infocentros&pag=";
	$_SESSION["location"] = "pag=" . $compag;
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
// echo $sql;
// echo $param_csv;
$DB_name = "infocentros";


?>



<?php if (count($users) > 0) { ?>

	<!-- si hay usuarios -->
	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<a href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
		<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>

		<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9): ?>
			<!-- <a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx.php?param=<?php echo $sql_download . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> Info de gerencia</a> -->
		<?php endif ?>

		<!-- <a href="./pdf/jspdf_info.php?param_pdf=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> </a> -->

		<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9): ?>
			<a href="./index.php?view=newinfocentro" class="btn btn-info">Agregar infocentro</a>
		<?php endif ?>
	</div>








	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="form-group">
							<div class="card-body">

								<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

									<!-- EDICION POR LOTES -->
									<form class="form-horizontal" role="form" method="post" action="./?action=ajax&function=update_info&location=<?php echo $location ?>" enctype="multipart/form-data">
										<input type="hidden" name="data_id" id="data_id" value="">
										<input type="hidden" name="pagination" id="pagination" value="<?php echo $pagination ?>">
										<!-- <div class="form-group"> -->
										<!-- <div class="col-lg-1">
											<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
										</div> -->
										<div class="row">

											<div class="col-lg-3">
												<div class="form-group">
													<span class="input-group-addon"><i class="fa fa-unlink"></i></span>
													<select name="operatividad" class="form-control">
														<option value="">OPERATIVIDAD</option>
														<?php foreach ($operative_info as $p): ?>
															<option value="<?php echo $p->operative_type; ?>"><?php echo $p->operative_type ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group">
													<span class="input-group-addon"><i class="fa fa-signal"></i></span>
													<select name="internet" class="form-control">
														<option value="">INTERNET</option>
														<?php foreach ($internet_type as $p): ?>
															<option value="<?php echo $p->type; ?>"><?php echo $p->type ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group">
													<span class="input-group-addon"><i class="fa fa-hourglass-2"></i></span>
													<select name="estatus" class="form-control">
														<option value="">ESTATUS</option>
														<?php foreach ($status_type as $p): ?>
															<option value="<?php echo $p->status; ?>"><?php echo $p->status ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>


											<div class="col-lg-3">
												<!-- <button class="btn btn-info btn-block"><i class="far fa-save"></i> Modificar</button> -->
											</div>

										</div>

									</form>
									<!-- END EDICION POR LOTES -->
									<br><br>
								<?php } ?>

								<div class="card-content table-responsive">
									<div class="card-body">

										<table class="table table-bordered table-hover">
											<!-- INONOS -->
											<thead>

												<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
													<th>
														<!-- Check all button -->
														<div class="mailbox-controls" style="text-align:center">
															<input type="checkbox" class="btn btn-default btn-sm checkbox-toggle"></input>
														</div>
													</th>
												<?php } ?>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-newspaper-o icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-gear icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-map-marker icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-signal icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-unlink icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-hourglass-2 icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-info icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-info icon_table"></i></th>
												<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
													<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
												<?php } ?>
												<?php if ($_SESSION["user_type"] == 8) { ?>
													<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
												<?php } ?>
											</thead>

											<thead>
												<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
													<th>TODO</th>
												<?php } ?>
												<th>COD</th>
												<th>Nombre</th>
												<th>Es gerencia</th>
												<th>Estado</th>
												<th>Internet</th>
												<th>Operat</th>
												<th>Estatus</th>
												<th>Motivo de cierre</th>
												<th>Observaciones</th>
												<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
													<th>Acciones</th>
												<?php } ?>
												<?php if ($_SESSION["user_type"] == 8) { ?>
													<th>Acciones</th>
												<?php } ?>
											</thead>

											<?php
											$count = 0;
											foreach ($users as $user) {
												$count = $count + 1;
											?>
												<tr>
													<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
														<td>
															<div class="edit" style="text-align:center">
																<input class="item-checkbox" type="checkbox" name="edit" value="<?php echo $user["id"]; ?>" id="<?php echo $count; ?>">
															</div>
														</td>
													<?php } ?>
													<td><?php echo $user["cod"]; ?></td>
													<td><?php echo $user["nombre"]; ?></td>
													<td><?php echo $user["cod_gerencia"]; ?></td>
													<td><?php echo $user["estado"]; ?></td>
													<td><?php echo $user["tecno_internet"]; ?></td>
													<td><?php echo $user["estatus_op"]; ?></td>
													<td><?php echo $user["estatus"]; ?></td>
													<td><?php echo $user["motivo_cierre"]; ?></td>

													<td>
														<?php if ($user["observacion"] != "" || $user["observacion"] != "N/A" || $user["observacion"] != "no aplica") { ?>
															<button type="obser_viewer" id="<?php echo $user["observacion"]; ?>" value="<?php echo $user["cod"]; ?>" class="btn btn-success btn-sm">Observaciones
																<button type="obser_viewer" id="<?php echo $user["observacion_tecnica"]; ?>" value="<?php echo $user["cod"]; ?>" class="btn btn-warning btn-sm">Obse. técnicas
																<?php } else { ?>
																	<button type="obser_viewer" id="<?php echo $user["observacion"]; ?>" value="<?php echo $user["cod"]; ?>" class="btn btn-secondary btn-sm">Observaciones
																		<button type="obser_viewer" id="<?php echo $user["observacion_tecnica"]; ?>" value="<?php echo $user["cod"]; ?>" class="btn btn-secondary btn-sm">Obse. técnicas
																		<?php } ?>
													</td>


													<?php if ($_SESSION["user_type"] != 10) { ?>
														<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9  || $_SESSION["user_type"] == 10) { ?>
															<td style="width:180px;">
																<a href="index.php?view=editinfocentro&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																			<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
																		</svg></i></a>
																<!-- <a href="index.php?action=delinfocentro&id=<!?php echo $user["id"]; ?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a> -->

																<?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
																	<?php $URL = "index.php?action=delinfocentro&id=" . $user["id"] . "&estado=" . $user["estado"] . "&pag=" . $compag; ?>
																	<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																				<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
																			</svg></i></button></a>
																<?php } ?>
															</td>
														<?php } ?>
													<?php } ?>

													<?php if ($_SESSION["user_type"] == 8 && $_SESSION["user_region"] == $user["estado"]) { ?>
														<td style="width:180px;">
															<a href="index.php?view=editinfocentro&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																		<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
																	</svg></i></a>
														</td>
													<?php } ?>

												</tr>
											<?php

											}
											?>
										</table>
									</div>
								</div>

							<?php
						} else {
							echo "<p class='alert alert-danger'>No hay infocentros</p>";
						}
							?>

							</div class="card-content table-responsive">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


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

		// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";
		echo $url_pag . $IncrimentNum . "\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


		?>

	</center>





	<script>
		$(function() {

			// Activa o desactiva las casillas por separado y guarda los ID en una array
			var array_item = [];
			var count_item = -1;
			$('.item-checkbox').click(function() {
				var clicks = $(this).data('clicks');
				var checkboxes = document.getElementsByName("edit");
				// alert($(this).val());

				if (clicks) {
					arr = array_item.indexOf($(this).val()); // busca la pos del valor en el array
					console.log(arr);

					count_item = count_item - 1
					array_item.splice(arr, 1); // elimina el valor de la pos | solo un valor
				} else {
					count_item = count_item + 1
					array_item[count_item] = $(this).val();
				}
				console.log(array_item);
				$(this).data('clicks', !clicks)
				document.getElementById("data_id").value = array_item;

			})


			$('.checkbox-toggle').click(function() {
				var clicks = $(this).data('clicks')
				var checkboxes = document.getElementsByName("edit");
				//   alert(clicks);

				if (clicks) {
					array_item = [];
					// alert(array_item);

					//Uncheck all checkboxes
					$('.edit input[type=\'checkbox\']').prop('checked', false)
					$('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
					// alert(document.getElementById("edit").value);
					console.log(array_item);

				} else {
					for (var i = 0; i < checkboxes.length; i++) {
						id = i + 1;
						array_item[i] = document.getElementById(id.toString()).value;
					}
					// alert(array_item);
					console.log(array_item);

					//Check all checkboxes
					$('.edit input[type=\'checkbox\']').prop('checked', true)
					$('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
				}
				$(this).data('clicks', !clicks)
				document.getElementById("data_id").value = array_item;

			})

		})
	</script>



	<style>
		.card .title {
			margin-top: 0;
			margin-bottom: 5px;
			margin-left: 10px;
			margin-right: -20px;
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