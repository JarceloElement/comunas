<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar facilitadores</h4>
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="facilitators">

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
											<input type="text" name="user_dni" value="<?php if (isset($_GET["user_dni"]) && $_GET["user_dni"] != "") {
																							echo $_GET["user_dni"];
																						} ?>">
											<label><i class="fa fa-search"></i> Cédula</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="col-md-12 mui-textfield mui-textfield--float-label">
											<input type="text" name="info_cod" value="<?php if (isset($_GET["info_cod"]) && $_GET["info_cod"] != "") {
																							echo $_GET["info_cod"];
																						} ?>">
											<label><i class="fa fa-search"></i> Código Info</label>
										</div>
									</div>

								</div>


								<div class="row">

									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
											<select name="estado" class="form-control" id="estados1">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p): ?>
													<option value="<?php echo $p->id_estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<select name="municipio" class="form-control" id="municipios_1">
												<option value="">MUNICIPIO</option>

											</select>
										</div>
									</div>



									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-gear"></i> Código de gerencia</span>
											<select name="cod_ger" class="form-control">
												<option value="">-COD-</option>
												<option value="">NO</option>
												<option value="1">SI</option>
											</select>
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

$CantidadMostrar = 100;
$url_pag_atras = "";
$url_pag_adelante = "";
$user_region = $_SESSION["user_region"];
$sql_rrss_dw = "";
// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$user_dni = (isset($_GET['user_dni'])) ? $_GET['user_dni'] : '';
$info_cod = (isset($_GET['info_cod'])) ? $_GET['info_cod'] : '';
$info_cod = strtoupper( $info_cod);


$sql_rrss = "SELECT 
	facilitators.info_cod, 
	facilitators.f_state, 
	facilitators.status_nom, 
	facilitators.personal_type, 
	facilitators.f_name, 
	facilitators.f_lastname, 
	facilitators.document_number, 
	facilitators.phone_number, 
	facilitators.gender, 
	facilitators.email, 
	final_users.red_x, 
	final_users.red_facebook, 
	final_users.red_instagram, 
	final_users.red_linkedin, 
	final_users.red_youtube, 
	final_users.red_tiktok, 
	final_users.red_whatsapp, 
	final_users.red_telegram, 
	final_users.red_snapchat, 
	final_users.red_pinterest from facilitators 
	INNER JOIN final_users ON (final_users.user_dni = CAST(REPLACE(facilitators.document_number,'.','') AS varchar))";


$users = array();

