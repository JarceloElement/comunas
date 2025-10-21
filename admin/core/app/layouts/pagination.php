
<div class="card-content table-responsive">



    <center>

    <?php

    /*Sector de Paginacion */

    //Operacion matematica para boton siguiente y atras 
    $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
    $DecrementNum =(($compag -1))<1?1:($compag -1);

    echo $url_pag.$DecrementNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-left\"></i> </a>";

    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
    $Desde=$compag-(ceil($CantidadMostrar/2)-1);
    $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
        
    //Se valida
    $Desde=($Desde<1)?1: $Desde;
    $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
    //Se muestra los numeros de paginas
    for($i=$Desde; $i<=$Hasta;$i++){
        //Se valida la paginacion total
        //de registros
        if($i<=$TotalRegistro){
            //Validamos la pag activo
            if($i==$compag){
                echo $url_pag.$i."\" class=\"btn btn-primary btn-sm\"active\">".$i."  </a>";
            }else {
                echo $url_pag.$i."\" class=\"btn btn-info btn-sm\">".$i."  </a>";
            }     		
        }
    }
        
    // echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";
    echo $url_pag.$IncrimentNum."\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


    ?>

    </center>


</div class="card-content table-responsive">















