<?php
$user_type = UserTypeData::getAll();
$estado = EstadoData::getAll();

$alert = isset($_GET["alert"]) ? $_GET["alert"] : '';
?>


<script language="javascript">
  $(document).ready(function() {

  });



  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("validar").addEventListener('submit', validarFormulario);
  });

  async function validarFormulario(evento) {
    event.preventDefault();

    var formData = new FormData();
    formData.append('function', 'get_repeateduser'); // Agrega la función a llamar
    formData.append('username', $("#username").val());
    formData.append('dni', $("#user_dni").val());
    formData.append('email', $("#email").val());

    var formObj = document.getElementById('validar');
    var dni = document.getElementById('user_dni').value;

    // valida longitud de la contraseña
    if ((dni.length < 6 || dni.length > 8)) {
      alert("El documento de identidad debe tener al menos 6 números");
      $("#user_dni").focus();
      // $("#document_id")[0].scrollIntoView();           
      return;
    }

    $('#cover-spin').show(0);

    try {
      const res = await fetch("./?action=ajax", {
        method: 'POST',
        body: formData
      });

      if (res.ok) {
        // console.log(res);
        const result_await = await res.text();
        // console.log(result_await);
        var array = JSON.parse(result_await);
        console.log(array);
        $('#cover-spin').hide(0);

        if (array.err == 'true') {
          if (getOS() == "Android") {
            alert(array['text']);
          } else {
            toastify(array['text'], true, 15000, "warning");
          }
          return;
        } else {
          formObj.submit()
        }



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

  };
</script>

<div id="cover-spin"></div>


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">


          <div class="card-header card-header-primary">
            <h4 class="card-title">Nuevo usuario</h4>
          </div>


          <div class="card-body">

            <!-- ALERT -->
            <!-- <div class="card-body">
              <!?php if ($alert != "") {
                View::Error("<p class='alert alert-warning'>$alert </p>");
              }
              ?>
            </div> -->
            <!-- END ALERT -->

            <form id="validar" class="form-horizontal" method="post" action="index.php?view=adduser" role="form">

              <div class="form-row">


                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="text" name="name" id="name" placeholder="">
                  <label><i class="fa fa-user"></i> Nombres</label>
                </div>

                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="text" name="lastname" id="lastname" placeholder="">
                  <label><i class="fa fa-user"></i> Apellidos</label>
                </div>

                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="number" name="user_dni" id="user_dni" min="1" minlength="7" maxlength="8" list="list_dni" placeholder="" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                  <label><i class="fa fa-user"></i> Documento de identidad</label>
                </div>

                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="text" name="username" id="username" placeholder="" maxlength="15" oninput="javascript:this.value=this.value.replace(/ /g,'');" required>
                  <label><i class="fa fa-user"></i> Nombre de usuario*</label>
                </div>

                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="password" name="password" id="password" placeholder="" oninput="javascript:this.value=this.value.replace(/ /g,'');" required>
                  <label><i class="fa fa-lock"></i> Contrase&ntilde;a*</label>
                </div>

                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="email" name="email" id="email" placeholder="" oninput="javascript:this.value=this.value.replace(/ /g,'');" required>
                  <label><i class="fa fa-email"></i> Correo electrónico*</label>
                </div>

                <div class="col-md-4 mui-select" id="user_gender">
                  <select name="gender" id="gender" required>
                    <option value="">--GÉNERO--</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                  </select>
                  <label class="control-label"><i class="fa fa-user"></i> Género*</label>
                </div>





                <!--  SOLO ADMIN VISIBLE -->
                <div class="col-md-4 mui-select">
                  <select name="user_type" id="tipo_de_usuario" required>
                    <!-- busca el nombre por el ID -->
                    <option value="">--TIPO--</option>

                    <?php foreach ($user_type as $p): ?>

                      <!-- ROOT -->
                      <?php if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6) { ?>
                        <?php if ($p->user_type != 7) { ?>
                          <option value="<?php echo $p->user_type; ?>" data="<?php echo $p->user_type_name; ?>"> <?php echo $p->user_type_name; ?></option>
                        <?php } ?>

                        <!-- Politicas Admin -->
                      <?php } elseif ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6) { ?>
                        <?php if ($p->user_type != 7) { ?>
                          <option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
                        <?php } ?>

                        <!-- Gerencias ADMIN -->
                      <?php } elseif ($_SESSION["user_type"] == 9) { ?>
                        <?php if ($p->user_type == 4) { ?>
                          <option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
                        <?php } ?>

                        <!-- Coordinador estadal -->
                      <?php } elseif ($_SESSION["user_type"] == 8) { ?>
                        <?php if ($p->user_type == 2 || $p->user_type == 3) { ?>
                          <option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
                        <?php } ?>
                      <?php } ?>

                    <?php endforeach; ?>

                  </select>
                  <label class="control-label"><i class="fa fa-info"></i> Tipo de usuario*</label>
                </div>


                <div class="col-md-4 mui-select" id="user_rol">
                  <select name="rol" id="rol" required>
                    <option value="">--ROL--</option>


                  </select>
                  <label class="control-label"><i class="fa fa-cog"></i> Rol*</label>
                </div>
                <!-- SOLO ADMIN -->

                <div class="col-md-4 mui-select">
                  <select name="region" id="region" required>
                    <option value="">-- ESTADO --</option>
                    <?php foreach ($estado as $p): ?>
                      <option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label><i class="fa fa-map"></i> Región*</label>
                </div>


                <div class="col-md-4 mui-textfield mui-textfield--float-label">
                  <input type="text" name="code_info" id="code_info" oninput="javascript:this.value=this.value.replace(/ /g,'');" required placeholder="">
                  <label><i class="fa fa-user"></i> Código Info*</label>
                </div>
              </div>


              <!-- <div class="form-check" id="is_organization">
                <label class="form-check-label">
                  <input type="checkbox" id="checkbox_organization" name="is_organization" class="form-check-input" value="">
                  Pertenece a una organización comunitaria
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>

              <div class="col-md-12 mui-textfield mui-textfield--float-label" id="organization_name" style="display: none;">
                <input type="text" name="organization_name" id="organization" value="" placeholder="">
                <label><i class="fa fa-user"></i> Nombre de la organización</label>
              </div> -->

              <br>
              <div class="form-group">

                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Agregar usuario</button>
                  </div>
                </div>

              </div>
          </div>

          </form>

          <datalist id="list_dni">
            <option value="No cedulado">
          </datalist>

        </div>
      </div>
    </div>
  </div>
