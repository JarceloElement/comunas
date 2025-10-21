<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// $maps = SocialMapData::getAll();
// foreach($maps as $map){
// 	$total_progress = [];

// 	$r = SocialMapData::getById($map->id);
// 	foreach($r as $user){
// 		if ($user != ""){
// 			$total_progress[] = $user;
// 		}
// 	}
// 	$progress_total = round(count($total_progress)*100/59);

// 	$r->id = $map->id;
// 	$r->progress = count($total_progress);
// 	$r->progress_percent = $progress_total;
// 	$r->update();
// // echo "<div>".count($total_progress)."</div><br>";
// }



?>





<script language="javascript">
	$(document).ready(function() {
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




		// evento al cerrar el modal
		$('#map_preview').on('hide.bs.modal', function(e) {
			// console.log("close modal");
		})





	});



	var names = [
		'User id',
		'Tipo de usuario',
		'Campos listos',
		'Progeso %',
		'Estado',
		'Code_info',
		'Responsable',
		'Cantidad de comunas',
		'Cantidad de Consejos comunales',
		'Otras org en el entorno del infocentro',
		'Otras org. relacionadas directamente al infocentro',
		'Actividades Q. realizan las org. en el infocentro',
		'Emprendimientos en el entorno del infocentro',
		'Forma en que el infocentro brinda apoyo a emprendimientos',
		'Existen Ins. educ. para niños/as con discapacidad en torno al infocentro',
		'Forma en que el infocentro apoyo a instituciones educativas',
		'Potencialidades de la comunidad',
		'Familias en torno al infocentro',
		'Población en torno al infocentro',
		'Niños de 0 a 3',
		'Niños de 4 a 7',
		'Niños de 8 a 11',
		'Niños Adolescentes de 12 a 15',
		'Hombres Jóvenes de 16 a 19',
		'Hombres Jóvenes de 20 a 23',
		'Hombres Jóvenes de 24 a 27',
		'Hombres Jóvenes de 28 a 31',
		'Hombres adultos de 32 a 35',
		'Hombres adultos de 36 a 39',
		'Hombres adultos de 40 a 59',
		'Adultos mayores de 60 a 120',
		'Niñas de 0 a 3',
		'Niñas de 4 a 7',
		'Niñas de 8 a 11',
		'Niñas adolescentes de 12 a 15',
		'Mujeres jóvenes de 16 a 19',
		'Mujeres jóvenes de 20 a 23',
		'Mujeres jónes de 24 a 27',
		'Mujeres jóvenes de 28 a 31',
		'Mujeres adulatas de 32 a 35',
		'Mujeres adultas de 36 a 39',
		'Mujeres adultas de 40 a 59',
		'Adultas mayores de 60 a 120',
		'Niños/as con discapacidad',
		'Principal proveedor de internet',
		'Otro proveedor de internet',
		'Infocentro en proyecto de Comunidades Wifi',
		'Beneficiados del proyecto comunidades wifi',
		'Espacios formativos públicos',
		'Espacios formativos privados',
		'Cantidad de teléfonos inteligentes',
		'Cantidad de tablets en la comunidad',
		'Cantidad de canaimitas en la comunidad',
		'Cantidad de laptos en la comunidad',
		'Cantidad de PC de escritorio en la comunidad',
		'Cantidad de viviendas con internet',
		'Registrado desde sistema',
		'ID de registro',
		'Fecha del registro'


	];


	$(document).on('click', 'button[type="map_p"]', function(event) {
		let id = this.id;
		var data_map = document.getElementsByClassName("data_map").item(id).id;
		const dataMap = data_map.split("{");
		document.getElementById("title_preview").innerHTML = dataMap[4] + " | " + dataMap[5];

		var new_school = document.getElementById("modal-body");
		var newDiv = document.createElement("div");
		newDiv.setAttribute("class", "map_preview_class");

		let html = "";
		for (i in names) {
			if (names[i] != "User id" && names[i] != "Tipo de usuario" && names[i] != "Campos listos") {

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






	function updatefield(field, data, id) {

		$.post("index.php?action=socialmap&function=updatefield", {
			id: id,
			field: field,
			data: data

		}, function(response, status) {
			if (status == 'success') {
				toastify('Guardado', true, 1000, "dashboard");

			}
		});

	}
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
				$datatable_array = [];

				// Validado  la variable GET
				$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


				$users = array();
				if ((isset($_GET["q"]) && $_GET["q"] != "") || (isset($_GET["school_type"]) && $_GET["school_type"] != "")) {


					if (($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 10)) {
						$sql = "SELECT * from info_social_map_educations WHERE s_state='" . $_SESSION["user_region"] . "' and ";
					} else {
						$sql = "SELECT * from info_social_map_educations WHERE ";
					}


					if ($_GET["q"] != "") {
						$sql .= " (s_state like '$_GET[q]%' or code_info like '$_GET[q]%') ";
					}

					if ($_GET["school_type"] != "") {
						if ($_GET["q"] != "") {
							$sql .= " and ";
						}
						$sql .= " school_type='" . $_GET['school_type'] . "'";
					}

					// Busca el total de registros segun parametros de consulta
					$users = SocialMapData::getBySQL($sql . " order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar);
					$sql_total = $sql;
					$total = SocialMapData::getBySQL($sql_total);
					$TotalReg = count($total);
					// Asigna url de paginacion
					$url_pag = "<a href=\"?view=reportsocialmap&q=" . $_GET["q"] . "&school_type=" . $_GET["school_type"] . "&pag=";

					$param_csv = $sql;
					$param_sql = "true";

				} else {

					if (($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
						$sql = "SELECT * from info_social_map_educations WHERE s_state='" . $_SESSION["user_region"] . "' order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						$sql_total = "SELECT * from info_social_map_educations WHERE s_state='" . $_SESSION["user_region"] . "'";
					} else {
						$sql = "SELECT * from info_social_map_educations order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
						$sql_total = "SELECT * from info_social_map_educations";
					}

					$total = SocialMapData::getBySQL($sql_total);

					$users = SocialMapData::getBySQL($sql);
					// $total_q = SocialMapData::getAll();
					$TotalReg = count($total);

					$url_pag_1 = "?view=inst_educativas&pag=";
					$url_pag = " <a href=\"?view=inst_educativas&pag=";

					$param_csv = $sql_total;
					// $param_csv = "info_social_map_educations";
					$param_sql = "true";
					// echo $param_csv;

					// datatables
					// $con = Database::connectPDO();
					// $query_datatable = $con->prepare($sql_total);
					// $query_datatable->execute();
					// // $res_datatable = $query_datatable->fetchAll(PDO::FETCH_ASSOC);

					// while (($result = $query_datatable->fetch(PDO::FETCH_OBJ)) != false):
					// 	$result_array = [];
					// 	foreach ($result as $key => $value) {
					// 		$result_array[] = "'" . $value . "'";
					// 	}
					// 	$datatable_array[] = implode(",", $result_array);
					// endwhile;
					// print_r($datatable_array[330]);



				}
				// Asigna url de paginacion

				$DB_name = "info_social_map_educations";
				$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
				?>

				<!-- total mapas registrados -->
				<!-- <div class="col-md-12">
						<div class="form-group text_label">
							<span class="badge badge-primary">Total de mapas creados</span>
						</div>
						<div class="form-group text_label">
							<!?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
						</div>


					</div> -->


				<div class="card text-center">
					<div class="col-md-12">
						<br>
						<div class="form-group text_label">
							<span class="badge badge-primary" style="height:40px;">Instituciones educativas en torno al infocentro</span>
						</div>
						<div class="form-group text_label">
							<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
						</div>
					</div>
				</div>




				<?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>

					<br>




					<ul class="list-group">
						<form class="form-inline">
							<input type="hidden" name="view" value="inst_educativas">

							<div class="container">


								<div class="row">

									<div class="col-sm-4">
										<div class="form-group">
											<li class="list-group-item d-flex">
												<span class="material-icons md-32" style="color:#9e9e9e;">search</span>
												<input id="search" style="min-width: 300px;" type="text" name="q" class="form-control" placeholder="Buscar" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
																																				echo $_GET["q"];
																																			} ?>">
											</li>
										</div>
									</div>

									<div class="col-sm-4">
										<li class="list-group-item d-flex">
											<span class="material-icons md-32" style="color:#9e9e9e;">home_work</span>
											<div class="col-sm-6">
												<select name="school_type" class="form-control" style="min-width: 300px;" id="school_type">
													<option value="">- TIPO -</option>
													<option value="Pública">Pública</option>
													<option value="Privada">Privada</option>
												</select>
											</div>
										</li>
									</div>



									<div class="col-sm-4">
										<li class="list-group-item d-flex">
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-block">Buscar</button>
											</div>
											<div class="col-md-6">
												<a class="btn btn-secondary btn-block" href="core/app/view/exportxlsxmysql.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><span class="material-symbols-outlined">download</span> XLSX</a>
											</div>
										</li>
									</div>

								</div>

							</div>







						</form>
					</ul>

					<br>
				<?php } ?>


				<!-- linea -->
				<!-- <div class="progress" style="height:2px;">
					<div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
				</div> -->

			</div>
		</div>
	</div>
</div>








</form name="form">


<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="form-group">
						<div class="card-content table-responsive">
							<div class="card-body">

								<?php if (count($users) > 0) { ?>

									<table id="example" class="table table-bordered table-hover" style="max-width:100%;">

										<thead class="thead-light">
											<th style="max-width:60px;">Estado</th>
											<th style="max-width:60px;">Code info</th>
											<th>Tipo organización</th>
											<th class="priority_5" style="max-width:50px;">Nombre organización</th>
											<th class="priority_5">N° registro</th>
											<th class="priority_5" style="max-width:50px;">Dirección</th>
											<th class="priority_5">Población</th>
											<th class="priority_5">N° Mujeres</th>
											<th class="priority_5">N° Hombres</th>
											<!-- <th style="width: 250px;"> Progreso</th> -->
										</thead>

										<?php
										$ID = 0;
										foreach ($users as $user) {
											$DEMO = "";
											$Update_progress = [];

											foreach ($user as $data) {
												$DEMO .= $data . "{";
											}
										?>
											<tr>
												<!-- <td>
												<button type="map_p" class="btn btn-primary" id="<!?php echo $ID; ?>">Ver</button>
											</td> -->
												<td><?php echo $user->s_state; ?></td>
												<td><?php echo $user->code_info; ?></td>
												<td><?php echo $user->school_type; ?></td>
												<td class="priority_5"><?php echo $user->school_name; ?></td>
												<td class="priority_5"><?php echo $user->dea_code; ?></td>
												<td class="priority_5"><?php echo $user->school_address; ?></td>
												<td class="priority_5"><?php echo $user->school_n_students; ?></td>
												<td class="priority_5"><?php echo $user->school_n_students_female; ?></td>
												<td class="priority_5"><?php echo $user->school_n_students_male; ?></td>
											</tr>

											<!-- data preview -->
											<p class="data" id="set_data">
											<p class="data_map" id="<?php echo $DEMO; ?>"></p>
											<!-- <p class="data_code_info" id="<!?php echo $user->code_info;?>"></p> -->
											<!-- <p class="data_infe_state" id="<!?php echo $user->infe_state;?>"></p> -->
											</p>





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
			</div>
		</div>
	</div>
</div>
<br>


<center>


	<!-- <nav aria-label="pagination">
	<ul class="pagination justify-content-center"> -->

	<?php

	/*Sector de Paginacion */
	if (count($users) > 0) {

		//Operacion matematica para boton siguiente y atras 
		$IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
		$DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);

		echo $url_pag . $DecrementNum . "\" class=\"btn btn-secondary btn-sm mb-1 \"> <span class=\"material-icons-outlined\">west</span> </a>";
		// echo '<li class="page-item"><a class="page-link" href="'.$url_pag_1.$DecrementNum.'">Anterior</a></li>';

		//Se resta y suma con el numero de pag actual con el cantidad de 
		//numeros  a mostrar
		$Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
		$Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);

		//Se valida
		$Desde = ($Desde < 1) ? 1 : $Desde;
		$Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
		//Se muestra los numeros de paginas
		for ($i = $Desde; $i <= $Hasta; $i++) {
			//Se valida la paginacion total
			//de registros
			if ($i <= $TotalRegistro) {
				//Validamos la pag activo
				if ($i == $compag) {
					echo $url_pag . $i . "\" class=\"btn btn-primary btn-sm mb-1 \"active\">" . $i . "</a> ";
					// echo '<li class="page-item active" aria-current="page"><span class="page-link">'.$i.'</span></li>';
				} else {
					echo $url_pag . $i . "\" class=\"btn btn-secondary btn-sm mb-1 \">" . $i . "</a> ";
					// echo '<li class="page-item"><a class="page-link" href="'.$url_pag_1.$i.'">'.$i.'</a></li>';
				}
			}
			// echo '<a class="btn btn-primary" href="#" role="button">Link</a>';
		}

		// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";
		echo $url_pag . $IncrimentNum . "\" class=\"btn btn-secondary btn-sm mb-1 \"> <span class='material-icons-outlined'>east</span> </a>";
		// echo '<li class="page-item"><a class="page-link" href="'.$url_pag_1.$IncrimentNum.'">Siguiente</a></li>';

	}
	?>


	<!-- </ul>
</nav> -->



</center>



<br>


<!-- <link href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script> -->


<!-- <table id="datatables-example" class="table"></table> -->



<script>
	const dataSet = [
		["Tiger Nixon", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800"],
		["Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750"],
		["Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000"],
		["Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060"],
		["Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700"],
		["Brielle Williamson", "Integration Specialist", "New York", "4804", "2012/12/02", "$372,000"],
		["Herrod Chandler", "Sales Assistant", "San Francisco", "9608", "2012/08/06", "$137,500"],
		["Rhona Davidson", "Integration Specialist", "Tokyo", "6200", "2010/10/14", "$327,900"],
		["Colleen Hurst", "Javascript Developer", "San Francisco", "2360", "2009/09/15", "$205,500"],
		["Sonya Frost", "Software Engineer", "Edinburgh", "1667", "2008/12/13", "$103,600"],
		["Jena Gaines", "Office Manager", "London", "3814", "2008/12/19", "$90,560"],
		["Quinn Flynn", "Support Lead", "Edinburgh", "9497", "2013/03/03", "$342,000"],
		["Charde Marshall", "Regional Director", "San Francisco", "6741", "2008/10/16", "$470,600"],
		["Haley Kennedy", "Senior Marketing Designer", "London", "3597", "2012/12/18", "$313,500"],
		["Tatyana Fitzpatrick", "Regional Director", "London", "1965", "2010/03/17", "$385,750"],
		["Michael Silva", "Marketing Designer", "London", "1581", "2012/11/27", "$198,500"],
		["Paul Byrd", "Chief Financial Officer (CFO)", "New York", "3059", "2010/06/09", "$725,000"],
		["Gloria Little", "Systems Administrator", "New York", "1721", "2009/04/10", "$237,500"],
		["Bradley Greer", "Software Engineer", "London", "2558", "2012/10/13", "$132,000"],
		["Dai Rios", "Personnel Lead", "Edinburgh", "2290", "2012/09/26", "$217,500"],
		["Jenette Caldwell", "Development Lead", "New York", "1937", "2011/09/03", "$345,000"],
		["Yuri Berry", "Chief Marketing Officer (CMO)", "New York", "6154", "2009/06/25", "$675,000"],
		["Caesar Vance", "Pre-Sales Support", "New York", "8330", "2011/12/12", "$106,450"],
		["Doris Wilder", "Sales Assistant", "Sydney", "3023", "2010/09/20", "$85,600"],
		["Angelica Ramos", "Chief Executive Officer (CEO)", "London", "5797", "2009/10/09", "$1,200,000"],
		["Gavin Joyce", "Developer", "Edinburgh", "8822", "2010/12/22", "$92,575"],
		["Jennifer Chang", "Regional Director", "Singapore", "9239", "2010/11/14", "$357,650"],
		["Brenden Wagner", "Software Engineer", "San Francisco", "1314", "2011/06/07", "$206,850"],
		["Fiona Green", "Chief Operating Officer (COO)", "San Francisco", "2947", "2010/03/11", "$850,000"],
		["Shou Itou", "Regional Marketing", "Tokyo", "8899", "2011/08/14", "$163,000"],
		["Michelle House", "Integration Specialist", "Sydney", "2769", "2011/06/02", "$95,400"],
		["Suki Burks", "Developer", "London", "6832", "2009/10/22", "$114,500"],
		["Prescott Bartlett", "Technical Author", "London", "3606", "2011/05/07", "$145,000"],
		["Gavin Cortez", "Team Leader", "San Francisco", "2860", "2008/10/26", "$235,500"],
		["Martena Mccray", "Post-Sales support", "Edinburgh", "8240", "2011/03/09", "$324,050"],
		["Unity Butler", "Marketing Designer", "San Francisco", "5384", "2009/12/09", "$85,675"]
	];

	$(function() {
		// $('#datatables-example').DataTable({
		// 		// Table data
		// 		data: dataSet, // My JS array
		// 		columns: [ // Define table Headers for each column
		// 			{
		// 				title: 'name'
		// 			},
		// 			{
		// 				title: 'position'
		// 			},
		// 			{
		// 				title: 'office'
		// 			},
		// 			{
		// 				title: 'extn'
		// 			},
		// 			{
		// 				title: 'start date'
		// 			},
		// 			{
		// 				title: 'salary'
		// 			},
		// 		],
		// 	})
		// 	.column([2]).visible(false) // Hide Office column for demo suitable width
		// 	.on('page.dt', function() {
		// 		$('[data-toggle="tooltip"]').tooltip({
		// 			placement: 'bottom'
		// 		})
		// 	})




		$('#example').DataTable({

		})



		$('[data-toggle="tooltip"]').tooltip({
			placement: 'top'
		})

	})



	$.extend($.fn.dataTable.defaults, {


		// Display
		// dom: '<Bflip>rt<p>',


		// dom: '<"top"f><"data-table"rt<"bottom"Blip>>', // https://datatables.net/examples/basic_init/dom.html
		lengthMenu: [ // https://datatables.net/examples/advanced_init/length_menu.html
			[10, 25, 50, -1],
			[10, 25, 50, 100],
		],


		language: {
			search: '_INPUT_',
			searchPlaceholder: 'Filtrar resultados de la página', // https://datatables.net/reference/option/language.searchPlaceholder

			select: {
				rows: {
					_: '| %d filas seleccionadas',
					0: '| clic en una fila para seleccionar',
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









	$(document).ready(function() {
		// new DataTable('#example');
		// $('#example').DataTable();

		// new DataTable('#example', {
		// 	layout: {
		// 		topStart: {
		// 			pageLength: {
		// 				menu: [10, 25, 50, 100]
		// 			}
		// 		},
		// 		topEnd: {
		// 			search: {
		// 				placeholder: 'Type search here'
		// 			}
		// 		},
		// 		bottomEnd: {
		// 			paging: {
		// 				numbers: 3
		// 			}
		// 		}
		// 	}
		// });


	});
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