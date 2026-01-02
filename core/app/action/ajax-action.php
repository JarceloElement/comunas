<?php
/**
 * InfoApp
 * @author Jarcelo
 **/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$func_post = "";
$func_get = "";

if (isset($_POST['function'])) {
    $func_post = $_POST["function"];
}
if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}



// POST FUNCTIONS

// add internet type
if ($func_post == "add") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['name']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new InternetTypeData();
    $param->type = $_POST["name"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}

// add operative type data
if ($func_post == "add_operative_type") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['name']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new OperativeInfoData();
    $param->operative_type = $_POST["name"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}

// add_action_line
if ($func_post == "add_action_line") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['name']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new ActionsLineData();
    $param->line_name = $_POST["name"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}


// add_status_type
if ($func_post == "add_status_type") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['param']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new StatusInfocentroData();
    $param->status = $_POST["param"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}



// add_coord
if ($func_post == "add_coord") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['param']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new CoordTypeData();
    $param->name = $_POST["param"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}


// add_responsible_type
if ($func_post == "add_responsible_type") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['param']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new ResponsibleTypeData();
    $param->name = $_POST["param"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}


// add_user_type
if ($func_post == "add_user_type") {
    if (!isset($_POST['user_type_name'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new UserTypeData();
    $param->user_type = $_POST["user_type"];
    $param->user_type_name = $_POST["user_type_name"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}


// add_product_type
if ($func_post == "add_product_type") {

    if (!isset($_POST['name'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $param = new ProductsType();
    $param->name = $_POST["name"];
    $param->add();
    echo "¡Creado exitosamente!";

}



// add_participant
if ($func_post == "add_participant") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['id_activity']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }


    $update_person = new ReportActivityData();
    $update_person->update_type = "add";
    $update_person->perso_gender = $_POST["gender"];
    $update_person->id_activity = $_POST["id_activity"];

    if ($_POST["gender"] == "Hombre" || $_POST["gender"] == "M" || $_POST["gender"] == "m") {
        $update_person->update_participant_ma_add();
    }
    if ($_POST["gender"] == "Mujer" || $_POST["gender"] == "F" || $_POST["gender"] == "f") {
        $update_person->update_participant_fe_add();
    }

    $param = new ParticipantsData();
    $param->id_activity = $_POST["id_activity"];
    $param->date_activity = $_POST["date_activity"];
    $param->estate = $_POST["estate"];
    $param->code_info = $_POST["code_info"];
    $param->name = $_POST["name"];
    $param->document_id = $_POST["document_id"];
    $param->age = $_POST["age"];
    $param->gender = $_POST["gender"];
    $param->phone = $_POST["phone"];
    $param->email = $_POST["email"];
    $param->add();



    // Core::alert("Creado exitosamente!");
    // echo "¡Creado exitosamente!";
    $PHP_SELFx = "index.php?view=participants_list&swal=Agregado correctamente&id_activity=" . $_POST["id_activity"] . "&activity=" . $_POST["activity"] . "&code_info=" . $_POST['code_info'] . "&estate=" . $_POST['estate'] . "&date_activity=" . $_POST['date_activity'];
    echo $PHP_SELFx;

}

// add_report_limit
if ($func_post == "add_report_limit") {
    if (!isset($_POST['fecha_final'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];
    $sql = "UPDATE report_date_limit set date_limit_ini=\"$fecha_inicio\", date_limit_end=\"$fecha_final\" ";
    Executor::doit($sql);

    // echo "¡Creado exitosamente!";
    echo $fecha_inicio . " | " . $fecha_final;
}



// update_info por lotes
if ($func_get == "update_info") {
    if (!isset($_POST['operatividad'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }


    if (isset($_POST['pagination'])) {
        $pagination = $_POST["pagination"];
    } else {
        $pagination = "";
    }

    $location = $_GET['location'];
    $operatividad = $_POST['operatividad'];
    $internet = $_POST['internet'];
    $estatus = $_POST['estatus'];
    $data_id = $_POST['data_id'];
    $array_id = explode(',', $data_id);

    // si no hay ID para modificar
    if ($data_id == "") {
        Core::alert("Debes seleccionar algún elemento para modificar");
        if ($pagination != "") {
            print "<script>window.location='" . $location . "&pag=" . $pagination . "';</script>";
        } else {
            print "<script>window.location='" . $location . "';</script>";
        }
        return;
    }

    $sql = "UPDATE infocentros ";

    if ($operatividad != "") {
        $sql .= "SET estatus_op = CASE id ";
        foreach ($array_id as $id) {
            $sql .= sprintf("WHEN %d THEN %s ", $id, "'" . $operatividad . "'");
        }
    }
    if ($internet != "") {
        if ($operatividad != "") {
            $sql .= "END, tecno_internet = CASE id ";
        } else {
            $sql .= "SET tecno_internet = CASE id ";
        }
        foreach ($array_id as $id) {
            $sql .= sprintf("WHEN %d THEN %s ", $id, "'" . $internet . "'");
        }
    }
    if ($estatus != "") {
        if ($operatividad != "" || $internet != "") {
            $sql .= "END, estatus = CASE id ";
        } else {
            $sql .= "SET estatus = CASE id ";
        }
        foreach ($array_id as $id) {
            $sql .= sprintf("WHEN %d THEN %s ", $id, "'" . $estatus . "'");
        }
    }
    $sql .= "END WHERE id IN ($data_id)";
    // echo $pagination;
    // Core::alert($sql);
    // $sql = "UPDATE report_date_limit set date_limit_ini=\"$fecha_inicio\", date_limit_end=\"$fecha_final\" ";
    Executor::doit($sql);
    if ($pagination != "") {
        print "<script>window.location='" . $location . "&pag=" . $pagination . "';</script>";
    } else {
        print "<script>window.location='" . $location . "';</script>";
    }

}






// update_part
if ($func_post == "update_part") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['id']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }
    $param = ParticipantsData::getById($_POST["id"]);

    $param->id = $_POST["id"];
    $param->name = $_POST["name"];
    $param->document_id = $_POST["document_id"];
    $param->age = $_POST["age"];
    $param->gender = $_POST["gender"];
    $param->phone = $_POST["phone"];
    $param->update();
    // Core::alert("Creado exitosamente!");
    echo "Guardado exitosamente!";
    print "<script>window.location='index.php?view=users';</script>";


}




// add_product
if ($func_post == "add_product") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['id_activity']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    // $update_person = new ReportActivityData();
    // $update_person->update_type = "add";
    // $update_person->id_activity = $_POST["id_activity"];
    // $update_person->quantity_created = $_POST["quantity_created"];
    // $update_person->quantity_published = $_POST["quantity_published"];

    // $update_person->update_product_add_created();


    $param = new ProductsData();
    $param->id_activity = $_POST["id_activity"];
    $param->estate = $_POST["estate"];
    $param->action_performed = $_POST["action_performed"];
    $param->date_activity = $_POST["date_activity"];
    $param->estate = $_POST["estate"];
    $param->code_info = $_POST["code_info"];
    $param->format = $_POST["format"];
    $param->format_detail = $_POST["format_detail"];
    $param->quantity_created = $_POST["quantity_created"];
    $param->quantity_published = $_POST["quantity_published"];
    $param->web_link = $_POST["web_link"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    // echo "¡Creado exitosamente!";
    $PHP_SELFx = "index.php?view=products_list&swal=Agregado correctamente&id_activity=" . $_POST["id_activity"] . "&activity=" . $_POST["activity"] . "&code_info=" . $_POST['code_info'] . "&estate=" . $_POST['estate'] . "&date_activity=" . $_POST['date_activity'];
    echo $PHP_SELFx;
}



// update_prod
if ($func_post == "update_prod") {
    if (
        !isset( # valido los parametros recibidos
        $_POST['id']
    )
    ) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }
    $param = ProductsData::getById($_POST["id"]);

    $param->id = $_POST["id"];
    $param->action_performed = $_POST["action_performed"];
    $param->format = $_POST["format"];
    $param->format_detail = $_POST["format_detail"];
    $param->quantity_created = $_POST["quantity_created"];
    $param->quantity_published = $_POST["quantity_published"];
    $param->web_link = $_POST["web_link"];
    $param->update();
    // Core::alert("Creado exitosamente!");
    echo "Producto actualizado";


}





// GET FUNCTIONS

// delet internet_type
if ($func_get == "del_internet_type") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = InternetTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
    </script>";

}


// delet operative type
if ($func_get == "del_operatve_type") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = OperativeInfoData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
	</script>";

}


// delet action_line
if ($func_get == "del_action_line") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ActionsLineData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
    </script>";

}





// del_status_type
if ($func_get == "del_status_type") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = StatusInfocentroData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
    </script>";

}





// del_coord
if ($func_get == "del_coord") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = CoordTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}




// del_responsible_type
if ($func_get == "del_responsible_type") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ResponsibleTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}


