<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">
	$(document).ready(function() {

		$('#add_submit').click(function(event) {

			event.preventDefault();

			// console.log($("#line_id").val());
			if ($("#action_line_name").val() != "") { // valida la informacion
				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						// headers: {
						//     "X-CSRFToken": getCookie("csrftoken")
						// },
						data: {
							function: "edit_action_line", // funcion que llama
							line_id: $("#line_id").val(),
							name: $("#action_line_name").val(),
							permisos: $("#permisos").val()
						}
					})
					.done(function(msg) {
						toastify(msg, true, 1000, "dashboard");
						window.location.href = "./?view=action_line"; // redirecciona a la vista de líneas de acción
						// location.reload();

					})
					.fail(function() {
						toastify('Hubo un error al guardar', true, 5000, "warning");
					});
				// .always(function() {
				//     toastify('Finished',true,1000,"warning");
				// });
			};

		});
	});
</script>


<?php $line = ActionsLineData::getByIdPg($_GET["line_id"]); ?>



<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Línea de acción </b> </span>
								</a>
							</h4>
						</div>

						<br><br>

						<form method="post" id="addline" role="form">
							<input type="hidden" name="line_id" id="line_id" value="<?php echo $line->line_id; ?>"></input>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="action_line_name" class="control-label">Nueva línea de acción</label>
										<input type="text" name="param" id="action_line_name" value="<?php echo $line->line_name; ?>" required class="form-control" placeholder="Nombre">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="permisos" class="control-label"><i class="fa fa-cogs"></i> Habilitar solo a los infocentros marcados</label>
										<input type="text" name="permisos" id="permisos" value="<?php echo $line->permisos; ?>" class="form-control" placeholder="AMA01, AMA02"></input>
										<span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="submit" id="add_submit" class="btn btn-primary btn-block">Guardar</button>
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