</div>


<script language="javascript">
  $(document).ready(function() {
    var $organization_name = $('#organization_name');
    $($organization_name).hide();

  })



  $(function() {

    $("#is_organization").change(function() {
      data = $(this).val();
      var checkbox = $("#checkbox_organization").is(":checked");

      var $organization_name = $('#organization_name');
      if (checkbox == true) {
        $($organization_name).show();
        $("#organization").focus();
      } else {
        $($organization_name).hide();
        $("#organization").val("");
      }

    });


    $("#tipo_de_usuario").change(function() {
      data = $(this).val();
      console.log(data);

      // limpiar el select
      const $select = document.querySelector("#rol");
      for (let i = $select.options.length; i >= 0; i--) {
        $select.remove(i);
      }

      if (data == '1') {
        $('#rol').append($('<option>').val('Usuario final').text('Usuario final'));
      }

      if (data == '2') {
        <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
          $('#rol').append($('<option>').val('').text('-SELECCIONE-'));
          $('#rol').append($('<option>').val('Facilitador').text('Facilitador'));
          $('#rol').append($('<option>').val('Promotor').text('Promotor'));
        <?php } else { ?>
          $('#rol').append($('<option>').val('Facilitador').text('Facilitador'));
        <?php } ?>
      }

      if (data == '3') {
        $('#rol').append($('<option>').val('').text('-SELECCIONE-'));
        $('#rol').append($('<option>').val('Comunicación').text('Comunicación'));
        $('#rol').append($('<option>').val('Formación').text('Formación'));
        $('#rol').append($('<option>').val('Infraestructura').text('Infraestructura'));
        $('#rol').append($('<option>').val('Tecnología').text('Tecnología'));
        $('#rol').append($('<option>').val('Red móvil').text('Red móvil'));
        $('#rol').append($('<option>').val('Organización').text('Organización'));
        $('#rol').append($('<option>').val('Administración').text('Administración'));
        $('#rol').append($('<option>').val('Políticas públicas').text('Políticas públicas'));
      }

      if (data == '4') {
        <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
          // <!-- Gerencias sustantiva CCS-->
          $('#rol').append($('<option>').val('').text('-SELECCIONE-'));
          $('#rol').append($('<option>').val('Comunicación').text('Comunicación'));
          $('#rol').append($('<option>').val('Formación').text('Formación'));
          $('#rol').append($('<option>').val('Infraestructura').text('Infraestructura'));
          $('#rol').append($('<option>').val('Tecnología').text('Tecnología'));
          $('#rol').append($('<option>').val('Red móvil').text('Red móvil'));
          $('#rol').append($('<option>').val('Organización').text('Organización'));
          $('#rol').append($('<option>').val('Administración').text('Administración'));
          $('#rol').append($('<option>').val('Políticas públicas').text('Políticas públicas'));
        <?php } ?>

      }

      if (data == '5') {
        <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
          // <!-- Gerencia principal -->
          $('#rol').append($('<option>').val('').text('-SELECCIONE-'));
          $('#rol').append($('<option>').val('Políticas públicas').text('Políticas públicas'));
          $('#rol').append($('<option>').val('Gerencias ADMIN').text('Gerencia comunal'));
        <?php } ?>
      }

      if (data == '6') {

        <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
          $('#rol').append($('<option>').val('').text('-SELECCIONE-'));
          // <!-- Gerencia principal -->
          $('#rol').append($('<option>').val('Políticas públicas').text('Políticas públicas'));
          $('#rol').append($('<option>').val('Gerencias ADMIN').text('Gerencia comunal'));

        <?php } ?>

      }

      if (data == '7') {

        <?php if ($_SESSION["user_type"] == 7) { ?>
          $('#rol').append($('<option>').val('ROOT').text('ROOT'));
        <?php } ?>

      }

      if (data == '8') {
        $('#rol').append($('<option>').val('Jefe estadal').text('Jefe estadal'));
        $('#rol').append($('<option>').val('Sala unificada').text('Sala unificada'));
      }

      if (data == '10') {
        $('#rol').append($('<option>').val('Revisión').text('Revisión'));
      }

    });



  });
</script>