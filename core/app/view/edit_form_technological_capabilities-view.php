<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$document_number = $_SESSION['user_dni'];
$user = PersonalCapabilitiesData::getRepeatedPg($document_number);

if ($user == 'null') {
    print "<script>window.location='index.php?view=form_technological_capabilities';</script>";
}

$user_training_needs = $user->user_training_needs;
$user_potential_contribution_for_areas_pnct = $user->user_potential_contribution_for_areas_pnct;
$user_potential_contribution_for_pni_infocentro = $user->user_potential_contribution_for_pni_infocentro;



?>

<script>
    var num = 0;


    $(document).ready(function() {

        // las func estan en demo.js
        if (getOS() == "Android") {
            get_Name = getOS() + "|" + getBrowser();
            $("#user_name_os").val(get_Name);
        } else {
            get_Name = getOS() + "|" + getBrowser();
            $("#user_name_os").val(get_Name);
        }


        // alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
        // toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
        // toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000); // [message, autohide]
        // setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);

        // alertas
        <?php if (isset($_SESSION["alert"]) && $_SESSION["alert"] != ""): ?>
            if (getOS() == "Android") {
                alert('<?php echo $_SESSION["alert"]; ?>');
            } else {
                toastify('<?php echo $_SESSION["alert"]; ?>', true, 10000, "dashboard"); // [message, autohide]
            }

            <?php $_SESSION["alert"] = ""; ?>
        <?php endif; ?>

        // cambiar el parametro de alert
        const url = new URL(window.location);
        url.searchParams.set('swal', '');
        window.history.pushState({}, '', url);




        // marca los checkbox
        var user_training_needs = '<?php echo $user_training_needs; ?>';
        var selected = '';
        $('#add_capabilities input:checkbox[name="user_training_needs[]"]').each(function() {
            if (!this.checked) {
                selected = $(this)[0].id;
                value = $(this).val();
                // console.log(value);
                if (user_training_needs.split(',').includes(value)) {
                    document.getElementById(selected).checked = true;
                    // carga el total de casillas seleccionadas para limitar la seleccion
                    num += 1;
                }
            }
        });

        // user_potential_contribution_for_areas_PNCT
        var user_potential_contribution_for_areas_pnct = '<?php echo $user_potential_contribution_for_areas_pnct; ?>';
        var selected = '';
        $('#add_capabilities input:checkbox[name="user_potential_contribution_for_areas_PNCT[]"]').each(function() {
            if (!this.checked) {
                selected = $(this)[0].id;
                value = $(this).val();
                // console.log(value);
                if (user_potential_contribution_for_areas_pnct.split(',').includes(value)) {
                    document.getElementById(selected).checked = true;
                }
            }
        });

        // user_potential_contribution_for_pni_infocentro
        var user_potential_contribution_for_pni_infocentro = '<?php echo $user_potential_contribution_for_pni_infocentro; ?>';
        var selected = '';
        $('#add_capabilities input:checkbox[name="user_potential_contribution_for_PNI_infocentro[]"]').each(function() {
            if (!this.checked) {
                selected = $(this)[0].id;
                value = $(this).val();
                // console.log(value);
                if (user_potential_contribution_for_pni_infocentro.split(',').includes(value)) {
                    document.getElementById(selected).checked = true;
                }
            }
        });
        // console.log(user_potential_contribution_for_pni_infocentro.split(','));







    })



    // limita las opciones a seleccionar

    function formacion(form, obj) {
        limite = 4;
        if (obj.checked && num < limite) {
            num++;
        }
        if (!obj.checked) {
            num--;
        }
        if (num === limite) {
            obj.checked = false;
            num--;
        }

    }




    // VALIDAR FORMULARIO
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("add_capabilities").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(evento) {
        evento.preventDefault();

        var user_state = document.getElementById('user_state').value;

        if (user_state === "") {
            if (getOS() == "Android") {
                alert("No pudimos cargar el estado del infocentro.\nPor favor vuelve a escribir el código de infocentro para validar nuevamente.\n Si persiste solicita editar la dirección de tu infocentro");
            } else {
                toastify('No pudimos cargar el estado del infocentro.\nPor favor vuelve a escribir el código de infocentro para validar nuevamente.\n Si persiste solicita editar la dirección de tu infocentro', true, 10000, "warning");
            }
            return;
        }




        this.submit();


    }
</script>


<?php $user_id = $_SESSION['user_id']; ?>


