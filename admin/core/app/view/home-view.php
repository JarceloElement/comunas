<script>

</script>


<?php
// limitar texto de la tarjeta
function charlimit_title($string, $limit)
{
  $overflow = (strlen($string) > $limit ? true : false);
  return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
}

function charlimit_sub_title($string, $limit)
{
  $overflow = (strlen($string) > $limit ? true : false);
  return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
}
?>



<div class="card text-center">
	<div class="card-header card-header-primary">
		<!-- <ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" href="#0">Ver servicios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#0">Ver usuarios</a>
			</li>
		
		</ul>	 -->
		<h4 class="title text-left">Sistema de reporte de actividades</h4>

	</div>
	<div class="card-body">
		<h4 class="card-title">¡Bienvenidos de vuelata!</h4>
		<!-- <p class="card-text">Si es primera vez que se agrega el servicio de un usuario, antes debe ser registrado en el sistema como nuevo usuario</p> -->
		<!-- <a href="#" data-toggle="modal" data-target="#image_preview" class="btn btn-success">Nuevo servicio</a> -->
		<a href="./index.php?view=newplanning" class="btn btn-success">Nuevo reporte</a>
		<a href="./../index.php?view=userform_new&new=1" class="btn btn-primary">Nuevo usuario</a>
		<a href="./index.php?view=final_users" class="btn btn-info">Editar usuarios</a>
	</div>
</div>






<style>
  /* limitar titulo de la tarjeta */
  .lead {
    width: 100%;
    table-layout: fixed;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>










</style>