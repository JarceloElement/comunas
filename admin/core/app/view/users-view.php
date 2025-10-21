<!-- <script src="assets/js/jquery-3.1.1.min.js"></script> -->
<?php
$user_type = UserTypeData::getAll();
$alert = isset($_GET['swal']) ? $_GET['swal'] : "";
?>

<script language="javascript">

$(document).ready(function(){
	// NOTIFICACION
	if ('<?php echo $alert; ?>' != ""){
		Swal.fire({
		// position: 'top-center',
		icon: 'success',
		title: '<?php echo $alert; ?>',
		showConfirmButton: false,
		timer: 1500
		})
	};
});


// cambiar el parametro de alert
const url = new URL(window.location);
url.searchParams.set('swal', '');
window.history.pushState({}, '', url);



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
						<form action="index.php?view=import_xlsx_users" method="POST" enctype="multipart/form-data" />
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



<div class="row">
	<div class="col-md-12">
		<div class="card-body">

			<div class="card-content table-responsive">
				<?php if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>
					<a href="index.php?view=newuser" class="btn btn-default"><i class='fa fa-user'></i> Nuevo Usuario</a>

						<br>
						<br>

					PERMISOS
					<br>
					(1) Usuario final: Puede editar sus datos
					<br>
					(2) Facilitador: Puede editar sus datos
					<br>
					(3) Coordinador estadal: Puede editar sus datos	
					<br>
					(4) Gerencias sustantivas CCS: Puede editar datos de usuarios de su unidad 	
					<br>
					(5) Gerencia RNI: Puede crear y editar usuarios y roles CCS
					<br>
					(6) Políticas públicas ADMIN: Puede crear y editar usuarios y roles
					<br>
					(7) Administración del sistema: Puede crear y editar usuarios y roles
					<br>
					(8) Jefe de estado: Puede crear y editar datos a usuarios de su estado
					<br>
					(9) Gerencias ADMIN: Puede crear y editar las unidades sustantivas CCS
					<br>
					(10) Lector: Solo puede ver y descargar reporte (no edita ni elimina)

					
				<?php } ?>

			</div>
		</div>
	</div>
</div>


