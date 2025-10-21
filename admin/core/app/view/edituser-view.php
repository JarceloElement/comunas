<?php $user = UserData::getById($_GET["id"]); ?>
<?php $user_type = UserTypeData::getAll(); ?>
<?php $estado = EstadoData::getAll(); ?>

<?php
// $_SESSION['user_dni'] = "XXXX";
// echo "user_dni -".$_SESSION['user_dni'];



?>

<script>
  var Name_OS = "Unknown OS";
  // OS NAME
  if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
  if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
  if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
  if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
  if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";


  $(document).ready(function() {

    // alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
    // toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
    // toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000,"#ff8d00", "#ffbc00"); // [message, autohide]
    // setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);




    // alertas
    <?php if (isset($_GET['swal']) && isset($_SESSION["alert"]) && $_GET['swal'] != ""): ?>
      if (Name_OS == "Android") {
        toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "dashboard");
        // toastify('<!?php echo $_SESSION["alert"]; ?>',true,10000,"#ff8d00", "#ffbc00");
      } else {
        toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "dashboard");
      }
    <?php endif; ?>




    // cambiar el parametro de alert
    const url = new URL(window.location);
    url.searchParams.set('swal', '');
    window.history.pushState({}, '', url);


  })




  // VALIDAR FORMULARIO
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("form").addEventListener('submit', validarFormulario);
  });

  function validarFormulario(evento) {
    evento.preventDefault();

    var user_id = document.getElementById('user_id').value;
    var username = document.getElementById('username').value;
    var user_dni = document.getElementById('user_dni').value;
    var user_email = document.getElementById('email').value;


    if (user_dni == "" && user_email == "") {
      if (Name_OS == "Android") {
        alert("Si no tines un documento de identidad debes colocar un correo");
        $("#user_dni").focus();
        $("#user_dni")[0].scrollIntoView();
        return;
      } else {
        toastify("Si no tines un documento de identidad debes colocar un correo", true, 10000, "warning"); // [message, autohide]
        $("#user_dni").focus();
        $("#user_dni")[0].scrollIntoView();
        return;
      }

    }
    if (user_dni != "" && user_dni.length < 6) {
      if (Name_OS == "Android") {
        alert("¡AVISO! El documento de identidad debe tener al menos 7 carácteres");
        $("#user_dni").focus();
        $("#user_dni")[0].scrollIntoView();
        return;
      } else {
        toastify("¡AVISO! El documento de identidad debe tener al menos 7 carácteres", true, 10000, "warning"); // [message, autohide]
        $("#user_dni").focus();
        $("#user_dni")[0].scrollIntoView();
        return;
      }

    }



    $('#cover-spin').show(0);



    // buscar repetido
    $.ajax({
        type: "POST",
        url: "index.php?action=finaluser&function=getrepeatededit",
        // headers: {
        //     "X-CSRFToken": getCookie("csrftoken")
        // },
        data: {
          user_id: user_id,
          username: username,
          user_dni: user_dni,
          email: user_email
        }
      })
      .done(function(msg) {
        console.log(msg);

        var array = JSON.parse(msg);

        if (array['err'] == 'null') {
          if (Name_OS == "Android") {
            alert(array['text']);
          } else {
            toastify(array['text'], true, 10000, "error");
          }
          $('#cover-spin').hide(0);

          if (array['param'] == 'ambos') {
            $("#user_dni").focus();
          }
          if (array['param'] == 'email') {
            $("#user_correo").focus();
          }
          if (array['param'] == 'dni') {
            $("#user_dni").focus();
          }
          return;

        } else {
          formObj = document.getElementById('form');
          formObj.submit()
        }
      })
      .fail(function() {
        toastify('No se pudo validar el registro, por favor intenta de nuevo', true, 10000, "warning");
        return;
      });


    // this.submit();


  }
</script>