// del_user_type
if ($func_get == "del_user_type") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = UserTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}

// del_user
if ($func_get == "del_user") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = UserData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=users&swal=Usuario eliminado";
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}

// del_participant
if ($func_get == "del_participant") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ParticipantsData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $update_person = new ReportActivityData();
    $update_person->update_type = "del";
    $update_person->perso_gender = $_GET["gender"];
    $update_person->id_activity = $_GET["id_activity"];

    if ($_GET["gender"] == "Hombre" || $_GET["gender"] == "M" || $_GET["gender"] == "m") {
        $update_person->update_participant_ma_del();
    }
    if ($_GET["gender"] == "Mujer" || $_GET["gender"] == "F" || $_GET["gender"] == "f") {
        $update_person->update_participant_fe_del();
    }

    $PHP_SELFx = "index.php?view=participants_list&swal=Eliminado&id_activity=" . $_GET["id_activity"] . "&activity=" . $_GET["activity"] . "&code_info=" . $_GET['code_info'] . "&date_activity=" . $_GET['date_activity'] . "&estate=" . $_GET['estate'];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}




// del_products
if ($func_get == "del_products") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ProductsData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=products_list&swal=Eliminado&id_activity=" . $_GET["id_activity"] . "&activity_title=" . $_GET["activity_title"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}



