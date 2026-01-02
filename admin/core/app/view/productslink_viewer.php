
<?php
	require ('../../../core/controller/Database_admin.php');
    $db = Database::connectPDO();

$id = $_POST['id'];

$statement_1 = $db->query("SELECT web_link FROM products_list WHERE id_activity = '$id' ");
$res = $statement_1->fetchAll();




// if(isset($res)){
// 	foreach ($res as $i){
// 		// $image = $i['image'];
// 		// $link = explode(", ",$i['web_link']);
// 		$datas = $i['web_link'];
// 	}
// }
// $link = explode(", ",$datas);

?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Archivo CSS para Swiper JS -->
        <!-- <link rel="stylesheet" type="text/css" href="assets/plugins/swiper/node_modules/swiper/swiper-bundle.css"> -->
        <!-- Archivo Javascript para Swiper JS -->
        <!-- <script type="text/javascript" src="assets/plugins/swiper/node_modules/swiper/swiper-bundle.js"></script> -->
        <!-- <script type="text/javascript" src="assets/plugins/swiper/node_modules/swiper/swiper-bundle.esm.js"></script> -->
    </head>


    <body>

        <div class="card">
            <div class="card-content table-responsive">
                <table id="table" class="table table-bordered table-hover">
                
                    <!-- TITULOS -->
                    <thead>
                        <th>Enlaces</th>
                    </thead>

                    <tr>

                        <td>
                            <!-- CARGA LOS ENLACES -->
                            <?php foreach ($res as $i){ ?>
                                <?php $datas = $i['web_link']; ?>
                                <?php $link = explode(",",$datas); ?>
                                
                                <?php foreach($link as $data):?>
                                    <?php $linkPath  = $data;?>
                                    <a href="<?php echo $linkPath ?>" target="_blank" class=" btn btn-info btn-xs"><i class="fa fa-globe" ></i> </a>
                                    
                                    <!-- buscar la RRSS X y reemplazar para embeber -->
                                    <!-- <!?php if(str_contains($linkPath,"x.com")){?>
                                        <!?php $linkPath = str_replace("x.com","twitter.com",$linkPath) ?>
                                        <center>
                                        <div class="col-md-8">
                                            <blockquote class="twitter-tweet"><p lang="es" dir="ltr"></p><a href="<!?php echo $linkPath;?>?ref_src=twsrc%5Etfw">Cargando vista de X...</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                        </div>
                                        </center>
                                    <!?php } ?> -->

                                <?php endforeach; ?>

                            <?php } ?>

                        </td>

                    </tr>

                </table>
                <br>
                <!-- https://twitter.com/YAR21Lpi/status/1796277904189341948 -->
            </div>
        </div class="card">


    </body>

</html>