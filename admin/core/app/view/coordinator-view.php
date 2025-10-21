<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$coordinations = CoordTypeData::getAll();
// $estadoName = EstadoData::getNameById(6);
// echo CoordTypeData::getById(1);
?>



<!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->
<script>
	$(function() {
		if ('<?php echo $_GET['swal']; ?>' != "") {
			Swal.fire({
				position: 'top-center',
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

	});

	function del_item(url) {
		Swal.fire({
			title: "<br>¿Desea eliminar?",
			text: "¡Esto es irreversible!",
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
</script>

<!-- importar archivos por lotes -->
<?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx_coordinatorPg" method="POST" enctype="multipart/form-data" />
						<span class="btn btn-raised btn-round btn-default btn-file">
							<span class="fileinput-new">Select</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".xlsx" />
						</span>

						<button type="submit" name="subir" class="btn btn-default btn-block">
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
						<h4 class="card-title">Filtrar coordinador</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="coordinator">

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

									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
											<select name="estado" class="form-control" id="estado">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p): ?>
													<option value="<?php echo $p->id_estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>



									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i> Municipio</span>
											<select name="municipio" class="form-control" id="municipios_1">
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

$CantidadMostrar = 30;
$url_pag_atras = "";
$url_pag_adelante = "";
$user_region = $_SESSION["user_region"];

$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
$sql_rrss_dw = "";
$user_dni = (isset($_GET['user_dni'])) ? $_GET['user_dni'] : '';
$info_cod = (isset($_GET['info_cod'])) ? $_GET['info_cod'] : '';
$info_cod = strtoupper($info_cod);


$sql_rrss = "SELECT 
coordinators.f_state, 
coordinators.status_nom, 
coordinators.personal_type, 
coordinators.f_name, 
coordinators.f_lastname, 
coordinators.document_number, 
coordinators.phone_number, 
coordinators.gender, 
coordinators.email, 
final_users.red_x, 
final_users.red_facebook, 
final_users.red_instagram, 
final_users.red_linkedin, 
final_users.red_youtube, 
final_users.red_tiktok, 
final_users.red_whatsapp, 
final_users.red_telegram, 
final_users.red_snapchat, 
final_users.red_pinterest from coordinators INNER JOIN final_users ON (final_users.user_dni = coordinators.document_number) where";


$users = array();

if ((isset($_GET["q"]) && isset($_GET["estado"])) && ($_GET["q"] != "" || $_GET["estado"] != "")) {

	if ($_GET["estado"] != "") {
		$estate = EstadoData::getNameById($_GET["estado"]);
	}
	if ($_GET["municipio"] != "") {
		$municipality = MunicipioData::getNameById($_GET["municipio"]);
	}

	$sql = "SELECT * from coordinators where";

	if ($_GET["q"] != "") {
		$sql .= " (email = '$_GET[q]' or status_nom like '%$_GET[q]%' or f_name like '%$_GET[q]%' or document_number like '%$_GET[q]%' or f_lastname like '%$_GET[q]%')";
		$sql_rrss .= " (coordinators.email = '$_GET[q]' or coordinators.status_nom like '%$_GET[q]%' or coordinators.f_name like '%$_GET[q]%' or coordinators.document_number like '%$_GET[q]%' or coordinators.f_lastname like '%$_GET[q]%')";
	}

	if ($_GET["estado"] != "") {
		if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {
			if ($_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss .= " and ";
			}
			$sql .= " f_state ='" . $user_region . "'";
			$sql_rrss .= " coordinators.f_state ='" . $user_region . "'";
		} else if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
			if ($_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss .= " and ";
			}
			$sql .= " f_state ='" . $estate . "'";
			$sql_rrss .= " coordinators.f_state ='" . $estate . "'";
		} else {
			if ($_GET["q"] != "") {
				$sql .= " and ";
				$sql_rrss .= " and ";
			}
			$sql .= " f_state ='" . $_SESSION["user_region"] . "'";
			$sql_rrss .= " coordinators.f_state ='" . $_SESSION["user_region"] . "'";
		}
	}





	if ($_GET["municipio"] != "") {

		if ($_GET["estado"] != "") {
			$sql .= " and ";
			$sql_rrss .= " and ";
		}

		$sql .= " municipality ='" . $municipality . "'";
		$sql_rrss .= " coordinators.municipality ='" . $municipality . "'";
	}




	// echo $sql;
	$sql_dw = $sql;
	$sql_rrss = $sql_rrss . " and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
	$sql .= " order by id asc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	$users = CoordinatorsData::getAllPg($sql);
	$TotalReg = $users[1];

	$url_pag = "<a href=\"?view=coordinator&q=" . $_GET["q"] . "&estado=" . $_GET["estado"] . "&municipio=" . $_GET["municipio"] . "&pag=";
	$param_csv = $sql;
	$param_sql = "true";
} else {

	// jefe de estado y coordinadores 
	if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3) {
		$sql = "SELECT * from coordinators WHERE f_state ='" . $user_region . "' order by id asc";
		$users = CoordinatorsData::getAllPg($sql);
		// $TotalReg = $users[1];
		$sql_dw = "SELECT * from coordinators WHERE f_state ='" . $user_region . "' order by id asc";
		$sql_rrss = $sql_rrss . " coordinators.f_state ='" . $user_region . "' and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
		$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
	} else {
		$sql = "SELECT * from coordinators order by id asc";
		$sql_dw = "SELECT * from coordinators order by id asc";
		$sql_rrss = $sql_rrss . " (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
		$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
		$users = CoordinatorsData::getAllPg($sql);
	}

	// total aproximado con pg_class
	$conn = DatabasePg::connectPg();
	$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'coordinators'");
	$row_table->execute();
	$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
	$TotalReg = $total_data[0]["reltuples"];


	$url_pag = "<a href=\"?view=coordinator&pag=";

	// echo $sql;
	// echo $sql_rrss;
	$param_csv = $sql_dw;
	$param_sql = "true";
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
// echo $sql;
// echo $param_csv;
$DB_name = "coordinators";

?>

<div class="col-md-12">

	<?php if ($_SESSION["user_type"] != 10 && $_SESSION["user_type"] != 3) { ?>
		<a href="./index.php?view=newcoordinator" class="btn btn-info">Agregar coordinador</a>
	<?php } ?>
</div>


<!-- si hay usuarios -->
<?php if (count($users[0]) > 0) { ?>

	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
			<!-- <a href="./pdf/csv.php?param_csv=<!?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a> -->
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
			<!-- <a class="btn btn-success" href="../../../core/app/view/exportxlsxmysql.php?param=<!?php echo $sql_rrss . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a> -->
		<?php } ?>


		<?php if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8) { ?>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $sql_rrss . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a>
		<?php } ?>


	</div>




	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">

					<table class="table table-hover">
						<thead>
							<th> N°</th>
							<th><i class="fa fa-sliders" style="color:gray "></i> Coordinación</th>
							<th><i class="fa fa-map" style="color:gray "></i> Estado</th>
							<th><i class="fa fa-user" style="color:gray "></i> Nombres</th>
							<th><i class="fa fa-user" style="color:gray "></i> Apellidos</th>
							<th><i class="fa fa-credit-card" style="color:gray "></i> N° documento</th>
							<th><i class="fa fa-phone" style="color:gray "></i> Teléfono</th>
							<th><i class="fa fa-cog" style="color:gray "></i> Estatus</th>

							<th></th>
						</thead>
						<?php
						$count = 1;
						foreach ($users[0] as $user) {
						?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $user["coordination"]; ?></td>
								<td><?php echo $user["f_state"]; ?></td>
								<td><?php echo $user["f_name"]; ?></td>
								<td><?php echo $user["f_lastname"]; ?></td>
								<td><?php echo $user["document_number"]; ?></td>
								<td><?php echo $user["phone_number"]; ?></td>
								<td><?php echo $user["status_nom"]; ?></td>

								<td style="width:180px;">
									<?php if ($_SESSION["user_type"] != 10) { ?>
										<?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

											<a href="index.php?view=editcoordinator&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i>
													<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
													</svg></i>
											</a>

											<?php $URL = "./?action=coordinator&function=delete&id=" . $user["id"]; ?>
											<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm">
												<i>
													<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
													</svg>
												</i>
											</button>

										<?php } elseif (($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) && ($_SESSION["user_region"] == $user["f_state"])) { ?>

											<a href="index.php?view=editcoordinator&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i>
												<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
													</svg></i></a>

										<?php } ?>
									<?php } ?>

								</td>
							</tr>
						<?php
							$count++;

						}
						?>
					</table>

				</div>
			</div class="card-content table-responsive">
		</div>
		<!-- Botones de paginacion -->
		<?php
		if (count($users[0]) > 1) {
			include "core/app/layouts/pagination.php";
		}
		?>
	</div>

<?php } else { ?>

	<div class="col-md-12">
		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">
					<p class='alert alert-danger'>Sin resultados</p>
				</div>
			</div>
		</div>
	</div>

<?php } ?>



<script language="javascript">
	$(document).ready(function() {

		$("#estado").change(function() {

			$('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');

			$("#estado option:selected").each(function() {
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