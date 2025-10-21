<?php
$sql = "SELECT date_pub,code_info,line_action,activity_title,estate from reports where estate=\"Lara\" ";
$date_pub = "Fecha publicación";
?>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />
  

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  
  
 <section class="showcase">
    <div class="container">
        <div class="row padall">
            <div class="col-lg-12" style="padding-bottom:10px; padding-top:10px;">
                <h3>Reportes</h3>               
            </div>
        </div>

            <div class="container">
            <div class="row padall border-bottom">
                <div class="col-lg-12">
                <div class="table-responsive-sm">
                    <table id="render-data" class="table display wrap" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>Imagen</th> -->
                                <th>Ver</th>
                                <th><?php echo $date_pub; ?></th>
                                <th>code_info</th>
                                <th>line_action</th>
                                <th>activity_title</th>
                                <th>estate</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- <th>Imagen</th> -->
                                <th>Ver</th>
                                <th><?php echo $date_pub; ?></th>
                                <th>code_info</th>
                                <th>line_action</th>
                                <th>activity_title</th>
                                <th>estate</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php
?>

<!-- Footer -->
<footer class="footer bg-light" style="background: #00354E!important">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
        
            <p class="text-muted small mb-4 mb-lg-0">Copyright &copy;  2010 - <?php print date('Y', time());?> <a href="https://baulphp.com/">BAULPHP.COM</a> .</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
        
        </div>
        </div>
    </div>
</footer>




<!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>




<script type="text/javascript">

var names = ['A', '<?php echo $date_pub; ?>', 'C', 'D', 'E', 'F']

jQuery(document).ready(function() {
    jQuery('#render-data').DataTable({
        // oculta columnas en movil
        rowReorder: {
        selector: 'td:nth-child(2)'
        },
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        "paging": true,
        "processing": true,
        "searching": false,
        "order": [[0, 'desc']],
        "autoWidth": true,
        "pageLength": 10,
        // col hide
        columnDefs: [
            {
                targets: [ 1, 2 ],
                visible: false
            }
        ],
   

        'serverMethod': 'post',
        "ajax": 'core/app/view/datatable_report.php?sql=<?php echo $sql;?>',
        dom: 'lBfrtip',

        
        buttons: [
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

        ],

        columns: [
        {"width": "20%", "className":'details-control', "orderable":false, "data": null,"defaultContent": ''},
        {data: "date_pub", "width": "10%", "className": "dt-body-center", "orderable":false,
        
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

        {data: "code_info", "width": "10%", "className": "dt-body-center", "orderable":false },
        {data: "line_action", "width": "10%", "className": "dt-body-center", "orderable":false },
        {data: "activity_title", "width": "60%", "className": "dt-body-center", "orderable":false },
        {data: "estate", "width": "10%", "className": "dt-body-center", "orderable":false }
        ],


        // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );






} );



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




  </script>
</body>
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
