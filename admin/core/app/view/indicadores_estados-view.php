
<?php

$person_fe = 0;
$person_ma = 0;
$report_part = 0;
$report_no_part = 0;


$con = Database::getCon();
$query = $con->query("SELECT * FROM estados ");
// $query_all_1 = $con->query("SELECT * FROM reports ");



// TOTAL REPORTES | CON SIN ESTADO
// $total_by_states_all = $query_all_1->num_rows;
// echo ("TOTAL REPORTES: ".$total_by_states_all);

// REPORTES SIN ESTADO
// foreach ($query_all_1 as $row_all_1){
//   if ($row_all_1['estate'] == ''){
//     $no_estate_list[] = $row_all_1['id'];
//   }
// }

// if (isset($no_estate_list)){
// // $no_estate_list_total = implode(",",$no_estate_list);
// echo "REPORTES SIN ESTADO: ".count($no_estate_list)." -- ";
// // echo $no_estate_list_total;
// // =============
// }




$date_now = date('d-m-Y');
$date_past = strtotime('-6 day', strtotime($date_now));
$date_past = date('d-m-Y', $date_past);
// echo $date_past;

// RECORRE LOS ESTADOS =>
if(isset($query) && $query!=null){
  foreach ($query as $row){
    // $states[] = $row['estado'];


    // REPORTES SIN ESTADO
    // $query_bugs = $con->query("SELECT * FROM reports WHERE estate = '' ");
    // foreach ($query_bugs as $row_all_1){
    //   // if ($row_all_1['estate'] != '' && $row_all_1['estate'] == $row['estado']){
    //     echo $row_all_1['code_info'].", ";
    //   // }
    // }






    $query_all = $con->query("SELECT * FROM reports a INNER JOIN estados b ON a.estate=b.estado WHERE a.is_active=1 AND a.status_activity=1 and b.estado='".$row['estado']."' ");
    // $query_all = $con->query("SELECT * FROM reports WHERE estate='".$row['estado']."' ");
    $total_by_states[] = $query_all->num_rows;
    
    // TOTAL REPORTES X ESTADO
    if ($query_all->num_rows != 0){

      //  RECORRE LOS REPORTES =>
      foreach ($query_all as $row_all){
        // echo count($row_all['person_fe']);
        // $array = array(
        //   "Amazonas"  => $row['name']." ".$row['lastname'],
        //   "Anzoátegui"  => $row['phone_number'],
        //   "Apure"  => $row['document_number'],
        //   "Aragua"  => $row['email'],
        // );

        // if ($row_all['estate'] != $row['estado']){
        //   echo $row_all['code_info'];
        // }

        if ($row_all['estate'] != ""){
          $person_fe += $row_all['person_fe'];
          $person_ma += $row_all['person_ma'];
          $states_report = $row_all['estate'];

          // $no_state[] = $row_all['code_info'];
          // echo $row_all['estate'];

          // report_part
          if ( ($row_all['person_fe'] != 0 || $row_all['person_ma'] != 0) && ($row_all['person_fe'] != "" && $row_all['person_ma'] != "") ){
            $report_part += 1;

          }
          // report_no_part
          if ( ($row_all['person_fe'] == 0 && $row_all['person_ma'] == 0) || ($row_all['person_fe'] == "" && $row_all['person_ma'] == "") ){
            $report_no_part += 1;

          }

        }



      }
      // echo ($person_fe_ama);
      $person_fe_all[] = $person_fe;
      $person_ma_all[] = $person_ma;
      $states_all[] = $states_report;
      $total_rep_part[] = $report_part;
      $total_rep_no_part[] = $report_no_part;
      $person_fe = 0;
      $person_ma = 0;
      $report_part = 0;
      $report_no_part = 0;
      $states_report = "";

      // $no_estate_list[] = $code_info;

    }


    // REPORTES ULTIMA SEMANA
    $query_week = $con->query("SELECT * FROM reports a INNER JOIN estados b ON a.estate=b.estado WHERE b.estado='".$row['estado']."' and a.is_active=1 AND a.status_activity=1 and ( STR_TO_DATE( SUBSTRING_INDEX(a.date_pub,'/',1), '%d-%m-%Y' )>= STR_TO_DATE('".$date_past."', '%d-%m-%Y')"." ) ");
    $total_by_week[] = $query_week->num_rows;
    
    // TOTAL REPORTES X ESTADO
    if ($query_week->num_rows != 0){
      // echo $row['estado'];
      //  RECORRE LOS REPORTES =>
      foreach ($query_week as $row_all){
        // echo $row_all['code_info'];
        if ($row_all['estate'] != ""){
          $states_report_week = $row_all['estate'];
        }


      }
      $states_week[] = $states_report_week;
      $states_report_week = "";
    }



  }
}

// arreglo las labels de los estados
foreach ($states_all as $st){
  $state_labels[] = "'".$st."'";
}
foreach ($states_week as $st){
  $state_labels_week[] = "'".$st."'";
}






// $total_states_all = implode(", ",$total_by_states_all);


$state_labels_week = implode(",",$state_labels_week);
$state_labels = implode(",",$state_labels);
$total_states = implode(", ",$total_by_states);
$total_week = implode(", ",$total_by_week);



$total_person_fe = implode(", ",$person_fe_all);
$total_person_ma = implode(", ",$person_ma_all);

$total_report_part = implode(", ",$total_rep_part);
$total_report_no_part = implode(", ",$total_rep_no_part);
// echo ($total_report_part);
// echo ($total_report_no_part);
// echo "Mujeres ".array_sum($person_fe_all);


