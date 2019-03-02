<?php
    include "db.php";

    $res = $db->query("SELECT * FROM student");

    $data = array();

    foreach($res as $r){
        $data[] = array(
            "id" => $r["id"],
            "nim" => $r["nim"],
            "fname" => $r["fname"],
            "lname" => $r["lname"],
        );
    }

    include "db2.php";

    echo json_encode($data);

    // session_start();

    // $students = array(
    //     array(
    //         "nim" => "00000010765",
    //         "fname" => "Richard",
    //         "lname" => "Dharmawan",
    //         "desc" => "desc1"
    //     ),
    //     array(
    //         "nim" => "00000012345",
    //         "fname" => "aaa",
    //         "lname" => "bbb",
    //         "desc" => "desc2"
    //     )
    // );

    // if(!isset($_SESSION["students"])) $_SESSION["students"] = $students;
    
    // echo json_encode($_SESSION["students"]);
?>