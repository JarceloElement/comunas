
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
$DB_name = $_GET["DB_name"].".pdf";

?>








<body>
  <div class="col-md-12">
    <div class="btn_" >
        <button class="btn btn-primary"  onclick="generate()">Descargar pdf</button>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="card" >
          <div class="card-content table-responsive">
      </div>
    </div>
  </div>


<style>
  .btn_ {
    background-color: #d2d2d2;
}
</style>



		<div class="card">
			<div class="card-content table-responsive">

				<table id="table" class="table table-bordered table-hover">
		
					<thead>
						<tr>
							<th>N°</th>
							<th>Actividad</th>
							<th>Fecha</th>
							<th>Estado</th>
							<th>Cod-Infc</th>
							<th style="width: 200px;">Acción realizada</th>
							<th>Formato</th>
							<th>Detalles del formato</th>
							<th>Cantidad creados</th>
							<th>Cantidad publicados</th>
							<th>Enlaces web</th>
						</tr>
					</thead>
					

					<tbody>
				

        <!-- <tr>
          <td>1</td>
          <td>Donna y amazonas</td>
          <td>Culpa cumque ipsam quidem saepe sunt velit doloremque illum rerum ut eos quaerat velit enim ut
commodi eum ut aut cupiditate nesciunt voluptatem.</td>
          <td>dmoore0@furl.net</td>
          <td>China</td>
          <td>211.56.242.221</td>
				</tr>
				

        <tr>
          <td>2</td>
          <td>Janice</td>
          <td>Henry</td>
          <td>jhenry1@theatlantic.com</td>
          <td>Ukraine y amazonas, chichirivichi</td>
          <td>38.36.7.199</td>
				</tr> -->
				

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
				

					$total_fem = 0;
					$total_mas = 0;
					$count = 0;
					foreach($res as $row){
					    $count += 1;

						// $pacient  = $user->getPacient();
						// $medic = $user->getMedic();
						?>
						<tr>
						<td><?php echo $count; ?></td>
						<td><?php echo $row["activity_title"]; ?></td>
						<td><?php echo date("d/m/Y", strtotime($row["date"])); ?></td>
						<td><?php echo $row["estate"]; ?></td>
						<td><?php echo $row["code_info"]; ?></td>
						<td><?php echo $row["action_performed"]; ?></td>
						<td><?php echo $row["format"]; ?></td>
						<td><?php echo $row["format_detail"]; ?></td>
						<td><?php echo $row["quantity_created"]; ?></td>
						<td><?php echo $row["quantity_published"]; ?></td>
						<td><?php echo $row["web_link"]; ?></td>
		
						
						</tr>


						
						<?php

					}
					?>


      </tbody>
    </table>


		</div>
	</div>





    <script>




// function headRows() {
//   return [
//     { ID: 'ID', First_name: 'First name', Last_name: 'Last name', Email: 'Email', Country: 'Country', IP_address: 'IP-address' },
//   ]
// }


