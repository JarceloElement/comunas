<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// $r = PersonalCapabilitiesData::getRepeated("14948691");
// echo "XXX".$r->user_dni;
$alert = isset($_GET["swal"]) ? $_GET["swal"] : "";
?>




<script language="javascript">
	$(document).ready(function() {
		// NOTIFICACION
		if ('<?php echo $alert; ?>' != "") {
			Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '<?php echo $alert; ?>',
				showConfirmButton: false,
				timer: 1500
			})
		};




		// evento al cerrar el modal
		$('#map_preview').on('hide.bs.modal', function(e) {
			// console.log("close modal");
		})





	});



	var names = [
		'User id',
		'Tipo de usuario',
		'Tipo de personal',
		'Correo',
		'DNI',
		'Nombres',
		'Apellidos',
		'Teléfono',
		'Code-Info',
		'Infocentro',
		'Estado',
		'Municipo',
		'Parroquia',
		'Tipo de zona',
		'Habilidades en Blender',
		'Habilidades en Python',
		'Habilidades en Stop Motion',
		'Habilidades en Diseño web',
		'Habilidades en Wordpress',
		'Habilidades en Html',
		'Habilidades en PHP',
		'Habilidades en Diseño de blog',
		'Habilidades en Revista digital',
		'Habilidades en Economía digital',
		'Habilidades en Manejo de Criptoactivos',
		'Habilidades en Banca y Patria',
		'Habilidades en Comercio electrónico',
		'Habilidades en Uso de dispositivos móviles',
		'Habilidades en Soporte Técnico Computadoras',
		'Habilidades en Soporte Técnico Móvil',
		'Habilidades en Soporte Técnico de Redes',
		'Habilidades en Uso y manejo de las RRSS',
		'Habilidades en Seguridad en las redes sociales',
		'Habilidades en Diseño y manejo de imágenes',
		'Habilidades en Edición de videos en dispositivos móviles',
		'Habilidades en plataformas de comunicación a distancia',
		'Habilidades en Aplicaciones de Libre Office',
		'Habilidades en Manipulación de Imágenes? (Creación de memes)',
		'Habilidades en creación y preparación de Presentaciones',
		'Habilidades en Cómo llevar un libro contable',
		'Habilidades en Elaborar un presupuesto',
		'Habilidades en Planificación estratégica',
		'Habilidades en  Elaboración de Proyectos',
		'Habilidades en elaboración de un Diagnostico Colectivo',
		'Habilidades en Técnicas para Construir Análisis Situacional',
		'Habilidades en Sistematización de Experiencias Comunitarias',
		'Habilidades en contenidos sobre Comunicación asertiva y organizacional',
		'Habilidades en el área de robótica',
		'Habilidades en el área de inteligencia artificial',
		'Habilidades en programación',
		'Habilidades en el área de creación de aplicaciones',
		'Áreas en las que deseas formación',
		'Otras áreas de formación necesarias',
		'¿Conoces el PNCT del MinCYT 2023-2030?',
		'De las siguientes áreas estratégicas del PNCT 2023-2030: ¿En cuál crees que según tus potencialidades puedas contribuir a su desarrollo?',
		'Conoces el Plan Nacional Infocentro 2023-2030 "Comunidades TIC para la Inclusión Digital',
		'De los siguientes ejes de actuación digital del Plan Nacional Infocentro 2023-2030: ¿En cuál crees que podrías contribuir, tomando en cuenta las fortalezas y características del entorno del Infocentro?',
		'¿Tienes conocimiento en multiplataformas de aprendizajes en modalidad remota?',
		'¿Has participado en procesos formativos en modalidad virtual?',
		'¿Has dado algún proceso formativo en línea?',
		'¿Conoces la plataforma de Aprendiendo Juntos?',
		'¿En que formación de Aprendiendo Juntos has participado?',
		'¿Te gustaría facilitar cursos en esta plataforma?',
		'¿Conoces las bondades de generar procesos formativos en línea?',
		'Sugerencias para mejorar la plataforma de Aprendiendo Juntos',
		'Registrado desde sistema',
		'ID',
		'Fecha del registro'


	];


	$(document).on('click', 'button[type="map_p"]', function(event) {
		let id = this.id;
		var data_map = document.getElementsByClassName("data_map").item(id).id;
		const dataMap = data_map.split("{");
		document.getElementById("title_preview").innerHTML = dataMap[8] + " | " + dataMap[10];

		var new_school = document.getElementById("modal-body");
		var newDiv = document.createElement("div");
		newDiv.setAttribute("class", "map_preview_class");

		let html = "";
		for (i in names) {
			if (names[i] != "User id" && names[i] != "Tipo de usuario" && names[i] != "Campos listos" && names[i] != "Tipo de zona") {

				data_map = (names[i] === "Progeso %") ? dataMap[i] + "%" : dataMap[i];

				if (dataMap[i] === "") {


					html = `
				<div class="form-group col-md-12">
					<blockquote class="blockquote mb-0">
						<p style="color:red;">` + names[i] + `</p>
						<p>` + data_map + `</p>
					</blockquote>
				</div>
				`;
				} else {
					html = `
				<div class="form-group col-md-12">
					<blockquote class="blockquote mb-0">
						<p><small class="text-muted">` + names[i] + `</small></p>
						<p>` + data_map + `</p>
					</blockquote>
				</div>
				`;
				}
				newDiv.innerHTML += html;
			}
		}

		// <!?php echo ($campos_listos*100/$total_campos == 100 ? ' bg-success ' : ' '); ?>

		// elimina el div agregado
		$('#map_preview .map_preview_class').empty();
		// agrega el nuevo div
		new_school.appendChild(newDiv);

		$('#map_preview').modal("show")
		// console.log(dataMap[0]);

	});
