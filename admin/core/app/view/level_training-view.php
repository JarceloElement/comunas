<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">


// las func estan en demo.js
// if (getOS() == "Android"){
//     get_Name = getOS() + "|" + getBrowser();
//     $("#user_name_os").val(get_Name);
// }else{
//     get_Name = getOS() + "|" + getBrowser();
//     $("#user_name_os").val(get_Name);
// }



// SCRIPTS FUCNTIONS
$(document).ready(function(){

    var location = window.location;

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
	// cambiar el parametro de alert
	const url = new URL(window.location);
	url.searchParams.set('swal', '');
	window.history.pushState({}, '', url);





    $('#add_submit').click( function(event) { 
        event.preventDefault();


        if ($("#tipo_nivel").val() != ""){ // valida la informacion

            $.ajax({
                type: "POST",
                url: "./?action=ajax",
                data: {
                    function: "add_tipo_nivel", // funcion que llama
                    tipo_nivel: $("#tipo_nivel").val(),
                }
            })
            .done(function( msg ) {
                toastify('Guardado',true,1000,"dashboard");
                location.reload();
                // $('#content').reload('#content');

            })
            .fail(function() {
                toastify('Hubo un error al guardar',true,5000,"warning");
            });
            // .always(function() {
            //     toastify('Finished',true,1000,"warning");
            // });




        };

    });



});





    


</script>


<?php
// $action_line = ActionsLineData::getAll();

?>



<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label' ></i> <b> Tipos de niveles formativos </b> </span>
								</a>
							</h4>
						</div>

						<br>

						<form method="post" id="add_strategic" role="form">

           
							<div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="tipo_nivel" class=" control-label"><i class="fa fa-reorder"></i> Nivel de la formación</label>
                                    <select name="tipo_nivel" class="form-control" id="tipo_nivel" required>
                                        <option value="Básico">Básico</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                    </select>
                                    </div>
									<br>
                                </div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="submitx" name="" id="add_submit" class="btn btn-primary btn-block">Agregar</button>
									</div>
								</div>
							</div>
						</form >


						<!-- Obtengo los datos para la paginacion -->
						<?php
						$CantidadMostrar=50;
						$url_pag_atras = "";
						$url_pag_adelante = "";

						// Validado  la variable GET
						$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

						$total = TrainingLevelData::getBySQL("SELECT * from level_training");
						$TotalReg = count($total);
						
						$sql = "SELECT * from level_training order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
						$param = TrainingLevelData::getBySQL($sql);

						$url_pag = "<a href=\"?view=level_training&pag=";

						//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
						$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
						?>
						<!-- --------------------------- -->




						<!-- creo la tabla con la consulta -->
						<div class="card-content table-responsive">
							<div class="card-body">

								<?php if(count($param)>0){ ?>
									<!-- si hay usuarios -->
									
									<div class="form-group text_label">
										<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
									</div>

									<table class="table table-bordered table-hover">
										<thead>
											<th>Nivel de formación</th>
											<th>Acciones</th>
										</thead>
										
										<?php foreach($param as $user){ ?>
											<tr>
												<td><?php echo $user->name_level_training; ?></td>
												<td style="width:180px;"><a href="./?action=ajax&function=del_tipo_nivel&id=<?php echo $user->id;?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></i></a></td>
											</tr>
										<?php }	?>

									</table>
								<?php
								}else{
									echo "<p class='alert alert-danger'>No hay registros</p>";
								}
								?>

							</div>

						</div class="card-content table-responsive">

						<!-- Botones de paginacion -->
						<?php include "core/app/layouts/pagination.php"; ?>	

					</div>

					

					
				</div>


			</div>
		</div>
	</div>
</div>




<script language="javascript">


    // carga nuevas dimensiones
    $(document).ready(function(){

        // $("#line_action").change(function () {
        //     $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
        //     $("#line_action option:selected").each(function () {
        //         line = $(this).val();
        //         console.log($("#tipo_reporte").val());
        //         $.post("core/app/view/get_strategic_action.php", { line: line }, function(data){
        //             $("#tipo_reporte").html(data);
        //             // console.log(data);
        //         });  
        
        //     });
        // })

        // $("#tipo_reporte").change(function () {
        //     $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
        //     $("#tipo_reporte option:selected").each(function () {
        //         line_acc = $(this).val();
        //         // console.log($("#accion_especifica").val());
        //         $.post("core/app/view/get_specific_action.php", { line_acc: line_acc }, function(data){
        //             $("#accion_especifica").html(data);
        //             // console.log(data);
        //         });  
        
        //     });
        // })

        // $("#accion_especifica").change(function () {
        //     $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');
        //     $("#accion_especifica option:selected").each(function () {
        //         line_acc = $(this).val();
        //         // console.log($("#area_formativa").val());
        //         $.post("core/app/view/get_training_type.php", { line_acc: line_acc }, function(data){
        //             $("#area_formativa").html(data);
        //             // console.log(data);
        //         });  
        
        //     });
        // })

        // $("#area_formativa").change(function () {
        //     $('#nivel_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
        //     $("#area_formativa option:selected").each(function () {
        //         line_acc = $(this).val();
        //         // console.log($("#nivel_formacion").val());
        //         $.post("core/app/view/get_level_training.php", { line_acc: line_acc }, function(data){
        //             $("#nivel_formacion").html(data);
        //             // console.log(data);
        //         });  
        
        //     });
        // })



    });


</script>










