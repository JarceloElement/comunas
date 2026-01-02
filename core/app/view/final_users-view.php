<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
// $estadoName = EstadoData::getNameById(6);
// echo EstadoData::getNameById(6);

$user_type = UserTypeData::getAll();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

?>

<div class="col-md-12">

	<div class="card">
		<div class="card-header card-header">
			<h4 class="card-title">Depurar usuarios repetidos</h4>
		</div>
		<br>
		<form class="form-horizontal" role="form">
			<input type="hidden" name="view" value="final_users">

			<div class="row">

				<div class="col-md-6">
					<div class="col">
						<div class="form-group">
							<label for="inputEmail1" class="control-label">Cédula</label>
							<input type="number" name="user_dni_remove" required class="form-control" placeholder="C.I">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col">
						<div class="form-group">
							<label for="inputEmail1" class="control-label">ID principal</label>
							<input type="number" name="id_remove" required class="form-control" placeholder="ID a conservar">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="col">
						<div class="form-group">
							<button type="submit" class="btn btn-secundary btn-block">Depurar</button>
						</div>
					</div>
				</div>
		</form>
	</div>
</div>




<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar usuarios finales</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="final_users">

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

									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
											<select name="user_estado" class="form-control" id="estados">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p) : ?>
													<option value="<?php echo $p->id_estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>



									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i> Municipio</span>
											<select name="user_municipio" class="form-control" id="municipios_1">
												<option value="">MUNICIPIO</option>

											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-user"></i> Tipo de usuario</span>
											<select name="user_type" class="form-control" id="user_type">
												<option value="">TIPO DE USUARIO</option>
												<?php foreach ($user_type as $p) : ?>
													<option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
												<?php endforeach; ?>
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


$CantidadMostrar = 30;
$url_pag_atras = "";
$url_pag_adelante = "";
$user_region = $_SESSION["user_region"];
$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : "";
$user_estado = isset($_GET['user_estado']) ? $_GET['user_estado'] : "";
$user_municipio = isset($_GET['user_municipio']) ? $_GET['user_municipio'] : "";
$user_dni = isset($_GET['user_dni']) ? $_GET['user_dni'] : "";
$sql_rrss_dw = "";

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$sql_rrss = "SELECT 
user_estado, 
user_nombres, 
user_apellidos, 
user_telefono, 
user_genero, 
red_x, 
red_facebook, 
red_instagram, 
red_linkedin, 
red_youtube, 
red_tiktok, 
red_whatsapp, 
red_telegram, 
red_snapchat, 
red_pinterest from final_users";


$users = array();

