<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">

$(document).ready(function(){
	// NOTIFICACION
	if ('<?php echo $_GET['swal']; ?>' != ""){
		Swal.fire({
		// position: 'top-center',
		icon: 'success',
		title: '<?php echo $_GET['swal']; ?>',
		showConfirmButton: false,
		timer: 1500
		})
	};

	var location = window.location;

	$('#add_coord').click( function() { 
		if ($("#coord_name").val() != ""){ // valida la informacion
			$.post("./?action=ajax", {
				function: "add_responsible_type", // funcion que llama
				param: $("#coord_name").val() // parametros

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
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();

// $internet_type = new CategoryData();
// $internet_type->type = $_POST["name"];
// $internet_type->add();
?>

<!-- <div class="panel panel-default"> -->

	<div class="panel-heading">
		<h4 class="title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
		<span class='text_label'> <i class='fa fa-sliders icon_label' ></i> <b> Tipo responsable </b> </span>
		</a>
		</h4>
	</div>

	<!-- <div id="collapse1" class="panel-collapse collapse in">
		<div class="panel-body"> -->

			<div class="row">
				<div class="col-md-12">
					<div class="btn-group pull-right">
					<!--<div class="btn-group pull-right">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-download"></i> Descargar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
					</ul>S
					</div>
					-->
					</div>

					<div class="card">

						<div class="card-content table-responsive">
						
							<!-- <a href="./index.php?view=newmunicipio" class="btn btn-info">Agregar tipo de internet</a> -->

							<!-- <a href="./index.php?view=oldreservations" class="btn btn-default">Citas Anteriores</a> -->

							<br><br>

							<form method="post" id="addcategory" role="form">
							<!-- <form class="form-horizontal" role="form" method="post" action="./?action=ajax"> -->

								<div class="col-md-6">
									<div class="form-group">
										<label for="coord_name" class="control-label">Nombre*</label>
										<input type="text" name="param" id="coord_name" required class="form-control" placeholder="Nombre">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="submit" name="" id="add_coord" class="btn btn-primary btn-block">Agregar</button>
										</div>
								</div>
							


							<?php

							$CantidadMostrar=20;
							$url_pag_atras = "";
							$url_pag_adelante = "";

							// Validado  la variable GET
							$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


							$total = ResponsibleTypeData::getAll();
							$TotalReg = count($total);
							
							$sql = "select * from responsible_type order by id asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
							$param = ResponsibleTypeData::getBySQL($sql);

							$url_pag = "<a href=\"?view=data&type=".$_GET["type"]."&swal=&pag=";

							//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
							$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);

							?>

						</div class="card-content table-responsive">


						<div class="card-content table-responsive">

							<?php if(count($param)>0){ ?>
								<!-- si hay usuarios -->
								
								<div class="form-group text_label">
									<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
								</div>

								<table class="table table-bordered table-hover">
									<thead>
										<th>Nombre</th>

										<th></th>
									</thead>
									
									<?php
									foreach($param as $types){
										// $pacient  = $user->getPacient();
										// $medic = $user->getMedic();
										?>
										<tr>
										<td><?php echo $types->name; ?></td>
										
										<td style="width:180px;">
										<!-- <a href="index.php?view=editmunicipio&id=<!?php echo $user->id_municipio;?>" class="btn btn-warning btn-xs">Editar</a> -->
										<!-- <a href="./?action=delinternettype&id=<!?php echo $types->id;?>" class="btn btn-danger btn-xs">Eliminar</a> -->
										<a href="./?action=ajax&function=del_responsible_type&id=<?php echo $types->id;?>&type=<?php echo $_GET["type"];?>" class="btn btn-danger btn-xs">Eliminar</a>
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


							<br></br>


							<center>

							<?php

							/*Sector de Paginacion */

							//Operacion matematica para boton siguiente y atras 
							$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
							$DecrementNum =(($compag -1))<1?1:($compag -1);

							echo $url_pag.$DecrementNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-left\"></i> </a>";

							//Se resta y suma con el numero de pag actual con el cantidad de 
							//numeros  a mostrar
							$Desde=$compag-(ceil($CantidadMostrar/2)-1);
							$Hasta=$compag+(ceil($CantidadMostrar/2)-1);
								
							//Se valida
							$Desde=($Desde<1)?1: $Desde;
							$Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
							//Se muestra los numeros de paginas
							for($i=$Desde; $i<=$Hasta;$i++){
								//Se valida la paginacion total
								//de registros
								if($i<=$TotalRegistro){
									//Validamos la pag activo
									if($i==$compag){
										echo $url_pag.$i."\" class=\"btn btn-primary btn-xs\"active\">".$i."  </a>";
									}else {
										echo $url_pag.$i."\" class=\"btn btn-info btn-xs\">".$i."  </a>";
									}     		
								}
							}
								
							// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";
							echo $url_pag.$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";


							?>

							</center>


						</div class="card-content table-responsive">
					</div>
				</div>
			</div>

		<!-- </div>
	</div>
</div> -->
