// del_product_type
if ($func_get == "del_product_type") {
    if (
        !isset( # valido los parametros recibidos
        $_GET['id']
    )
    ) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ProductsType::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";

}

if ($func_get == "indicators") {

    $base = new DatabasePg();
    $con = $base->connectPg();


    if ((!isset($_POST["start_date"]) || $_POST["start_date"] == "") || (!isset($_POST["end_date"]) || $_POST["end_date"] == "")) {
        echo json_encode([
            "data" => ["La fecha de inicio y fin son obligatorias"],
            "status_code" => 200
        ]);
        exit;

    }


    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];

    # Mostrar los resportes de todos los estados bajo las fechas de inicio y de fin de las actividades
    // $query = "SELECT e.estado, count(reports.estate) as count 
    // FROM estados as e 
    // INNER JOIN reports ON reports.estate=e.estado 
    // WHERE reports.estate!='' and reports.is_active=1 and reports.status_activity=1 and ( STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )>=STR_TO_DATE('".$start_at."', '%d-%m-%Y')"." and STR_TO_DATE( SUBSTRING_INDEX(reports.date_pub,'/',1), '%d-%m-%Y' )<=STR_TO_DATE('".$finish_at."', '%d-%m-%Y')"." ) 
    // GROUP BY e.estado order by e.estado asc";

    $query = "SELECT reports.estate, count(reports.estate) as count 
        FROM reports 
        WHERE reports.estate !='' 
            and reports.is_active='1' 
            and reports.status_activity='1' 
            and ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY') ) 
        GROUP BY reports.estate order by count DESC";

    $query_all_1 = $con->query($query);
    # Si no hay reportes, se muestran todos los estados con 0 reportes para mostrarlos en el grafico
    if ($query_all_1->rowCount() == 0) {
        $con = Database::getCon();

        $query_all_1 = $con->query("SELECT estado, 0 FROM estados")->fetch_all();
    } else {
        $query_all_1 = $query_all_1->fetchAll();
    }

    echo json_encode([
        "data" => $query_all_1,
        "status_code" => 200,
        "sql" => $query
    ]);

}

