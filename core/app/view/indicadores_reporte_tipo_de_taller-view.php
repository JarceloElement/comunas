<?php

$con = Database::getCon();
$workshop_types = $con->query("SELECT * FROM tipo_taller");

$pg_base = new DatabasePg();
$pg_con = $pg_base->connectPg();


$pie_chart_labels = array();

if (isset($workshop_types) && $workshop_types != null) {

    $query = "SELECT estate";
    foreach ($workshop_types as $row) {
        $query .= ',count(case when tipo_taller=\'' . $row['nombre_taller'] . '\' then 1 end) as "' . $row['nombre_taller'] . '" ';
        array_push($pie_chart_labels, "'" . $row['nombre_taller'] . "'");

    }
    $query .= " FROM reports WHERE estate!='null' GROUP BY estate";
}

$reports_by_state = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);


$pie_chart_labels = implode(", ", $pie_chart_labels);
$reports_in_general = [];

foreach ($reports_by_state as $row) {
    foreach ($row as $key => $value) {
        if (!isset($reports_in_general[$key]) && $key != "estate") {
            $reports_in_general[$key] = 0;
        }

        if ($value != null && $key != "estate") {
            $reports_in_general[$key] += $value;
        }
    }
}

$reports_in_general = implode(",", $reports_in_general);

