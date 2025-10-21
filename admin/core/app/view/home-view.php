



<script>
// <!-- MODAL IMAGE POPUP -->
$(function() {
  // $("#btnExito").click(function(){
  $(document).on('click', 'button[type="image_add"]', function(event) {
  let id = this.id;

  // var id = document.getElementById("data_id");
  // var idx = document.getElementsByClassName("data_id").item(0).id;
  var titulo = document.getElementsByClassName("data_titulo").item(id).id;
  var imagen = document.getElementsByClassName("data_imagen").item(id).id;
  var code_info = document.getElementsByClassName("data_code_info").item(id).id;
  var linea = document.getElementsByClassName("data_linea").item(id).id;


// alert(id);


Swal.fire({
  width: 800,
  title: titulo,
  imageUrl: imagen,
  text: code_info+' | '+linea,
  // html: '<b>'+linea+'<b>',
  imageWidth: 400,
  // imageHeight: 400,
  imageAlt: 'Custom image',
  padding: '1em',
  customClass: {
    image:'swiper'
  }
})

    // alert("AA");
    // $.post("core/app/view/image_viewer.php", { id_estado: 1 }, function(data){
    //   $("#modal-body").html(data);
    //   $('#myModal').modal('show');

    // }); 

  });







});



// $(function() {
//  $(document).on('click', 'button[type="image_add"]', function(event) {
//     let id = this.id;
// 			// $(window).scrollTop(0);
// 			window.scrollTo({ top: 100, left: 100, behavior: 'smooth' });
// 			// document.location.href = "#top";

//     $.post("core/app/view/image_viewer.php", { id: id }, function(data){
// 		$("#modal-body").html(data);
// 		$('#myModal').modal('show');
// 		$('.modal,.notice').fadeIn(200,function(){});
		
// 			// $(window).scrollTop(0);
// 			// window.scrollTo({ top: 0, behavior: 'smooth' });

// 	  // alert("-"+id+"-");
// 	//   console.log(id);
// 		// console.log("Se presionó el Boton con Id :"+ id)

//     });


//   });
// });




</script>







<!-- <input type="button" value="Abrir modal" name="registrar" id="btnExito" class="registrar" tabindex="8" /> -->

<!-- MODAL IMAGE POPUP -->
<div class="modal fullscreen-modal fade" id="myModal" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body" id="modal-body">

            </div>

          </div>

          <!-- Titulo actividad -->
          <!-- <div class="modal-content">
            <div class="modal-header">
              <div class="card_title">
                <span> Title </span>
              </div>
            </div>
          </div> -->


          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
      </div>
    </div>
  </div>

</div>





<!-- <!?php
$thejson=null;
$events = ReservationData::getEvery();
foreach($events as $event){
	$thejson[] = array("title"=>$event->title,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$event->date_at."T".$event->time_at);
}
?>

<script>
	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<!?php echo date('Y-m-d');?>',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: <!?php echo json_encode($thejson); ?>
		});
		
	});
</script> -->





<?php
  // limitar texto de la tarjeta
  function charlimit_title($string, $limit) {
    $overflow = (strlen($string) > $limit ? true : false);
    return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
  }
  
  function charlimit_sub_title($string, $limit) {
    $overflow = (strlen($string) > $limit ? true : false);
    return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
  }
?>


<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
          <div class="form-group">
            <div class="card-body">
              <div class="card-content table-responsive">
                <a href="./index.php?view=newplanning" class="btn btn-primary"><i class="fa fa-paper-plane" ></i> Agregar planificación</a>
                <a href="./index.php?view=services" class="btn btn-info"><i class="fa fa-plus-circle" ></i> Registrar servicio</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <div class="row">

	<div class="col-md-6">
    <div class="form-group floating-label form-ripple-bottom">
      <div class="input-group">
        <span class="input-group-addon"><i class="material-icons">group</i></span>
        <label for="floating">Usuario o correo</label>
        <input class="form-control" name="email" type="text" required></input>
      </div>
    </div>
  </div>

	<div class="col-md-6">
    <div class="form-group floating-label form-ripple-bottom">
      <div class="input-group">
        <span class="input-group-addon"><i class="material-icons">group</i></span>
        <label for="floating">Usuario o correo</label>
        <input class="form-control" name="email" type="text" required></input>
      </div>
    </div>
  </div>