<!-- FORM -->
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-2">
                <div class="mui-container-fluid">
                    <!-- <div class="row justify-content-center"><span class="material-icons md-48 orange600">&#xe7fe;</span></div>     -->


                    <div class="col-md-10">
                        <div class="row justify-content-center" material-icons.md-36> <span class="material-icons md-48 orange600">app_registration</span></div>
                        <div class="row justify-content-center">
                            <h6 class="title">Encuesta sobre habilidades tecnológicas</h6>
                        </div>
                    </div>

                    <form id="add_capabilities" accept-charset="UTF-8" class="form-horizontal" method="post" action="index.php?action=capabilities&function=update" role="form">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="personal_type" id="personal_type" value="<?php echo $user->personal_type; ?>">
                        <input type="hidden" name="user_name_os" id="user_name_os" value="<?php echo $user->user_name_os; ?>">
                        <input type="hidden" name="user_state" id="user_state" value="<?php echo $user->user_state; ?>">
                        <input type="hidden" name="user_municipality" id="user_municipality" value="<?php echo $user->user_municipality; ?>">
                        <input type="hidden" name="user_parish" id="user_parish" value="<?php echo $user->user_parish; ?>">
                        <input type="hidden" name="user_zone_type" id="user_zone_type" value="<?php echo $user->user_zone_type; ?>">
                        <input type="hidden" name="birthdate" id="birthdate" value="<?php echo $user->birthdate; ?>">


                        <fieldset>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-center btn-link">
                                            <h6 class="title">DATOS DEL INFOCENTRO</h6>
                                        </div>
                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                            <!-- <label for="communes_quantity">Total</label> -->
                                            <!-- <input type="text" value="<!?php echo $socialmap->code_info; ?>" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="code_info" placeholder="Ejemplo: AMA000"> -->
                                            <input required type="text" value="<?php echo $user->code_info; ?>" name="code_info" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="code_info" placeholder="Código infocentro">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Código info: Debe ser colocado de la siguiente manera (AMA000). De ser trabajador del piso 11 de la torre MINCyT y no tiene un código colocar (SEDE)<span style="color:red; font-size:large;"> *</span></small>

                                        </div>

                                        <div class="form-group floating-label floating-label form-ripple">
                                            <input required type="text" value="<?php echo $user->info_name; ?>" name="info_name" id="info_name" placeholder="Nombre del infocentro" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Nombre del Infocentro<span style="color:red; font-size:large;"> *</span></small>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <select required class="custom-select mr-sm-2" name="user_type" id="user_type">
                                            <option selected value="<?php echo $user->user_type; ?>"><?php echo $user->user_type; ?></option>
                                            <option value="Facilitador">Facilitador</option>
                                            <option value="Coordinador">Coordinador</option>
                                            <option value="Jefe de Estado">Jefe de Estado</option>
                                            <option value="Gerente">Gerente</option>
                                        </select>
                                        <small id="exampleFloatingLabel6Help" class="form-text">Tipo de personal<span style="color:red; font-size:large;"> *</span></small>
                                    </div>
                                </div>
                            </div>


                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-center btn-link">
                                            <h6 class="title">DATOS PERSONALES</h6>
                                        </div>

                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <div class="form-group floating-label floating-label-lg form-ripple">
                                            <input required type="text" value="<?php echo $user->user_dni; ?>" name="user_dni" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" id="user_dni" minlength="6" maxlength="8" placeholder="20123456" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Documento de identidad<span style="color:red; font-size:large;"> *</span></small>
                                        </div>

                                        <div class="form-group floating-label floating-label form-ripple">
                                            <input required type="text" value="<?php echo $user->user_name; ?>" name="user_name" id="user_name" placeholder="Nombres" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Nombres del encuestado/a<span style="color:red; font-size:large;"> *</span></small>
                                        </div>

                                        <div class="form-group floating-label floating-label form-ripple">
                                            <input required type="text" value="<?php echo $user->user_lastname; ?>" name="user_lastname" id="user_lastname" placeholder="Apellidos" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Apellidos del encuestado/a<span style="color:red; font-size:large;"> *</span></small>
                                        </div>

                                        <div class="form-group floating-label floating-label form-ripple">
                                            <input required type="email" value="<?php echo $user->user_email; ?>" name="user_email" id="user_email" placeholder="micorreo@email.com" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Correo del encuestado/a<span style="color:red; font-size:large;"> *</span></small>
                                        </div>

                                        <div class="form-group floating-label floating-label form-ripple">
                                            <input type="tel" value="<?php echo $user->user_phone; ?>" name="user_phone" id="user_phone" placeholder="04xx1234567" aria-describedby="exampleFloatingLabel6Help" data="field" class="form-control" maxlength="12" pattern="[0-9]{4}-[0-9]{7}">
                                            <small id="exampleFloatingLabel6Help" class="form-text">Teléfono del encuestado/a</small>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-center btn-link">
                                            <h6 class="title">
                                                HABILIDADES TECNOLÓGICAS
                                            </h6>
                                        </div>

                                        <br>
                                        <br>

                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_blender_user_skills-1" name="user_blender_user_skills" <?php echo $user->user_blender_user_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_blender_user_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_blender_user_skills-2" name="user_blender_user_skills" <?php echo $user->user_blender_user_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_blender_user_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Blender?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_python_user_skills-1" name="user_python_user_skills" <?php echo $user->user_python_user_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_python_user_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_python_user_skills-2" name="user_python_user_skills" <?php echo $user->user_python_user_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_python_user_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Phyton?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_stop_motion_skills-1" name="user_stop_motion_skills" <?php echo $user->user_stop_motion_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_stop_motion_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_stop_motion_skills-2" name="user_stop_motion_skills" <?php echo $user->user_stop_motion_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_stop_motion_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Stop Motion?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_web_design_skills-1" name="user_web_design_skills" <?php echo $user->user_web_design_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_web_design_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_web_design_skills-2" name="user_web_design_skills" <?php echo $user->user_web_design_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_web_design_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Páginas Web?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_wordpress_skills-1" name="user_wordpress_skills" <?php echo $user->user_wordpress_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_wordpress_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_wordpress_skills-2" name="user_wordpress_skills" <?php echo $user->user_wordpress_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_wordpress_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Wordpress?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_html_skills-1" name="user_html_skills" <?php echo $user->user_html_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_html_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_html_skills-2" name="user_html_skills" <?php echo $user->user_html_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_html_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Htlm?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_PHP_skills-1" name="user_PHP_skills" <?php echo $user->user_php_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_PHP_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_PHP_skills-2" name="user_PHP_skills" <?php echo $user->user_php_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_PHP_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Php?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_blog_design_skills-1" name="user_blog_design_skills" <?php echo $user->user_blog_design_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_blog_design_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_blog_design_skills-2" name="user_blog_design_skills" <?php echo $user->user_blog_design_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_blog_design_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Blogs?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_digital_magazine_skills-1" name="user_digital_magazine_skills" <?php echo $user->user_digital_magazine_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_digital_magazine_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_digital_magazine_skills-2" name="user_digital_magazine_skills" <?php echo $user->user_digital_magazine_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_digital_magazine_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Revista Digital?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_digital_economy_skills-1" name="user_digital_economy_skills" <?php echo $user->user_digital_economy_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_digital_economy_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_digital_economy_skills-2" name="user_digital_economy_skills" <?php echo $user->user_digital_economy_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_digital_economy_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Economía Digital?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_crypto_assets_skills-1" name="user_crypto_assets_skills" <?php echo $user->user_crypto_assets_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_crypto_assets_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_crypto_assets_skills-2" name="user_crypto_assets_skills" <?php echo $user->user_crypto_assets_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_crypto_assets_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Criptoactivos?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_e_bank_patria_skills-1" name="user_e_bank_patria_skills" <?php echo $user->user_e_bank_patria_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_e_bank_patria_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_e_bank_patria_skills-2" name="user_e_bank_patria_skills" <?php echo $user->user_e_bank_patria_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_e_bank_patria_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Banca Electrónica y Sistema Patria?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_e_commerce_skills-1" name="user_e_commerce_skills" <?php echo $user->user_e_commerce_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_e_commerce_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_e_commerce_skills-2" name="user_e_commerce_skills" <?php echo $user->user_e_commerce_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_e_commerce_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el manejo de Diseño de Comercio Digital?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_use_movile_devices_skills-1" name="user_use_movile_devices_skills" <?php echo $user->user_use_movile_devices_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_use_movile_devices_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_use_movile_devices_skills-2" name="user_use_movile_devices_skills" <?php echo $user->user_use_movile_devices_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_use_movile_devices_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el Uso Básico de Dispositivos Móviles?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_technical_support_computers_devices_skills-1" name="user_technical_support_computers_devices_skills" <?php echo $user->user_technical_support_computers_devices_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_technical_support_computers_devices_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_technical_support_computers_devices_skills-2" name="user_technical_support_computers_devices_skills" <?php echo $user->user_technical_support_computers_devices_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_technical_support_computers_devices_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el Soporte Técnico Computadoras?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_technical_support_movile_devices_skills-1" name="user_technical_support_movile_devices_skills" <?php echo $user->user_technical_support_movile_devices_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_technical_support_movile_devices_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_technical_support_movile_devices_skills-2" name="user_technical_support_movile_devices_skills" <?php echo $user->user_technical_support_movile_devices_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_technical_support_movile_devices_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el Soporte Técnico de Dispositivos Móviles?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_network_technical_support_skills-1" name="user_network_technical_support_skills" <?php echo $user->user_network_technical_support_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_network_technical_support_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_network_technical_support_skills-2" name="user_network_technical_support_skills" <?php echo $user->user_network_technical_support_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_network_technical_support_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Instalación y Soporte Técnico de Redes?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_social_media_management_skills-1" name="user_social_media_management_skills" <?php echo $user->user_social_media_management_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_social_media_management_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_social_media_management_skills-2" name="user_social_media_management_skills" <?php echo $user->user_social_media_management_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_social_media_management_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el Uso y manejo de las RRSS?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_social_media_security_skills-1" name="user_social_media_security_skills" <?php echo $user->user_social_media_security_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_social_media_security_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_social_media_security_skills-2" name="user_social_media_security_skills" <?php echo $user->user_social_media_security_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_social_media_security_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Seguridad en las redes sociales?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_imagen_design_skills-1" name="user_imagen_design_skills" <?php echo $user->user_imagen_design_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_imagen_design_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_imagen_design_skills-2" name="user_imagen_design_skills" <?php echo $user->user_imagen_design_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_imagen_design_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Diseño y manejo de imágenes?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_mobile_video_editing_skills-1" name="user_mobile_video_editing_skills" <?php echo $user->user_mobile_video_editing_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_mobile_video_editing_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_mobile_video_editing_skills-2" name="user_mobile_video_editing_skills" <?php echo $user->user_mobile_video_editing_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_mobile_video_editing_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Edición de videos en dispositivos móviles?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_remote_communication_skills-1" name="user_remote_communication_skills" <?php echo $user->user_remote_communication_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_remote_communication_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_remote_communication_skills-2" name="user_remote_communication_skills" <?php echo $user->user_remote_communication_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_remote_communication_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Uso de las diversas plataformas de comunicación a distancia?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_libre_office_applications_skills-1" name="user_libre_office_applications_skills" <?php echo $user->user_libre_office_applications_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_libre_office_applications_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_libre_office_applications_skills-2" name="user_libre_office_applications_skills" <?php echo $user->user_libre_office_applications_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_libre_office_applications_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Uso de Aplicaciones de Libre Office?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_meme_creations_skills-1" name="user_meme_creations_skills" <?php echo $user->user_meme_creations_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_meme_creations_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_meme_creations_skills-2" name="user_meme_creations_skills" <?php echo $user->user_meme_creations_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_meme_creations_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Manipulación de Imágenes? (Creación de memes)
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_presentations_creations_skills-1" name="user_presentations_creations_skills" <?php echo $user->user_presentations_creations_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_presentations_creations_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_presentations_creations_skills-2" name="user_presentations_creations_skills" <?php echo $user->user_presentations_creations_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_presentations_creations_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en creación y preparación de Presentaciones?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_accounting_books_skills-1" name="user_accounting_books_skills" <?php echo $user->user_accounting_books_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_accounting_books_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_accounting_books_skills-2" name="user_accounting_books_skills" <?php echo $user->user_accounting_books_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_accounting_books_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Cómo llevar un libro contable?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_budget_cration_skills-1" name="user_budget_cration_skills" <?php echo $user->user_budget_cration_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_budget_cration_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_budget_cration_skills-2" name="user_budget_cration_skills" <?php echo $user->user_budget_cration_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_budget_cration_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Elaborar un presupuesto?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_strategic_planning_skills-1" name="user_strategic_planning_skills" <?php echo $user->user_strategic_planning_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_strategic_planning_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_strategic_planning_skills-2" name="user_strategic_planning_skills" <?php echo $user->user_strategic_planning_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_strategic_planning_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Planificación estratégica?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_project_elaboration_skills-1" name="user_project_elaboration_skills" <?php echo $user->user_project_elaboration_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_project_elaboration_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_project_elaboration_skills-2" name="user_project_elaboration_skills" <?php echo $user->user_project_elaboration_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_project_elaboration_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Elaboración de Proyectos?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_collective_diagnosis_skills-1" name="user_collective_diagnosis_skills" <?php echo $user->user_collective_diagnosis_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_collective_diagnosis_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_collective_diagnosis_skills-2" name="user_collective_diagnosis_skills" <?php echo $user->user_collective_diagnosis_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_collective_diagnosis_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en elaboración de un Diagnostico Colectivo?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_situational_analysis_tecniques_skills-1" name="user_situational_analysis_tecniques_skills" <?php echo $user->user_situational_analysis_tecniques_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_situational_analysis_tecniques_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_situational_analysis_tecniques_skills-2" name="user_situational_analysis_tecniques_skills" <?php echo $user->user_situational_analysis_tecniques_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_situational_analysis_tecniques_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Técnicas para Construir Análisis Situacional?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_systematization_community_experiences_skills-1" name="user_systematization_community_experiences_skills" <?php echo $user->user_systematization_community_experiences_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_systematization_community_experiences_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_systematization_community_experiences_skills-2" name="user_systematization_community_experiences_skills" <?php echo $user->user_systematization_community_experiences_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_systematization_community_experiences_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en Sistematización de Experiencias Comunitarias?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_content_assertive_organizational_communication_skills-1" name="user_content_assertive_organizational_communication_skills" <?php echo $user->user_content_assertive_organizational_communication_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_content_assertive_organizational_communication_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_content_assertive_organizational_communication_skills-2" name="user_content_assertive_organizational_communication_skills" <?php echo $user->user_content_assertive_organizational_communication_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_content_assertive_organizational_communication_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en contenidos sobre Comunicación asertiva y organizacional?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_robotics_skills-1" name="user_robotics_skills" <?php echo $user->user_robotics_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_robotics_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_robotics_skills-2" name="user_robotics_skills" <?php echo $user->user_robotics_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_robotics_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el área de robótica?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_artificial_intelligence_skills-1" name="user_artificial_intelligence_skills" <?php echo $user->user_artificial_intelligence_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_artificial_intelligence_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_artificial_intelligence_skills-2" name="user_artificial_intelligence_skills" <?php echo $user->user_artificial_intelligence_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_artificial_intelligence_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el área de inteligencia artificial?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_programming_skills-1" name="user_programming_skills" <?php echo $user->user_programming_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_programming_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_programming_skills-2" name="user_programming_skills" <?php echo $user->user_programming_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_programming_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tenes habilidades en el área de programación?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_application_creation_skills-1" name="user_application_creation_skills" <?php echo $user->user_application_creation_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_application_creation_skills-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_application_creation_skills-2" name="user_application_creation_skills" <?php echo $user->user_application_creation_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_application_creation_skills-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes habilidades en el área de creación de aplicaciones?
                                            <span style="color:red; font-size:large;"> *</span>
                                        </small>

                                        <br>
                                        <br>
                                        <div class="col">
                                            <div class="card text border-primary mb-3">
                                                <div class="card-body">
                                                    <small id="exampleFloatingLabel6Help" class="form-text">
                                                        <label style="color:#009dfb;font-size:16px;">NUEVO</label> De todas las áreas seleccionadas, en cual tiene mayor habilidad (selecciona)
                                                        <span style="color:red; font-size:large;"> *</span>
                                                    </small>
                                                    <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                                    <select required class="custom-select mr-sm-2" name="user_greater_technological_skill" id="user_greater_technological_skill">
                                                        <option selected value="<?php echo $user->user_greater_technological_skill; ?>"><?php echo $user->user_greater_technological_skill; ?></option>
                                                        <option value="Blender">Blender</option>
                                                        <option value="Phyton">Phyton</option>
                                                        <option value="Stop Motion">Stop Motion</option>
                                                        <option value="Diseño de Páginas Web">Diseño de Páginas Web</option>
                                                        <option value="Diseño en Wordpress">Diseño en Wordpress</option>
                                                        <option value="Diseño de Htlm">Diseño de Htlm</option>
                                                        <option value="Diseño de Php">Diseño de Php</option>
                                                        <option value="Diseño de Blogs">Diseño de Blogs</option>
                                                        <option value="Diseño de Revista Digital">Diseño de Revista Digital</option>
                                                        <option value="Diseño de Economía Digital">Diseño de Economía Digital</option>
                                                        <option value="Diseño de Criptoactivos">Diseño de Criptoactivos</option>
                                                        <option value="Diseño de Banca Electrónica y Sistema Patria">Diseño de Banca Electrónica y Sistema Patria</option>
                                                        <option value="Diseño de Comercio Digital">Diseño de Comercio Digital</option>
                                                        <option value="Uso Básico de Dispositivos Móviles">Uso Básico de Dispositivos Móviles</option>
                                                        <option value="Soporte Técnico Computadoras">Soporte Técnico Computadoras</option>
                                                        <option value="Soporte Técnico de Dispositivos Móviles">Soporte Técnico de Dispositivos Móviles</option>
                                                        <option value="Instalación y Soporte Técnico de Redes">Instalación y Soporte Técnico de Redes</option>
                                                        <option value="Uso y manejo de las RRSS">Uso y manejo de las RRSS</option>
                                                        <option value="Seguridad en las redes sociales">Seguridad en las redes sociales</option>
                                                        <option value="Diseño y manejo de imágenes">Diseño y manejo de imágenes</option>
                                                        <option value="Edición de videos en dispositivos móviles">Edición de videos en dispositivos móviles</option>
                                                        <option value="Uso de las diversas plataformas de comunicación a distancia">Uso de las diversas plataformas de comunicación a distancia</option>
                                                        <option value="Uso de Aplicaciones de Libre Office">Uso de Aplicaciones de Libre Office</option>
                                                        <option value="Manipulación de Imágenes">Manipulación de Imágenes</option>
                                                        <option value="Creación y preparación de Presentaciones">Creación y preparación de Presentaciones</option>
                                                        <option value="Cómo llevar un libro contable">Cómo llevar un libro contable</option>
                                                        <option value="Elaborar un presupuesto">Elaborar un presupuesto</option>
                                                        <option value="Planificación estratégica">Planificación estratégica</option>
                                                        <option value="Elaboración de Proyectos">Elaboración de Proyectos</option>
                                                        <option value="Elaboración de un Diagnostico Colectivo">Elaboración de un Diagnostico Colectivo</option>
                                                        <option value="Técnicas para Construir Análisis Situacional">Técnicas para Construir Análisis Situacional</option>
                                                        <option value="Sistematización de Experiencias Comunitarias">Sistematización de Experiencias Comunitarias</option>
                                                        <option value="Comunicación asertiva y organizacional">Comunicación asertiva y organizacional</option>
                                                        <option value="Robótica">Robótica</option>
                                                        <option value="Inteligencia Artificial">Inteligencia artificial</option>
                                                        <option value="Programación">Programación</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="card text border-primary mb-3">
                                                <div class="card-body">
                                                    <small id="exampleFloatingLabel6Help" class="form-text">
                                                        Nivel de habilidad
                                                        <span style="color:red; font-size:large;"> *</span>
                                                    </small>
                                                    <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                                    <select required class="custom-select mr-sm-2" name="user_greater_technological_skill_level" id="user_greater_technological_skill_level">
                                                        <option selected value="<?php echo $user->user_greater_technological_skill_level; ?>"><?php echo $user->user_greater_technological_skill_level; ?></option>
                                                        <option value="Básico">Básico</option>
                                                        <option value="Intermedio">Intermedio</option>
                                                        <option value="Avanzado">Avanzado</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>






                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-center btn-link">
                                            <h6 class="title">
                                                NECESIDADES DE FORMACIÓN
                                            </h6>
                                        </div>

                                        <br>
                                        <br>

                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            Selecciona las áreas en las que deseas formación | (Máximo 3)
                                        </small>

                                        <br>


                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Robótica" id="user_training_needs-1" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-1">Robótica</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Inteligencia Artificial" id="user_training_needs-2" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-2">Inteligencia Artificial</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Electrónica" id="user_training_needs-3" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-3">Electrónica</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Soporte técnico" id="user_training_needs-4" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-4">Soporte técnico</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Programación" id="user_training_needs-5" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-5">Programación</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Gamer" id="user_training_needs-6" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-6">Desarrollo de videojuegos</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Matemáticas" id="user_training_needs-7" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-7">Matemáticas</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Física" id="user_training_needs-8" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-8">Física</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Química" id="user_training_needs-9" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-9">Química</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Biodiversidad" id="user_training_needs-10" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-10">Biodiversidad</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Ciencias del agro" id="user_training_needs-11" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-11">Ciencias del agro</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Stop motion" id="user_training_needs-12" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-12">Stop motion</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_training_needs[]" value="Programación con Python" id="user_training_needs-13" onchange="formacion('add_capabilities', this)">
                                                <label class="custom-control-label" for="user_training_needs-13">Programación con Python</label>
                                            </div>


                                        </div>

                                        <br>

                                        <div class="form-group floating-label floating-label">
                                            <small id="exampleFloatingLabel6Help" class="form-text">
                                                Otras áreas (mencione)
                                            </small>
                                            <br>
                                            <textarea data="field" name="user_other_training_needs" value="<?php echo $user->user_other_training_needs; ?>" class="form-control" id="user_other_training_needs" rows="2"><?php echo $user->user_other_training_needs; ?></textarea>
                                        </div>


                                    </div>

                                </div>
                            </div>









                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-center btn-link">
                                            <h6 class="title">
                                                PLAN NACIONAL CIENTÍFICO TECNOLÓGICO 2023-2030
                                            </h6>
                                        </div>

                                        <br>
                                        <br>
                                        <div class="row justify-content-center">
                                            <h6 class="title">PNCT del MinCYT 2023-2030</h6>
                                        </div>
                                        <br>


                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_know_PNCT_MincCYT-1" name="user_know_PNCT_MincCYT" <?php echo $user->user_blender_user_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_know_PNCT_MincCYT-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_know_PNCT_MincCYT-2" name="user_know_PNCT_MincCYT" <?php echo $user->user_blender_user_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_know_PNCT_MincCYT-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Conoces el PNCT del MinCYT 2023-2030?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <div class="card-header"></div>

                                        <br>


                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            De las siguientes áreas estratégicas del PNCT 2023-2030: ¿En cuál crees que según tus potencialidades puedas contribuir a su desarrollo?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <br>


                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Salud colectiva" id="user_potential_contribution_for_areas_PNCT-1">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-1">Salud colectiva</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Soberanía agro-alimentaria" id="user_potential_contribution_for_areas_PNCT-2">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-2">Soberanía agro-alimentaria </label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Gestión integral de los recursos hídricos" id="user_potential_contribution_for_areas_PNCT-3">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-3">Gestión integral de los recursos hídricos</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Crisis climática" id="user_potential_contribution_for_areas_PNCT-4">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-4">Crisis climática</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Sismología" id="user_potential_contribution_for_areas_PNCT-5">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-5">Sismología</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Petróleo y petroquímica" id="user_potential_contribution_for_areas_PNCT-6">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-6">Petróleo y petroquímica</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Telecomunicaciones" id="user_potential_contribution_for_areas_PNCT-7">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-7">Telecomunicaciones</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Minería y geología" id="user_potential_contribution_for_areas_PNCT-8">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-8">Minería y geología</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Transporte" id="user_potential_contribution_for_areas_PNCT-9">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-9">Transporte</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Energía eléctrica" id="user_potential_contribution_for_areas_PNCT-10">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-10">Energía eléctrica</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Desarrollo industrial" id="user_potential_contribution_for_areas_PNCT-11">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-11">Desarrollo industrial</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_areas_PNCT[]" value="Cultura / comunidad y ciencia" id="user_potential_contribution_for_areas_PNCT-12">
                                                <label class="custom-control-label" for="user_potential_contribution_for_areas_PNCT-12">Cultura, comunidad y ciencia</label>
                                            </div>



                                        </div>

                                        <div class="card-header"></div>

                                        <br>
                                        <br>
                                        <br>


                                        <div class="row justify-content-center">
                                            <h6 class="title">Plan Nacional Infocentro 2023-2030 "Comunidades TIC</h6>
                                        </div>
                                        <br>


                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_know_PNI_infocentro-1" name="user_know_PNI_infocentro" <?php echo $user->user_blender_user_skills == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="user_know_PNI_infocentro-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="user_know_PNI_infocentro-2" name="user_know_PNI_infocentro" <?php echo $user->user_blender_user_skills == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="user_know_PNI_infocentro-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            Conoces el Plan Nacional Infocentro 2023-2030 "Comunidades TIC para la Inclusión Digital"
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <div class="card-header"></div>

                                        <br>


                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            De los siguientes ejes de actuación digital del Plan Nacional Infocentro 2023-2030: ¿En cuál crees que podrías contribuir, tomando en cuenta las fortalezas y características del entorno del Infocentro?
                                            <span style="color:red; font-size:large;"> *</span></small>
                                        <br>

                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-1" value="Las niñas / niños y adolescentes en las TIC">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-1">Las niñas, niños y adolescentes en las TIC</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-2" value="Las TIC para la vida cotidiana">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-2">Las TIC para la vida cotidiana</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-3" value="Habilidades digitales para la asociatividad (presencial y virtual)">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-3">Habilidades digitales para la asociatividad (presencial y virtual)</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-4" value="Habilidades digitales para el trabajo / la empleabilidad y el emprendimiento productivo">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-4">Habilidades digitales para el trabajo / la empleabilidad y el emprendimiento productivo</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-5" value="Mujeres en las TIC">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-5">Mujeres en las TIC</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-6" value="Comunidades indígenas / campesinos y afrodescendientes en las TIC">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-6">Comunidades indígenas, campesinos y afrodescendientes en las TIC</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="user_potential_contribution_for_PNI_infocentro[]" id="user_potential_contribution_for_PNI_infocentro-7" value="Las TIC para personas en situación de vulnerabilidad digital">
                                                <label class="custom-control-label" for="user_potential_contribution_for_PNI_infocentro-7">Las TIC para personas en situación de vulnerabilidad digital</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>












                            <div class="col">
                                <div class="card text border-primary mb-3">
                                    <div class="card-body">
                                        <div class="row justify-content-center btn-link">
                                            <h6 class="title">
                                                NUEVAS TENDENCIAS EN PROCESOS FORMATIVOS
                                            </h6>
                                        </div>

                                        <br>
                                        <br>

                                        <!-- <span class="material-icons text-primary mt-2 mr-4" style="font-size: 32px;">palette</span> -->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv', '#divtext-1', this)" type="radio" id="knowledge_remote_learning-1" name="knowledge_remote_learning-radio" <?php echo $user->knowledge_remote_learning != '' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="knowledge_remote_learning-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv', '#divtext-1', this)" type="radio" id="knowledge_remote_learning-2" name="knowledge_remote_learning-radio" <?php echo $user->knowledge_remote_learning == '' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="knowledge_remote_learning-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Tienes conocimiento en multiplataformas de aprendizajes en modalidad remota?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <div id="formdiv" style="display: <?php echo $user->knowledge_remote_learning != '' ? 'visible' : 'none'; ?>" class="form-group floating-label floating-label">
                                            <small id="exampleFloatingLabel6Help" class="form-text">
                                                Mencione las modalidades remota
                                            </small>
                                            <br>
                                            <textarea required data="field" name="knowledge_remote_learning" value="<?php echo $user->knowledge_remote_learning; ?>" class="form-control" id="divtext-1" rows="2"><?php echo $user->knowledge_remote_learning; ?></textarea>
                                        </div>


                                        <!-- <div class="card-header"></div> -->

                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="participation_virtual_training-1" name="participation_virtual_training" <?php echo $user->participation_virtual_training == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="participation_virtual_training-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="participation_virtual_training-2" name="participation_virtual_training" <?php echo $user->participation_virtual_training == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="participation_virtual_training-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Has participado en procesos formativos en modalidad virtual?
                                            <span style="color:red; font-size:large;"> *</span></small>



                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv-2', '#divtext-2', this)" type="radio" id="experience_online_training-1" name="experience_online_training-radio" <?php echo $user->experience_online_training != '' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="experience_online_training-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv-2', '#divtext-2', this)" type="radio" id="experience_online_training-2" name="experience_online_training-radio" <?php echo $user->experience_online_training == '' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="experience_online_training-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Has dado algún proceso formativo en línea?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <div id="formdiv-2" style="display: <?php echo $user->experience_online_training != '' ? 'visible' : 'none'; ?>" class="form-group floating-label floating-label">
                                            <small id="exampleFloatingLabel6Help" class="form-text">
                                                Mencione cuales
                                            </small>
                                            <br>
                                            <textarea required data="field" name="experience_online_training" value="<?php echo $user->experience_online_training; ?>" class="form-control" id="divtext-2" rows="2"><?php echo $user->experience_online_training; ?></textarea>
                                        </div>





                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv-3', '#divtext-3', this)" type="radio" id="know_platform_aprendiendo_juntos-1" name="know_platform_aprendiendo_juntos" <?php echo $user->know_platform_aprendiendo_juntos != '' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="know_platform_aprendiendo_juntos-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv-3', '#divtext-3', this)" type="radio" id="know_platform_aprendiendo_juntos-2" name="know_platform_aprendiendo_juntos" <?php echo $user->know_platform_aprendiendo_juntos == '' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="know_platform_aprendiendo_juntos-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Conoces la plataforma de Aprendiendo Juntos?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <div id="formdiv-3" style="display: <?php echo $user->training_received_aprendiendo_juntos != '' ? 'visible' : 'none'; ?>" class="form-group floating-label floating-label">
                                            <small id="exampleFloatingLabel6Help" class="form-text">
                                                Menciona los Talleres en que has participado en la plataforma de Aprendiendo Juntos
                                            </small>
                                            <br>
                                            <textarea required data="field" name="training_received_aprendiendo_juntos" value="<?php echo $user->training_received_aprendiendo_juntos; ?>" class="form-control" id="divtext-3" rows="2"><?php echo $user->training_received_aprendiendo_juntos; ?></textarea>
                                        </div>




                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="interest_to_training_on_aprendiendo_juntos-1" name="interest_to_training_on_aprendiendo_juntos" <?php echo $user->interest_to_training_on_aprendiendo_juntos == 'SI' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="interest_to_training_on_aprendiendo_juntos-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required type="radio" id="interest_to_training_on_aprendiendo_juntos-2" name="interest_to_training_on_aprendiendo_juntos" <?php echo $user->interest_to_training_on_aprendiendo_juntos == 'NO' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="interest_to_training_on_aprendiendo_juntos-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Te gustaría facilitar cursos en esta plataforma?
                                            <span style="color:red; font-size:large;"> *</span></small>






                                        <br>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv-4', '#divtext-4', this)" type="radio" id="know_benefits_online_training-1" name="know_benefits_online_training-radio" <?php echo $user->know_benefits_online_training != '' ? 'checked' : ''; ?> value="SI" class="custom-control-input">
                                            <label class="custom-control-label" for="know_benefits_online_training-1">SI</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input required onchange="tendencias('#formdiv-4', '#divtext-4', this)" type="radio" id="know_benefits_online_training-2" name="know_benefits_online_training-radio" <?php echo $user->know_benefits_online_training == '' ? 'checked' : ''; ?> value="NO" class="custom-control-input">
                                            <label class="custom-control-label" for="know_benefits_online_training-2">NO</label>
                                        </div>
                                        <small id="exampleFloatingLabel6Help" class="form-text">
                                            ¿Conoces las bondades de generar procesos formativos en línea?
                                            <span style="color:red; font-size:large;"> *</span></small>

                                        <div id="formdiv-4" style="display: <?php echo $user->know_benefits_online_training != '' ? 'visible' : 'none'; ?>" class="form-group floating-label floating-label">
                                            <small id="exampleFloatingLabel6Help" class="form-text">
                                                Menciona algunas bondades
                                            </small>
                                            <br>
                                            <textarea required data="field" name="know_benefits_online_training" value="<?php echo $user->know_benefits_online_training; ?>" class="form-control" id="divtext-4" rows="2"><?php echo $user->know_benefits_online_training; ?></textarea>
                                        </div>



                                        <br>

                                        <div class="form-group floating-label floating-label">
                                            <small id="exampleFloatingLabel6Help" class="form-text">
                                                Nos gustaría que nos aportaras algunas sugerencias para mejorar la plataforma de Aprendiendo Juntos, en cuanto a: Contenido, Diseño, Lenguaje, Incorporación de algunos recursos educativos, servicios de ayuda técnica, mensajería interna
                                            </small>
                                            <br>
                                            <textarea required data="field" name="suggestions_provided" value="<?php echo $user->suggestions_provided; ?>" class="form-control" id="suggestions_provided" rows="2"><?php echo $user->suggestions_provided; ?></textarea>
                                        </div>




                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> Enviar</button>
                                </div>
                            </div>


                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<br><br>





