
<?php
//$infocentros = InfoData::getAll();
//$TotalReg = count($infocentros);
// $estadoName = EstadoData::getNameById(6);
 // echo $TotalReg;

$sql_total = 'select * from infocentros WHERE (cod_gerencia = "" or cod_gerencia = "0") ';
$result_t = InfoData::getBySQL($sql_total);
$Tota_info = count($result_t);

$faci_nomina = 'SELECT * from facilitators WHERE personal_type = "Nómina" ';
$fn = FacilitatorsData::getBySQL($faci_nomina);
$Tota_faci_nomina = count($fn);

$faci_inst = 'SELECT * from facilitators WHERE personal_type = "Institucional" ';
$fi = FacilitatorsData::getBySQL($faci_inst);
$Tota_faci_inst = count($fi);

$faci_col = 'SELECT * from facilitators WHERE personal_type = "Colaborador" ';
$fc = FacilitatorsData::getBySQL($faci_col);
$Tota_faci_col = count($fc);

$consult = "SELECT * FROM reports WHERE is_active=1 AND status_activity=1"; 
$total_report = ReportActivityData::getBySQL($consult);
$TotalRep = count($total_report);

$consult_plan = "SELECT * FROM reports WHERE is_active=1 AND status_activity=0"; 
$total_plan = ReportActivityData::getBySQL($consult_plan);




$field = "
reports.id,
reports.user_id,
reports.code_info,
reports.estate,
reports.municipality,
reports.parish,
reports.city,
reports.line_action,
reports.report_type,
reports.activity_title,
reports.responsible_name,
reports.responsible_phone,
reports.responsible_type,
reports.responsible_dni,
reports.responsible_email,
reports.personal_type,
reports.date_pub,
reports.developed_content,
reports.training_modality,
reports.duration_days,
reports.duration_hour,
reports.person_fe,
sum(case when participant.gender='Mujer' then 1 else 0 end) as total_mujeres,
reports.person_ma,
sum(case when participant.gender='Hombre' then 1 else 0 end) as total_hombres,
reports.institutions,
reports.address,
reports.observations,
reports.name_os,
reports.datetime
";


$field2 = "
id,
user_id,
code_info,
estate,
municipality,
parish,
city,
line_action,
report_type,
activity_title,
responsible_name,
responsible_phone,
responsible_type,
responsible_dni,
responsible_email,
personal_type,
date_pub,
developed_content,
training_modality,
duration_days,
duration_hour,
person_fe,
(SELECT COUNT(1) FROM participants_list WHERE id_activity = reports.id and gender = 'Mujer')total_mujeres, 
person_ma,
(SELECT COUNT(1) FROM participants_list WHERE id_activity = reports.id and gender = 'Hombre')total_hombres, 
institutions,
address,
observations,
name_os,
datetime 
";



// $param_csv = "SELECT $field
// FROM reports 
// INNER JOIN participants_list as participant on participant.id_activity=reports.id 
// WHERE reports.is_active=1 
// group by participant.id_activity
// order by reports.id desc LIMIT 10";

// $param_csv2 = "SELECT $field2
// FROM reports 
// WHERE is_active=1 
// order by id desc LIMIT 10";

// $report = ReportActivityData::getBySQL($param_csv2);

// foreach($report as $user){
// echo "total_fe: ".$user->code_info."--".$user->total_mujeres."<br>";
// }

// $con = Database::getCon();
// $query = $con->query("SELECT COUNT(*) as total from participants_list where id_activity=27535 ");
// $res = mysqli_fetch_array($query);
// echo "Total: ".$res["total"];




// $param_sql = "true";
// $DB_name = "reports";


?>

<!-- <br>
<a href="./pdf/csv.php?param_csv=<!?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> </a>

<div class="form-group mx-1 mb-1">
	<a class="btn btn-secondary mb-2" href="../../../core/app/view/exportxlsx.php?param=<!?php echo $param_csv2.'&param_sql='.$param_sql.'&filename='.$DB_name; ?>" name="Descargar"><span class="material-symbols-outlined">download</span> XLSX</a>
</div> -->





<div class="row">

	<div class="col-md-4">
		<div class="card">
			<div class="card-header card-header-icon card-header-rose">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 20v-6l8-2l-8-2V4l14.3 6H17q-2.925 0-4.962 2.063T10 17.05zm14 2q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m1.65-2.65l.7-.7l-1.85-1.85V14h-1v3.2z"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Planificaciones</h4>
				<h3 class="title"><?php echo count($total_plan);?></h3>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header card-header-icon card-header-rose">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 20v-6l8-2l-8-2V4l19 8z"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Reportes</h4>
				<h3 class="title"><?php echo $TotalRep;?></h3>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header card-header-icon card-header-warning">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17 9h2V7h-2zm0 4h2v-2h-2zm0 4h2v-2h-2zM1 21V11l7-5l7 5v10h-5v-6H6v6zm16 0V10l-7-5.05V3h13v18z"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Infocentros</h4>
				<h3 class="title"><?php echo $Tota_info;?></h3>
			</div>
		</div>
	</div>

</div>



<div class="row">

	<div class="col-md-3">
		<div class="card">
			<div class="card-header card-header-icon card-header-success">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Total facilitadores</h4>
				<h3 class="title"><?php echo count(FacilitatorsData::getAll());?></h3>
			</div>
		</div>
	</div>



	<div class="col-md-3">
		<div class="card">
			<div class="card-header card-header-icon card-header-success">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Facilitadores nómina</h4>
				<h3 class="title"><?php echo $Tota_faci_nomina;;?></h3>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card">
			<div class="card-header card-header-icon card-header-success">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Facilitadores institucional</h4>
				<h3 class="title"><?php echo $Tota_faci_inst;;?></h3>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card">
			<div class="card-header card-header-icon card-header-success">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M1 20v-2.8q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2V20zm18 0v-3q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v3zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Facilitadores colaborador</h4>
				<h3 class="title"><?php echo $Tota_faci_col;;?></h3>
			</div>
		</div>
	</div>

</div>



<div class="row">

	<div class="col-md-3">
		<div class="card">
			<div class="card-header card-header-icon card-header-info">
			<div class="card-icon">
				<i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m16 21l-.3-1.5q-.3-.125-.562-.262T14.6 18.9l-1.45.45l-1-1.7l1.15-1q-.05-.35-.05-.65t.05-.65l-1.15-1l1-1.7l1.45.45q.275-.2.538-.337t.562-.263L16 11h2l.3 1.5q.3.125.563.275t.537.375l1.45-.5l1 1.75l-1.15 1q.05.3.05.625t-.05.625l1.15 1l-1 1.7l-1.45-.45q-.275.2-.537.338t-.563.262L18 21zM2 20v-2.8q0-.825.425-1.55t1.175-1.1q1.275-.65 2.875-1.1T10 13h.35q.15 0 .3.05q-.725 1.8-.6 3.575T11.25 20zm15-2q.825 0 1.413-.587T19 16t-.587-1.412T17 14t-1.412.588T15 16t.588 1.413T17 18m-7-6q-1.65 0-2.825-1.175T6 8t1.175-2.825T10 4t2.825 1.175T14 8t-1.175 2.825T10 12"/></svg></i>
			</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Total coordinadores</h4>
				<h3 class="title"><?php echo count(CoordinatorsData::getAll());?></h3>
			</div>
		</div>
	</div>







</div>





<div class="row">

</div>


<?php

// require ('indicadores_report_week-view.php');
require ('indicadores_estados-view.php');

?>