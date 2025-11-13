<!-- <script src="../../../assets/js/jquery-3.1.1.min.js"></script> -->

<script language="javascript">
    $(document).ready(function() {

        $('#add_submit').click(async function(event) {

            event.preventDefault();

            let url = "./?action=ajax";

            var formData = new FormData(document.getElementById("add_org"));
            formData.append('function', 'edit_organizacion'); // Agrega la función a llamar
            // console.log(formData);

            $('#cover-spin').show(0);

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    body: formData
                });

                if (res.ok) {
                    // console.log(res);
                    const result_await = await res.text();
                    var array = JSON.parse(result_await);
                    // console.log(array);
                    toastify(array.alert, true, 13000, array.alert_type);
                    $('#cover-spin').hide(0);
                    if (array.error == "false") {
                        window.timer = setTimeout(function() {
                            history.back();
                        }, 400);
                    }


                } else {
                    $('#cover-spin').hide(0);
                    toastify(res.statusText, true, 12000, "error");
                    throw res.statusText;
                }

            } catch (error) {
                $('#cover-spin').hide(0);
                toastify(error, true, 12000, "error");
                throw error;
            }


        });
    });
</script>


<div id="cover-spin"></div>

<?php $line = OrganizacionesData::getByIdPg($_GET["id"]); ?>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="panel-heading">
                            <h4 class="title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Organización </b> </span>
                                </a>
                            </h4>
                        </div>

                        <br>

                        <form method="post" id="add_org" role="form">
                            <input type="hidden" name="id" id="id" value="<?php echo $line->id; ?>"></input>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="code_info" class="control-label">Código info</label>
                                        <input type="text" name="code_info" id="code_info" value="<?php echo $line->code_info; ?>" required class="form-control" placeholder="Nombre">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="codigo_organizacion" class="control-label">Código organización</label>
                                        <input type="text" name="codigo_organizacion" id="codigo_organizacion" value="<?php echo $line->codigo_organizacion; ?>" required class="form-control" placeholder="Nombre">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_organizacion" class="control-label">Nombre organización</label>
                                        <input type="text" name="nombre_organizacion" id="codigo_organizacion" value="<?php echo $line->nombre_organizacion; ?>" required class="form-control" placeholder="Nombre">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" id="add_submit" class="btn btn-primary btn-block">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>


            </div>
        </div>
    </div>
</div>