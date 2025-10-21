<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<script language="javascript">
	// las func estan en demo.js
	// if (getOS() == "Android"){
	//     get_Name = getOS() + "|" + getBrowser();
	//     $("#user_name_os").val(get_Name);
	// }else{
	//     get_Name = getOS() + "|" + getBrowser();
	//     $("#user_name_os").val(get_Name);
	// }


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

	// SCRIPTS FUCNTIONS
	$(document).ready(function() {

		var location = window.location;

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
		// cambiar el parametro de alert
		const url = new URL(window.location);
		url.searchParams.set('swal', '');
		window.history.pushState({}, '', url);





		$('#add_submit').click(function(event) {
			event.preventDefault();

			var line = $("#line_action").val().split(",");
			if ($("#line_action").val() != "" && $("#name_action").val() != "") { // valida la informacion

				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						// headers: {
						//     "X-CSRFToken": getCookie("csrftoken")
						// },
						data: {
							function: "add_strategic_action", // funcion que llama
							line_action: line[0],
							line_id: line[1],
							name_action: $("#name_action").val(),
							permisos: $("#permisos").val()
						}
					})
					.done(function(msg) {
						// console.log(msg);
						toastify('Guardado', true, 1000, "dashboard");
						location.reload();
						// $('#content').reload('#content');

					})
					.fail(function(error) {
						toastify('Hubo un error al guardar: '+error.statusText, true, 5000, "warning");
					});
				// .always(function() {
				//     toastify('Finished',true,1000,"warning");
				// });




			};

		});



	});

	function uploadXLSX() {
		$('#cover-spin').show(0);
	}
</script>


<?php
$action_line = ActionsLineData::getAll();
											// print_r($action_line);

?>



<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx_strategic_action" method="POST" enctype="multipart/form-data" />
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



