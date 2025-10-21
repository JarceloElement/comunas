<?php

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();

$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();
?>




<script language="javascript">
  $(document).ready(function() {

  });



  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("addinfocentro").addEventListener('submit', validarFormulario);
  });

  function validarFormulario(evento) {
    event.preventDefault();


    var formObj = document.getElementById('addinfocentro');
    var cod = document.getElementById('cod').value;

    $('#cover-spin').show(0);

    $.ajax({
        type: "POST",
        url: "./?action=ajax",
        data: {
          function: "get_repeated_info", // funcion que llama
          cod: $("#cod").val().toUpperCase()
        }
      })
      .done(function(msg) {
        $('#cover-spin').hide(0);

        console.log(msg);
        var array = JSON.parse(msg);

        if (array['err'] == 'true') {
          console.log(array['text']);
          $("#cod").focus();

          if (getOS() == "Android") {
            alert(array['text']);
          } else {
            toastify(array['text'], true, 15000, "error");
          }

        } else {
          formObj.submit()
        }



      })
      .fail(function() {
        if (getOS() == "Android") {
          alert("Hubo un error, intenta nuevamente");
        } else {
          toastify('Hubo un error, intenta nuevamente', true, 5000, "warning");
        }
        $('#cover-spin').hide(0);
        return false;
      });
    // .always(function() {
    //     toastify('Finished',true,1000,"warning");
    // });

    // this.submit();

  };
</script>

<div id="cover-spin"></div>



