
<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$internet_type = InternetTypeData::getAll();
$operative_info = OperativeInfoData::getAll();
$status_type = StatusInfocentroData::getAll();

// echo strtoupper("ama05");
?>


<script src="assets/js/jquery.min.js" type="text/javascript"></script>




<!-- MODAL IMAGE POPUP -->
<script>


function add_viewer(comp){
  let id = comp.id;

    $.post("core/app/view/image_viewer.php", { id: id }, function(data){
      $("#modal-body").html(data);
      $('#myModal').modal('show');
	  
	//   alert("-"+id+"-");
	//   console.log(id);

    }); 
}







$(function() {
	// alert('<!?php echo $_GET['swal']; ?>');
	if ('<?php echo $_GET['swal']; ?>' != ""){
		Swal.fire({
		position: 'top-center',
		icon: 'success',
		title: '<?php echo $_GET['swal']; ?>',
		showConfirmButton: false,
		timer: 1500
		})
	};




 $(document).on('click', 'button[type="image_viewer"]', function(event) {
    let id = this.id;
			// $(window).scrollTop(0);
			window.scrollTo({ top: 100, left: 100, behavior: 'smooth' });
			// document.location.href = "#top";

    $.post("core/app/view/image_viewer.php", { id: id }, function(data){
		$("#modal-body").html(data);
		$('#myModal').modal('show');
		$('.modal,.notice').fadeIn(200,function(){});
		
			// $(window).scrollTop(0);
			// window.scrollTo({ top: 0, behavior: 'smooth' });

	//   alert("-"+id+"-");
	//   console.log(id);
		// console.log("Se presionó el Boton con Id :"+ id)

    });


  });
});



(function smoothscroll(){
    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
    if (currentScroll > 0) {
         window.requestAnimationFrame(smoothscroll);
         window.scrollTo (0,currentScroll - (currentScroll/5));
    }
})();






			







</script>








<!-- <input type="button" value="Abrir modal" name="registrar" id="image_viewer" class="registrar" tabindex="8" /> -->

<!-- MODAL IMAGE POPUP -->
<div class="modal fullscreen-modal fade" id="myModal" role="dialog" >

  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-body" id="modal-body">

          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>