<script>
    function tendencias(formdiv, div, obj) {

        if (obj.value === "SI") {
            $(formdiv).show();
            $(div).val("");
        }
        if (obj.value === "NO") {
            $(formdiv).hide();
            $(div).val(obj.value);
        }

    }






    // CARGA DATOS DEL INFOCENTRO CON AJAX
    $(function() {
        $("#code_info").change(function() {
            code = $(this).val();
            // alert(code);
            if (code != "") {
                $.post("core/app/view/getInfoLocation-view.php", {
                    code_info: code
                }, function(data, response, status) {
                    // console.log(response);
                    var array = JSON.parse(data);

                    if (array["nombre"] === "No se encontró un infocentro con ese código") {
                        document.getElementById("code_info").value = "";
                        document.getElementById("code_info").focus();
                        alert("No se encontró un infocentro con el código: " + code);
                        return;
                    }
                    if (array["nombre"] === "El infocentro con ese código no tiene nombre en la Infoapp") {
                        document.getElementById("code_info").value = "";
                        document.getElementById("code_info").focus();
                        alert("El infocentro con el código: " + code + " no tiene nombre en la Infoapp");
                        return;

                    } else {
                        // alert(array["estado"]);
                        $("#info_name").val(array["nombre"]);
                        $("#user_state").val(array["estado"]);
                        $("#user_municipality").val(array["municipio"]);
                        $("#user_parish").val(array["parroquia"]);
                        $("#user_zone_type").val(array["tipo_zona"]);
                    }
                });
            };
        });
    });





    // CARGA DATOS DEL RESPONSABLE CON AJAX Y RETARDO AL ESCRIBIR
    var controladorTiempo = "";

    // retardo entre caracteres
    // $(function(){

    //     $("#user_dni").on("keyup", function() {
    //         clearTimeout(controladorTiempo);
    //         controladorTiempo = setTimeout(codigoAJAX, 800);
    //     });
    // });

    $("#user_dni").change(function() {
        code = document.getElementById("code_info").value;
        responsable_tipo = document.getElementById("user_type").value;
        que = document.getElementById("user_dni").value;

        if (code === "") {
            if (getOS() === "Android") {
                alert("Por favor ingresa el código del infocentro primero");
            } else {
                toastify('Por favor ingresa el código del infocentro primero', true, 10000, "warning");
            }
            document.getElementById("code_info").focus();
            document.getElementById("user_dni").value = "";
            return;
        }

        if (responsable_tipo === "") {
            if (getOS() === "Android") {
                alert("Por favor ingresa el tipo de responsable primero");
            } else {
                toastify('Por favor ingresa el tipo de responsable primero', true, 10000, "warning");
            }
            document.getElementById("user_type").focus();
            document.getElementById("user_dni").value = "";
            return;
        }

        // que = que.replace(/\./g,''); reemplaza puntos por nada


        // alert(responsable_tipo);
        if (responsable_tipo === "Facilitador") {
            $.post("core/app/view/getResponsible-view.php", {
                search: que,
                info_cod: code
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                // console.log(array["nombre"]);
                if (array["nombre"] === "El responsable no está en ese infocentro") {
                    alert("El responsable no está en ese infocentro o no es Facilitador");
                    document.getElementById("user_dni").focus();
                    document.getElementById("user_dni").value = "";
                    return;
                }
                $("#user_dni").val(array["dni"]);
                $("#user_name").val(array["nombre"]);
                $("#user_lastname").val(array["apellido"]);
                $("#user_email").val(array["email"]);
                $("#user_phone").val(array["telefono"]);
                $("#personal_type").val(array["personal_type"]);

            });

            // revisa si ya esta encuestado
            $.post("core/app/view/getEncuestaDni-view.php", {
                search: que
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                if (array["message"] != "null") {
                    alert(array["message"]);
                    document.getElementById("user_dni").focus();
                    return;
                }

            });


        }
        if (responsable_tipo === "Coordinador" || responsable_tipo === "Jefe de Estado") {
            $.post("core/app/view/getResponsible_coord-view.php", {
                search: que,
                info_cod: code
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                if (array["nombre"] === "El Coordinador no está registrado") {
                    alert("El coordinador no está registrado en Gestión Humana. Verifica que la C.I no contenga espacios");
                    document.getElementById("user_dni").focus();
                    document.getElementById("user_dni").value = "";
                    return;
                }
                // alert(array["nombre"]);
                $("#user_dni").val(array["dni"]);
                $("#user_name").val(array["nombre"]);
                $("#user_lastname").val(array["apellido"]);
                $("#user_email").val(array["email"]);
                $("#user_phone").val(array["telefono"]);
                $("#personal_type").val(array["personal_type"]);

            });

            // revisa si ya esta encuestado
            $.post("core/app/view/getEncuestaDni-view.php", {
                search: que,
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                if (array["message"] != "null") {
                    alert(array["message"]);
                    document.getElementById("user_dni").focus();
                    return;
                }

            });

        }
        if (responsable_tipo === "Gerente") {

            $.post("core/app/view/getResponsible_ger-view.php", {
                search: que,
                info_cod: code
            }, function(data) {
                var array = JSON.parse(data);
                if (array["nombre"] === "El gerente no está registrado") {
                    alert("El gerente no está registrado en Gestión Humana");
                    document.getElementById("user_dni").focus();
                    document.getElementById("user_dni").value = "";
                    return;
                }
                // alert(array["nombre"]);
                $("#user_dni").val(array["dni"]);
                $("#user_name").val(array["nombre"]);
                $("#user_lastname").val(array["apellido"]);
                $("#user_email").val(array["email"]);
                $("#user_phone").val(array["telefono"]);
                $("#personal_type").val(array["personal_type"]);
                $("#birthdate").val(array["birthdate"]);

            });

            // revisa si ya esta encuestado
            $.post("core/app/view/getEncuestaDni-view.php", {
                search: que,
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                if (array["message"] != "null") {
                    alert(array["message"]);
                    document.getElementById("user_dni").focus();
                    return;
                }

            });



        }


    })
    // =======================





    $(function() {

        $("#is_organization").change(function() {
            data = $(this).val();
            var checkbox = $("#checkbox_organization").is(":checked");

            var $organization_name = $('#organization_name');
            if (checkbox == true) {
                $($organization_name).show();
                $("#organization").focus();
            } else {
                $($organization_name).hide();
                $("#organization").val("");
            }

        });

    });



    // validar telefono
    var numbers = /^[0-9_-]+$/;
    var valida = /^\d{4}-\d{7}$/;
    $("#user_phone").on("keyup", function() {
        var tel = $(this).val();
        var element = document.getElementById("user_phone");

        if (tel.length > 0) {
            if (tel.match(valida)) {
                element.classList.remove("is-invalid");
                element.className += ' is-valid';
            } else {
                element.classList.remove("is-valid");
                element.className += ' is-invalid';
            }

            // solo numeros y guiones
            if (tel.match(numbers)) {
                // 
            } else {
                alert("¡En el campo teléfono solo se aceptan números!");
                document.getElementById("user_phone").focus();
                document.getElementById("user_phone").value = tel.substring(0, tel.length - 1);
            }
            // colocar y quitar guion
            if (tel.length > 4 && !tel.includes("-")) {
                document.getElementById("user_phone").value = tel.slice(0, 4) + "-" + (tel).slice(4);
            } else if (tel.length == 5) {
                document.getElementById("user_phone").value = tel.replace("-", "");
            }

            // if (tel.length == 11) {
            //     controladorTiempo = setTimeout(validaTele, 200);
            // }
        } else {
            document.getElementById("user_phone").value = ""
            element.classList.remove("is-invalid");
            element.className += ' is-valid';
        }


    });





    $(document).ready(function() {

        if (window.matchMedia("(min-width: 768px)").matches) {

            $('.js-example-basic-multiple').select2({
                // theme: 'filled',
                placeholder: 'Seleccione',
                width: '450px'
                // minimumResultsForSearch: Infinity /* Hide search on single select */
            });

        } else {
            $('.js-example-basic-multiple').wrap('<div class="textfield-box"></div>');
        }

    });
</script>






<style>
    /* Rules for sizing the icon. */
    .material-icons.md-18 {
        font-size: 18px;
    }

    .material-icons.md-24 {
        font-size: 24px;
    }

    .material-icons.md-36 {
        font-size: 36px;
    }

    .material-icons.md-48 {
        font-size: 48px;
    }

    /* Rules for using icons as black on a light background. */
    .material-icons.md-dark {
        color: rgba(0, 0, 0, 0.54);
    }

    .material-icons.md-dark.md-inactive {
        color: rgba(0, 0, 0, 0.26);
    }

    /* Rules for using icons as white on a dark background. */
    .material-icons.md-light {
        color: rgba(255, 255, 255, 1);
    }

    .material-icons.md-light.md-inactive {
        color: rgba(255, 255, 255, 0.3);
    }

    .material-icons.orange600 {
        color: #009dfb;
    }
</style>
