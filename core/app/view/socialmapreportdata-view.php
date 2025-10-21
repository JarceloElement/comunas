<br>
<br>


<div class="container">
    <div class="card bg-light mb-3">
        <div class="card-body">
            <div class="row justify-content-md-center">
                <!-- <div class="col col-lg-2">
                1 of 3
                </div> -->


                <div class="col-md-auto">
                <!-- <div class="col col-lg-8"> -->





                    
                    <?php

                    $users= array();
                    if( ( isset($_GET["q"]) ) && ( $_GET["q"]!="" ) ) {
                    
                        if($_GET["q"]!=""){
                            $sql_where = " user_type = 2 and (progress = '$_GET[q]' or info_state like '$_GET[q]%' or code_info like '$_GET[q]%') ";
                        }

                    }else{

                        $sql_where = "";

                    }

                    ?>

                    <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>

                    <br>

                    <form class="form-inline">
                        <input type="hidden" name="view" value="socialmapreportdata">
                        


                        <div class="form-group row mx-sm-2 mb-2">
                            <label for="search" class="col-sm-2 col-form-label">Buscar</label>
                            <div class="col-sm-8">
                                <input id="search" type="text" name="q" class="form-control" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>">
                            </div>
                        </div>
                        
                        
                        <div class="form-group mx-sm-2 mb-2">
                            <button type="submit" class="btn btn-light mb-2">Filtrar</button>
                        </div>
            
                        
                    </form>
                        
                    <!-- <br> -->
                    <?php } ?>

                </div>
                <!-- <div class="col col-lg-2">
                3 of 3
                </div> -->
            </div>


        <!-- linea -->
        <div class="progress">
            <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>


        </div>
    </div>
</div>




<br>



<?php
// echo $sql_where;
if ($sql_where == ""){
    $sql = "SELECT * from info_social_map where user_type = 2 ";
}else {
    $sql = "SELECT * from info_social_map WHERE $sql_where ";
}
?>




  


 <section class="showcase">
    <div class="container">
        <br><br>

        <div class="container">
            <div class="row padall border-bottom">
                <div class="col-lg-12">
                    <div class="table-responsive-sm">
                        <table id="render-data" class="table  table-bordered table-hover" style="width:100%">
                            <thead class="thead-dark">
                            <tr>
                                <!-- cantidad de columnas -->
                                <?php for ($i = 1; $i <= 58; $i++) {
                                    echo '<th></th>';
                                } ?>

                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>Ver</th>
                                    <th><!?php echo $date_pub; ?></th>
                                    <th>code_info</th>
                                    <th>line_action</th>
                                    <th>activity_title</th>
                                    <th>estate</th>
                                </tr>
                            </tfoot> -->
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br><br><br>










<script type="text/javascript">

