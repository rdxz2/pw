<?php
    include "../include/db_connect.php";
    include "../models/Student.php";

    //HTTP GET/POST HANDLER
    $act = (isset($_POST["act"])) ? $_POST["act"] : ((isset($_GET["act"])) ? $_GET["act"] : "");

    switch($act){
        //BUAT TABEL
        case "getall":
            $stdnt = new Student();
            $data = $stdnt->GetAll($db);

            echo json_encode($data);

            break;
        //...
        //...
        //...
        default:
            echo "Wrong action";
            break;
    }

    include "../include/db_disconnect.php";

    exit;
?>