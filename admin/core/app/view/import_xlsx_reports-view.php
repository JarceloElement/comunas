
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

<br>
<br>
<br>
<label for="file">Progreso de la subida:</label>
<!-- <progress id="file" value="0" max="100"></progress> -->



<div class="progress">
  <div class="progress-bar" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    /* DOM is ready, so we can query for its elements */
})

function setProgress(total,progress){
    var prog = Math.round(progress*100/total);
    // document.getElementById("file").value = prog;
    // console.log(prog);

    var bar = document.querySelector(".progress-bar");
    bar.innerText = prog.toString() + '%';
    document.getElementById('progressbar').style.width = prog.toString() + '%';

}

</script>




<?php
use Shuchkin\SimpleXLSX;

$debug= false;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once __DIR__.'/assets/simplexlsx-master/src/SimpleXLSX.php';


$conn = Database::connectPDO();

$code_info = "";


// insertar
    $stmt_insert = $conn->prepare( "INSERT INTO info_inventory (
    estado, 
    code_info, 
    desc_pc, 
    t_pc_asig,
    t_pc_ope,
    t_pc_inope,
    causa_pc_inop,
    desc_impresora,
    t_impresora,
    t_imp_ope,
    t_imp_inop,
    t_escrit_ope,
    t_escrit_inop,
    t_escrit,
    t_sillas_ope,
    t_silas_inop,
    t_sillas,
    t_aires_ope,
    t_aires_inop,
    t_aires
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    
if (isset($_FILES['info_process'])) {
   
    if ( $xlsx = SimpleXLSX::parse( $_FILES['info_process']['tmp_name'] ) ) {
      
        $array_fields_name = array();
        
        foreach ($xlsx->rows() as $k => $fields){
            if ($k == 0){
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | id
            $param = ( isset($fields[0]) ? $fields[0] : '' );
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1]-1;

            // echo $param;
            // return;

            if( !empty($param) ){

                $r = ReportActivityData::getById($param);

                if(isset($r)!=1){

                    // for ($i = 0; $i < $cols-1; $i ++) {
                    //     $array_fields[] = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : '' );
                    //     // echo ($i+1)."-- ".$array_fields[$i]." --".$code."<br>";
                    // }

                    // $stmt_insert->bindParam(1, $array_fields[1]);
                    // $stmt_insert->bindParam(2, $array_fields[2]);
                    // $stmt_insert->bindParam(3, $array_fields[3]);
                    // $stmt_insert->bindParam(4, $array_fields[4]);
                    // $stmt_insert->bindParam(5, $array_fields[5]);
                    // $stmt_insert->bindParam(6, $array_fields[6]);
                    // $stmt_insert->bindParam(7, $array_fields[7]);
                    // $stmt_insert->bindParam(8, $array_fields[8]);
                    // $stmt_insert->bindParam(9, $array_fields[9]);
                    // $stmt_insert->bindParam(10, $array_fields[10]);
                    // $stmt_insert->bindParam(11, $array_fields[11]);
                    // $stmt_insert->bindParam(12, $array_fields[12]);
                    // $stmt_insert->bindParam(13, $array_fields[13]);

                    // $stmt_insert->execute();
                    // echo "Nuevo: ".$array_fields[2]."<br>";
                    // echo "<script>setProgress($total_xlsx,$k);</script>";
                        
                } else{
              
                    for ($i = 0; $i < $cols-1; $i ++) {
                        $array_fields[] = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : "" );
                        $val_field = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : "" );
                        $val_field = str_replace("'","",$val_field);
                        $data_field = $array_fields_name[$i+1];

                        if ( $data_field != "T_mujeres" && $data_field != "T_hombres" && $data_field != "id" && $val_field != $r->$data_field ){
                            // echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";

                            if ($data_field == "is_active"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "status_activity"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_id"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "line_action"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "report_type"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "activity_title"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "responsible_name"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "responsible_phone"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "responsible_type"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "responsible_dni"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "personal_type"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "date_pub"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "developed_content"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "training_modality"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "duration_days"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "duration_hour"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "institutions"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "name_os"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "observations"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "notific"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "estate"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "municipality"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "parish"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "city"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "address"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                        }

                    }
                    $r->update();

                    // echo "Update - ".$array_fields[2]."<br>";
                    echo "<script>setProgress($total_xlsx,$k);</script>";

                } 
            }

        }


    } else {
        echo SimpleXLSX::parseError();
    }
}

    
?>