<div class="row">
  <div class="card">

    <!-- <div class="card-header" data-background-color="blue">
      <h4 class="title">Agregar Infocentro</h4>
    </div> -->


    <div class="card-content table-responsive">

      <form class="form-horizontal" id="addinfocentro" role="form" method="post" action="./?action=addinfocentro">

        <div class="form-group">
          <br>

          <div class="col-md-6">
            <div class="form-group">
              <label for="nombre" class=" control-label"><i class="fa fa-list-alt"></i> Código</label>
              <textarea class="form-control" name="cod" id="cod" placeholder="COD" oninput="javascript:this.value=this.value.replace(/ /g,'');" required></textarea>
            </div>
          </div>


          <!-- DATOS DEL INFOCENTRO -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="nombre" class=" control-label"><i class="fa fa-list-alt"></i> Nombre</label>
              <textarea class="form-control" name="nombre" placeholder="Nombre" required></textarea>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group">
              <label for="direccion" class=" control-label"><i class="fa fa-thumb-tack"></i> Dirección</label>
              <textarea class="form-control" name="direccion" placeholder="Dirección" required></textarea>
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
              <label for="ciudad" class=" control-label"><i class="fa fa-thumb-tack"></i> Ciudad</label>
              <select name="ciudad" class="form-control" id="ciudades">
                <option value="">-- CIUDAD --</option>
              </select>
            </div>
          </div>



          <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7  || $_SESSION["user_type"] == 8) { ?>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="cod_gerencia" class=" control-label"><i class="fa fa-warning"></i> ¿Es código de gerencia?</label>
                <select name="cod_gerencia" id="cod_gerencia" class="form-control" required>
                  <option value="<?php echo "0"; ?>"><?php echo "NO"; ?></option>
                  <option value="<?php echo "1"; ?>"><?php echo "SI"; ?></option>
                </select>
              </div>
            </div>
          <?php } ?>





          <div class="col-md-6" >
            <div class="form-group" id="id_estatus">
              <label class="control-label"><i class="fa fa-hourglass-2"></i> Estatus</label>
              <select name="estatus" class="form-control" id="estatus" required>
                <option value="">-- ESTATUS --</option>
                <?php foreach ($status_type as $p): ?>
                  <option value="<?php echo $p->status; ?>"><?php echo $p->status ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>


          <!-- ACTIVAR CUANDO ESTE CERRADO EL INFO -->
          <div class="col-md-6">
            <div class="form-group" id="motivo_cierre">
              <label for="motivo_cierre" class=" control-label"> <i class="fa fa-list-alt"></i> Motivo del cierre</label>
              <textarea class="form-control" name="motivo_cierre" placeholder="Motivo del cierre" id="Motivo del cierre" value="No Aplica"></textarea>
            </div>
          </div>







          <div class="col-lg-6">
            <div class="form-group">
              <label for="f_instalacion" class=" control-label"><i class="fa fa-calendar"></i> Fecha instalación</label>
              <input type="date" name="f_instalacion" id="f_instalacion" required class="form-control" id="inputEmail1" placeholder="Fecha de instalación">
            </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group">
              <label for="perso_contacto" class=" control-label"><i class="fa fa-user"></i> Persona de contacto</label>
              <input class="form-control" name="perso_contacto" placeholder="Persona de contacto"></input>
            </div>
          </div>



          <div class="col-lg-6">
            <div class="form-group">
              <label for="telef_contacto" class=" control-label"><i class="fa fa-phone"></i> Teléfono de contacto</label>
              <input class="form-control" name="telef_contacto" placeholder="Télefono de contacto"></input>
            </div>
          </div>

          <!-- <div class="col-lg-6">
            <div class="form-group">
              <label for="n_circuito" class=" control-label"><i class="fa fa-map"></i> N° de circuito</label>
              <textarea class="form-control" name="n_circuito" placeholder="N° circuito"></textarea>
            </div>
          </div> -->

          <!-- 
          <div class="col-lg-6">
            <div class="form-group">
              <label for="central_dlci" class=" control-label"><i class="fa fa-cog"></i> Central DLCI</label>
              <textarea class="form-control" name="central_dlci" placeholder="Central DLCI"></textarea>
            </div>
          </div> -->



          <div class="col-lg-6" id="id_transferido">
            <div class="form-group">
              <label for="transferido" class=" control-label"><i class="fa fa-users"></i> Transferencia comunal</label>
              <select name="transferido" id="transferido" class="form-control" required>
                <option value="">-- TRANSFERENCIA --</option>
                <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
              </select>
            </div>
          </div>







          <!-- DATOS TECNOLOGICOS -->

          <div class="col-lg-6" id="id_tecno_internet">
            <div class="form-group">
              <label for="tecno_internet" class=" control-label"><i class="fa fa-signal"></i> Tecnología de internet actual</label>
              <select name="tecno_internet" id="tecno_internet" class="form-control" required>
                <option value="">-- TECNOLOGÍA --</option>
                <?php foreach ($internet_type as $p): ?>
                  <option value="<?php echo $p->type; ?>"><?php echo $p->type ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-lg-6" id="id_proveedor">
            <div class="form-group">
              <label for="proveedor" class=" control-label"><i class="fa fa-building"></i> Proveedor internet</label>
              <select name="proveedor" id="proveedor" class="form-control" required>
                <option value="">-- PROVEEDOR DE INTERNET --</option>
                <option value="<?php echo "CANTV"; ?>"><?php echo "CANTV"; ?></option>
                <option value="<?php echo "Otro"; ?>"><?php echo "Otro"; ?></option>
              </select>
            </div>
          </div>




          <div class="col-lg-6" id="id_estatus_op">
            <div class="form-group">
              <label for="estatus_op" class=" control-label"><i class="fa fa-traffic-light"></i> Estatus operativo</label>
              <select name="estatus_op" id="estatus_op" class="form-control" required>
                <option value="">-- OPERATIVIDAD --</option>
                <?php foreach ($operative_info as $p): ?>
                  <option value="<?php echo $p->operative_type; ?>"><?php echo $p->operative_type ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>


          <div class="col-lg-6" id="id_servicio_pagado_por">
            <div class="form-group">
              <label for="servicio_pagado_por" class=" control-label"><i class="fa fa-traffic-light"></i> Servicio pagado por</label>
              <input class="form-control" name="servicio_pagado_por" placeholder="Servicio pagado por"></input>
            </div>
          </div>


          <!-- <div class="col-lg-6">
            <div class="form-group">
              <label for="migrado" class=" control-label"><i class="fa fa-cogs"></i> ¿Requiere migración?</label>
              <select name="migrado" class="form-control" required>
                <option value="">-- MIGRACIÓN --</option>
                <option value="<!?php echo "SI";?>"><!?php echo "SI";?></option>
                <option value="<!?php echo "NO";?>"><!?php echo "NO";?></option>
              </select>
            </div>
          </div> -->








          <!-- DATOS TECNOLOGICOS -->

          <div class="col-lg-6" id="id_t_espacio">
            <div class="form-group">
              <label for="t_espacio" class=" control-label"><i class="fa fa-map"></i> Tipo espacio de ubicación</label>
              <input class="form-control" name="t_espacio"  placeholder="Descripción"></input>
            </div>
          </div>


          <div class="col-lg-6" id="id_g_etnico">
            <div class="form-group">
              <label for="g_etnico" class=" control-label"><i class="fa fa-street-view"></i> Grupos étnicos</label>
              <!-- <textarea class="form-control" name="g_etnico" placeholder="Descripción"></textarea> -->
              <select name="g_etnico" id="g_etnico" class="form-control" required>
                <option value="">-- GRUPOS ETNICOS --</option>
                <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
              </select>
            </div>
          </div>

          <div class="col-lg-6" id="id_t_zona">
            <div class="form-group">
              <label for="t_zona" class=" control-label"><i class="fa fa-map-signs"></i> Tipo de zona</label>
              <!-- <textarea class="form-control" name="t_zona" placeholder="Descripción"></textarea> -->
              <select name="t_zona" id="t_zona" class="form-control" required>
                <option value="">-- TIPO ZONA --</option>
                <option value="<?php echo "Urbana"; ?>"><?php echo "Urbana"; ?></option>
                <option value="<?php echo "Rural"; ?>"><?php echo "Rural"; ?></option>
              </select>
            </div>
          </div>

          <div class="col-lg-6" id="id_m_fronterizo">
            <div class="form-group">
              <label for="m_fronterizo" class=" control-label"><i class="fa fa-flag"></i> Municipio fronterizo</label>
              <!-- <textarea class="form-control" name="m_fronterizo" placeholder="Descripción"></textarea> -->
              <select name="m_fronterizo" id="m_fronterizo" class="form-control" required>
                <option value="">-- FRONTERAS --</option>
                <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
              </select>
            </div>
          </div>

          <div class="col-lg-6" id="id_l_fronterizo">
            <div class="form-group">
              <label for="l_fronterizo" class=" control-label"><i class="fa fa-shekel"></i> Límite fronterizo</label>
              <!-- <textarea class="form-control" name="l_fronterizo" placeholder="Descripción"></textarea> -->
              <select name="l_fronterizo" id="l_fronterizo" class="form-control" required>
                <option value="">-- LÍMITES --</option>
                <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
              </select>
            </div>
          </div>


          <div class="col-lg-6" id="id_propuesto_nucleo_robotica">
            <div class="form-group">
              <label for="propuesto_nucleo_robotica" class=" control-label"><i class="fa fa-traffic-light"></i>¿Es propuesto como nucleo de robotica?</label>
              <select name="propuesto_nucleo_robotica" id="propuesto_nucleo_robotica" class="form-control" required>
                <option value="">-- PROPUESTO COMO NUCLEO DE ROBOTICA --</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6" id="id_espacio_robotica_educativa">
            <div class="form-group">
              <label for="espacio_robotica_educativa" class=" control-label"><i class="fa fa-traffic-light"></i>¿Es un espacio de robotica educativa?</label>
              <select name="espacio_robotica_educativa" id="espacio_robotica_educativa" class="form-control" required>
                <option value="">-- ESPACIO ROBOTICA EDUCATIVA --</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6" id="id_fecha_solicitud_migracion">
            <div class="form-group">
              <label for="fecha_solicitud_migracion" class=" control-label"><i class="fa fa-traffic-light"></i>Fecha de solicitud de migracion</label>
              <input type="date" name="fecha_solicitud_migracion" id="fecha_solicitud_migracion" class="form-control" placeholder="Fecha de solicitud de migracion">
    
            </div>
          </div>

          <div class="col-lg-6" id="id_fecha_reporte">
            <div class="form-group">
              <label for="fecha_reporte" class=" control-label"><i class="fa fa-traffic-light"></i>Fecha de reporte</label>
              <input type="date" name="fecha_reporte" id="fecha_reporte" class="form-control" placeholder="Fecha de reporte">
            </div>
          </div>

          <div class="col-lg-6" id="id_fecha_solucion">
            <div class="form-group">
              <label for="fecha_solucion" class=" control-label"><i class="fa fa-traffic-light"></i>Fecha de solucion a la falla</label>
              <input type="date" name="fecha_solucion" id="fecha_solucion" class="form-control" placeholder="Fecha de solucion a la falla">
            </div>
          </div>

          <div class="col-lg-6" id="id_observacion_falla">
            <div class="form-group">
              <label for="observacion_falla" class=" control-label"><i class="fa fa-traffic-light"></i>Observacion de la falla</label>
              <input type="text" name="observacion_falla" id="observacion_falla" class="form-control" placeholder="Observacion de la falla">
            </div>
          </div>

          <div class="col-lg-6" id="id_casos_resueltos_ano">
            <div class="form-group">
              <label for="casos_resueltos_ano" class=" control-label"><i class="fa fa-traffic-light"></i>Casos resueltos al año</label>
              <input type="text" name="casos_resueltos_ano" id="casos_resueltos_ano" class="form-control" placeholder="Casos resueltos al año">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="observacion" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
              <textarea class="form-control" name="observacion" placeholder="Nota"></textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Agregar infocentro</button>
            </div>
          </div>

        </div>
      </form>

    </div>
  </div>

