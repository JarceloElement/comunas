<?php
// header('Access-Control-Allow-Origin: *');

$user_id = $_SESSION['user_id'];
$user_region = $_SESSION['user_region'];
$id = $_GET['id'];

// $db = Database::getCon();
// $res = $db->query("SELECT image FROM reports WHERE id = '$id' ");

$conn = DatabasePg::connectPg();
$row = $conn->prepare("SELECT image FROM reports WHERE id='" . (int)$id . "'");
$row->execute();
$data = $row->fetchAll(PDO::FETCH_ASSOC);
// $TotalReg = $data[0]["reltuples"];


$images_array = array();
$images_string = "";

if ($data[0] > 0) {
  $images_array = explode(", ", $data[0]['image']);
  $images_string = $data[0]['image'];
  // echo "xxx".$images_string;
  // echo "xxx".$images_array[0];
}


?>




<script>
  $(function() {

    $(document).on('click', 'button[type="image_add"]', function(event) {
      let id = this.id;

      var id_report = document.getElementsByClassName("id_report").item(id).id;
      var image = document.getElementsByClassName("image").item(id).id;
      var images_string = document.getElementsByClassName("images_string").item(id).id;

      // alert(id);
      // alert(image);
      // alert(images_string);
      // return;

      $.ajax({
          type: "POST",
          url: "./?action=delimagereport",
          // headers: {
          //     "X-CSRFToken": getCookie("csrftoken")
          // },
          data: {
            id: id_report,
            image: image,
            images_string: images_string
          }
        })
        .done(function(msg) {
          console.log(msg);

          if (Number(msg) == 1) {
            if (getOS() == "Android") {
              alert("Imagen eliminada");
            } else {
              toastify('Imagen eliminada', true, 1000, "dashboard");
            }
            // window.document.location=msg;
            location.reload();
          } else {
            if (getOS() == "Android") {
              alert("No se pudo eliminar la imagen, consulta con el administrador");
            } else {
              toastify('No se pudo eliminar la imagen, consulta con el administrador', true, 3000, "dashboard");
            }
          }

          // $('#content').reload('#content');
          // $('#update_planning').modal('hide');
          // $('#cover-spin').hide(0);

        })
        .fail(function(err) {
          if (getOS() == "Android") {
            alert("Ocurrió un error al eliminar la imagen, intenta nuevamente");
          } else {
            toastify('Ocurrió un error al eliminar la imagen, intenta nuevamente', true, 5000, "warning");
          }

          // $('#cover-spin').hide(0);
        });



    });




  });
</script>



<!-- Modal upload image -->
<div class="modal" id="show_notific" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="title_preview">Agregar imagen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body fullscreen" id="modal-body">

        <!-- FORM -->
        <div class="col-md-12">
          <div class="form-group">

            <fieldset>
              <form id="upload_image" name="uploadForm" enctype="multipart/form-data" method="post" action="./?action=upload">
                <!-- <p><input type="file" onchange="this.form.submit();" size="32" name="image" value="" id="dnd_field" /></p> -->
                <p class="button"><input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
                <p class="button"><input type="hidden" name="code_info" value="<?php echo $_GET["code_info"]; ?>" />
                <p class="button"><input type="hidden" name="images" value="<?php echo $images_string; ?>" />
                <p class="button"><input type="hidden" name="action" value="image" />

                <div id="dnd_status"></div>
                <div id="dnd_drag">... arrastra y suelta aquí ...</div>


                <!-- <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div> -->

                <!-- preview -->
                <!-- <div class="form-group" id="uploadForm" ></div><br>  -->

                <div class="form-group" bis_skin_checked="1" id="uploadForm"></div><br>

                <div class="progressbar" style="display:none;" id="progressbardiv">
                  <br>
                  <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>



                <!-- <div class="form-group" >
                    <td><input type="file" name="image" id="dnd_field" accept="image/*"> <i class="fa fa-image icon_label"></i></td>
                </div> -->


                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <!-- <div class="fileinput-preview fileinput-exists thumbnail img-raised " ></div> -->
                  <div>
                    <span class="btn btn-raised btn-round btn-default btn-file" id="boton_subir">
                      <span class="fileinput-new">Selecionar imagen</span>
                      <span class="fileinput-exists">cambiar</span>
                      <input type="file" name="image" id="dnd_field" accept="image/*"> <i class="fa fa-image icon_label"></i>
                    </span>
                    <a href="#pablo" id="remove" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remover</a>


                    <!-- boton subir -->
                    <input type="hidden" name="Submit" id="submit" value="Subir" class="btn btn-primary btn-round fileinput-exists"></input>

                  </div>
                </div>






                <!-- <div id="dnd_progress"></div> -->

              </form>
              <!-- <div id="dnd_result"></div> -->
              <div class="xprogress"></div>
            </fieldset>

          </div>
        </div>

      </div>

      <!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div> -->
    </div>
  </div>