</div>





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
				<h4 class="title">Productos</h4>
				
			</div>
			

			<div class="card-content table-responsive">
				
					<!-- <a href="./index.php?view=newactivity" class="btn btn-info">Agregar reporte</a>
					<a href="" class="btn btn-default"><i class="fa fa-area-chart"></i> Indicadores</a> -->


				<br><br>

				<form class="form-horizontal" role="form">
					<input type="hidden" name="view" value="products_admin">


					<div class="form-group">

						<div class="col-lg-11">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
								<input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>
						</div>
							

						<div class="col-lg-6">
							<div class="input-group">
								<h5 class="title">Desde</h5>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  						<input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>
						</div>


						<div class="col-lg-6">
							<div class="input-group">
								<h5 class="title">Hasta</h5>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>

							<br><br>
						</div>

						

						<div class="col-lg-4">
							<button class="btn btn-primary btn-block">Buscar</button>
						</div>

						<!-- <div class="form-group text_label">
							<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Descargar Reporte</span>
						</div> -->

						



					</div>

				</form>
					








				




				<?php

				$CantidadMostrar=10;
				$url_pag_atras = "";
				$url_pag_adelante = "";

				// Validado  la variable GET
				$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];




				$users= array();
				if( ( isset($_GET["q"]) && isset($_GET["start_at"]) && isset($_GET["finish_at"]) ) && ( $_GET["q"]!="" || $_GET["start_at"]!="" || $_GET["finish_at"]!="" ) ) {
				
					$sql = "select * from produts_list_admin where ";

					if($_GET["q"]!=""){
						$sql .= " (code_info like '%$_GET[q]%' or estate like '%$_GET[q]%' or activity_title like '%$_GET[q]%' or action_performed like '%$_GET[q]%' or date like '%$_GET[q]%' or  format like '%$_GET[q]%' or format_detail like '%$_GET[q]%' or web_link like '%$_GET[q]%') ";
					}

					if($_GET["start_at"]!="" and $_GET["finish_at"]!=""){
						if($_GET["q"]!=""){
							$sql .= " and ";
						}
						$sql .= " ( date >= '".$_GET["start_at"]."'"." and date <= '".$_GET["finish_at"]."'"." ) ";
					}

					if($_GET["start_at"]!="" and $_GET["finish_at"]==""){
						if($_GET["q"]!=""){
							$sql .= ' and ';
						}
						$sql .= " ( date >= '".$_GET["start_at"]."'"." ) ";
					}




						// $users = InfoData::getBySQL($sql);

					// Busca el total de registros segun parametros de consulta
					$param = $sql;
					$total = ProductsAdminData::getBySQL($param);
					$TotalReg = count($total);

					$users = ProductsAdminData::getBySQL($sql." order by date desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);

					// Asigna url de paginacion
					// $url_pag = "<a href=\"?view=products&q=".$_GET["q"]."&pag=";
					$url_pag = "<a href=\"?view=products_admin&q=".$_GET["q"]."&start_at=".$_GET["start_at"]."&finish_at=".$_GET["finish_at"]."&pag=";

					// echo $sql;
					
					$param_csv = $sql;
					$param_sql = "true";
					


				}else{
					// $users = InfoData::getAll();

					$total = ProductsAdminData::getAll();
					$TotalReg = count($total);
					$sql = "select * from produts_list_admin order by date desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
					$users = ProductsAdminData::getBySQL($sql);

					$url_pag = "<a href=\"?view=products_admin&q=".$_GET["q"]."&start_at=".$_GET["start_at"]."&finish_at=".$_GET["finish_at"]."&pag=";

					$param_csv = "produts_list_admin";
					$param_sql = "false";
					
				}


				//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
				$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);
				// echo $sql;
				// echo $param_csv;
				$DB_name = "produts_list_admin";
				

				?>




				<?php if(count($users)>0){ ?>
				<!-- si hay usuarios -->

				<div class="form-group text_label">
					<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
				</div>

				<a href="./pdf/csv.php?param_csv=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> </a>
				<a href="./pdf/jspdf_prod.php?param_pdf=<?php echo $param_csv.'&param_sql='.$param_sql.'&DB_name='.$DB_name; ?>" name="Descargar" class=" btn btn-danger "><i class="fa fa-file-pdf-o"></i> </a>
				<!-- <a href="./pdf/jspdf.php" name="Descargar" class=" btn btn-default "><i class="fa fa-file-pdf-o"></i> </a> -->
				
				<!-- <button onclick="generate()">Generate pdf</button> -->

				
			</div class="card-content table-responsive">
		</div>












		<div class="card">
			<div class="card-content table-responsive">

				
				<table id="table" class="table table-bordered table-hover">
				
					<!-- INONOS -->
					<thead>
						<th class="text_label " > <i class="fa fa-check icon_table" ></i></th>
						<th class="text_label " style="width: 200px;"> <i class="fa fa-slideshare icon_table" ></i></th>
						<th class="text_label " style="width: 100px;"> <i class="fa fa-map-marker icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-building icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-calendar-check-o icon_table" ></i></th>
						<th class="text_label " style="width: 200px;"> <i class="fa fa-list-alt icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-camera icon_table" ></i></th>
						<th class="text_label " style="width: 200px;"> <i class="fa fa-tasks icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-pie-chart icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-paper-plane icon_table" ></i></th>
						<th class="text_label " style="width: 200px;"> <i class="fa fa-link icon_table" ></i></th>
						<th class="text_label " > <i class="fa fa-cog icon_table" ></i></th>
					</thead>

					<!-- TITULOS -->
					<thead>
                        <th>N°</th>
                        <th>Actividad</th>
                        <th>Estado</th>
                        <th>Cod. Info</th>
                        <th>Fecha</th>
                        <th>Acción realizada</th>
                        <th>Formato</th>
                        <th>Detalles del formato</th>
                        <th>Cantidad creados</th>
                        <th>Cantidad publicados</th>
                        <th>Enlaces web</th>
                        <th>Acciones</th>
					</thead>

					<?php
					$total_fem = 0;
					$total_mas = 0;
                    $var_count = 0;
                    
					foreach($users as $types){
						$var_count += 1;
						?>
						<tr>
                        <td><?php echo $var_count; ?></td>
                        <td><?php echo $types->activity_title; ?></td>
                        <td><?php echo $types->estate; ?></td>
                        <td><?php echo $types->code_info; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($types->date)); ?></td>
                        <td><?php echo $types->action_performed; ?></td>
                        <td><?php echo $types->format; ?></td>
                        <td><?php echo $types->format_detail; ?></td>
                        <td><?php echo $types->quantity_created; ?></td>
                        <td><?php echo $types->quantity_published; ?></td>
                        <td><?php echo $types->web_link; ?></td>

						<td style="width:80px;">
						<?php if ($_SESSION["user_region"] == $user->estate){ ?>

							<a href="index.php?view=editproduct&id=<?php echo $types->id;?>" class="btn btn-warning btn-xs">Editar</a>

						<?php }elseif ( $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9 ) { ?>

							<a href="index.php?view=editproduct&id=<?php echo $types->id;?>" class="btn btn-warning btn-xs">Editar</a>

						<?php } ?>

						</td>
						</tr>
						
						<?php

					}
					?>


				</table>
				





				<?php
				}else{
					echo "<p class='alert alert-danger'>No hay productos</p>";

					$total_fem = 0;
					$total_mas = 0;
				}
				?>


			</div class="card-content table-responsive">

			<?php if ($total_fem > 0 or $total_mas > 0){ ?>
				<div class="card-content">

					<div class="col-lg-3">
						<h6><i class="fa fa-male"></i> Total hombres p/pg <span class="badge badge-light"><?php echo $total_mas;?></span> </h6> 
					</div>

					<div class="col-lg-3">
						<h6><i class="fa fa-female"></i> Total mujeres p/pg <span class="badge badge-light"><?php echo $total_fem;?></span> </h6> 
					</div>

				</div>
			<?php } ?>

		</div>
	</div>


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









<style>

.title {
    margin-top: 0;
    margin-bottom: 5px;
    margin-left: 10px;
    margin-right: -20px;
}

.card {
	font-size: 14px;
	margin: 15px 0;
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
    font-size: 0.8em;
	font-weight: 400;
	/* width: 50%; */
	
}



.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px 5px;
	vertical-align: middle;
}







</style>