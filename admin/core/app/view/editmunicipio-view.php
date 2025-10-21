<?php
$user = MunicipioData::getById2($_GET["id"]);
$estado = EstadoData::getAll();


?>


<div class="row">
    <div class="card">
        
        <div class="card-header" data-background-color="blue">
            <h4 class="title">Editar municipio <?php echo $user->municipio;?></h4>
        </div>


        <div class="card-content table-responsive">
        
            <form class="form-horizontal" method="post" action="index.php?view=updatemunicipio" role="form">

                <input type="hidden" name="id_municipio" value="<?php echo $_GET["id"];?>">

                <div class="form-group">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><i class="fa fa-newspaper-o"></i> Nombre*</label>
                            <input type="text" name="name" value="<?php echo $user->municipio;?>" class="form-control" id="name" placeholder="Municipio">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><i class="fa fa-map"></i> Estado*</label>
                            <select name="estado" class="form-control" id="estado" required>
                                <option value="<?php echo $user->id_estado;?>"><?php echo EstadoData::getNameById($user->id_estado);?></option>
                            
                                <?php foreach($estado as $p):?>
                                    <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Guardar cambios</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

        
</div>