</div>





<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="col-md-12">
            <div class="form-group">


              <!-- admin -->
              <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

                <button href="#" type="show_notific" data-toggle="modal" data-target="#show_notific" class="btn btn-primary btn-fab btn-round">
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                    </svg></i>
                </button>


                <!-- jefe estado -->
              <?php } else if ($_SESSION["user_type"] == 8) { ?>

                <?php if ($user_region == $_GET['estate']) { ?>
                  <button href="#" type="show_notific" data-toggle="modal" data-target="#show_notific" class="btn btn-primary btn-fab btn-round">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                      </svg></i>
                  </button>
                <?php } ?>

                <!-- user id -->
              <?php } else { ?>

                <?php if ($user_id == $_GET['user_id']) { ?>
                  <button href="#" type="show_notific" data-toggle="modal" data-target="#show_notific" class="btn btn-primary btn-fab btn-round">
                    <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                      </svg></i>
                  </button>
                <?php } ?>

              <?php } ?>

              <label for="status_activity" style="text-align:center;color:#c50082;" class="control-label" id="act_title"> <?php echo $_GET["title"]; ?></label>


            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>






<div class="row">


  <!-- <div class="col-md-4">
    <div class="card text-center" >
      <br>
      <h5 class="title_preview" >Debido a que cambiaremos la Infoapp a un nuevo servidor, hemos pospuesto la carga de imágenes, una vez esté listo se podrán cargar.</h5>  
      <br>
    </div>
</div> -->


  <?php
  // $reports = ReportActivityData::getProducts();



  if (count($images_array) >= 1) {

    $ID = 0;

    foreach ($images_array as $image) {

      // $image = str_replace("origin", "preview", $image);
      $image_name = explode("_", $image);
      // echo $image_name[0];
      // echo $image;

      if ($image != "" && $image_name[0] == "origin") {
        $image_d = $image;

  ?>


        <div class="col-md-4">
          <div class="card text-center">
            <div class="card_imag-xxxx">
              <img class="card-img-top" id="https://infoapp2.infocentro.gob.ve/uploads/images/reports/<?php echo $image_d; ?>" src="uploads/images/reports/<?php echo $image_d; ?>" alt="image">
            </div>


            <!-- admin -->
            <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>

              <div class="card-body">
                <button type="image_add" id="<?php echo $ID; ?>" class="btn btn-primary btn-sm">Eliminar
              </div>

              <!-- jefe estado -->
            <?php } else if ($_SESSION["user_type"] == 8) { ?>

              <?php if ($user_region == $_GET['estate']) { ?>
                <div class="card-body">
                  <button type="image_add" id="<?php echo $ID; ?>" class="btn btn-primary btn-sm">Eliminar
                </div>
              <?php } ?>

              <!-- user id -->
            <?php } else { ?>

              <?php if ($user_id == $_GET['user_id']) { ?>
                <div class="card-body">
                  <button type="image_add" id="<?php echo $ID; ?>" class="btn btn-primary btn-sm">Eliminar
                </div>
              <?php } ?>

            <?php } ?>



          </div>
        </div>


        <!-- data preview -->
        <p class="id_report" id="<?php echo $_GET["id"]; ?>"></p>
        <p class="image" id="<?php echo $image_d; ?>"></p>
        <p class="images_string" id="<?php echo $images_string; ?>"></p>
        <p class="data_imagen" id="https://infoapp2.infocentro.gob.ve/admin/uploads/images/reports/<?php echo $image_d; ?>"></p>


        <?php $ID += 1; ?>



      <?php } else if ($image != "" && count($images_array) == 1 && $image_name[0] == "preview") {
        $image_d = $image;
      ?>

        <div class="col-md-4">
          <div class="card text-center">
            <div class="card_imag-xxxx">
              <img class="card-img-top" id="https://infoapp2.infocentro.gob.ve/uploads/images/reports/<?php echo $image_d; ?>" src="uploads/images/reports/<?php echo $image_d; ?>" alt="image">
            </div>
            <div class="card-body">
              <button type="image_add" id="<?php echo $ID; ?>" class="btn btn-primary btn-sm">Eliminar
            </div>
          </div>
        </div>


        <!-- data preview -->
        <p class="id_report" id="<?php echo $_GET["id"]; ?>"></p>
        <p class="image" id="<?php echo $image_d; ?>"></p>
        <p class="images_string" id="<?php echo $images_string; ?>"></p>
        <p class="data_imagen" id="https://infoapp2.infocentro.gob.ve/admin/uploads/images/reports/<?php echo $image_d; ?>"></p>


        <?php $ID += 1; ?>



      <?php } ?>


    <?php } ?>


  <?php } ?>






