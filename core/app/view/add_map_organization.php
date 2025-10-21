		


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
    $organization_id = $_POST['organization_id'];
    $code_info = $_POST['code_info'];
    $user_name_os = $_POST['user_name_os'];
    $o_state = $_POST['o_state'];


    $insert = "INSERT into info_social_map_organizations (
    user_id,
    organization_id,
    code_info,
    o_state,
    organization_type,
    organization_connection_type,
    organization_name,
    organization_dni,
    organization_map_ubication,
    organization_limit_area,
    organization_address,
    organization_n_population,
    organization_n_population_female,
    organization_n_population_male,
    user_name_os) ";
    $insert .= "value (
    \"$user_id\",
    \"$organization_id \",
    \"$code_info\",
    \"$o_state\",
    'null',
    'null',
    'null',
    'null',
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

    $statement_1 = $db->query("SELECT * FROM info_social_map_organizations where code_info='$code_info' and organization_id='$organization_id' ");
    $res = $statement_1->fetchAll();
    
    if(isset($res) && $res!=null){
        foreach ($res as $row){
            if($row['code_info']!=""){
                $sc_id = (int)$row['organization_id'];
                $array = array(
                    "id"  => $row['id'],
                    "user_id"  => $row['user_id'],
                    "organization_id"  => $sc_id+1,
                    "organization_type"  => $row['organization_type'],
                    "organization_connection_type"  => $row['organization_connection_type'],
                    "organization_name"  => $row['organization_name'],
                    "organization_dni"  => $row['organization_dni'],
                    "organization_map_ubication"  => $row['organization_map_ubication'],
                    "organization_limit_area"  => $row['organization_limit_area'],
                    "organization_address"  => $row['organization_address'],
                    "organization_n_population"  => $row['organization_n_population'],
                    "organization_n_population_female"  => $row['organization_n_population_female'],
                    "organization_n_population_male"  => $row['organization_n_population_male'],
                    "code_info"  => $row['code_info'],
                    "o_state"  => $row['o_state'],
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