// function bodyRows(rowCount) {
//   rowCount = rowCount || 10
//   var body = []
//   for (var j = 1; j <= rowCount; j++) {
//     body.push({
//       id: j,
//       name: faker.name.findName(),
//       email: faker.internet.email(),
//       city: faker.address.city(),
//       expenses: faker.finance.amount(),
//     })
//   }
//   return body
// }


	function generate() {
		var doc = new jspdf.jsPDF("landscape")

		// // Simple data example
		// doc.text(20,20,"Reporte general de actividades");
		var totalPagesExp = '{total_pages_count_string}'


		// var columns = ["Id", "Nombre", "Email", "Pais"];
		// var data = [
		// 		[1, "Carlos", "009@gmail.com", "Mexico"],
		// 		[2, "Miguel",  "888@hotmail.com", "Brasil"],
		// 		[3, "Jorge", "jorge@yandex.com", "Ecuador"],
		// 		[3, "mario", "mario@yandex.com", "Colombia"],
		// ];







// // EJEMPLO calentario

// 		var nestedTableCell = {
//     content: '',
//     // Dynamic height of nested tables are not supported right now
//     // so we need to define height of the parent cell
//     styles: { minCellHeight: 100 },
//   }
// 	doc.autoTable({
// 			theme: 'grid',
// 			head: [['2019', '2020']],
// 			body: [[nestedTableCell]],
// 			foot: [['2019', '2020']],
// 			startY: 20,
// 			didDrawCell: function (data) {
// 				if (data.row.index === 0 && data.row.section === 'body') {
// 					doc.autoTable({
// 						startY: data.cell.y + 2,
// 						margin: { left: data.cell.x + 2 },
// 						tableWidth: data.cell.width - 4,
// 						styles: {
// 							maxCellHeight: 4,
// 						},
// 						columns: [
// 							{ dataKey: 'id', header: 'ID' },
// 							{ dataKey: 'name', header: 'Name' },
// 							{ dataKey: 'expenses', header: 'Sum' },
// 						],
// 						body: bodyRows(),
// 					})
// 				}
// 			},
// 		})
// // EJEMPLO









		doc.autoTable({
			// datos |
			// columns,
			// data, 
			html: '#table',
			// fin data

			// startY: doc.lastAutoTable.finalY + 15,
			// rowPageBreak: 'auto',
			// bodyStyles: { valign: 'top' },
			// margin:{ top: 25  },
			// showHead: 'firstPage',

			

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




// // EJEMPLO

		// 	didParseCell: function (data) {

		// 		// color fila
    //   if (data.row.index === 1) {
		// 		data.cell.styles.fillColor = [40, 170, 100]
		// 		// data.cell.text = 'HOLA'
		// 	}
			
		// 	// color columna
		// 	if (data.column.dataKey === 1) {
		// 		data.cell.styles.fillColor = [40, 170, 100]
		// 	}


    //   if (data.column.dataKey === 'Fecha') {
		// 		// data.cell.styles.font = 'mitubachi'
		// 		data.cell.text = 'HOLA'
      
		// 	}

		// },
// // EJEMPLO
		





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
			doc.text("<?php echo "Parámetros de consulta: ".$param_pdf; ?>", data.settings.margin.left + 25, 25)



      // Footer
      var str = 'Página ' + doc.internal.getNumberOfPages()
      // Total page number plugin only available in jspdf v1.0+
      if (typeof doc.putTotalPages === 'function') {
        str = str + ' of ' + totalPagesExp
      }
      doc.setFontSize(10)

      // jsPDF 1.4+ uses getWidth, <1.4 uses .width
      var pageSize = doc.internal.pageSize
      var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
      doc.text(str, data.settings.margin.left, pageHeight - 10)
		},
		

		margin: { top: 30 },



  	})
		
		// Total page number plugin only available in jspdf v1.0+
		if (typeof doc.putTotalPages === 'function') {
    doc.putTotalPages(totalPagesExp)
  	}

		doc.save("<?php echo $DB_name; ?>")

		// doc.save('table.pdf')
	}







	function bodyRows(rowCount) {
  rowCount = rowCount || 10
  var body = []
  for (var j = 1; j <= rowCount; j++) {
    body.push({
      id: j,
      name: faker.name.findName(),
      email: faker.internet.email(),
      city: faker.address.city(),
      expenses: faker.finance.amount(),
    })
  }
  return body
}


</script>
		

  </body>















<script type="text/javascript">
    var jsPDF = window.jspdf.jsPDF;
    // $(document).ready(function() {
    //     if(jsPDF && jsPDF.version) {
    //         $('#dversion').text('Version ' + jsPDF.version);
    //     }
    // });


// Default export is a4 paper, portrait, using millimeters for units
// const doc = new jsPDF();
// doc.text("Hello world!", 10, 10);
// doc.setTextColor("#2d2d2d");
// doc.save("a4.pdf");

// --------------------------------------



// CARGAR IMAGEN DESDE URL
  // Because of security restrictions, getImageFromUrl will
  // not load images from other domains.  Chrome has added
  // security restrictions that prevent it from loading images
  // when running local files.  Run with: chromium --allow-file-access-from-files --allow-file-access
  // to temporarily get around this issue.
  var getImageFromUrl = function(url, callback) {
    var img = new Image(),
      data,
      ret = {
        data: null,
        pending: true
      };

    img.onError = function() {
      throw new Error('Cannot load image: "' + url + '"');
    };
    img.onload = function() {
      var canvas = document.createElement("canvas");
      document.body.appendChild(canvas);
      canvas.width = img.width;
      canvas.height = img.height;

      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0);
      // Grab the image as a jpeg encoded in base64, but only the data
      data = canvas
        .toDataURL("image/png")
        .slice("data:image/png;base64,".length);
      // Convert the data to binary form
      data = atob(data);
      document.body.removeChild(canvas);

      ret["data"] = data;
      ret["pending"] = false;
      if (typeof callback === "function") {
        callback(data);
      }
    };
    img.src = url;

    return ret;
  };





var headers = [
  "COD",
  "Línea",
  "Estado",
  "Municipio",
  "Título",
  "Fecha",
  "Mujeres",
  "Hombres",
  "Instituciones"
];

var head = createHeaders(headers);

function createHeaders(keys) {
  var result = [];
  
  for (var i = 0; i < keys.length; i += 1) {
	// alert(keys[i].length);
	  
    result.push({
      id: keys[i],
      name: keys[i],
      prompt: keys[i],
      width: (keys[i].length)*6,
      align: "center",
      padding: 0
    });
  }
  return result;
}




