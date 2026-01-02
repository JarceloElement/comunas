<?php

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$personal_type = PersonalTypeData::getAll();

				
$con = Database::getCon();
$etnias = $con->query("select * from etnia_type");
$discapacidad = $con->query("select * from disability_type");
// $etnias = mysqli_fetch_array($query);

// foreach($query as $name):
// echo $name["name"];
// endforeach

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					
					<div class="card-header card-header-primary">
						<h4 class="title text-left">Nuevo usuario final</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

          
          <div class="card-body">

            <form accept-charset="UTF-8" class="form-horizontal" method="post" action="./?action=finaluser&function=add" role="form">

              <div class="form-row">

    


                <!-- DATOS DEL FACILITADOR -->
          
                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                  <input type="text" name="user_nombres" required></input>
                  <label><i class="fa fa-user"></i> Nombres*</label>
                </div>



                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="text" name="user_apellidos" required></input>
                  <label><i class="fa fa-user"></i> Apellidos*</label>
                </div>

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="text" name="user_dni" required></input>
                  <label><i class="fa fa-user"></i> N° documento*</label>
                </div>

       
                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="email" type="email" name="user_correo"></input>
                  <label><i class="fa fa-user"></i> Correo</label>
                </div>
           

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="number" name="user_telefono"></input>
                  <label><i class="fa fa-user"></i> Teléfono</label>
                </div>

    

                <div class="col-md-6 mui-select">
                  <select name="user_genero" id="user_genero" required>
                    <option value="">-- GÉNERO --</option>
                    <option value="<?php echo "Hombre";?>"><?php echo "Hombre";?></option>
                    <option value="<?php echo "Mujer";?>"><?php echo "Mujer";?></option>
                  </select>
                  <label><i class="fa fa-user"></i> Género*</label>
                </div>


                <div class="col-md-6 mui-select">
                  <select name="user_etnia" id="user_etnia" required>
                      <option value="">-- ETNIA --</option>
                      <?php foreach($etnias as $name):?>
                        <option value="<?php echo $name["name"]; ?>"> <?php echo $name["name"]; ?></option>
                      <?php endforeach; ?>
                    </select>
                  <label><i class="fa fa-user"></i> Pueblo indígena*</label>
                </div>

                <div class="col-md-6 mui-select">
									<select name="disability_type" id="disability_type" required>
										<option value="">-- DISCAPACIDAD --</option>
										<?php foreach($discapacidad as $name):?>
											<option value="<?php echo $name["disability"]; ?>"> <?php echo $name["disability"]; ?></option>
										<?php endforeach; ?>
										</select>
									<label><i class="fa fa-user"></i> Discapacidad*</label>
								</div>
         

                <div class="col-md-6 mui-textfield">
                <input type="date" name="user_f_nacimiento" required id="user_f_nacimiento">
                  <label><i class="fa fa-user"></i> Fecha nacimiento*</label>
                </div>


                <div class="col-md-6 mui-select">
                  <select name="user_nivel_academ" id="user_nivel_academ" required>
                      <option value="">-- NIVEL ACADÉMICO --</option>
                      <option value="<?php echo "Primaria";?>"><?php echo "Primaria";?></option>
                      <option value="<?php echo "Secundaria";?>"><?php echo "Secundaria";?></option>
                      <option value="<?php echo "Bachillerato";?>"><?php echo "Bachillerato";?></option>
                      <option value="<?php echo "Universitario";?>"><?php echo "Universitario";?></option>
                    </select>
                  <label><i class="fa fa-user"></i> Nivel académico*</label>
                </div>

  
                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="text" name="user_profesion"></input>
                  <label><i class="fa fa-user"></i> Profesión</label>
                </div>

          

                <div class="col-md-6 mui-select">
                  <select name="user_empleado" id="user_empleado" required>
                      <option value="">-- SELECCIONE --</option>
                      <option value="<?php echo "Empleado";?>"><?php echo "Empleado";?></option>
                      <option value="<?php echo "Jubilado";?>"><?php echo "Jubilado";?></option>
                      <option value="<?php echo "Trabajo del hogar";?>"><?php echo "Trabajo del hogar";?></option>
                      <option value="<?php echo "No trabaja";?>"><?php echo "No trabaja";?></option>
                    </select>
                  <label><i class="fa fa-user"></i> Situación laboral*</label>
                </div>


                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="text" name="user_institucion"></input>
                  <label><i class="fa fa-user"></i> Lugar dónde trabaja</label>
                </div>

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input type="text" name="user_organizacion"></input>
                  <label><i class="fa fa-user"></i> Pertenece a Organización social (Nombre)</label>
                </div>

                
                <div class="col-md-6 mui-select">
                  <select name="user_estado" id="estados" required>
                      <option value="">-- ESTADO --</option>
                      <?php foreach($estado as $p):?>
                        <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                      <?php endforeach; ?>
                    </select>
                  <label><i class="fa fa-user"></i> Estado*</label>
                </div>

   
                <div class="col-md-6 mui-select">
                  <select name="user_municipio" id="municipios_1" required>
                    <option value="0">-- MUNICIPIOS --</option>
                  </select>
                  <label><i class="fa fa-user"></i> Municipio*</label>
                </div>

        

                <div class="col-md-6 mui-textfield mui-textfield--float-label">
                <input name="user_direccion" required></input>
                  <label><i class="fa fa-user"></i> Dirección*</label>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Agregar usuario</button>
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


		</script>
		
	