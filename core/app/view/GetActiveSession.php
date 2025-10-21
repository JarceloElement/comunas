		<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../controller/DatabasePg.php');

    $user_id = $_POST['user_id'];
    $session_id = $_POST['session_id'];

    if ($_SESSION['user_id'] != "") {

      // carga las sessiones activas
      $conn = DatabasePg::connectPg();
      $sql = "SELECT * from user_session where active=1";
      $row_table = $conn->prepare($sql);
      $row_table->execute();
      $sessions = $row_table->fetchAll(PDO::FETCH_ASSOC);
      $TotalReg = $row_table->rowCount();

      $_SESSION['active_session'] = $TotalReg;

      $array = array(
        "active_session"  => "Session_activa",
        "total"  => $_SESSION['active_session'],
      );
    } else {

      $conn = DatabasePg::connectPg();
      $sql = "UPDATE user_session set active=0, session_id='expired' where user_id=$user_id";
      $row_table = $conn->prepare($sql);
      $row_table->execute();

      $array = array(
        "active_session"  => "Session_cerrada",
      );
    }

    echo json_encode($array);


    ?>



<?php
