<script language="javascript">
	$(document).ready(function() {
		// sendMessage(event);
		sendMessage2(event);

	});


	async function sendMessage(event) {
		event.preventDefault();
		var code_info = "<b>CÓDIGO:</b> DC85";
		var message = code_info + "\n"; // Tu mensaje
		message += "<b>CATEGORÍA:</b> Formación\n";
		message += "<b>TÍTULO:</b> Curso de Programación\n";
		message += "Esto es un ejemplo";

		try {
			// const res = await fetch("./?action=telegramApi", {
			const res = await fetch("./?action=telegramBot", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					message: message
				})
			});

			if (res.ok) {
				const result_await = await res.text();
				console.log(result_await);
				var array = JSON.parse(result_await);
				toastify(array['message'], true, 52000, "dashboard");

			} else {
				toastify(res.statusText, true, 52000, "error");
				throw res.statusText;
			}

		} catch (error) {
			toastify(error, true, 52000, "error");
			throw error;
		}

	}




	function sendMessage2(event) {
		event.preventDefault();

		$.ajax({
				type: "POST",
				url: "./?action=ajax",
				// headers: {
				//     "X-CSRFToken": getCookie("csrftoken")
				// },
				data: {
					function: "send_notific",
					message: "🔥 Demo message",
				}
			})
			.done(function(msg) {
				if (getOS() == "Android") {
					alert("Registro actualizado");
				} else {
					toastify('Registro actualizado', true, 1000, "dashboard");
				}
				console.log(msg);
				// location.reload();

			})
			.fail(function(err) {
				if (getOS() == "Android") {
					alert("Ocurrió un error al guardar, intenta nuevamente");
				} else {
					toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
				}

				$('#cover-spin').hide(0);
			});
		// .always(function() {
		//     toastify('Finished',true,1000,"warning");
		// });
	};
</script>




<div class="row">
	<div class="col-md-12">

		<div class="card">

			<span>Mensajes con Bot desde clase ajax y PHP</span>

		</div>

	</div>
</div>