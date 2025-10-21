
<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();

// echo strtoupper("ama05");
?>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />

  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->





<!-- MODAL IMAGE POPUP -->
<script language="javascript">


$(document).ready(function(){

	var Name_OS = "Unknown OS";
	// OS NAME
	if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
	if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
	if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
	if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
	if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
	// console.log(Name_OS);



	// // // AVISO
	// if (Name_OS != "Android"){
	// 	Swal.fire({
	// 	// position: 'top-center',
	// 	icon: 'warning',
	// 	title: 'Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.\n',
	// 	showConfirmButton: true,
	// 	// timer: 1000
	// 	})
	// }else{
	// 	alert('Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.');
	// }









	// <!-- MODAL SWEET ALERT -->
	$(function() {
		<?php if(isset($_GET['swal']) && $_GET['swal']!= ""): ?>
			if (Name_OS != "Android"){
					Swal.fire({
					// position: 'top-center',
					icon: 'success',
					title: '<?php echo $_GET['swal']; ?>',
					showConfirmButton: false,
					timer: 1000
					})
			}else{
				
				alert("<?php echo $_GET['swal']; ?>");
			}
		<?php endif; ?>
	});


});




$(function() {

	$(document).on('click', 'button[type="image_viewer_orig"]', function(event) {
		let id = this.id;
		let title_v = this.title;



		// METODO 1
		var body_html = document.createElement("div");
		body_html.className = "data-image";
		body_html.id = "data-image";

		Swal.fire({
			title: title_v,
			html: body_html,
			width: 800,
			padding: '1em',
			backdrop: `rgba(0,0,123,0.4)`
		});

		$.post("core/app/view/image_viewer_orig.php", { id: id }, function(data){
			$("#data-image").html(data);
		});

	});



	$(document).on('click', 'a[type="link_viewer"]', function(event) {
		let id = this.id;
		let title_v = this.title;



		// METODO 1
		var body_html = document.createElement("div");
		body_html.className = "data-image";
		body_html.id = "data-image";

		Swal.fire({
			title: title_v,
			html: body_html,
			width: 800,
			padding: '1em',
			backdrop: `rgba(0,0,123,0.4)`
		});

		$.post("core/app/view/productslink_viewer.php", { id: id }, function(data){
			$("#data-image").html(data);
		});

	});


	$(document).on('click', 'a[type="link_viewer_NO"]', function(event) {
		Swal.fire({
			title: "Producto sin enlaces web",
			// html: body_html,
			width: 800,
			padding: '1em',
			backdrop: `rgba(0,0,123,0.4)`
		});
	});


 $(document).on('click', 'button[type="image_viewer"]', function(event) {
    let id = this.id;
    // let title_v = this.title;



	// // METODO 1
	// var body_html = document.createElement("div");
	// body_html.className = "data-image";
	// body_html.id = "data-image";

	// Swal.fire({
	// 	title: title_v,
	// 	html: body_html,
	// 	width: 800,
	// 	padding: '1em',
	// 	backdrop: `rgba(0,0,123,0.4)`
	// });

	// $.post("core/app/view/image_viewer.php", { id: id }, function(data){
	// 	$("#data-image").html(data);
	// });




	// // METODO 2
    // $.post("core/app/view/image_viewer.php", { id: id }, function(data){
	// 	var body_html = document.createElement("div");
	// 	body_html.className = "data-image";
	// 	body_html.id = "data-image";
	// 	// body_html.style.width = '60%';
	// 	// body_html.style.height = '60%';
	// 	// body_html.style.margin = '100px auto';
	// 	// body_html.style.backgroundColor = '#fff';
	// 	// show modal
	// 	// mui.overlay('on', body_html);

	// 	// sweet alert
	// 	Swal.fire({
	// 	title: title_v,
	// 	html: body_html,
	// 	width: 800,
	// 	padding: '1em',
	// 	backdrop: `rgba(0,0,123,0.4)`
	// 	// customClass: "fullscreen-swal", autoHeight: false
	// 	})

	// 	$("#data-image").html(data);

    // });



	var titulo = document.getElementsByClassName("data_titulo").item(id).id;
	var imagen = document.getElementsByClassName("data_imagen").item(id).id;
	var code_info = document.getElementsByClassName("data_code_info").item(id).id;

	// alert(titulo);

	// alert(parrafos);
	Swal.fire({
		width: 800,
		title: titulo,
		imageUrl: imagen,
		text: code_info,
		// html: '<b>'+linea+'<b>',
		imageWidth: 400,
		// imageHeight: 400,
		imageAlt: 'Custom image',
		padding: '1em',
		customClass: {
			image:'swiper'
		}
	})







  });







});


