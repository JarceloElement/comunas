<?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();

$statuses = StatusData::getAll();
$payments = PaymentData::getAll();

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();

$munic_byID = MunicipioData::getById(1);




?>






<?php

    $PHP_SELFx = 'index.php?view=newinfocentro';
    echo "<script language=\"JavaScript\">
    <!-- 
    document.location=\"$PHP_SELFx#Ancho=\"+screen.width+\"&Alto=\"+screen.height;
    
    //-->
    </script>";



  ?>

<!-- ancho de pantalla -->
<!-- document.location=\"$PHP_SELFx#Ancho=\"+screen.width+\"&Alto=\"+screen.height; -->


<?php
// $valor = $_POST["caja_valor"];
// echo $valor; 
// el valor
?>

<div class="row">
<div class="col-md-10">
<h1>Agregar infocentro</h1>

<form class="form-horizontal" role="form" method="post" action="./?action=addinfocentro">
<div class="form-group">
    <label for="cod" class="col-lg-2 control-label">Código</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="cod" placeholder="COD"></textarea>
    </div>
  </div>


<!-- DATOS DEL INFOCENTRO -->
  <div class="form-group">
    <label for="nombre" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="nombre" placeholder="Nombre"></textarea>
    </div>
  </div>



  <div class="form-group">
    <label for="estatus" class="col-lg-2 control-label">Estatus</label>
    <div class="col-lg-10">
    <select name="estatus" class="form-control" required>
    <option value="">-- ESTATUS --</option>
    <option value=""><?php echo "Abierto";?></option>
    <option value=""><?php echo "Cerrado";?></option>
    </select>

    </div>
  </div>



<!-- ACTIVAR CUANDO ESTE CERRADO EL INFO -->
  <div class="form-group">
    <label for="motivo_cierre" class="col-lg-2 control-label">Motivo del cierre</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="motivo_cierre" placeholder="Motivo del cierre"></textarea>
    </div>
  </div>



  <div class="form-group">
    <label for="direccion" class="col-lg-2 control-label">Dirección</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="direccion" placeholder="Dirección"></textarea>
    </div>
  </div>



  <form id="combo" name="combo" action="guarda.php" method="POST">
			<div>Selecciona Estado : <select name="cbx_estado" id="cbx_estado">
				<option value="0">Seleccionar Estado</option>
        
				<?php foreach($estado as $p):?>
        <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
        <?php endforeach; ?>
    
			</select></div>
			
			<br />
			
			<div>Selecciona Municipio : <select name="cbx_municipio" id="cbx_municipio"></select></div>
			
			<br />
			
			<div>Selecciona Localidad : <select name="cbx_localidad" id="cbx_localidad"></select></div>
			
			<br />
			<input type="submit" id="enviar" name="enviar" value="Guardar" />
		</form>




  <div class="form-group">
    <label for="estado" class="col-lg-2 control-label">Estado</label>
    <div class="col-lg-10">
      <select name="estado" class="form-control" id="filtro_estados">
        <option value="">-- ESTADO --</option>
        <?php foreach($estado as $p):?>
          <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
        <!?php $muni= $p->id_estado; ?>
          

        <?php endforeach; ?>
        </select>


        <!?php $muni= 55; ?>



        <?php



// echo "<script language=\"JavaScript\"> document.getElementById('filtro_estados').value  </script>";


// echo "<script type='text/javascript'> alert('Just wanted to say $muni!'); </script>"; // Pasar var desde PHP a JS



        // $var_PHP = "<script document.getElementById('municipios').value=this.value </script>"; // igualar el valor de la variable JavaScript a PHP 

    // echo $var_PHP;   // muestra el resultado 
  echo "xxx";
  
    ?>

    </div>
  </div>
  
  

  <form class="form-inline" method="POST" action=""> 
<label>Nombres: </label> 
<input class="form-control" type="text" id="trord" onblur="document.getElementById('uno').value=this.value" />
<label>Nombres: </label>
<input type="text" id="uno" placeholder="Recibe contenido"  class="form-control">  

