<?php

$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$responsible_type = ResponsibleTypeData::getAll();


// $lineas = ActionsLineData::getNameById(5);
// foreach($lineas as $p):
//     echo($linea_name = $p['line_name']);
//     // echo($p->line_name);

// endforeach;

$location = "index.php?view=report&q=&estado=&participantes=&start_at=&finish_at=";

$con = Database::getCon();
$query = $con->query("select * from report_date_limit");
$res = mysqli_fetch_array($query);
$fecha_ini = $res['date_limit_ini'];
$fecha_end = $res['date_limit_end'];

?>


<script>


        



$(document).ready(function() {

    // las func estan en demo.js
    if (getOS() == "Android"){
        get_Name = getOS() + "|" + getBrowser();
    }else{
        get_Name = getOS() + "|" + getBrowser();
    }
    
// alertas JS
// alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
// toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
// toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000,"warning"); // [message, autohide]
// setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);



// cambiar el parametro de alert
// const url = new URL(window.location);
// url.searchParams.set('swal', '');
// window.history.pushState({}, '', url);

})




// <!-- MODAL SWEET ALERT -->
$(function() {
	<?php if(isset($_GET['swal']) && $_GET['swal']!= ""): ?>
		if (getOS() != "Android"){
				Swal.fire({
				// position: 'top-center',
				icon: 'success',
				title: '<?php echo $_GET['swal']; ?>',
                <?php if(isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "true"): ?>
				showConfirmButton: true,
                <?php endif; ?>
                <?php if(isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "false"): ?>
				showConfirmButton: false,
				timer: 1000
                <?php endif; ?>

				})
		}else{
			
			alert("<?php echo $_GET['swal']; ?>");
		}
	<?php endif; ?>
});








// VALIDAR FORMULARIO
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("activity").addEventListener('submit', validarFormulario); 
});

function validarFormulario(evento) {
	evento.preventDefault();
    mensaje = document.getElementById("nombre_act").value;
    var result = checkType(mensaje);
    // alert(result);
    if (result == '0') {
        // primera minusculas
        if (getOS() == "Android") {
            alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");              
        } else {
            toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.",true,20000,"error"); // [message, autohide]
        }
        document.getElementById("nombre_act").focus();
        return;
    }  else if (result == '1') {
        // todo minusculas
        if (getOS() == "Android") {
            alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");              
        } else {
            toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.",true,20000,"error"); // [message, autohide]
        }
        document.getElementById("nombre_act").focus();
        return;
    }  else if (result == '2') {
        // mayusculas
        if (getOS() == "Android") {
            alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");              
        } else {
            toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.",true,20000,"error"); // [message, autohide]
        }
        document.getElementById("nombre_act").focus();
        return;
    } else if (result == '3') {
        // mayusculas y minusculas
        if (getOS() == "Android") {
            alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");              
        } else {
            toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.",true,20000,"warning"); // [message, autohide]
        }
        // document.getElementById("nombre_act").focus();
    } else {
    // console.log('El mensaje no incluye letras');
    }


    // if (mobile) {
    // 	alert("El recaptcha es requerido");              
    // } else {
    // 	toastify("El recaptcha es requerido",true,10000,"warning"); // [message, autohide]
    // }
    // return;

    $('#cover-spin').show(0);
	this.submit();

}









</script>





<div id="cover-spin"></div>






