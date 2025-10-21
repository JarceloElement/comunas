<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();

$munic_byID = MunicipioData::getById(1);

$info = InfoData::getById($_GET["id"]);
$internet_type = InternetTypeData::getAll();
$status_type = StatusInfocentroData::getAll();


?>




<script>
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
        // console.log(res);
        // console.log(array);
        toastify(array.alert, true, 13000, array.alert_type);
        $('#cover-spin').hide(0);

        if (array.data == "code") {
          document.querySelector("#cod").focus();
        }else{
          if (array.alert_type != 'error'){
            setTimeout(function() {
              window.location.href = './?view=infocentros';
            }, 1000);
          }
          
        }
        // form.get(0).reset();

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



<div class="col-md-8">
  <span class='text_label'> <i class='fa fa-edit icon_label'></i> <b>Editar infocentro <?php echo $info->cod; ?></b> </span>
  <div class="card">

    <div class="card-content table-responsive">

      <div class="card-body">

        <form id="send_form" class="form-horizontal" role="form" method="post" action="./?action=updateinfocentro">
          <input class="form-control" style="display:none" name="id" value="<?php echo $info->id; ?>"></input>

          <div class="form-group">

            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre" class=" control-label"><i class="fa fa-list-alt"></i> Código</label>
                  <input class="form-control" name="cod" id="cod" value="<?php echo $info->cod; ?>" placeholder="Código" required></input>
                </div>
              </div>


              <!-- DATOS DEL INFOCENTRO -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre" class=" control-label"><i class="fa fa-user"></i> Nombre</label>
                  <input class="form-control" name="nombre" value="<?php echo $info->nombre; ?>" placeholder="Nombre" required></input>
                </div>
              </div>




              <div class="col-md-12">

                <div class="form-group">
                  <label for="direccion" class=" control-label"><i class="fa fa-list-alt"></i> Dirección</label>
                  <input class="form-control" name="direccion" value="<?php echo $info->direccion; ?>" placeholder="Dirección"></input>
                </div>
              </div>


              <div class="col-lg-6">
                <div class="form-group">
                  <label for="estado" class=" control-label"><i class="fa fa-map"></i> Estado</label>
                  <select name="estado" class="form-control" id="estados_1" required>
                    <option value="<?php echo $info->estado; ?>"><?php echo $info->estado; ?></option>
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
                    <option value="<?php echo $info->municipio; ?>"><?php echo $info->municipio; ?></option>

                  </select>
                </div>
              </div>


              <div class="col-lg-6">
                <div class="form-group">
                  <label for="parroquia" class=" control-label"><i class="fa fa-map-pin"></i> Parroquia</label>
                  <select name="parroquia" class="form-control" id="parroquias_1">
                    <option value="<?php echo $info->parroquia; ?>"><?php echo $info->parroquia; ?></option>
                  </select>
                </div>
              </div>




              <div class="col-lg-6">
                <div class="form-group">
                  <label for="ciudad" class=" control-label"><i class="fa fa-thumb-tack"></i> Ciudad</label>
                  <select name="ciudad" class="form-control" id="ciudades">
                    <option value="<?php echo $info->ciudad; ?>"><?php echo $info->ciudad; ?></option>
                  </select>
                </div>
              </div>








              <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="cod_gerencia" class=" control-label"><i class="fa fa-warning"></i> ¿Es código de gerencia?</label>
                    <select name="cod_gerencia" class="form-control" required>
                      <option value="<?php echo $info->cod_gerencia; ?>"><?php echo $info->cod_gerencia; ?></option>
                      <option value="<?php echo "1"; ?>"><?php echo "SI"; ?></option>
                      <option value="<?php echo "0"; ?>"><?php echo "NO"; ?></option>
                    </select>
                  </div>
                </div>

              <?php } ?>

              <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label"><i class="fa fa-hourglass-2"></i> Estatus</label>
                    <select name="estatus" class="form-control" id="estatus">
                      <option value="<?php echo $info->estatus; ?>"><?php echo $info->estatus; ?></option>
                      <?php foreach ($status_type as $p): ?>
                        <option value="<?php echo $p->status; ?>"><?php echo $p->status ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <!-- ACTIVAR CUANDO ESTE CERRADO EL INFO -->
                <div class="col-md-12" id="motivo_cierre">
                  <div class="form-group">
                    <label for="motivo_cierre" class=" control-label"> <i class="fa fa-list-alt"></i> Motivo del cierre</label>
                    <input class="form-control" name="motivo_cierre" id="Motivo del cierre" value="<?php echo $info->motivo_cierre; ?>" placeholder="Motivo del cierre"></input>
                  </div>
                </div>


              <?php } ?>


              <div class="col-lg-6">
                <div class="form-group">
                  <label for="perso_contacto" class=" control-label"><i class="fa fa-user"></i> Persona de contacto</label>
                  <input class="form-control" name="perso_contacto" value="<?php echo $info->perso_contacto; ?>" placeholder="Persona de contacto"></input>
                </div>
              </div>


              <div class="col-lg-6">
                <div class="form-group">
                  <label for="telef_contacto" class=" control-label"><i class="fa fa-phone"></i> Teléfono de contacto</label>
                  <input class="form-control" name="telef_contacto" value="<?php echo $info->telef_contacto; ?>" placeholder="Teléfono de contacto"></input>
                </div>
              </div>


              <div class="col-lg-12">
                <div class="form-group">
                  <label for="f_instalacion" class=" control-label"><i class="fa fa-calendar"></i> Fecha instalación</label>
                  <input type="date" name="f_instalacion" value="<?php echo $info->f_instalacion; ?>" class="form-control" id="inputEmail1" placeholder="Fecha de instalación">
                </div>
              </div>

              <!-- <div class="col-lg-6">
                <div class="form-group">
                  <label for="n_circuito" class=" control-label"><i class="fa fa-calendar"></i> N° de circuito</label>
                  <input class="form-control" name="n_circuito" value="<!?php echo $info->n_circuito;?>" placeholder="N° circuito"></input>
                </div>
              </div>


              <div class="col-lg-6">
                <div class="form-group">
                  <label for="central_dlci" class=" control-label"><i class="fa fa-calendar"></i> Central DLCI</label>
                  <input class="form-control" name="central_dlci" value="<!?php echo $info->central_dlci;?>" placeholder="Central DLCI"></input>
                </div>
              </div> -->



              <div class="col-lg-6">
                <div class="form-group">
                  <label for="transferido" class=" control-label"><i class="fa fa-home"></i> Transferencia comunal</label>
                  <select name="transferido" id="transferido" class="form-control">
                    <option value="<?php echo $info->transferido; ?>"><?php echo $info->transferido; ?></option>
                    <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                    <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
                  </select>
                </div>
              </div>







              <!-- DATOS TECNOLOGICOS -->

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="tecno_internet" class=" control-label"><i class="fa fa-signal"></i> Tecnología de internet actual</label>
                  <select name="tecno_internet" id="tecno_internet" class="form-control">
                    <option value="<?php echo $info->tecno_internet; ?>"><?php echo $info->tecno_internet; ?></option>
                    <?php foreach ($internet_type as $p): ?>
                      <option value="<?php echo $p->type; ?>"><?php echo $p->type ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="proveedor" class=" control-label"><i class="fa fa-building"></i> Proveedor</label>
                  <select name="proveedor" id="proveedor" class="form-control">
                    <option value="<?php echo $info->proveedor; ?>"><?php echo $info->proveedor; ?></option>
                    <option value="<?php echo "CANTV"; ?>"><?php echo "CANTV"; ?></option>
                    <option value="<?php echo "Otro"; ?>"><?php echo "Otro"; ?></option>
                  </select>
                </div>
              </div>




              <div class="col-lg-6">
                <div class="form-group">
                  <label for="estatus_op" class=" control-label"><i class="fa fa-traffic-light"></i> Estatus operativo</label>
                  <select name="estatus_op" id="estatus_op" class="form-control">
                    <option value="<?php echo $info->estatus_op; ?>"><?php echo $info->estatus_op; ?></option>
                    <option value="<?php echo "Operativo"; ?>"><?php echo "Operativo"; ?></option>
                    <option value="<?php echo "Inoperativo"; ?>"><?php echo "Inoperativo"; ?></option>
                    <option value="<?php echo "Sin enlace"; ?>"><?php echo "Sin enlace"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6" id="id_servicio_pagado_por">
                <div class="form-group">
                  <label for="servicio_pagado_por" class=" control-label"><i class="fa fa-traffic-light"></i> Servicio pagado por</label>
                  <input class="form-control" value="<?php echo $info->servicio_pagado_por; ?>" name="servicio_pagado_por" placeholder="Servicio pagado por"></input>
                </div>
              </div>


              <!-- <div class="col-lg-6">
                <div class="form-group">
                  <label for="migrado" class=" control-label"><i class="fa fa-calendar"></i> ¿Requiere migración?</label>
                  <select name="migrado" class="form-control" required>
                    <option value="<!?php echo $info->migrado;?>"><!?php echo $info->migrado;?></option>
                    <option value="<!?php echo "SI";?>"><!?php echo "SI";?></option>
                    <option value="<!?php echo "NO";?>"><!?php echo "NO";?></option>
                  </select>
                </div>
              </div> -->







              <div class="col-lg-12">
                <div class="form-group">
                  <label for="t_espacio" class=" control-label"><i class="fa fa-map"></i> Tipo espacio de ubicación</label>
                  <input class="form-control" name="t_espacio" value="<?php echo $info->espacio_inst; ?>" placeholder="Descripción"></input>

                </div>
              </div>


              <div class="col-lg-6">
                <div class="form-group">
                  <label for="g_etnico" class=" control-label"><i class="fa fa-street-view"></i> Grupos étnicos</label>
                  <!-- <textarea class="form-control" name="g_etnico" placeholder="Descripción"></textarea> -->
                  <select name="g_etnico" id="g_etnico" class="form-control">
                    <option value="<?php echo $info->grupos_etnicos; ?>"><?php echo $info->grupos_etnicos; ?></option>
                    <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                    <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="t_zona" class=" control-label"><i class="fa fa-map-signs"></i> Tipo de zona</label>
                  <!-- <textarea class="form-control" name="t_zona" placeholder="Descripción"></textarea> -->
                  <select name="t_zona" id="t_zona" class="form-control">
                    <option value="<?php echo $info->tipo_zona; ?>"><?php echo $info->tipo_zona; ?></option>
                    <option value="<?php echo "Urbana"; ?>"><?php echo "Urbana"; ?></option>
                    <option value="<?php echo "Rural"; ?>"><?php echo "Rural"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="m_fronterizo" class=" control-label"><i class="fa fa-flag"></i> Municipio fronterizo</label>
                  <!-- <textarea class="form-control" name="m_fronterizo" placeholder="Descripción"></textarea> -->
                  <select name="m_fronterizo" id="m_fronterizo" class="form-control">
                    <option value="<?php echo $info->municipio_fronterizo; ?>"><?php echo $info->municipio_fronterizo; ?></option>
                    <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                    <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="l_fronterizo" class=" control-label"><i class="fa fa-shekel"></i> Límite fronterizo</label>
                  <!-- <textarea class="form-control" name="l_fronterizo" placeholder="Descripción"></textarea> -->
                  <select name="l_fronterizo" id="l_fronterizo" class="form-control">
                    <option value="<?php echo $info->limite_fronterizo; ?>"><?php echo $info->limite_fronterizo; ?></option>
                    <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                    <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6" id="id_propuesto_nucleo_robotica">
                <div class="form-group">
                  <label for="propuesto_nucleo_robotica" class=" control-label"><i class="fa fa-traffic-light"></i>¿Es propuesto como nucleo de robotica?</label>
                  <select name="propuesto_nucleo_robotica" id="propuesto_nucleo_robotica" class="form-control" required>
                    <option value="<?php echo $info->propuesto_nucleo_robotica; ?>"><?php echo $info->propuesto_nucleo_robotica; ?></option>
                    <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                    <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6" id="id_espacio_robotica_educativa">
                <div class="form-group">
                  <label for="espacio_robotica_educativa" class=" control-label"><i class="fa fa-traffic-light"></i>¿Es un espacio de robotica educativa?</label>
                  <select name="espacio_robotica_educativa" id="espacio_robotica_educativa" class="form-control" required>
                    <option value="<?php echo $info->espacio_robotica_educativa; ?>"><?php echo $info->espacio_robotica_educativa; ?></option>
                    <option value="<?php echo "SI"; ?>"><?php echo "SI"; ?></option>
                    <option value="<?php echo "NO"; ?>"><?php echo "NO"; ?></option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6" id="id_fecha_solicitud_migracion">
                <div class="form-group">
                  <label for="fecha_solicitud_migracion" class=" control-label"><i class="fa fa-traffic-light"></i>Fecha de solicitud de migracion</label>
                  <input type="date" value="<?php echo $info->fecha_solicitud_migracion; ?>" name="fecha_solicitud_migracion" id="fecha_solicitud_migracion" class="form-control" placeholder="Fecha de solicitud de migracion">

                </div>
              </div>

              <div class="col-lg-6" id="id_fecha_reporte">
                <div class="form-group">
                  <label for="fecha_reporte" class=" control-label"><i class="fa fa-traffic-light"></i>Fecha de reporte</label>
                  <input type="date" value="<?php echo $info->fecha_reporte; ?>" name="fecha_reporte" id="fecha_reporte" class="form-control" placeholder="Fecha de reporte">
                </div>
              </div>

              <div class="col-lg-6" id="id_fecha_solucion">
                <div class="form-group">
                  <label for="fecha_solucion" class=" control-label"><i class="fa fa-traffic-light"></i>Fecha de solucion a la falla</label>
                  <input type="date" value="<?php echo $info->fecha_solucion; ?>" name="fecha_solucion" id="fecha_solucion" class="form-control" placeholder="Fecha de solucion a la falla">
                </div>
              </div>

              <div class="col-lg-6" id="id_observacion_falla">
                <div class="form-group">
                  <label for="observacion_falla" class=" control-label"><i class="fa fa-traffic-light"></i>Observacion de la falla</label>
                  <input type="text" value="<?php echo $info->observacion_falla; ?>" name="observacion_falla" id="observacion_falla" class="form-control" placeholder="Observacion de la falla">
                </div>
              </div>

              <div class="col-lg-6" id="id_casos_resueltos_ano">
                <div class="form-group">
                  <label for="casos_resueltos_ano" class=" control-label"><i class="fa fa-traffic-light"></i>Casos resueltos al año</label>
                  <input type="text" value="<?php echo $info->casos_resueltos_ano; ?>" name="casos_resueltos_ano" id="casos_resueltos_ano" class="form-control" placeholder="Casos resueltos al año">
                </div>
              </div>





              <div class="col-lg-6">
                <div class="form-group">
                  <label for="observacion" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
                  <input type="text" class="form-control" name="observacion" value="<?php echo $info->observacion; ?>" placeholder="Nota"></input>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Guardar infocentro</button>
                </div>
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
    $(document).ready(function() {

      // ocultar campo al iniciar
      // $('#motivo_cierre').hide();
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