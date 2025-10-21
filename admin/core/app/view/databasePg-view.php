<?php

/**
 * InfoApp
 * @author Jarcelo
 **/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['alterdb'])) {
    alter_db();
}


$query = isset($_POST['query']) ? $_POST['query'] : null;

if ($query) {
    $conn = DatabasePg::connectPg();
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($result);
    echo "</pre>";
} else {
    echo "No query provided.";
}
// UPDATE+infocentros+SET+cod='XZ'+where+id=1059














function alter_db()
{

    print_r("PG: Migrado<br>");
    $conn = DatabasePg::connectPg();



    // EJECUTAR SQL DESDE ARCHIVOS.sql
    // -----------------------------------------------------------------

    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $facilitators = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'facilitators' ");
    $facilitators->execute();
    $table_name = $facilitators->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/facilitators-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (", $table_name["table_name"] . ")<br>";
    }


    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $encuesta_1 = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'encuesta_capacidades_tecnologicas' ");
    $encuesta_1->execute();
    $table_name = $encuesta_1->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/encuesta_1-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (", $table_name["table_name"] . ")<br>";
    }




    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $coordinators = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'coordinators' ");
    $coordinators->execute();
    $table_name = $coordinators->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/coordinators-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (", $table_name["table_name"] . ")<br>";
    }



    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $gerencias = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'gerencias' ");
    $gerencias->execute();
    $table_name = $gerencias->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/gerencias-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (", $table_name["table_name"] . ")<br>";
    }




    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $social_medias = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'social_medias' ");
    $social_medias->execute();
    $table_name = $social_medias->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/social_medias-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (", $table_name["table_name"] . ")<br>";
    }








    // $DROP2 = $conn->prepare("DROP TABLE IF EXISTS public.brigades");
    // $DROP2->execute();

    // $DROP3 = $conn->prepare("DROP SEQUENCE IF EXISTS public.brigades_id_seq");
    // $DROP3->execute();



    // brigades
    $encuesta_1 = $conn->prepare("SELECT tablename FROM pg_tables WHERE tablename = 'brigades'");
    $encuesta_1->execute();
    $table_name = $encuesta_1->fetch();

    if (!isset($table_name["tablename"])) {
        $table_name = "brigades";

        $query = '';
        $sqlFile = file('./../migrate/brigades-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (" . $table_name["tablename"] . ")<br>";
    }




    // user_brigades
    $encuesta_1 = $conn->prepare("SELECT tablename FROM pg_tables WHERE tablename = 'user_brigades'");
    $encuesta_1->execute();
    $table_name = $encuesta_1->fetch();

    if (!isset($table_name["tablename"])) {

        $table_name = "user_brigades";

        $query = '';
        $sqlFile = file('./../migrate/users_brigades-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
        echo "Tabla creada: (" . $table_name . ")<br>";
    } else {
        echo "Ya existe la tabla: (", $table_name["tablename"] . ")<br>";
    }


    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $social_medias = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'links' ");
    $social_medias->execute();
    $table_name = $social_medias->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/links-Pg.sql');

    foreach ($sqlFile as $line) {
        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
            echo "<br><br>".$query . "<br><br>";
            $execute = $conn->prepare($query);
            $execute->execute();
            $query = '';
        }
    }
} else {
    echo "Ya existe la tabla: (", $table_name["table_name"].")<br>";
}



// $DROP1 = $conn->prepare("DROP TABLE IF EXISTS public.specific_action");
// $DROP1->execute();


// $DROP1 = $conn->prepare("DROP TABLE IF EXISTS public.strategic_action");
// $DROP1->execute();

// $DROP1 = $conn->prepare("DROP TABLE IF EXISTS public.actions_line");
// $DROP1->execute();


// SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
$actions_line = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'actions_line' ");
$actions_line->execute();
$table_name = $actions_line->fetch();

// Si no existe la tabla, se crea desde el archivo
if (!isset($table_name["table_name"])) {
    $query = '';
    $sqlFile = file('./../migrate/actions_line-Pg.sql');

    foreach ($sqlFile as $line) {
        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
            echo "<br><br>".$query . "<br><br>";
            $execute = $conn->prepare($query);
            $execute->execute();
            $query = '';
        }
    }
} else {
    echo "Ya existe la tabla: (", $table_name["table_name"].")<br>";
}





// SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
$strategic_action = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'strategic_action' ");
$strategic_action->execute();
$table_name = $strategic_action->fetch();

// Si no existe la tabla, se crea desde el archivo
if (!isset($table_name["table_name"])) {
    $query = '';
    $sqlFile = file('./../migrate/strategic_action-Pg.sql');

    foreach ($sqlFile as $line) {
        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
            echo "<br><br>".$query . "<br><br>";
            $execute = $conn->prepare($query);
            $execute->execute();
            $query = '';
        }
    }
} else {
    echo "Ya existe la tabla: (", $table_name["table_name"].")<br>";
}




// SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
$specific_action = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'specific_action' ");
$specific_action->execute();
$table_name = $specific_action->fetch();

// Si no existe la tabla, se crea desde el archivo
if (!isset($table_name["table_name"])) {
    $query = '';
    $sqlFile = file('./../migrate/specific_action-Pg.sql');

    foreach ($sqlFile as $line) {
        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
            echo "<br><br>".$query . "<br><br>";
            $execute = $conn->prepare($query);
            $execute->execute();
            $query = '';
        }
    }
} else {
    echo "Ya existe la tabla: (", $table_name["table_name"].")<br>";
}


// $DROP1 = $conn->prepare("DROP TABLE IF EXISTS public.training_type CASCADE");
// $DROP1->execute();

// SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
$training_type = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'training_type' ");
$training_type->execute();
$table_name = $training_type->fetch();

// Si no existe la tabla, se crea desde el archivo
if (!isset($table_name["table_name"])) {
    $query = '';
    $sqlFile = file('./../migrate/training_type-Pg.sql');

    foreach ($sqlFile as $line) {
        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
            echo "<br><br>".$query . "<br><br>";
            $execute = $conn->prepare($query);
            $execute->execute();
            $query = '';
        }
    }
} else {
    echo "Ya existe la tabla: (", $table_name["table_name"].")<br>";
}


// SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
$training_type = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'tipo_taller' ");
$training_type->execute();
$table_name = $training_type->fetch();

