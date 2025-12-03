<?php
$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();

// echo strtoupper("ama05");
?>


<script src="assets/js/jquery.min.js" type="text/javascript"></script>




<!-- MODAL IMAGE POPUP -->
<script>
	$(function() {
		// alert('<!?php echo $_GET['swal']; ?>');
		if ('<?php echo $_GET['swal']; ?>' != "") {
			Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '<?php echo $_GET['swal']; ?>',
				showConfirmButton: false,
				timer: 1500
			})
		};




	});
</script>








<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="title text-left">Productos de actividades</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="products">

								<div class="form-group">
									<div class="row">

										<div class="col">
											<div class="form-group col-mg-4">
												<div class="col-md-12 mui-textfield mui-textfield--float-label">
													<input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																							echo $_GET["q"];
																						} ?>">
													<label><i class="fa fa-search"></i> Palabra clave</label>
												</div>
											</div>
										</div>

										<div class="col">
											<div class="form-group col-mg-4">
												<div class="col-md-12 mui-textfield mui-textfield--float-label">
													<input type="text" name="info_id" value="<?php if (isset($_GET["info_id"]) && $_GET["info_id"] != "") {
																									echo $_GET["info_id"];
																								} ?>">
													<label><i class="fa fa-search"></i> Código info</label>
												</div>
											</div>
										</div>

										<div class="col">
											<div class="form-group col-mg-4">
												<div class="col-md-12 mui-textfield mui-textfield--float-label">
													<input type="text" name="user_id" value="<?php if (isset($_GET["user_id"]) && $_GET["user_id"] != "") {
																									echo $_GET["user_id"];
																								} ?>">
													<label><i class="fa fa-search"></i> UID</label>
												</div>
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


								</div>

								<div class="form-group ">
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

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
$pag = isset($_GET['pag']) ? $_GET['pag'] : "";
$q = isset($_GET['q']) ? $_GET['q'] : "";
$linea_accion_q = isset($_GET['linea_accion']) ? $_GET['linea_accion'] : "";
$start_at_q = isset($_GET['start_at']) ? $_GET['start_at'] : "";
$finish_at_q = isset($_GET['finish_at']) ? $_GET['finish_at'] : "";
$estado_q = isset($_GET['estado']) ? $_GET['estado'] : "";
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";
$code_info = isset($_GET["info_id"]) ? $_GET["info_id"] : "";
$info_id = "";
$TotalReg = 0;

if ($code_info != "") {
	$code_info = trim(strtoupper($code_info));
	$conn = DatabasePg::connectPg();
	$row = $conn->prepare("SELECT * FROM infocentros WHERE cod='$code_info'");
	$row->execute();
	$data = $row->fetchAll(PDO::FETCH_ASSOC)[0];
	$info_id = isset($data["id"]) ? $data["id"] : "0";
}


$date_ini = "";
$date_end = "";
$start_at = "";
$finish_at = "";

if (isset($_GET["start_at"]) && isset($_GET["finish_at"])) {
	$date_ini = date_create($_GET["start_at"]);
	$date_end = date_create($_GET["finish_at"]);
	$start_at = $date_ini->format('Y-m-d');
	$finish_at = $date_end->format('Y-m-d');
}