if ((isset($_GET["q"]) && isset($_GET["user_estado"]) && isset($_GET["user_municipio"]) && isset($_GET["user_type"]) && isset($_GET["user_dni"])) && ($_GET["q"] != "" || $_GET["user_estado"] != ""  || $_GET["user_municipio"] != "" || $_GET["user_type"] != "" || $_GET["user_dni"] != "")) {

	if ($_GET["user_estado"] != "") {
		$estate = EstadoData::getNameById($_GET["user_estado"]);
	}
	if ($_GET["user_municipio"] != "") {
		$municipality = MunicipioData::getNameById($_GET["user_municipio"]);
	}

	$sql = "SELECT * from final_users where";

	if ($_GET["q"] != "") {
		$sql .= " (parent_ref='$_GET[q]' or user_correo='$_GET[q]' or user_nombres='$_GET[q]' or user_apellidos='$_GET[q]')";
		$sql_rrss_dw .= " (parent_ref='$_GET[q]' or user_correo= '$_GET[q]' or user_nombres= '$_GET[q]' or user_apellidos='$_GET[q]')";
	}


	if ($_GET["user_dni"] != "") {

		if ($_GET["q"] != "") {
			$sql .= " and ";
			$sql_rrss_dw .= " and ";
		}
		$sql .= " user_dni ='" . $user_dni . "'";
		$sql_rrss_dw .= " user_dni ='" . $user_dni . "'";
	}

	if ($_GET["user_municipio"] != "") {

		if ($_GET["q"] != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
			$sql_rrss_dw .= " and ";
		}

		$sql .= " user_municipio ='" . $municipality . "'";
		$sql_rrss_dw .= " user_municipio ='" . $municipality . "'";
	}


	// if ($_GET["user_type"] != "" && intval($_GET["user_type"]) > 1) {
	if ($_GET["user_type"] != "") {

		if ($_GET["q"] != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
			$sql_rrss_dw .= " and ";
		}
		$sql .= " user_type ='" . $user_type . "'";
		$sql_rrss_dw .= " user_type ='" . $user_type . "'";
	}

	// solo admin visualiza la data nacional
	if ($_GET["user_estado"] != "" && ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6)) {
		if ($_GET["q"] != "" || $user_type != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
			$sql_rrss_dw .= " and ";
		}
		$sql .= " user_estado = '" . $estate . "'";
		$sql_rrss_dw .= " user_estado = '" . $estate . "'";
	} else if ($_GET["user_estado"] != "" && ($_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 6)) {
		if ($_GET["q"] != "" || $user_type != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
			$sql_rrss_dw .= " and ";
		}
		$sql .= " user_estado = '" . $estate . "'";
		$sql_rrss_dw .= " user_estado = '" . $estate . "'";
	} else if ($_GET["user_estado"] == "" && ($_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
		if ($_GET["q"] != "" || $user_type != "" || $user_municipio != "" || $_GET["user_dni"] != "") {
			$sql .= " and ";
			$sql_rrss_dw .= " and ";
		}
		$sql .= " user_estado = '" . $user_region . "'";
		$sql_rrss_dw .= " user_estado = '" . $user_region . "'";
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
	$url_pag = "<a href=\"?view=final_users&q=" . $_GET["q"] . "&user_estado=" . $_GET["user_estado"] . "&user_type=" . $_GET["user_type"] . "&municipio=" . $_GET["user_municipio"] . "&pag=";

	$sql_rrss = $sql_rrss . " where" . $sql_rrss_dw . " and (red_x!='' or red_facebook!='' or red_instagram!='' or red_linkedin!='' or red_youtube!='' or red_tiktok!='' or red_whatsapp!='' or red_telegram!='' or red_snapchat!='') order by user_estado desc";
	$param_sql = "true";

	// echo $sql_rrss;

} else {
	// $users = MunicipioData::getAll();

	if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3) {
		$sql = "SELECT * from final_users WHERE user_estado ='" . $user_region . "' order by id desc";
		$sql_dw = "SELECT * from final_users WHERE user_estado ='" . $user_region . "' order by id desc";
		$sql_rrss = $sql_rrss . " where user_estado ='" . $user_region . "' and (red_x!='' or red_facebook!='' or red_instagram!='' or red_linkedin!='' or red_youtube!='' or red_tiktok!='' or red_whatsapp!='' or red_telegram!='' or red_snapchat!='') GROUP BY user_dni order by user_estado desc";
	} else if ($_SESSION["user_type"] == 6 && $_SESSION["user_type"] == 7) {
		$sql = "SELECT * from final_users order by id desc";
		$sql_dw = "SELECT * from final_users order by id desc";
		$sql_rrss = $sql_rrss . " where (red_x!='' or red_facebook!='' or red_instagram!='' or red_linkedin!='' or red_youtube!='' or red_tiktok!='' or red_whatsapp!='' or red_telegram!='' or red_snapchat!='') GROUP BY user_dni order by user_estado desc";
	} else {
		$sql = "SELECT * from final_users WHERE user_estado ='" . $_SESSION["user_region"] . "' order by id desc";
		$sql_dw = "SELECT * from final_users WHERE user_estado ='" . $_SESSION["user_region"] . "' order by id desc";
		$sql_rrss = $sql_rrss . " where (red_x!='' or red_facebook!='' or red_instagram!='' or red_linkedin!='' or red_youtube!='' or red_tiktok!='' or red_whatsapp!='' or red_telegram!='' or red_snapchat!='') GROUP BY user_dni order by user_estado desc";
	}

	$base = new DatabasePg();
	$conn = $base->connectPg();

	if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {
		// total aproximado con pg_class all
		$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'final_users'");
		$row_table->execute();
		$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $total_data[0]["reltuples"];
		// $TotalReg = 1000;
	} else {
		// por regiones
		$total = FinalUsersData::getBySQL($sql);
		$TotalReg = $total[1];
	}


	$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = FinalUsersData::getBySQL($sql)[0];


	$url_pag = "<a href=\"?view=final_users&pag=";
	$param_csv = $sql_dw;
	$param_sql = "true";
	// 
	// echo $users[0]["id"];
	// echo $sql;
	// print_r($users[0]);

}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
// echo $param_csv;
$DB_name = "final_users";


