<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

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
			var id = $("#id").val();

			if ($("#line_action").val() != "" && $("#name_action").val() != "") { // valida la informacion

				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						data: {
							function: "edit_strategic_action", // funcion que llama
							id: id,
							line_action: line[0],
							line_id: line[1],
							name_action: $("#name_action").val(),
							permisos: $("#permisos").val()
						}
					})
					.done(function(msg) {
						toastify('Guardado', true, 1000, "dashboard");
						document.location='index.php?view=strategic_action&swal=Guardado';

					})
					.fail(function() {
						toastify('Hubo un error al guardar', true, 5000, "warning");
					});
				// .always(function() {
				//     toastify('Finished',true,1000,"warning");
				// });




			}else{
				toastify('Por favor selecciona la línea de acción', true, 5000, "warning");
			};

		});



	});
</script>


<?php
$id = $_GET["id"];
$data = StrategicActionData::getByIdPg($id);
$action_line = ActionsLineData::getAllPg("SELECT * from actions_line order by line_id desc")[0];
?>



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
							<input type="hidden" name="id" id="id" value="<?php echo $data->id; ?>"></input>


							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<label for="line_action" class=" control-label"><i class="fa fa-cogs"></i> Linea de acción</label>
										<select name="line_action" class="form-control" id="line_action" required>
											<!-- <option value="<"?php echo $data->line_action.','.$data->line_id; ?>"><"?php echo $data->line_action; ?></option> -->
											<option value="">-- LINEA DE ACCIÓN --</option>
											<?php foreach ($action_line as $p): ?>
												<option value="<?php echo $p["line_name"] . ',' . $p["line_id"]; ?>"> <?php echo $p["line_name"]; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="name_action" class="control-label"><i class="fa fa-cogs"></i> Accione Estratégica</label>
										<input type="text" name="name_action" id="name_action" value="<?php echo $data->name_action; ?>" required class="form-control" placeholder="Descripción"></input>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="permisos" class="control-label"><i class="fa fa-cogs"></i> Habilitar solo a los infocentros marcados</label>
										<input type="text" name="permisos" id="permisos" value="<?php echo $data->permisos; ?>" class="form-control" placeholder="AMA01, AMA02"></input>
										<span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
									</div>
								</div>



								<div class="col-md-6">
									<div class="form-group">
										<button type="submitx" name="" id="add_submit" class="btn btn-primary btn-block">Guardar</button>
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