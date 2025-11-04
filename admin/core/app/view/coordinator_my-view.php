
<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$coordinations = CoordTypeData::getAll();
// $estadoName = EstadoData::getNameById(6);
// echo CoordTypeData::getById(1);
?>


<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script>

$(function() {
	if ('<?php echo $_GET['swal']; ?>' != ""){
		Swal.fire({
		position: 'top-center',
		icon: 'success',
		title: '<?php echo $_GET['swal']; ?>',
		showConfirmButton: false,
		timer: 1500
		})
	};
});
	
</script>



<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					
					<div class="card-header card-header-primary">
						<h4 class="card-title">Filtrar coordinador</h4>
						<!-- <p class="card-category">Complete your profile</p> -->
					</div>

					<div class="form-group">

						<div class="card-body">
							<form class="form-horizontal" role="form">
								<input type="hidden" name="view" value="coordinator">

								<div class="form-group col-mg-4">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/></svg></i></span>
										</div>
										<label class="bmd-label-floating floating_icon">Palabra clave</label>
										<input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control">
									</div>
								</div>

								<div class="row">

									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map"></i> Estado</span> 
											<select name="estado" class="form-control" id="estados">
												<option value="">ESTADO</option>
												<?php foreach($estado as $p):?>
													<option value="<?php echo $p->id_estado; ?>"><?php echo $p->estado ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

			
			
									<div class="col-md-6">
										<div class="form-group ">
											<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
											<select name="municipio" class="form-control" id="municipios_1">
												<option value="">MUNICIPIO</option>
												
											</select>
										</div>
									</div>

								</div>



								<div class="form-group">
									<button type="submit" class="btn btn-primary float-right">Buscar</button>
								</div>

							</form>



						</div>
					</div>

				
				</div>
			</div>
		</div>

	</div>
