
<?php
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
// $estadoName = EstadoData::getNameById(6);
// echo EstadoData::getNameById(6);
?>




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
				
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Parroquias</h4>
			</div>
		
			<div class="card-content table-responsive">


			
				<a href="./index.php?view=newparroquia" class="btn btn-info">Agregar parroquia</a>

				<!-- <a href="./index.php?view=oldreservations" class="btn btn-default">Citas Anteriores</a> -->

				<br><br>

				<form class="form-horizontal" role="form">
					<input type="hidden" name="view" value="parroquias">

					<div class="form-group">

						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
								<input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
							</div>
						</div>
					

						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map"></i></span>
								<select name="estado" class="form-control" id="estados1">
									<option value="">ESTADO</option>
									<?php foreach($estado as $p):?>
										<option value="<?php echo $p->id_estado; ?>"><?php echo $p->estado ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						

						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
								<select name="municipio" class="form-control" id="municipios1">
									<option value="">MUNICIPIO</option>
									
								</select>
							</div>
						</div>


						<div class="col-lg-6">
							<button class="btn btn-primary btn-block">Buscar</button>
						</div>
						
					</div>

				</form>








		
				<?php

				$CantidadMostrar=10;
				$url_pag_atras = "";
				$url_pag_adelante = "";

				// Validado  la variable GET
				$compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];




				$users= array();

				if((isset($_GET["q"]) && isset($_GET["municipio"])) && ($_GET["q"]!="" || $_GET["municipio"]!="") ) {
					$sql = "select * from parroquias where";

					if($_GET["q"]!=""){
						$sql .= " (parroquia like '%$_GET[q]%') ";
					}

					if($_GET["municipio"]!=""){
						
						if($_GET["q"]!=""){
							$sql .= " and ";
						}

						$sql .= " id_municipio =\"".$_GET["municipio"]."\"";
					}



				// echo $sql;

						// $users = MunicipioData::getBySQL($sql);

					// Busca el total de registros segun parametros de consulta
					$totalCons = $sql;
					$total = ParroquiaData::getBySQL($totalCons);
					$TotalReg = count($total);
					// echo "XXXX" . $TotalReg;
					
					$users = ParroquiaData::getBySQL($sql." order by id_parroquia asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);

					// Asigna url de paginacion
					$url_pag = "<a href=\"?view=parroquias&q=".$_GET["q"]."&municipio=".$_GET["municipio"]."&pag=";




				}else{
					// $users = MunicipioData::getAll();
					
					$total = ParroquiaData::getAll();
					$TotalReg = count($total);
					
					$sql = "select * from parroquias order by id_parroquia asc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
					$users = ParroquiaData::getBySQL($sql);

					$url_pag = "<a href=\"?view=parroquias&pag=";
					
					
				}


				//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
				$TotalRegistro  =ceil($TotalReg/$CantidadMostrar);


				?>


				<?php if(count($users)>0){ ?>
					<!-- si hay usuarios -->
					
					<div class="form-group text_label">
						<?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay ".$TotalReg. " Registros </b>. La cantidad se dividió a ".$TotalRegistro." páginas para mostrar de ".$CantidadMostrar. " en ".$CantidadMostrar. "</span>" . "<br><br>"; ?>
					</div>
					
			</div class="card-content table-responsive">
		</div>




		<!-- LISTA TABLA -->
		<div class="card">

			<div class="card-content table-responsive">

					<table class="table table-bordered table-hover">
					<thead>
					<th><i class="fa fa-map-pin" style="color:gray"></i> Parroquia</th>
					<th><i class="fa fa-map-marker" style="color:gray" ></i> Municipio</th>
					<th><i class="fa fa-map" style="color:gray"></i> Estado</th>
					<!-- <th><i class="fa fa-home" style="color:gray"></i> Infocentros</th> -->

					<th></th>
					</thead>
					<?php
					foreach($users as $user){
						// $pacient  = $user->getPacient();
						// $medic = $user->getMedic();  
						?>
						<tr>
						<td><?php echo $user->parroquia; ?></td>
						<td><?php echo MunicipioData::getNameById($user->id_municipio); ?></td>
						<td><?php echo EstadoData::getNameById(MunicipioData::getIdEstadoByIdMunic($user->id_municipio)); ?></td>
						<!-- <td><!?php echo count(InfoData::getByParroquia(ParroquiaData::getNameById($user->id_parroquia)));?></td> -->
						
						<td style="width:180px;">
						<a href="index.php?view=editparroquia&id=<?php echo $user->id_parroquia;?>" class="btn btn-warning btn-xs">Editar</a>
						<a href="index.php?action=delparroquia&id=<?php echo $user->id_parroquia;?>" class="btn btn-danger btn-xs">Eliminar</a>
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





<!-- <script src="../../../assets/js/jquery.min.js"></script> -->

		<script language="javascript">
			$(document).ready(function(){

                
                
				$("#estados1").change(function () {

					$('#municipios1').find('option').remove().end().append('<option value=""></option>').val('0');
					
					$("#estados1 option:selected").each(function () {
						id_estado = $(this).val();
					
					// alert(id_estado);
					// alert($("#municipios").val());
            
						$.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
						$("#municipios1").html(data);
						});  

						         
					});
				})
			});





			$(function(){
				$("#estados1").find('select').add('style=display:none');
			})




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
    font-size: 1.2em;
    font-weight: 400;
}

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px 5px;
    vertical-align: middle;
}



</style>