// Si no existe la tabla, se crea desde el archivo
if (!isset($table_name["table_name"])) {
    $query = '';
    $sqlFile = file('./../migrate/tipo_taller-Pg.sql');

    foreach ($sqlFile as $line) {
        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
        $query = $query . $line;
        if ($endWith == ';') {
            echo "<br><br>".$query . "<br><br>";
            $execute = $conn->prepare($query);
            $execute->execute();
            $query = '';
        }
    }
} else {
    echo "Ya existe la tabla: (", $table_name["table_name"].")<br>";
}







    // SABER SI EXISTE UNA TABLA | IMPORTAR DESDE ARCHIVO | Se recomienda crear un archivo para cada tabla diferente
    $social_medias = $conn->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'users' ");
    $social_medias->execute();
    $table_name = $social_medias->fetch();

    // Si no existe la tabla, se crea desde el archivo
    if (!isset($table_name["table_name"])) {
        $query = '';
        $sqlFile = file('./../migrate/users-Pg.sql');

        foreach ($sqlFile as $line) {
            $startWith = substr(trim($line), 0, 2);
            $endWith = substr(trim($line), -1, 1);
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
            $query = $query . $line;
            if ($endWith == ';') {
                echo "<br><br>" . $query . "<br><br>";
                $execute = $conn->prepare($query);
                $execute->execute();
                $query = '';
            }
        }
    } else {
        echo "Ya existe la tabla: (", $table_name["table_name"] . ")<br>";
    }
    // -----------------------------------------------------------------


    // SABER SI EXISTE UNA COLUMNA
    // $row_table = $conn->prepare("SELECT column_name, data_type FROM information_schema.columns WHERE table_schema = 'public' AND table_name = 'reports' AND column_name='tipo_taller' ");
    // $row_table->execute();
    // $column = $row_table->fetch();
    // if (!isset($column["column_name"])) {
    //     echo "No existe la columna";
    // } else {
    //     echo "Existe la columna";
    // }

    // AGREGAR UNA COLUMNA
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports ADD COLUMN IF NOT EXISTS tipo_taller VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports ADD COLUMN IF NOT EXISTS profile_image VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.final_users ADD COLUMN IF NOT EXISTS profile_image VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.final_users ADD COLUMN IF NOT EXISTS user_equipo_sala_comunal VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS servicio_pagado_por VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS propuesto_nucleo_robotica VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS espacio_robotica_educativa VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS fecha_solicitud_migracion VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS fecha_reporte VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS fecha_solucion VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS observacion_falla VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.infocentros ADD COLUMN IF NOT EXISTS casos_resueltos_ano VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS causa_imp_inop VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS desc_fotocopiadora VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS t_fotocopiadora VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS t_fotoc_ope VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS t_fotoc_inop VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS causa_fotoc_inop VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS causa_fotoc_inop VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();


    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS desc_video VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS t_video VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS estado_video VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS causa_video_inop VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();


    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS desc_scanner VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS t_scanner VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS estado_scan VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.info_inventory ADD COLUMN IF NOT EXISTS causa_scan_inop VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();


    // report
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports ADD COLUMN IF NOT EXISTS institucion_formacion VARCHAR(255) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports ADD COLUMN IF NOT EXISTS id_institucion VARCHAR(50) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports ADD COLUMN IF NOT EXISTS isnt_type VARCHAR(50) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports ADD COLUMN IF NOT EXISTS circuito_comunal VARCHAR(50) ");
    $add_column->execute();
    $add_column->fetch();

    // cambiar tamaño de datos
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports  ALTER COLUMN isnt_type TYPE VARCHAR(500) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports  ALTER COLUMN circuito_comunal TYPE VARCHAR(500) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports  ALTER COLUMN institucion_formacion TYPE VARCHAR(500) ");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.reports  ALTER COLUMN organized_by_info TYPE VARCHAR(500) ");
    $add_column->execute();
    $add_column->fetch();

    // services_users
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.services_users ADD COLUMN IF NOT EXISTS user_f_id VARCHAR(50) ");
    $add_column->execute();
    $add_column->fetch();


    // services_users
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.participants_list ADD COLUMN IF NOT EXISTS equipo_sala_comunal VARCHAR(200) ");
    $add_column->execute();
    $add_column->fetch();
    
    // products_list
    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.products_list ADD COLUMN IF NOT EXISTS doc_name VARCHAR(200) ");
    $add_column->execute();
    $add_column->fetch();

    ExecutorPg::doit('ALTER TABLE IF EXISTS public.products_list ADD COLUMN IF NOT EXISTS doc_ttipo VARCHAR(20);');



    // crear index para restringir duplicados
    // $add_column = $conn->prepare("DROP INDEX idx_code");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_column = $conn->prepare("DROP INDEX idx_code_process");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_column = $conn->prepare("DROP INDEX idx_info_code");
    // $add_column->execute();
    // $add_column->fetch();





    // ===== SOLO UNA EJECUCION | COMENTAR LUEGO 29/09/2025
    $add_column = $conn->prepare("CREATE UNIQUE INDEX IF NOT EXISTS idx_code ON public.info_inventory(code_info, k_info)");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("CREATE UNIQUE INDEX IF NOT EXISTS idx_code_process ON public.info_process(code_info, k_info)");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("CREATE UNIQUE INDEX IF NOT EXISTS idx_info_code ON public.infocentros(cod)");
    $add_column->execute();
    $add_column->fetch();


    // coordinators
    // ExecutorPg::doit('TRUNCATE TABLE public.coordinators;');


    // facilitators

    // ExecutorPg::doit('TRUNCATE TABLE public.infocentros CASCADE;');
    // ExecutorPg::doit('TRUNCATE TABLE public.facilitators CASCADE;');
    // ExecutorPg::doit('TRUNCATE TABLE public.info_inventory;');

    // ExecutorPg::doit('ALTER TABLE IF EXISTS facilitators ALTER COLUMN id ADD GENERATED BY DEFAULT AS IDENTITY;');
    ExecutorPg::doit('CREATE SEQUENCE IF NOT EXISTS public.info_facilitators_id_seq;');




    // $add_column = $conn->prepare("DROP INDEX IF EXISTS idx_facilitators_code");
    // $add_column->execute();
    // $add_column->fetch();

    $add_column = $conn->prepare("CREATE INDEX IF NOT EXISTS idx_facilitators_code ON public.facilitators(info_cod)");
    $add_column->execute();
    $add_column->fetch();


    // borra antes de crear para evitar el error
    // $add_column = $conn->prepare("ALTER TABLE IF EXISTS facilitators DROP CONSTRAINT IF EXISTS fk_facilitator_info_cod");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_constraint = $conn->prepare("ALTER TABLE facilitators ADD CONSTRAINT fk_facilitator_info_cod FOREIGN KEY (info_cod) REFERENCES infocentros(cod) ON UPDATE CASCADE NOT VALID");
    // $add_constraint->execute();
    // $add_constraint->fetch();



    // brigades / user_brigades
    // ExecutorPg::doit('TRUNCATE TABLE public.user_brigades;');

    $add_column = $conn->prepare("ALTER TABLE IF EXISTS public.brigades ALTER COLUMN info_id TYPE INTEGER USING (info_id::integer)");
    $add_column->execute();
    $add_column->fetch();

    $add_column = $conn->prepare("CREATE INDEX IF NOT EXISTS idx_brigades_code ON public.brigades(info_cod)");
    $add_column->execute();
    $add_column->fetch();

    // ExecutorPg::doit('UPDATE public.brigades SET info_cod = infocentros.cod FROM infocentros WHERE brigades.info_id = infocentros.id;');
    // ExecutorPg::doit('UPDATE public.user_brigades SET parroquia = infocentros.parroquia FROM infocentros WHERE user_brigades.info_cod = infocentros.cod;');
    // ExecutorPg::doit('UPDATE public.user_brigades SET ciudad = infocentros.ciudad FROM infocentros WHERE user_brigades.info_cod = infocentros.cod;');
    // ExecutorPg::doit('UPDATE public.user_brigades SET comunidad = infocentros.direccion FROM infocentros WHERE user_brigades.info_cod = infocentros.cod;');

    // borra antes de crear para evitar el error
    // $add_column = $conn->prepare("ALTER TABLE IF EXISTS brigades DROP CONSTRAINT IF EXISTS fk_brigades_info_cod");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_constraint = $conn->prepare("ALTER TABLE brigades ADD CONSTRAINT fk_brigades_info_cod FOREIGN KEY (info_cod) REFERENCES infocentros(cod) ON UPDATE CASCADE NOT VALID");
    // $add_constraint->execute();
    // $add_constraint->fetch();

    ExecutorPg::doit('ALTER TABLE IF EXISTS public.user_brigades ADD COLUMN IF NOT EXISTS info_cod VARCHAR(255);');
    ExecutorPg::doit('ALTER TABLE IF EXISTS public.user_brigades ADD COLUMN IF NOT EXISTS municipio VARCHAR(255);');

    // ExecutorPg::doit('ALTER TABLE IF EXISTS user_brigades DROP CONSTRAINT fk_brigade;');
    // ExecutorPg::doit('ALTER TABLE IF EXISTS user_brigades DROP CONSTRAINT fk_user;');

    // ExecutorPg::doit('ALTER TABLE user_brigades ADD CONSTRAINT fk_brigade FOREIGN KEY(fk_id_brigade) REFERENCES brigades(id) ON DELETE CASCADE NOT VALID;');
    // ExecutorPg::doit('ALTER TABLE user_brigades ADD CONSTRAINT fk_user FOREIGN KEY(fk_id_user) REFERENCES final_users(id) ON DELETE CASCADE;');

    // ExecutorPg::doit('UPDATE public.user_brigades SET fk_id_brigade = brigades.id FROM brigades WHERE brigades.info_cod = user_brigades.info_cod;');



    // =======






    // INFOCENTROS

    // ExecutorPg::doit('ALTER TABLE infocentros ALTER COLUMN observacion_tecnica TYPE VARCHAR(2000);');
    ExecutorPg::doit('ALTER TABLE infocentros ALTER COLUMN observacion_tecnica DROP NOT NULL;');
    // ExecutorPg::doit('ALTER TABLE infocentros ALTER COLUMN creacion_year TYPE VARCHAR(50);');
    ExecutorPg::doit('ALTER TABLE infocentros ALTER COLUMN creacion_year DROP NOT NULL;');


    // ExecutorPg::doit('TRUNCATE TABLE public.infocentros CASCADE;');

    // ExecutorPg::doit('ALTER TABLE infocentros ALTER COLUMN id SET GENERATED BY DEFAULT;');
    // ExecutorPg::doit('ALTER SEQUENCE public.infocentros_id_seq RESTART WITH 1;');
    // ExecutorPg::doit('ALTER SEQUENCE public.info_process_id_seq RESTART WITH 1;');
    // ExecutorPg::doit('ALTER SEQUENCE public.info_inventory_id_seq RESTART WITH 1;');

    // SELECT setval(pg_get_serial_sequence('infocentros', 'id'),COALESCE((SELECT MAX(id) FROM infocentros), 1))
    // SELECT setval(pg_get_serial_sequence('facilitators', 'id'),COALESCE((SELECT MAX(id) FROM facilitators), 1))



    // $add_column = $conn->prepare("CREATE INDEX IF NOT EXISTS idx_info_process_code ON public.info_process(code_info)");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_column = $conn->prepare("CREATE INDEX IF NOT EXISTS idx_info_inventory_code ON public.info_inventory(code_info)");
    // $add_column->execute();
    // $add_column->fetch();

    // ExecutorPg::doit('UPDATE public.info_process SET code_info = infocentros.cod FROM infocentros WHERE info_process.k_info = infocentros.id;');
    // ExecutorPg::doit('UPDATE public.info_inventory SET code_info = infocentros.cod FROM infocentros WHERE info_inventory.k_info = infocentros.id;');


    // borra antes de crear para evitar el error
    // $add_column = $conn->prepare("ALTER TABLE IF EXISTS info_process DROP CONSTRAINT IF EXISTS fk_info_process_code_info");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_constraint = $conn->prepare("ALTER TABLE info_process ADD CONSTRAINT fk_info_process_code_info FOREIGN KEY (code_info) REFERENCES infocentros(cod) ON UPDATE CASCADE NOT VALID");
    // $add_constraint->execute();
    // $add_constraint->fetch();

    // // borra antes de crear para evitar el error
    // $add_column = $conn->prepare("ALTER TABLE IF EXISTS info_inventory DROP CONSTRAINT IF EXISTS fk_info_inventory_code_info");
    // $add_column->execute();
    // $add_column->fetch();

    // $add_constraint = $conn->prepare("ALTER TABLE info_inventory ADD CONSTRAINT fk_info_inventory_code_info FOREIGN KEY (code_info) REFERENCES infocentros(cod) ON UPDATE CASCADE NOT VALID");
    // $add_constraint->execute();
    // $add_constraint->fetch();
    // =======




    // ENCUESTA TECNOLOGICA

    // UPDATE public.encuesta_capacidades_tecnologicas SET code_info = facilitators.info_cod FROM facilitators WHERE encuesta_capacidades_tecnologicas.user_dni = facilitators.document_number


    // ExecutorPg::doit('ALTER TABLE encuesta_capacidades_tecnologicas ALTER COLUMN suggestions_provided TYPE VARCHAR(1000);');

    $add_column = $conn->prepare("CREATE INDEX IF NOT EXISTS idx_encuesta_code ON public.encuesta_capacidades_tecnologicas(code_info)");
    $add_column->execute();
    $add_column->fetch();

    // borra antes de crear para evitar el error
    ExecutorPg::doit('ALTER TABLE IF EXISTS encuesta_capacidades_tecnologicas DROP CONSTRAINT IF EXISTS fk_encuesta_info_cod;');
    // ==

    // $add_constraint = $conn->prepare("ALTER TABLE encuesta_capacidades_tecnologicas ADD CONSTRAINT fk_encuesta_info_cod FOREIGN KEY (code_info) REFERENCES infocentros(cod) ON UPDATE CASCADE NOT VALID");
    // $add_constraint->execute();
    // $add_constraint->fetch();
    // =======


    // LOS CONSTRAINTS CON EL CODIGO DE INFOCENTRO SON:
    // brigadas, facilitators, encuesta_capacidades_tecnologicas


    // SE COLOCO CONSTRAINT EN LA ENCUESTA TECNOLOGICA CON EL CODIGO DEL INFOCENTRO, NO SE PUEDE ACTUALIZAR POR LOTE PORQUE NO TIENE EL ID DEL INFOCENTRO

    // NO SE PUEDE ACTUALIZAR LOS CODIGOS EN REPORTS PORQUE LOS DATOS DE USERS ESTAN EN MYSQL


    // FALTA ACTUALIZAR LOS ID DE LOS INFOCENTROS EN LAS TABLAS:
    // brigades
    // encuesta_capacidades_tecnologicas
    // reportes
    // productos
    // enlaces RRSS

    // ============= PENDIENTE EN EL SERVER - Antes de importar facilitadores ==============
    // CREATE SEQUENCE IF NOT EXISTS public.info_facilitators_id_seq
    // CREATE INDEX IF NOT EXISTS idx_facilitators_code ON public.facilitators(info_cod)




    // BORRAR CONSTRAINTS Y VOLVER A CREARLAS

    ExecutorPg::doit('ALTER TABLE IF EXISTS public.specific_action DROP CONSTRAINT IF EXISTS fk_k_strategic;');
    ExecutorPg::doit('ALTER TABLE IF EXISTS public.specific_action DROP CONSTRAINT IF EXISTS fk_name_strategic;');
    ExecutorPg::doit('ALTER TABLE IF EXISTS public.specific_action DROP CONSTRAINT IF EXISTS fk_name_line_action;');
    ExecutorPg::doit('ALTER TABLE specific_action ADD CONSTRAINT fk_k_strategic FOREIGN KEY(k_strategic) REFERENCES public.strategic_action(id) ON DELETE CASCADE ON UPDATE CASCADE NOT VALID;');
    ExecutorPg::doit('ALTER TABLE specific_action ADD CONSTRAINT fk_name_strategic FOREIGN KEY (name_strategic) REFERENCES public.strategic_action(name_action) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;');
    ExecutorPg::doit('ALTER TABLE specific_action ADD CONSTRAINT fk_name_line_action FOREIGN KEY (name_line_action) REFERENCES public.actions_line(line_name) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;');
    
    // $add_column = $conn->prepare("DROP INDEX IF EXISTS idx_facilitators_code");

    ExecutorPg::doit('DROP INDEX IF EXISTS idx_line_action;');
    ExecutorPg::doit('DROP INDEX IF EXISTS idx_line_id;');
    // ExecutorPg::doit('CREATE UNIQUE INDEX IF NOT EXISTS idx_line_id ON public.strategic_action(line_id);');
    ExecutorPg::doit('ALTER TABLE IF EXISTS strategic_action DROP CONSTRAINT IF EXISTS fk_line_action;');
    ExecutorPg::doit('ALTER TABLE IF EXISTS strategic_action DROP CONSTRAINT IF EXISTS fk_strategic_action_line;');
    ExecutorPg::doit('ALTER TABLE strategic_action ADD CONSTRAINT fk_line_action FOREIGN KEY(line_action) REFERENCES actions_line(line_name) ON DELETE CASCADE ON UPDATE CASCADE NOT VALID;');
    ExecutorPg::doit('ALTER TABLE strategic_action ADD CONSTRAINT fk_strategic_action_line FOREIGN KEY(line_id) REFERENCES actions_line(line_id) ON DELETE CASCADE ON UPDATE CASCADE NOT VALID;');
    

    ExecutorPg::doit('ALTER TABLE IF EXISTS training_type DROP CONSTRAINT IF EXISTS fk_training_to_name_line_action;');
    ExecutorPg::doit('ALTER TABLE IF EXISTS training_type DROP CONSTRAINT IF EXISTS fk_training_to_name_strategic_action;');
    ExecutorPg::doit('ALTER TABLE IF EXISTS training_type DROP CONSTRAINT IF EXISTS fk_training_to_name_specific_action;');
    ExecutorPg::doit('ALTER TABLE training_type ADD CONSTRAINT fk_training_to_name_line_action FOREIGN KEY(name_line_action) REFERENCES actions_line(line_name) ON DELETE CASCADE ON UPDATE CASCADE NOT VALID;');
    ExecutorPg::doit('ALTER TABLE training_type ADD CONSTRAINT fk_training_to_name_strategic_action FOREIGN KEY (name_strategic_action) REFERENCES public.strategic_action(name_action) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;');
    ExecutorPg::doit('ALTER TABLE training_type ADD CONSTRAINT fk_training_to_name_specific_action FOREIGN KEY (name_specific_action) REFERENCES public.specific_action(name_specific_action) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;');


    ExecutorPg::doit('ALTER TABLE IF EXISTS tipo_taller DROP CONSTRAINT IF EXISTS fk_tipotaller_to_name_training_type;');
    ExecutorPg::doit('ALTER TABLE tipo_taller ADD CONSTRAINT fk_tipotaller_to_name_training_type FOREIGN KEY (name_training_type) REFERENCES public.training_type(name_training_type) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;');