</div>




<script type="text/javascript">



  $("#remove").click(function() {
    document.getElementById("dnd_drag").style.display = 'block';
    document.getElementById("boton_subir").style.display = 'block';
    document.getElementById("submit").style.display = 'none';
    $('#uploadForm + img').remove();
  });



  $("#dnd_field").change(function() {
    filePreview(this);
  });

  function filePreview(input) {

    // TAMANYO DE LA IMAGEN
    if (input.files[0].size > 10000000) {
      Swal.fire({
        // position: 'top-center',
        icon: 'warning',
        title: 'La imagen:\n ' + '"' + input.files[0].name + '"' + ' \nNo debe exceder 10MB de peso',
        showConfirmButton: true,
        // timer: 1500
      })
    }

    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(input.files[0]);
      reader.onload = function(e) {
        $('#uploadForm + img').remove();
        $('#uploadForm').after('<img class="card-img-top" src="' + e.target.result + '" />');
        document.getElementById("dnd_drag").style.display = 'none';
        document.getElementById("submit").style.display = 'block';
        document.getElementById("uploadForm").style.display = 'block';
        document.getElementById("boton_subir").style.display = 'none';
      }
    }
  }







  window.onload = function() {

    function xhr_send(file, status, progress) {
      if (file) {
        xhr.addEventListener('readystatechange', function(event) {
          if (xhr.readyState == 4) {
            document.getElementById(status).innerHTML = xhr.responseText;
          }
        }, false);

        xhr.upload.addEventListener("progress", function(event) {
          if (event.lengthComputable) {
            self.progress = event.loaded / event.total;
          } else if (this.explicitTotal) {
            self.progress = Math.min(1, event.loaded / self.explicitTotal);
          } else {
            self.progress = 0;
          }
          document.getElementById(progress).innerHTML = ' ' + Math.floor(self.progress * 1000) / 10 + '%';
          document.getElementById(progress).style.width = self.progress * 100 + '%';
        }, false);

        xhr.open("POST", "./?action=upload");
        // xhr.setRequestHeader("Access-Control-Allow-Origin: *");
        xhr.setRequestHeader("Cache-Control", "no-cache");
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.setRequestHeader("X-File-Name", encodeURIComponent(file.name));
        xhr.send(file);
      }
    }



    function xhr_parse(file, status) {
      if (file) {
        document.getElementById(status).innerHTML = "Imagen : " + file.name + " (Peso: " + formatBytes(file.size) + ")";
        // document.getElementById(status).innerHTML = "Imagen : " + file.name + "(" + file.type + ", " + file.size + ")";
        document.getElementById("uploadForm").style.display = 'block';

        // crea la miniatura
        const fileInput = document.getElementById("dnd_field");
        if (fileInput.files && fileInput.files[0]) {
          var reader = new FileReader();
          reader.readAsDataURL(fileInput.files[0]);
          reader.onload = function(e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img class="card-img-top" src="' + e.target.result + '" />');
          }
        }


      } else {
        document.getElementById(status).innerHTML = "¡Nada seleccionado!";
      }
    }




    function dnd_hover(e) {
      e.stopPropagation();
      e.preventDefault();
      e.target.className = (e.type == "dragover" ? "hover" : "");
    }





    var xhr = new XMLHttpRequest();

    if (xhr && window.File && window.FileList) {

      // drag and drop example
      var dnd_file = null;
      document.getElementById("dnd_drag").style.display = "block";
      // document.getElementById("dnd_field").style.display = "none";

      document.getElementById("dnd_drag").ondragover = function(e) {
        dnd_hover(e);
      }
      document.getElementById("dnd_drag").ondragleave = function(e) {
        dnd_hover(e);
      }
      document.getElementById("dnd_drag").ondrop = function(e) {
        dnd_hover(e);
        var files = e.target.files || e.dataTransfer.files;
        dnd_file = files[0];

        // actualiza el input al arrastrar
        const fileInput = document.getElementById("dnd_field");
        const dataTransfer = new DataTransfer();

        dataTransfer.items.add(dnd_file);
        fileInput.files = dataTransfer.files;
        document.getElementById("submit").type = "submit";
        document.getElementById("submit").style.display = 'block';
        document.getElementById("dnd_drag").style.display = 'none';
        document.getElementById("boton_subir").style.display = 'none';



        xhr_parse(dnd_file, "dnd_status");
      }

      document.getElementById("dnd_field").onchange = function(e) {
        dnd_file = this.files[0];
        xhr_parse(dnd_file, "dnd_status");
        document.getElementById("submit").type = "submit";
      }

      // document.getElementById("dnd_upload").onclick = function (e) {
      //   e.preventDefault();
      //   xhr_send(dnd_file, "dnd_result", "dnd_progress");
      // }

    }
  }






  $('#upload_image').on('submit', (function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    const fileInput = document.getElementById("dnd_field");
    document.getElementById("submit").style.display = 'none';
    document.getElementById("remove").style.display = 'none';

    $.ajax({
      type: 'POST',
      // headers: {
      //     'Content-Type': 'application/x-www-form-urlencoded'
      // },
      url: $(this).attr('action'),
      data: formData,
      cache: false,
      contentType: false,
      processData: false,

      success: function(data) {
        console.log("success");
        console.log(data);

        // recargar pagina
        setTimeout(() => {
          window.location.reload();
        }, 2000);

        // crea la miniatura
        if (fileInput.files && fileInput.files[0]) {
          var reader = new FileReader();
          reader.readAsDataURL(fileInput.files[0]);
          reader.onload = function(e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img class="card-img-top" src="' + e.target.result + '" />');
            // $('#uploadForm').after('<img src="'+e.target.result+'" width="160" height="120"/>');
          }
        }

        document.getElementById("dnd_status").innerHTML = "";
        document.getElementById("submit").type = "hidden";
        $('#dnd_field').val('');

      },
      error: function(data) {
        console.log("POST-error");
        console.log(data);
      },
      xhr: function() {
        var xhr = new window.XMLHttpRequest();



        xhr.upload.addEventListener("progress", function(evt) {

          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = parseInt(percentComplete * 100);
            // console.log(percentComplete);
            $(".xprogress").html("Subiendo: " + formatBytes(evt.loaded) + " / " + formatBytes(evt.total));
            // $(".xprogress").html("Subiendo: "+ percentComplete +"%");
            document.getElementById("progressbardiv").style.display = "block";
            $('#progressbar').css('width', percentComplete + '%');
            var bar = document.querySelector(".progress-bar");
            bar.innerText = percentComplete + '%';

            // if (percentComplete === 100) {
            //   console.log("Imagen lista");
            // }

          }


        }, false);

        return xhr;


      },

    });

  }));






  function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
  }