if ((isset($_GET["q"]) && isset($_GET["estado"]) && isset($_GET["cod_ger"]) && isset($_GET["user_dni"]) && isset($_GET["info_cod"]) && isset($_GET["estado"]) && isset($_GET["municipio"]) ) && ($_GET["q"] != "" || $_GET["estado"] != "" || $_GET["cod_ger"] != "" || $_GET["user_dni"] != "" || $_GET["info_cod"] != "" || $_GET["municipio"] != "" )) {

	if ($_GET["estado"] != "") {
		$estate = EstadoData::getNameById($_GET["estado"]);
	}
	if ($_GET["municipio"] != "") {
		$municipality = MunicipioData::getNameById($_GET["municipio"]);
	}

	if ($_GET["cod_ger"] == "") {
		$sql = "SELECT * from facilitators where";

		if ($_GET["q"] != "") {
			$sql .= " (email = '$_GET[q]' or personal_type like '%$_GET[q]%' or status_nom like '%$_GET[q]%' or f_name like '%$_GET[q]%' or f_lastname like '%$_GET[q]%')";
			$sql_rrss_dw .= " (facilitators.email = '$_GET[q]' or facilitators.personal_type like '%$_GET[q]%' or facilitators.status_nom like '%$_GET[q]%' or facilitators.f_name like '%$_GET[q]%' or facilitators.f_lastname like '%$_GET[q]%')";
		}

		// solo admin visualiza la data nacional
		if ($_GET["estado"] != "") {
			if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {
				if ($_GET["q"] != "") {
					$sql .= " and ";
					$sql_rrss_dw .= " and ";
				}
				$sql .= " f_state ='" . $user_region . "'";
				$sql_rrss_dw .= " facilitators.f_state ='" . $user_region . "'";
			} else if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
				if ($_GET["q"] != "") {
					$sql .= " and ";
					$sql_rrss_dw .= " and ";
				}
				$sql .= " f_state ='" . $estate . "'";
				$sql_rrss_dw .= " facilitators.f_state ='" . $estate . "'";
			} else {
				if ($_GET["q"] != "") {
					$sql .= " and ";
					$sql_rrss_dw .= " and ";
				}
				$sql .= " f_state ='" . $_SESSION["user_region"] . "'";
				$sql_rrss_dw .= " facilitators.f_state ='" . $_SESSION["user_region"] . "'";
			}
		}

		if ($_GET["municipio"] != "") {
			if ($_GET["estado"] != "" || $_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " municipality ='" . $municipality . "'";
			$sql_rrss_dw .= " facilitators.municipality ='" . $municipality . "'";
		}



		if ($_GET["user_dni"] != "") {
			if ($_GET["estado"] != "" || $_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " CAST(REPLACE(document_number,'.','') AS varchar)='" . $user_dni . "'";
			$sql_rrss_dw .= " CAST(REPLACE(facilitators.document_number,'.','') AS varchar)='" . $user_dni . "'";
		}

		if ($_GET["info_cod"] != "") {
			if ($_GET["estado"] != "" || $_GET["q"] != "" || $_GET["user_dni"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " UPPER(info_cod) ='" . $info_cod . "'";
			$sql_rrss_dw .= " UPPER(facilitators.info_cod) ='" . $info_cod . "'";
		}
	}


	if ($_GET["cod_ger"] == "1") {

		$sql = "SELECT f.*,i.cod_gerencia,i.nombre,i.direccion,i.perso_contacto,i.telef_contacto from facilitators f inner join infocentros i on f.info_cod = i.cod where";

		if ($_GET["q"] != "") {
			$sql .= " (f.email = '$_GET[q]' or f.info_cod='$_GET[q]' or f.personal_type like '%$_GET[q]%' or f.status_nom like '%$_GET[q]%' or f.name like '%$_GET[q]%' or f.document_number like '%$_GET[q]%' or f.lastname like '%$_GET[q]%')";
			$sql_rrss_dw .= " (facilitators.email = '$_GET[q]' or facilitators.info_cod='$_GET[q]' or facilitators.personal_type like '%$_GET[q]%' or facilitators.status_nom like '%$_GET[q]%' or facilitators.f_name like '%$_GET[q]%' or facilitators.document_number like '%$_GET[q]%' or facilitators.f_lastname like '%$_GET[q]%')";
		}

		if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {
			if ($_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " f.f_state ='" . $user_region . "' and ";
			$sql_rrss_dw .= " facilitators.f_state ='" . $user_region . "' and ";
		} else {
			if ($_GET["estado"] != "") {
				if ($_GET["q"] != "") {
					$sql .= " and ";
					$sql_rrss_dw .= " and ";
				}
				$sql .= " f.f_state ='" . $estate . "'";
				$sql_rrss_dw .= " facilitators.f_state ='" . $estate . "'";
			}
		}



		if ($_GET["municipio"] != "") {
			if ($_GET["estado"] != "" || $_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " f.municipality ='" . $municipality . "'";
			$sql_rrss_dw .= " facilitators.municipality ='" . $municipality . "'";
		}

		if ($_GET["cod_ger"] != "") {
			if ($_GET["estado"] != "" || $_GET["municipio"] != "" || $_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " i.cod_gerencia='1'";
			$sql_rrss_dw .= " infocentros.cod_gerencia='1'";
		}

		if ($_GET["user_dni"] != "") {
			if ($_GET["estado"] != "" || $_GET["municipio"] != "" || $_GET["q"] != "" || $_GET["cod_ger"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " CAST(REPLACE(document_number,'.','') AS varchar)='" . $user_dni . "'";
			$sql_rrss_dw .= " CAST(REPLACE(facilitators.document_number,'.','') AS varchar)='" . $user_dni . "'";
		}

		if ($_GET["info_cod"] != "") {
			if ($_GET["estado"] != "" || $_GET["municipio"] != "" || $_GET["q"] != "" || $_GET["user_dni"] != "" || $_GET["cod_ger"] != "") {
				$sql .= " and ";
				$sql_rrss_dw .= " and ";
			}
			$sql .= " UPPER(info_cod) ='" . $info_cod . "'";
			$sql_rrss_dw .= " UPPER(facilitators.info_cod) ='" . $info_cod . "'";
		}

	}

	// echo $sql;

	$sql_dw = "SELECT * from facilitators WHERE f_state ='" . $user_region . "' order by id asc";
	$sql_rrss = $sql_rrss . " where" . $sql_rrss_dw . " and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
	$sql .= " order by id asc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = FacilitatorsData::getAllPg($sql);
	$TotalReg = $users[1];

	$url_pag = "<a href=\"?view=facilitators&q=" . $_GET["q"] . "&estado=" . $_GET["estado"] . "&municipio=" . $_GET["municipio"] . "&pag=";
	$param_csv = $sql;
	$param_sql = "true";
	$DB_name = "facilitators";

	// echo $sql;

	// 
} else {

	// jefe de estado y coordinadores 
	if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {
		$sql = "SELECT * from facilitators WHERE f_state ='" . $user_region . "' order by id asc";
		$users = FacilitatorsData::getAllPg($sql);
		$TotalReg = $users[1];
		$sql_dw = "SELECT * from facilitators WHERE f_state ='" . $user_region . "' order by id asc";
		$sql_rrss = $sql_rrss . " where f_state ='" . $user_region . "' and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
		$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);

		// gerentes nacionales y administradores
	} else if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {

		$sql = "SELECT * from facilitators order by id asc";
		$users = FacilitatorsData::getAllPg($sql);
		// $TotalReg = $users[1];
		$sql_dw = "SELECT * from facilitators order by id asc";
		$sql_rrss = $sql_rrss . " where (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
		$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
		$users = FacilitatorsData::getAllPg($sql);

		// total aproximado con pg_class
		$conn = DatabasePg::connectPg();
		$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'facilitators'");
		$row_table->execute();
		$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $total_data[0]["reltuples"];
		// 
		// demas usuarios
	} else {
		$sql = "SELECT * from facilitators WHERE f_state ='" . $user_region . "' order by id asc";
		$users = FacilitatorsData::getAllPg($sql);
		$TotalReg = $users[1];
		$sql_dw = "SELECT * from facilitators WHERE f_state ='" . $user_region . "' order by id asc";
		$sql_rrss = $sql_rrss . " where (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
		$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	}


	$url_pag = "<a href=\"?view=facilitators&pag=";
	$param_csv = $sql_dw;
	$param_sql = "true";
	$DB_name = "facilitators";
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);


?>
