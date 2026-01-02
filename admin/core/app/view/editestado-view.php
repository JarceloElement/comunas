
<?php $user = EstadoData::getById2($_GET["id"]);?>


<div class="row">
    <div class="card">
        
        <div class="card-header" data-background-color="blue">
            <h4 class="title">Editar estado <?php echo $user->estado;?></h4>
        </div>


        <div class="card-content table-responsive">
        
          <form class="form-horizontal" method="post" action="index.php?view=updateestado" role="form">
              <input type="hidden" name="id_estado" value="<?php echo $user->id_estado;?>">

              <div class="form-group">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><i class="fa fa-newspaper-o"></i> Nombre*</label>
                        <input type="text" name="estado" value="<?php echo $user->estado;?>" class="form-control" id="estado" placeholder="Estado">
                      </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label class="control-label"><i class="fa fa-list-alt"></i> Código*</label>
                      <input type="text" name="iso" value="<?php echo $user->iso;?>" required class="form-control" id="iso" placeholder="Código">
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