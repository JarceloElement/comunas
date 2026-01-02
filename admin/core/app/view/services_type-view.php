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

function del_services(id) {
    Swal.fire({
        title: "¿Desea eliminar?",
        text: "¡Esto es irreversible!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, eliminar!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./?action=ajax&function=del_services_type&id="+id
        }
    });
};




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
        if ($("#services_name").val() != ""){ // valida la informacion

            $.ajax({
                type: "POST",
                url: "./?action=ajax",
                data: {
                    function: "add_services_type", // funcion que llama
                    services_name: $("#services_name").val(),
                }
            })
            .done(function( msg ) {
                toastify('Guardado',true,1000,"dashboard");
                location.reload();
                // $('#content').reload('#content');

            })
            .fail(function() {
                toastify('Hubo un error al guardar',true,5000,"warning");
            })
            .always(function() {
                toastify('Finished',true,1000,"warning");
            });
        };

    });

});


</script>

<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="panel-heading">
							<h4 class="title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									<span class='text_label'> <i class='fa fa-cogs icon_label' ></i> <b> Crear nuevo servicio al usuario </b> </span>
								</a>
							</h4>
						</div>

						<br>

						<form method="post" id="add_strategic" role="form">
							<div class="row">
                                <div class="col-md-12 mui-textfield mui-textfield--float-label">
                                    <textarea type="text" name="services_name" id="services_name" value=""></textarea>
                                    <label><i class="fa fa-user"></i> Descripción del servicio</label>
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

						$total = TrainingLevelData::getBySQL("SELECT * from services_type");
						$TotalReg = count($total);
						
						$sql = "SELECT * from services_type order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
						$param = TrainingLevelData::getBySQL($sql);

						$url_pag = "<a href=\"?view=services_type&pag=";

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
											<th>Servicios</th>
											<th>Acciones</th>
										</thead>
										<?php foreach($param as $user){ ?>
											<tr>
												<td><?php echo $user->services_name; ?></td>
												<!-- <td style="width:180px;"><a href="./?action=ajax&function=del_services_type&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a></td> -->
												<td style="width:180px;">  <a onclick="del_services('<?php echo $user->id;?>')" title="Eliminar"><button type="button" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a></td>
											
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










