


<!-- muestra variable PHP en JS -->
<?php $a = "Hola Mundo!"; ?>
<script type="text/javascript"> alert( "<?php echo $a; ?>" ); </script>


<!-- cambiar location -->
<?php
    $LOCATION_U = 'index.php?view=newinfocentro';
    echo "<script language=\"JavaScript\">
    <!-- 
    document.location=\"$LOCATION_U#Ancho=\"+id_estado;
    
    //-->
    </script>";
  ?>

<!-- ancho de pantalla -->
<script> document.location=\"$LOCATION_U#Ancho=\"+screen.width+\"&Alto=\"+screen.height";</script>





<!-- PASAR VALOR DE UN DIV A OTRO -->
<form class="form-inline" method="POST" action=""> 
    <label>Nombres: </label> 
    <input class="form-control" type="text" id="trord" onblur="document.getElementById('uno').value=this.value" />
    <label>Nombres: </label>
    <input type="text" id="uno" placeholder="Recibe contenido"  class="form-control">  
</form>




<!-- FUNCION PARA MOSTRAR IMAGEN SEGUN EL ANCHO-->
<!-- La función se encargará de retornar las dimensiones idóneas para ese ancho. -->
<?php
function redimensionar($src, $ancho_forzado){
   if (file_exists($src)) {
      list($width, $height, $type, $attr)= getimagesize($src);
      if ($ancho_forzado > $width) {
         $max_width = $width;
      } else {
         $max_width = $ancho_forzado;
      }
      $proporcion = $width / $max_width;
      if ($proporcion == 0) {
         return -1;
      }
      $height_dyn = $height / $proporcion;
   } else {
      return -1;
   }
   return array($max_width, $height_dyn);
}
?>
<!-- USO -->
<?php
$imagen = 'images/imagen1.jpg';
$array_medidas_img = redimensionar($imagen, 50);
echo '<img src="'.$imagen.'" width="'.$array_medidas_img[0].'" height="'.$array_medidas_img[1].'" />';
?>



<?php 
function clonar_imagenes()
  {
    // URL de los recursos a copiar
    $urls =
    [
      'https://731392.smushcdn.com/2541639/wp-content/uploads/2021/11/js_121-1024x566.jpg',
      'https://www.joystick.com.mx/wp-content/uploads/2021/12/js_209.jpg',
      'https://www.joystick.com.mx/wp-content/uploads/2021/12/js_206.jpg',
      'https://cdn.shopify.com/s/files/1/0339/1743/5948/products/vital-army-official-playeras-manga-larga-spiderman-manga-larga-compresion-28656617685036.jpg'
    ];
 
    // Directorio donde almacenaremos las imágenes localmente
    $dir = UPLOADS; // constante de bee framework para guardar en la carpeta de assets/uploads/
 
    // Conteos
    $images = []; // nombres de imágenes copiadas con éxito
    $copied = 0;
    $errors = 0;
 
    // Iteramos sobre cada URL del array
    foreach ($urls as $url) {
      $new_name = generate_filename().'.jpg';
      if (!copy($url, $dir.$new_name)) {
        $errors++;
        continue; // para continuar a la siguiente iteración
      }
 
      $copied++;
      $images[] = $new_name;
    }
 
    if ($errors > 0) {
      echo sprintf('Hubo %s errores.', $errors);
    }
 
    if ($copied > 0) {
      echo sprintf('Copiamos %s recursos con éxito al servidor.<br>', $copied);
 
      // Mostramos las nuevas imágenes locales
      foreach ($images as $img) {
        echo sprintf('<img src="%s" alt="%s" style="width: 100px; height: 100px; object-fit: cover; margin: 10px 5px 0px 0px; border: 1px solid grey;">',
          UPLOADED.$img,
          $img
        );
      }
    }
  }
?>






<!-- ==================================== java script ========================================== -->

<script>
// $(window).scrollTop(0);
// window.scrollTo({ top: 100, left: 100, behavior: 'smooth' });
// document.location.href = "#top";


var modalEl = document.createElement('div');
modalEl.textContent = "body_html"; //añade texto al div creado.
// var newContent = document.createTextNode("Hola!¿Qué tal?");
// modalEl.appendChild(newContent); //añade texto al div creado.


function add_viewer(comp){
    let id = comp.id;
    $.post("core/app/view/image_viewer.php", { id: id }, function(data){
    //   $("#modal-body").html(data);
    //   $('#myModal').modal('show');
        
    //   alert("-"+id+"-");
    //   console.log(id);

    }); 
}


// $('#data-image').fadeIn(200,function(){});

// $(window).scrollTop(0);
// window.scrollTo({ top: 0, behavior: 'smooth' });

// body_html.content = '<img src="uploads/images/reports/origin_1_2021-02-04 17:28:10.jpg" style="min-width: 80px; min-height: 50px;" class="img-fluid mb-2" alt="Imagen"/>';


</script>