<div id="cover-spin"></div>


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">


          <div class="card-header card-header-primary">
            <h4 class="card-title">Editar usuario</h4>
          </div>


          <div class="card-body">

            <form id="form" class="form-horizontal" method="post" action="index.php?view=updateuser" role="form">
              <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id; ?>">
              <!-- <input type="hidden" id="session_user_type" value="<!?php echo $_SESSION["user_type"];?>"> -->
              <input type="hidden" name="lastname" value="<?php echo $user->lastname; ?>" id="lastname" placeholder="">

              <div class="form-row">

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                  <input type="text" name="name" value="<?php echo $user->name; ?>" id="name" placeholder="">
                  <label><i class="fa fa-user"></i> Alias</label>
                </div>

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                  <input type="number" name="user_dni" value="<?php echo $user->user_dni; ?>" id="user_dni" minlength="7" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                  <p class="help-block" style="color:red;">Deberá cerrar e iniciar sesión nuevamente para editar el perfil</p>
                  <label><i class="fa fa-user"></i> Nº cédula de identidad</label>
                </div>

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                  <input type="text" name="username" value="<?php echo $user->username; ?>" required id="username" maxlength="15" oninput="javascript:this.value=this.value.replace(/ /g,'');" placeholder="">
                  <label><i class="fa fa-user"></i> Nombre de usuario*</label>
                </div>

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                  <input type="password" name="password" value="" id="inputEmail1" placeholder="">
                  <p class="help-block" style="color:red;">La contrase&ntilde;a solo se modifica si escribes algo, déjalo en blanco para no modificarla.</p>
                  <label><i class="fa fa-lock"></i> Contrase&ntilde;a*</label>
                </div>

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                  <input type="email" name="email" value="<?php echo $user->email; ?>" id="email" placeholder="">
                  <p class="help-block" style="color:red;">Obligatorio solo si no tiene documento de identidad</p>
                  <label><i class="fa fa-mail"></i> Correo electrónico</label>
                </div>

                <div class="col-md-6 mui-select">
                  <select name="gender" id="gender" required>
                    <option value="<?php echo $user->gender != "" ? $user->gender : ""; ?>"><?php echo $user->gender != "" ? $user->gender : "-Selecciona-"; ?></option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                  </select>
                  <label class="control-label"><i class="fa fa-user"></i> Género*</label>
                </div>






                <!--  SOLO ADMIN VISIBLE -->
                <div class="col-md-6 mui-select" id="tipo_de_usuario" style="display:none;">
                  <select name="user_type" id="user_type" required>
                    <!-- busca el nombre por el ID -->
                    <option value="<?php echo $user->user_type; ?>"><?php echo UserTypeData::getNameById($user->user_type); ?></option>
                    <?php foreach ($user_type as $p): ?>

                      <!-- ROOT -->
                      <?php if ($_SESSION["user_type"] == 7) { ?>
                        <option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>

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
                        <?php if ($p->user_type == 2 || $p->user_type == 3 || $p->user_type == 8) { ?>
                          <option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
                        <?php } ?>
                      <?php } ?>

                    <?php endforeach; ?>

                  </select>
                  <label class="control-label"><i class="fa fa-info"></i> Tipo de usuario*</label>
                </div>

                <div class="col-md-6 mui-select" id="user_rol" style="display:none;">
                  <select name="rol" id="rol" required>
                    <option value="<?php echo $user->rol; ?>"> <?php echo $user->rol; ?></option>
                  </select>
                  <label class="control-label"><i class="fa fa-cog"></i> Rol*</label>
                </div>
                <!-- SOLO ADMIN -->


                <div class="col-md-6 mui-select" id="user_region" style="display:none;">
                  <select name="region" id="region" required>
                    <option value="<?php echo $user->region; ?>"><?php echo $user->region; ?></option>
                    <?php foreach ($estado as $p): ?>
                      <option value="<?php echo $p->estado; ?>"> <?php echo $p->estado; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label class="control-label"><i class="fa fa-map"></i> Región*</label>
                </div>


                <div class="col-md-6 mui-textfield mui-textfield--float-label" id="code_info" style="display:none;">
                  <input type="text" name="code_info" value="<?php echo $user->code_info; ?>" placeholder="" require>
                  <p class="help-block" style="color:red;">Debes salir e iniciar sesión de nuevo para surtir efecto.</p>
                  <label><i class="fa fa-user"></i> Código Info</label>
                </div>


                <!--  SOLO ADMIN -->
                <div class="col-md-4 form-check" id="user_active" style="display:none;">
                  <label class="form-check-label">
                    <input type="checkbox" id="checkbox" name="is_active" class="form-check-input" value="<?php echo $user->is_active ?>" <?php if ($user->is_active) {
                                                                                                                                            echo "checked";
                                                                                                                                          } ?>>
                    Está activo
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <!-- SOLO ADMIN -->

                <div class="col-md-4 form-check" id="is_organization">
                  <label class="form-check-label">
                    <input type="checkbox" id="checkbox_organization" name="is_organization" class="form-check-input" value="<?php echo $user->is_organization; ?>" <?php if ($user->is_organization) {
                                                                                                                                                                      echo "checked";
                                                                                                                                                                    } ?>>
                    Pertenece a una organización comunitaria
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>


                <div class="col-md-12 mui-textfield mui-textfield--float-label" id="organization_name" style="display: none;">
                  <input type="text" name="organization_name" id="organization" value="<?php echo $user->organization_name; ?>" placeholder="">
                  <label><i class="fa fa-user"></i> Nombre de la organización</label>
                </div>

                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-6">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="is_admin" <!?php if($user->is_admin){ echo "checked";}?>> 
                        </label>
                        <label class="control-label">Es administrador</label>
                      </div>
                    </div>
                  </div>
                </div> -->


              </div>

              <div class="form-group">

                <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Guardar</button>
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





