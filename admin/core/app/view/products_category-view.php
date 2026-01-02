<script language="javascript">
	$(document).ready(function() {
		// NOTIFICACION
		if ('<?php echo $_SESSION['alert']; ?>' != "") {
			Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '<?php echo $_SESSION['alert']; ?>',
				showConfirmButton: false,
				timer: 1500
			})
		};

		<?php echo $_SESSION['alert'] = ""; ?>

	});



	async function del_item(url,id) {
		Swal.fire({
			title: "¿Desea eliminar?",
			text: "¡Esto es irreversible! y eliminará todas las dependencias de ésta categoría",
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
					function: "del_product_type",
					id: id
				};
				// 2. Construir la URL con los parámetros de búsqueda
				const params = new URLSearchParams(datos);
				// const url = `./?action=ajax&${params.toString()}`;

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
		document.getElementById("addcategory").addEventListener('submit', validarFormulario);
	});

	function validarFormulario(event) {
		event.preventDefault();
		$('#cover-spin').show(1);
		$.ajax({
				type: "POST",
				url: "./?action=ajax",
				// headers: {
				//     "X-CSRFToken": getCookie("csrftoken")
				// },
				data: {
					function: "add_product_cat",
					name: $("#product_type_name").val(),
					codigo: $("#codigo").val()
				}
			})
			.done(function(msg) {
				if (getOS() == "Android") {
					alert("Registro guardado");
				} else {
					toastify('Registro guardado', true, 1000, "dashboard");
				}

				// console.log(msg);
				// window.document.location=msg;
				location.reload();
				// $('#content').reload('#content');

			})
			.fail(function() {
				if (getOS() == "Android") {
					alert("Hubo un error al guardar, intenta nuevamente");
				} else {
					toastify('Hubo un error al guardar, intenta nuevamente', true, 5000, "warning");
				}
				$('#cover-spin').hide(0);
				return false;
			});
		// .always(function() {
		//     toastify('Finished',true,1000,"warning");
		// });
	};
</script>

<div id="cover-spin"></div>



<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Categoría de productos </b> </span>
								</a>
							</h4>
						</div>

						<br><br>

						<form method="post" id="addcategory" role="form">
							<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label for="product_type_name" class="control-label">Nombre categoría*</label>
										<input type="text" name="param" id="product_type_name" required class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="codigo" class="control-label">Código*</label>
										<input type="text" name="codigo" id="codigo" required class="form-control" placeholder="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="submit" name="" id="add" class="btn btn-primary btn-block">Agregar</button>
									</div>
								</div>
							</div>
						</form>






						<!-- Obtengo los datos para la paginacion -->
						<?php
						$CantidadMostrar = 20;
						$url_pag_atras = "";
						$url_pag_adelante = "";
						$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

						$products_cat = ProductsType::getBySQL("select * from categoria_productos");
						$TotalReg = count($products_cat);

						$sql = "SELECT * from categoria_productos order by id asc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						$param = ProductsType::getBySQL($sql);

						$url_pag = "<a href=\"?view=products_category&pag=";

						$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
						?>
						<!-- --------------------------- -->




						<!-- creo la tabla con la consulta -->
						<div class="card-content table-responsive">
							<div class="card-body">

								<?php if (count($param) > 0) { ?>
									<!-- si hay usuarios -->

									<div class="form-group text_label">
										<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
									</div>

									<table class="table table-bordered table-hover">
										<thead>
											<th>Tipo</th>
											<th>Código</th>
											<th></th>
										</thead>

										<?php foreach ($param as $types) { ?>
											<tr>
												<td><?php echo $types->nombre_categoria; ?></td>
												<td><?php echo $types->cod_categoria; ?></td>

												<td>

													<?php $url = "./?action=ajax&function=del_product_cat&id=". $types->id; ?>

													<a onclick="del_item('<?php echo $url; ?>', '<?php echo $types->id; ?>')" href="javascript:void(0);">
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

								<?php include "core/app/layouts/pagination.php"; ?>
							</div>


						</div class="card-content table-responsive">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>