// echo $state_labels;
// echo sizeof($states_all);
// echo implode(", ",$no_state);






?>


<!-- <script src="assets/js/canvasjs.min.js"></script> -->
<!-- https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/#8-grouped-bar-chart -->


<script>
window.onload = function () {

	var Name = "Unknown OS";
	if (navigator.userAgent.indexOf("Win") != -1) Name = "Windows";
	if (navigator.userAgent.indexOf("Mac") != -1) Name = "Macintosh";
	if (navigator.userAgent.indexOf("Linux") != -1) Name = "Linux";
	if (navigator.userAgent.indexOf("Android") != -1) Name = "Android";
	if (navigator.userAgent.indexOf("like Mac") != -1) Name = "iOS";
	// console.log(Name);





var state_colors = [];
var state_colors_week = [];
for (var counter1 = 0; counter1 < <?php echo sizeof($states_all); ?>; counter1++) {
  state_colors.push(ColorCode());
  state_colors_week.push(ColorCode_week());
}

//The ColorCode() will give the code every time.
function ColorCode_week() {
    var makingColorCode = '0123456789ABCDEF';
    var finalCode = '#';
    for (var counter = 0; counter < 6; counter++) {
       finalCode =finalCode+ makingColorCode[Math.floor(Math.random() * 16)];
    }
    return finalCode;
    // return "#8c8c8c";
 }
function ColorCode() {
    var makingColorCode = '0123456789ABCDEF';
    var finalCode = '#';
    for (var counter = 0; counter < 6; counter++) {
       finalCode =finalCode+ makingColorCode[Math.floor(Math.random() * 16)];
    }
    // return finalCode;
    return "#8c8c8c";
 }











new Chart(document.getElementById("bar-chart-horizontal"), {

  type: 'bar',
  data: {
    labels: [<?php echo $state_labels; ?>],
    datasets: [
      {
        label: "Total reportes",
        backgroundColor: state_colors,
        data: [<?php echo $total_states; ?>],
        datalabels: {
          color: '#404040',
        },
      }
    ]
    
  },

  options: {
    indexAxis: 'y',
    // plugins: {

    // },

    scales: {
      y: {
          beginAtZero: true
      }
    },

    legend: { display: false },
    title: {
      display: true,
      text: 'Reportes por regiones | ' + '<?php echo array_sum( $total_by_states ); ?>',
    },
  },

  plugins: [ChartDataLabels],
  options:{
    indexAxis: 'y',
  }


});




// new Chart(document.getElementById("bar-chart-horizontal-week"), {

// type: 'bar',
// data: {
//   labels: [<?php echo $state_labels_week; ?>],
//   datasets: [
//     {
//       label: "Reportes última semana",
//       backgroundColor: state_colors_week,
//       data: [<?php echo $total_week; ?>],
//       datalabels: {
//         color: '#404040',
//       },
//     }
//   ]
  
// },

// options: {
//   indexAxis: 'y',
//   // plugins: {

//   // },

//   scales: {
//     y: {
//         beginAtZero: true
//     }
//   },

//   legend: { display: false },
//   title: {
//     display: true,
//     text: 'Reportes de la última semana | ' + '<?php echo array_sum( $total_by_week ); ?>',
//   },
// },

// plugins: [ChartDataLabels],
// options:{
//   indexAxis: 'y',
// }


// });









new Chart(document.getElementById("bar-chart-grouped"), {
  type: 'bar',
  data: {
    labels: [<?php echo $state_labels; ?>],
    datasets: [
      {
        minBarLength: 2,
        label: "Con participantes",
        backgroundColor: "#38ccac",
        data: [<?php echo $total_report_part; ?>],
        datalabels: {
          color: '#404040',
        }
      }, {
        minBarLength: 4,
        label: "Sin participantes",
        backgroundColor: "#c942cc",
        data: [<?php echo $total_report_no_part; ?>],
        datalabels: {
          color: '#c2c2c2',
        }
      }
      
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Reportes con participantes'
    }
  },
  plugins: [ChartDataLabels],

});



new Chart(document.getElementById("bar-chart-grouped-partipants"), {
  type: 'bar',
  data: {
    labels: [<?php echo $state_labels; ?>],
    datasets: [
      {
        label: "Mujeres",
        backgroundColor: "#c1068a",
        data: [<?php echo $total_person_fe; ?>],
        datalabels: {
          color: '#c2c2c2',
        }
      }, {
        label: "Hombres",
        backgroundColor: "#02cade",
        data: [<?php echo $total_person_ma; ?>],
        datalabels: {
          color: '#404040',
        }
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Participantes por regiones | ' + <?php echo array_sum( array_merge($person_fe_all,$person_ma_all) ); ?>
    }
  },
  plugins: [ChartDataLabels],

});












// const ctx = document.getElementById('myChart').getContext('2d');
// const myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         plugins: {
//           legend: {display: false}
//         },
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     },
//     plugins: [ChartDataLabels],
//       options:{}
// });





}

</script>

<!-- <canvas id="myChart" width="400" height="400"></canvas> -->


<!-- <canvas id="bar-chart-horizontal-week" width="800" height="450"></canvas> -->
<canvas id="bar-chart-horizontal" width="800" height="450"></canvas>

<canvas id="bar-chart-grouped" width="800" height="450"></canvas>
<canvas id="bar-chart-grouped-partipants" width="800" height="450"></canvas>

<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>




