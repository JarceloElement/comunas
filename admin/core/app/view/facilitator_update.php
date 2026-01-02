<?php
$debug= true;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}


require('conexion.php');
$db = Database::connect();

$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;
$updateData = "";

foreach ($lineas as $linea) {

    
    if ($i != 0) {
        // echo $linea;

        $datos = explode("|", $linea);
        
        $estate              = !empty($datos[0])  ? ($datos[0]) : '';
        $municipality        = !empty($datos[1])  ? ($datos[1]) : '';
        $parish              = !empty($datos[2])  ? ($datos[2]) : '';
        $name                = !empty($datos[3])  ? ($datos[3]) : '';
        $lastname            = !empty($datos[4])  ? ($datos[4]) : '';
        $document_number     = !empty($datos[5])  ? ($datos[5]) : '';
        $phone_number        = !empty($datos[6])  ? ($datos[6]) : '';
        $email               = !empty($datos[7])  ? ($datos[7]) : '';
        $gender              = !empty($datos[8])  ? ($datos[8]) : '';
        $birthdate           = !empty($datos[9])  ? ($datos[9]) : '';
        $date_admission      = !empty($datos[10])  ? ($datos[10]) : '';
        $info_cod            = !empty($datos[11])  ? ($datos[11]) : '';
        $status_nom          = !empty($datos[12])  ? ($datos[12]) : '';
        $personal_type       = !empty($datos[13])  ? ($datos[13]) : '';
        $observations        = !empty($datos[14])  ? ($datos[14]) : '';
        
        // echo $estate;

        // $date_ini = date_create($_GET["start_at"]);
        // $date_end = date_create($_GET["finish_at"]);
        // $start_at = $date_ini->format('d-m-Y');
        // $finish_at = $date_end->format('d-m-Y');

        $birthdate = str_replace("/","-",$birthdate);
        $date_admission = str_replace("/","-",$date_admission);

        $birthdate = date("Y-m-d", strtotime($birthdate));  
        $date_admission = date("Y-m-d", strtotime($date_admission));  

        $document_number = str_replace(".","",$document_number);
        $DNI = "";

        if( !empty($document_number) ){
            $sqlVerificarExistencia = $db->query("SELECT * FROM facilitators WHERE document_number='".$document_number."' ");
            $queryDuplicidad = $sqlVerificarExistencia->fetchAll();

            foreach ($queryDuplicidad as $row){
                $DNI = $row['document_number'];
            } 
            echo '<b><div>'. $i. '</div></b>';
            echo "REPETIDO: ".$document_number."<br/>".$DNI."<br/><br/>";

            if(empty($DNI)){
                $insertar = ("INSERT INTO facilitators (estate,municipality,parish,name,lastname,document_number,phone_number,email,gender,birthdate,date_admission,info_cod,status_nom,personal_type,observations) 
                VALUES('$estate','$municipality','$parish','$name','$lastname','$document_number','$phone_number','$email','$gender','$birthdate','$date_admission','$info_cod','$status_nom','$personal_type','$observations')");
                if ($db->query($insertar)) {
                    // printf("Record inserted successfully.<br />");
                    echo '<b><div>'. $i. '</div></b>';
                    echo "NUEVO: ".$document_number."<div>";
                }
                if ($db->error) {
                    printf("Could not insert record into table: %s<br />", $db->error);
                }

                echo '<b><div>'. $i. '</div></b>';
                echo "NUEVO: ".$document_number."<div>";
                    
            } else{

                $updateData =  ("UPDATE facilitators SET 
                    estate = IF(estate != '$estate' and '$estate' != '', '$estate', estate),
                    municipality = IF(municipality != '$municipality' and '$municipality' != '', '$municipality', municipality),
                    parish = IF(parish != '$parish' and '$parish' != '', '$parish', parish),
                    name = IF(name != '$name' and '$name' != '', '$name', name),
                    lastname = IF(lastname != '$lastname' and '$lastname' != '', '$lastname',  lastname),
                    document_number = IF(document_number != '$document_number' and '$document_number' != '', '$document_number', document_number),
                    phone_number = IF(phone_number != '$phone_number' and '$phone_number' != '', '$phone_number', phone_number),
                    email = IF(email != '$email' and '$email' != '', '$email', email),
                    gender = IF(gender != '$gender' and '$gender' != '', '$gender', gender),
                    birthdate = IF(birthdate != '$birthdate' and '$birthdate' != '', '$birthdate', birthdate),
                    date_admission = IF(date_admission != '$date_admission' and '$date_admission' != '', '$date_admission', date_admission),
                    info_cod = IF(info_cod != '$info_cod' and '$info_cod' != '', '$info_cod', info_cod),
                    status_nom = IF(status_nom != '$status_nom' and '$status_nom' != '', '$status_nom', status_nom),
                    personal_type = IF(personal_type != '$personal_type' and '$personal_type' != '', '$personal_type', personal_type),
                    observations =IF(observations != '$observations' and '$observations' != '', '$observations', observations) 
                    WHERE document_number='$document_number'
                ");
                $resultadoUpdate = $db->query($updateData);
                echo '<b><div>'. $i. '</div></b>';
                echo "ACTUALIZADO: ".$document_number."<br>";


            } 
        } //Cierre de mi 2 If
    } //Cierre de mi 1 If

    //   echo '<center><div>'. $i. '</div></center>';
    $i++;
}
// echo $updateData;


//   echo '<center><p style="text-aling:center; color:#333;">Total de Registros: '. $cantidad_regist_agregados .'</p></center>';

echo "<center><a href='#'>Datos subidos con éxito | Puedes volver</a></center>";
?>

