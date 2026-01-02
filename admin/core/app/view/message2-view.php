
<div class="row">
	<div class="col-md-12">

		<div class="card">

			<span>Mensajes con Bot</span>

			<?php

			$url = "http://infoapp2.infocentro.gob.ve/admin/index.php?view=editplanning&user_id=";

			$notific = new NotificData();
			$notific->url = $url;
			$notific->message = "🔥 REVICIÓN INFOAPP";
			$result = $notific->sendTelegram2();
			// echo $result;

			?>


		</div>

	</div>
</div>