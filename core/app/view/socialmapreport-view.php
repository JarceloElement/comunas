<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>DataTables Server-side procesado con PHP y MYSQL</title>










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
<!-- <table id="listaUsuarios" class="table table-sm table-striped table-bordered display wrap" style="width:100%"> -->
<table id="listaUsuarios" class="row-border table-striped table-bordered" style="width:100%">

<!-- <table id="listaUsuarios" class="mdl-data-table" style="width:100%"> -->

<thead>


<tr>
    <!-- cantidad de columnas -->
    <?php for ($i = 1; $i <= 9; $i++) {
        echo '<th>Col</th>';
    } ?>
</tr>


</thead>
<!-- <tfoot>
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
</tfoot> -->
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

    //
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function (opts) {
    // Configuration options
    var conf = $.extend(
        {
            pages: 5, // number of pages to cache
            url: '', // script url
            data: null, // function or object with parameters to send to the server
            // matching how `ajax.data` works in DataTables
            method: 'GET', // Ajax HTTP method
        },
        opts
    );
 
    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;
 
    return function (request, drawCallback, settings) {
        var ajax = false;
        var requestStart = request.start;
        var drawStart = request.start;
        var requestLength = request.length;
        var requestEnd = requestStart + requestLength;
 
        if (settings.clearCache) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        } else if (cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper) {
            // outside cached data - need to make a request
            ajax = true;
        } else if (
            JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) ||
            JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) ||
            JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }
 
        // Store the request for checking next time around
        cacheLastRequest = $.extend(true, {}, request);
 
        if (ajax) {
            // Need data from the server
            if (requestStart < cacheLower) {
                requestStart = requestStart - requestLength * (conf.pages - 1);
 
                if (requestStart < 0) {
                    requestStart = 0;
                }
            }
 
            cacheLower = requestStart;
            cacheUpper = requestStart + requestLength * conf.pages;
 
            request.start = requestStart;
            request.length = requestLength * conf.pages;
 
            // Provide the same `data` options as DataTables.
            if (typeof conf.data === 'function') {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data(request);
                if (d) {
                    $.extend(request, d);
                }
            } else if ($.isPlainObject(conf.data)) {
                // As an object, the data given extends the default
                $.extend(request, conf.data);
            }
 
            return $.ajax({
                type: conf.method,
                url: conf.url,
                data: request,
                dataType: 'json',
                cache: false,
                success: function (json) {
                    cacheLastJson = $.extend(true, {}, json);
 
                    if (cacheLower != drawStart) {
                        json.data.splice(0, drawStart - cacheLower);
                    }
                    if (requestLength >= -1) {
                        json.data.splice(requestLength, json.data.length);
                    }
 
                    drawCallback(json);
                },
            });
        } else {
            json = $.extend(true, {}, cacheLastJson);
            json.draw = request.draw; // Update the echo for each response
            json.data.splice(0, requestStart - cacheLower);
            json.data.splice(requestLength, json.data.length);
 
            drawCallback(json);
        }
    };
};
 
// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register('clearPipeline()', function () {
    return this.iterator('table', function (settings) {
        settings.clearCache = true;
    });
});













    var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 1 ? data.replace( 'ama', 'AMA' ) : data;
                },
                // body: function ( data, row, column, node ) {
                //     return column === 2 ? data='Hola' : data;
                // }
                modifier: {
                    selected: null
                }
            }
        }
    };











    var names = [
        'Estado', 
        'Code_info', 
        'Responsable', 
        'Cantidad de comunas', 
        'Cantidad de CC',
        'Otras org en el entorno',
        'Otras org. relacionadas',
        'Actividades Q. realizan org. en el info',
        'Emprendimientos en el entorno del info'

        
    ];

    var columns_array = [];

    for (tt of names) {
        // console.log(tt);
        columns_array.push({title: tt, "width": "10%", "className": "dt-body-center", "orderable":false });
    }

    // console.log(columns_array);







    var table = $('#listaUsuarios').DataTable( {

    // "rowReorder": true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    responsive: true,
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    // "info": true,
    "searching": true,
    searchDelay: 2000,
    "order": [[0, 'asc']],
    "autoWidth": true,
    // "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
    paging: true,
    columnDefs: [
        // {
        //     targets: ['_all'],
        //     className: 'mdc-data-table__cell',
        // },

        {
            targets: [ 1, 2 ],
            visible: false
        },

        // {
        //     defaultContent: "-",
        //     targets: "_all"
        // }
    ],
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
    // dom: '<"toolbar">frtip',



    ajax: $.fn.dataTable.pipeline({
        url: "core/app/view/getdatareport.php",
        // data: {
        //   "where": "estate='Amazonas' "
        // },

        deferLoading: 57, // tiempo para el post cuando se escribe en el campo de busqueda
        pages: 5, // number of pages to cache
    }),


    // ajax: {
    //     url: "core/app/view/getdatareport.php",
    //     data: {
    //         "where": "estate='Amazonas' "
    //     },
    //     deferLoading: 57,
    // },


    
    columns: columns_array,
    // columns: [
    //     // {title: "Ver", "width": "10%", "className":'details-control', "orderable":false, "data": null,"defaultContent": ''},

    //     {title: "A", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "B", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "C", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "d", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "e", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "f", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "g", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "h", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "i", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "j", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "kk", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "ll", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "mm", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "nn", "width": "10%", "className": "dt-body-center", "orderable":false },
    //     {title: "oo", "width": "10%", "className": "dt-body-center", "orderable":false },

    //     {title: "Última", "width": "20%", "className": "dt-body-center", "orderable":false }
    // ],
    

    
    buttons: [

        {
            "extend": 'colvis',
            // "text": 'Filtrar columnas',
            text: '<span class="material-icons-round">disabled_visible</span> Filtrar columnas',
            // change buttons text
            columnText: function(dt, idx, title){
                return names[idx];
            },
        },

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

            $.extend( true, {}, buttonCommon, {
                extend:    'excelHtml5',
                text:      '<span style="color: green;" class="material-icons-round">download_for_offline</span> Excel | Todo',
                // text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                action: newexportaction,
                filename: function(){
                    var d = new Date();
                    var n = d.getTime();
                    return 'Reporte_mapa_' + d;
                },
                exportOptions: {
                // columns: ':visible'
                }
            } ),

            $.extend( true, {}, buttonCommon, {
                extend:    'excelHtml5',
                text:      '<span style="color: green;" class="material-icons-round">download_for_offline</span> Excel | Col. visibles',
                // text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                action: newexportaction,
                filename: function(){
                    var d = new Date();
                    var n = d.getTime();
                    return 'Reporte_mapa_' + d;
                },
                exportOptions: {
                columns: ':visible'
                }
            } ),

            // {
            //     extend:    'excelHtml5',
            //     text:      '<i class="fa fa-file-excel-o"></i>',
            //     titleAttr: 'Excel',
            //     action: newexportaction,
            //     exportOptions: {
            //     // columns: ':visible'
            //     }
            // },

            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //     columns: ':visible'
            //     }
            // },
            {
                extend:    'pdfHtml5',
                text:      '<span style="color: #cf0a36;" class="material-icons-round">download_for_offline</span> PDF | Col-visibles',
                titleAttr: 'PDF',
                action: newexportaction,
                filename: function(){
                    var d = new Date();
                    var n = d.getTime();
                    return 'Reporte_mapa_' + d;
                },
                exportOptions: {
                columns: ':visible'
                }
            },

            
            
            // {
            // "extend": 'excel',
		    // "text": '<button class="btn btn-outline-primary"><i class="fa fa-file-excel-o" style="color: green;"></i>  Exportar todo</button>',
            // "titleAttr": 'Excel',
            // "action": newexportaction
            // }

        ]
    

        


  } );


//   $('div.toolbar').html('<b>Custom tool bar! Text/images etc.</b>');


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






