



<?php
	





// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.
// actualizado [11-Aug-2016]
class Core {
	public static $theme = "";
	public static $root = "";
	public static $logintype = "";


	public static $user = null;
	public static $debug_sql = false;








	public static function includeCSS(){
		$path = "res/css/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";

					}
				}
			}
		closedir($handle);
		}

	}

	public static function alert_layout($type,$message,$close){

		echo "<script>
		$('#toast-body').html('$message');
		var myAlert =document.getElementById('layout_alert');
		var bsAlert = new bootstrap.Toast(myAlert, {'autohide': $close, 'delay': 5000, 'animation': true});
		bsAlert.show();
		</script>";

	}

	public static function toast($type,$message,$close){

		echo '
		<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="height: 50px;">
		  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
			  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			<div class="toast-body">'.
			$message
			.'</div>
		  </div>
		</div>
		';

		echo "<script>
		var myAlert =document.getElementById('liveToast');
		var bsAlert = new bootstrap.Toast(myAlert, {'autohide': $close, 'delay': 3000, 'animation': true});
		bsAlert.show();
		</script>";




	}

	public static function toast_down($type,$message,$close){

		// OTRO TIPO DE TOAST
		echo '<script src="assets/js/toast.js"></script>';
		echo "<script>";
		echo "const bs5Utils = new Bs5Utils();";
		echo "bs5Utils.Snack.show('$type', '$message', 0, $close);";
		// bs5Utils.Snack.show('secondary', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('light', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('white', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('dark', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('info', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('primary', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('success', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('warning', 'Hello World!', 0, true);
		// bs5Utils.Snack.show('danger', 'Hello World!', 0, true);

		// echo "
		// bs5Utils.Toast.show({
		// 	type: 'primary',
		// 	icon: ` <span class='material-icons'> &#xE87C;</span> `,
		// 	title: 'Notification!',
		// 	subtitle: '23 secs ago',
		// 	content: 'Hello World!',
		// 	buttons: [
		// 		{
		// 			text: 'Click Me!',
		// 			class: 'btn btn-sm btn-primary',
		// 			handler: () => {
		// 				alert(`Button #1 has been clicked!`);
		// 			}
		// 		},
		// 		{
		// 			text: 'Click Me Too!',
		// 			class: 'btn btn-sm btn-warning',
		// 			handler: () => {
		// 				alert(`You clicked me too!`);
		// 			}
		// 		},
		// 		{
		// 			type: 'dismiss',
		// 			text: 'Hide',
		// 			class: 'btn btn-sm btn-secondary'
		// 		}
		// 	],
		// 	delay: 0,
		// 	dismissible: false
		// });
		// ";

		echo "</script>";




	}



	public static function alert($text){
		echo "<script>alert('".$text."');</script>";
	}

	public static function Swal($text){
		echo "<script>"."Swal.fire(".$text.");</script>";
	}
	public static function redir($url){
		echo "<script>window.location='".$url."';</script>";
	}

	public static function includeJS(){
		$path = "res/js/";
		$handle=opendir($path);
		if($handle){
			while (false !== ($entry = readdir($handle)))  {
				if($entry!="." && $entry!=".."){
					$fullpath = $path.$entry;
				if(!is_dir($fullpath)){
						echo "<script type='text/javascript' src='".$fullpath."'></script>";

					}
				}
			}
		closedir($handle);
		}

	}

}


?>

