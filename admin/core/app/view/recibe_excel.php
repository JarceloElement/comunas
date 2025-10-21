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

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {
        // echo $linea;

        $datos = explode("|", $linea);
        
        $cod                   = !empty($datos[0])  ? ($datos[0]) : '';
        $nombre                = !empty($datos[1])  ? ($datos[1]) : '';
        $estatus               = !empty($datos[2])  ? ($datos[2]) : '';
        $motivo_cierre         = !empty($datos[3])  ? ($datos[3]) : '';
        $direccion             = !empty($datos[4])  ? ($datos[4]) : '';
        $ciudad                = !empty($datos[5])  ? ($datos[5]) : '';
        $estado                = !empty($datos[6])  ? ($datos[6]) : '';
        $municipio             = !empty($datos[7])  ? ($datos[7]) : '';
        $parroquia             = !empty($datos[8])  ? ($datos[8]) : '';
        $n_circuito            = !empty($datos[9])  ? ($datos[9]) : '';
        $tecno_internet        = !empty($datos[10])  ? ($datos[10]) : '';
        $proveedor             = !empty($datos[11])  ? ($datos[11]) : '';
        $perso_contacto        = !empty($datos[12])  ? ($datos[12]) : '';
        $telef_contacto        = !empty($datos[13])  ? ($datos[13]) : '';
        $f_instalacion         = !empty($datos[14])  ? ($datos[14]) : '';
        $creacion_year         = !empty($datos[15])  ? ($datos[15]) : '';
        $estatus_op            = !empty($datos[16])  ? ($datos[16]) : '';
        $transferido           = !empty($datos[17])  ? ($datos[17]) : '';
        $central_dlci          = !empty($datos[18])  ? ($datos[18]) : '';
        $migrado               = !empty($datos[19])  ? ($datos[19]) : '';
        $espacio_inst          = !empty($datos[20])  ? ($datos[20]) : '';
        $grupos_etnicos        = !empty($datos[21])  ? ($datos[21]) : '';
        $tipo_zona             = !empty($datos[22])  ? ($datos[22]) : '';
        $municipio_fronterizo  = !empty($datos[23])  ? ($datos[23]) : '';
        $limite_fronterizo     = !empty($datos[24])  ? ($datos[24]) : '';
        $observacion           = !empty($datos[25])  ? ($datos[25]) : '';
        $observacion_tecnica   = !empty($datos[26])  ? ($datos[26]) : '';
        $cod_gerencia          = !empty($datos[27])  ? ($datos[27]) : '';
        $f_registro            = !empty($datos[28])  ? ($datos[28]) : '';
      

        // echo $estado;

        if( !empty($cod) ){
            $sqlVerificarExistencia = $db->query("SELECT * FROM infocentros WHERE cod='".$cod."' ");
            $queryDuplicidad = $sqlVerificarExistencia->fetchAll();

            if(isset($queryDuplicidad) && $queryDuplicidad=null){
                // $insertarProduct = ("INSERT INTO infocentros(producto,codigo,cantidad) VALUES('$producto','$codigo','$cantidad')");
                // mysqli_query($connection, $insertarProduct);
                echo "Insert";
                    
            } else{

                // foreach ($queryDuplicidad as $row){
                    // echo $row['cod'];
                // } 

                
                $updateData =  ("UPDATE infocentros SET 
                    nombre = IF(nombre != '$nombre' and '$nombre' != '', '$nombre', nombre),
                    estatus = IF(estatus != '$estatus' and '$estatus' != '', '$estatus', estatus),
                    motivo_cierre = IF(motivo_cierre != '$motivo_cierre' and '$motivo_cierre' != '', '$motivo_cierre', motivo_cierre),
                    direccion = IF(direccion != '$direccion' and '$direccion' != '', '$direccion', direccion),
                    ciudad = IF(ciudad != '$ciudad' and '$ciudad' != '', '$ciudad',  ciudad),
                    estado = IF(estado != '$estado' and '$estado' != '', '$estado', estado),
                    municipio = IF(municipio != '$municipio' and '$municipio' != '', '$municipio', municipio),
                    parroquia = IF(parroquia != '$parroquia' and '$parroquia' != '', '$parroquia', parroquia),
                    n_circuito = IF(n_circuito != '$n_circuito' and '$n_circuito' != '', '$n_circuito', n_circuito),
                    tecno_internet = IF(tecno_internet != '$tecno_internet' and '$tecno_internet' != '', '$tecno_internet', tecno_internet),
                    proveedor = IF(proveedor != '$proveedor' and '$proveedor' != '', '$proveedor', proveedor),
                    perso_contacto = IF(perso_contacto != '$perso_contacto' and '$perso_contacto' != '', '$perso_contacto', perso_contacto),
                    telef_contacto = IF(telef_contacto != '$telef_contacto' and '$telef_contacto' != '', '$telef_contacto', telef_contacto),
                    
                    f_instalacion = IF(f_instalacion != '$f_instalacion' and '$f_instalacion' != '', '$f_instalacion', f_instalacion),
                    creacion_year = IF(creacion_year != '$creacion_year' and '$creacion_year' != '', '$creacion_year', creacion_year),
                    estatus_op = IF(estatus_op != '$estatus_op' and '$estatus_op' != '', '$estatus_op', estatus_op),
                    transferido = IF(transferido != '$transferido' and '$transferido' != '', '$transferido', transferido),
                    central_dlci = IF(central_dlci != '$central_dlci' and '$central_dlci' != '', '$central_dlci', central_dlci),
                    migrado = IF(migrado != '$migrado' and '$migrado' != '', '$migrado', migrado),
                    espacio_inst = IF(espacio_inst != '$espacio_inst' and '$espacio_inst' != '', '$espacio_inst', espacio_inst),
                    grupos_etnicos = IF(grupos_etnicos != '$grupos_etnicos' and '$grupos_etnicos' != '', '$grupos_etnicos', grupos_etnicos),
                    tipo_zona = IF(tipo_zona != '$tipo_zona' and '$tipo_zona' != '', '$tipo_zona', tipo_zona),
                    municipio_fronterizo = IF(municipio_fronterizo != '$municipio_fronterizo' and '$municipio_fronterizo' != '', '$municipio_fronterizo', municipio_fronterizo),
                    limite_fronterizo = IF(limite_fronterizo != '$limite_fronterizo' and '$limite_fronterizo' != '', '$limite_fronterizo', limite_fronterizo),
                    observacion = IF(observacion != '$observacion' and '$observacion' != '', '$observacion', observacion),
                    observacion_tecnica = IF(observacion_tecnica != '$observacion_tecnica' and '$observacion_tecnica' != '', '$observacion_tecnica', observacion_tecnica),
                    cod_gerencia =IF(cod_gerencia != '$cod_gerencia' and '$cod_gerencia' != '', '$cod_gerencia', cod_gerencia)
                
                    WHERE cod='$cod'
                ");
                $resultadoUpdate = $db->query($updateData);


            } 
        }
    }


    //   echo '<center><div>'. $i. "). " .$linea.'</div></center>';
    $i++;
}


//   echo '<center><p style="text-aling:center; color:#333;">Total de Registros: '. $cantidad_regist_agregados .'</p></center>';

echo "<center><a href='#'>Datos subidos con éxito | Puedes volver</a></center>";
?>

