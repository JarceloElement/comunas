<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<script language="javascript">
	async function del_item(id) {
		Swal.fire({
			title: "¿Desea eliminar?",
			text: "¡Esto es irreversible!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "¡Sí, eliminar!",
			cancelButtonText: "Cancelar",
		}).then(async (result) => {
			if (result.isConfirmed) {

				$('#cover-spin').show(0);

				// 1. Datos para la URL
				const datos = {
					function: "del_organizacion",
					id: id
				};
				// 2. Construir la URL con los parámetros de búsqueda
				const params = new URLSearchParams(datos);
				const url = `./?action=ajax&${params.toString()}`;

				try {
					// 3. Realizar la solicitud GET, sin 'method' ni 'body'
					const res = await fetch(url);

					if (res.ok) {
						// console.log(res);
						const array = await res.json();
						// console.log(array);
						toastify(array.alert, true, 13000, array.alert_type);
						$('#cover-spin').hide(0);
						if (array.err == 'false') {
							window.timer = setTimeout(function() {
								location.reload();
							}, 800);
						}

					} else {
						// Leer la respuesta como texto para depurar
						const errorText = await res.text();
						$('#cover-spin').hide(0);
						// Mostrar el texto de error real del servidor
						toastify(`Error del servidor: ${errorText}`, true, 12000, "error");
						throw new Error(`Error de red: ${res.statusText}`);
					}

				} catch (error) {
					$('#cover-spin').hide(0);
					toastify(`Error inesperado: ${error.message}`, true, 12000, "error");
					console.error("Detalle del error:", error);
				}
			}
		});
	};



	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("addline").addEventListener('submit', validarFormulario);
	});

	async function validarFormulario(event) {
		event.preventDefault();

		if ($("#action_line_name").val() != "") { // valida la informacion

			let url = "./?action=ajax";

			var formData = new FormData(event.target);
			formData.append('function', 'add_action_line'); // Agrega la función a llamar
			// console.log(formData);

			$('#cover-spin').show(0);

			try {
				const res = await fetch(url, {
					method: 'POST',
					body: formData
				});

				if (res.ok) {
					// console.log(res);
					const result_await = await res.text();
					var array = JSON.parse(result_await);
					// console.log(array);
					toastify(array.alert, true, 13000, array.alert_type);
					$('#cover-spin').hide(0);
					if (array.error == 'false') {
						window.timer = setTimeout(function() {
							location.reload();
						}, 800);
					}

				} else {
					$('#cover-spin').hide(0);
					toastify(res.statusText, true, 12000, "error");
					throw res.statusText;
				}

			} catch (error) {
				$('#cover-spin').hide(0);
				toastify(error, true, 12000, "error");
				throw error;
			}
		};

	}



	// SCRIPTS FUCNTIONS
	$(document).ready(function() {
		$('#cover-spin').hide(0);

		// <!-- MODAL SWEET ALERT -->
		$(function() {
			<?php if (isset($_SESSION['alert']) && $_SESSION['alert'] != "") : ?>
				if (getOS() != "Android") {
					Swal.fire({
						icon: 'success',
						title: '<?php echo $_SESSION['alert']; ?>',
						showConfirmButton: false,
						timer: 1000
					})
				} else {
					alert("<?php echo $_SESSION['alert']; ?>");
				}

				<?php echo $_SESSION['alert'] = ""; ?>

			<?php endif; ?>
		});



	});

	function uploadXLSX() {
		$('#cover-spin').show(0);
	}
</script>



<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx_organizaciones" method="POST" enctype="multipart/form-data" />
						<span class="btn btn-raised btn-round btn-default btn-file">
							<span class="fileinput-new">Select</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="datafile" id="file-input" class="file-input__input" accept=".xlsx" />
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
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Organizaciones comunales </b> </span>
								</a>
							</h4>
						</div>

						<br><br>

						<!-- <form method="post" id="addline" role="form">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="action_line_name" class="control-label">Nueva línea de acción</label>
										<input type="text" name="name" id="action_line_name" required class="form-control" placeholder="Nombre">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="permisos" class="control-label"><i class="fa fa-cogs"></i> Habilitar solo a los infocentros marcados</label>
										<textarea type="text" name="permisos" id="permisos" class="form-control" placeholder="AMA01, AMA02"></textarea>
										<span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block">Agregar</button>
									</div>
								</div>
							</div>
						</form> -->

						<!-- Obtengo los datos para la paginacion -->
						<?php
						$CantidadMostrar = 20;
						$url_pag_atras = "";
						$url_pag_adelante = "";

						// Validado  la variable GET
						$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

						// $total = ActionsLineData::getAll();
						// $TotalReg = count($total);

						// $sql = "SELECT * from actions_line order by line_id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						// $param = ActionsLineData::getBySQL($sql);

						// pg
						$total = OrganizacionesData::getAllPg("SELECT * from organizaciones order by code_info");
						$TotalReg = $total[1];

						$sql = "SELECT * from organizaciones order by code_info asc";

						$param_csv = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
						$param_sql = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
						$DB_name = "organizaciones";

						$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
						$param = OrganizacionesData::getAllPg($sql);


						$url_pag = "<a href=\"?view=organizaciones&pag=";

						//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
						$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
						?>
						<!-- --------------------------- -->




						<!-- creo la tabla con la consulta -->
						<div class="card-content table-responsive">
							<div class="card-body">

								<?php if ($param != "null") { ?>
									<!-- si hay usuarios -->

									<div class="form-group text_label">
										<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
									</div>


									<!-- botones de descarga de reportes -->
									<div class="col-md-12">
										<div class="input-group">
											<!-- <a href="./pdf/csv_pdo.php?param_csv=<!?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>"
												name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV
											</a> -->
											<a target="_blank" class="btn btn-success"
												href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>"
												name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX
											</a>

										</div>

										<br>
									</div>


									<table class="table table-bordered table-hover">
										<thead>
											<th>Cod Infocentro</th>
											<th>Cod Organización</th>
											<th>Nombre Organización</th>
											<th></th>
										</thead>

										<?php foreach ($param[0] as $types) {
										?>
											<tr>
												<td><?php echo $types["code_info"]; ?></td>
												<td><?php echo $types["codigo_organizacion"]; ?></td>
												<td><?php echo $types["nombre_organizacion"]; ?></td>
												<td style="width:180px;">
													<a href="./?view=edit_organizacion&id=<?php echo $types["id"]; ?>" class="btn btn-warning btn-lm"><i class="material-icons">edit</i></a>
													<a onclick="del_item('<?php echo $types['id']; ?>')" title="Eliminar">
														<button type="button" class="btn btn-danger btn-sm"><i>
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																	<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
																</svg></i>
														</button>
													</a>
												</td>

											</tr>
										<?php }	?>

									</table>
								<?php
								} else {
									echo "<p class='alert alert-danger'>No hay registros</p>";
								}
								?>

							</div>

						</div class="card-content table-responsive">

						<!-- Botones de paginacion -->
						<?php include "core/app/layouts/pagination.php"; ?>

					</div>




				</div>


			</div>
		</div>
	</div>
</div>