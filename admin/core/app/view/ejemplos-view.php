<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
  
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    
    <div class="row">




<!-- 
        <div class="content-wrapper">
                <div class="section section1"></div>
                <div class="section section2"></div>
                <div class="section section3"></div>
                <div class="section section4"></div>
                <a class="scrolltop">Scroll top</a>
                </div>

 -->


 <?php

//  verificar las librerias de mysql
 if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
   echo 'Debes instalar mysqli!!!';
 } else {
   echo '¡Todo está bien!';
 }



require('assets/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>





</div>

<footer class="footer bg-dark">
    <div class="container">
        <span class="text-muted"><a href="https://www.jose-aguilar.com/">&copy; Jose Aguilar</a></span>
    </div>
</footer>
</body>
</html>



<script>

$(".scrolltop").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });

</script>



<style>
  .section{
   height:400px;
  }
  .section1{
    background-color: #333;
  }
  .section2{
    background-color: red;
  }
  .section3{
    background-color: yellow;
  }
  .section4{
    background-color: green;
  }
  .scrolltop{
    position:fixed;
    right:10px;
    bottom:10px;
    color:#fff;
  }

</style>