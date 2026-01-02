
<!doctype html>
<html lang="es">
<head>



<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<link rel="icon" type="../image/png"  href="uploads/icon.png"/>

<title>InfoApp</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
<!-- <link href="../assets/css/material-dashboard.css" rel="stylesheet"/> -->
<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="../assets/css/views_responsive.css" rel="stylesheet"/>
<link href="../assets/css/views_styles.css" rel="stylesheet"/>

<script src="../assets/js/jquery.min.js" type="text/javascript"></script>


<!-- <img class="img_report card" src="../images/default.jpg" alt="image"> -->


</head>










<!-- <script src="../assets/jsPDF/examples/js/jquery/jquery-1.7.1.min.js"></script> -->
<!-- <script type="text/javascript" src="../assets/jsPDF/dist/polyfills.umd.js"></script> -->
        
<script src="../assets/jsPDF/dist/jspdf.umd.min.js"></script>
<script src="../assets/jsautotable/dist/jspdf.plugin.autotable.js"></script>

<script src="../assets/jsautotable/examples/libs/faker.min.js"></script>

<!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script> -->
<!-- <script src='../assets/jsPDF/dist/jspdf.debug.js'></script> -->
    
<!-- <script src="../libs/jspdf.debug.js"></script> -->





<?php

$param_pdf = $_GET["param_pdf"];
$param_sql = $_GET["param_sql"];
$DB_name = $_GET["DB_name"];

?>








<body>

<div class="col-md-12">
	<div id="cover-spin"></div>
	<br>
	<br>
	<!-- <div class="form-group text_label">
		<!?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
	</div> -->
	<div class="form-group text_label">
        <button class="btn btn-primary text_label"  onclick="generate()">Descargar pdf</button>
</div>







<?php
require ('../core/app/view/conexion.php');

$db = Database::connect();


if ($param_sql == "true"){
	$statement_1 = $db->query($param_pdf);
}else{
	$statement_1 = $db->query("SELECT * FROM ".$param_pdf);
}


$res = $statement_1->fetchAll();
Database::disconnect();

?>





<script language="javascript">




$(document).ready(function(){
	$('#cover-spin').hide(0);

})

function generate() {
	$('#cover-spin').show(0);

	var doc = new jspdf.jsPDF("landscape");
	var totalPagesExp = '{total_pages_count_string}'

	var columns = ["Nº","Fecha", "Infocentro", "Región", "Línea","Actividad","Responsable","Teléfono","T. mujeres","T. hombres","Instituciones"];
	var n = 0;
	var data = [
		<?php foreach($res as $row):
			$n++?>
		['<?php echo $n; ?>','<?php echo date("d/m/Y",strtotime(explode("/",$row["date_pub"])[0])); ?>','<?php echo $row["code_info"]; ?>','<?php echo $row["estate"]; ?>','<?php echo $row["line_action"]; ?>','<?php echo str_replace("\r\n", ' ',$row["activity_title"]); ?>','<?php echo $row["responsible_name"]; ?>','<?php echo $row["responsible_phone"]; ?>','<?php echo $row["T_hombres"]; ?>','<?php echo $row["T_mujeres"]; ?>','<?php echo $row["institutions"]; ?>'],
		<?php endforeach; ?>
	];

	// var columns = ["Id", "Nombre", "Email", "Pais"];
		// var data = [
		// 		[1, "Carlos", "009@gmail.com", "Mexico"],
		// 		[2, "Miguel",  "888@hotmail.com", "Brasil"],
		// 		[3, "Jorge", "jorge@yandex.com", "Ecuador"],
		// 		[3, "mario", "mario@yandex.com", "Colombia"],
		// ];

	// console.log(data);

	doc.autoTable(columns,data,
	{ 
		headStyles: { 
			fillColor: ['a75edb'],
			lineColor: ['ffffff'],
			lineWidth: 0.2,
			fontSize: 9,
			halign: 'center',
		},


		// theme: 'plain',
		theme: 'grid',
		margin: { top: 30 },
		styles: { halign: 'left', lineColor: ['eaeaea'], },
		alternateRowStyles: { fillColor: ['#F6F6F6'], },


		columnStyles: {
			0: {
				fontStyle: 'bold',
				// lineColor: '576574',
			},
		},

		didDrawPage: function (data) {
			// Header
			doc.setFontSize(14)
			doc.setTextColor(40)
			// if (base64Img) {
			//   doc.addImage(base64Img, 'JPEG', data.settings.margin.left, 15, 10, 10)
				// }

			doc.addImage("../uploads/logo_report.jpg", data.settings.margin.left, 15, 20, 13); // p-y, ancho, alto
			doc.text("<?php echo "Reporte de ".$DB_name; ?>", data.settings.margin.left + 25, 20)
			doc.setFontSize(8)
			// doc.text("<!?php echo "Parámetros de consulta: ".$param_pdf; ?>", data.settings.margin.left + 25, 25)

			// Footer
			var str = 'Página ' + doc.internal.getNumberOfPages()
			// Total page number plugin only available in jspdf v1.0+
			if (typeof doc.putTotalPages === 'function') {
				str = str + ' de ' + totalPagesExp
			}
			doc.setFontSize(10)

			// jsPDF 1.4+ uses getWidth, <1.4 uses .width
			var pageSize = doc.internal.pageSize
			var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
			doc.text(str, data.settings.margin.left, pageHeight - 10)
		},




	});

	// Total page number plugin only available in jspdf v1.0+
	if (typeof doc.putTotalPages === 'function') {
		doc.putTotalPages(totalPagesExp)
	}

	doc.save("<?php echo $DB_name.".pdf"; ?>");
	$('#cover-spin').hide(0);

}



$('#cover-spin').show(0);






</script>
		

</body>








<style>



.table > thead > tr > th {
    border-bottom-width: 1px;
    font-size: 0.8em;
	font-weight: 400;
	/* width: 50%; */
	
}



.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px 5px;
	vertical-align: middle;
}





</style>

