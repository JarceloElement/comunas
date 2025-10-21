<?php

$estado = EstadoData::getAll();

?>


<div class="row">
    <div class="card">
        
        <div class="card-header" data-background-color="blue">
            <h4 class="title">Agregar parroquia</h4>
        </div>


        <div class="card-content ">
            
            <form class="form-horizontal" role="form" method="post" action="./?action=addparroquia">

                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputEmail1" class="control-label"><i class="fa fa-map"></i> Nombre*</label>
                        <input type="text" name="name" value="" class="form-control" id="name" placeholder="Parroquia" required>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                    <label for="estado" class="control-label"><i class="fa fa-map"></i> Estado*</label>
                        <select name="estado" class="form-control" id="estados1" required>
                            <option value="">-- ESTADO --</option>
                            <?php foreach($estado as $p):?>
                                <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group" id='recargar_munic'>
                        <label for="municipio" class=" control-label"><i class="fa fa-map"></i> Municipio*</label>
                        <select name="municipio" class="form-control" id="municipio1" required>
                            <option value="">-- MUNICIPIO --</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Agregar parroquia</button>
                    </div>
                </div>

            </form>
        </div>


    </div>
</div>




<!-- <script src="../../../assets/js/jquery.min.js"></script> -->

		<script language="javascript">
			$(document).ready(function(){
                
				$("#estados1").change(function () {

					$('#municimunicipiopios').find('option').remove().end().append('<option value=""></option>').val('0');
					
					$("#estados1 option:selected").each(function () {
						id_estado = $(this).val();
					
					// alert(id_estado);
					// alert($("#municipios").val());
            
						$.post("core/app/view/getMunicipio.php", { id_estado: id_estado }, function(data){
						$("#municipio1").html(data);
						});  
						         
					});
				})
			});








            </script>