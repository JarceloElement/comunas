<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
// $estadoName = EstadoData::getNameById(6);
// echo EstadoData::getNameById(6);

$user_type = UserTypeData::getAll();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>




<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx_brigadistas" method="POST" enctype="multipart/form-data" />
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
						<h4 class="card-title">Filtrar brigadistas</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="brigadistas">

								<div class="row">

									<div class="col">
										<div class="form-group col-mg-6">
											<div class="mui-textfield mui-textfield--float-label">

												<input type="text" id="q" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																								echo $_GET["q"];
																							} ?>" />
												<label><i class="fa fa-search"></i> Palabra clave</label>

											</div>
										</div>
									</div>
									<div class="col">
										<div class="form-group col-mg-6">
											<div class="mui-textfield mui-textfield--float-label">
												<input type="text" name="user_dni" value="<?php if (isset($_GET["user_dni"]) && $_GET["user_dni"] != "") {
																								echo $_GET["user_dni"];
																							} ?>">
												<label><i class="fa fa-search"></i> DNI</label>
											</div>
										</div>
									</div>



								</div>


								<div class="row">

									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
											<select name="user_estado" class="form-control" id="estados1">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p) : ?>
													<option value="<?php echo $p->id_estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>



									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i> Municipio</span>
											<select name="user_municipio" class="form-control" id="municipios_1">
												<option value="">MUNICIPIO</option>

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

$conn = DatabasePg::connectPg();
$id_remove = isset($_GET["id_remove"]) ? $_GET["id_remove"] : "0";
$user_dni_remove = isset($_GET["user_dni_remove"]) ? $_GET["user_dni_remove"] : "0";

$query_remove = "DELETE FROM final_users WHERE id !=" . $id_remove . " and user_dni ='" . $user_dni_remove . "'";
// echo $query_remove;

if (($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) && (isset($_GET["user_dni_remove"]) and $_GET["user_dni_remove"] != "")) {
	$row_table = $conn->prepare($query_remove);
	$row_table->execute();
}


$CantidadMostrar = 100;
$url_pag_atras = "";
$url_pag_adelante = "";
$user_region = $_SESSION["user_region"];
$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : "";
$user_estado = isset($_GET['user_estado']) ? $_GET['user_estado'] : "";
$user_municipio = isset($_GET['user_municipio']) ? $_GET['user_municipio'] : "";
$user_dni = isset($_GET['user_dni']) ? $_GET['user_dni'] : "";

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$users = array();

