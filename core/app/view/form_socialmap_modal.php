<?php

$user_id = $_SESSION['user_id'];
$cod_info = "'".$_SESSION['user_code_info']."'";


$socialmap_students = SocialMapStudentsData::getBySQL("SELECT * from info_social_map_educations where code_info = $cod_info ");
$socialmap_org = SocialMapOrganizationsData::getBySQL("SELECT * from info_social_map_organizations where code_info = $cod_info ");

$socialmap = SocialMapData::getByInfo($cod_info);
$id_map = $socialmap->id;
$progress = $socialmap->progress;

// function update_field($id,$field,$data){
//     echo '<script>alert("Lola");';
// }

?>

<?php if(isset($_GET['swal']) && $_GET['swal']!= ""): ?>
	<?php Core::toast("warning",$_SESSION["alert"],'false'); ?>
	<!?php Core::toast_down("warning",$_GET['swal'],'true'); ?>
	<!?php Core::alert_layout("warning",$_SESSION["alert"],'false'); ?>

<?php endif; ?>





<div id="cover-spin"></div>





<script language="javascript">



var data_field_school = {};
var data_field_organization = {};



$(document).ready(function(){

    // carga las organizations de la DB
    <?php foreach($socialmap_org as $p):?>
        load_organization(<?php echo $p->id;?>,<?php echo $p->organization_id;?>,`<?php echo $p->code_info;?>`,`<?php echo $p->organization_type;?>`,`<?php echo $p->organization_connection_type;?>`,`<?php echo $p->organization_name;?>`,`<?php echo $p->organization_dni;?>`,`<?php echo $p->organization_map_ubication;?>`,`<?php echo $p->organization_limit_area;?>`,`<?php echo $p->organization_address;?>`,`<?php echo $p->organization_n_population;?>`,`<?php echo $p->organization_n_population_female;?>`,`<?php echo $p->organization_n_population_male;?>`);
    <?php endforeach;?>

    // carga las school de la DB
    <?php foreach($socialmap_students as $p):?>
        load_school(<?php echo $p->id;?>,<?php echo $p->school_id;?>,`<?php echo $p->code_info;?>`,`<?php echo $p->school_type;?>`,`<?php echo $p->school_name;?>`,`<?php echo $p->school_address;?>`,`<?php echo $p->dea_code;?>`,`<?php echo $p->school_n_students;?>`,`<?php echo $p->school_n_students_female;?>`,`<?php echo $p->school_n_students_male;?>`);
    <?php endforeach;?>


	var Name_OS = "Unknown OS";
	// OS NAME
	if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
	if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
	if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
	if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
	if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
	// console.log(Name_OS);

	// navegador web en escritorio
	var sBrowser, sUsrAg = navigator.userAgent;

	if(sUsrAg.indexOf("Chrome") > -1) {
		sBrowser = "Chrome";
	} else if (sUsrAg.indexOf("Safari") > -1) {
		sBrowser = "Safari";
	} else if (sUsrAg.indexOf("Opera") > -1) {
		sBrowser = "Opera";
	} else if (sUsrAg.indexOf("Firefox") > -1) {
		sBrowser = "Firefox";
	} else if (sUsrAg.indexOf("MSIE") > -1) {
		sBrowser = "Internet Explorer";
	}
	
    if (Name_OS == "Android"){
        get_Name = Name_OS + "|" + sBrowser;
    }else{
        get_Name = Name_OS + "|" + sBrowser;
    }



	// // // AVISO
	// if (Name_OS != "Android"){
	// 	Swal.fire({
	// 	// position: 'top-center',
	// 	icon: 'warning',
	// 	title: 'Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.\n',
	// 	showConfirmButton: true,
	// 	// timer: 1000
	// 	})
	// }else{
	// 	alert('Hemos reseteado la carga de actividades.\n Sin embargo la data de los participantes sigue activa para la buśqueda por C.I o nombre.');
	// }




    var delayTimer;

    $(function(){

        // actualiza datos del campo segun su tipo
        $(document).on('change', 'input[data="field"]', function (event) {

            field_id = this.id;
            data = $(this).val();
            if (data < 0){
                toastify('La cantidad debe ser mayor o igual a cero',true,15000,"error");
                return;
            }
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {updatefield(field_id,data)}, 600);
        });

        $(document).on('change', 'select[data="field"]', function (event) {
            field_id = this.id;
            data = $(this).val();
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {updatefield(field_id,data)}, 600);
        });

        $(document).on('change', 'textarea[data="field"]', function (event) {
            field_id = this.id;
            data = $(this).val();
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {updatefield(field_id,data)}, 600);
        });





        // MANAGER SCHOOL
        $(document).on('change', 'input[data="field_school"]', function (event) {
            id = this.id;
            field = this.dataset.field;
            data = $(this).val();
            console.log(field);
            if (data < 0){
                toastify('La cantidad debe ser mayor o igual a cero',true,15000,"error");
                return;
            }

            if(field=='school_name' || field=='school_address'){
                validar_texto = verificarMayusculas(data);
                if (validar_texto == 0){
                    this.value = "";
                    return;
                }
            }
            

            if ("id" in data_field_school === false || data_field_school["id"] === id){
                data_field_school["id"] = id;
                data_field_school[field] = data.replace('"','\"');
            }else {
                alert("Tienes cambios sin guardar en la institución editada anteriormente, primero guarda para editar ésta");
                this.value = "";
                return;
            }
        });

        $(document).on('change', 'select[data="field_school"]', function (event) {
            id = this.id;
            field = this.dataset.field;
            data = $(this).val();

            if ("id" in data_field_school === false || data_field_school["id"] === id){
                data_field_school["id"] = id;
                data_field_school[field] = data.replace('"','\"');
            }else {
                alert("Tienes cambios sin guardar en la institución editada anteriormente, primero guarda para editar ésta");
                this.value = "";
                return;
            }
        });

        $(document).on('change', 'textarea[data="field_school"]', function (event) {
            id = this.id;
            field = this.dataset.field;
            data = $(this).val();

            if ("id" in data_field_school === false || data_field_school["id"] === id){
                data_field_school["id"] = id;
                data_field_school[field] = data.replace('"','\"');
            }else {
                alert("Tienes cambios sin guardar en la institución editada anteriormente, primero guarda para editar ésta");
                this.value = "";
                return;
            }
        });
        // END MANAGER SCHOOL


        // MANAGER ORGANIZATION
        $(document).on('change', 'input[data="field_organization"]', function (event) {
            id = this.id;
            field = this.dataset.field;
            console.log(field);
            data = $(this).val();
            if (data < 0){
                toastify('La cantidad debe ser mayor o igual a cero',true,15000,"error");
                return;
            }

            if(field=='organization_name' || field=='organization_address'){
                validar_texto = verificarMayusculas(data);
                if (validar_texto == 0){
                    this.value = "";
                    return;
                }
            }


            if ("id" in data_field_organization === false || data_field_organization["id"] === id){
                data_field_organization["id"] = id;
                data_field_organization[field] = data.replace('"','\"');
            }else {
                alert("Tienes cambios sin guardar en la organización editada anteriormente, primero guarda para editar ésta");
                this.value = "";
                return;
            }

        });

        $(document).on('change', 'select[data="field_organization"]', function (event) {
            id = this.id;
            field = this.dataset.field;
            data = $(this).val();

            if ("id" in data_field_organization === false || data_field_organization["id"] === id){
                data_field_organization["id"] = id;
                data_field_organization[field] = data.replace('"','\"');
            }else {
                alert("Tienes cambios sin guardar en la organización editada anteriormente, primero guarda para editar ésta");
                this.value = "";
                return;
            }

        });

        $(document).on('change', 'textarea[data="field_organization"]', function (event) {
            id = this.id;
            field = this.dataset.field;
            data = $(this).val();

            validar_texto = verificarMayusculas(data);
            if (validar_texto == 0){
                this.value = "";
                return;
            }

            if ("id" in data_field_organization === false || data_field_organization["id"] === id){
                data_field_organization["id"] = id;
                data_field_organization[field] = data.replace('"','\"');
            }else {
                alert("Tienes cambios sin guardar en la organización editada anteriormente, primero guarda para editar ésta");
                this.value = "";
                return;
            }
        });
        // END MANAGER ORGANIZATION


    });





});




