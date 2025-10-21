<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("update_prod").addEventListener('submit', validarFormulario);
		getSocialmedia();
	});

	function validarFormulario(evento) {
		event.preventDefault();

		$('#cover-spin').show(0);

		// Verify if the links don't duplide
		if(!validarDuplicidad()){
			$('#cover-spin').hide(0);
			toastify("El links duplicados, por favor, revise.", true, 12000, "error");
			
			return false;
		}


		console.log(socialMedias);
		let socialMediasArray = socialMedias["array"];
		
		let socialMediasData = [];
		console.log(socialMediasArray);

		socialMediasArray.forEach(element => {
			let nombre = element["nombre"];
			let valor = $(`#${nombre}`).val();
			let id =  $(`#${nombre}`).data("id");
			
			socialMediasData.push(
				{
					"id"     : id,
					"nombre" : element["nombre"],
					"valor"  : valor, 
				}
			);
		
		});

		console.log(socialMediasData);

		$.ajax({
				type: "POST",
				url: "./?action=ajax",
				// headers: {
				//     "X-CSRFToken": getCookie("csrftoken")
				// },
				data: {
					function: "update_prod", // funcion que llama
					id: $("#id").val(), // parametros
					action_performed: $("#action_performed").val(),
					date_activity: $("#date_activity").val(),
					estate: $("#estate").val(),
					code_info: $("#code_info").val(),
					format: $("#format").val(),
					format_detail: $("#format_detail").val(),
					quantity_created: $("#quantity_created").val(),
					quantity_published: $("#quantity_published").val(),
					web_link: socialMediasData
				}
			})
			.done(function(msg) {
				if (getOS() == "Android") {
					alert("Registro guardado");
				} else {
					toastify('Registro guardado', true, 1000, "dashboard");
				}
				// window.document.location=msg;
				// location.reload();
				// $('#content').reload('#content');
				$('#cover-spin').hide(0);

			})
			.fail(function() {
				if (getOS() == "Android") {
					alert("Hubo un error al guardar, intenta nuevamente");
				} else {
					toastify('Hubo un error al guardar, intenta nuevamente', true, 5000, "warning");
				}
				$('#cover-spin').hide(0);
				return false;
			});
		// .always(function() {
		//     toastify('Finished',true,1000,"warning");
		// });

		// this.submit();
	};


	async function getSocialmedia() {

		try {
			let product_id = document.getElementById("id").value;

			let data = {
				product_id : product_id
			};

			let res = await fetch("./?action=getLinks", {
				method: 'POST',
				body: JSON.stringify(data),
				headers: {
					"Content-Type": "application/json",
				},
			});

			let links = null;
			
			if (res.ok) {
				const result_await = await res.text();
				var array = JSON.parse(result_await);
				console.log(array);

				links = array;
				
			} else {
				toastify(res.statusText, true, 12000, "error");
				throw res.statusText;
			}

			res = await fetch("./?action=getSocialmedia", {
				method: 'POST',
				body: "data"
			});

			if (res.ok) {
				const result_await = await res.text();
				var array = JSON.parse(result_await);
				console.log(array);
				socialMedias = array;
				let icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12q0-.175-.003-.353t-.022-.341q-.067.667-.53 1.104q-.464.436-1.137.436h-2.539q-.698 0-1.195-.496t-.497-1.193v-.845h-3.385v-1.69q0-.697.498-1.198q.497-.501 1.195-.501h.846v-.77q0-.728.476-1.146t1.137-.482q-.673-.26-1.38-.392T12 4Q8.65 4 6.325 6.325T4 12v.289q0 .134.02.288H8.5q1.42 0 2.402.983q.983.982.983 2.393v.855H9.346v2.73q.616.222 1.286.342T12 20"/></svg>';
				let linksCount = 0;
				for ( let r of array["array"]) {
					let id = ""
					let dataLink = "";
					let isLink = false;
					for (let link of links){
						if(link["social_medias_id"] == r["id"]){
							dataLink = link["link"];
							id = link["id"];
							linksCount ++;
							isLink = true;
						}
					}


					var nombre = r.nombre;
					if (nombre == "Facebook") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" fill-rule="evenodd" d="M15.725 22v-7.745h2.6l.389-3.018h-2.99V9.31c0-.874.243-1.47 1.497-1.47h1.598v-2.7a21 21 0 0 0-2.33-.12c-2.304 0-3.881 1.407-3.881 3.99v2.227H10v3.018h2.607V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104v17.792c0 .61-.494 1.104-1.104 1.104z"/></svg>';
					} else if (nombre == "X") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="m9 7l2 5l-2 5h2l1-2.5l1 2.5h2l-2-5l2-5h-2l-1 2.5L11 7zm3-5a10 10 0 0 1 10 10a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2"/></svg>';
					} else if (nombre == "Instagram") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3"/></svg>';
					} else if (nombre == "Threads") {
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M6.321 6.016c-.27-.18-1.166-.802-1.166-.802.756-1.081 1.753-1.502 3.132-1.502.975 0 1.803.327 2.394.948s.928 1.509 1.005 2.644q.492.207.905.484c1.109.745 1.719 1.86 1.719 3.137 0 2.716-2.226 5.075-6.256 5.075C4.594 16 1 13.987 1 7.994 1 2.034 4.482 0 8.044 0 9.69 0 13.55.243 15 5.036l-1.36.353C12.516 1.974 10.163 1.43 8.006 1.43c-3.565 0-5.582 2.171-5.582 6.79 0 4.143 2.254 6.343 5.63 6.343 2.777 0 4.847-1.443 4.847-3.556 0-1.438-1.208-2.127-1.27-2.127-.236 1.234-.868 3.31-3.644 3.31-1.618 0-3.013-1.118-3.013-2.582 0-2.09 1.984-2.847 3.55-2.847.586 0 1.294.04 1.663.114 0-.637-.54-1.728-1.9-1.728-1.25 0-1.566.405-1.967.868ZM8.716 8.19c-2.04 0-2.304.87-2.304 1.416 0 .878 1.043 1.168 1.6 1.168 1.02 0 2.067-.282 2.232-2.423a6.2 6.2 0 0 0-1.528-.161"/></svg>';
					} else if (nombre == "Pinterest"){
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M9.04 21.54c.96.29 1.93.46 2.96.46a10 10 0 0 0 10-10A10 10 0 0 0 12 2A10 10 0 0 0 2 12c0 4.25 2.67 7.9 6.44 9.34c-.09-.78-.18-2.07 0-2.96l1.15-4.94s-.29-.58-.29-1.5c0-1.38.86-2.41 1.84-2.41c.86 0 1.26.63 1.26 1.44c0 .86-.57 2.09-.86 3.27c-.17.98.52 1.84 1.52 1.84c1.78 0 3.16-1.9 3.16-4.58c0-2.4-1.72-4.04-4.19-4.04c-2.82 0-4.48 2.1-4.48 4.31c0 .86.28 1.73.74 2.3c.09.06.09.14.06.29l-.29 1.09c0 .17-.11.23-.28.11c-1.28-.56-2.02-2.38-2.02-3.85c0-3.16 2.24-6.03 6.56-6.03c3.44 0 6.12 2.47 6.12 5.75c0 3.44-2.13 6.2-5.18 6.2c-.97 0-1.92-.52-2.26-1.13l-.67 2.37c-.23.86-.86 2.01-1.29 2.7z"/></svg>';
					} else if (nombre == "TikTok"){
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M16.6 5.82s.51.5 0 0A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6c0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64c0 3.33 2.76 5.7 5.69 5.7c3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48"/></svg>';
					} else if (nombre == "YouTube"){
						icono = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/><path fill="#828282" d="M8 19V5l11 7z"/></svg>';
					}

					var new_rrss = document.getElementById("new_rrss");
					var newDiv = document.createElement("div");
					newDiv.innerHTML = `
					<div class="row">
						<div class="col">
							<div class="form-group col-mg-4">
								<div class="mui-textfield mui-textfield--float-label">

									<input type="url" data-id="`+ id +`" data-is-link="`+ isLink +`" id="` + nombre + `" name="` + nombre + `" value="` + dataLink + `" />
									<label>
									<i>
										` + icono + `
									</i>
									` + nombre + ` (url)
									</label>

								</div>
							</div>
						</div>
					</div>
					`;

					new_rrss.appendChild(newDiv);

					let input = document.getElementById(nombre);
					input.addEventListener('change', validarLink);
					
				}

				let input = document.getElementById("quantity_published");
				input.value = linksCount;


			} else {
				toastify(res.statusText, true, 12000, "error");
				throw res.statusText;
			}

		} catch (error) {
			toastify(error, true, 12000, "error");
			throw error;
		}




	}

	function validarLink(e){
		
		let valor = e.target.value;
		console.log(valor);

		//Si el valor es un link valido entonces se coloca el dataset is link a true
		if (/(?:https?):\/\/(\w+:?\w*)?(\S+)(:\d+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/i.test(valor)) {
			e.target.dataset.isLink = true;

		}else{
			e.target.dataset.isLink = false;
		}		
		validarDuplicidad();
		calcularProductosPublicados();
		
	}

	function calcularProductosPublicados(){
		elements = $("input[data-is-link]");

		let cantidad = 0;
		for (let i = 0; i < elements.length; i++) {
			if(elements[i].dataset.isLink == "true"){
				cantidad++;
			}
		}
		console.log(cantidad);
		$("#quantity_published").val(cantidad);
	}

	function validarDuplicidad() {
		var links = $("input[data-is-link = true]");
		let valido = true;
		for (let i = 0; i < links.length; i++) {
			for (let j = i + 1; j < links.length; j++) {
				if (links[i].value == links[j].value) {
					links[i].setCustomValidity("El link ya ha sido ingresado");
					links[j].setCustomValidity("El link ya ha sido ingresado");
					valido = false;
				}
			}
		}
		if(valido){
			for (let i = 0; i < links.length; i++) {
				links[i].setCustomValidity("");
			}
		}
		return valido;
	}
</script>


<?php
$prod = ProductsData::getById($_GET["id"]);
$id = $_GET["id"];
$sql = "SELECT * FROM links 
	INNER JOIN products_list ON products_list.id = links.products_list_id 
	WHERE links.products_list_id = $id;";
$links = LinksData::getBySQL($sql)[0];
$products_cat = ProductsType::getBySQL("select * from categoria_productos");
?>


<div id="cover-spin"></div>


<div class="panel panel-default">

	<div class="panel-heading">
		<h4 class="title">
			<span class='text_label'> <i class='fa fa-sliders icon_label'></i> <b> Editando el producto: <?php echo "(" . $prod["format"] . "/" . $prod["format_detail"] . ")" ?></b> </span>
		</h4>
	</div>

	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">

						<div class="card-header card-header-primary">
							<h4 class="title">Editar producto</h4>
							<!-- <p class="card-category">Complete your profile</p> -->
						</div>

						<br>
						<div class="card-body">

							<form method="post" id="update_prod" role="form">
								<!-- <form class="form-horizontal" role="form" method="post" action="./?action=ajax"> -->
								<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
								<input type="hidden" name="date_activity" id="date_activity" value="<?php echo $prod["date"]; ?>">
								<input type="hidden" name="estate" id="estate" value="<?php echo $prod["estate"]; ?>">
								<input type="hidden" name="code_info" id="code_info" value="<?php echo $prod["code_info"]; ?>">

								<div class="col-md-6">
									<div class="form-group">
										<label for="format" class="control-label">Categoría del producto*</label>
										<select name="format" class="form-control" id="format" required>
											<option value="<?php echo $prod["format"] ?>"> <?php echo $prod["format"] ?> </option>
											<?php foreach ($products_cat as $p) : ?>
												<option value="<?php echo $p->nombre_categoria; ?>"><?php echo $p->nombre_categoria ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>


								<div class="col-md-6">
									<div class="form-group">
										<label for="format_detail" class="control-label">Tipo de producto*</label>
										<select name="format_detail" class="form-control" id="format_detail" required>
											<option value="<?php echo $prod["format_detail"] ?>"><?php echo $prod["format_detail"] ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="quantity_created" class="control-label">Total de productos creados*</label>
										<input type="number" disabled name="quantity_created" id="quantity_created" required value="<?php echo $prod["quantity_created"] ?>" class="form-control" placeholder="Número">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="quantity_published" class="control-label">Total de productos publicados*</label>
										<input type="number" disabled name="quantity_published" id="quantity_published" required value="<?php echo $prod["quantity_published"] ?>" class="form-control" placeholder="Número">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group" id="new_rrss">

									</div>
								</div>

								<div class="col-md-11">
									<div class="form-group">
										<label for="action_performed" class="control-label">Descripción</label>
										<input type="text" name="action_performed" id="action_performed" value="<?php echo $prod["action_performed"] ?>" class="form-control" placeholder="">
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<button type="submit" name="" class="btn btn-primary btn-block">Guardar</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<button type="button" onclick="history.back()" class="btn btn-default btn-block">Volver</button>
										</div>
									</div>
								</div>


							</form>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	<script language="javascript">
		$(document).ready(function() {

			$("#format").change(function() {
				$('#format_detail').find('option').remove().end().append('<option value=""></option>').val('0');
				$("#format option:selected").each(function() {
					categoria = $(this).val();
					console.log(categoria);
					$.post("core/app/view/getCatProduct.php", {
						categoria: categoria
					}, function(data) {
						// console.log(data);
						$("#format_detail").html(data);
					});

				});
			})

		});
	</script>