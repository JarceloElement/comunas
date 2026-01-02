

<script language="javascript">
    $(document).ready(function() {

        const loadInputs = () => {
            let title =
                '<h2>Crear estado</h2>';

            let stateName =
                '<input type="text" name="estado_name" class="swal2-input text-black swal-input-class" id="estado_name" placeholder="Nombre del estado"/>';


			var stateCode =
				'<input type="text" name="estado_code" class="swal2-input text-black swal-input-class" id="estado_code" placeholder="Codigo del estado">';


            return (
                title +
                stateName +
                stateCode
            );
        };

        const btnCreateState = document.getElementById("create-state-btn");

        let inputHtml = loadInputs();

        btnCreateState.addEventListener("click", async () => {
            Swal.fire({
                // title: "Crear brigada",
                html: inputHtml,
                allowEscapeKey: false,
                preConfirm: async (nothing) => {
                    let stateName = document.getElementById("estado_name").value;
                    let stateCode = document.getElementById("estado_code").value;

                    if (!stateName) {
                        Swal.showValidationMessage("El nombre del estado es obligatorio");
                        return;
                    }
                    if (!stateCode) {
                        Swal.showValidationMessage("El codigo del estado es obligatorio");
                        return;
                    }

                    await $.ajax({
                            type: "POST",
                            url: "index.php?action=estado&function=add",
                            data: {
                                estado: stateName,
                                iso: stateCode
                            }
                        })
                        .done(function(msg) {
                            var array = JSON.parse(msg);
                            if (array["success"] == true) {
                                return "El estado ha sido creada";

                            } else {
                                Swal.showValidationMessage(array["message"]);
                            }
                        })
                        .fail(function(err) {
                            Swal.showValidationMessage(err);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
                showLoaderOnConfirm: true,
                confirmButtonText: "Crear",
                cancelButtonText: "Salir",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#dc3545",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        text: "El estado ha sido creada con éxito",
                        // title: "La brigada ha sido creada",
                        preConfirm: () => {
                            window.location.reload();
                        },
                        allowOutsideClick: () => {
                            window.location.reload();
                        },
                    });
                }
            });
        });
    });

    function uploadXLSX() {
        $('#cover-spin').show(0);
    }
</script>

<!-- <div class="card text-center">
    <div class="card-header card-header-rose">
        <h4 class="title text-left">Estados</h4>
    </div>
    <div class="card-body">
        <a id="create-state-btn" class="btn btn-primary text-white">Nuevo Estado</a>
    </div>
    <input type="hidden" value="<!?php echo ($_SESSION["user_type"]); ?>" id="user_type">
    <input type="hidden" value="<!?php echo ($_SESSION["user_code_info"]); ?>" id="user_code_info">

</div> -->

<div class="row">
	<div class="col-md-12">
		<div class="btn-group pull-right">
		<!--<div class="btn-group pull-right">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-download"></i> Descargar <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
			</ul>
		</div>
		-->
		</div>


		<div class="card">
			<div class="card-header" data-background-color="blue">
					<h4 class="title">Estados</h4>
			</div>
			
			<div class="card-content table-responsive">
			<!-- <a href="index.php?view=newestado" class="btn btn-default"><i class='fa fa-male'></i> Nuevo estado</a> -->
				
		
				<?php
				$users = EstadoData::getAll();
				if(count($users)>0){
					// si hay usuarios
					?>

					<table class="table table-bordered table-hover">
						<thead>
							<th><i class="fa fa-map" style="color:gray"></i> Estado</th>
							<!-- <th><i class="fa fa-home" style="color:gray"></i> Infocentros</th> -->
							<th></th>
						</thead>

						<?php
						foreach($users as $user){
							?>
								<tr>
								<td><?php echo $user->estado; ?></td>
								<!-- <td><!?php echo count(InfoData::getByEstado(EstadoData::getNameById($user->id_estado)));?></td> -->
								<td style="width:280px;">
								<!-- <a href="index.php?view=pacienthistory&id=<!?php echo $user->id;?>" class="btn btn-default btn-xs">Historial</a> -->
								<a href="index.php?view=editestado&id=<?php echo $user->id_estado;?>" class="btn btn-warning btn-xs">Editar</a>
								<!-- <a href="index.php?view=delpacient&id=<°?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a> -->
								</td>
								</tr>

						<?php
						}
						?>

					</table>

					

					<?php
				}else{
					echo "<p class='alert alert-danger'>No hay estados</p>";
				}
				?>

			</div class="card-content table-responsive">

	</div>
</div>


<style>

.card .title {
    margin-top: 0;
    margin-bottom: 5px;
    margin-left: 10px;
    margin-right: -20px;
}

h5, .h5 {
    font-size: 1.0em;
    line-height: 1.0em;
    margin-bottom: 15px;
}

.icon_table{
  font-size: 24px;
  color: #585858;
  margin-right: 10px;
  
}

.table > thead > tr > th {
    border-bottom-width: 1px;
    font-size: 1.2em;
    font-weight: 400;
}

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px 5px;
    vertical-align: middle;
}
.swal-input-class::placeholder {
            color: #000 !important;
            opacity: 0.5 !important;
        }

        .title {
            margin-top: 0;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: -20px;
        }

        /* .card {
        font-size: 14px;
        margin: 15px 0;
    }

    h5, .h5 {
        font-size: 1.0em;
        line-height: 1.0em;
        margin-bottom: 15px;
    } */

        .icon_table {
            font-size: 24px;
            color: #585858;
            margin-right: 10px;
        }

        /* .btn_preview {
        color: #FFFFFF;
        background: #8a8a8a;
        box-shadow: none;
        padding: 0px 0px;
        margin: 0px 0px;
        border: none;
        opacity: 1;
    } */


        .fullscreen-swal {
            z-index: 9999 !important;
            width: 100vw !important;
            height: 90vh !important;
        }


</style>