<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">
	$('#cover-spin').show(0);


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






	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("validar").addEventListener('submit', validarFormulario);
	});

	function validarFormulario(event) {
		event.preventDefault();

		$('#cover-spin').show(0);

		$.ajax({
				type: "POST",
				url: "./?action=ajax",
				// headers: {
				//     "X-CSRFToken": getCookie("csrftoken")
				// },
				data: {
					function: "add_product", // funcion que llama
					id_activity: $("#id_activity").val(), // parametros
					activity: $("#activity").val(),
					estate: $("#estate").val(),
					code_info: $("#code_info").val(),
					action_performed: $("#action_performed").val(),
					date_activity: $("#date_activity").val(),
					format: $("#format").val(),
					format_detail: $("#format_detail").val(),
					quantity_created: $("#quantity_created").val(),
					quantity_published: $("#quantity_published").val(),
					web_link: $("#web_link").val()
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

		// this.submit();

	};
</script>


<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
// $products_type = ProductsType::getAll();
$products_cat = ProductsType::getBySQL("select * from categoria_productos");
?>






<div id="cover-spin"></div>








<div class="col-md-12">
	<div class="panel-heading">
		<h4 class="title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
				<span class='text_label'> <i class='fa fa-sliders icon_label'></i> <b> Lista de productos en: <?php echo $_GET["activity_title"] ?> </b> </span>
			</a>
		</h4>
	</div>
</div>

<?php if ($_SESSION["user_id"] == $_GET['user_id'] || $_SESSION['user_type'] == 7 || (($_SESSION["user_type"] == 8 || $_SESSION["user_rol"] == 'Políticas públicas') && $_SESSION["user_region"] == $_GET["estate"])) { ?>


	<div class="card-body">
		<h6 class="card-category text-info text-center">
			<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M11 21v-2h8v-7.1q0-2.925-2.037-4.962T12 4.9T7.038 6.938T5 11.9V18H4q-.825 0-1.412-.587T2 16v-2q0-.525.263-.987T3 12.275l.075-1.325q.2-1.7.988-3.15t1.975-2.525T8.762 3.6T12 3t3.225.6t2.725 1.663t1.975 2.512t1 3.15l.075 1.3q.475.225.738.675t.262.95v2.3q0 .5-.262.95t-.738.675V19q0 .825-.587 1.413T19 21zm-2-7q-.425 0-.712-.288T8 13t.288-.712T9 12t.713.288T10 13t-.288.713T9 14m6 0q-.425 0-.712-.288T14 13t.288-.712T15 12t.713.288T16 13t-.288.713T15 14m-8.975-1.55Q5.85 9.8 7.625 7.9T12.05 6q2.225 0 3.913 1.412T18 11.026Q15.725 11 13.813 9.8t-2.938-3.25q-.4 2-1.687 3.563T6.025 12.45"/></svg></i>
		</h6>
		<h6 class="card-category text-danger text-center">
			<!-- Si has publicado varios productos en redes sociales el mismo día, debes reportar una sola actividad de acción en redes para todos los productos, en el formulario irás agregando cada producto, uno a la vez. En resumen no se debe crear un reporte por cada publicación en redes cuando se hayan generado el mismo día. -->
			Todos los productos que hayan sido publicados en redes sociales el mismo día, se cargaran en un mismo reporte. | Para cada enlace generado se agrega un producto aparte, pero en este mismo reporte.
		</h6>
		<!-- <h6 class="card-category text-info text-center">
		AVISO: A partir del 1 de agosto no se crearan los reportes de actividades desde este módulo de Reportes, la nueva forma será primero planificar la actividad en la sección de planificación y se cambia el estatus a ejecutada, luego se cargan participantes, productos e imágenes.
	</h6> -->
	</div>

	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">

						<div class="card-header card-header-primary">
							<h4 class="title">Agregar producto</h4>
							<!-- <p class="card-category">Complete your profile</p> -->
						</div>

						<br>
						<div class="card-body">

							<form method="post" id="validar" role="form">
								<!-- <form class="form-horizontal" role="form" method="post" action="./?action=ajax"> -->
								<input type="hidden" name="id_activity" id="id_activity" value="<?php echo $_GET['id_activity']; ?>">
								<input type="hidden" name="activity" id="activity" value="<?php echo isset($_GET['activity']) ? $_GET['activity'] : ''; ?>">
								<input type="hidden" name="date_activity" id="date_activity" value="<?php echo $_GET['date_activity']; ?>">
								<input type="hidden" name="estate" id="estate" value="<?php echo $_GET['estate']; ?>">
								<input type="hidden" name="code_info" id="code_info" value="<?php echo $_GET['code_info']; ?>">

								<div class="form-row">

									<div class="col-md-6">
										<div class="form-group">
											<label for="format" class="control-label">Categoría del producto*</label>
											<select name="format" class="form-control" id="format" required>
												<option value=""><?php echo "-SELECCIONE-" ?></option>
												<?php foreach ($products_cat as $p) : ?>
													<option value="<?php echo $p->nombre_categoria; ?>"><?php echo $p->nombre_categoria ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>


									<div class="col-md-6">
										<div class="form-group">
											<label for="format_detail" class="control-label">Tipo de producto*</label>
											<select name="format_detail" class="form-control" id="format_detail" required>
												<option value=""><?php echo "-SELECCIONE CATEGORÍA-" ?></option>
											</select>
										</div>
									</div>


									<div class="col-md-6">
										<div class="form-group">
											<label for="quantity_created" class="control-label">Total de productos creados*</label>
											<input type="number" name="quantity_created" id="quantity_created" value="1" min="0" class="form-control" placeholder="Número">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="quantity_published" class="control-label">Total de productos publicados*</label>
											<input type="number" name="quantity_published" id="quantity_published" value="1" min="0" class="form-control" placeholder="Número">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="web_link" class="control-label">Referencia web de la publicación <label style="color: #d2ff;"> (Agregue un nuevo producto para cada enlace diferente) </label>.</label>
											<textarea type="text" name="web_link" id="web_link" class="form-control" placeholder="URL"></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="action_performed" class="control-label">Descripción (Opcional)</label>
											<input type="text" name="action_performed" id="action_performed" class="form-control" placeholder="">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<button type="submit" name="" id="add_part" class="btn btn-primary btn-block">Agregar</button>
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

<?php } ?>


<?php

$CantidadMostrar = 50;
$url_pag_atras = "";
$url_pag_adelante = "";

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


$total = ProductsData::getBySQL("SELECT * from products_list where id_activity=" . $_GET['id_activity'] . " order by id asc ");
$TotalReg = $total[1];

$param_csv = "SELECT * from products_list where id_activity=" . $_GET['id_activity'] . " order by id desc ";
$sql = "SELECT * from products_list where id_activity=" . $_GET['id_activity'] . " order by id desc";
$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
$param = ProductsData::getBySQL($sql);


$url_pag = "<a href=\"?view=products_list&id_activity=" . $_GET["id_activity"] . "&activity_title=" . $_GET["activity_title"] . "&pag=";

//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
$param_sql = "true";
$DB_name = "products_list";



?>




<?php if (count($param[0]) > 0) { ?>
	<!-- si hay usuarios -->
	<div class="col-md-12">
		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>
		<!-- <a href="./pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a> -->
		<a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
		<br>
	</div>



	<div class="col-md-12">
		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">

					<table class="table table-bordered table-hover">
						<thead>
							<th>N°</th>
							<th>Actividad</th>
							<th>Categoría</th>
							<th>Tipo de producto</th>
							<th>Cantidad creados</th>
							<th>Cantidad publicados</th>
							<th>Descripción</th>
							<th>Enlaces web</th>
							<th>Acciones</th>
						</thead>

						<?php
						$var_count = 0;
						foreach ($param[0] as $types) {
							$var_count += 1;
							// $pacient  = $user->getPacient();
							// $medic = $user->getMedic();
							$link = explode(",", $types["web_link"]);

						?>
							<tr>
								<td><?php echo $var_count; ?></td>
								<td><?php echo $types["activity_title"]; ?></td>
								<td><?php echo $types["format"]; ?></td>
								<td><?php echo $types["format_detail"]; ?></td>
								<td><?php echo $types["quantity_created"]; ?></td>
								<td><?php echo $types["quantity_published"]; ?></td>
								<td><?php echo $types["action_performed"]; ?></td>

								<td>
									<?php foreach ($link as $data) {
										if ($data != "") {
									?>
											<a href="<?php echo $data ?>" target="_blank" class=" btn btn-info btn-sm"><i class="fa fa-globe"></i> </a>
										<?php } else { ?>
											<a href="#" class=" btn btn-warning btn-sm"><i class="fa fa-globe"></i> </a>
										<?php } ?>
									<?php } ?>
								</td>

								<td style="width:180px;">

									<?php if ($_SESSION["user_id"] == $_GET['user_id']) { ?>

										<a href="index.php?view=editproduct&id=<?php echo $types["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></i></a>
										<a href="./?action=ajax&function=del_products&user_id=<?php echo $_GET['user_id']; ?>&id=<?php echo $types["id"]; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&activity_title=<?php echo $_GET["activity_title"]; ?>&estate=<?php echo $_GET["estate"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&code_info=<?php echo $_GET["code_info"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></i></a>

									<?php } elseif ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9 || (($_SESSION["user_type"] == 8 || $_SESSION["user_rol"] == 'Políticas públicas') && $_SESSION["user_region"] == $_GET["estate"])) { ?>

										<a href="index.php?view=editproduct&id=<?php echo $types["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></i></a>
										<a href="./?action=ajax&function=del_products&user_id=<?php echo $_GET['user_id']; ?>&id=<?php echo $types["id"]; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&activity_title=<?php echo $_GET["activity_title"]; ?>&estate=<?php echo $_GET["estate"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&code_info=<?php echo $_GET["code_info"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></i></a>

									<?php } ?>

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
			</div>
		</div>
	</div>

	<?php include "core/app/layouts/pagination.php"; ?>






	<script language="javascript">
		$('#cover-spin').show(0);

		$(document).ready(function() {

			$("#format").change(function() {
				$('#format_detail').find('option').remove().end().append('<option value=""></option>').val('0');
				$("#format option:selected").each(function() {
					categoria = $(this).val();
					console.log(categoria);
					$.post("core/app/view/getCatProduct.php", {
						categoria: categoria
					}, function(data) {
						// console.log(data);
						$("#format_detail").html(data);
					});

				});
			})

		});
	</script>