<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					
					<div class="card-header card-header-primary">
                        <h4 class="title">Agregar actividad</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>
    

                    <br>
                    <div class="card-body">

                    <h5 class="title"> <i class='fa fa-bullhorn icon_label' ></i> NOTA: Toda la información debe ser cargada respetando la ortografía, eso incluye el uso de mayúsculas.</h5>
                    <br>
                        <!-- <form class="form-horizontal" role="form" method="post" action="./?action=addreport" enctype="multipart/form-data"> -->
                        <form id="activity" class="form-horizontal" role="form" method="post" action="./?action=addreport&location=<?php echo $location ?>" enctype="multipart/form-data">
                            <input type="hidden" name="name_os" id="name_os" value="">
                            <input type="hidden" name="estado" id="estados" value="">
                            <input type="hidden" name="municipio" id="municipios" value="">
                            <input type="hidden" name="parroquia" id="parroquias_1" value="">
                            <input type="hidden" name="ciudad" id="ciudades" value="">
                            <input type="hidden" name="personal_type" id="personal_type" value="">
                            <input type="hidden" name="fecha_limite_inicio" id="fecha_limite_inicio" value="<?php echo $fecha_ini ?>">
                            <input type="hidden" name="fecha_limite_final" id="fecha_limite_final" value="<?php echo $fecha_end ?>">
                        

                            <div class="form-row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code_info" class=" control-label"><i class="fa fa-building"></i> Código infocentro</label>
                                        <textarea class="form-control" name="code_info" placeholder="Nombre" id="code_info" required></textarea>
                                        <!-- <input name="estate" id="estate" value=""> -->
                                    </div>
                                </div>

                       

                                <!-- nombre de la actividad -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_act" class=" control-label"><i class="fa fa-newspaper-o"></i> Nombre de la actividad</label>
                                        <textarea class="form-control" name="nombre_act" placeholder="Nombre" id="nombre_act" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion" class=" control-label"><i class="fa fa-map-marker"></i> Dirección de la actividad</label>
                                        <textarea class="form-control" name="direccion" placeholder="Dirección" id="direccion" required></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="linea_accion" class=" control-label"><i class="fa fa-cogs"></i> Linea de acción</label>
                                    <select name="linea_accion" class="form-control" id="linea_accion" required>
                                        <option value="">-- LINEA DE ACCIÓN --</option>
                                        <?php foreach($action_line as $p):?>
                                        <option value="<?php echo $p->line_name; ?>"> <?php echo $p->line_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="tipo_reporte" class=" control-label"><i class="fa fa-reorder"></i> Tipo de reporte</label>
                                    <select name="tipo_reporte" class="form-control" id="tipo_reporte" required>
                                        <option value="">-- TIPO DE REPORTE --</option>
              

                                    </select>
                                    </div>
                                </div>


                                <!-- <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="estado" class=" control-label"><i class="fa fa-map"></i> Estado</label>
                                    <select name="estado" class="form-control" id="estados" required>
                                        <option value="">-- ESTADO --</option>
                                        <!?php foreach($estado as $p):?>
                                        <option value="<!?php echo $p->id_estado; ?>"> <!?php echo $p->estado; ?></option>
                                        <!?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                                

                                <div class="col-lg-6">
                                    <div class="form-group" id='recargar_munic'>
                                        <label for="municipio" class=" control-label"><i class="fa fa-map"></i> Municipio</label>
                                        <select name="municipio" class="form-control" id="municipios" required>
                                        <option value="0">-- MUNICIPIOS --</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="parroquia" class=" control-label"><i class="fa fa-map"></i> Parroquia</label>
                                        <select name="parroquia" class="form-control" id="parroquias_1" required>
                                        <option value="">-- PARROQUIA --</option>
                                        </select>
                                    </div>
                                </div> -->




                                <!-- <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="ciudad" class=" control-label"><i class="fa fa-map"></i> Ciudad</label>
                                    <select name="ciudad" class="form-control" id="ciudades">
                                        <option value="">-- CIUDAD --</option>
                                    </select>
                                    </div>
                                </div> -->


                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="fecha" class=" control-label"><i class="fa fa-calendar"></i> Fecha de la actividad</label>
                                    <input type="date" name="fecha" required class="form-control" id="fecha" placeholder="Fecha">
                                    </div>
                                </div>


                                <!-- FORMACION A LA MEDIDA -->
                                <!-- contenido desarrollado -->
                                <div class="col-md-12">
                                    <div style="display: none" class="form-group" id="contenido">
                                        <label for="contenido_des" class=" control-label"><i class="fa fa-flask"></i> Contenido desarrollado</label>
                                        <textarea class="form-control" name="contenido_des" placeholder="Nombre" id="contenido_des" ></textarea>
                                    </div>
                                </div>


                                <!-- modalida formacion -->
                                <div class="col-lg-4">
                                    <div style="display: none" class="form-group" id="modalidad">
                                        <label for="modalidad_formacion" class=" control-label"><i class="fa fa-users"></i> Modalidad formación</label>
                                        <select name="modalidad_formacion" class="form-control" id="modalidad_formacion">
                                            <option value=""> - MODALIDAD - </option>
                                            <option value="Presencial"> Presencial </option>
                                            <option value="Distancia"> Distancia </option>
                                            <option value="Distancia"> Ambas </option>
                                        </select>
                                    </div>
                                </div>


                                <!-- duracion act -->
                                <div class="col-md-4">
                                    <div style="display: none" class="form-group" id="div_duracion_dias">
                                        <label for="duracion_dias" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración días</label>
                                        <input type="number" class="form-control" value="<?php echo $activity->duration_days;?>" name="duracion_dias" placeholder="Días" id="duracion_dias">
                                        <p class="help-block" style="color:gray;">Días impartiendo formación</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="display: none" class="form-group" id="div_duracion_horas">
                                        <label for="duracion_horas" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración horas</label>
                                        <input type="number" class="form-control" value="<?php echo $activity->duration_hour;?>" name="duracion_horas" placeholder="Horas" id="duracion_horas">
                                        <p class="help-block" style="color:gray;">Horas académicas certificadas</p>
                                    </div>
                                </div>






                                <!-- responsible_type -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="responsable_tipo" class=" control-label"><i class="fa fa-user-plus"></i> Tipo responsable</label>
                                    <select name="responsable_tipo" class="form-control" id="responsable_tipo" required>
                                        <!-- <option value="">-- TIPO --</option> -->
                                        <?php foreach($responsible_type as $p):?>
                                        <option value="<?php echo $p->name; ?>"> <?php echo $p->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>


                                <div class="col-md-4" id="buscar_responsable">
                                    <div class="form-group" id="buscar_responsable">
                                        <label for="buscar_responsable" class=" control-label"><i class="fa fa-search"></i> Buscar responsable</label>
                                        <input type="text" class="form-control" name="buscar_responsable" placeholder="Nombre o cédula" id="b_responsable">
                                    </div>

                                    <!-- <!?php View::Error("<p class='alert alert-warning' style='padding:10px 10px;'>Sin coincidencias </p>");?> -->
                                
                                </div>


                                <!-- name_responsable -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Responsable de actividad</label>
                                        <input type="text" class="form-control" name="responsable_name" placeholder="Nombre" id="responsable_name" required></input>
                                    </div>
                                </div>


                                

                                <!-- dni -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responsible_dni" class=" control-label"><i class="fa fa-credit-card"></i> Cédula del responsable</label>
                                        <input type="text" class="form-control" name="responsible_dni" placeholder="Número" id="responsible_dni" required>
                                    </div>
                                </div>
                                


                                <!-- tel_responsable -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responsable_tel" class=" control-label"><i class="fa fa-phone"></i> Teléfono del Responsable</label>
                                        <input type="tel" class="form-control" name="responsable_tel" placeholder="Teléfono" id="responsable_tel" required>
                                    </div>
                                </div>


                                <!-- correo_responsable -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responsible_email" class=" control-label"><i class="fa fa-envelope"></i> Correo del Responsable</label>
                                        <input type="email" class="form-control" name="responsible_email" placeholder="Correo" id="responsible_email" value="demo@gmail.com" required>
                                    </div>
                                </div>

                                


                                <!-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mujeres" class=" control-label"><i class="fa fa-female"></i> Participantes mujeres</label>
                                        <input type="number" class="form-control" name="mujeres" placeholder="N° mujeres" id="mujeres" required>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hombres" class=" control-label"><i class="fa fa-male"></i> Participantes hombres</label>
                                        <input type="number" class="form-control" name="hombres" placeholder="N° hombres" id="hombres" required>
                                    </div>
                                </div> -->


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instituciones" class=" control-label"><i class="fa fa-building"></i> Organización Comunitaria presente</label>
                                        <input type="text" class="form-control" name="instituciones" placeholder="Nombres" id="instituciones" value="Infocentro" required>
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="observacion" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
                                        <textarea class="form-control" name="observacion" placeholder="Nota" id="observacion"></textarea>
                                    </div>
                                </div>




                                <!-- FILE lista de participantes -->
                                <!-- <div class="col-lg-11">
                                    <div class="row">
                                        <div class="form-group">
                                        <i class="fa fa-file icon_label"></i> <td>Archivo adjunto</td>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <td><input type="file" name="file" id="file" accept="file/*"></td>
                                            <div class="form-group" id="uploadForm_file" > 
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div> -->


                                <div class="col-md-4">
                                        <div class="form-group" >
                                            <td>Imagen 1</td>
                                            <!-- <td><input type="file" name="image" id="image" accept="image/*" capture="camera" > <i class="fa fa-image icon_label"></i></td> -->
                                            <td><input type="file" name="image" id="image" accept="image/*"> <i class="fa fa-image icon_label"></i></td>
                                            <td>(Destacada)</td>
                                            <div class="form-group" id="uploadForm" > <!-- preview -->
                                            </div>
                                        </div>
                                </div>

                                <div class="col-md-4">
                                        <div class="form-group">
                                            <td>Imagen 2</td>
                                            <td><input type="file" name="image2" id="image2" accept="image/*"> <i class="fa fa-image icon_label"></i></td>
                                            <div class="form-group" id="uploadForm2" > <!-- preview -->
                                            </div>
                                        </div>	
                                </div>	

                                <div class="col-md-4">
                                        <div class="form-group">
                                            <td>Imagen 3</td>
                                            <td><input type="file" name="image3" id="image3" accept="image/*"> <i class="fa fa-image icon_label"></i></td>
                                            <div class="form-group" id="uploadForm3" > <!-- preview -->
                                            </div>
                                        </div>	
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" id="add_activity" class="btn btn-default"><i class="fa fa-check"></i> Agregar actividad</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

			</div>
		</div>

	</div>
