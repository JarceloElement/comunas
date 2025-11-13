<script language="javascript">
	async function del_item(id) {
		Swal.fire({
			title: "¿Desea eliminar?",
			text: "¡Esto es irreversible! y eliminará todas las dependencias de ésta catrgoría",
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


	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("addproduct").addEventListener('submit', validarFormulario);
	});

	async function validarFormulario(event) {
		event.preventDefault();

		let url = "./?action=ajax";

		var formData = new FormData(event.target);
		formData.append('function', 'add_product_type'); // Agrega la función a llamar
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
				window.timer = setTimeout(function() {
					location.reload();
				}, 800);

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

	}
</script>

<div id="cover-spin"></div>

<?php
$products_cat = ProductsType::getBySQL("select * from categoria_productos");
?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Crear tipo de productos </b> </span>
								</a>
							</h4>
						</div>


						<form method="post" id="addproduct" role="form">
							<div class="row">


								<div class="col-md-6">
									<div class="form-group">
										<label for="categoria" class="control-label">Categoría del producto*</label>
										<select name="categoria" class="form-control" id="categoria" required>
											<option value=""><?php echo "-SELECCIONE-" ?></option>
											<?php foreach ($products_cat as $p) : ?>
												<option value="<?php echo $p->nombre_categoria; ?>"><?php echo $p->nombre_categoria ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="codigo" class="control-label">Formato</label>
										<select name="codigo" class="form-control" id="codigo" required>
											<option value=""><?php echo "-SELECCIONE-" ?></option>
											<option value="formulario">Formulario</option>
											<option value="imagen">Imagen</option>
											<!-- <option value="video">Video</option> -->
											<option value="calc">Hoja de cálculo</option>
											<option value="writer">Documento de texto</option>
											<option value="rrss">Redes Sociales</option>
											<option value="video">Video</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="tipo" class="control-label">Nombre del producto</label>
										<input type="text" name="tipo" id="tipo" required class="form-control" placeholder="">
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

						$products_cat = ProductsType::getBySQL("select * from products_type");
						$TotalReg = count($products_cat);

						$sql = "SELECT * from products_type order by id asc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						$param = ProductsType::getBySQL($sql);

						$url_pag = "<a href=\"?view=products_type&pag=";

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
											<th>Categoría</th>
											<th>Producto</th>
											<th>Formato</th>
											<th></th>
										</thead>

										<?php foreach ($param as $types) { ?>
											<tr>
												<td><?php echo $types->tipo_categoria; ?></td>
												<td><?php echo $types->name; ?></td>
												<td><?php echo $types->cod_producto; ?></td>
												<td>
													<a onclick="del_item('<?php echo $types->id; ?>')" title="Eliminar">
														<button type="button" class="btn btn-danger btn-sm"><i>
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
																	<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
																</svg></i>
														</button>
													</a>
												</td>

												<!-- <td style="width:180px;"><a href="./?action=ajax&function=del_product_type&id=<!?php echo $types->id; ?>&type=<!?php echo $_GET["type"]; ?>" class="btn btn-danger btn-xs">Eliminar</a></td> -->
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