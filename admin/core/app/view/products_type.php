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


	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("addproduct").addEventListener('submit', validarFormulario);
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
					function: "add_product_type",
					categoria: $("#categoria").val(),
					tipo: $("#tipo").val(),
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


								<div class="col-md-12">
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
										<label for="tipo" class="control-label">Tipo de producto</label>
										<input type="text" name="tipo" id="tipo" required class="form-control" placeholder="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="codigo" class="control-label">Código del producto</label>
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

						$products_cat = ProductsType::getBySQL("select * from products_type");
						$TotalReg = count($products_cat);

						$sql = "SELECT * from products_type order by tipo_categoria asc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						$param = ProductsType::getBySQL($sql);

						$url_pag = "<a href=\"?view=data&type=" . $_GET["type"] . "&pag=";

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
											<th>Código</th>
											<th></th>
										</thead>

										<?php foreach ($param as $types) { ?>
											<tr>
												<td><?php echo $types->tipo_categoria; ?></td>
												<td><?php echo $types->name; ?></td>
												<td><?php echo $types->cod_producto; ?></td>
												<td style="width:180px;"><a href="./?action=ajax&function=del_product_type&id=<?php echo $types->id; ?>&type=<?php echo $_GET["type"]; ?>" class="btn btn-danger btn-xs">Eliminar</a></td>
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