<?php
    include "db.php";

    //AJAX RESPONSE
    $rs = false;
    $rt = "Wrong NIM/Password";

    //QUERY DB
    $dbr = $db->prepare("SELECT * FROM student WHERE nim = " . $_POST["nim"] . " LIMIT 1");
    $dbr->execute();

    $res = $dbr->fetch();

    //KETEMU ATO KAGAK
    if($dbr->rowCount()>0){
        //CEK PASSWORD
        if (md5($_POST["pwd"]) === $res["pwd"]){
            $rs = true;
            $rt = "Welcome " . $res["fname"] . " " . $res["lname"];
        }
    }

    include "db2.php";

    echo json_encode([
        "s" => $rs,
        "t" => $rt
    ]);
?>