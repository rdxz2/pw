<?php
    include "../include/db_connect.php";
    include "../model/User.php";

    session_start();
    
    switch($act){
        case "view":{
            include "../view/student_data.php";
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
                $_SESSION["sess"] = [
                    "logged" => true,
                    "usn" => $data->get_usn()
                ];
                
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
        //REGISTER
        case "register":{
            $usn = $_POST["usn"];
            $pwd = $_POST["pwd"];
            $pwdc = $_POST["pwdc"];

            if($pwd == $pwdc){
                $usr = new User();
                $usr->set_usn($usn);
                $usr->set_pwd(md5($pwd));

                try{
                    $db->prepare("INSERT INTO users (usn, pwd) VALUES (?, ?)")->execute([$usr->get_usn(), $usr->get_pwd()]);
                    $rs = true;
                    $rt = "Register success.";
                }
                catch(Exception $e){
                    $rt = "Register failed.";
                }
            }
            else{
                $rt = "Password didn't match.";
            }

            break;
        }
        //LOG OUT
        case "logout":{
            //KILL SESSION
            unset($_SESSION["sess"]);
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
        "t" => $rt
    ]);
?>