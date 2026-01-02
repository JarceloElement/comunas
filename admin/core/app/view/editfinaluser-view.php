<?php

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$personal_type = PersonalTypeData::getAll();
$user = FinalUsersData::getById($_GET["id"]);
$user_type = UserTypeData::getAll();

$con = Database::getCon();
$etnias = $con->query("select * from etnia_type");
$discapacidad = $con->query("select * from disability_type");
$professions = $con->query("SELECT * from professions order by p_name");
$occupations = $con->query("SELECT * from occupations order by p_name");

?>

<div class="row">
  <div class="card">
    
    <div class="card-header" data-background-color="blue">
        <h4 class="title">Modificar usuario final</h4>
    </div>


    <div class="card-content table-responsive">
    
      <form class="form-horizontal" role="form" method="post" action="./?action=finaluser&function=update">

        <div class="form-group">

            <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"];?>">

          <!-- DATOS DEL FACILITADOR -->


          <div class="col-md-6">
            <div class="form-group ">
            <label for="user_nationality" class=" control-label"><i class="fa fa-user"></i> Tipo de usuario</label>
              <select name="user_type" class="form-control" id="user_type">
                <option value="<?php echo $user->user_type;?>"><?php echo $user->user_type;?></option>
                <?php foreach($user_type as $p):?>
                  <option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_nombres" class=" control-label"><i class="fa fa-user"></i> Nombres</label>
              <input class="form-control" name="user_nombres" id="user_nombres" value="<?php echo $user->user_nombres;?>" placeholder="Nombres" required>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_apellidos" class=" control-label"><i class="fa fa-user"></i> Apellidos</label>
              <input class="form-control" name="user_apellidos" id="user_apellidos" value="<?php echo $user->user_apellidos;?>" placeholder="Apellidos" required>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
            <label for="user_nationality" class=" control-label"><i class="fa fa-user"></i> Nacionalidad</label>
            <select name="user_nationality" class="form-control" id="user_nationality" required>
                <option value="<?php echo $user->user_nationality;?>"><?php echo $user->user_nationality;?></option>
                <option value="<?php echo "V";?>"><?php echo "V";?></option>
                <option value="<?php echo "E";?>"><?php echo "E";?></option>

            </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="user_has_document" class=" control-label"><i class="fa fa-user"></i> ¿Está cedulado?</label>
              <select name="user_has_document" class="form-control" id="user_has_document" required>
                  <option value="">-Elige-</option>
                  <option value="<?php echo "Si";?>">Si</option>
                  <option value="<?php echo "No/Sin partida de nacimiento";?>">No/Sin partida de nacimiento</option>
                  <option value="<?php echo "No/Menor de edad";?>">No/Menor de edad</option>
                  <option value="<?php echo "No/Problemas en documentos";?>">No/Problemas en documentos</option>
                  <option value="<?php echo "No/Pueblo originario";?>">No/Pueblo originario</option>

              </select>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_dni" class=" control-label"><i class="fa fa-user"></i> N° documento</label>
              <input class="form-control" name="user_dni" id="user_dni" value="<?php echo $user->user_dni;?>" placeholder="Número" minlength="6" maxlength="8" required>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_correo" class=" control-label"><i class="fa fa-user"></i> Correo</label>
              <input class="form-control" name="user_correo" id="user_correo" value="<?php echo $user->user_correo;?>" placeholder="mi@correo.com">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="user_telefono" class=" control-label"><i class="fa fa-user"></i> N° teléfono (0412-0000000)</label>
              <input type="tel" class="form-control" name="user_telefono" id="user_telefono" value="<?php echo $user->user_telefono;?>" placeholder="Número" maxlength="12" list="list_code" placeholder="N° teléfono" pattern="[0-9]{4}-[0-9]{7}">
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_genero" class=" control-label"><i class="fa fa-user"></i> Género</label>
              <select name="user_genero" class="form-control" id="user_genero" required>
                <option value="<?php echo $user->user_genero;?>"><?php echo $user->user_genero;?></option>
                <option value="<?php echo "Hombre";?>"><?php echo "Hombre";?></option>
                <option value="<?php echo "Mujer";?>"><?php echo "Mujer";?></option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="user_comunity_type" class=" control-label"><i class="fa fa-user"></i> Comunidad a la que pertenece</label>
              <select name="user_comunity_type" class="form-control" id="user_comunity_type" required>
                <option value="<?php echo $user->user_comunity_type;?>"><?php echo $user->user_comunity_type;?></option>
                <option value="<?php echo "Indígena" ?>"> <?php echo "Indígena" ?></option>
                <option value="<?php echo "Campesina" ?>"> <?php echo "Campesina" ?></option>
                <option value="<?php echo "Afrodescendiente" ?>"> <?php echo "Afrodescendiente" ?></option>
                <option value="<?php echo "Privado de Libertad" ?>"> <?php echo "Privado de Libertad" ?></option>
                <option value="<?php echo "No aplica" ?>"> <?php echo "No aplica" ?></option>
              </select>
            </div>
          </div>

     

          <div class="col-md-6">
            <div class="form-group">
              <label for="user_pertenece_organizacion" class=" control-label"><i class="fa fa-user"></i> Pertenece a Organización social</label>
              <select name="user_pertenece_organizacion" class="form-control" required>
                <option value="<?php echo $user->user_pertenece_organizacion;?>"><?php echo $user->user_pertenece_organizacion;?></option>
                <option value="<?php echo "No aplica"?>"><?php echo "No aplica"?></option>
                <option value="<?php echo "Consejo Comunal"?>"><?php echo "Consejo Comunal"?></option>
                <option value="<?php echo "Comuna"?>"><?php echo "Comuna"?></option>
                <option value="<?php echo "UBCH"?>"><?php echo "UBCH"?></option>
                <option value="<?php echo "Clap"?>"><?php echo "Clap"?></option>
                <option value="<?php echo "Comité"?>"><?php echo "Comité"?></option>
                <option value="<?php echo "Movimiento"?>"><?php echo "Movimiento"?></option>
                <option value="<?php echo "Colectivo"?>"><?php echo "Colectivo"?></option>
              </select>
            </div>
          </div>



          <div class="col-md-6">
            <div class="form-group">
              <label for="user_etnia" class=" control-label"><i class="fa fa-user"></i> Pueblo indígena</label>
              <select name="user_etnia" class="form-control" id="user_etnia" required>
                <option value="<?php echo $user->user_etnia;?>"><?php echo $user->user_etnia;?></option>
                <?php foreach($etnias as $name):?>
                  <option value="<?php echo $name["name"]; ?>"> <?php echo $name["name"]; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="disability_type" class=" control-label"><i class="fa fa-user"></i> Discapacidad*</label>
              <select name="disability_type" class="form-control" id="disability_type" required>
                <option value="<?php echo $user->disability_type?>"><?php echo $user->disability_type?></option>
                <?php foreach($discapacidad as $name):?>
                  <option value="<?php echo $name["disability"]; ?>"> <?php echo $name["disability"]; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>



          <div class="col-md-6">
            <div class="form-group">
              <label for="user_f_nacimiento" class=" control-label"><i class="fa fa-calendar"></i> Fecha nacimiento</label>
              <input type="date" class="form-control" name="user_f_nacimiento" id="user_f_nacimiento" value="<?php echo $user->user_f_nacimiento;?>" placeholder="Fecha" min="1928-01-01" max="2021-12-31" required>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_nivel_academ" class=" control-label"><i class="fa fa-user"></i> Nivel académico</label>
              <select name="user_nivel_academ" class="form-control" id="user_nivel_academ" required>
                <option value="<?php echo $user->user_nivel_academ;?>"><?php echo $user->user_nivel_academ;?></option>
                <option value="<?php echo "Sin escolarización";?>"><?php echo "Sin escolarización";?></option>
                <option value="<?php echo "Educación preescolar";?>"><?php echo "Educación preescolar";?></option>
                <option value="<?php echo "Educación primaria";?>"><?php echo "Educación primaria";?></option>
                <option value="<?php echo "Primer ciclo de secundaria";?>"><?php echo "Primer ciclo de secundaria";?></option>
                <option value="<?php echo "Segundo ciclo de secundaria";?>"><?php echo "Segundo ciclo de secundaria";?></option>
                <option value="<?php echo "Tecnico medio";?>"><?php echo "Técnico medio";?></option>
                <option value="<?php echo "Técnico Superior Universitario";?>"><?php echo "Técnico Superior Universitario";?></option>
                <option value="<?php echo "Licenciatura universitaria";?>"><?php echo "Licenciatura universitaria";?></option>
                <option value="<?php echo "Estudios de cuarto nivel";?>"><?php echo "Estudios de cuarto nivel";?></option>
              </select>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_profesion" class=" control-label"><i class="fa fa-user"></i> Profesión</label>
              <select name="user_profesion" class="form-control" id="user_profesion" required>
                <option value="<?php echo $user->user_profesion;?>"><?php echo $user->user_profesion;?></option>
                <option value="<?php echo 'Otra' ?>"><?php echo 'Otra' ?></option>
                <option value="<?php echo 'Sin títulos universitarios' ?>"><?php echo 'Sin títulos universitarios' ?></option>
                <?php foreach($professions as $name):?>
                    <option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
                <?php endforeach; ?>
                
              </select>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
            <label for="user_ocupacion" class=" control-label"><i class="fa fa-user"></i> Ocupación</label>
            <select name="user_ocupacion" class="form-control" id="user_ocupacion" required>
                <option value="<?php echo $user->user_ocupacion;?>"><?php echo $user->user_ocupacion;?></option>
                <option value="<?php echo 'Otra' ?>"><?php echo 'Otra' ?></option>
                <option value="<?php echo 'Desempleado' ?>"><?php echo 'Desempleado' ?></option>
                <option value="<?php echo 'Estudiante' ?>"><?php echo 'Estudiante' ?></option>
                <option value="<?php echo 'Formador/a en TIC' ?>"><?php echo 'Formador/a en TIC' ?></option>
                <?php foreach($occupations as $name):?>
                    <option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
          </div>





          <div class="col-md-6">
            <div class="form-group">
              <label for="user_empleado" class=" control-label"><i class="fa fa-user"></i> Situación laboral</label>
              <select name="user_empleado" class="form-control" id="user_empleado" required>
                <option value="<?php echo $user->user_empleado;?>"><?php echo $user->user_empleado;?></option>
                <option value="<?php echo "Empleado";?>"><?php echo "Empleado";?></option>
                <option value="<?php echo "Jubilado";?>"><?php echo "Jubilado";?></option>
                <option value="<?php echo "Trabajo del hogar";?>"><?php echo "Trabajo del hogar";?></option>
                <option value="<?php echo "Trabajo independiente";?>"><?php echo "Trabajo independiente";?></option>
                <option value="<?php echo "No trabaja";?>"><?php echo "No trabaja";?></option>
              </select>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_institucion" class=" control-label"><i class="fa fa-user"></i> Lugar dónde trabaja</label>
              <input class="form-control" name="user_institucion" id="user_institucion" value="<?php echo $user->user_institucion;?>" placeholder="Institución de trabajo">
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_organizacion" class=" control-label"><i class="fa fa-user"></i> Pertenece a Organización social</label>
              <input type="text" class="form-control" name="user_organizacion" value="<?php echo $user->user_organizacion;?>" placeholder='Consejo comunal "Patria Grande" '></input>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="user_estado" class=" control-label"><i class="fa fa-map"></i> Estado</label>
              <select name="user_estado" class="form-control" id="estados" required>
                <option value="<?php echo $user->user_estado;?>"><?php echo $user->user_estado;?></option>
                <?php foreach($estado as $p):?>
                  <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          

          <div class="col-md-6">
            <div class="form-group" id='recargar_munic'>
                <label for="user_municipio" class=" control-label"><i class="fa fa-map"></i> Municipio</label>
                <select name="user_municipio" class="form-control" id="municipios_1" required>
                    <option value="<?php echo $user->user_municipio;?>"><?php echo $user->user_municipio;?></option>

                </select>
              </div>
          </div>

          
          <div class="col-md-6">
            <div class="form-group">
              <label for="user_direccion" class=" control-label"><i class="fa fa-user"></i> Dirección</label>
              <input class="form-control" name="user_direccion" id="user_direccion" value="<?php echo $user->user_direccion;?>" placeholder="Dirección" required>
            </div>
          </div>


          <div class="col-md-6">
              <div class="form-group">
                <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Guardar usuario</button>
              </div>
          </div>

        </div>
      </form>

    </div>
  </div>

