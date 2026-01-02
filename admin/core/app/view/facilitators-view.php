<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();


?>


<!-- <script src="assets/js/jquery.min.js" type="text/javascript"></script> -->
<script>

  $(document).ready(function() {

    // mensaje al cambiar el estatus de la actividad
    <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] != "") : ?>
      if (getOS() != "Android") {
        Swal.fire({
          icon: 'warning',
          title: 'Aviso!',
          text: '<?php echo $_SESSION['alert']; ?>',
          showConfirmButton: true,
          timer: 50000

        })
      } else {
        alert("<?php echo $_SESSION['alert']; ?>");
      }

      <?php $_SESSION['alert'] = ""; ?>
    <?php endif; ?>

  });


	function del_item(url) {
		Swal.fire({
			title: "<br>¿Desea eliminar?",
			text: "¡Esto es irreversible!",
			// icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "¡Sí, eliminar!",
			cancelButtonText: "Cancelar",
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = url
			}
		});
	};




</script>

<!-- importar archivos por lotes -->
<?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx_facilitatorPg" method="POST" enctype="multipart/form-data" />
						<span class="btn btn-raised btn-round btn-default btn-file">
							<span class="fileinput-new">Select</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".xlsx" />
						</span>

						<button type="submit" name="subir" class="btn btn-default btn-block">
							Subir Archivo
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16">
								<path fill="currentColor" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252q.284.091.665.091q.507 0 .858-.158q.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.188-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15q-.336.149-.527.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326a.5.5 0 0 1-.085.29a.56.56 0 0 1-.255.193q-.168.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.249-.115a.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036z" />
							</svg>
						</button>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
<?php } ?>



<!-- formunalrio de filtrado -->
<?php require_once("filter_form_facilitators.php"); ?>


<div class="col-md-12">

	<?php if ($_SESSION["user_type"] != 10 && $_SESSION["user_type"] != 3 && $_SESSION["user_type"] != 4) { ?>
		<a href="./index.php?view=newfacilitator" class="btn btn-info">Agregar facilitador</a>
	<?php } ?>
</div>




<?php if (count($users[0]) > 0) { ?>
	<!-- si hay usuarios -->

	<div class="col-md-12">

		<div class="form-group text_label">
			<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
		</div>

		<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>
			<!-- <a href="./pdf/csv.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a> -->
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $sql_rrss . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a>
		<?php } ?>

		<?php if ($_SESSION["user_type"] == 3) { ?>
			<a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $sql_rrss . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a>
			<!-- <a class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=' . $param_sql . '&filename=' . $DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a> -->
		<?php } ?>



	</div>




	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">

					<table class="table table-hover">
						<thead>
							<th> N°</th>
							<th><i class="fa fa-map" style="color:gray "></i> Estado</th>
							<th><i class="fa fa-building" style="color:gray "></i> Infocentro</th>
							<th><i class="fa fa-user" style="color:gray "></i> Nombres</th>
							<th><i class="fa fa-user" style="color:gray "></i> Apellidos</th>
							<th><i class="fa fa-credit-card" style="color:gray "></i> N° documento</th>
							<th><i class="fa fa-phone" style="color:gray "></i> Teléfono</th>
							<th><i class="fa fa-warning" style="color:gray "></i> Relación</th>
							<th><i class="fa fa-cog" style="color:gray "></i> Estatus</th>

							<th></th>
						</thead>
						<?php
						$count = 1;
						foreach ($users[0] as $user) {
						?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $user["f_state"]; ?></td>
								<td><?php echo $user["info_cod"]; ?></td>
								<td><?php echo ucwords($user["f_name"]); ?></td>
								<td><?php echo $user["f_lastname"]; ?></td>
								<td><?php echo $user["document_number"]; ?></td>
								<td><?php echo $user["phone_number"]; ?></td>
								<td><?php echo $user["personal_type"]; ?></td>
								<td><?php echo $user["status_nom"]; ?></td>

								<td style="width:180px;">
									<?php if ($_SESSION["user_type"] != 10) { ?>
										<?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

											<a href="index.php?view=editfacilitator&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm">
												<i>
													<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
													</svg>
												</i>
											</a>

											<?php $URL = "./?action=facilitator&function=delete&id=" . $user["id"]; ?>
											<button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm">
												<i>
													<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
														<path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
													</svg>
												</i>
											</button>

										<?php } elseif (($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) && ($_SESSION["user_region"] == $user["f_state"])) { ?>

											<a href="index.php?view=editfacilitator&id=<?php echo $user["id"]; ?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
														<path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
													</svg></i></a>
											<!-- <a href="./?action=facilitator&function=delete&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a> -->

										<?php } ?>
									<?php } ?>

								</td>
							</tr>
						<?php
							$count++;
						}	?>
					</table>

				</div>
			</div class="card-content table-responsive">
		</div>
		<!-- Botones de paginacion -->
		<?php
		if (count($users[0]) > 1) {
			include "core/app/layouts/pagination.php";
		}
		?>
	</div>



<?php } else { ?>

	<div class="col-md-12">
		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">
					<p class='alert alert-danger'>Sin resultados</p>
				</div>
			</div>
		</div>
	</div>

<?php } ?>







<script language="javascript">
	$(document).ready(function() {
		$("#estados1").change(function() {
			$('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
			$("#estados1 option:selected").each(function() {
				id_estado = $(this).val();
				$.post("core/app/view/getMunicipio.php", {
					id_estado: id_estado
				}, function(data) {
					$("#municipios_1").html(data);
				});

			});
		})
	});
</script>



<style>
	.card .title {
		margin-top: 0;
		margin-bottom: 5px;
		margin-left: 10px;
		margin-right: -20px;
	}

	h5,
	.h5 {
		font-size: 1.0em;
		line-height: 1.0em;
		margin-bottom: 15px;
	}

	.icon_table {
		font-size: 24px;
		color: #585858;
		margin-right: 10px;

	}

	.table>thead>tr>th {
		border-bottom-width: 1px;
		font-size: 1.1em;
		font-weight: 400;
	}

	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		padding: 5px 5px;
		vertical-align: middle;
	}
</style>
