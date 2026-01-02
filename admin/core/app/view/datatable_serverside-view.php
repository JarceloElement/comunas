<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>DataTables Server-side procesado con PHP y MYSQL</title>
<!-- DataTables CSS library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"/>


<link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/rr-1.3.3/datatables.min.css" rel="stylesheet"/>
 
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/rr-1.3.3/datatables.min.js"></script>



  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />
  

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">




  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">





<style type="text/css">
.bs-example{
margin: 20px;
}
</style>
</head>
<body>
<div class="bs-example">
<div class="container">
<div class="row">
<div class="col-md-12">
<!-- <div class="page-header clearfix"> -->
<h2 class="pull-left">Reportes</h2>
</div>

<div class="container">
<div class="row padall border-bottom">
<div class="col-lg-12">
<div class="table-responsive-sm">
<table id="listaUsuarios" class="table table-sm table-striped table-bordered display wrap" style="width:100%">
<thead>
<tr>
<th>Ver</th>
<th>Info</th>
<th>Linea de acción</th>
<th>Estado</th>
<th>Título de actividad</th>
<th>Publicado</th>
<th>Tipo reporte</th>
<th>Responsable</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Ver</th>
<th>Info</th>
<th>Linea de acción</th>
<th>Estado</th>
<th>Título de actividad</th>
<th>Publicado</th>
<th>Tipo reporte</th>
<th>Responsable</th>
</tr>
</tfoot>
</table>


</div>
</div>        
</div>
</div>
</div>
</div>
</div>
</div>
</body>


<?php 
$date_pub = "Infocentro";
?>



<script>


$(document).ready(function() {

var names = ['A', '<?php echo $date_pub; ?>', 'C', 'D', 'E', 'F']

  var table = $('#listaUsuarios').DataTable( {
    // "rowReorder": true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    responsive: true,
    "processing": true,
    "serverSide": true,
    "responsive" : true,
    "pageLength": 10,
    "info": true,
    "searching": false,
    "order": [[0, 'asc']],
    "autoWidth": true,
    "pageLength": 10,
    "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
    paging: true,
    columnDefs: [
            {
                targets: [ 1, 2 ],
                visible: false
            }
        ],



    // "ajax": "core/app/view/extraer.php"
    ajax: {
      url: "core/app/view/extraer.php",
      data: {
        //   "where": "estate='Amazonas' "
      },
    },



    columns: [
        {"width": "20%", "className":'details-control', "orderable":false, "data": null,"defaultContent": ''},
        {"width": "10%", "className": "dt-body-center", "orderable":false },
        {"width": "10%", "className": "dt-body-center", "orderable":false },
        {"width": "10%", "className": "dt-body-center", "orderable":false,
         
        	render: function (data, type) {
                // console.log(data);
                if (type === 'display') {
                    let link = 'http://datatables.net';

                    if (data[0] < 'H') {
                        link = 'http://cloudtables.com';
                    } else if (data[0] < 'S') {
                        link = 'http://editor.datatables.net';
                    }

                    return '<a href="' + link + '">' + data + '</a>';
                }

                return data;
            },
        
        },
        {"width": "60%", "className": "dt-body-center", "orderable":false },
        {"width": "20%", "className": "dt-body-center", "orderable":true },
        {"width": "10%", "className": "dt-body-center", "orderable":false },
        {"width": "10%", "className": "dt-body-center", "orderable":false }
    ],
    

    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    dom: 'Bfrtip',
    buttons: [
	    	//{
		//"extend": 'excel',
		//"text": '<button class="btn btn-outline-primary"><i class="fa fa-file-excel-o" style="color: green;"></i>  Exportar todo</button>',
		//"titleAttr": 'Excel',
		//"action": newexportaction
		//},
		
            // {
            //     extend: 'excel',
            //     exportOptions: {
            //     columns: ':visible'
            //     }
            // },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                action: newexportaction,
                exportOptions: {
                // columns: ':visible'
                }
            },

            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //     columns: ':visible'
            //     }
            // },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                action: newexportaction,
                exportOptions: {
                columns: ':visible'
                }
            },

            
            {
                "extend": 'colvis',
                "text": 'Filtrar columnas',
                // change buttons text
                columnText: function(dt, idx, title){
                    return names[idx];
                },
            }
            // {
            // "extend": 'excel',
            // "text": '<button class="btn btn-outline-primary"><i class="fa fa-file-excel-o" style="color: green;"></i>  Exportar todo</button>',
            // "titleAttr": 'Excel',
            // "action": newexportaction
            // }

        ]
    




  } );




  function newexportaction(e, dt, button, config) {
         var self = this;
         var oldStart = dt.settings()[0]._iDisplayStart;
         dt.one('preXhr', function (e, s, data) {
             // Just this once, load all data from the server...
             data.start = 0;
             data.length = 2147483647;
             dt.one('preDraw', function (e, settings) {
                 // Call the original action function
                 if (button[0].className.indexOf('buttons-copy') >= 0) {
                     $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                     $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                     $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                     $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-print') >= 0) {
                     $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                 }
                 dt.one('preXhr', function (e, s, data) {
                     // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                     // Set the property to what it was before exporting.
                     settings._iDisplayStart = oldStart;
                     data.start = oldStart;
                 });
                 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                 setTimeout(dt.ajax.reload, 0);
                 // Prevent rendering of the full data to the DOM
                 return false;
             });
         });
         // Requery the server with the new one-time export settings
         dt.ajax.reload();
     }





    // $('#render-data tbody').on('click', 'td.details-control', function () {
    $(document).on('click', 'td.details-controlx', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        // console.log(row.data());

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


    function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d[1]+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d[4]+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}



} );
</script>







</html>

<style>
  td.details-control {
    background: url('assets/icondetails.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('assets/icondetails.png') no-repeat center center;
}
</style>