</script>




    <!-- CONTENEDOR PARA EL FORM -->
    <!-- <div class="content-wrapper mui-container-fluid">
      <div class="mui--text-center">
        <form class="mui-form">
          <legend>Validación de Formulario</legend>

            <div class="mui-textfield">
              <input type="text" name="user_name" placeholder="NAME">
            </div>

            <div class="mui-textfield mui-textfield--float-label mui--text-left">
              <input type="text" id="user_dni">
              <label>DNI</label>
            </div>

            <button onclick="validateForm()" type="submit" class="mui-btn mui-btn--raised">Submit</button>
        </form>
      </div>
    </div> -->








<!-- <input type="button" value="Abrir modal" name="registrar" id="image_viewer" class="registrar" tabindex="8" /> -->

<!-- MODAL IMAGE POPUP -->
<div class="modal fullscreen-modal fade" id="myModal" role="dialog" >

  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-body" id="modal-body">

          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>

</div>





<div class="row">
	<div class="col-md-12">
		<div class="btn-group pull-right">
		<!--<div class="btn-group pull-right">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-download"></i> Descargar <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
		</ul>
		</div>
		-->
		</div>

		<div class="card">

			<!-- <div class="card-header" data-background-color="orange">
				<h4 class="title">Panel de noticias</h4>
			</div> -->

			<div class="card-content table-responsive">
				
					<a href="./index.php?view=newactivity" class="btn btn-primary">Agregar reporte</a>
					<!-- <a href="" class="btn btn-default"><i class="fa fa-area-chart"></i> Indicadores</a> -->
					<a href="./index.php?view=services" class="btn btn-info"><i class="fa fa-plus-circle" ></i> Registrar servicio</a>


				<br><br>

				<form class="form-horizontal" role="form">
					<input type="hidden" name="view" value="report">


					<!-- <div class="form-group"> -->

						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
								<input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>
						</div>
							
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map"></i></span>
								<select name="estado" class="form-control">
									<option value="">ESTADO</option>
									<?php foreach($estado as $p):?>
										<option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						

						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-users"></i></span>
								<select name="participantes" class="form-control">
									<option value="">PARTICIPANTES</option>
									<option value="1"><?php echo "Con participantes" ?></option>
									<option value="0"><?php echo "Sin participantes" ?></option>
								</select>
							</div>
						</div>


						<!-- <div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map"></i></span>
								<select name="person_fe" class="form-control">
									<option value="">Participantes hombre</option>
									<option value="Mujer"><!?php echo "Hombre" ?></option>
								</select>
							</div>
						</div> -->


						<div class="col-lg-6">
							<div class="input-group">
								<h5 class="title">Desde</h5>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  						<input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>
						</div>


						<div class="col-lg-6">
							<div class="input-group">
								<h5 class="title">Hasta</h5>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>
						</div>

						<!-- <div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-support"></i></span>
								<select name="operatividad" class="form-control">
									<option value="">OPERATIVIDAD</option>
									<?php foreach($operative_info as $p):?>
										<option value="<?php echo $p->operative_type; ?>"><?php echo $p->operative_type ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-globe"></i></span>
								<select name="internet" class="form-control">
									<option value="">INTERNET</option>
									<?php foreach($internet_type as $p):?>
										<option value="<?php echo $p->type; ?>"><?php echo $p->type ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-support"></i></span>
								<select name="estatus" class="form-control">
									<option value="">ESTATUS</option>
									<?php foreach($status_type as $p):?>
										<option value="<?php echo $p->status; ?>"><?php echo $p->status ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div> -->



						<div class="col-lg-4">
							<button class="btn btn-primary btn-block">Buscar</button>
						</div>

						<!-- <div class="form-group text_label">
							<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Descargar Reporte</span>
						</div> -->

						



					<!-- </div> -->

				</form>
					







				

				




				<?php

				$CantidadMostrar=10;
				$url_pag_atras = "";
				$url_pag_adelante = "";

				// Validado  la variable GET
				$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

				$users= array();
				if( (isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["participantes"]) ) &&  ($_GET["q"]!="" || $_GET["estado"]!="" || $_GET["start_at"]!="" || $_GET["finish_at"]!="" || $_GET["participantes"]!="")) {
				
					$sql = "select * from reports where ";

					if($_GET["q"]!=""){
						$sql .= " (report_type like '%$_GET[q]%' or activity_title like '%$_GET[q]%' or line_action like '%$_GET[q]%' or estate like '%$_GET[q]%' or code_info like '%$_GET[q]%'  or responsible_dni like '%$_GET[q]%') ";
					}

					if($_GET["estado"]!=""){
						if($_GET["q"]!=""){
							$sql .= ' and ';
						}
						$sql .= " estate ='".$_GET["estado"]."'";
					}


					if($_GET["participantes"] != ""){

						if($_GET["participantes"] == "1"){

							if($_GET["q"]!="" or $_GET["estado"]!=""){
								$sql .= ' and ';
							}
							$sql .= "(person_fe > '0' or person_ma > '0') ";
						}

						if ($_GET["participantes"] == "0") {
	
							if($_GET["q"]!="" or $_GET["estado"]!=""){
								$sql .= ' and ';
							}
							$sql .= "(person_fe = '0' and person_ma = '0') ";
						}
					}

				

			

					if($_GET["start_at"]!="" and $_GET["finish_at"]!=""){
						if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!=""){
							$sql .= " and ";
						}
						$sql .= " ( date_pub >= '".$_GET["start_at"]."'"." and date_pub <= '".$_GET["finish_at"]."'"." ) ";
					}

					if($_GET["start_at"]!="" and $_GET["finish_at"]==""){
						if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!=""){
							$sql .= ' and ';
						}
						$sql .= " ( date_pub >= '".$_GET["start_at"]."'"." ) ";
					}




					// $users = InfoData::getBySQL($sql);

					// Busca el total de registros segun parametros de consulta
					$param = $sql;
					$total = ReportActivityData::getBySQL($param);
					$TotalReg = count($total);

					$users = ReportActivityData::getBySQL($sql." order by datetime desc ");

					// Asigna url de paginacion
					$url_pag = "<a href=\"?view=report&participantes=".$_GET["participantes"]."&q=".$_GET["q"]."&estado=".$_GET["estado"]."&start_at=&finish_at&pag=";

					// echo $sql;
					
					$param_csv = $sql;
					$param_sql = "true";
					


				}else{
					// $users = InfoData::getAll();

					// $total = ReportActivityData::getAll();
					// $TotalReg = count($total);
					$sql = "SELECT * from reports ";
					$users = ReportActivityData::getBySQL($sql);

					$url_pag = "<a href=\"?view=report&participantes=".$_GET["participantes"]."&q=".$_GET["q"]."&estado=".$_GET["estado"]."&start_at=&finish_at&pag=";

					$param_csv = "reports";
					$param_sql = "false";
					
				}


				//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
				// echo $sql;
				// echo $param_csv;
				$DB_name = "reports";
				

				?>




				<?php if(count($users)>0){ ?>
				<!-- si hay usuarios -->

				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
				</div>

				<a href="./pdf/csv.php?param_csv=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> </a>
				<a href="./pdf/jspdf.php?param_pdf=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> </a>
				<!-- <a href="./pdf/jspdf.php" name="Descargar" class=" btn btn-default "><i class="fa fa-file-pdf-o"></i> </a> -->
				
				<!-- <button onclick="generate()">Generate pdf</button> -->

				
			</div class="card-content table-responsive">
		</div>







		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-content table-responsive">

						<section class="showcase">
							<div class="container">
								<br>
								<!-- <div class="row padall">
									<div class="col-lg-11" style="padding-bottom:10px; padding-top:10px;">
										<h3>Exportar a Excel, CSV, PDF, Print Datatables con PHP MySQL</h3>               
									</div>
								</div> -->
									<div class="row padall border-bottom">
										<div class="col-lg-11">
										<div class="table-responsive-sm">
											<table id="render-data" class="table display nowrap" style="width:100%">
												
												<!-- INONOS -->
												<thead>
													<th class="text_label " style="width: 100px;"> <i class="fa fa-image icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-calendar icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-calendar icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-home icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-cogs icon_table" ></i></th>
													<th class="text_label " style="width: 200px;"> <i class="fa fa-newspaper-o icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-user-plus icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-flask icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-cog icon_table" ></i></th>
													<th class="text_label " > <i class="fa fa-image icon_table" ></i></th>
												</thead>


												<!-- TITULOS -->
												<thead>
													<tr>
														<th> Preview</th>
														<th> Publicado</th>
														<th> Fecha de actividad</th>
														<th> Infocentro</th>
														<th> Línea de acción</th>
														<th> Título de la actividad</th>
														<th> Agregar Participantes</th>
														<th> Agregar Productos</th>
														<th>Acciones</th>
														<th>Imágenes</th>
													</tr>
												</thead>

												<tbody>
													
												</tbody>

												<tfoot>
													<tr>
														<th> Preview</th>
														<th> Publicado</th>
														<th> Fecha de actividad</th>
														<th> Infocentro</th>
														<th> Línea de acción</th>
														<th> Título de la actividad</th>
														<th> Agregar Participantes</th>
														<th> Agregar Productos</th>
														<th>Acciones</th>
														<th>Imágenes</th>
													</tr>
												</tfoot>

											</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>

		<?php
		// include('templates/footer.php');
		?>

		<?php } ?>





		</div>
	</div>

	









