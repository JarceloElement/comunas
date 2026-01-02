<div class="row">
    <div class="col-md-12">

        <div class="card text-center">
            <div class="card-header card-header-rose">
                <h4 class="title text-left">Ciudades</h4>
            </div>
            <div class="card-body">
                <a href="./index.php?view=newciudad" id="create-state-btn" class="btn btn-primary text-white">Nueva ciudad</a>
            </div>

        </div>


        <div class="btn-group pull-right">
            <!--<div class="btn-group pull-right">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-download"></i> Descargar <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
			</ul>
		</div>
		-->
        </div>


        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Ciudades</h4>
            </div>

            <div class="card-content table-responsive">
                <!-- <a href="index.php?view=newestado" class="btn btn-default"><i class='fa fa-male'></i> Nuevo estado</a> -->


                <?php
                $users = CiudadData::getAll();
                if (count($users) > 0) {
                    // si hay usuarios
                ?>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <th><i class="fa fa-map" style="color:gray"></i> Estado</th>
                            <th><i class="fa fa-map" style="color:gray"></i> Ciudad</th>
                            <!-- <th><i class="fa fa-home" style="color:gray"></i> Infocentros</th> -->
                            <th></th>
                        </thead>

                        <?php
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <td><?php echo EstadoData::getNameById($user->id_estado); ?></td>
                                <td><?php echo $user->ciudad; ?></td>
                                <td style="width:280px;">
                                    <a href="index.php?view=editciudad&id=<?php echo $user->id_ciudad; ?>&id_estado=<?php echo $user->id_estado; ?>" class="btn btn-warning btn-xs">Editar</a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </table>



                <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay registros</p>";
                }
                ?>

            </div class="card-content table-responsive">

        </div>
    </div>