$users = array();
if ((isset($_GET["q"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["info_id"]) || isset($_GET["linea_accion"]) || isset($_GET["estado"]) || isset($_GET["user_id"]) || isset($_GET["info_id"])) && ($_GET["q"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "" || $_GET["info_id"] != "")) {

	$sql = "SELECT 
	";
	$fields = "
	reports.user_id, 
	products_list.id, 
	products_list.id_activity, 
	products_list.date, 
	products_list.estate, 
	products_list.info_id, 
	products_list.code_info, 
	reports.line_action,
	reports.date_ini,  
	reports.report_type, 
	reports.activity_title, 
	reports.datetime, 
	products_list.action_performed, 
	products_list.format, 
	products_list.format_detail, 
	products_list.quantity_created, 
	products_list.quantity_published, 
	products_list.doc_tipo,
	products_list.red_creada,
	products_list.formulario_url,
	products_list.video_url,
	products_list.doc_name,
	products_list.date_reg";
	$sql .= $fields;
	$sql .= " from products_list 
	INNER JOIN reports on products_list.id_activity = reports.id where";



	if ($_GET["q"] != "") {
		$sql .= " (products_list.activity_title like '%$_GET[q]%' or products_list.action_performed like '%$_GET[q]%' or products_list.date like '%$_GET[q]%' or  products_list.format like '%$_GET[q]%' or products_list.format_detail like '%$_GET[q]%' ) ";
	}

	if ($info_id != "") {
		if ($_GET["q"] != "") {
			$sql .= ' and ';
		}
		$sql .= " products_list.info_id='" . $info_id . "'";
	}

	if ($_GET["user_id"] != "") {
		if ($_GET["info_id"] != "" or $_GET["q"] != "") {
			$sql .= " and ";
		}
		$sql .= " reports.user_id = '" . $_GET['user_id'] . "' ";
	}

	if ($_GET["linea_accion"] != "") {
		if ($_GET["q"] != "" or $_GET["info_id"] != "" or $_GET["user_id"] != "") {
			$sql .= ' and ';
		}

		if ($_GET["linea_accion"] == "Comunidades de participación digital") {
			$sql .= " (reports.line_action='Medios digitales' or reports.line_action='Infocentro adentro' or reports.line_action='Participación digital' or reports.line_action='Sistematización de Experiencias' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else if ($_GET["linea_accion"] == "Comunidades de aprendizaje") {
			$sql .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else if ($_GET["linea_accion"] == "Medios digitales") {
			$sql .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else if ($_GET["linea_accion"] == "Acceso abierto") {
			$sql .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
		} else {
			$sql .= " (reports.line_action='" . $_GET["linea_accion"] . "')";
		}

		// $sql .= " reports.line_action='".$_GET["linea_accion"]."'";
	}


	// solo admin visualiza la data nacional
	if ($_GET["estado"] != "" && ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6)) {
		if ($_GET["q"] != "" or $_GET["user_id"] != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
		}
		$sql .= " reports.estate='" . $_GET["estado"] . "'";
	} else if ($_GET["estado"] != "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 6)) {
		if ($_GET["q"] != "" or $_GET["user_id"] != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
	} else if ($_GET["estado"] == "" && ($_SESSION["user_type"] == 4 && $_SESSION["user_type"] == 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
		if ($_GET["q"] != "" or $_GET["user_id"] != "" or $_GET["linea_accion"] != "" or $info_id != "") {
			$sql .= ' and ';
		}
		$sql .= " reports.estate='" . $_SESSION["user_region"] . "'";
	}


	if ($_GET["start_at"] != "" and $_GET["finish_at"] != "") {
		if (($_GET["q"] != "" || $_GET["info_id"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "")) {
			$sql .= " and ";
		}
		// $sql .= " to_date(left(products_list.date,10), 'DD-MM-YYYY') BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
		$sql .= " reports.date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
	}


	if ($_GET["start_at"] != "" and $_GET["finish_at"] == "") {
		if (($_GET["q"] != "" || $_GET["info_id"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "")) {
			$sql .= ' and ';
		}
		// $sql .= " to_date(left(products_list.date,10), 'DD-MM-YYYY')>=to_date('" . $start_at . "','DD-MM-YYYY')";
		$sql .= " reports.date_ini >= '" . $start_at . "'";
	}




	$sql .= " GROUP BY " . $fields;
	$sql .= " ORDER BY reports.date_ini desc";
	$param_csv = $sql;
	$param_xlsx = $sql;
	// echo $sql;

	// Busca el total de registros segun parametros de consulta
	$total = ProductsData::getBySQL($sql);
	$TotalReg = $total[1];

	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = ProductsData::getBySQL($sql);

	// Asigna url de paginacion
	$url_pag = "<a href=\"?view=products&q=" . $q . "&info_id=" . $code_info . "&estado=" . $estado_q . "&linea_accion=" . $linea_accion_q . "&user_id=" . $user_id . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";


	$param_sql = "true";
} else {
	// $users = InfoData::getAll();




	// solo admin visualiza la data nacional
	if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {
		$total_sql = "SELECT 
		";
		$fields = "
		reports.user_id, 
		products_list.id, 
		products_list.id_activity, 
		products_list.date, 
		products_list.estate, 
		products_list.code_info, 
		products_list.info_id, 
		reports.line_action, 
		reports.report_type, 
		reports.activity_title, 
		reports.datetime, 
		products_list.action_performed, 
		products_list.format, 
		products_list.format_detail, 
		products_list.doc_tipo,
		products_list.red_creada,
		products_list.formulario_url,
		products_list.video_url,
		products_list.doc_name,
		products_list.date_reg";
		$total_sql .= $fields;
		$total_sql .= " from products_list 
		INNER JOIN reports on products_list.id_activity = reports.id";
		$total_sql .= " group by " . $fields;
		$total_sql .= " order by reports.datetime desc";
	} else {
		$total_sql = "SELECT 
		";
		$fields = "
		reports.user_id, 
		products_list.id, 
		products_list.id_activity, 
		products_list.date, 
		products_list.estate, 
		products_list.code_info, 
		products_list.info_id, 
		reports.line_action, 
		reports.report_type, 
		reports.activity_title, 
		reports.datetime, 
		products_list.action_performed, 
		products_list.format, 
		products_list.format_detail, 
		products_list.doc_tipo,
		products_list.red_creada,
		products_list.formulario_url,
		products_list.video_url,
		products_list.doc_name,
		products_list.date_reg";
		$total_sql .= $fields;
		$total_sql .= " from products_list 
		INNER JOIN reports on products_list.id_activity = reports.id";
		$total_sql .= " where products_list.estate='" . $_SESSION["user_region"] . "'";
		$total_sql .= " group by " . $fields;
		$total_sql .= " order by reports.datetime desc";
	}




	$total_sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = ProductsData::getBySQL($total_sql);
	$TotalReg = $users[1];


	if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {
		// total aproximado con pg_class
		$base = new DatabasePg();
		$conn = $base->connectPg();
		$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'products_list'");
		$row_table->execute();
		$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $total_data[0]["reltuples"];
		// $TotalReg = 1000;
	}


	$param_csv = $total_sql;
	$param_xlsx = $total_sql;

	$url_pag = "<a href=\"?view=products&q=" . $q . "&info_id=" . $code_info . "&estado=" . $estado_q . "&linea_accion=" . $linea_accion_q . "&user_id=" . $user_id . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";
	$param_sql = "true";
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
if ($TotalReg > 0) {
	$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
} else {
	$TotalRegistro  = 0;
}
$DB_name = "products_list";


?>




<?php if (count($users[0]) > 0) { ?>
	<!-- si hay usuarios -->



	<?php if ($_SESSION["user_type"] != 4) { ?>
		<div class="col-md-12">

			<div class="form-group text_label">
				<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
			</div>

			<a target="_blank" href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
			<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>

		</div>
	<?php } else { ?>
		<div class="col-md-12">

			<div class="form-group text_label">
				<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
			</div>

		</div>
	<?php } ?>



	<div class="col-md-12">
		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">
					<table class="table table-bordered table-hover">

						<!-- INONOS -->
						<thead>
							<th class="text_label "> <i class="fa fa-check icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-user icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-gear icon_table"></i></th>
							<th class="text_label " style="width: 400px;"> <i class="fa fa-list-alt icon_table"></i></th>
							<th class="text_label " style="width: 100px;"> <i class="fa fa-map-marker icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-building icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-building icon_table"></i></th>
							<th class="text_label "> <i class="fa fa-calendar-check-o icon_table"></i></th>
							<!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-list-alt icon_table"></i></th> -->
							<th class="text_label "> <i class="fa fa-camera icon_table"></i></th>
							<th class="text_label " style="width: 200px;"> <i class="fa fa-tasks icon_table"></i></th>
							<!-- <th class="text_label "> <i class="fa fa-pie-chart icon_table"></i></th> -->
							<th class="text_label "> <i class="fa fa-paper-plane icon_table"></i></th>
							<!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-link icon_table" ></i></th> -->
							<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
						</thead>

						<!-- TITULOS -->
						<thead>
							<th>N°</th>
							<th>UID</th>
							<th>Id-Actividad</th>
							<th>Título Actividad</th>
							<th>Estado</th>
							<th>Id. Info</th>
							<th>Cod. Info</th>
							<th>Fecha</th>
							<th>Acción realizada</th>
							<th>Formato</th>
							<th>Enlace</th>
							<!-- <th>Detalles del formato</th> -->
							<!-- <th>Cantidad creados</th> -->
							<!-- <th>Cantidad publicados</th> -->
							<!-- <th>Enlaces web</th> -->
							<th>Acciones</th>
						</thead>

						<?php
						$total_fem = 0;
						$total_mas = 0;
						$var_count = 0;

						foreach ($users[0] as $types) {
							$var_count += 1;

							// sacamos la fecha de inicio
							$date_pub_end = explode("/", $types["date"]);
							if (count($date_pub_end) > 1) {
								$date_pub = $date_pub_end[0];
							} else {
								$date_pub = $types["date"];
							}


						?>
							<tr>
								<td><?php echo $var_count; ?></td>
								<td><?php echo $types["user_id"]; ?></td>
								<td><?php echo $types["id_activity"]; ?></td>
								<td><?php echo $types["activity_title"]; ?></td>
								<td><?php echo $types["estate"]; ?></td>
								<td><?php echo $types["info_id"]; ?></td>
								<td><?php echo $types["code_info"]; ?></td>
								<td><?php echo date("d/m/Y", strtotime($date_pub)); ?></td>
								<td><?php echo $types["action_performed"]; ?></td>
								<td><?php echo $types["format"]; ?></td>
								<!-- <td><!?php echo $types["format_detail"]; ?></td> -->
								<!-- <td><!?php echo $types["quantity_created"]; ?></td> -->
								<!-- <td><!?php echo $types["quantity_published"]; ?></td> -->

								<td>
									<?php
									// $id = $types["id"];
									// $sql = "SELECT * FROM links INNER JOIN social_medias ON links.social_medias_id = social_medias.id WHERE links.products_list_id = $id";
									// $param = LinksData::getBySQL($sql);

									if ($types["doc_tipo"] != "") {
										// foreach ($param[0] as $link) {
										$svg_icon = "";
										$background_icon_color = "";
										switch (strtoupper($types["doc_tipo"])) {
											case "XLSX":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252q.284.091.665.091q.507 0 .858-.158q.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.188-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15q-.336.149-.527.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326a.5.5 0 0 1-.085.29a.56.56 0 0 1-.255.193q-.168.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.249-.115a.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036z"/></svg>';
												$background_icon_color = "#53CE57FF";
												break;
											case "PDF":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="#fff" d="M17.924 7.154h-.514l.027-1.89a.46.46 0 0 0-.12-.298L12.901.134A.4.4 0 0 0 12.618 0h-9.24a.8.8 0 0 0-.787.784v6.37h-.515c-.285 0-.56.118-.76.328A1.14 1.14 0 0 0 1 8.275v5.83c0 .618.482 1.12 1.076 1.12h.515v3.99A.8.8 0 0 0 3.38 20h13.278c.415 0 .78-.352.78-.784v-3.99h.487c.594 0 1.076-.503 1.076-1.122v-5.83c0-.296-.113-.582-.315-.792a1.05 1.05 0 0 0-.76-.328M3.95 1.378h6.956v4.577a.4.4 0 0 0 .11.277a.37.37 0 0 0 .267.115h4.759v.807H3.95zm0 17.244v-3.397h12.092v3.397zM12.291 1.52l.385.434l2.58 2.853l.143.173h-2.637q-.3 0-.378-.1q-.08-.098-.093-.313zM3 14.232v-6h1.918q1.09 0 1.42.09q.51.135.853.588q.343.451.343 1.168q0 .552-.198.93q-.198.375-.503.59a1.7 1.7 0 0 1-.62.285q-.428.086-1.239.086h-.779v2.263zm1.195-4.985v1.703h.654q.707 0 .945-.094a.79.79 0 0 0 .508-.762a.78.78 0 0 0-.19-.54a.82.82 0 0 0-.48-.266q-.213-.04-.86-.04zm4.04-1.015h2.184q.739 0 1.127.115q.52.155.892.552q.371.398.565.972q.195.576.194 1.418q0 .741-.182 1.277q-.223.655-.634 1.06q-.31.308-.84.48q-.395.126-1.057.126H8.235zM9.43 9.247v3.974h.892q.501 0 .723-.057q.291-.074.482-.25q.193-.176.313-.579q.121-.403.121-1.099t-.12-1.068a1.4 1.4 0 0 0-.34-.581a1.13 1.13 0 0 0-.553-.283q-.25-.057-.98-.057zm4.513 4.985v-6H18v1.015h-2.862v1.42h2.47v1.015h-2.47v2.55z"/></svg>';
												$background_icon_color = "#D02626FF";
												break;
											case "DOCX":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="#fff" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-6.839 9.688v-.522a1.5 1.5 0 0 0-.117-.641a.86.86 0 0 0-.322-.387a.86.86 0 0 0-.469-.129a.87.87 0 0 0-.471.13a.87.87 0 0 0-.32.386a1.5 1.5 0 0 0-.117.641v.522q0 .384.117.641a.87.87 0 0 0 .32.387a.9.9 0 0 0 .471.126a.9.9 0 0 0 .469-.126a.86.86 0 0 0 .322-.386a1.55 1.55 0 0 0 .117-.642m.803-.516v.513q0 .563-.205.973a1.47 1.47 0 0 1-.589.627q-.381.216-.917.216a1.86 1.86 0 0 1-.92-.216a1.46 1.46 0 0 1-.589-.627a2.15 2.15 0 0 1-.205-.973v-.513q0-.569.205-.975q.205-.411.59-.627q.386-.22.92-.22q.535 0 .916.22q.383.219.59.63q.204.406.204.972M1 15.925v-3.999h1.459q.609 0 1.005.235q.396.233.589.68q.196.445.196 1.074q0 .634-.196 1.084q-.197.451-.595.689q-.396.237-.999.237zm1.354-3.354H1.79v2.707h.563q.277 0 .483-.082a.8.8 0 0 0 .334-.252q.132-.17.196-.422a2.3 2.3 0 0 0 .068-.592q0-.45-.118-.753a.9.9 0 0 0-.354-.454q-.237-.152-.61-.152Zm6.756 1.116q0-.373.103-.633a.87.87 0 0 1 .301-.398a.8.8 0 0 1 .475-.138q.225 0 .398.097a.7.7 0 0 1 .273.26a.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964a1.4 1.4 0 0 0-.49-.272a1.8 1.8 0 0 0-.606-.097q-.534 0-.911.223q-.375.222-.571.633q-.197.41-.197.978v.498q0 .568.194.976q.195.406.571.627q.375.216.914.216q.44 0 .785-.164t.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364a.7.7 0 0 1-.273.248a.9.9 0 0 1-.401.088a.85.85 0 0 1-.478-.131a.83.83 0 0 1-.298-.393a1.7 1.7 0 0 1-.103-.627zm5.092-1.76h.894l-1.275 2.006l1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015l-1.228-1.984h.932l.832 1.439h.035z"/></svg>';
												$background_icon_color = "#0362C7FF";
												break;
											case "DOC":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="#fff" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-6.839 9.688v-.522a1.5 1.5 0 0 0-.117-.641a.86.86 0 0 0-.322-.387a.86.86 0 0 0-.469-.129a.87.87 0 0 0-.471.13a.87.87 0 0 0-.32.386a1.5 1.5 0 0 0-.117.641v.522q0 .384.117.641a.87.87 0 0 0 .32.387a.9.9 0 0 0 .471.126a.9.9 0 0 0 .469-.126a.86.86 0 0 0 .322-.386a1.55 1.55 0 0 0 .117-.642m.803-.516v.513q0 .563-.205.973a1.47 1.47 0 0 1-.589.627q-.381.216-.917.216a1.86 1.86 0 0 1-.92-.216a1.46 1.46 0 0 1-.589-.627a2.15 2.15 0 0 1-.205-.973v-.513q0-.569.205-.975q.205-.411.59-.627q.386-.22.92-.22q.535 0 .916.22q.383.219.59.63q.204.406.204.972M1 15.925v-3.999h1.459q.609 0 1.005.235q.396.233.589.68q.196.445.196 1.074q0 .634-.196 1.084q-.197.451-.595.689q-.396.237-.999.237zm1.354-3.354H1.79v2.707h.563q.277 0 .483-.082a.8.8 0 0 0 .334-.252q.132-.17.196-.422a2.3 2.3 0 0 0 .068-.592q0-.45-.118-.753a.9.9 0 0 0-.354-.454q-.237-.152-.61-.152Zm6.756 1.116q0-.373.103-.633a.87.87 0 0 1 .301-.398a.8.8 0 0 1 .475-.138q.225 0 .398.097a.7.7 0 0 1 .273.26a.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964a1.4 1.4 0 0 0-.49-.272a1.8 1.8 0 0 0-.606-.097q-.534 0-.911.223q-.375.222-.571.633q-.197.41-.197.978v.498q0 .568.194.976q.195.406.571.627q.375.216.914.216q.44 0 .785-.164t.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364a.7.7 0 0 1-.273.248a.9.9 0 0 1-.401.088a.85.85 0 0 1-.478-.131a.83.83 0 0 1-.298-.393a1.7 1.7 0 0 1-.103-.627zm5.092-1.76h.894l-1.275 2.006l1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015l-1.228-1.984h.932l.832 1.439h.035z"/></svg>';
												$background_icon_color = "#0362C7FF";
												break;
											case "ODS":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252q.284.091.665.091q.507 0 .858-.158q.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.188-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15q-.336.149-.527.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326a.5.5 0 0 1-.085.29a.56.56 0 0 1-.255.193q-.168.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.249-.115a.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036z"/></svg>';
												$background_icon_color = "#53CE57FF";
												break;
											case "ODT":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="#fff" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-6.839 9.688v-.522a1.5 1.5 0 0 0-.117-.641a.86.86 0 0 0-.322-.387a.86.86 0 0 0-.469-.129a.87.87 0 0 0-.471.13a.87.87 0 0 0-.32.386a1.5 1.5 0 0 0-.117.641v.522q0 .384.117.641a.87.87 0 0 0 .32.387a.9.9 0 0 0 .471.126a.9.9 0 0 0 .469-.126a.86.86 0 0 0 .322-.386a1.55 1.55 0 0 0 .117-.642m.803-.516v.513q0 .563-.205.973a1.47 1.47 0 0 1-.589.627q-.381.216-.917.216a1.86 1.86 0 0 1-.92-.216a1.46 1.46 0 0 1-.589-.627a2.15 2.15 0 0 1-.205-.973v-.513q0-.569.205-.975q.205-.411.59-.627q.386-.22.92-.22q.535 0 .916.22q.383.219.59.63q.204.406.204.972M1 15.925v-3.999h1.459q.609 0 1.005.235q.396.233.589.68q.196.445.196 1.074q0 .634-.196 1.084q-.197.451-.595.689q-.396.237-.999.237zm1.354-3.354H1.79v2.707h.563q.277 0 .483-.082a.8.8 0 0 0 .334-.252q.132-.17.196-.422a2.3 2.3 0 0 0 .068-.592q0-.45-.118-.753a.9.9 0 0 0-.354-.454q-.237-.152-.61-.152Zm6.756 1.116q0-.373.103-.633a.87.87 0 0 1 .301-.398a.8.8 0 0 1 .475-.138q.225 0 .398.097a.7.7 0 0 1 .273.26a.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964a1.4 1.4 0 0 0-.49-.272a1.8 1.8 0 0 0-.606-.097q-.534 0-.911.223q-.375.222-.571.633q-.197.41-.197.978v.498q0 .568.194.976q.195.406.571.627q.375.216.914.216q.44 0 .785-.164t.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364a.7.7 0 0 1-.273.248a.9.9 0 0 1-.401.088a.85.85 0 0 1-.478-.131a.83.83 0 0 1-.298-.393a1.7 1.7 0 0 1-.103-.627zm5.092-1.76h.894l-1.275 2.006l1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015l-1.228-1.984h.932l.832 1.439h.035z"/></svg>';
												$background_icon_color = "#0362C7FF";
												break;
											case "PNG";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fffdfd" fill-rule="evenodd" d="M2 5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v6.5a1 1 0 0 1-.032.25A1 1 0 0 1 22 12v7a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-3a1 1 0 0 1 .032-.25A1 1 0 0 1 2 15.5zm2.994 9.83q-.522.01-.994.046V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v6.016c-4.297.139-7.4 1.174-9.58 2.623c.826.293 1.75.71 2.656 1.256c1.399.84 2.821 2.02 3.778 3.583a1 1 0 1 1-1.706 1.044c-.736-1.203-1.878-2.178-3.102-2.913c-1.222-.734-2.465-1.192-3.327-1.392a15.5 15.5 0 0 0-3.703-.386h-.022zm1.984-8.342A2.67 2.67 0 0 1 8.5 6c.41 0 1.003.115 1.522.488c.57.41.978 1.086.978 2.012s-.408 1.601-.978 2.011A2.67 2.67 0 0 1 8.5 11c-.41 0-1.003-.115-1.522-.489C6.408 10.101 6 9.427 6 8.5c0-.926.408-1.601.978-2.012" clip-rule="evenodd"/></svg>';
												$background_icon_color = "#3E88FFFF";
												break;
											case "JPEG";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fffdfd" fill-rule="evenodd" d="M2 5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v6.5a1 1 0 0 1-.032.25A1 1 0 0 1 22 12v7a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-3a1 1 0 0 1 .032-.25A1 1 0 0 1 2 15.5zm2.994 9.83q-.522.01-.994.046V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v6.016c-4.297.139-7.4 1.174-9.58 2.623c.826.293 1.75.71 2.656 1.256c1.399.84 2.821 2.02 3.778 3.583a1 1 0 1 1-1.706 1.044c-.736-1.203-1.878-2.178-3.102-2.913c-1.222-.734-2.465-1.192-3.327-1.392a15.5 15.5 0 0 0-3.703-.386h-.022zm1.984-8.342A2.67 2.67 0 0 1 8.5 6c.41 0 1.003.115 1.522.488c.57.41.978 1.086.978 2.012s-.408 1.601-.978 2.011A2.67 2.67 0 0 1 8.5 11c-.41 0-1.003-.115-1.522-.489C6.408 10.101 6 9.427 6 8.5c0-.926.408-1.601.978-2.012" clip-rule="evenodd"/></svg>';
												$background_icon_color = "#3E88FFFF";
												break;
											case "JPG";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fffdfd" fill-rule="evenodd" d="M2 5a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v6.5a1 1 0 0 1-.032.25A1 1 0 0 1 22 12v7a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-3a1 1 0 0 1 .032-.25A1 1 0 0 1 2 15.5zm2.994 9.83q-.522.01-.994.046V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v6.016c-4.297.139-7.4 1.174-9.58 2.623c.826.293 1.75.71 2.656 1.256c1.399.84 2.821 2.02 3.778 3.583a1 1 0 1 1-1.706 1.044c-.736-1.203-1.878-2.178-3.102-2.913c-1.222-.734-2.465-1.192-3.327-1.392a15.5 15.5 0 0 0-3.703-.386h-.022zm1.984-8.342A2.67 2.67 0 0 1 8.5 6c.41 0 1.003.115 1.522.488c.57.41.978 1.086.978 2.012s-.408 1.601-.978 2.011A2.67 2.67 0 0 1 8.5 11c-.41 0-1.003-.115-1.522-.489C6.408 10.101 6 9.427 6 8.5c0-.926.408-1.601.978-2.012" clip-rule="evenodd"/></svg>';
												$background_icon_color = "#3E88FFFF";
												break;
											case "VIDEO";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#FFFFFFFF" d="M12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12q0-.175-.003-.353t-.022-.341q-.067.667-.53 1.104q-.464.436-1.137.436h-2.539q-.698 0-1.195-.496t-.497-1.193v-.845h-3.385v-1.69q0-.697.498-1.198q.497-.501 1.195-.501h.846v-.77q0-.728.476-1.146t1.137-.482q-.673-.26-1.38-.392T12 4Q8.65 4 6.325 6.325T4 12v.289q0 .134.02.288H8.5q1.42 0 2.402.983q.983.982.983 2.393v.855H9.346v2.73q.616.222 1.286.342T12 20"/></svg>';
												$background_icon_color = "#4AB1FFFF";
												break;
											case "IMPRESS";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#036ED1FF" d="M12 2.04c-5.5 0-10 4.49-10 10.02c0 5 3.66 9.15 8.44 9.9v-7H7.9v-2.9h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89c1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.45 2.9h-2.33v7a10 10 0 0 0 8.44-9.9c0-5.53-4.5-10.02-10-10.02"/></svg>';
												$background_icon_color = "#F1690FFF";
												break;
											case "PPTX";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><defs><mask id="SVGRBPVS6Hj"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path stroke="#fff" d="M4 8h40"/><path fill="#fff" fill-rule="evenodd" stroke="#fff" d="M8 8h32v26H8z" clip-rule="evenodd"/><path stroke="#000" d="m22 16l5 5l-5 5"/><path stroke="#fff" d="m16 42l8-8l8 8"/></g></mask></defs><path fill="#fffdfd" d="M0 0h48v48H0z" mask="url(#SVGRBPVS6Hj)"/></svg>';
												$background_icon_color = "#F1690FFF";
												break;
											case "PPT";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><defs><mask id="SVGRBPVS6Hj"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path stroke="#fff" d="M4 8h40"/><path fill="#fff" fill-rule="evenodd" stroke="#fff" d="M8 8h32v26H8z" clip-rule="evenodd"/><path stroke="#000" d="m22 16l5 5l-5 5"/><path stroke="#fff" d="m16 42l8-8l8 8"/></g></mask></defs><path fill="#fffdfd" d="M0 0h48v48H0z" mask="url(#SVGRBPVS6Hj)"/></svg>';
												$background_icon_color = "#F1690FFF";
												break;
											case "ODP";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><defs><mask id="SVGRBPVS6Hj"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path stroke="#fff" d="M4 8h40"/><path fill="#fff" fill-rule="evenodd" stroke="#fff" d="M8 8h32v26H8z" clip-rule="evenodd"/><path stroke="#000" d="m22 16l5 5l-5 5"/><path stroke="#fff" d="m16 42l8-8l8 8"/></g></mask></defs><path fill="#fffdfd" d="M0 0h48v48H0z" mask="url(#SVGRBPVS6Hj)"/></svg>';
												$background_icon_color = "#F1690FFF";
												break;

											case "TELEGRAM";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<path fill="#1576C1FF" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19c-.14.75-.42 1-.68 1.03c-.58.05-1.02-.38-1.58-.75c-.88-.58-1.38-.94-2.23-1.5c-.99-.65-.35-1.01.22-1.59c.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.21-.02c-.09.02-1.49.95-4.22 2.79c-.4.27-.76.41-1.08.4c-.36-.01-1.04-.2-1.55-.37c-.63-.2-1.12-.31-1.08-.66c.02-.18.27-.36.74-.55c2.92-1.27 4.86-2.11 5.83-2.51c2.78-1.16 3.35-1.36 3.73-1.36c.08 0 .27.02.39.12c.1.08.13.19.14.27c-.01.06.01.24 0 .38" />
											</svg>';
												$background_icon_color = "#FFFFFFFF";
												break;
											case "WHATSAPP";
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<path fill="#06A93FFF" d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.2 8.2 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31c-.22.25-.87.86-.87 2.07c0 1.22.89 2.39 1 2.56c.14.17 1.76 2.67 4.25 3.73c.59.27 1.05.42 1.41.53c.59.19 1.13.16 1.56.1c.48-.07 1.46-.6 1.67-1.18s.21-1.07.15-1.18c-.07-.1-.23-.16-.48-.27c-.25-.14-1.47-.74-1.69-.82c-.23-.08-.37-.12-.56.12c-.16.25-.64.81-.78.97c-.15.17-.29.19-.53.07c-.26-.13-1.06-.39-2-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.12-.24-.01-.39.11-.5c.11-.11.27-.29.37-.44c.13-.14.17-.25.25-.41c.08-.17.04-.31-.02-.43c-.06-.11-.56-1.35-.77-1.84c-.2-.48-.4-.42-.56-.43c-.14 0-.3-.01-.47-.01" />
											</svg>';
												$background_icon_color = "#FFFFFFFF";
												break;
										}
									?>


										<a href="<?php echo "uploads/files/" . str_replace(" ", "-", $types['doc_name']) ?>" target="_blank" style="background:<?php echo $background_icon_color; ?>;" class=" btn btn-info btn-sm"><?php echo $svg_icon; ?> </a>

									<?php } else { ?>

										<?php
										$svg_icon = "";
										$background_icon_color = "";

										switch (strtoupper($types["format"])) {
											case "XLSX":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252q.284.091.665.091q.507 0 .858-.158q.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.188-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15q-.336.149-.527.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326a.5.5 0 0 1-.085.29a.56.56 0 0 1-.255.193q-.168.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.249-.115a.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036z"/></svg>';
												$background_icon_color = "#53CE57FF";
												break;
											case "FORMULARIO":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36"><path fill="#fffdfd" d="M21 12H7a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1M8 10h12V7.94H8Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="#fffdfd" d="M21 14.08H7a1 1 0 0 0-1 1V19a1 1 0 0 0 1 1h11.36L22 16.3v-1.22a1 1 0 0 0-1-1M20 18H8v-2h12Z" class="clr-i-outline clr-i-outline-path-2"/><path fill="#fffdfd" d="M11.06 31.51v-.06l.32-1.39H4V4h20v10.25l2-1.89V3a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v28a1 1 0 0 0 1 1h8a3.4 3.4 0 0 1 .06-.49" class="clr-i-outline clr-i-outline-path-3"/><path fill="#fffdfd" d="m22 19.17l-.78.79a1 1 0 0 0 .78-.79" class="clr-i-outline clr-i-outline-path-4"/><path fill="#fffdfd" d="M6 26.94a1 1 0 0 0 1 1h4.84l.3-1.3l.13-.55v-.05H8V24h6.34l2-2H7a1 1 0 0 0-1 1Z" class="clr-i-outline clr-i-outline-path-5"/><path fill="#fffdfd" d="m33.49 16.67l-3.37-3.37a1.61 1.61 0 0 0-2.28 0L14.13 27.09L13 31.9a1.61 1.61 0 0 0 1.26 1.9a1.6 1.6 0 0 0 .31 0a1.2 1.2 0 0 0 .37 0l4.85-1.07L33.49 19a1.6 1.6 0 0 0 0-2.27ZM18.77 30.91l-3.66.81l.89-3.63L26.28 17.7l2.82 2.82Zm11.46-11.52l-2.82-2.82L29 15l2.84 2.84Z" class="clr-i-outline clr-i-outline-path-6"/><path fill="none" d="M0 0h36v36H0z"/></svg>';
												$background_icon_color = "#AE00FFFF";
												break;
											case "RRSS":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="#fffdfd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5a2 2 0 1 0 4 0a2 2 0 1 0-4 0M3 19a2 2 0 1 0 4 0a2 2 0 1 0-4 0m14 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0m-8-5a3 3 0 1 0 6 0a3 3 0 1 0-6 0m3-7v4m-5.3 6.8l2.8-2m7.8 2l-2.8-2"/></svg>';
												$background_icon_color = "#FF005DFF";
												break;
											case "VIDEO":
												$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#fffdfd" d="M4 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm4.625 5.63a1.235 1.235 0 0 1 1.715-.992c.504.216 1.568.702 2.916 1.48a28 28 0 0 1 2.74 1.786a1.234 1.234 0 0 1 0 1.98a28 28 0 0 1-2.74 1.784a28 28 0 0 1-2.916 1.482a1.234 1.234 0 0 1-1.715-.992a29 29 0 0 1-.176-3.264c0-1.551.112-2.719.176-3.264"/></g></svg>';
												$background_icon_color = "#BA0000FF";
												break;
										}
										?>
										<?php if ($types['format'] == "formulario") { ?>
											<a href="<?php echo $types['formulario_url'] ?>" target="_blank" style="background:<?php echo $background_icon_color; ?>;" class=" btn btn-info btn-sm"><?php echo $svg_icon; ?> </a>

										<?php } else if ($types['format'] == "rrss") { ?>
											<a href="<?php echo $types['red_creada'] ?>" target="_blank" style="background:<?php echo $background_icon_color; ?>;" class=" btn btn-info btn-sm"><?php echo $svg_icon; ?> </a>


										<?php } else if ($types['format'] == "video") { ?>
											<a href="<?php echo $types['video_url'] ?>" target="_blank" style="background:<?php echo $background_icon_color; ?>;" class=" btn btn-info btn-sm"><?php echo $svg_icon; ?> </a>


										<?php } else { ?>
											<a href="#" class=" btn btn-warning btn-sm"><i class="fa fa-globe"></i> </a>
										<?php } ?>
									<?php } ?>

								</td>


								<td style="width:80px;">
									<?php if ($_SESSION["user_type"] != 10) { ?>

										<!-- <!?php if ($_SESSION["user_id"] == $types["uid_fac"]) { ?> -->
										<!-- <a href="index.php?view=editproduct&id=<!?php echo $types["id"]; ?>" class="btn btn-warning btn-sm">Editar</a> -->

										<!-- <!?php } elseif ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?> -->
										<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

											<a href="index.php?view=editproduct&id=<?php echo $types["id"]; ?>" class="btn btn-warning btn-sm">Editar</a>

										<?php } ?>
									<?php } ?>

								</td>
							</tr>

						<?php

						}
						?>


					</table>


				<?php
			} else {
				echo "<p class='alert alert-danger'>No hay productos</p>";
			}
				?>


				</div>
			</div class="card-content table-responsive">
		</div>
	</div>
	<!-- fin tabla con lista de registros -->


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