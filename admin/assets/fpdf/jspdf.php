
<!doctype html>
<html lang="es">
<head>



<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<link rel="icon" type="../image/png"  href="images/icon.png"/>

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







		<body>
    <button onclick="generate()">Generate pdf</button>

    <!-- <script src="libs/jspdf.umd.js"></script>
    <script src="../dist/jspdf.plugin.autotable.js"></script> -->


		<div class="card">
			<div class="card-content table-responsive">

				<table id="table" class="table table-bordered table-hover">
		
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Cod-Infc</th>
							<th>Estado</th>
							<th>Línea de acción</th>
							<th style="width: 200px;">Título de Actividad</th>
							<th>Responsable</th>
							<th>Teléfono</th>
							<th>Hombres</th>
							<th>Mujeres</th>
							<th>Instituciones</th>
							<th>Observación</th>
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
					$statement_1 = $db->query("SELECT * FROM reports ");
					$res = $statement_1->fetchAll();
					Database::disconnect();
				

					$total_fem = 0;
					$total_mas = 0;
					foreach($res as $row){
						// $pacient  = $user->getPacient();
						// $medic = $user->getMedic();
						?>
						<tr>
						<td><?php echo date("d/m/Y", strtotime($row["date_pub"])); ?></td>
						<td><?php echo $row["code_info"]; ?></td>
						<td><?php echo $row["estate"]; ?></td>
						<td><?php echo $row["line_action"]; ?></td>
						<td><?php echo $row["activity_title"]; ?></td>
						<td><?php echo $row["responsible_name"]; ?></td>
						<td><?php echo $row["responsible_phone"]; ?></td>
						<td><?php echo $row["person_ma"]; ?></td>
						<td><?php echo $row["person_fe"]; ?></td>
						<td><?php echo $row["institutions"]; ?></td>
						<td><?php echo $row["observations"]; ?></td>
						<!-- <td><a href="" value="xxxx"  id="<!?php echo 'image_viewer_'.$user->id; ?>" class="btn btn-warning btn-xs">Ver</a></td> -->
						<!-- <td><button type="image_viewer" id="<!?php echo $user->id; ?>" class="btn btn-success btn-xs">Ver</td>
						<td><a href="index.php?view=editactivity&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a></td>
						 -->
						<!-- <td style="width:180px;">
						<a href="index.php?view=editinfocentro&id=<!?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
						<a href="index.php?action=delinfocentro&id=<!?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
						</td> -->
						
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
		// var head = [['ID', 'Country', 'Rank', 'Capital']]
		// var body = [
		//   [1, 'Denmark', 7.526, 'Copenhagen'],
		//   [2, 'Switzerland', 7.509, 'Bern'],
		//   [3, 'Iceland', 7.501, 'Reykjavík'],
		// ]
		// doc.autoTable({ head: head, body: body })

		// Simple html example
		

		doc.autoTable({ 
			html: '#table',
			// startY: doc.lastAutoTable.finalY + 15,
			rowPageBreak: 'auto',
			bodyStyles: { valign: 'top' },
  })



		


		doc.save('table.pdf')
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

	getImageFromUrl("../images/icon.png", createPDF);

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