?>
<script>
    $(document).ready(function () {

        $(function () {
            $('#table-report').DataTable({

            })

            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            })

        })

        $.extend($.fn.dataTable.defaults, {


            // Display
            dom: '<Bfl>rti<p>',


            lengthMenu: [ // https://datatables.net/examples/advanced_init/length_menu.html
                [10, 25, 50, -1],
                [10, 25, 50, "Todo"],
            ],


            language: {
                search: '_INPUT_',
                searchPlaceholder: 'Filtrar resultados de la página', // https://datatables.net/reference/option/language.searchPlaceholder

                select: {
                    rows: {
                        _: '| %d filas seleccionadas',
                        0: '| clic en la fila para seleccionar',
                        1: '| 1 fila seleccionada'
                    }
                },

                info: '_START_-_END_ de _TOTAL_', // https://datatables.net/examples/basic_init/language.html
                lengthMenu: 'Filas por páginas _MENU_',
                infoEmpty: '0 de _MAX_',
                infoFiltered: '| de un total de _MAX_',
                paginate: {
                    first: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M18.41 16.59L13.82 12l4.59-4.59L6l-6 6 6 6zM6 6h2v12H6z"/></svg>',
                    previous: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.4141z"/></svg>',
                    next: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/></svg>',
                    last: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M5.59 7.41L10.18 12l-4.59 4.59L7 18l6-6-6-6zM6h2v12h-2z"/></svg>'
                },

                decimal: ',',
                thousands: '.',
                zeroRecords: 'No hay registros',

            },
            // Data display
            colReorder: true,
            fixedHeader: true,
            ordering: true,
            paging: true,
            pageLength: 50,
            pagingType: 'full', // https://datatables.net/reference/option/pagingType
            responsive: false,
            searching: true,
            stateSave: true,
            select: {
                style: 'multi+shift', // https://datatables.net/reference/option/select.style
                className: 'table-active' // https://datatables.net/reference/option/select.className

            },


            buttons: {
                buttons: [{
                    extend: 'print',
                    text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z"/></svg>',
                    className: 'btn-icon',
                    attr: {
                        title: 'Imprimir página',
                        'data-toggle': 'tooltip'
                    }
                },
                {
                    extend: 'excel',
                    text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M14 2H6C4.89 2 4 2.9 4 4V20C4 21.11 4.89 22 6 22H18C19.11 22 20 21.11 20 20V8L14 2M18 20H6V4H13V9H18V20M12.9 14.5L15.8 19H14L12 15.6L10 19H8.2L11.1 14.5L8.2 10H10L12 13.4L14 10H15.8L12.9 14.5Z"/></svg>',
                    className: 'btn-icon',
                    attr: {
                        title: 'Exportar a Excel',
                        'data-toggle': 'tooltip'
                    }
                },
                {
                    extend: 'pdf',
                    download: 'open',
                    text: '<svg class="dataTables-svg" viewBox="0 0 24 24"><path d="M14,2L20,8V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V4A2,2 0 0,1 6,2H14M18,20V9H13V4H6V20H18M10.92,12.31C10.68,11.54 10.15,9.08 11.55,9.04C12.95,9 12.03,12.16 12.03,12.16C12.42,13.65 14.05,14.72 14.05,14.72C14.55,14.57 17.4,14.24 17,15.72C16.57,17.2 13.5,15.81 13.5,15.81C11.55,15.95 10.09,16.47 10.09,16.47C8.96,18.58 7.64,19.5 7.1,18.61C6.43,17.5 9.23,16.07 9.23,16.07C10.68,13.72 10.9,12.35 10.92,12.31M11.57,13.15C11.17,14.45 10.37,15.84 10.37,15.84C11.22,15.5 13.08,15.11 13.08,15.11C11.94,14.11 11.59,13.16 11.57,13.15M14.71,15.32C14.71,15.32 16.46,15.97 16.5,15.71C16.57,15.44 15.17,15.2 14.71,15.32M9.05,16.81C8.28,17.11 7.54,18.39 7.72,18.39C7.9,18.4 8.63,17.79 9.05,16.81M11.57,11.26C11.57,11.21 12,9.58 11.57,9.53C11.27,9.5 11.56,11.22 11.57,11.26Z"/></svg>',
                    className: 'btn-icon',
                    attr: {
                        title: 'Exportar a PDF',
                        'data-toggle': 'tooltip'
                    }
                }
                ],
                dom: {
                    container: {
                        // className: 'dt-buttons d-none d-md-flex flex-wrap'
                        className: 'dt-buttons d-md-flex flex-wrap'
                    },
                    buttonContainer: {},
                    button: {
                        className: 'btn'
                    }
                }
            },

        });

        $(function () {
            $('#datepicker-reports').daterangepicker({
                "showDropdowns": true,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],

                },
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "a",
                    "customRangeLabel": "Personalizado",
                    "weekLabel": "S",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                },
                "alwaysShowCalendars": true,
                "startDate": moment(),
            });

            $('#datepicker-reports').on("change", function (ev, picker) {

                var start_date = ev.target.value.split(" - ")[0].replaceAll("/", "-");
                var end_date = ev.target.value.split(" - ")[1].replaceAll("/", "-");

                document.getElementById("spinner").style.display = "inline-block";
                document.getElementById("table-report").style.display = "none";

                $.post({

                    url: "index.php?action=ajax&function=reports_by_workshop_type",
                    dataType: 'json',
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                    },
                    success: (response, data) => {

                        let table = $('#table-report').DataTable();
                        table.clear();
                        let productsByState = response.data;
                        let row = [];
                        productsByState.forEach(element => {
                            let total = 0;
                            Object.keys(element).forEach(key => {
                                row.push(element[key]);
                                //if the element[key] is integer
                                if (typeof (element[key]) == 'number') {
                                    total += element[key];
                                }
                            });

                            row.push(total);
                            table.row.add(row);
                            row = [];

                        });

                        table.draw(false);

                        document.getElementById("spinner").style.display = "none";
                        document.getElementById("table-report").style.display = "table";
                    }
                });
            });
        });


        var training_type_colors = [];
        for (var counter1 = 0; counter1 < <?php echo $workshop_types->num_rows ?>; counter1++) {
            training_type_colors.push(ColorCode());
        }

        function ColorCode() {
            var makingColorCode = '0123456789ABCDEF';
            var finalCode = '#';
            for (var counter = 0; counter < 6; counter++) {
                finalCode = finalCode + makingColorCode[Math.floor(Math.random() * 16)];
            }
            return finalCode;

        }


        const ctx = document.getElementById('myChart').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $pie_chart_labels; ?>],
                datasets: [{
                    label:"Tipos de talleres",
                    data: [<?php echo $reports_in_general; ?>],
                    backgroundColor: training_type_colors,
                    datalabels: {
                        color: 'white',
                        font: {
                        weight: 'bold',
                        size: '10'
                        },
                    }
                }]
            },
            plugins: [ChartDataLabels],

            options: {
                aspectRatio: 7 / 6,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                        color: 'rgb(152, 60, 187)'
                        }
                    },
                },
            }
        });

        // Datepicker para el filtrado de reportes
        $(function () {
            $('#datepicker').daterangepicker({
                "showDropdowns": true,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],

                },
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "a",
                    "customRangeLabel": "Personalizado",
                    "weekLabel": "S",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                },
                "alwaysShowCalendars": true,
                "startDate": moment(),
            });

            $('#datepicker').on("change", function (ev, picker) {

                var start_date = ev.target.value.split(" - ")[0].replaceAll("/", "-");
                var end_date = ev.target.value.split(" - ")[1].replaceAll("/", "-");

                myChart.destroy();
                document.getElementById("spinner").style.display = "inline-block";
                document.getElementById("myChart").style.display = "none";

                $.post({
                    url: "index.php?action=ajax&function=reports_by_workshop_type_in_general",
                    dataType: 'json',
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                    },
                    success: (response, data) => {
                        let chartData = response.data[0];

                        let chartCount = Array();
                        let chartLabels = Array();

                        let total_reports = 0;

                        Object.entries(chartData).forEach((key, count) => {
                            chartLabels.push(key[0]);
                            chartCount.push(key[1]);
                        });
                        // calculate sum using forEach() method
                        chartCount.forEach(sum => {
                            total_reports += parseInt(sum);
                        })
                        // console.log(total_reports);

                        document.getElementById("spinner").style.display = "none";
                        document.getElementById("myChart").style.display = "block";
                        myChart = new Chart(document.getElementById("myChart"), {
                            type: 'bar',
                            data: {
                                labels: [<?php echo $pie_chart_labels; ?>],
                                datasets: [{
                                    label:"Tipos de talleres",
                                    backgroundColor: training_type_colors,
                                    data: chartCount,
                                    datalabels: {
                                        color: 'white',
                                        font: {
                                        weight: 'bold',
                                        size: '10'
                                        },
                                    }
                                }]
                            },
                            plugins: [ChartDataLabels],

                            options: {
                                aspectRatio: 7 / 6,
                                indexAxis: 'y',
                                plugins: {
                                    legend: {
                                        display: true,
                                        labels: {
                                        color: 'rgb(152, 60, 187)'
                                        }
                                    },
                                },
                            }
                        });
                    }
                });
            });
        });

    });
