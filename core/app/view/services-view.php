<?php

// if (isset($_SESSION['user_code_info']) && $_SESSION['user_code_info'] == "777") {
// 	$info = InfoData::getByCode("ama000");
// 	// echo $info->estado;
// 	// echo strtoupper("ama05");
// 	$estado = $info->estado;
// 	$municipio = $info->municipio;
// 	$direccion = $info->direccion;
// } else {
// 	$info = InfoData::getByCode($_SESSION['user_code_info']);
// 	$estado = $info->estado;
// 	$municipio = $info->municipio;
// 	$direccion = $info->direccion;
// }
?>



<script language="javascript">
	$(document).ready(function() {

		var Name_OS = "Unknown OS";
		// OS NAME
		if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
		if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
		if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
		if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
		if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
		// console.log(Name_OS);

		// navegador web en escritorio
		var sBrowser, sUsrAg = navigator.userAgent;

		if (sUsrAg.indexOf("Chrome") > -1) {
			sBrowser = "Chrome";
		} else if (sUsrAg.indexOf("Safari") > -1) {
			sBrowser = "Safari";
		} else if (sUsrAg.indexOf("Opera") > -1) {
			sBrowser = "Opera";
		} else if (sUsrAg.indexOf("Firefox") > -1) {
			sBrowser = "Firefox";
		} else if (sUsrAg.indexOf("MSIE") > -1) {
			sBrowser = "Internet Explorer";
		}
		// console.log(sBrowser);



		if (Name_OS == "Android") {
			get_Name = Name_OS + "|" + sBrowser;
			// get_Name = Name_OS + "|" + md.userAgent() + "|" + md.mobile() + "|" + md.versionStr('Build');
		} else {
			get_Name = Name_OS + "|" + sBrowser;
		}
		// console.log(md.userAgent());



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






		// alert('<!?php echo $_SESSION['user_code_info'];?>');
	});
</script>



<?php


// $search = "maria";
// $aviso = "";

// $conn = DatabasePg::connectPg();

// if ($search != "") {
// 	$row = $conn->prepare("SELECT * from final_users where id='".(int)$search."' or (user_nombres like '%$search%' or user_dni like '".(int)$search."' or user_correo like '%$search%')");
// 	$row->execute();
// 	$total_data = $row->fetchAll(PDO::FETCH_ASSOC);
// }
// // echo $total_data[0]['user_nombres'];

// $array = array(
// 	"error" => "true",
// 	"param"  => $aviso,
// 	"name"  => $total_data[0]['user_nombres'],
// );
// echo json_encode($array);





$participants_q = isset($_GET["participantes"]) ? $_GET["participantes"] : "";
$start_at_q = isset($_GET["start_at"]) ? $_GET["start_at"] : "";
$finish_at_q = isset($_GET["finish_at"]) ? $_GET["finish_at"] : "";
$linea_accion_q = isset($_GET["linea_accion"]) ? $_GET["linea_accion"] : "";
$q = isset($_GET["q"]) ? $_GET["q"] : "";
$uid_q = isset($_GET["uid"]) ? $_GET["uid"] : "";
$estado_q = isset($_GET["estado"]) ? $_GET["estado"] : "";
$pag = isset($_GET["pag"]) ? $_GET["pag"] : "";
$code_info = isset($_GET["info_id"]) ? $_GET["info_id"] : "";
$info_id = "";
$TotalReg = 0;

if ($code_info != "") {
	$base = new Database();
	$db = $base->connectPDO();

	$query = $db->query("SELECT id from infocentros where cod='$code_info'");
	$res = $query->fetchAll();
	foreach ($res as $row) {
		$info_id = isset($row["id"]) ? $row["id"] : "0";
	}
}



$CantidadMostrar = 10;
$url_pag_atras = "";
$url_pag_adelante = "";
$TotalRegistro = 0;

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

$date_ini = date_create($start_at_q);
$date_end = date_create($finish_at_q);
$start_at = $date_ini->format('d-m-Y');
$finish_at = $date_end->format('d-m-Y');



if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) {

	$sql = "SELECT * FROM reports";
	$sql_dw = "SELECT reports.id, 
reports.is_active, 
reports.status_activity, 
reports.user_id, 
reports.code_info, 
reports.line_action, 
reports.report_type, 
reports.activity_title, 
SUM(participants_list.gender = 'Mujer') AS T_mujeres, 
SUM(participants_list.gender = 'Hombre') AS T_hombres, 
reports.responsible_name, 
reports.responsible_phone, 
reports.responsible_type, 
reports.responsible_dni, 
reports.responsible_email, 
reports.personal_type, 
reports.training_modality, 
reports.date_pub, 
reports.duration_days, 
reports.duration_hour, 
reports.developed_content, 
reports.organized_by_info, 
reports.institutions, 
reports.address, 
reports.estate, 
reports.city, 
reports.municipality, 
reports.parish, 
reports.observations, 
reports.notific, 
reports.name_os, 
reports.image, 
reports.datetime 
from reports 
INNER JOIN participants_list ON participants_list.id_activity = reports.id 
where";
} else {

	$sql = "SELECT * FROM reports WHERE reports.estate='" . $_SESSION["user_region"] . "' and ";
	$sql_dw = "SELECT reports.id, 
reports.is_active, 
reports.status_activity, 
reports.user_id, 
reports.code_info, 
reports.line_action, 
reports.report_type, 
reports.activity_title, 
SUM(participants_list.gender = 'Mujer') AS T_mujeres, 
SUM(participants_list.gender = 'Hombre') AS T_hombres, 
reports.responsible_name, 
reports.responsible_phone, 
reports.responsible_type, 
reports.responsible_dni, 
reports.responsible_email, 
reports.personal_type, 
reports.training_modality, 
reports.date_pub, 
reports.duration_days, 
reports.duration_hour, 
reports.developed_content, 
reports.organized_by_info, 
reports.institutions, 
reports.address, 
reports.estate, 
reports.city, 
reports.municipality, 
reports.parish, 
reports.observations, 
reports.notific, 
reports.name_os, 
reports.image, 
reports.datetime 
from reports 
INNER JOIN participants_list ON participants_list.id_activity = reports.id 
where reports.estate='" . $_SESSION["user_region"] . "' and ";
}
// solo admin visualiza la data nacional