</div>









<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->

<!-- <script src="../../../assets/js/jquery.min.js"></script> -->


		<script language="javascript">
			$(document).ready(function(){
				$("#estados").change(function () {

					$('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
					$('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');
					
					$("#estados option:selected").each(function () {
						id_estado = $(this).val();
					
					// alert(id_estado);
					// alert($("#municipios").val());
            
						$.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
						$("#municipios_1").html(data);
						});  

						$.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
						$("#ciudades").html(data);
						});          
					});
				})
			});
			

			$(document).ready(function(){
				$("#municipios_1").change(function () {
					$("#municipios_1 option:selected").each(function () {
						id_municipio = $(this).val();
					// alert(id_municipio);
						
						$.post("core/app/view/getParroquia.php", { id_municipio: id_municipio }, function(data){
							$("#parroquias").html(data);
						});            
					});
				})
			});

			

    $(function(){
      var $tabla = $('#motivo_cierre');

      $('#estatus').change(function(){
          var value = $(this).val();
					// alert(value);

          if (value=='Cerrado'){
              $($tabla).show();
              // $('option:not(.' + value + ')', $tabla).hide();
          }
          else{
              // Se ha seleccionado All
              $($tabla).hide();
              // $('option', $tabla).show();
          }
      });
    })


    // oculta o muestra motivo de cierre al iniciar
    $(function(){
      var $tabla = $('#motivo_cierre');

          var value = $('#estatus').val();
					// alert(value);

          if (value=='Cerrado'){
              $($tabla).show();
              // $('option:not(.' + value + ')', $tabla).hide();
          }
          else{
              // Se ha seleccionado All
              $($tabla).hide();
              // $('option', $tabla).show();
          }
    })


		
	