</script>


<style>
    .dataTables_wrapper .bottom {
        -ms-flex-align: center;
        align-items: center;
        border-top: 0px solid #e1e1e1;
        display: -ms-flexbox;
        display: flex;
        min-height: 52px;
        /* padding: 0 2px 0 35%; */
    }

    .dataTables_info {
        text-align: center;
        padding: 10px;
    }

    .dataTables_paginate {
        display: flex;
        justify-content: center;
    }
</style>


<br>
<br>
<div class="offset-md-1 col-10 mb-5">
    <ul class="nav nav-justified nav-tabs" id="justifiedTab" role="tablist">
        <li class="nav-item justify-content-center" role="presentation">
            <button aria-controls="estates" aria-selected="true" class="nav-link active" data-toggle="tab"
                data-target="#estates" id="estates-tab" type="button" role="tab">Estados</button>
        </li>
        <li class="nav-item justify-content-center" role="presentation">
            <button aria-controls="national" aria-selected="false" class="nav-link" data-toggle="tab"
                data-target="#national" id="national-tab" type="button" role="tab">Nacional</button>
        </li>
    </ul>
</div>

<div class="tab-content" id="justifiedTabContent">
    <div aria-labelledby="estates-tab" class="tab-pane fade show active" id="estates" role="tabpanel">
        <div class="content">
            <div class="container">
                <h4 class="text-center mb-4 mt-2">Tipos de talleres</h4>
                <div class="form-group">
                    <label for="fecha" class="control-label"><i class="fa fa-calendar"></i> Fecha de la
                        actividad</label>
                    <input type="text" name="fecha" required class="form-control" id="datepicker-reports"
                        placeholder="Fecha">
                </div>

                <div class="card">
                    <div class="card-content table-responsive">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table" id="table-report">

                                        <thead>
                                            <tr>
                                                <th scope="col">Estado</th>
                                                <?php foreach ($workshop_types as $row) { ?>
                                                    <th scope="col"><?= $row['nombre_taller'] ?></th>
                                                <?php } ?>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <?php foreach ($reports_by_state as $row) {
                                                $total = 0;
                                                ?>
                                                <tr>
                                                    <?php foreach ($row as $key => $value) { ?>
                                                        <td><?= $value ?></td>
                                                        <?php

                                                        if (gettype($value) == 'integer' || $value == 'float') {
                                                            $total += $value;
                                                        }
                                                    } ?>
                                                    <td><?= $total ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!-- spinner -->
                                    <div class="text-center">
                                        <div class="spinner-border text-primary mx-auto mb-5" id="spinner"
                                            style="width: 200px;height:200px;display:none;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <!-- end spinner -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div aria-labelledby="national-tab" class="tab-pane fade" id="national" role="tabpanel">
        <div class="offset-md-1 col-md-10">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Tipos de talleres en general</h5>
                    <div class="text-center">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="fecha" class="control-label"><i class="fa fa-calendar"></i> Fecha de la
                                    actividad</label>
                                <input type="text" name="fecha" required class="form-control" id="datepicker"
                                    placeholder="Fecha">
                            </div>
                        </div>
                    </div>
                    <!-- canvas -->
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <!-- spinner -->
                    <div class="text-center">
                        <div class="spinner-border text-primary mx-auto mb-5" id="spinner"
                            style="width: 200px;height:200px;display:none;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <!-- end spinner -->
                    <button class="btn btn-outline-dark" id="reportsImageExport">Exportar PNG</button>
                </div>
                </div>
            <br>
        </div>
    </div>

</div>