<style>

.title {
    margin-top: 0;
    margin-bottom: 5px;
    margin-left: 10px;
    margin-right: -20px;
}

/* .card {
	font-size: 14px;
	margin: 15px 0;
}

h5, .h5 {
    font-size: 1.0em;
    line-height: 1.0em;
    margin-bottom: 15px;
} */

.icon_table{
  font-size: 24px;
  color: #585858;
  margin-right: 10px;
}

/* .btn_preview {
	color: #FFFFFF;
	background: #8a8a8a;
	box-shadow: none;
	padding: 0px 0px;
	margin: 0px 0px;
	border: none;
	opacity: 1;
} */











.fullscreen-swal{ z-index: 9999 !important; width:100vw !important; height:90vh !important; }




</style>

  <script type="text/javascript">
    // jQuery(document).ready(function() {
	// 	var table = $('#render-data').DataTable({
	// 	ajax: 'core/app/view/datatable_report.php?sql=<!?php echo $sql; ?>',
	// 	rowReorder: {
	// 		selector: 'td:nth-child(2)'
	// 	},
	// 	"language": {
	// 		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
	// 	},

	// 	responsive: true,
	// 	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
	// 	"paging": true,
	// 	"processing": true,
	// 	order: [[0, 'asc']],
	// 	dom: '<"toolbar">Blftrip',


	// 	buttons:[ 
	// 		{
	// 			extend:    'excelHtml5',
	// 			text:      'Exportar a Excel',
	// 			titleAttr: 'Exportar a Excel',
	// 			title:     'Título del documento',
	// 			exportOptions: {
	// 				columns: [2,3,4,5]
	// 			}
	// 		},
	// 		{
	// 			extend:    'pdfHtml5',
	// 			text:      'Exportar a PDF',
	// 			titleAttr: 'Exportar a PDF',
	// 			className: 'btn btn-danger',
	// 			title:     'Título del documento',
	// 			exportOptions: {
	// 				columns: [2,3,4,5]
	// 			}                    
	// 		},
	// 		{
	// 			extend:    'print',
	// 			text:      'Imprimir',
	// 			titleAttr: 'Imprimir',
	// 			// className: 'btn btn-info',
	// 			exportOptions: {
	// 				columns: [2,3,4,5]
	// 			}
	// 		}
	// 	],

	// 	"columnDefs":[
	// 		{
	// 			"targets": [0],
	// 			"visible": false,
	// 		},
	// 		{
	// 			"targets": [ 0 ],
	// 			"searchable": false,
	// 		},
	// 		{
	// 			"targets":[0,1,2],
	// 			"orderable":false,
	// 		}
     
	// 	],
	// 	"pageLength": 25,
	// 	drawCallback: function () {
	// 		$('div.dataTables_filter input').addClass('form-controles');
	// 		$('div.dataTables_length select').addClass('form-controles');
	// 		$('div.dt-buttons button').addClass('btn btn-primary');
	// 	},


    //   } );
    // } );



    function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.estate+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.line_action+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 