// https://infoapp2.infocentro.gob.v|e/core/app/view/exportxlsxmysql.php?param=SELECT%20*%20from%20tipo_taller%20order%20by%20id%20asc&param_sql=true&filename=tipo_taller


    // ACTUALIZAR LAS FECHAS DE LOS REPORTES | 28-01-2025
    // ExecutorPg::doit(" UPDATE public.reports SET date_ini = ( TO_DATE(split_part(date_pub,'/',1), 'YYYY/MM/DD') ) where split_part(date_pub,'/',2)='' ");
    // ExecutorPg::doit(" UPDATE public.reports SET date_ini = ( TO_DATE(split_part(date_pub,'/',1), 'DD/MM/YYYY') ) where split_part(date_pub,'/',2)!='' AND id!='29005' ");
    // ExecutorPg::doit(" UPDATE public.reports SET date_ini = ( TO_DATE(split_part(date_pub,'/',1), 'YYYY/MM/DD') ) where id='29005' ");

    // ExecutorPg::doit(" UPDATE public.reports SET date_end = ( TO_DATE(split_part(date_pub,'/',2), 'DD/MM/YYYY') ) where split_part(date_pub,'/',2)!='' AND id!='29005' and id != '45383' ");
    // ExecutorPg::doit(" UPDATE public.reports SET date_end = ( TO_DATE(split_part(date_pub,'/',2), 'YYYY/MM/DD') ) where id='29005' ");
    // ExecutorPg::doit(" UPDATE public.reports SET date_end = ( TO_DATE(split_part(date_pub,'/',2), 'DDMM/YYYY') ) where id='45383' ");


    // UPDATE public.strategic_action SET line_id = actions_line.line_id FROM actions_line WHERE strategic_action.line_action = actions_line.line_name;
    
    // ExecutorPg::doit('UPDATE public.strategic_action SET line_id = actions_line.line_id FROM actions_line WHERE strategic_action.line_action = actions_line.line_name;');






    // eliminar registros de varias tablas
    // DELETE tablaA.*, tablaB.* FROM tablaA, TablaB WHERE tablaA.id = tablaB.id;
}
?>




