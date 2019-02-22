<?php
    //BUAT DATA BARU
    include "db.php";

    $nim = $_POST["nim"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $desc = $_POST["desc"];
    $scs = false;

    try{
        $db->prepare("INSERT INTO student (nim, fname, lname, `desc`) VALUES (?, ?, ?, ?)")
            ->execute([$nim, $fname, $lname, $desc]);
        $scs = true;
    }
    catch(Exception $e){

    }

    include "db2.php";

    echo json_encode($scs);
    // session_start();

    // if(isset($_POST["snim"]) && isset($_POST["sfname"]) && isset($_POST["slname"]) && isset($_POST["sdesc"])){
    //     $sorted = $_SESSION["students"];

    //     array_push($_SESSION["students"], array(
    //         "nim" => $_POST["snim"],
    //         "fname" => $_POST["sfname"],
    //         "lname" => $_POST["slname"],
    //         "desc" => $_POST["sdesc"]
    //     ));
    // }

    // echo json_encode($_SESSION["students"]);
?>