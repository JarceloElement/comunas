
<?php 
date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");




// try {
//     $database_name     = 'info_app';
//     $database_user     = 'infoadmin';
//     $database_password = 'infoadmin2050';
//     $database_host     = '192.99.147.218';

//     $pdo = new PDO('mysql:host=' . $database_host . '; dbname=' . $database_name, $database_user, $database_password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
//     $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);          

//     $sql = "SELECT * from reports WHERE is_active=1 and status_activity=0 ";           

//     $stmt = $pdo->prepare($sql);
//     $stmt->execute();
   
//     $data = [];

//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {          
//          $data[] = $row;  
//     } 

//    $response         = [];
//    $response['data'] =  $data;

//    echo json_encode($response, JSON_PRETTY_PRINT);

// } catch (PDOException $e) {
//     echo 'Database error. ' . $e->getMessage();
// }


$con = Database::getCon();
// $con = Database::getPDO();

$search_region = $_GET["estado"];
$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

$CantidadMostrar=50;
$url_pag_atras = "";
$url_pag_adelante = "";

// Validado  la variable GET
$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ 
  if( (isset($_GET["estado"]) && $_GET["estado"] != "")){
    $sql_json = "SELECT * from reports WHERE is_active=1 and status_activity=0 and estate='".$_GET["estado"]."' order by date_pub LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
    $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0 and estate='".$_GET["estado"]."'";
  }else {
    $sql_json = "SELECT * from reports WHERE is_active=1 and status_activity=0 order by date_pub LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
    $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0";
  }
} else if ($_SESSION["user_type"] == 8){ 
  $sql_json = "SELECT * from reports WHERE is_active=1 and status_activity=0 and estate='".$user_region."' LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
  $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0 and estate='".$user_region."' ";
}else {
  $sql_json = "SELECT * from reports WHERE is_active=1 and status_activity=0 and user_id='".$user_id."' LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;  
  $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity=0 and user_id='".$user_id."' ";  
}
$url_pag = "<a href=\"?view=planning_calendar&pag=";

$total = ReportActivityData::getBySQL($sql_dow);

$TotalReg = count($total);
$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);




$stmt = $con->prepare($sql_json);
$stmt->execute();
$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
// $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo= json_encode($data, JSON_PRETTY_PRINT);
$hoy = date("Y-m-d");
$anyo = date('Y', strtotime($hoy));
$mes = date('m', strtotime($hoy));
$f_inicio = date($anyo."-".$mes."-"."01");

$event = array();
foreach($data as $row){
    $date = explode("/",$row["date_pub"]);
    $hour = explode("/",$row["hour_activity"]);
    $row["extendedProps"] = $row["code_info"];
    $row["extendedProps"] = $row["line_action"];
    $row["id"] = $row["id"];
    $row["title"] = $row["activity_title"];
    $row["start"] = date("Y-m-d", strtotime($date[0]))."T".date("H:i:s", strtotime($hour[0]));
    $row["end"] = date("Y-m-d", strtotime($date[1]))."T".date("H:i:s", strtotime($hour[1]));
    $row["hour_start"] = date("H:i:s", strtotime($hour[0]));
    $row["hour_end"] = date("H:i:s", strtotime($hour[1]));

    if ($row["line_action"] == "Infocentro adentro" || $row["line_action"] == "Participación digital"){
      $row["color"] = "#f79e05";
    }else if ($row["line_action"] == "Formación a la medida" || $row["line_action"] == "Comunidades de aprendizaje"){
      $row["color"] = "#f72acb";
    }else if ($row["line_action"] == "Tejiendo redes" || $row["line_action"] == "Medios digitales"){
      $row["color"] = "#005af5";
    }else if ($row["line_action"] == "Unidades socio-productivas" || $row["line_action"] == "Acceso abierto"){
      $row["color"] = "#0eab74";
    }else if ($row["line_action"] == "Sistematización de Experiencias"){
      $row["color"] = "#d90d73";
    }
    $event[] = $row;
}

$events = json_encode($event);
// echo date("H:i:s", strtotime("10:30"));

    
?>


<?php if($TotalReg>0){ ?>



<center>

<?php

/*Sector de Paginacion */

//Operacion matematica para boton siguiente y atras 
$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
$DecrementNum =(($compag -1))<1?1:($compag -1);

echo $url_pag.$DecrementNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-left\"></i> </a>";

//Se resta y suma con el numero de pag actual con el cantidad de 
//numeros  a mostrar
$Desde=$compag-(ceil($CantidadMostrar/2)-1);
$Hasta=$compag+(ceil($CantidadMostrar/2)-1);
  
//Se valida
$Desde=($Desde<1)?1: $Desde;
$Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
//Se muestra los numeros de paginas
for($i=$Desde; $i<=$Hasta;$i++){
  //Se valida la paginacion total
  //de registros
  if($i<=$TotalRegistro){
    //Validamos la pag activo
    if($i==$compag){
      echo $url_pag.$i."\" class=\"btn btn-primary btn-sm\"active\">".$i."  </a>";
    }else {
      echo $url_pag.$i."\" class=\"btn btn-info btn-sm\">".$i."  </a>";
    }     		
  }
}
  
// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";
echo $url_pag.$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


?>

<div class="col-md-12">
  <div class="form-group text_label">
      <?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió en ".$TotalRegistro." partes para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br>"; ?>
  </div>
</div>

</center>

<?php } ?>







