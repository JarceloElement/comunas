<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">
	$('#cover-spin').show(0);

	var socialMedias;

	$(document).ready(function() {

		// toastify('AVISO: Ahora todos los enlaces de un mismo producto se cargan al registrar el producto. No hace falta planificar un reporte para cada producto', true, 20000, "warning");

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


		// cargar listado de RRSS
		// getSocialmedia();

	});



	async function getSocialmedia() {

		try {
			const res = await fetch("./?action=getSocialmedia", {
				method: 'POST',
				body: "data"
			});

			if (res.ok) {
				const result_await = await res.text();
				var array = JSON.parse(result_await);
				// console.log(array);
				socialMedias = array;
				let icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12q0-.175-.003-.353t-.022-.341q-.067.667-.53 1.104q-.464.436-1.137.436h-2.539q-.698 0-1.195-.496t-.497-1.193v-.845h-3.385v-1.69q0-.697.498-1.198q.497-.501 1.195-.501h.846v-.77q0-.728.476-1.146t1.137-.482q-.673-.26-1.38-.392T12 4Q8.65 4 6.325 6.325T4 12v.289q0 .134.02.288H8.5q1.42 0 2.402.983q.983.982.983 2.393v.855H9.346v2.73q.616.222 1.286.342T12 20"/></svg>';

				for (let r of array["array"]) {

					var nombre = r.nombre.split("-")[0];

					if (nombre.toUpperCase() == "FACEBOOK") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" fill-rule="evenodd" d="M15.725 22v-7.745h2.6l.389-3.018h-2.99V9.31c0-.874.243-1.47 1.497-1.47h1.598v-2.7a21 21 0 0 0-2.33-.12c-2.304 0-3.881 1.407-3.881 3.99v2.227H10v3.018h2.607V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104v17.792c0 .61-.494 1.104-1.104 1.104z"/></svg>';
					} else if (nombre.toUpperCase() == "X") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="m9 7l2 5l-2 5h2l1-2.5l1 2.5h2l-2-5l2-5h-2l-1 2.5L11 7zm3-5a10 10 0 0 1 10 10a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2"/></svg>';
					} else if (nombre.toUpperCase() == "INSTAGRAM") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3"/></svg>';
					} else if (nombre.toUpperCase() == "THREADS") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M6.321 6.016c-.27-.18-1.166-.802-1.166-.802.756-1.081 1.753-1.502 3.132-1.502.975 0 1.803.327 2.394.948s.928 1.509 1.005 2.644q.492.207.905.484c1.109.745 1.719 1.86 1.719 3.137 0 2.716-2.226 5.075-6.256 5.075C4.594 16 1 13.987 1 7.994 1 2.034 4.482 0 8.044 0 9.69 0 13.55.243 15 5.036l-1.36.353C12.516 1.974 10.163 1.43 8.006 1.43c-3.565 0-5.582 2.171-5.582 6.79 0 4.143 2.254 6.343 5.63 6.343 2.777 0 4.847-1.443 4.847-3.556 0-1.438-1.208-2.127-1.27-2.127-.236 1.234-.868 3.31-3.644 3.31-1.618 0-3.013-1.118-3.013-2.582 0-2.09 1.984-2.847 3.55-2.847.586 0 1.294.04 1.663.114 0-.637-.54-1.728-1.9-1.728-1.25 0-1.566.405-1.967.868ZM8.716 8.19c-2.04 0-2.304.87-2.304 1.416 0 .878 1.043 1.168 1.6 1.168 1.02 0 2.067-.282 2.232-2.423a6.2 6.2 0 0 0-1.528-.161"/></svg>';
					} else if (nombre.toUpperCase() == "PINTEREST") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M9.04 21.54c.96.29 1.93.46 2.96.46a10 10 0 0 0 10-10A10 10 0 0 0 12 2A10 10 0 0 0 2 12c0 4.25 2.67 7.9 6.44 9.34c-.09-.78-.18-2.07 0-2.96l1.15-4.94s-.29-.58-.29-1.5c0-1.38.86-2.41 1.84-2.41c.86 0 1.26.63 1.26 1.44c0 .86-.57 2.09-.86 3.27c-.17.98.52 1.84 1.52 1.84c1.78 0 3.16-1.9 3.16-4.58c0-2.4-1.72-4.04-4.19-4.04c-2.82 0-4.48 2.1-4.48 4.31c0 .86.28 1.73.74 2.3c.09.06.09.14.06.29l-.29 1.09c0 .17-.11.23-.28.11c-1.28-.56-2.02-2.38-2.02-3.85c0-3.16 2.24-6.03 6.56-6.03c3.44 0 6.12 2.47 6.12 5.75c0 3.44-2.13 6.2-5.18 6.2c-.97 0-1.92-.52-2.26-1.13l-.67 2.37c-.23.86-.86 2.01-1.29 2.7z"/></svg>';
					} else if (nombre.toUpperCase() == "TIKTOK") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M16.6 5.82s.51.5 0 0A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48"/></svg>';
					} else if (nombre.toUpperCase() == "YOUTUBE") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M8 19V5l11 7z"/></svg>';
					} else if (nombre.toUpperCase() == "WHATSAPP") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.2 8.2 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31c-.22.25-.87.86-.87 2.07c0 1.22.89 2.39 1 2.56c.14.17 1.76 2.67 4.25 3.73c.59.27 1.05.42 1.41.53c.59.19 1.13.16 1.56.1c.48-.07 1.46-.6 1.67-1.18s.21-1.07.15-1.18c-.07-.1-.23-.16-.48-.27c-.25-.14-1.47-.74-1.69-.82c-.23-.08-.37-.12-.56.12c-.16.25-.64.81-.78.97c-.15.17-.29.19-.53.07c-.26-.13-1.06-.39-2-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.12-.24-.01-.39.11-.5c.11-.11.27-.29.37-.44c.13-.14.17-.25.25-.41c.08-.17.04-.31-.02-.43c-.06-.11-.56-1.35-.77-1.84c-.2-.48-.4-.42-.56-.43c-.14 0-.3-.01-.47-.01"/></svg>';
					} else if (nombre.toUpperCase() == "TELEGRAM") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19c-.14.75-.42 1-.68 1.03c-.58.05-1.02-.38-1.58-.75c-.88-.58-1.38-.94-2.23-1.5c-.99-.65-.35-1.01.22-1.59c.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.21-.02c-.09.02-1.49.95-4.22 2.79c-.4.27-.76.41-1.08.4c-.36-.01-1.04-.2-1.55-.37c-.63-.2-1.12-.31-1.08-.66c.02-.18.27-.36.74-.55c2.92-1.27 4.86-2.11 5.83-2.51c2.78-1.16 3.35-1.36 3.73-1.36c.08 0 .27.02.39.12c.1.08.13.19.14.27c-.01.06.01.24 0 .38"/></svg>';
					} else if (nombre.toUpperCase() == "FACEBOOK/Grupo") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" fill-rule="evenodd" d="M15.725 22v-7.745h2.6l.389-3.018h-2.99V9.31c0-.874.243-1.47 1.497-1.47h1.598v-2.7a21 21 0 0 0-2.33-.12c-2.304 0-3.881 1.407-3.881 3.99v2.227H10v3.018h2.607V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104v17.792c0 .61-.494 1.104-1.104 1.104z"/></svg>';
					}
					var new_rrss = document.getElementById("new_rrss");
					var newDiv = document.createElement("div");
					newDiv.innerHTML = `
					<div class="row">
						<div class="col">
							<div class="form-group col-mg-4">
								<div class="mui-textfield mui-textfield--float-label">

									<input type="url" data-is-link=false id="` + nombre + `" name="` + nombre + `" value="" />
									<label>
									<i>
										` + icono + `
									</i>
									` + r.nombre + ` (url)
									</label>

								</div>
							</div>
						</div>
					</div>
					`;

					new_rrss.appendChild(newDiv);

					let input = document.getElementById(nombre);
					input.addEventListener('change', validarLink);

				}


			} else {
				toastify(res.statusText, true, 12000, "error");
				throw res.statusText;
			}

		} catch (error) {
			toastify(error, true, 12000, "error");
			throw error;
		}

	}

	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("validar").addEventListener('submit', validarFormulario);
	});


	function validarFormulario(event) {
		event.preventDefault();

		$('#cover-spin').show(0);

		// let socialMediasArray = socialMedias["array"];
		let socialMediasData = [];

		// console.log(socialMediasArray.length);

		// socialMediasArray.forEach(element => {
		// 	let nombre = element["nombre"].split("-")[0];
		// 	console.log(nombre);

		// 	let valor = $(`#${nombre}`).val();

		// 	if (valor != "" && valor != null) {
		// 		socialMediasData.push({
		// 			"id": element["id"],
		// 			"nombre": element["nombre"],
		// 			"valor": valor,
		// 		});
		// 	}
		// });

		var formData = new FormData(); // Obtiene los datos del formulario
		var fileInput = $('#userfile')[0]; // Selecciona el input de tipo file
		formData.append('function', 'add_product'); // Agrega la función a llamar
		formData.append('id_activity', $("#id_activity").val());
		formData.append('activity', $("#activity").val());
		formData.append('estate', $("#estate").val());
		formData.append('code_info', $("#code_info").val());
		formData.append('action_performed', $("#action_performed").val());
		formData.append('date_activity', $("#date_activity").val());
		formData.append('format', $("#format").val());
		formData.append('format_detail', $("#format_detail").val());
		formData.append('quantity_created', $("#quantity_created").val());
		formData.append('quantity_published', $("#quantity_published").val());
		// formData.append('web_link', JSON.stringify(socialMediasData));

		if (fileInput.files.length > 0) {
			formData.append('userfile', fileInput.files[0]);
		}

		if (!validarDuplicidad()) {
			$('#cover-spin').hide(0);
			toastify("Hay enlaces duplicados, por favor revisa que no sean iguales.", true, 12000, "error");

			return false;
		}

		$.ajax({
				type: "POST",
				url: "./?action=ajax",
				// headers: {
				//     "X-CSRFToken": getCookie("csrftoken")
				// },
				data: {
					function: "verify_links", // funcion que llama
					web_link: socialMediasData,
				}

			})
			.done(function(msg) {
				console.log(msg);
				let data = JSON.parse(msg);

				if (data.err == "true") {
					if (getOS() == "Android") {
						alert(data.text);
					} else {
						toastify(data.text, true, 12000, "error");
					}

					$('#cover-spin').hide(0);
					return false;
				} else {
					$.ajax({
							type: "POST",
							url: "./?action=ajax",
							data: formData,
							contentType: false,
							processData: false,

						})
						.done(function(msg) {
							// console.log(msg);
							if (getOS() == "Android") {
								alert("Registro guardado");
							} else {
								toastify('Registro guardado', true, 1000, "dashboard");
							}
							location.reload();

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
				}
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


	};


	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("creado").addEventListener('change', esCreado);
	})

	function esCreado(e) {

		let valor = e.target.value;
		let campoCantidadCreado = document.getElementById("quantity_created");
		console.log(valor);

		if (valor == 0) {
			campoCantidadCreado.value = 0;
		} else {
			campoCantidadCreado.value = 1;
		}

	}


	function validarLink(e) {

		let valor = e.target.value;
		console.log(valor);
		//Si el valor es un link valido entonces se coloca el dataset is link a true
		if (/(?:https?):\/\/(\w+:?\w*)?(\S+)(:\d+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/i.test(valor)) {
			e.target.dataset.isLink = true;

		} else {
			e.target.dataset.isLink = false;
		}
		validarDuplicidad();
		calcularProductosPublicados();

	}

	function calcularProductosPublicados() {
		elements = $("input[data-is-link]");

		let cantidad = 0;
		for (let i = 0; i < elements.length; i++) {
			if (elements[i].dataset.isLink == "true") {
				cantidad++;
			}
		}
		console.log(cantidad);
		$("#quantity_published").val(cantidad);
	}

	function validarDuplicidad() {
		var links = $("input[data-is-link = true]");
		let valido = true;
		for (let i = 0; i < links.length; i++) {
			for (let j = i + 1; j < links.length; j++) {
				if (links[i].value == links[j].value) {
					links[i].setCustomValidity("El link ya ha sido ingresado");
					links[j].setCustomValidity("El link ya ha sido ingresado");
					valido = false;
					console.log(valido);
				}

			}
		}
		if (valido) {
			for (let i = 0; i < links.length; i++) {
				links[i].setCustomValidity("");
			}

		}
		return valido;
	}
</script>

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

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
// $products_type = ProductsType::getAll();
$products_cat = ProductsType::getBySQL("select * from categoria_productos");
$social_medias = SocialMediasData::getBySQL("SELECT * FROM social_medias;")[0];
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
			<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
					<path fill="currentColor" d="M11 21v-2h8v-7.1q0-2.925-2.037-4.962T12 4.9T7.038 6.938T5 11.9V18H4q-.825 0-1.412-.587T2 16v-2q0-.525.263-.987T3 12.275l.075-1.325q.2-1.7.988-3.15t1.975-2.525T8.762 3.6T12 3t3.225.6t2.725 1.663t1.975 2.512t1 3.15l.075 1.3q.475.225.738.675t.262.95v2.3q0 .5-.262.95t-.738.675V19q0 .825-.587 1.413T19 21zm-2-7q-.425 0-.712-.288T8 13t.288-.712T9 12t.713.288T10 13t-.288.713T9 14m6 0q-.425 0-.712-.288T14 13t.288-.712T15 12t.713.288T16 13t-.288.713T15 14m-8.975-1.55Q5.85 9.8 7.625 7.9T12.05 6q2.225 0 3.913 1.412T18 11.026Q15.725 11 13.813 9.8t-2.938-3.25q-.4 2-1.687 3.563T6.025 12.45" />
				</svg></i>
		</h6>
		<h6 class="card-category text-danger text-center">
			<!-- Si has publicado varios productos en redes sociales el mismo día, debes reportar una sola actividad de acción en redes para todos los productos, en el formulario irás agregando cada producto, uno a la vez. En resumen no se debe crear un reporte por cada publicación en redes cuando se hayan generado el mismo día. -->
			Todos los productos que hayan sido publicados en redes sociales el mismo día, se cargaran en un mismo reporte.
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

							<form method="post" id="validar" role="form" enctype="multipart/form-data">
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

									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">¿Creaste este producto?</label>
											<select class="form-control" id="creado" required>
												<option value=""><?php echo "-SELECCIONE-" ?></option>
												<option value="1">Si</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="quantity_created" class="control-label">Total de productos creados*</label>
											<input type="number" name="quantity_created" id="quantity_created" disabled="true" value="0" min="0" class="form-control" placeholder="Número">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="quantity_published" class="control-label">Total de productos publicados*</label>
											<input type="number" name="quantity_published" id="quantity_published" disabled="true" value="0" min="0" class="form-control" placeholder="Número">
										</div>
									</div>

									<div class="col-md-12" id="userfile_f" style="display:true">
										<label for="action_performed" class="control-label">Adjuntar producto (Tipo documento)</label>
										<span class="btn btn-raised btn-round btn-default btn-file">
											<span class="fileinput-new">Select</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" name="userfile" id="userfile" class="file-input__input" accept=".pdf,.xlsx,.ods,.doc,.odt" />
										</span>
									</div>



									<!-- <div class="col-md-12" id="userfile_f" style="display:none">
										<label for="action_performed" class="control-label">Adjuntar producto de Comunas en Red (Formato PDF)</label>
										<span class="btn btn-raised btn-round btn-default btn-file">
											<span class="fileinput-new">Select</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" name="userfile" id="userfile" class="file-input__input" accept=".pdf" />
										</span>
									</div> -->


									<div class="col-md-12">
										<div class="form-group" id="new_rrss">

										</div>
									</div>


									<div class="col-md-6">
										<br>
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
$sql = "SELECT 
	products_list.id as id,
	products_list.activity_title as activity_title,
	products_list.format as format, 
	products_list.format_detail as format_detail, 
	products_list.quantity_created as quantity_created, 
	products_list.quantity_published as quantity_published, 
	products_list.action_performed as action_performed
	FROM products_list WHERE id_activity=" . $_GET['id_activity'] . " order by products_list.id desc";
$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
$param = ProductsData::getBySQL($sql);

$url_pag = "<a href=\"?view=products_list&id_activity=" . $_GET["id_activity"] . "&activity_title=" . $_GET["activity_title"] . "&user_id=" . $_SESSION["user_id"] . "&pag=";

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
									<?php
									$id = $types["id"];
									$sql = "SELECT * FROM links INNER JOIN social_medias ON links.social_medias_id = social_medias.id WHERE links.products_list_id = $id";
									$param = LinksData::getBySQL($sql);

									if ($param[0] != array()) {
										foreach ($param[0] as $link) {
											$svg_icon = "";
											$background_icon_color = "";

											switch (strtoupper(explode("-", $link["nombre"])[0])) {
												case "FACEBOOK":
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2.04c-5.5 0-10 4.49-10 10.02c0 5 3.66 9.15 8.44 9.9v-7H7.9v-2.9h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89c1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.45 2.9h-2.33v7a10 10 0 0 0 8.44-9.9c0-5.53-4.5-10.02-10-10.02"/></svg>';
													$background_icon_color = "#0866FF";
													break;
												case "X":
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m9 7l2 5l-2 5h2l1-2.5l1 2.5h2l-2-5l2-5h-2l-1 2.5L11 7zm3-5a10 10 0 0 1 10 10a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2"/></svg>';
													$background_icon_color = "#0F1419";
													break;
												case "PINTEREST":
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9.04 21.54c.96.29 1.93.46 2.96.46a10 10 0 0 0 10-10A10 10 0 0 0 12 2A10 10 0 0 0 2 12c0 4.25 2.67 7.9 6.44 9.34c-.09-.78-.18-2.07 0-2.96l1.15-4.94s-.29-.58-.29-1.5c0-1.38.86-2.41 1.84-2.41c.86 0 1.26.63 1.26 1.44c0 .86-.57 2.09-.86 3.27c-.17.98.52 1.84 1.52 1.84c1.78 0 3.16-1.9 3.16-4.58c0-2.4-1.72-4.04-4.19-4.04c-2.82 0-4.48 2.1-4.48 4.31c0 .86.28 1.73.74 2.3c.09.06.09.14.06.29l-.29 1.09c0 .17-.11.23-.28.11c-1.28-.56-2.02-2.38-2.02-3.85c0-3.16 2.24-6.03 6.56-6.03c3.44 0 6.12 2.47 6.12 5.75c0 3.44-2.13 6.2-5.18 6.2c-.97 0-1.92-.52-2.26-1.13l-.67 2.37c-.23.86-.86 2.01-1.29 2.7z"/></svg>';
													$background_icon_color = "#E60023";
													break;
												case "INSTAGRAM":
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3"/></svg>';
													$background_icon_color = "linear-gradient(115deg, #f9ce34, #ee2a7b, #6228d7)";
													break;
												case "THREADS":
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><rect width="24" height="24" fill="none"/><path fill="#FFFFFF" d="M6.321 6.016c-.27-.18-1.166-.802-1.166-.802.756-1.081 1.753-1.502 3.132-1.502.975 0 1.803.327 2.394.948s.928 1.509 1.005 2.644q.492.207.905.484c1.109.745 1.719 1.86 1.719 3.137 0 2.716-2.226 5.075-6.256 5.075C4.594 16 1 13.987 1 7.994 1 2.034 4.482 0 8.044 0 9.69 0 13.55.243 15 5.036l-1.36.353C12.516 1.974 10.163 1.43 8.006 1.43c-3.565 0-5.582 2.171-5.582 6.79 0 4.143 2.254 6.343 5.63 6.343 2.777 0 4.847-1.443 4.847-3.556 0-1.438-1.208-2.127-1.27-2.127-.236 1.234-.868 3.31-3.644 3.31-1.618 0-3.013-1.118-3.013-2.582 0-2.09 1.984-2.847 3.55-2.847.586 0 1.294.04 1.663.114 0-.637-.54-1.728-1.9-1.728-1.25 0-1.566.405-1.967.868ZM8.716 8.19c-2.04 0-2.304.87-2.304 1.416 0 .878 1.043 1.168 1.6 1.168 1.02 0 2.067-.282 2.232-2.423a6.2 6.2 0 0 0-1.528-.161"/></svg>';
													$background_icon_color = "#000000";
													break;
												case "TIKTOK";
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)"><path d="M 36.203 35.438 v -3.51 c -1.218 -0.173 -2.447 -0.262 -3.677 -0.268 c -15.047 0 -27.289 12.244 -27.289 27.291 c 0 9.23 4.613 17.401 11.65 22.342 c -4.712 -5.039 -7.332 -11.681 -7.328 -18.58 C 9.559 47.88 21.453 35.784 36.203 35.438" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,242,234); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/><path d="M 36.847 75.175 c 6.714 0 12.19 -5.341 12.44 -11.997 l 0.023 -59.417 h 10.855 c -0.232 -1.241 -0.349 -2.5 -0.35 -3.762 H 44.989 l -0.025 59.419 c -0.247 6.654 -5.726 11.993 -12.438 11.993 c -2.015 0.001 -4 -0.49 -5.782 -1.431 C 29.079 73.238 32.839 75.171 36.847 75.175 M 80.441 23.93 v -3.302 c -3.989 0.004 -7.893 -1.157 -11.232 -3.339 c 2.928 3.371 6.869 5.701 11.234 6.641" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,242,234); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/><path d="M 69.209 17.286 c -3.272 -3.744 -5.075 -8.549 -5.073 -13.522 h -3.972 C 61.203 9.318 64.472 14.205 69.209 17.286 M 32.526 46.486 c -6.88 0.008 -12.455 5.583 -12.463 12.463 c 0.004 4.632 2.576 8.88 6.679 11.032 c -1.533 -2.114 -2.358 -4.657 -2.358 -7.268 c 0.007 -6.88 5.582 -12.457 12.463 -12.465 c 1.284 0 2.515 0.212 3.677 0.577 V 35.689 c -1.218 -0.173 -2.447 -0.262 -3.677 -0.268 c -0.216 0 -0.429 0.012 -0.643 0.016 v 11.626 C 35.014 46.685 33.774 46.49 32.526 46.486" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,0,79); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/><path d="M 80.441 23.93 v 11.523 c -7.689 0 -14.81 -2.459 -20.627 -6.633 v 30.13 c 0 15.047 -12.24 27.289 -27.287 27.289 c -5.815 0 -11.207 -1.835 -15.639 -4.947 c 5.151 5.555 12.384 8.711 19.959 8.709 c 15.047 0 27.289 -12.242 27.289 -27.287 v -30.13 c 6.009 4.321 13.226 6.642 20.627 6.633 V 24.387 c -1.484 0 -2.927 -0.161 -4.323 -0.46" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,0,79); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/><path d="M 59.813 58.949 v -30.13 c 6.009 4.322 13.226 6.642 20.627 6.633 V 23.93 c -4.364 -0.941 -8.305 -3.272 -11.232 -6.644 c -4.737 -3.081 -8.006 -7.968 -9.045 -13.522 H 49.309 l -0.023 59.417 c -0.249 6.654 -5.726 11.995 -12.44 11.995 c -4.007 -0.004 -7.768 -1.938 -10.102 -5.194 c -4.103 -2.151 -6.676 -6.399 -6.681 -11.032 c 0.008 -6.88 5.583 -12.455 12.463 -12.463 c 1.282 0 2.513 0.21 3.677 0.577 V 35.438 C 21.453 35.784 9.559 47.88 9.559 62.713 c 0 7.173 2.787 13.703 7.328 18.58 c 4.578 3.223 10.041 4.95 15.639 4.945 C 47.574 86.238 59.813 73.996 59.813 58.949" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/></g></svg>';
													$background_icon_color = "#000000";
													break;
												case "YOUTUBE";
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M8 19V5l11 7z"/></svg>';
													$background_icon_color = "#FF0033";
													break;
												case "DRIVE";
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#FFFFFFFF" d="M12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12q0-.175-.003-.353t-.022-.341q-.067.667-.53 1.104q-.464.436-1.137.436h-2.539q-.698 0-1.195-.496t-.497-1.193v-.845h-3.385v-1.69q0-.697.498-1.198q.497-.501 1.195-.501h.846v-.77q0-.728.476-1.146t1.137-.482q-.673-.26-1.38-.392T12 4Q8.65 4 6.325 6.325T4 12v.289q0 .134.02.288H8.5q1.42 0 2.402.983q.983.982.983 2.393v.855H9.346v2.73q.616.222 1.286.342T12 20"/></svg>';
													$background_icon_color = "#4AB1FFFF";
													break;
												case "FACEBOOK_GRUPO";
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#036ED1FF" d="M12 2.04c-5.5 0-10 4.49-10 10.02c0 5 3.66 9.15 8.44 9.9v-7H7.9v-2.9h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89c1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.45 2.9h-2.33v7a10 10 0 0 0 8.44-9.9c0-5.53-4.5-10.02-10-10.02"/></svg>';
													$background_icon_color = "#FFFFFFFF";
													break;
												case "TELEGRAM";
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<path fill="#1576C1FF" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19c-.14.75-.42 1-.68 1.03c-.58.05-1.02-.38-1.58-.75c-.88-.58-1.38-.94-2.23-1.5c-.99-.65-.35-1.01.22-1.59c.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.21-.02c-.09.02-1.49.95-4.22 2.79c-.4.27-.76.41-1.08.4c-.36-.01-1.04-.2-1.55-.37c-.63-.2-1.12-.31-1.08-.66c.02-.18.27-.36.74-.55c2.92-1.27 4.86-2.11 5.83-2.51c2.78-1.16 3.35-1.36 3.73-1.36c.08 0 .27.02.39.12c.1.08.13.19.14.27c-.01.06.01.24 0 .38" />
											</svg>';
													$background_icon_color = "#FFFFFFFF";
													break;
												case "WHATSAPP";
													$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<path fill="#06A93FFF" d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.2 8.2 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31c-.22.25-.87.86-.87 2.07c0 1.22.89 2.39 1 2.56c.14.17 1.76 2.67 4.25 3.73c.59.27 1.05.42 1.41.53c.59.19 1.13.16 1.56.1c.48-.07 1.46-.6 1.67-1.18s.21-1.07.15-1.18c-.07-.1-.23-.16-.48-.27c-.25-.14-1.47-.74-1.69-.82c-.23-.08-.37-.12-.56.12c-.16.25-.64.81-.78.97c-.15.17-.29.19-.53.07c-.26-.13-1.06-.39-2-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.12-.24-.01-.39.11-.5c.11-.11.27-.29.37-.44c.13-.14.17-.25.25-.41c.08-.17.04-.31-.02-.43c-.06-.11-.56-1.35-.77-1.84c-.2-.48-.4-.42-.56-.43c-.14 0-.3-.01-.47-.01" />
											</svg>';
													$background_icon_color = "#FFFFFFFF";
													break;
											}
									?>


											<a href="<?php echo $link['link'] ?>" target="_blank" style="background:<?php echo $background_icon_color; ?>;" class=" btn btn-info btn-sm"><?php echo $svg_icon; ?> </a>
										<?php }
									} else { ?>
										<a href="#" class=" btn btn-warning btn-sm"><i class="fa fa-globe"></i> </a>
									<?php } ?>

								</td>

								<td style="width:180px;">

									<?php if ($_SESSION["user_id"] == $_GET['user_id']) { ?>

										<a href="index.php?view=editproduct&id=<?php echo $types["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
													<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
												</svg></i></a>
										<a href="./?action=ajax&function=del_products&user_id=<?php echo $_GET['user_id']; ?>&id=<?php echo $types["id"]; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&activity_title=<?php echo $_GET["activity_title"]; ?>&estate=<?php echo $_GET["estate"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&code_info=<?php echo $_GET["code_info"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
													<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
												</svg></i></a>


									<?php } elseif ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9 || (($_SESSION["user_type"] == 8 || $_SESSION["user_rol"] == 'Políticas públicas') && $_SESSION["user_region"] == $_GET["estate"])) { ?>

										<a href="index.php?view=editproduct&id=<?php echo $types["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
													<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
												</svg></i></a>
										<a href="./?action=ajax&function=del_products&user_id=<?php echo $_GET['user_id']; ?>&id=<?php echo $types["id"]; ?>&id_activity=<?php echo $_GET["id_activity"]; ?>&activity_title=<?php echo $_GET["activity_title"]; ?>&estate=<?php echo $_GET["estate"]; ?>&date_activity=<?php echo $_GET["date_activity"]; ?>&code_info=<?php echo $_GET["code_info"]; ?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
													<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
												</svg></i></a>


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
					// console.log(categoria);
					$.post("core/app/view/getCatProduct.php", {
						categoria: categoria
					}, function(data) {
						// console.log(data);
						$("#format_detail").html(data);
					});

					// if (categoria == "Comunas en Red Digital") {
					// 	document.getElementById("userfile_f").style.display = "block";
					// 	document.getElementById("userfile_f").required = true;
					// }else {
					// 	document.getElementById("userfile_f").style.display = "none";
					// 	document.getElementById("userfile_f").required = false;
					// }

				});
			})

		});
	</script>