function verificarMayusculas(mensaje){

    var result = checkType(mensaje);
    // alert(result);

    if (result == '0') {
        // primera minusculas
        if (getOS() == "Android") {
            alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");
        } else {
            toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.", true, 20000, "error"); // [message, autohide]
        }
        // document.getElementById("nombre_act").focus();
        return 0;
    } else if (result == '1') {
        // todo minusculas
        if (getOS() == "Android") {
            alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");
        } else {
            toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.", true, 20000, "error"); // [message, autohide]
        }
        // document.getElementById("nombre_act").focus();
        return 0;
    } else if (result == '2') {
        // mayusculas
        if (getOS() == "Android") {
            alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");
        } else {
            toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.", true, 20000, "error"); // [message, autohide]
        }
        // document.getElementById("nombre_act").focus();
        return 0;
    } else if (result == '3') {
        // mayusculas y minusculas
        if (getOS() == "Android") {
            alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");
        } else {
            toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.", true, 20000, "warning"); // [message, autohide]
        }
        // document.getElementById("nombre_act").focus();
        return 1;
    } else {
        // console.log('El mensaje no incluye letras');
    }

}


function checkType(mensaje) {
    mensaje = mensaje.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')
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
    if (regxs.upper.test(mensaje)) {
        return '2';
    }
    if (regxs.upperLower.test(mensaje)) {
        return '3';
    }
    return -1;
}




// updatefield_async
async function updatefield(field,data){

    code_info = '<?php echo $_SESSION['user_code_info']; ?>';
    user_type = <?php echo $_SESSION['user_type']; ?>;

    if (code_info === "" || user_type === ""){alert("Tus datos de usuario no fueron cargados correctamente, por favor vuelve a iniciar sessión para seguir cargando."); return;}

    let data_up = new FormData();
    data_up.append("id", <?php echo $id_map; ?>);
    data_up.append("code_info", code_info);
    data_up.append("field", field);
    data_up.append("data", data);
    $('#cover-spin').show(0);

    try {
        const res = await fetch('index.php?action=async&function=updatefield', {
            // credentials: 'include',
            method: 'POST',
            // headers: {
            //     "Accept": "application/json",
            //     'Content-Type': 'application/json',
            //     // 'Content-Type': 'application/x-www-form-urlencoded'
                
            // },
            
            body: data_up
        });

        if(res.ok){
            const result_await = await res.text();
            var array = JSON.parse(result_await);
            // console.log(array.id);
            toastify('Guardado',true,1000,"dashboard");
            $('#cover-spin').hide(0);

        }else{
            // console.log("Error en la respuesta");
            $('#cover-spin').hide(0);
            toastify('No se guardó el campo ('+field+') por favor espera un momento y modifica otra vez.',true,5000,"warning");
            throw "Error en la respuesta";
        }

    } catch(error) {
        console.log(error);
        toastify(error,true,1000,"warning");
    }


}




