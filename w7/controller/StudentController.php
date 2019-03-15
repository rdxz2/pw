<?php
    include "../include/db_connect.php";
    include "../model/Student.php";

    //HTTP GET/POST HANDLER
    $id = (isset($_POST["id"])) ? $_POST["id"] : ((isset($_GET["id"])) ? $_GET["id"] : "");
    $nim = (isset($_POST["nim"])) ? $_POST["nim"] : ((isset($_GET["nim"])) ? $_GET["nim"] : "");
    $fname = (isset($_POST["fname"])) ? $_POST["fname"] : ((isset($_GET["fname"])) ? $_GET["fname"] : "");
    $lname = (isset($_POST["lname"])) ? $_POST["lname"] : ((isset($_GET["lname"])) ? $_GET["lname"] : "");
    $desc = (isset($_POST["desc"])) ? $_POST["desc"] : ((isset($_GET["desc"])) ? $_GET["desc"] : "");
    $addr = (isset($_POST["addr"])) ? $_POST["addr"] : ((isset($_GET["addr"])) ? $_GET["addr"] : "");

    switch($act){
        //BUAT TABEL
        case "getall":{
            $stdnt = new Student();
            $data = $stdnt->GetAll($db);
            $arr_v = array_values($data);

            echo json_encode($data);

            include "../include/db_disconnect.php";
            exit;
            break;
        }
        //CREATE
        case "create":{
            $v = renderPhpToString("../view/add_student.php", $d);
            $rs = true;
            break;
        }
        //CREATE (SUBMIT)
        case "createsubmit":{
            $stdnt = new Student();
            $scs = $stdnt->create($nim, $fname, $lname, $desc, $addr, $db);

            if($scs){
                $rs = true;
                $rt = "Student data created.";
            }
            else{
                $rt = "Error creating student data.";
            }
            break;
        }
        //EDIT
        case "edit":{
            $stdnt = new Student();
            $data = $stdnt->Get($id, $db);
            $d = [
                "id" => $data->get_id(),
                "nim" => $data->get_nim(),
                "fname" => $data->get_fname(),
                "lname" => $data->get_lname(),
                "desc" => $data->get_desc(),
                "addr" => $data->get_addr()
            ];

            $v = renderPhpToString("../view/edit_student.php", $d);
            $rs = true;
            break;
        }
        //EDIT (SUBMIT)
        case "editsubmit":{
            $stdnt = new Student();
            $scs = $stdnt->edit($id, $fname, $lname, $desc, $addr, $db);

            if($scs){
                $rs = true;
                $rt = "Student data updated.";
            }
            else{
                $rt = "Error udpating student data.";
            }
            break;
        }
        //DELETE
        case "delete":{
            $stdnt = new Student();
            $scs = $stdnt->delete($id, $db);

            if($scs){
                $rs = true;
                $rt = "Student data deleted.";
            }
            else{
                $rt = "Error deleting student data.";
            }
            break;
        }
        //??
        default:{
            $rt = "Wrong action.";
            break;
        }
    }

    include "../include/db_disconnect.php";

    echo json_encode([
        "s" => $rs,
        "t" => $rt,
        "v" => (isset($v)) ? $v : ""
    ]);

    exit;

    function renderPhpToString($file, $vars = []){
        if (is_array($vars) && !empty($vars)) {
            extract($vars);
        }
        ob_start();
        include $file;
        return ob_get_clean();
    }
?>