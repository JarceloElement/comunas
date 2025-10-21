<?php

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$coordinations = CoordTypeData::getAll();
$personal_type = PersonalTypeData::getAll();

?>



<script>
  $(document).ready(function() {

  });


  function replace_t(value) {
    return value.replace(/ +/g, "");
  }

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
        console.log(array);
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
            <h4 class="title">Nuevo gerente</h4>
          </div>
          <br>
          <div class="card-body">

            <form id="send_form" class="form-horizontal" role="form" method="post" action="./?action=gerencias&function=add">
              <br>
              <div class="form-group">

                <!-- DATOS DEL COORDINADOR -->

                <!-- <div class="col-lg-6">
                  <div class="form-group">
                    <label for="info_cod" class=" control-label"><i class="fa fa-calendar"></i> Código Infocentro</label>
                    <input type="text" name="info_cod" onkeydown="value = replace_t(value);" class="form-control" id="info_cod" placeholder="" style='text-transform:uppercase'>
                  </div>
                </div> -->


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="document_number" class=" control-label"><i class="fa fa-list-alt"></i> N° documento</label>
                    <input type="number" class="form-control" name="document_number" placeholder="C.I" required minlength="6" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = '',alert('El DNI no es válido');"></input>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="f_name" class=" control-label"><i class="fa fa-user"></i> Nombres</label>
                    <textarea class="form-control" name="f_name" placeholder="Nombres" required></textarea>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="f_lastname" class=" control-label"><i class="fa fa-user"></i> Apellidos</label>
                    <textarea class="form-control" name="f_lastname" placeholder="Apellidos" required></textarea>
                  </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_number" class=" control-label"><i class="fa fa-phone"></i> N° teléfono</label>
                    <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="0416-1234567" required maxlength="12" list="list_code" pattern="[0-9]{4}-[0-9]{7}"></input>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="genero" class=" control-label"><i class="fa fa-venus-mars"></i> Género</label>
                    <select name="genero" class="form-control" id="genero" required>
                      <option value="">-- GÉNERO --</option>
                      <option value="<?php echo "Hombre"; ?>"><?php echo "Hombre"; ?></option>
                      <option value="<?php echo "Mujer"; ?>"><?php echo "Mujer"; ?></option>

                    </select>
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
                    <label for="coordination" class=" control-label"><i class="fa fa-sliders"></i> Coordinación</label>
                    <select name="coordination" class="form-control" id="coordination" required>
                      <option value="">-- COORDINACIÓN --</option>
                      <?php foreach ($coordinations as $p): ?>
                        <option value="<?php echo $p->name; ?>"> <?php echo $p->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="info_cod" class=" control-label"><i class="fa fa-calendar"></i> Código Infocentro</label>
                    <input type="text" name="info_cod" onkeydown="value = replace_t(value);" class="form-control" id="info_cod" placeholder="" style='text-transform:uppercase'>
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
                    <label for="f_state" class=" control-label"><i class="fa fa-map"></i> Estado</label>
                    <select name="f_state" class="form-control" id="estados_1" required>
                      <option value="">-- ESTADO --</option>
                      <?php foreach ($estado as $p): ?>
                        <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group" id='recargar_munic'>
                    <label for="municipio" class=" control-label"><i class="fa fa-map-marker"></i> Municipio</label>
                    <select name="municipio" class="form-control" id="municipios_1" required>
                      <option value="0">-- MUNICIPIOS --</option>

                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="parroquia" class=" control-label"><i class="fa fa-map-pin"></i> Parroquia</label>
                    <select name="parroquia" class="form-control" id="parroquias_1">
                      <option value="">-- PARROQUIA --</option>
                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="estatus" class=" control-label"><i class="fa fa-list-alt"></i> Estatus ingreso</label>
                    <select name="estatus" class="form-control" id="estatus" required>
                      <option value="APROBADO">APROBADO</option>
                      <option value="PENDIENTE">PENDIENTE</option>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="status_nom" class=" control-label"><i class="fa fa-list-alt"></i> Estatus nómina</label>
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


                <!-- nuevos campos Gestion humana -->

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="gerencia_tipo" class=" control-label"><i class="fa fa-gear"></i> Tipo de gerencia</label>
                    <input type="text" name="gerencia_tipo" class="form-control" id="gerencia_tipo" list="gerencias-tipo" placeholder=""></input>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="pcta" class=" control-label"><i class="fa fa-gear"></i> PCTA</label>
                    <input type="text" name="pcta" class="form-control" id="pcta" value="PCTA "></input>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="fecha_tentativa" class=" control-label"><i class="fa fa-gear"></i> Fecha tentativa</label>
                    <input type="date" name="fecha_tentativa" class="form-control" id="fecha_tentativa"></input>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="cargo" class=" control-label"><i class="fa fa-gear"></i> Cargo</label>
                    <input type="text" name="cargo" class="form-control" id="cargo"></input>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="nivel_academico" class=" control-label"><i class="fa fa-gear"></i> Nivel académico</label>
                    <input type="text" name="nivel_academico" class="form-control" id="nivel_academico"></input>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="prima_profesional" class=" control-label"><i class="fa fa-gear"></i> Prima profesionalización</label>
                    <input type="number" name="prima_profesional" class="form-control" id="prima_profesional"></input>
                  </div>
                </div>

                <!-- ============= -->



                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="observations" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
                    <textarea class="form-control" name="observations" placeholder="Nota"></textarea>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Agregar</button>
                  </div>
                </div>

              </div>




            </form>

            <datalist id="list-code">
              <option value="0412"></option>
              <option value="0414"></option>
              <option value="0416"></option>
              <option value="0424"></option>
              <option value="0426"></option>
            </datalist>

            <datalist id="gerencias-tipo">
              <option value="GERENCIA DE LA RED"></option>
              <option value="CONSULTORÍA JURÍDICA"></option>
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
  });



  $(function() {
    var $tabla = $('#motivo_cierre');

    $('#estatus').change(function() {
      var value = $(this).val();
      // alert(value);

      if (value == 'Cerrado') {
        $($tabla).show();
        // $('option:not(.' + value + ')', $tabla).hide();
      } else {
        // Se ha seleccionado All
        $($tabla).hide();
        // $('option', $tabla).show();
      }
    });
  })


  // oculta o muestra motivo de cierre al iniciar
  $(function() {
    var $tabla = $('#motivo_cierre');

    var value = $('#estatus').val();
    // alert(value);

    if (value == 'Cerrado') {
      $($tabla).show();
      // $('option:not(.' + value + ')', $tabla).hide();
    } else {
      // Se ha seleccionado All
      $($tabla).hide();
      // $('option', $tabla).show();
    }




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


  })
</script>