</script>









<style>
  .form-group input[type=file] {
    opacity: 0;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
  }


  .form-group input[name=file] {
    opacity: 1;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
  }

  .icon_label {
    font-size: 45px;
  }


  #examples {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: stretch;
  }

  fieldset {
    box-sizing: border-box;
    margin-bottom: 20px;
    padding: 15px;
    width: 100%;
  }

  p.result {
    margin: 0px;
    padding: 0px;
  }

  legend {
    font-weight: bold;
  }

  .button {
    text-align: right;
  }

  .button input {
    font-weight: bold;
  }

  pre {
    white-space: pre-wrap;
  }

  #dnd_drag {
    display: none;
    text-align: center;
    padding: 3em 0;
    margin: 1em 0;
    color: #555;
    border: 2px dashed #888;
    border-radius: 7px;
    cursor: default;
  }

  #dnd_drag.hover {
    border: 2px dashed #f704ab;
  }

  #xhr_progress,
  #dnd_progress {
    background-color: #999;
    padding: .1em 0;
    width: 0%;
  }

  #xhr_status,
  #dnd_status {
    font-size: 90%;
    font-style: italic;
  }













  .row:before {
    display: block;
    content: " ";
  }

  .card-title,
  .card-text {
    margin-top: 0;
    margin-bottom: 5px;
    margin-left: 10px;
    margin-right: 10px;
  }

  .jumbotron {
    padding-top: 10px;
    padding-bottom: 10px;
    margin-bottom: 10px;
    color: inherit;
    background-color: #ffffff;
    box-shadow: 0 2px 2px 0 #99999924, 0 3px 3px -2px #99999933, 0 3px 5px 0 #9999991f;
    /* height: 500px; */
  }


  .card_imag {

    /* width:230px; */
    height: 180px;
    overflow: hidden;

  }

  .card_title {

    /* width:230px; */
    height: 45px;
    overflow: hidden;

  }

  .col-md-4 {
    /* width: 33.33333333%; */
    min-width: 33%;
  }


  .jumbotron p {
    margin-bottom: 15px;
    font-size: 16px;
    font-weight: 300;
    /* letter-spacing: 0.1em; */
    line-height: 20px;
  }


  @media screen and (min-width: 768px) {

    .container .jumbotron,
    .container-fluid .jumbotron {
      padding-right: 20px;
      padding-left: 20px;
    }

  }

  @media screen and (max-width: 769px) {

    .container .jumbotron,
    .container-fluid .jumbotron {
      padding-right: 20px;
      padding-left: 20px;
    }

  }



  /* limitar titulo de la tarjeta */
  .lead {
    width: 100%;
    table-layout: fixed;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>