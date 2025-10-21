<script src="../../../assets/js/jquery-3.1.1.min.js"></script>

<script language="javascript">

// SCRIPTS FUCNTIONS
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

	$('#status_send').click( function() { 
		if ($("#status_name").val() != ""){ // valida la informacion
			$.post("./?action=ajax", {
				function: "add_status_type", // funcion que llama
				param: $("#status_name").val() // parametros

			}, function(data){
				alert(data)
				if (data != ""){
					return window.location=location+"&swal="+data;
				};
			});
			alert('Registro enviado' );
		};

	});
});

	$(function(){
      var $tabla = $('#collapse1');
		$('#collapse1').addClass('panel-collapse collapse in');
    });

    


</script>


<?php
$StatusInfocentroData = StatusInfocentroData::getAll();
?>

<!-- <div class="panel panel-default"> -->

	<div class="panel-heading">
		<h4 class="title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
		<span class='text_label'> <i class='fa fa-hourglass-2 icon_label' ></i> <b> Tipo de estatus de infocentros </b> </span>
		</a>
		</h4>
	</div>

	<!-- <div id="collapse1" class="panel-collapse collapse">
		<div class="panel-body"> -->

			<div class="row">
				<div class="col-md-12">

					<div class="card">

						<div class="card-content table-responsive">
							<br><br>

							<form method="post" id="addcategory" role="form">
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail1" class="control-label">Nombre*</label>
									<input type="text" name="param" id="status_name" required class="form-control" placeholder="Nombre">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" name="" id="status_send" class="btn btn-primary btn-block">Agregar</button>
									</div>
							</div>

						</div class="card-content table-responsive">





						<!-- Obtengo los datos para la paginacion -->
						<?php
						$CantidadMostrar=5;
						$url_pag_atras = "";
						$url_pag_adelante = "";

						// Validado  la variable GET
						$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

						$total = StatusInfocentroData::getAll();
						$TotalReg = count($total);
						
						$sql = "select * from status_type order by id asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
						$param = StatusInfocentroData::getBySQL($sql);

						$url_pag = "<a href=\"?view=data&type=".$_GET["type"]."&pag=";

						//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
						$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
						?>
						<!-- --------------------------- -->




						<!-- creo la tabla con la consulta -->
						<div class="card-content table-responsive">

							<?php if(count($param)>0){ ?>
								<!-- si hay usuarios -->
								
								<div class="form-group text_label">
									<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
								</div>

								<table class="table table-bordered table-hover">
									<thead>
										<th>Tipo</th>

										<th></th>
									</thead>
									
									<?php foreach($param as $types){ ?>
										<tr>
											<td><?php echo $types->status; ?></td>

											<td style="width:180px;"><a href="./?action=ajax&function=del_status_type&id=<?php echo $types->id;?>&type=<?php echo $_GET["type"];?>" class="btn btn-danger btn-xs">Eliminar</a></td>
										</tr>
									<?php }	?>

								</table>
							<?php
							}else{
								echo "<p class='alert alert-danger'>No hay registros</p>";
							}
							?>

							<!-- Botones de paginacion -->
							<?php include "core/app/layouts/pagination.php"; ?>


						</div class="card-content table-responsive">
					</div>
				</div>
			</div>

		<!-- </div>
	</div>
</div>
 -->















