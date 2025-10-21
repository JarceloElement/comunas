<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<script language="javascript">

$(document).ready(function(){

	var Name_OS = "Unknown OS";
	// OS NAME
	if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
	if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
	if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
	if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
	if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
	// console.log(Name_OS);

	// navegador web en escritorio
	var sBrowser, sUsrAg = navigator.userAgent;

	if(sUsrAg.indexOf("Chrome") > -1) {
		sBrowser = "Chrome";
	} else if (sUsrAg.indexOf("Safari") > -1) {
		sBrowser = "Safari";
	} else if (sUsrAg.indexOf("Opera") > -1) {
		sBrowser = "Opera";
	} else if (sUsrAg.indexOf("Firefox") > -1) {
		sBrowser = "Firefox";
	} else if (sUsrAg.indexOf("MSIE") > -1) {
		sBrowser = "Internet Explorer";
	}
	// console.log(sBrowser);


	
	if (Name_OS == "Android"){
		get_Name = Name_OS + "|" + sBrowser;
		// get_Name = Name_OS + "|" + md.userAgent() + "|" + md.mobile() + "|" + md.versionStr('Build');
	}else{
		get_Name = Name_OS + "|" + sBrowser;
	}
	// console.log(md.userAgent());



	$(function(){

		// $(document).on('click', 'video', function (event) {
		// 	console.log('click '+this.id);
		// });

		// evento al reproducir el video
		// const video = document.querySelector("video");
		// video.addEventListener("play", (event) => {
		// 	add_doclog(video.id);
		// 	console.log('add_doclog '+video.id);
		// });


		let videos = document.querySelectorAll("video");
		videos.forEach(video => {
			video.addEventListener('play', (event)=> {
				if(video.className =="paused"){
					add_doclog(video.id,"play");
					video.className = "playing"
				}
				console.log('add_doclog '+video.className);
			});
		});



	});

});




function add_doclog(video,status){

	let user_id = <?php echo $_SESSION['user_id']; ?>;
	let code_info = <?php echo '"'.$_SESSION['user_code_info'].'"';?>;

	$.ajax({
		type: "GET",
		url: "core/app/view/log_doc.php",
		// headers: {
		//     "X-CSRFToken": getCookie("csrftoken")
		// },
		data: {
			user_id: user_id,
			code_info: code_info,
			video_view: video,
			description: status
		}
	})
	.done(function( msg ) {
		toastify('Reproduciendo',true,1000,"dashboard");
	})
	.fail(function(msg) {
		toastify('No se guardó el log',true,5000,"warning");
	});
	// .always(function() {
	//     toastify('Finished',true,1000,"warning");
	// });
}


</script>






<div class="row justify-content-center">
	

	<div class="col-md-12">

		<div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-36 orange600">support_agent</span></div>  
		<div class="row justify-content-center"><h6 class="title">Documentación Infoapp</h6></div>  

		<div class="list-group" id="accordionOne">

			<div class="expansion-panel list-group-item">
				<a aria-controls="collapseOne" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapseOne" id="headingOne">
				<h6>¿Cómo crear y reportar una actividad?</h6>
				<div class="expansion-panel-icon ml-3 text-black-secondary">
					<i class="collapsed-show material-icons">keyboard_arrow_down</i>
					<i class="collapsed-hide material-icons">keyboard_arrow_up</i>
				</div>
				</a>
				<div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapseOne">
					<div class="expansion-panel-body">
						<div class="row justify-content-center">
							Video
						</div>
						<div class="row justify-content-center">

						<div class="col-md-8">
							<div class="embed-responsive embed-responsive-16by9">
								<video class="paused" id="crear_reportar_actividad" controls="true" class="embed-responsive-item">
									<source src="uploads/videos/crear_reportar_actividad.mp4" type="video/mp4" />
								</video>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="expansion-panel list-group-item">
				<a aria-controls="collapseTwo" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapseTwo" id="headingTwo">
				<h6>¿Cómo crear nuevos usuarios del sistema?</h6>
				<div class="expansion-panel-icon ml-3 text-black-secondary">
					<i class="collapsed-show material-icons">keyboard_arrow_down</i>
					<i class="collapsed-hide material-icons">keyboard_arrow_up</i>
				</div>
				</a>
				<div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionOne" id="collapseTwo">
					<div class="expansion-panel-body">
						<div class="row justify-content-center">
							
						</div>
						<div class="row justify-content-center">

						<div class="col-md-4">
							<b style="color:#06aaed;">Contenido del video:</b><br>
							- Creando un nuevo usuario<br>
							- Verificando el infocentro del usuario<br>
							- Registro de personal en Gestión Humana<br>
						<br>
						</div>
						
						<div class="col-md-8">
							<div class="embed-responsive embed-responsive-16by9">
								<video class="paused" id="crear_nuevo_usuario" controls="true" class="embed-responsive-item">
									<source src="uploads/videos/nuevos_usuarios.mp4" type="video/mp4" />
								</video>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="expansion-panel list-group-item">
				<a aria-controls="collapseThree" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#collapseThree" id="headingThree">
				<h6>¿Cómo crear y reportar una actividad?</h6>
				<div class="expansion-panel-icon ml-3 text-black-secondary">
					<i class="collapsed-show material-icons">keyboard_arrow_down</i>
					<i class="collapsed-hide material-icons">keyboard_arrow_up</i>
				</div>
				</a>
				<div aria-labelledby="headingThree" class="collapse" data-parent="#accordionOne" id="collapseThree">
					<div class="expansion-panel-body">
						<div class="row justify-content-center">
							Video
						</div>
						<div class="row justify-content-center">
							<div class="col-md-8">
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="uploads/videos/crear_reportar_actividad.mp4" allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->

		</div>





	</div>
</div>





<br>
<br>
<br>
<br>
<br>
<br>
<br>