$(document).ready(function() {
    var table = $('#render-data').DataTable( {
        "ajax": 'core/app/view/datatable_report.php?sql=<?php echo $sql; ?>',
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		},
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "datetime" },
            { "data": "date_pub" },
            { "data": "code_info" },
            { "data": "line_action" },
            { "data": "activity_title" }
        ],
		responsive: true,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
		"paging": true,
		"processing": true,
		order: [[0, 'asc']],
		dom: '<"toolbar">Blftrip',

		buttons:[ 
		{
			extend:    'excelHtml5',
			text:      'Exportar a Excel',
			titleAttr: 'Exportar a Excel',
			title:     'Título del documento',
			exportOptions: {
				columns: [2,3,4,5]
			}
		},
		{
			extend:    'pdfHtml5',
			text:      'Exportar a PDF',
			titleAttr: 'Exportar a PDF',
			className: 'btn btn-danger',
			title:     'Título del documento',
			exportOptions: {
				columns: [2,3,4,5]
			}                    
		},
		{
			extend:    'print',
			text:      'Imprimir',
			titleAttr: 'Imprimir',
			// className: 'btn btn-info',
			exportOptions: {
				columns: [2,3,4,5]
			}
		}
	],

	"columnDefs":[
		// {
		// 	"targets": [0],
		// 	"visible": false,
		// },
		{
			"targets": [ 0 ],
			"searchable": false,
		},
		{
			"targets":[0,1,2],
			"orderable":false,
		}
	
	],
	"pageLength": 25,



    } );
     
    // Add event listener for opening and closing details
    $('#render-data tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );



   


  </script>


<style>
  td.details-control {
    background: url('assets/icondetails.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('assets/icondetails_off.png') no-repeat center center;
}
</style>