if ($func_get == "products_by_category") {


    $con = Database::getCon();
    $products_type = $con->query("SELECT * FROM  categoria_productos");


    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];


    if (isset($products_type) && $products_type != null) {

        $query = "SELECT estate";
        foreach ($products_type as $row) {
            $query .= ',count(case when format=\'' . $row['nombre_categoria'] . '\' then 1 end) as "' . $row['nombre_categoria'] . '" ';

        }
        $query .= " FROM products_list WHERE estate!='null' AND ( TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY') ) GROUP BY estate ";
    }

    $products_by_state = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $products_by_state,
        "status_code" => 200,
        "sql" => $query
    ]);

}

if ($func_get == "products_by_category_in_general") {


    $con = Database::getCon();
    $product_categories = $con->query("SELECT * FROM  categoria_productos");


    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];
    $count_array = [];


    if (isset($product_categories) && $product_categories != null) {

        $query = "SELECT estate";

        foreach ($product_categories as $row) {
            array_push($count_array, 'count(case when format=\'' . $row['nombre_categoria'] . '\' then 1 end) as "' . $row['nombre_categoria'] . '" ');
        }
        $query = "SELECT " . implode(", ", $count_array) . " FROM products_list WHERE ( TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY') )";
    }

    $products_by_categories = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        "data" => $products_by_categories,
        "status_code" => 200,
        "sql" => $query
    ]);

}

if ($func_get == "products_by_type") {


    $con = Database::getCon();
    $products_type = $con->query("SELECT * FROM  products_type GROUP BY name");

    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];


    if (isset($products_type) && $products_type != null) {

        $query = "SELECT estate";
        foreach ($products_type as $row) {
            $query .= ',count(case when format_detail=\'' . $row['name'] . '\' then 1 end) as "' . $row['name'] . '" ';

        }
        $query .= " FROM products_list WHERE estate!='null' AND ( TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY') ) GROUP BY estate ";
    }

    $products_by_types = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $products_by_types,
        "status_code" => 200,
        "sql" => $query
    ]);

}

if ($func_get == "products_by_type_in_general") {


    $con = Database::getCon();
    $products_type = $con->query("SELECT * FROM  products_type GROUP BY name");


    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];
    $count_array = [];


    if (isset($products_type) && $products_type != null) {

        foreach ($products_type as $row) {
            array_push($count_array, 'count(case when format_detail=\'' . $row['name'] . '\' then 1 end) as "' . $row['name'] . '" ');
        }
    }
    $query = "SELECT " . implode(", ", $count_array) . " FROM products_list WHERE estate != 'null' AND ( TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and TO_DATE(split_part(products_list.date,'/',1),'DD-MM-YYYY') <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY') ) ";
    

    $products_by_types = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $products_by_types,
        "status_code" => 200,
        "sql" => $query
    ]);

}

if ($func_get == "reports_by_action_line") {

    $con = Database::getCon();
    $action_lines = $con->query("SELECT * FROM actions_line");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];

    if (isset($action_lines) && $action_lines != null) {

        $query = "SELECT estate";
        foreach ($action_lines as $row) {
            $query .= ',count(case when line_action=\'' . $row['line_name'] . '\' then 1 end) as "' . $row['line_name'] . '" ';
    
        }
        $query .= " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) GROUP BY estate";
    }
    
    $reports_by_state = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_state,
        "status_code" => 200,
        "sql" => $query
    ]);

}


if ($func_get == "reports_by_action_line_in_general") {


    $con = Database::getCon();
    $action_lines = $con->query("SELECT * FROM  actions_line");


    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];
    $count_array = [];

    if (isset($action_lines) && $action_lines != null) {

        foreach ($action_lines as $row) {
            array_push($count_array, 'count(case when line_action=\'' . $row['line_name'] . '\' then 1 end) as "' . $row['line_name'] . '" ');
        }
    }
    $query = "SELECT " . implode(", ", $count_array) . " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) ";
    
    $reports_by_action_line = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_action_line,
        "status_code" => 200,
        "sql" => $query
    ]);

}


if ($func_get == "reports_by_strategic_action") {

    $con = Database::getCon();
    $strategic_actions = $con->query("SELECT * FROM strategic_action");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];

    if (isset($strategic_actions) && $strategic_actions != null) {

        $query = "SELECT estate";
        foreach ($strategic_actions as $row) {
            $query .= ',count(case when report_type=\'' . $row['name_action'] . '\' then 1 end) as "' . $row['name_action'] . '" ';
    
        }
        $query .= " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) GROUP BY estate";
    }
    
    $reports_by_state = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_state,
        "status_code" => 200,
        "sql" => $query
    ]);

}


