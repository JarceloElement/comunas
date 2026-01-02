<?php
$user = ParroquiaData::getById2($_GET["id"]);
$estado = EstadoData::getAll();

?>


<div class="row">
    <div class="card">

        <div class="card-header" data-background-color="blue">
            <h4 class="title">Editar parroquia <?php echo $user->parroquia; ?></h4>
        </div>


        <div class="card-content ">

            <form class="form-horizontal" method="post" action="index.php?view=updateparroquia" role="form">

                <input type="hidden" name="id_parroquia" value="<?php echo $_GET["id"]; ?>">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inputEmail1" class="control-label"><i class="fa fa-newspaper-o"></i> Nombre*</label>
                        <input type="text" name="name" value="<?php echo $user->parroquia; ?>" class="form-control" id="name" placeholder="Nombre" required>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado" class="control-label"><i class="fa fa-map"></i> Estado*</label>
                        <select name="estado" class="form-control" id="estados_1" required>
                            <option value="">-- ESTADO --</option>
                            <?php foreach ($estado as $p): ?>
                                <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group" id='recargar_munic'>
                        <label for="municipio" class=" control-label"><i class="fa fa-map-marker"></i> Municipio*</label>
                        <select name="municipio" class="form-control" id="municipios_1" required>
                            <option value="">-- MUNICIPIO --</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Guardar cambios</button>
                    </div>
                </div>

            </form>
        </div>


    </div>
</div>

<script language="javascript">
    $(document).ready(function() {

        $("#estados_1").change(function() {
            $('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');

            $("#estados_1 option:selected").each(function() {
                id_estado = $(this).val();


                $.post("core/app/view/getMunicipio.php", {
                    id_estado: id_estado
                }, function(data) {
                    $("#municipios_1").html(data);
                });
            });
        })
    });
</script>