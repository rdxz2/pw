<?php
    include "../include/db_connect.php";
    include "../models/User.php";

    session_start();

    //HTTP GET/POST HANDLER
    $act = (isset($_POST["act"])) ? $_POST["act"] : ((isset($_GET["act"])) ? $_GET["act"] : "");
    
    switch($act){
        case "view":{
            include "../views/index.php";
            exit;
            break;
        }
        //LOG IN
        case "login":{
            $usn = $_POST["usn"];
            $pwd = $_POST["pwd"];
            
            $usr = new User();
            $data = $usr->Login($usn, $pwd, $db);
            
            if ($data != false) {
                //SET SESSION
                $_SESSION["logged"] = true;
                
                $rs = true;
                $rt = "Login success.";
                echo json_encode([
                    "s" => $rs,
                    "t" => $rt,
                    "d" => json_decode(json_encode($data), true)
                ]);
                exit;
            }
            else{
                $rs = false;
                $rt = "User not found";
            }
            
            break;
        }
        //LOG OUT
        case "logout":{
            //KILL SESSION
            unset($_SESSION["logged"]);
            $rs = true;
            $rt = "Logged out.";
            break;
        }
        //??
        default:{
            $rt = "??";
            break;
        }
    }

    include "../include/db_disconnect.php";

    echo json_encode([
        "s" => $rs,
        "t" => $rt
    ]);
?>