<div id="cover-spin"></div>

<div class="col-md-12">

    <div class="card">
        <div class="card-content table-responsive">
            <div class="card-body">


            <div id='calendar'></div>


            </div>
        </div class="card-content table-responsive">
    </div>
</div>






<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'es',
      initialDate: '<?php echo $f_inicio; ?>',
      // initialView: 'timeGridWeek',
      initialView: 'dayGridMonth',
      


      headerToolbar: {
        left: 'prev,next,today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listMonth'
        // right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },

      height: 'auto',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      selectMirror: true,
      nowIndicator: true,
      eventColor: '#378006',
      eventDisplay: 'block',

      dayMaxEventRows: true, // for all non-TimeGrid views
      views: {
        timeGrid: {
          dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
        },
        dayGrid: {
          dayMaxEventRows: 3
        }
      },

      events: <?php echo $events; ?>,

    //   events: [
    //     {
    //       title: 'All Day Event XXXXXX',
    //       start: '2023-06-30',
    //       color: '#B300A9'
    //     },
    //     {
    //       title: 'Long Event',
    //       start: '2023-01-07',
    //       end: '2023-01-10'
    //     },
    //     {
    //       groupId: 999,
    //       title: 'Repeating Event',
    //       start: '2023-01-09T16:00:00'
    //     },
    //     {
    //       groupId: 999,
    //       title: 'Repeating Event',
    //       start: '2023-01-16T16:00:00'
    //     },
    //     {
    //       title: 'Conference',
    //       start: '2023-01-11',
    //       end: '2023-01-13'
    //     },
    //     {
    //       title: 'Meeting',
    //       start: '2023-01-12T10:30:00',
    //       end: '2023-01-12T12:30:00'
    //     },
    //     {
    //       title: 'Lunch',
    //       start: '2023-01-12T12:00:00'
    //     },
    //     {
    //       title: 'Meeting',
    //       start: '2023-01-12T14:30:00'
    //     },
    //     {
    //       title: 'Happy Hour',
    //       start: '2023-01-12T17:30:00'
    //     },
    //     {
    //       title: 'Dinner',
    //       start: '2023-01-12T20:00:00'
    //     },
    //     {
    //       title: 'Birthday Party',
    //       start: '2023-01-13T07:00:00'
    //     },
    //     {
    //       title: 'Click for Google',
    //       url: 'http://google.com/',
    //       start: '2023-01-28'
    //     }
    //   ],






      eventResize: function(info) {

        var id = info.event.id;
        var start = moment(info.event.start).format('DD-MM-Y');
        var end = "";
        var hour_ini = moment(info.event.start).format('H:MM');
        var hour_end = moment(info.event.end).format('H:MM');
        // alert(hour_ini);

        if (info.event.end === null){
          end = moment(info.event.start).format('DD-MM-Y');
        }else{
          end = moment(info.event.end).format('DD-MM-Y');
        }

        if (!confirm("¿Quieres cambiar la fecha de ese evento?")) {
          info.revert();
        }else{
          updateDate(id,start,end,hour_ini,hour_end);
        }
     
      },



      eventClick: function(info) {
        alert(toUnicodeVariant('INFOCENTRO: ', 'bold sans', 'bold')+info.event.extendedProps.code_info+'\n'+toUnicodeVariant('LINEA: ', 'bold sans', 'bold')+info.event.extendedProps.line_action+'\n'+toUnicodeVariant('ACTIVIDAD: ', 'bold sans', 'bold')+ info.event.title +"\n"+ toUnicodeVariant('INICIA: ', 'bold sans', 'bold')+moment(info.event.start).format('DD-MM-Y'));
        // alert('Clicked on: ' + info.event.start);
        // alert('Clicked on: ' + info.event.startStr);
        
        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        // alert('View: ' + info.view.type);

        // change the border color just for fun
        info.el.style.borderColor = 'red';
      },



      eventDrop: function(info) {
        var id = info.event.id;
        var start = moment(info.event.start).format('DD-MM-Y');
        var end = "";
        var hour_ini = moment(info.event.start).format('H:MM');
        var hour_end = moment(info.event.end).format('H:MM');

        if (info.event.end === null){
          end = moment(info.event.start).format('DD-MM-Y');
        }else{
          end = moment(info.event.end).format('DD-MM-Y');
        }

        if (!confirm("¿Quieres cambiar la fecha de ese evento?")) {
          info.revert();
        }else{
          updateDate(id,start,end,hour_ini,hour_end);
        }
      },



      dateClick: function(info) {
        // alert('Clicked on: ' + info.dateStr);
        
        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        // alert('Current view: ' + info.view.type);
        // change the day's background color just for fun
        // info.dayEl.style.backgroundColor = 'red';
      },


      eventMouseEnter: function(info) {
        // alert('Clicked on: ' + info.dateStr);
        
        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        // alert('Current view: ' + info.view.type);
        // change the day's background color just for fun
        // info.dayEl.style.backgroundColor = 'red';
      },



      


    });











    calendar.render();
  });