if ((isset($_GET["q"]) && isset($_GET["user_estado"]) && isset($_GET["user_municipio"]) && isset($_GET["user_dni"])) && ($_GET["q"] != "" || $_GET["user_estado"] != ""  || $_GET["user_municipio"] != "" || $_GET["user_dni"] != "")) {

	if ($_GET["user_estado"] != "") {
		$estate = EstadoData::getNameById($_GET["user_estado"]);
	}
	if ($_GET["user_municipio"] != "") {
		$municipality = MunicipioData::getNameById($_GET["user_municipio"]);
	}

	$sql = "SELECT 
		user_brigades.fk_id_brigade,
		user_brigades.parroquia,
		user_brigades.ciudad,
		user_brigades.comunidad,
		final_users.id as user_id, 
		user_brigades.id as user_brigade_id, 
		final_users.user_estado as estado,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg,
		final_users.red_x as X,
		final_users.red_facebook as facebook, 
		final_users.red_instagram as instagram, 
		final_users.red_linkedin as linkedin, 
		final_users.red_youtube as youtube, 
		final_users.red_tiktok as tiktok, 
		final_users.red_whatsapp as whatsapp, 
		final_users.red_telegram as telegram, 
		final_users.red_snapchat as snapchat, 
		final_users.red_pinterest as pinterest FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id WHERE";

	if ($_GET["q"] != "") {
		$sql .= " (parent_ref='$_GET[q]' or user_correo='$_GET[q]' or user_nombres='$_GET[q]' or user_apellidos='$_GET[q]')";
	}


	if ($_GET["user_dni"] != "") {

		if ($_GET["q"] != "") {
			$sql .= " and ";
		}
		$sql .= " user_dni ='" . $user_dni . "'";
	}

	if ($_GET["user_municipio"] != "") {

		if ($_GET["q"] != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
		}

		$sql .= " user_municipio ='" . $municipality . "'";
	}


	// if ($_GET["user_type"] != "" && intval($_GET["user_type"]) > 1) {
	// if ($_GET["user_type"] != "") {

	// 	if ($_GET["q"] != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
	// 		$sql .= " and ";
	// 	}
	// 	$sql .= " user_type ='" . $user_type . "'";
	// }

	// solo admin visualiza la data nacional
	if ($_GET["user_estado"] != "" && ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6)) {
		if ($_GET["q"] != "" || $user_type != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
		}
		$sql .= " user_estado = '" . $estate . "'";
	} else if ($_GET["user_estado"] != "" && ($_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 6)) {
		if ($_GET["q"] != "" || $user_type != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
		}
		$sql .= " user_estado = '" . $estate . "'";
	} else if ($_GET["user_estado"] == "" && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
		if ($_GET["q"] != "" || $user_type != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
		}
		$sql .= " user_estado = '" . $user_region . "'";
	}




	// echo $sql;

	// Busca el total de registros segun parametros de consulta
	$total = FinalUsersData::getBySQL($sql . " order by user_estado desc");
	$TotalReg = $total[1];

	$sql .= " order by user_estado desc";
	$param_csv = $sql;
	// echo $param_csv;

	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = FinalUsersData::getBySQL($sql)[0];

	// Asigna url de paginacion
	$url_pag = "<a href=\"?view=brigadistas&q=" . $_GET["q"] . "&user_estado=" . $_GET["user_estado"] . "&municipio=" . $_GET["user_municipio"] . "&pag=";

	$param_sql = "true";
} else {
	// $users = MunicipioData::getAll();

	// Para Jefes de estado, coordinadores y facilitadores
	if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3) {
		$sql = "SELECT final_users.id as user_id,
		user_brigades.id as user_brigade_id, 
		final_users.user_estado as estado,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id WHERE final_users.user_estado ='" . $user_region . "' order by final_users.id desc";

		$sql_dw = "SELECT 
		user_brigades.id,
		user_brigades.fk_id_brigade,
		final_users.id as fk_id_user, 
		final_users.user_estado as estado,
		user_brigades.municipio,
		user_brigades.parroquia,
		user_brigades.ciudad,
		user_brigades.comunidad,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg,
		final_users.red_x as X,
		final_users.red_facebook as facebook, 
		final_users.red_instagram as instagram, 
		final_users.red_linkedin as linkedin, 
		final_users.red_youtube as youtube, 
		final_users.red_tiktok as tiktok, 
		final_users.red_whatsapp as whatsapp, 
		final_users.red_telegram as telegram, 
		final_users.red_snapchat as snapchat, 
		final_users.red_pinterest as pinterest FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id WHERE final_users.user_estado ='" . $user_region . "' order by final_users.id desc";
	}
	// Para politicas publicas y administracion
	else if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
		$sql = "SELECT final_users.id as user_id, 
		user_brigades.id as user_brigade_id, 
		final_users.user_estado as estado,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id order by final_users.id desc";

		$sql_dw = "SELECT 
		user_brigades.id,
		user_brigades.fk_id_brigade,
		final_users.id as fk_id_user, 
		final_users.user_estado as estado,
		user_brigades.municipio,
		user_brigades.parroquia,
		user_brigades.ciudad,
		user_brigades.comunidad,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg,
		final_users.red_x as X,
		final_users.red_facebook as facebook, 
		final_users.red_instagram as instagram, 
		final_users.red_linkedin as linkedin, 
		final_users.red_youtube as youtube, 
		final_users.red_tiktok as tiktok, 
		final_users.red_whatsapp as whatsapp, 
		final_users.red_telegram as telegram, 
		final_users.red_snapchat as snapchat, 
		final_users.red_pinterest as pinterest FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id  order by final_users.id desc";
	}
	// Gerencia, usuario finales y lectores
	else {
		$sql = "SELECT final_users.id as user_id, 
		user_brigades.id as user_brigade_id, 
		final_users.user_estado as estado,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,	
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id WHERE final_users.user_estado ='" . $_SESSION["user_region"] . "' order by final_users.id desc";

		$sql_dw = "SELECT 
		user_brigades.id,
		user_brigades.fk_id_brigade,
		final_users.id as fk_id_user, 
		final_users.user_estado as estado,
		user_brigades.municipio,
		user_brigades.parroquia,
		user_brigades.ciudad,
		user_brigades.comunidad,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
		final_users.user_nombres as primer_nombre,
		final_users.user_apellidos as apellido,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg,
		final_users.red_x as X,
		final_users.red_facebook as facebook, 
		final_users.red_instagram as instagram, 
		final_users.red_linkedin as linkedin, 
		final_users.red_youtube as youtube, 
		final_users.red_tiktok as tiktok, 
		final_users.red_whatsapp as whatsapp, 
		final_users.red_telegram as telegram, 
		final_users.red_snapchat as snapchat, 
		final_users.red_pinterest as pinterest FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id WHERE final_users.user_estado ='" . $_SESSION["user_region"] . "' order by final_users.id desc";
	}

	$base = new DatabasePg();
	$conn = $base->connectPg();

	if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {
		// total aproximado con pg_class all
		$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'user_brigades'");
		$row_table->execute();
		$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $total_data[0]["reltuples"];
		// $TotalReg = 1000;
	} else {
		// por regiones
		$total = FinalUsersData::getBySQL($sql);
		$TotalReg = $total[1];
	}

	// echo $sql;
	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = FinalUsersData::getBySQL($sql)[0];
	$url_pag = "<a href=\"?view=brigadistas&pag=";
	$param_csv = $sql_dw;
	$param_sql = "true";

}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
// echo $param_csv;
$DB_name = "user_brigades";
?>

