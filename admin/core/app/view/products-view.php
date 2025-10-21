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
												<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z"/></svg></i> </span> Desde
											</div>
											<input type="date" name="start_at" value="<?php if (isset($_GET["start_at"]) && $_GET["start_at"] != "") {
																							echo $_GET["start_at"];
																						} ?>" class="form-control">
										</div>


										<div class="col">
											<div class="input-group-prepend">
												<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z"/></svg></i> </span> Hasta
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
	products_list.web_link, 
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
		if (($_GET["q"] != "" || $_GET["info_id"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "") ) {
			$sql .= " and ";
		}
		// $sql .= " to_date(left(products_list.date,10), 'DD-MM-YYYY') BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
		$sql .= " reports.date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
	}

	
	if ($_GET["start_at"] != "" and $_GET["finish_at"] == "") {
		if (($_GET["q"] != "" || $_GET["info_id"] != "" || $_GET["linea_accion"] != "" || $_GET["estado"] != "" || $_GET["user_id"] != "") ) {
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
		products_list.quantity_created, 
		products_list.quantity_published, 
		products_list.web_link, 
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
		products_list.quantity_created, 
		products_list.quantity_published, 
		products_list.web_link, 
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
	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<a target="_blank" href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
		<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<!-- <a target="_blank" href="./pdf/jspdf_prod.php?param_pdf=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> </a> -->

	</div>



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
							<th class="text_label "> <i class="fa fa-pie-chart icon_table"></i></th>
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
							<!-- <th>Detalles del formato</th> -->
							<th>Cantidad creados</th>
							<th>Cantidad publicados</th>
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
								<td><?php echo $types["quantity_created"]; ?></td>
								<td><?php echo $types["quantity_published"]; ?></td>
								<!-- <td><!?php echo $types["web_link"]; ?></td> -->

								<td style="width:80px;">
									<?php if ($_SESSION["user_type"] != 10) { ?>

										<!-- <!?php if ($_SESSION["user_id"] == $types["uid_fac"]) { ?> -->
											<!-- <a href="index.php?view=editproduct&id=<!?php echo $types["id"]; ?>" class="btn btn-warning btn-sm">Editar</a> -->

										<!-- <!?php } elseif ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?> -->
										<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

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