<?php

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$coordinations = CoordTypeData::getAll();
$personal_type = PersonalTypeData::getAll();

?>

<div class="row">
  <div class="card">
    
    <div class="card-header" data-background-color="blue">
        <h4 class="title">Nuevo coordinador</h4>
    </div>


    <div class="card-content table-responsive">
    
      <form class="form-horizontal" role="form" method="post" action="./?action=coordinator&function=add">

        <div class="form-group">

 


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
              <label for="document_number" class=" control-label"><i class="fa fa-list-alt"></i> N° documento</label>
              <textarea type="number" class="form-control" name="document_number" placeholder="N° documento" required></textarea>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="phone_number" class=" control-label"><i class="fa fa-phone"></i> N° teléfono</label>
              <textarea type="number" class="form-control" name="phone_number" placeholder="N° teléfono" required></textarea>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group">
              <label for="genero" class=" control-label"><i class="fa fa-venus-mars"></i> Género</label>
              <select name="genero" class="form-control" id="genero" required>
                <option value="">-- GÉNERO --</option>
                <option value="<?php echo "Hombre";?>"><?php echo "Hombre";?></option>
                <option value="<?php echo "Mujer";?>"><?php echo "Mujer";?></option>

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
                <?php foreach($coordinations as $p):?>
                  <option value="<?php echo $p->id; ?>"> <?php echo $p->name; ?></option>
                <?php endforeach; ?>
              </select>
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
              <label for="estado" class=" control-label"><i class="fa fa-map"></i> Estado</label>
              <select name="estado" class="form-control" id="estados_1" required>
                <option value="">-- ESTADO --</option>
                <?php foreach($estado as $p):?>
                  <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          

          <div class="col-lg-6">
            <div class="form-group" id='recargar_munic'>
                <label for="municipio" class=" control-label"><i class="fa fa-map-marker"></i> Municipio</label>
                <select name="municipio" class="form-control" id="municipios" required>
                  <option value="0">-- MUNICIPIOS --</option>

                </select>
              </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group">
                <label for="parroquia" class=" control-label"><i class="fa fa-map-pin"></i> Parroquia</label>
                <select name="parroquia" class="form-control" id="parroquias_1" >
                  <option value="">-- PARROQUIA --</option>
                </select>
              </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group">
              <label for="status_nom" class=" control-label"><i class="fa fa-list-alt"></i> Estatus nómina</label>
                <select name="status_nom" class="form-control" id="status_nom" required>
                  <option value="Activo">Activo</option>
                  <option value="Inactivo">Inactivo</option>
                  <option value="<?php echo "CS-E";?>"><?php echo "CS-E";?></option>
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
                <?php foreach($personal_type as $p):?>
                  <option value="<?php echo $p->type; ?>"> <?php echo $p->type; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="observations" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
              <textarea class="form-control" name="observations" placeholder="Nota"></textarea>
            </div>
          </div>


          <div class="col-md-6">
              <div class="form-group">
                <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Agregar coordinador</button>
              </div>
          </div>

        </div>
      </form>

    </div>
  </div>

</div>





<!-- <?php 
$a = "Hola Mundo!";
?>

<script type="text/javascript"> alert( "<?php echo $a; ?>" ); </script>
 -->




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->

<!-- <script src="../../../assets/js/jquery.min.js"></script> -->


		<script language="javascript">
			$(document).ready(function(){
				$("#estados_1").change(function () {

					$('#municipios').find('option').remove().end().append('<option value=""></option>').val('0');
					$('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');
					
					$("#estados_1 option:selected").each(function () {
						id_estado = $(this).val();
					
					// alert(id_estado);
					// alert($("#municipios").val());
            
						$.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
						$("#municipios").html(data);
						});  

						$.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
						$("#ciudades").html(data);
						});          
					});
				})
			});
			

			$(document).ready(function(){
				$("#municipios").change(function () {
					$("#municipios option:selected").each(function () {
						id_municipio = $(this).val();
					// alert(id_municipio);
						
						$.post("core/app/view/getParroquia.php", { id_municipio: id_municipio }, function(data){
							$("#parroquias_1").html(data);
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


		</script>
		
	