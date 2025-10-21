<?php

$estado = EstadoData::getAll();


?>


<div class="row">
    <div class="card">
        
        <div class="card-header" data-background-color="blue">
            <h4 class="title">Agregar municipio</h4>
        </div>


        <div class="card-content table-responsive">
        
            <form class="form-horizontal" role="form" method="post" action="./?action=addmunicipio">

                <div class="form-group">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><i class="fa fa-map"></i> Nombre*</label>
                            <input type="text" name="name" value="" class="form-control" id="name" placeholder="Municipio" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label"><i class="fa fa-map"></i> Estado*</label>
                            <select name="id_estado" class="form-control" id="id_estado" required>
                                <option value="">-- ESTADO --</option>
                            
                                <?php foreach($estado as $p):?>
                                    <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Agregar municipio</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

        
</div>