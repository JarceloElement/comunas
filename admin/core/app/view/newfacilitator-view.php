<?php

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$personal_type = PersonalTypeData::getAll();

?>



<script>
  $(document).ready(function() {

  });


  // VALIDAR FORMULARIO
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("send_form").addEventListener('submit', validarFormulario);
  });


  async function validarFormulario(event) {
    event.preventDefault();

    let form = $("#send_form");
    let url = form.attr('action');
    var data = new FormData(event.target);

    $('#cover-spin').show(0);

    try {
      const res = await fetch(url, {
        method: 'POST',
        body: data
      });

      if (res.ok) {
        const result_await = await res.text();
        var array = JSON.parse(result_await);
        console.log(res);
        // console.log(array);
        toastify(array.alert, true, 13000, array.alert_type);
        $('#cover-spin').hide(0);
        form.get(0).reset();

      } else {
        $('#cover-spin').hide(0);
        toastify(res.statusText, true, 12000, "error");
        throw res.statusText;
      }

    } catch (error) {
      $('#cover-spin').hide(0);
      toastify(error, true, 12000, "error");
      throw error;
    }

  }
</script>





<div id="cover-spin"></div>




<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="title">Nuevo facilitador</h4>
          </div>
          <br>
          <div class="card-body">


            <form id="send_form" class="form-horizontal" role="form" method="post" action="./?action=facilitator&function=add">
              <br>

              <div class="form-row">

                <!-- DATOS DEL FACILITADOR -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class=" control-label"><i class="fa fa-user"></i> Nombres</label>
                    <textarea class="form-control" name="name" placeholder="Nombres" required></textarea>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname" class=" control-label"><i class="fa fa-user"></i> Apellidos</label>
                    <textarea class="form-control" name="lastname" placeholder="Apellidos" required></textarea>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="document_number" class=" control-label"><i class="fa fa-user"></i> N° documento</label>
                    <input type="number" class="form-control" name="document_number" placeholder="25123456" minlength="6" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 1) this.value = '',alert('El DNI no es válido');" required></input>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_number" class=" control-label"><i class="fa fa-user"></i> N° teléfono</label>
                    <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="0416-1234567" required maxlength="12" list="list_code" pattern="[0-9]{4}-[0-9]{7}"></input>
                  </div>
                </div>





                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email" class=" control-label"><i class="fa fa-envelope"></i> Correo</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="correo" required></input>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="info_cod" class=" control-label"><i class="fa fa-home"></i> Código infocentro</label>
                    <input type="text" class="form-control" name="info_cod" placeholder="COD" required></input>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="birthdate" class=" control-label"><i class="fa fa-calendar"></i> Fecha nacimiento</label>
                    <input type="date" name="birthdate" required class="form-control" id="birthdate" placeholder="Fecha de nacimiento">
                  </div>
                </div>



                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="date_admission" class=" control-label"><i class="fa fa-calendar"></i> Fecha de ingreso</label>
                    <input type="date" name="date_admission" required class="form-control" id="date_admission" placeholder="Fecha de nacimiento">
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="genero" class=" control-label"><i class="fa fa-user"></i> Género</label>
                    <select name="genero" class="form-control" id="genero" required>
                      <option value="">-- GÉNERO --</option>
                      <option value="<?php echo "Hombre"; ?>"><?php echo "Hombre"; ?></option>
                      <option value="<?php echo "Mujer"; ?>"><?php echo "Mujer"; ?></option>

                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="estado" class=" control-label"><i class="fa fa-map"></i> Estado</label>
                    <select name="estado" class="form-control" id="estados_1" required>
                      <option value="">-- ESTADO --</option>
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
                      <option value="0">-- MUNICIPIOS --</option>

                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="parroquia" class=" control-label"><i class="fa fa-map"></i> Parroquia</label>
                    <select name="parroquia" class="form-control" id="parroquias_1">
                      <option value="">-- PARROQUIA --</option>
                    </select>
                  </div>
                </div>



                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="status_nom" class=" control-label"><i class="fa fa-list-alt"></i> Estatus facilitador</label>
                    <select name="status_nom" class="form-control" id="status_nom" required>
                      <option value="Activo">Activo</option>
                      <option value="Inactivo">Inactivo</option>
                      <option value="<?php echo "CS-E"; ?>"><?php echo "CS-E"; ?></option>
                      <option value="Comisión de servicios">Comisión de servicios</option>
                      <option value="Vacaciones">Vacaciones</option>
                      <option value="Permiso">Permiso</option>

                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="personal_type" class=" control-label"><i class="fa fa-user"></i> Tipo de personal</label>
                    <select name="personal_type" class="form-control" id="personal_type" required>
                      <?php foreach ($personal_type as $p): ?>
                        <option value="<?php echo $p->type; ?>"> <?php echo $p->type; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="observations" class=" control-label"><i class="fa fa-map"></i> Observación</label>
                    <textarea class="form-control" name="observations" placeholder="Nota"></textarea>
                  </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Agregar facilitador</button>
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
    $("#estados_1").change(function() {

      $('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
      $('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');

      $("#estados_1 option:selected").each(function() {
        id_estado = $(this).val();

        // alert(id_estado);
        // alert($("#municipios").val());

        $.post("core/app/view/getMunicipio.php", {
          id_estado: id_estado
        }, function(data) {
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






    // validar telefono
    var numbers = /^[0-9_-]+$/;
    var valida = /^\d{4}-\d{7}$/;
    $("#phone_number").on("keyup", function() {
      var tel = $(this).val();

      if (tel.length > 0) {

        // solo numeros y guiones
        if (tel.match(numbers)) {
          // 
        } else {
          alert("¡En el campo teléfono solo se aceptan números!");
          document.getElementById("phone_number").focus();
          document.getElementById("phone_number").value = tel.substring(0, tel.length - 1);
        }
        // colocar y quitar guion
        if (tel.length > 4 && !tel.includes("-")) {
          document.getElementById("phone_number").value = tel.slice(0, 4) + "-" + (tel).slice(4);
        } else if (tel.length == 5) {
          document.getElementById("phone_number").value = tel.replace("-", "");
        }

      } else {
        document.getElementById("phone_number").value = ""
      }
    });






  });
</script>