</script>




<br>
<br>





<!-- Modal -->
<div class="modal fade" id="map_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="card-header">
					<h5 class="title_preview" id="title_preview">title</h5>
				</div>

				<button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body fullscreen" id="modal-body">

				<!-- <img src='' id='imagen_modal' style="margin:1px auto; display:block; width: 100%; height:auto;" alt="Imagen"/>

			<div class="mui--text-center">
				<h5 class="title_preview" id="title_preview" >Descripción</h5> 
			</div> -->
			</div>

			<div class="modal-footer">
				<button type="button" id="close_modal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>







<div class="content">
	<div class="container-fluid">
		<!-- <div class="card bg-light mb-3"> -->
		<!-- <div class="row justify-content-md-center"> -->
		<div class="row">
			<div class="col-md-12">



				<?php

				$CantidadMostrar = 100;
				$url_pag_atras = "";
				$url_pag_adelante = "";

				// Validado  la variable GET
				$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


				$users = array();
				if (isset($_GET["q"]) && $_GET["q"] != "") {

					if ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) {
						$sql = "SELECT * from encuesta_capacidades_tecnologicas where user_state='" . $_SESSION["user_region"] . "' and";
					} else {
						$sql = "SELECT * from encuesta_capacidades_tecnologicas where";
					}


					if ($_GET["q"] != "") {
						$sql .= " (user_name_os like '%$_GET[q]%' or user_type like '$_GET[q]%' or user_state like '$_GET[q]%' or user_dni like '$_GET[q]%' or user_email like '$_GET[q]%' or code_info like '$_GET[q]%') ";
					}

					$users = PersonalCapabilitiesData::getAllPg($sql . " order by id desc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar));
					$TotalReg = $users[1];
					// Asigna url de paginacion
					$url_pag = "<a href=\"?view=report_capabilities_tech&q=" . $_GET["q"] . "&pag=";

					$param_csv = $sql;
					$param_sql = "true";
				} else {


					if ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) {
						$sql = "SELECT * from encuesta_capacidades_tecnologicas where user_state='" . $_SESSION["user_region"] . "' order by id desc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
						$sql_total = "SELECT * from encuesta_capacidades_tecnologicas where user_state='" . $_SESSION["user_region"] . "'";
					} else {
						$sql = "SELECT * from encuesta_capacidades_tecnologicas order by id desc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
						$sql_total = "SELECT * from encuesta_capacidades_tecnologicas";
					}


					$usersTotal = PersonalCapabilitiesData::getAllPg($sql_total);
					$users = PersonalCapabilitiesData::getAllPg($sql);
					// $total_q = PersonalCapabilitiesData::getAll();
					$TotalReg = $usersTotal[1];

					$url_pag_1 = "?view=report_capabilities_tech&pag=";
					$url_pag = " <a href=\"?view=report_capabilities_tech&pag=";

					$param_csv = $sql_total;
					$param_sql = "true";
				}
				// Asigna url de paginacion

				$DB_name = "encuesta_capacidades_tecnologicas";
				$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
				?>

				<div class="card text-center">
					<div class="card-body">
						<h5 class="card-title text-primary">Encuesta de habilidades tecnológicas</h5>
						<div class="card-header"></div>
						<br>
						<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
					</div>
				</div>


				<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>

					<br>

					<form class="form-inline">
						<input type="hidden" name="view" value="report_capabilities_tech">


						<div class="form-group row mx-1 mb-1">
							<label for="search" class="col-sm-2 col-form-label">Buscar</label>
							<div class="col-sm-8">
								<input id="search" type="text" name="q" class="form-control" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																										echo $_GET["q"];
																									} ?>">
							</div>
						</div>

						<div class="form-group mx-1 mb-1">
							<button type="submit" class="btn btn-light mb-2">Buscar</button>
						</div>
						<!-- <div class="form-group mx-1 mb-1">
							<a class="btn btn-secondary mb-2" href="assets/pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar"><span class="material-symbols-outlined">download</span> CSV</a>
						</div> -->
						<div class="form-group mx-1 mb-1">
							<a class="btn btn-secondary mb-2" href="core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><span class="material-symbols-outlined">download</span> XLSX</a>
						</div>

					</form>

					<br>
				<?php } ?>


				<!-- linea -->
				<div class="progress">
					<div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
				</div>


				<!-- </div> -->
			</div>
		</div>
	</div>