if ($func_get == "reports_by_strategic_action_in_general") {

    $con = Database::getCon();
    $strategic_actions = $con->query("SELECT * FROM strategic_action");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];
    $count_array = [];


    if (isset($strategic_actions) && $strategic_actions != null) {

        foreach ($strategic_actions as $row) {
            array_push($count_array, 'count(case when report_type=\'' . $row['name_action'] . '\' then 1 end) as "' . $row['name_action'] . '" ');
        }
    }
    $query = "SELECT " . implode(", ", $count_array) . " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) ";
    
    $reports_by_strategic_action = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_strategic_action,
        "status_code" => 200,
        "sql" => $query
    ]);


}


if ($func_get == "reports_by_training_type") {

    $con = Database::getCon();
    $training_types = $con->query("SELECT * FROM training_type");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];

    if (isset($training_types) && $training_types != null) {

        $query = "SELECT estate";
        foreach ($training_types as $row) {
            $query .= ',count(case when training_type=\'' . $row['name_training_type'] . '\' then 1 end) as "' . $row['name_training_type'] . '" ';
    
        }
        $query .= " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) GROUP BY estate";
    }
    
    $reports_by_state = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_state,
        "status_code" => 200,
        "sql" => $query
    ]);

}


if ($func_get == "reports_by_training_type_in_general") {

    $con = Database::getCon();
    $training_types = $con->query("SELECT * FROM training_type");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];
    $count_array = [];


    if (isset($training_types) && $training_types != null) {

        foreach ($training_types as $row) {
            array_push($count_array, 'count(case when training_type=\'' . $row['name_training_type'] . '\' then 1 end) as "' . $row['name_training_type'] . '" ');
        }
    }
    $query = "SELECT " . implode(", ", $count_array) . " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) ";
    
    $reports_by_training_type = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_training_type,
        "status_code" => 200,
        "sql" => $query
    ]);


}


if ($func_get == "reports_by_workshop_type") {

    $con = Database::getCon();
    $workshop_types = $con->query("SELECT * FROM tipo_taller");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];

    if (isset($workshop_types) && $workshop_types != null) {

        $query = "SELECT estate";
        foreach ($workshop_types as $row) {
            $query .= ',count(case when tipo_taller=\'' . $row['nombre_taller'] . '\' then 1 end) as "' . $row['nombre_taller'] . '" ';
    
        }
        $query .= " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) GROUP BY estate";
    }
    
    $reports_by_state = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_state,
        "status_code" => 200,
        "sql" => $query
    ]);

}


if ($func_get == "reports_by_workshop_type_in_general") {

    $con = Database::getCon();
    $workshop_types = $con->query("SELECT * FROM tipo_taller");
    
    $pg_base = new DatabasePg();
    $pg_con = $pg_base->connectPg();
    

    $start_at = $_POST["start_date"];
    $finish_at = $_POST["end_date"];
    $count_array = [];


    if (isset($workshop_types) && $workshop_types != null) {

        foreach ($workshop_types as $row) {
            array_push($count_array, 'count(case when tipo_taller=\'' . $row['nombre_taller'] . '\' then 1 end) as "' . $row['nombre_taller'] . '" ');
        }
    }
    $query = "SELECT " . implode(", ", $count_array) . " FROM reports WHERE estate != 'null' AND ( reports.date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and reports.date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')) ";
    
    $reports_by_workshop_type = $pg_con->query($query)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "data" => $reports_by_workshop_type,
        "status_code" => 200,
        "sql" => $query
    ]);


}


// $statement_1 = $db->query("SELECT id_municipio, municipio FROM municipios WHERE id_estado = '$id_estado' ORDER BY municipio");
// $res = $statement_1->fetchAll();

// $html= "<option value=''>- SELECCIONAR MUNICIPIO -</option>";

// if(isset($res)){
// 	foreach ($res as $row){
// 		$html.= "<option value='".$row['id_municipio']."'>".$row['municipio']."</option>";

// 	}
// }
// echo $html;

// Database::disconnect();

?>