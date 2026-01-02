<?php
$estado1 = EstadoData::getById2($_GET["id_estado"]);
$ciudad = CiudadData::getById2($_GET["id"]);
$estado = EstadoData::getAll();
?>

<div class="row">
    <div class="card">

        <div class="card-header" data-background-color="blue">
            <h4 class="title">Editar ciudad</h4>
        </div>
        <h4 class="title">Editar ciudad</h4>

        <div class="card-content ">
            <br>

            <form class="form-horizontal" role="form" method="post" action="./?action=updateciudad">
                <input type="hidden" name="id_ciudad" value="<?php echo $ciudad->id_ciudad; ?>">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ciudad" class="control-label"><i class="fa fa-map"></i> Nombre*</label>
                        <input type="text" name="ciudad" value="<?php echo $ciudad->ciudad; ?>" class="form-control" id="ciudad" placeholder="Ciudad" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_estado" class="control-label"><i class="fa fa-map"></i> Estado*</label>
                        <select name="id_estado" class="form-control" id="id_estado" required>
                            <option value="<?php echo $estado1->id_estado; ?>"><?php echo $estado1->estado; ?></option>
                            <?php foreach ($estado as $p): ?>
                                <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="capital" class="control-label"><i class="fa fa-map"></i> Es capital*</label>
                        <select name="capital" class="form-control" id="capital" required>
                            <option value="">-- SELECCIONE --</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Agregar ciudad</button>
                    </div>
                </div>

            </form>
        </div>


    </div>
</div>




<script language="javascript">
    // $(document).ready(function(){

    // 	$("#estados1").change(function () {

    // 		$('#municimunicipiopios').find('option').remove().end().append('<option value=""></option>').val('0');

    // 		$("#estados1 option:selected").each(function () {
    // 			id_estado = $(this).val();

    // 		// alert(id_estado);
    // 		// alert($("#municipios").val());

    // 			$.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
    // 			$("#municipio1").html(data);
    // 			});  

    // 		});
    // 	})
    // });
</script>