?>

<?php if (count($users) > 0) {

?>
	<!-- si hay usuarios -->

	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
			<!-- <a href="./pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a> -->
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $sql_rrss . '&param_sql=true&filename=' . $DB_name . '_RRSS'; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a>
		<?php } ?>

		<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3) { ?>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $sql_rrss . '&param_sql=true&filename=' . $DB_name . '_RRSS'; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a>
		<?php } ?>

		<?php if ($_SESSION["user_type"] != 10) { ?>
			<a href="./../index.php?view=userform_new&new=1" class="btn btn-info">Agregar usuario</a>
		<?php } ?>
	</div>




	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">

					<table class="table table-bordered table-hover">
						<thead>
							<th><i class="fa fa-map" style="color:gray "></i> ID</th>
							<th><i class="fa fa-map" style="color:gray "></i> Estado</th>
							<th><i class="fa fa-user" style="color:gray "></i> Nombres</th>
							<th><i class="fa fa-user" style="color:gray "></i> Apellidos</th>
							<th><i class="fa fa-id-card" style="color:gray "></i> Cedulado</th>
							<th><i class="fa fa-credit-card" style="color:gray "></i> N° documento</th>
							<th><i class="fa fa-user-plus" style="color:gray "></i> Padre ref.</th>
							<th><i class="fa fa-users" style="color:gray "></i> Posición de hijo</th>
							<th><i class="fa fa-user" style="color:gray "></i> Edad</th>
							<th><i class="fa fa-phone" style="color:gray "></i> Teléfono</th>
							<th><i class="fa fa-lock" style="color:gray "></i> Permiso</th>
							<th><i class="fa fa-calendar" style="color:gray "></i> F.R</th>
							<th><i class="fa fa-gear" style="color:gray "></i> Herramientas</th>
						</thead>
						<?php
						$fecha_actual = date("Y", time());
						foreach ($users as $user) {
						?>
							<tr>
								<td><?php echo $user["id"]; ?></td>
								<td><?php echo $user["user_estado"]; ?></td>
								<td><?php echo ucwords($user["user_nombres"]); ?></td>
								<td><?php echo $user["user_apellidos"]; ?></td>
								<td><?php echo $user["user_has_document"]; ?></td>
								<td><?php echo $user["user_dni"]; ?></td>
								<td><?php echo $user["parent_ref"]; ?></td>
								<td><?php echo $user["child_number"]; ?></td>
								<td><?php echo $fecha_actual - date("Y", strtotime($user["user_f_nacimiento"])); ?></td>
								<td><?php echo $user["user_telefono"]; ?></td>
								<td><?php echo $user["user_type"]; ?></td>
								<td><?php echo $user["user_fecha_reg"]; ?></td>


								<td style="width:180px;">
									<?php if ($_SESSION["user_type"] != 10) { ?>
										<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

											<a href="./../index.php?view=finaluser_update&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></i></a>
											<a href="./?action=finaluser&function=delete&id=<?php echo $user["id"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></i></a>

										<?php } elseif (($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) && ($_SESSION["user_region"] == $user["user_estado"])) { ?>

											<a href="./../index.php?view=finaluser_update&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></i></a>
											<a href="./?action=finaluser&function=delete&id=<?php echo $user["id"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></i></a>

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
				echo "<p class='alert alert-danger'>Sin resultados</p>";
			}


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

			$("#estados").change(function() {

				$('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');

				$("#estados option:selected").each(function() {
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





		});
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