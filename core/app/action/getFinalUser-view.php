		


<?php

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
	
    $search = $_POST['search'];
	
    $statement_1 = $db->query("select * from final_users where (user_nombres like '%$search%' or user_apellidos like '%$search%' or user_dni like '%$search%' or user_correo like '%$search%') ");
    $res = $statement_1->fetchAll();

    if(isset($res) && $res!=null){
        foreach ($res as $row){
            if($row['user_dni']!=""){
                $array = array(
                    "user_nombres"  => $row['user_nombres'],
                    "user_apellidos"  => $row['user_apellidos'],
                    "user_dni"  => $row['user_dni'],
                    "user_correo"  => $row['user_correo'],
                    "user_telefono"  => $row['user_telefono'],
                    "user_genero"  => $row['user_genero'],
                    "user_f_nacimiento"  => $row['user_f_nacimiento'],
                    "user_edad"  => $row['user_edad'],
                    "user_nivel_academ"  => $row['user_nivel_academ'],
                    "user_profesion"  => $row['user_profesion'],
                    "user_empleado"  => $row['user_empleado'],
                    "user_institucion"  => $row['user_institucion'],
                    "user_estado"  => $row['user_estado'],
                    "user_municipio"  => $row['user_municipio'],
                    "user_direccion"  => $row['user_direccion'],
                );

            }else{
                $array = array(
                    "user_nombres"  => "No existe este usuario",
                    "user_apellidos"  => "",
                );
            }
        }

    }else{
        $array = array(
            "user_nombres"  => "No existe este usuario",
            "user_apellidos"  => "",
        );
    }

    echo json_encode($array);
        

?>


