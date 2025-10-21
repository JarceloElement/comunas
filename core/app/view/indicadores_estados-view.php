<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pg_base = new DatabasePg();
$pg_con = $pg_base->connectPg();

$query = "SELECT reports.estate, count(*) as total FROM reports WHERE is_active='1' AND status_activity='1' and DATETIME >= '2024-01-01' GROUP BY reports.estate ORDER BY total DESC";
$query_all = $pg_con->query($query);

$total_by_states_array = [];
$state_labels_array = [];

foreach($query_all as $row){
  $total_by_states_array[] = $row['total'];
  $state_labels_array[] = "'".$row['estate']."'";
}

$state_labels = implode(",", $state_labels_array);
$total_states = implode(", ", $total_by_states_array);

?>

<script>
  $(document).ready(function () {
    // GENERA COLORES ALEATORIOS CON EL TOTAL DE LA VARIABLE DADA
    var state_colors = [];
    for (var counter1 = 0; counter1 < <?php echo sizeof($state_labels_array); ?>; counter1++) {
      state_colors.push(ColorCode());
    }

    function ColorCode() {
      var makingColorCode = '0123456789ABCDEF';
      var finalCode = '#';
      for (var counter = 0; counter < 6; counter++) {
        finalCode = finalCode + makingColorCode[Math.floor(Math.random() * 16)];
      }
      // return finalCode;
      return "#0088DDFF";
    }

    var horizontalChart = new Chart(document.getElementById("bar-chart-horizontal"), {

      type: 'bar',
      data: {
        labels: [<?php echo $state_labels; ?>],
        datasets: [{
          label: "Reportes",
          backgroundColor: state_colors,
          data: [<?php echo $total_states; ?>],

          datalabels: {
            color: 'white',
            font: {
              weight: 'bold',
              size: '10'
            },
            // posicion label
            // align: 'start',
            // anchor: 'end'
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
          title: {
            display: true,
            text: 'Reportes por regiones | Total: ' + '<?php echo array_sum($total_by_states_array); ?>',
          }
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

        horizontalChart.destroy();
        document.getElementById("spinner").style.display = "inline-block";
        document.getElementById("bar-chart-horizontal").style.display = "none";

        $.post({
          url: "index.php?action=ajax&function=indicators",
          dataType: 'json',
          data: {
            start_date: start_date,
            end_date: end_date,
          },
          success: (response, data) => {
            // console.log(response.sql);
            let chartData = response.data;
            let chartEstates = Array();
            let chartCount = Array();
            let total_reports = 0;

            chartData.forEach((estate) => {
              chartEstates.push(estate[0]);
              chartCount.push(estate[1]);
            });
            // calculate sum using forEach() method
            chartCount.forEach(sum => {
              total_reports += parseInt(sum);
            })
            // console.log(total_reports);

            document.getElementById("spinner").style.display = "none";
            document.getElementById("bar-chart-horizontal").style.display = "block";
            horizontalChart = new Chart(document.getElementById("bar-chart-horizontal"), {

              type: 'bar',
              data: {
                labels: chartEstates,
                datasets: [{
                  label: "Reportes",
                  backgroundColor: "#56b2c4",
                  data: chartCount,

                  datalabels: {
                    color: 'white',
                    font: {
                      weight: 'bold'
                    }

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
                  title: {
                    display: true,
                    text: 'Reportes por regiones del ' + start_date + ' al ' + end_date + ' | Total: ' + total_reports,
                  }
                },

              }
            });
          }
        });
      });
    });

  });

</script>
<div class="offset-md-1 col-md-10">
  <!-- reportes por estados -->
  <div class="card text-center">
    <div class="card-body">
    <h5 class="card-title">Reportes por estado</h5>
      <div class="text-center">
        <div class="col-md-12 ">
          <div class="form-group">
            <label for="fecha" class="control-label"><i class="fa fa-calendar"></i> Fecha de la actividad</label>
            <input type="text" name="fecha" required class="form-control" id="datepicker" placeholder="Fecha">
          </div>
        </div>
      </div>
      <!-- canvas -->
      <canvas id="bar-chart-horizontal" width="400" height="400"></canvas>
      <!-- spinner -->
      <div class="text-center">
        <div class="spinner-border text-primary mx-auto mb-5" id="spinner"
          style="width: 200px;height:200px;display:none;" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- end spinner -->
      <br>
      <button class="btn btn-outline-dark" id="reportsImageExport">Exportar PNG</button>
    </div>
    <!-- <div class="card-footer text-muted">2 days ago</div> -->
  </div>
</div>
<br>