</div>






		
				<?php

				$CantidadMostrar=30;
				$url_pag_atras = "";
				$url_pag_adelante = "";
				$user_region = $_SESSION["user_region"];

				// Validado  la variable GET
				$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


				$sql_rrss = "SELECT 
				coordinators.estate, 
				coordinators.status_nom, 
				coordinators.personal_type, 
				coordinators.name, 
				coordinators.lastname, 
				coordinators.document_number, 
				coordinators.phone_number, 
				coordinators.gender, 
				coordinators.email, 
				final_users.red_x, 
				final_users.red_facebook, 
				final_users.red_instagram, 
				final_users.red_linkedin, 
				final_users.red_youtube, 
				final_users.red_tiktok, 
				final_users.red_whatsapp, 
				final_users.red_telegram, 
				final_users.red_snapchat, 
				final_users.red_pinterest from coordinators INNER JOIN final_users ON (final_users.user_dni = coordinators.document_number) where";


				$users= array();

				if( (isset($_GET["q"]) && isset($_GET["estado"]) ) && ($_GET["q"]!="" || $_GET["estado"]!="" ) ) {

					if ($_GET["estado"]!=""){
						$estate = EstadoData::getNameById($_GET["estado"]);
					}
					if ($_GET["municipio"]!=""){
						$municipality = MunicipioData::getNameById($_GET["municipio"]);
					}

					$sql = "SELECT * from coordinators where";

					if($_GET["q"]!=""){
						$sql .= " (email = '$_GET[q]' or status_nom like '%$_GET[q]%' or name like '%$_GET[q]%' or document_number like '%$_GET[q]%' or lastname like '%$_GET[q]%')";
						$sql_rrss .= " (coordinators.email = '$_GET[q]' or coordinators.status_nom like '%$_GET[q]%' or coordinators.name like '%$_GET[q]%' or coordinators.document_number like '%$_GET[q]%' or coordinators.lastname like '%$_GET[q]%')";
					}

					if($_GET["estado"]!=""){
						if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3){
							if($_GET["q"]!=""){
								$sql .= " and ";
								$sql_rrss .= " and ";
							}
							$sql .= " estate ='".$user_region."'";
							$sql_rrss .= " coordinators.estate ='".$user_region."'";
						
						}else if($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){
							if($_GET["q"]!=""){
								$sql .= " and ";
								$sql_rrss .= " and ";
							}
							$sql .= " estate ='".$estate."'";
							$sql_rrss .= " coordinators.estate ='".$estate."'";

						}else {
							if($_GET["q"]!=""){
								$sql .= " and ";
								$sql_rrss .= " and ";
							}
							$sql .= " estate ='".$_SESSION["user_region"]."'";
							$sql_rrss .= " coordinators.estate ='".$_SESSION["user_region"]."'";
						}
						
					}





					if($_GET["municipio"]!=""){
						
						if($_GET["estado"]!=""){
							$sql .= " and ";
							$sql_rrss .= " and ";
						}

						$sql .= " municipality ='".$municipality."'";
						$sql_rrss .= " coordinators.municipality ='".$municipality."'";
					}
					



					// echo $sql;

					// $users = MunicipioData::getBySQL($sql);

					// Busca el total de registros segun parametros de consulta
					$totalCons = $sql;
					$total = CoordinatorsData::getBySQL($totalCons);
					$TotalReg = count($total);
					
					$users = CoordinatorsData::getBySQL($sql." order by id asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);

					// Asigna url de paginacion
					$url_pag = "<a href=\"?view=coordinator&q=".$_GET["q"]."&estado=".$_GET["estado"]."&municipio=".$_GET["municipio"]."&pag=";

					$sql_rrss = $sql_rrss." and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
					$param_csv = $sql;
					$param_sql = "true";
					// echo $sql_rrss;


				}else{

					if ($_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 3){
						$sql = "SELECT * from coordinators WHERE estate ='".$user_region."' order by id asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
						$sql_dw = "SELECT * from coordinators WHERE estate ='".$user_region."' order by id asc";
						$total = CoordinatorsData::getBySQL("SELECT * from coordinators WHERE estate ='".$user_region."'");
						$sql_rrss = $sql_rrss." coordinators.estate ='".$user_region."' and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
					}else{
						$sql = "SELECT * from coordinators order by id asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
						$sql_dw = "SELECT * from coordinators order by id asc";
						$total = CoordinatorsData::getAll();
						$sql_rrss = $sql_rrss." (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='')";
					}

					$users = FacilitatorsData::getBySQL($sql);
					$TotalReg = count($total);

					$url_pag = "<a href=\"?view=coordinator&pag=";
					
					// echo $sql;
					// echo $sql_rrss;
					$param_csv = $sql_dw;
					$param_sql = "true";
								
				}


				//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
				$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
				// echo $sql;
				// echo $param_csv;
				$DB_name = "coordinators";
				

				?>

				<div class="col-md-12">

					<?php if ($_SESSION["user_type"] != 10 && $_SESSION["user_type"] != 3){ ?>
						<a href="./index.php?view=newcoordinator" class="btn btn-info">Agregar coordinador</a>
					<?php } ?>
				</div>


				<?php if(count($users)>0){ ?>
					<!-- si hay usuarios -->
				<div class="col-md-12">
					
					<div class="form-group text_label">
						<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
					</div>
					
					<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10){ ?>
						<!-- <a href="./pdf/csv.php?param_csv=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a> -->
						<a class="btn btn-success" href="../../../core/app/view/exportxlsxmysql.php?param=<?php echo $param_csv.'&param_sql=true&filename='.$DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
						<!-- <a class="btn btn-success" href="../../../core/app/view/exportxlsxmysql.php?param=<?php echo $sql_rrss.'&param_sql=true&filename='.$DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a> -->
					<?php } ?>
						

					<?php if ($_SESSION["user_type"] == 3){ ?>
						<a class="btn btn-success" href="../../../core/app/view/exportxlsxmysql.php?param=<?php echo $sql_rrss.'&param_sql=true&filename='.$DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> RRSS</a>
						<!-- <a class="btn btn-success" href="../../../core/app/view/exportxlsxmysql.php?param=<?php echo $param_csv.'&param_sql='.$param_sql.'&filename='.$DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a> -->
					<?php } ?>
					
				
				</div>




	<div class="col-md-12">

		<div class="card">
			<div class="card-content table-responsive">
				<div class="card-body">

					<table class="table table-bordered table-hover">
					<thead>
					<th><i class="fa fa-sliders" style="color:gray "></i> Coordinación</th>
					<th><i class="fa fa-map" style="color:gray "></i> Estado</th>
					<th><i class="fa fa-user" style="color:gray "></i> Nombres</th>
					<th><i class="fa fa-user" style="color:gray "></i> Apellidos</th>
					<th><i class="fa fa-credit-card" style="color:gray "></i> N° documento</th>
					<th><i class="fa fa-phone" style="color:gray "></i> Teléfono</th>
					<th><i class="fa fa-cog" style="color:gray "></i> Estatus</th>

					<th></th>
					</thead>
					<?php
					foreach($users as $user){
						// $pacient  = $user->getPacient();
						// $medic = $user->getMedic();  
						?>
						<tr>
						<td><?php echo $user->coordination; ?></td>
						<td><?php echo $user->estate; ?></td>
						<td><?php echo $user->name; ?></td>
						<td><?php echo $user->lastname; ?></td>
						<td><?php echo $user->document_number; ?></td>
						<td><?php echo $user->phone_number; ?></td>
						<td><?php echo $user->status_nom; ?></td>
						
						<td style="width:180px;">
						<?php if ($_SESSION["user_type"] != 10){ ?>
							<?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7){ ?>

								<a href="index.php?view=editcoordinator&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></i></a>
								<a href="./?action=coordinator&function=delete&id=<?php echo $user->id;?>" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></i></a>
						
								<?php }elseif ( ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 ) && ($_SESSION["user_region"] == $user->estate) ) { ?>
						
								<a href="index.php?view=editcoordinator&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"/></svg></i></a>
								<!-- <a href="./?action=coordinator&function=delete&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a> -->
							
								<?php } ?>
							<?php } ?>
						
							</td>
						</tr>
						<?php

					}
					?>
					</table>
				
					<?php



				}else{
					echo "<p class='alert alert-danger'>Sin resultados</p>";
				}


				?>


			</div class="card-content table-responsive">
		</div>
	</div>
</div>


<center>

<?php

/*Sector de Paginacion */

//Operacion matematica para boton siguiente y atras 
$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
$DecrementNum =(($compag -1))<1?1:($compag -1);

echo $url_pag.$DecrementNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-left\"></i> </a>";

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
			echo $url_pag.$i."\" class=\"btn btn-primary btn-sm\"active\">".$i."  </a>";
		}else {
			echo $url_pag.$i."\" class=\"btn btn-info btn-sm\">".$i."  </a>";
		}     		
	}
}
	
// echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";
echo $url_pag.$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


?>

</center>





<!-- <script src="../../../assets/js/jquery.min.js"></script> -->

<script language="javascript">
$(document).ready(function(){
	
	$("#estados").change(function () {

		$('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
		
		$("#estados option:selected").each(function () {
			id_estado = $(this).val();
		
		// alert(id_estado);
		// alert($("#municipios").val());

			$.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
			$("#municipios_1").html(data);
			});  
						
		});
	})





	// $(function(){
	// 	$("#estados").find('select').add('style=display:none');
	// })





});

</script>



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
    font-size: 1.1em;
    font-weight: 400;
}

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px 5px;
    vertical-align: middle;
}



</style>