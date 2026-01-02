<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<script language="javascript">
	async function del_item(id) {
		Swal.fire({
			title: "<br>¿Desea eliminar?",
			text: "¡Esto es irreversible!",
			// icon: "warning",
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
					function: "del_user_type",
					id: id
				};
				// 2. Construir la URL con los parámetros de búsqueda
				const params = new URLSearchParams(datos);
				const url = `./?action=ajax&${params.toString()}`;

				try {
					const res = await fetch(url);

					if (res.ok) {
						// console.log(res);
						const array = await res.json();
						// console.log(array);
						toastify(array.alert, true, 13000, array.alert_type);
						$('#cover-spin').hide(0);
						if (array.error == 'false') {
							window.timer = setTimeout(function() {
								location.reload();
							}, 800);
						}

					} else {
						const errorText = await res.text();
						$('#cover-spin').hide(0);
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





	$(document).ready(function() {
		// NOTIFICACION
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



		$('#add_user').click(async function(event) {
			event.preventDefault();

			let url = "./?action=ajax";
			var formData = new FormData(document.getElementById('add_user_type'));
			formData.append('function', 'add_user_type'); // Agrega la función a llamar
			// console.log(formData);

			$('#cover-spin').show(0);

			try {
				const res = await fetch(url, {
					method: 'POST',
					body: formData
				});

				if (res.ok) {
					const result_await = await res.text();
					// console.log(result_await);
					var array = JSON.parse(result_await);
					toastify(array.alert, true, 13000, array.alert_type);
					$('#cover-spin').hide(0);
					if (array.error == 'false') {
						window.timer = setTimeout(function() {
							location.reload();
							// location.href = './?view=strategic_action';
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

		});




	});
</script>



<div class="panel-heading">
	<h4 class="title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
			<span class='text_label'> <i class='fa fa-signal icon_label'></i> <b> Tipo de usuario </b> </span>
		</a>
	</h4>
</div>
Sala de Autogobierno u Organización (1)
<br>
Facilitador o Promotor (2)
<br>
Coordinador estadal (3)
<br>
Gerencias nacional (Solo revisión) (4)
<!-- Gerencia RNI (5) -->
<br>
Gerencias nacional (Genera reportes) (5)
<!-- Gerencia RNI (5) -->
<br>
Dirección de Políticas Públicas de Min Comunas (6)
<br>
Administración del sistema (7)
<br>
Jefe de Estado o Responsable de Sala Unificada (8)
<!-- Gerencias ADMIN (9) -->

<div class="content-wrapper">
	<!-- <div class="card-header">
        <h6 class="card-text">1: Usuario final, 2: Facilitador, 3: Coordinador estadal, 4: Gerencia sustantiva, 5. Gerencia principal 6. Políticas públicas 7. Administración del sistema </h6>
		<br>
	</div> -->

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-content table-responsive">
					<div class="card-body">
						<form method="post" id="add_user_type" role="form">
							<br>
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail1" class="control-label"><i class="fa fa-user-cog"></i> Nombre: ejem. (Admin,Coord)*</label>
									<input type="text" name="user_type_name" id="user_type_name" required class="form-control" placeholder="Nombre de usuario">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail1" class="control-label"><i class="fa fa-lock"></i> Privilegios del 1-5*</label>
									<input type="number" name="user_type" id="user_type" required class="form-control" placeholder="1-5">
								</div>
							</div>



							<div class="col-lg-6">
								<div class="form-group">
									<button type="submit" id="add_user" class="btn btn-primary btn-block">Agregar</button>
								</div>
							</div>
						</form>


						<?php

						$CantidadMostrar = 10;
						$url_pag_atras = "";
						$url_pag_adelante = "";

						// Validado  la variable GET
						$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


						$total = UserTypeData::getAll();
						$TotalReg = count($total);

						$sql = "select * from user_type order by id asc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						$param = UserTypeData::getBySQL($sql);

						$url_pag = "<a href=\"?view=data&&swal=&pag=";

						//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
						$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);

						?>

						<!-- MENSAJE DE TOTALES -->
						<div class="card-content">
							<div class="card-body">
								<div class="form-group text_label">
									<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br>"; ?>
								</div>
							</div>
						</div class="card-content">


						<!-- LISTA DE REGISTROS -->
						<div class="card-content table-responsive">
							<?php if (count($param) > 0) { ?>
								<!-- si hay usuarios -->

								<table class="table table-bordered table-hover">
									<thead>
										<th>Nombre</th>
										<th>Privilegios</th>
										<th>Acciones</th>
									</thead>

									<?php
									foreach ($param as $types) {
										// $pacient  = $user->getPacient();
										// $medic = $user->getMedic();
									?>
										<tr>
											<td><?php echo $types->user_type_name; ?></td>
											<td><?php echo $types->user_type; ?></td>

											<td style="width:80px;">
												<!-- <a href="index.php?view=editmunicipio&id=<!?php echo $user->id_municipio;?>" class="btn btn-warning btn-xs">Editar</a> -->
												<!-- <a href="./?action=delinternettype&id=<!?php echo $types->id;?>" class="btn btn-danger btn-xs">Eliminar</a> -->
												<a onclick="del_item('<?php echo $types->id; ?>')" href="javascript:void(0);">
													<button type="button" class="btn btn-danger btn-sm"><i>
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
															</svg></i>
													</button>
												</a>

											</td>
										</tr>
									<?php

									}
									?>
								</table>


							<?php
							} else {
								echo "<p class='alert alert-danger'>No hay registros</p>";
							}
							?>

						</div class="card-content table-responsive">
						<!-- FIN LISTA DE REGISTROS -->

					</div class="row">
					</form>
				</div class="card-body">





				<!-- PAGINACION -->
				<?php include "core/app/layouts/pagination.php"; ?>
				<!-- FIN PAGINACION -->

			</div class="content-wrapper">
		</div>
	</div>
</div>