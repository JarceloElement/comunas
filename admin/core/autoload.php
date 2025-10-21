<?php
/**
* @author evilnapsis
* @brief Llama todos los archivos del framework LegoBox
**/

include "controller/Core.php";
include "controller/View.php";
include "controller/Module.php";
include "controller/Database_admin.php";
include "controller/DatabasePg_admin.php";
include "controller/Executor.php";
include "controller/ExecutorPg.php";
//# include "controller/Session.php"; [remplazada]

include "controller/forms/lbForm.php";
include "controller/forms/lbInputText.php";
include "controller/forms/lbInputPassword.php";
include "controller/forms/lbValidator.php";
// include ('../../../core/controller/Database.php');

// 10 octubre 2014
include "controller/Model.php";
include "controller/ModelPg.php";
include "controller/Bootload.php";
include "controller/Action.php";

// 13 octubre 2014
include "controller/Request.php";


// 14 octubre 2014
include "controller/Get.php";
include "controller/Post.php";
include "controller/Cookie.php";
include "controller/Session.php";
include "controller/Lb.php";

// 18 enero 2023
include "assets/upload/src/class.upload.php";

// 20 enero 2023
// include "core/app/usertheme/model/UserData.php";




?>