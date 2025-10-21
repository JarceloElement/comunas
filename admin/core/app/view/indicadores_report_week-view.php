
<?php


$con = Database::getCon();
$query = $con->query("SELECT * FROM estados ");
$query_all_1 = $con->query("SELECT * FROM reports ");

$person_fe = 0;
$person_ma = 0;
$report_part = 0;
$report_no_part = 0;

// TOTAL REPORTES | CON SIN ESTADO
$total_by_states_all = $query_all_1->num_rows;
// echo ("TOTAL REPORTES: ".$total_by_states_all);

// REPORTES SIN ESTADO
foreach ($query_all_1 as $row_all_1){
  if ($row_all_1['estate'] == ''){
    $no_estate_list[] = $row_all_1['id'];
  }
}

if (isset($no_estate_list)){
// $no_estate_list_total = implode(",",$no_estate_list);
echo "REPORTES SIN ESTADO: ".count($no_estate_list)." -- ";
// echo $no_estate_list_total;
// =============
}







// RECORRE LOS ESTADOS =>
if(isset($query) && $query!=null){
  foreach ($query as $row){
    $states[] = $row['estado'];


    // REPORTES SIN ESTADO
    // $query_bugs = $con->query("SELECT * FROM reports WHERE estate = '' ");
    // foreach ($query_bugs as $row_all_1){
    //   // if ($row_all_1['estate'] != '' && $row_all_1['estate'] == $row['estado']){
    //     echo $row_all_1['code_info'].", ";
    //   // }
    // }



    $date_now = date('d-m-Y');
    $date_past = strtotime('-7 day', strtotime($date_now));
    $date_past = date('d-m-Y', $date_past);


    $query_all = $con->query("SELECT * FROM reports a INNER JOIN estados b ON a.estate=b.estado WHERE b.estado='".$row['estado']."' and ( STR_TO_DATE( SUBSTRING_INDEX(a.date_pub,'/',1), '%d-%m-%Y' )>= STR_TO_DATE('".$date_past."', '%d-%m-%Y')"." ) ");
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

        if ($row_all['estate'] != $row['estado']){
          echo $row_all['code_info'];
        }

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
  }
}

// arreglo las labels de los estados
foreach ($states_all as $st){
  $state_labels[] = "'".$st."'";
}






// $total_states_all = implode(", ",$total_by_states_all);


$state_labels = implode(",",$state_labels);
$total_states = implode(", ",$total_by_states);



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
for (var counter1 = 0; counter1 < <?php echo sizeof($states_all); ?>; counter1++) {
  state_colors.push(ColorCode());
}

//The ColorCode() will give the code every time.
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
      text: 'Reportes de la semana actual | ' + '<?php echo array_sum( $total_by_states ); ?>',
    },
  },

  plugins: [ChartDataLabels],
  options:{
    indexAxis: 'y',
  }


});





}

</script>

<!-- <canvas id="myChart" width="400" height="400"></canvas> -->


<canvas id="bar-chart-horizontal" width="800" height="450"></canvas>

<canvas id="bar-chart-grouped" width="800" height="450"></canvas>
<canvas id="bar-chart-grouped-partipants" width="800" height="450"></canvas>

<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>




