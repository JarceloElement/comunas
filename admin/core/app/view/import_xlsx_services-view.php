
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

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

$debug= true;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once __DIR__.'/assets/simplexlsx-master/src/SimpleXLSX.php';


$conn = Database::connectPDO();

// insertar
    $stmt_insert = $conn->prepare( "INSERT INTO services_users (
    user_id, 
    user_info_cod, 
    user_nombres, 
    user_apellidos, 
    user_dni, 
    user_correo, 
    user_telefono, 
    user_genero, 
    disability_type, 
    user_etnia, 
    user_f_nacimiento, 
    user_edad, 
    user_nivel_academ, 
    user_profesion, 
    user_empleado, 
    user_institucion, 
    user_estado, 
    user_municipio, 
    user_direccion, 
    user_tipo_servicio, 
    user_fecha_servicio, 
    user_name_os 
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    
if (isset($_FILES['info_process'])) {
   
    $name_os = $_POST['os'];
    if ( $xlsx = SimpleXLSX::parse( $_FILES['info_process']['tmp_name'] ) ) {
      
        $array_fields_name = array();
        
        foreach ($xlsx->rows() as $k => $fields){
            if ($k == 0){
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | DNI
            $param = ( isset($fields[5]) ? $fields[5] : '' );
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1]-1;

            // echo $param;
            // return;

            if( !empty($param) ){

                $r = ServicesUsersData::getRepeated($param);

                if(isset($r)!=1){

                    for ($i = 0; $i < $cols-1; $i ++) {
                        $array_fields[] = ( isset($fields[ $i ]) ? $fields[ $i ] : '' );
                        // echo ($i)."-- ".$array_fields[$i]." --".$array_fields[0]."<br>";
                        // return;
                    }

                    $user_f_nacimiento = date("Y-m-d", strtotime($array_fields[11]));
                    $user_fecha_servicio = date("Y-m-d", strtotime($array_fields[21]));

                    $stmt_insert->bindParam(1, $array_fields[1]);
                    $stmt_insert->bindParam(2, $array_fields[2]);
                    $stmt_insert->bindParam(3, $array_fields[3]);
                    $stmt_insert->bindParam(4, $array_fields[4]);
                    $stmt_insert->bindParam(5, $array_fields[5]);
                    $stmt_insert->bindParam(6, $array_fields[6]);
                    $stmt_insert->bindParam(7, $array_fields[7]);
                    $stmt_insert->bindParam(8, $array_fields[8]);
                    $stmt_insert->bindParam(9, $array_fields[9]);
                    $stmt_insert->bindParam(10, $array_fields[10]);
                    $stmt_insert->bindParam(11, $user_f_nacimiento);
                    $stmt_insert->bindParam(12, $array_fields[12]);
                    $stmt_insert->bindParam(13, $array_fields[13]);
                    $stmt_insert->bindParam(14, $array_fields[14]);
                    $stmt_insert->bindParam(15, $array_fields[15]);
                    $stmt_insert->bindParam(16, $array_fields[16]);
                    $stmt_insert->bindParam(17, $array_fields[17]);
                    $stmt_insert->bindParam(18, $array_fields[18]);
                    $stmt_insert->bindParam(19, $array_fields[19]);
                    $stmt_insert->bindParam(20, $array_fields[20]);
                    $stmt_insert->bindParam(21, $user_fecha_servicio);
                    $stmt_insert->bindParam(22, $name_os);

                    $stmt_insert->execute();
                    echo "<span style='color:blue;'>Nuevo:</span> DNI: ".$array_fields[5]." - ".$array_fields[3]."<br>";
                    echo "<script>setProgress($total_xlsx,$k);</script>";
                } else{
              
                    for ($i = 0; $i < $cols-1; $i ++) {
                        $array_fields[] = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : "" );
                        $val_field = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : "" );
                        $val_field = str_replace("'","",$val_field);
                        $data_field = $array_fields_name[$i+1];

                        if ( $data_field == "user_f_nacimiento"){
                            $val_field = date("Y-m-d", strtotime($val_field));
                        }
                        if ( $data_field == "user_fecha_servicio"){
                            // forma de convertir string a date
                            // $date = date_create($val_field);
                            // $user_fecha_servicio = $date->format('Y-m-d');
                            // Otra forma de convertir string a date
                            $val_field = date("Y-m-d", strtotime($val_field));
                        }

                        if ( $data_field != "id" && $val_field != $r->$data_field ){
                            // echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";

                            if ($data_field == "user_info_cod"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_nombres"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_apellidos"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_dni"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_correo"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_telefono"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_genero"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_f_nacimiento"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_edad"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_nivel_academ"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_profesion"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_empleado"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_institucion"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_estado"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_municipio"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_direccion"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_tipo_servicio"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
                            if ($data_field == "user_fecha_servicio"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}
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