</div>



<br>
<br>




<div class="card-content table-responsive">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">

				<?php

				if (count($users[0]) > 0) {

				?>
					<table id="example" class="table table-bordered table-hover" style="max-width:100%">
						<thead>
							<!-- <th>Ver</th> -->
							<!-- <th>Estatus</th> -->
							<th>Estado</th>
							<th>Infocentro</th>
							<!-- <th>Usuario</th> -->
							<th>Correo</th>
							<th>Tipo/Usuario</th>
							<th>OS</th>
							<th>Fecha de registro</th>
							<th>Fecha de actualizado</th>
							<!-- <th style="width: 250px;"> Progreso</th> -->
						</thead>


						<?php

						$ID = 0;

						foreach ($users[0] as $user) {
							$DATA = "";
							foreach ($user as $data) {
								$DATA .= $data . "{";
							}

						?>
							<tr>
								<!-- <td>
									<button type="map_p" class="btn btn-primary" id="<!?php echo $ID; ?>">Ver</button>
								</td> -->
								<td><?php echo $user->user_state; ?></td>
								<td><?php echo $user->code_info; ?></td>
								<!-- <td><!?php echo $user->user_name; ?></td> -->
								<td><?php echo $user->user_email; ?></td>
								<td><?php echo $user->user_type; ?></td>
								<td><?php echo $user->user_name_os; ?></td>
								<td><?php echo $user->date_reg; ?></td>
								<td><?php echo $user->date_update; ?></td>
							</tr>

							<!-- data preview -->
							<p class="data_map" id="<?php echo $DATA; ?>"></p>





						<?php
							$ID += 1;
						}
						?>

					</table>

				<?php
				} else {
					// no hay usuarios
					echo "<p class='alert alert-danger'>No hay registros</p>";
				}
				?>


			</div>
		</div>
	</div>