</div>





<?php
$a = "Hola Mundo!";
?>

<!-- <script type="text/javascript"> alert( "<?php echo $a; ?>" ); </script> -->





<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->

<!-- <script src="../../../assets/js/jquery.min.js"></script> -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>


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
          // console.log(data);
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

      if (value == 'Cerrado' || value == 'Cierre Definitivo') {
        $($tabla).show();
        document.getElementById("Motivo del cierre").value = "";

        // $('option:not(.' + value + ')', $tabla).hide();
      } else {
        // Se ha seleccionado All
        $($tabla).hide();
        document.getElementById("Motivo del cierre").value = "No Aplica";
        // $('option', $tabla).show();
      }
    });
  })


  // oculta o muestra motivo de cierre al iniciar
  $(function() {
    var $tabla = $('#motivo_cierre');

    var value = $('#estatus').val();
    // alert(value);

    if (value == 'Cerrado' || value == 'Cierre Definitivo') {
      $($tabla).show();
      document.getElementById("Motivo del cierre").value = "";

      // $('option:not(.' + value + ')', $tabla).hide();
    } else {
      // Se ha seleccionado All
      $($tabla).hide();
      document.getElementById("Motivo del cierre").value = "No Aplica";

      // $('option', $tabla).show();
    }
  })




  document.addEventListener("DOMContentLoaded", function() {
    $("#cod_gerencia").change(function() {
      var codigo = $(this).val();

      if (codigo != 1) {
        $('#id_estatus').show();
        $('#id_transferido').show();
        $('#id_tecno_internet').show();
        $('#id_proveedor').show();
        $('#id_estatus_op').show();
        $('#id_g_etnico').show();
        $('#id_t_zona').show();
        $('#id_m_fronterizo').show();
        $('#id_l_fronterizo').show();
        $('#id_t_espacio').show();
        document.getElementById("estatus").required = true;
        document.getElementById("transferido").required = true;
        document.getElementById("tecno_internet").required = true;
        document.getElementById("proveedor").required = true;
        document.getElementById("estatus_op").required = true;
        document.getElementById("g_etnico").required = true;
        document.getElementById("t_zona").required = true;
        document.getElementById("m_fronterizo").required = true;
        document.getElementById("l_fronterizo").required = true;
      } else {
        $('#id_estatus').hide();
        $('#id_transferido').hide();
        $('#id_tecno_internet').hide();
        $('#id_proveedor').hide();
        $('#id_estatus_op').hide();
        $('#id_g_etnico').hide();
        $('#id_t_zona').hide();
        $('#id_m_fronterizo').hide();
        $('#id_l_fronterizo').hide();
        $('#id_t_espacio').hide();
        document.getElementById("estatus").required = false;
        document.getElementById("transferido").required = false;
        document.getElementById("tecno_internet").required = false;
        document.getElementById("proveedor").required = false;
        document.getElementById("estatus_op").required = false;
        document.getElementById("g_etnico").required = false;
        document.getElementById("t_zona").required = false;
        document.getElementById("m_fronterizo").required = false;
        document.getElementById("l_fronterizo").required = false;
      }

    })

  })
</script>