<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Acciones estratégicas de las líneas de acción </b> </span>
								</a>
							</h4>
						</div>

						<br>

						<form method="post" id="add_strategic" role="form">


							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<label for="line_action" class=" control-label"><i class="fa fa-cogs"></i> Linea de acción</label>
										<select name="line_action" class="form-control" id="line_action" required>
											<option value="">-- LINEA DE ACCIÓN --</option>
											<?php foreach ($action_line as $p): ?>
												<option value="<?php echo $p->line_name . ',' . $p->line_id; ?>"> <?php echo $p->line_name; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="name_action" class="control-label"><i class="fa fa-cogs"></i> Accione Estratégica</label>
										<textarea type="text" name="name_action" id="name_action" required class="form-control" placeholder="Descripción"></textarea>
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
										<button type="submitx" name="" id="add_submit" class="btn btn-primary btn-block">Agregar</button>
									</div>
								</div>


							</div>
						</form>

						<!-- Obtengo los datos para la paginacion -->
						<?php
						$CantidadMostrar = 50;
						$url_pag_atras = "";
						$url_pag_adelante = "";

						// Validado  la variable GET
						$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

						// $total = StrategicActionData::getAll();
						// $TotalReg = count($total);

						// $sql = "SELECT * from strategic_action order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						// $param = StrategicActionData::getBySQL($sql);


						// pg
						$total = StrategicActionData::getAllPg("SELECT * from strategic_action order by id desc");
						$TotalReg = $total[1];

						$sql = "SELECT * from strategic_action order by id desc";

						$param_csv = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
						// $param_sql = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
						$DB_name = "strategic_action";

						$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
						$param = StrategicActionData::getObj($sql);

						$url_pag = "<a href=\"?view=strategic_action&pag=";

						//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
						$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
						?>
						<!-- --------------------------- -->




						<!-- creo la tabla con la consulta -->
						<div class="card-content table-responsive">
							<div class="card-body">

								<!-- <!?php if ($param != "null") { ?> -->
								<?php if (count($param) > 0) { ?>
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
											<th>Línea de acción</th>
											<th>Acción estratégica</th>
											<th>Permisos</th>
											<th>Acciones</th>
										</thead>

										<?php foreach ($param as $user) { 
											
											?>
											<tr>
												</td>
												<?php if ($user->line_action == "Infocentro adentro" || $user->line_action == "Participación digital" || $user->line_action == "Comunidades de participación digital") {
													echo '<td class="priority_5" style="color:#f75e05;">'; ?>
												<?php } else if ($user->line_action == "Formación a la medida" || $user->line_action == "Comunidades de aprendizaje") {
													echo '<td class="priority_5" style="color:#f72acb;">'; ?>
												<?php } else if ($user->line_action == "Tejiendo redes" || $user->line_action == "Medios digitales") {
													echo '<td class="priority_5" style="color:#005af5;">'; ?>
												<?php } else if ($user->line_action == "Unidades socio-productivas" || $user->line_action == "Acceso abierto") {
													echo '<td class="priority_5" style="color:#02782f;">'; ?>
												<?php } else {
													echo '<td class="priority_5">';
												} ?>
												<?php echo $user->line_action; ?>
												</td>
												<td><?php echo $user->name_action; ?></td>
												<td><label style="font-size: 12px; width:200px; color:black;"><?php echo $user->permisos; ?></label></td>
												<td>
													<a href="./?view=edit_strategic_action&id=<?php echo $user->id; ?>" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>

													<?php $URL = "./?action=ajax&function=del_strategic_action&id=" . $user->id; ?>
													<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button>

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





<script>
	// $(function(){
	//     var $contenido = $('#contenido');
	//     var $modalidad = $('#modalidad');
	//     var $duracion = $('#duracion');

	//     $('#linea_accion').change(function(){
	//         var value = $(this).val();
	//         // alert(value);

	//         // limpiar el select
	//         const $select = document.querySelector("#tipo_reporte");
	//         for (let i = $select.options.length; i >= 0; i--) {
	//             $select.remove(i);
	//         }

	//         if (value=='Infocentro adentro'){
	//             $('#tipo_reporte').append($('<option>').val('Jorna de atención social').text('Jornada de atención social'));
	//             $('#tipo_reporte').append($('<option>').val('Comunal').text('Comunal'));
	//             $('#tipo_reporte').append($('<option>').val('Político').text('Político'));
	//             $('#tipo_reporte').append($('<option>').val('Infocentro como plataforma de apoyo').text('Infocentro como plataforma de apoyo'));
	//             $('#tipo_reporte').append($('<option>').val('Organización interna de infocentro').text('Organización interna de infocentro'));
	//             $('#tipo_reporte').append($('<option>').val('Mantenimiento').text('Mantenimiento'));
	//             $('#tipo_reporte').append($('<option>').val('Movilización').text('Movilización'));
	//             $('#tipo_reporte').append($('<option>').val('Jornada de limpieza voluntaria al infocentro').text('Jornada de limpieza voluntaria al infocentro'));
	//             $('#tipo_reporte').append($('<option>').val('Soporte').text('Soporte'));
	//             $('#tipo_reporte').append($('<option>').val('Vinculación').text('Vinculación'));
	//         }

	//         if (value=='Formación a la medida'){
	//             $('#tipo_reporte').append($('<option>').val('Formación').text('Formación'));
	//         }

	//         if (value=='Tejiendo redes'){
	//             $('#tipo_reporte').append($('<option>').val('Prácticas de comunicación popular').text('Prácticas de comunicación popular'));
	//         }

	//         if (value=='Unidades socio-productivas'){
	//             $('#tipo_reporte').append($('<option>').val('Producción sustentable').text('Producción sustentable'));
	//         }

	//         if (value=='Sistematización de Experiencias'){
	//             $('#tipo_reporte').append($('<option>').val('Experiencias significativas').text('Experiencias significativas'));
	//         }


	//         if (value=='Formación a la medida'){
	//             $($contenido).show();
	//             $($modalidad).show();
	//             $($duracion).show();
	//             // $('option:not(.' + value + ')', $tabla).hide();
	//         }
	//         else{
	//             // Se ha seleccionado All
	//             $($contenido).hide();
	//             $($modalidad).hide();
	//             $($duracion).hide();
	//             // $('option', $tabla).show();
	//         }
	//     });
	// })
</script>