<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="form-group">
						<div class="card-content table-responsive">
							<div class="card-body">
				
								<form class="form-horizontal" role="form">
									<input type="hidden" name="view" value="users">

									<?php if ($_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) { ?>
										<br>

										<div class="form-group">
											<div class="row">

												<div class="col-md-6 mui-textfield mui-textfield--float-label">
													<input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>">
													<label><i class="fa fa-search"></i> Filtrar por palabra clave</label>
												</div>

												<div class="col-md-6">
													<span class="input-group-addon"><i class="fa fa-user"></i> Por tipo de usuario</span>
													<select name="user_type" class="form-control" id="user_type">
														<option value="">-TIPO DE USUARIO-</option>
														<?php foreach($user_type as $p):?>
															<?php if ($_SESSION["user_type"] == 8 && $p->user_type <= 3) {?>

															<option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>
														<?php }else if($_SESSION["user_type"] != 8){ ?>
															<option value="<?php echo $p->user_type; ?>"> <?php echo $p->user_type_name; ?></option>

														<?php } ?>
														<?php endforeach; ?>
													</select>
												</div>

												<div class="col-lg-4">
													<button class="btn btn-primary btn-block">Buscar</button>
												</div>
											</div>
										</div>
										
									<?php } ?>

								</form>
									
								<br>




								<?php

								$CantidadMostrar=100;
								$url_pag_atras = "";
								$url_pag_adelante = "";

								// Validado  la variable GET
								$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
								$user_type = isset($_GET["user_type"]) ? $_GET["user_type"] : "";
								$q_info = isset($_GET['q']) ? trim(strtoupper($_GET['q'])) : "";



								$users= array();
								if( ( isset($_GET["q"]) && isset($_GET["user_type"]) ) && ( $_GET["q"]!="" || $_GET["user_type"]!="" ) ) {
								
									$sql = "SELECT * from user where ";

									if($_GET["q"]!=""){
										$sql .= " (user_dni='$_GET[q]' or id='$_GET[q]' or email like '%$_GET[q]%' or code_info like '%$q_info%' or name like '%$_GET[q]%' or lastname like '%$_GET[q]%' or username like '%$_GET[q]%' or region like '%$_GET[q]%' or rol like '%$_GET[q]%') ";
									}

									if($_GET["user_type"]!="" && intval($_GET["user_type"]) > 1){
		
										if($_GET["q"]!=""){
											$sql .= " and ";
										}
										$sql .= " user_type ='".$user_type."'";
								
									}
									
									if ($_GET["user_type"]!="" && intval($_GET["user_type"]) == 1) {
										$sql .= " user_type <= ".intval($user_type);
									}



									// filtra por region de facilitador, coordinador y jefe estadal
									if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 8) {
										$sql .= " and user_type!='6' AND user_type!='7' AND region ='".$_SESSION["user_region"]."'";
									
									}else if($_SESSION["user_type"] == 0 || $_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4){
										$sql .= " and id ='".$_SESSION["user_id"]."'";

									}

									// Busca el total de registros segun parametros de consulta
									$users = UserData::getBySQL($sql." order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);
									
									$total = UserData::getBySQL($sql);
									$TotalReg = count($total);
									$Total_q = $TotalReg;

									$param_csv = $sql." order by id desc";
									$param_sql = "true";
									$DB_name = "usuarios_tipo_".$_GET["user_type"]."_sistema_infoapp";

									// Asigna url de paginacion
									$url_pag = "<a href=\"?view=users&q=".$_GET["q"]."&user_type=".$user_type."&pag=";

									
									


								}else{
									if ($_SESSION["user_type"] == 8) {
										
										$sql = "SELECT * from user where user_type!='6' AND user_type!='7' AND region='".$_SESSION["user_region"]."' order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
										$users = UserData::getBySQL($sql);

										$query = "SELECT * from user where user_type!='6' AND user_type!='7' AND region='".$_SESSION["user_region"]."' ";
										$total_q = UserData::getBySQL($query);
										$Total_q = $total_q;
									
									}else if($_SESSION["user_type"] == 3 && $_SESSION["user_rol"] == 'Políticas públicas'){
										$sql = "SELECT * from user where region='".$_SESSION["user_region"]."' order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
										$users = UserData::getBySQL($sql);

										$query = "SELECT * from user where region='".$_SESSION["user_region"]."' ";
										$total_q = UserData::getBySQL($query);
										$Total_q = $total_q;
									
									}else if($_SESSION["user_type"] == 0 ||  $_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 10){
										$sql = "SELECT * from user where id='".$_SESSION["user_id"]."' order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
										$users = UserData::getBySQL($sql);

										$query = "SELECT * from user where id='".$_SESSION["user_id"]."' ";
										$total_q = UserData::getBySQL($query);
										$Total_q = $total_q;

									}else {
										$sql = "SELECT * from user order by id desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
										$users = UserData::getBySQL($sql);
										$total_q = UserData::getAll();
										$query = "SELECT * from user order by id desc";
									}
									$TotalReg = count($total_q);
									$Total_q = $total_q;

									$param_csv = $query;
									$param_sql = "true";
									$DB_name = "usuarios_tipo_".$user_type."_sistema_infoapp";

									$url_pag = "<a href=\"?view=users&pag=";
									

								}

								$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
								?>


								<?php 
									if(count($users)>0){ 
					

									?>

									<div class="col-md-12">
	
										<div class="form-group text_label">
											<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
										</div>
								
										<a class="btn btn-success" href="../core/app/view/exportxlsxmysql.php?param=<?php echo $param_csv.'&param_sql=true&filename='.$DB_name; ?>" name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>
			
									</div>

									<br>

									

									

									<table class="table table-hover">
									<thead>
									<th>User ID</th>
									<th>Nombre o Alias</th>
									<th>Usuario</th>
									<?php if ($_SESSION["user_type"] != 0) { ?>
									<th>Código info</th>
									<?php }?>
									<th>Activo</th>
									<th>Región</th>
									<?php if ($_SESSION["user_type"] != 0) { ?>
									<th>Rol</th>
									<th>Privilegios</th>
									<?php }?>
									<th style="width: 250px;"> Acciones</th>
									</thead>
									<?php
									foreach($users as $user){
										?>

										<!-- USUARIO CON PRIVILEGIO MAYOR O IGUAL A 7 -->
										<?php if ($_SESSION["user_type"] == 7){ ?>

											<tr>
												<td><?php echo $user->id; ?></td>
												<td><?php echo $user->name." ".$user->lastname; ?></td>
												<td><?php echo $user->username; ?></td>
												<td><?php echo $user->code_info; ?></td>
												<td>
													<?php if($user->is_active):?>
														<i class="fa fa-check"></i>
													<?php endif; ?>
												</td>
												<td><?php echo $user->region; ?></td>
												<td><?php echo $user->rol; ?></td>
												<td><?php echo $user->user_type; ?></td>

												<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
												<?php $URL = "./?action=ajax&function=del_user&id=".$user->id;?>
												<button type="button" onclick="del_item('<?php echo $URL;?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>
											
											</tr>

										<!-- USUARIOS 6 NO VISUALIZA EL 7 -->
										<?php }elseif ($_SESSION["user_type"] == 6) { ?>
											<tr>
												<td><?php echo $user->id; ?></td>
												<td><?php echo $user->name." ".$user->lastname; ?></td>
												<td><?php echo $user->username; ?></td>
												<td><?php echo $user->code_info; ?></td>
												<td>
													<?php if($user->is_active):?>
														<i class="fa fa-check"></i>
													<?php endif; ?>
												</td>
												<td><?php echo $user->region; ?></td>
												<td><?php echo $user->rol; ?></td>
												<td><?php echo $user->user_type; ?></td>

												<!-- SI NO TIENE PRIVILEGIO 7 NO PUEDE EDITAR EL USURIO ADMIN -->
												<?php if ($_SESSION["user_type"] != 7 && $user->user_type != 7){ ?>
													<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
													<?php $URL = "./?action=ajax&function=del_user&id=".$user->id;?>
													<button type="button" onclick="del_item('<?php echo $URL;?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>
												<?php } ?>

												
											</tr>

										<!-- Gerencia RNI ve y crea todas las gerencias centrales -->
										<?php }elseif ($_SESSION["user_type"] == 5 && ($user->user_type == 2 || $user->user_type == 3 || $user->user_type == 4 || $user->user_type == 8) ) { ?>
												<tr>
													<td><?php echo $user->id; ?></td>
													<td><?php echo $user->name." ".$user->lastname; ?></td>
													<td><?php echo $user->username; ?></td>
													<td><?php echo $user->code_info; ?></td>
													<td>
														<?php if($user->is_active):?>
															<i class="fa fa-check"></i>
														<?php endif; ?>
													</td>
													<td><?php echo $user->region; ?></td>
													<td><?php echo $user->rol; ?></td>
													<td><?php echo $user->user_type; ?></td>
													<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
													<!-- <a href="./?action=ajax&function=del_user&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm">Eliminar</a></td> -->
												</tr>

										<!-- Gerencias ADMIN ve todas las gerencias -->
										<?php }elseif ($_SESSION["user_type"] == 9) { ?>
											<!-- SOLO PRIVILEGIOS MENOR O IGUAL -->
											<?php if ($user->user_type == 4 || $user->user_type == 5 || $user->user_type == 9){ ?>
												<tr>
													<td><?php echo $user->id; ?></td>
													<td><?php echo $user->name." ".$user->lastname; ?></td>
													<td><?php echo $user->username; ?></td>
													<td><?php echo $user->code_info; ?></td>
													<td>
														<?php if($user->is_active):?>
															<i class="fa fa-check"></i>
														<?php endif; ?>
													</td>
													<td><?php echo $user->region; ?></td>
													<td><?php echo $user->rol; ?></td>
													<td><?php echo $user->user_type; ?></td>
													<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
													<!-- <a href="./?action=ajax&function=del_user&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm">Eliminar</a></td> -->
												</tr>
											<?php } ?>


										<!-- Gerencia sustantiva | Coordinaciones CCS -->
										<?php }elseif ( $_SESSION["user_type"] == 4) { ?>
												<tr>
													<td><?php echo $user->id; ?></td>
													<td><?php echo $user->name." ".$user->lastname; ?></td>
													<td><?php echo $user->username; ?></td>
													<td><?php echo $user->code_info; ?></td>
													<td>
														<?php if($user->is_active):?>
															<i class="fa fa-check"></i>
														<?php endif; ?>
													</td>
													<td><?php echo $user->region; ?></td>
													<td><?php echo $user->rol; ?></td>
													<td><?php echo $user->user_type; ?></td>
													<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
													<!-- <a href="./?action=ajax&function=del_user&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm">Eliminar</a></td> -->
												</tr>

										<!-- Jefe estadal | solo visualiza sustantivas de su region | esta en la consulta SQL -->
										<?php }elseif ( $_SESSION["user_type"] == 8 ) { ?>
											<!-- SOLO DE SU ESTADO -->
												<tr>
													<td><?php echo $user->id; ?></td>
													<td><?php echo $user->name." ".$user->lastname; ?></td>
													<td><?php echo $user->username; ?></td>
													<td><?php echo $user->code_info; ?></td>
													<td>
														<?php if($user->is_active):?>
															<i class="fa fa-check"></i>
														<?php endif; ?>
													</td>
													<td><?php echo $user->region; ?></td>
													<td><?php echo $user->rol; ?></td>
													<td><?php echo $user->user_type; ?></td>
													<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
													<?php $URL = "./?action=ajax&function=del_user&id=".$user->id;?>
													<button type="button" onclick="del_item('<?php echo $URL;?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button></a>
												</tr>

										<!-- COORD ESTADAL | SOLO SU COORDINACION | esta en la consulta SQL -->
										<?php }elseif ( $_SESSION["user_type"] == 3) { ?>
											<!-- SOLO DE SU ESTADO -->
												<tr>
													<td><?php echo $user->id; ?></td>
													<td><?php echo $user->name." ".$user->lastname; ?></td>
													<td><?php echo $user->username; ?></td>
													<td><?php echo $user->code_info; ?></td>
													<td>
														<?php if($user->is_active):?>
															<i class="fa fa-check"></i>
														<?php endif; ?>
													</td>
													<td><?php echo $user->region; ?></td>
													<td><?php echo $user->rol; ?></td>
													<td><?php echo $user->user_type; ?></td>
													<td	style="width:30px;">
													<?php if ($_SESSION["user_id"] == $user->id){ ?>
														<a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
														<?php } ?>
													</td>
												</tr>

										<!-- FACILITADOR Y USUARIOS | VE SOLO SU USUARIO -->
										<?php }elseif ( ($_SESSION["user_type"] == 1  || $_SESSION["user_type"] == 10 || $_SESSION["user_type"] == 2) && $user->username == $_SESSION["user_username"]) { ?>

											<!-- SOLO DE SU ESTADO -->
												<tr>
													<td><?php echo $user->id; ?></td>
													<td><?php echo $user->name." ".$user->lastname; ?></td>
													<td><?php echo $user->username; ?></td>
													<td><?php echo $user->code_info; ?></td>
													<td>
														<?php if($user->is_active):?>
															<i class="fa fa-check"></i>
														<?php endif; ?>
													</td>
													<td><?php echo $user->region; ?></td>
													<td><?php echo $user->rol; ?></td>
													<td><?php echo $user->user_type; ?></td>
													<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
													<!-- <a href="./?action=ajax&function=del_user&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm">Eliminar</a></td> -->
												</tr>

										<!-- USUARIO FINAL -->
										<?php }elseif ( ($_SESSION["user_type"] == 0) && $user->id == $_SESSION["user_id"]) { ?>

										<!-- SOLO DE SU ESTADO -->
											<tr>
												<td><?php echo $user->id; ?></td>
												<td><?php echo $user->name." ".$user->lastname; ?></td>
												<td><?php echo $user->username; ?></td>
												<td>
													<?php if($user->is_active):?>
														<i class="fa fa-check"></i>
													<?php endif; ?>
												</td>
									
												<td><?php echo $user->region; ?></td>
												<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-sm">Editar</a>
												<!-- <a href="./?action=ajax&function=del_user&id=<!?php echo $user->id;?>" class="btn btn-danger btn-sm">Eliminar</a></td> -->
											</tr>
										<?php } ?>

									<?php
									}
									?>
									</table>
										
								<?php
								}else{
									// no hay usuarios
									echo "<p class='alert alert-danger'>No hay registros</p>";
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<center>

	<?php

	/*Sector de Paginacion */
	if(count($users)>1){

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

	}
	?>

	</center>