</div> -->




<!-- <span class="text_label"> <i class="fa fa-paper-plane icon_label" ></i> <b>Últimos reportes del mes</b></span><br><br> -->






  <div class="row">

    <?php
      $reports = ReportActivityData::getProducts();
      $ID = 0;
      
      foreach($reports as $param){

        $image = explode(", ",$param->image);
        $image = str_replace("origin", "preview", $image);

        if ($image[0] != "Sin registro fotográfico"){
          $image_d = $image[0];
        }
        if ($image[0] == "Sin registro fotográfico"){
            $image_d = "default.jpg";}
  
        if ($image[0] == ""){
          $image_d = "default.jpg";}

        ?>




        <div class="col-md-4">
            <div class="card text-center" >
              <div class="card_imag">
                <img class="card-img-top" id="https://infoapp.lanubeplus.com/uploads/images/reports/<?php echo $image_d; ?>" src="uploads/images/reports/<?php echo $image_d; ?>" alt="image">            
              </div>
              <hr class="my-4">
              <div class="card-body">
                <!-- <h4 class="card-title"><!?php echo charlimit_title($param->activity_title, 50); ?></h4> -->
                <div class="card_title" id="titulo">
                  <p class="card-text"><?php echo charlimit_title($param->activity_title, 50); ?></p>
                </div>
                <button type="image_add" id="<?php echo $ID; ?>" class="btn btn-primary btn-sm">Ver más
              </div>
              <div class="card-footer">
                <div class="stats">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2M12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8s-3.58 8-8 8"/><path fill="currentColor" d="M12.5 7H11v6l5.25 3.15l.75-1.23l-4.5-2.67z"/></svg></i> <?php echo "Fecha: ".date("d/m/Y", strtotime($param->date_pub)); ?>
                </div>
              </div>
            </div>
        </div>


        <!-- data preview -->
        <p class="data" id="get_data" >
        <p class="data_id" id="<?php echo $ID; ?>"></p>
        <p class="data_imagen" id="https://infoapp.lanubeplus.com/admin/uploads/images/reports/<?php echo $image_d; ?>"></p>
        <p class="data_titulo" id="<?php echo $param->activity_title; ?>"></p>
        <p class="data_code_info" id="<?php echo $param->code_info; ?>"></p>
        <p class="data_linea" id="<?php echo $param->line_action; ?>"></p>
        </p>
        
        
        <?php $ID += 1; ?>

        
    <?php } ?>

    


<!-- <a><button type="image_add" id=" echo $param->image; " class="btn btn-primary btn-sm">Leer mas</a> -->



</div>




<style>
 
 .row:before {
    display: block;
    content: " ";
}

.card-title, .card-text {
  margin-top: 0;
  margin-bottom: 5px;
  margin-left: 10px;
  margin-right: 10px;
}

.jumbotron {
    padding-top: 10px;
    padding-bottom: 10px;
    margin-bottom: 10px;
    color: inherit;
    background-color: #ffffff;
    box-shadow: 0 2px 2px 0 #99999924, 0 3px 3px -2px #99999933, 0 3px 5px 0 #9999991f;
    /* height: 500px; */
}


.card_imag {

  /* width:230px; */
  height:180px;
  overflow:hidden;

}

.card_title {

/* width:230px; */
height:45px;
overflow:hidden;

}

.col-md-4 {
    /* width: 33.33333333%; */
    min-width: 33%;
}


.jumbotron p {
    margin-bottom: 15px;
    font-size: 16px;
    font-weight: 300;
    /* letter-spacing: 0.1em; */
	  line-height: 20px;
}


@media screen and (min-width: 768px){
  .container .jumbotron, .container-fluid .jumbotron {
      padding-right: 20px;
      padding-left: 20px;
  }

}
@media screen and (max-width: 769px){
  .container .jumbotron, .container-fluid .jumbotron {
      padding-right: 20px;
      padding-left: 20px;
  }

}



/* limitar titulo de la tarjeta */
.lead { 
  width: 100%;
  table-layout:fixed;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}








</style>