function updateDate(id,start,end,hour_ini,hour_end){


  $('#cover-spin').show(0);

  $.ajax({
      type: "POST",
      url: "./?action=ajax",
      // headers: {
      //     "X-CSRFToken": getCookie("csrftoken")
      // },
      data: {
          function: "update_date",
          id: id,
          start: start,
          end: end,
          hour_ini: hour_ini,
          hour_end: hour_end
      }
  })
  .done(function( msg ) {
      if (getOS() == "Android"){
          alert("Actividad guardada");
      }else {
          toastify('Actividad guardada',true,5000,"dashboard");
      }
      $('#cover-spin').hide(0);
      
  })
  .fail(function(err) {
      if (getOS() == "Android"){
          alert("Ocurrió un error al guardar, intenta nuevamente");
      }else {
          toastify('Ocurrió un error al guardar, intenta nuevamente',true,5000,"warning");
      }

      $('#cover-spin').hide(0);
  });
  // .always(function() {
  //     toastify('Finished',true,1000,"warning");
  // });





};



function toUnicodeVariant(str, variant, flags) {
    const offsets = {
        m: [0x1d670, 0x1d7f6],
        b: [0x1d400, 0x1d7ce],
        i: [0x1d434, 0x00030],
        bi: [0x1d468, 0x00030],
        c: [0x1d49c, 0x00030],
        bc: [0x1d4d0, 0x00030],
        g: [0x1d504, 0x00030],
        d: [0x1d538, 0x1d7d8],
        bg: [0x1d56c, 0x00030],
        s: [0x1d5a0, 0x1d7e2],
        bs: [0x1d5d4, 0x1d7ec],
        is: [0x1d608, 0x00030],
        bis: [0x1d63c, 0x00030],
        o: [0x24B6, 0x2460],
        p: [0x249C, 0x2474],
        w: [0xff21, 0xff10],
        u: [0x2090, 0xff10]
    }

    const variantOffsets = {
        'monospace': 'm',
        'bold': 'b',
        'italic': 'i',
        'bold italic': 'bi',
        'script': 'c',
        'bold script': 'bc',
        'gothic': 'g',
        'gothic bold': 'bg',
        'doublestruck': 'd',
        'sans': 's',
        'bold sans': 'bs',
        'italic sans': 'is',
        'bold italic sans': 'bis',
        'parenthesis': 'p',
        'circled': 'o',
        'fullwidth': 'w'
    }

    // special characters (absolute values)
    var special = {
        m: {
            ' ': 0x2000,
            '-': 0x2013
        },
        i: {
            'h': 0x210e
        },
        g: {
            'C': 0x212d,
            'H': 0x210c,
            'I': 0x2111,
            'R': 0x211c,
            'Z': 0x2128
        },
        o: {
            '0': 0x24EA,
            '1': 0x2460,
            '2': 0x2461,
            '3': 0x2462,
            '4': 0x2463,
            '5': 0x2464,
            '6': 0x2465,
            '7': 0x2466,
            '8': 0x2467,
            '9': 0x2468,
        },
        p: {},
        w: {}
    }
    //support for parenthesized latin letters small cases 
    for (var i = 97; i <= 122; i++) {
        special.p[String.fromCharCode(i)] = 0x249C + (i - 97)
    }
    //support for full width latin letters small cases 
    for (var i = 97; i <= 122; i++) {
        special.w[String.fromCharCode(i)] = 0xff41 + (i - 97)
    }

    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    const numbers = '0123456789';

    var getType = function (variant) {
        if (variantOffsets[variant]) return variantOffsets[variant]
        if (offsets[variant]) return variant;
        return 'm'; //monospace as default
    }
    var getFlag = function (flag, flags) {
        if (!flags) return false
        return flags.split(',').indexOf(flag) > -1
    }

    var type = getType(variant);
    var underline = getFlag('underline', flags);
    var strike = getFlag('strike', flags);
    var result = '';

    for (var k of str) {
        let index
        let c = k
        if (special[type] && special[type][c]) c = String.fromCodePoint(special[type][c])
        if (type && (index = chars.indexOf(c)) > -1) {
            result += String.fromCodePoint(index + offsets[type][0])
        } else if (type && (index = numbers.indexOf(c)) > -1) {
            result += String.fromCodePoint(index + offsets[type][1])
        } else {
            result += c
        }
        if (underline) result += '\u0332' // add combining underline
        if (strike) result += '\u0336' // add combining strike
    }
    return result
}


</script>


<style>
      #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
  
  
  @media screen and (max-width: 767px) {
    .fc-toolbar.fc-header-toolbar {
      flex-direction: column;
      order: 2;
    }
    .fc-toolbar-chunk {
      display: table-row;
      text-align: center;
      padding: 5px 0;
    }
  }
</style>