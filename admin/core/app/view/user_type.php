<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">

$(document).ready(function(){
	// NOTIFICACION
	if ('<?php echo $_GET['swal']; ?>' != ""){
		Swal.fire({
		position: 'top-center',
		icon: 'success',
		title: '<?php echo $_GET['swal']; ?>',
		showConfirmButton: false,
		timer: 1500
		})
	};

	var location = window.location;

	$('#add_user_type').click( function() { 
		if ($("#user_type_name").val() != ""){ // valida la informacion
			$.post("./?action=ajax", {
				function: "add_user_type", // funcion que llama
				user_type: $("#user_type").val(), // parametros
				user_type_name: $("#user_type_name").val() // parametros

			}, function(data){
				if (data != ""){
					return window.location=location+"&swal="+data;
				};
			});
			alert('Registro enviado' );
		};
		
	});
		
});

</script>


<?php
// $estado = EstadoData::getAll();
// $municipio = MunicipioData::getAll();

// $internet_type = new CategoryData();
// $internet_type->type = $_POST["name"];
// $internet_type->add();
?>

<div class="panel-heading">
	<h4 class="title">
	<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
	<span class='text_label'> <i class='fa fa-signal icon_label' ></i> <b> Tipo de usuario </b> </span>
	</a>
	</h4>
</div>
Usuario final (1) 	
Facilitador (2) 	
Coordinador estadal (3) 	
Gerencia sustantiva (4) 	
Gerencia RNI (5) 	
Políticas públicas ADMIN (6) 	
Administración del sistema (7)
Jefe de estado (8)
Gerencias ADMIN (9)

<div class="content-wrapper">
    <!-- <div class="card-header">
        <h6 class="card-text">1: Usuario final, 2: Facilitador, 3: Coordinador estadal, 4: Gerencia sustantiva, 5. Gerencia principal 6. Políticas públicas 7. Administración del sistema </h6>
		<br>
	</div> -->

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-content table-responsive">
					<div class="card-body">
						<form method="post" id="addcategory" role="form">

							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail1" class="control-label"><i class="fa fa-user-cog"></i> Nombre: ejem. (Admin,Coord)*</label>
									<input type="text" name="param" id="user_type_name" required class="form-control" placeholder="Nombre de usuario">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail1" class="control-label"><i class="fa fa-lock"></i> Privilegios del 1-5*</label>
									<input type="number" name="param" id="user_type" required class="form-control" placeholder="1-5">
								</div>
							</div>



							<div class="col-lg-6">
								<div class="form-group">
									<button type="submit" name="" id="add_user_type" class="btn btn-primary btn-block">Agregar</button>
								</div>
							</div>
						</form>			


				<?php

				$CantidadMostrar=10;
				$url_pag_atras = "";
				$url_pag_adelante = "";

				// Validado  la variable GET
				$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


				$total = UserTypeData::getAll();
				$TotalReg = count($total);
				
				$sql = "select * from user_type order by id asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
				$param = UserTypeData::getBySQL($sql);

				$url_pag = "<a href=\"?view=data&type=".$_GET["type"]."&swal=&pag=";

				//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
				$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);

				?>

				<!-- MENSAJE DE TOTALES -->
				<div class="card-content">
					<div class="card-body">
						<div class="form-group text_label">
							<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br>"; ?>
						</div>
					</div>
				</div class="card-content">


				<!-- LISTA DE REGISTROS -->
				<div class="card-content table-responsive">
					<?php if(count($param)>0){ ?>
						<!-- si hay usuarios -->

						<table class="table table-bordered table-hover">
							<thead>
								<th>Nombre</th>
								<th>Privilegios</th>
								<th>Acciones</th>
							</thead>
							
							<?php
							foreach($param as $types){
								// $pacient  = $user->getPacient();
								// $medic = $user->getMedic();
								?>
								<tr>
								<td><?php echo $types->user_type_name; ?></td>
								<td><?php echo $types->user_type; ?></td>
								
								<td style="width:180px;">
								<!-- <a href="index.php?view=editmunicipio&id=<!?php echo $user->id_municipio;?>" class="btn btn-warning btn-xs">Editar</a> -->
								<!-- <a href="./?action=delinternettype&id=<!?php echo $types->id;?>" class="btn btn-danger btn-xs">Eliminar</a> -->
								<a href="./?action=ajax&function=del_user_type&id=<?php echo $types->id;?>&type=<?php echo $_GET["type"];?>" class="btn btn-danger btn-xs">Eliminar</a>
								</td>
								</tr>
								<?php

							}
							?>
						</table>


					<?php
					}else{
						echo "<p class='alert alert-danger'>No hay registros</p>";
					}
					?>


				</div class="card-content table-responsive">
				<!-- FIN LISTA DE REGISTROS -->

			</div class="row">
		</form>
	</div class="card-body">
	

		


	<!-- PAGINACION -->
	<?php include "core/app/layouts/pagination.php"; ?>
	<!-- FIN PAGINACION -->


</div class="content-wrapper">