</div>





<!-- <?php 
$a = "Hola Mundo!";
?>

<script type="text/javascript"> alert( "<!?php echo $a; ?>" ); </script>
 -->




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->

<!-- <script src="../../../assets/js/jquery.min.js"></script> -->
<script language="javascript">


    $(document).ready(function(){
        // ASIGNA EL SISTEMA
        $("#name_os").val(get_Name);

        $("#estados").change(function () {

            $('#municipios').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');
            
            $("#estados option:selected").each(function () {
                id_estado = $(this).val();
            
            // alert(id_estado);
            // alert($("#municipios").val());
    
                $.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
                $("#municipios").html(data);
                });  

                $.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
                $("#ciudades").html(data);
                });          
            });
        })
    });
    

    $(document).ready(function(){
        $("#municipios").change(function () {
            $("#municipios option:selected").each(function () {
                id_municipio = $(this).val();
            // alert(id_municipio);
                
                $.post("core/app/view/getParroquia.php", { id_municipio: id_municipio }, function(data){
                    $("#parroquias_1").html(data);
                });            
            });
        })
    });







    // CARGA DATOS DEL RESPONSABLE CON AJAX Y RETARDO AL ESCRIBIR
    var controladorTiempo = "";

    // retardo entre caracteres
    $(function(){

        $("#buscar_responsable").on("keyup", function() {
            clearTimeout(controladorTiempo);
            controladorTiempo = setTimeout(codigoAJAX, 800);
        });
    });

    function codigoAJAX() {
        code = document.getElementById("code_info").value;
        que = document.getElementById("b_responsable").value;
        // que = que.replace(/\./g,''); reemplaza puntos por nada

        responsable_tipo = document.getElementById("responsable_tipo").value;
        
        if (code == ""){
            alert("Debes asignar el código del infocentro primero");
            return;
        }

        // alert(responsable_tipo);
        if (responsable_tipo === "Facilitador") {
            $.post("core/app/view/getResponsible-view.php", { search: que, info_cod: code }, function(data){
                var array = JSON.parse(data);
                // alert(array["nombre"]);
                if (array["nombre"] === "El responsable no está en ese infocentro"){
                    alert("El responsable no está en ese infocentro");
                    return;
                }
                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                $("#personal_type").val(array["personal_type"]);
                // $("#parroquias_1").val(array["parroquia"]);
                
            }); 
        }
        if (responsable_tipo === "Coordinador" || responsable_tipo === "Jefe de Estado") {
            $.post("core/app/view/getResponsible_coord-view.php", { search: que, info_cod: code }, function(data){
                var array = JSON.parse(data);
                // alert(array["nombre"]);
                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                $("#personal_type").val(array["personal_type"]);
                // $("#parroquias_1").val(array["parroquia"]);
                
            }); 
        }
        if (responsable_tipo != "Facilitador" && responsable_tipo != "Coordinador" && responsable_tipo != "Jefe de Estado") {
            $.post("core/app/view/getResponsible_ger-view.php", { search: que, info_cod: code }, function(data){
                var array = JSON.parse(data);
                // alert(array["telefono"]);
                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                $("#personal_type").val(array["personal_type"]);
                // $("#parroquias_1").val(array["parroquia"]);
                
            }); 
        }

    }
    // =======================




    // CARGA DATOS DEL INFOCENTRO CON AJAX
    $(function(){
        $("#code_info").change(function () {
            code = $(this).val();
            // alert(code);
            $.post("core/app/view/getReportLocation-view.php", { code_info: code }, function(data){
                var array = JSON.parse(data);
                if (array === null){
                    document.getElementById("code_info").value = "";
                    alert("No existe un infocentro con el código: "+code);

                }else{
                    // $("#estate").val(array["estado"]);
                    // alert(array["estado"]);
                    $("#estados").val(array["estado"]);
                    $("#municipios").val(array["municipio"]);
                    $("#parroquias_1").val(array["parroquia"]);
                    $("#ciudades").val(array["ciudad"]);
                }
            });            
        });
    });







    // FECHA LIMITE DE LA ACTIVIDAD
    $(function(){
        fecha_limite_inicio = document.getElementById("fecha_limite_inicio").value;
        fecha_limite_final = document.getElementById("fecha_limite_final").value;
        // const f = new Date("2018/01/30");
        // alert(f);

        $('#fecha').change(function(){
            var value = $(this).val();
                // alert(value);

            if (Date.parse(value)<Date.parse(fecha_limite_inicio) || Date.parse(value)>Date.parse(fecha_limite_final)){
                Swal.fire({
                // position: 'top-center',
                icon: 'warning',
                title: 'La fecha límite de reportes es del: \n'+fecha_limite_inicio+" al "+fecha_limite_final,
                showConfirmButton: true,
                // timer: 1500
                })

                document.getElementById("fecha").value = "";
            }
            else{
          
            }
        });
    })








    $(function(){

        $('#linea_accion').change(function(){
            var value = $(this).val();
            // alert(value);

            // limpiar el select
            const $select = document.querySelector("#tipo_reporte");
            for (let i = $select.options.length; i >= 0; i--) {
                $select.remove(i);
            }

            if (value=='Infocentro adentro'){
                $('#tipo_reporte').append($('<option>').val('Jornada de atención social').text('Jornada de atención social'));
                $('#tipo_reporte').append($('<option>').val('Comunal').text('Comunal'));
                $('#tipo_reporte').append($('<option>').val('Político').text('Político'));
                $('#tipo_reporte').append($('<option>').val('Infocentro como plataforma de apoyo').text('Infocentro como plataforma de apoyo'));
                $('#tipo_reporte').append($('<option>').val('Organización interna de infocentro').text('Organización interna de infocentro'));
                $('#tipo_reporte').append($('<option>').val('Mantenimiento').text('Mantenimiento'));
                $('#tipo_reporte').append($('<option>').val('Movilización').text('Movilización'));
                $('#tipo_reporte').append($('<option>').val('Jornada de limpieza voluntaria al infocentro').text('Jornada de limpieza voluntaria al infocentro'));
                $('#tipo_reporte').append($('<option>').val('Soporte').text('Soporte'));
                $('#tipo_reporte').append($('<option>').val('Vinculación').text('Vinculación'));
            }

            if (value=='Formación a la medida'){
                $('#tipo_reporte').append($('<option>').val('Formación').text('Formación'));
            }

            if (value=='Tejiendo redes'){
                $('#tipo_reporte').append($('<option>').val('Prácticas de comunicación popular').text('Prácticas de comunicación popular'));
            }

            if (value=='Unidades socio-productivas'){
                $('#tipo_reporte').append($('<option>').val('Producción sustentable').text('Producción sustentable'));
            }

            if (value=='Sistematización de Experiencias'){
                $('#tipo_reporte').append($('<option>').val('Experiencias significativas').text('Experiencias significativas'));
            }


            var $contenido = $('#contenido');
            var $modalidad = $('#modalidad');
            var $duracion_dias = $('#div_duracion_dias');
            var $duracion_horas = $('#div_duracion_horas');

            if (value=='Formación a la medida'){
                $($contenido).show();
                $($modalidad).show();
                $($duracion_dias).show();
                $($duracion_horas).show();
                // $('option:not(.' + value + ')', $tabla).hide();
            }
            else{
                // Se ha seleccionado All
                $($contenido).hide();
                $("#contenido_des").val('');
                $($modalidad).hide();
                $("#modalidad_formacion").val('');
                $($duracion_dias).hide();
                $("#duracion_dias").val("");
                $($duracion_horas).hide();
                $("#duracion_horas").val("");
                // $('option', $tabla).show();
            }

        });
    })




    // oculta o muestra motivo de cierre al iniciar
    $(function(){
        var $contenido = $('#contenido');
        var $modalidad = $('#modalidad');
        var $duracion_dias = $('#div_duracion_dias');
        var $duracion_horas = $('#div_duracion_horas');

        var value = $('#linea_accion').val();

        if (value=='Formación a la medida'){
            $($contenido).show();
            $($modalidad).show();
            $($duracion_dias).show();
            $($duracion_horas).show();
            // $('option:not(.' + value + ')', $tabla).hide();
        }
        else{
            // Se ha seleccionado All
            $($contenido).hide();
            $($modalidad).hide();
            $($duracion_dias).hide();
            $($duracion_horas).hide();
            // $('option', $tabla).show();
        }
    })


    $(function(){
        var $buscar_responsable = $('#buscar_responsable');

        // var value = document.getElementById$('#responsable_tipo');
        var value = $('#responsable_tipo').val();

        if (value==''){
            $($buscar_responsable).hide();
        }


        $('#responsable_tipo').change(function(){
            var value = $(this).val();
                // alert(value);

            if (value!='Otro'){
                $($buscar_responsable).show();
            }
            else{
                // Se ha seleccionado All
                $($buscar_responsable).hide();
            }
        });
    })


    

    // preview uploaded image

    $("#image").change(function () {
        filePreview(this);
    });

    function filePreview(input) {
        
        // TAMANYO DE LA IMAGEN
        if (input.files[0].size > 10000000){
            Swal.fire({
            // position: 'top-center',
            icon: 'warning',
            title: 'La imagen:\n '+'"'+input.files[0].name+'"'+' \nNo debe exceder 10MB de peso',
            showConfirmButton: true,
            // timer: 1500
            })
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#uploadForm + img').remove();
                $('#uploadForm').after('<img src="'+e.target.result+'" width="160" height="120"/>');
            }
        }
    }

    // preview uploaded image 2

    $("#image2").change(function () {
        filePreview2(this);
    });

    function filePreview2(input) {

        // TAMANYO DE LA IMAGEN
        if (input.files[0].size > 10000000){
            Swal.fire({
            icon: 'warning',
            title: 'La imagen:\n '+'"'+input.files[0].name+'"'+' \nNo debe exceder 10MB de peso',
            showConfirmButton: true,
            // timer: 1500
            })
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#uploadForm2 + img').remove();
                $('#uploadForm2').after('<img src="'+e.target.result+'" width="160" height="120"/>');
            }
        }
    }



    // preview uploaded image 3

    $("#image3").change(function () {
        filePreview3(this);
    });

    function filePreview3(input) {

        // TAMANYO DE LA IMAGEN
        if (input.files[0].size > 10000000){
            Swal.fire({
            icon: 'warning',
            title: 'La imagen:\n '+'"'+input.files[0].name+'"'+' \nNo debe exceder 10MB de peso',
            showConfirmButton: true,
            // timer: 1500
            })
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#uploadForm3 + img').remove();
                $('#uploadForm3').after('<img src="'+e.target.result+'" width="160" height="120"/>');
            }
        }
    }



    // VALIDA QUE EL TEXTO NO ESTE EN MAYUSCULAS
    $("#nombre_act").change(function () {
        mensaje = $(this).val();
        var result = checkType(mensaje);
        // alert(result);
        if (result == '0') {
            // primera minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");              
            } else {
                toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.",true,20000,"error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        }  else if (result == '1') {
            // todo minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");              
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.",true,20000,"error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        }  else if (result == '2') {
            // mayusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");              
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.",true,20000,"error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '3') {
            // mayusculas y minusculas
            if (getOS() == "Android") {
                alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");              
            } else {
                toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.",true,20000,"warning"); // [message, autohide]
            }
            // document.getElementById("nombre_act").focus();
        } else {
        // console.log('El mensaje no incluye letras');
        }
    });

    $("#direccion").change(function () {
        mensaje = $(this).val();
        var result = checkType(mensaje);
        // alert(result);
        if (result == '0') {
            // primera minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");              
            } else {
                toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.",true,20000,"error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        }  else if (result == '1') {
            // todo minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");              
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.",true,20000,"error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        }  else if (result == '2') {
            // mayusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");              
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.",true,20000,"error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '3') {
            // mayusculas y minusculas
            if (getOS() == "Android") {
                alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");              
            } else {
                toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.",true,20000,"warning"); // [message, autohide]
            }
            // document.getElementById("nombre_act").focus();
        } else {
        // console.log('El mensaje no incluye letras');
        }
    });

    function checkType(mensaje) {
        mensaje = mensaje.replace(/[&\/\\#,+()$~%.'":*?<>{}áéíóú]/g, '')
        mensaje = String(mensaje).trim();
        var primerCaracter = mensaje.charAt(0);
        var primera_minuscula = primerCaracter === primerCaracter.toLowerCase();
        // alert(mensaje);
        const regxs = {
        "lower": /^[a-z0-9 ]+$/,
        "upper": /^[A-Z0-9 ]+$/,
        "upperLower": /^[A-Za-z0-9 ]+$/
        };
        if (primera_minuscula === true) {
            return '0';
        }
        if (regxs.lower.test(mensaje)) {
            return '1';
        }
        if (regxs.upper.test(mensaje)){
            return '2';
        }
        if (regxs.upperLower.test(mensaje)){
            return '3';
        }
        return -1;
    }


</script>
		
	


<style>

.form-group input[type=file] {
opacity: 0;
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 100;
}


.form-group input[name=file] {
opacity: 1;
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 100;
}











</style>

