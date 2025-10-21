
<?php
	require ('../../../core/controller/Database_admin.php');
  $db = Database::connectPDO();

$id = $_POST['id'];

$statement_1 = $db->query("SELECT image FROM reports WHERE id = '$id' ");
$res = $statement_1->fetchAll();

if(isset($res)){
	foreach ($res as $i){
		// $image = $i['image'];
		$images = explode(", ",$i['image']);
	}
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Archivo CSS para Swiper JS -->
	<link rel="stylesheet" type="text/css" href="assets/plugins/swiper/node_modules/swiper/swiper-bundle.css">
	<!-- Archivo Javascript para Swiper JS -->
	<script type="text/javascript" src="assets/plugins/swiper/node_modules/swiper/swiper-bundle.js"></script>
	<script type="text/javascript" src="assets/plugins/swiper/node_modules/swiper/swiper-bundle.esm.js"></script>
</head>






<body>



  <!-- Swiper -->
  <div class="swiper">
    <div class="swiper-wrapper">


      <!-- CARGA LAS IMAGENES -->
      <?php $cnt=0; foreach($images as $img):?>
      <?php 

      clearstatcache();

      if ($img != "Sin registro fotográfico"){
        $img = $img;
      }
      if ($img == "Sin registro fotográfico"){
          $img = "default.jpg";
        }

      if ($img == ""){
        $img = "default.jpg";
      }

      $img = str_replace("origin", "preview", $img);

      $imagePath  = '../../../uploads/images/reports/'.$img;
      // $file_path_and_name = DIRECTORY_SEPARATOR . "{$filename}";
      if(file_exists($imagePath)){
        $imagePath  = 'uploads/images/reports/'.$img;
        // echo "AAA".$imagePath;

      }else{
        $img = str_replace("origin", "preview", $img);
        $imagePath  = 'uploads/images/reports/'.$img;
        
      }
      
      ?>


      <div class="swiper-slide">
        <div class="swiper-zoom-container">
		      <img src="<?php echo $imagePath; ?>" />
        </div>
      </div>

	    <?php $cnt++; endforeach; ?>

	  
    </div>

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-white"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

  </div>













			
  <!-- Initialize Swiper -->
  <script type="text/javascript">
    var swiper = new Swiper('.swiper', {
      zoom: true,
      slidesPerView: 1,
      spaceBetween: 30,

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    //   autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    //   },
      keyboard: {
        enabled: true,
      },
      loop: true,
      
    });
  </script>

  <!-- Demo styles -->
  <style>
    html,
    body {
      position: relative;
      height: 100%;
    }

    /* body {
      background: #000;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: rgb(218, 218, 218);
      margin: 0;
      padding: 0;
    } */

    .swiper {
      width: 100%;
      height: 100%;

	  background: #000;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: rgb(218, 218, 218);
      margin: 0;
      padding: 0;
    }

    .swiper-slide {
      overflow: hidden;
    }

  </style>
</body>

</html>