<div class="col-md-12">
	<?php
	if ($_SESSION["user_type"] != 10) { ?>
		<a href="./../index.php?view=brigadistaform_new&new=1" class="btn btn-info">Agregar brigadista</a>
	<?php } ?>
</div>

<?php if (count($users) > 0 && (isset($users[0]["user_id"]) && $users[0]["user_id"] != "")) {
?>
	<!-- si hay usuarios -->

	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
			<!-- <a href="./pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a> -->
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<?php } ?>

		<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3) { ?>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<?php } ?>
	</div>




	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">

					<table class="table table-bordered table-hover">
						<thead>
							<th><i class="fa fa-id-card" style="color:gray "></i> ID</th>
							<th><i class="fa fa-home" style="color:gray "></i> Estado</th>
							<th><i class="fa fa-home" style="color:gray "></i> Codigo Info</th>
							<th><i class="fa fa-users" style="color:gray "></i> Brigada</th>
							<th><i class="fa fa-user" style="color:gray "></i> Nombres</th>
							<th><i class="fa fa-user" style="color:gray "></i> Apellidos</th>
							<th><i class="fa fa-id-card" style="color:gray "></i> Cedulado</th>
							<th><i class="fa fa-credit-card" style="color:gray "></i> N° documento</th>
							<th><i class="fa fa-user" style="color:gray "></i> Edad</th>
							<th><i class="fa fa-phone" style="color:gray "></i> Teléfono</th>
							<th><i class="fa fa-gear" style="color:gray "></i> Fecha de registro</th>
							<th><i class="fa fa-gear" style="color:gray "></i> Herramientas</th>

						</thead>
						<?php
						$fecha_actual = date("Y", time());
						foreach ($users as $user) {
						?>
							<tr>
								<td><?php echo $user["user_id"]; ?></td>
								<td><?php echo $user["estado"]; ?></td>
								<td><?php echo $user["info_cod"]; ?></td>
								<td><?php echo $user["brigada"]; ?></td>
								<td><?php echo ucwords($user["primer_nombre"]); ?></td>
								<td><?php echo $user["apellido"]; ?></td>
								<td><?php echo $user["cedulado"]; ?></td>
								<td><?php echo $user["cedula"]; ?></td>
								<td><?php echo $fecha_actual - date("Y", strtotime($user["f_nacimiento"])); ?></td>
								<td><?php echo $user["telefono"]; ?></td>
								<td><?php echo $user["fecha_reg"]; ?></td>


								<td style="width:180px;">
									<?php if ($_SESSION["user_type"] != 10) { ?>
										<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
											<a href="../?view=brigadistaform_edit&id=<?php echo $user["user_brigade_id"]; ?>" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
													</svg></i></a>
											<a href="./?action=brigade&function=deleteuserbrigade&id=<?php echo $user["user_brigade_id"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
													</svg></i></a>

										<?php } elseif (($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) && (strtoupper($_SESSION["user_code_info"]) == strtoupper($user["info_cod"]))) { ?>

											<a href="../?view=brigadistaform_edit&id=<?php echo $user["user_brigade_id"]; ?>" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
													</svg></i></a>
											<a href="./?action=brigade&function=deleteuserbrigade&id=<?php echo $user["user_brigade_id"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
													</svg></i></a>

										<?php } ?>
									<?php } ?>

								</td>
							</tr>
						<?php

						}
						?>
					</table>

				<?php



			} else
				echo " <p class='alert alert-danger'>Sin resultados</p>";
				?>


				</div class="card-content table-responsive">
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





	<!-- <script src="../../../assets/js/jquery.min.js"></script> -->

	<script language="javascript">
		$(document).ready(function() {

			$("#estados1").change(function() {

				$('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');

				$("#estados1 option:selected").each(function() {
					id_estado = $(this).val();

					// alert(id_estado);
					// alert($("#municipios").val());

					$.post("core/app/view/getMunicipio.php", {
						id_estado: id_estado
					}, function(data) {
						$("#municipios_1").html(data);
					});

				});
			})





			// $(function(){
			// 	$("#estados").find('select').add('style=display:none');
			// })




			<?php if (isset($_SESSION["alert"]) && $_SESSION["alert"] != null): ?>

				toastify('<?php echo $_SESSION["alert"]; ?>', true, 20000, "dashboard");

			<?php endif; ?>
		});
	</script>
	<?php
	$_SESSION["alert"] = null;
	?>



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
			font-size: 1.1em;
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