$sql .= " WHERE";
$sql .= " is_active='1' AND status_activity='1' AND estate!=''";
$sql .= " AND date_ini between '2024-01-01' and '2024-01-02'";
$sql .= " order by datetime desc";
$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);


$conn = DatabasePg::connectPg();

// echo $sql;

$stmt = $conn->prepare($sql);
// $stmt = $conn->prepare("SELECT * from reports_2 WHERE date_ini between '2024-01-01' and '2024-01-02' ");
$stmt->execute();
// Según algunas respuestas, en PDO obtener los resultados como objetos sería más lento en la mayoría de los casos
// $data = $stmt->fetchAll(PDO::FETCH_OBJ);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $TotalReg = $stmt->rowCount();
// print_r ( $data);

// total aproximado con pg_class
$row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'reports'");
$row_table->execute();
$total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
$TotalReg = $total_data[0]["reltuples"];


// con la clase ExecutorPg
// $sql = "SELECT * FROM reports WHERE relname = 'reports'";
// $data = ExecutorPg::get($sql);

// $sql = "UPDATE reports set person_fe = ? where id = ?;";
// $values = [(int)$total_person, (int)$id_activity];
// return ExecutorPg::update($sql, $values);

// Uasando Postgre directamente con PDO
// $sql = "UPDATE participants_list set id_user_final = (select id from final_users where user_dni=document_id) where id_user_final =''";
// $query = $conn->prepare($sql);
// $query->execute();
// $result = $query->fetchAll(PDO::FETCH_ASSOC);


if ($TotalReg > 0) {

	$url_pag = "<a href=\"?view=services&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
	$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
	$DB_name = "reports";

	# Redireccionar a la lista
	// header("Location: listar.php");
	// echo "Estas conectado con total de: " . $TotalReg;
} else {
	echo "Algo salió mal. Por favor verifica que la tabla exista";
}





?>


<!-- modal form services -->
<div class="modal fade " id="nuevoservicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<!-- <div class="modal fade" id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="row justify-content-center">
				<h6 class="title">Nuevo servicio</h6>
			</div>

			<div class="modal-body">
				<!-- <"?php include "core/app/view/form_services_modal.php"; ?> -->
			</div>

			<div class="modal-footer">
				<!-- <a class="btn btn-secondary" href="./admin/index.php?view=newfinaluser">Nuevo usuario</a> -->
				<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button> -->
			</div>
			<!-- <div class="row justify-content-center"><h6 class="title">Nuevo servicio</h6></div>     -->
			<a class="btn btn-secondary" href="./index.php?view=userform_new">Nuevo usuario</a>

		</div>
	</div>
</div>
<!-- fin modal form services -->


<br>

<div class="row justify-content-center">
	<div class="col-md-10">

		<div class="row">

			<h6 class="title text-left">Servicio al usuario</h6>
			<table class="table table-active">
				<tbody>
					<tr>
						<!-- <td>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoservicio">Nuevo servicio</button>
						</td> -->

						<!-- <td>
							<a type="button" class="form-group text-right" data-toggle="modal" data-target="#nuevoservicio"><i class="fa fa-plus-circle"></i> Nuevo servicio</a>
						</td> -->

						<td>
							<a class="form-group text-right" href="./index.php?view=userform_new"><i class="fa fa-user-tag"></i> Nuevo usuario</a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>

</div>

<br>

<div class="row justify-content-center">
	<div class="col-md-10">

		<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>
		<div class="row justify-content-center">
			<h6 class="title">Listado de servicios</h6>
		</div>

		<!-- <div class="card p-4">
			<h6 class="title text-left">
				< En desarrollo>
			</h6>
		</div> -->
	</div>
</div>







<div class="row">
	<div class="col-12">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>UID</th>
						<th>Fecha</th>
						<th>Code Info</th>
						<th>Línea de acción</th>
						<th>Tipo de repoorte</th>
						<th>Título de la actividad</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($data as $row) { ?>
						<tr>
							<!-- La forma con PDO::FETCH_OBJ -->
							<!-- <td><!?php echo $row->user_id ?></td> -->

							<td><?php echo $row["user_id"] ?></td>
							<td><?php echo $row["date_ini"] ?></td>
							<td><?php echo $row["code_info"] ?></td>
							<td><?php echo $row["line_action"] ?></td>
							<td><?php echo $row["report_type"] ?></td>
							<td><?php echo $row["activity_title"] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<!-- Botones de paginacion -->
<?php include "core/app/layouts/pagination.php"; ?>



<br>
<br>
<br>
<br>
<br>
<br>
<br>












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

	.icon_table {
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


	.fullscreen-swal {
		z-index: 9999 !important;
		width: 100vw !important;
		height: 90vh !important;
	}

	.modal-body {
		padding: 5px;
		position: relative;
	}
</style>