<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estado = EstadoData::getAll();
// $municipio = MunicipioData::getAll();
// $internet_type = InternetTypeData::getAll();
// $operative_info = OperativeInfoData::getAll();
// $status_type = StatusInfocentroData::getAll();

$location = "index.php?view=process";
if (isset($_GET['pag'])) {
	$pagination = $_GET["pag"];
} else {
	$pagination = "";
}

?>

<script type="text/javascript">
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


	$(function() {

		// anima la notificacion
		$(function() {
			<?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
				Swal.fire({
					// position: 'top-center',
					icon: 'success',
					title: '<?php echo $_GET['swal']; ?>',
					showConfirmButton: true,
					timer: 1500
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
			// $('#modal-secondary').modal('show');

			Swal.fire({
				title: this.id,
				text: this.value,
				width: 600,
				// padding: '3em',
				backdrop: `rgba(0,0,123,0.4)`,
			})

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
		<div class="modal-content bg-secondary">
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

	<center>
		<div class="row">
			<div class="col-md-12">

				<!-- ACTUALIZAR REGISTROS POR LOTES -->
				<div class="col-md-4">
					<!-- <form action="core/app/view/recibe_excel.php" method="POST" enctype="multipart/form-data"/> -->
					<form action="index.php?view=import_xlsx_info_inventory" method="POST" enctype="multipart/form-data" />
					<span class="btn btn-raised btn-round btn-default btn-file">
						<span class="fileinput-new"></span>
						<span class="fileinput-exists"></span>
						<input type="file" name="info_inventory" id="file-input" class="file-input__input" accept=".xlsx" />
					</span>
					<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-info btn-block"><i class="far fa-file"></i> Subir Archivo XLSX</button>
					</form>
				</div>

			</div>
		</div>
	</center>


<?php } ?>



<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar inventario de infocentros</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">


							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="inventory">


								<div class="form-group col-mg-12">
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
											<select name="estado" class="form-control" id="estados">
												<option value="">ESTADO</option>
												<?php foreach ($estado as $p): ?>
													<option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-lg-6">
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

$q = isset($_GET["q"]) ? $_GET["q"] : "";
$estado_q = isset($_GET["estado"]) ? $_GET["estado"] : "";
$pag = isset($_GET["pag"]) ? $_GET["pag"] : "";


// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
$compag = $compag = "" ? $compag : 1;


$users = array();
if ((isset($q) || isset($estado_q)) && ($q != "" || $estado_q != "")) {
	$sql = "SELECT * from info_inventory where ";

	if ($q != "") {
		$sql .= " (code_info like '%$q%') ";
	}

	if ($estado_q != "") {
		if ($q != "") {
			$sql .= " and ";
		}
		$sql .= " estado ='" . $estado_q . "'";
	}


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
	$url_pag = "<a href=\"?view=inventory&q=" . $q . "&estado=" . $estado_q . "&pag=";

	$param_csv = $sql;
	$param_sql = "true";
} else {

	$region = $_SESSION['user_region'];
	if ($_SESSION["user_type"] == 8) {
		$sql = "SELECT * from info_inventory WHERE estado='$region' order by code_info asc ";
	} else {
		$sql = "SELECT * from info_inventory order by code_info asc ";
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

	$url_pag = "<a href=\"?view=inventory&pag=";
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
$DB_name = "info_inventory";


?>



<?php if (count($users) > 0) { ?>

	<!-- si hay usuarios -->
	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<!-- <a href="./pdf/csv.php?param_csv=<!?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV </a> -->
		<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>

		<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9): ?>
			<!-- <a href="./index.php?view=newinfocentro" class="btn btn-info">Agregar infocentro</a> -->
		<?php endif ?>
	</div>








	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="form-group">
							<div class="card-body">

								<div class="card-content table-responsive">
									<div class="card-body">

										<table class="table table-bordered table-hover">
											<!-- INONOS -->
											<thead>
												<th class="text_label "> <i class="fa fa-map-marker icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>
												<th class="text_label "> <i class="fa fa-tag icon_table"></i></th>

												<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
													<th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
												<?php } ?>
											</thead>

											<thead>
												<th>Estado</th>
												<th>cod. Info</th>
												<th>Des. PC</th>
												<th>T. PC asignados</th>
												<th>T. PC operativos</th>
												<th>T. PC inoperativos</th>
												<th>Causa PC inoperativos</th>
												<th>Desc. impresora</th>
												<th>T. impresora</th>
												<th>T. impresora ope.</th>
												<th>T. impresora inop.</th>
												<th>Causa impresora inoperativos</th>
												<th>Desc. fotocopiadora</th>
												<th>T. fotocopiadora</th>
												<th>T. fotocopiadora ope.</th>
												<th>T. fotocopiadora inop.</th>
												<th>Causa fotocopiadoras inoperativas</th>
												<th>Desc. video beam</th>
												<th>T. video beam</th>
												<th>Estado videobeam.</th>
												<th>Causa videobeam inoperativo</th>
												<th>Desc. scanner</th>
												<th>T. scanner</th>
												<th>Estado scanner.</th>
												<th>Causa scanner inoperativo</th>
												<th>T. escritorio ope.</th>
												<th>T. escritorio inope.</th>
												<th>T. escritorios</th>
												<th>T. sillas ope.</th>
												<th>T. sillas inope.</th>
												<th>T. sillas</th>
												<th>T. aire ope.</th>
												<th>T. aire inope.</th>
												<th>T. aires</th>
												<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>
													<th>Acciones</th>
												<?php } ?>
											</thead>

											<?php
											$count = 0;
											foreach ($users as $user) {
												$count = $count + 1;
												// $id_item = (string)$count;
											?>
												<tr>
													<td><?php echo $user['estado']; ?></td>
													<td><?php echo $user['code_info']; ?></td>
													<td><?php echo $user['desc_pc']; ?></td>
													<td><?php echo $user['t_pc_asig']; ?></td>
													<td><?php echo $user['t_pc_ope']; ?></td>
													<td><?php echo $user['t_pc_inope']; ?></td>
													<td><label style="font-size: 10px; color:#585858; width:300px;"><?php echo $user['causa_imp_inop']; ?><?php echo $user['causa_pc_inop']; ?></label></td>
													<td><label style="font-size: 10px; color:#585858;"><?php echo $user['desc_impresora']; ?></label></td>
													<td><label style="font-size: 10px; color:#585858;"><?php echo $user['t_impresora']; ?></label></td>
													<td><?php echo $user['t_imp_ope']; ?></td>
													<td><?php echo $user['t_imp_inop']; ?></td>
													<td><label style="font-size: 10px; color:#585858;"><?php echo $user['causa_imp_inop']; ?></label></td>
													<td><?php echo $user['desc_fotocopiadora']; ?></td>
													<td><?php echo $user['t_fotocopiadora']; ?></td>
													<td><?php echo $user['t_fotoc_ope']; ?></td>
													<td><?php echo $user['t_fotoc_inop']; ?></td>
													<td><?php echo $user['causa_fotoc_inop']; ?></td>
													<td><?php echo $user['desc_video']; ?></td>
													<td><?php echo $user['t_video']; ?></td>
													<td><?php echo $user['estado_video']; ?></td>
													<td><?php echo $user['causa_video_inop']; ?></td>
													<td><?php echo $user['desc_scanner']; ?></td>
													<td><?php echo $user['t_scanner']; ?></td>
													<td><?php echo $user['estado_scan']; ?></td>
													<td><?php echo $user['causa_scan_inop']; ?></td>
													<td><?php echo $user['t_escrit_ope']; ?></td>
													<td><?php echo $user['t_escrit_inop']; ?></td>
													<td><?php echo $user['t_escrit']; ?></td>
													<td><?php echo $user['t_sillas_ope']; ?></td>
													<td><?php echo $user['t_silas_inop']; ?></td>
													<td><?php echo $user['t_sillas']; ?></td>
													<td><?php echo $user['t_aires_ope']; ?></td>
													<td><?php echo $user['t_aires_inop']; ?></td>
													<td><?php echo $user['t_aires']; ?></td>

													<?php if ($_SESSION["user_type"] != 10) { ?>
														<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9  || $_SESSION["user_type"] == 10) { ?>
															<td style="width:180px;">

																<?php $URL = "index.php?action=del_inventory&id=" . $user['id'] . "&q=" . $q . "&estado=" . $estado_q . "&pag=" . $pag; ?>
																<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>

															</td>
														<?php } ?>
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
							echo "<p class='alert alert-danger'>No hay registros</p>";
						}
							?>

							</div class="card-content table-responsive">
						</div>
					</div>
				</div>


				<?php if (count($users) > 0) { ?>

					<!-- Botones de paginacion -->
					<?php include "core/app/layouts/pagination.php"; ?>

				<?php } ?>




				<script>
					$(function() {



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