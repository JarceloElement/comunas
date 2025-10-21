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

	$('#send').click( function() { 
		if ($("#fecha_final").val() != ""){ // valida la informacion
			$.post("./?action=ajax", {
				function: "add_report_limit", // funcion que llama
				fecha_inicio: $("#fecha_inicio").val(), // parametros
				fecha_final: $("#fecha_final").val() // parametros

			}, function(data){
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
$ActionsLineData = ActionsLineData::getAll();
?>

<!-- <div class="panel panel-default"> -->

	<div class="panel-heading">
		<h4 class="title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
		<span class='text_label'> <i class='fa fa-calendar icon_label' ></i> <b> Fecha límite para reportes </b> </span>
		</a>
		</h4>
	</div>

	<!-- <div id="collapse1" class="panel-collapse collapse">
		<div class="panel-body"> -->

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<br><br>

						<!-- <form method="post" id="addcategory" role="form">
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputEmail1" class="control-label">Nombre*</label>
								<input type="text" name="param" id="action_line_name" required class="form-control" placeholder="Nombre">
							</div>
						</div> -->
						<div class="row">

						<div class="col-lg-6">
							<div class="form-group">
							<label for="fecha_inicio" class=" control-label"><i class="fa fa-calendar"></i> Fecha límite de inicio</label>
							<input type="date" name="fecha_inicio" required class="form-control" id="fecha_inicio" placeholder="Fecha">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
							<label for="fecha_final" class=" control-label"><i class="fa fa-calendar"></i> Fecha límite final</label>
							<input type="date" name="fecha_final" required class="form-control" id="fecha_final" placeholder="Fecha">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<button type="submit" name="" id="send" class="btn btn-primary btn-block">Establecer fechas</button>
								</div>
						</div>


			



						<!-- Obtengo los datos para la paginacion -->
						<?php
				
						$con = Database::getCon();
						$query = $con->query("select * from report_date_limit");
						$res = mysqli_fetch_array($query);
						$fecha_ini = date("d/m/Y", strtotime($res['date_limit_ini']));
						$fecha_end = date("d/m/Y", strtotime($res['date_limit_end']));
						

						// $total = ActionsLineData::getAll();
						// $TotalReg = count($total);
						
						// $sql = "select * from actions_line ";
						// $param = ActionsLineData::getBySQL($sql);

						?>
						<!-- --------------------------- -->



					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="card card-nav-tabs text-center">

	<div class="card-header card-header-info">


		Fechas actuales
	</div>
              <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M1 21L12 2l11 19zm11-3q.425 0 .713-.288T13 17t-.288-.712T12 16t-.712.288T11 17t.288.713T12 18m-1-3h2v-5h-2z"/></svg></i>
	<div class="card-body">
		<p class="card-text">La fecha límite para realizar reportes es:</p>
		<?php echo "<span class='card-title'>  <b> ".$fecha_ini. " al ".$fecha_end. "</b></span>" . "<br><br>"; ?>
	</div>

</div>













