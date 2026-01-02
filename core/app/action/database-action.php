<?php
/**
* InfoApp
* @author Jarcelo
**/

$con = Database::getCon();
$result[] = null;

if ($result = $con->query("SHOW TABLES FROM infoapp WHERE 
Tables_in_infoapp LIKE 'products_type' or 
Tables_in_infoapp LIKE 'estados'
")) {
    if($result->num_rows != 0) {
        // echo "Table exists";
    }else {
        echo "Table does not exist";
    }
}
else {
    echo "RESULT: Table does not exist";
}

if($result->num_rows != 0) {

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS products_type (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
        -- apellidos VARCHAR(50) NOT NULL,
        -- email VARCHAR(50),
        -- fecha TIMESTAMP
        )";
        
    Executor::doit($sql)[1];
}

echo "Base de datos creada con éxito."



?>



<div class="panel-heading">
		<h4 class="title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
		<span class='text_label'> <i class='fa fa-unlink icon_label' ></i> <b> Tipo de productos </b> </span>
		</a>
		</h4>
	</div>
