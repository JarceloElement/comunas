
<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();

// echo strtoupper("ama05");
?>


<!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->

<!-- MODAL IMAGE POPUP -->
<script language="javascript">





$(document).ready(function(){

	// // AVISO
	Swal.fire({
	// position: 'top-center',
	icon: 'warning',
	title: 'Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.\n',
	showConfirmButton: true,
	// timer: 1000
	})



	var Name_OS = "Unknown OS";
	// OS NAME
	if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
	if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
	if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
	if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
	if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
	// console.log(Name_OS);

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
				
					<a href="./index.php?view=newactivity" class="btn btn-info">Agregar reporte</a>
					<a href="" class="btn btn-default"><i class="fa fa-area-chart"></i> Indicadores</a>


				<br><br>

				<form class="form-horizontal" role="form">
					<input type="hidden" name="view" value="report_admin">


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
						$sql .= " (activity_title like '%$_GET[q]%' or line_action like '%$_GET[q]%' or estate like '%$_GET[q]%' or code_info like '%$_GET[q]%'  or responsible_dni like '%$_GET[q]%') ";
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

					$users = ReportActivityData::getBySQL($sql." order by datetime desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);

					// Asigna url de paginacion
					$url_pag = "<a href=\"?view=report_admin&participantes=".$_GET["participantes"]."&q=".$_GET["q"]."&estado=".$_GET["estado"]."&start_at=&finish_at&pag=";

					// echo $sql;
					
					$param_csv = $sql;
					$param_sql = "true";
					


				}else{
					// $users = InfoData::getAll();

					$total = ReportActivityData::getAll();
					$TotalReg = count($total);
					$sql = "select * from reports order by datetime desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
					$users = ReportActivityData::getBySQL($sql);

					$url_pag = "<a href=\"?view=report_admin&participantes=".$_GET["participantes"]."&q=".$_GET["q"]."&estado=".$_GET["estado"]."&start_at=&finish_at&pag=";

					$param_csv = "reports";
					$param_sql = "false";
					
				}


				//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
				$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
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











		<div class="card">
			<div class="card-content table-responsive">

			



				<table id="table" class="table table-bordered table-hover">

				
					<!-- INONOS -->
					<thead>
						<!-- <th class="text_label " style="width: 100px;"> <i class="fa fa-image icon_table" ></i></th> -->
						<!-- <th class="text_label " > <i class="fa fa-calendar icon_table" ></i></th> -->
						<th class="text_label " > <i class="fa fa-home icon_table" ></i></th>
						<!-- <th class="text_label " > <i class="fa fa-map icon_table" ></i></th> -->
						<!-- <th class="text_label " > <i class="fa fa-cogs icon_table" ></i></th> -->
						<th class="text_label " style="width: 200px;"> <i class="fa fa-newspaper-o icon_table" ></i></th>
						<!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-user icon_table" ></i></th> -->
						<!-- <th class="text_label " > <i class="fa fa-phone icon_table" ></i></th> -->
						<th class="text_label " > <i class="fa fa-male icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-female icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-user-plus icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-flask icon_table" ></i></th>
						<!-- <th class="text_label " > <i class="fa fa-image icon_table" ></i></th> -->
						<!-- <th class="text_label " > <i class="fa fa-file icon_table" ></i></th> -->
						<th class="text_label " > <i class="fa fa-cog icon_table" ></i></th>
						<!-- <th class="text_label " > <i class="fa fa-image icon_table" ></i></th> -->
					</thead>


					<!-- TITULOS -->
					<thead>
						<!-- <th> Preview</th> -->
						<!-- <th> Fecha de actividad</th> -->
						<th> Infocentro</th>
						<!-- <th> Estado</th> -->
						<!-- <th> Línea de acción</th> -->
						<th> Título de la actividad</th>
						<!-- <th> Responsable</th> -->
						<!-- <th> Teléfono</th> -->
						<th> Partic. Hombres</th>
						<th> Partic. Mujeres</th>
						<th> Agregar Participantes</th>
						<th> Agregar Productos</th>
						<!-- <th> Imágenes</th> -->
						<!-- <th> Archivo</th> -->
						<th>Acciones</th>
						<!-- <th>Imágenes</th> -->
					</thead>


					<?php
					$total_fem = 0;
					$total_mas = 0;
					$ID = 0;

					$imagen_p = "";
					$titulo_p = "";
					$code_info_p = "";

					foreach($users as $user){
						// $pacient  = $user->getPacient();
						// $medic = $user->getMedic();
						
						



						?>
						<tr>
						



						



						<!-- <td><!?php echo date("d/m/Y", strtotime($user->date_pub)); ?></td> -->
						<td><?php echo $user->code_info; ?></td>
						<!-- <td><!?php echo $user->estate; ?></td> -->
						<!-- <td><!?php echo $user->line_action; ?></td> -->
						<td><?php echo $user->activity_title; ?></td>
						<!-- <td><!?php echo ucfirst(mb_strtolower($user->activity_title,"UTF-8")); ?></td> -->
						<!-- <td><!?php echo $user->responsible_name; ?></td> -->
						<!-- <td><!?php echo $user->responsible_phone; ?></td> -->
						<td><?php echo $user->person_ma; ?></td>
						<td><?php echo $user->person_fe; ?></td>

						<?php
						 $total_part = ParticipantsData::getBySQL("select * from participants_list where id_activity=$user->id ")[0];
						 $total_prod = ProductsData::getBySQL("select * from products_list where id_activity=$user->id ");
						// echo count($total_part);
						$link = "";

						// ENLACE DE LOS PRODUCTOS
						$product = [];
						foreach($total_prod as $p):
							// $link = $p;
							// $link = explode(", ",$p->web_link);
							if (strlen($p->web_link) > 0){
								$product[$p->web_link] = $p->web_link;
							}
						endforeach;

						$prod_link = sizeof($product);
						?>


						<?php if (count($total_part)>0){?>
							<td><a href="index.php?view=participants_list&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity=<?php echo $user->activity_title;?>" class="btn btn-info btn-xs"> <?php echo count($total_part)?></a></td>
						<?php } ?>

						<?php if (count($total_part)==0){?>
							<td><a href="index.php?view=participants_list&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity=<?php echo $user->activity_title;?>" class="btn btn-danger btn-xs"> <?php echo count($total_part)?></a></td>
						<?php } ?>


						<?php if (count($total_prod)>0){?>
							<td>
								<a href="index.php?view=products_list&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity_title=<?php echo $user->activity_title;?>" class="btn btn-info btn-xs"> <?php echo count($total_prod)?></a>

							<?php echo $link; if ($prod_link > 0){?>
								<a type="link_viewer" id="<?php echo $user->id; ?>" class=" btn btn-info btn-xs"><i class="fa fa-globe" ></i> </a>
							<?php }else{ ?>
								<a type="link_viewer_NO" id="<?php echo $user->id; ?>" class=" btn btn-warning btn-xs"><i class="fa fa-globe" ></i> </a>
							<?php } ?>

							</td>
						<?php } ?>

						<?php if (count($total_prod)==0){?>
							<td><a href="index.php?view=products_list&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity_title=<?php echo $user->activity_title;?>" class="btn btn-danger btn-xs"> <?php echo count($total_prod)?></a></td>
						<?php } ?>




						<!-- <td><button type="image_viewer" id="<!?php echo $user->id; ?>" class="btn btn-success btn-xs">Ver</td> -->
						<!-- <!?php if ($user->file != ""){ ?>
						<td><a href="uploads/files/<!?php echo $user->file;?>" class="btn btn-default btn-xs">Des</a></td>
						<!?php } ?>
						<!?php if ($user->file == ""){ ?>
						<td><a href="#" class="btn btn-default btn-xs">Des</a></td>
						<!?php } ?> -->


						<td>

						<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ ?>
							<a href="index.php?view=editactivity&id=<?php echo $user->id;?>&code_info=<?php echo $user->code_info;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-warning btn-xs">Editar</a>
							<a href="index.php?action=delreport&id=<?php echo $user->id;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-danger btn-xs">Eliminar</a>
						
							<?php }elseif ( ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 ) && ($_SESSION["user_region"] == $user->estate) ) { ?>

							<a href="index.php?view=editactivity&id=<?php echo $user->id;?>&code_info=<?php echo $user->code_info;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-warning btn-xs">Editar</a>
							<a href="index.php?action=delreport&id=<?php echo $user->id;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-danger btn-xs">Eliminar</a>

						<?php } ?>
						</td>


						<!-- <td><button type="image_viewer_orig" id="<?php echo $user->id; ?>" class="btn btn-success btn-xs">Imágenes</td> -->



						<!-- <td style="width:180px;">
						<a href="index.php?view=editinfocentro&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
						<a href="index.php?action=delinfocentro&id=<!?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
						</td> -->
						
						</tr>

						<!-- data preview -->
						<p class="data" id="get_data" >
							<p class="data_imagen" id="https://infoapp.lanubeplus.com/<?php echo $imagen_p;?>"></p>
							<p class="data_titulo" id="<?php echo $titulo_p;?>"></p>
							<p class="data_code_info" id="<?php echo $code_info_p;?>"></p>
						</p>


						<?php $total_fem += $user->person_fe; ?>
						<?php $total_mas += $user->person_ma; ?>
						
					<?php
					$ID += 1;

					}
					?>


				</table>
				





				<?php
				}else{
					// echo "<p class='alert alert-danger'>No hay reportes</p>";

					$total_fem = 0;
					$total_mas = 0;
				}
				?>


			</div class="card-content table-responsive">

			<?php if ($total_fem > 0 or $total_mas > 0){ ?>
				<div class="card-content">

					<!-- <div class="col-lg-3">
						<h6><i class="fa fa-male"></i> Total hombres p/pg <span class="badge badge-light"><?php echo $total_mas;?></span> </h6> 
					</div>

					<div class="col-lg-3">
						<h6><i class="fa fa-female"></i> Total mujeres p/pg <span class="badge badge-light"><?php echo $total_fem;?></span> </h6> 
					</div> -->

				</div>
			<?php } ?>

		</div>
	</div>


	<center>

	<?php

	/*Sector de Paginacion */

	//Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
	$DecrementNum =(($compag -1))<1?1:($compag -1);

	echo $url_pag.$DecrementNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-left\"></i> </a>";

	//Se resta y suma con el numero de pag actual con el cantidad de 
	//numeros  a mostrar
	$Desde=$compag-(ceil($CantidadMostrar/2)-1);
	$Hasta=$compag+(ceil($CantidadMostrar/2)-1);
		
	//Se valida
	$Desde=($Desde<1)?1: $Desde;
	$Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
	//Se muestra los numeros de paginas
	for($i=$Desde; $i<=$Hasta;$i++){
		//Se valida la paginacion total
		//de registros
		if($i<=$TotalRegistro){
			//Validamos la pag activo
			if($i==$compag){
				echo $url_pag.$i."\" class=\"btn btn-primary btn-xs\"active\">".$i."  </a>";
			}else {
				echo $url_pag.$i."\" class=\"btn btn-info btn-xs\">".$i."  </a>";
			}     		
		}
	}
		
	// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";
	echo $url_pag.$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";


	?>

	</center>









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