<!-- VIEW HTML -->




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <span>Cónsola psql</span>

    <!-- CDN de Ace Editor y estilo (se puede ajustar la altura y ancho en el CSS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css" media="screen">
        #editor {
            height: 200px;
            width: 900px;
            font-size: 18px;
        }
    </style>
</head>

<body>


    <form action="" method="post">
        <!-- El contenedor del editor (este no es el campo del formulario) -->
        <div id="editor"></div>

        <!-- El textarea oculto que enviará el contenido -->
        <textarea id="code_textarea" name="query" style="display: none;"></textarea>

        <br>
        <button type="submit">Ejecutar</button>
    </form>

    <script>
        // Inicializar Ace Editor
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/chrome");
        editor.getSession().setMode("ace/mode/javascript");

        // Obtener el textarea oculto
        var codeTextarea = document.getElementById("code_textarea");

        // Sincronizar el contenido del editor con el textarea
        // El evento 'change' se dispara cada vez que el contenido del editor cambia.
        editor.getSession().on('change', function() {
            codeTextarea.value = editor.getSession().getValue();
        });

        // Opcional: Para inicializar el textarea con el contenido inicial del editor
        codeTextarea.value = editor.getSession().getValue();
    </script>

</body>

</html>





<div class="row">
    <div class="col-md-12">

        <div class="col-lg-4">
            <a href="./index.php?view=databasePg&alterdb=true" class="btn btn-info btn-block">Alter BD Pg</a>
        </div>

    </div class="col-md-12">
</div class="row">