</form>
  

  <div class="form-group" id='recargar_munic'>
    <label for="municipio" class="col-lg-2 control-label">Municipio</label>
    <div class="col-lg-10" >
      <select name="municipio2" class="form-control" id="municipios">

        <option value="">-- MUNICIPIOS --</option>

        <!?php echo MunicipioData::getById( 1 ); ?>

      </select>

      <?php

    // echo $var_PHP;   // muestra el resultado 
  // echo "xxx";
    ?>

    </div>
  </div>








  <div class="form-group">
    <label for="ciudad" class="col-lg-2 control-label">Ciudad</label>
    <div class="col-lg-10">
      <select name="ciudad" class="form-control" id="ciudades">
        <option value="">-- CIUDAD --</option>
        <?php foreach($ciudad as $p):?>
          <option class="<?php echo $p->id_estado; ?>"> <?php echo $p->ciudad; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>



  <div class="form-group">
    <label for="parroquia" class="col-lg-2 control-label">Parroquia</label>
    <div class="col-lg-10">
      <select name="parroquia" class="form-control" id="parroquias">
        <option value="">-- PARROQUIA --</option>
        <?php foreach($parroquia as $p):?>
            <option class="<?php echo $p->id_municipio; ?>"> <?php echo $p->parroquia; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>



  <div class="form-group">
    <label for="f_instalacion" class="col-lg-2 control-label">Fecha de instalación</label>
    <div class="col-lg-5">
      <input type="date" name="f_instalacion" required class="form-control" id="inputEmail1" placeholder="Fecha de instalación">
    </div>
  </div>


  <div class="form-group">
  <label for="perso_contacto" class="col-lg-2 control-label">Persona de contacto</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="perso_contacto" placeholder="Persona de contacto"></textarea>
    </div>
  </div>




  <div class="form-group">
    <label for="n_circuito" class="col-lg-2 control-label">N° de circito</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="n_circuito" placeholder="N° circuito"></textarea>
    </div>
  </div>


  <div class="form-group">
    <label for="central_dlci" class="col-lg-2 control-label">Central DLCI</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="central_dlci" placeholder="Central DLCI"></textarea>
    </div>
  </div>



  <div class="form-group">
  <label for="transferido" class="col-lg-2 control-label">Transferencia comunal</label>
    <div class="col-lg-10">
    <select name="transferido" class="form-control" required>
    <option value="">-- TRANSFERENCIA --</option>
    <option value=""><?php echo "SI";?></option>
    <option value=""><?php echo "NO";?></option>
    </select>

    </div>
  </div>







<!-- DATOS TECNOLOGICOS -->

  <div class="form-group">
  <label for="tecno_internet" class="col-lg-2 control-label">Tecnología de internet actual</label>
    <div class="col-lg-10">
    <select name="tecno_internet" class="form-control" required>
    <option value="">-- TECOLOGÍA --</option>
    <option value=""><?php echo "ABA";?></option>
    <option value=""><?php echo "Satelital";?></option>
    </select>

    </div>
  </div>




  <div class="form-group">
  <label for="proveedor" class="col-lg-2 control-label">Proveedor</label>
    <div class="col-lg-10">
    <select name="proveedor" class="form-control" required>
    <option value="">-- PROVEEDOR DE INTERNET --</option>
    <option value=""><?php echo "CANTV";?></option>
    <option value=""><?php echo "Otro";?></option>
    </select>

    </div>
  </div>




  <div class="form-group">
  <label for="estatus_op" class="col-lg-2 control-label">Estatus operativo</label>
    <div class="col-lg-10">
    <select name="estatus_op" class="form-control" required>
    <option value="">-- OPERATIVIDAD --</option>
    <option value=""><?php echo "Operativo";?></option>
    <option value=""><?php echo "Inoperativo";?></option>
    <option value=""><?php echo "Sin enlace";?></option>
    </select>

    </div>
  </div>



 

  <div class="form-group">
  <label for="migrado" class="col-lg-2 control-label">¿Requiere migración?</label>
    <div class="col-lg-10">
    <select name="migrado" class="form-control" required>
    <option value="">-- MIGRARLO --</option>
    <option value=""><?php echo "SI";?></option>
    <option value=""><?php echo "NO";?></option>
    </select>

    </div>
  </div>



  <div class="form-group">
    <label for="observacion" class="col-lg-2 control-label">Oservacion</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="observacion" placeholder="Nota"></textarea>
    </div>
  </div>



  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Agregar Cita</button>
    </div>
  </div>
</form>

</div>
</div>






<!-- <?php 
$a = "Hola Mundo!";
?>

<script type="text/javascript"> alert( "<?php echo $a; ?>" ); </script>
 -->




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->

<!-- <script src="../../../assets/js/jquery.min.js"></script> -->





<script type="text/javascript">
  // document.getElementById("filtro_estados").value = $(this).val();

function PasarValor()
{
document.getElementById("nombre2").value = document.getElementById("nombre1").value;
}





$(function(){


				$("#filtro_estados").change(function () {
          // id_estado = $(this).val();
          // $("#apellidos2").val(id_estado);


          // alert(id_estado);

          $("#filtro_estados option:selected").each(function () {
						id_estado = $(this).val();

						$.post("getMunicipio.php", { id_estado: id_estado }, function(data){
							$("#cbx_municipio").html(data);
						});            
					});


          // window.location.href = "somepage.php?w1=" + id_estado + "&w2=" + id_estado;

          // $("#recargar_munic").load(location.href + " #recargar_munic");

				})


        // <!?php echo MunicipioData::getById( $var_PHP ); ?>
  

})
</script>

<script language="javascript">
			$(document).ready(function(){
				$("#cbx_estado").change(function () {

					$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#cbx_estado option:selected").each(function () {
						id_estado = $(this).val();
						$.post("getMunicipio.php", { id_estado: id_estado }, function(data){
							$("#cbx_municipio").html(data);
						});            
					});
				})
			});
			
      
			$(document).ready(function(){
				$("#cbx_municipio").change(function () {
					$("#cbx_municipio option:selected").each(function () {
						id_municipio = $(this).val();
						$.post("includes/getLocalidad.php", { id_municipio: id_municipio }, function(data){
							$("#cbx_localidad").html(data);
						});            
					});
				})
			});
		</script>