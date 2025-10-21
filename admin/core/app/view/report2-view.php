
<?php
// ini_set('memory_limit', '512M');
$debug= true;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}


$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();
$location = "index.php?view=report";

// echo strtoupper("ama05");
// GIT

// $users = ReportActivityData::getAll();
// // $users = ReportActivityData::getById(33836);
// $data = "";
// $count = 0;

// foreach($users as $user){
// 	// sacamos la fecha de inicio
// 	$date_pub_end = explode("/",$user->date_pub);
// 	// echo "C-".count($date_pub_end)."<br>";

// 	if (count($date_pub_end) > 1){
// 		// echo "<br><br>A".$date_pub_end[0];

// 		// $date_ini_x = date_create($date_pub_end[0]);
// 		// $date_end_x = date_create($date_pub_end[1]);
// 		// $start_at_x = $date_ini_x->format('d-m-Y');
// 		// $finish_at_x = $date_end_x->format('d-m-Y');

// 		// $new_date = $start_at_x."/".$finish_at_x;
// 		// echo $new_date;
// 		// $db = Database::getCon();
// 		// $statement_1 = $db->query("UPDATE reports SET date_pub = '".$new_date."' where id='".$user->id."' ");
// 		// $count++;
// 	}else{
// 		echo "<br><br>B".$date_pub_end[0];

// 		// $date_ini_x = date_create($date_pub_end[0]);
// 		// $start_at_x = $date_ini_x->format('d-m-Y');
// 		// $finish_at_x = $date_ini_x->format('d-m-Y');

// 		// $new_date = $start_at_x."/".$finish_at_x;
// 		// echo "<br><br>".$new_date;
// 		// $db = Database::getCon();
// 		// $statement_1 = $db->query("UPDATE reports SET date_pub = '".$new_date."' where id='".$user->id."' ");

// 		$count++;

// 	}
// }
// echo "C-".$count;

?>


<!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->

<!-- MODAL IMAGE POPUP -->
<script language="javascript">


<?php
// limitar texto de la tarjeta
function charlimit_title($string, $limit) {
	$overflow = (strlen($string) > $limit ? true : false);
	return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
}
?>


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
						<?php if(isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "true"): ?>
						showConfirmButton: true,
						<?php endif; ?>
						<?php if(!isset($_GET['ConfirmButton']) || $_GET['ConfirmButton'] == "false"): ?>
						showConfirmButton: false,
						timer: 1000
						<?php endif; ?>
					})
			}else{
				
				alert("<?php echo $_GET['swal']; ?>");
			}

			// cambiar el parametro de alert
            const url = new URL(window.location);
            url.searchParams.set('swal', '');
            window.history.pushState({}, '', url);

		<?php endif; ?>
	});


});