var names = [
        'Id', 
        'User Id', 
        'Tipo de usuario', 
        'Progreso', 
        'Estado', 
        'Code_info', 
        'Responsable', 
        'Cantidad de comunas', 
        'Cantidad de CC',
        'Otras org en el entorno',
        'Otras org. relacionadas',
        'Actividades Q. realizan org. en el info',
        'Emprendimientos en el entorno del info',
        'Forma de apoyo a emprendimientos',
        'Ins. educ. niños con discapacidad',
        'Forma de apoyo a instituciones educ',
        'Potencialidades de la comunidad',
        'Familias en torno al infocentro',
        'Población en torno al infocentro',
        'Niños de 0 a 3',
        'Niños de 4 a 7',
        'Niños de 8 a 11',
        'Niños Adolescentes de 12 a 15',
        'Hombres Jóvenes de 16 a 19',
        'Hombres Jóvenes de 20 a 23',
        'Hombres Jóvenes de 24 a 27',
        'Hombres Jóvenes de 28 a 31',
        'Hombres adultos de 32 a 35',
        'Hombres adultos de 36 a 39',
        'Hombres adultos de 40 a 59',
        'Adultos mayores de 60 a 120',
        'Niñas de 0 a 3',
        'Niñas de 4 a 7',
        'Niñas de 8 a 11',
        'Niñas adolescentes de 12 a 15',
        'Mujeres jóvenes de 16 a 19',
        'Mujeres jóvenes de 20 a 23',
        'Mujeres jónes de 24 a 27',
        'Mujeres jóvenes de 28 a 31',
        'Mujeres adulatas de 32 a 35',
        'Mujeres adultas de 36 a 39',
        'Mujeres adultas de 40 a 59',
        'Adultas mayores de 60 a 120',
        'Niños/as con discapacidad',
        'Principal proveedor de internet',
        'Otro proveedor de internet',
        'Info en proyecto Comunidades Wifi',
        'Beneficiados de comunidades wifi',
        'Espacios formativos públicos',
        'Espacios formativos privados',
        'Cantidad de teléfonos inteligentes',
        'Cantidad de tablets',
        'Cantidad de canaimitas',
        'Cantidad de laptos',
        'Cantidad de PC de escritorio',
        'Cantidad de viviendas con internet',
        'Datos de disp',
        'Fecha del registro'

        
    ];

    var columns_array = [];
    var progress = [];

    // columns_array.push(
    //     {"width": "20%", "className":'details-control', "orderable":false, "data": null,"defaultContent": ''},
    // );
    
    // columns_array.push(
    //     {
    //         title: "Progreso", "className": "dt-body-center", "orderable":false,
    //         render: function (data, type, row, meta) {
    //             return type === 'display'
    //             ? '<progress value="' + 50 + '" max="9999"></progress>'
    //             : data;
    //         },
        
    //     },
    // );
    // console.log(progress);
    // progress = [];



    for (tt of names) {
        // console.log(tt);
        if (tt === 'Otras org en el entorno'){
            columns_array.push(
                {
                    render: function (data, type) {
                        // console.log(data);
                        if (type === 'display') {
                            // let link = 'http://datatables.net';
                            // return '<a href="' + link + '">' + data + '</a>';
                            if (data === '') {
                                return '<p class="text-danger">Falta este campo</p>';
                            }else{
                                progress.push(1);
                            }
                        }
                        return data;
                    },
                    title: tt, "width": "40%", "className": "dt-body-center", "orderable":false,
                },
            );
        
        }else if(tt === 'Otras org. relacionadas'){
            columns_array.push(
                {
                    render: function (data, type) {
                        if (type === 'display') {
                            if (data === '') {
                                return '<p class="text-danger">Falta este campo</p>';
                            }else{
                                progress.push(1);
                            }
                        }
                        return data;
                    },
                    title: tt, "width": "50%", "className": "dt-body-center", "orderable":false,
                },
            );
       
        }else if(tt === 'Actividades Q. realizan org. en el info'){
            columns_array.push(
                {
                    render: function (data, type) {
                        if (type === 'display') {
                            if (data === '') {
                                return '<p class="text-danger">Falta este campo</p>';
                            }else{
                                progress.push(1);
                            }
                        }
                        return data;
                    },
                    title: tt, "width": "40%", "className": "dt-body-center", "orderable":false,
                },
            );
       
        }else if(tt === 'Progreso'){
            

            columns_array.push(
                {
                    title: "Progreso", "className": "dt-body-center", "orderable":false,
                    render: function (data, type, row, meta) {
                        return type === 'display'
                        ? '<progress value="' + data + '" max="58"></progress>'
                        : data;
                    },
                
                },
            );
            console.log(progress);
            progress = [];

        }else{

            columns_array.push(
                {
                    render: function (data, type) {
                        if (type === 'display') {
                            if (data === '') {
                                return '<p class="text-danger">Falta este campo</p>';
                            }else{
                            progress.push(1);
                            }
                        }
                        return data;
                    },
                    title: tt, "className": "dt-body-center", "orderable":false,
                },
            );

        }
    }

    



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
        "autoWidth": false,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],

        // col hide
        columnDefs: [
            {
                targets: [ 0,1,2 ],
                visible: false
            }
        ],
   

        'serverMethod': 'post',
        "ajax": `core/app/view/datatable_report.php?sql=<?php echo $sql;?>`,
        dom: 'lBfrtip',

        
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
            //     extend:    'excelHtml5',
            //     text:      '<i class="fa fa-file-excel-o"></i>',
            //     titleAttr: 'Excel',
            //     exportOptions: {
            //     // columns: ':visible'
            //     }
            // },

            // {
            //     extend: 'excel',
            //     exportOptions: {
            //     // columns: ':visible'
            //     }
            // },



            // {
            // "extend": 'excel',
            // "text": '<button class="btn btn-outline-primary"><i class="fa fa-file-excel-o" style="color: green;"></i>  Exportar todo</button>',
            // "titleAttr": 'Excel',
            // "action": newexportaction
            // }

        ],

        columns: columns_array,
        // columns: [
        // {"width": "20%", "className":'details-control', "orderable":false, "data": null,"defaultContent": ''},
        // {data: "date_pub", "width": "10%", "className": "dt-body-center", "orderable":false,
        
        //     render: function (data, type) {
        //         // console.log(data);
        //         if (type === 'display') {
        //             let link = 'http://datatables.net';

        //             if (data[0] < 'H') {
        //                 link = 'http://cloudtables.com';
        //             } else if (data[0] < 'S') {
        //                 link = 'http://editor.datatables.net';
        //             }

        //             return '<a href="' + link + '">' + data + '</a>';
        //         }

        //         return data;
        //     },
        
        // },

        // {data: "code_info", "width": "10%", "className": "dt-body-center", "orderable":false },
        // {data: "line_action", "width": "10%", "className": "dt-body-center", "orderable":false },
        // {data: "activity_title", "width": "60%", "className": "dt-body-center", "orderable":false },
        // {data: "estate", "width": "10%", "className": "dt-body-center", "orderable":false }
        // ],


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
