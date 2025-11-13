<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">
	$(document).ready(function() {

		$('#add_submit').click(async function(event) {
				$('#cover-spin').show(0);

			event.preventDefault();
			if ($("#action_line_name").val() != "") { // valida la informacion

				try {
					const res = await fetch("./?action=ajax", {
						method: 'POST',
						body: formData = new URLSearchParams({
							'function': "edit_action_line", // funcion que llama
							'line_id': $("#line_id").val(),
							'name': $("#action_line_name").val(),
							'permisos': $("#permisos").val()
						})
					});

					if (res.ok) {
						// console.log(res);
						const result_await = await res.text();
						// console.log(result_await);
						var array = JSON.parse(result_await);
						console.log(array);
						$('#cover-spin').hide(0);
						if (array.error == 'true') {
							if (getOS() == "Android") {
								alert(array.text);
							} else {
								toastify(array.text, true, 15000, "error");
							}

						}else{
							history.back();
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

		});
	});
</script>


<?php $line = ActionsLineData::getByIdPg($_GET["line_id"]); ?>

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