function updatefield_school(id,field,data){
    // console.log(id,field,data);
    $.post("index.php?action=socialmapstudents&function=updatefield", {
        id: id,
        field: field,
        data: data

    }, function(response, status){
        if (status == 'success'){
            toastify('Guardado',true,1000,"dashboard");

        }
    }); 

}


function updatefield_organization(id,field,data){
    // console.log(id,field,data);
    $.post("index.php?action=socialmaporganizations&function=updatefield", {
        id: id,
        field: field,
        data: data

    }, function(response, status){
        if (status == 'success'){
            toastify('Guardado',true,1000,"dashboard");

        }
    }); 

}





// MANAGER SCHOOL
var n_school = 1;

function load_school(id_school,school_id,code_info,school_type,school_name,school_address,dea_code,school_n_students,school_n_students_female,school_n_students_male) {
    
    n_school = school_id+1; // coloca el ultimo school_id registrado en la DB
    var new_school = document.getElementById("new_school");
    var newDiv = document.createElement("div");
    newDiv.innerHTML = `
    <div class="shadow-sm p-3 mb-2 bg-light rounded id="n_school_`+id_school+`" "> 
        <div class="row"> 
            <div class="form-group col-md-12">
            </div>

                <div class="form-group col-md-6">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nombre</label>
                    <input value='`+school_name+`' id="`+id_school+`" data-field="school_name" data="field_school" class="form-control" placeholder="Nombre plantel" type="text">
                </div>
                <div class="form-group col-md-6">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Código DEA</label>
                    <input value="`+dea_code+`" id="`+id_school+`" data-field="dea_code" data="field_school" class="form-control" placeholder="Código DEA del plantel" type="text">
                </div>
                <div class="form-group col-md-6">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de plantel</label>
                    <select class="custom-select" id="`+id_school+`" data-field="school_type" data="field_school">
                        <option value="`+school_type+`">`+school_type+`</option>
                        <option value="Pública">Pública</option>
                        <option value="Privada">Privada</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total estudiantes</label>
                    <input value="`+school_n_students+`" id="`+id_school+`" data-field="school_n_students" data="field_school" class="form-control" placeholder="0" type="number">
                </div>
                <div class="form-group col-md-6">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total estudiantes mujeres</label>
                    <input value="`+school_n_students_female+`" id="`+id_school+`" data-field="school_n_students_female" data="field_school" class="form-control" placeholder="0" type="number">
                </div>
                <div class="form-group col-md-6">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total estudiantes hombres</label>
                    <input value="`+school_n_students_male+`" id="`+id_school+`" data-field="school_n_students_male" data="field_school" class="form-control" placeholder="0" type="number">
                </div>
                <div class="form-group col-md-12">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Dirección de la institución (Será visible en las planificaciones)</label>
                    <input value='`+school_address+`' id="`+id_school+`" data-field="school_address" data="field_school" class="form-control" placeholder="Dirección" type="text">
                </div>

            </form>

        </div>
        <button onclick="delete_school(this);" id="`+id_school+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">delete</i></button>
        <button onclick="update_school(this);" id="`+id_school+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">save</i></button>
    </div>
    `;

    new_school.appendChild(newDiv);
}




var delayTimer = 0;
function add_new_school() {
    document.querySelector('#button_add_s').disabled = true;

    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        add_school();
        document.querySelector('#button_add_s').disabled = false;
    }, 1000);
    

}
function add_school() {
    $('#cover-spin').show(0);

    $.post("core/app/view/add_map_school.php", {
        user_id: <?php echo "'".$_SESSION['user_id']."'"; ?>,
        school_id: n_school,
        code_info: <?php echo "'".$_SESSION['user_code_info']."'"; ?>,
        s_state: <?php echo "`".$_SESSION['user_region']."`"; ?>,
        user_name_os: get_Name

    }, function(response, status, data, result){
        if (status == 'success'){
            // console.log(data.responseText);
            var array = JSON.parse(data.responseText);
            id_school = array["id"];
            new_school_id = parseInt(array["school_id"]);
            // console.log(n_school,array["school_id"]);
            $('#cover-spin').hide(0);
              
            new_school(id_school,new_school_id);
            toastify('Agregado a final de la lista',true,3000,"dashboard");

        }else{
            $('#cover-spin').hide(0);
            toastify('Error en agregando institución',true,3000,"warning");

        }
    });


}


function new_school(id_school,new_school_id) {
    var new_school = document.getElementById("new_school");
    var newDiv = document.createElement("div");
    newDiv.innerHTML = `
    <div class="shadow-sm p-3 mb-2 bg-light rounded id="n_school_`+id_school+`" "> 
        <div class="row"> 
            <div class="form-group col-md-12">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nombre</label>
                <input value="" id="`+id_school+`" data-field="school_name" data="field_school" class="form-control" placeholder="Nombre plantel" type="text">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Código DEA</label>
                <input value="" id="`+id_school+`" data-field="dea_code" data="field_school" class="form-control" placeholder="Código DEA del plantel" type="text">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de plantel</label>
                <select class="custom-select" id="`+id_school+`" data-field="school_type" data="field_school">
                    <option selected>Seleccione</option>
                    <option value="Pública">Pública</option>
                    <option value="Privada">Privada</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total estudiantes</label>
                <input value="" id="`+id_school+`" data-field="school_n_students" data="field_school" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total estudiantes mujeres</label>
                <input value="" id="`+id_school+`" data-field="school_n_students_female" data="field_school" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total estudiantes hombres</label>
                <input value="" id="`+id_school+`" data-field="school_n_students_male" data="field_school" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-12">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Dirección de la institución (Será visible en las planificaciones)</label>
                <input value="" id="`+id_school+`" data-field="school_address" data="field_school" class="form-control" placeholder="Dirección" type="text">
            </div>
        </div>
        <button onclick="delete_school(this);" id="`+id_school+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">delete</i></button>
        <button onclick="update_school(this);" id="`+id_school+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">save</i></button>
    </div>
    `;

    new_school.appendChild(newDiv);
    n_school = new_school_id // Incrementa el ID para el proximo registro

}

// END MANAGER SCHOOL







// MANAGER ORGANIZATION
var n_org = 1;

function load_organization(id,organization_id,code_info,organization_type,organization_connection_type,organization_name,organization_dni,organization_map_ubication,organization_limit_area,organization_address,organization_n_population,organization_n_population_female,organization_n_population_male) {
    n_org = organization_id+1; // coloca el ultimo school_id registrado en la DB
    var new_organization = document.getElementById("new_organization");
    var newDiv = document.createElement("div");
    newDiv.innerHTML = `
    <div class="shadow-sm p-3 mb-2 bg-light rounded id="`+id+`" "> 
        <div class="row"> 
            <div class="form-group col-md-12">
            </div>
            <div class="form-group col-md-12">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nombre</label>
                <input value='`+organization_name+`' id="`+id+`" data-field="organization_name" data="field_organization" class="form-control" placeholder="Organización" type="text">
            </div>
            
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de organización</label>
                <select class="custom-select" id="`+id+`" data-field="organization_type" data="field_organization">
                    <option value="`+organization_type+`">`+organization_type+`</option>
                    <option value="Comuna">Comuna</option>
                    <option value="Consejo comunal">Consejo comunal</option>
                    <option value="Circuito comunal">Circuito comunal</option>
                    <option value="Organización privada">Organización privada</option>
                    <option value="Institución pública">Institución pública</option>
                    <option value="ONG">ONG</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Vinculación con el infocentro</label>
                <select class="custom-select" id="`+id+`" data-field="organization_connection_type" data="field_organization">
                    <option value="`+organization_connection_type+`">`+organization_connection_type+`</option>
                    <option value="Directamente al infocentro">Directamente al infocentro</option>
                    <option value="En torno al infocentro">En torno al infocentro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">RIF o Nº de registro</label>
                <input value="`+organization_dni+`" id="`+id+`" data-field="organization_dni" data="field_organization" class="form-control" placeholder="Número de registro" type="text">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total población dentro de la organización</label>
                <input value="`+organization_n_population+`" id="`+id+`" data-field="organization_n_population" data="field_organization" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total de mujeres dentro de la organización</label>
                <input value="`+organization_n_population_female+`" id="`+id+`" data-field="organization_n_population_female" data="field_organization" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total de hombres dentro de la organización</label>
                <input value="`+organization_n_population_male+`" id="`+id+`" data-field="organization_n_population_male" data="field_organization" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-12">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Dirección de la organización</label>
                <input value='`+organization_address+`' id="`+id+`" data-field="organization_address" data="field_organization" class="form-control" placeholder="Dirección" type="text">
            </div>
        </div>
        <button onclick="delete_organization(this);" id="`+id+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">delete</i></button>
        <button onclick="update_organization(this);" id="`+id+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">save</i></button>
    </div>
    `;
    new_organization.appendChild(newDiv);

}




var delayTimer = 0;
function add_new_organization() {
    document.querySelector('#button_add').disabled = true;

    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        add_organization();
        document.querySelector('#button_add').disabled = false;
    }, 1000);
    

}
function add_organization() {
    $('#cover-spin').show(0);

    $.post("core/app/view/add_map_organization.php", {
        user_id: <?php echo "'".$_SESSION['user_id']."'"; ?>,
        organization_id: n_org,
        code_info: <?php echo "'".$_SESSION['user_code_info']."'"; ?>,
        o_state: <?php echo "`".$_SESSION['user_region']."`"; ?>,
        user_name_os: get_Name

    }, function(response, status, data, result){
        if (status == 'success'){
            // console.log(data.responseText);
            var array = JSON.parse(data.responseText);
            id = array["id"];
            new_id = parseInt(array["organization_id"]);
            // console.log(n_school,array["school_id"]);
              
            $('#cover-spin').hide(0);
            new_organization(id,new_id);
            toastify('Agregado a final de la lista',true,3000,"dashboard");

        }else{
            $('#cover-spin').hide(0);
            toastify('Error en agregando organización',true,3000,"warning");

        }
    });


}

function new_organization(id,new_id) {
    var new_organization = document.getElementById("new_organization");
    var newDiv = document.createElement("div");
    newDiv.innerHTML = `
    <div class="shadow-sm p-3 mb-2 bg-light rounded id="n_school_`+id+`" "> 
        <div class="row"> 
            <div class="form-group col-md-12">
            </div>
            <div class="form-group col-md-12">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Nombre</label>
                <input value="" id="`+id+`" data-field="organization_name" data="field_organization" class="form-control" placeholder="Organización" type="text">
            </div>
            
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de organización</label>
                <select class="custom-select" id="`+id+`" data-field="organization_type" data="field_organization">
                    <option selected>Seleccione</option>
                    <option value="Comuna">Comuna</option>
                    <option value="Consejo comunal">Consejo comunal</option>
                    <option value="Circuito comunal">Circuito comunal</option>
                    <option value="Organización privada">Organización privada</option>
                    <option value="Institución pública">Institución pública</option>
                    <option value="ONG">ONG</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Vinculación con el infocentro</label>
                <select class="custom-select" id="`+id+`" data-field="organization_connection_type" data="field_organization">
                    <option selected>Seleccione</option>
                    <option value="Directamente al infocentro">Directamente al infocentro</option>
                    <option value="En torno al infocentro">En torno al infocentro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">RIF o Nº de registro</label>
                <input value="" id="`+id+`" data-field="organization_dni" data="field_organization" class="form-control" placeholder="Número de registro" type="text">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total población dentro de la organización</label>
                <input value="" id="`+id+`" data-field="organization_n_population" data="field_organization" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total de mujeres dentro de la organización</label>
                <input value="" id="`+id+`" data-field="organization_n_population_female" data="field_organization" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Total de hombres dentro de la organización</label>
                <input value="" id="`+id+`" data-field="organization_n_population_male" data="field_organization" class="form-control" placeholder="0" type="number">
            </div>
            <div class="form-group col-md-12">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Dirección de la organización</label>
                <input value="" id="`+id+`" data-field="organization_address" data="field_organization" class="form-control" placeholder="Dirección" type="text">
            </div>
        </div>
        <button onclick="delete_organization(this);" id="`+id+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">delete</i></button>
        <button onclick="update_organization(this);" id="`+id+`" data="btn_school" type="button" class="btn btn-outline-primary"><i class="material-icons btn-icon-prepend" aria-hidden="true">save</i></button>
    </div>
    `;

    new_organization.appendChild(newDiv);
    n_org = new_id // Incrementa el ID para el proximo registro

}

// END MANAGER ORGANIZATION






function update_school(e){
    // console.log(data_field_school);
    $('#cover-spin').show(0);
    $.ajax({
        type: "POST",
        url: "index.php?action=socialmapstudents&function=update",
        data: data_field_school
    })
    .done(function( msg ) {
        toastify('Guardado',true,1000,"dashboard");
        data_field_school = {};
    $('#cover-spin').hide(0);
    })
    .fail(function() {
        toastify('No se guardó el campo, por favor espera un momento y modifica otra vez.',true,5000,"warning");
    $('#cover-spin').hide(0);
    });

}

function update_organization(e){
    $('#cover-spin').show(0);
    $.ajax({
        type: "POST",
        url: "index.php?action=socialmaporganizations&function=update",
        data: data_field_organization
    })
    .done(function( msg ) {
        toastify('Guardado',true,1000,"dashboard");
        data_field_organization = {};
        $('#cover-spin').hide(0);
    })
    .fail(function() {
        toastify('No se guardó el campo, por favor espera un momento y modifica otra vez.',true,5000,"warning");
        $('#cover-spin').hide(0);
    });

}







function delete_school(e){
    field_id = e.id;
    $('#cover-spin').show(0);
    $.post("index.php?action=socialmapstudents&function=delete", {
        id: field_id
    }, function(response, status, data, result){
        if (status == 'success'){
            e.parentNode.remove();
            toastify('Eliminado',true,1000,"dashboard");
            $('#cover-spin').hide(0);
            // if (n_school > 1){
            //     n_school = n_school-1

            // }

        }
    });

    // alert(field_id);
}


function delete_organization(e){
    field_id = e.id;
    $('#cover-spin').show(0);

    $.post("index.php?action=socialmaporganizations&function=delete", {
        id: field_id
    }, function(response, status, data, result){
        if (status == 'success'){
            e.parentNode.remove();
            toastify('Eliminado',true,1000,"dashboard");
            $('#cover-spin').hide(0);
            // if (n_school > 1){
            //     n_school = n_school-1

            // }

        }
    });

    // alert(field_id);
}



</script>









<style>
.responsive {
    max-width: 70%;
  height: auto;

  display: block;
  margin-left: auto;
  margin-right: auto;
  /* width: 60%; */
  
}
</style>




<div class="row justify-content-center">

	<div class="col-md-12">
        <div class="container">

            <img src="assets/comunidad.webp" alt="Nature" class="responsive">
            <div class="row justify-content-center"><h6 class="title">Mapa del Poder Popular en torno al Infocentro</h6></div>  
            <div class="row justify-content-center col px-md-12"><span class="form-text">Por favor ingresa la información de cada campo, la información se guarda automáticamente cada vez que es modificado</span></div> 
            <br>
        </div>

        <div class="container">
            <div class="row">
                
                <!-- expansion pane -->
                <div class="col-md-12 list-group border-primary mb-3" id="accordionOne">

                    <div class="expansion-panel list-group-item bg-light-2 bg-light-2 bg-light-2">
                        <a aria-controls="collapseOne" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapseOne" id="headingOne">
                            Sección #1 | Expresiones organizativas
                            <div class="expansion-panel-icon ml-3 text-black-secondary">
                                <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                                <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                            </div>
                        </a>

                        <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapseOne">
                            <div class="expansion-panel-body">

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->communes_quantity; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="communes_quantity" placeholder="0" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de comunas en el entorno del infocentro</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                                <!-- <label for="exampleFloatingLabel6">Total</label> -->
                                                <input value="<?php echo $socialmap->c_comunal_quantity; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="c_comunal_quantity" placeholder="0" type="number">
                                                <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de Consejos Comunales que existen en el entorno del Infocentro</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    

                                <div class="w-100"></div>
                    

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <textarea data="field" value="<?php echo $socialmap->other_organizations; ?>" class="form-control" id="other_organizations" rows="2"><?php echo $socialmap->other_organizations; ?></textarea>
                                            <small id="exampleFloatingLabel6Help" class="form-text">Otras Organizaciones de Base del Poder Popular en el entorno del Infocentro (Mencione)</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <textarea data="field" value="<?php echo $socialmap->other_organizations_related_to_info; ?>" class="form-control" id="other_organizations_related_to_info" rows="2"><?php echo $socialmap->other_organizations_related_to_info; ?></textarea>
                                            <small id="exampleFloatingLabel6Help" class="form-text">Otras Organizaciones de Base del Poder Popular relacionadas directamente en el Infocentro (Mencione)</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label">
                                                <!-- <label for="exampleFloatingLabel6">Total</label> -->
                                                <textarea data="field" value="<?php echo $socialmap->organizations_activities_on_info; ?>" class="form-control" id="organizations_activities_on_info" rows="2"><?php echo $socialmap->organizations_activities_on_info; ?></textarea>
                                                <small id="exampleFloatingLabel6Help" class="form-text">¿Qué actividades realizan estas Organizaciones de Base del Poder Popular en el Infocentro?</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="w-100"></div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body" id="new_organization">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <button onclick="add_new_organization()" id="button_add" class="btn btn-secondary btn-float btn-float-extended" type="button"><i class="material-icons">add</i>Agregar organización</button>

                                            <div class="form-group floating-label floating-label-lg form-ripple">

                                                <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de organizaciones en el entorno del infocentro</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>

                    <!--  -->
                    <div class="expansion-panel list-group-item bg-light-2 bg-light-2">
                        <a aria-controls="collapseTwo" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapseTwo" id="headingTwo">
                        Sección #2 | Capacidad productiva
                        <div class="expansion-panel-icon ml-3 text-black-secondary">
                            <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                            <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                        </div>
                        </a>
                        <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionOne" id="collapseTwo">
                            <div class="expansion-panel-body">

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <select class="form-control" data="field" id="ventures_around_info">
                                                <option value="<?php echo $socialmap->ventures_around_info; ?>"> <?php echo $socialmap->ventures_around_info; ?></option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                            <small id="exampleFloatingLabel6Help" class="form-text">¿Existen emprendimientos en funcionamiento en el entorno del Infocentro?</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label">
                                                <!-- <label for="exampleFloatingLabel6">Total</label> -->
                                                <textarea data="field" value="<?php echo $socialmap->info_support_to_entrepreneurship; ?>" class="form-control" id="info_support_to_entrepreneurship" rows="2"><?php echo $socialmap->info_support_to_entrepreneurship; ?></textarea>
                                                <small id="exampleFloatingLabel6Help" class="form-text">¿De qué manera apoya el Infocentro a estos emprendimientos?</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                    
                                <div class="w-100"></div>
                               

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                    
                                                <select data="field" id="community_potentials" class="form-control js-example-basic-multiple" multiple>
                                                    <?php $selected = explode(',',$socialmap->community_potentials);?>
                                                    <option <?php $value="Ingeniería en Sistemas"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?> ><?php echo $value;?></option>
                                                    <option <?php $value="Comunicacional"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Electrónica"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Robótica"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Inteligencia Artificial"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Creación de Aplicaciones"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Programación"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Agroalimentaria"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Pesquera"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Pecuaria"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Minería"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Educadores"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Salud"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                    <option <?php $value="Otro"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                </select>

                                            <small id="exampleFloatingLabel6Help" class="form-text">Identifica las potencialidades de la comunidad del entorno de tu Infocentro (Puedes elegir una o más opciones)</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            

                            </div>
                        </div>
                    </div>
                    

                    <div class="expansion-panel list-group-item bg-light-2">
                        <a aria-controls="collapseThree" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapseThree" id="headingThree">
                        Sección #3 | Datos poblacional
                        <div class="expansion-panel-icon ml-3 text-black-secondary">
                            <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                            <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                        </div>
                        </a>
                        <div aria-labelledby="headingThree" class="collapse" data-parent="#accordionOne" id="collapseThree">
                            <div class="expansion-panel-body">

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->families_around_the_info; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="families_around_the_info" placeholder="0" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de familias que habitan en el entorno del Infocentro</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->population_around_the_info; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="population_around_the_info" placeholder="0" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de habitantes en el entorno del Infocentro</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->boy_around_the_info_0_3_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="boy_around_the_info_0_3_age" placeholder="varones de 0-3" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niños (varones) de 0 a 3 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->girl_around_the_info_0_3_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="girl_around_the_info_0_3_age" placeholder="hembras de 0-3" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niñas (hembras) de 0 a 3 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->boy_around_the_info_4_7_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="boy_around_the_info_4_7_age" placeholder="varones de 4-7" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niños (varones) de 4 a 7 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->girl_around_the_info_4_7_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="girl_around_the_info_4_7_age" placeholder="hembras de 4-7" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niñas (hembras) de 4 a 7 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->boy_around_the_info_8_11_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="boy_around_the_info_8_11_age" placeholder="varones de 8-11" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niños (varones) de 8 a 11 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->girl_around_the_info_8_11_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="girl_around_the_info_8_11_age" placeholder="hembras de 8-11" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niñas (hembras) de 8 a 11 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->teenagers_boy_around_the_info_12_15_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="teenagers_boy_around_the_info_12_15_age" placeholder="varones de 12-15" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adolescentes (varones) de 12 a 15 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->teenagers_girl_around_the_info_12_15_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="teenagers_girl_around_the_info_12_15_age" placeholder="hembras de 12-15" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adolescentes (hembras) de 12 a 15 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_boy_around_the_info_16_19_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_boy_around_the_info_16_19_age" placeholder="varones de 16-19" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (varones) de 16 a 19 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_girl_around_the_info_16_19_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_girl_around_the_info_16_19_age" placeholder="hembras de 16-19" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (hembras) de 16 a 19 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_boy_around_the_info_20_23_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_boy_around_the_info_20_23_age" placeholder="varones de 20-23" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (varones) de 20 a 23 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_girl_around_the_info_20_23_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_girl_around_the_info_20_23_age" placeholder="hembras de 20-23" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (hembras) de 20 a 23 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_boy_around_the_info_24_27_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_boy_around_the_info_24_27_age" placeholder="varones de 24-27" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (varones) de 24 a 27 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_girl_around_the_info_24_27_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_girl_around_the_info_24_27_age" placeholder="hembras de 24-27" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (hembras) de 24 a 27 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_boy_around_the_info_28_31_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_boy_around_the_info_28_31_age" placeholder="varones de 28-31" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (varones) de 28 a 31 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->youths_girl_around_the_info_28_31_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="youths_girl_around_the_info_28_31_age" placeholder="hembras de 28-31" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de jóvenes (hembras) de 28 a 31 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->adult_boy_around_the_info_32_35_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="adult_boy_around_the_info_32_35_age" placeholder="varones de 32-35" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos (hombres) de 32 a 35 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->adult_girl_around_the_info_32_35_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="adult_girl_around_the_info_32_35_age" placeholder="hembras de 32-35" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos (mujeres) de 32 a 35 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->adult_boy_around_the_info_36_39_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="adult_boy_around_the_info_36_39_age" placeholder="varones de 36-39" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos (hombres) de 36 a 39 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->adult_girl_around_the_info_36_39_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="adult_girl_around_the_info_36_39_age" placeholder="hembras de 36-39" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos (mujeres) de 36 a 39 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->adult_boy_around_the_info_40_59_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="adult_boy_around_the_info_40_59_age" placeholder="varones de 40-59" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos (hombres) edades entre 40 y 59 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->adult_girl_around_the_info_40_59_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="adult_girl_around_the_info_40_59_age" placeholder="hembras de 40-59" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos (mujeres) edades entre 40 y 59 años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->elderman_around_the_info_60_120_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="elderman_around_the_info_60_120_age" placeholder="varones de 60-mas" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos mayores (hombres) de 60 o más años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->elderwoman_around_the_info_60_120_age; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="elderwoman_around_the_info_60_120_age" placeholder="hembras de 60-mas" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de adultos mayores (mujeres) de 60 o más años de edad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <div class="card text border-primary mb-3">
                                        <div class="card-body">
                                            <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                            <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <input value="<?php echo $socialmap->childrens_w_disability; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="childrens_w_disability" placeholder="total menores con discapacidad" type="number">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de niños y niñas con alguna discapacidad</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                        

                            </div>
                        </div>
                    </div>


                    <!--  -->

                    <div class="expansion-panel list-group-item bg-light-2">
                        <a aria-controls="collapse4" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapse4" id="headingOne">
                        Sección #4 | Servicios de conexión en el territorio
                        <div class="expansion-panel-icon ml-3 text-black-secondary">
                            <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                            <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                        </div>
                        </a>
                        <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapse4">
                            <div class="expansion-panel-body">

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <div class="form-group">
                                            <select class="form-control" data="field" id="major_internet_provider">
                                                <option value="<?php echo $socialmap->major_internet_provider; ?>"> <?php echo $socialmap->major_internet_provider; ?></option>
                                                <option value="CANTV">CANTV</option>
                                                <option value="Movilnet">Movilnet</option>
                                                <option value="Movistar">Movistar</option>
                                                <option value="Digitel">Digitel</option>
                                                <option value="Inter">Inter</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">¿Cuál es el principal proveedor de servicio de internet en su comunidad?</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->other_internet_provider; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="other_internet_provider" placeholder="Nombre" type="text">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Otro proveedor de internet</small>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            <div class="w-100"></div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <div class="form-group">
                                            <select class="form-control" data="field" id="in_wifi_communities_project">
                                                <option value="<?php echo $socialmap->in_wifi_communities_project; ?>"> <?php echo $socialmap->in_wifi_communities_project; ?></option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">¿Este Infocentro forma parte del proyecto Comunidades Wifi?</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->wifi_communities_project_benefited_people; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="wifi_communities_project_benefited_people" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">¿Cuántas personas se benefician del servicio de internet gratuito proporcionado a través del wifi del Infocentro?</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            
                            </div>
                        </div>
                    </div>






                    <!--  -->
                    <div class="expansion-panel list-group-item bg-light-2">
                        <a aria-controls="collapse6" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapse6" id="headingOne">
                        Sección #5 | Equipos tecnológicos
                        <div class="expansion-panel-icon ml-3 text-black-secondary">
                            <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                            <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                        </div>
                        </a>
                        <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapse6">
                            <div class="expansion-panel-body">



                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->n_iphone; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="n_iphone" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de teléfonos inteligentes en el entorno del infocentro</small>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->n_tablets; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="n_tablets" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de tablets en el entorno del infocentro</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->n_canaimitas; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="n_canaimitas" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de canaimitas en el entorno del infocentro</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->n_laptops; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="n_laptops" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de laptos en el entorno del infocentro</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->n_pc; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="n_pc" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de PC de escritorio en el entorno del infocentro</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <input value="<?php echo $socialmap->n_home_w_internet; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="n_home_w_internet" placeholder="0" type="number">
                                        <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de viviendas con internet</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>


                    <!--  -->
                    <div class="expansion-panel list-group-item bg-light-2">
                        <a aria-controls="collapse7" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapse7" id="headingOne">
                        Sección #6 | Instituciones educativas
                        <div class="expansion-panel-icon ml-3 text-black-secondary">
                            <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                            <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                        </div>
                        </a>
                        <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapse7">
                            <div class="expansion-panel-body">


                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label-lg">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                        <div class="form-group">
                                            <select class="form-control" data="field" id="are_educational_institutions">
                                                <option value="<?php echo $socialmap->are_educational_institutions; ?>"> <?php echo $socialmap->are_educational_institutions; ?></option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">¿Existen instituciones educativas dedicadas a la atención de niños, niñas y adolescentes con alguna discapacidad en el entorno del Infocentro?</small>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label">
                                            <!-- <label for="exampleFloatingLabel6">Total</label> -->
                                            <textarea data="field" value="<?php echo $socialmap->info_support_to_educational_institutions; ?>" class="form-control" id="info_support_to_educational_institutions" rows="2"><?php echo $socialmap->info_support_to_educational_institutions; ?></textarea>
                                            <small id="exampleFloatingLabel6Help" class="form-text">¿Cómo apoya el Infocentro a dichas instituciones educativas?</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                
                                            <select data="field" id="public_schools" class="form-control js-example-basic-multiple" multiple>
                                                <?php $selected = explode(',',$socialmap->public_schools);?>
                                                <option <?php $value="Centro de educación"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Inicial"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Escuela"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Liceo"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Escuela-liceo"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Universidad"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Biblioteca"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="INCES"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Centros para personas con discapacidad"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Parasistema"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Ninguno"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                            </select>

                                        <small id="exampleFloatingLabel6Help" class="form-text">Espacios formativos PÚBLICOS en torno al Infocentro</small>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <div class="form-group floating-label floating-label">
                                        <!-- <label for="communes_quantity">Total</label> -->
                                
                                            <select data="field" id="private_schools" class="form-control js-example-basic-multiple" multiple>
                                                <?php $selected = explode(',',$socialmap->private_schools);?>
                                                <option <?php $value="Centro de educación"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Inicial"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Escuela"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Liceo"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Escuela-liceo"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Universidad"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Biblioteca"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Centros para personas con discapacidad"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Parasistema"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                                <option <?php $value="Ninguno"; if (in_array($value,$selected)){echo 'selected="selected" '.'value="'.$value.'"';}else{echo 'value="'.$value.'"';}?>><?php echo $value;?></option>
                                            </select>

                                            <small id="exampleFloatingLabel6Help" class="form-text">Espacios formativos PRIVADOS en torno al Infocentro</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body" id="new_school">
                                        <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span>
                                        <button onclick="add_new_school()" id="button_add_s" class="btn btn-secondary btn-float btn-float-extended" type="button"><i class="material-icons">add</i>Agregar institución</button>

                                        <div class="form-group floating-label floating-label-lg form-ripple">

                                            <small id="exampleFloatingLabel6Help" class="form-text">Cantidad de instituciones educativas en el entorno del infocentro</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>



                </div>
                <!-- end expansion pane -->










                



            </div>
        </div>
	</div>
</div>

<br>
<br>
<br>




<script>
$(document).ready(function() {

    if (window.matchMedia("(min-width: 768px)").matches) {

        $('.js-example-basic-multiple').select2({
            // theme: 'filled',
            placeholder: 'Seleccione',
            width: '450px'
            // minimumResultsForSearch: Infinity /* Hide search on single select */
        });

    } else {
        $('.js-example-basic-multiple').wrap('<div class="textfield-box"></div>');
    }

});

</script>



<style>

.fullscreen-swal{ z-index: 9999 !important; width:100vw !important; height:90vh !important; }

.modal-body {
  padding: 5px;
  position: relative;
}








</style>