</div>
<br>

<?php
// paginacion
if (count($users) > 0) {
	require_once "core/app/layouts/pagination.php";
}
?>






<br>






<script>
	$(function() {
		$('#example').DataTable({

		})

		$('[data-toggle="tooltip"]').tooltip({
			placement: 'top'
		})

	})



	$.extend($.fn.dataTable.defaults, {


		// Display
		dom: '<Bfl>rti<p>',


		// dom: '<"top"f><"data-table"rt<"bottom"Blip>>', // https://datatables.net/examples/basic_init/dom.html
		lengthMenu: [ // https://datatables.net/examples/advanced_init/length_menu.html
			[10, 25, 50, -1],
			[10, 25, 50, "Todo"],
		],


		language: {
			search: '_INPUT_',
			searchPlaceholder: 'Filtrar resultados de la página', // https://datatables.net/reference/option/language.searchPlaceholder

			select: {
				rows: {
					_: '| %d filas seleccionadas',
					0: '| clic en la fila para seleccionar',
					1: '| 1 fila seleccionada'
				}
			},

			info: '_START_-_END_ de _TOTAL_', // https://datatables.net/examples/basic_init/language.html
			lengthMenu: 'Filas por páginas _MENU_',
			infoEmpty: '0 de _MAX_',
			infoFiltered: '| de un total de _MAX_',
			paginate: {
				first: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M18.41 16.59L13.82 12l4.59-4.59L6l-6 6 6 6zM6 6h2v12H6z"/></svg>',
				previous: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.4141z"/></svg>',

				next: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/></svg>',
				last: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M5.59 7.41L10.18 12l-4.59 4.59L7 18l6-6-6-6zM6h2v12h-2z"/></svg>'
			},

			decimal: ',',
			thousands: '.',
			zeroRecords: 'No hay registros',

		},


		// Data display
		colReorder: true,
		fixedHeader: true,
		ordering: true,
		paging: true,
		pageLength: 10,
		pagingType: 'full', // https://datatables.net/reference/option/pagingType
		responsive: false,
		searching: true,
		stateSave: true,
		select: {
			style: 'multi+shift', // https://datatables.net/reference/option/select.style
			className: 'table-active' // https://datatables.net/reference/option/select.className

		},


		buttons: {

			buttons: [
				// {
				// 	extend: 'copy',
				// 	text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M19,21H8V7H19M19,5H8A2,2 0 0,0 6,7V21A2,2 0 0,0 8,23H19A2,2 0 0,0 21,21V7A2,2 0 0,0 19,5M16,1H4A2,2 0 0,0 2,3V17H4V3H16V1Z"/></svg>',
				// 	className: 'btn-icon',
				// 	attr: {
				// 		title: 'Copy table data to clipboard',
				// 		'data-toggle': 'tooltip'
				// 	}
				// },
				{
					extend: 'print',
					text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z"/></svg>',
					className: 'btn-icon',
					attr: {
						title: 'Imprimir página',
						'data-toggle': 'tooltip'
					}
				},
				// {
				// 	extend: 'csv',
				// 	text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2M18 20H6V4H13V9H18V20M10 19L12 15H9V10H15V15L13 19H10"/></svg>',
				// 	className: 'btn-icon',
				// 	attr: {
				// 		title: 'Exportar como CSV',
				// 		'data-toggle': 'tooltip'
				// 	}
				// },
				// {
				// 	text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M5,3H7V5H5V10A2,2 0 0,1 3,12A2,2 0 0,1 5,14V19H7V21H5C3.93,20.73 3,20.1 3,19V15A2,2 0 0,0 1,13H0V11H1A2,2 0 0,0 3,9V5A2,2 0 0,1 5,3M19,3A2,2 0 0,1 21,5V9A2,2 0 0,0 23,11H24V13H23A2,2 0 0,0 21,15V19A2,2 0 0,1 19,21H17V19H19V14A2,2 0 0,1 21,12A2,2 0 0,1 19,10V5H17V3H19M12,15A1,1 0 0,1 13,16A1,1 0 0,1 12,17A1,1 0 0,1 11,16A1,1 0 0,1 12,15M8,15A1,1 0 0,1 9,16A1,1 0 0,1 8,17A1,1 0 0,1 7,16A1,1 0 0,1 8,15M16,15A1,1 0 0,1 17,16A1,1 0 0,1 16,17A1,1 0 0,1 15,16A1,1 0 0,1 16,15Z"/></svg>',
				// 	action: function(e, dt, button, config) {
				// 		let data = dt.buttons.exportData();
				// 		$.fn.dataTable.fileSave(
				// 			new Blob([JSON.stringify(data)]),
				// 			'Data ExportJSON.json'
				// 		);
				// 	},
				// 	className: 'btn-icon',
				// 	attr: {
				// 		title: 'Exportar como JSON',
				// 		'data-toggle': 'tooltip'
				// 	}
				// },
				{
					extend: 'excel',
					text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M14 2H6C4.89 2 4 2.9 4 4V20C4 21.11 4.89 22 6 22H18C19.11 22 20 21.11 20 20V8L14 2M18 20H6V4H13V9H18V20M12.9 14.5L15.8 19H14L12 15.6L10 19H8.2L11.1 14.5L8.2 10H10L12 13.4L14 10H15.8L12.9 14.5Z"/></svg>',
					className: 'btn-icon',
					attr: {
						title: 'Exportar a Excel',
						'data-toggle': 'tooltip'
					}
				},
				{
					extend: 'pdf',
					download: 'open',
					text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M14,2L20,8V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V4A2,2 0 0,1 6,2H14M18,20V9H13V4H6V20H18M10.92,12.31C10.68,11.54 10.15,9.08 11.55,9.04C12.95,9 12.03,12.16 12.03,12.16C12.42,13.65 14.05,14.72 14.05,14.72C14.55,14.57 17.4,14.24 17,15.72C16.57,17.2 13.5,15.81 13.5,15.81C11.55,15.95 10.09,16.47 10.09,16.47C8.96,18.58 7.64,19.5 7.1,18.61C6.43,17.5 9.23,16.07 9.23,16.07C10.68,13.72 10.9,12.35 10.92,12.31M11.57,13.15C11.17,14.45 10.37,15.84 10.37,15.84C11.22,15.5 13.08,15.11 13.08,15.11C11.94,14.11 11.59,13.16 11.57,13.15M14.71,15.32C14.71,15.32 16.46,15.97 16.5,15.71C16.57,15.44 15.17,15.2 14.71,15.32M9.05,16.81C8.28,17.11 7.54,18.39 7.72,18.39C7.9,18.4 8.63,17.79 9.05,16.81M11.57,11.26C11.57,11.21 12,9.58 11.57,9.53C11.27,9.5 11.56,11.22 11.57,11.26Z"/></svg>',
					className: 'btn-icon',
					attr: {
						title: 'Exportar a PDF',
						'data-toggle': 'tooltip'
					}
				}
			],
			dom: {
				container: {
					// className: 'dt-buttons d-none d-md-flex flex-wrap'
					className: 'dt-buttons d-md-flex flex-wrap'
				},
				buttonContainer: {},
				button: {
					className: 'btn'
				}
			}
		},

	})
</script>

<style>
	.dataTables_wrapper .bottom {
		-ms-flex-align: center;
		align-items: center;
		border-top: 0px solid #e1e1e1;
		display: -ms-flexbox;
		display: flex;
		min-height: 52px;
		/* padding: 0 2px 0 35%; */
	}

	.dataTables_info {
		text-align: center;
		padding: 10px;
	}

	.dataTables_paginate {
		display: flex;
		justify-content: center;
	}

	.dataTables_length {
		display: flex;
		justify-content: center;
		padding: 10px;
	}
</style>