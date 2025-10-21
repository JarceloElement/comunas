<!-- <div class="col-md-12">
    <div class="row">
    <h1><i class="fa fa-warning"></i> Cargando...</h1>
</div> -->

<?php
/**
* InfoApp
* @author Jarcelo
**/

$func_post = "";
$func_get = "";

// if (isset($_POST['function'])){$func_post = $_POST["function"]; }
if (isset($_GET['function'])){$func_get = $_GET["function"]; }


if($func_get == "add"){
    $rx = CoordinatorsData::getRepeated($_POST["document_number"]);
    if($rx==null){
        $r = new CoordinatorsData();
        $r->name = $_POST["name"];
        $r->lastname = $_POST["lastname"];
        $r->document_number = $_POST["document_number"];
        $r->phone_number = $_POST["phone_number"];
        $r->gender = $_POST["genero"];
        $r->email = $_POST["email"];
        $r->coordination = $_POST["coordination"];
        $r->status_nom = $_POST["status_nom"];
        $r->personal_type = $_POST["personal_type"];
        $r->birthdate = $_POST["birthdate"];
        $r->date_admission = $_POST["date_admission"];
        $r->estate = $_POST["estado"];
        $r->municipality = $_POST["municipio"];
        $r->parish = $_POST["parroquia"];
        $r->observations = $_POST["observations"];

        $r->add();

        // echo $_POST["cod"] . $_POST["nombre"] . $_POST["estado"] . $estado_name;

        // Core::alert("¡Agregado con éxito!");
    }else{
    Core::alert("¡AVISO: no se registró, ya existe la cedula que intentas guardar!");
    Core::redir("./index.php?view=newfacilitator");

    }
    Core::redir("./index.php?view=coordinator&swal=Registro creado");

}



// update_facilitator
if($func_get == "update"){
    if(count($_POST)>0){

        $r = CoordinatorsData::getById($_POST["id"]);
        $r->id = $_POST["id"];
        $r->name = $_POST["name"];
        $r->lastname = $_POST["lastname"];
        $r->document_number = $_POST["document_number"];
        $r->phone_number = $_POST["phone_number"];
        $r->gender = $_POST["genero"];
        $r->email = $_POST["email"];
        $r->coordination = $_POST["coordination"];
        $r->status_nom = $_POST["status_nom"];
        $r->personal_type = $_POST["personal_type"];
        $r->birthdate = $_POST["birthdate"];
        $r->date_admission = $_POST["date_admission"];
        $r->estate = $_POST["estado"];
        $r->municipality = $_POST["municipio"];
        $r->parish = $_POST["parroquia"];
        $r->observations = $_POST["observations"];
        $r->update();
    
        // Core::alert("Actualizado exitosamente!");
    }else {
        Core::alert("No hay parámetros enviados para actualizar");
    }

    Core::redir("./index.php?view=coordinator&swal=Registro actualizado");

}



// del_
if($func_get == "delete"){
    if (!isset( # valido los parametros recibidos
        $_GET['id']
        )) {Core::alert("Error: Falta el id a eliminar");
            return;
        }
    $param = CoordinatorsData::getById($_GET["id"]);
    $param->del();

    Core::alert("Eliminado exitosamente!");


    Core::redir("./index.php?view=coordinator&swal=Registro borrado");

    // print "<script>window.location='index.php?view=facilitators';</script>";

}



?>