// IMPORTAR DATOS DE SQL
var generateData = function(amount) {
  var result = [];
  var id = 0;

 
	<?php
	require ('../core/app/view/conexion.php');
	
	$db = Database::connect();
	$statement_1 = $db->query("SELECT * FROM reports ");
	$res = $statement_1->fetchAll();
	Database::disconnect();

	foreach ($res as $row){
	?>

	var data = {
		COD: "<?php echo $row['code_info']; ?>",
		Línea: "<?php echo $row['line_action']; ?>",
		Estado: "<?php echo $row['estate']; ?>",
		Municipio: "<?php echo $row['municipality']; ?>",
		Título: "<?php echo $row['activity_title']; ?>",
		Fecha: "<?php echo $row['date_pub']; ?>",
		Mujeres: "<?php echo $row['person_fe']; ?>",
		Hombres: "<?php echo $row['person_ma']; ?>",
		Instituciones: "<?php echo $row['institutions']; ?>"
	};


	// for (var i = 0; i < amount; i += 1) {
		data.id = (id).toString();
		// data.id = (i + 1).toString();

    result.push(Object.assign({}, data));
		// alert(data.id);
		id += 1;

  <?php	} ?>

  return result;
		// alert(result);
		// alert("result");
};





// crear PDF
// cell()

function cell() {

	// cuando la imagen esta convertida a base64
	var createPDF = function(imgData) {

		var doc = new jsPDF({ putOnlyUsedFonts: true, orientation: "landscape", floatPrecision: 2 });
		// doc.setTextColor(0, 0, 255);

		// doc.addImage(imgData, "JPG", 20, 10, 15, 20);
		doc.addImage(imgData, "PNG", 20, 10, 15, 20, null, "FAST");

		doc.setFontSize(12);
		doc.text("Reportes", 50, 15);

		doc.setDrawColor(150); // color de linea | draw red lines
		

		// doc.setLineWidth(1);
		//   doc.line(20, 30, 60, 30);
		doc.setFontSize(12);
		doc.table(15, 35, generateData(), head, { autoSize: false });

		// doc.setDrawColor(0);
		// doc.setFillColor(255, 0, 0);
		// doc.rect(100, 20, 10, 10, "F"); // filled red square

		// doc.setDrawColor(0);
		// doc.setFillColor(255, 255, 255);
		// doc.roundedRect(140, 20, 10, 10, 3, 3, "FD"); //  Black square with rounded corners

		doc.addPage();

		// doc.setFontSize(22);
		// doc.text(20, 20, "This is a title");

		// doc.setFontSize(16);
		// doc.text(20, 30, "This is some normal sized text underneath.");


		// var name = prompt("What is your name?");
		// doc.setTextColor(100);
		// doc.text(20, 20, "This belongs to: " + name);

		doc.setTextColor(150);
		doc.text(20, 30, "This is light gray.");

		doc.setTextColor(255, 0, 0);
		doc.text(20, 40, "This is red.");


		// url | nota
		doc.textWithLink("Visitar web", 10, 10, {
		url: "https://parall.ax/"
		});
		
		// doc.createAnnotation({
		// type: "text",
		// title: "note",
		// bounds: {
		// 	x: 10,
		// 	y: 10,
		// 	w: 200,
		// 	h: 10
		// },
		// contents: "This is text annotation (closed by default)",
		// open: false
		// });



		// doc.text("10 degrees rotated", 20, 10, null, 10);

		// doc.autoPrint({variant: 'non-conform'});

		
		doc.save("tabla.pdf");
		// doc.autoPrint();

	}

	getImageFromUrl("../uploads/icon.png", createPDF);

}

// print();
</script>







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




<!-- 
<div id="html" style='position: absolute'>
		<h1>Tables</h1>

		<table class='table2'>
			
		<div class="col-lg-4">
                    <div class="row">
                        <div class="form-group">
							<img src="../images/icon.png" width="160" height="120"/>
                            </div>
                        </div>
                    </div>
                </div>

			<tr>
				<td>Item</td>
				<td>Cost</td>
				<td>Description</td>
				<td>Available</td>
			</tr>
			<tr>
				<td>Milk</td>
				<td>$1.00</td>
				<td>Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, Hello PDF World para saber mas sobre la distacia, </td>
				<td>Out Of Stock</td>
			</tr>
			<tr>
				<td>Milk</td>
				<td>$1.00</td>
				<td>Hello PDF World</td>
				<td>Out Of Stock</td>
			</tr>
		</table>

    </div>
    
    <style>

		.table2,
		.table2 td {
			border: 1px solid silver;
			border-collapse: collapse;
		}

		.table2 td:first-child {
			background-color: lightblue;
		}
	</style> -->