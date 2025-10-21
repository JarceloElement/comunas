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


function alter_db()
{

    $con = Database::getCon();





    // categoria_productos
    if ($con->query("SHOW TABLES FROM infoappdb01 WHERE Tables_in_infoappdb01 = 'categoria_productos' ")->num_rows != 1) {
        $table_1 = "categoria_productos";
        $sql = "CREATE TABLE IF NOT EXISTS $table_1 (
        id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre_categoria VARCHAR(200) COLLATE latin1_spanish_ci,
        cod_categoria VARCHAR(50) COLLATE latin1_spanish_ci,
        fecha_reg datetime DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci";
        print_r(Executor::doit($sql)[1]);
        echo $table_1 . "--Creada";

        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Aplicación móvil","FI-OCE-01")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Audios","FI-OCE-02")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Diseño gráfico","FI-OCE-03")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Escrito","FI-OCE-04")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Fotografía","FI-OCE-05")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Portal","FI-OCE-06")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Radio","FI-OCE-07")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Redes sociales","FI-OCE-08")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Revista","FI-OCE-09")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("TV","FI-OCE-10")');
        Executor::doit('INSERT INTO categoria_productos (nombre_categoria,cod_categoria) value ("Videos","FI-OCE-11")');



        if ($con->query("SHOW COLUMNS FROM products_type WHERE Field = 'tipo_categoria' ")->num_rows != 1) {
            Executor::doit('ALTER TABLE products_type add column tipo_categoria VARCHAR(50) DEFAULT "" AFTER id;');
        };
        if ($con->query("SHOW COLUMNS FROM products_type WHERE Field = 'cod_producto' ")->num_rows != 1) {
            Executor::doit('ALTER TABLE products_type add column cod_producto VARCHAR(50) DEFAULT "" AFTER name;');
        };

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Aplicación móvil","Telegram","FI-OCE-01-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Aplicación móvil","WhatsApp","FI-OCE-01-2")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Audios","Edición de audio","FI-OCE-02-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Audios","Grabación de audio","FI-OCE-02-2")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Diseño gráfico","Banners","FI-OCE-03-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Diseño gráfico","Flyers","FI-OCE-03-2")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Diseño gráfico","Edición fotografía","FI-OCE-03-3")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Diseño gráfico","Infografías","FI-OCE-03-4")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Diseño gráfico","Paquetes gráficos","FI-OCE-03-5")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Diseño gráfico","Slider","FI-OCE-03-6")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Escrito","Baterías","FI-OCE-04-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Escrito","Artículos","FI-OCE-04-2")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Escrito","Correos","FI-OCE-04-3")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Escrito","Guiones","FI-OCE-04-4")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Escrito","Notas de prensa","FI-OCE-04-5")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Fotografía","Captura básica","FI-OCE-05-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Fotografía","Captura producida","FI-OCE-05-2")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Portal","Página blog","FI-OCE-06-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Portal","Página web","FI-OCE-06-2")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Radio","Radio en vivo","FI-OCE-07-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Radio","Radio podcast","FI-OCE-07-2")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","Facebook","FI-OCE-08-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","Facebook grupo","FI-OCE-08-2")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","Instagram","FI-OCE-08-3")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","Pinterest","FI-OCE-08-4")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","Threads","FI-OCE-08-5")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","TikTok","FI-OCE-08-6")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Redes sociales","YouTube","FI-OCE-08-7")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Revista","Revista digital","FI-OCE-09-1")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("TV","Programa vía streaming","FI-OCE-10-1")');

        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Videos","Edición de video","FI-OCE-11-1")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Videos","Grabación de video","FI-OCE-11-2")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Videos","TikTok","FI-OCE-11-3")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Videos","Video reportaje","FI-OCE-11-4")');
        Executor::doit('INSERT INTO products_type (tipo_categoria,name,cod_producto) value ("Videos","Video tutorial","FI-OCE-11-5")');
    }




    // lineas de accion y formaciones
    // if ($con->query("SHOW COLUMNS FROM training_type WHERE Field = 'codigo_curso' ")->num_rows != 1) {

    //     Executor::doit('ALTER TABLE training_type add column codigo_curso VARCHAR(50) DEFAULT "" AFTER name_training_type;');
    //     Executor::doit('ALTER TABLE training_type add column duracion_horas VARCHAR(50) DEFAULT "" AFTER name_training_type;');
    //     Executor::doit('ALTER TABLE training_type add column nivel_curso VARCHAR(50) DEFAULT "" AFTER duracion_horas;');
    //     Executor::doit('ALTER TABLE training_type add column modalidad_curso VARCHAR(50) DEFAULT "" AFTER nivel_curso;');
    //     Executor::doit('ALTER TABLE training_type add column ejes_actuacion VARCHAR(200) DEFAULT "" AFTER modalidad_curso;');
    //     Executor::doit('ALTER TABLE training_type add column tipo_certificacion VARCHAR(200) DEFAULT "" AFTER ejes_actuacion;');
    //     Executor::doit('ALTER TABLE training_type add column contenido_curso VARCHAR(200) DEFAULT "" AFTER tipo_certificacion;');
    //     echo "modificada-training_type<br>";

    //     Executor::doit(' TRUNCATE TABLE training_type; ;');

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Curso De Stop Motion Iniciación','FIGF-C-SMI-01','25','Básico','Presencial','Todos','Aprobación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos De Robótica Educativa','FIGF-C-RE-01','30','Básico','Presencial','Todos','Aprobación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Python Power Para Todos','FIGF-C-PPT-01','30','Básico','Presencial','Todos','Aprobación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Curso La Ciencia De Juegos Tradicionales','FIGF-C-CDJ-01','4','Básico','Presencial','Niñas, niños y adolescentes en las TIC','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Curso De Ofimática','FIGF-C-DO-01','6','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Curso De Uso De Herramientas De Inteligencia Artificial','FIGF-C-HIA-01','15','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos De Seguridad Digital','FIGF-C-DSD-01','6','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos De Buen Uso De Las Redes Sociales','FIGF-C-BRS-01','15','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos De Diseño Gráfico','FIGF-C-DDG-01','12','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos De Derechos De Las Niñas, Niños Y Jóvenes','FIGF-C-DNNJ-01','6','Básico','Presencial','Todos','Aprobación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Electroaventura','FIGF-C-EA-01','30','Básico','Presencial','Todos','Aprobación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos Comunicación Popular','FIGF-C-CP-01','8','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Cursos De Ciudadanía Digital','FIGF-C-CD-01','2','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Misterios De La Ciencia: ¡Un Viaje Divertido Al Conocimiento!','FIGF-C-MCU-01','3','Básico','Presencial','Todos','Participación','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Curso Un Buen Facilitador','FIGF-C-UBF-01','10','Básico','Presencial','Todos','No aplica','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','FIGF-C-OPF-01','4','Básico','Presencial','Todos','No aplica','https://infocentro.gob.ve')");

    //     Executor::doit("INSERT INTO training_type (name_line_action,name_strategic_action,name_specific_action,name_training_type,codigo_curso,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso) 
    //     value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Gestión Integral De La Fundación Infocentro','FIGF-C-GIFI-01','4','Básico','Presencial','Todos','No aplica','https://infocentro.gob.ve')");
    // };



    // tipo_taller
    // if ($con->query("SHOW TABLES FROM infoappdb01 WHERE Tables_in_infoappdb01 = 'tipo_taller' ")->num_rows != 1) {
    //     $table_2 = "tipo_taller";
    //     $sql_2 = "CREATE TABLE IF NOT EXISTS $table_2 (
    //         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         name_training_type VARCHAR(500) COLLATE latin1_swedish_ci,
    //         nombre_taller VARCHAR(500) COLLATE latin1_swedish_ci,
    //         duracion_horas VARCHAR(50) COLLATE latin1_swedish_ci,
    //         nivel VARCHAR(50) COLLATE latin1_swedish_ci,
    //         modalidad VARCHAR(50) COLLATE latin1_swedish_ci,
    //         FOREIGN KEY (name_training_type) REFERENCES training_type(name_training_type) ON DELETE CASCADE ON UPDATE CASCADE
    //         ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci";
    //     Executor::doit($sql_2)[1];
    //     echo "creada-tipo_taller<br>";

    //     // Crea registros
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Stop Motion Iniciación','Taller De Fotografía Básico','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Stop Motion Iniciación','Taller De Guión Básico','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Stop Motion Iniciación','Taller De Celumetraje Básico','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Stop Motion Iniciación','Taller De Stop Motion Básico','6','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Robótica Educativa','Taller De Lenguaje De Programación Básico','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Robótica Educativa','Taller De Electrónica Básica','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Robótica Educativa','Taller De Tinkerkad','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Robótica Educativa','Taller De Iniciación A La Robótica','30','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Introducción A Python','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Sintaxis Básica','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Estructuras De Datos','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Control De Flujo','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Funciones','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Módulos','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Python Power Para Todos','Aplicaciones De Python','30','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso La Ciencia De Juegos Tradicionales','Taller De Tradiciones De Nuestro País','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso La Ciencia De Juegos Tradicionales','Taller De Creación De Juegos Tradiccionales','4','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Ofimática','Taller Básico De Calc','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Ofimática','Taller Básico De Writer','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Ofimática','Taller Básico Impress','6','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Uso De Herramientas De Inteligencia Artificial','Taller ¿Que Es La Inteligencia Artificial?','15','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Uso De Herramientas De Inteligencia Artificial','Taller De Ventajas Y Desventajas De La IA','15','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso De Uso De Herramientas De Inteligencia Artificial','Taller De Innovaciónes Con La IA','15','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Seguridad Digital','Taller De Ciberseguridad','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Seguridad Digital','Taller De Ciberbullyign','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Seguridad Digital','Taller De Acoso Digital','6','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Buen Uso De Las Redes Sociales','Taller De Facebook','15','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Buen Uso De Las Redes Sociales','Taller De TikTok','15','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Buen Uso De Las Redes Sociales','Taller De Telegram','15','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Buen Uso De Las Redes Sociales','Taller De Instagram','15','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Diseño Gráfico','Taller De Colorimetria','12','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Diseño Gráfico','Taller De Manejo De Canva','12','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Diseño Gráfico','Taller De Diseño De Flayer','12','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Derechos De Las Niñas, Niños Y Jóvenes','Taller De Convención Sobre Los Derechos De La Niñez','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Derechos De Las Niñas, Niños Y Jóvenes','Taller De Derechos De Las Niñas, Niños Y Adolescentes Con Discapacidad','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Derechos De Las Niñas, Niños Y Jóvenes','Taller Formas De Violencia Hacia Niños, Niñas y Adolescentes, Incluida La Violencia Online','6','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Derechos De Las Niñas, Niños Y Jóvenes','Taller De Internet Seguro','6','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Introducción A La Electricidad','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Circuitos Eléctricos','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Componentes Electrónicos Básicos','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Circuitos Digitales','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Instrumentos De Medición','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Conceptos De Electrónica','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Circuitos Impresos (PCB)','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Proyectos Prácticos','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Seguridad En Electricidad Y Electrónica','30','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Electroaventura','Aplicaciones Y Avances De La Electricidad Y La Electrónica','30','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos Comunicación Popular','Taller De Nota De Prensa','8','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos Comunicación Popular','Taller De Creación De Contenido Comunicacional','8','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos Comunicación Popular','Taller De Guerrilla Comunicacional','8','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos Comunicación Popular','Taller De Fotografía Periodística','8','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Ciudadanía Digital','Taller De Banca En línea','2','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Ciudadanía Digital','Taller De VenApp','2','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Cursos De Ciudadanía Digital','Taller Uso Sistema De Protección Social Patria','2','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Misterios De La Ciencia: ¡Un Viaje Divertido Al Conocimiento!','Taller De Experimentos Científicos','3','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Misterios De La Ciencia: ¡Un Viaje Divertido Al Conocimiento!','Taller De Porque Ciencia','3','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Misterios De La Ciencia: ¡Un Viaje Divertido Al Conocimiento!','Taller De La Ciencia Y La Vida','3','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Formación Sociopolítica','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Asambleas Comunitarias','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller Planificación Estratégica Situacional','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Oratoria','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Andragogía','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Pedagogía','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Sensibilización','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller Nueva Cultura De La Discapacidad','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Ciencia Para La Vida','10','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Curso Un Buen Facilitador','Taller De Uso Del Sistema Operativo Canaima Y Herramientas De Accesibilidad','10','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','Recorrido Educativo','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','Recorrido Educativo Mega Núcleos','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','Charla Formativa','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','Cinechamos','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','Conversatorio','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Otros Procesos Formativos / Actividades Lúdica Y Pedagógicas','Cineforos','4','Básico','Presencial')");

    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller Introducción A La Ejecución Del Presupuesto','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller Funcionamiento Y Funciones Del Sistema Integrado De Gestión Administrativa Del Sector Público (Sigesp)','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller De Procesos De Ingresos','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller De Perfiles De Ingresos','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller Funcionamiento De Plataforma En Línea Infoapp','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller Inducción A Los Procedimientos De Legislación Laboral','4','Básico','Presencial')");
    //     Executor::doit("INSERT INTO tipo_taller (name_training_type,nombre_taller,duracion_horas,nivel,modalidad) value ('Gestión Integral De La Fundación Infocentro','Taller De Mitología Y Herramientas Básicas De Infraestructura Dentro De Los Espacios','4','Básico','Presencial')");
    // }



    // if ($con->query("SHOW COLUMNS FROM personal_technological_capabilities WHERE Field = 'user_greater_technological_skill' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE personal_technological_capabilities add column user_greater_technological_skill VARCHAR(500) DEFAULT "N/A" AFTER user_application_creation_skills;');
    // };

    // if ($con->query("SHOW COLUMNS FROM personal_technological_capabilities WHERE Field = 'user_greater_technological_skill_level' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE personal_technological_capabilities add column user_greater_technological_skill_level VARCHAR(50) DEFAULT "N/A" AFTER user_greater_technological_skill;');
    // };

    // if ($con->query("SHOW COLUMNS FROM training_type WHERE Field = 'restringir_categoria' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE training_type add column restringir_categoria VARCHAR(200) DEFAULT "Todos" AFTER codigo_curso;');
    // };

    // if ($con->query("SHOW COLUMNS FROM training_type WHERE Field = 'descripcion_actividad' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE training_type add column descripcion_actividad VARCHAR(200) DEFAULT "" AFTER contenido_curso;');
    // };

    // if ($con->query("SHOW COLUMNS FROM training_type WHERE Field = 'habilitar_descripcion' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE training_type add column habilitar_descripcion VARCHAR(50) DEFAULT "0" AFTER descripcion_actividad;');
    // };

    // if ($con->query("SHOW COLUMNS FROM training_type WHERE Field = 'habilitar_institucion' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE training_type add column habilitar_institucion VARCHAR(50) DEFAULT "0" AFTER habilitar_descripcion;');
    // };

    // if ($con->query("SHOW COLUMNS FROM specific_action WHERE Field = 'has_formation' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE specific_action add column has_formation VARCHAR(50) DEFAULT "No" AFTER name_specific_action;');
    // };

    // if ($con->query("SHOW COLUMNS FROM specific_action WHERE Field = 'permisos' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE specific_action add column permisos VARCHAR(2000) DEFAULT "Todos" AFTER has_formation;');
    // };

    // if ($con->query("SHOW COLUMNS FROM strategic_action WHERE Field = 'permisos' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE strategic_action add column permisos VARCHAR(2000) DEFAULT "Todos" AFTER name_action;');
    // };

    // if ($con->query("SHOW COLUMNS FROM tipo_taller WHERE Field = 'permisos' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE tipo_taller add column permisos VARCHAR(2000) DEFAULT "Todos" AFTER modalidad;');
    // };

    // if ($con->query("SHOW COLUMNS FROM tipo_taller WHERE Field = 'descripcion_taller' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE tipo_taller add column descripcion_taller VARCHAR(500) DEFAULT "" AFTER nombre_taller;');
    // };


    // mapa social
    if ($con->query("SHOW COLUMNS FROM info_social_map_organizations WHERE Field = 'organization_address' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_social_map_organizations add column organization_address VARCHAR(200) DEFAULT "null" AFTER organization_limit_area;');
    };
    if ($con->query("SHOW COLUMNS FROM info_social_map_educations WHERE Field = 'school_address' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_social_map_educations add column school_address VARCHAR(200) DEFAULT "null" AFTER school_name;');
    };

    // Datos
    // if ($con->query("SHOW COLUMNS FROM specific_action WHERE Field = 'activity_description' ")->num_rows != 1) {
    //     Executor::doit('ALTER TABLE specific_action add column activity_description VARCHAR(200) DEFAULT "null" AFTER name_specific_action;');
    // };

    // info_social_map_educations
    if ($con->query("SHOW COLUMNS FROM info_social_map_educations WHERE Field = 'isnt_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_social_map_educations add column isnt_type VARCHAR(50) DEFAULT "Educativa" AFTER school_id;');
    };

    // info_social_map_educations
    if ($con->query("SHOW COLUMNS FROM info_social_map_organizations WHERE Field = 'isnt_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_social_map_organizations add column isnt_type VARCHAR(50) DEFAULT "Organización" AFTER organization_id;');
    };

    // actions_line
    // if ($con->query("SHOW COLUMNS FROM actions_line WHERE Field = 'permisos' ")->num_rows != 1) {
        // Executor::doit('ALTER TABLE actions_line add column permisos VARCHAR(1000) DEFAULT "TODOS" AFTER line_name;');
    // };

    // Executor::doit('UPDATE user set id=1587 where id=1925 ');

    // Executor::doit('ALTER TABLE specific_action CHANGE k_strategic k_strategic VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;');


    // 26 octubre 2025
    Executor::doit('SET FOREIGN_KEY_CHECKS=0;');

    Executor::doit('UPDATE info_social_map_educations INNER JOIN user ON user.id = info_social_map_educations.user_id SET info_social_map_educations.code_info = user.code_info;');
    Executor::doit('UPDATE info_social_map_organizations INNER JOIN user ON user.id = info_social_map_organizations.user_id SET info_social_map_organizations.code_info = user.code_info;');
    Executor::doit('UPDATE info_social_map INNER JOIN user ON user.id = info_social_map.user_id SET info_social_map.code_info = user.code_info;');

    // CREAR UN CONSTRAINT PARA ACTUALIZAR LOS CODIGOS DEL MAPA CON EL CODIGO DEL USUARIO EN MYSQL
    if ($con->query("SHOW INDEX FROM info_social_map WHERE Key_name = 'idx_mapa_info_code' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE `info_social_map` ADD INDEX `idx_mapa_info_code` (code_info);');
    };
    // Executor::doit('ALTER TABLE info_social_map DROP CONSTRAINT info_social_map_ibfk_10;');
    // Executor::doit('ALTER TABLE info_social_map DROP CONSTRAINT info_social_map_ibfk;');
    Executor::doit('ALTER TABLE info_social_map ADD CONSTRAINT `info_social_map_ibfk` FOREIGN KEY (code_info) REFERENCES `user` (code_info) ON UPDATE CASCADE ON DELETE SET NULL;');


    // EJECUTAR CUERY EN MYSQL
    // https://infoapp2.infocentro.gob.ve/core/app/view/exportxlsxmysql.php?param=ALTER+TABLE+info_social_map+DROP+CONSTRAINT+info_social_map_ibfk_10&param_sql=true&filename=usuarios_tipo

    // http://localhost/infoapp/core/app/view/exportxlsxmysql.php?param=ALTER+TABLE+info_social_map+DROP+CONSTRAINT+info_social_map_ibfk&param_sql=true&filename=usuarios_tipo


    // CREAR UN CONSTRAINT PARA ACTUALIZAR EL CODIGO DE LAS INSTITUCIONES CON EL CODIGO DEL USUARIO EN MYSQL
    if ($con->query("SHOW INDEX FROM user WHERE Key_name = 'idx_user_code_info' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE `user` ADD INDEX `idx_user_code_info` (code_info);');
    };

    if ($con->query("SHOW INDEX FROM info_social_map_educations WHERE Key_name = 'idx_map_educations_info_code' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE `info_social_map_educations` ADD INDEX `idx_map_educations_info_code` (code_info);');
    };
    // Executor::doit('ALTER TABLE info_social_map_educations DROP CONSTRAINT `info_map_educations_ibfk`;');
    Executor::doit('ALTER TABLE info_social_map_educations ADD CONSTRAINT `info_map_educations_ibfk` FOREIGN KEY (code_info) REFERENCES `user` (code_info) ON UPDATE CASCADE;');

    if ($con->query("SHOW INDEX FROM info_social_map_organizations WHERE Key_name = 'idx_map_organizations_info_code' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE `info_social_map_organizations` ADD INDEX `idx_map_organizations_info_code` (code_info);');
    };
    // Executor::doit('ALTER TABLE info_social_map_organizations DROP CONSTRAINT `info_social_map_organizations_ibfk_6`;');
    // Executor::doit('ALTER TABLE info_social_map_organizations DROP CONSTRAINT `info_map_organizations_ibfk`;');
    Executor::doit('ALTER TABLE info_social_map_organizations ADD CONSTRAINT `info_map_organizations_ibfk` FOREIGN KEY (code_info) REFERENCES `user` (code_info) ON UPDATE CASCADE;');


    
    // EL CODIGO DEL USUARIO TIENE CONSTRAINTS CON:
    // info_social_map, info_social_map_educations, info_social_map_organizations

    // Executor::doit('SET FOREIGN_KEY_CHECKS=1;');




    // Executor::doit('ALTER TABLE categoria_productos CHANGE nombre_categoria nombre_categoria VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;');
    // Executor::doit('ALTER TABLE `products_type` ADD INDEX(tipo_categoria);');
    // Executor::doit('ALTER TABLE `categoria_productos` ADD INDEX(`nombre_categoria`);');
    // Executor::doit('ALTER TABLE products_type ADD FOREIGN KEY (tipo_categoria) REFERENCES categoria_productos(nombre_categoria) ON DELETE CASCADE ON UPDATE CASCADE;');

    // deshabilitar las claves foraneas para poder eliminar y editar las tablas secundarias














    // eliminar registros de varias tablas
    // DELETE tablaA.*, tablaB.* FROM tablaA, TablaB WHERE tablaA.id = tablaB.id;
}
?>




<!-- VIEW HTML -->

<div class="row">
    <div class="col-md-12">

        <div class="col-lg-4">
            <a href="./index.php?view=database&alterdb=true" class="btn btn-info btn-block">Alter BD</a>
        </div>

    </div class="col-md-12">
</div class="row">