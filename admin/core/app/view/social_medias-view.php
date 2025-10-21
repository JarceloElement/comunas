<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->
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

			if ($("#social_media_name").val() != "") { // valida la informacion

				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						// headers: {
						//     "X-CSRFToken": getCookie("csrftoken")
						// },
						data: {
							function: "add_social_media", // funcion que llama
							nombre: $("#social_media_name").val(),
						}
					})
					.done(function(msg) {
						toastify('Guardado', true, 1000, "dashboard");
						location.reload();
						// $('#content').reload('#content');

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

<?php
$action_line = ActionsLineData::getAll();

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
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Tipos de enlaces de productos </b> </span>
								</a>
							</h4>
						</div>
						<br>
						<form id="add_social_media">

							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<label for="social_media_name" class="control-label"><i class="fa fa-cogs"></i> Nombre</label>
										<textarea type="text" name="social_media_name" id="social_media_name" required class="form-control" placeholder="Nombre de la red social"></textarea>
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
						
						// MYSQL
						// $sql = "SELECT * from social_medias";
						// $total = SocialMediasData::getBySQL($sql);
						// $TotalReg = count(value: $total);

						// $sql = "SELECT * FROM social_medias ORDER BY id DESC";
						// $param = SocialMediasData::getBySQL($sql)[0];


						// POSTGRESQL
						$conn = DatabasePg::connectPg();

						$sql_total = "SELECT * from social_medias";
						$stmt = $conn->prepare($sql_total);
						$stmt->execute();
						$TotalReg = $stmt->rowCount();

						$sql = "SELECT * FROM social_medias ORDER BY id DESC LIMIT " . $CantidadMostrar . " OFFSET " . ($compag - 1) * $CantidadMostrar;
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$param = $data;


						$url_pag = "<a href=\"?view=social_medias&pag=";

						//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
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
											<th>Red social</th>
											<th>Acciones</th>
										</thead>

										<?php foreach ($param as $social_media) { ?>
											<tr>

												<td><?php echo $social_media["nombre"]; ?></td>
												<td>
													<a href="./?view=edit_social_media&id=<?php echo $social_media["id"]; ?>" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>

													<?php $URL = "./?action=ajax&function=del_social_media&id=" . $social_media["id"]; ?>
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