<!-- <script src="../../../assets/js/jquery.min.js"></script> -->
<script language="javascript">
  // OCULTA Y MUESTRA LOS CAMPOS DE TIPO DE USUARIO
  $(document).ready(function() {
    var user_type = <?php echo $_SESSION["user_type"] ?>;

    var $div_user_type = $('#tipo_de_usuario');
    var $div_user_rol = $('#user_rol');
    var $user_region = $('#user_region');
    var $div_user_active = $('#user_active');
    var $code_info = $('#code_info');
    var $user_rol = $('#rol');


    var checkbox = $("#checkbox_organization").is(":checked");
    var $organization_name = $('#organization_name');
    if (checkbox == true) {
      $($organization_name).show();
    } else {
      $($organization_name).hide();
      $("#organization").val("");
    }

    // var user_type2 = document.getElementById("session_user_type").value;
    // alert(user_type);


    if (user_type == 9 || user_type == 8 || user_type == 7 || user_type == 6 || user_type == 5) {
      $($div_user_type).show();
      $($div_user_rol).show();
      $($user_region).show();
      $($div_user_active).show();
      $($code_info).show();
      // $('option:not(.' + value + ')', $tabla).hide();
    } else {
      $($div_user_type).hide();
      $($div_user_rol).hide();
      $($user_region).hide();
      $($div_user_active).hide();
      $($code_info).hide();
    }
    if (user_type == 0) {
      $($user_region).show();
      $($user_rol).prop('required', false);
    }

    // });
  })



  $(function() {

    $("#is_organization").change(function() {
      data = $(this).val();
      var checkbox = $("#checkbox_organization").is(":checked");

      // alert(checkbox);

      var organization_name = $('#organization_name');
      if (checkbox == true) {
        $(organization_name).show();
        $("#organization").focus();
      } else {
        $(organization_name).hide();
        $("#organization").val("");
      }

    });


    $("#user_type").change(function() {

      data = $(this).val();
      console.log(data);
      toastify("Privilegio: "+data, true, 2000, "warning");

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
          $('#rol').append($('<option>').val('Analista').text('Analista'));
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
          $('#rol').append($('<option>').val('Gerencias ADMIN').text('Gerencias ADMIN'));
          $('#rol').append($('<option>').val('Gerencia RNI').text('Gerencia RNI'));
        <?php } ?>
      }

      if (data == '6') {

        <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
          $('#rol').append($('<option>').val('').text('-SELECCIONE-'));
          // <!-- Gerencia principal -->
          $('#rol').append($('<option>').val('Gerencias ADMIN').text('Gerencias ADMIN'));
          $('#rol').append($('<option>').val('Gerencia RNI').text('Gerencia RNI'));
          // <!-- Gerencias sustantiva CCS-->
          $('#rol').append($('<option>').val('Comunicación').text('Comunicación'));
          $('#rol').append($('<option>').val('Formación').text('Formación'));
          $('#rol').append($('<option>').val('Infraestructura').text('Infraestructura'));
          $('#rol').append($('<option>').val('Tecnología').text('Tecnología'));
          $('#rol').append($('<option>').val('Red móvil').text('Red móvil'));
          $('#rol').append($('<option>').val('Organización').text('Organización'));
          $('#rol').append($('<option>').val('Administración').text('Administración'));
          $('#rol').append($('<option>').val('Políticas públicas').text('Políticas públicas'));
          $('#rol').append($('<option>').val('Analista').text('Analista'));
          <?php } ?>

      }

      if (data == '7') {

        <?php if ($_SESSION["user_type"] == 7) { ?>
          $('#rol').append($('<option>').val('ROOT').text('ROOT'));
        <?php } ?>

      }

      if (data == '8') {
        $('#rol').append($('<option>').val('Jefe estadal').text('Jefe estadal'));
      }

      if (data == '10') {
        $('#rol').append($('<option>').val('Revisión').text('Revisión'));
      }

    });


  });
</script>