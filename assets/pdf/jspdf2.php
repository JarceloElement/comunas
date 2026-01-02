<!-- <script src="../assets/jsPDF/examples/js/jquery/jquery-1.7.1.min.js"></script> -->
<!-- <script type="text/javascript" src="../assets/jsPDF/dist/polyfills.umd.js"></script> -->
        
<script src="../assets/jsPDF/dist/jspdf.umd.min.js"></script>

<!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script> -->
<!-- <script src='../assets/jsPDF/dist/jspdf.debug.js'></script> -->
    
<script src="../libs/jspdf.debug.js"></script>
    <script src="../../dist/jspdf.plugin.autotable.js"></script>

    <script>
      const doc = new jsPDF('p', 'mm')
      doc.autoTable({
        html: '#my-table',
        theme: 'grid',
        tableWidth: 180,
        head: [['ID', 'Name', 'Email', 'Country', 'IP-address']],
        body: [
          ['1', 'Donna', 'dmoore0@furl.net', 'China', '211.56.242.221'],
          ['2', 'Janice', 'jhenry1@theatlantic.com', 'Ukraine', '38.36.7.199'],
          [
            '3',
            'Ruth',
            'rwells2@constantcontact.com',
            'Trinidad and Tobago',
            '19.162.133.184',
          ],
          ['4', 'Jason', 'jray3@psu.edu', 'Brazil', '10.68.11.42'],
          ['5', 'Jane', 'jstephens4@go.com', 'United States', '47.32.129.71'],
          ['6', 'Adam', 'anichols5@com.com', 'Canada', '18.186.38.37'],
        ],
      })

      document.getElementById('output').data = doc.output('datauristring')
    </script>


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
		alert(result);
		// alert("result");
};





// crear PDF
cell()

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