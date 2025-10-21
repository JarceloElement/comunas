<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->
<?php
$swal = $_GET["swal"]?$_GET["swal"]:"";

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
		if ('<?php echo $swal; ?>' != "") {
			Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '<?php echo $swal; ?>',
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

			var nombre = $("#social_media_name").val();
			var id = $("#id").val();

			if ($("#social_media_name").val() != "") { // valida la informacion
				
				
				$.ajax({
						type: "POST",
						url: "./?action=ajax",
						data: {
							function: "edit_social_media", // funcion que llama
							id: id,
							nombre: nombre,
						}
					})
					.done(function(msg) {
						toastify('Guardado', true, 1000, "dashboard");
						document.location='index.php?view=social_medias&swal=Guardado';

					})
					.fail(function() {
						toastify('Hubo un error al guardar', true, 5000, "warning");
					});

				}
			});

			}

		);
</script>


<?php
$id = $_GET["id"];

$sql = "SELECT * FROM social_medias WHERE id = $id";

$data = SocialMediasData::getBySQL($sql)[0][0];

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
									<span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Nombre de la red social </b> </span>
								</a>
							</h4>
						</div>

						<br>

						<form method="POST" id="add_social_media" role="form">
							<input type="hidden" name="id" id="id" value="<?php echo $data["id"]; ?>"></input>


							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<label for="social_media_name" class="control-label"><i class="fa fa-cogs"></i>Nombre de la red social</label>
										<input type="text" name="social_media_name" id="social_media_name" value="<?php echo $data["nombre"]; ?>" required class="form-control" placeholder="Descripción"></input>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="submit" name="" id="add_submit" class="btn btn-primary btn-block">Guardar</button>
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