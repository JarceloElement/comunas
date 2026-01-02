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
    $info_cod = $_POST['info_cod'];
	
    // $numero = 1002002.365;
    // number_format($numero, 2, ",", ".");
    // //devuelve 1.002.002,37

        $statement_1 = $db->query("SELECT * from gerencias where (name like '%$search%' or lastname like '%$search%' or CAST(REPLACE(document_number,'.','') AS CHARACTER) like '%$search%') ");
        $res = $statement_1->fetchAll();

        $array = array(
            "nombre"  => "El gerente no está registrado",
        );
        
        
        if(isset($res) && $res!=null){
            foreach ($res as $row){
                if($row['name']!=""){
                    $array = array(
                        "nombre"  => $row['name'],
                        "apellido"  => $row['lastname'],
                        // "dni"  => str_replace(".","",str_replace("V-","",$row['document_number']) ),
                        "dni"  => $row['document_number'],
                        "email"  => $row['email'],
                        "personal_type"  => $row['personal_type'],
                        "birthdate"  => $row['birthdate'],

                    );

                }else{
                    $array = array(
                        "nombre"  => "El gerente no está registrado",
                    );
                }
            }

        }else{
            $array = array(
                "nombre"  => "El gerente no está registrado",
            );
        }

        echo json_encode($array);
    


?>