$(function() {

	$(document).on('click', 'button[type="image_edit"]', function(event) {
		let id = this.id;
		let title_v = this.title;

		// $('#image_edit').modal('show');

		$.post("core/app/view/image_edit.php", { id: id }, function(data){
			$("#image_edit_body").html(data);
		});

	});



	$(document).on('click', 'button[type="image_viewer_orig"]', function(event) {
		let id = this.id;
		let title_v = this.title;



		// MODAL SWAL
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
		// $('#image_view').modal('show');
		// $('#image_view').modal({ show:true });

		$.post("core/app/view/image_viewer_orig.php", { id: id }, function(data){
			$("#modal_image").html(data);
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
	var titulo = document.getElementsByClassName("data_titulo").item(id).id;
	var imagen_modal = document.getElementsByClassName("data_imagen_modal").item(id).id;
	var imagen = document.getElementsByClassName("data_imagen").item(id).id;
	var code_info = document.getElementsByClassName("data_code_info").item(id).id;

	document.getElementById("title_preview").innerHTML = titulo;
	document.getElementById("imagen_modal").src = imagen;
	document.getElementById("codigo_info").innerHTML = code_info;
	

  });







});


</script>





<!-- MODAL IMAGE PREVIEW -->

<!-- Modal -->
<div class="modal fade" id="image_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<h5 class="title_preview" id="codigo_info" >codigo_info</h5>  

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

		<div class="modal-body fullscreen" id="modal-body">
			<img src='' id='imagen_modal' style="margin:1px auto; display:block; width: 100%; height:auto;" alt="Imagen"/>
			<br>
			<div class="mui--text-center">
				<h5 class="title_preview" id="title_preview" >Descripción</h5> 
			</div>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- modal images -->
<div class="modal fade " id="image_view" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
	<!-- <div class="modal fade" id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body" id="modal_image">

			</div>

			<div class="modal-footer">
      			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>

		</div>
	</div>
</div>
<!-- fin modal images -->















<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					
					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar reportes</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="report">

								<div class="row">
									<div class="form-group col-md-8">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="material-icons">search</i></span>
											</div>
											<label class="bmd-label-floating floating_icon">Palabra clave</label>
											<input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control">
										</div>
									</div>

									
									
									<div class="form-group col-md-4">
										<div class="input-group">
											<span class="input-group-text">Por UID</span>
											<input type="text" name="uid" value="<?php if(isset($_GET["uid"]) && $_GET["q"]!=""){ echo $_GET["uid"]; } ?>" class="form-control">
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span> 
											<select name="estado" class="form-control">
												<option value="">ESTADO</option>
												<?php foreach($estado as $p):?>
													<option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
			
									<div class="col-lg-6">
										<div class="form-group">
											<span class="input-group-addon"><i class="fa fa-cogs"></i> Linea de acción</span> 
											<select name="linea_accion" class="form-control" id="linea_accion">
												<option value="">-- LINEA DE ACCIÓN --</option>
												<?php foreach($action_line as $p):?>
												<option value="<?php echo $p->line_name; ?>"> <?php echo $p->line_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<!-- <div class="col-md-4">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-users"></i> Participantes</span>
											<select name="participantes" class="form-control">
												<option value="">PARTICIPANTES</option>
												<option value="1"><!?php echo "Con participantes" ?></option>
												<option value="0"><!?php echo "Sin participantes" ?></option>
											</select>
										</div>
									</div> -->

								</div>



								<div class="form-group ">
									<div class="row">

										<div class="col">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="material-icons">date_range</i> </span> Desde
											</div>
											<input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control">
										</div>


										<div class="col">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="material-icons">date_range</i> </span> Hasta
											</div>
											<input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control">
										</div>

									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary float-right">Buscar</button>
								</div>

							</form>



						</div>
					</div>

				
				</div>
			</div>
		</div>

	</div>
</div>






				

				




<?php

$CantidadMostrar=10;
$url_pag_atras = "";
$url_pag_adelante = "";

// Validado  la variable GET
$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

$date_ini = date_create($_GET["start_at"]);
$date_end = date_create($_GET["finish_at"]);
// $start_at = $date_ini->format('Y-m-d');
// $finish_at = $date_end->format('Y-m-d');
$start_at = $date_ini->format('d-m-Y');
$finish_at = $date_end->format('d-m-Y');

// echo "dmy".date("d-m-Y", strtotime("10/07/2023"))->format('d-m-Y');
// echo "ymd".date("Y-m-d", strtotime("2023/07/10"))->format('Y-m-d');



$users= array();
if( (isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["participantes"]) ) &&  ($_GET["q"]!="" || $_GET["estado"]!="" || $_GET["start_at"]!="" || $_GET["finish_at"]!="" || $_GET["uid"]!="" || $_GET["participantes"]!="" || $_GET["linea_accion"]!="") ) {

	$sql = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1 AND"; 

	if($_GET["q"]!=""){
		$sql .= " (report_type like '%$_GET[q]%' or activity_title like '%$_GET[q]%' or line_action like '%$_GET[q]%' or estate like '%$_GET[q]%' or code_info='$_GET[q]' or responsible_dni='$_GET[q]') ";
	}

	if($_GET["uid"]!=""){
		if($_GET["q"]!=""){
			$sql .= ' and ';
		}
		$sql .= " user_id='".$_GET["uid"]."'";
	}

	if($_GET["linea_accion"]!=""){
		if($_GET["q"]!="" or $_GET["uid"]!=""){
			$sql .= ' and ';
		}
		$sql .= " line_action='".$_GET["linea_accion"]."'";
	}
	
	if($_GET["estado"]!=""){
		if($_GET["q"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
			$sql .= ' and ';
		}
		$sql .= " estate='".$_GET["estado"]."'";
	}



	// if($_GET["start_at"]!="" and $_GET["finish_at"]!=""){
    //     if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
    //         $sql .= " and ";
    //     }
    //     $sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%Y-%m-%d' )>=STR_TO_DATE('".$start_at."', '%Y-%m-%d')"." and STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%Y-%m-%d' )<=STR_TO_DATE('".$finish_at."', '%Y-%m-%d')"." ) ";
    // }

    // if($_GET["start_at"]!="" and $_GET["finish_at"]==""){
    //     if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
    //         $sql .= ' and ';
    //     }
    //     $sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%d-%m-%y' )>= STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." ) ";
    // }


	// 
	if($_GET["start_at"]!="" and $_GET["finish_at"]!=""){
        if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
            $sql .= " and ";
        }
        $sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%d-%m-%Y' )>=STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." and STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%d-%m-%Y' )<=STR_TO_DATE('".$finish_at."', '%d-%m-%Y')"." ) ";
    }

    if($_GET["start_at"]!="" and $_GET["finish_at"]==""){
        if($_GET["q"]!="" or $_GET["estado"]!="" or $_GET["participantes"]!="" or $_GET["uid"]!="" or $_GET["linea_accion"]!=""){
            $sql .= ' and ';
        }
        $sql .= " ( STR_TO_DATE( SUBSTRING_INDEX(date_pub,'/',1), '%d-%m-%Y' )>= STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." ) ";
    }


	// echo $sql;


	// if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ 
    //     $sql = $sql;
    // } else if ($_SESSION["user_type"] == 8){ 
    //     $sql.="and estate='".$user_region."' ";
    // }else {
    //     $sql.="and user_id='".$user_id."' ";
	// }
		

	// Busca el total de registros segun parametros de consulta
	$total = ReportActivityData::getBySQL($sql);
	$TotalReg = count($total);

	$users = ReportActivityData::getBySQL($sql." order by date_pub desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);

	// Asigna url de paginacion
	$url_pag = "<a href=\"?view=report&linea_accion=".$_GET["linea_accion"]."&q=".$_GET["q"]."&uid=".$_GET["uid"]."&estado=".$_GET["estado"]."&start_at=".$_GET["start_at"]."&finish_at=".$_GET["finish_at"]."&pag=";

	
	$param_csv = $sql;
	$param_xlsx = $sql;
	$param_sql = "true";
	


}else{
	// $users = InfoData::getAll();

	// $total = ReportActivityData::getAll();
	// if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ 
	// 	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1"; 
    // } else if ($_SESSION["user_type"] == 8){ 
	// 	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1 and estate='".$user_region."'"; 
    // }else {
	// 	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1 and user_id='".$user_id."' "; 
    // }

	$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1"; 

	$sql = $consult." order by datetime desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
	$users = ReportActivityData::getBySQL($sql);
	
	$total = ReportActivityData::getBySQL($consult);
	$TotalReg = count($total);

	$url_pag = "<a href=\"?view=report&participantes=".$_GET["participantes"]."&linea_accion=".$_GET["linea_accion"]."&q=".$_GET["q"]."&uid=".$_GET["uid"]."&estado=".$_GET["estado"]."&start_at=".$_GET["start_at"]."&finish_at=".$_GET["finish_at"]."&pag=";
	

	$param_csv = $consult;
	$param_xlsx = $consult;
	$param_sql = "true";
	
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
// echo $sql;
// echo $param_csv;
$DB_name = "reports";

// echo $param_csv;
?>




<?php if(count($users)>0){ ?>
<!-- si hay usuarios -->

<div class="col-md-12">
	<a href="./index.php?view=newplanning" class="btn btn-primary"><i class="material-icons">update</i> Programar actividad</a>
	<!-- <a href="./index.php?view=newactivity" class="btn btn-primary"><i class="fa fa-paper-plane" ></i> Agregar reporte</a> -->
	<a href="./index.php?view=services" class="btn btn-info"><i class="material-icons">support_agent</i> Registrar servicio</a>

	<a target="_blank" href="./pdf/csv.php?param_csv=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
	<a target="_blank" class="btn btn-success" href="../../../core/app/view/exportxlsx.php?param=<?php echo $param_xlsx.'&param_sql=true&filename='.$DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
	<a href="./pdf/jspdf2.php?param_pdf=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> PDF</a>
	
	<!-- <a href="./pdf/jspdf.php" name="Descargar" class=" btn btn-default "><i class="fa fa-file-pdf-o"></i> </a> -->
	<!-- <button onclick="generate()">Generate pdf</button> -->
	<!-- <a href="./index.php?view=services" class="btn btn-primary btn-round"><i class="material-icons">add</i></a> -->
	
	<div class="form-group text_label">
		<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
	</div>

</div>










		<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">


					<?php if ($_SESSION["user_type"] == 7){ ?>

					<!-- EDICION POR LOTES -->
					<form class="form-horizontal" role="form" method="post" action="./?action=ajax&function=active_report" enctype="multipart/form-data">
						<input type="hidden" name="data_id" id="data_id" value="">
						<input type="hidden" name="pagination" id="pagination" value="<?php echo $pagination ?>">
						
						<div class="row">

							<div class="col-lg-3">
								<div class="form-group">
									<span class="input-group-addon"><i class="fa fa-cog"></i> Quitar sin participantes</span> 
									<select name="participantes" class="form-control" required>
										<option value="">-OPCIONES-</option>
										<option value="Ocultar"><?php echo "Ocultar sin participantes" ?></option>
										<option value="Visualizar"><?php echo "Visualizar todo" ?></option>
									</select>
								</div>
							</div>
							
							<div class="col-lg-3">
								<button class="btn btn-warning btn-block"><i class="far fa-save"></i> Modificar</button>
							</div>

						</div>

					</form>
					<!-- END EDICION POR LOTES -->

					
					<br>
					<?php } ?>

					<div class="card-body">
						<h6 class="card-category text-danger text-center">
							<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M11 21v-2h8v-7.1q0-2.925-2.037-4.962T12 4.9T7.038 6.938T5 11.9V18H4q-.825 0-1.412-.587T2 16v-2q0-.525.263-.987T3 12.275l.075-1.325q.2-1.7.988-3.15t1.975-2.525T8.762 3.6T12 3t3.225.6t2.725 1.663t1.975 2.512t1 3.15l.075 1.3q.475.225.738.675t.262.95v2.3q0 .5-.262.95t-.738.675V19q0 .825-.587 1.413T19 21zm-2-7q-.425 0-.712-.288T8 13t.288-.712T9 12t.713.288T10 13t-.288.713T9 14m6 0q-.425 0-.712-.288T14 13t.288-.712T15 12t.713.288T16 13t-.288.713T15 14m-8.975-1.55Q5.85 9.8 7.625 7.9T12.05 6q2.225 0 3.913 1.412T18 11.026Q15.725 11 13.813 9.8t-2.938-3.25q-.4 2-1.687 3.563T6.025 12.45"/></svg></i> ¡Toda actividad sin participante será eliminada en un plazo de tiempo!
						</h6>
						<!-- <h6 class="card-category text-danger text-center">
							AVISO: A partir del 1 de agosto no se crearan los reportes de actividades desde este módulo de Reportes, la nueva forma será primero planificar la actividad y se cambia el estatus a ejecutada, luego se cargan participantes, productos e imágenes.
						</h6> -->
					</div>

					<!-- <p class='alert alert-warning' style='padding:10px 10px;'>¡Toda actividad sin participante será eliminada en un plazo de tiempo! </p> -->





					<!-- <table class="table"> -->
					<table  class="table table-bordered table-hover">

					
						<!-- INONOS -->
						<thead>
							<th class="text_label " style="width: 100px;"> <i class="fa fa-image icon_table" ></i></th>
							<th class="text_label " > <i class="fa fa-calendar icon_table" ></i></th>
							<th class="text_label " > <i class="fa fa-calendar icon_table" ></i></th>
							<th class="text_label " > <i class="fa fa-home icon_table" ></i></th>
							<!-- <th class="text_label " > <i class="fa fa-map icon_table" ></i></th> -->
							<th class="text_label " > <i class="fa fa-cogs icon_table" ></i></th>
							<th class="text_label " style="width: 200px;"> <i class="fa fa-newspaper-o icon_table" ></i></th>
							<!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-user icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-phone icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-male icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-female icon_table" ></i></th> -->
							<th class="text_label " > <i class="fa fa-user-plus icon_table" ></i></th>
							<th class="text_label " > <i class="fa fa-flask icon_table" ></i></th>
							<!-- <th class="text_label " > <i class="fa fa-image icon_table" ></i></th> -->
							<!-- <th class="text_label " > <i class="fa fa-file icon_table" ></i></th> -->
							<th class="text_label " > <i class="fa fa-image icon_table" ></i></th>
							<th class="text_label " > <i class="fa fa-cog icon_table" ></i></th>
						</thead>


						<!-- TITULOS -->
						<thead>
							<th> Preview</th>
							<th> Publicado</th>
							<th> Fecha de actividad</th>
							<th> Infocentro</th>
							<!-- <th> Estado</th> -->
							<th> Línea de acción</th>
							<!-- <th> Tipo de reporte</th> -->
							<th> Título de la actividad</th>
							<!-- <th> Responsable</th> -->
							<!-- <th> Teléfono</th> -->
							<!-- <th> Partic. Hombres</th> -->
							<!-- <th> Partic. Mujeres</th> -->
							<th> Agregar Participantes</th>
							<th> Agregar Productos</th>
							<!-- <th> Imágenes</th> -->
							<!-- <th> Archivo</th> -->
							<th>Imágenes</th>
							<th>Acciones</th>
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
							<td>
								<!-- CARGA LAS IMAGENES -->
								<?php $img = explode(", ",$user->image)[0];
								$img = str_replace("origin", "preview", $img);

								if (!file_exists("uploads/images/reports/".$img)) {
									$img = str_replace("jpg", "webp", $img);
									$img = str_replace("jpeg", "webp", $img);
									$img = str_replace("JPG", "webp", $img);
									$img = str_replace("JPEG", "webp", $img);
									if (!file_exists("uploads/images/reports/".$img)) {
										// se coloca la original
										$img = str_replace("preview", "origin", $img);
										$img = str_replace("webp", "jpg", $img);

									}
								} else {
									// echo "------------ La imagen no es .webp -------------------";
								}
								?>
								
								<?php 
								if ($img != "Sin registro fotográfico"){
									$img = $img;
								}
								if ($img == "Sin registro fotográfico"){
										$img = "default.jpg";}

								if ($img == ""){
									$img = "default.jpg";}


								// $imagen_p = "uploads/images/reports/".$img;
								$imagen_p = $img;
								$titulo_p = $user->activity_title;
								$code_info_p = $user->code_info." | ".$user->line_action;
								$data_activity = $user->line_action." | ".$user->report_type;
								

								// sacamos la fecha de inicio
								$date_pub_end = explode("/",$user->date_pub);
								if (count($date_pub_end) > 1) {
									$date_pub = $date_pub_end[0];
								}else {
									$date_pub = $user->date_pub;
								}
								
								?>


								<!-- <!?php echo explode(", ",$user->image)[0];?> -->
								<div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
									<!-- <button type="image_viewer" title="" id="<!?php echo $ID; ?>" class="btn_preview" > -->
									<button type="image_viewer" id="<?php echo $ID; ?>" class="btn_preview" data-toggle="modal" data-target="#image_preview">
									
									<a href="#" data-title="Imagen" >
										<img src="uploads/images/reports/<?php echo $img;?>" style="min-width: 80px; min-height: 50px;" class="img-fluid mb-2" alt="Imagen"/>
									</a>
									
								</div>
							</td>



							



							<td><?php echo date("d/m/Y H:i:s", strtotime($user->datetime)); echo " desde ".$user->name_os; echo " Por: UID ".$user->user_id; ?></td>
							<td><?php echo date("d/m/Y", strtotime($date_pub)); ?></td>
							<td><?php echo $user->code_info; ?></td>
							<!-- <td><!?php echo $user->estate; ?></td> -->
							<td><?php echo $user->line_action." |\n ".$user->report_type; ?></td>
							<td><?php echo charlimit_title($user->activity_title,60); ?></td>
							<!-- <td><!?php echo ucfirst(mb_strtolower($user->activity_title,"UTF-8")); ?></td> -->
							<!-- <td><!?php echo $user->responsible_name; ?></td> -->
							<!-- <td><!?php echo $user->responsible_phone; ?></td> -->
							<!-- <td><!?php echo $user->person_ma; ?></td> -->
							<!-- <td><!?php echo $user->person_fe; ?></td> -->

							<?php
							// total de participantes
							if ($user->report_type == "Atención al usuario" && $user->user_id != ""){
								$mujer = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=".$user->user_id." AND user_genero='Mujer' AND DATE(user_fecha_servicio)="."'".date("Y/m/d", strtotime($user->date_pub))."'");
								$hombre = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=".$user->user_id." AND user_genero='Hombre' AND DATE(user_fecha_servicio)="."'".date("Y/m/d", strtotime($user->date_pub))."'");
								$Total_mujeres = count($mujer);
								$Total_hombres = count($hombre);

								$total_part = $Total_mujeres+$Total_hombres;

								// actualizo los participantes si la cantidad es diferente
								if($user->person_fe != $Total_mujeres){
									$sql = "UPDATE reports SET person_fe=\"$Total_mujeres\" WHERE id=\"$user->id\" ";
									Executor::doit($sql);
								}
								if($user->person_ma != $Total_hombres ){
									$sql = "UPDATE reports SET person_ma=\"$Total_hombres\" WHERE id=\"$user->id\" ";
									Executor::doit($sql);
								}

							}else {
								$total_part = count(ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=$user->id ") );
							}
							$total_prod = ProductsData::getBySQL("SELECT * from products_list where id_activity=$user->id ");
							// echo count($total_part);



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


							<?php if ($total_part>0){?>
								<td><a href="index.php?view=participants_list&user_id=<?php echo $user->user_id;?>&line_action=<?php echo $user->line_action;?>&report_type=<?php echo $user->report_type;?>&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity=<?php echo $user->activity_title;?>" class="btn btn-info btn-sm"> <?php echo $total_part?></a></td>
							<?php } ?>

							<?php if ($total_part==0){?>
								<td><a href="index.php?view=participants_list&user_id=<?php echo $user->user_id;?>&line_action=<?php echo $user->line_action;?>&report_type=<?php echo $user->report_type;?>&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity=<?php echo $user->activity_title;?>" class="btn btn-danger btn-sm"> <?php echo $total_part?></a></td>
							<?php } ?>


							<?php if (count($total_prod)>0){?>
								<td>
									<a href="index.php?view=products_list&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity_title=<?php echo $user->activity_title;?>" class="btn btn-info btn-sm"> <?php echo count($total_prod)?></a>

								<?php if ($prod_link > 0){?>
									<a type="link_viewer" id="<?php echo $user->id; ?>" class=" btn btn-info btn-sm"><i class="fa fa-globe" ></i> </a>
								<?php }else{ ?>
									<a type="link_viewer_NO" id="<?php echo $user->id; ?>" class=" btn btn-warning btn-sm"><i class="fa fa-globe" ></i> </a>
								<?php } ?>

								</td>
							<?php } ?>

							<?php if (count($total_prod)==0){?>
								<td><a href="index.php?view=products_list&code_info=<?php echo $user->code_info;?>&estate=<?php echo $user->estate;?>&id_activity=<?php echo $user->id;?>&date_activity=<?php echo $user->date_pub;?>&activity_title=<?php echo $user->activity_title;?>" class="btn btn-danger btn-sm"> <?php echo count($total_prod)?></a></td>
							<?php } ?>




							<!-- <td><button type="image_viewer" id="<!?php echo $user->id; ?>" class="btn btn-success btn-xs">Ver</td> -->
							<!-- <!?php if ($user->file != ""){ ?>
							<td><a href="uploads/files/<!?php echo $user->file;?>" class="btn btn-default btn-xs">Des</a></td>
							<!?php } ?>
							<!?php if ($user->file == ""){ ?>
							<td><a href="#" class="btn btn-default btn-xs">Des</a></td>
							<!?php } ?> -->


							<td><a href="index.php?view=image_edit&id=<?php echo $user->id;?>&code_info=<?php echo $user->code_info; ?>&user_id=<?php echo $user->user_id; ?>&estate=<?php echo $user->estate; ?>&title=<?php echo $user->activity_title; ?>" class="btn btn-default btn-sm"><i class="material-icons">image</i></a>




							<td>

							<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ ?>
								<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id;?>&id=<?php echo $user->id;?>&code_info=<?php echo $user->code_info;?>&estado=<?php echo $user->estate; ?>&participantes=<?php if(isset($_GET["participantes"])){echo $_GET["participantes"];}?>&start_at=<?php if(isset($_GET["start_at"])){echo $_GET["start_at"];}?>&finish_at=<?php if(isset($_GET["finish_at"])){echo $_GET["finish_at"];}?>&pag=<?php if(isset($_GET["pag"])){echo $_GET["pag"];}?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
								<a href="index.php?action=delreport&id=<?php echo $user->id;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a>
							
							<?php }else{
								if ( $_SESSION["user_type"] == 8 && strtoupper($_SESSION["user_region"]) == strtoupper($user->estate) )  {
							?>
									<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id;?>&id=<?php echo $user->id;?>&code_info=<?php echo $user->code_info;?>&estado=<?php echo $user->estate; ?>&participantes=<?php if(isset($_GET["participantes"])){echo $_GET["participantes"];}?>&start_at=<?php if(isset($_GET["start_at"])){echo $_GET["start_at"];}?>&finish_at=<?php if(isset($_GET["finish_at"])){echo $_GET["finish_at"];}?>&pag=<?php if(isset($_GET["pag"])){echo $_GET["pag"];}?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
									<a href="index.php?action=delreport&id=<?php echo $user->id;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a>

								<?php }elseif ( trim(strtoupper($_SESSION["user_code_info"])) == trim(strtoupper($user->code_info) ) || $user->user_id == $_SESSION["user_id"])  { ?>
									<a href="index.php?view=editactivity&user_id=<?php echo $user->user_id;?>&id=<?php echo $user->id;?>&code_info=<?php echo $user->code_info;?>&estado=<?php echo $user->estate; ?>&participantes=<?php if(isset($_GET["participantes"])){echo $_GET["participantes"];}?>&start_at=<?php if(isset($_GET["start_at"])){echo $_GET["start_at"];}?>&finish_at=<?php if(isset($_GET["finish_at"])){echo $_GET["finish_at"];}?>&pag=<?php if(isset($_GET["pag"])){echo $_GET["pag"];}?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
									<a href="index.php?action=delreport&id=<?php echo $user->id;?>&estado=<?php echo $user->estate; ?>&participantes=<?php echo $_GET["participantes"];?>&start_at=<?php echo $_GET["start_at"];?>&finish_at=<?php echo $_GET["finish_at"];?>&pag=<?php echo $_GET["pag"];?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a>
								<?php } ?>
								<!-- <a class="navbar-brand"> <!?php echo "-".strtoupper($_SESSION["user_code_info"])."-".strtoupper($user->code_info)."-";?> </a> -->

							<?php } ?>
							</td>


							<!-- <td><button type="image_viewer_orig" id="<"?php echo $user->id; ?>" class="btn btn-success btn-xs">Imágenes</td> -->
							<!-- activa el modal y llama la func JS | el scroll vuelve a donde estaba -->
							<!-- <td><button type="image_viewer_orig" id="<!?php echo $user->id; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#image_view">Imágenes</button> -->
							<!-- <button type="image_edit" id="<!?php echo $user->id; ?>" class="btn btn-success btn-xs" data-toggle="modal" data-target="#image_view">Editar</button><td> -->
							<!-- <a href="index.php?view=image_edit&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> -->


							<!-- <td style="width:180px;">
							<a href="index.php?view=editinfocentro&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
							<a href="index.php?action=delinfocentro&id=<!?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
							</td> -->
							
							</tr>
							

							<!-- data preview -->
							<p class="data" id="get_data" >
								<!-- <p class="data_imagen" id="https://infoapp.lanubeplus.com/uploads/images/reports/<!?php echo $imagen_p;?>"></p> -->
								<p class="data_imagen_modal" id='uploads/images/reports/<?php echo $img;?>'></p>
								<p class="data_imagen" id="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/admin/uploads/images/reports/'; ?><?php echo $imagen_p;?>"></p>
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
						echo "<p class='alert alert-danger'>No hay reportes</p>";
					}
					?>


					</div class="card-content table-responsive">

		

				</div>
			</div>
		</div>



	<?php if(count($users)>0){ ?>

	<center>

	<?php

	/*Sector de Paginacion */

	//Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
	$DecrementNum =(($compag -1))<1?1:($compag -1);

	echo $url_pag.$DecrementNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-left\"></i> </a>";

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
				echo $url_pag.$i."\" class=\"btn btn-primary btn-sm\"active\">".$i."  </a>";
			}else {
				echo $url_pag.$i."\" class=\"btn btn-info btn-sm\">".$i."  </a>";
			}     		
		}
	}
		
	// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";
	echo $url_pag.$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


	?>

	</center>

	<?php } ?>








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

.btn_preview {
	color: #FFFFFF;
	background: #ffffff00;
	box-shadow: none;
	padding: 0px 0px;
	margin: 0px 0px;
	border: none;
	opacity: 1;
}











.fullscreen-swal{ z-index: 9999 !important; width:100vw !important; height:90vh !important; }




</style>