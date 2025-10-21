<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<script language="javascript">
	$(document).ready(function() {
		// NOTIFICACION
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

<!-- <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
                        <h5>Reportes eliminados</h5>
                    </div>
                </div>
            </div>
        </div> -->

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="form-group">
						<br>
						<div class="col-md-12">
							<h4><b>Reportes eliminados</b></h4>
						</div>
						<br>

						<form class="form-horizontal" role="form">
							<input type="hidden" name="view" value="log_deleted">
							<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>

								<div class="form-group">
									<div class="col-md-12 mui-textfield mui-textfield--float-label">
										<input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																				echo $_GET["q"];
																			} ?>">
										<label><i class="fa fa-search"></i> Filtrar por palabra clave</label>
									</div>

									<div class="col-lg-4">
										<button class="btn btn-primary btn-block">Buscar</button>
									</div>
								</div>
							<?php } ?>

						</form>
					</div>


					<div class="form-group">
						<div class="card-content table-responsive">
							<div class="card-body">

								<?php

								$CantidadMostrar = 100;
								$url_pag_atras = "";
								$url_pag_adelante = "";

								// Validado  la variable GET
								$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


								$_GET["q"] = isset($_GET["q"]) ? $_GET["q"] : "";
								$users = array();

								if ((isset($_GET["q"])) && ($_GET["q"] != "")) {

									$sql = "SELECT * from del_log WHERE datetime between '2024-01-01' and '2025-12-31' and";

									// solo admin visualiza la data nacional
									if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {
										if ($_GET["q"] != "") {
											$sql .= " (user_id='$_GET[q]' or code_deleted='$_GET[q]' or state_deleted='$_GET[q]' or type_deleted='$_GET[q]' or line_action='$_GET[q]') ";
										}
									} else {
										if ($_GET["q"] != "") {
											$sql .= " state_deleted='" . $_SESSION["user_region"] . "' and (user_id='$_GET[q]' or code_deleted='$_GET[q]' or state_deleted='$_GET[q]' or type_deleted='$_GET[q]' or line_action='$_GET[q]') ";
										}
									}




									// filtra por region de facilitador, coordinador y jefe estadal
									// if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8) {
									// 	$sql .= " and state_deleted ='".$_SESSION["user_region"]."'";
									// }

									// Busca el total de registros segun parametros de consulta
									$param = $sql;
									$users = LogDelete::getBySQL($sql . " order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar);
									// $TotalReg = count($users);

									$total = LogDelete::getBySQL($sql . " order by id");
									$total_q = count($total);
									$TotalReg = $total_q;
									// Asigna url de paginacion
									$url_pag = "<a href=\"?view=log_deleted&q=" . $_GET["q"] . "&pag=";
								} else {
									if ($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8) {

										$sql = "SELECT * from del_log WHERE datetime between '2024-01-01' and '2025-12-31' and state_deleted='" . $_SESSION["user_region"] . "' order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
										$users = LogDelete::getBySQL($sql);

										$query = "SELECT * from del_log WHERE datetime between '2024-01-01' and '2025-12-31' and state_deleted='" . $_SESSION["user_region"] . "' ";
										$total_r = LogDelete::getBySQL($query);
										$total_q = count($total_r);
									} else {
										$sql = "SELECT * from del_log WHERE datetime between '2024-01-01' and '2025-12-31' order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
										$users = LogDelete::getBySQL($sql);
										$total_q = count(LogDelete::getAll());
									}
									$TotalReg = $total_q;
									// $TotalReg = count($users);

									// $url_pag = "<a href=\"?view=log_deleted=users&pag=";
									$url_pag = "<a href=\"?view=log_deleted&q=" . $_GET["q"] . "&pag=";
								}
								// echo $sql ;
								$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
								?>


								<?php

								if (count($users) > 0) {
									// si hay usuarios
								?>
									<div class="row">
										<div class="col-md-12">
											<h5><b><?php echo "Total registros: " . $total_q; ?></b></h5>
										</div>
									</div>

									<table class="table table-bordered table-hover">
										<thead>
											<th>Eliminado por UID</th>
											<th>Eliminado por CodeInfo</th>
											<th>ID borrado</th>
											<th>Código borrado</th>
											<th>Estado borrado</th>
											<th>Tipo de reporte borrado</th>
											<th>Línea de acc.</th>
											<th>Título</th>
											<th>T. hombres</th>
											<th>T. mujeres</th>
											<th>Fecha borrado</th>
											<!-- <th style="width: 250px;"> Acciones</th> -->
										</thead>
										<?php
										foreach ($users as $user) {
										?>

											<!-- USUARIO CON PRIVILEGIO MAYOR O IGUAL A  -->
											<?php if ($_SESSION["user_type"] >= 2) { ?>

												<tr>
													<td><?php echo $user->user_id; ?></td>
													<td><?php echo $user->user_code_info ?></td>
													<td><?php echo $user->id_deleted; ?></td>
													<td><?php echo $user->code_deleted; ?></td>
													<td><?php echo $user->state_deleted; ?></td>
													<td><?php echo $user->type_deleted; ?></td>
													<td><?php echo $user->line_action; ?></td>
													<td><?php echo $user->activity_title; ?></td>
													<td><?php echo $user->t_hombres; ?></td>
													<td><?php echo $user->t_mujeres; ?></td>
													<td><?php echo $user->datetime; ?></td>
												</tr>


											<?php } ?>

										<?php
										}
										?>
									</table>

								<?php
								} else {
									// no hay usuarios
									echo "<p class='alert alert-danger'>No hay registros</p>";
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<center>

	<?php

	/*Sector de Paginacion */
	if (count($users) > 0) {

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
	}
	?>

</center>