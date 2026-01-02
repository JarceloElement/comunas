<?php

$estado = EstadoData::getAll();
// $municipio = MunicipioData::getAll();
// $ciudad = CiudadData::getAll();
// $parroquia = ParroquiaData::getAll();
$personal_type = PersonalTypeData::getAll();

$user = FacilitatorsData::getByIdPg($_GET["id"]);

?>





<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="title">Modificar datos del facilitador</h4>
          </div>
          <div class="card-body">

            <form class="form-horizontal" role="form" method="post" action="./?action=facilitator&function=update">
              <br>

              <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"]; ?>">


                <!-- DATOS DEL FACILITADOR -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="f_name" class=" control-label"><i class="fa fa-user"></i> Nombres</label>
                    <input class="form-control" name="f_name" id="f_name" value="<?php echo $user->f_name; ?>" placeholder="Nombres" required>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="f_lastname" class=" control-label"><i class="fa fa-user"></i> Apellidos</label>
                    <input class="form-control" name="f_lastname" id="f_lastname" value="<?php echo $user->f_lastname; ?>" placeholder="Apellidos" required>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="document_number" class=" control-label"><i class="fa fa-user"></i> N° documento</label>
                    <input type="number" class="form-control" id="document_number" value="<?php echo $user->document_number; ?>" name="document_number" placeholder="12345678" minlength="6" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 1) this.value = '',alert('El DNI no es válido');" required>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_number" class=" control-label"><i class="fa fa-user"></i> N° teléfono</label>
                    <input type="tel" class="form-control" value="<?php echo $user->phone_number; ?>" name="phone_number" id="user_telefono" placeholder="0426-1234567" maxlength="12" list="list_code" pattern="[0-9]{4}-[0-9]{7}">
                  </div>
                </div>



                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="genero" class=" control-label"><i class="fa fa-user"></i> Género</label>
                    <select name="genero" class="form-control" id="genero" required>
                      <option value="<?php echo $user->gender; ?>"><?php echo $user->gender; ?></option>
                      <option value="<?php echo "Hombre"; ?>"><?php echo "Hombre"; ?></option>
                      <option value="<?php echo "Mujer"; ?>"><?php echo "Mujer"; ?></option>

                    </select>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email" class=" control-label"><i class="fa fa-envelope"></i> Correo</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $user->email; ?>" placeholder="correo" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="info_cod" class=" control-label"><i class="fa fa-home"></i> Código infocentro</label>
                    <input class="form-control" name="info_cod" id="info_cod" value="<?php echo $user->info_cod; ?>" placeholder="COD" required>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="birthdate" class=" control-label"><i class="fa fa-calendar"></i> Fecha nacimiento</label>
                    <input type="date" name="birthdate" id="birthdate" required class="form-control" value="<?php echo date("Y-m-d", strtotime($user->birthdate)); ?>" id="birthdate" placeholder="Fecha de nacimiento">
                  </div>
                </div>



                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="date_admission" class=" control-label"><i class="fa fa-calendar"></i> Fecha de ingreso</label>
                    <input type="date" name="date_admission" id="date_admission" value="<?php echo date("Y-m-d", strtotime($user->date_admission)); ?>" required class="form-control" id="date_admission" placeholder="Fecha de nacimiento">
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="f_state" class=" control-label"><i class="fa fa-map"></i> Estado</label>
                    <select name="f_state" class="form-control" id="estados_1" required>
                      <option value="<?php echo $user->f_state; ?>"><?php echo $user->f_state; ?></option>

                      <?php foreach ($estado as $p): ?>
                        <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group" id='recargar_munic'>
                    <label for="municipio" class=" control-label"><i class="fa fa-map"></i> Municipio</label>
                    <select name="municipio" class="form-control" id="municipios_1" required>
                      <option value="<?php echo $user->municipality; ?>"><?php echo $user->municipality; ?></option>

                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="parroquia" class=" control-label"><i class="fa fa-map"></i> Parroquia</label>
                    <select name="parroquia" class="form-control" id="parroquias_1">
                      <option value="<?php echo $user->parish; ?>"><?php echo $user->parish; ?></option>
                    </select>
                  </div>
                </div>



                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="status_nom" class=" control-label"><i class="fa fa-list-alt"></i> Estatus nómina</label>
                    <select name="status_nom" class="form-control" id="status_nom">
                      <option value="<?php echo $user->status_nom; ?>"><?php echo $user->status_nom; ?></option>
                      <option value="<?php echo "Activo"; ?>"><?php echo "Activo"; ?></option>
                      <option value="<?php echo "Inactivo"; ?>"><?php echo "Inactivo"; ?></option>
                      <option value="<?php echo "CS-E"; ?>"><?php echo "CS-E"; ?></option>
                      <option value="<?php echo "Comisión de servicios"; ?>"><?php echo "Comisión de servicios"; ?></option>
                      <option value="<?php echo "Vacaciones"; ?>"><?php echo "Vacaciones"; ?></option>
                      <option value="<?php echo "Permiso"; ?>"><?php echo "Permiso"; ?></option>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="personal_type" class=" control-label"><i class="fa fa-user"></i> Tipo de personal</label>
                    <select name="personal_type" class="form-control" id="personal_type" required>
                      <option value="<?php echo $user->personal_type; ?>"><?php echo $user->personal_type; ?></option>

                      <?php foreach ($personal_type as $p): ?>
                        <option value="<?php echo $p->type; ?>"> <?php echo $p->type; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="observations" class=" control-label"><i class="fa fa-map"></i> Observación</label>
                    <input class="form-control" name="observations" id="observations" value="<?php echo $user->observations; ?>" placeholder="Nota">
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" id="update" class="btn btn-default"><i class="fa fa-check"></i> Actualizar</button>
                  </div>
                </div>

              </div>
            </form>


            <datalist id="list_code">
              <option value="0412">
              <option value="0414">
              <option value="0416">
              <option value="0424">
              <option value="0426">
            </datalist>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<script language="javascript">
  $(document).ready(function() {
    // alert('id_estado');
    // alert($("#municipios").val());

    $("#estados_1").change(function() {

      $('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
      $('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');

      $("#estados_1 option:selected").each(function() {
        id_estado = $(this).val();

        $.post("core/app/view/getMunicipio.php", {
          id_estado: id_estado
        }, function(data) {
          // console.log(data);
          $("#municipios_1").html(data);
        });

        $.post("core/app/view/getCiudad.php", {
          id_estado: id_estado
        }, function(data) {
          $("#ciudades").html(data);
        });
      });
    })
  });


  $(document).ready(function() {
    $("#municipios_1").change(function() {
      $("#municipios_1 option:selected").each(function() {
        id_municipio = $(this).val();
        // alert(id_municipio);

        $.post("core/app/view/getParroquia.php", {
          id_municipio: id_municipio
        }, function(data) {
          $("#parroquias_1").html(data);
        });
      });
    })
  });


  // validar telefono
  var numbers = /^[0-9_-]+$/;
  var valida = /^\d{4}-\d{7}$/;
  $("#user_telefono").on("keyup", function() {
    var tel = $(this).val();
    var element = document.getElementById("user_telefono");

    if (tel.length > 0) {
      // if (tel.match(valida)) {
      //   element.classList.remove("is-invalid");
      //   element.className += ' is-valid';
      // } else {
      //   element.classList.remove("is-valid");
      //   element.className += ' is-invalid';
      // }

      // solo numeros y guiones
      if (tel.match(numbers)) {
        // 
      } else {
        alert("¡En el campo teléfono solo se aceptan números!");
        document.getElementById("user_telefono").focus();
        document.getElementById("user_telefono").value = tel.substring(0, tel.length - 1);
      }
      // colocar y quitar guion
      if (tel.length > 4 && !tel.includes("-")) {
        document.getElementById("user_telefono").value = tel.slice(0, 4) + "-" + (tel).slice(4);
      } else if (tel.length == 5) {
        document.getElementById("user_telefono").value = tel.replace("-", "");
      }

      // if (tel.length == 11) {
      //     controladorTiempo = setTimeout(validaTele, 200);
      // }
    } else {
      document.getElementById("user_telefono").value = ""
      // element.classList.remove("is-invalid");
      // element.className += ' is-valid';
    }


  });
</script>