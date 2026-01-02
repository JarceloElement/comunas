		


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $code_info = $_POST['code_info'];
// // $sql = 'select * from infocentros order by cod asc LIMIT 1 , 10';

// $sql = 'select * from infocentros where cod ='.'"'.$code_info.'"';
// $info = InfoData::getBySQL($sql);


// if(count($info)>0){

//     foreach($info as $data){
//         return $data->nombre;

//     }
// }



    include ('../../controller/Database.php');
    $db = Database::connectPDO();

    $user_id = $_POST['user_id'];
    $school_id = $_POST['school_id'];
    $code_info = $_POST['code_info'];
    $user_name_os = $_POST['user_name_os'];
    $s_state = $_POST['s_state'];


    $insert = "INSERT into info_social_map_educations (
    user_id,
    school_id,
    code_info,
    s_state,
    school_type,
    school_name,
    dea_code,
    school_n_students,
    school_n_students_female,
    school_n_students_male,
    user_name_os) ";
    $insert .= "value (
    \"$user_id\",
    \"$school_id \",
    \"$code_info\",
    \"$s_state\",
    'null',
    'null',
    'null',
    'null',
    'null',
    'null',
    \"$user_name_os\" 
    )";

    $result = $db->query($insert);

    // las dos formas de obtener el ultimo ID | me arroja null
    // $ID = $db->insert_id;
    // $ID = mysqli_insert_id($db);

    $statement_1 = $db->query("SELECT * FROM info_social_map_educations where code_info='$code_info' and school_id='$school_id' ");
    $res = $statement_1->fetchAll();
    
    if(isset($res) && $res!=null){
        foreach ($res as $row){
            if($row['code_info']!=""){
                $sc_id = (int)$row['school_id'];
                $array = array(
                    "id"  => $row['id'],
                    "user_id"  => $row['user_id'],
                    "school_id"  => $sc_id+1,
                    "code_info"  => $row['code_info'],
                    "s_state"  => $row['s_state'],
                    "school_type"  => $row['school_type'],
                    "school_name"  => $row['school_name'],
                    "dea_code"  => $row['dea_code'],
                    "school_n_students"  => $row['school_n_students'],
                    "school_n_students_female"  => $row['school_n_students_female'],
                    "school_n_students_male"  => $row['school_n_students_male'],
                );

            }else{
                $array = array(
                    "user_id"  => "No existe el code info en este id",
                );
            }
        }

    }else{
        $array = array(
            "user_id"  => "No existe el code info en este id",
        );
    }

    echo json_encode($array);


?>