$(document).ready(function(){
	var dni = document.getElementById("user_dni").value;
	var controladorTiempo = "";

	// verificar si es cedulado
	$("#user_has_document").change(function () {
		var cedulado = $(this).val();
		if (cedulado != 'Si'){
			document.getElementById("user_dni").type="text";
			document.getElementById("user_dni").setAttribute('maxlength',11);
			document.getElementById("user_dni").value = "No cedulado";
			document.getElementById("user_dni").readOnly = true;
			document.getElementById("user_dni").classList.remove("is-invalid");
			// $("#document_id_l").removeClass('mui-textfield--float-label').addClass('mui-textfield--float-label-true');
			// document.getElementById("email").required = true;
			compareDni(' is-valid');
			// if (mobile) {
			//     alert('¡AVISO! si el usuario no está cedulado requiere de un correo electrónico para ser registrado');
			// } else {
			//     toastify('¡AVISO! si el usuario no está cedulado requiere de un correo electrónico para ser registrado',true,10000,"warning");
			// }
		}else{
			document.getElementById("user_dni").type="number";
			document.getElementById("user_dni").setAttribute('maxlength',8);
			document.getElementById("user_dni").value = dni;
			document.getElementById("user_dni").readOnly = false;
			document.getElementById("user_dni").classList.remove("is-valid");
			// document.getElementById("email").required = false;
			// compareDni(' is-invalid');
		}
	})



	$("#user_dni").on("keyup", function() {
		user_dni = $(this).val();
		var user_has_document = document.getElementById("user_has_document").value;
		clearTimeout(controladorTiempo);

		if (user_has_document == 'Si'){
			if (user_dni.length < 6 || user_dni.length > 8){
				// retardo entre caracteres
				controladorTiempo = setTimeout(compareDni(' is-invalid'), 800);
			}else{
				document.getElementById("user_dni").classList.remove("is-invalid");
				controladorTiempo = setTimeout(compareDni(' is-valid'), 800);
			}
		}
	});


	// validar telefono
	var numbers = /^[0-9_-]+$/;
	var valida = /^\d{4}-\d{7}$/;
	$("#phone").on("keyup", function() {
		var tel = $(this).val();
		var element = document.getElementById("phone");

		if (tel.length > 0) {
			if (tel.match(valida)) {
				element.classList.remove("is-invalid");
				element.className += ' is-valid';
			} else {
				element.classList.remove("is-valid");
				element.className += ' is-invalid';
			}
			
			// solo numeros y guiones
			if (tel.match(numbers)) {
				// 
			} else {
				alert("¡En el campo teléfono solo se aceptan números!");
				document.getElementById("phone").focus();
				document.getElementById("phone").value = tel.substring(0, tel.length - 1);
			}
			// colocar y quitar guion
			if (tel.length > 4 && !tel.includes("-")) {
				document.getElementById("phone").value = tel.slice(0, 4) + "-" + (tel).slice(4);
			}
			else if (tel.length == 5) {
				document.getElementById("phone").value = tel.replace("-", "");
			}

			// if (tel.length == 11) {
			//     controladorTiempo = setTimeout(validaTele, 200);
			// }
		}else{
			document.getElementById("phone").value = ""
			element.classList.remove("is-invalid");
			element.className += ' is-valid';
		}

		
	});






})

function compareDni(setclass) {
    var element = document.getElementById("user_dni");
    element.className += setclass;
}


function validaTele() {
    var tel = document.getElementById("phone").value;
    if (tel.length == 4) {
        document.getElementById("phone").value = tel + '-';
    }
}

</script>